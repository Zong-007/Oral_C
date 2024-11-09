<?php
header('Content-Type: application/json');

// รับข้อมูล POST
$input = json_decode(file_get_contents('php://input'), true);

// ตรวจสอบว่าข้อมูลที่รับมามีค่าและเป็นอาร์เรย์
if (!isset($input['dates']) || !is_array($input['dates'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$dates = $input['dates'];

// เชื่อมต่อกับฐานข้อมูล
$servername = "y0nkiij6humroewt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306";
$username = "iu55u4jwe71fr074";
$password = "zg432644ej6s6w4p";
$dbname = "r3en3wy6qhopkprr";

try {
    // สร้างการเชื่อมต่อฐานข้อมูลด้วย PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit();
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลตามวันที่ที่ส่งมา
$placeholders = implode(',', array_fill(0, count($dates), '?'));
$sql = "SELECT record_date, SUM(sodium_level) AS total_sodium 
        FROM sodiumdata 
        WHERE record_date IN ($placeholders)
        GROUP BY record_date
        ORDER BY record_date ASC";

// เตรียมและรันคำสั่ง SQL
$query = $conn->prepare($sql);
$query->execute($dates); // ส่งอาร์เรย์ของวันที่ไปยัง execute

$result = $query->fetchAll(PDO::FETCH_ASSOC);

// สร้างอาร์เรย์สำหรับข้อมูลกราฟ
$data = [
    'dates' => $dates,
    'values' => array_fill(0, count($dates), 0)
];

// เพิ่มข้อมูลที่ได้จากฐานข้อมูล
foreach ($result as $row) {
    $index = array_search($row['record_date'], $dates);
    if ($index !== false) {
        $data['values'][$index] = $row['total_sodium'];
    }
}

// ปิดการเชื่อมต่อ
$conn = null;

// ส่งข้อมูล JSON
echo json_encode($data);
?>
