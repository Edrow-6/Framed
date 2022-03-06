const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
      './modules/**/**/views/**/**/*.{php,js}',
      './public/assets/js/*.js'
  ],
  theme: {
    extend: {},
    fontFamily: {
      sans: ['Manrope', ...defaultTheme.fontFamily.sans],
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/line-clamp')
  ],
}
