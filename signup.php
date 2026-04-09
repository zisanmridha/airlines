<head>
  <link rel="stylesheet" href="style.css">
</head>

<div class="container">
    <h3>Admin Signup</h3>

    <form action="../controller/authController.php" method="POST">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <button name="signup">Signup</button>
    </form>

    <!-- Link to login -->
    <p style="text-align:center; margin-top:15px;">
        Already have an account? 
        <a href="login.php">Login here</a>
    </p>
</div>
