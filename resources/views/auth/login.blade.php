<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword");
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.innerHTML = "👁️"; // Change icon to indicate visibility
            } else {
                passwordField.type = "password";
                toggleIcon.innerHTML = "👁️‍🗨️"; // Change icon back
            }
        }
    </script>
</head>
<body>
    <h2>Login</h2>

    <!-- Show Error Message if Login Fails -->
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <div style="position: relative; display: inline-block;">
            <input type="password" id="password" name="password" required>
            <span id="togglePassword" onclick="togglePassword()" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                👁️‍🗨️
            </span>
        </div>
        <br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
