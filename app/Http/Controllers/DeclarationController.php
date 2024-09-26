<?php

namespace App\Http\Controllers;

use App\Models\Declaration;
use App\Models\Entreprise;
use App\Models\Travailleur;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DeclarationController extends Controller
{
    // Générer et télécharger le fichier Excel avec les travailleurs
    public function generateExcel(): BinaryFileResponse
    {
        $entreprise = Entreprise::find(auth()->id());

        // Récupérer les travailleurs de cette entreprise avec leur immatriculation approuvée
        $travailleurs = Travailleur::where('entreprise_id', $entreprise->id)
            ->whereHas('immatriculation', function ($query) {
                $query->where('etat', 'accepter');
            })
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Définir les en-têtes
        $headers = [
            'id travailleur',
            'Num_mmatriculation',
            'Nom',
            'Postnom',
            'Prenom',
            'Commune',
            'Periode Cotisee ',
            'Montant Brut Imposable',
            'Montant Cotise'
        ];

        // Ajouter les en-têtes à la première ligne
        $sheet->fromArray($headers, null, 'A1');

        // Mettre les en-têtes en gras, agrandir la police et ajuster la hauteur des lignes
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);

        // Définir la hauteur de la ligne 1 (les en-têtes)
        $sheet->getRowDimension(1)->setRowHeight(16); // Par exemple, définir la hauteur de la première ligne à 30

        // Ajuster la largeur des colonnes automatiquement
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Remplir les données des travailleurs
        $row = 2;
        foreach ($travailleurs as $travailleur) {
            $sheet->setCellValue('A' . $row, $travailleur->id);
            $sheet->setCellValue('B' . $row, $travailleur->matricule);
            $sheet->setCellValue('C' . $row, $travailleur->nom);
            $sheet->setCellValue('D' . $row, $travailleur->postnom);
            $sheet->setCellValue('E' . $row, $travailleur->prenom);
            $sheet->setCellValue('G' . $row, date('Y-m'));
            $row++;
        }

        // Ajouter la formule pour la colonne des montants cotisés
        for ($i = 2; $i < $row; $i++) {
            $sheet->setCellValue('I' . $i, '=H' . $i . '*18/100');
        }

        // Générer et sauvegarder le fichier Excel
        $fileName = 'Declaration_Cotisation_' . date('Y-m') . '.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


    // Upload du fichier Excel complété par l'entreprise
    public function uploadExcel(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        // Stocker le fichier uploadé
        $path = $request->file('file')->store('declarations', 'public');

        // Créer une nouvelle déclaration
        Declaration::create([
            'entreprise_id' => Entreprise::find(auth()->id())->id,
            'file_path' => $path,
            'status' => 'en attente',
        ]);

        return back()->with('success', 'Fichier uploadé avec succès. En attente de validation.');
    }

    public function enoyerFichierExcel(): View|Factory|Application
    {
        return view('entreprise.declaration.envoyer');
    }
}
