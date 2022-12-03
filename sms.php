<?php
require 'db.php';
$sql = 'SELECT * FROM people WHERE `status`="Active"';
$statement = $connection->prepare($sql);
$statement->execute();
$person = $statement->fetch(PDO::FETCH_OBJ);
 ?>

<?php
$msg="Dear ".$person->name." Child is getting a pee!!!!";
$curl = curl_init();

curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mista.io/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('to' =>$person->mobile,'from' =>'Baby status','unicode' =>'0','sms'=>$msg,'action'=>'send-sms'),
        CURLOPT_HTTPHEADER => array('x-api-key: 151|bdEmomvcMLCIoRqQ8briK04a50MI6o6jW8sJnTcw '
        ),
));

$response = curl_exec($curl);
echo $response;
curl_close($curl); 
?>