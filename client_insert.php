<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server.php?wsdl");
    
    $data = $client->call("insertAirData",array('roomid'=> 4, 'time' => '2018-10-23', 'temperature'=> 25.65, 'humidity'=> 12.22));
    
    // $xml=simplexml_load_string($data);
    
    print_r($data);
   
?>

