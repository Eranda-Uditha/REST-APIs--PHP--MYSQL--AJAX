<?php 
        $cCode = $_GET['q'];// Get the country code from the query parameter
    
        // Retrieve country information using the REST Countries API
        $apipath = "https://restcountries.com/v3.1/alpha/$cCode";
        $dataapi = json_decode(file_get_contents($apipath), true);
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
            <div id="navi" class="bg bg-dark text text-white">REST COUNTRIES API </div>
            <div id="navi_link" class="container-fluid"> 
                <a class="list" href="index.php">Home</a>&nbsp; 
                <a class="list" href="rest.php">RestFull Web Service</a>
            </div>
            <div id="content">
                <h3 class="list"><?php echo $dataapi[0]['name']['common']; ?> </h3> 
                <div class="container">
                    
<table class="table table-striped ">
        <tr><td colspan="2"style="text-align: center; ">
            <img src="<?php echo $dataapi[0]['flags']['png'];  ?>" height="150px" />
            </td>
        </tr>
        <tr><th>Official Name</th>
            <th>
                <?php echo $dataapi[0]['name']['official']; ?>        
            </th>
        </tr>       
        <tr><th>Capital</th>
            <th><?php 
            if (isset($dataapi[0]['capital'][0])){
                            
                $capital_city=$dataapi[0]['capital'][0];
            }
            else{
                $capital_city=" ";
            }

            echo $capital_city; ?>
            </th>
        </tr>
        <tr><th>Code</th>
            <th><?php echo $dataapi[0]['cca2']; ?>
            </th>
        </tr>

        <tr><th>Currency</th>
            <th>
            <?php 
            foreach($dataapi[0]['currencies'] as $v){
                echo $v['name']."<br />";
            } ?>
            </th>
        </tr>
    
       <tr><th>Subregion</th>
           <th>
            <?php 
            if(isset($dataapi[0]['subregion'])){
            echo ($dataapi[0]['subregion']);
            }?>
            </th>
        </tr>

        <tr><th>Continent</th>
           <th>
            <?php 
            if(isset($dataapi[0]['region'])){
            echo ($dataapi[0]['region']);
            }?>
            </th>
        </tr>

        <tr><th>Languages</th><th>
            <?php 
            echo join(", ",$dataapi[0]['languages']); ?>
            </th>
        </tr>

        <tr><th>Borders</th><th>
        <?php 
            if (isset($dataapi[0]['borders'])) {
                foreach($dataapi[0]['borders'] as $v){
                $pathcode="https://restcountries.com/v3.1/alpha/$v";
                $datacode=json_decode(file_get_contents($pathcode),true);
                echo $datacode[0]['name']['common'].", ";
            } 
        }
        ?> 
          
        </th>
        </tr>

        <tr><th>Population</th><th>
            <?php echo number_format($dataapi[0]['population']); ?>        
        </th>
        </tr>

        <tr><th>Area</th><th>
            <?php echo number_format($dataapi[0]['area']); ?>        
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