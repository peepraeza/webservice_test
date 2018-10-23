<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server.php?wsdl");
    
    $data = $client->call("getInfoAircon",array('lan'=>'en'));
    
    $xml=simplexml_load_string($data);
    
    print_r($xml);
   
?>

