<?php

    /** CONFIG - HIER BEARBEITEN */
    $t = [
      "titel"             => "Teilnahme am Hof- und Gartenflohmarkt am 06. Juni 2024",
      "hinweis_standort"  => "ACHTUNG: Stände müssen auf dem eigenen Grundstück stehen, Gehweg, Straße o.Ä. sind leider nicht gestattet.",
      "kontakt_mail"      => "info@rethink-ev.de",
      "kontakt_tel"       => "02622/902787"
    ];

    $t["hinweis_allgemein"] = "<p>Es sind <strong>ausschließlich private Angebote</strong> erlaubt. Gewerbliche Anbieter sind von der Teilnahme ausgeschlossen.</p>
    <p>Sollten <strong>nachträglich Anderungen</strong> am Eintrag gewünscht sein, gib uns bitte kurz per <a href=\"mailto:".$t["kontakt_mail"]."\">Mail</a> oder telefonisch unter ".$t["kontakt_tel"]." Bescheid.</p>";

    $t["hinweis_datenschutz"] = "<p>Deine Daten werden ausschließlich für die Durchführung der Veranstaltung gespeichert und verarbeitet.
      Die Adresse kann online und auf Flyern und Plakaten veröffentlicht werden, um Besuchern das Auffinden des jeweiligen Verkaufsstandes zu ermöglichen.
      Nach Durchführung der Veranstaltung werden die Daten binnen 7 Tagen von unseren Systemen gelöscht.
      Eine Löschung kann auch zu jedem früheren Zeitpunkt beantragt werden.
      Eine Weitergabe der Daten an Dritte zu anderen als der oben genannten Zwecke ist ausgeschlossen.</p>";
?><!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
  <title data-i18n="reg.titel"><?=$t["titel"]?></title>
</head>
<body>

<div class="container mt-5">

<!-- Sprach Auswahl -->
<div class="row">
  <div class="col-sm-6"></div>
  <div class="col-sm-2">
    <div class="input-group mb-3">
      <label class="input-group-text" for="languageSelect" data-i18n="sprache">Sprache</label>
      <select class="form-select" id="languageSelect">
        <option value="de"selected>DE</option>
        <option value="en">EN</option>
      </select>
    </div>
  </div>
</div>

  <h2 data-i18n="reg.titel"><?=$t["titel"]?></h2>

  <form action="/" class="needs-validation" novalidate>

    <div class="row">
      <div class="col-sm-8">
        <label for="name" data-i18n="reg.inputName_label" class="form-label">Name</label>:
        <input type="text" class="form-control" id="name" placeholder="Optional, wird nicht veröffentlicht" data-i18n="reg.inputName_platzhalter" data-i18n-attr="placeholder" name="name"/>
        <div class="invalid-feedback" data-i18n="reg.inputName_hinweisUngueltig">Bitte fülle das Feld aus.</div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <label for="strasse" class="form-label" data-i18n="reg.inputStrasse_label">Straße</label>:
        <input type="text" class="form-control" id="strasse" placeholder="Bitte Straße eingeben" data-i18n="reg.inputStrasse_platzhalter" data-i18n-attr="placeholder" name="strasse" required>
        <div class="invalid-feedback" data-i18n="reg.inputStrasse_hinweisUngueltig"></div>
      </div>
      <div class="col-sm-2">
        <label for="hausnr" class="form-label" data-i18n="reg.inputHausnummer_label">Hausnummer</label>:
        <input type="text" class="form-control" id="hausnr" placeholder="Nr." data-i18n="reg.inputHausnummer_platzhalter" data-i18n-attr="placeholder" name="hausnr" required>
        <div class="invalid-feedback" data-i18n="reg.inputHausnummer_hinweisUngueltig">Bitte fülle das Feld aus.</div>
      </div>
    </div>
    <span data-i18n="reg.hinweis-ort"><?=$t["hinweis_standort"]?></span>
    <p></p>
    
    <div class="row">
      <div class="col-sm-4">
        <label for="email" data-i18n="inputEmail_label" class="form-label">Email</label>:
        <input data-i18n="reg.InputEmail_platzhalter" data-i18n-attr="placeholder" type="email" class="form-control" id="email" placeholder="optional, wird nicht veröffentlicht" name="email">
        <div class="invalid-feedback" data-i18n="reg.inputEmail_hinweisUngueltig">Bitte gib eine gültige Mailadresse ein, oder lasse das Feld leer.</div>
      </div>
      <div class="col-sm-4">
        <label for="tel" class="form-label">Telefon</label>:
        <input type="tel" class="form-control" id="tel" placeholder="optional, wird nicht veröffentlicht" name="tel">
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">Bitte gib eine gültige Telefonnummer ein, oder lasse das Feld leer.</div>
      </div>
    </div>
    
  <div class="row">
    <div class="col-sm-8">
      <label for="angebot" class="form-label">Angebot:</label>
      <textarea class="form-control" id="angebot" placeholder="Optional, was bietest du an?" name="angebot" maxlength="200"></textarea>
      <div class="valid-feedback">OK. Maximal 200 Zeichen</div>
      <div class="invalid-feedback">Bitte fülle das Feld aus.</div>
    </div>
  </div>
  <p></p>

  <div class="row">
    <div class="col-sm-8">
      <input class="form-check-input" type="checkbox" id="teilnahme" name="remember" required>
      <label class="form-check-label" for="teilnahme">Ich möchte an der Veranstaltung an o.g. Adresse teilnehmen.</label>
      <div class="valid-feedback">akzeptiert</div>
      <div class="invalid-feedback">Pflichtfeld</div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8">
      <input class="form-check-input" type="checkbox" id="datenschutz" name="remember" required>
      <label class="form-check-label" for="datenschutz">ich habe die u.g. Hinweise zum Datenschutz zur Kenntnis genommen und akzeptiert.</label>
      <div class="valid-feedback">akzeptiert</div>
      <div class="invalid-feedback">Pflichtfeld</div>
    </div>
  </div>

  <p></p>
  <div class="form-group">
    <p><strong>ALLGEMEINE HINWEISE</strong></p>
    <span data-i18n="reg.hinweis-allgemein"><?=$t["hinweis_allgemein"]?></span>
  </div>

  <p></p>
  <div class="form-group">
    <p><strong><br>HINWEISE ZUM DATENSCHUTZ<br></strong></p>
    <?=$t["hinweis_datenschutz"]?>
  </div>

  <p>
    <button type="submit" class="btn btn-primary col-sm-4">JETZT TEILNEHMEN</button>
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
