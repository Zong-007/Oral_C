<?php


// กำหนดค่าตัวแปรสำหรับการเชื่อมต่อฐานข้อมูล
$servername = "m7nj9dclezfq7ax1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com"; // ชื่อเซิร์ฟเวอร์ฐานข้อมูล
$username = "p1jryqynwuzez4tj"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "hbjnf2ffhkcvcnak"; // รหัสผ่านฐานข้อมูล
$dbname = "ickshh2zl54q79ab"; // ชื่อฐานข้อมูลของเรา

try {
    // สร้างการเชื่อมต่อฐานข้อมูลโดยใช้ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // ตั้งค่าให้ PDO แสดงข้อผิดพลาดเป็นข้อยกเว้น (Exception)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>"; // แสดงข้อความเมื่อการเชื่อมต่อสำเร็จ
} catch (PDOException $e) {
    // แสดงข้อความเมื่อการเชื่อมต่อล้มเหลว และแสดงข้อผิดพลาด
    echo "Connection failed: " . $e->getMessage();
    exit(); // หยุดการทำงานของโปรแกรม
}

// ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // เปิดไฟล์ที่ถูกอัปโหลดและอ่านข้อมูล
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    
    // รับค่าจากฟอร์ม
    $telephone = $_POST['telephone'];
    $doctor = $_POST['doctor'];
    $clinic = $_POST['clinic'];
    $get_results = $_POST['get_results'];
    $user_name = $_POST['user_name'];
    $appointment = $_POST['appointment'];
    $mobile_no = $_POST['mobile_no']; // รับค่าหมายเลขโทรศัพท์มือถือ

    // เพิ่มข้อมูลรูปภาพเป็น BLOB และข้อมูลอื่น ๆ ลงในฐานข้อมูล
    $stmt = $conn->prepare("INSERT INTO Oral_C_data (PicAI, PicAI_Name, Clinic_Tel, Dent_Name, Clinic_Name, AI_Result, User_Name, Meet_Date, Mobile_No ,Trans_Date) 
                            VALUES (:image_data, :image_name, :telephone, :doctor, :clinic, :get_results, :user_name, :appointment, :mobile_no, NOW())");
    $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
    $stmt->bindParam(':image_name', $_FILES['image']['name']);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':doctor', $doctor);
    $stmt->bindParam(':clinic', $clinic);
    $stmt->bindParam(':get_results', $get_results);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':appointment', $appointment);
    $stmt->bindParam(':mobile_no', $mobile_no); // เชื่อมโยงหมายเลขโทรศัพท์มือถือ
    
    if ($stmt->execute()) {
        echo "Image, appointment details, and mobile number uploaded successfully.";
    } else {
        echo "Failed to upload image and appointment details.";
    }
} else {
    echo "No image uploaded or there was an upload error.";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn = null;
?>
