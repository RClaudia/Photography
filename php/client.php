<?php
session_start();

include 'connectDB.php';
$conn = connect();

$codeDB = $_GET['clientCode'];
$valide = false;
$_SESSION['codeDB'] = $codeDB;

//check if the client is in database
$sql = "SELECT id_client, Cod FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
        if($row["Cod"] == $codeDB)
        {
            $valide = true;
            break;
        }
        else
        {
            $valide = false;
        }
    }
}
if(true == $valide)
{
    header('Location: ../client.php?$codeDB');
}
else
{
    echo "Sorry, you don't have access to enter!!";
}
?>