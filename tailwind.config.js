const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  mode: 'jit',
  purge: [
      './**/*.php',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        sans: ['Theinhardt, "Helvetica Neue", Helvetica, Arial, sans-serif', ...defaultTheme.fontFamily.sans],
        serif: ['Theinhardt, "Helvetica Neue", Helvetica, Arial, sans-serif', ...defaultTheme.fontFamily.serif],
      },
      colors: {
        'uic-white': '#f6f6f6',
        'headline': '#d50032',
        'sub-headline': '#001e62',
        'body-text': '#333333',
        'link': '#001e62',
        'hover': '#e1e1e1',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
