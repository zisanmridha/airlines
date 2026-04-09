<head>
  <link rel="stylesheet" href="style.css">
</head>

<div class="container">
    <h3>Admin Login</h3>

    <form action="../controller/authController.php" method="POST" onsubmit="return validateLogin()">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <button name="login">Login</button>
    </form>

    <!-- Link to signup -->
    <p style="text-align:center; margin-top:15px;">
        Don't have an account? 
        <a href="signup.php">Signup here</a>
    </p>
</div>

<script>
function validateLogin(){
    let u = document.forms[0]["username"].value;
    let p = document.forms[0]["password"].value;
    if(u=="" || p==""){
        alert("All fields are required!");
        return false;
    }
    return true;
}
</script>
