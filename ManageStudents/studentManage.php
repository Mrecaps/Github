<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - CDM</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../Dashboard/styleDASH.css">
    <link rel="stylesheet" href="styleMANAGE.css">
</head>
<body>

<div class="management-container">
        <div class="header-section">
            <div class="page-title2">
                <h1>Student Management</h1>
                <p>Colegio De Muntinlupa Student Records</p>
            </div>
            <div class="action-buttons">
                <a href="http://localhost/Cognate2/Dashboard/Dashboard.php#" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
                <button class="btn btn-primary" onclick="openRegisterModal()">
                    <i class="fas fa-user-plus"></i>
                    Register Student
                </button>
            </div>
        </div>

        <div class="student-table">
            <table border ="2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rfid</th>
                        <th>Student Number</th>
                        <th>Firstname</th>
                        <th>Surname</th>    
                        <th>Course</th>
                        <th style = "text-indent:35px">Action</th>
                    </tr>
                </thead>

                <tbody id= "attendanceTableBody">
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "attendance_db";

                        $connection = new mysqli($servername, $username, $password, $database);
                        if($connection->connect_error){
                            die("Connection Failed you fool: " . $connection->connect_error);
        
                        }

                        $sql = "SELECT * FROM rfidtable_attendance";
                        $result = $connection->query($sql);
                        if(!$result) {
                            die("Invalid query: ". $connection->error);
                        }

                        while($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                        <td> <?php echo $row["id"] ?></td>
                                        <td> <?php echo $row["rfid"] ?> </td>
                                        <td> <?php echo $row["studentnumber"]?> </td>
                                        <td> <?php echo $row["firstname"] ?> </td>
                                        <td> <?php echo $row["surname"]?> </td>
                                        <td> <?php echo $row["course"]?> </td>

                                        <td>
                                        <button class = 'btn btn-primary btn-sm' onclick="openEditModal(<?= $row['id'] ?>)">Edit</button>
                                        <button class = 'btn btn-danger btn-sm' onclick="openDeleteModal(<?= $row['id'] ?>)">Delete</button>
                                        </td>
                                    
                                </tr>
                                <?php
                            }
                            ?>
                </tbody>
            </table>
        </div>
    </div>




    <!-- Register Modal -->
    <div class="modal" id="RegisterModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Student Registration</div>
                <button class="close-modal" onclick="closeRegisterModal()">&times;</button>
            </div>  
            <div class="modal-body">
                <form id="studentForm" method="POST" action="register_student.php"> 
                    <div class="form-row">
                        <div class="input-group">
                            <label for="studentnumber"><strong>Student Number</strong></label>
                            <input type="text" id="studentnumber" name="studentnumber" required class="rfid-input">
                        </div>
                        <div class="input-group">
                            <label for="rfid"><strong>RFID ID</strong></label>
                            <input type="text" id="rfid" name="rfid" required class="rfid-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label for="firstname"><strong>First Name</strong></label>
                            <input type="text" id="firstname" name="firstname" required class="rfid-input">
                        </div>
                        <div class="input-group">
                            <label for="surname"><strong>Surname</strong></label>
                            <input type="text" id="surname" name="surname" required class="rfid-input">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="course"><strong>Course</strong></label>
                        <select id="course" name="course" class="rfid-input" required>
                            <option value="">Select course</option>
                            <option value="BSCPE">BS Computer Engineering</option>
                            <option value="BSCE">BS Civil Engineering</option>
                            <option value="BSME">BS Mechanical Engineering</option>
                            <option value="BSIE">BS Industrial Engineering</option>
                            <option value="BSEE">BS Electrical Engineering</option>
                            <option value="BSESNE">BS Environmental and Sanitary Engineering</option>
                            <option value="BSECE">BS Electronics Engineering</option>
                            <option value="BSAR">BS Architecture</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="closeRegisterModal()">Cancel</button>
                        <button class="btn btn-primary" type="submit">Register Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    

    <!-- Edit Modal -->
    <div class="modal" id="EditModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Edit Student Information</div>
            <button class="close-modal" onclick="closeEditModal()">&times;</button>
        </div>  
        <div class="modal-body">
            <form id="editStudentForm" method="POST" action="edit.php">
                <input type="hidden" id="edit-id" name="id"> 
                
                <div class="form-row">
                    <div class="input-group">
                        <label for="edit-studentnumber"><strong> Student Number</strong> </label>
                        <input type="text" id="edit-studentnumber" name="studentnumber" required class="rfid-input">
                    </div>
                    <div class="input-group">
                        <label for="edit-rfid"><strong> RFID ID</strong> </label>
                        <input type="text" id="edit-rfid" name="rfid" required class="rfid-input">
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="edit-firstname"><strong>First Name</strong> </label>
                        <input type="text" id="edit-firstname" name="firstname" required class="rfid-input">
                    </div>
                    <div class="input-group">
                        <label for="edit-surname"><strong>Surname</strong> </label>
                        <input type="text" id="edit-surname" name="surname" required class="rfid-input">
                    </div>
                </div>

                <div class="input-group">
                    <label for="edit-course"><strong>Course</strong> </label>
                    <select id="edit-course" name="course" class="rfid-input" required>
                        <option value="">Select course</option>
                        <option value="BSCPE">BS Computer Engineering</option>
                        <option value="BSCE">BS Civil Engineering</option>
                        <option value="BSME">BS Mechanical Engineering</option>
                        <option value="BSIE">BS Industrial Engineering</option>
                        <option value="BSEE">BS Electrical Engineering</option>
                        <option value="BSESNE">BS Environmental and Sanitary Engineering</option>
                        <option value="BSECE">BS Electronics Engineering</option>
                        <option value="BSAR">BS Architecture</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeEditModal()">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update Student</button>
                </div>
            </form>
        </div>
     </div>
    </div>


    
    <!-- Delete Modal -->
    <div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Confirm Deletion</div>
            <button class="close-modal" onclick="closeDeleteModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete this student record?</p>
            <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn btn-danger" onclick="deleteStudent()">Delete</button>
        </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
         //Page refresh PREVENTOR
        document.getElementById('studentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('register_student.php', {
            method: 'POST',
            body: formData
            })
            .then(res => res.text())
            .then(response => {
            alert(response);
            closeRegisterModal();
            this.reset();
            })
            .catch(error => console.error('Error:', error));
            });

        function openRegisterModal() {
            document.getElementById("RegisterModal").style.display = "flex";
        }

        function closeRegisterModal() {
            document.getElementById("RegisterModal").style.display = "none";
        }

        
        // Opening Edit Modal
        function openEditModal(studentId) {
    fetch(`edit.php?id=${studentId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (!data.id) {
                throw new Error('Invalid student data');
            }
            
            // Populate form fields
            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-studentnumber').value = data.studentnumber;
            document.getElementById('edit-rfid').value = data.rfid;
            document.getElementById('edit-firstname').value = data.firstname;
            document.getElementById('edit-surname').value = data.surname;
            document.getElementById('edit-course').value = data.course;
            
            document.getElementById('EditModal').style.display = 'flex';
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert(`Error loading student data: ${error.message}`);
        });
        }
        //Closing Edit Modal
        function closeEditModal() {
            document.getElementById("EditModal").style.display = "none";
        }

        // Update the edit form handler
        document.getElementById('editStudentForm').addEventListener('submit', function(e) {
        e.preventDefault();
    
        const formData = new FormData(this);
    
    // Convert number fields explicitly
    formData.set('studentnumber', parseInt(formData.get('studentnumber')));
    formData.set('rfid', parseInt(formData.get('rfid')));
    
    fetch('edit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
             Swal.fire({
            icon: 'success',
            title: 'Added successfully!!',
            text: data.error,
            timer: 2000,
            showConfirmButton: false
        });
            location.reload();
        } else {
            alert('Error: ' + (data.error || 'Update failed'));
        }
    })
    .catch(error => console.error('Error:', error));
});

function openDeleteModal(id) {
    document.getElementById('id').value = id;
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

function deleteStudent() {
    const id = document.getElementById('id').value;
    
    fetch('delete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + encodeURIComponent(id)
    })
    .then(response => response.text())
    .then(result => {
        alert(result);
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Deletion failed');
    });
}


    // Close when clicking outside function
    window.addEventListener('click', function(event) {
    const modal1 = document.getElementById('EditModal');
    const modal2 = document.getElementById('RegisterModal');
    const modal3 = document.getElementById('deleteModal');

    if (event.target === modal1) {
        closeEditModal();
    } else if (event.target === modal2) {
        closeRegisterModal();
    } else if (event.target === modal3) {
        closeDeleteModal();
    }
});


  function loadAttendanceLogs() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_logs.php", true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById("attendanceTableBody").innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }

  // Load immediately and then every 5 seconds
  loadAttendanceLogs();
  setInterval(loadAttendanceLogs, 5000);





    
    </script>
</body>
</html>