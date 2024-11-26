/** @type {import('tailwindcss').Config} */
export default {
  presets: [
    require("./vendor/wireui/wireui/tailwind.config.js")
  ],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    // "./resources/**/*.vue",
    'node_modules/preline/dist/*.js',
    "./vendor/wireui/wireui/src/*.php",
    "./vendor/wireui/wireui/ts/**/*.ts",
    "./vendor/wireui/wireui/src/WireUi/**/*.php",
    "./vendor/wireui/wireui/src/Components/**/*.php",
  ],
  // safelist: [/text-/, /^border-/],
  // safelist: [
  //   'text-/',
  //   'border-/',
  //   {
  //     pattern: /^/,
  //   },
  // ],
  theme: {
    extend: {
      animation: {
        wiggle: 'wiggle 1s ease-in-out infinite',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('preline/plugin'),
  ],
}

