<?php
    include_once("config/config.php");

    global $i18n, $isLoggedIn;

?><!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" language="javascript">
      const POCKETBASE_URI = "<?= POCKETBASE_URI ?>";
    </script>
    
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

  <form action="#" method="post" id="registrationForm" style="max-width:800px;">
    
    <hr/>

    <fieldset>
      <!-- NAME -->
      <label for="name" class="myFormLabel" data-i18n="reg.inputName_label"><?= $i18n->reg->inputName_label ?></label>&nbsp;
      <input
        type="text"
        id="name"
        placeholder="optional"
        autocomplete="name"
        aria-describedby="inputName_platzhalter"
        onchange="checkInputValidity(this)"
        maxlength="50"
      />
      <!--<small class="invalid-feedback" data-i18n="reg.inputName_hinweisUngueltig"><?= $i18n->reg->inputName_hinweisUngueltig ?></small>-->
      <small data-i18n="reg.inputName_platzhalter" id="inputStrasse_platzhalter"><?= $i18n->reg->inputName_platzhalter ?></small>

    </fieldset>
    <hr/>
    
    <!-- EMAIL -->
    <fieldset>
      <label for="email" class="myFormLabel" data-i18n="reg.inputEmail_label"><?= $i18n->reg->inputEmail_label ?></label>&nbsp;
      <input
        type="email"
        id="email"
        autocomplete="email"
        placeholder="optional"
        aria-describedby="inputEmail_platzhalter"
        maxlength="50"
        onchange="checkInputValidity(this)"
      />
      <!--<small class="invalid-feedback" style="display:none;" data-i18n="reg.inputEmail_hinweisUngueltig"><?= $i18n->reg->inputEmail_hinweisUngueltig ?></small>-->
      <small data-i18n="reg.inputEmail_platzhalter" id="inputEmail_platzhalter"><?= $i18n->reg->inputEmail_platzhalter ?></small>
    </fieldset>
    <hr/>

    <!-- TELEFON -->
    <fieldset>
      <label for="phone" class="myFormLabel" data-i18n="reg.inputPhone_label"><?= $i18n->reg->inputPhone_label ?></label>&nbsp;
      <input
        type="tel"
        pattern="^\+?[0-9\s\(\)\-]*$"
        id="phone"
        autocomplete="phone"
        placeholder="optional"
        aria-describedby="inputPhone_platzhalter"
        onchange="checkInputValidity(this)"
        maxlength="25"
      />
      <!--<small class="invalid-feedback" style="display:none;" data-i18n="reg.inputPhone_hinweisUngueltig"><?= $i18n->reg->inputPhone_hinweisUngueltig ?></small>-->
      <small data-i18n="reg.inputPhone_platzhalter" id="inputPhone_platzhalter"><?= $i18n->reg->inputPhone_platzhalter ?></small>
    </fieldset>
    <hr/>

    <!-- STRASSE -->
    *<label class="myFormLabel" for="strasse" data-i18n="reg.inputStrasse_label"><?= $i18n->reg->inputStrasse_label ?></label>
    <fieldset role="group">
      <input
        type="text"
        id="strasse"
        autocomplete="street"
        required
        aria-describedby="inputStrasse_platzhalter"
        onchange="checkInputValidity(this)"
        maxlength="100"
      />
      
      <!--<label for="hausnummer" data-i18n="reg.inputHausnummer_label"><?= $i18n->reg->inputHausnummer_label ?></label>-->
      <input
        type="text"
        id="hausnummer"
        placeholder="<?= $i18n->reg->inputHausnummer_platzhalter ?>"
        data-i18n="reg.inputHausnummer_platzhalter"
        data-i18n-attr="placeholder"
        style="width:30%;"
        required
        aria-describedby="inputStrasse_platzhalter"
        onchange="checkInputValidity(this)"
        maxlength="20"
      />
    </fieldset>
    <small data-i18n="reg.inputStrasse_platzhalter" id="inputStrasse_platzhalter"><?= $i18n->reg->inputStrasse_platzhalter ?></small>
    <small data-i18n="reg.hinweis_ort"><?= $i18n->reg->hinweis_ort ?></small>
    <!--<small class="invalid-feedback" data-i18n="reg.inputStrasse_hinweisUngueltig"><?= $i18n->reg->inputStrasse_hinweisUngueltig ?></small>-->
    <hr/>

    <!-- ANZAHL -->
    <fieldset>
      <label for="anzahl" data-i18n="reg.inputAnzahl_label"><?= $i18n->reg->inputAnzahl_label ?></label>
      <select type="number" id="anzahl" style="width:auto;" required>
        <option selected value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10+</option>
      </select>

      <!--<small class="invalid-feedback" data-i18n="reg.inputAnzahl_hinweisUngueltig"><?= $i18n->reg->inputAnzahl_hinweisUngueltig ?></small>-->
      <small data-i18n="reg.inputAnzahl_hinweis"><?= $i18n->reg->inputAnzahl_hinweis ?></small>
    </fieldset>


    <!-- ANGEBOT -->
    <fieldset>
      <label for="angebot" class="myFormLabel" data-i18n="reg.inputAngebot_label"><?= $i18n->reg->inputAngebot_label ?></label>&nbsp;
      <textarea
        id="angebot"
        placeholder="DVDs, Sneaker, Möbel..."
        maxlength="200"
        aria-describedby="inputAngebot_platzhalter"
        onchange="checkInputValidity(this)"
      ></textarea>
      <!--<small data-i18n="reg.inputAngebot_hinweisUngueltig">max. 200 Zeichen</div>-->
      <small data-i18n="reg.inputAngebot_platzhalter" id="inputAngebot_platzhalter"><?= $i18n->reg->inputAngebot_platzhalter ?></small>

    </fieldset>
    <hr/>


    <!-- KOMMENTAR -->
    <fieldset>
      <label for="kommentar" class="myFormLabel" data-i18n="reg.inputKommentar_label"><?= $i18n->reg->inputKommentar_label ?></label>&nbsp;
      <textarea
        id="kommentar"
        placeholder=""
        maxlength="200"
        aria-describedby="inputKommentar_platzhalter"
        onchange="checkInputValidity(this)"
      ></textarea>
      <small data-i18n="reg.inputKommentar_platzhalter" id="inputKommentar_platzhalter"><?= $i18n->reg->inputKommentar_platzhalter ?></small>

    </fieldset>
    <hr/>


    <!-- CHECKBOXEN -->
    <fieldset>
      <label>
        <input
          type="checkbox"
          name="teilnahme"
          id="inputTeilnahme"
          role="switch"
          required
          aria-invalid=""
          aria-describedby="inputTeilnahme_label"
          onchange="checkInputValidity(this)"
        />
        <span for="teilnahme" data-i18n="reg.inputTeilnahme_label"><?= $i18n->reg->inputTeilnahme_label ?></span>&nbsp;
      </label>
      <label>
        <input
          type="checkbox"
          name="datenschutz"
          role="switch"
          required
          aria-invalid=""
          aria-describedby="inputDatenschutz_label"
          onchange="checkInputValidity(this)"
        />
        <span for="datenschutz" data-i18n="reg.inputDatenschutz_label" required><?= $i18n->reg->inputDatenschutz_label ?></span>&nbsp;
      </label>
    </fieldset>

    <hr/>
    
    <?php if ($isLoggedIn) { ?>

      <!-- SOFORT VALIDIERUNG -->
      <fieldset>
      <legend>Admin-Optionen:</legend>
        <label>
          <input type="checkbox" name="validieren" 
          role="switch"/>
          <span for="validieren" data-i18n="reg.inputValidieren_label"><?= $i18n->reg->inputValidieren_label ?></span>&nbsp;
        </label>
      </fieldset>
      <hr/>
      
    <?php } ?>

    
    <section>
      <h6 data-i18n="reg.hinweis_allgemein_titel">ALLGEMEINE HINWEISE</h6>
      <small data-i18n="reg.hinweis_allgemein"><?= $i18n->reg->hinweis_allgemein ?></small>
    </section>

    <hr/>

    <section>
      <h6 data-i18n="reg.hinweis_datenschutz_titel">HINWEISE ZUM DATENSCHUTZ</h6>
      <small data-i18n="reg.hinweis_datenschutz"><?= $i18n->reg->hinweis_datenschutz ?></small>
    </section>

    <hr/>

    <section>
      <button type="submit" id="btnSubmit" data-i18n="reg.jetztTeilnehmen" class="btn btn-primary col-sm-4">JETZT TEILNEHMEN</button>
    </section>
  </form>
  
