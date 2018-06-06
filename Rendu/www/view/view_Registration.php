<?php
    ob_start();
?>
<header>
	<h2>Inscription</h2>
	<p>Veuillez remplir le formulaire d'inscription</p>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
			<form method="post" action="index.php?action=register">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="nickname"placeholder="Pseudo" maxlength="20" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="email"placeholder="Adresse mail" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="password" name="password"placeholder="Mot de passe" maxlength="50" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="password" name="password_Confirmation" placeholder="Mot de passe (confirmation)" maxlength="50" required/>
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
					        <li><input type="submit" value="Créer" /></li>		
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