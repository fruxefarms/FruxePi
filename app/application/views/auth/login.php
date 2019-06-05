
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex,nofollow" />

    <title>FruxePi</title>

    <!-- Bootstrap core CSS --> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">

    <!-- Custom CSS for login -->
    <link href="<?php echo asset_url(); ?>css/signin.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet">

  </head>

  <body class="text-center">
    <?php $attributes = array('class' => 'form-signin'); ?>
    <?php echo form_open("auth/login", $attributes);?>

      <img class="mb-4" src="<?php echo asset_url(); ?>img/logo-wordmark-sm.svg" alt="FruxePi" width="80%">

      <h1 class="h3 mb-3 font-weight-normal">Please Sign-in</h1>
      
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="identity" class="form-control" placeholder="Email address" required autofocus>
      
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      
      <button class="btn btn-magenta btn-lg btn-block" type="submit">Login</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?> frx-pi-v0.3-BETA</p>

    <?php echo form_close();?>
  </body>
</html>