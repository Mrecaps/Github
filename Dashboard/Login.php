<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDM Attendance System - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styleLOGIN.css">
</head>
<body>
    <div class="login-container">
        <img src="Photos/cdmlogo.png" alt="CDM Logo" class="logo">
        <h2>Attendance System Login</h2>
        
        <form id="loginForm" action="dashboard.html" method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit">Login</button>
            
            <a href="#" class="forgot-password">Forgot password?</a>
            
            <div class="error-message" id="errorMessage">
                Invalid username or password. Please try again.
            </div>
        </form>
    </div>


    
    <script>
         document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
           
            if (username === 'admin' && password === 'admin123') {
                sessionStorage.setItem('isAuthenticated', 'true');
                sessionStorage.setItem('username', username);
                
                window.location.href = 'Dashboard.php';
            } else {
                showError();
            }
        });
        
        function showError() {
            const errorElement = document.getElementById('errorMessage');
            errorElement.style.display = 'block';
            
            const form = document.getElementById('loginForm');
            form.classList.add('shake');
            setTimeout(() => {
                form.classList.remove('shake');
            }, 500);
        }
    </script>
</body>
</html>