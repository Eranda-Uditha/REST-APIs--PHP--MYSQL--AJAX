<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>City Information</title>
    <link rel="stylesheet" href="./css/style.css"  />
    <link rel="stylesheet" href="./bootstrap-5.0.2/css/bootstrap.min.css" />
    <!-- Including jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showResult(str) {
            if (str.length == 0) {
                $("#livesearch").html("");
                $("#livesearch").css("border", "0px");
                return;
            }
            
            $.ajax({
                url: "livesearch.php",
                method: "GET",
                data: { q: str },
                success: function(response) { //Callback function executed when the request is successful 
                    $("#livesearch").html(response); //Updating the content of an element with the AJAX response
                }
            });
        }
    </script>
</head>
<body>
    <div id="main">
        <div id="navi" class="bg bg-dark text text-white">Research and Development Lab</div>
        <div id="navi_link" class="container-fluid">
            <a class="list" href="index.php">Home</a>&nbsp;
            <a class="list" href="rest.php">RestFull Web Service</a>
        </div>
        
            <div class="container">
                <div class="row">
                    <div class="col-md-1">&nbsp;</div>
                    <div class="col-md-10">
                        <h5 class="list">City Information</h5>
                        <div class="container">
                        <div class="row">
                            <h5 class="text text-primary">
                                <div class="row">
                                    <div class="col-md-4">Search Cities:</div>
                                    <div class="col-md-8">
                                        <!-- Search input with an event listener -->
                                        <input type="text" id="search" class="form-control" onkeyup="showResult(this.value)" />
                                    </div>
                                </div>
                            </h5> 
                            <hr/>
                            <div id="livesearch">Load Cities <!-- Placeholder for the dynamically loaded search results -->   
                            <div id="footer">
                            <div class="text text-dark">
                                All Right Received &copy; 2023
                            </div>
                            </div>
                        </div>
                        </div>                        
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
