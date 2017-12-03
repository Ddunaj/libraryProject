<?php
$username = "root"; 
$password = ""; 
$host = "localhost";
$dbname = "library_db";

$link = mysqli_connect($host,$username,$password,$dbname);

$ISBN = $_REQUEST['ISBN'];
$name = mysqli_real_escape_string($link, $_REQUEST['Name']);
$series = mysqli_real_escape_string($link, $_REQUEST['series']);
$date = $_REQUEST['publish_date'];
$pages = $_REQUEST['pages'];
$publisher = mysqli_real_escape_string($link, $_REQUEST['publisher']);
$author = $_REQUEST['author_id'];

function query_error($attr, $query, $link)
{
    if(mysqli_query($link, $query))
    {
        $last_id = mysqli_insert_id($link);
        echo $attr . " updated successfully. <br></br>";
    }
    else
    {
        die("ERROR: Could not execute. " . mysqli_error($link) . "<br></br>");
    }
}
$query =  "SELECT ISBN FROM books WHERE ISBN = '$ISBN'";
$result =  mysqli_query($link, $query);
if ($result == true & (mysqli_num_rows($result) > 0))
{
    if ($name != NULL)
    {
        $attr = "Tilte";
        $query =  "Update books SET " . $attr . " = '$name' WHERE ISBN = '$ISBN'";
        query_error($attr, $query, $link);
    }
    if ($series != NULL)
    {
        $attr = "Series";
        $query =  "Update books SET " . $attr. " = '$series' WHERE ISBN = '$ISBN'";
        query_error($attr, $query, $link);
    }
    if ($date != NULL)
    {
        $attr = "Publish_date";
        $query =  "Update books SET " . $attr. " = '$date' WHERE ISBN = '$ISBN'";
        query_error($attr, $query, $link);
    }
    if ($pages != NULL)
    {
        $attr = "Number_of_pages";
        $query =  "Update books SET " . $attr. " = '$pages' WHERE ISBN = '$ISBN'";
        query_error($attr, $query, $link);
    }
    if ($publisher != NULL)
    {
        $query = "SELECT Name FROM publisher WHERE Name = '$publisher'";
        $result = mysqli_query($link, $query);
        if ($result == true & (mysqli_num_rows($result) > 0))
        {
            $attr = "Publisher";
            $query =  "Update books SET " . $attr. " = '$publisher' WHERE ISBN = '$ISBN'";
            query_error($attr, $query, $link);
        }
        else
            echo "Publisher was not found in the database";
    }
    if ($author != NULL)
    {
        $query = "SELECT Author_id FROM authors WHERE Author_id = '$author'";
        $result = mysqli_query($link, $query);
        if ($result == true & (mysqli_num_rows($result) > 0))
        {
            $attr = "Author_id";
            $query =  "Update wrote SET " . $attr. " = '$author' WHERE ISBN = '$ISBN'";
            query_error($attr, $query, $link);
        }
        else
            echo "Author was not found in the database";
    }
}
else
    echo "ISBN was not found in the database <br></br>";
mysqli_close($link);

echo "<a href=\"homepage.html\">Return to Home Page</a>";
?>