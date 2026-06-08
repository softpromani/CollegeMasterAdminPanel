<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;

            background: url('admin/assets/img/login-background.jpg') no-repeat center center/cover;
            opacity: 1;

            z-index: -1;
        }



        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            position: relative;


            background: rgba(255, 255, 255, 0.6);


            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .login-left {
            background: linear-gradient(135deg, #facc15, #f59e0b);
            color: white;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
        }

        .btn-login {
            height: 50px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(135deg, #facc15, #f59e0b);
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        .divider {
            width: 60px;
            height: 4px;
            background: white;
            border-radius: 10px;
        }


        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }


        .col-lg-7 {
            position: relative;
            z-index: 2;

            animation: emergeFromLeft 3s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }



        @keyframes emergeFromLeft {

            0% {
                opacity: 0;
                transform: translateX(-250px);
            }

            60% {
                opacity: 0.7;
                transform: translateX(-40px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }









        .wave-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
        }


        .wave-bg span {
            position: absolute;
            width: 200%;
            height: 200%;

            background: radial-gradient(circle,
                    rgba(250, 204, 21, 0.18) 0%,
                    transparent 60%);

            border-radius: 40%;

            animation: waveMove 15s linear infinite;
        }

        /* Different Layers */
        .wave-bg span:nth-child(1) {
            top: -60%;
            left: -20%;
            animation-duration: 18s;
        }

        .wave-bg span:nth-child(2) {
            top: -65%;
            left: -30%;
            animation-duration: 25s;
        }

        .wave-bg span:nth-child(3) {
            top: -70%;
            left: -25%;
            animation-duration: 20s;
        }

        .wave-bg span:nth-child(4) {
            top: -75%;
            left: -35%;
            animation-duration: 30s;
        }

        .wave-bg span:nth-child(5) {
            top: -80%;
            left: -40%;
            animation-duration: 35s;
        }

        /* Animation */
        @keyframes waveMove {

            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>


    <!-- BODY KE ANDAR SABSE UPAR -->
    <div class="wave-bg">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="container">

        <div class="row min-vh-100 justify-content-center align-items-center">

            <div class="col-lg-7">

                <div class="card shadow-lg login-card">

                    <div class="row g-0">

                        <!-- Left Side -->
                        <div
                            class="col-lg-5 d-none d-lg-flex flex-column justify-content-center align-items-center p-5 login-left">

                            <div
                                class="logo-circle d-flex justify-content-center align-items-center mb-4 bg-white shadow">

                                <img src="{{ asset('admin/assets/img/logo.jpg') }}" alt="LNMU Logo"
                                    style="width: 100px; height: 100px; object-fit: contain;   mix-blend-mode: multiply;">

                            </div>

                            <h2 class="fw-bold mb-3">Welcome Back!</h2>

                            <div class="divider mb-4"></div>

                            <p class="text-center fs-6">
                                Login to access your dashboard and manage your system easily.
                            </p>

                        </div>

                        <!-- Right Side -->
                        <div class="col-lg-7">

                            <div class="p-4 p-md-5">

                                <div class="text-center mb-4">

                                    <h3 class="fw-bold mb-2">Admin Login</h3>

                                    <p class="text-muted">
                                        Enter your credentials to continue
                                    </p>

                                </div>

                                <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate>

                                    @csrf

                                    <!-- Email -->
                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">
                                            Email
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text bg-white">
                                                <i class="bi bi-envelope"></i>
                                            </span>

                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter email" value="{{ old('email') }}" required>

                                        </div>

                                        @error('email')
                                            <div class="text-danger small mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <!-- Password -->
                                  
<div class="mb-3">

    <label class="form-label fw-semibold">
        Password
    </label>

    <div class="input-group">

        <span class="input-group-text bg-white">
            <i class="bi bi-lock"></i>
        </span>

        <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            placeholder="Enter password"
            required
        >

        <span
            class="input-group-text bg-white"
            style="cursor:pointer"
            onclick="togglePassword()"
        >
            <i class="bi bi-eye" id="toggleIcon"></i>
        </span>

    </div>

    @error('password')
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror

</div>

                                    <!-- Remember + Forgot -->
                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <div class="form-check">

                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="rememberMe">

                                            <label class="form-check-label" for="rememberMe">
                                                Remember Me
                                            </label>

                                        </div>

                                        <a href="#" class="text-decoration-none">
                                            Forgot Password?
                                        </a>

                                    </div>

                                    <!-- Button -->
                                    <div class="d-grid mb-4">

                                        <button type="submit" class="btn btn-primary btn-login shadow-sm">

                                            <i class="bi bi-box-arrow-in-right me-2"></i>

                                            Login

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
function togglePassword() {

    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('toggleIcon');

    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');

    } else {

        password.type = 'password';

        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');

    }
}
</script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
