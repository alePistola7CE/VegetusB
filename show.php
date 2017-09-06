<?php
$stazione1="";
$stazione2="";
$par = isset($_GET['par']) ? $_GET['par'] : "temperature";
$node = isset($_GET['node']) ? $_GET['node'] : "ID01";
$limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
$intervallo = isset ($_GET['intervallo']) ? $_GET['intervallo'] : 'no';
$dayin = isset($_GET['dayin']) ? $_GET['dayin'] : 'dayin';
$dayfin = isset($_GET['dayfin']) ? $_GET['dayfin'] : 'dayfin';
if (isset($_GET['stazione1'])) {
	$stazione1 = $_GET['stazione1'];
}
if (isset($_GET['stazione2'])) {
	$stazione2 = $_GET['stazione2'];
}
$stazione3 = isset ($_GET['stazione3']) ? $_GET['stazione3'] : 'no';
$stazione4 = isset ($_GET['stazione4']) ? $_GET['stazione3'] : 'no';
if (empty($stazione1) && empty($stazione2)) {
	$stazione1 = "yes";
	$stazione2 = "yes";
}
?>


<div id="show">
	<p class="subtitle">Controllo Parametri "Serra" - Progetto di "Internet of Things"</p>
  <hr>
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
  if (parametro_sub == "Show"){
    var link = document.getElementById("topmenu");
    link.children[0].children[1].children[0].id = "actualpage";
    link.children[0].children[0].children[0].id = "";
    link.children[0].children[2].children[0].id = "";
  }
  </script>

<div id="contenitore_blu">
  <div class="diagramblock blue">
  	<form action="index.php" method="get">
  		<input type="hidden" name="sub" value="Show">
  		<div class="col_sx">
				<fieldset>
					<legend>Selezione date</legend>
  				<div class="prima_riga">
  					<label>Data iniziale:</label>
  					<input type="date" size="30"  name="dayin"  value=<?php echo "$dayin"?>>
  				</div>
  				<div class="seconda_riga">
  					<label>Data finale:</label>
  					<input type="date" name="dayfin" value=<?php echo "$dayfin"?>>
  				</div>
				</fieldset>
				<fieldset>
					<legend>Selezione sensori</legend>
  				<div class="terza_riga">
  					<span class="riga_checkboxe"><input type="checkbox" name="stazione1" value="yes" style="width:20px;height:20px;" <?php if ($stazione1 == "yes") echo "checked"; ?> ><label> Stazione 1</label> </span>
  					<span class="riga_checkboxe"><input type="checkbox" name="stazione2" value="yes" style="width:20px;height:20px;" <?php if ($stazione2 == "yes") echo "checked"; ?> ><label> Stazione 2</label> </span>
  				</div>
  				<div class="quarta_riga">
  					<span class="riga_checkboxe"><input type="checkbox" name="stazione3" value="no" disabled style="width:20px;height:20px;" <?php if ($stazione3 == "yes") echo "checked"; ?> ><label>Stazione 3</label></span>
  					<span class="riga_checkboxe"><input type="checkbox" name="stazione4" value="no" disabled style="width:20px;height:20px;" <?php if ($stazione4 == "yes") echo "checked"; ?> ><label>Stazione 4</label></span>
  				</div>
				</fieldset>
  		</div>

  		<div class="col_dx">
				<fieldset>
					<legend>Selezione parametri</legend>
  				<div class="prima_riga_1">
  					<label>Selezione periodo:</label>
  					<select name="limit" class="limit">
  						<option value="20">Ultime 20 rilevazioni</option>
  						<option value="50">Ultime 50 rilevazioni</option>
  						<option value="g">Giorno</option>
  						<option value="s">Ultimi 7 giorni</option>
  						<option value="m">Ultimi 30 giorni</option>
  						<option value="interv">Selezione Date</option>
  					</select>
  				</div>
  				<div class="seconda_riga_2">
						<div>
  					<label>Parametro</label>
					</div>
  					<select name="par[]" class="par" multiple="multiple" size="6">
  						<option value="temperature">Temperatura ambiente</option>
  						<option value="humidity">Umidita' ambiente</option>
  						<option value="pressure">Pressione atmosferica</option>
  						<option value="soil1">"Soil Moisture Tension"</option>
  						<option value="battery">Livello Batteria Nodo</option>
  					</select>
  				</div>
  				<div class="terza_riga_3">
  					<p class="hint">Puoi selezionare più elementi tenendo premuto "control"</p>
  				</div>
				</fieldset
  			<div class="quarta_riga_4">
  				<input type="submit" value="Aggiorna">
  			</div>
  		</div>
  	</form>



  <script>
	//va aggiornato non esistono più gli id!!!
  var elem1 = document.getElementByClassName("limit");
  var opts1 = elem1[1].options;
  for (i = 0; i < opts1.length; i++)
  {
      if (opts1[i].value == "<?php echo $limit; ?>")
      {
          opts1.selectedIndex = i;
      }
  }

  var elem2 = document.getElementByClassName("par");
  var opts2 = elem2[1].options;
  for (i = 0; i < opts2.length; i++)
  {
      if (opts2[i].value == "<?php echo $par; ?>")
      {
          opts2[i].selected = true;
      }
  }

