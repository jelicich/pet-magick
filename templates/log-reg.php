<input type="button" id="link-login" value="Login" />
<input type="button" id="link-reg" value="Sign up!" />

<script type="text/javascript">

	//======================DESPLIEGA REGISTRO
	byid('link-reg').onclick = function(){
		ajax('POST', 'ajax/getReg.php', printReg, null, true);
	}

	//======================DESPLIEGA LOGIN
	byid('link-login').onclick = function(){
		ajax('POST', 'ajax/getLogin.php', printLogin, null, true);
	}

</script>
