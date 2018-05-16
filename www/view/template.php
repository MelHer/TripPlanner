<!DOCTYPE HTML>

<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Trip Planner</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<link rel="stylesheet" href="assets/css/additional.css" /> <!--Short css adjustments-->
		
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="index.php?action=home">Trip Planner</a></h1>
					<nav id="nav">
						<ul>
                            <?php if(isset($_SESSION['user'])){ ?>
                            <li><h5 class="head_Text">Bonjour <?php echo $_SESSION['nickname'];?></h5></li>
                            <?php } ?>
							<li><a href="#">Voyages publics</a></li>
							
							<!-- Dynamic menu-->
							<?php if(isset($_SESSION['user'])){ ?>
								<li><a href="#">Mes voyages</a></li>
								<li>
									<a href="#" class="icon fa-angle-down">Mon compte</a>
									<ul>
										<li><a href="index.php?action=change_Password">Changer mot de passe</a></li>
										<li><a href="index.php?action=delete_Account">Supprimer le compte</a></li>
									</ul>
								</li>
								<li><a href="index.php?action=logout" class="button special">Déconnexion</a></li>
							<?php }else{ ?>
								<li><a href="index.php?action=register">Inscription</a></li>
								<li><a href="index.php?action=login" class="button special">Connexion</a></li>
							<?php } ?>

						</ul>
					</nav>
				</header>

            <!-- Content -->
                <section id="main" class="container">
                    <?=$contenu ?>
                </section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
                        <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><br><br>
                        <div>Plane icon by <a href="https://www.flaticon.com/authors/graphberry" title="GraphBerry">GraphBerry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
                        <div>Sun icon by <a href="https://www.flaticon.com/authors/pause08" title="Pause08">Pause08</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
                        <div>Park and house iconby <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
						<div>Concept réalisé par Herzig Melvyn</div>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script> 
			<script src="assets/js/jquery.scrollgress.min.js"></script> 
			<script src="assets/js/skel.min.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/util.js"></script>
			
			<script src="assets/js/main.js"></script>

	</body>
</html>