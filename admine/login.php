
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<link rel="stylesheet" href="login.css">
    <style>
        body {
	background-color: #f7f7f7;
	font-family: Arial, Helvetica, sans-serif;
    background-color: #F0F3F4;
    /* Set the initial background color */
    animation: Change 6s infinite;
    /* Apply the animation */
  }
  
  @keyframes Change {
    0% { background-color: #F0F3F4; }
    25% { background-color: #E67E22; }
    50% { background-color: #3498DB; }
    75% { background-color: #27AE60; }
    100% { background-color: #F0F3F4; }
  }
        </style>
</head>
<body>
	<div class="container">
		<form action="process.php" method="POST">
		
			<h2 class="heading">Welcome to our website!</h2>
			<p class="subheading">Please enter your email and password to log in.</p>
			<div class="form-group">
				<input type="email" name="email" value="" placeholder="Email" class="form-control">
			</div>
			<div class="form-group">
				<input type="password" name="motdepasse" value="" placeholder="Password" class="form-control">
			</div>
			<button type="submit" name="loginbt" class="btn btn-primary btn-block">Login</button>
			<p class="signup-link">Don't have an account? <a href="signup.php">Signup</a></p>
		</form>
	</div>
	<script src="index.js"></script>
</body>
</html>