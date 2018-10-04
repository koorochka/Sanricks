/**
 * powered by Artem Koorochka 2018
 * Filter managers by filial
 * @type {{filial: string, manager: string, shooseFilial: managersByFilial.shooseFilial, showAllManagers: managersByFilial.showAllManagers, filterManagers: managersByFilial.filterManagers}}
 */
var managersByFilial = {

    filial: "UF_FILIAL",
    manager: "UF_MANAGER",

    /**
     * Ivent method
     * @param filial
     */
    shooseFilial: function(filial){
        var options = BX.findChildren(BX(this.manager), {'tagName': "option"}, false);
        this.showAllManagers(options);
        this.filterManagers(options, filial);
    },

    /**
     * Method for show all managers
     * @param options
     */
    showAllManagers: function (options) {
        var i;
        for(i = 0; i < options.length; i++){
            BX.removeClass(options[i], "d-none");
        }
    },

    /**
     * Method for filter managers
     * @param options
     * @param filial
     */
    filterManagers: function (options, filial) {
        var i;
        if(filial > 0)
        {
            for(i = 0; i < options.length; i++){
                if(BX(options[i]).getAttribute('data-filial') !== filial)
                {
                    BX.addClass(options[i], "d-none");
                }
            }
        }
    }

};