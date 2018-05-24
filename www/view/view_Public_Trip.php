<?php
    ob_start();
?>
<header>
	<h2>Voyages publics</h2>
	<p>Voici la liste des voyages publics</p>
</header>
<div class="row">
    <div class="12u">
        
        <section class="box">
            <div class="table-wrapper">
				<table id="simple_Table">
				    <tbody>
                        <?php 
                            foreach($trips as $trip)
                            {
                                $date_Start = date_Create($trip['Date_Start']);
                                $date_End = date_Create($trip['Date_End']);
                                $creation = date_Create($trip['Creation']);
                                
                                
                                echo '<tr>';
                                    
                                //image
                                if($trip['Image'] == true)
                                {
                                    echo "<td><a class='no_Border' href='images/user".$trip["fkUser_Organizer"]."/".$trip['idTrip']."/".$trip['idTrip'].".jpg'><img class='thumbnail' src='images/user".$trip["fkUser_Organizer"]."/".$trip['idTrip']."/".$trip['idTrip'].".jpg'></a></td>";
                                }
                                else
                                {
                                    echo '<td><img class="thumbnail" src="images/default_Trip.png"></td>';     
                                }
                                   
                                echo '<td class="text_Center">'.htmlspecialchars($trip['Title']).'<br>'.htmlspecialchars($trip['Destination']).'</td>';
                                echo '<td class="text_Center">Du: '.date_format($date_Start,"d-m-Y").' au :'.date_format($date_End,"d-m-Y").'</td>';
                                echo '<td class="text_Center">Crée le: '.date_format($creation,"d-m-Y").'<br>Par: '.$trip['Nickname'].'</td>';
                                if(isset($_SESSION['id']))
                                {
                                    echo '<td class="text_Center"><a href="index.php?action=see_Public_Trip&id='.$trip['idTrip'].'">voir</a></td>';
                                }
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
				</table>
                <div class="12u" align="center">
				    <ul class="actions">
                        <?php 
                            if($_GET['page']==1)
                            {
                                echo '<li><a class="button special" href="">1</a></li>';
                                echo '<li><a class="button" href="index.php?action=public_Trip&page=2">2</a></li>';
                                echo '<li><a class="button" href="index.php?action=public_Trip&page=3">3</a></li>';
                            }
                            else
                            {
                                echo '<li><a class="button" href="index.php?action=public_Trip&page='.($_GET['page']-1).'">'.($_GET['page']-1).'</a></li>';
                                echo '<li><a class="button special" href="index.php?action=public_Trip&page='.$_GET['page'].'">'.$_GET['page'].'</a></li>';
                                echo '<li><a class="button" href="index.php?action=public_Trip&page='.($_GET['page']+1).'">'.($_GET['page']+1).'</a></li>';
                            }

                        ?>
				    </ul>
                </div>
			</div>
		</section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";