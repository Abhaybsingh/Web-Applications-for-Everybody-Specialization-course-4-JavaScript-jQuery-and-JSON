<?php // Do not put any HTML above this line
session_start();
require_once "pdo.php";

// the intersection between user and profile on user_id
$stmt = $pdo->query("SELECT profile_id, first_name,last_name , headline 
    from users join Profile on users.user_id = Profile.user_id");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Abhay Singh's Resume Registry</title>
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h2>Abhay Singh's Resume Registry</h2>
    <!-- for logout  -->
    <?php
    if (isset($_SESSION['name'])) {
        echo '<p><a href="logout.php">Logout</a></p>';
    }
    ?>
    <!-- printing the success message by flash -->
    <?php
    if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION['success']);
    }
    ?>

    <ul>
    <!-- if name is not set the login message is shown -->
        <?php
        if (!isset($_SESSION['name'])) {
            echo "<p><a href='login.php'>Please log in</a></p>";
        }

        // printing the data in table form
        if (true) {
            if (true) {
                echo "<table border='1'>";
                echo " <thead><tr>";
                echo "<th>Name</th>";
                echo " <th>Headline</th>";
                // if name is set then action(edit/delete) is shown
                if (isset($_SESSION['name'])) {
                    echo("<th>Action</th>");
                }
                echo " </tr></thead>";
                // printing all data of users
                foreach ($rows as $row) {
                    echo "<tr><td>";
                    echo("<a href='view.php?profile_id=" . $row['profile_id'] . "'>" . $row['first_name'] . $row['last_name']  . "</a>");
                    echo("</td><td>");
                    echo($row['headline']);
                    echo("</td>");
                    // adding the edit and delete action
                    if (isset($_SESSION['name'])) {
                        echo("<td>");
                        echo('<a href="edit.php?profile_id=' . $row['profile_id'] . '">Edit</a> / <a href="delete.php?profile_id=' . $row['profile_id'] . '">Delete</a>');
                    }
                    echo("</td></tr>\n");
                }
                echo "</table>";
            } else {
                echo 'No rows found';
            }
        }
        echo '</li></ul>';
        ?>
        <!-- link to add.php -->
        <p><a href="add.php">Add New Entry</a></p>
        <p>
            <b>Note:</b> Your implementation should retain data across multiple
            logout/login sessions. This sample implementation clears all its
            data periodically - which you should not do in your implementation.
        </p>
</div>
</body>
</html>