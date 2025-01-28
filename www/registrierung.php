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
  
  <title data-i18n="reg.titel"><?= $i18n->reg->titel ?></title>
</head>
<body>

<main class="container">
<?php require_once("modules/header-pico.php"); ?>

  
  <h2 data-i18n="reg.titel"><?= $i18n->reg->titel ?></h2>

  <form action="staende.php" method="post" id="registrationForm" novalidate style="width:600px;">

    <fieldset>

      <!-- NAME -->
      <label for="name" data-i18n="reg.inputName_label"><?= $i18n->reg->inputName_label ?></label>
      <input
        type="text"
        id="name"
        placeholder="<?= $i18n->reg->inputName_platzhalter ?>"
        data-i18n="reg.inputName_platzhalter"
        data-i18n-attr="placeholder"
        autocomplete="name"
      />
    </fieldset>
    
    <label for="strasse" data-i18n="reg.inputStrasse_label"><?= $i18n->reg->inputStrasse_label ?></label>
    <fieldset role="group">
      <!-- STRASSE -->
      <input
        type="text"
        id="strasse"
        placeholder="<?= $i18n->reg->inputStrasse_platzhalter ?>"
        data-i18n="reg.inputStrasse_platzhalter"
        data-i18n-attr="placeholder"
        autocomplete="street"
      />
      
      <!--<label for="hausnummer" data-i18n="reg.inputHausnummer_label"><?= $i18n->reg->inputHausnummer_label ?></label>-->
      <input
        type="text"
        id="hausnummer"
        placeholder="<?= $i18n->reg->inputHausnummer_platzhalter ?>"
        data-i18n="reg.inputHausnummer_platzhalter"
        data-i18n-attr="placeholder"
        style="width:20%;"
      />
    </fieldset>


    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-6">
        *<label for="strasse" class="form-label" data-i18n="reg.inputStrasse_label">Straße</label>:
        <input type="text" class="form-control" id="strasse" placeholder="Bitte Straße eingeben" data-i18n="reg.inputStrasse_platzhalter" data-i18n-attr="placeholder" name="strasse" required>
        <div class="invalid-feedback" data-i18n="reg.inputStrasse_hinweisUngueltig"><?= $i18n->reg->inputStrasse_hinweisUngueltig ?></div>
      </div>
      <div class="col-sm-2">
        *<label for="hausnr" class="form-label" data-i18n="reg.inputHausnummer_label">Hausnummer</label>:
        <input type="text" class="form-control" id="hausnr" placeholder="Nr." data-i18n="reg.inputHausnummer_platzhalter" data-i18n-attr="placeholder" name="hausnr" required>
        <div class="invalid-feedback" data-i18n="reg.inputHausnummer_hinweisUngueltig"><?= $i18n->reg->inputHausnummer_hinweisUngueltig ?></div>
      </div>
    </div>
    <span data-i18n="reg.hinweis_ort"><?= $i18n->reg->hinweis_ort ?></span>
    
    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-3">
        *<label for="anzahl" class="form-label" data-i18n="reg.inputAnzahl_label">Anzahl</label>:
        <input type="number" value="1" class="form-control" id="anzahl" placeholder="1" min="1" max="10" data-i18n="reg.inputAnzahl_platzhalter" data-i18n-attr="placeholder" name="anzahl" required>
        <div class="invalid-feedback" data-i18n="reg.inputAnzahl_hinweisUngueltig"><?= $i18n->reg->inputAnzahl_hinweisUngueltig ?></div>
      </div>
      <div class="col-sm-5"></div>
    </div>
    <span data-i18n="reg.inputAnzahl_hinweis"><?= $i18n->reg->inputAnzahl_hinweis ?></span>

    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-4">
        <label for="email" data-i18n="reg.inputEmail_label" class="form-label">Email</label>:
        <input data-i18n="reg.inputEmail_platzhalter" data-i18n-attr="placeholder" type="email" class="form-control" id="email" placeholder="optional, wird nicht veröffentlicht" name="email">
        <div class="invalid-feedback" data-i18n="reg.inputEmail_hinweisUngueltig">Bitte gib eine gültige Mailadresse ein, oder lasse das Feld leer.</div>
      </div>
      <div class="col-sm-4">
        <label for="phone" data-i18n="reg.inputPhone_label" class="form-label">Telefon</label>:
        <input type="tel" data-i18n="reg.inputPhone_platzhalter" data-i18n-attr="placeholder" class="form-control" id="phone" placeholder="optional, wird nicht veröffentlicht" name="phone">
        <div class="invalid-feedback" data-i18n="reg.inputPhone_hinweisUngueltig">Bitte gib eine gültige Telefonnummer ein, oder lasse das Feld leer.</div>
      </div>
    </div>

    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-8">
        <label for="angebot" data-i18n="reg.inputAngebot_label" class="form-label">Angebot</label>:
        <textarea data-i18n="reg.inputAngebot_platzhalter" data-i18n-attr="placeholder" class="form-control" id="angebot" placeholder="(optional) was bietest du an?" name="angebot" maxlength="200"></textarea>
        <div data-i18n="reg.inputAngebot_hinweisUngueltig" class="invalid-feedback">max. 200 Zeichen</div>
      </div>
    </div>
    
    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-8">
        <label for="kommentar" data-i18n="reg.inputKommentar_label" class="form-label">Kommentar:</label>
        <textarea data-i18n="reg.inputKommentar_platzhalter" data-i18n-attr="placeholder" class="form-control" id="kommentar" placeholder="(optional, wird nicht veröffentlicht) möchtest du uns etwas mitteilen?" name="kommentar" maxlength="2048"></textarea>
        <div data-i18n="reg.inputKommentar_hinweisUngueltig" class="invalid-feedback">max. 2048 Zeichen</div>
      </div>
    </div>
    <p></p>

    <div class="row">
      <div class="col-sm-8">
        <input class="form-check-input" type="checkbox" id="teilnahme" name="teilnahme" required>
        <label class="form-check-label" data-i18n="reg.inputTeilnahme_label" for="teilnahme">Ich möchte an der Veranstaltung an o.g. Adresse teilnehmen.</label>
        <div class="valid-feedback" data-i18n="akzeptiert">akzeptiert</div>
        <div class="invalid-feedback" data-i18n="pflichtfeld">Pflichtfeld</div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-8">
        <input class="form-check-input" type="checkbox" id="datenschutz" name="datenschutz" required>
        <label class="form-check-label" data-i18n="reg.inputDatenschutz_label" for="datenschutz">Ich habe die u.g. Hinweise zum Datenschutz zur Kenntnis genommen und akzeptiert.</label>
        <div class="valid-feedback" data-i18n="akzeptiert"><?= $i18n->akzeptiert ?></div>
        <div class="invalid-feedback" data-i18n="pflichtfeld"><?= $i18n->pflichtfeld ?></div>
      </div>
    </div>

    
    <?php if ($isLoggedIn) { ?>
      <div class="row adminFeature">
        <div class="col-sm-8">
          <input class="form-check-input" type="checkbox" id="validieren" name="validieren">
          <label class="form-check-label" data-i18n="reg.inputValidieren_label" for="validieren"><?= $i18n->reg->inputValidieren_label ?></label>
          <div class="valid-feedback" data-i18n="akzeptiert"><?= $i18n->akzeptiert ?></div>
        </div>
      </div>
    <?php } ?>

    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="form-group">
      <p><strong data-i18n="reg.hinweis_allgemein_titel">ALLGEMEINE HINWEISE</strong></p>
      <span data-i18n="reg.hinweis_allgemein"><?= $i18n->reg->hinweis_allgemein ?></span>
    </div>

    <p></p>
    <div class="form-group">
      <p><br/><strong data-i18n="reg.hinweis_datenschutz_titel">HINWEISE ZUM DATENSCHUTZ</strong><br/></p>
      <span data-i18n="reg.hinweis_datenschutz"><?= $i18n->reg->hinweis_datenschutz ?></span>
    </div>

    <br/>
    <p>
      <button type="submit" data-i18n="reg.jetztTeilnehmen" class="btn btn-primary col-sm-4">JETZT TEILNEHMEN</button>
    </p>
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

<script type="text/javascript">

  var form = document.getElementById('registrationForm');

  function processForm(e) {
      
      if (form.checkValidity() === false) {
        alert('invalid');
        if (e.preventDefault) e.preventDefault();
      } else {
        alert('valid');
      }
      form.classList.add('was-validated');

      return false;
  }

  if (form.attachEvent) {
      form.attachEvent("submit", processForm);
  } else {
      form.addEventListener("submit", processForm);
  }

</script>
</main>
</body>
</html>
