<div  id="informazioni">

	<script>
	function parseGetVars()
	{
		// creo una array
		var args = new Array();
		var query = window.location.search.substring(1);
		// se c'è una querystring procedo alla sua analisi
		if (query)
		{
			// divido la querystring in blocchi sulla base del carattere &
			var strList = query.split('&');
			// faccio un ciclo per leggere i blocchi individuati nella querystring
			for(str in strList)
			{
				// divido ogni blocco mediante il simbolo uguale
				var parts = strList[str].split('=');
				// inserisco nella array args l'accoppiata nome = valore di ciascun
				// parametro presente nella querystring
				args[unescape(parts[0])] = unescape(parts[1]);
			}
		}
		return args;
	}

	var get = parseGetVars();
	var parametro_sub = get['sub'];
	if (parametro_sub == "Informazioni"){
		var link = document.getElementById("topmenu");
		link.children[0].children[2].children[0].id = "actualpage";
		link.children[0].children[1].children[0].id = "";
		link.children[0].children[0].children[0].id = "";
	}
	</script>

	<div id="text">
		<h1 style="margin-top:10px;">Smart Agricolture Project - Vegetus Lab</h1>
		<p>E' una strategia gestionale dell'agricoltura che si avvale di moderne strumentazioni ed è mirata all'esecuzione
			 di interventi agronomici tenendo conto delle effettive esigenze colturali e
		   delle caratteristiche biochimiche e fisiche del suolo.</p>
		<hr>
		<h1>Caratteristiche del progetto Vegetus </h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
			 magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
			 aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
		<h1>IoT e futuro</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
			 magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			 Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<hr>
		<h1>Controllo dei dati 24h su 24h</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
			 dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
			 commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
			 nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
			 anim id est laborum.</p>
	</div>





	<div class="vcard" style="clear:left;">
	<img src="images/chip.png" alt="materiale e dispense" style="width:100%;">
		<!-- <img src="images/materiale.jpg" alt="materiale e dispense" style="width:100%"> -->
		<div class="vcardtext">
			<h1>PARAMETRI TECNICI DELLE MISURAZIONI</h1>
			<br>
			<ul>
				<li>Temperatura dell'aria</li>
				<li>Pressione atmosferica</li>
				<li>Umidita' dell'aria</li>
				<li>Aridita' del terreno - "Soil Moisture Tension"</li>
			</ul>
		</div>
	</div>

	<div class="vcard">
		<img src="images/ondetraspighe.jpg" alt="codice sorgente" style="width:100%;">
		<div class="vcardtext">
			<h1>INFORMAZIONI</h1>
			<br>
			<ul>
				<li>Smart Agricolture</li>
				<li>IoT e futuro</li>
				<li>Controllo dati 24h su 24h</li>
				<li>Avvertimenti anomalie real time</li>
			</ul>
		</div>
	</div>

	<div id="contenitore_vcard">
		<div class="vcard" style="clear:right;">
			<img src="images/alertvcard.png" alt="messaging alert" style="width:100%;">
			<div class="vcardtext">
				<h1>REAL TIME ALERT</h1>
				<br>
				<ul>
					<li>Controllo dati ora per ora</li>
					<li>Rilevamento anomalie automatico</li>
					<li>Avviso per email immediato</li>
			</div>
		</div>

</div>
</div>
