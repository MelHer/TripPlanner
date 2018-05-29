<?php
    ob_start();
?>
<header>
	<h2>Voyage</h2>
	<p>Modifier l'intitulé. Les champs marqués d'un * sont obligatoires</p>
</header>
<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
			<form method="post" action="index.php?action=change_Trip&id=<?php echo $trip['idTrip'];?>" enctype="multipart/form-data">
				<div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="title" placeholder="Titre*" maxlength="45" value="<?php echo htmlspecialchars($trip['Title']);?>" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="12u 12u(mobilep)">
						<input type="text" name="destination" placeholder="Destination*" maxlength="45" value="<?php echo htmlspecialchars($trip['Destination']);?>" required/>
					</div>
				</div>
                <div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<label for="date_Start">Date de début*:</label>
						<input type="date" id="start" name="date_Start" value="<?php echo $trip['Date_Start'];?>" onchange="set_Min_Date()" min="2018-01-01" required/>
                        
					</div>
					<div class="6u 12u(mobilep)">
						<label for="date_End">Date de fin*:</label>
						<input type="date" id="end"  name="date_End" value="<?php echo $trip['Date_End'];?>" onchange="set_Min_Date()" required/>
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="6u 12u(mobilep)">
						<input type="file" name="image"/>
						<label for="image">Image du voyage</label>
					</div>
                    <div class="2u 12u(mobilep)">
				        <span>Image actuelle:</span>
					</div>
                    <div class="3u 12u(mobilep)">
				        <?php
                            //image
                            if($trip['Image'] == true)
                            {
                                 echo "<td><a class='no_Border' href='images/user".$_SESSION["id"]."/".$trip['idTrip']."/".$trip['idTrip'].".jpg'><img class='thumbnail' src='images/user".$_SESSION["id"]."/".$trip['idTrip']."/".$trip['idTrip'].".jpg'></a></td>";
                            }
                                 else
                            {
                                 echo '<td><img class="thumbnail" src="images/default_Trip.png"></td>';     
                            }
                        ?>
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
					        <li><input type="submit" value="Modifier" /></li>
                            <li><a class="button" href="<?php echo "index.php?action=see_Trip&id=".$trip['idTrip']?>">Annuler</a></li>	
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