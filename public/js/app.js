// import Places from "../../node_modules/places.js"
//
// let inputAddress = document.querySelector('#property_address')
// if (inputAddress !== null) {
//     let place = Places({
//         container: document.querySelector('#property_address')
//     })
//     place.on('change', e => {
//         document.querySelector('#property_city').value = e.suggestion.city
//         document.querySelector('#property_postal_code').value = e.suggestion.postcode
//         document.querySelector('#property_lat').value = e.suggestion.latlng.lat
//         document.querySelector('#property_lng').value = e.suggestion.latlng.lng
//     })
// }

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
