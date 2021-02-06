<?php

include 'connectDB.php';

$conn = connect();

$first_name = $_GET['fname'];
$last_name = $_GET['lname'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$service_code = $_GET['code'];
$date = $_GET['date'];
$location = $_GET['location'];
$details = $_GET['details'];
$clientCheck = false;
$codeDB = false;
$id = "null";

//check if the client is in database
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        if($row["Mail"] == $email)
        {
        	$clientCheck = true;
        	$codeDB = $row["Cod"];
        	$id = $row["id_client"];
        	break;
        }
        else
        {
        	$clientCheck = false;
        }
    }
}
    if(true == $clientCheck)
    {
    	$sql2 ="INSERT INTO appointments (id_client, id_service, Data, Detalii, Locatie) VALUES ('".$id."','".$service_code."', '".$date."', '".$details."', '".$location."')";
    	$result = mysqli_query($conn,$sql2);
    }
    else
    {
    	$code = generateRandomString();
        saveInFile($code);
    	$sql1 = "INSERT INTO clients (Nume, Prenume, Telefon, Mail, Cod) VALUES ('".$last_name."', '".$first_name."', '".$phone."', '".$email."', '".$code."')";
       	$result = mysqli_query($conn,$sql1);
       //	sendMail($code, $email);

       	$sql = "SELECT * FROM clients";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
    		// output data of each row      search the client to get the id
    		while($row = $result->fetch_assoc()) 
    		{
        		if($row["Mail"] == $email)
        		{
        			$clientCheck = true;

        			//get the id of client
        			$id = $row["id_client"];
        			break;
        		}
        		else
        		{
        			$clientCheck = false;
        		}
        	}
    	}
    	if(true == $clientCheck)
    	{
    		$sql2 ="INSERT INTO appointments (id_client, id_service, Data, Detalii, Locatie) VALUES ('".$id."','".$service_code."', '".$date."', '".$details."', '".$location."')";
    		$result = mysqli_query($conn,$sql2);
    	} 
    }

function generateRandomString($length = 7) 
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '#';
    for ($i = 0; $i < $length; $i++) 
    {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if ($conn->query($sql) == TRUE) 
{
   header( 'Location: ../validation.html' );
} else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
function saveInFile($code)
{
    $myfile = fopen('../files/clientCode.txt', 'w') or die("Unable to open file!");
    $text = "*****************************************************************\n";
    $text .="*                                                               *\n";
    $text .="*                   Your code is:" .$code."                       *\n";
    $text .="*                                                               *\n";
    $text .="*****************************************************************\n\n";
    $text .="Hi!\n\n";
    $text .="Use this code to have access to your personal page.\n\n";
    $text .="Step 1: Go to Home page and enter your code\n\n";
    $text .="On your personal page you'll find:\n";
    $text .="\t\t- a countdown till your photo season\n";
    $text .="\t\t- all the informations about the photo season\n";
    $text .="\t\t- a download link from where you can download your photos\n";
    $text .="\t\t- the CONFIRM notification\n";
    $text .="Wait until the photo season is confirmed!!\n\n";
    $text .="All the best,\n";
    $text .="Claudia Rusu";

    fwrite($myfile, $text);
    fclose($myfile);
}


$conn->close();



?>