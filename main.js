// Validation code for Inputs

var uname = document.forms['form']['uname'];
var pword = document.forms['form']['pword'];

var u_error = document.getElementById('u_error');
var p_error = document.getElementById('p_error');

function validated() {
	// body...
	if (uname.value.length < 9) {
		uname.style.border = "1px solid red";
		u_error.style.display="block";
		uname.focus();
		return false;
	}
	if (pword.value.length <= 8) {
		pword.style.border = "1px solid red";
		p_error.style.display="block";
		pword.focus();
		return false;
	}
}