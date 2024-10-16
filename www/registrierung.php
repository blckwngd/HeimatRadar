<?php
    include_once("config/config.php");

    $i18n = json_decode(file_get_contents("i18n/de.json"));

?><!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">

  <!-- HeimatRadar -->
  <link href='/inc/heimatradar/heimatradar.css' rel='stylesheet' />
  <script src='/inc/heimatradar/heimatradar.js'></script>
  
  <title data-i18n="reg.titel"><?= $i18n->reg->titel ?></title>
</head>
<body>

<div class="container mt-5">

<!-- Sprach Auswahl -->
<div class="row">
  <div class="col-sm-6"></div>
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

  <h2 data-i18n="reg.titel"><?= $i18n->reg->titel ?></h2>

  <form action="/" class="needs-validation" novalidate>

    <div class="row">
      <div class="col-sm-8">
        <label for="name" data-i18n="reg.inputName_label" class="form-label"><?= $i18n->reg->inputName_label ?></label>:
        <input type="text" class="form-control" id="name" placeholder="<?= $i18n->reg->inputName_platzhalter ?>" data-i18n="reg.inputName_platzhalter" data-i18n-attr="placeholder" name="name"/>
        <div class="invalid-feedback" data-i18n="reg.inputName_hinweisUngueltig"><?= $i18n->reg->inputName_hinweisUngueltig ?></div>
      </div>
    </div>

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
      <div class="col-sm-4">
        <label for="email" data-i18n="reg.inputEmail_label" class="form-label">Email</label>:
        <input data-i18n="reg.inputEmail_platzhalter" data-i18n-attr="placeholder" type="email" class="form-control" id="email" placeholder="optional, wird nicht veröffentlicht" name="email">
        <div class="invalid-feedback" data-i18n="reg.inputEmail_hinweisUngueltig">Bitte gib eine gültige Mailadresse ein, oder lasse das Feld leer.</div>
      </div>
      <div class="col-sm-4">
        <label for="tel" data-i18n="reg.inputPhone_label" class="form-label">Telefon</label>:
        <input type="tel" data-i18n="reg.inputPhone_platzhalter" data-i18n-attr="placeholder" class="form-control" id="tel" placeholder="optional, wird nicht veröffentlicht" name="tel">
        <div class="invalid-feedback" data-i18n="reg.inputPhone_hinweisUngueltig">Bitte gib eine gültige Telefonnummer ein, oder lasse das Feld leer.</div>
      </div>
    </div>

    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-8">
        <label for="angebot" data-i18n="reg.inputAngebot_label" class="form-label">Angebot:</label>
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
        <div class="valid-feedback" data-i18n="akzeptiert">akzeptiert</div>
        <div class="invalid-feedback" data-i18n="pflichtfeld">Pflichtfeld</div>
      </div>
    </div>

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

</body>
</html>
