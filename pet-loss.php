<?php 
	session_start();
	//session_destroy();
	$_SESSION['token'] = sha1(uniqid()); 
	//var_dump($_SESSION);

	include_once "php/classes/BOPopups.php";
	$pop = new BOPopups;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Pet Magick is a global social network for pet and animal lovers to connect and share the joy that animal companions bring into their life. A place where those grieving with pet loss can get support from others who've been through the same traumatic experience.">
<meta name="keywords" content="pet lovers,pet owners,pet loss,funny pet videos,pet health,animal health,pet information,animal rescue,pet stories,dog club,cat club">
<title>Pet Magick</title>

<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/960_12_col.css" type="text/css" />
<link rel="stylesheet" href="css/layout.css" type="text/css" />

<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/jq_functions.js"></script> 

<script type="text/javascript" src="js/lib.js"></script>

</head>

<body>
<div id='preloader'><img src='img/loading.gif' alt='loader' /></div>

<?php 
		include_once 'templates/No_IE.php'; 
?>

<div id="wrapper">
	
	<?php 
		include_once 'templates/header.php'; 
	?>

	<!-- site content -->
	<div class="container_12" id="content">

		<div id='what'>
			<a href="#" ><p>How does Pet Loss work ?</p></a>
			<div class='active five_pixels'>
				<div id='pop-up' class='mod grid_4 '>

					<p> 
						<?php echo nl2br($pop->getPopUps("petloss")); ?>
					</p>

				</div>
				<div class=' arrow-top'></div>
			</div>
		</div>
		<?php 
		if(isset($_GET['c'])) 
		{
		?>
			<div id="show-all">
				<a href="pet-loss.php">Show all tributes</a>
			</div>
		<?php } ?>

		
		
		<!-- pet loss module -->
		<div  class="pet-loss-mod mod grid_12" id="pet-loss-mod">
			<?php 
						
				include_once 'templates/modHeaderTribute.php'; 
			?>
				<div class="scrollable-module" id="petLoss">
					<ul class='grid-thumbs clearfix' id='ModulesByPet'> 
						
						<?php 
							
							if(!isset($_GET['c']))
							{	
								$category = '"*"';
								$url = '"ajax/searchTributes.php?"';
								
								include_once 'templates/petLossModule.php'; 
							}
							else
							{
								$url = '"ajax/searchTributesByCategory.php?"';
								switch ($_GET['c']) 
								{
									case 'dog':
										$category = 1;
										$string = 'dog';									
										break;

									case 'cat':
										$category = 2;
										$string = 'cat';
										break;

									case 'bird':
										$category = 3;
										$string = 'bird';
										break;

									case 'rabbit':
										$category = 4;
										$string = 'rabbit';
										break;

									case 'ferret':
										$category = 5;
										$string = 'cat';
										break;

									case 'others':
										$category = 6;
										$string = 'pet';
										break;
									
									default:
										$category = 1;
										$string = 'dog';
										break;									
								}

								include 'php/classes/BOTributes.php';
								$p = new BOTributes;
								$r = $p->searchTributesByCategory($category, 0, 28);

								$totalRec = $p->totalRecords($category);
								$totalPag = ceil($totalRec/28);
								$firstPag = rand(0, $totalPag-1);
								if($r)
								{
									shuffle($r);
									
									for($i = 0; $i < sizeof($r); $i++)
									{
										if(isset($r[$i]['Pets']['Pics']))
										{
											$thumb = 'img/pets/thumb/'.$r[$i]['Pets']['Pics']['PIC'];
										}
										else
										{
											$thumb = 'img/pets/thumb/default.jpg';	
										}

										?>
											<li>
												<a href="<?php echo 'pet-tribute.php?t='.$r[$i]['ID_TRIBUTE']; ?>" >
													<img src= "<?php echo $thumb ?>" class='thumb-mid'/>
													<dl class='hidden'>
													<dt>R.I.P</dt>
														<dd><?php echo  htmlspecialchars($r[$i]['Pets']['NAME']); ?> </dd>
														<dd><?php echo  $r[$i]['SINCE']." - ".$r[$i]['THRU'];  ?></dd>
													</dl>
												</a>
											</li>
										<?php 
									}
									
								}
								else
								{
									echo '<div class="mod-content"><h3>We couldn\'t find what you\'re looking for</h3></div>';
								}
							}
						?>
					</ul>	
				</div>
		</div>
		<!-- END profiles module -->

		<!-- ads -->
		<div class="publi-org mod grid_4">
			<?php 
				require('admin/ledads/ad_class.php');
				echo $pla_class->adcode( );
			?>
		</div>
		<div class="publi-org mod grid_4">
			<?php 
				require('admin/ledads/ad_class.php');
				echo $pla_class->adcode( );
			?>
		</div>
		<div class="publi-org mod grid_4">
			<?php 
				require('admin/ledads/ad_class.php');
				echo $pla_class->adcode( );
			?>
		</div> 
		<!-- END ads -->

	</div>
	<!-- END site content -->

	<?php 
		include_once 'templates/footer.php'; 
	?>

</div>
<!-- END wrapper-->

<script type="text/javascript">
//	listByCategory('tributesModuleByPets.php'); // ACA HAY Q HACER UN ajax/php para traer mascotas muertas (tributos)



	function range(start, end) 
	{
	    var foo = [];
	    for (var i = start; i <= end; i++) {
	        foo.push(i);
	    }
	    return foo;
	}
	
	//Guardo la cant de pags en un array
	var pages = range(0, <?php echo $totalPag ?>);
	//borro la primer pag q se imprime del array (la primera vez q se ejecuta nro de pag coincide con indice de array)
	pages.splice(<?php echo $firstPag ?>, 1);
	
	var totalRec = <?php if($totalRec) echo $totalRec; else echo "0"; ?>;
	var totalPag = <?php if($totalPag) echo $totalPag; else echo "0"; ?>;

	$(".scrollable-module").mCustomScrollbar(
	{
		scrollButtons:
		{
			enable: false 
		},

		advanced:
		{
			updateOnContentResize: true,
			horizontalSrcoll: true
		},

		theme:"light-thin",

		callbacks:
		{
		    
		    onTotalScroll:function()
		    {
	 			  		
	    		
	    		if(pages.length > 0)
	    		{
	    			//agarro una pag random del array
	    			var rand = Math.floor(Math.random() * pages.length);
		    		page = pages[rand];

		    		$.ajax(
		    		{
		                type: "POST",
		                url: <?php echo $url ?>,
		                data: {q: <?php echo $category ?>, from: page*28, rand: true},
		                cache: false,

		                success: function(html)
		                {
		                	$('#ModulesByPet').append(html);		                	
		                }
		            });			    	

	    		

		    		//borro la pag q se cargo del array
		    		pages.splice(rand,1);		    		

	    		}

	    		else
		    	{
		    		var li = $('.last-result-tributes');
		    		if(li.length == 0)
		    		{
		    			$('#ModulesByPet').append('<li class="last-result-tributes">No more results</li>');
		    		}
		    		
		    	}
	    		    		
	    		
	    		
	        }
		}
	});

</script>

</body>
</html>
