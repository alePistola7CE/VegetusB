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

<div id="main">
	<p class="subtitle">Controllo Parametri "Serra" - Progetto di "Internet of Things"</p>
<div class="diagramblock blue">
	<form action="index.php" method="get">
		<input type="hidden" name="sub" value="Grafici">
		<div class="col_sx">
			<div id="prima_riga">
				<label>Data iniziale:</label>
				<input type="date" size="30"  name="dayin"  value=<?php echo "$dayin"?>>
			</div>
			<div id="seconda_riga">
				<label>Data finale:</label>
				<input type="date" name="dayfin" value=<?php echo "$dayfin"?>>
			</div>
			<div id="terza_riga">
				<input type="checkbox" name="stazione1" value="yes" style="width:20px;height:20px;" <?php if ($stazione1 == "yes") echo "checked"; ?> > Stazione 1
				<input type="checkbox" name="stazione2" value="yes" style="width:20px;height:20px;" <?php if ($stazione2 == "yes") echo "checked"; ?> > Stazione 2
			</div>
			<div id="quarta_riga">
				<input type="checkbox" name="stazione3" value="no" disabled style="width:20px;height:20px;" <?php if ($stazione3 == "yes") echo "checked"; ?> > Stazione 3
				<input type="checkbox" name="stazione4" value="no" disabled style="width:20px;height:20px;" <?php if ($stazione4 == "yes") echo "checked"; ?> > Stazione 4
			</div>
		</div>

		<div class="col_dx">
			<div id="prima_riga_1">
				<label>Selezione periodo:</label>
				<select name="limit" id="limit">
					<option value="20">Ultime 20 rilevazioni</option>
					<option value="50">Ultime 50 rilevazioni</option>
					<option value="g">Giorno</option>
					<option value="s">Ultimi 7 giorni</option>
					<option value="m">Ultimi 30 giorni</option>
					<option value="interv">Selezione Date</option>
				</select>
			</div>
			<div id="seconda_riga_2">
				<label>Parametro</label>
				<select name="par" id="par">
					<option value="temperature">Temperatura ambiente</option>
					<option value="humidity">Umidita' ambiente</option>
					<option value="pressure">Pressione atmosferica</option>
					<option value="soil1">"Soil Moisture Tension"</option>
					<option value="battery">Livello Batteria Nodo</option>
				</select>
			</div>
			<div id="terza_riga_3">
				<br >
			</div>
			<div id="quarta_riga_4">
				<input type="submit" value="Aggiorna">
			</div>
		</div>
	</form>


<script>
var elem1 = document.getElementById("limit");
var opts1 = elem1.options;
for (i = 0; i < opts1.length; i++)
{
    if (opts1[i].value == "<?php echo $limit; ?>")
    {
        opts1.selectedIndex = i;
    }
}

var elem2 = document.getElementById("par");
var opts2 = elem2.options;
for (i = 0; i < opts2.length; i++)
{
    if (opts2[i].value == "<?php echo $par; ?>")
    {
        opts2[i].selected = true;
    }
}

</script>
</div>
<?php

// first things first...
//require ('functions.php');
require ('config.php');

// ----------------------------------------------

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//INIZIO DELLA COSTRUZIONE DELLE QUERY
//-----------------------------------------------------------
if($stazione1=="yes") $node="ID01";
if ($limit=="g")  //query per giorno
{
	$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
	if (isset($node) AND $node != "both")
	{
		$sql .= " WHERE node = '".$node."'";
	}
	//$sql .= " AND (dataOra > '2017-04-01' AND dataOra < '2017-05-01') ";
	//$sql .= " AND DATE_FORMAT(dataOra, '%d') = DATE_FORMAT(CURDATE(), '%d')";
	$sql .= " AND DATE_FORMAT(dataOra, '%Y-%m-%d') = CURDATE();";
}
//---------------------------------------------------------------------
else //query per ultima settimana - settimana corrente
	if($limit =="s")
	{
		$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
		if (isset($node) AND $node != "both")
		{
			$sql .= " WHERE node = '".$node."'";
		}
		//$sql .= "AND DATE_FORMAT(dataOra, '%u') = DATE_FORMAT(CURDATE(), '%u')";
		$sql .= "AND dataOra BETWEEN NOW() - INTERVAL 7 DAY AND  NOW();";
	}
//----------------------------------------------------------------------
	else
		if ($limit=="m")  //query per mese ultimo - mese corrente
		{
			$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
			if (isset($node) AND $node != "both")
			{
				$sql .= " WHERE node = '".$node."'";
			}
			//$sql .= " AND (dataOra > '2017-04-01' AND dataOra < '2017-05-01') ";
			//$sql .= "AND DATE_FORMAT(dataOra, '%m') = DATE_FORMAT(CURDATE(),'%m')";
			$sql .= "AND dataOra BETWEEN NOW() - INTERVAL 30 DAY AND  NOW();";
		}
