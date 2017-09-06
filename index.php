<!DOCTYPE html>
<html lang="it">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="HandheldFriendly" content="true" />
		<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
		<meta name="keywords" content="IoT, Smart Agriculture, Sensor, aesilab"/>
		<meta name="Description" content="Vegetus IoT" />

		<title>Vegetus</title>

		<link rel="stylesheet" type="text/css" href="style.css" media="all">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">


		<!-- <link rel="icon" href="images/IoT.png" type="image/x-icon"> -->
		<!--<link rel="icon" href="immagini/logo_aesilab_prova.png" type="image/x-icon">-->
		<link rel="icon" href="images/logo16.png" type="image/x-icon">
		<script src="code.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

		<!-- jQuery, -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<!-- fotorama.css & fotorama.js. -->
		<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->

</head>


<body>

	<div id="container">
		<img id="logo" src="images/logoAEsilab2.png" alt="logo">


		<div id="topmenu" class="topmenu">
    	<ul>
    		<li><a href="?sub=Grafici" id="actualpage">Grafici</a></li>
    		<li><a href="?sub=Show">Dati</a></li>
				<li><a href="?sub=Informazioni">Informazioni</a></li>
     		<li class="icon"><a href="javascript:void(0);" onclick="showMenu()">&#9776;</a></li>
    	</ul>
		</div>


	<div id="header">

	 <!-- FOTORAMA CAROUSEL -->
		<div class="fotorama" data-autoplay="true" data-loop="true">
			<img src="images/monitoring_slide.jpg" alt="data monitoring">
			<img src="images/how_to_slide.jpg" alt="how to grow">
			<img src="images/process_of_growing_slide.jpg" alt="growing process">
		</div>

	</div> <!-- HEADER -->



<!-- CONTENT -->
	<div id="content" style="min-height:540px;">

		<?php
		if ( !$_GET )
    	include("grafici.php");
		else
		{
    $sub = $_GET["sub"];
   	switch ($sub)
    {
    case "Grafici":
        include("grafici.php");
        break;
    case "Informazioni":
        include("informazionitecniche.php");
        break;
    case "Show":
        include("show.php");
        break;
    default:
		include("grafici.php");
        break;
    }
}

?>

	</div><!-- CONTENT -->


	</div><!-- CONTAINER -->


	<div id="footerWrap">
		<div id="footer_text">
			<p>"Vegetus - Smart Agriculture Project - aesilab srl</p>
			<p>Contact information: email: <a href="mailto:info@aesilab.com"> info@aesilab.com </a> mobile: +39 338 9896878</p>
			<p class = "subFoot">Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></p>
			<p class = "subFoot">Photos designed by <a href="http://www.freepik.com" title="Freepik">Freepik</a> :
				<a href="http://it.freepik.com/foto-gratuito/serra-con-le-colture-verdi_904138.htm"> 1 </a> -
				<a href="http://it.freepik.com/foto-gratuito/tempo-di-lavoro-del-giardino_1181236.htm"> 2 </a> -
				<a href="http://it.freepik.com/foto-gratuito/piantina-nuova-primavera-della-foresta-del-bambino_1150268.htm"> 3 </a> -
				<a href="http://it.freepik.com/foto-gratuito/grafici-finanziari-con-la-matita-sul-tavolo_1017714.htm"> 4 </a> -
				<a href='http://it.freepik.com/vettori-gratuito/sirene-della-polizia-vettoriale_746451.htm'>5</a> -
				<a href="http://it.freepik.com/vettori-gratuito/confezione-di-pulsanti-di-contatto-e-le-icone_1064098.htm">6</a>
			</p>
		</div>
	</div>


</body>
</html>
