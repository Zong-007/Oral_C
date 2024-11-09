<?php

    $servername = "y0nkiij6humroewt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "iu55u4jwe71fr074";
    $password = "zg432644ej6s6w4p";
    $dbname = "r3en3wy6qhopkprr";

    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

?>
<!-- php_sql-->
<!--WHERE date = CURDATE()--> 
<!--WHERE date = CURDATE()--> 
<?php
    $sql = 'SELECT SUM(sodium_level) as SE_data FROM sodiumdata WHERE record_date = CURDATE()';
    $query = $conn->prepare($sql);
    $query->execute();
    $fetch = $query->fetch();
    $updated_SE_data = $fetch['SE_data'] + 0;

    $sql1 = 'SELECT SUM(sodium_level) as SE_data FROM sodiumdata WHERE record_date = DATE_SUB(CURDATE(), INTERVAL 1 DAY)';
    $query1 = $conn->prepare($sql1);
    // รันคำสั่ง SQL
    $query1->execute();
    // ดึงข้อมูลเป็นอาร์เรย์
    $fetch1 = $query1->fetch() ;
    // ตรวจสอบค่า SE_data และแปลงเป็นตัวเลข
    $updated_SE_data1 = $fetch1['SE_data'] + 0;

    $sql2 = 'SELECT record_date as SE_data FROM sodiumdata WHERE record_date = CURDATE() ';
    $query2 = $conn-> prepare($sql2);
    $query2->execute();
    $day = $query2->fetch() ;
    
?>

<!DOCTYPE html>
<html lang="en" >

<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

