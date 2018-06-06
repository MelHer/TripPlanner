<?php
    ob_start();
?>
<header>
	<h2>Erreur</h2>
	<p>Aïe, ça ne se passe pas comme prévu</p>
</header>

<div class="row">
    <div class="12u">
        <section class="box">
            <div class="row uniform 50%">
				<!-- Text -->
				<div class="12u 12u(mobilep)">
					<p class="center">Ce que vous recherchez n'existe pas ou n'existe plus. Nous ne pouvons exécuter votre requête.</p>
				</div>
			</div>
			<div class="row uniform 50%">
				<div class="12u" align="center">
					<ul class="actions">
						<li><a class="button" href="index.php?action=home">Retourner au menu</a></li>		
					</ul>
				</div>
			</div>
		</section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template.php";