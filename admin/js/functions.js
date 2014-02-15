
function printUserMenu(){

	var html = this.responseText;
 	try 
 	{
 		var errores = JSON.parse(this.responseText);
 		var err = create('div');
 		err.className = "alert alert-danger";
 		for(error in errores)
 		{
 			var p = '<strong>'+error+'</strong> '+errores[error];
 		}
 		err.innerHTML = p;
 		byid('log-form').appendChild(err);

 		setTimeout(function()
			{
				err.parentNode.removeChild(err);
			},3000)
 	}
 	catch(e)
 	{
		var wrap = byid('here');
 		wrap.innerHTML = html;
 	}	 
}//end printUserMenu

function login(){

	byid('login').onclick = function(){ 
		//levanto los valores de los campos
		var email = byid('email-log').value;
		var pass = byid('password-log').value;
		var token = byid('token').value;

		//variable q pasa todo por post
		var vars = 'email='+email+'&password='+pass+'&token='+token;

		source = 'log';
		ajax('POST', 'php/login.php', printUserMenu, vars, true);
	}
}//end login
