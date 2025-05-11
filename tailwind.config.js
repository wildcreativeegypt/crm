/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
  ],
  theme: { extend: {} },
  plugins: [
    require('@tailwindcss/forms'), // if you want form styles
    require('daisyui'),
  ],
  daisyui: {
    themes: ['light'], // or your preferred themes
  },
}
