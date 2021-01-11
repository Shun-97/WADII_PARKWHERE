function onemap_search(Location_Keyword) {
   let request = new XMLHttpRequest();
   var jsondata = [];
   request.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
         jsondata.push(JSON.parse(this.responseText));
         // console.log(this.responseText)
         // console.log(JSONobj.results[0])
      }
   };
   request.open("GET", `https://developers.onemap.sg/commonapi/search?searchVal=${Location_Keyword}&returnGeom=Y&getAddrDetails=Y&pageNum=1`, false);
   request.send();

   return jsondata;
}