/**
 * scroll to an element on click
 * @param elt the element to click
 * @param targetElement the target where to go
 * @param offset value add to the scrollTop of the target element, if you have a fixed menu for example
 * @param transitionDuration the duration of the scroll
 */
function scrollToEltOnClick(elt, targetElementId, breakpointMenuValue, offset = 0, transitionDuration = 500) {
    let targetElement = $('#'+ targetElementId);

    $(elt).on('click', (e) => {
        console.log('test');
        e.preventDefault();

        let scrollTopValue = targetElement.offset().top;
        if ($(window).width() > breakpointMenuValue) scrollTopValue -= offset;

        $('html, body').animate({
            scrollTop: scrollTopValue
        }, transitionDuration);
    });
}

export default scrollToEltOnClick;
