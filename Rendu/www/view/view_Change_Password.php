<?php
    ob_start();
?>
<header>
	<h2>Mon compte</h2>
	<p>Changer le mot de passe</p>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
			<form method="post" action="index.php?action=change_Password">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="password" name="old_Password"placeholder="Ancien mot de passe" maxlength="50" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="password" name="new_Password"placeholder="Nouveau mot de passe" maxlength="50" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="password" name="new_Password_Confirmation" placeholder="Nouveau mot de passe (confirmation)" maxlength="50" required/>
					</div>
                </div>
				
				<!-- Information messages -->
                <div class="center error">
                    <?php
                        if (isset($error_Message) && !empty($error_Message)) {
                            echo $error_Message;
                        }
                    ?>
                </div>
				<div class="center info">
                    <?php
                        if (isset($info_Message) && !empty($info_Message)) {
                            echo $info_Message;
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