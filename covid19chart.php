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
    $data1 = json_decode($response, true);
    $arr1 = $data1['response'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/style.css"/>
    <link rel="stylesheet" href="./bootstrap-5.0.2/css/bootstrap.min.css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(Chart);

        function Chart() {
            // Create a new DataTable for the chart
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Country');
            data.addColumn('number', 'Cases');

            // Loop through the 'response' array and add data to the DataTable
            <?php foreach ($arr1 as $value) {
                // Check if the continent is Europe and the country is not "Europe"
                if (isset($value['continent']) && $value['continent'] === "Europe" && $value['country'] !== "Europe") {
                    ?>
                    data.addRow(['<?php echo isset($value['country']) ? $value['country'] : ''; ?>', 
                                  <?php echo isset($value['cases']['total']) ? $value['cases']['total'] : '0'; ?>]);
                    <?php
                }
            } ?>

            // Set chart options
            var options = {
                title: 'Cases vs Countries in Europe',
                legend: { position: 'bottom' },
                'height': 500,
                'width' : 1000,
            };

            // Create a new BarChart and draw it in the 'chartLink' element
            var chart = new google.visualization.BarChart(document.getElementById('chartLink'));
            chart.draw(data, options);
        }
    </script>
    <title>COVID19 Information</title>
</head>
<body>
<div id="main">
    <div id="navi" class="bg bg-dark text text-white">Research and Development Lab</div>
    <div id="navi_link" class="container-fluid">
        <a class="list" href="index.php">Home</a>&nbsp;
        <a class="list" href="rest.php">RestFull Web Service</a>&nbsp;
        <a class="list" href="covid19.php">COVID19</a>
    </div>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-10">
                    <h4 class="list">COVID19 Information in Europe - Bar Chart</h4>
                        <div id="chartLink" style="min-height: 500px;"></div>
                </div>
                <div id="footer">
                    <div class="text text-dark">
                        All Rights Reserved &copy; 2023 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

