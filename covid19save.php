<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./bootstrap-5.0.2/css/bootstrap.min.css"/>
<title>COVID19 Information</title>
</head>
<body>
<div id="main">
    <div id="navi" class="bg bg-dark text text-white">Research and Development Lab</div>
    <div id="navi_link" class="container-fluid">
        <a class="list" href="index.php">Home</a>&nbsp;
        <a class="list" href="rest.php">RestFull Web Service</a>
        <a class="list" href="covid19.php">Covid19</a>
    </div>

<?php
$con=new mysqli("localhost","root","","covid2023");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$curl = curl_init();

// Setting up the cURL options
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


// Fetching COVID-19 statistics using cURL
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data1 = json_decode($response, true);
    $arr1 = $data1['response'];
}

// Processing the fetched data and inserting it into the database
foreach ($arr1 as $v) {
    $countryName = $v['country'];
    $population = $v['population'];
    $totalcases = $v['cases']['total'];
    $deaths = $v['deaths']['total'];
    $tests = $v['tests']['total'];
    $continent = $v['continent'];
    $date = $v['day'];
    $sql = "INSERT INTO covidcases (countryName, population, totalcases, deaths, tests, continent, date)
            VALUES ('$countryName', '$population', '$totalcases', '$deaths', '$tests', '$continent', '$date')";
            
     // Inserting the data into the database
    if ($con->query($sql) === TRUE) {    
    } else {
        echo "Error: ";
    }
}
echo '<div class="alert alert-success" role="alert">';
echo  '<h4 class="alert-heading">Well done!</h4>';
echo  '<p class="list">Data entry is successful.</p>';
echo '</div>';
$con->close();
?>

<div id="footer">
                    <div class="text text-dark">
                        All Right Received &copy; 2023
                    </div>
                </div>
</body>
</html>


  