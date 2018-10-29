<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("https://test-soap-peepraeza.c9users.io/server_send_mail.php?wsdl");
    
    // $data = array('status' => 'false');
    $result = $client->call("get_data_all", array("anything" => "aaa"));
    // $result = $client->call("get_data_from_status", array("status" => "true"));
    
    print_r($result);
?>

