<?php
    if(isset($_POST['fingerprint']))
    {
        print_r($_POST);

    }
  

?>
<form id="myForm" method="post" action="file.php"> 
    <input type="text" value="rwhaej23jrb" id="fingerprint" name="fingerprint" hidden>
    <button type="submit" hidden id="submitbtn">Submit</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
         
        var validate = function() { 
            $('#submitbtn').click()
        
        }
        validate()
        
    </script>