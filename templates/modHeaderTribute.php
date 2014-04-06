<div class="mod-header">
					
		<ul class='clearfix mod-menu' id='menuByPet'>
		
			<li id='dog'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=dog'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Dog					
				</a>
				<div id='arrow-dog' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='dog') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='cat'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=cat'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Cat					
				</a>
				<div id='arrow-cat' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='cat') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='bird'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=bird'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Bird
				</a>
				<div id='arrow-bird' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='bird') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='rabbit'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=rabbit'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Rabbit
				</a>
				<div id='arrow-rabbit' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='rabbit') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='ferret'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=ferret'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Ferret
				</a>
				<div id='arrow-ferret' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='ferret') echo 'style="display:block;"'?> ></div>
			</li>

			<li id='others'><!-- Hay q modificar estos a por algo semantico, ahora me da fiaca jaja -->
				<a href='pet-loss.php?c=others'> <!-- Reemplazar este valor por el numero q corresponda en la bd segun categoria -->
					Others
				</a>
				<div id='arrow-others' class="arrow-pet-loss" <?php if(isset($_GET['c']) && $_GET['c']=='others') echo 'style="display:block;"'?>></div>
			</li>
	</ul>
</div>