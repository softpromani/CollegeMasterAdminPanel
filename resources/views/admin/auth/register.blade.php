<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>

  <!-- Bootstrap CSS -->
  <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #4e73df, #224abe);
      min-height: 100vh;
    }

   

    .register-card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
    }

    .register-left {
      background: linear-gradient(135deg, #0d6efd, #3b82f6);
      color: white;
    }

    .form-control {
      height: 50px;
      border-radius: 12px;
    }

    .btn-register {
      height: 50px;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
    }

    .logo-circle {
      width: 70px;
      height: 70px;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
    }

    .divider {
      width: 60px;
      height: 4px;
      background: white;
      border-radius: 10px;
    }

    .form-check-input {
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div class="container">

    <div class="row min-vh-100 justify-content-center align-items-center">

      <div class="col-lg-10">

        <div class="card shadow-lg register-card">

          <div class="row g-0">

            <!-- Left Side -->
            <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-center align-items-center p-5 register-left">

              <div class="logo-circle d-flex justify-content-center align-items-center mb-4">
                <i class="bi bi-person-plus-fill fs-1 text-white"></i>
              </div>

              <h2 class="fw-bold mb-3">Join With Us!</h2>

              <div class="divider mb-4"></div>

              <p class="text-center fs-6">
                Create your account and start managing your dashboard easily and securely.
              </p>

            </div>

            <!-- Right Side -->
            <div class="col-lg-7">

              <div class="p-4 p-md-5">

                <div class="text-center mb-4">

                  <h3 class="fw-bold mb-2">Create Account</h3>

                  <p class="text-muted">
                    Fill all details to create your account
                  </p>

                </div>

                <form class="needs-validation" novalidate>

                  <!-- Name -->
                  <div class="mb-3">

                    <label class="form-label fw-semibold">
                      Full Name
                    </label>

                    <div class="input-group">

                      <span class="input-group-text bg-white">
                        <i class="bi bi-person"></i>
                      </span>

                      <input type="text"
                        class="form-control"
                        placeholder="Enter your full name"
                        required>

                    </div>

                    <div class="invalid-feedback">
                      Please enter your name
                    </div>

                  </div>

                  <!-- Email -->
                  <div class="mb-3">

                    <label class="form-label fw-semibold">
                      Email Address
                    </label>

                    <div class="input-group">

                      <span class="input-group-text bg-white">
                        <i class="bi bi-envelope"></i>
                      </span>

                      <input type="email"
                        class="form-control"
                        placeholder="Enter your email"
                        required>

                    </div>

                    <div class="invalid-feedback">
                      Please enter valid email
                    </div>

                  </div>

                  <!-- Username -->
                  <div class="mb-3">

                    <label class="form-label fw-semibold">
                      Username
                    </label>

                    <div class="input-group">

                      <span class="input-group-text bg-white">
                        @
                      </span>

                      <input type="text"
                        class="form-control"
                        placeholder="Choose username"
                        required>

                    </div>

                    <div class="invalid-feedback">
                      Please choose username
                    </div>

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

                      <input type="password"
                        class="form-control"
                        placeholder="Enter password"
                        required>

                    </div>

                    <div class="invalid-feedback">
                      Please enter password
                    </div>

                  </div>

                  <!-- Terms -->
                  <div class="mb-4">

                    <div class="form-check">

                      <input class="form-check-input"
                        type="checkbox"
                        id="terms"
                        required>

                      <label class="form-check-label" for="terms">
                        I agree to the
                        <a href="#" class="text-decoration-none">
                          Terms & Conditions
                        </a>
                      </label>

                    </div>

                  </div>

                  <!-- Button -->
                  <div class="d-grid mb-4">

                    <button type="submit"
                      class="btn btn-primary btn-register shadow-sm">

                      <i class="bi bi-person-check-fill me-2"></i>
                      Create Account

                    </button>

                  </div>

                  <!-- Footer -->
                  <div class="text-center">

                    <span class="text-muted">
                      Already have an account?
                    </span>

                    <a href="#"
                      class="text-decoration-none fw-semibold">
                      Login
                    </a>

                  </div>

                </form>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
