/**
 * Top menu toggle
 * @type {{button: string, menu: string, catalog: string, wait: null, dialog: null, items: Array, catalogItems: Array, setHeader: topMenu.setHeader, setBody: topMenu.setBody, show: topMenu.show}}
 */
var topMenu = {
    button: "top-menu-button",
    menu: "top-menu",
    catalog: "footer-menu",
    wait: null,
    dialog: null,
    items:[],
    catalogItems:[],

    setHeader: function () {
        this.dialog.setHeader(false, false);
    },
    setBody: function () {
        var body = BX.create("div");

        // set adres
        body.appendChild(BX.create("div",{
                props:{
                    className: "m-3 margin-top-0"
                },
                html:BX.html(BX("region-adres"))
            }
        ));

        // set worktime
        body.appendChild(BX.create("div",{
                props:{
                    className: "m-3"
                },
                html:BX.html(BX("region-worktime"))
            }
        ));

        // set top menu
        if(this.items.length <= 0){
            // get data for menu
            this.items = BX.findChildren(BX(this.menu),{className: 'top-menu-item'}, true);
        }

        if(this.items.length > 0){
            // create title
            body.appendChild(BX.create("h1",{
                    props:{
                        className: "m-3"
                    },
                    text:"Меню"
                }
            ));

            // create list
            var list = BX.create("ul", {
                props: {
                    className: "list-group list-group-flush"
                }
            });

            // add items to list
            for(var i = 0; i < this.items.length; i++){

                this.items[i].removeAttribute("class");
                list.appendChild(BX.create("li",{
                    props: {
                        className: "list-group-item"
                    },
                    children: [this.items[i]]
                }));
            }
            // add list to panel body
            body.appendChild(list);
        }

        // set personal links
        body.appendChild(BX.create("a",{
            props: {
                className: "h1 d-block m-3",
                href: "/lc/"
            },
            text: "Личный кабинет"
        }));

        list = BX.create("ul", {
            props: {
                className: "list-group list-group-flush"
            }
        });
        list.appendChild(BX.create("li",{
            props: {
                className: "list-group-item"
            },
            children: [BX.create("a",{
                props: {
                    href: "#"
                },
                events: {
                    click: BX.delegate(function () {
                        BX("auth-window-link").click();
                    }, this)
                },
                text: "Войти"
            })]
        }));
        list.appendChild(BX.create("li",{
            props: {
                className: "list-group-item"
            },
            children: [BX.create("a",{
                props: {
                    href: "#"
                },
                events: {
                    click: BX.delegate(function (e) {
                        var target = e.target || e.srcElement;
                        registerWindow.show(target);
                    }, this)
                },
                text: "Зарегистрироваться"
            })]
        }));
        // add list to panel body
        body.appendChild(list);

        // set catalog menu
        if(this.catalogItems.length <= 0){
            // get data for menu
            this.catalogItems = BX.findChildren(BX(this.catalog),{tagName: 'li'}, true);
        }
        if(this.catalogItems.length > 0){
            // create title
            body.appendChild(BX.create("h1",{
                props: {
                    className: "h1 d-block m-3",
                    href: "/lc/"
                },
                text: "Каталог"
            }));

            // formating catalog items
            for(i = 0; i < this.catalogItems.length; i++){
                BX.addClass(this.catalogItems[i], 'list-group-item');
            }
            // create list
            list = BX.create("ul", {
                props: {
                    className: "list-group list-group-flush"
                },
                children: this.catalogItems
            });
            // add list to panel body
            body.appendChild(list);
        }

        // set content to panel body
        this.dialog.setBody(body);
    },
    show: function () {
        // call all events modal open
        BX.onCustomEvent('onKoorochkaModalShow', []);

        this.wait = BX.showWait();

        this.dialog = new KoorochkaModal({
            id: "register-modal",
            modalDialog: "modal-panel"
        });

        this.setHeader();
        this.setBody();


        BX.closeWait(null, this.wait);
        this.dialog.show();

    }
};

