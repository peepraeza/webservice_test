<?php
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
// Create the server instance
$server = new soap_server();
// Initialize WSDL support
$server->configureWSDL('studentdata', 'urn:studentdata');

// Register the data structures used by the service
$server->wsdl->addComplexType(
    'StudentData',
    'complexType',
    'struct',
    'sequence',
    '',
    array(
        'stdname' => array('name' => 'stdname', 'type' => 'xsd:string'),
        'stdnumber' => array('name' => 'stdnumber', 'type' => 'xsd:string'),
        'stdhobby' => array('name' => 'stdhobby', 'type' => 'tns:Hobby')
    )
);

$server->wsdl->addComplexType(
 'Hobby',
 'complexType',
 'array',
 '',
 'SOAP-ENC:Array',
  array(),
  array(
    array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'xsd:string[]')
  ),
  'xsd:string'
);

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
    'GetStudentData',
    'complexType',
    'struct',
    'sequence',
    '',
    array(
        'GetStudentData' => array('name' => 'GetStudentData','minOccurs'=> '0', 'maxOccurs' =>'unbounded','nillable' => 'true', 'type'=>'tns:StudentData')
    )
);

// Define the method as a PHP function
// function set_data($data) {
//     $dbcon =  mysqli_connect('localhost', 'peepraeza', '', 'aircondata') or die('not connect database'.mysqli_connect_error());
//     mysqli_set_charset($dbcon, 'utf8');
//     $roomid = $data['roomid'];
//     $time = $data['time'];
//     $temperature = $data['temperature'];
//     $humidity = $data['humidity'];
//     $query = "INSERT INTO data (roomid, time, temperature, humidity) VALUES('$roomid','$time','$temperature','$humidity')";
//     // $query = "INSERT INTO data_table(room, time, temp, humidity) VALUES('01', '12-09-2016 05:00', '22.5', '10.2')";
//     $result = mysqli_query($dbcon, $query);
//     mysqli_close($dbcon);
//     $send = "add data complete!";
//     return $send;
// }

// Register the method to expose
// $server->register('set_data',           // method name
//     array('data' => 'tns:AirData'),     // input parameters
//     array('return' => 'xsd:string'),    // output parameters
//     'urn:airdata');

function get_std_data($room) {
    // $dbcon =  mysqli_connect('localhost', 'peepraeza', '', 'aircondata') or die('not connect database'.mysqli_connect_error());
    // mysqli_set_charset($dbcon, 'utf8');
    // $query = "SELECT * FROM data";
    // $result = mysqli_query($dbcon, $query);
    // if($result){
    //     $data = array();
    //     while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    //         $data[] = array('roomid'=>$row['roomid'], 'time'=>$row['time'], 'temperature'=>$row['temperature'], 'humidity'=>$row['humidity']);
    //     }
    // }
    
    // mysqli_close($dbcon);
    $data[] = array("stdname"=> "Peerawit Wandech", "stdnumber" => "5801012620054", "stdhobby" => array('Play tabletennis', 'Basketball'));
    return array('GetStudentData' => $data);
}

// Register the method to expose
$server->register('get_std_data',           // method name
    array('data' => 'xsd:string'),
    array('return' => 'tns:GetStudentData'),    // output parameters
                        'urn:studentdata');         


// Use the request to (try to) invoke the service
@$server->service(file_get_contents("php://input"));
?>