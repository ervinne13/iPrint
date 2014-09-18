
/* global form_utilities, baseURL */

(function () {

    var $map;
    var marker = false;

    var fileUploadPending = false;

    $(document).ready(function () {
        setupValidation();
        initializeMap();
        initializeEvents();
    });

    function setupValidation() {
        $('#form-store').validate({
            rules: {
                password1: "required",
                password2: {
                    equalTo: "[name=password1]"
                }
            }
        });
    }

    function initializeEvents() {
        $('#action-submit').click(submitForm);
        $("#input-store-image").change(function () {
            previewFileImage(this, $('#store-image'));
            uploadFile(this);
        });
    }

    function previewFileImage(input, $img) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $img.attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function uploadFile(input) {
        if (input.files && input.files[0]) {
            var formData = new FormData();
            formData.append('file', input.files[0]);

            $.ajax({
                url: '/file/upload',
                type: 'POST',
                processData: false, // important
                contentType: false, // important                
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('[name=logo_url]').val("/uploads/" + response);
                    fileUploadPending = false;
                }
            });

            fileUploadPending = true;

        }
    }

    function initializeMap() {

        //  Philippine Location:
        var centerOfMap = new google.maps.LatLng(14.7082042, 120.9624023);

        var options = {
            center: centerOfMap,
            zoom: 14,
        };

        $map = new google.maps.Map(document.getElementById('map'), options);

        //Listen for any clicks on the map.
        google.maps.event.addListener($map, 'click', function (event) {
            //Get the location that the user clicked.
            var clickedLocation = event.latLng;
            //If the marker hasn't been added.
            if (marker === false) {
                //Create the marker.
                marker = new google.maps.Marker({
                    position: clickedLocation,
                    map: $map,
                    draggable: true //make it draggable
                });
                //Listen for drag events!
                google.maps.event.addListener(marker, 'dragend', function (event) {

                    var currentLocation = marker.getPosition();

                    $('input[name=location_lat]').val(currentLocation.lat());
                    $('input[name=location_long]').val(currentLocation.lng());

                });
            } else {
                //Marker has already been added, so just change its location.
                marker.setPosition(clickedLocation);
            }
            //Get the marker's location.
            markerLocation();
        });
    }

    function submitForm() {

        if (fileUploadPending) {
            swal({
                title: "Upload Pending",
                text: "Upload is still ongoing! Please wait",
                type: "warning"
            });
            return;
        }

        var shop;
        var url = baseURL + "/stores";
        var method = 'POST';

        if (mode == 'edit') {
            url += "/" + storeId;
            method = 'PUT';
            
            shop = form_utilities.formToJSON($('#form-store'));
            
        } else {

            shop = form_utilities.formToJSON($('#panel-store'));
            shop.owner = form_utilities.formToJSON($('#panel-owner'));

        }
        
        console.log(shop);

        if ($('#form-store').valid()) {
            var data = shop;
            data._token = _token;
            $.ajax({
                url: url,
                type: method,
                data: shop,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    swal("Success!", "Store Saved!", "success");
                    setTimeout(function () {
                        if (mode == 'edit') {
                            window.location.reload();
                        } else {
                            window.location.href = "/stores";
                        }

                    }, globals.reloadRedirectWaitTime);
                }
            });

        }


    }

})();
