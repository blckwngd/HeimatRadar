/*eslint no-undef: "off"*/

//import Translator from "@andreasremdt/simple-translator";

// The below provided options are default.
var translator = new Translator({
  defaultLanguage: "de",
  detectLanguage: true,
  selector: "[data-i18n]",
  debug: false,
  registerGlobally: "__",
  persist: true,
  persistKey: "preferred_language",
  filesLocation: "/i18n"
});

translator.fetch(["de", "en"]).then(() => {
  // Calling `translatePageTo()` without any parameters
  // will translate to the default language.
  translator.translatePageTo();
  registerLanguageToggle();
});

function registerLanguageToggle() {
  var select = document.querySelector("select");

  select.addEventListener("change", evt => {
    var language = evt.target.value;
    translator.translatePageTo(language);
  });
}
