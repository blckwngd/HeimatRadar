<?php
  $printView = isset($_GET["print"]);
  if (!$printView) {
?>
<main>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="karte.php" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z"/>
          <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
        </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="karte.php" class="nav-link px-2 link-secondary" data-i18n="karte.bezeichnung"><?= $i18n->karte->bezeichnung ?></a></li>
          <li><a href="registrierung.php" class="nav-link px-2 link-body-emphasis" data-i18n="reg.bezeichnung"><?= $i18n->reg->bezeichnung ?></a></li>
        </ul>

        <form class="ml-auto p-2" role="search">
          
          <!-- Sprach Auswahl -->
          <div class="input-group mb-4">
            <label class="input-group-text" for="languageSelect" data-i18n="sprache">Sprache</label>
            <select class="form-select" id="languageSelect">
              <?php
                foreach ($languages as $k => $l) {
                  $first = ($k == array_keys($languages)[0]);
                  echo "<option value=\"$k\"" . ($first ? " selected" : "") . ">$l</option>\r\n";
                }
              ?>
            </select>
          </div>

        </form>
      </div>
    </div>
  </header>

  </main>

  <!--
    <div class="row">
      <div class="col-sm-8">
        <?php if ($isLoggedIn) { ?>
            <span data-i18n="loggedIn"><?= $i18n->loggedIn ?></span> (<a href="logout.php"><span data-i18n="logOut"><?= $i18n->logout ?></span></a>)
        <?php } ?>
      </div>
      <div class="col-sm-3">
        <div class="input-group mb-4">
          <label class="input-group-text" for="languageSelect" data-i18n="sprache">Sprache</label>
          <select class="form-select" id="languageSelect">
            <?php
              foreach ($languages as $k => $l) {
                $first = ($k == array_keys($languages)[0]);
                echo "<option value=\"$k\"" . ($first ? " selected" : "") . ">$l</option>\r\n";
              }
            ?>
          </select>
        </div>
      </div>
    </div>
            -->
<?php
  }
?>