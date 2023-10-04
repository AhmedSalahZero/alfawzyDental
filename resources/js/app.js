// 1- load jquery
const $ = require("jquery");
window.$ = window.Jquery = $;

// s-alpine js
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// swiper
const Swiper = require("swiper/bundle");
require("swiper/css/bundle");
window.Swiper = Swiper.Swiper;

import ScrollReveal from "scrollreveal";

window.ScrollReveal = ScrollReveal;

import "./scrollReveal.js";
