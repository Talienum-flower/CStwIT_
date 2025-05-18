<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/cstwit/auth.php';
checkRole(['User']); // Only User can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Settings | CStwIT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/cstwit/assets/css/adminlte.css" />
  <link rel="stylesheet" href="/cstwit/assets/css/style.css">
  <link rel="stylesheet" href="/cstwit/assets/css/validate.css">
  <link rel="icon" href="/cstwit/assets/img/owl-outline-logo.png" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">
  <di class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-header-danger-subtle" data-bs-theme="dark">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <li class="nav-item dropdown user-menu bg-header-danger-subtle">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img src="/cstwit/assets/img/owl-outline-logo.png" class="user-image rounded-circle shadow" alt="User" />
              <span class="d-none d-md-inline"><?php echo getFullname() ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header bg-header-danger-subtle">
                <img src="/cstwit/assets/img/owl-outline-logo.png" class="rounded-circle shadow" alt="User Image" />
                <p>
                  <?php echo getFullname() ?>
                  <small><?php echo getUsername() ?></small>
                </p>
              </li>
              <li class="bg-header-danger-subtle p-3">
                <a href="profile.php" class="btn btn-danger-subtle">Profile</a>
                <a href="/cstwit/signout.php" class="btn btn-danger-subtle float-end">Sign out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <aside class="app-sidebar bg-header-danger-subtle" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="index.php" class="brand-link">
          <img src="/cstwit/assets/img/owl-outline-logo.png" alt="Logo" class="brand-image" />
          <span class="brand-text fw-bold">CStwIT</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon bi bi-house"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="followers.php" class="nav-link">
                <i class="nav-icon bi bi-person-add"></i>
                <p>
                  Followers
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="settings.php" class="nav-link">
                <i class="nav-icon bi bi-gear"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0 text-danger-subtle fw-bold fs-1">Settings</h3>
            </div>
          </div>
        </div>
      </div>
      <?php
          if (isset($_SESSION['updatesuccess'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
              <?= $_SESSION['updatesuccess']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['updatesuccess']);
          }
          if (isset($_SESSION['updateerror'])) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
              <?= $_SESSION['updateerror']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['updateerror']);
          }
          ?>
      <div class="app-content">
        <div class="container-fluid">
          <?php
          $id = userID(); // Assuming this returns a valid user ID
          if (!empty($id)) {
            // Use a prepared statement for security
            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id); // 'i' for integer
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
            } else {
              // Handle case where no user is found
              $row = null;
            }

            mysqli_stmt_close($stmt);
          } else {
            $row = null;
            // Optionally handle empty user ID
          }
          ?>
          <div class="card mb-3">
            <div class="card-header fw-bold text-danger-subtle">
              <i class="bi bi-person-gear"></i> Change Name
              <button type="" class="btn btn-danger-subtle editnamebtn" data-bs-toggle="modal"
                data-bs-target="#editNameModal">
                <i class="bi bi-person-gear"></i> Edit
              </button>
            </div>
            <div class="card-body fs-5 fw-bold mb-0">
              <p class="text-danger-subtle" style="margin-bottom: 0px;">Name:
                <?php echo $row['name'] ?>
              </p>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-header fw-bold text-danger-subtle">
              <i class="bi bi-person-gear"></i> Change Username
              <button type="button" class="btn btn-danger-subtle editbtn" data-bs-toggle="modal"
                data-bs-target="#editUsernameModal">
                <i class="bi bi-person-gear"></i> Edit
              </button>
            </div>
            <div class="card-body fs-5 fw-bold mb-0">
              <p class="text-danger-subtle" style="margin-bottom: 0px;">Username:
                <?php echo $row['username'] ?>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-header fw-bold text-danger-subtle">
              <div>
                <i class="bi bi-key-fill"></i> Change Password
              </div>
              <button type="button" class="btn btn-danger-subtle editpassbtn" data-bs-toggle="modal"
                data-bs-target="#editPasswordModal">
                <i class="bi bi-key-fill"></i> Edit
              </button>
            </div>
          </div>
        </div>
        <!-- Edit Username Modal -->
        <div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editUsernameModalLabel"><i class="bi bi-person-fill-gear"></i> Change
                  Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="forms needs-validation" method="POST"
                  action="/cstwit/pages/user/api/changeusername" novalidate="">
                  <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="<?php echo $row['username']; ?>" name="username"
                      id="editUsername" required>
                    <label for="username" class="form-label">Username</label>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updateusername" class="btn btn-danger-subtle"><i
                    class="bi bi-person-fill-gear"></i>
                  Change Username</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Edit Name Modal -->
        <div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel"><i class="bi bi-person-fill-gear"></i> Change Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="forms needs-validation" method="POST"
                  action="/cstwit/pages/user/api/changename" novalidate="">
                  <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="name"
                      id="editName" required>
                    <label for="name" class="form-label">Name</label>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updatename" class="btn btn-danger-subtle"><i
                    class="bi bi-person-fill-gear"></i>
                  Change Name</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Edit Password Modal -->
        <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editPasswordModalLabel"><i class="bi bi-key-fill"></i>
                  Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="forms needs-validation" method="POST"
                  action="/cstwit/pages/user/api/changepassword" novalidate="">
                  <input type="hidden" value="<?php echo $row['id']; ?>" name="updatepassword_id"
                    id="updatepassword_id">
                  <div class="form-floating mb-2">
                    <input type="password" class="form-control" name="password" id="editPassword" required>
                    <label for="password" class="form-label">Password</label>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="updatepassword" class="btn btn-danger-subtle">
                  <i class="bi bi-key-fill"></i> Change Password</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="app-footer">
      <strong>
        <span class="text-danger-subtle text-sm">© <span>
            <script>document.write(new Date().getFullYear())</script>
          </span> CStwIT | All Rights Reserved.</span>&nbsp;
      </strong>
    </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"></script>
    <script src="/cstwit/assets/js/adminlte.js"></script>
    <script src="/cstwit/assets/js/script.js"></script>
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <script>
      function toggleComments(postId) {
        const el = document.getElementById('comments-' + postId);
        if (el) {
          el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'block' : 'none';
        }
      }
    </script>
</body>

</html>