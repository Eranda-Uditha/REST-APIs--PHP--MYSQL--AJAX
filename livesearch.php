<?php
$data = $_GET['q'];  // Get the value of 'q' parameter from the URL
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/search?q=$data",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: city-and-state-search-api.p.rapidapi.com",
		"X-RapidAPI-Key: 70cdf0cfc9mshe6ce5553db71134p10077ejsnc62927e21a99"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $value = json_decode($response, true); // Decode the response JSON and store it in the variable $value
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css"  />
    <link rel="stylesheet" href="bootstrap-5.2.3/css/bootstrap.min.css"/>
    <title>City Details</title>
</head>
<body>
<div id="content">
    <div class="row">
    <table class="table">
        
        <tr>
            <th>ID</th>
            <th>City Name</th>
            <th>State Name</th>
            <th>Country Name</th>
            <th></th>
        </tr>
                
        <?php foreach ($value as $v) { // Iterate over each element in the $value array
            if (!empty($v['id']) && !empty($v['name']) && !empty($v['state_name']) && !empty($v['country_name'])) { ?>
                <tr>
                    <td><?php echo $v['id']; ?></td>
                    <td><?php echo $v['name']; ?></td>
                    <td><?php echo $v['state_name']; ?></td>
                    <td><?php echo $v['country_name']; ?></td>
                    <td>
                        <a href="citydetails.php?q=<?php echo $v['id'];?>">
                            <button type="button" class="btn btn-success">City Details</button>
                        </a>
                    </td>
                </tr>
            <?php }
        } ?>        
    </table>
    <div id="footer">
                <div class="text text-dark">
                    All Right Received &copy; 2023   
                </div>    
            </div>
        </div>
    </div>
    
</body>
</html>
