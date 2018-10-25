<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server_send_mail.php?wsdl");
    
    $data = array('name'=> "Peerawit", 'addr' => "6/111 cheunkamol", 'weight'=> 150);
    $result = $client->call("send_mail", array('data' => $data));

    
    print_r($result);
?>

