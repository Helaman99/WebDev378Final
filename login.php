<?php

    session_start();

    // Check to see if the session contains a username from a previous session
    // If so, destroy the session and start a new one
    if (isset($_SESSION['username'])) {
        session_destroy();
        session_start(); }

    // Open the connection
    $conn = mysqli_connect("localhost", "root", "")
        or die ("Could not connect to the server " . mysqli_error($conn));

    // Select the database
    mysqli_select_db($conn, "examdb")
        or die ("Could not open the database: " . mysqli_error($conn));

    if (isset($_POST['login'])) {
        // Get the username and password
        $username = $_POST['username'];
        $password = $_POST['password'];

        //echo $username . " " . $password; // For testing

        // Prepare the query with the provided credentials (we are MD5 hashing the password)
        $query = "SELECT * from client where username = '" . $username . "' AND password = '" . md5($password) . "';";
    
        // Execute the query
        $result = mysqli_query($conn, $query)
            or die ("Could not execute query " . mysqli_error($conn));

        // Check to make sure that the user exists (there should only be 1)
        if (mysqli_num_rows($result) != 1)
            echo "<center><font color = 'red'>User does not exist!</font></center>";
        else {
            //echo "user exists"; // For testing
            $row = mysqli_fetch_array($result);
            $id = $row[0];
            $_SESSION['id'] = $id; // We assign the sessions ID to match that of the user
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        }
    }

?>

<html>

<center>

    <h1>Enter Your Account Credentials to Login</h1>

    <br>
    <form method = "POST" action = "">

        Username <input type = "text" name = "username">
        <br>
        Password <input type = "password" name = "password">
        <br><br>
        <input type = "submit" name = "login" value = "Login">

    </form>
    <br>

    <br>
    <p>Not a member? <a href = "register.php">Register here!</a></p>

</center>

</html>