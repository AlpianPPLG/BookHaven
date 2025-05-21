<?php
session_start();

if(isset($_SESSION["signIn"]) ) {
  header("Location: ../../DashboardAdmin/dashboardAdmin.php");
  exit;
}

require "../../loginSystem/connect.php";

if(isset($_POST["signIn"]) ) {
  
  $nama = strtolower($_POST["nama_admin"]);
  $password = $_POST["password"];
  
  $result = mysqli_query($connect, "SELECT * FROM admin WHERE nama_admin = '$nama' AND password = '$password' ");
  
  if(mysqli_num_rows($result) === 1) {
    //SET SESSION 
    $_SESSION["signIn"] = true;
    $_SESSION["admin"]["nama_admin"] = $nama;
    header("Location: ../../DashboardAdmin/dashboardAdmin.php");
      exit;
  }
  $error = true;
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Sign In || Admin</title>
    <style>
    :root {
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #3f37c9;
        --success: #4ade80;
        --danger: #ef4444;
        --text-dark: #1e293b;
        --text-light: #f8fafc;
        --bg-light: #f8f9fa;
        --bg-dark: #0f172a;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f6f9fc 0%, #edf2f7 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .container {
        max-width: 500px;
    }

    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: white;
        position: relative;
    }

    .card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        opacity: 0.1;
    }

    .card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--success) 0%, var(--primary) 100%);
        opacity: 0.1;
    }

    .logo-container {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 10;
        border: 5px solid white;
    }

    .logo-container img {
        width: 70px;
        height: auto;
    }

    h1 {
        color: var(--text-dark);
        font-weight: 700;
        margin-top: 1.5rem;
        font-size: 2rem;
    }

    hr {
        background-color: rgba(0, 0, 0, 0.05);
        margin: 1.5rem 0;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .input-group {
        margin-bottom: 1.5rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.03);
        border-radius: 8px;
        overflow: hidden;
    }

    .input-group-text {
        background-color: var(--primary);
        border: none;
        color: white;
        padding-left: 15px;
        padding-right: 15px;
    }

    .form-control {
        border: none;
        padding: 12px 15px;
        font-size: 1rem;
        background-color: white;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: var(--primary);
    }

    .btn {
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
    }

    .btn-success {
        background-color: #10b981;
        border-color: #10b981;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-success:hover {
        background-color: #0d9668;
        border-color: #0d9668;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
    }

    .alert-danger {
        background-color: #fee2e2;
        border: none;
        color: #b91c1c;
        border-radius: 8px;
        padding: 15px;
        font-weight: 500;
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.2);
        display: flex;
        align-items: center;
        animation: shake 0.5s ease-in-out;
    }

    .alert-danger::before {
        content: '\f071';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        margin-right: 10px;
        font-size: 1.2rem;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translateX(-5px);
        }

        20%,
        40%,
        60%,
        80% {
            transform: translateX(5px);
        }
    }

    .invalid-feedback {
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .container {
            padding: 0 15px;
        }

        h1 {
            font-size: 1.75rem;
        }

        .btn {
            padding: 10px 20px;
        }
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeIn 0.6s ease forwards;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-center">
                <div class="logo-container">
                    <img src="../../assets/adminLogo.png" alt="Admin Logo">
                </div>
            </div>
            <h1 class="text-center">Admin Sign In</h1>
            <hr>

            <form action="" method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="validationCustom01" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" name="nama_admin" id="validationCustom01"
                            placeholder="Masukkan nama admin" required>
                        <div class="invalid-feedback">
                            Masukkan Nama anda!
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="validationCustom02" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" id="validationCustom02" name="password"
                            placeholder="Masukkan password" required>
                        <div class="invalid-feedback">
                            Masukkan Password anda!
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex">
                    <button class="btn btn-primary flex-grow-1" type="submit" name="signIn">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
                    </button>
                    <a class="btn btn-success" href="../link_login.html">
                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>

        <?php if(isset($error)) : ?>
        <div class="alert alert-danger mt-3" role="alert">
            Nama atau Password Salah!
        </div>
        <?php endif; ?>
    </div>

    <script>
    // Form validation
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>