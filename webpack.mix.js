const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss'); 
mix.sass('./resources/scss/main.scss','./public/front/scss')
.js('./resources/js/app.js','./public/front/js/plugins.js')
.options({
	postCss: [ tailwindcss('./tailwind.config.js') ],
}).disableNotifications();
