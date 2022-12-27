/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/views/admin/**/*.blade.php",
        "./resources/js/admin/**/*.vue",
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
                'success-primary': '#3FAD35',
                'success-secondary': '#EFFCEA',
                'error-primary': '#E53633',
                'error-secondary': '#FCEBEA',
                'warning-primary': '#FEA04A',
                'warning-secondary': '#FFF7E8',
                'preview-primary': '#A762B5',
                'preview-secondary': '#FFF0FD',
                'extra-primary': '#4D9FEC',
                'extra-secondary': '#F0F5FF',
            },
        },
        fontFamily: {
            'custom': ['Urbanist', 'sans-serif']
        }
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
    ],
}
