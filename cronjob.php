<?php


/* controllo i DATI
  salvo sul file log.dat l'ora e il giorno del controllo
  se c'è discontinuità nel trend avverto
  mando email
  (va creato il file cronjob)
  */


require('config.php');
$today = date("Y-m-d H:i:s");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

//CALCOLO RANGE PER OUTLIERS

//creazione sql per parametro e nodo
$sql_indice = "SELECT indice FROM tbl_waspdata ORDER BY asc";
$sql_temperatura = "SELECT temperature FROM tbl_waspdata ORDER BY asc"
$sql_umidità = "SELECT humidity FROM tbl_waspdata ORDER BY asc"
$sql_pressione = "SELECT pressure FROM tbl_waspdata ORDER BY asc"
$sql_soil1 = "SELECT soil1 FROM tbl_waspdata ORDER BY asc"
$sql_batteria = "SELECT battery FROM tbl_waspdata ORDER BY asc"

//eseguo le sql
$indici = mysqli_query($conn, $sql_indice);
$temperature = mysqli_query($conn, $sql_temperatura);
$umidità = mysqli_query($conn, $sql_umidità);
$pressioni = mysqli_query($conn, $sql_pressione);
$soil1 = mysqli_query($conn, $sql_soil1);
$batterie = mysqli_query($conn, $sql_batteria);




 ?>
