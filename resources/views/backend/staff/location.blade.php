<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Latitude and Longitude</title>
</head>
<body>

    <h1>Page Loaded - Getting Your Current Location</h1>

    <p id="demo"></p>

    <script>
        // Call getLocation when the page is loaded
        window.onload = function() {
            getLocation();
        };

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                document.getElementById("demo").innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            document.getElementById("demo").innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;

            // Log latitude and longitude to the console
            console.log("Latitude:", latitude);
            console.log("Longitude:", longitude);
        }
    </script>

</body>
</html>