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
$Series = mysqli_real_escape_string($link, $_REQUEST['Series']);
$NumberOfPages = $_REQUEST['NumberOfPages'];
$PublishDate = $_REQUEST['PublishDate'];
$ISBN = $_REQUEST['ISBN'];
$Author_id = $_REQUEST['AuthorId'];

function query_error($query, $link)
{
    if(mysqli_query($link, $query))
    {
        echo "Records added successfully.";
    } 
    else
    {
        die("ERROR: Could not execute. " . mysqli_error($link));
    }
}

$query = "INSERT INTO books (Title, Series, Number_of_Pages, Publish_Date, ISBN, Author_id) 
          VALUES ('$Title', '$Series', '$NumberOfPages', '$PublishDate', '$ISBN', '$Author_id')";
query_error($query,$link);

// close connection
mysqli_close($link);
?>