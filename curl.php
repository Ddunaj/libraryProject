<?php
$key = 'J1p2EyrPmY8WHFC5axXmw';
header('Content-Type: text/plain');
function api_call($path)
{
        sleep(1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $retValue = curl_exec($ch);          
        curl_close($ch);
        return $retValue;
}

$ISBN = '0721602401';
getBookInfo($ISBN, $key);

function getBookInfo($ISBN, $key)
{
        $xml = api_call('https://www.goodreads.com/book/isbn/'. $ISBN .'?key='. $key);
        $sxml = new SimpleXMLElement($xml);
        $book_title = (string) $sxml->book->title;
        $book_pub_date = (string) $sxml->book->publication_month . '-' . $sxml->book->publication_day . '-' . $sxml->book->publication_year;
        $book_publisher = (string) $sxml->book->publisher;
        $book_page_num = (int) $sxml->book->num_pages;
        $book_shelves = $sxml->book->popular_shelves;
        $genres = array();
        $size = sizeof($book_shelves->shelf);
        if (sizeof($book_shelves->shelf) > 10)
                $size = 10;

        for ($i = 0; $i < $size; ++$i)
        {
                foreach($book_shelves->shelf[$i]->attributes() as $a => $b)
                {
                        if ($a == "name")
                                array_push($genres, (string)$b);
                }
        }
        $book_genre = getGenre($genres);
        $book_author = array();
        foreach ($sxml->book->authors->author as $author)
        {
                array_push($book_author, (string)$author->name);
        }
        $book_info = array($book_title, $book_author, $book_pub_date, $book_publisher, $book_page_num, $book_genre);
        return $book_info;

}

function getGenre($genres)
{  
       
        $compare = file("genres.txt",FILE_IGNORE_NEW_LINES);
        $book_genre = array();
        for ($i = 0; $i < sizeof($genres); ++$i)
        {
                for ($j = 0; $j < sizeof($compare); ++$j)
                { 

                        if (strcasecmp($genres[$i], $compare[$j]) == 0)
                        {
                                array_push ($book_genre, $compare[$j]);
                        }
                }
        }
        return $book_genre;
}

?>