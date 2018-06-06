<?php
    ob_start();
?>
<header>
	<h2>Supprimer un participant</h2>
	<p>Cette action est irréversible</p>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
			<form method="post" action="index.php?action=delete_Participant&id=<?php echo $participation['fkTrip'];?>&participant=<?php echo $participation['fkUser'];?>">
				<div class="row uniform 50%">
                    <div class="3u">
                        <input type="hidden" name="hidden_Input" value="1"/>
                    </div>
                    <div class="6u 12u(mobilep)" align="center">
                        <h4>Vous êtes sur le point de supprimer <u><?php echo htmlspecialchars($participation['Nickname']);?></u> de votre voyage.
                        Voulez-vous continuer votre action?</h4>
                    </div>
				</div>
                <!-- Information message -->
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
					        <li><input class="special" type="submit" value="Confirmer" /></li>
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$participation['fkTrip']?>/#participant">Annuler</a></li>	
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