/**
 * Auth object
 * @type {{url: string, wait: null, dialog: null, title: null, show: authWindow.show, setHeader: authWindow.setHeader, setBody: authWindow.setBody, setFooter: authWindow.setFooter}}
 */
var authWindow = {
    id: "form-window",
    url: "/local/ajax/login.php",
    wait: null,
    dialog: null,
    title: null,

    show: function (t) {

        // call all events modal open
        BX.onCustomEvent('onKoorochkaModalShow', []);

        this.wait = BX.showWait();
        this.title = t.title;

        this.dialog = new KoorochkaModal({
            id: "auth-modal"
        });

        this.setHeader();
        this.setBody();
        this.setFooter(t);

        setTimeout(function () {
            BX.closeWait(null, authWindow.wait);
            authWindow.dialog.show();
        }, 300);

        return false;
    },
    setHeader: function () {
        this.dialog.setHeader(this.title, false);
    },
    setBody: function () {
        this.dialog.setBody([
            BX.create("div", {
                props: {
                    className: "form-group alert-warning p-4"
                },
                children: [
                    BX.create("label", {
                        text: "ЛОГИН"
                    }),
                    BX.create("input", {
                        props:{
                            type: "text",
                            name: "EMAIL",
                            className: "form-control",
                            placeholder: "E-mail"
                        }
                    }),
                    BX.create("small", {
                        props: {
                            className: "form-text text-muted",
                            text: "Неверный формат"
                        }
                    }),
                    BX.create("div", {
                        text: "или",
                        props: {
                            className: "text-center"
                        }
                    }),
                    BX.create("input", {
                        attrs: {
                            onkeyup: 'inputPhoneModificator(this, event)'
                        },
                        props:{
                            type: "text",
                            name: "TEL",
                            className: "form-control",
                            placeholder: "Телефон (812) 336-75-85"
                        }
                    })

                ]
            }),
            BX.create("div", {
                props: {
                    className: "form-group alert-warning p-4"
                },
                children: [
                    BX.create("label", {
                        text: "ПАРОЛЬ"
                    }),
                    BX.create("input", {
                        props:{
                            type: "password",
                            name: "PASS",
                            className: "form-control",
                            placeholder: "Пароль"
                        }
                    })
                ]
            }),
            BX.create("div", {
                props: {
                    className: "form-group text-center"
                },
                children: [
                    BX.create("div", {
                        props: {
                            className: "form-check d-inline-block p-3"
                        },
                        children:[
                            BX.create("label", {
                                props: {
                                    className: "checkbox"
                                },
                                children:[
                                    BX.create("input", {
                                        props: {
                                            type: "checkbox",
                                            checked: "checked",
                                            name: "REM",
                                            id: "REM",
                                            value: "1"
                                        }
                                    }),
                                    BX.create("span")
                                ]
                            }),
                            BX.create("label", {
                                attrs:{
                                    className: "form-check-label",
                                    for: "REM"
                                },
                                text: "Запомнить"
                            })
                        ]
                    }),
                    BX.create("a", {
                        props:{
                            href: "/lc/?forgot_password=yes",
                            className: "text-underline p-3"
                        },
                        text: "Восстановить пароль?"
                    })
                ]
            })
        ]);
    },
    setFooter: function (t) {
        this.dialog.setFooter([
            BX.create("button",{
                props: {
                    className: "btn btn-danger",
                    type: "button"
                },
                events: {
                    click: BX.delegate(this.submit, this)
                },
                text: BX(t).getAttribute('data-login')
            }),
            BX.create("button",{
                props: {
                    className: "btn btn-default",
                    type: "button"
                },
                events: {

                    click: BX.delegate(function (e) {
                        var target = e.target || e.srcElement;
                        registerWindow.show(target);
                    }, this)
                },
                text: BX(t).getAttribute('data-register')
            })
        ], false);
    },
    submit: function () {
        var form = this.dialog.getForm();
        form = form[0];

        BX.ajax.post(
            this.url,
            BX.ajax.prepareForm(form).data,
            BX.delegate(this.responce, this)
        );

    },
    responce: function (data) {
        if (data == "Y") {
            location.href = "/lc/";
        } else {
            BX.remove(BX(this.id + "-alert"));
            BX.prepend(BX.create("div",{
                props: {
                    id: this.id + "-alert",
                    className: "alert alert-danger"
                },
                html: data
            }), this.dialog.body);

        }
    }

};

