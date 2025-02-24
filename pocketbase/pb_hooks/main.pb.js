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
}, "staende")


onRecordCreateRequest((e) => {
    const strasse = e.record.get("strasse");
    const hausnummer = e.record.get("hausnummer");
    
    const config = require(`${__hooks}/config.js`)
    const utils = require(`${__hooks}/utils.js`)

    if (strasse && hausnummer) {
        const geoJson = utils.geocodeAddress(strasse, hausnummer);
        if (geoJson) {
            console.log("setting koordinaten to " + geoJson);
            e.record.set("koordinaten", geoJson);
        }
    }

    const mail = e.record.get("email");
    console.log("sending mail to " + mail);

    const message = new MailerMessage({
        from: {
            address: e.app.settings().meta.senderAddress,
            name:    e.app.settings().meta.senderName,
        },
        to:      mail,
        subject: "YOUR_SUBJECT...",
        html:    "YOUR_HTML_BODY...",
        // bcc, cc and custom headers are also supported...
    });

    if (mail) {
        e.app.newMailClient().send(message);
    }

    e.next()
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

/** CRONJOB */
console.log("setting up cronjobs...")
// prints "Hello!" every minute
cronAdd("hello", "*/1 * * * *", () => {
    console.log("Hello!")
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