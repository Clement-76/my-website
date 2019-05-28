import changeMenuOnScroll from './changeMenuOnScroll';
import scrollToEltOnClick from './scrollToEltOnClick';

changeMenuOnScroll('menu', '#fffdf7', 'rgba(0, 0, 0, 0.7)');

let menuHeight = $('#menu').outerHeight();
scrollToEltOnClick('go-down', 'about-me', menuHeight);

$('.menu-item').each((i, elt) => {
    scrollToEltOnClick($(elt).attr('id'), $(elt).attr('data-target-id'), menuHeight);
});
