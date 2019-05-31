import config from './config.js';
import changeMenuOnScroll from './changeMenuOnScroll';
import scrollToEltOnClick from './scrollToEltOnClick';
import ProjectModal from './ProjectModal';
import Project from "./Project";

changeMenuOnScroll('menu', '#fffdf7', 'rgba(0, 0, 0, 0.7)');

let menuHeight = $('#menu').outerHeight();
scrollToEltOnClick('go-down', 'about-me', menuHeight);

$('.menu-item').each((i, elt) => {
    scrollToEltOnClick($(elt).attr('id'), $(elt).attr('data-target-id'), menuHeight);
});

$.get(config.baseUrl + '/projects', (data) => {
    data.forEach(projectData => {
        let project = new Project('projects', projectData);
        new ProjectModal(project);
    });
}, 'JSON');
