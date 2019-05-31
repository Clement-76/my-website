import config from "./config";
import create from "./create";

class Project {
    constructor(projectsContainerId, {description, imagePath, link, repoLink, title}) {
        this.projectsContainer = $('#' + projectsContainerId);
        this.description = description;
        this.fullImagePath = `url('${config.baseUrl}/${imagePath}')`;
        this.link = link;
        this.repoLink = repoLink;
        this.title = title;

        this.displayProject();
    }

    displayProject() {
        let projectContainer = create('div', {class: 'project-container'}, this.projectsContainer[0]);
        let project = create('div', {class: 'project', style: `background-image: ${this.fullImagePath}`}, projectContainer);
        create('button', {class: 'see-project', text: 'Voir le projet'}, project);

        this.projectHTML = $(projectContainer);
    }
}

export default Project;
