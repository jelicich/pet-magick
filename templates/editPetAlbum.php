						<div class="slider-small">
							<?php
								if($p->getAlbumId())
								{
									$album = $p->getAlbum($p->getAlbumId());
							?>
									<ul class="clearfix">
							<?php

									for($i=0;$i<sizeof($album);$i++)
									{
							?>
									
										<li>
											<a href=<?php echo '"'.$album[$i]['PIC'].'"'; ?> ><img class="thumb-small" src=<?php echo '"'.$album[$i]['THUMB'].'"';?> /></a>
											<a href=<?php echo '"'.$album[$i]['ID_PIC'].'"'; ?> >Delete</a>
										</li>
										
							<?php
									}//end for
							?>
									</ul>
							<?php
								}//END IF
							?>
						</div>