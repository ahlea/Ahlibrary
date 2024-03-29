<!DOCTYPE html>
<html style= "background-image: url('https://img.freepik.com/premium-photo/nostalgic-background-with-old-books-wooden-shelf-ray-light_795881-9356.jpg')" >
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Ahlea, Angie">
        <link rel="stylesheet" href="BookInfo.css">
        <title>Book Info</title>
<!--         <script src="bookInfo.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <?php
        $title = $_GET['id'];
    ?>
    <body style= "background-color: rgba(0, 0, 0, 0.6)"> 
        <!-- Navigation bar -->
        <?php
            include("menuBar.php");
            
            // Report all error information on the webpage
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            //Get value from html file using id
            //https://www.plus2net.com/php_tutorial/variables2.php
            $title = $_GET['id'];

            //Set the library types
            $wishlist = 'Wishlist';
            $reading = 'Reading';
            $read = 'Read';

            $db_name = "";
            $db_user = "";
            $db_passwd = "";

            $db = new mysqli("localhost", $db_user, $db_passwd, $db_name);
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            } else {
                //Select the book from the db
                $sql_insert = "SELECT Title, Author, Blurb, Genre, Availability, Format FROM `books` WHERE Title = '" . trim($title) . "'";
                $result = $db->query($sql_insert) or die('Sorry, database operation was failed');

                //Store the resuting row in an array
                //https://stackoverflow.com/questions/17902483/show-values-from-a-mysql-database-table-inside-a-html-table-on-a-webpage
                while($row = mysqli_fetch_array($result)){
                    //Store each attribute of the book in a corresponding variable
                    $book = $row['Title'];
                    $author = $row['Author'];
                    $blurb = $row['Blurb'];
                    $genre = $row['Genre'];
                    $availability = $row['Availability'];
                    $format = $row['Format'];
                }
                $sql = "SELECT Title FROM `books` WHERE Title LIKE '%" . $book . "%' AND Availability = 'Available'";
                $r = $db->query($sql);
                $numAvail = mysqli_num_rows($r);
            }
        ?>    

        <!-- Display the info retrieved from the database -->
        <div id="info">

            <div id="booktitle">
                <h3> &nbsp; &nbsp; <?php echo($book);?> </h3>
            </div>

            <div id="author">
               By:  &nbsp; &nbsp; <?php echo($author);?>
            </div>

            <div id="desc">
                 &nbsp; &nbsp; <?php echo($blurb);?>
            </div>
            
            <div id="desc">
               Genre:  &nbsp; &nbsp; <?php echo($genre);?>
            </div>
            
            <div id="desc">
               Number of Copies Available:  &nbsp; <?php echo($numAvail);?>
            </div>

            <div id="added">
                Add this book to: 
                <button id="buttonLibrary" type="button" name="add" onclick="addBook('<?php echo $book ; ?>', '<?php echo $wishlist; ?>')">Wishlist </button>
                <br>
                Borrow this book:
                <?php 
                if ($numAvail == 0) {
                    ?>
                    <button id="buttonLibrary" type="button" name="add" onclick="addBook('<?php echo $book ; ?>', '<?php echo $onHold; ?>')">Join the Waitlist </button>
                <?php 
                }
                else {
                    ?>
                    <button id="buttonLibrary" type="button" name="add" onclick="addBook('<?php echo $book ; ?>', '<?php echo $checkOut; ?>')">Add to Profile </button>
                <?php 
                }
                ?>
                
                

<!--                 <p id="addBook"> -->
                    <?php
//                         $db = new mysqli("localhost", $db_user, $db_passwd, $db_name);

//                         if ($db->connect_errno > 0) {
//                             die('Unable to connect to database [' . $db->connect_error . ']');
//                         } else {
//                             //Increment added column by 1 to keep track of how many users have added the book to their library
//                             $sql_insert2 = "SELECT Added FROM `Book Search` WHERE Title = '" . $title . "'";
//                             $result = $db->query($sql_insert2);
//                             $numUsers = $result->fetch_assoc();

//                             //Display 0 if no users have added the book to their library
//                             if (mysqli_num_rows($result)===0) {
//                                 $numUsers['Added'] = 0;
//                             }
//                         }

//                         echo 'This book was added by ' . $numUsers['Added'] . ' other users.';
//                         $db->close();
//                     ?>
<!--                 </p> -->
            </div>
        </div>

        <div id="fb">
<!--             <p id="comments"> Comments </p> -->

            <!-- Field to add a comment and rating -->
<!--             <form id="form" method="POST"> -->
                <input type="hidden" name="title" value="<?=$title;?>"/>
<!--                 Leave a comment: <br> -->
<!--                 <textarea name="comment" rows="5" cols="40" required></textarea>  -->
<!--                 <br> -->
<!--                 Leave a rating: <br> -->
<!--                 &nbsp; 1 &nbsp; &nbsp; 2 &nbsp; &nbsp; 3 &nbsp; &nbsp; 4 &nbsp; &nbsp; 5  -->
<!--                 <br> -->
<!--                 <input type="range" min="1" max="5" class="slider" id="myRange" name="rating"> -->
<!--                 <br> -->
<!--                 <input id="#buttonLibrary" type="submit" name="submit" value="Submit">  -->
<!--             </form>  -->

<!--             <p id="cStyle"> All Comments: </p> -->
<!--             <ul id="cmtList"></ul> -->
            
<!--             <script> -->
                    <?php
//                         // Report all error information on the webpage
//                         error_reporting(E_ALL);
//                         ini_set('display_errors', 1);

//                         $db_name = "CS344F22BADREADS";
//                         $db_user = "AHLEA";
//                         $db_passwd = "Lindsey";

//                         $title = $_POST["title"];
//                         $cmt = $_POST["comment"];
//                         $rate = $_POST["rating"];

//                         $db = new mysqli("localhost", $db_user, $db_passwd, $db_name);

//                         //Add comments to database
//                         if ($db->connect_errno > 0) {
//                             die('Unable to connect to database [' . $db->connect_error . ']');
//                         } else {
//                             $sql_insert = "INSERT INTO Comments (Title, Comment, Rating) "."VALUES ('" . $title . "', '" . $cmt . "', " . $rate . ")";
//                             $result = $db->query($sql_insert) or die('Sorry, database operation was failed');
//                         }
//                         $db->close();
//                     ?>
<!--             </script> -->
        </div>
    </body>
</html>