class Menu {

    /**
     * @param menuId test
     * @param hamburgerMenuId
     * @param closeId
     * @param openId
     * @param overlayId
     * @param breakpoint
     */
    constructor(menuId, closeId, openId, overlayId = null) {
        this.menu = $('#' + menuId);
        this.closeBtn = $('#' + closeId);
        this.openBtn = $('#' + openId);
        this.overlay = overlayId === null ? null : $('#' + overlayId);

        this.openBtn.on('click', this.open.bind(this));
        this.closeBtn.on('click', this.close.bind(this));
        if (this.overlay !== null) this.overlay.on('click', this.close.bind(this));
        $('.menu-item').on('click', this.close.bind(this));
    }

    open() {
        $('body').css('overflow', 'hidden');
        this.menu.css('transform', 'translateX(0)');

        if (this.overlay !== null) {
            this.overlay.show(0, () => {
                this.overlay.animate({
                    opacity: 1
                }, 500);
            });
        }
    }

    close() {
        $('body').css('overflow', 'visible');
        this.menu.css('transform', 'translateX(101%)');

        if (this.overlay !== null) {
            this.overlay.animate({
                opacity: 0
            }, 500, () => {
                this.overlay.hide(0);
            });
        }
    }
}

export default Menu;
