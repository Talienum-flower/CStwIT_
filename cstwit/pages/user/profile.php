<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/cstwit/auth.php';
checkRole(['User']); // Only User can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo getFullname(); ?> | CStwIT</title>
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
              <h3 class="mb-0 text-danger-subtle fw-bold fs-1">Profile</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <?php
          $id = $_SESSION['uid'];
          $query = mysqli_query($conn, "SELECT * FROM users where id='$id'") or die(mysqli_error());
          $row = mysqli_fetch_array($query);
          ?>
          <div class="row">
            <div class="col-lg-4">
              <div class="text-center mb-3">
                <img class="rounded-circle" src="/cstwit/assets/img/owl-logo.png" width="200">
              </div>
            </div>
            <!-- This empty column will push the information to the right on large screens -->
            <div class="col-lg-7">
              <div class="d-flex flex-wrap row g-4 mb-3 gx-1 text-lg-start text-center">
                <h1 class="text-danger-subtle"><b>
                    <?php echo $row['name']; ?>
                  </b>
                  <br>
                  <p class="fs-3">@<?php echo $row['username']; ?></p>
                  <hr class="mt-2 mb-0 text-danger-subtle">
                </h1>
                <h4 class="mt-0 text-danger-subtle">
                  <?php echo $row['bio']; ?>
                </h4>
              </div>
            </div>
          </div>
          <hr class="text-danger-subtle">
          <?php
          if (isset($_SESSION['postsuccess'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
              <?= $_SESSION['postsuccess']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['postsuccess']);
          }
          if (isset($_SESSION['posterror'])) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
              <?= $_SESSION['posterror']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['posterror']);
          }
          ?>
          <form action="/cstwit/pages/user/api/createuserpost" method="POST" class="needs-validation" novalidate>
            <input type="hidden" name="user_id" value="<?php echo userID() ?>">
            <textarea name="content" class="form-control fs-5" rows="4" placeholder="What's happening?"
              required></textarea>
            <div class="invalid-feedback fs-5">
              Please add your thoughts!
            </div>
            <div class="d-flex justify-content-end py-3">
              <button class="btn btn-danger-subtle fw-bold">Post</button>
            </div>
          </form>
          <hr class="mt-0">
          <?php
          $user_id = userID();
          $sql = "SELECT 
    posts.*, 
    users.username, 
    (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count,
    (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS like_count,
    (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id AND likes.user_id = $user_id) AS is_liked
FROM posts
JOIN users ON posts.user_id = users.id 
WHERE posts.user_id = $user_id
ORDER BY posts.created_at DESC";
          $posts = $conn->query($sql);
          ?>
          <?php while ($post = $posts->fetch_assoc()): ?>
            <div class="col-md-12">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title fs-6">
                    <strong class="text-danger-subtle">@<?= htmlspecialchars($post['username']); ?></strong>
                  </h5>
                  <div class="card-tools">
                    <div class="btn-group">
                      <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-wrench"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" role="menu">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#reportPostModal"
                          class="dropdown-item">Report</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <p class="fs-6"><?= htmlspecialchars($post['content']); ?></p>
                  <small class="text-muted fs-6"><?= $post['created_at']; ?></small>
                </div>
                <div class="card-footer">
                  <div class="d-flex justify-content-start align-items-center gap-3">
                    <!-- Like Button -->
                    <form action="/cstwit/pages/user/api/likeuser_post" method="POST" class="d-inline">
                      <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                      <button type="submit" class="btn btn-outline-danger btn-sm<?php if ($post['is_liked'])
                        echo ' active'; ?>">
                        <i class="bi bi-heart-fill"></i>
                        <span class="count">
                          <?php echo (int) $post['like_count']; ?>
                        </span>
                      </button>
                    </form>
                    <!-- Comment Button -->
                    <button class="btn btn-outline-secondary btn-sm"
                      onclick="toggleComments(<?php echo (int) $post['id']; ?>)">
                      <i class="bi bi-chat-left-text"></i>
                      <span id="comment-count-<?php echo (int) $post['id']; ?>">
                        <?php echo isset($post['comment_count']) ? (int) $post['comment_count'] : 0; ?>
                      </span>
                    </button>
                  </div>
                </div>
                <div class="col-12 px-3">
                  <div id="comments-<?php echo (int) $post['id']; ?>" class="mt-2" style="display: none;">
                    <?php
                    $post_id = (int) $post['id'];
                    $comments_sql = "SELECT comments.*, users.username 
                          FROM comments 
                          JOIN users ON comments.user_id = users.id 
                          WHERE comments.post_id = $post_id 
                          ORDER BY comments.created_at DESC";
                    $comments = $conn->query($comments_sql);
                    if ($comments && $comments->num_rows > 0):
                      while ($comment = $comments->fetch_assoc()):
                        ?>
                        <div class="border rounded p-2 mb-1 bg-light">
                          <strong class="text-danger-subtle">@<?= htmlspecialchars($comment['username']); ?>:</strong>
                          <?= isset($comment['comment']) ? htmlspecialchars($comment['comment']) : '<span class="text-danger">[No content]</span>'; ?>
                          <br>
                          <small class="text-muted"><?= $comment['created_at']; ?></small>
                        </div>
                      <?php endwhile; else: ?>
                      <div class="text-muted">No comments yet.</div>
                    <?php endif; ?>

                    <!-- Add Comment Form -->
                    <form action="/cstwit/pages/user/api/adduser_comment" method="POST" class="my-3">
                      <input type="hidden" name="post_id" value="<?php echo (int) $post['id']; ?>">
                      <input type="hidden" name="user_id" value="<?php echo userID(); ?>">
                      <div class="input-group">
                        <input type="text" name="comment" class="form-control form-control-md"
                          placeholder="Add a comment..." required>
                        <button class="btn btn-danger-subtle btn-sm" type="submit">Post</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
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