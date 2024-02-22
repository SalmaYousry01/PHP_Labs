<?php
session_start();
require_once ("vendor/autoload.php");
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";;
$message = isset($_POST["message"]) ? $_POST["message"] : "";;
$errorMessage = "";
$successMessage = "Thank you for contacting us!";

if(isset($_SESSION["first_request_time"])) {
    $first_request_time = $_SESSION["first_request_time"];
} else {
    $first_request_time = date("F j Y g:i A");
    $_SESSION["first_request_time"] = $first_request_time; 
}

echo "Hello, this visit started at $first_request_time<br/>";

$desired_view=isset($_GET["view"]) ? $_GET["view"] : default_view;
if($desired_view == "display"){
    Display_Submits();
    die("<br/> To add a new submit <a href='index.php?view=add'>Click here</a>");
}else{
    if(isset($_POST["submit"]) && empty($errorMessage)){
        Store_Submits($name,$email);
        die("Contact saved successfully"."<br/> To visit all contacts <a href='index.php?view=display'>Click here</a");
    }
}


if(isset($_POST["submit"])) {
    if (empty($name) || strlen($name) > MAX_NAME_LENGTH) {
        $errorMessage .="Name is required and must be less than 100 characters <br>";
    } 

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage .= "Email is not valid <br>";
    } 

    if (strlen($message) > 255 || strlen($message) == 0){
        $errorMessage .= "Please enter a text and less than 255 character";
    }
}

?>



<html>

<head>
    <title> contact form </title>


</head>

<body>
    <?php
    if(isset($_POST["submit"]) && empty($errorMessage)) {
        echo SUCCESS_MESSAGE;
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Message: $message</p>";
        exit();
    }
    ?>
    <h3> Contact Form </h3>

    <div id="after_submit">
        <?php echo $errorMessage; ?>
    </div>
    <form id="contact_form" action="index.php" method="POST" enctype="multipart/form-data">

        <div class="row">
            <label class="required" for="name">Your name:</label><br />
            <input id="name" class="input" name="name" type="text" value="<?php echo $name ?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="email">Your email:</label><br />
            <input id="email" class="input" name="email" type="text" value="<?php echo $email ?>" size="30" /><br />

        </div>
        <div class="row">
            <label class="required" for="message">Your message:</label><br />
            <textarea id="message" class="input" name="message" rows="7" cols="30"><?php echo $message ?></textarea><br />

        </div>

        <input id="submit" name="submit" type="submit" value="Send email" />
        <input id="clear" name="clear" type="reset" value="clear form" />

    </form>
</body>

</html>