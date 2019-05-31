import config from "./config";
import create from "./create";

class ProjectModal {

    constructor(project) {
        this.createModal(project);
    }

    createModal() {
        let projectModal = create('div', {class: 'modal-project-container'}, this.projectsContainer[0]);
        let project = create('div', {class: 'project', style: `background-image: ${fullImagePath}`}, projectModal);
        create('button', {class: 'see-project', text: 'Voir le projet'}, project);

        this.modal = $(projectModal);
    }

    openModal() {
        // this.modal.show();
    }

    closeModal() {
        // this.modal.hide();
    }
}

export default ProjectModal;
