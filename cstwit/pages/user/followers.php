<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/cstwit/auth.php';
checkRole(['User']); // Only User can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Followers | CStwIT</title>
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
              <a class="nav-link active">
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
              <h3 class="mb-0 text-danger-subtle fw-bold fs-1">Followers</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <?php
          function getFollowers($userId)
          {
            global $conn;
            $sql = "SELECT u.id, u.username, u.profile_pic,
                 EXISTS (
                   SELECT 1 FROM follows 
                   WHERE follower_id = ? AND followed_id = u.id
                 ) AS is_followed_by_me
          FROM follows f
          JOIN users u ON f.follower_id = u.id
          WHERE f.followed_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $userId, $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $followers = [];
            while ($row = $result->fetch_assoc()) {
              $followers[] = $row;
            }
            return $followers;
          }

          $userId = userID(); // Get current user ID
          $followers = getFollowers($userId);
          ?>

          <?php if ($followers && count($followers) > 0): ?>
            <ul class="list-group">
              <?php foreach ($followers as $follower): ?>
                <li class="list-group-item d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <img
                      src="<?php echo htmlspecialchars($follower['profile_pic'] ?? '/cstwit/assets/uploads/images.jpg'); ?>"
                      alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                    <strong><?php echo htmlspecialchars($follower['username']); ?></strong>
                  </div>

                  <!-- Follow/Unfollow Button -->
                  <?php if ($follower['id'] != $userId): ?>
                    <form method="post" action="/cstwit/pages/user/api/follow_action">
                      <input type="hidden" name="target_user_id" value="<?php echo $follower['id']; ?>">
                      <input type="hidden" name="target_user_name" value="<?php echo $follower['username']; ?>">
                      <?php if ($follower['is_followed_by_me']): ?>
                        <button type="submit" name="action" value="unfollow"
                          class="btn btn-danger-subtle btn-md">Unfollow</button>
                      <?php else: ?>
                        <button type="submit" name="action" value="follow" class="btn btn-danger-subtle btn-md">Follow</button>
                      <?php endif; ?>
                    </form>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <div class="alert alert-danger mt-3">You have no followers yet.</div>
          <?php endif; ?>
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