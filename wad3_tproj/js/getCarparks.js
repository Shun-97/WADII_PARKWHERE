var js_scripts = [
    "Carpark_API/OneMap_search.js",
    "Carpark_API/Api_pull.js",
];

js_scripts.forEach(function (filename) {
    var fileref = document.createElement('script');
    fileref.setAttribute("type", "text/javascript");
    fileref.setAttribute("src", filename);
    document.getElementsByTagName("head")[0].appendChild(fileref);
});

function getCarparks() { //get carpark entries from availability API and rates DB
    var carparks_sg = getCarparkList(); ///get carparks from DB
    var availability_array = getCarparkAvailability().value; //get carparks and availability from availability API

    let carpark_info_array = new Array();

    for (let i = 0; i < carparks_sg.length; i++) { //process data from DB (rates)
        if (!isNaN(carparks_sg[i].lat)) { //only process records with a valid coord
            var info_obj = {};
            for (let e = 0; e < availability_array.length; e++) {
                if (availability_array[e].CarParkID == carparks_sg[i].carparkid) { //records from the DB that matches with availabilityAPI
                    info_obj.availableLots = Number(availability_array[e].AvailableLots);
                    break;
                } else {
                    info_obj.availableLots = "N/A";
                }
            }
            // console.log(carparks_sg[i]);
            info_obj.cpid = carparks_sg[i].carparkid;
            info_obj.lat = Number(carparks_sg[i].lat);
            info_obj.lng = Number(carparks_sg[i].lng);
            info_obj.cpname = carparks_sg[i].carparkname;
            info_obj.sat_rate = carparks_sg[i].sat_rate;
            info_obj.wkdy_rate = carparks_sg[i].wkdy_rate;
            carpark_info_array.push(info_obj);
        }
    }
    return carpark_info_array;
}

function getCarparkList() {
    var jsObj;
    const web = new XMLHttpRequest();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            // console.log(this.responseText)
            jsObj = JSON.parse(this.responseText);
        }
    };

    web.open('GET', "php/getcarpark.php", false);
    web.send();
    return jsObj;
}

function getCarparkAvailability() {
    var jsObj;
    const web = new XMLHttpRequest();
    web.onreadystatechange = function () {
        if (web.readyState == 4 && web.status == 200) {
            jsObj = JSON.parse(this.responseText);
        }
    };

    web.open('GET', "Carpark_API/Carpark_DataMall.php", false);
    web.send();
    return jsObj;
}

function getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1); // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d;
}

function deg2rad(deg) {
    return deg * (Math.PI / 180)
}