//-----------------------------------------------------------------------
		else
			if ($limit=="interv") //query per intervallo date
			{
				$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
				if (isset($node) AND $node != "both")
				{
					$sql .= " WHERE node = '".$node."'";
				}
			//$sql .= " AND (dataOra >= '2017-06-02' AND dataOra <= '2017-06-04') ";
			//	$sql .= " AND (dataOra >= '".$dayin."' AND dataOra <= '".$dayfin."')";
			$sql .= "AND dataOra BETWEEN '".$dayin."' AND '".$dayfin."';";
			}
			else //query per numero di valori
			{
				$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
				if (isset($node) AND $node != "both")
				{
					$sql .= " WHERE node = '".$node."'";
				}
				$sql .= " order by id desc limit ".$limit;
			}
//------------------FINE DELLA COSTRUZIONE DELLE QUERY --------------------
$result = mysqli_query($conn, $sql);
//---------------------------------------------$result = mysql_query($sql);
 if ( false===$result ) {
  printf("error: %s\n", mysqli_error($conn));
}
else {
  //echo 'done.';
}
$conta = mysqli_num_rows($result);
//echo "<h1>Numero di righe tornate da mysqli_num_rows $conta</h1><br>";

if ($conta > 0)
{
    $i = $conta - 1;
    while($row = mysqli_fetch_assoc($result))
    {
        $timeLabel[$i] = $row["ora"];
        $rowData[$i] = $row[$par];
	$i--;
	}
	//echo "Valore di limit = ".$limit;
    if($limit=="20" || $limit=="50" || $limit =="30")
	{
		// I don't understand why this is the unique way to...
		$timeLabel = array_reverse($timeLabel);
		$rowData = array_reverse($rowData);
	}

}

?>
<!--------------------------------------------->
<!------per ID02------------------------------->
<?php

// first things first...
//require ('functions.php');
require ('config.php');

// ----------------------------------------------

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//INIZIO DELLA COSTRUZIONE DELLE QUERY
//-----------------------------------------------------------
if($stazione2=="yes") $node="ID02";
if ($limit=="g")  //query per giorno
{
	$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
	if (isset($node) AND $node != "both")
	{
		$sql .= " WHERE node = '".$node."'";
	}
	//$sql .= " AND (dataOra > '2017-04-01' AND dataOra < '2017-05-01') ";
	//$sql .= " AND DATE_FORMAT(dataOra, '%d') = DATE_FORMAT(CURDATE(), '%d')";
	$sql .= " AND DATE_FORMAT(dataOra, '%Y-%m-%d') = CURDATE();";
}
//---------------------------------------------------------------------
else //query per ultima settimana - settimana corrente
	if($limit =="s")
	{
		$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
		if (isset($node) AND $node != "both")
		{
			$sql .= " WHERE node = '".$node."'";
		}
		//$sql .= "AND DATE_FORMAT(dataOra, '%u') = DATE_FORMAT(CURDATE(), '%u')";
		$sql .= "AND dataOra BETWEEN NOW() - INTERVAL 7 DAY AND  NOW();";
	}
//----------------------------------------------------------------------
	else
		if ($limit=="m")  //query per mese ultimo - mese corrente
		{
			$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
			if (isset($node) AND $node != "both")
			{
				$sql .= " WHERE node = '".$node."'";
			}
			//$sql .= " AND (dataOra > '2017-04-01' AND dataOra < '2017-05-01') ";
			//$sql .= "AND DATE_FORMAT(dataOra, '%m') = DATE_FORMAT(CURDATE(),'%m')";
			$sql .= "AND dataOra BETWEEN NOW() - INTERVAL 30 DAY AND  NOW();";
		}
//-----------------------------------------------------------------------
		else
			if ($limit=="interv") //query per intervallo date
			{
				$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
				if (isset($node) AND $node != "both")
				{
					$sql .= " WHERE node = '".$node."'";
				}
			//$sql .= " AND (dataOra >= '2017-06-02' AND dataOra <= '2017-06-04') ";
			//	$sql .= " AND (dataOra >= '".$dayin."' AND dataOra <= '".$dayfin."')";
			$sql .= "AND dataOra BETWEEN '".$dayin."' AND '".$dayfin."';";
			}
			else //query per numero di valori
			{
				$sql =  "select DATE_FORMAT(dataOra,'%H:%i') as ora, ".$par." from tbl_waspdata";
				if (isset($node) AND $node != "both")
				{
					$sql .= " WHERE node = '".$node."'";
				}
				$sql .= " order by id desc limit ".$limit;
			}
//------------------FINE DELLA COSTRUZIONE DELLE QUERY --------------------
$result = mysqli_query($conn, $sql);
//---------------------------------------------$result = mysql_query($sql);
 if ( false===$result ) {
  printf("error: %s\n", mysqli_error($conn));
}
else {
  //echo 'done.';
}
$conta = mysqli_num_rows($result);
//echo "<h1>Numero di righe tornate da mysqli_num_rows $conta</h1><br>";

if ($conta > 0)
{
    $i = $conta - 1;
    while($row = mysqli_fetch_assoc($result))
    {
        $timeLabel2[$i] = $row["ora"];
        $rowData2[$i] = $row[$par];
	$i--;
	}
	//echo "Valore di limit = ".$limit;
    if($limit=="20" || $limit=="50" || $limit =="30")
	{
		// I don't understand why this is the unique way to...
		$timeLabel2 = array_reverse($timeLabel2);
		$rowData2 = array_reverse($rowData2);
	}

}

