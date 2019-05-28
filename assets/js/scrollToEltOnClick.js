/**
 * scroll to an element on click
 * @param eltId
 * @param targetElement the target where to go
 * @param offset value add to the scrollTop of the target element, if you have a fixed menu for example
 * @param transitionDuration the duration of the scroll
 */
function scrollToEltOnClick(eltId, targetElementId, offset = 0, transitionDuration = 500) {
    let targetElement = $('#'+ targetElementId);

    $('#' + eltId).on('click', (e) => {
        e.preventDefault();

        $('html, body').animate({
            scrollTop: targetElement.offset().top - offset
        }, transitionDuration);
    });
}

export default scrollToEltOnClick;
