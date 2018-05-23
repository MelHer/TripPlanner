<?php
    ob_start();
?>
<header>
	<h2>Nouvelle activité</h2>
	<p>Les champs marqués d'un * sont facultatifs</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=new_Activity&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="description" placeholder="Description" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
                        <div>Prix:</div>
						<input type="number" id="price" onchange="two_Decimal()" name="price" value="0" min="0" step="0.01" required/>
                        <span>CHF</span>
                    </div>
                    <div class="6u 12u(mobilep)">
						<div>Date de l'activité *:</div>
						<input type="date" id="start" name="date_Activity" min="2018-01-01"/>
					</div>
                </div>
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="link" placeholder="Lien*" maxlength="255"/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="12u 12u(mobilep)">
						<input type="text" name="note" placeholder="Remarque*" maxlength="280"/>
                    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="file" name="image"/>
						<label for="image">Image de l'activité*</label>
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
					        <li><input type="submit" value="Créer" /></li>
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$_GET['id']?>/#activity">Annuler</a></li>	
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