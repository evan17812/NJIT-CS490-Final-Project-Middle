/*
Philip Wysocki
Login JS
*/

//======================================================================================
//Listeners for Login Fields, one for entering, two for empty inputs
document.querySelector("#loginForm").addEventListener("submit", function(e){
	//preventing default behaviour
	e.preventDefault();
	//making a call user userLogin()
	userLogin()
});

document.querySelector("#username").addEventListener("invalid", function(){
	//checking for length of username
	if(String(this.value).length==0){
		this.setCustomValidity("Username Missing");
	}
	else{
		this.setCustomValidity("");
	}
});

document.querySelector("#password").addEventListener("invalid", function(e){
	//checking for length of password
	if(String(this.value).length==0){
		this.setCustomValidity("Missing password...");
	}
	else{
		this.setCustomValidity("");
	}
});
//======================================================================================
//runs on attempted login
function userLogin()
{
	var username = document.getElementById('username');
	var password = document.getElementById('password');

	makeAjaxCall(username.value, password.value);
}
//======================================================================================
//ajax to PHP
function makeAjaxCall(username, password){
	var data = 'json_string={"header":"login","username":"'+username+'","password":"'+password+'"}'
 	//console.log(data);
	var request = new XMLHttpRequest();

	request.open('POST', 'http://localhost:8888/BetaFinal/frontend/php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	request.send(data);
	//console.log(data);

	//ajax request was successful
	request.onload = function() {
		if (request.status >= 200 && request.status < 400)
		{
			//console.log(request.responseText);
			var response = request.responseText;
			var serverResponse = JSON.parse(response);
			//console.log(serverResponse);
			loginAttempt(serverResponse, username);
		}
		else
		{
			console.log(response);
		}
	};
}
//======================================================================================
//parses response
function loginAttempt(response, username){
 	//json_decode(response);
	var responseJSON = response;
 	var ajaxDisplay = document.getElementById('ajaxDiv');
	if(responseJSON == "fail")
	{
   	ajaxDisplay.innerHTML = "<h3><center> Username or Password is incorrect!<br> Please try again!</center></h3>";
		console.log("failed Login");
	}
	else
	{
		window.localStorage.setItem('username', username);
		window.localStorage.setItem('type', responseJSON);

		if(responseJSON == "student")
		{
			//console.log('"Student"')
			window.location.replace("http://localhost:8888/BetaFinal/frontend/student/s-landing.html");
		}
		else if(responseJSON == "teacher")
		{
			//console.log("teacher")
			window.location.replace("../teacher/landing.html");
		}
	}
}
//======================================================================================
