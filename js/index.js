"use strict";

function loadController(name) {
    return new Controller(`${name}s`, `${name}s-view`, `app/view/${name}.html`, `api/${name}s`);
}

let user = new User();
let selectedCategory = 1;

// controller initialisation
const menu = loadController("menu");
const category = loadController("category");
const login = new Controller(`login`, `login-view`, `app/view/login.html`);
const addMenu = new Controller(`addMenu`, `menus-view`, `app/view/addMenu.html`);
const editMenu = new Controller(`editMenu`, `edit-menu-view`, `app/view/editMenu.html`)

function loadMenus() {
    return new Promise((resolve, reject) => {
        menu.clean();
    
        menu.load().then(() => {
            $(".type-Menus").css("display", "block");
            $(".tab-Menus").addClass("tab-entity-active");

            $(".delete-menu").click(function() {
                $.ajax({
                    url: `api/menu/${$(this).attr("menu-id")}`,
                    method: "DELETE",
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader("username", user.username);
                        xhr.setRequestHeader("token", user.token);
                    },
                    complete: () => {
                        $(this).parent(".card").parent(".menu-element").remove();
                    }
                });
            });

            $(".edit-menu").click(function() {
                loadEditMenu($(this).attr("menu-id"));
            });
        
            loadAddMenu().then(resolve);
        });
    });
}

function loadCategory() {
    return new Promise((resolve, reject) => {
        category.load().then(() => {
            $(".tab-entity").click(function() {
                const className = $(this).first().text();
                selectedCategory = $(this).attr("categ-id");
    
                $(".menu-element").css("display", "none");
                $(".tab-entity-active").removeClass("tab-entity-active");
    
                $(`.type-${className}`).css("display", "block");
                $(this).addClass("tab-entity-active");
            });
    
            loadMenus().then(resolve);
        });
    });
}

function loadLogin() {
    return new Promise((resolve, reject) => {
        login.load().then(() => {
            $("#show-login").click(() => {
                $("#login-view").show();
            });
    
            $("#hide-login").click(() => {
                $("#login-view").hide();
            });
    
            $("#submit-login-form").click(() => {
                const username = $("#username-form").val();
                $.ajax({
                    url: "api/login",
                    method: "GET",
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader("username", username);
                        xhr.setRequestHeader("password", $("#password-form").val());
                    },
                    success: (response) => {
                        user.init(username, response.token);
                        if ($("#remember-login-form").is(':checked')) {
                            user.save();
                        }

                        loginAction();
                    },
                    error: (xhr) => {
                        $("#login-error").html(xhr.responseJSON.error);
                        setTimeout(() => {$("#login-error").html("")}, 3000);
                    }
                });
            });
    
            $("#logout-button").click(() => {
                logoutAction();
            });

            resolve();
        });
    });
}

function loadAddMenu() {
    return new Promise((resolve, reject) => {
        addMenu.load().then(() => {
            $("#add-new-menu").click(() => {
                $.ajax({
                    url: `api/menu/${selectedCategory}`,
                    method: "POST",
                    beforeSend: (xhr) => {
                        xhr.setRequestHeader("username", user.username);
                        xhr.setRequestHeader("token", user.token);
                    },
                    complete: () => {
                        loadMenus().then(() => {
                            $(".admin-element").show();
                        });
                    }
                });
            });

            resolve();
        });
    });
}

function loadEditMenu(idMenu) {
    return new Promise((resolve, reject) => {
        editMenu.clean();

        $.ajax({
            url: `api/menu/${idMenu}`,
            method: "GET",
            beforeSend: (xhr) => {
                xhr.setRequestHeader("username", user.username);
                xhr.setRequestHeader("token", user.token);
            },
            complete: (response) => {
                editMenu.model = [{
                    id: idMenu,
                    name: response.responseJSON.name,
                    description: response.responseJSON.description,
                    prix: response.responseJSON.prix,
                    picture: response.responseJSON.picture,
                    category_id: response.responseJSON.category_id
                }];
        
                $("#edit-menu-view").show();
        
                editMenu.load().then(() => {
                    $("#hide-edit-menu").click(() => {
                        $("#edit-menu-view").hide();
                        editMenu.clean();
                    });

                    $.get("api/categories", (responseCateg) => {
                        responseCateg.categories.forEach((categ) => {
                            $("#category-id-menu-form").append(`<option value="${categ.id}" ${categ.id == response.responseJSON.category_id ? "selected" : ""}>${categ.name}</option>`);
                        });
                    });

                    $("#picture-menu-form").change(() => {
                        let formData = new FormData();
                        formData.append('file', $("#picture-menu-form")[0].files[0]);

                        $.ajax({
                            url : 'api/upload/',
                            type : 'POST',
                            data : formData,
                            processData: false,
                            contentType: false,
                            success : (data) => {
                                $("#picture-menu-form").attr("filename", data.fileName);
                            }
                        });
                    });

                    $("#submit-menu-form").click(function() {
                        $.ajax({
                            url: `api/menu/${idMenu}`,
                            method: "PUT",
                            beforeSend: (xhr) => {
                                xhr.setRequestHeader("username", user.username);
                                xhr.setRequestHeader("token", user.token);
                            },
                            data: JSON.stringify({
                                name: $("#name-menu-form").val(),
                                description: $("#description-menu-form").val(),
                                prix: $("#prix-menu-form").val(),
                                picture: $("#picture-menu-form").attr("filename"),
                                category_id: $("#category-id-menu-form").val()
                            }),
                            contentType: "application/json; charset=utf-8",
                            dataType   : "json",
                            complete: () => {
                                loadMenus().then(() => {
                                    $(".admin-element").show();
                                });
                                
                                $("#edit-menu-view").hide();
                                editMenu.clean();
                            }
                        });
                    });

                    resolve();
                });
            }
        });
    });
}


// Login and Logout
function loginAction() {
    $("#login-view").hide();
    $("#show-login").hide();
    $("#logout-button").show();
    $(".admin-element").show();
}
function logoutAction() {
    $("#show-login").show();
    $("#logout-button").hide();
    $(".admin-element").hide();
    user.disconnect();
}

$(function() {
    loadCategory().then(() => {
        loadLogin().then(() => {
            if (user.isSet()) {
                loginAction();
            }
        });
    });
});