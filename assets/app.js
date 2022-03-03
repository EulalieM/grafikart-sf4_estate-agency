/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

let $ = require('jquery')
import './styles/app.css'
import './bootstrap'
import 'select2'
import Places from 'places.js'
import Map from './modules/map'

// Select 2 form
$('select').select2()
// TODO: add placeholder https://select2.org/placeholders

// Suppression images
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        fetch(a.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-Requested-Width': 'XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'_token': a.dataset.token})
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
})

// Algolia Places
let inputAddress = document.querySelector('#property_address')
if (inputAddress !== null) {
    let place = Places({
        container: document.querySelector('#property_address')
    })
    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postal_code').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng
    })
}

let searchAddress = document.querySelector('#search_address')
if (searchAddress !== null) {
    let place = Places({
        container: document.querySelector('#search_address')
    })
    place.on('change', e => {
        document.querySelector('#lat').value = e.suggestion.latlng.lat
        document.querySelector('#lng').value = e.suggestion.latlng.lng
    })
}

// Leaflet
Map.init()