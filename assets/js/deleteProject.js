// import config from "./config";

$('.delete-project').on('click', e => {
    e.preventDefault();

    if (confirm(`Êtes-vous sûr de vouloir supprimer ce projet ?`)) {
        const targetUrl = e.currentTarget.href;

        $.get(targetUrl, data => {

            const getStatusMessage = (alertType, message) => {
                return `<div class="alert alert-${alertType} alert-dismissible fade show" role="alert">
                            ${message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`;
            }

            if (data.status === 'success') {
                $('h1').after(getStatusMessage('success', 'Le projet a bien été supprimé !'));
                $(e.currentTarget).parent().parent().remove();
            } else {
                $('h1').after(getStatusMessage('danger', data.message));
            }
        }, 'JSON');
    }
});
