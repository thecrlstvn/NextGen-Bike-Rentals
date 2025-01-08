<?php 
include('includes/header.php'); 
?>

<div class="main-content">
  <div class="container mt-2">
    <!-- Header Section -->
    <div class="header">
      <div class="logo">
        <img src="assets/img/nextgen.png" alt="NextGen Logo" style="height: 27px;">
      </div>
      <div class="title h4">Rental Operations for Tracking Bikes </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
      <h5 class="mb-3">Monitor the Bikes</h5>
      <div id="map" style="height: 500px; width: 100%;"></div> <!-- Adjusted map height -->
    </div>

    <!-- Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map, marker;

        // Initialize the map
        function initMap() {
            map = L.map('map').setView([0, 0], 16); // Default center, will update later
            
            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a marker at default location (0, 0)
            marker = L.marker([0, 0], {
                draggable: true // Optional: Makes the marker draggable
            }).addTo(map);

            // Start updating the location
            updateLocation();
        }

        // Function to update location from the PHP backend
        function updateLocation() {
            fetch("fetch_latest_location.php") // PHP script to get the latest location from the database
                .then(response => response.json())
                .then(data => {
                    const lat = parseFloat(data.latitude);
                    const lon = parseFloat(data.longitude);

                    // Check if the new coordinates are different from the previous ones
                    if (marker.getLatLng().lat !== lat || marker.getLatLng().lng !== lon) {
                        // Smoothly move the marker to the new position
                        marker.setLatLng([lat, lon]).update();

                        // Optionally, move the map to the marker's new position, but only if it's not already centered
                        if (map.getCenter().lat !== lat || map.getCenter().lng !== lon) {
                            map.setView([lat, lon], 16, { animate: true });
                        }

                        // Log the updated coordinates for debugging
                        console.log("Updated GPS Coordinates: Latitude: " + lat + ", Longitude: " + lon);
                    }
                })
                .catch(error => {
                    console.error("Error fetching location:", error);
                });
        }

        // Update location every 5 seconds
        setInterval(updateLocation, 5000);

        // Initialize the map after the page has loaded
        document.addEventListener("DOMContentLoaded", initMap);
    </script>

<?php include('includes/footer.php'); ?>
