<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server2.php?wsdl");
    
    $result = $client->call("get_data", array("room"=> 33));

    
    print_r($result);
   
?>

