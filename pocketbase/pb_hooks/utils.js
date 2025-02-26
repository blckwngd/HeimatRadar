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
    }
}