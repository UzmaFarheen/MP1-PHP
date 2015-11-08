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
require 'vendor/autoload.php';
# Creating a client for the s3 bucket
use Aws\Rds\RdsClient;
$client = new Aws\Rds\RdsClient([
 'version' => 'latest',
 'region'  => 'us-east-1'
]);
$result = $client->describeDBInstances([
    'DBInstanceIdentifier' => 'mp1',
]);
$endpoint = "";
$endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
# Connecting to the database
$link = mysqli_connect($endpoint,"UzmaFarheen","UzmaFarheen") or die("Error " . mysqli_error($link));
/* Checking the database connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$link->real_query("SELECT * FROM ITMO544");
$res = $link->use_result();
?>

</div>
</body>
</html>
