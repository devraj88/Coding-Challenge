<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>moviesdb</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js" type="text/javascript" defer="defer"></script>
<script src="js/bootstrap.min.js" type="text/javascript" defer="defer"></script>
</head>

<body style="background:whitesmoke">
<nav class="navbar navbar-default" style="border-radius:0">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">moviesdb</a>
      </div>
    </div><!--/.container-fluid -->
  </nav>
  
  <style>
  	.cover-img {
		box-shadow: 0 0 20px lightgrey;	
	}
	
	.info {
		color: grey;
		text-shadow: 0 0 15px white;	
	}
	
	.title {
		color: rgb(102,102,102);	
	}
  </style>
  <div class="container-fluid" style="background:whitesmoke;margin-top:-20px; height:250px">
  	<div class="container">
    	<?php $form_status = 'block'; 
			if($form_status = 'block'){
				echo '<form name="frm" style="width: 450px; margin-top:25px" method="post" style="display:<?php echo $form_status; ?>">
        	<div class="form-group">
            	<label for="search">Search by movie name: </label>
                <div class="input-group">
                	<input type="text" class="form-control" name="search-field" placeholder="Enter movie name to search..." />
                    <div class="input-group-btn">
                    	<button type="submit" name="search_but" class="btn btn-default" value="Search">Search</button>
                    </div>
                </div>
             </div> 
        </form>';
			}
			
			
			
			
	if(isset($_POST['search_but'])){
		$movie_name = urlencode($_REQUEST['search-field']);
		echo "<b>Requested url: </b>".($url = "http://www.omdbapi.com/?&i=tt3896198&apikey=22c34795&t=".$movie_name."&y=&plot=full&r=json");
		$contents = file_get_contents($url);
		$data = json_decode($contents);
		
		if ($data->{'Response'} == 'True'){
		$form_status = 'none';
		echo '<div id="search-result" class="row" style="margin-top: -20px;">
        	<div class="col-lg-3" style="width:auto">
            	<div class="cover">
                	<div class="cover" style="margin-top:55px;">
                    	<img class="cover-img slideInLeft" src="'.$data->{'Poster'}.'" style="width:auto; height:350px;"/>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
            	<div class="info">
                	<div class="title" style="margin-top:55px">
                    	<div class="title-container">
                        	<h1>'.$data->{'Title'}.'</h1>
                        </div>
                    </div>
					<div class="detail-info">
                        	<p><b>Language/Country: </b>'.$data->{'Language'}.'/'.$data->{'Country'}.'</p>
                        	<p><b>Director:</b> '.$data->{'Director'}.'</p>
                            <p><b>Writer:</b> '.$data->{'Writer'}.'</p>
                            <p><b>Genre: </b>'.$data->{'Genre'}.'</p>
                            <p><b>Actors:</b> '.$data->{'Actors'}.'</p>
                            <p><b>Awards: </b>'.$data->{'Awards'}.'</p>
                            <p><b>IMDB Rating/Votes: </b>'.$data->{'imdbRating'}.'/'.$data->{'imdbVotes'}.'</p>
                            <p><b>Year: </b>'.$data->{'Year'}.', <b>Rated:</b> '.$data->{'Rated'}.', <b>Released: </b>'.$data->{'Released'}.', <b>Runtime:</b>'.$data->{'Runtime'}.'</p>
                            <p><b>Plot: </b>'.$data->{'Plot'}.'</p>
                            <p><a href="http://www.imdb.com/'.$data->{'imdbID'}.'">See more on IMDB...</a></p>
                   </div>
                </div>
            </div>
        </div>';?>
    </div>
  </div>
</body>
</html>
<?php
	}
	else {
		$form_status = 'block';
		echo "<h1>Sorry, data not available.</h1>";
	}		
}	
?>