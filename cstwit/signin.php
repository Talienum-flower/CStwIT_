<?php
session_start();
require_once 'conn.php'; // Secure database connection

// Redirect logged-in users to their respective dashboard
if (isset($_SESSION['username'])) {
  switch ($_SESSION['role']) {
    case 'Administrator':
      header("Location: /cstwit/pages/admin/index.php");
      break;
    case 'User':
      header("Location: /cstwit/pages/user/index.php");
      break;
  }
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Sign In | CStwIT</title>
  <link href="/cstwit/assets/css/sb-admin-2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/cstwit/assets/css/style.css">
  <link rel="stylesheet" href="/cstwit/assets/css/validate.css">
  <link rel="icon" href="/cstwit/assets/img/owl-outline-logo.png" type="image/x-icon">
</head>

<body class="bg-danger-subtle">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9 align-items-center">
        <div class="card o-hidden border-0 shadow-lg my-5 py-5">
          <div class="card-body p-0">
            <div class="row d-flex align-items-center">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <div class="ml-5">
                  <h1 class="text-danger-subtle display-3 font-weight-bold">CStwIT</h1>
                  <p class="lead">Join now and never miss an update from your academic circle.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="d-flex justify-content-center">
                    <img src="/cstwit/assets/img/owl-logo.png" class="w-25 mb-2">
                  </div>
                  <div class="text-center">
                    <h1 class="mb-4 font-weight-bold text-danger-subtle">Sign In</h1>
                  </div>
                  <?php
                  if (isset($_SESSION['usernotfound'])) {
                    ?>
                    <div class="text-danger-subtle text-center mb-3" role="alert">
                      <?= $_SESSION['usernotfound']; ?>
                    </div>
                    <?php
                    unset($_SESSION['usernotfound']);
                  }
                  if (isset($_SESSION['invalidpassword'])) {
                    ?>
                    <div class="text-danger-subtle text-center mb-3" role="alert">
                      <?= $_SESSION['invalidpassword']; ?>
                    </div>
                    <?php
                    unset($_SESSION['invalidpassword']);
                  }
                  if (isset($_SESSION['registrationsuccess'])) {
                    ?>
                    <div class="text-success text-center mb-3" role="alert">
                      <?= $_SESSION['registrationsuccess']; ?>
                    </div>
                    <?php
                    unset($_SESSION['registrationsuccess']);
                  }
                  ?>
                  <form action="/cstwit/signinuser" method="POST" class="user needs-validation" novalidate>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" id="username"
                        aria-describedby="username" placeholder="Username" required />
                      <div class="invalid-feedback">
                        Please enter your username!
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password"
                        required />
                      <div class="invalid-feedback">
                        Please enter your password!
                      </div>
                    </div>
                    <button type="submit" class="btn btn-danger-subtle btn-user btn-block" id="signinButton">
                      <span id="loader" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                      <span id="buttonText">Sign In</span>
                    </button>
                    <hr />
                  </form>
                  <div class="text-center">
                    <a class="small text-danger-subtle text-decoration-none" href="forgot-password.php">Forgot
                      Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-danger-subtle text-decoration-none" href="signup.php">Do you have an account?
                      Sign Up</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/cstwit/assets/js/script.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/cstwit/assets/js/sb-admin-2.min.js"></script>
  <script>
    // Only run if the register button exists on the page
    const btn = document.getElementById("signinButton");

    if (btn) {
      btn.onclick = function (event) {
        event.preventDefault();

        let loader = document.getElementById("loader");
        let buttonText = document.getElementById("buttonText");
        let form = document.querySelector(".needs-validation");

        if (!form.checkValidity()) {
          form.classList.add("was-validated");
          return;
        }

        btn.disabled = true;
        loader.classList.remove("d-none");
        buttonText.textContent = "Signing in...";

        setTimeout(() => {
          form.submit();
        }, 1000);
      };
    }
  </script>
</body>

</html>