<?php

  $site=basename($_SERVER['PHP_SELF']);

  function active($page) {
    global $site;
    return ($site==$page) ? 'primary' : 'secondary';
  }

  $printView = isset($_GET["print"]);
  if (!$printView) {
?>


<nav role="menu">
  <label data-role="burger"><input type="checkbox" /></label>
  <ul role="menubar">
    <li>
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#50AA11" class="bi bi-pin-map-fill" viewBox="0 0 16 16" style="margin-bottom:20px;">
            <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z"/>
            <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
        </svg>
        <strong style="font-size:24pt;">HeimatRadar</strong>
    </li>
  </ul>
  <ul role="menuitem">
    <li><a href="karte-tabulator.php" class="<?= active('karte-tabulator.php') ?>" data-i18n="karte.bezeichnung"><?= $i18n->karte->bezeichnung ?></a></li>
    <li><a href="registrierung.php" class="<?= active('registrierung.php') ?>" data-i18n="reg.bezeichnung"><?= $i18n->reg->bezeichnung ?></a></li>
  </ul>
  
  <ul role="menuitem">
    <li>
        <select class="form-select" id="languageSelect">
        <?php
            foreach ($languages as $k => $l) {
            $first = ($k == array_keys($languages)[0]);
            echo "<option value=\"$k\"" . ($first ? " selected" : "") . ">$l</option>\r\n";
            }
        ?>
        </select>
    </li>
    <li>
        <?php if ($isLoggedIn) { ?>
            <a href="logout.php" class="<?= active('login.php') ?>" data-i18n="logout"><?= $i18n->logout ?></a></li>
        <?php } else { ?>
            <a href="login.php" class="<?= active('login.php') ?>" data-i18n="login.bezeichnung"><?= $i18n->login->bezeichnung ?></a></li>
        <?php } ?>
    </li>
  </ul>
</nav>

<section>&nbsp;</section>

<?php
  }
?>