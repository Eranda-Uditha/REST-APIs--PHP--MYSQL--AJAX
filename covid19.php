<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://covid-193.p.rapidapi.com/statistics",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: covid-193.p.rapidapi.com",
		"X-RapidAPI-Key: 70cdf0cfc9mshe6ce5553db71134p10077ejsnc62927e21a99"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    // Decoding the response JSON into an associative array
    $data1 = json_decode($response, true);
    // Extracting the 'response' array from the decoded data
    $arr1=$data1['response'];  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/style.css"  />
    <link rel="stylesheet" href="./bootstrap-5.0.2/css/bootstrap.min.css" />
    <title>COVID19 Information</title>
</head>
<body >
<div id="main">
            <div id="navi" class="bg bg-dark text text-white">REST COUNTRIES API </div>
            <div id="navi_link" class="container-fluid"> 
                <a class="list" href="index.php">Home</a>&nbsp; 
                <a class="list" href="rest.php">RestFull Web Service</a>&nbsp; 
                <a class="list" href="covid19.php">COVID19</a> 
            </div>
            <div id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-10" >                           
    <h4 class="list">COVID19 Information in Europe </h4>        
      <div class="container">
            
            <hr />
            
             <table class="table">
            <tr>
                <th>Country</th>
                <th>Population</th>
                <th>Total Covid Cases</th>
                <th>Total Deaths</th>
                <th>Tests</th>
                <th>Continent</th>
            </tr>
           
            <?php foreach ($arr1 as $value) {
    if (isset($value['continent'])) {
        if ($value['continent'] == "Europe") { ?>
            <tr>
                <td><?php echo isset($value['country']) ? 
                            $value['country'] : ''; ?>
                </td>

                <td><?php echo isset($value['population']) ? 
                            number_format($value['population']) : '0'; ?>
                </td>
                
                <td><?php echo isset($value['cases']['total']) ? 
                            number_format($value['cases']['total']) : '0'; ?>
                </td>

                <td><?php echo isset($value['deaths']['total']) ?
                            number_format($value['deaths']['total']) : '0'; ?>
                </td>

                <td><?php echo isset($value['tests']['total']) ? 
                            number_format($value['tests']['total']) : '0'; ?>
                </td>

                <td><?php echo isset($value['continent']) ?
                            $value['continent'] : ''; ?>
                </td>
            </tr>
        <?php }
    }
} ?>

</table>
        </div>
        </div>
        <div id="footer">
                <div class="text text-dark">
                    All Right Received &copy; 2023   
                </div>    
            </div>
</body>
</html>
