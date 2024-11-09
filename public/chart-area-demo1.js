document.addEventListener('DOMContentLoaded', function () {
    // หาตัวเลือกของ canvas ที่จะวาดกราฟ
    var ctx = document.getElementById('myAreaChart').getContext('2d');

    // สร้างวันที่ย้อนหลังไปอีก 7 วัน
    function getLast7DaysLabels() {
        let labels = [];
        let currentDate = new Date(); // วันที่ปัจจุบัน

        for (let i = 6; i >= 0; i--) {
            let date = new Date();
            date.setDate(currentDate.getDate() - i);
            labels.push(date.toISOString().slice(0, 10)); // รับวันในรูปแบบ YYYY-MM-DD
        }

        return labels;
    }

    // กำหนด labels ให้กับกราฟ
    var labels = getLast7DaysLabels();

    // สร้างกราฟพื้นที่
    var myAreaChart = new Chart(ctx, {
        type: 'line', // กำหนดประเภทของกราฟเป็น 'line' (กราฟพื้นที่)
        data: {
            labels: labels, // ใส่ข้อมูลวันที่ย้อนหลัง 7 วัน
            datasets: [{
                label: 'My Dataset', // ชื่อของชุดข้อมูล
                data: [65, 59, 80, 81, 56, 55, 40], // ข้อมูลที่จะแสดงในกราฟ
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // สีพื้นหลังของกราฟ
                borderColor: 'rgba(75, 192, 192, 1)', // สีเส้นขอบของกราฟ
                borderWidth: 1 // ความหนาของเส้นขอบ
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // เริ่มที่ศูนย์บนแกน Y
                }
            }
        }
    });
});