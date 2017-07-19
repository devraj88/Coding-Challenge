<?php
	$movie_name = $_REQUEST['search-field'];
	$url = "http://www.omdbapi.com/?i=tt3896198&apikey=22c34795&t=".$movie_name."&y=&plot=full&r=json";
	$contents = file_get_contents($url);
	$data = json_decode($contents);

    try {
        if ($data->{'Response'} == 'True'){
            echo $data->{'Title'};
            echo $data->{'Year'};
        }
        else {
            echo "Sorry, data not available.";
        }
    }
    catch (Exception $e){
        echo "Sorry, data not available.";
    }

?>