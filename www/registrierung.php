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
  <title><?=$t["titel"]?></title>
</head>
<body>

<div class="container mt-5">
  <h2><?=$t["titel"]?></h2>

  <form action="/" class="was-validated">

    <div class="row">
      <div class="col-sm-8">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Optional, wird nicht veröffentlicht" name="name">
        <div class="invalid-feedback">Bitte fülle das Feld aus.</div>
        <div class="valid-feedback">&nbsp;</div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <label for="strasse" class="form-label">Straße:</label>
        <input type="text" class="form-control" id="strasse" placeholder="Bitte Straße eingeben" name="strasse" required>
        <div class="invalid-feedback">Bitte fülle das Feld aus.</div>
        <div class="valid-feedback">&nbsp;</div>
      </div>
      <div class="col-sm-2">
        <label for="hausnr" class="form-label">Hausnummer:</label>
        <input type="text" class="form-control" id="hausnr" placeholder="Nr." name="hausnr" required>
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">Bitte fülle das Feld aus.</div>
      </div>
    </div>
    <?=$t["hinweis_standort"]?>
    <p></p>
    
    <div class="row">
      <div class="col-sm-4">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="optional, wird nicht veröffentlicht" name="email">
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">Bitte gib eine gültige Mailadresse ein, oder lasse das Feld leer.</div>
      </div>
      <div class="col-sm-4">
        <label for="tel" class="form-label">Telefon:</label>
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
    <?=$t["hinweis_allgemein"]?>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js"></script>

</body>
</html>
