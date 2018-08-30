

var sanriksClient = {
    url: "/local/ajax/client.php",
    modal: null,
    form: null,

    add: function () {
        this.modal = new KoorochkaModal({
            id: "order-modal"
        });

        // Header
        this.modal.setHeader("", false);

        // Body
        this.form = BX.create("form", {
            props: {
                className: "text-center",
                method: "post",
                action: "/local/ajax/client.php"
            },
            events: {
                submit: BX.delegate(this.ajax, this)
            },
            children: [
                BX.create("h1", {
                    text: "Добавить клиента"
                }),
                BX.create("div", {
                    text: "Добавьте пользователя и вы сможете видеть и подтверждать его заказы"
                }),
                BX.create("input", {
                    props: {
                        type: "hidden",
                        name: "add_clint",
                        value: "Y"
                    }
                }),
                BX.create("input", {
                    props: {
                        type: "hidden",
                        name: "sessid",
                        value: BX.bitrix_sessid()
                    }
                }),
                BX.create("div", {
                    props: {
                        id: "clients-alert-place"
                    }
                }),
                BX.create("div", {
                    props: {
                        className: "m-5 row align-items-center"
                    },
                    children: [
                        BX.create("div", {
                            props: {
                                className: "col-6"
                            },
                            children: [
                                BX.create("input", {
                                    props: {
                                        className: "form-control mb-3",
                                        placeholder: "Имя",
                                        name: "name",
                                        type: "text"
                                    }
                                }),
                                BX.create("input", {
                                    props: {
                                        className: "form-control",
                                        placeholder: "E-mail",
                                        name: "email",
                                        type: "text"
                                    }
                                })
                            ]
                        }),
                        BX.create("div", {
                            props: {
                                className: "col-6"
                            },
                            children: [
                                BX.create("input", {
                                    props: {
                                        className: "btn btn-danger",
                                        value: "Добавить",
                                        name: "action",
                                        type: "submit"
                                    }
                                })
                            ]
                        })
                    ]
                })

            ]
        });
        this.modal.setBody([this.form]);

        // Show
        this.modal.show();
        return false;
    },

    // ajax
    ajax: function(e){
        BX.PreventDefault(e);
        BX.ajax.post(
            this.url,
            this.getFormData(),
            BX.delegate(this.responce, this)
        );
        return false;
    },
    getFormData: function(){
        this.prepareFormData();
        return this.formData;
    },
    prepareFormData: function(){
        this.formData = BX.ajax.prepareForm(BX(this.form)).data;
    },
    responce: function (result) {
        if(result == "good"){
            location.reload();
        }else{
            BX.html(BX("clients-alert-place"), result);
        }
    },

    delete: function() {
        this.modal = new KoorochkaModal({
            id: "order-modal"
        });

        // Header
        this.modal.setHeader("Ошибки оформления заказа", false);

        // Body

        var clients = [
            BX.create("h1", {
                text: "Удалить клиента"
            })
        ];

        clients.push(BX.create("input", {
            props: {
                type: "text",
                name: "CANCEL",
                value: "Y"
            }
        }));


        this.modal.setBody([
            BX.create("div", {
                props: {
                    className: "text-center",
                },
                children: clients
            })
        ]);

        // Show
        this.modal.show();
        return false;
    }
};
