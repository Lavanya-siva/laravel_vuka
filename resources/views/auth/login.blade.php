
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2779bd;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .links {
            text-align: center;
            margin-top: 10px;
        }
        .links a {
            color: #3490dc;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <form method="POST" action="/login">
            @csrf

            <!-- Email -->
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')<span class="error">{{ $message }}</span>@enderror

            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            @error('password')<span class="error">{{ $message }}</span>@enderror

            <!-- Submit -->
            <button type="submit">Login</button>

            <!-- Links -->
            <div class="links">
                <a href="/user/create-account">Create Account</a>
            </div>
        </form>
    </div>
</body>
</html>

