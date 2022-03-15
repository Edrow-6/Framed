const defaultTheme = require('./libs/node_modules/tailwindcss/defaultTheme')

module.exports = {
  content: [
      '../app/resources/views/**/**/*.php',
      '../plugins/**/resources/views/**/**/*.php',
      '../app/resources/assets/js/**/*.js',
      '../plugins/**/resources/assets/js/**/*.js',
      '../public/js/**/*.js'
  ],
  theme: {
    extend: {},
    fontFamily: {
      sans: ['Manrope', ...defaultTheme.fontFamily.sans],
    },
  },
  plugins: [
    require('./libs/node_modules/@tailwindcss/typography'),
    require('./libs/node_modules/@tailwindcss/forms'),
    require('./libs/node_modules/@tailwindcss/aspect-ratio'),
    require('./libs/node_modules/@tailwindcss/line-clamp')
  ],
}
