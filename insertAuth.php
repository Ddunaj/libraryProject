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
$Genre = mysqli_real_escape_string($link, $_REQUEST['Genre']);
$ISBN = $_REQUEST['ISBN'];
$Review = $_REQUEST['Review'];

$aQuery = "INSERT INTO authors (Name) VALUES ('$Author')";
if(mysqli_query($link, $aQuery)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute.";
}
$query = "INSERT INTO books (Title, Author, Series, Number of Pages, Publish Date, Genre, ISBN, Review) 
          VALUES ('$Title', '$Author', '$Series', '$NumberOfPages', '$PublishDate', '$Genre', '$ISBN', '$Review')";
if(mysqli_query($link, $query)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not execute.";
}
// close connection
mysqli_close($link);
?>