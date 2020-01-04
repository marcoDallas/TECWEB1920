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

function toggleLogin(icon) {
    var toShow = document.getElementById("admin_login_form");
    if (toShow.classList.contains("mobile_hidden")) {
        toShow.classList.remove("mobile_hidden");
    } else {
        toShow.classList.add("mobile_hidden");
    }
    var element = document.getElementById("login_admin");
    if (element.classList.contains("hidden")) {
        element.classList.remove("hidden");
    } else {
        element.classList.add("hidden");
    }

}

function input_image() {
    document.getElementById("image").onchange = function() {

        var reader = new FileReader();
        if (this.files[0].size > 528385) {
            alert("Image Size should not be greater than 500Kb");
            $("#preview").attr("src", "blank");
            $("#preview").hide();
            $('#image').wrap('<form>').closest('form').get(0).reset();
            $('#image').unwrap();
            return false;
        }
        if (this.files[0].type.indexOf("image") == -1) {
            alert("Invalid Type");
            $("#preview").attr("src", "blank");
            $("#preview").hide();
            $('#image').wrap('<form>').closest('form').get(0).reset();
            $('#image').unwrap();
            return false;
        }
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            $("#preview").show();
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
};

function print_login_error(e, errorMessage) {
    e.preventDefault();
    $("#login_error_ajax").text(errorMessage);
}

function username_check() {
    var strLength = $("#username").val().trim().length;
    if (strLength < 5 || strLength > 20)
        return "Lunghezza username non valida!";

    var regex = /[a-z_\-0-9]/i;
    if (!regex.test($("#username").val()))
        return "Lo username contiene simboli non consentiti!";
    return "";
}

function password_check() {
    var strLength = $("#password").val().trim().length;
    if (strLength < 5 || strLength > 20)
        return "Lunghezza password non valida!";

    var regex = /[a-z_!?\-0-9]/i;
    if (!regex.test($("#password").val()))
        return "La password contiene simboli non consentiti!";
    return "";
}

function search_input_check() {
    $("#cercaProdotti").keypress(function(e) {
        var value = String.fromCharCode(e.keyCode);
        if (!value.match(/[a-zA-Z ]/i)) {
            return false;
        }
    });
}

function perform_client_login_check(e) {
    var errorMessage = username_check();
    if (errorMessage === "")
        errorMessage = password_check();

    if (errorMessage === "")
        return true;

    print_login_error(e, errorMessage);
    return false;
}

function process_server_login(e) {
    $.ajax({
        type: "POST",
        url: "../php/backend/admin_handler.php",
        data: { Login: "Accedi", username: $("#username").val(), password: $("#password").val() },
        async: false,
        success: function(correct) {
            if (correct != 1) {
                print_login_error(e, correct);
            }
        }
    });
}

function handle_login_form() {
    $('#admin_login_form').submit(function(e) {
        if (perform_client_login_check(e))
            process_server_login(e);
    });
}

function check_edit_title() {
    var strLength = $("#title").val().trim().length;
    if (strLength < 3 || strLength > 40) {
        $("#edit_title_error").text("Lunghezza del titolo non valida!");
        return false;
    }
    return true;
}

function check_edit_description() {
    var strLength = $("#description").val().trim().length;
    if (strLength < 20 || strLength > 500) {
        $("#edit_description_error").text("Lunghezza della descrizione non valida!");
        return false;
    }
    return true;
}

function perform_client_edit_check(e) {
    $("#edit_title_error").text("");
    $("#edit_description_error").text("");
    if (check_edit_title() && check_edit_description())
        return;

    e.preventDefault();
}

function handle_edit_form() {
    $('#edit_form').on('reset', function(e) {
        $("#edit_title_error").text("");
        $("#edit_description_error").text("");
    });

    $('#edit_form').submit(function(e) {
        perform_client_edit_check(e);
    });
}

function check_search(e) {
    $("#search_error").text("");
    var strLength = $("#cercaProdotti").val().trim().length;
    if (strLength > 0 && (strLength < 3 || strLength > 40)) {
        $("#search_error").text("Lunghezza della ricerca non valida!");
        e.preventDefault();
    }
    return true;
}

function handle_search_form() {
    $('#ricerca_prodotti').submit(function(e) {
        check_search(e);
    });
}

$(document).ready(function() {

    if ($("#login_error").length != 0) {

        $("#header").addClass("shift_down");
        $("#breadcrumb").addClass("shift_down");
        $("#general_container").addClass("shift_down");
        $("#footer").addClass("shift_down");
    }

    handle_login_form();
    handle_edit_form();
    handle_search_form();
    search_input_check();
});

function close_error() {
    $('#login_error').addClass('hide');
    $('#login_error').removeAttr('id');
    $("#header").removeClass("shift_down");
    $("#breadcrumb").removeClass("shift_down");
    $("#general_container").removeClass("shift_down");
    $("#footer").removeClass("shift_down");
}