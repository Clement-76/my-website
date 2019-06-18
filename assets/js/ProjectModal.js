import create from "./create";

class ProjectModal {

    /**
     * @param modalsContainerId
     * @param project
     */
    constructor(modalsContainerId, project) {
        this.modalsContainer = $('#' + modalsContainerId);
        this.createModal(project);
    }

    /**
     * create the modal HTML element and stores it
     * @param description
     * @param fullImagePath
     * @param link
     * @param repoLink
     * @param title
     * @param openBtn
     */
    createModal({description, fullImagePath, link, repoLink, title, openBtn}) {
        this.modal = create('div', {class: 'modal-overlay'});
        let githubLink = '';

        if (repoLink !== null) {
            githubLink = `<a class="github" href="${repoLink}" rel="noopener" target="_blank"><i class="icon-github"></i></a>`;
        }

        $(this.modal).html(`
        <div class="modal-project">
            <div class="top">
                <img class="project-image" src="${fullImagePath}" alt="">
                <div class="close"><i class="icon-close"></i></div>
            </div>

            <div class="info">
                <h3>${title}</h3>
                <div class="description">${description}</div>
                <div class="links">
                    <a href="${link}" rel="noopener" target="_blank" class="open-site">Voir le site</a>
                    ${githubLink}
                </div>
            </div>
        </div>`);

        $(openBtn).on('click', this.openModal.bind(this));
        $(this.modal).on('click', this.closeModal.bind(this));
        $(this.modal).find('.close, .close i').on('click', this.closeModal.bind(this));
        this.modalsContainer.append(this.modal);
    }

    /**
     * show the modal
     */
    openModal() {
        $('body').css('overflow', 'hidden');
        $(this.modal).css('visibility', 'visible');
        $(this.modal).find('.modal-project').css('transform', 'scale(1)');
    }

    /**
     * hide the modal
     * @param e
     */
    closeModal(e) {
        if (e.currentTarget === e.target) {
            $(this.modal).find('.modal-project').css('transform' ,'scale(0)');
            $('body').css('overflow', 'visible');
            $(this.modal).css('visibility', 'hidden');
        }
    }
}

export default ProjectModal;
