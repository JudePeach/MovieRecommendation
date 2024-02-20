<?php

$GLOBALS['token'] = "4a515f379c9b9116057ac1fcaa0a5631";

//Function added by Alex
//This function takes as input an imdb id and returns the poster path for the movie on the movie database
function getPoster($movieID) {

    $url = sprintf('https://api.themoviedb.org/3/find/tt%s?external_source=imdb_id&api_key=%s', $movieID, $GLOBALS['token']);
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Option makes it so the data returned by curl is stored in the data variable

    $data = curl_exec($curl);
    $decoded_data = json_decode($data, true);

    curl_close($curl);

    return $decoded_data["movie_results"][0]["poster_path"];

}

//Example use
    //getPoster(15009428);

?>