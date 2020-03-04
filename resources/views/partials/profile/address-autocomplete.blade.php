@extends('profile')
@section('section')

<section>
    <div class="card my-3 col-12 col-md-12 col-lg-7">
        <div class="card-body">
            <div class="row mb-2">
                <a @click="select('address-list')" class="col-1"><i class="fas fa-arrow-left"></i></a>
                <h4 class="col-10">Agregar direccion</h4>
            </div>
            <div id="locationField" class="mb-4">
                <input type="text" name="" id="autocomplete" class="form-control" placeholder="Enter your address" onFocus="geolocate()">
            </div>

            <div id="address">
                <input id="route" class="form-control form-control-sm" disabled readonly />
                <input id="street_number" class="form-control form-control-sm" disabled readonly />
                <input class="form-control form-control-sm" id="locality" disabled readonly />
                <input class="form-control form-control-sm" id="administrative_area_level_1" disabled readonly />
                <input class="form-control form-control-sm" id="postal_code" disabled readonly />
                <input class="form-control form-control-sm" id="country" disabled readonly />
            </div>
        </div>
    </div>

</section>


<!-- Note: The address components in this sample are typical. You might need to adjust them for
               the locations relevant to your app. For more information, see
         https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
    -->


<script type="application/javascript">
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {
                types: ['geocode']
            });

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>
@endsection

@section('script')
<script type="application/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-cPr5rLoUTj8f_5e5FhpU0ER6hg32tRU&libraries=places&callback=initAutocomplete" async defer></script>
@endsection