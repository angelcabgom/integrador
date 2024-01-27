<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $gpxDataJson = $_POST["gpxData"];

    
    $gpxData = json_decode($gpxDataJson, true);

   
    $name = $gpxData['name'];
    $distance = $gpxData['distance'];
    $elevation = $gpxData['elevation'];
    $location = $gpxData['location'];

    echo "Name: " . $name . "<br>";
    echo "Distance: " . $distance . "<br>";
    echo "Elevation Min: " . $elevation['min'] . "<br>";
    echo "Elevation Max: " . $elevation['max'] . "<br>";
    echo "Elevation Gain: " . $elevation['gain'] . "<br>";
    echo "Elevation Loss: " . $elevation['loss'] . "<br>";
    echo "Elevation Loss: " . $location['ciudad'] . "<br>";
    echo "Elevation Loss: " . $location['region'] . "<br>";
    echo "Elevation Loss: " . $location['pais'] . "<br>";
}
