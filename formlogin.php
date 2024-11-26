<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300');
        body {
            background: linear-gradient(90deg, #dfe9f3 0%, #ffffff 100%);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-page {
            width: 360px;
            padding: 4% 0 0;
            margin: auto;
        }
        .form {
            position: relative;
            z-index: 1;
            background: #fff;
            max-width: 360px;
            margin: 0 auto 50px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }
        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 1px solid #ccc;
            margin: 0 0 20px;
            padding: 14px;
            box-sizing: border-box;
            font-size: 16px;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        .form input:focus {
            border-color: #5f9ea0;
        }
        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #5f9ea0;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #fff;
            font-size: 16px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            border-radius: 50px;
        }
        .form button:hover {
            background: #4682b4;
        }
        .form .message {
            margin: 15px 0 0;
            color: #777;
            font-size: 14px;
        }
        .form .message a {
            color: #5f9ea0;
            text-decoration: none;
        }
        .form .message a:hover {
            text-decoration: underline;
        }
        .form .register-form {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form class="register-form">
                <input type="text" placeholder="Name" />
                <input type="password" placeholder="Password" />
                <input type="email" placeholder="Email address" />
                <button type="button">Create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form" method="POST" action="ceklogin.php">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>

        </div>
    </div>
    <script>
        document.querySelectorAll('.message a').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelectorAll('form').forEach(form => {
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                });
            });
        });

        document.getElementById('loginButton').addEventListener('click', () => {
            const username = document.querySelector('.login-form input[type="text"]').value;
            const password = document.querySelector('.login-form input[type="password"]').value;

            if (username && password) {
                window.location.href = 'dashboard_pemilik.php';
            } else {
                alert('Please enter both username and password');
            }
        });
    </script>
</body>
</html>
