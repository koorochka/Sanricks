// koorochka.bootstrap.bx.accordion.js

BX.ready(function () {
    /**
     *
     */
    window.accordion = new KoorochkaAccordion({
        id: "accordion"
    });

});

(function (window) {

    if (!!window.KoorochkaAccordion)
    {
        return;
    }

    window.KoorochkaAccordion = function (arParams)
    {
        this.id = "accordion";
        this.card = null;
        this.collapse = null;
        this.arParams = null;

        /**
         * Set params
         */
        if (typeof arParams === 'object')
        {
            this.id = arParams.id;
            this.arParams = arParams;
        }

        /**
         * init
         */
        this.Init();
    };

    window.KoorochkaAccordion.prototype.Init = function()
    {
        //this.buttons = BX.findChildren(BX(this.id),{tagName: 'button'}, true);
        //this.cards = BX.findChildren(BX(this.id),{className: 'collapse'}, true);
    };

    window.KoorochkaAccordion.prototype.show = function(t)
    {
        this.card = BX(t);
        this.collapse = BX.findChildren(this.card,{className: 'collapse'}, true);
        this.collapse = this.collapse[0];

        if(BX.isNodeHidden(this.collapse)){
            BX.addClass(this.card, 'show');
            BX.addClass(this.collapse, 'show');
        }else{
            BX.removeClass(this.card, 'show');
            BX.removeClass(this.collapse, 'show');
        }
    };

    window.KoorochkaAccordion.prototype.contentType = function(content)
    {
        var result = BX.create("div",{
            text: content
        });
        if(BX.type.isDomNode(content))
        {
            result = BX.create('div', {
                children: [content]
            });
        }
        else if(BX.type.isArray(content)){
            result = BX.create('div', {
                children: content
            });
        }
        return result;
    };

})(window);
