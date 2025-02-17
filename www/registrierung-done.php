<?php
    include_once("config/config.php");

    global $i18n, $isLoggedIn;

?><!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PicoCSS | https://picocss.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <!-- PocketBase | https://pocketbase.io/ -->
    <script src="/inc/pocketbase/pocketbase.umd.js"></script>
      
    <!-- HeimatRadar -->
    <link href='/inc/heimatradar/heimatradar.css' rel='stylesheet' />
    <script src='/inc/heimatradar/heimatradar.js'></script>
  
  <title data-i18n="regdone.titel"><?= $i18n->regdone->titel ?></title>
</head>
<body>

<main class="container">
    <?php require_once("modules/header-pico.php"); ?>

    <article>
        <h2 data-i18n="regdone.titel"><?= $i18n->regdone->titel ?></h2>
        <span data-i18n="regdone.beschreibung"><?= $i18n->regdone->beschreibung ?></span>
        <p>&nbsp;</p>
        <section>
            <button data-i18n="regdone.zur_karte" onclick="location.href='karte.php';"><?= $i18n->regdone->zur_karte ?></button>
        </section>
        
    </article>

</main>

<!-- Translation Modul von https://codeburst.io/translating-your-website-in-pure-javascript-98b9fa4ce427 -->
<script src="https://unpkg.com/@andreasremdt/simple-translator@latest/dist/umd/translator.min.js"></script>
<script src="inc/i18n.js"></script>

<script type="text/javascript">
</script>
</body>
</html>
