<?php
    session_start();
    include("connection.php");
    if(!isset($_SESSION['admin_username']))
    {
       $_SESSION = array();
       session_unset();
       session_destroy();
       header("location: admin_login.php");
    }
    $username = $_SESSION['admin_username'];
    $sql = "SELECT branch_name FROM admin WHERE username = '${username}'";
    $result = mysqli_query($db, $sql);
    $row = $result->fetch_assoc();
    $this_branch = $row["branch_name"];


    $keyword_value = "";
    $sql = "SELECT * FROM book ORDER BY isbn";
    $book = mysqli_query($db, $sql);
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $keyword = $_POST['keyword'];
        $keyword_value = $keyword;
        if($keyword !== "")
        {
            $sql =  "SELECT * FROM book 
            WHERE 
                isbn LIKE '%$keyword%' OR
                title LIKE '%$keyword%'OR
                author LIKE '%$keyword%'OR
                genre LIKE '%$keyword%'OR
                publisher LIKE '%$keyword%'
            ";
         $book = mysqli_query($db,$sql);
        }  
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book List</title>
	<link href="CSS/booklist.css" rel="stylesheet">
	<?php include('admin_navbar.php'); ?>
</head>
<body>
    <section class="main">
        <div class="search_box">
            <form action="" method="POST">
                <input type="text" list= 'username_list' name="keyword" value="<?=$keyword_value?>" placeholder="search by keywords">
                 <datalist id='username_list'>"
                    <?php
                        $sql2 = "SELECT * FROM book ORDER BY isbn";
                        $result2 = mysqli_query($db, $sql2);
                        if ($result2->num_rows > 0) 
                        {
                            while($row = $result2->fetch_assoc())
                            {
                                $isbn2 = $row['isbn']; 
                                $title2 = $row['title'];
                                $author2 = $row['author'];
                                $genre = $row['genre'];
                                $publisher = $row['publisher'];
                                $str = $title2." | ".$author2." | ".$genre." | ".$publisher;
                                echo "<option value='$isbn2'>$str</option>";
                            }
                        }?>
                </datalist>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="listbox">
            <div class="row" style="
            font-weight: bold;
            border: 3px solid black;
            ">
                <div class="element"><p>ISBN</p></div>
                <div class="element"><p>title</p></div>
                <div class="element"><p>Author</p></div>
                <div class="element"><p>Genre</p></div>
                <div class="element"><p>Publisher</p></div>
                <div class="element"><p>Available Copy</p></div>
                
            </div>
            <?php  
              
                if ($book->num_rows > 0) 
                {
                    while($row = $book->fetch_assoc())
                    {
                        $isbn = $row["isbn"];
                        $title = $row["title"];
                        $author = $row["author"];
                        $genre = $row["genre"];
                        $publisher = $row["publisher"];
                        $sql = "SELECT no_of_copies FROM keeps WHERE book_isbn = '$isbn' AND branch_name = '${this_branch}'";
                        $result = mysqli_query($db, $sql);
                        $num_of_copy = 0 ;
                        if($result->num_rows > 0)
                        {
                        	$row2 = $result->fetch_assoc();
                        	$num_of_copy = $row2['no_of_copies'];

                        }
                       // if($num_of_copy>0){
                        echo "
                            <a href = 'admin_full_bookinfo.php?isbn=$isbn'> 
                                 <div class='row'>
                                    <div class='element'><p>$isbn</p></div>
                                    <div class='element'><p>$title</p></div>
                                    <div class='element'><p>$author</p></div>
                                    <div class='element'><p>$genre</p></div>
                                    <div class='element'><p>$publisher</p></div>
                                    <div class='element'><p>$num_of_copy</p></div>
                                </div>
                            </a>
                        ";
                    // }

                    }
                } 

            ?>

        </div>
        
    </section>
</body>
<footer>
	<?php include('admin_footer.html'); ?>
</footer>
</html>