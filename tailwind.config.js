/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {

        extend: {
            colors: {
                'primary': '#f9191f',
                'secondary': '#2C1526',
                'tertiary': '#412C3C',
                'white-secondary': '#F0EDED',
                'placeholder': '#B9A9A9',
                'tab-secondary': '#D8D0D0',
                'success': '#3FD23C',
                'success-bg': '#EFFCEA',
                'error': '#E53633',
                'error-bg': '#FCEBEA',
            },
        },
        fontFamily: {
            'custom': ['Urbanist', 'sans-serif']
        }
    },
    plugins: [],
}
