    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CDM RFID Attendance System</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="styleDASH.css">
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="Photos/cdmlogo.png" alt="School Logo">
                </div>
                <div class="logo-text">Colegio De Muntinlupa</div>
            </div>
            <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="menu">
                <a href="#" class="menu-item active">
                    <div class="menu-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="menu-text">Attendance</div>
                </a>
                <a href="http://localhost/Cognate2/ManageStudents/StudentManage.php#" class="menu-item" >
        <div class="menu-icon">
              <i class="fas fa-users"></i>
             </div>
         <div class="menu-text">Students</div>  
            </a>
                <a href="#" class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="menu-text">Visitors</div>
                </a>
                <a href="#" class="menu-item">
                    <div class="menu-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="menu-text">Reports</div>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="page-title">
                    <h1>RFID Attendance System</h1>
                    <p>Real-time monitoring of student attendance</p>
                </div>
                <div class="user-profile">
                    <div class="profile">
                        <img src="Photos/profile.png" alt="User " class="profile-img">
                        <div>
                            <div class="profile-name">Admin User</div>
                            <div class="profile-role">Attendance Officer</div>
                        </div>
                           
                    </div>
                     <div class="clock">
                                <i class="fas fa-clock clock-icon"></i>
                                <span id="clock">Loading time...</span>
                        </div>
                </div>
            </div>

           


            <!-- RFID Scanner Section -->
            <div class="rfid-scanner">
                <div class="scanner-header">
                    <div class="scanner-title">RFID Scanner</div>
                    <div class="scanner-status">
                        <div class="status-indicator status-active"></div>
                        <span>Scanner Active</span>
                    </div>
                </div>
                <div class="scanner-box" id="scannerBox" onclick="document.getElementById('rfidInput').focus()">
                    <div class="scanner-icon">
                        <i class="fas fa-rss"></i>
                    </div>
                    <div class="scanner-text">Ready to Scan</div>
                    <div class="scanner-hint">Click to focus or tap RFID card on reader</div>
                    <div class="scanner-animation">
                        <div class="scanner-beam"></div>
                    </div>
                </div>
               <input type="text" class="rfid-input" id="rfidInput" placeholder="Waiting for RFID scan..." autofocus>

            </div>

            
            <!-- Dashboard Cards (NOT DONE AT ALL) -->
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Total Students</div>
                        <div class="card-icon students">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="card-value" id="totalStudents">2795</div>
                    <div class="card-change positive">
                        <i class="fas fa-arrow-up"></i> <span id="studentChange">0%</span> from last month
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Present Today</div>
                        <div class="card-icon present">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="card-value" id="presentToday">0</div>
                    <div class="card-change positive">
                        <i class="fas fa-arrow-up"></i> <span id="presentChange">0%</span> from yesterday
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Visitors Today</div>
                        <div class="card-icon visitors">
                            <i class="fas fa-user-clock"></i>
                        </div>
                    </div>
                    <div class="card-value" id="visitorsToday">0</div>
                    <div class="card-change positive">
                        <i class="fas fa-arrow-up"></i> <span id="visitorChange">0</span> from yesterday
                    </div>
                </div>
            </div>


                
    
            <div class="attendance-section" > 
                <!-- Recent Activity -->
                <div class="recent-activity">
                    <div class="section-header">
                        <div class="section-title">Recent Check-ins</div>
                        <div class="view-all">View All</div>
                    </div>
                    <div class="attendance-table">
                        <table id= "recentEntries" , border ='2'>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name </th>
                                    <th>StudentNumber</th>
                                    <th>Course</th>
                                    <th>Time-In</th>
                                    <th>Time-Out</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody >
                        </table>
                    </div>
                </div>
                

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <div class="section-header">
                        <div class="section-title">Quick Actions</div>
                    </div>
                    <div class="action-buttons">
                        <button class="action-btn" onclick="window.location.href='../GeneratePDF.php';">
                            <div class="action-icon">
                                <i class="fas fa-file-export"></i>
                            </div>
                            <div class="action-text">Generate Report</div>
                        </button>
                        <button class="action-btn" onclick="openModal()">
                            <div class="action-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="action-text">Manual Attendance</div>
                        </button>
                    </div>
                </div>
            </div>


        <!--RFID MANUAL SCAN MODAL(TO BE CONFIGURED PA) -->
        <div class="modal" id="attendanceModal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Student Check-in/out</div>
                    <button class="close-modal" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" class="rfid-input" id="modalStudentNumInput" placeholder="Student Number" autofocus>
                    
                    <div class="student-info" id="studentInfo">
                        <img src="Photos/pic.png" alt="Student" class="student-avatar" id="studentAvatar">
                        <div class="student-name" id="studentName"></div>
                        <div class="student-id" id="studentId">Press Enter to continue</div>
                        
                        <div class="student-details">
                            <div class="detail-item">
                                <div class="detail-label">Rfid</div>
                                <div class="detail-value" id="rfid">--</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Course</div>
                                <div class="detail-value" id="course">--</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Firstname</div>
                                <div class="detail-value" id="firstname">--</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Surname</div>
                                <div class="detail-value" id="surname">--</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline" onclick="closeModal()">Cancel</button>
                    <button class="btn btn-primary" id="confirmBtn" onclick="confirmAttendance()" disabled>Confirm</button>
                </div>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
            // Toggle sidebar
            const toggleBtn = document.getElementById('toggleBtn');
            const sidebar = document.getElementById('sidebar');
            
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-collapsed');
            });

            // Update clock
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString();
                const dateString = now.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
                document.getElementById("clock").innerHTML = `${dateString} &bull; ${timeString}`;
            }
                setInterval(updateClock, 1000);
                updateClock();

            // Modal functions
            function openModal() {
                document.getElementById("attendanceModal").style.display = "flex";
                document.getElementById("modalStudentNumInput").focus();
            }

            function closeModal() {
                document.getElementById("attendanceModal").style.display = "none";
            }
            function manualCheckIn() {
                alert('Manual check-in feature would open here');
            }

            function generateReport() {
                alert('Generating attendance report...');
            }

            function viewDailySummary() {
                alert('Showing daily attendance summary');
            }

            

            
        //RECENT RFID INPUTS
 document.addEventListener('DOMContentLoaded', function () {
    let entryNumber = 1;

    // Refresh Table Function
    async function refreshTable() {
        const logs = await (await fetch('FetchLogs.php')).json();
        const tbody = document.querySelector('#recentEntries tbody');
        tbody.innerHTML = '';
        let entryNumber = 1;
        logs.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${entryNumber++}</td>
                <td>${user.firstname} ${user.surname}</td>
                <td>${user.studentnumber}</td>
                <td>${user.course}</td>
                <td>${user.time_in}</td>
                <td>${user.time_out || '-'}</td>
                <td>${user.date}</td>
            `;
            tbody.appendChild(row);
        });
    }

    refreshTable(); // Load existing logs on page load

    // RFID Input Event
    document.getElementById('rfidInput').addEventListener('keydown', async function (e) {
        if (e.key === 'Enter') {
            const Recentrfid = this.value.trim();
            if (Recentrfid.length >= 7) {
                try {
                    const scanTime = new Date();
                    const payload = new URLSearchParams({
                        rfid: Recentrfid,
                        time_in: scanTime.toLocaleTimeString('en-US', { hour12: false }),
                        date: scanTime.toISOString().slice(0, 10)
                    });

                    const response = await fetch('RecentRFID.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: payload
                    });
                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Attendance',
                        text: `Successful!`,
                        timer: 1000,
                        showConfirmButton: false
                        });
                        await refreshTable();
                    } else {
                        alert(data.error || 'RFID not recognized.');
                    }
                } catch (err) {
                    console.error('Error:', err);
                    alert('Error contacting server.');
                }

                this.value = '';
            }
        }
    });

    // Modal Student Number Input
    document.getElementById('modalStudentNumInput').addEventListener('keydown', async function (e) {
        if (e.key === 'Enter') {
            const studentNumber = this.value.trim();
            if (studentNumber.length >= 10) {
                try {
                    const response = await fetch(`FetchStudentByNumber.php?studentnumber=${studentNumber}`);
                    const data = await response.json();

                    if (data.success) {
                        const student = data.student;

                        document.getElementById('studentName').textContent = `${student.firstname} ${student.surname}`;
                        document.getElementById('studentId').textContent = student.studentnumber;
                        document.getElementById('rfid').textContent = student.rfid;
                        document.getElementById('course').textContent = student.course;
                        document.getElementById('firstname').textContent = student.firstname;
                        document.getElementById('surname').textContent = student.surname;

                        document.getElementById('confirmBtn').disabled = false;

                        window.selectedStudentNumber = studentNumber;
                    } else {
                        alert(data.error);
                        clearModalInfo();
                    }
                } catch (err) {
                    console.error('Error:', err);
                    alert('Failed to fetch student info.');
                    clearModalInfo();
                }
            }
        }
    });

            // Clear Modal Details
    function clearModalInfo() {
        document.getElementById('studentName').textContent = '';
        document.getElementById('studentId').textContent = 'Type Student Number to continue';
        document.getElementById('rfid').textContent = '--';
        document.getElementById('course').textContent = '--';
        document.getElementById('firstname').textContent = '--';
        document.getElementById('surname').textContent = '--';
        document.getElementById('confirmBtn').disabled = true;
    }

    
    window.confirmAttendance = async function () {
        const studentnumber = document.getElementById('modalStudentNumInput').value.trim();
        const timeNow = new Date();
        const time = timeNow.toLocaleTimeString('en-US', { hour12: false });
        const date = timeNow.toISOString().slice(0, 10);

        if (studentnumber.length === 0) return;

        const payload = new URLSearchParams({
            studentnumber: studentnumber,
            time: time,
            date: date
        });

        try {
            const response = await fetch('ManualCheckin.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: payload
            });
            const data = await response.json();

            if (data.success) {
               Swal.fire({
                icon: 'success',
                title: 'Comfirm!',
                text: `Successful ${data.action === 'timein' ? 'Time-in' : 'Time-out'}.`,
                timer: 2000,
                showConfirmButton: false
                });
                await refreshTable();
            } else {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error,
                timer: 2000,
                showConfirmButton: false
                     });
            }
        } catch (err) {
            console.error('Error:', err);
            alert('Server error.');
        }

        closeModal();
    };

});
    window.addEventListener('click', function(event) {
    const modal1 = document.getElementById('attendanceModal');
    if (event.target === modal1) {
        closeModal();
    }
});

</script>

    </body>
    </html>