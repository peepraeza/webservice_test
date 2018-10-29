<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server_send_mail.php?wsdl");
    
    $data = array('name'=> "Supitcha", 'addr' => "4/222 Nonthaburi", 'weight'=> 12);
    $result = $client->call("send_mail", array('data' => $data));

    
    print_r($result);
?>

