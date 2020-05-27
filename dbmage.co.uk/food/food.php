<?php

$zomatokey = 'e697769205c156d9b1448920001a160d';
$googlekey = 'AIzaSyATkseftbvHPPhADXctTCNSbcQvQnBpG34';
$city_id = 61;
//$location = json_decode( shell_exec(' curl -X GET "https://www.googleapis.com/geolocation/v1/geolocate?key=$googlekey"')
$result = json_decode( shell_exec('curl -X GET --header "Accept: application/json" --header "user-key: ' . $zomatokey . '" "https://developers.zomato.com/api/v2.1/search?lat=51.5092375&lon=-0.0599393&radius=1000"') );
if ( $result->{"restaurants"} ) {
    print("<table>\n");
    print("\t<tr>\n");
    print("\t\t<th>Name</th>\n");
    print("\t\t<th>Cuisine</th>\n");
    print("\t\t<th>Address</th>\n");
    print("\t\t<th>Zomato user rating (votes)</th>\n");
    print("\t</tr>\n");
};
foreach ( $result->{"restaurants"} as $option ) {
    $restaurant = $option->{'restaurant'};
    print("\t<tr>\n");
    print("\t\t<td>" . $restaurant->{'name'} . "</td>\n");
    print("\t\t<td>" . $restaurant->{'cuisines'} . "</td>\n");
    print("\t\t<td>" . $restaurant->{'location'}->{'address'} . "</td>\n");
    print("\t\t<td>" . $restaurant->{'user_rating'}->{'aggregate_rating'} . " (" . $restaurant->{'user_rating'}->{'votes'} . ")</td>\n");
    print("\t</tr>\n");
};
if ( $result->{"restaurants"} ) {
    print("</table>\n");
};
?>
