
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; }
        form { max-width: 500px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"], select { width: 100%; padding: 8px 10px; border-radius: 5px; border: 1px solid #ccc; }
        input[type="checkbox"] { margin-right: 5px; }
        button { padding: 10px 15px; border: none; background-color: #007bff; color: #fff; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #0069d9; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Create Account</h2>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<form method="POST" action="/user/create-account">
    @csrf
    <!-- OR explicit hidden CSRF input -->
    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->

    <!-- Name -->
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}" required>
        @error('name')<span class="error">{{ $message }}</span>@enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
        @error('email')<span class="error">{{ $message }}</span>@enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password" required>
        @error('password')<span class="error">{{ $message }}</span>@enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
    </div>

    <!-- Mobile Number -->
    <div>
        <label for="mobile">Mobile Number</label>
        <input type="text" name="mobile" id="mobile" placeholder="Enter your mobile number" value="{{ old('mobile') }}">
        @error('mobile')<span class="error">{{ $message }}</span>@enderror
    </div>

    <!-- Gender -->
    <div>
        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="">Select Gender</option>
            <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
            <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
            <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
        </select>
        @error('gender')<span class="error">{{ $message }}</span>@enderror
    </div>

    <!-- Terms & Conditions -->
    <div>
        <input type="checkbox" name="terms" id="terms" required {{ old('terms') ? 'checked' : '' }}>
        <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
        @error('terms')<span class="error">{{ $message }}</span>@enderror
    </div>

    <!-- Submit -->
    <div style="text-align:center;">
        <button type="submit">Create Account</button>
    </div>
</form>

</body>
</html>

