<?php 
function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

$name = $_POST["name"];
$profession = $_POST["profession"];
$email = $_POST["email"];
$need = $_POST["need"];
$city = $_POST["city"];
$message = $_POST["message"];
$pilotTest = $_POST["pilotTest"] ? true : false;
$interview = $_POST["interview"] ? true : false;

$to_email = "info@needspot.ca";
$headers = "From: ".$email.;
$subject = "Another ".$profession." subscribed to NeedSpot.";

$bio = "This mail is sent using the PHP mail by ".$email.". <br><br> Hi, my name is ".$name.". I am ".$profession.". I need to ".$need.". I live in ".$city.". <br><br>".$message."<br><br> Interview: ".$interview."<br> Pilot Test: ".$pilotTest;
echo $bio;

// //check if the email address is invalid $secure_check
$secure_check = sanitize_my_email($to_email);
if ($secure_check == false) {
    echo "Invalid input";
} else { 
//send email 
    mail($to_email, $subject, $bio, $headers);
}

//form.trigger("reset")

// connect to database

$servername = "vmi833699.contaboserver.net";
$database = "c0needspotmain";
$username = "c0nsmain";
$password = "nsm@1nuser";

// // Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: ".mysqli_connect_error());
}
 
//echo "Connected successfully";

// INSERT
$sql = "INSERT INTO `users` (`nsname`, `nsutype`, `nsneed`, `nsemail`, `nscity`, `nsbio`, `nspilot`, `nsinterview`, `nstimestamp`) VALUES ('". $name . "', '".$profession."', '". $need. "', '".$email."', '".$city."', '".$bio."', '".$pilotTest."', '".$interview."', current_timestamp())";

if (mysqli_query($conn, $sql)) {
      //echo "New record created successfully";
      header("Location: https://www.needspot.ca/Thank-you.html");
        exit();
} else {
      //echo "Error: <br>" . mysqli_error($conn);
      header("Location: https://www.needspot.ca/");
}
mysqli_close($conn);

?>