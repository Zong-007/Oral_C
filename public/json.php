<?php
header('Content-Type: application/json');

$servername = "y0nkiij6humroewt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
$username = "iu55u4jwe71fr074";
$password = "zg432644ej6s6w4p";
$dbname = "r3en3wy6qhopkprr";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // คำสั่ง SQL
    $sql = 'SELECT SUM(SODIUM) as SE_data FROM sd_data WHERE day = CURDATE()';
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetch(PDO::FETCH_ASSOC);

    // ส่งผลลัพธ์ในรูปแบบ JSON
    echo json_encode($fetch);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
