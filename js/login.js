$(document).ready(function () {
    $('#signup-tab').css('display', 'none');
});

function openTab(tab) {
    if(tab == "signup-tab")
    {
        $('#signupLink').addClass('active');
        $('#loginLink').removeClass('active');
        $('#loginLink').addClass('inactive');
        $('#signupLink').removeClass('inactive');

        $('#signup-tab').css('display', 'block');
        $('#login-tab').css('display', 'none');

    }
    if (tab == "login-tab") {
        $('#loginLink').addClass('active');
        $('#signupLink').removeClass('active');
        $('#signupLink').addClass('inactive');
        $('#loginLink').removeClass('inactive');

        $('#signup-tab').css('display', 'none');
        $('#login-tab').css('display', 'block');
        
    }
}

function markInValid(id, error) {
    $(id).text(error);
}

function markValid(id) {
    $(id).empty();
}

function isEmailValid(label, id) {
    var atpos = ($(id).val()).indexOf("@");
    var dotpos = ($(id).val()).lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= ($(id).val()).length) {
        markInValid(label, "Please format as follow: someone@example.com");
        return false;
    }
    else {
        markValid(label);
        return true;
    }
}

function isPassValid(label, id)
{
    var text = $(id).val();
    if (text.length < 6)
        markInValid(label, "Please type your password");
    else
        markValid(label);
    return text.length > 6;
}

// Checks whether the form is valid
function fullValidation(form) {
    var isValid = true;
    if (form == "signup") {
        $("#signupBtn").disabled = true;
        if (!isEmailValid("#signupLbl", "#semail"))
            return false;
        if (!isPassValid("#signupLbl", "#spassword"))
            return false;
        if (!isPassValid("#signupLbl", "#srpassword"))
            return false;
        $("#signupBtn").disabled = false;
    }
    if (form == "login")
    {
        $("#loginBtn").disabled = true;
        if (!isEmailValid("#loginLbl", "#email"))
            return false;

        if (!isPassValid("#password")) {
            return false;
        }

        $("#loginBtn").disabled = false;
    }
    return true; //isValid;
}