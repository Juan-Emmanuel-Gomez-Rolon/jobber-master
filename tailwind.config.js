/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Roboto', 'sans-serif'],
      },
      colors: {
        primary: '#007fdd',
        primaryHover: '#54ACDC',
        grayForm: '#eeeeee',
        grayFormUnderline: '#e8e8e8',
        grayBackground: '#f4f2ef',
        grayDark: '#d0d0d0',
        grayDarkIcon: "#7b7b7b",
        secondary: '#00FF00',
        success: '#0000FF',
        warning: '#FFFF00',
        error: '#FF00FF',
      },
      spacing: {
        '120': '30rem',
        '128': '32rem',
      },
      boxShadow: {
        'bold': '1px 1px 17px 7px rgba(0,0,0,0.62)',
      },
    }
  },
  plugins: [],
}