<script>
    function fetchSodiumData() {
        const xhr1 = new XMLHttpRequest();
        xhr1.open('GET', 'reload.php?ajax=1', true);
        xhr1.onload = function() {
            if (this.status === 200) {
                console.log(this.responseText); // สำหรับการดีบัก
                try {
                    const result = JSON.parse(this.responseText);
                    const sodiumValueElement = document.getElementById('sodiumCard');
                    const sodiumValue = parseFloat(result.updated_SE_data);

                    sodiumValueElement.textContent = sodiumValue;

                    // เปลี่ยนสีตามค่าที่ได้รับ
                    if (sodiumValue < 1500) {
                        sodiumValueElement.style.color = '#2afa96';
                    } else if (sodiumValue >= 1500 && sodiumValue <= 2000) {
                        sodiumValueElement.style.color = '#ffa338';
                    } else if (sodiumValue > 2000) {
                        sodiumValueElement.style.color = '#ff0505';
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            } else {
                console.error('Failed to fetch data:', this.status, this.statusText);
            }
        };
        xhr1.send();
    }

    // เรียกใช้ฟังก์ชันเพื่ออัปเดตข้อมูลทุกๆ 5 วินาที
    setInterval(fetchSodiumData, 43200000);

    // เรียกใช้ฟังก์ชัน fetchSodiumData ครั้งแรกเมื่อเอกสารโหลดเสร็จ
  ment.addEventListener('DOMContentLoaded', fetchSodiumData);
</script>
    <!--<meta charset="utf-8">
    <title>Auto Refresh</title>
    <script>
        function autoRefresh() {
            setInterval(function() {
                location.reload();
            }, 2000); // รีเฟรชทุกๆ 5 วินาที (5000 มิลลิวินาที)
        }--> 
    </script>
    <link rel="icon" href="img/logo_sodium.png" type="image/png" sizes="48x48">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SodiumLoad</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
    .background_head {
        background-image: linear-gradient(0deg, #53a7d8 0%,#bce6ff 75% ) !important;/**/
        /*box-shadow: inset 0 0 0 2000px #ffffff !important;  กำหนดเงาด้วยสี */
    }
    .content{
        max-width: 1000px;
        margin: auto;
    }
    .content1{
        max-width: 280px;
        margin: 0;
    }
</style>

<body id="page-top" onload="autoRefresh()" class="background_head content">
<div class="col-xl-12 col-lg-5">
                    <!-- Page Heading -->
                    <style>
                        .Font_head{
                            
                            font-family: "Open Sans", sans-serif;
                            font-optical-sizing: auto;
                            font-weight: 700;
                            font-style: normal;
                            font-variation-settings:
                                "wdth" 100;
                            width: 100%;
                            }
                        .d-sm-flex-column {
                            display: flex;
                            flex-direction: column;
                            align-items: flex-start; /* จัดให้อยู่มุมขวา */
                        }

                        .d-sm-flex-column img:first-child {
                            margin-bottom: 10px; /* เพิ่มระยะห่างด้านล่างรูปภาพแรก */
                        }

                        .background-color-custom {
                            border: 5px solid black; /* ขอบหนา 2px สีดำ */
                            /*background-image: linear-gradient(0deg, #aafcff 0%,#049cf0 100% ) !important;  สีพื้นหลัง */
                            box-shadow: inset 0 0 0 10000px #45aaf7!important; /* กำหนดเงาด้วยสี */
                            border-radius: 20px; /* มุมกรอบกลมขึ้น */
                            padding: 0px; /* ลดขนาด padding */
                            margin-bottom: 0px; /* ลดระยะห่างระหว่างกรอบ */
                            width: 100%;
                        }
                        .text-color-custom {
                            color: #FFFFFF; /* สีตัวหนังสือ */
                        }
                        .text-color-custom-input {
                            color: #164863; /* สีตัวหนังสือ */
                        }
                        .card-body-custom {
                            margin: auto;
                            padding: 10px;
                            margin: 0px;
                            flex-basis: auto; /* กำหนดขนาดเริ่มต้นตามเนื้อหาภายใน */
                            font-size: 1.5rem; /* ขนาดตัวอักษร */
                        }
                        .value-container {
                            position: relative;
                            display: flex;
                            justify-content: space-between; /* จัดตำแหน่งให้อยู่ฝั่งซ้ายและขวา */
                            align-items: center; /* จัดให้อยู่กลางในแนวตั้ง */
                            width: 100%; /* ใช้ความกว้างเต็มที่ */
                        }   
                        .value-day {

                            color: #000000; /* สีตัวหนังสือ */
                            font-size: 1.5rem; /* ขนาดตัวอักษร */
                        }   
                        .value {
                            font-size: 4rem; /* ขนาดตัวอักษร */
                            line-height: 1;
                        }
                        .valuey {
                            font-size: 4rem; /* ขนาดตัวอักษร */
                        }
                        .valueinput {
                            font-size: 1.5rem; /* ขนาดตัวอักษร */
                        }
                        .valuemg {
                            position: absolute;
                            font-size: 1.5rem; /* ขนาดตัวอักษร */
                            bottom: 0;
                            right: 10px;
                            margin: -20px; /* ปรับมาร์จิ้นตามต้องการ */
                        }
                        .unit {
                            font-size: 1rem; /* ขนาดตัวอักษรของหน่วย */
                            margin-top: 0px; /* ระยะห่างระหว่างค่ากับหน่วย */
                        }
                        .title {
                            margin-bottom: 8px; /* ลดระยะห่างระหว่างกรอบข้อความกับตัวหนังสือ */
                        }
                        .flex-container {
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }
                        .tex_mg {
                            color: #000000; /* สีตัวหนังสือ */
                        } 
                        .shadow {
                            box-shadow: 10px 10px 5px #46e3ff !important; /* กำหนดเงาด้วยสี */
                        }
                        .shadow_img {
                            box-shadow: inset 0 0 0 2000px #FFFFFF !important; /* กำหนดเงาด้วยสี */
                        }
                    </style>
                    
                        <div class="col-xl-8 col-lg-5">
                            <a href="javascript:location.reload()">
                                <img src="img/logo_sodium.png" alt="Description of the image" width="98.5" height="45.5" class="shadow-sm shadow_img">
                            </a>
                            <img src="img/logo_RBM.png" alt="Description of the image" width="90" height="25.2" class="shadow-sm">
                        </div>
                        <div>
                            <span class="input-container"></span>
                        </div>
                        <div>
                            <span class="input-container"></span>
                        </div>
                    <!-- toDay -->
                    
                        
                            <div class=" content1 background-color-custom ">
                                <div class="  card-body-custom text-color-custom">
                                    
                                    <div class="title Font_head">
                                        Today Sodium Load
                                    </div>
                                </div>
                            </div>
                                    <div class="value-container">

                                        <div class="value-day">
                                            <?=$day['SE_data']?>
                                        </div> 
                                        <div id="sodiumCard" class="value ">
                                            <?=$updated_SE_data?> 
                                        </div>
                                        <div class="valuemg tex_mg">mg</div>
                                    </div>
                                    <div>
                                    <span class="input-container"></span>
                                    </div>
                            
                       
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var sodiumValueElement = document.getElementById('sodiumCard'); // ตรวจสอบว่า id นี้ถูกต้องหรือไม่
                            var sodiumValue = parseFloat('<?=$updated_SE_data?>');

                            if (sodiumValue < 1500) {
                                sodiumValueElement.style.color = '#00c951'; // สีเขียว
                            } else if (sodiumValue >= 1500 && sodiumValue <= 2000) {
                                sodiumValueElement.style.color = '#f88033'; // สีส้ม
                            } else if (sodiumValue > 2000) {
                                sodiumValueElement.style.color = '#ff4f4f'; // สีแดง
                            }
                        });
                    </script>

                    <!-- Yesterday -->
                        
                            
                                <div class=" content1 background-color-custom ">
                                    <div class="  card-body-custom text-color-custom">
                                        <div class="title Font_head">
                                        Yesterday Load
                                        </div>
                                    </div>
                                </div>
                                <div class="value-container">

                                    <div class="value-day">
                                        max. 2000 mg/day
                                    </div> 
                                    <div id="sodiumCard1" class="value ">
                                        <?=$updated_SE_data1?> 
                                    </div>
                                    <div class="valuemg tex_mg">mg</div>
                                </div>
                                        
                                        
                                    
                             
                       
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var sodiumValueElement1 = document.getElementById('sodiumCard1');
                                var sodiumValue1 = parseFloat('<?=$updated_SE_data1?>');

                                if (sodiumValue1 < 1500) {
                                    sodiumValueElement1.style.color = '#00c951';
                                } else if (sodiumValue1 >= 1500 && sodiumValue1 <= 2000) {
                                    sodiumValueElement1.style.color = '#f88033';
                                } else if (sodiumValue1 > 2000) {
                                    sodiumValueElement1.style.color = '#ff4f4f';
                                }
                            });
                        </script>
                        <!-- add -->

                            <style>
                                .input-container {
                                    display: inline-flex; /* ทำให้ช่องข้อความอยู่ในบรรทัดเดียวกับข้อความ */
                                    align-items: center; /* จัดแนวแนวตั้งให้ตรงกัน */
                                    margin: 0px 0;
                                    margin-right: 0px; /* เพิ่มระยะห่างระหว่าง input และปุ่ม */
                                }
                                .input-field {
                                    width: auto;
                                    padding: 5px;
                                    font-size: 1rem;
                                    border-radius: 5px;
                                    border: 1px solid #ccc;
                                    box-sizing: border-box;
                                }
                                .btn-circle {
                                    border-radius: 50%;
                                    width: 40px;
                                    height: 40px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    font-size: 1.2rem;
                                }
                                .text-center-custom {
                                    align-items: center; /* จัดให้อยู่ตรงกลางแนวนอน */
                                    text-align: center;
                                }
                                .margin{
                                    max-width: 1000px;
                                    margin: 0;
                                }
                            </style>
                                <div>
                                    <span class="input-container"></span>
                                </div>
                                        <div class=" margin card mb8 py3 border-bottom-info border-left-info ">
                                            <div class="  card-body text-color-custom-input valueinput text-center-custom">
                                                Enter Sodium Load
                                                    <span class="input-container"></span>
                                                    <span class="input-container"> 
                                                        <input type="text" id="shortInput" class="input-field" placeholder="YOUR SODIUM">
                                                    </span>
                                                    <span class="input-container"> 
                                                    <a id="infoButton" href="#" class="btn btn-info btn-circle">
                                                        <img src="img/Upload-Icon.png" alt="Upload Icon" style="width: 24px; height: 24px;">
                                                    </a>
                                                    </span>
                                            </div>
                                        </div>
                                   
                                
                            <script>
                                document.getElementById('infoButton').addEventListener('click', function(event) {
                                    event.preventDefault(); // Prevent default link behavior
                                    var sodiumValue = document.getElementById('shortInput').value;
                                    var xhr = new XMLHttpRequest();
                                    var baseUrl = 'https://sodiumload-40aeae535e35.herokuapp.com/sensql/sen_to_db.php?sodium_level=';
                                    var fullUrl = baseUrl + encodeURIComponent(sodiumValue);

                                    console.log('Full URL:', fullUrl); // ตรวจสอบว่า URL ถูกต้อง

                                    xhr.open('GET', fullUrl, true);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === 4) {
                                            console.log('XHR readyState:', xhr.readyState); // ตรวจสอบ readyState
                                            console.log('XHR status:', xhr.status); // ตรวจสอบ status
                                            if (xhr.status === 200) {
                                                // Process server response here
                                                alert('ข้อมูลถูกส่งเรียบร้อยแล้ว');
                                                location.reload(); // Refresh the page
                                            } else {
                                                console.error('Error:', xhr.statusText); // แสดงข้อผิดพลาด
                                            }
                                        }
                                    };
                                    xhr.send();
                                });
                            </script>  
                    

                    <!-- Content Row -->
                   
                       
                                <div>
                                    <span class="input-container"></span>
                                </div>
                            <!-- Area Chart -->
                            <div class="card  mb-4">
                                <div class="card-header py-3 Font_head">
                                    <h4 class="m-0 font-weight-bold text-primary">Sodium data for the past 7 days</h4>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                        <canvas id="myAreaChart" width="515" height="400" style="display: block; height: 320px; width: 412px;" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>

                        

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
        

</body>

</html>