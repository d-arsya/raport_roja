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
    extend: {
      colors: {
        primary: {
          DEFAULT: '#e4007e',
          hover: '#c9006f',
          50: '#fdf2f8',
          100: '#fce7f3',
          500: '#e4007e',
          600: '#db2777',
          700: '#be185d',
        },
        secondary: {
          DEFAULT: '#8dc31e',
          hover: '#79a819',
          500: '#8dc31e',
          600: '#65a30d',
        },
        tertiary: '#1bc5bd',
        quaternary: '#c694f9',
        quinary: '#de2ff5',
        danger: '#f8374b',
        warning: '#ffa800',
        success: '#28af52',
        info: '#6866e9',
        dark: '#17283c',
        grey: '#abb4be',
        roja: {
          bg: '#ecedf0',
          card: '#fdfdfd',
          border: '#eeeeee',
        }
      },
      borderRadius: {
        'xl': '12px',
        '2xl': '16px',
        '3xl': '24px',
      },
      boxShadow: {
        'roja-sm': '0px 4px 12px rgba(0, 0, 0, 0.04)',
        'roja-md': '0px 8px 30px rgba(0, 0, 0, 0.06)',
        'roja-primary': '0px 8px 16px rgba(228, 0, 126, 0.25)',
        'roja-secondary': '0px 8px 16px rgba(141, 195, 30, 0.25)',
      }
    },
  },
  plugins: [],
}

