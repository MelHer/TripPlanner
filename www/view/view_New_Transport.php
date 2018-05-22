<?php
    ob_start();
?>
<header>
	<h2>Nouveau transport</h2>
	<p>Les champs marqués d'un * sont facultatifs</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=new_Transport&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="place_Start" placeholder="Lieu de départ" maxlength="45" required/>
					</div>
                    <div class="6u 12u(mobilep)">
						<input type="text" name="place_End" placeholder="Lieu d'arrivée" maxlength="45" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Date du départ:</label>
						<input type="date" id="start" name="date_Start" onchange="set_Min_Date()" min="2018-01-01" required/>
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Date d'arrivée:</label>
						<input type="date" id="end"  name="date_End" onchange="set_Min_Date()" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Heure du départ*:</label>
						<input type="time" name="time_Start"/>
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Heure d'arrivée*:</label>
						<input type="time"  name="time_End"/>
					</div>
				</div>
                <div class="row uniform 50%">
                    <div class="6u 12u(mobilep)">
                        <div>Prix:</div>
						<input type="number" id="price" onchange="two_Decimal()" name="price" value="0" min="0" step="0.01" required/>
                        <span>CHF</span>
                    </div>
                    <div class="6u">
						<div class="select-wrapper">
							<select name="type">
								<?php
                                    foreach($transport_Types as $transport_Type)
                                    {
                                        echo "<option value='".$transport_Type['idTransport_Type']."'>".$transport_Type['Type']."</option>";
                                    }
                                ?>
				            </select>
				        </div>
				    </div>
                </div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="text" name="code" placeholder="Code de résertvation*"/>
					</div>
					<div class="6u 12u(mobilep)">
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
						<label for="image">Image du transport*</label>
					</div>
				</div>
                <div class="center error">
                    <?php
                        if (isset($error_Message) && !empty($error_Message)) {
                            echo $error_Message;
                        }
                    ?>
                </div>
				<div class="row uniform">
					<div class="12u" align="center">
						<ul class="actions">
					        <li><input type="submit" value="Créer" /></li>
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$_GET['id']?>">Annuler</a></li>	
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