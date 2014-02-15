<div id="log-form" class="span4 offset4 well">
	 <form class="form-signin form-login" role="form">
       
        <h2 class="form-signin-heading"><small>Pet Magick admin panel</small></h2>

        <input type="email" name="email" id="email-log" class="form-control" placeholder="Email address" required autofocus />
        <input type="password" name="password" id="password-log" class="form-control" placeholder="Password" required />
        <input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />

        <input type="button" class="btn btn-lg btn-info btn-block" id="login" value="Login" />
       
	</form>
</div>	

<script type="text/javascript">
	login(); 
</script>