<?php

$servername = "y0nkiij6humroewt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "iu55u4jwe71fr074";
$password = "zg432644ej6s6w4p";
$dbname = "r3en3wy6qhopkprr";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['ajax'])) {
        $sql = 'SELECT SUM(sodium_level) as SE_data FROM sodiumdata WHERE record_date = CURDATE()';
        $query = $conn->prepare($sql);
        $query->execute();
        $fetch = $query->fetch();
        $updated_SE_data = $fetch['SE_data'] + 0;

        echo json_encode(array("updated_SE_data" => $updated_SE_data));
        exit;
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>