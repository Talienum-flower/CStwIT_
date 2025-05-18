<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/cstwit/auth.php';
checkRole(['Administrator']); // Only Administrator can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Dashboard | CStwIT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/cstwit/assets/css/adminlte.css" />
  <link rel="stylesheet" href="/cstwit/assets/css/style.css">
  <link rel="stylesheet" href="/cstwit/assets/css/dashboard.css">
  <link rel="icon" href="/cstwit/assets/img/owl-outline-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      new DataTable('#myTable', {
        dom: `<'d-flex justify-content-between mb-2 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
        columnDefs: [
          { targets: [0, 1] }
        ]
      });
    });
  </script>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">
  <div class="app-wrapper">
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
          <li class="nav-item dropdown user-menu">
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
                <a href="#" class="btn btn-danger-subtle">Profile</a>
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
                <i class="nav-icon bi bi-speedometer"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-header">MANAGEMENT</li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="nav-icon bi bi-people"></i>
                <p>
                  Manage Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="posts.php" class="nav-link">
                <i class="nav-icon bi bi-stickies"></i>
                <p>
                  Manage Posts
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
              <h3 class="mb-0 text-danger-subtle fw-bold fs-1">Manage Users</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="index.php" class="text-danger-subtle">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="row">
            <div class="table-responsive px-1 py-1">
              <div class="data_table">
                <table id="myTable" class="table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                    </tr>
                  </thead>
                  <tbody class="text-dark">
                    <?php
                    $query = "SELECT * FROM users WHERE role='User'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $items) {
                        ?>
                        <tr>
                          <td class="text-center">
                            <?= $items['id']; ?>
                          </td>
                          <td>
                            <?= $items['name']; ?>
                          </td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
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
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous">
    </script>
</body>

</html>