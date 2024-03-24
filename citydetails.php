<?php
$data = $_GET['q']; // Getting the value of 'q' parameter from the GET request

$curl = curl_init(); // Initializing a cURL session

curl_setopt_array($curl, [
    CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/cities/$data",
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
$error = curl_error($curl);

curl_close($curl);

if ($error) {
    echo "cURL Error #:" . $error;
} else {
    $cityInfo = json_decode($response, true);
}
?>

<!DOCTYPE html>
<head>    
    <link rel="stylesheet" href="./css/style.css"  />
        <link rel="stylesheet" href="./bootstrap-5.0.2/css/bootstrap.min.css" />
    <title>City Information</title>
</head>
<body>
<div id="main">
            <div id="navi" class="bg bg-dark text text-white">Research and Development Lab </div>
            <div id="navi_link" class="container-fluid"> 
                <a class="list" href="index.php">Home</a>&nbsp; 
                <a class="list" href="rest.php">RestFullWebService</a>&nbsp;
                <a class="list" href="city.php">CitiesAndStates</a>
            </div>
<div id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-10" >                           
    <h4 class="list">City Information </h4>               
 
      <div class="container">
            
            <hr />
            
             <table class="table table-striped">
                <tr>
                    <th>City ID:</th>
                    <td><?php echo $cityInfo['id']; ?></td>
                </tr>
                <tr>
                    <th>City Name:</th>
                    <th><?php echo $cityInfo['name']; ?></th>
                </tr>
                <tr>
                    <th>State Name:</th>
                    <td>
                        <?php
                        if (isset($cityInfo['state_name'])) {
                            echo $cityInfo['state_name'];
                        } else {
                            echo 'No data available';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Country Name:</th>
                    <td>
                        <?php
                        if (isset($cityInfo['country_name'])) {
                            echo $cityInfo['country_name'];
                        } else {
                            echo 'No data available';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Country Flag:</th>
                    <td>

                        <?php 
                        if (isset($cityInfo['country_code'])) {
                            $countryName = $cityInfo['country_code'];
                            $apipath = "https://restcountries.com/v3.1/alpha/$countryName";
                            $apiResponse = file_get_contents($apipath);
                            $countries = json_decode($apiResponse, true);
                            if (!empty($countries)) {
                                $country = $countries[0];

                                // Display the flag image using the PNG URL from the country data
                                echo '<img src="' . $country['flags']['png'] . '" style="width: 100px; height: auto;" >';
                            } else {
                                echo 'No flag available';
                            }
                        } else {
                            echo 'No flag available';
                        }
                        ?>
                     </td>
                </tr>
            <tr>
                    <th colspan="2">
                    <!-- Embedding a Google Maps iframe with the city location -->
                        <?php
                                    if (isset($cityInfo['name']) && isset($cityInfo['state_name'])) {
                                        $location = urlencode($cityInfo['name'] . ',' . $cityInfo['state_name']);
                                        echo "<iframe
                                                width='100%'
                                                height='350'
                                                style='border:0'
                                                loading='lazy'
                                                allowfullscreen
                                                referrerpolicy='no-referrer-when-downgrade'
                                                src='https://www.google.com/maps/embed/v1/place?key=AIzaSyBpe_lysxbbxfuNQ6lhcP6t3bXoZstxkHY&q={$location}'>
                                                </iframe>";
                                    } else {
                                        echo 'No data available';
                                    }
                                    ?>
                    </th>
                </tr>
            </table>
        </div>
    </div>
    <div id="footer">
                <div class="text text-dark">
                    All Right Received &copy; 2023   
                </div>    
            </div>
  
</div>
</body>
</html>