</script>
</div>
<div style="clear:left;">
	<label style="margin-left:7px"> Valori per Nodo ID02 e ID01 </label>
</div>
<?php
require('config.php');
// ----------------------------------------------
//$servername = "localhost";
//$username = "root";
//$password = "alenico";
//$database = "serra01";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}


//INIZIO DELLA COSTRUZIONE DELLE QUERY
//parametri selezionati
$par = [];
if (isset($_GET['par'])){
	foreach ($_GET['par'] as $param) {
		$par[] = $param;
	}
	}else{
		$par = ["node", "indice", "temperature", "humidity", "pressure", "soil1", "dataOra", "battery"];
}

//scelta del Nodo
$node = $stazione1 == 'yes' ? "ID01" : "ID02";
if ($stazione1 == "yes" && $stazione2 == "yes"){
	$node = "both";
}

//------------Query per giorno------------
if ($limit == "g"){
	$sql = "SELECT node, indice, dataOra, ";
	//aggiungo i parametri alla query
	foreach ($par as $parametro) {
		$last = end($par);  //copio l'ultimo elemento in modo che durante il foreach riesca a capire se sia l'ultimo parametro e non aggiungere la virgola
		if ($parametro == $last){
			$sql .= $parametro. " from tbl_waspdata";
		} else {
			$sql .= $parametro .", ";
		}
	}
	//aggiungo il nodo
	if (isset($node) && $node !="both"){
		$sql .= " WHERE node = '".$node."'";
	}
	//aggiorno la data ad oggi
	$sql .= " AND DATE FORMAT(dataOra, '%Y-%m-%d') = CURDATE();";
}


//------------Query per ultima settimana------------
if ($limit == "s"){
	$sql = "SELECT node, indice, dataOra, ";
	//aggiungo i parametri della query
	foreach ($par as $parametro) {
		$last = end($par);  //copio l'ultimo elemento in modo che durante il foreach riesca a capire se sia l'ultimo parametro e non aggiungere la virgola
		if ($parametro == $last){
			$sql .= $parametro. " from tbl_waspdata";
		} else {
			$sql .= $parametro .", ";
		}
	}
	//aggiungo il nodo
	if (isset($node) && $node != "both"){
		$sql .= " WHERE node= '" .$node."'";
	}
	//aggiungo l'ultima settimana
	$sql .= " AND dataOra BETWEEN NOW() - INTERVAL 7 DAY AND NOW();";
}



