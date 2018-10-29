<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server2.php?wsdl");
    
    $data = $client->call("get_data",array('userId'=> 1));
    print_r($data);
   
?>