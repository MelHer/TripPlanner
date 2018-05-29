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
			<form method="post" action="index.php?action=new_Prerequisite&id=<?php echo $_GET['id'];?>">
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="name" placeholder="Description*" maxlength="45" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<div>Quantité*</div>
						<input type="number" id="quantity" onchange="no_Decimal()" name="quantity" value="0" min="0" max"9999" step="1" required/>
                    </div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
						<input type="checkbox" id="ready" name="ready"/>
						<label for="ready">Prêt</label>
                    </div>
                </div>
                <div class="center error">
                    <?php
                        if (isset($error_Message) && !empty($error_Message)) {
							echo $error_Message;
							print_r($_POST);
                        }
                    ?>
                </div>
				<div class="row uniform 50%">
					<div class="12u" align="center">
						<ul class="actions">
					        <li><input type="submit" value="Créer" /></li>
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