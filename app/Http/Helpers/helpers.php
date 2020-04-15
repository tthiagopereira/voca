<?php

function corAleatoria()
{
    $cores = [
        "#FFFFFF", "#CCCCCC", "#999999", "#666666", "#333333", "#000000", "#003366", "#336699", "#3366CC", "#003399", "#000099", "#0000CC",
        "#000066", "#006666", "#006699", "#0099CC", "#0066CC", "#0033CC", "#0000FF", "#3333FF", "#333399", "#669999", "#009999", "#33CCCC",
        "#00CCFF", "#0099FF", "#0066FF", "#3366FF", "#3333CC", "#666699", "#666699", "#339966", "#00CC99", "#00FFCC", "#00FFFF", "#33CCFF",
        "#3399FF", "#6699FF", "#6666FF", "#6600FF", "#6600CC", "#339933", "#00CC66", "#00FF99", "#66FFCC", "#66FFFF", "#66CCFF", "#99CCFF",
        "#9999FF", "#9966FF", "#9933FF", "#9900FF", "#006600", "#00CC00", "#00FF00", "#66FF99", "#99FFCC", "#CCFFFF", "#CCCCFF", "#CC99FF",
        "#CC66FF", "#CC33FF", "#CC00FF", "#9900CC", "#003300", "#009933", "#33CC33", "#66FF66", "#99FF99", "#CCFFCC", "#FFFFFF", "#FFCCFF",
        "#FF99FF", "#FF66FF", "#FF00FF", "#CC00CC", "#660066", "#336600", "#009900", "#66FF33", "#99FF66", "#CCFF99", "#FFFFCC", "#FFCCCC",
        "#FF99CC", "#FF66CC", "#FF33CC", "#CC0099", "#993399", "#333300", "#669900", "#99FF33", "#CCFF66", "#FFFF99", "#FFCC99", "#FF9999",
        "#FF6699", "#FF3399", "#CC3399", "#990099", "#666633", "#99CC00", "#CCFF33", "#FFFF66", "#FFCC66", "#FF9966", "#FF6666", "#FF0066",
        "#CC6699", "#993366", "#999966", "#CCCC00", "#FFFF00", "#FFCC00", "#FF9933", "#FF6600", "#FF5555", "#CC0066", "#660033", "#996633",
        "#CC9900", "#FF9900", "#CC6600", "#FF3300", "#FF0000", "#CC0000", "#990033", "#663300", "#996600", "#CC3300", "#993300", "#990000",
        "#880000", "#993333", "#6699CC", "#333366", "#000033", "#99FFFF", "#00CCCC", "#66CCCC", "#99CCCC", "#66CC99", "#99CC66", "#99CC99",
        "#66CC66", "#33CC66", "#33FF66", "#339900", "#669966", "#336633", "#009966", "#33CC00", "#66CC00", "#CCFF00", "#CCCC99", "#CCCC66",
        "#999900", "#666600", "#CC9966", "#330000", "#CC6633", "#CC9933", "#CC0033", "#CC6666", "#CC9999", "#996666", "#663333", "#660000",
        "#990066", "#FF0099", "#FF33FF", "#CC66CC", "#CC33CC", "#663366", "#996699", "#CC99CC", "#9999CC", "#6633CC", "#6666CC", "#9966CC",
        "#9933CC", "#663399", "#330066", "#660099", "#330033"
    ];

    return $cores[rand(0, (count($cores) - 1))];
}


function dataDeHoje(){
    $data = date('Y-m-d');
    return $data;
}

function pingaIp($ip) {
    $pingresult = exec("/bin/ping -c2 -w2 $ip", $outcome, $status);
    if ($status==0) {
        $status = "Ok";
    } else {
        $status = "Desligado";
    }
    return $status;
}

function pegaip(){
    $meuip =$_SERVER["REMOTE_ADDR"];
    return $meuip;
}

// guiche de atendimento
function retornaguiche($id){

    $guiche = \App\Models\Guiche::find($id);
    return $guiche->identification;

}

