var validEmail = false;
var validPassword = false;
var validConfirmPassword = false;

function validateEmail(){

	var enteredEmail = document.getElementById("email").value;
	var rexp1 = /^[\w.-]+@[\w-]+\.[A-Za-z]{1,3}$/;
	var rexp2 = /^[\w.-]+@[\w-]+\.[\w-]+\.[A-Za-z]{1,3}$/;
	var rexp3 = /^[\w.-]+@[\w-]+\.[\w-]+\.[\w-]+\.[A-Za-z]{1,3}$/;
	// var emailrexp = /^[\w.-]+@[\w.-]{1,3}+\.[A-Za-z]{1,3}$/;
	var invalidtexttag = document.getElementById("invalidemail");
	//@aaa.aaa.aaa is correct x
	//@aaa.aaa is correct
	//@aaa.aaa.aaa.aaa is correct x
	//@aaa is not correct as it only contain one address extension
	//@aaa.aaa.aaa.aaa.aaa is not correct because it contains 5 address extension
	//@aaa.aaa.aaaa is not correct as the the last address extension contains 4 alphabet
	//@aaa.aaa.123 is not correct as the last address contain number
	if (rexp1.test(enteredEmail) || rexp2.test(enteredEmail) || rexp3.test(enteredEmail)){
		invalidtexttag.style.display = "none";
		validEmail = true;
	}
	else {
		invalidtexttag.style.display = "block";
		validEmail = false;
	}

}

function validatePassword(){
	var enteredPassword = document.getElementById("password").value;
	var invalidtexttag = document.getElementById("invalidpassword");
	if(enteredPassword.length >= 6){
		invalidtexttag.style.display = "none";
		validPassword = true;
	}else{
		invalidtexttag.style.display = "block";
		validPassword = false;
	}
}

function confirmPassword(){
	var enteredPassword = document.getElementById("password").value;
	var confirmedPassword = document.getElementById("confirm_password").value;
	var invalidtexttag = document.getElementById("invalid_confirm_password");
	if(enteredPassword.localeCompare(confirmedPassword) != 0){
		invalidtexttag.style.display = "block";
		validConfirmPassword = false;
	}else{
		invalidtexttag.style.display = "none";
		validConfirmPassword = true;
	}
}


function signUpValidation(){
	var alertMessage = ""; 
	
	if (validEmail == false){
		alertMessage += "Email";
	}
	if (validPassword == false){
		alertMessage += " Password";
	}
	if (validConfirmPassword == false){
		alertMessage += " Confirm password";
	}



	if (alertMessage != ""){
		alertMessage += " is invalid";
		alert(alertMessage);
	}
	else{
		alert("Sign up successfully!");
	}
}