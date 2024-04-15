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
        primary: 'bg-red-300',
        secondary: 'bg-orange-500',
        'custom-blue': '#3f4874',
        'custom-orange':'#ff8d00',
      },
    },
  },
  plugins: [],
}