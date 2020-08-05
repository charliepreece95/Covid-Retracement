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
<script>
    
    const Submit = () => {
        //declare and get Id's from HTML 
        let name = document.getElementById("name").value;
        let number = document.getElementById("number").value;
        //prevent cache
        autocomplete = "off";
    
    //prevent form submitting with invalid data
    const noSubmit = () => {

        let refuseSubmit = document.querySelector("form");

        refuseSubmit.addEventListener("submit", event => {
            event.preventDefault();
            console.log("form not submitted");
        })
    };
        //name or number is blank
        if(name === "" || number === "") {
               noSubmit();
               document.getElementById("valid").innerHTML = "Name or Number \
               cannot be blank";
        }
        //letters only
        else if(!isNaN(name)) {
                noSubmit(); 
                document.getElementById("valid").innerHTML = "Numbers not allowed in \
                the name field";
        }
        //only allows eleven digits
        else if(number.length < 11 || number.length > 11) {  
                noSubmit(); 
                document.getElementById("valid").innerHTML = "Your number must be \
                11 digits";
        }
        //data is valid so is submitted
        else {
                //allow data to be submitted
                let submit = document.querySelector("form");
                //submit form click event 
                submit.addEventListener("submit", event => { 
                event.submit();
                });
                //refresh page after 3 seconds (doesn't work)
                setTimeout( function () { location.reload(true); }, 3000);
                document.getElementById("valid").innerHTML = "Thank You " + "<strong>" + name.toUpperCase() + "<strong/>";
                console.log("form submitted");
        }
}
        //clear form upon click event
        const Clear = () => {

            document.getElementById("valid").innerHTML = "";
            document.getElementById("resetForm").reset();
}
</script>
<body>
    <?php
        //get db credentials
        include "insert.php";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $db_name);
        // Check connection
        if ($conn->connect_errno) { 
        die("Connection failed: " . $conn->connect_error);
        }
        // Check if server is alive
        if ($conn -> ping()) {
            echo "Connection is ok! <br>";
        }else {
            echo "Error: ". $conn -> error;
        }

        //if submit button is triggered do this
        if(isset($_POST["submit"])) {

            //get values from fields and insert into db
            $stmt = $conn->prepare("INSERT INTO user (fname, telephone) VALUES (?, ?)");
            //tell db it's parameters and datatypes
            $stmt->bind_param("sd", $fname, $telephone);
            
            //align field data into a variable
            $fname = $_POST['_name'];
            $telephone = $_POST['_number'];
            //execute instruction and save to db
            $stmt->execute();

            echo "submission is saved";

            //close db connections
            $stmt->close();
            $conn->close();
            
        }else {
            echo "Submission was not saved";
    }
?>
    <h1>COVID-19 Retracement</h1>
    <!--Send data to DB-->
    <form method="POST" action="index.php" id="resetForm" class="text-justify">
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
            <button type="submit" name="submit" id="btn" class="btn btn-success font-weight-bold" onclick='Submit()'>Submit</button>
            <button type="button" id="btnClear" class="btn btn-danger font-weight-bold" onclick="Clear()">Clear</button>
        </div>            
    </form>
</body>
</html>