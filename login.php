<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="inset">
       
        <form id="loginForm" action="login">
        <h1>Login</h1>
            <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            </p>
            <p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            </p>
            <p class="p-container">
            <button type="submit">Login</button>
            </p>
        </form>
    </div>
   <script src="login.js"></script>
</body>
</html>