
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FruxePi</title>

    <!-- Bootstrap core CSS --> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">

    <!-- Custom CSS for login -->
    <link href="<?php echo asset_url(); ?>css/signin.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet">

  </head>

  <body class="text-center">
        <div class="form-signin">
            <img class="mb-4" src="<?php echo asset_url(); ?>img/logo-wordmark-sm.svg" alt="FruxePi" width="80%">

            <h1 class="h3 mb-3 font-weight-normal">Reset FruxePi Admin</h1>
            <p>FruxePi will be reset to default username and password</p>
            
            <a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url("auth/reset"); ?>">Reset</a>
            
            <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?> frx-dev-v0.1</p>
        </div>
  </body>
</html>