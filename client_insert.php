<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server2.php?wsdl");
    
    $data = array('roomid'=> 99, 'time' => '2018-10-25 03:56:00', 'temperature'=> 100.22, 'humidity'=> 122.22);
    $result = $client->call("set_data", array('data' => $data));

    
    print_r($result);
?>

