<?php
session_start();

// when performing the add action without logging in
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

require_once "pdo.php";

// checking if data is entered 
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email'])
    && isset($_POST['headline']) && isset($_POST['summary'])) {
    
    // checking if data is not empty
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 ||
        strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = 'All values are required';
        header("Location: add.php");
        return;
    } else {

        // adding values to the database
        $stmt = $pdo->prepare('INSERT INTO Profile (user_id,first_name, last_name, email, headline, summary) VALUES (:user_id, :first_name, :last_name, :email, :headline,:summary)');
        $stmt->execute(array(
                ':user_id' => $_SESSION['user_id'],
                ':first_name' => $_POST['first_name'],
                ':last_name' => $_POST['last_name'],
                ':email' => $_POST['email'],
                ':headline' => $_POST['headline'],
                ':summary' => $_POST['summary'])
        );
        $_SESSION['success'] = "Record added.";
        header("Location: index.php");
        return;
    }
}
else{
    $_SESSION['fail']="All values are required";
}?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Abhay Singh's Login Page</title>
</head>
<body>
<div class="container">
    <h1>Adding Profile for UMSI</h1>
    <!-- printing the error message in flash -->
    <?php
    if (isset($_SESSION['fail'])) {
        echo('<p style="color: red;">' . htmlentities($_SESSION['fail']) . "</p>\n");
        unset($_SESSION['fail']);
    }
    ?>
    <form method="post">
        <p>First Name:
            <input type="text" name="first_name" size="60"/></p>
        <p>Last Name:
            <input type="text" name="last_name" size="60"/></p>
        <p>Email:
            <input type="text" name="email" size="30"/></p>
        <p>Headline:<br/>
            <input type="text" name="headline" size="80"/></p>
        <p>Summary:<br/>
            <textarea name="summary" rows="8" cols="80"></textarea>
        <p>
            <input type="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>
</div>
</body>
</html>