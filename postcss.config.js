// postcss.config.js
module.exports = {
  plugins: [
    require('@tailwindcss/postcss'),   // 🔥 must be this, not 'tailwindcss'
    require('autoprefixer'),
  ],
}
