<?php
$username = "root"; 
$password = ""; 
$host = "localhost";
$dbname = "library_db";

$link = mysqli_connect($host,$username,$password,$dbname);

$name = mysqli_real_escape_string($link, $_REQUEST['Name']);
$address = mysqli_real_escape_string($link, $_REQUEST['Address']);
$year = mysqli_real_escape_string($link, $_REQUEST['year']);
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
$query =  "SELECT Name FROM publisher WHERE Name = '$name'";
$result =  mysqli_query($link, $query);
if ($result == true & (mysqli_num_rows($result) > 0))
{
    if ($name != NULL)
    {
        $attr = "Name";
        $query =  "Update publisher SET " . $attr . " = '$name' WHERE Id = '$ID'";
        query_error($attr, $query, $link);
    }
    if ($address != NULL)
    {
        $attr = "Address";
        $query =  "Update publisher SET " . $attr. " = '$address' WHERE Id = '$ID'";
        query_error($attr, $query, $link);
    }
    if ($year != NULL)
    {
        $attr = "Year_Est.";
        $query =  "Update publisher SET " . $attr. " = '$year' WHERE Id = '$ID'";
        query_error($attr, $query, $link);
    }
}
else
    echo "Publisher was not found in the database <br></br>";
mysqli_close($link);
    
echo "<a href=\"homepage.html\">Return to Home Page</a>";
?>