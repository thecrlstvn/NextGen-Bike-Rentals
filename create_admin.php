<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('admin-assets/images/poly-abstract.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #005F15;
        }
        .btn-success {
            background-color: #00831D;
            border: none;
        }
        .btn-success:hover {
            background-color: #006f17;
        }
        label {
            font-weight: bold;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 370px; /* Adjust as per logo size */
        }
        .password-checklist {
            list-style: none;
            padding: 0;
        }
        .password-checklist li {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        .password-checklist li img {
            margin-right: 10px;
        }
        .valid {
            color: green;
        }
        .invalid {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <img src="admin-assets/images/admin-logo.png" alt="Logo" class="logo">
            <h2>Create Admin Account</h2>
            <form action="process_create_admin.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" required placeholder="Enter admin email">
                </div>
                <div class="mb-3">
                    <label for="admin_name" class="form-label">Admin Name</label>
                    <input type="text" name="admin_name" class="form-control form-control-lg" required placeholder="Enter admin name">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required placeholder="Enter password" oninput="checkPassword()">
                </div>

                <!-- Password Checklist -->
                <ul class="password-checklist">
                    <li id="lowercase" class="invalid"><img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">Lowercase & Uppercase Letters</li>
                    <li id="number" class="invalid"><img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">Number (0-9)</li>
                    <li id="special" class="invalid"><img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">Special Character (!@%&*)</li>
                    <li id="length" class="invalid"><img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">At least 10 Characters</li>
                </ul>

                <div class="mb-3">
                    <label for="admin_image" class="form-label">Admin Image</label>
                    <input type="file" name="admin_image" class="form-control form-control-lg" required>
                </div>
                <div class="mb-3">
                    <label for="pin" class="form-label">Admin PIN</label>
                    <input type="text" name="pin" class="form-control form-control-lg" required placeholder="Enter admin PIN">
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">Create Admin</button>
            </form>
        </div>
    </div>

    <script>
        function checkPassword() {
            const password = document.getElementById('password').value;
            const lowercase = /[a-z]/.test(password) && /[A-Z]/.test(password);
            const number = /[0-9]/.test(password);
            const special = /[!@%&*]/.test(password);
            const length = password.length >= 10;

            // Lowercase & Uppercase validation
            const lowercaseEl = document.getElementById('lowercase');
            if (lowercase) {
                lowercaseEl.classList.remove('invalid');
                lowercaseEl.classList.add('valid');
                lowercaseEl.innerHTML = '<img src="admin-assets/images/valid-icon.png" alt="valid" width="20">Lowercase & Uppercase Letters';
            } else {
                lowercaseEl.classList.remove('valid');
                lowercaseEl.classList.add('invalid');
                lowercaseEl.innerHTML = '<img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">Lowercase & Uppercase Letters';
            }

            // Number validation
            const numberEl = document.getElementById('number');
            if (number) {
                numberEl.classList.remove('invalid');
                numberEl.classList.add('valid');
                numberEl.innerHTML = '<img src="admin-assets/images/valid-icon.png" alt="valid" width="20">Number (0-9)';
            } else {
                numberEl.classList.remove('valid');
                numberEl.classList.add('invalid');
                numberEl.innerHTML = '<img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">Number (0-9)';
            }

            // Special character validation
            const specialEl = document.getElementById('special');
            if (special) {
                specialEl.classList.remove('invalid');
                specialEl.classList.add('valid');
                specialEl.innerHTML = '<img src="admin-assets/images/valid-icon.png" alt="valid" width="20">Special Character (!@%&*)';
            } else {
                specialEl.classList.remove('valid');
                specialEl.classList.add('invalid');
                specialEl.innerHTML = '<img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">Special Character (!@%&*)';
            }

            // Length validation
            const lengthEl = document.getElementById('length');
            if (length) {
                lengthEl.classList.remove('invalid');
                lengthEl.classList.add('valid');
                lengthEl.innerHTML = '<img src="admin-assets/images/valid-icon.png" alt="valid" width="20">At least 10 Characters';
            } else {
                lengthEl.classList.remove('valid');
                lengthEl.classList.add('invalid');
                lengthEl.innerHTML = '<img src="admin-assets/images/invalid-icon.png" alt="invalid" width="20">At least 10 Characters';
            }
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
