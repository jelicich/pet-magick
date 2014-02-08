								
								<?php
									if(isset($_POST['u']))
										$idUsr['u'];
									elseif(isset($_GET['u']))
										$idUsr['u'];
								?>
								
								<a href=<?php echo '"#'.$_GET['u'].'"' ?> class="btn" id="upload-organization">Upload</a>
								<ul>	
								
									<?php
									$list = $org->getOrgListByUser($_SESSION['id']);
									if($list)
									{
										for($i=0; $i<sizeof($list); $i++)
										{
								?>
										<li class="vet-q clearfix">
											<img src=<?php echo '"'.$list[$i]['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
											<div class="content-description bg-txt">
												<h3><?php echo $list[$i]['NAME']?></h3>
												<p><?php echo $list[$i]['DESCRIPTION'] //hacerle un substr?></p>
												<a href=<?php echo '"'.$list[$i]['ID_ORGANIZATION'].'"'?> class="btn btn-danger">Delete</a>
											</div>
										</li>
								<?php
										}//end for
									}//end if
								?>
								</ul>
								<script type="text/javascript">
									uploadOrganization();
									deleteOrganization();
									
								</script>