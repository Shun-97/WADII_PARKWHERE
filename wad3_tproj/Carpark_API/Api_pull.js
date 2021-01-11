// var database = []
function get_carpark_Avail() { //get availability lot from carpark_datamall api
    const web = new XMLHttpRequest();
    var jsondata = [];
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            // console.log(JSON.parse(this.responseText))
            jsondata = JSON.parse(this.responseText).value

            for (i of jsondata) {
                console.log(i);
                agency = i.CarParkID;
            }

        }

    };
    web.open('GET', "Carpark_API/Carpark_DataMall.php", false);
    web.send();
    return jsondata;
}

function giveMECB() { //get all of Json file
    const web = new XMLHttpRequest();
    var jsondata = [];
    var jsObj = []
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            // console.log(JSON.parse(this.responseText))
            jsondata = JSON.parse(this.responseText);
            for (x of jsondata) {
                let carparkid = "-";
                let carparkname = x.CarPark.toUpperCase();
                let sat_rate = x.Saturday_Rate;
                let wkdy_rate = x.WeekDays_Rate_1;
                let lat = x.Location_Lat;
                let lng = x.Location_Lng;



                // console.log(carparkid,carparkname,sat_rate,wkdy_rate,lat,lng);
                jsObj.push({ "carparkid": carparkid, "carparkname": carparkname, "sat_rate": sat_rate, "wkdy_rate": wkdy_rate, "lat": lat, "lng": lng })
            }
        }
    }

    web.open('GET', "../Carpark_API/rates.json", false);
    web.send();
    return jsObj;
}

function giveMECP() { //get all of URACP
    const web = new XMLHttpRequest();
    var jsondata = [];
    var jsObj = [];
    var cv = new SVY21();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            // console.log(JSON.parse(this.responseText))
            jsondata = JSON.parse(this.responseText);
            for (x of jsondata.Result) {
                if (x.vehCat == "Car") {
                    let carparkid = x.ppCode;
                    let carparkname = x.ppName;
                    let sat_rate = x.satdayRate + " per " + x.satdayMin;
                    let wkdy_rate = x.weekdayRate + " per " + x.weekdayMin;
                    let lat = "-";
                    let lng = "-";
                    if (x.geometries) {
                        let coordinates = x.geometries[0].coordinates;
                        let coorliz = coordinates.split(",");
                        North = coorliz[0];
                        East = coorliz[1];

                        // Computing Lat/Lon from SVY21 Code from cgcai/SVY21 <- From GitHub
                        var resultLatLon = cv.computeLatLon(North, East);
                        lat = resultLatLon.lat;
                        lng = resultLatLon.lon;
                    }
                    // console.log(carparkid,carparkname,sat_rate,wkdy_rate,lat,lng);
                    jsObj.push({ "carparkid": carparkid, "carparkname": carparkname, "sat_rate": sat_rate, "wkdy_rate": wkdy_rate, "lat": lat, "lng": lng })

                }
            }
        }
    };
    web.open('GET', "../Carpark_API/uracp.php", false);
    web.send();
    return jsObj;
}

function giveHDB() { //get all of URACP
    const web = new XMLHttpRequest();
    var jsondata = [];
    var jsObj = [];
    var cv = new SVY21();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            jsondata = JSON.parse(this.responseText);
            // console.log(jsondata)
            for (x of jsondata.result.records) {
                // console.log(x)
                let carparkid = x.car_park_no;
                let carparkname = x.address;
                let sat_rate = 'Free Parking';
                let wkdy_rate = '1.20 per hour';
                let North = x.x_coord;
                let East = x.y_coord;


                // Computing Lat/Lon from SVY21 Code from cgcai/SVY21 <- From GitHub
                var resultLatLon = cv.computeLatLon(North, East);
                lat = resultLatLon.lat;
                lng = resultLatLon.lon;

                // console.log(carparkid,carparkname,sat_rate,wkdy_rate,lat,lng);
                jsObj.push({ "carparkid": carparkid, "carparkname": carparkname, "sat_rate": sat_rate, "wkdy_rate": wkdy_rate, "lat": lat, "lng": lng })

            }
        }
    };
    web.open('GET', "https://data.gov.sg/api/action/datastore_search?resource_id=139a3035-e624-4f56-b63f-89ae28d4ae4c&limit=9999", false);
    web.send();
    return jsObj;
}


