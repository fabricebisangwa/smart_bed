<?php
require '../connection.php';
$sql = 'SELECT * FROM customer WHERE `status`="Active"';
$statement = $connection->prepare($sql);
$statement->execute();  
$person = $statement->fetch(PDO::FETCH_OBJ);

$names = $person->names;
$num = $person->mobile;
 ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "message";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {  
  die("Connection failed: " . $conn->connect_error);
} else{
    $sql = "SELECT * FROM transaction";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $from = strtotime($row['time']);
            $to = strtotime(date('Y-m-d h:i:s', time()));
            $diff = round(abs($to - $from) / 60,2);
            $now = date('Y-m-d h:i:s', time());
            echo $row['time']."<br>".date('Y-m-d h:i:s', time())."<br>".$diff;
            if ($diff>2) {
                $sql = "UPDATE transaction SET time='$now' WHERE id=1";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                    //message code
                    if ($_SERVER["REQUEST_METHOD"] = "POST" || isset($_POST['temp']) && isset($_POST['hum'])) {
                        $Temperature = $_POST['temp'];
                        $Humidity = $_POST['hum'];
                    
                        $msg = "Temp:".$Temperature."C "."Humidity:".$Humidity."%";
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
                            CURLOPT_POSTFIELDS => array('to' =>'+25'.$num,'from' =>'Baby status','unicode' =>'0','sms'=>$msg,'action'=>'send-sms'),
                            CURLOPT_HTTPHEADER => array('x-api-key: 151|bdEmomvcMLCIoRqQ8briK04a50MI6o6jW8sJnTcw '
        ),
                    ));
                    
                    $response = curl_exec($curl);
                    echo $response;
                    curl_close($curl); 
                    }
                    //End of message
                }else {
                    echo "Error updating record: " . $conn->error;
                }                
            }else {
                echo "time is less than 2 minutes";
            }
        }
    } else {
      echo "0 results";
    }

    $conn->close();
}