?>


<div id="contenitore_grafici">
		<div id="grafico_1">
			<?php if($stazione1=="yes") echo '
			<table>
				<td id="grandezza_grafico1">		<canvas id="newChart01"></canvas></td>
			</table>';?>
		</div>
		<div id="grafico_2">
			<?php if($stazione2=="yes") echo '
			<table>
				<td id="grandezza_grafico2">		<canvas id="newChart02"></canvas></td>
			</table> ';?>
		</div>
</div>


<!-- script per togliere lo spazio vuoto (derivante dal min-height del #content) in caso tutte e due le
			stazioni siano state disattivate -->
			<script>
				<?php if(($stazione1=="" && $stazione2="") || ($stazione1=="no" && $stazione2=="no")){
					echo'
						var content = document.getElementById("content");
						content.style.minHeight = "250px";';
				}else{
					echo'
						var content = document.getElementById("content");
						content.style.minHeight = "540px";';
				};?>
			</script>



    <script>
    var ctx = document.getElementById("newChart01");
    var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
					<?php
						foreach ($timeLabel as $value)
						{
							echo "'$value',";
						}
					?>
					],
			datasets: [{
				/*label: <?php echo "'$par',"; ?> */
				label: 'Stazione1',
				data: [
					<?php
						foreach ($rowData as $value)
						{
							echo "$value,";
						}
					?>
				],
				backgroundColor: ['rgba(255,99,132,0.2)'],
				borderColor: ['rgba(255,99,132,1)'],

				borderWidth: 1
			}]
		},
	options: {
		responsive: true,
		scales: {
				xAxes: [{
                        display: true,
                        scaleLabel: {
								display: true,
                                labelString: 'Ora Rilevazione'
									}
                        }],
				yAxes: [{
					display: true,
                            scaleLabel: {
                                display: true,
                                labelString: <?php if ($par == 'pressure') echo "'Pressione Atmosferica kPa'";
													else if ($par == 'temperature') echo "'Temperatura C°'";
													else if ($par == 'humidity') echo "'Umidità Aria %'";
													else if ($par == 'soil1') echo "'Pressione capillare kPa'";
													else if ($par == 'battery') echo "'Livello Batteria %'";
											?>
                            },

					ticks: {
				beginAtZero:false,
				<?php if ($par == 'pressure')
							{
								echo "min: 99000,";
								echo "max: 102000";
							}
							else if ($par == 'temperature')
							{
								echo "min: 0,";
								echo "max: 50,";
								//echo "stepSize: 2";
							}
							else if ($par == 'humidity')
							{
								echo "min: 0,";
								echo "max: 100";
							}
							else if ($par == 'soil1')
							{
								echo "min: 0,";
								echo "max: 35,";

							}
							else if ($par == 'battery')
							{
								echo "min: 5,";
								echo "max: 100";
							}

				?>

		 } }]        }


		 }
    });
    </script>
    <script>
	var ctx = document.getElementById("newChart02");
    var myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
					<?php
						foreach ($timeLabel2 as $value)
						{
							echo "'$value',";
						}
					?>
					],
			datasets: [{
				/*label: <?php echo "'$par',"; ?>*/
				label: 'Stazione2',
				data: [
					<?php
						foreach ($rowData2 as $value)
						{
							echo "$value,";
						}
					?>
				],
				backgroundColor: ['rgba(255,99,132,0.2)'],
				borderColor: ['rgba(255,99,132,1)'],

				borderWidth: 1
			}]

		},
	options: { scales: {
				responsive: true,
				xAxes: [{
                        display: true,
                        scaleLabel: {
								display: true,
                                labelString: 'Ora Rilevazione'
									}
                        }],
				yAxes: [{
				display: true,
                            scaleLabel: {
                                display: true,
                                labelString: <?php if ($par == 'pressure') echo "'Pressione Atmosferica kPa'";
													else if ($par == 'temperature') echo "'Temperatura C°'";
													else if ($par == 'humidity') echo "'Umidità Aria %'";
													else if ($par == 'soil1') echo "'Pressione capillare kPa'";
													else if ($par == 'battery') echo "'Livello Batteria %'";
											?>
                            },
				ticks: {
				beginAtZero:false,
				<?php if ($par == 'pressure')
							{
								echo "min: 99000,";
								echo "max: 102000";
							}
							else if ($par == 'temperature')
							{
								echo "min: 0,";
								echo "max: 50,";
								//echo "stepSize: 2";
							}
							else if ($par == 'humidity')
							{
								echo "min: 0,";
								echo "max: 100";
							}
							else if ($par == 'soil1')
							{
								echo "min: 0,";
								echo "max: 35,";

							}
							else if ($par == 'battery')
							{
								echo "min: 5,";
								echo "max: 100";
							}

				?>

		 } }]        }     }


    }							);
    </script>
</div>
