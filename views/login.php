<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php
        $title ?>
    </title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<div class="container-sm justify-content-center col pt-lg-5">
    <h1 align="center">Login Here</h1>
    <div style="width: 50%; align-content: center; align-self: center">

        <form action="" method="post">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email"
                       placeholder="Enter email" name="email" value="<?php
                echo $email; ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password"
                       placeholder="Enter password" name="password" value="<?php
                echo $password; ?>">
            </div>
            <label class="mt-3 mt-3 text-danger"><?php
                echo $error;
                ?></label>
            <br>
            <label class="mt-3 mt-3 ">Don't have account? <a
                        href="/registration">registration</a> here </label>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
</body>
</html>
