<?php
session_start();
function isForum()
{
  $cp = $_SERVER['REQUEST_URI'];


      if(strpos($cp, 'forum') !== false || strpos($cp, 'topic') !== false || strpos($cp, 'bbp') !== false)
      {
         return true;
      }
      else
      {
        return false;
      }
    
}
 

  
  if(strpos($cp,'blog') !== false)
  { 
    if(strpos($cp, $var) !== false)
    {
       echo 'active';
       return;
    }
    else
    {
      if($var == 'blog')
      {
        echo 'active';
        return;
      }  
    }
  

}

/**
 * The template for Header.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if (is_search()) { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<title>
<?php bloginfo('name'); ?>
<?php wp_title('|'); ?>
</title>
<!-- pet magcik -->
<script type="text/javascript" src="../js/jquery.js"></script>
<!--  -->

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/normalize.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
<!--<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/mediaqueries.css" />-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_enqueue_script("jquery"); ?>
<?php //wp_head(); ?>
<script src="<?php bloginfo('template_url'); ?>/menu.js"></script>
<script type="text/javascript">var templateDir = "<?php bloginfo('template_directory') ?>";</script>
<script src="<?php bloginfo('template_url'); ?>/to-top-jquery/to-top-jquery.js"></script>

<!-- pet magick -->
<link rel="stylesheet" href="../css/reset.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="../css/layout.css" type="text/css" />

<script type="text/javascript" src="../js/lib.js"></script>
<script type="text/javascript" src="../js/autosearch.js"></script>
<script type="text/javascript" src="../js/jq_functions.js"></script> 
<!-- -->

</head>
<body>

<div id="wrapper">
  <div id="header">
    <!-- yellow bar -->
    <div id="yellow-bar">
      <div class="container_12">
        <!-- logo -->
        
      <a href='../index.php'>  <h1 class="grid_2" id="logo-pet-magick">Pet Magick</h1> </a><!-- no se si esto es semantico a- h1-->
        
        <!-- form login  -->
        <!--IF QUE SE FIJA Q SI ESTA LOGUEADO CARGUE EL MENU DE USUARIO EN VEZ DEL LOGIN --> 
        <div id="login-reg">

          <?php 
            //session_destroy();

            if(isset($_SESSION['id']) && isset($_SESSION['email']))
            {
            ?>
              <!-- user menu -->
              <ul class="grid_5 push_5 clearfix" id="user-menu">
                <li>
                  <a href="../ajax/logout.php" id="logout">Log out</a>
                </li>
                <li>
                  <a href="../inbox.php">Inbox</a>
                  <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                      include_once "../../php/classes/BOConversations.php";
                    else
                      include_once "../php/classes/BOConversations.php";
                    
                    $conv = new BOConversations;
                    $unread = $conv->getNotifications($_SESSION['id']);
                    if($unread)
                    {
                  ?>
                    <i id="notification-msg"><?php echo $unread?></i>
                    <div id="notification-msg-box">
                      <p>You have <strong><?php echo $unread?></strong> unread conversations</p>
                    </div>
                    <script type="text/javascript">
                      showNotification('msg');
                    </script>
                  <?php
                    }//end if sizeof
                  ?>
                </li>
                <li>
                  <?php 
                    if(!isset($_SESSION['thumb'])){

                      $thumReg = '../img/users/thumb/default.jpg';

                    }else{

                      $thumReg = $_SESSION['thumb'];
                    }
                  ?>
                  <img src=<?php echo '"../'. $thumReg  .'"'; ?> />
                  <a href=<?php echo "../user-profile.php?u=". $_SESSION['id'] ?> ><?php echo $_SESSION['name'].' '.$_SESSION['lastname'] ?></a>
                  <?php

                  if(isset($_SESSION['rank']) && $_SESSION['rank'] == 1)
                  {
                    if($_SERVER['REQUEST_METHOD'] == 'POST')
                      include_once "../../php/classes/BOQuestions.php";
                    else
                      include_once "../php/classes/BOQuestions.php";
                    $q = new BOQuestions;
                    $n = $q->qtyNewQuestions();
                    if($n[0]['COUNT']>0)
                    {
                  ?>
                    <i id="notification"><?php echo $n[0]['COUNT']?></i>
                    <div id="notification-box">
                      <p>There are <strong><?php echo $n[0]['COUNT']?></strong> unanswered questions in Vet Talk</p>
                    </div>
                    <script type="text/javascript">
                      showNotification();
                    </script>
                  <?php
                    }//end if sizeof
                  }
                  ?>

                </li>
              </ul>
              <!-- END user menu -->

            <?php
            }
            else
            {
            ?>
            <!-- log reg -->
              <ul class="grid_4 push_6 clearfix" id="login-reg-btns">

                <!-- ==================================== REGISTRATION ==================================== -->
                <li>
                  <a href="#" id="link-reg" class="btn btn-danger btn-small">Sign up</a>
                  <!-- hidden -->
                  <div id="reg-form">
                    
                    <?php 
                      
                      include_once '../php/classes/BOLocation.php';

                      $country = new BOLocation;
                      $countries = $country->countryList();

                    ?>

                    <form class="clearfix form-login" > <!-- removi un id q se repetia con el de id="form-login" y lo converti en class-->
                      
                      <div class="clearfix">
                        <div class="half">
                          <div>
                            <label for="name">Name*</label>
                            <input type="text" name="name" id="name" placeholder="name" style="width:100%"/>
                          </div>

                          <div>
                            <label for="lastname">Lastname*</label>
                            <input type="text" name="lastname" id="lastname" placeholder="lastname" style="width:100%"/>
                          </div>

                          <div>
                            <label for="nickname">Nickname*</label>
                            <input type="text" name="nickname" id="nickname" placeholder="nickname" style="width:100%"/>
                          </div>
                        </div>

                        <div class="half">
                          <div>
                            <label for="email">e-mail*</label>
                            <input type="text" name="email" id="email" placeholder="email" style="width:100%"/>
                          </div>

                          <div>
                            <label for="password">Password*</label>
                            <input type="password" name="password" id="password" placeholder="password" style="width:100%"/>
                          </div>

                          <div>
                            <label for="password2">Confirm password*</label>
                            <input type="password" name="password2" id="password2" placeholder="password2" style="width:100%"/>
                          </div>
                        </div>
                      </div>

                      <div id="country-wrapper">
                        <select id="country" name="country">
                            <option disabled="disabled" selected="selected">Country</option>
                          
                          <?php
                            foreach ($countries as $key => $value){
                                echo '<option value="'.$value['CountryId'].'">'.$value['Country'].'</option>';
                            }
                            ?>

                        </select>
                        </div>
                        <!-- pasar estos displays al css -->
                        <div id="region-wrapper" >
                          <select id="region" name="region" style='display:none;'></select><!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
                          
                        </div>

                        <div id="city-wrapper" >
                          <!-- pasar estos displays al css -->
                          <select id="city" name="city" style='display:none;'></select> <!-- tratar de mandarlo al wrapper el display. lib.js linea 171. -->
                          
                        </div>

                        <p>* Mandatory fields</p>

                        <input type="button" id="reg" value="Sign up!" class="btn btn-danger" />
                      <input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />

                    </form>
                  </div>
                </li>


                  <!-- ==================================== LOGIN ==================================== -->

                <li>
                  <a href="#" id="link-login" class="btn btn-danger btn-small">Login</a>
                  <!-- hidden -->
                  <div id="log-form">
                    <form class="clearfix form-login" >
                      
                      <div>
                        <label for="email-log">e-mail</label>
                        <input type="text" name="email" id="email-log" placeholder="e-mail" style="width:100%"/>
                      </div>
                      <div>
                        <label for="password-log">Password</label>
                        <input type="password" name="password" id="password-log" placeholder="Password" style="width:100%"/>
                      </div>
                      
                      <input type="button" id="login" value="Login" class="btn btn-danger"/>
                      <input type="hidden" name="token" id="token" value=<?php echo '"'. $_SESSION['token'] . '"'; ?> />

                      <span id="forgotPassword">Forgot your password ?</span>

                      <div id='forgotContent' >
                          <label for="forgotEmail">Enter your email addres</label>
                          <input type='text' name='forgotEmail' id='forgotEmail' style="width: 180px" placeholder="e-mail" />
                          <input type='button' value='Submit' id='submitEmail'  class="btn btn-danger" />
                      </div>

                    </form>
                  </div>
                </li>
              </ul>



              <script type="text/javascript">

                //showForms('link-reg', 'reg-form', 'log-form'); //====================== DESPLIEGA REGISTRO
                //showForms('link-login', 'log-form', 'reg-form'); //====================== DESPLIEGA LOGIN
                
                //logRegOnclick(); //====================== DESPLIEGA REGISTRO y LOGIN
                reg(); //====================== PARA REGISTRARSE
                countriesCombo(); //====================== DESPLIEGA COMBOS
                regionsCombo(); //====================== DESPLIEGA REGIONES
                login(); //====================== PARA LOGUEARSE 
                userForms(); // jquery function
                forgotPassword();
              </script>


            <!-- log reg -->

            <?php
            }
          ?>
          
        </div>
        
      </div>
    </div>
    <!-- END yellow bar -->

    <!-- navbar -->
    <div id="nav-bar">
      <div class="container_12 clearfix">
        <ul class="grid_9 btn-group">
            <li class="btn btn-small btn-danger"><a href="../index.php">Home</a></li>
            <li class="btn btn-small btn-danger"><a href="../profiles.php">Profiles</a></li>
            <!--<li class="btn btn-small btn-danger"><a href="#">Formums</a></li> -->
            <li class="btn btn-small btn-danger"><a href="../antics.php">Animal Antics</a></li>
            <li class="btn btn-small btn-danger"><a href="../vet-talk.php">Vet Talk</a></li>
            <li class="btn btn-small btn-danger"><a href="../projects.php">Projects</a></li>
            <li class="btn btn-small btn-danger"><a href="../organizations.php">Organizations</a></li>
            <li class="btn btn-small btn-danger"><a href="../pet-loss.php">Pet Loss</a></li>
            <li class="<?php if(isForum()) echo active; ?> btn btn-small btn-danger"><a href="../blog/?post_type=forum">Forum</a></li>
            <li class="<?php if(!isForum()) echo active; ?> btn btn-small btn-danger"><a href="../blog">Blog</a></li>
            
          <?php
            if(isset($_SESSION['rank']) && $_SESSION['rank'] == 2){
          ?>
            <li class="btn btn-small btn-danger"><a href="../admin/index.php?active=0">Admin</a></li>
          <?php
            }
          ?>
            
        </ul>
        <div class="grid_3" id='searchF'>
          <input type="text" placeholder="Search..." id='finder' autocomplete="off"/>
          <input type='hidden' id='id-recipientf' name='recipient'/> 
        </div>
      </div>
    </div>
    <!-- END navbar -->
  </div>
  <!-- END header -->

  <!-- Esta libreria es para interpretar JSON en navegadores viejos (IE) -->
  <!--[if lt IE 9]>
        <script type="text/javascript" src="js/json.js"></script>
  <![endif]-->





<!--
  <div class="container_12" id="blog-head">


<!- -
      <div id="wp-header" class="grid_12">
          <h2>
            <a href="<?php echo home_url(); ?>/">
            <?php bloginfo('name'); ?>
            </a>
          </h2>
          
          <div class="description">
            <?php bloginfo('description'); ?>
          </div>
        
        <div class="clear"></div>
      </div>
- ->

      <nav>
        <div id="navigation" class="flex_100">
          
          <div class="clear"></div>
          <a href="#" id="pull"><img src="<?php bloginfo('template_directory') ?>/images/nav-icon.png"></a></div>
          
      </nav>
      <div class="clear"></div>


  </div><!- - container 12 -->

