/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
  theme: {
    extend: {
        colors: {
            'my-green': '#35b675',
            'black-blue': '#242c4d'
        },
    },
  },
  plugins: [],
}

