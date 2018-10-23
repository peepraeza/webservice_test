<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server.php?wsdl");
    
    $data = $client->call("insertAirData",array('roomid'=> 1, 'time' => '2018-10-24 00:54:00', 'temperature'=> 25.65, 'humidity'=> 12.22));
   
?>

