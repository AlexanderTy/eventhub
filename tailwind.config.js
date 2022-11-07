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
                'g': '#5d5c61',
                'g-h': '#77767B',
                'lg': '#938E94',
                'lg-h': '#7A757B',
                'lb': '#7395AE',
                'lb-h': '#8DAFC8',
                'b': '#557a95',
                'b-h': '#6F94AF',
                'br': '#B1A296',
                'br-h': '#CBBCB0',
                'primary': '#DF3838',
                'secondary': '#2C1526',
                'tertiary': '#412C3C',
            },
        },
    },
    plugins: [],
}
