function toggleMenu(icon) {
    toggleMobileVisibility(document.getElementById("menu"));
    icon.classList.toggle("change");
}

function toggleMobileVisibility(element) {
    if (element.className === "mobile_hidden") {
        element.classList = "mobile";
    } else {
        element.className = "mobile_hidden";
    }
}

function toggleLogin() {
    var toShow = document.getElementById("admin_login_form");
    if (toShow.classList.contains("mobile_hidden")) {
        toShow.classList.remove("mobile_hidden");
    } else {
        toShow.classList.add("mobile_hidden");
    }
    var element = document.getElementById("login_button_mobile");
    if (element.classList.contains("hidden")) {
        element.classList.remove("hidden");
    } else {
        element.classList.add("hidden");
    }

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
    $("#cercaProdotti").keypress(function(e) {
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
        if (parent.children.length > 4)
            parent.removeChild(parent.children[4]);
        var strong = document.createElement("strong");
        strong.classList.add("input_error_message");
        strong.appendChild(document.createTextNode("Lunghezza del titolo non valida!"));
        parent.appendChild(strong);
        return false;
    } else {
        if (parent.children.length > 4)
            parent.removeChild(parent.children[4]);
    }
    return true;
}

function check_edit_description() {
    var strLength = $("#description").val().trim().length;
    var parent = (document.getElementById("description")).parentNode;
    if (strLength < 20 || strLength > 500) {
        if (parent.children.length > 5)
            parent.removeChild(parent.children[5]);
        var strong = document.createElement("strong");
        strong.classList.add("input_error_message");
        strong.appendChild(document.createTextNode("Lunghezza della descrizione non valida!"));
        parent.appendChild(strong);
        return false;
    } else {
        if (parent.children.length > 5)
            parent.removeChild(parent.children[5]);
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
        if (typeof def == 'undefined')
            def = document.getElementById("preview").src;
        var reader = new FileReader();
        var parent = (document.getElementById("preview")).parentNode;
        if (this.files[0].type.indexOf("image") == -1) {
            if (parent.children.length > 2)
                parent.removeChild(parent.children[2]);
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
            if (parent.children.length > 2)
                parent.removeChild(parent.children[2]);
        }
        if (this.files[0].size > 528385) {
            if (parent.children.length > 2)
                parent.removeChild(parent.children[2]);
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
            if (parent.children.length > 2)
                parent.removeChild(parent.children[2]);
        }
        reader.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
            $("#preview").show();
        };
        reader.readAsDataURL(this.files[0]);
    };
};


function handle_edit_form() {
    $('#edit_form').on('reset', function(e) {
        $("#edit_title_error").text("");
        $("#edit_description_error").text("");
        $("#file_error").text("");
        document.getElementById("preview").src = def;
        $("#preview").show();
    });

    $('#edit_form').submit(function(e) {
        perform_client_edit_check(e);
    });
}

function check_search(e) {
    var strLength = $("#cercaProdotti").val().trim().length;
    var parent = (document.getElementById('cercaProdotti')).parentNode;
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

$(document).ready(function() {
    handle_login_form();
    handle_edit_form();
    handle_search_form();
    search_input_check();
});