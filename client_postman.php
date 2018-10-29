<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server_send_mail.php?wsdl");
    
    $data = array('id'=> 3, 'name'=> "Pee", 'addr' => "4/222");
    $result = $client->call("sent_mail_already", array('data' => $data));

    
    print_r($result);
?>

