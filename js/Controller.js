"use strict";

class Controller {
    constructor(name, baliseId, view, model = null) {
        this.name = name;
        this.baliseId = baliseId;
        this.view = view;
        this.model = model;
    }

    _loadViewAndApiModel() {
        return new Promise((resolve, reject) => {
            $.get(this.model, (_model) => {
                const model = _model[this.name];
                    $.get(this.view, (_view) => {
                        model.forEach(instance => {
                            let view = _view;
                            Object.keys(instance).forEach(key => {
                                const matcher = new RegExp(`{{[ ]?${key}[ ]?}}`, "g");
                                if($.isArray(instance[key])) {
                                    view = view
                                        .replace(matcher, instance[key]
                                            .map(element => `<li>${element}</li>`)
                                            .join(""));
                                } else {
                                    view = view.replace(matcher, instance[key]);
                                }
                            });
                            $(`#${this.baliseId}`).append(view);
                            resolve();
                        });
                    }).fail(reject);
            }).fail(reject);
        });
    }

    _loadViewAndModel() {
        return new Promise((resolve, reject) => {
            $.get(this.view, (_view) => {
                this.model.forEach(instance => {
                    let view = _view;
                    Object.keys(instance).forEach(key => {
                        const matcher = new RegExp(`{{[ ]?${key}[ ]?}}`, "g");
                        if($.isArray(instance[key])) {
                            view = view
                                .replace(matcher, instance[key]
                                    .map(element => `<li>${element}</li>`)
                                    .join(""));
                        } else {
                            view = view.replace(matcher, instance[key]);
                        }
                    });
                    $(`#${this.baliseId}`).append(view);
                    resolve();
                });
            }).fail(reject);
        });
    }

    _loadView() {
        return new Promise((resolve, reject) => {
            $.get(this.view, (view) => {
                $(`#${this.baliseId}`).append(view);
                resolve();
            }).fail(reject);
        });
    }

    load() {
        if (!this.model) {
            return this._loadView();
        } else if (typeof this.model === "string") {
            return this._loadViewAndApiModel();
        } else if (typeof this.model === "object") {
            return this._loadViewAndModel();
        }
    }

    clean() {
        $(`#${this.baliseId}`).html("");
    }
}