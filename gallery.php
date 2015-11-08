<html>
<head><title>Gallery</title>
  <!-- jQuery -->
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <!-- Fotorama -->
  <link href="fotorama.css" rel="stylesheet">
  <script src="fotorama.js"></script>
</head>
<body>
<div class="fotorama" data-width="700" data-ratio="600/465" data-max-width="100%">
<?php
session_start();
$email = $_POST["email"];
echo $email;
require 'vendor/autoload.php';
$rds = new Aws\Rds\RdsClient([
    'version' => 'latest',
    'region'  => 'us-east-1'
]);
$result = $rds->describeDBInstances(array(
    'DBInstanceIdentifier' => 'ITMO544-MP1-DB'
   
));
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    echo "============\n". $endpoint . "================";
$link = mysqli_connect($endpoint,"UzmaFarheen","UzmaFarheen","MiniProject");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
else {
echo "Success";
}
$link->real_query("SELECT * FROM MP1 WHERE email = '$email'");
$res = $link->use_result();
echo "Result set order...\n";
while ($row = $res->fetch_assoc()) {
    echo "<img src =\" " . $row['raws3url'] . "\" /><img src =\"" .$row['finisheds3url'] . "\"/>";
echo $row['id'] . "Email: " . $row['email'];
}
$link->close();
?>

</div>
</body>
</html>
