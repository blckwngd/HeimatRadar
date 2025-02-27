// pb_hooks/utils.js
module.exports = {
    hello: (name) => {
        console.log("Hello " + name)
    },

    geocodeAddress: (strasse, hausnummer, plz, ort, land, apiKey) => {
        const address = `${strasse} ${hausnummer}, ${plz} ${ort}, ${land}`;
        const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`;
        console.log(url);
        console.log("ORT:" + process.env.FIXED_ORT);
        

        try {
            const response = $http.send({ 
                url:     url,
                method:  "GET",
                body:    "", // ex. JSON.stringify({"test": 123}) or new FormData()
                headers: {"content-type": "application/json"},
                timeout: 120, // in seconds
            });
            if (response.json.status === "OK") {
                console.log(response.raw);
                const location = response.json.results[0].geometry.location;
                return {
                    type: 'Point',
                    coordinates: [location.lng, location.lat]
                };
            } else {
                console.error('Geocoding-Fehler: ' + response.json.status + " (" + response.json.error_message + ")");
                return null;
            }
        } catch (error) {
            console.error('Geocoding-Anfrage fehlgeschlagen:', error);
            return null;
        }
    },

    sendConfirmationToParticipant: (record, config) => {
        console.log("mail subroutine")

        let email = record.get("email")
        console.log("mail: " + email)

        if (email) {
            console.log("send Bestätigungsmail an " + email);

            const message = new MailerMessage({
                from: {
                    address: $app.settings().meta.senderAddress,
                    name:    $app.settings().meta.senderName,
                },
                to:     [{address: email}],
                bcc:    [{address: $app.settings().meta.senderAddress}],
                subject: config.confirmation_subject,
                html:    config.confirmation_body
            });
            console.log("sending NOW")
            $app.newMailClient().send(message);
        } else {
            console.log("Keine Mailadresse angegeben - Bestätigungsmail wird nicht versendet.")
        }
        return true;
    }
}