using rest api is easy.. In this code sample rest api of google and instagram are being used.
The location values are obtained for a entered city by using google maps api, and then the instagram api is used to retrive the mages for that location..

<?php   

	if(!empty($_GET['location'])){

			$map_url="https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($_GET['location']);
			$maps_json=file_get_contents($map_url);
			$maps_array=json_decode($maps_json,true);
			//print_r($maps_array);
			$lat=$maps_array['results'][0]['geometry']['location']['lat'];
			$lng=$maps_array['results'][0]['geometry']['location']['lng'];
//the access toke can be quickly obtained from http://services.chrisriversdesign.com/instagram-token/ for more info refer the blog https://shareurcodes.com/blog/instagram%20location%20image%20fetcher%20in%20php.
			$insta_url="https://api.instagram.com/v1/media/search?lat=".$lat."&lng=".$lng."&access_token=6765184942.e029fea.33c257e0aca14dc6942440c4d67bbbb3";
			$insta_json=file_get_contents($insta_url);
			$insta_array=json_decode($insta_json,true); // taking the json object obtained in array format
			//echo($insta_json);

}
 ?>

<head>
<title>geogram</title>
</head>
<body>
<form action="" method="">
	Enter Location:
	<input type="text" name="location">
	<button type="submit" value="submit">Submit</button>


</form>

<br>

<?php

if(!empty($insta_array)){
	
	foreach ($insta_array['data'] as $key => $images) {
		echo "<img src='".$images['images']['low_resolution']['url']."'>";
	}
}

?>



</body>