/**
 * Register object
 * @type {{url: string, wait: null, dialog: null, title: null, show: registerWindow.show, setHeader: registerWindow.setHeader, setBody: registerWindow.setBody, setFooter: registerWindow.setFooter}}
 */
var registerWindow = {
    url: "/local/ajax/register.entity.php",
    wait: null,
    dialog: null,
    title: null,
    type: "entity",
    form: null,

    show: function (t) {
        // call all events modal open
        BX.onCustomEvent('onKoorochkaModalShow', []);

        this.wait = BX.showWait();
        this.title = t.title;

        this.dialog = new KoorochkaModal({
            id: "register-modal",
            modalDialog: "modal-lg"
        });

        if (BX(t).hasAttribute('data-type'))
        {
            if(BX(t).getAttribute('data-type') == "individual"){
                this.url = "/local/ajax/register.individual.php";
                this.type = "individual";
            }else{
                this.url = "/local/ajax/register.entity.php";
                this.type = "entity";
            }
        }

        this.setHeader();
        this.setBody();
        this.setFooter(t);

        setTimeout(function () {
            BX.closeWait(null, registerWindow.wait);
            registerWindow.dialog.show();
        }, 300);

    },
    setHeader: function () {
        var tabs = BX.create("ul", {
            props: {
                className: "nav nav-tabs block-width"
            },
            children: [
                BX.create("li", {
                    props: {
                        className: "nav-item"
                    },
                    children: [
                        BX.create("a", {
                            props: {
                                className: (this.type == "entity" ? "nav-link active" : "nav-link"),
                                href: "#"
                            },
                            events: {
                                click: BX.delegate(function (e) {
                                    var target = e.target || e.srcElement;
                                    this.show(target);
                                }, this)
                            },
                            dataset: {
                                type: "entity"
                            },
                            text: "Юридическое лицо"
                        })
                    ]
                }),
                BX.create("li", {
                    props: {
                        className: "nav-item"
                    },
                    children: [
                        BX.create("a", {
                            props: {
                                className: (this.type == "entity" ? "nav-link" : "nav-link active"),
                                href: "#"
                            },
                            events: {
                                click: BX.delegate(function (e) {
                                    var target = e.target || e.srcElement;
                                    this.show(target);
                                }, this)
                            },
                            dataset: {
                                type: "individual"
                            },
                            text: "Физическое лицо"
                        })
                    ]
                })
            ]
        });
        this.dialog.setHeader(tabs, "block-width");
    },
    setBody: function () {
        this.dialog.setBody(null);
        BX.ajax.insertToNode(this.url, this.dialog.body);
    },
    setFooter: function (t) {
        this.dialog.setFooter([
            BX.create("button",{
                props: {
                    className: "btn btn-danger",
                    type: "button"
                },
                events: {
                    click: BX.delegate(this.submit, this)
                },
                text: (this.type == "entity" ? "Отправить на модерацию" : "Зарегистрироваться")
            })
        ], false);
    },

    submit: function () {
        this.form = this.dialog.getForm();
        this.form = this.form[0];
        // validate and wait
        BX.addClass(this.form, "needs-validation was-validated");
        this.wait = BX.showWait(this.form, "Попытка авторизации");

        BX.ajax.post(
            this.url,
            BX.ajax.prepareForm(this.form).data,
            BX.delegate(this.responce, this)
        );
        return false;
    },
    responce: function (data) {
        BX.html(this.dialog.body, data);

        BX.closeWait(this.wait);
    }
};

