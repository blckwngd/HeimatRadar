// main.pb.js

onRecordViewRequest((e) => {
    // e.app
    // e.collection
    // e.records
    // e.result
    // and all RequestEvent fields...
    $app.logger().info("OMG it really worked!!! \\o/ we called " + e.record.get("name"))
    console.log("onRecordViewRequest")

    e.next()
}, "dorfflohmarkt")


onRecordsListRequest((e) => {
    e.next()
    console.log("onRecordListRequest: sending mail alert...")
    const config = require(`${__hooks}/config.js`)
    /*
    const message = new MailerMessage({
        from: {
            address: e.app.settings().meta.senderAddress,
            name:    e.app.settings().meta.senderName,
        },
        to:      [{address: config.mail_recipient}],
        subject: "Someone listed your data...",
        html:    "must be haxx0rs",
        // bcc, cc and custom headers are also supported...
    })
    e.app.newMailClient().send(message)
    */
}, "staende")


onRecordCreateRequest((e) => {
    var name = e.record.get("name")
    var email = e.record.get("email")
    var telefon = e.record.get("telefon")
    var strasse = e.record.get("strasse")
    var hausnummer = e.record.get("hausnummer")
    var anzahl = e.record.get("anzahl")
    var kommentar = e.record.get("kommentar")
    var angebot = e.record.get("angebot")
    
    const config = require(`${__hooks}/config.js`)
    const utils = require(`${__hooks}/utils.js`)

    if (strasse && hausnummer) {
        const geoJson = utils.geocodeAddress(strasse, hausnummer, config.event_plz, config.event_ort, config.event_land, config.google_maps_api_key);
        if (geoJson) {
            console.log("setting koordinaten to " + geoJson);
            e.record.set("koordinaten", geoJson);
        }
    }

    e.next()
    
    var token = e.record.get("token")

    console.log("sending mail to " + config.mail_recipient);

    const message = new MailerMessage({
        from: {
            address: e.app.settings().meta.senderAddress,
            name:    e.app.settings().meta.senderName,
        },
        to:      [{address: config.mail_recipient}],
        subject: config.mail_new_entry_subject,
        html:    config.mail_new_entry_subject +
            `Name: ${name}<br/>
            Email: ${email}<br/>
            Telefon: ${telefon}<br/>
            Adresse: ${strasse} ${hausnummer}<br/>
            Angebot: ${angebot}<br/>
            Kommentar: ${kommentar}<br/>
            <a href="${config.pocketbase_uri}/reject/${e.record.get('id')}?token=${token}">ABLEHNEN</a>&nbsp;&nbsp;&nbsp;
            <a href="${config.pocketbase_uri}/accept/${e.record.get('id')}?token=${token}">AKZEPTIEREN</a>`
        // bcc, cc and custom headers are also supported...
    });

    e.app.newMailClient().send(message);

}, "dorfflohmarkt");

onRecordUpdateRequest((e) => {
    const strasse = e.record.get("strasse");
    const hausnummer = e.record.get("hausnummer");
    
    const utils = require(`${__hooks}/utils.js`)
    utils.hello("world")

    if (strasse && hausnummer) {
        const geoJson = utils.geocodeAddress(strasse, hausnummer);
        if (geoJson) {
            console.log("setting koordinaten to " + geoJson);
            e.record.set("koordinaten", geoJson);
        }
    }
    e.next()
}, "dorfflohmarkt");

/** CRONJOB (1 min) */
cronAdd("hello", "*/1 * * * *", () => {
    // this runs every minute in background
})

onBootstrap((e) => {
    console.log("onBootstrap");
    e.next()
    // e.app
})

onSettingsReload((e) => {
    console.log("onSettingsReload");
    e.next()

    // e.app.settings()
})

// register "GET /reject/{id}" route
routerAdd("GET", "/reject/{id}", (e) => {

    let id = e.request.pathValue("id")
    let token = e.requestInfo().query["token"]
    let record = $app.findRecordById("dorfflohmarkt", id)

    if (token == record.get("token")) {
        console.log("Eintrag wird gelöscht!!")
        $app.delete(record);
        return e.json(200, { "message": "Eintrag wurde gelöscht" })
    } else {
        console.log("falscher token!!")
        return e.json(401, { "message": "Nicht authorisiert" })
    }

})

// register "GET /accept/{id}" route
routerAdd("GET", "/accept/{id}", (e) => {
    
    const utils = require(`${__hooks}/utils.js`)
    const config = require(`${__hooks}/config.js`)

    let id = e.request.pathValue("id")
    let token = e.requestInfo().query["token"]
    let record = $app.findRecordById("dorfflohmarkt", id)

    if (token == record.get("token")) {
        console.log("Eintrag akzeptiert!!")
        let success = utils.sendConfirmationToParticipant(record, config)
        if (success) {
            record.set("verifiziert", true);
            $app.save(record);
            return e.json(200, { "message": "Eintrag wurde akzeptiert" })
        } else {
            return e.json(405, { "message": `Fehler beim Versenden der Mailbenachrichtigung an ${record.get("email")}` })
        }
    } else {
        console.log("falscher token!!")
        return e.json(401, { "message": "Nicht authorisiert" })
    }

})