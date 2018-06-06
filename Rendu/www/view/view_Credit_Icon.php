<?php
    ob_start();
?>
<header>
	<h2>Crédits des icônes</h2>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
			<div class="table-wrapper">
				<table id="simple_Table">
				    <tbody>
                        <tr>
                            <td><img src="images/default_Trip.png"/></td>
                            <td align="center">Icône par <a href="https://www.flaticon.com/authors/pause08" title="Pause08">Pause08</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></td>
                        </tr>
                        <tr>
                            <td><img src="images/default_Transport.png"/></td>
                            <td align="center">Icône par <a href="https://www.flaticon.com/authors/graphberry" title="GraphBerry">GraphBerry</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></td>
                        </tr>
                        <tr>
                            <td><img src="images/default_Lodging.png"/></td>
                            <td align="center">Icône par <a href="http://www.freepik.com" title="Freepik">Freepik</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></td>
                        </tr>
                        <tr>
                            <td><img src="images/default_Activity.png"/></td>
                            <td align="center">Icône par <a href="http://www.freepik.com" title="Freepik">Freepik</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></td>
                        </tr>
                        <tr>
                            <td><img src="images/delete.png"/></td>
                            <td align="center">Icône par <a href="http://www.freepik.com" title="Freepik">Freepik</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></td>
                        </tr>
                        <tr>
                            <td><img src="images/edit.png"/></td>
                            <td align="center">Icône par <a href="https://www.flaticon.com/authors/hanan" title="Hanan">Hanan</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></td>
                        </tr>
                        <tr>
                            <td><img src="images/accept.png"/></td>
                            <td align="center"><div>Icône par <a href="http://www.freepik.com" title="Freepik">Freepik</a> de <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> sous licence <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC 3.0 BY</a></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row uniform 50%">
				<div class="12u" align="center">
					<ul class="actions">
                        <li><a class="button" href="index.php?action=home">Accueil</a></li>	
					</ul>
				</div>
			</div>
		</section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";