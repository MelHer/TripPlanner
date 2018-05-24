<?php
    ob_start();
?>
<header>
	<h2>Authentification</h2>
	<p>Entrer le mot de passe du voyage pour accéder à ses détails</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=see_Public_Trip&id=<?php echo $_GET['id'];?>">
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="password" name="password" placeholder="Mot de passe" maxlength="50" required/>
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
					        <li><input type="submit" value="Valider" /></li>		
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