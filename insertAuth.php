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

$Title = mysqli_real_escape_string($link, $_REQUEST['Title']);
$Author = mysqli_real_escape_string($link, $_REQUEST['Author']);
$Series = mysqli_real_escape_string($link, $_REQUEST['Series']);
$NumberOfPages = $_REQUEST['NumberOfPages'];
$PublishDate = $_REQUEST['PublishDate'];
$ISBN = $_REQUEST['ISBN'];

function query_error($query, $link)
{
    if(mysqli_query($link, $query))
    {
        echo "Records added successfully.";
    } 
else
    {
        echo "ERROR: Could not execute. " . mysqli_error($link)  . "<br>";
    }
}

$query = "INSERT INTO authors (Name) VALUES ('$Author')";
query_error($query, $link);
$query = "INSERT INTO books (Title, Series, Number_of_Pages, Publish_Date, ISBN) 
          VALUES ('$Title', '$Series', '$NumberOfPages', '$PublishDate', '$ISBN')";
query_error($query,$link);

// close connection
mysqli_close($link);
?>