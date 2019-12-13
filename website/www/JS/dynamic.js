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
    if(toShow.classList.contains("mobile_hidden")){
        toShow.classList.remove("mobile_hidden");
    }else{
        toShow.classList.add("mobile_hidden");
    }
    var element = document.getElementById("login_admin");
    if(element.classList.contains("hidden")){
        element.classList.remove("hidden");
    }else{
        element.classList.add("hidden");
    }

}

