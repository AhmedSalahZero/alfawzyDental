/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin')

const backfaceVisibility = plugin(function({addUtilities}) {
	addUtilities({
	  '.backface-visible': {
		'backface-visibility': 'visible',
	  },
	  '.backface-hidden': {
		'backface-visibility': 'hidden',
	  }
	})
  });
  
module.exports = {
	content: [
	   
	  './resources/**/*.blade.php',
	  './resources/**/*.js',
	  './resources/**/*.vue',
	  "./node_modules/tw-elements/dist/js/**/*.js"
  
	  ],
	theme: {
	  container:{
	  center:true	,
	  padding: {
		  DEFAULT: '1rem',
		  sm: '.5rem',
		  lg: '1rem',
		  xl: '1rem',
		  '2xl': '1rem',
		},
	  },
	  extend: {
		  colors:{
			  'main':"#D1AA65",
		  
		  },
	  },
	},
	plugins: [
	  require("tw-elements/dist/plugin.cjs"),
	  backfaceVisibility
	],
	darkMode: "class"
  }
  