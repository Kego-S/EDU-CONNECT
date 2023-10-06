function openRegistrationForm() {
	var registrationFormPopup = document.getElementById(
		'registration-form-popup'
		
	);
	registrationFormPopup.style.display = 'flex';

	// so what this does is it gets the card div with id of maincard and adds the blur-card(which has filter blur) css class to it
	document.getElementById('maincard').classList.add('blur-card');
}

function closeRegistrationForm() {
	var registrationFormPopup = document.getElementById(
		'registration-form-popup'
	);
	registrationFormPopup.style.display = 'none';
	// this simply removes the css class from it when you close the modal
	document.getElementById('maincard').classList.remove('blur-card');
}

function openLoginForm() {
	var loginformpopup = document.getElementById('Login-form-popup');
	loginformpopup.style.display = 'flex';
	document.getElementById('maincard').classList.add('blur-card');
}

function closeLoginForm() {
	var loginformpopup = document.getElementById('Login-form-popup');
	loginformpopup.style.display = 'none';
	document.getElementById('maincard').classList.remove('blur-card');
}
