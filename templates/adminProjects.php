					
					<?php
						if(isset($_POST['u']))
							$idUsr = $_POST['u'];
						elseif(isset($_GET['u']))
							$idUsr = $_GET['u'];
					?>
					
					<a href=<?php echo '"#'.$idUsr.'"' ?> class="btn" id="upload-project">Create Project</a>
					<ul>	
					
						<?php
						$list = $pro->getProjectListByUser($idUsr);
						if($list)
						{
							for($i=0; $i<sizeof($list); $i++)
							{
					?>
							<li class="vet-q clearfix">
								<img src=<?php echo '"'.$list[$i]['Albums']['Pics'][0]['THUMB'] .'"'?> class="thumb-small side-img"/>
								<div class="content-description bg-txt">
									<h3><?php echo $list[$i]['TITLE']?></h3>
									<p><?php echo $list[$i]['DESCRIPTION'] //hacerle un substr?></p>
									<a href=<?php echo '"#'.$list[$i]['ID_PROJECT'].'"'?> class="btn btn-danger delete-org">Delete</a>
								</div>
								<div>
									<?php
									for($j = 0; $j < sizeof($list[$i]['Albums']['Pics']); $j++)
									{
										
										echo '<a href="'.$list[$i]['Albums']['Pics'][$j]['PIC'].'"><img src="'.$list[$i]['Albums']['Pics'][$j]['THUMB'].'"/></a>';
									}
									?>
								</div>
							</li>
					<?php
							}//end for
						}//end if
					?>
					</ul>
					<script type="text/javascript">
						uploadProject();
						deleteProject();
						
					</script>