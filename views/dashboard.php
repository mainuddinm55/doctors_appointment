<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php
        $title;
        session_start() ?>
    </title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<div class="container-sm justify-content-center col pt-lg-5">
    <h1 align="center"><?php
        session_start();
        if (isset($_SESSION["user"])) {
            var_dump($_SESSION["user"]);
            echo "Welcome back Mr. " . $_SESSION["user"]->email;
        } ?></h1>

</div>
</body>
</html>
