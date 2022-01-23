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
<div class="container-sm align-items-center">
    <h1 align="center">Registration Here</h1>

    <form action="" method="post">
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email"
                   placeholder="Enter email" name="email">
        </div>
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password"
                   placeholder="Enter password" name="password">
        </div>
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password"
                   placeholder="Confirm password" name="confirm_password">
        </div>
        <button type="submit" class="btn btn-primary">Registration</button>
    </form>
</div>
</body>
</html>
