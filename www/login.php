<?php

include_once("config/config.php");

global $i18n, $isLoggedIn;

$msg = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    if (($_POST["username"] == ADMIN_USER) && ($_POST["password"] == ADMIN_PASS)) {
        $_SESSION["API_SECRET"] = API_SECRET;
        header("Location: registrierung.php");
    } else {
        $_SESSION["API_SECRET"] = "";
        $msg = $i18n->login->msgLoginFailed;
    }
}

?><!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    

  <!-- HeimatRadar -->
  <link href='/inc/heimatradar/heimatradar.css' rel='stylesheet' />
  <script src='/inc/heimatradar/heimatradar.js'></script>

  <title data-i18n="login.titel"><?= $i18n->login->titel ?></title>
</head>
<body>

<?php require_once("modules/header.php"); ?>

<main class="container">

<h2 data-i18n="login.titel"><?= $i18n->login->titel ?></h2>

<?php
    if (!empty($msg)) {
        echo "<h3 style=\"color:red;\">" . $msg . "</h3>";
    }
?>

<form action="login.php" class="needs-validation" novalidate method="POST">

<div class="row">
  <div class="col-sm-4">
    <label for="name" data-i18n="login.inputUsername_label" class="form-label"><?= $i18n->login->inputUsername_label ?></label>:
    <input type="text" class="form-control" id="username" placeholder="<?= $i18n->login->inputUsername_platzhalter ?>" data-i18n="login.inputUsername_platzhalter" data-i18n-attr="placeholder" name="username"/>
    <div class="invalid-feedback" data-i18n="login.inputUsername_hinweisUngueltig"><?= $i18n->login->inputUsername_hinweisUngueltig ?></div>
  </div>

  
  <div class="col-sm-4">
    <label for="name" data-i18n="login.inputPassword_label" class="form-label"><?= $i18n->login->inputPassword_label ?></label>:
    <input type="password" class="form-control" id="password" placeholder="<?= $i18n->login->inputPassword_platzhalter ?>" data-i18n="login.inputPassword_platzhalter" data-i18n-attr="placeholder" name="password"/>
    <div class="invalid-feedback" data-i18n="login.inputPassword_hinweisUngueltig"><?= $i18n->login->inputPassword_hinweisUngueltig ?></div>
  </div>
</div>



<p></p>
<div class="form-group">
    <button type="submit" data-i18n="login.btnLogin" class="btn btn-primary col-sm-4"><?= $i18n->login->btnLogin ?></button>
</div>

</form>

</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>
<script>
  (function () {
    'use strict';
    window.addEventListener('load', function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

<!-- Translation Modul von https://codeburst.io/translating-your-website-in-pure-javascript-98b9fa4ce427 -->
<script src="https://unpkg.com/@andreasremdt/simple-translator@latest/dist/umd/translator.min.js"></script>
<script src="inc/i18n.js"></script>

</body>
</html>