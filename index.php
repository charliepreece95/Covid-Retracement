<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>COVID Retracement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<script>
    
    const Submit = () => {

        let name = document.getElementById("name").value;
        let number = document.getElementById("number").value;

        if(name === "" || number === "") {
               document.getElementById("valid").innerHTML = "Name or Number \
               cannot be blank";
        }
        else if(!isNaN(name)) {   
                document.getElementById("valid").innerHTML = "Numbers not allowed in \
                the name field";
        }
        else if(number.length < 11 || number.length > 11) {   
                document.getElementById("valid").innerHTML = "Your number must be \
                11 digits";
        }
        else {
                document.getElementById("valid").innerHTML = "Thank You " + "<strong>" + name.toUpperCase() + "<strong/>";
                setTimeout( function () { location.reload(true); }, 4000);
        }
}
    const Clear = () => {

        document.getElementById("valid").innerHTML = "";
        document.getElementById("resetForm").reset();
}
</script>

    <h1>COVID-19 Retracement</h1>
    <!--Send data to DB-->
    <form method="POST" action="insert.php" id="resetForm" class="text-justify">
        <!--Input data to DB-->
        <p class="name">Name</p>
            <input type="text" name="_name" id="name" class="form-control">
        <p class="number">Number</p>
            <input type="number" name="_number" id="number" class="form-control">
        <!--Validation-->
        <div id="validation" class="form-text text-muted">
            <p id="valid"></p>
        </div>
        <!--Submit button to DB-->
        <div class="flex-center">
            <button type='button' id="btn" class="btn btn-success font-weight-bold" onclick='Submit()'>Submit</button>
            <button type='button' id="btnClear" class="btn btn-danger font-weight-bold" onclick="Clear()">Clear</button>
        </div>            
    </form>
</body>
</html>