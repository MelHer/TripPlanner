<?php
    ob_start();
?>

<div class="row">
    <div class="12u">
        <section class="box">
            <!-- Home view is empty but created to add further content if needed -->
        </section>
	</div>
</div>
                    
<?php
$contenu = ob_get_clean();
require "view/template_Home.php";