//------------Query per il mese (ultimi 30 giorni)------------
if ($limit=="m"){
			$sql = "SELECT node, indice, dataOra, ";
			//aggiungo i parametri della query
			foreach ($par as $parametro) {
				$last = end($par);  //copio l'ultimo elemento in modo che durante il foreach riesca a capire se sia l'ultimo parametro e non aggiungere la virgola
				if ($parametro == $last){
					$sql .= $parametro. " from tbl_waspdata";
				} else {
					$sql .= $parametro .", ";
				}
			}
			//aggiungo il nodo
			if (isset($node) && $node != "both"){
				$sql .= " WHERE node= '" .$node."'";
			}
			//aggiungo l'ultima settimana
			$sql .= " AND dataOra BETWEEN NOW() - INTERVAL 30 DAY AND NOW();";
		}
//------------Query per intervallo tra date specificate------------
	if ($limit=="interv")
			{
				$sql = "SELECT node, indice, dataOra, ";
				//aggiungo i parametri della query
				foreach ($par as $parametro) {
					$last = end($par);  //copio l'ultimo elemento in modo che durante il foreach riesca a capire se sia l'ultimo parametro e non aggiungere la virgola
					if ($parametro == $last){
						$sql .= $parametro. " from tbl_waspdata";
					} else {
						$sql .= $parametro .", ";
					}
				}
				//aggiungo il nodo
				if (isset($node) && $node != "both"){
					$sql .= " WHERE node= '" .$node."'";
				}
				//aggiungo le date
				$sql .= "AND dataOra BETWEEN '".$dayin."' AND '".$dayfin."';";
			}


//------------Query per numero di valori------------
	if($limit =="20" || $limit =="50"){
		$sql = "SELECT node, indice, dataOra, ";
		//aggiungo i parametri della query
		foreach ($par as $parametro) {
			$last = end($par);  //copio l'ultimo elemento in modo che durante il foreach riesca a capire se sia l'ultimo parametro e non aggiungere la virgola
			if ($parametro == $last){
				$sql .= $parametro. " from tbl_waspdata";
			} else {
				$sql .= $parametro .", ";
			}
		}
		//aggiungo il nodo
		if (isset($node) && $node != "both"){
			$sql .= " WHERE node= '" .$node."'";
		}
		//aggiungo il limite
		$sql .= " order by id desc limit ".$limit;
	}



//controllo se mancano alccuni parametri, in caso li aggiungo
if (!in_array("dataOra", $par)){
	$par[] = "dataOra";
}
if (!in_array("node", $par)){
	$par[]= "node";
}
if (!in_array("indice", $par)){
	$par[] = "indice";
}

$parametri_ordinati = [];
$table_head = [];
$param_head = array("node"=>"Nodo", "indice"=>"Indice", "temperature"=>"Temperatura", "humidity"=>"Umidità", "pressure"=>"Pressione", "soil1"=>"Aridità suolo", "dataOra"=>"Data-ora", "battery"=>"Batteria");
$result = mysqli_query($conn, $sql);
//riordino i parametri
foreach ($param_head as $chiave => $valore) {
	if (in_array($chiave, $par))
	$parametri_ordinati[] = $chiave;
}
//prendo i parametri scelti dall'utente copiando il loro valore (la legenda della table)
foreach ($param_head as $chiave => $valore) {
	if (in_array($chiave, $par)){
		$table_head[] = $valore;
	}
}


//creazione tabella 1 -th

	if (mysqli_num_rows($result) > 0)
	{
			echo "<div id='contenitore_table'>";
	    echo "<table id='tab_show' border=2px>";
	    echo "<tr>";
	    foreach ( $table_head as $value)
	    {
	        echo "<th>$value</th>";
	    }
	    echo "</tr>";
	//riempimento tabella
	    while($row = mysqli_fetch_assoc($result)) //<--- restituisce array associativo riga[valore]
	    {
	        echo "<tr>";
	        foreach ($parametri_ordinati as $value)
	        {
	            echo "<td>$row[$value]</td>";
	        }
	        echo "</tr>";
	    }

	}
	else
	{
	    echo "ooops...";
	}




if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result1) > 0){
  echo"</table>";
	echo "</div>";
}

echo "<hr>";
mysqli_close($conn);

?>
</div>
