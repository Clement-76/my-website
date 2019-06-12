import config from "./config";

class ContactForm {

    /**
     * @param contactFormId
     */
    constructor(contactFormId) {
        this.form = $('#' + contactFormId);
        this.form.on('submit', this.sendMessage.bind(this));
    }

    /**
     * send a message with an ajax request and return a status message
     * @param e
     */
    sendMessage(e) {
        e.preventDefault();

        // define the messageData variable value with FormData(form)
        let messageData = new FormData(this.form[0]);

        $.ajax({

            url: `${config.baseUrl}/contact`,
            type: 'POST',
            data: messageData,
            dataType: 'JSON',
            processData: false,
            contentType: false

        }).always((data) => {

            if (data.status === 'success') {
                this.displayStatusMessage('success', 'Votre message a bien été envoyé');
                this.clear();
            } else if (data.status === 'error') {
                this.displayStatusMessage('error', data.message);
            } else {
                console.error('Bad value or undefined property status of data.status');
                this.displayStatusMessage('error', 'Une erreur imprévue s\'est produite');
            }
        });
    }

    /**
     * display a message in a modal using Swal
     * @param status
     * @param text
     */
    displayStatusMessage(status, text) {
        Swal.fire({
            type: status,
            title: text,
            heightAuto: false,
            customClass: {
                container: 'modal-container',
                title: 'info-message',
                confirmButton: 'confirm-btn'
            }
        });
    }

    clear() {
        this.form.find('input:not([type=submit]), textarea').val('');
    }
}

export default ContactForm;
