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


function input_image(){
    document.getElementById("image").onchange = function () {
        
        var reader = new FileReader();
        if(this.files[0].size>528385){
            alert("Image Size should not be greater than 500Kb");
            $("#preview").attr("src","blank");
            $("#preview").hide();  
            $('#image').wrap('<form>').closest('form').get(0).reset();
            $('#image').unwrap();     
            return false;
        }
        if(this.files[0].type.indexOf("image")==-1){
            alert("Invalid Type");
            $("#preview").attr("src","blank");
            $("#preview").hide();  
            $('#image').wrap('<form>').closest('form').get(0).reset();
            $('#image').unwrap();         
            return false;
        }   
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            $("#preview").show(); 
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
};

$(document).ready(function(){

    if($("#login_error").length != 0){

        $("#header").addClass("shift_down");
        $("#breadcrumb").addClass("shift_down");
        $("#general_container").addClass("shift_down");
        $("#footer").addClass("shift_down");
    }
});


function close_error(){
    $('#login_error').addClass('hide');
    $('#login_error').removeAttr('id');
    $("#header").removeClass("shift_down");
    $("#breadcrumb").removeClass("shift_down");
    $("#general_container").removeClass("shift_down");
    $("#footer").removeClass("shift_down");
}