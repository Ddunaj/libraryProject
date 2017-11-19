<!DOCTYPE html>
<html>
<body>

<?php
         // define variables and set to empty values
$TitleErr = $AuthorErr = $PublishDateErr = $ISBNErr = $NumberOfPagesErr = $GenreError = $ReviewErr = $SeriesErr = "";
$Title = "";
$Author = "";
$PublishDate = "";
$ISBN = 0;
$Review = "";
$Genre = "";
$Series = "";
$NumberofPages = 0;
        
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["Title"])) {
               $TitleErr = "Title is required";
            }else {
               $Title = test_input($_POST["Title"]);
            }
            if (empty($_POST["Author"])) {
               $AuthorErr = "Author is required";
            }else {
               $Author = test_input($_POST["Author"]);
            } 
            if (empty($_POST["Series"])) {
               $Series = "";
            }else {
               $Series = test_input($_POST["Series"]);
            }
            if (empty($_POST["NumberofPages"])) {
               $NumberofPages = 0;
            }else {
               $NumberofPages = test_input($_POST["NumberofPages"]);
            }
            if (empty($_POST["PublishDate"])) {
               $PublishDate = "";
            }else {
               $PublishDate = test_input($_POST["PublishDate"]);
            }
            if (empty($_POST["Genre"])) {
               $Genre = "";
            }else {
               $Genre = test_input($_POST["Genre"]);
            }
            if (empty($_POST["ISBN"])) {
               $ISBN = 0;
            }else {
               $ISBN = test_input($_POST["ISBN"]);
            }
            if (empty($_POST["Review"])) {
               $Review = "";
            }else {
               $Review = test_input($_POST["Review"]);
            }
         }
         
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
?>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <table>

            <tr>
               <td>Title:</td>
               <td><input type = "text" name = "Title">
                  <span class = "error">* <?php echo $TitleErr;?></span>
               </td>
            </tr>

            <tr>
               <td>Author:</td>
               <td><input type = "text" name = "Author">
                  <span class = "error">* <?php echo $AuthorErr;?></span>
               </td>
            </tr>

            <tr>
               <td>Series:</td>
               <td><input type = "text" name = "Series">
                  <span class = "error">* <?php echo $SeriesErr;?></span>
               </td>
            </tr>

            <tr>
               <td>NumberOfPages: </td>
               <td><input type = "number" name = "NumberofPages">
                  <span class = "error">* <?php echo $NumberOfPagesErr;?></span>
               </td>
            </tr>

            <tr>
               <td>PublishDate: </td>
               <td><input type = "text" name = "PublishDate">
                  <span class = "error">* <?php echo $PublishDateErr;?></span>
               </td>
            </tr>

            <tr>
               <td>Genre: </td>
               <td><input type = "text" name = "Genre">
                  <span class = "error">* <?php echo $GenreError;?></span>
               </td>
            </tr>

            <tr>
               <td>ISBN: </td>
               <td><input type = "number" name = "ISBN">
                  <span class = "error">* <?php echo $ISBNErr;?></span>
               </td>
            </tr>

            <tr>
               <td>Review: </td>
               <td><input type = "text" name = "Review">
                  <span class = "error">* <?php echo $ReviewErr;?></span>
               </td>
            </tr>
            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit"> 
               </td>
            </tr>
        </table>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo ("Title: $Title"); echo "<br>";
echo ("Author: $Author"); echo "<br>";
echo ("Series: $Series"); echo "<br>";
echo ("Number of Pages: $NumberofPages"); echo "<br>";
echo ("PublishDate: $PublishDate"); echo "<br>";
echo ("Genre: $Genre"); echo "<br>";
echo ("ISBN: $ISBN"); echo "<br>";
echo ("Review: $Review"); echo "<br>";
?>

<?php
$username = "root"; $password = ""; $host = "localhost:8080";
$dbname = "library_db";
$link = mysqli_connect("$host","$username","$password","$dbname");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s <br>", mysqli_connect_error());
    exit();
}
echo "Connect successfully:";

$authorQuery = "INSERT INTO Authors (Author)
				Values ($Author)";
mysqli_query($link, $authorQuery);
$query = "INSERT INTO Books (Title, Author, Series, NumberofPages, PublishDate, Genre, ISBN, Review)
		  Values($Title, $Author, $Series, $NumberofPages, $PublishDate, $Genre, $ISBN, $Review)";
mysqli_query($link,$query);

mysqli_close($link);
?>

</body>
</html>