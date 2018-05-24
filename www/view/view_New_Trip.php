<?php
    ob_start();
?>
<header>
	<h2>Nouveau voyage</h2>
	<p>Les champs accompagnés d'un * sont facultatifs</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=new_Trip" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="title" placeholder="Titre" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="destination" placeholder="Destination" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Date de début:</label>
						<input type="date" id="start" name="date_Start" onchange="set_Min_Date()" min="2018-01-01" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Date de fin:</label>
						<input type="date" id="end"  name="date_End" onchange="set_Min_Date()" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="4u 12u(narrower)">
						<input type="radio" id="private" name="privacy" onclick="lock_Password()" value="private" checked>
						<label for="private">Privé</label>
					</div>
					<div class="4u 12u(narrower)">
						<input type="radio" id="public" name="privacy" onclick="unlock_Password()" value="public">
						<label for="public">Public</label>
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="password" id="password" name="password" placeholder="Mot de passe" maxlength="50" disabled/>
					</div>
					<div class="6u 12u(mobilep)">
						<input type="password" id="password_Confirmation" name="password_Confirmation" placeholder="Mot de passe (confirmation)" maxlength="50" disabled/>
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="file" name="image"/>
						<label for="image">Image du voyage*</label>
					</div>
				</div>
                <div class="center error">
                    <?php
                        if (isset($error_Message) && !empty($error_Message))
                        {
                            echo $error_Message;
                        }
                    ?>
                </div>
				<div class="row uniform 50%">
					<div class="12u" align="center">
						<ul class="actions">
					        <li><input type="submit" value="Créer" /></li>
							<li><a class="button" href="index.php?action=my_Trip&page=1">Annuler</a></li>			
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