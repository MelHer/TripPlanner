<?php
    ob_start();
?>

<div class="row">
    <div class="12u">
        <!-- Text -->
        <section class="box">
        </section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template_Home.php";