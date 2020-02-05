<?php
function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}

$x = haversineGreatCircleDistance(36.8152155, -119.749909, 36.8114022, -119.7496391, 6371000);
echo $x;
?>