</div>

<!-- Translation Modul von https://codeburst.io/translating-your-website-in-pure-javascript-98b9fa4ce427 -->
<script src="https://unpkg.com/@andreasremdt/simple-translator@latest/dist/umd/translator.min.js"></script>
<script src="inc/i18n.js"></script>

<script type="text/javascript">

  var form = document.getElementById('registrationForm');

  function checkInputValidity(e) {
    let v = e.checkValidity();
    e.ariaInvalid=!v;
  }

  async function submitForm() {
    
    // Werte aus den Eingabefeldern holen
    const name = document.getElementById('name').value;
    const angebot = document.getElementById('angebot').value;
    const anzahl = parseInt(document.getElementById('anzahl').value, 10);
    const hausnummer = document.getElementById('hausnummer').value;
    const strasse = document.getElementById('strasse').value;
    const kommentar = document.getElementById('kommentar')?.value || '';
    const telefon = document.getElementById('telefon')?.value || '';
    const email = document.getElementById('email')?.value || '';
    const btn = document.getElementById("btnSubmit");
    
    try {
        // Eintrag in die Collection "dorfflohmarkt" erstellen
        const record = await pb.collection('dorfflohmarkt').create({
            name: name,
            angebot: angebot,
            anzahl: anzahl,
            hausnummer: hausnummer,
            strasse: strasse,
            kommentar: kommentar,
            telefon: telefon,
            email: email
        });
        
        btn.ariaBusy = false;

        window.location.href="registrierung-done.php";
        
    } catch (error) {
        console.error('Fehler beim Eintragen:', error);
        switch (error.status) {
          case 400:
            alert('Ungültige Daten. Bitte prüfe deine Eingaben und versuche es erneut.');
            break;
          case 500:
            alert("Interner Fehler :-( Bitte versuche es später noch einmal.");
            break;
          default:
            alert("Ein Fehler ist aufgetreten :-( Bitte versuche es später noch einmal.");
            break;
        }
        btn.ariaBusy = false;
    }
}

  function processForm(e) {

      var btn = document.getElementById("btnSubmit");
      btn.ariaBusy = true;

      if (e.preventDefault) e.preventDefault();

      if (form.checkValidity() === false) {
        alert('Ungültige Daten. Bitte prüfe deine Eingaben und versuche es erneut.');
        return false;
      } else {
        form.classList.add('was-validated');
      }

      submitForm();
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
