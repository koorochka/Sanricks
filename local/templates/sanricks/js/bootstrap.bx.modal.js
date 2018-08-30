// koorochka.bootstrap.bx.modal.js

(function (window) {

    if (!!window.KoorochkaModal)
    {
        return;
    }

    window.KoorochkaModal = function (arParams)
    {
        this.id = "modal";
        this.window = null;
        this.modalDialog = "";
        this.header = null;
        this.body = null;
        this.footer = null;
        this.arParams = null;

        /**
         * Set params
         */
        if (typeof arParams === 'object')
        {
            this.id = arParams.id;
            this.arParams = arParams;

            if(this.arParams.modalDialog !== undefined){
                this.modalDialog = this.arParams.modalDialog;
            }
        }

        /**
         * init
         */
        this.Init();
    };

    window.KoorochkaModal.prototype.Init = function()
    {
        this.onBeforeInit();
        this.window = BX("sanricks");
    };

    window.KoorochkaModal.prototype.onBeforeInit = function()
    {
        BX.addCustomEvent('onKoorochkaModalShow', BX.delegate(this.hide, this));
    };

    window.KoorochkaModal.prototype.setBg = function()
    {
        BX.addClass(this.window, "modal-open");
        BX.append(BX.create('div', {
            props: {
                id: this.id + "-backdrop",
                className: 'modal-backdrop fade show'
            }
        }), this.window);
    };

    window.KoorochkaModal.prototype.setHeader = function(title, cls)
    {

        var close = BX.create('button', {
                props: {
                    id: "modal-close-button",
                    className: "close",
                    type: "button"
                }
            });

        if(title){
            this.header = BX.create('div', {
                props: {
                    className: 'modal-header'
                },
                children: [
                    BX.create('h5',{
                        props: {
                            className: "modal-title " + cls
                        },
                        children: [this.contentType(title)]
                    }),
                    close
                ],
                events: {
                    click: BX.delegate(this.hide, this)
                }
            });
        }else{
            this.header = BX.create('div', {
                props: {
                    className: 'modal-header'
                },
                children: [close],
                events: {
                    click: BX.delegate(this.hide, this)
                }
            });
        }

        setTimeout(function () {
            if(BX.type.isDomNode(BX("modal-close-button"))){
                var iconClose = SVG('modal-close-button').size(23, 23);
                iconClose.line(1.09, 0.5, 22.5, 21.92).addClass("modal-close-line");
                iconClose.line(22.5, 0.5, 0.5, 22.5).addClass("modal-close-line");
            }
        }, 500);


    };

    window.KoorochkaModal.prototype.setBody = function(body)
    {
        if(BX.type.isDomNode(body))
        {
            this.body = BX.create('div', {
                props: {
                    className: 'modal-body'
                },
                children: [body]
            });
        }
        else if(BX.type.isArray(body)){
            this.body = BX.create('div', {
                props: {
                    className: 'modal-body'
                },
                children: body
            });
        }else{
            this.body = BX.create('div', {
                props: {
                    className: 'modal-body'
                },
                text: body
            });
        }
    };

    window.KoorochkaModal.prototype.setFooter = function(buttons, cls)
    {
        if(buttons.length > 0){
            this.footer = BX.create("div", {
                props: {
                    className: "modal-footer " + cls
                },
                children: buttons
            });
        }
    };

    window.KoorochkaModal.prototype.show = function()
    {
        BX.append(BX.create('div', {
            props: {
                id: this.id,
                className: 'modal fade show'
            },
            style: {
                display: 'block'
            },
            children: [BX.create('div', {
                props: {
                    className: 'modal-dialog ' + this.modalDialog
                },
                children: [BX.create('form', {
                    props: {
                        className: 'modal-content'
                    },
                    children: [this.header, this.body, this.footer]
                })]
            })]
        }), this.window);
        this.setBg();
    };

    window.KoorochkaModal.prototype.hide = function()
    {
        BX.remove(BX(this.id));
        BX.remove(BX(this.id + "-backdrop"));
        BX.removeClass(this.window, "modal-open");
    };

    window.KoorochkaModal.prototype.contentType = function(content)
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

    window.KoorochkaModal.prototype.getForm = function()
    {
        return BX.findChildren(BX(this.id), {tagName: 'form'}, true);
    };

})(window);