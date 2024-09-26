<?php

namespace App\Http\Controllers;

use App\Mail\DeclarationApprouveeMail;
use App\Mail\DeclarationRejeterMail;
use App\Models\Declaration;
use App\Models\Entreprise;
use App\Models\Travailleur;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DeclarationController extends Controller
{
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
    public function envoyerFichierExcel(): View|Factory|Application
    {
        return view('entreprise.declaration.envoyer');
    }
    public function declarationEnAttente(Entreprise $entreprise): View|Factory|Application
    {
        // Récupérer toutes les déclarations de l'entreprise qui sont en attente
        $declarations = Declaration::where('entreprise_id', $entreprise->id)
            ->where('status', 'en attente') // Filtrer par état "en attente"
            ->get();

        // Retourner la vue avec les déclarations en attente
        return view('admin.declaration.attente', compact('declarations', 'entreprise'));
    }
    public function declarationEnApprouver(Entreprise $entreprise): View|Factory|Application
    {
        // Récupérer toutes les déclarations approuvées de l'entreprise
        $declarations = Declaration::where('entreprise_id', $entreprise->id)
            ->where('status', 'approuve') // Filtrer par état "approuvé"
            ->get();

        // Retourner la vue avec les déclarations approuvées
        return view('admin.declaration.approuver', compact('declarations', 'entreprise'));
    }
    public function declarationEnRejeter(Entreprise $entreprise): View|Factory|Application
    {
        // Récupérer toutes les déclarations rejetées de l'entreprise
        $declarations = Declaration::where('entreprise_id', $entreprise->id)
            ->where('status', 'rejete') // Filtrer par état "rejeté"
            ->get();

        // Retourner la vue avec les déclarations rejetées
        return view('admin.declaration.rejeter', compact('declarations', 'entreprise'));
    }
    public function download($id): BinaryFileResponse|RedirectResponse
    {
        // Trouver la déclaration par son ID
        $declaration = Declaration::findOrFail($id);

        // Construire le chemin complet du fichier
        $filePath = storage_path('app/public/' . $declaration->file_path);

        // Vérifier si le fichier existe
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
        }

        // Télécharger le fichier
        return response()->download($filePath);
    }
    public function repondre(Declaration $declaration): RedirectResponse
    {

        // Envoyer un e-mail à l'entreprise
        Mail::to($declaration->entreprise->email)->send(new DeclarationApprouveeMail($declaration));
        $declaration->status = 'approuve';
        $declaration->save();

        return redirect()->back()->with('success', 'Déclaration approuvée et email envoyé.');
    }
    public function confirmerRejet(Declaration $declaration): RedirectResponse
    {

        // Envoyer un e-mail à l'entreprise
        Mail::to($declaration->entreprise->email)->send(new DeclarationRejeterMail($declaration));

        // Logique pour rejeter la déclaration
        $declaration->status = 'rejete';
        $declaration->save();

        return redirect()->back()->with('success', 'Déclaration rejetée et email envoyé.');
    }
}
