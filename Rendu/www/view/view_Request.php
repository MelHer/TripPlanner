<?php
    ob_start();
?>
<header>
	<h2>Demandes</h2>
	<p>Voici les personnes qui désirent partir avec vous</p>
</header>

<div class="row">
    <div class="12u">        
        <section class="box">
            <!-- Information message -->
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
            <div class="table-wrapper">
				<table id="simple_Table">
				    <tbody>
                        <?php 
                            foreach($requests as $request)
                            {
                                echo '<tr>';
                                echo '<td >'.htmlspecialchars($request['Nickname']).' souhaite venir pour le voyage: '.htmlspecialchars($request['Title']).'</td>';
                                echo "<td><a class='no_Border' href='index.php?action=accept_Request&user=".$request['fkUser']."&trip=".$request['fkTrip']."'><img src='images/accept.png'></a></td><td><a class='no_Border' href='index.php?action=delete_Request&user=".$request['fkUser']."&trip=".$request['fkTrip']."'><img src='images/delete.png'></a></td>";
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
				</table>
			</div>
		</section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";