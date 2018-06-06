<?php
    ob_start();
?>
<header>
	<h2>Nouvel hébergement</h2>
	<p>Les champs marqués d'un * sont obligatoires</p>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
			<form method="post" action="index.php?action=new_Lodging&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="address" placeholder="Adresse*" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Date de début*:</label>
						<input type="date" id="start" name="date_Start" onchange="set_Min_Date()" min="2018-01-01" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Date de fin*:</label>
						<input type="date" id="end"  name="date_End" onblur="check_Date()" required/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
                        <div>Prix*:</div>
						<input type="number" id="price" onchange="two_Decimal()" name="price" value="0" min="0" max="900000" step="0.01" required/>
                        <span>CHF</span>
                    </div>
                    <div class="6u">
						<div class="select-wrapper">
							<select name="type">
								<?php
                                    foreach($lodging_Types as $lodging_Type)
                                    {
                                        echo "<option value='".$lodging_Type['idLodging_Type']."'>".$lodging_Type['Type']."</option>";
                                    }
                                ?>
				            </select>
				        </div>
				    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="code" placeholder="Code de réservation" maxlength="45"/>
					</div>
					<div class="6u 12u(mobilep)">
						<input type="text" name="link" placeholder="Lien" maxlength="255"/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="12u 12u(mobilep)">
						<textarea  name="note"  maxlength="280" placeholder="Remarque"></textarea>
                    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="file" name="image"/>
						<label for="image">Image de l'hébergement</label>
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
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$_GET['id']?>/#lodging">Annuler</a></li>	
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