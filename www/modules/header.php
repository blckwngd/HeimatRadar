<?php
  $printView = isset($_GET["print"]);
  if (!$printView) {
?>
    <div class="row">
      <div class="col-sm-8">
        <?php if ($isLoggedIn) { ?>
            <span data-i18n="loggedIn"><?= $i18n->loggedIn ?></span> (<a href="logout.php"><span data-i18n="logOut"><?= $i18n->logout ?></span></a>)
        <?php } ?>
      </div>
      <div class="col-sm-3">
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
      </div>
    </div>
<?php
  }
?>