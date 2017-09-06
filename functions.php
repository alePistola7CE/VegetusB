<?php

function createGraph($nodeName, $width, $height, $labelArray, $dataUnit, $dataArray, $red, $green, $blue) {

    echo "<canvas id=\"".$nodeName."\" width=\"".$width."\" height=\"".$height."\"></canvas>";
    echo "<script>";
    echo "var ctx = document.getElementById(\"".$nodeName."\");";
    echo "var myChart = new Chart(ctx, {";
    echo "type: 'line',";
    echo "data: {";
    echo "labels: [";
    
    foreach ($labelArray as $value) {
        echo "'$value',";
    }

    echo "],";
    echo "datasets: [{";
    echo "label: '".$dataUnit."',";
    echo "data: [";
    
    foreach ($dataArray as $value) {
        echo "$value,";
    }
    
    echo "],";
    echo "backgroundColor: [";
    echo "'rgba(".$red.", ".$green.", ".$blue.", 0.2)'";
    echo "],";
    echo "borderColor: [";
    echo "'rgba(".$red.", ".$green.", ".$blue.", 1)'";
    echo "],";
    echo "borderWidth: 1";
    echo "}]";
    echo "},";
    echo "options: { scales: { yAxes: [{ ticks: { beginAtZero:false } }]        }     }";
    echo "});";
    echo "</script>";

}

// -----------------------------------------------------------------------------------------------------------------------------


function lastSent($conn, $node) {
    
    $cucu =  "select MAX(dataOra) as ddd from tbl_waspData where node = '".$node."'";
    $res = mysqli_query($conn, $cucu);
    
    $dat = mysqli_fetch_assoc($res);
    $x = $dat['ddd'];
    if ($x === NULL)
    {
        echo "Mai!";
    }
    else
    {
        echo $x;
    }
}

?>
