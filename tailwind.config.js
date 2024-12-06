/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

export default {
  presets: [
    require("./vendor/wireui/wireui/tailwind.config.js"),
    require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
  ],
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    'node_modules/preline/dist/*.js',
    "./vendor/wireui/wireui/src/*.php",
    "./vendor/wireui/wireui/ts/**/*.ts",
    "./vendor/wireui/wireui/src/WireUi/**/*.php",
    "./vendor/wireui/wireui/src/Components/**/*.php",
    './app/Livewire/**/*Table.php',
    './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
    './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php',
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
      colors: {
        "pg-primary": colors.lime,
      },
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

