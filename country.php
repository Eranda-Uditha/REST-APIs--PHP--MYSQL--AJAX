<?php 
    // Setting path to access the REST Countries API and retrieving the response
    $apipath = "https://restcountries.com/v3.1/region/asia";
    $apiResponse = file_get_contents($apipath);

    if ($apiResponse === false) {
        // Handle the error when the API request fails
        echo "Failed to retrieve data from the API.";
        exit;
    }

    $countries = json_decode($apiResponse, true);

    if ($countries === null) {
        // Handle the error when the API response is invalid
        echo "Invalid API response.";
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Country Information</title>
        <link rel="stylesheet" href="./css/style.css"  />
        <link rel="stylesheet" href="./bootstrap-5.0.2/css/bootstrap.min.css" />
    </head>
    <body>
   
        <div id="main">
            <div id="navi" class="bg bg-dark text text-white">REST COUNTRIES API</div>
            <div id="navi_link" class="container-fluid"> 
                <a class="list" href="index.php">Home</a>&nbsp; 
                <a class="list" href="rest.php">RestFull Web Service</a>
            </div>
            <div id="content">
                <h5 class="list">Asian Countries </h5> 
                <div class="container">
                    
          
        <table class="table table-striped"> <!-- A table for displaying country information -->
                <tr class="text text-primary">
                    <th>Flag</th>
                    <th>Country Name</th>
                    <th>Capital City</th>
                    <th>Region</th>
                    <th>Subregion</th>
                    <th>Currencies</th>
                    <th>Country Code</th>
                    <th>&nbsp;</th>
                </tr>   
            
            <?php                 
                foreach ($countries as $country_details) {
                    
                    $flag        =$country_details['flags']['png'];
                    $country_name=$country_details['name']['common'];
                    $region      =$country_details['region'];
                    $subregion   =$country_details['subregion'];
                    $currencies= $country_details['currencies'];
                    $countrycode =$country_details['cca2'];
                    
                    if (isset($country_details['capital'][0])){
                        
                        $capital_city=$country_details['capital'][0];
                    }
                    else{
                        $capital_city=" ";
                    }
                    
            ?>
        
                    <tr>
                        <td><img src="<?php echo $flag; ?>" width="70px" height="40px"></td>
                        <td><?php echo $country_name; ?></td>
                        <td><?php echo$capital_city; ?></td>
                        <td><?php echo$region; ?></td>
                        <td><?php echo$subregion; ?></td>
                        
                        <td> 
                            <?php     
               
                                foreach ($currencies as $currencyCode => $currency) {

                                     $curr_name = $currency['name'];
                                     $curr_symbol = $currency['symbol'];
                                
                                // Print the currency name followed by the symbol, tab character, and line break
                                  echo  $curr_name."(".$curr_symbol.")\t\t"."<br />";

                             }?>
                        </td>
                        
                        <td><?php echo $countrycode; ?></td>
                        <td>
                           
                           <a href="countrydetails.php?q=<?php echo $countrycode;?>">
                                <button type="button" class="btn btn-success">View</button>
                            </a>
                        </td>
                    </tr>
               <?php }
        
        ?>
        
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








