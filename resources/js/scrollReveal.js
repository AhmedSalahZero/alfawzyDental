import ScrollReveal from "scrollreveal"

const scrollMobile = false;
const scrollFromLeftToRight = {
    delay: 500,
    duration: 500,
    opacity: 0,
    origin: "bottom",
    distance: "140%",
    reset: false,
    mobile: scrollMobile,
};

const scrollFromRightToLeft = {
    delay: 500,
    duration: 1200,
    opacity: 0,
    origin: "right",
    distance: "150%",
    reset: false,
    mobile: scrollMobile,
};
const scrollFromBottomToUp = {
    delay: 500,
    duration: 1200,
    opacity: 0,
    origin: "bottom",
    distance: "150%",
    reset: false,
    mobile: scrollMobile,
};
const revealOptions = {
    distance: "150%",
    reset: false,
    origin: "top",
    opacity: 0,
    delay: 500,
    duration: 500,
    scale: 1.05,
    mobile: scrollMobile,
};
 ScrollReveal().reveal(".min-services-container", revealOptions);
ScrollReveal().reveal(".section-header", revealOptions);


ScrollReveal().reveal(".scroll-from-left-to-right", scrollFromLeftToRight);
ScrollReveal().reveal(".scroll-from-bottom-to-up", scrollFromBottomToUp);
ScrollReveal().reveal(".scroll-from-right-to-left", scrollFromRightToLeft);
