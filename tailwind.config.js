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
        'custom-blue-header': '#01105a',
        'custom-blue': '#3f4874',
        'custom-blue2' :'#2f396d',
        'custom-orange':'#ff8d00',
        'custom-font-blue' :'#353858',
      },
    },
  },
  plugins: [],
}