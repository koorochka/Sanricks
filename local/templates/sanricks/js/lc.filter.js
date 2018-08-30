
var lcFilter = {
    menu: "lc-filter",
    isActiveTabs: true,

    toggle: function (button) {
        if(BX.hasClass(BX(this.menu), "d-none")){
            BX.removeClass(BX(this.menu), "d-none");
        }else{
            BX.addClass(BX(this.menu), "d-none");
        }
        this.lightOutAllTabs(button);
    },
    lightOutAllTabs: function (button) {

        if(this.isActiveTabs){
            var items,
                i;
            items = BX.findChildren(BX("lc-tabs"),{className: 'nav-link'}, true);
            if(!!items && items.length > 0){
                for(i=0; i< items.length; i++){
                    BX.removeClass(items[i], "active");
                }
            }

            this.isActiveTabs = false;
        }

        this.activateFilterButton(button)
    },
    activateFilterButton: function (button) {
        BX.addClass(button, "active");
    }
};

