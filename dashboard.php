<?php

    session_start();

    if (!isset($_SESSION['username']))
        header("Location: login.php");

    $id = $_SESSION['id'];
    $username = $_SESSION['username'];

    // Open the connection
    $conn = mysqli_connect("localhost", "root", "")
        or die ("Could not connect to the server " . mysqli_error($conn));

    // Select the database
    mysqli_select_db($conn, "examdb")
        or die ("Could not open the database: " . mysqli_error($conn));

    // Get all of the books that are in the database
    $query = "SELECT * from book;";
    $results = mysqli_query($conn, $query)
        or die ("Could not execute query " . mysqli_error($conn));
?>

<html>
<center>

    <h1>Dashboard</h1>

    <p>Hey, <?php echo $username; ?>!</p>
    <p>You are now in the dashboard page.</p>
    <a href = "login.php">Logout</a>

    <br>
    <h2>Select the books you would like to rent</h2>
    <form method = "GET" action = "">
        <select name = "books[]" multiple>
            <?php while ($book = mysqli_fetch_array($results)) {
                if ($book[4] == 0) // Checks to make sure the book isn't checked out yet
                    echo "<option value = '" . $book[0] . "'>" . $book[1] . " - " . $book[2] . " - " . $book[3] . "</option>";
            } ?>
        </select>
        <br>
        <input type = "submit" name = "submit" value = "Submit">
    </form>

    <?php
    if (isset($_GET['submit'])) {

        // If the user selected books
        if (isset($_GET['books'])) {

            $selected = $_GET['books'];
            foreach ($selected as $bookID) {

                // Update the 'book' table so that is knows what books are now rented
                $query1 = "UPDATE book set status = 1 where id = " . $bookID . ";";
                mysqli_query($conn, $query1) or die("Could not complete query " . mysqli_error($conn));
                echo "You selected book " . $bookID . "<br>";

                // Update the 'bookrental' table so that it knows who rented the book(s)
                $query2 = "INSERT into bookrental (client_id, book_id) values (" . $id . ", " . $bookID . ");";
                mysqli_query($conn, $query2) or die("Could not complete query " . mysqli_error($conn));
            }
        }
        else // If no books were selected
            echo "<font color = 'red'>Please select at least one book</font>";
    }
    ?>

</center>
</html>