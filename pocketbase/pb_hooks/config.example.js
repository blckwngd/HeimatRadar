// pb_hooks/config.js
module.exports = {
    /** Google Maps API Key (für Geocoding) */
    google_maps_api_key: "DEIN_KEY_HIER",
    
    /** Basis-URL der Pocketbase-Instanz für HeimatRadar */
    pocketbase_uri: "http://127.0.0.1:8090",

    /** Postleitzahl der Veranstaltung */
    event_plz: "12345",

    /** Ort der Veranstaltung */
    event_ort: "Musterstadt",

    /** Land der Veranstaltung */
    event_land: "Deutschland",

    /** Daten zur Infomail, die nach Eintragung eines neuen Stands an den Admin geht */
    mail_recipient: "your@mail.com",
    mail_new_entry_subject: "Neuer Eintrag",
    mail_new_entry_body: "Ein neuer Eintrag wurde hinzugefügt. Hier sind die Daten:",
    
    /** Daten zu Bestätigungsmail, die Teilnehmer*innen nach Verifizierung durch den Admin erhalten */
    confirmation_subject: "Teilnahme bestätigt",
    confirmation_body: `Deine Teilnahme wurde <b>bestätigt</b>`
}