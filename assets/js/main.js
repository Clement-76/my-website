import config from './config';
import changeMenuOnScroll from './changeMenuOnScroll';
import scrollToEltOnClick from './scrollToEltOnClick';
import ProjectModal from './ProjectModal';
import Project from './Project';
import Menu from './Menu';
import ContactForm from "./ContactForm";

changeMenuOnScroll('menu', '#fffdf7', 'rgba(0, 0, 0, 0.7)');

let menuHeight = $('#menu').outerHeight();
scrollToEltOnClick($('#go-down'), 'about-me', config.menuBreakpoint, menuHeight);

$('.menu-item').each((i, elt) => {
    scrollToEltOnClick($(elt), $(elt).attr('data-target-id'), config.menuBreakpoint, menuHeight);
});

$.get(config.baseUrl + '/projects', (data) => {
    data.forEach(projectData => {
        let project = new Project('projects', projectData);
        new ProjectModal('portfolio', project);
    });
}, 'JSON');

new Menu('mobile-menu', 'close-menu', 'open-menu', 'menu-overlay');

let homeSectionHeight = $('#home').innerHeight();
let topValue = homeSectionHeight - parseFloat($('#open-menu').css('top')) - parseFloat($('#open-menu').css('padding-top'));

const checkScrollMenu = () => {
    if (window.scrollY > topValue) {
        $('#open-menu div').css('background-color', '#222');
    } else {
        $('#open-menu div').css('background-color', '#fff');
    }
}

checkScrollMenu();
$(window).on('scroll', checkScrollMenu);

let contactForm = new ContactForm('contact-form');
