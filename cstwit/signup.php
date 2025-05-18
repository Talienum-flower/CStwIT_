<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Sign Up | CStwIT</title>
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
                    <h1 class="mb-4 font-weight-bold text-danger-subtle">Sign Up</h1>
                  </div>
                  <?php
                  if (isset($_SESSION['registrationfailed'])) {
                    ?>
                    <div class="text-danger-subtle text-center mb-3" role="alert">
                      <?= $_SESSION['registrationfailed']; ?>
                    </div>
                    <?php
                    unset($_SESSION['registrationfailed']);
                  }
                  ?>
                  <form action="signupuser" method="POST" class="user needs-validation" novalidate>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="name" id="name" aria-describedby="name"
                        placeholder="Name" required />
                      <div class="invalid-feedback">
                        Name is required.
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="email"
                        placeholder="Email Adddress" required />
                      <div class="invalid-feedback">
                        Email Address is required.
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username"
                        aria-describedby="username" placeholder="Username" required />
                      <div class="invalid-feedback">
                        Username is required.
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password"
                        required />
                      <div class="invalid-feedback">
                        Password is required.
                      </div>
                    </div>
                    <button type="submit" class="btn btn-danger-subtle btn-user btn-block" id="signupButton">
                      <span id="loader" class="spinner-border spinner-border-sm d-none" role="status"
                        aria-hidden="true"></span>
                      <span id="buttonText">Sign Up</span>
                    </button>
                    <hr />
                  </form>
                  <div class="text-center">
                    <a class="small text-danger-subtle text-decoration-none" href="forgot-password.php">Forgot
                      Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-danger-subtle text-decoration-none" href="signin.php">Already have an account?
                      Sign In</a>
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
    const btn = document.getElementById("signupButton");

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
        buttonText.textContent = "Signing up...";

        setTimeout(() => {
          form.submit();
        }, 1000);
      };
    }
  </script>
</body>

</html>