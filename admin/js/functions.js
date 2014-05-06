


function  admin_printUserMenu(){
//console.log(this.responseText);
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
 		console.log(this.responseText);
		var wrap = byid('here');
 		wrap.innerHTML = html;
 		refresh();
 	}	 
}//end printUserMenu

function admin_login(){

	byid('login').onclick = function(){ 

		var email = byid('email-log').value;
		var pass = byid('password-log').value;
		//var token = byid('token').value;
		//var vars = 'email='+email+'&password='+pass+'&token='+token;

		var vars = 'email='+email+'&password='+pass;
		ajax('POST', 'php/login.php',  admin_printUserMenu, vars, true);
	}
}//end login



function  admin_reg(){
		
	byid('reg').onclick = function() {
		
		//levanto los valores de los campos
		//var name = byid('name').value;
		//var lastname = byid('lastname').value;
		var nickname = byid('nickname').value;
		var email = byid('email').value;
		var password = byid('password').value;
		var password2 = byid('password2').value;
		//var rank = byid('rank').value; // Ver q valores mandamos por aca
		//var country = byid('country').value;
		//var region = byid('region').value;
		//var city = byid('city').value;
		//var token = byid('token').value;

		//variable q pasa todo por post
		var vars = 'nickname='+nickname +'&email='+email+'&password='+password+
				   '&password2='+password2;

		ajax('POST', 'php/vets_new.php',  admin_printUserMenu, vars, true);
	}
}//end reg
