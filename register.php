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

    if (isset($_POST['submit'])) {

        // Get all of the data entered by the user
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if ($username && $password && $email && $phone && $address) {
            $query = "INSERT into client (username, password, email, phone, address)";
            $query .= " values ('" . $username . "', '" . md5($password) . "', '" . $email
                    . "', " . $phone . ", '" . $address . "');";

            //echo $query; // For testing

            $result = mysqli_query($conn, $query)
                or die ("Could not execute query " . mysqli_error($conn)); // Execute query
            // We need to get the information about the new user so that we can assign its
            // 'id' as the sesions 'id'
            $idResult = mysqli_query($conn, "SELECT id from client where username = '" . $username . "' AND password = '" . md5($password) . "';")
                or die ("Could not execute query " . mysqli_error($conn));

            if ($result) {
                $row = mysqli_fetch_array($idResult);
                echo $row[0];
                $_SESSION['id'] =  $row[0];
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
            }
        }
        else
            echo "<center><font color = 'red'>Please fill out all the fields!</font></center>";

    }

?>

<html>
<center>

    <h1>Registration Form</h1>

    <form method = "POST" action = "">

        <!-- Fields to be filled out -->
        <table>
        <tr><td>Username:</td><td><input type = "text" name = "username"></td></tr>
        <tr><td>Password:</td><td><input type = "text" name = "password"></td></tr>
        <tr><td>Email:</td><td><input type = "email" name = "email"></td></tr>
        <tr><td>Phone Number:</td><td><input type = "number" name = "phone" maxlength = "10"></td></tr>
        <tr><td>Address:</td><td><input type = "text" name = "address"></td></tr>
        </table>

        <br>
        <input type = "submit" name = "submit" value = "Register">

    </form>

    <br>
    <p>Already have an account? <a href = "login.php">Login here!</a></p>

</center>
</html>