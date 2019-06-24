import config from "./config";
import create from "./create";

class Project {

    /**
     * @param projectsContainerId
     * @param description
     * @param imageName
     * @param link
     * @param repoLink
     * @param title
     */
    constructor(projectsContainerId, {description, imageName, link, repoLink, title}) {
        this.projectsContainer = $('#' + projectsContainerId);
        this.description = description;
        this.fullImagePath = `${config.baseUrl}/${config.projectsPath}/${imageName}`;
        this.link = link;
        this.repoLink = repoLink;
        this.title = title;

        this.createProject();
    }

    /**
     * create the project HTML element and stores it in a property
     */
    createProject() {
        let projectContainer = create('div', {class: 'project-container'}, this.projectsContainer[0]);
        let project = create('div', {class: 'project', style: `background-image: url('${this.fullImagePath}')`}, projectContainer);
        this.openBtn = create('button', {class: 'see-project', text: 'Voir le projet'}, project);
        this.projectHTML = $(projectContainer);
    }
}

export default Project;
