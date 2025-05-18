<?php
http_response_code(404);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="CStwIT" />
    <meta name="author" content="Author" />
    <title>404 Not Found | CStwIT</title>
    <link rel="icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="/cstwit/assets/css/error-pages.css" />
    <link rel="stylesheet" href="/cstwit/assets/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
</head>

<body>
    <!-- Main Container -->
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="col-lg-8 col-md-4">
            <div class="text-center">
                <h1 class="text-danger-subtle animate__animated animate__tada fw-bold" style="font-size:150px">404</h1>
                <h2 class="fw-light">Page Not Found</h2>
                <p class="fs-5 py-3">The page you are looking for might have been removed, had its name changed or is
                    temporarily unavailable.</p>
                <button type="submit" onclick="goBack()" class="btn btn-md rounded-5">
                    <span class="bi bi-arrow-left"></span> Go Back
                </button>
            </div>
        </div>
    </div>

    <script src="/cstwit/assets/js/script.js"></script>
</body>

</html>