								
								<?php
									if(isset($_POST['u']))
										$idUsr = $_POST['u'];
									elseif(isset($_GET['u']))
										$idUsr = $_GET['u'];
								?>
								
								<a href=<?php echo '"#'.$idUsr.'"' ?> class="btn" id="upload-vettalk">Upload</a>
								<ul>	
								
									<?php
									$list = $org->getOrgListByUser($idUsr);
									if($list)
									{
										for($i=0; $i<sizeof($list); $i++)
										{
								?>
										<li class="vet-q clearfix">
											<img src=<?php echo '"'.$list[$i]['Pics']['THUMB'] .'"'?> class="thumb-small side-img"/>
											<div class="content-description bg-txt">
												<h3><?php echo $list[$i]['TITLE']?></h3>
												<p><?php echo $list[$i]['CONTENT'] //hacerle un substr?></p>
												<a href=<?php echo '"#'.$list[$i]['ID_ORGANIZATION'].'"'?> class="btn btn-danger delete-org">Delete</a>
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