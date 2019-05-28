/**
 * transform a transparent menu in a menu with a background color when the user scroll
 * @param menuId the id of the target menu
 * @param textColor the applied color when the user scroll at the top value
 * @param bgColor the applied background-color when the user scroll at the top value
 * @param scrollTop the top (position) value where the transition will applied
 */
function changeMenuOnScroll(menuId, textColor, bgColor, scrollTop = 0) {
    let menu = $('#' + menuId);
    let baseColorMenu = menu.css('color');
    let baseBackgroundColorMenu = menu.css('background-color');
    let status = 0;

    const checkScroll = () => {
        if (window.scrollY > scrollTop && status === 0) {
            // if the scroll is greater than the scrollTop value
            status = 1;
            menu.css('background-color', bgColor);
            menu.css('color', textColor);
        } else if (window.scrollY <= scrollTop && status === 1) {
            // if the scroll is less than the scrollTop value
            status = 0;
            menu.css('background-color', baseBackgroundColorMenu);
            menu.css('color', baseColorMenu);
        }
    }

    checkScroll();
    $(window).on('scroll', checkScroll);
}

export default changeMenuOnScroll;
