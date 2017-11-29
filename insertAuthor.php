<?php
$username = "root"; $password = ""; $host = "localhost";
$dbname = "library_db";

$link = mysqli_connect($host,$username,$password,$dbname);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s <br>", mysqli_connect_error());
    exit();
}
echo "Connect successfully:"; echo $link->host_info . "<br>";

$Name = mysqli_real_escape_string($link, $_REQUEST['Name']);
$Gender = mysqli_real_escape_string($link, $_REQUEST['Gender']);
$Hometown = mysqli_real_escape_string($link, $_REQUEST['Hometown']);
//$ISBN = $_REQUEST['ISBN'];
$BirthDate = $_REQUEST['BirthDate'];

$authorQuery = "INSERT INTO authors (Name, Gender, Hometown, Birth_Date) 
				VALUES ('$Name', '$Gender', '$Hometown', '$BirthDate')";

if(mysqli_query($link, $authorQuery))
{
    echo "Records added successfully.";
} 
    else
{
    die("ERROR: Could not execute. " . mysqli_error($link));
}

// close connection
mysqli_close($link);
?>