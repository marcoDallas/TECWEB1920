function toggleMenu() {
    toggleMobileVisibility();
    $("#menu_icon").toggleClass("change");
}

function toggleMobileVisibility() {
    $("#menu").toggleClass("mobile_hidden");
    $("#menu").toggleClass("mobile");
}

function toggleLogin() {
    $("#admin_login_form").toggleClass("mobile_hidden");
    $("#login_button_mobile").toggleClass("hidden");
}

function delete_error_login(input) {
    var p = input.parentNode.parentNode;
    if (p.children.length > 5) {
        p.removeChild(p.children[1]);
    }
}

function add_error_login(input, error) {
    delete_error_login(input);
    var p = input.parentNode.parentNode;
    var strong = document.createElement("strong");
    strong.appendChild(document.createTextNode(error));
    p.insertBefore(strong, p.children[1]);
}

function username_check() {
    var input = document.getElementById('username');
    var strLength = $("#username").val().trim().length;
    var regex = /[a-z_\-0-9]/i;
    if (strLength < 5 || strLength > 20 || !regex.test($("#username").val())) {
        return false;
    } else {
        delete_error_login(input);
        return true;
    }
}

function password_check() {
    var input = document.getElementById('password');
    var strLength = $("#password").val().trim().length;
    var regex = /[a-z_!?\-0-9]/i;
    if (strLength < 5 || strLength > 20 || !regex.test($("#password").val())) {
        return false;
    } else {
        delete_error_login(input);
        return true;
    }
}

function search_input_check() {
    $("#cerca_prodotti").keypress(function(e) {
        var value = String.fromCharCode(e.keyCode);
        if (!value.match(/[a-zA-Z ]/i)) {
            return false;
        }
    });
}

function print_login_error(e) {
    e.preventDefault();
    add_error_login(document.getElementById('username'), "Credenziali errate!");
}

function perform_client_login_check(e) {
    var username = username_check();
    var password = password_check();
    if (!(username && password)) {
        print_login_error(e);
        return false;
    } else
        return true;
}

function process_server_login(e) {
    $.ajax({
        type: "POST",
        url: "../php/backend/admin_handler.php",
        data: { Login: "Accedi", username: $("#username").val(), password: $("#password").val() },
        async: false,
        success: function(correct) {
            if (correct != 1) {
                print_login_error(e);
            }
        }
    });
}

function handle_login_form() {
    $('#admin_login_form').submit(function(e) {
        if (perform_client_login_check(e))
            process_server_login(e);
        else
            e.preventDefault();
    });
}

function check_edit_title() {
    var strLength = $("#title").val().trim().length;
    var parent = (document.getElementById("title")).parentNode;
    if (strLength < 3 || strLength > 40) {
        $('#title').parent().find('.input_error_message').remove();
        var strong = document.createElement("strong");
        strong.classList.add("input_error_message");
        strong.appendChild(document.createTextNode("Lunghezza del titolo non valida!"));
        parent.appendChild(strong);
        return false;
    } else {
        $('#title').parent().find('.input_error_message').remove();
    }
    return true;
}

function check_edit_description() {
    var strLength = $("#description").val().trim().length;
    var parent = (document.getElementById("description")).parentNode;
    if (strLength < 20 || strLength > 500) {
        $('#description').parent().find('.input_error_message').remove();
        var strong = document.createElement("strong");
        strong.classList.add("input_error_message");
        strong.appendChild(document.createTextNode("Lunghezza della descrizione non valida!"));
        parent.appendChild(strong);
        return false;
    } else {
        $('#description').parent().find('.input_error_message').remove();
    }
    return true;
}

function perform_client_edit_check(e) {
    var title = check_edit_title();
    var description = check_edit_description();
    if (title && description)
        return;
    e.preventDefault();
}

function input_image() {
    document.getElementById("image").onchange = function() {
        var reader = new FileReader();
        var parent = (document.getElementById("preview")).parentNode;
        if (this.files[0].type.indexOf("image") == -1) {
            $('#preview').parent().find('.input_error_message').remove();
            var strong = document.createElement("strong");
            strong.classList.add("input_error_message");
            strong.appendChild(document.createTextNode("Estensione invalida!"));
            parent.appendChild(strong);
            $("#preview").attr("src", "blank");
            $("#preview").hide();
            $('#image').wrap('<form>').closest('form').get(0).reset();
            $('#image').unwrap();
            return false;
        } else {
            $('#preview').parent().find('.input_error_message').remove();
        }
        if (this.files[0].size > 528385) {
            $('#preview').parent().find('.input_error_message').remove();
            var strong = document.createElement("strong");
            strong.classList.add("input_error_message");
            strong.appendChild(document.createTextNode("L'immagine non può essere più grande di 500kb"));
            parent.appendChild(strong);
            $("#preview").attr("src", "blank");
            $("#preview").hide();
            $('#image').wrap('<form>').closest('form').get(0).reset();
            $('#image').unwrap();
            return false;
        } else {
            $('#preview').parent().find('.input_error_message').remove();
        }
        reader.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
            $("#preview").show();
        };
        reader.readAsDataURL(this.files[0]);
    };
};


function handle_edit_form() {

    if (page_name() == "modifica_prodotto.php" && typeof def == 'undefined')
        def = document.getElementById("preview").src;
    $('#edit_form').on('reset', function(e) {
        if (page_name() == "modifica_prodotto.php") {
            document.getElementById("preview").src = def;
            $("#preview").show();
        }
        $(".input_error_message").remove();
    });
    $('#edit_form').submit(function(e) {
        perform_client_edit_check(e);
    });
}

function check_search(e) {
    var strLength = $("#cerca_prodotti").val().trim().length;
    var parent = (document.getElementById('cerca_prodotti')).parentNode;
    if (strLength > 40) {
        if (parent.children.length > 4)
            parent.removeChild(parent.children[4]);
        var strong = document.createElement("strong");
        strong.classList.add("input_error_message");
        strong.appendChild(document.createTextNode("Lunghezza della ricerca non valida!"));
        parent.appendChild(strong);

        e.preventDefault();
    } else {
        if (parent.children.length > 4)
            parent.removeChild(parent.children[4]);
    }
    return true;
}

function handle_search_form() {
    $('#ricerca_prodotti').submit(function(e) {
        check_search(e);
    });
}

function page_name() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    return page;
}


$(document).ready(function() {
    handle_login_form();
    handle_edit_form();
    handle_search_form();
    search_input_check();
});