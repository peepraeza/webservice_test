<?php 
require_once "lib/nusoap.php";
    
    $client = new nusoap_client("http://test-soap-peepraeza.c9users.io/server_test.php?wsdl");
    
    $result = $client->call("get_std_data", array("data"=> "pee"));

    
    print_r($result);
    
   //function defination to convert array to xml
function array_to_xml($array, &$xml_user_info) {
    foreach($array as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml_user_info->addChild("$key");
                array_to_xml($value, $subnode);
            }else{
                $subnode = $xml_user_info->addChild("item$key");
                array_to_xml($value, $subnode);
            }
        }else {
            $xml_user_info->addChild("$key",htmlspecialchars("$value"));
        }
    }
}
   
   
$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><user_info></user_info>");

//function call to convert array to xml
array_to_xml($result,$xml_user_info);

//saving generated xml file
$xml_file = $xml_user_info->asXML('users.xml');

//success and error message based on xml creation
if($xml_file){
    echo 'XML file have been generated successfully.';
}else{
    echo 'XML file generation error.';
}
?>

