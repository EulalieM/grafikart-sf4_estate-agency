import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

export default class Map {
    static init () {
        let map = document.querySelector('#map')
        if (map === null) {
            return
        }
        let icon = L.icon({
            iconUrl: '/images/marker-icon.png',
        });
        let center = [map.dataset.lat, map.dataset.lng]
        map = L.map('map').setView(center, 12)
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXVsYWxpZW1vcmVhdSIsImEiOiJja3d4ajQzdjQwZjM1Mnlycm41MXFrdTAxIn0.JoQ_ZKke13wpW28Vun1yIQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            minZoom: 8,
            id: 'mapbox/streets-v11',
        }).addTo(map)
        L.marker(center, {icon: icon}).addTo(map)
    }
}