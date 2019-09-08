<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $details = trim($_POST["details"]);

    if ($name == '' || $email == '' || $details == ''){
        echo "Please fill in the required fields: Name, Email and Details";
        exit;
    }

    echo "<pre>";
    $email_body = '';
    $email_body .= "Name " . $posts['name'] . "\n";
    $email_body .= "Email " . $posts['email'] . "\n";
    $email_body .= "Details " . $posts['details'] . "\n";
    echo $email_body;
    echo "</pre>";
    // To do: send email
    header("location:suggest.php?status=thanks");
}

$pageTitle = "Suggest a Media Item";
$section = "suggest";

include("inc/header.php"); ?>

<div class="section page">
    <div class="wrapper">
        <h1>Suggest a Media Item</h1>
        <?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") {
            echo "<p>Thanks for the email! I&rsquo;ll check out your suggestions shortly!</p>";
        } else { ?>
            <p>Complete the form and send me an email, if you think there is something I am missing</p>
            <form method="post" action="suggest.php">
                <table>
                    <tr>
                        <th><label for="name">Name</label></th>
                        <td><input type="text" name="name" id="name"></td>
                    </tr>
                    <tr>
                        <th><label for="email">Email</label></th>
                        <td><input type="text" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <th><label for="details">Suggest Item Details</label></th>
                        <td><textarea name="details" id="details"></textarea></td>
                    </tr>
                </table>
                <input type="submit" value="send">
            </form>
        <?php } ?>
    </div>

</div>

<?php include("inc/footer.php"); ?>
