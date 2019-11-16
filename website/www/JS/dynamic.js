function toggleMenu(icon) {
    toggleMobileVisibility(document.getElementById("menu"));
    toggleMobileVisibility(document.getElementById("login"));
    icon.classList.toggle("change");
}

function toggleMobileVisibility(element) {
    if (element.className === "mobile_hidden") {
        element.className = "mobile";
    } else {
        element.className = "mobile_hidden";
    }
}
