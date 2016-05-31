$(document).ready(function () {
    $('#signup-tab').css('display', 'none');
});

function addNewWard()
{
  if ($("#ward_name option:selected").text() == "Add New Ward")
  {
    $('#ward').css('display', 'initial');
    $("#ward").val("");
    $('#ward').focus();
  }
  else {
    $('#ward').css('display', 'none');
    markValid(SIGNUP);
    //alert($("#ward_name option:selected").text());
    //alert($("#ward_name").val());
    $("#ward").val($("#ward_name option:selected").text());
  }
}
// global lables
var SIGNUP = "#signupLbl";
var LOGIN = "#loginLbl";

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

function doPassMatch(p1, p2)
{
    if ($(p1).val() == $(p2).val())
        markValid(SIGNUP);
    else
        markInValid(SIGNUP, "Passwords do not match");

    return $(p1).val() == $(p2).val();
}

function isPassValid(label, id)
{
    if (id == "#srpassword")
        return ($(id).val().length > 6) && doPassMatch("#srpassword", "#spassword");
    else {
        if ($(id).val().length < 6)
            markInValid(label, "Password must be at least 7 characters long");
        else
            markValid(label);
    }
    return $(id).val().length > 6;
}

function isValidName(label, id)
{
  if ($(id).val().length < 3)
  {
    markInValid(label, "Name/Last must be at least 3 characters long");
    return false;
  }
  else {
    markValid(label);
    return true;
  }
}

function isValidWard()
{
  if ($("#ward_name").val() == "newWard")
  {
    if(!isValidName(SIGNUP,"#ward"))
    {
      markInValid(SIGNUP, "The name of the ward is too short");
      return false;
    }
    else {
      markValid(SIGNUP);
    }
  }
  // they have not selectec a ward
  if  ($("#ward_name option:selected").text() == "")
  {
    markInValid(SIGNUP, "Please select a ward");
    return false;
  }
  else {
    return true;
  }
}

// Checks whether the form is valid
function fullValidation(form) {
    var isValid = true;
    if (form == "signup") {
        $("#signupBtn").disabled = true;
        if (!isValidName(SIGNUP, "#name"))
            return false;
        if (!isValidName(SIGNUP, "#last"))
            return false;
        if (!isEmailValid(SIGNUP, "#semail"))
            return false;
        if (!isValidWard())
            return false;
        if (!isPassValid(SIGNUP, "#spassword"))
            return false;
        if (!isPassValid(SIGNUP, "#srpassword"))
            return false;
        $("#signupBtn").css('disabled', 'false');
    }
    if (form == "login")
    {
        $("#loginBtn").disabled = true;
        if (!isEmailValid(LOGIN, "#email"))
            return false;

        if (!isPassValid("#password")) {
            return false;
        }
        $("#loginBtn").css('disabled', 'false');
    }
    return true; //isValid;
}
