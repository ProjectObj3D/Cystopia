$(function() {
    $('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});



var password = document.getElementById("password_register")
  , confirm_password = document.getElementById("confirm-password_register");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("il faut que le mot de passe soit identique");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


// Animation *****************************

var objSelected = false;

function objClick() {

    document.getElementById('animA').style.cssText = 'animation: paused';
	  document.getElementById('animB').style.cssText = 'animation: paused';
    document.getElementById('animA').classList.add('selected');

    objSelected = true;
}

function objHoverA() {

    document.getElementById('animA').style.cssText = 'animation: step-end; transition: .3s; box-shadow: 0px 0px 15px 5px rgb(32,162,215);';
 	  document.getElementById('animB').style.cssText = 'display: none';
}

function objHoverB() {

    document.getElementById('animA').style.cssText = 'display: none';
    document.getElementById('animB').style.cssText = 'animation: step-end; transition: .3s;';
}

function objMouseOut() {
    
    if (objSelected == false)
    {
      document.getElementById('animA').style.cssText = 'animation: rotationA 5s  cubic-bezier(.47,.32,.26,.44) infinite';
		  document.getElementById('animB').style.cssText = 'animation: rotationB 5s  cubic-bezier(.47,.32,.26,.44) infinite';
    }
}









		