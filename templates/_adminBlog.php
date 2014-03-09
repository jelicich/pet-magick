								
								<?php
									if(isset($_POST['u']))
										$idUsr = $_POST['u'];
									elseif(isset($_GET['u']))
										$idUsr = $_GET['u'];
								?>
								
								<a href=<?php echo '"#'.$idUsr.'"' ?> class="btn" id="new-post">New Post</a>
								<ul>	
								
									<?php

									$list = $bl->getArchive($idUsr);
									var_dump($list);
									if($list)
									{
										for($i=0; $i<sizeof($list); $i++)
										{
											echo'<li>';
												

										}//end for
									}//end if
								?>
								</ul>
								<script type="text/javascript">
									uploadVetTalk();
									deleteVetTalk();
									
								</script>