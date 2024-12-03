/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/**/*.js",
    "./resources/views/**/*.vue",
  ],
  theme: {
    fontFamily:{
      'sans': ['Montserrat', 'sans-serif'],
    },
    extend: {},
  },
  plugins: [],
}

