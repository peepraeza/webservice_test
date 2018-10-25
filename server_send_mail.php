<?php
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('maildata', 'urn:maildata');

// Register the data structures used by the service
$server->wsdl->addComplexType(
    'MailData',
    'complexType',
    'struct',
    'sequence',
    '',
    array(
        'name' => array('name' => 'name', 'type' => 'xsd:string'),
        'addr' => array('name' => 'addr', 'type' => 'xsd:string'),
        'weight' => array('name' => 'weight', 'type' => 'xsd:float')
    )
);

// $server->wsdl->addComplexType(
//  'Hobby',
//  'complexType',
//  'array',
//  '',
//  'SOAP-ENC:Array',
//   array(),
//   array(
//     array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'xsd:string[]')
//   ),
//   'xsd:string'
// );

// $server->wsdl->addComplexType(
//     'Hobby',
//     'complexType',
//     'array',
//     'sequence',
//     '',
//     array(
//         'hobby' => array('name' => 'hobby', 'type' => 'xsd:string[]'))
// );

$server->wsdl->addComplexType(
    'SentMail',
    'complexType',
    'struct',
    'sequence',
    '',
    array(
        'id' => array('name' => 'id', 'type' => 'xsd:integer'),
        'name' => array('name' => 'name', 'type' => 'xsd:string'),
        'addr' => array('name' => 'addr', 'type' => 'xsd:string'),
        'weight' => array('name' => 'weight', 'type' => 'xsd:float')
    )
);

//Define the method as a PHP function
function send_mail($data) {
    $dbcon =  mysqli_connect('localhost', 'peepraeza', '', 'maildata') or die('not connect database'.mysqli_connect_error());
    mysqli_set_charset($dbcon, 'utf8');
    $name = $data['name'];
    $addr = $data['addr'];
    $weight = $data['weight'];

    $query = "INSERT INTO data (id, name, addr, weight, status) VALUES('','$name','$addr','$weight', 'false')";
    $result = mysqli_query($dbcon, $query);
    mysqli_close($dbcon);
    $send = "add data complete!";
    return $send;
}

//Register the method to expose
$server->register('send_mail',           // method name
    array('data' => 'tns:MailData'),     // input parameters
    array('return' => 'xsd:string'),    // output parameters
    'urn:maildata');

function sent_mail_already($data) {
    $dbcon =  mysqli_connect('localhost', 'peepraeza', '', 'maildata') or die('not connect database'.mysqli_connect_error());
    mysqli_set_charset($dbcon, 'utf8');
    $name = $data['name'];
    $addr = $data['addr'];
    $weight = $data['weight'];
    $query = "SELECT * FROM data WHERE name = '$name' and addr = '$addr' and weight = '$weight'";
    $result = mysqli_query($dbcon, $query);
    if($result){
       $query = "UPDATE data SET status = 'true' WHERE id = '$id'and name = '$name' and addr = '$addr' and weight = '$weight'";
       $result = mysqli_query($dbcon, $query);
        }
    
    mysqli_close($dbcon);
   return "sent mail already and status updated";
}

//Register the method to expose
$server->register('sent_mail_already',           // method name
    array('data' => 'tns:SentMail'),
    array('return' => 'xsd:string'),    // output parameters
                        'urn:maildata');         

function check_status($data) {
    $dbcon =  mysqli_connect('localhost', 'peepraeza', '', 'maildata') or die('not connect database'.mysqli_connect_error());
    mysqli_set_charset($dbcon, 'utf8');
    $id = $data['id'];
    $name = $data['name'];
    $addr = $data['addr'];
    $weight = $data['weight'];
    $query = "SELECT * FROM data WHERE name = '$name' and addr = '$addr' and weight = '$weight'";
    $result = mysqli_query($dbcon, $query);
    if($result){
        $data = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array('name'=>$row['name'], 'addr'=>$row['addr'], 'weight'=>$row['weight'], 'status'=>$row['status']);
        }
    }
    
    mysqli_close($dbcon);
    return array('MailStatus' => $data);
}

//Register the method to expose
$server->register('check_status',           // method name
    array('data' => 'tns:MailData'),
    array('return' => 'tns:MailStatus'),    // output parameters
                        'urn:maildata');         



// Use the request to (try to) invoke the service
@$server->service(file_get_contents("php://input"));
?>