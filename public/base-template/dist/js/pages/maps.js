$(document).ready(function () {
    //--------------START Deklarasi awal seperti icon pembuatan map-------------//
    var mymap = L.map('gmaps').setView([-8.4517916, 115.1970086], 9);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Maps E-Yajamana',
        maxZoom: 18,
        minZoom: 9,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibWFkZXJpc21hd2FuIiwiYSI6ImNrbGNqMzZ0dDBteHIyb21ydTRqNWQ4MXAifQ.YyTGDJLfKwwufNRVYUdvig'
    }).addTo(mymap);

    document.getElementById("modalMap").onclick = function () {
        document.getElementById('modal-xl').style.display = 'block';
        setTimeout(function () {
            mymap.invalidateSize();
        }, 100);
    }

})
