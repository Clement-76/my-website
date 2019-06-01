import create from "./create";

class ProjectModal {

    constructor(modalsContainerId, project) {
        this.modalsContainer = $('#' + modalsContainerId);
        this.createModal(project);
    }

    createModal({description, fullImagePath, link, repoLink, title, openBtn}) {
        this.modal = create('div', {class: 'modal-overlay'});
        let githubLink = '';

        if (repoLink !== null) {
            githubLink = `<a class="github" href="${repoLink}"><i class="icon-github"></i></a>`;
        }

        $(this.modal).html(`
        <div class="modal-project">
            <div class="top">
                <img class="project-image" src="${fullImagePath}" alt="">
                <div class="close"><i class="icon-close"></i></div>
            </div>

            <div class="info">
                <h3>${title}</h3>
                <p class="description">${description}</p>
                <div class="links">
                    <a href="${link}" target="_blank" class="open-site">Voir le site</a>
                    ${githubLink}
                </div>
            </div>
        </div>`);

        $(openBtn).on('click', this.openModal.bind(this));
        $(this.modal).on('click', this.closeModal.bind(this));
        $(this.modal).find('.close, .close i').on('click', this.closeModal.bind(this));
        this.modalsContainer.append(this.modal);
    }

    openModal() {
        $('body').css('overflow', 'hidden');
        $(this.modal).css('visibility', 'visible');
        $(this.modal).find('.modal-project').css('transform', 'scale(1)');
    }

    closeModal(e) {
        if (e.currentTarget === e.target) {
            $(this.modal).find('.modal-project').css('transform' ,'scale(0)');
            $('body').css('overflow', 'visible');
            $(this.modal).css('visibility', 'hidden');
        }
    }
}

export default ProjectModal;
