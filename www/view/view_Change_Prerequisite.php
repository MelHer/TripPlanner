<?php
    ob_start();
?>
<header>
	<h2>Nouveau prérequis</h2>
	<p>Les champs marqués d'un * sont obligatoires</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=change_Prerequisite&id=<?php echo $_GET['id'];?>">
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="name" placeholder="Description*" value="<?php echo $prerequisite['Name'];?>" maxlength="45" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<div>Quantité*</div>
						<input type="number" id="quantity" onchange="no_Decimal()" value="<?php echo $prerequisite['Quantity'];?>" name="quantity" value="0" min="0" max"9999" step="1" required/>
                    </div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
						<?php
						if($prerequisite['Ready']==true)
						{
							echo '<input type="checkbox" id="ready" name="ready" checked/>';
						}
						else
						{
							echo '<input type="checkbox" id="ready" name="ready"/>';
						}?>
						<label for="ready">Prêt</label>
                    </div>
                </div>
                <div class="center error">
                    <?php
                        if (isset($error_Message) && !empty($error_Message)) {
							echo $error_Message;
                        }
                    ?>
                </div>
				<div class="row uniform 50%">
					<div class="12u" align="center">
						<ul class="actions">
					        <li><input type="submit" value="Modifier"/></li>
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$_GET['id']?>/#prerequisite">Annuler</a></li>	
						</ul>
					</div>
				</div>
			</form>
		</section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";