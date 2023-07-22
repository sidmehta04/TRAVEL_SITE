<?php
    include_once 'admin/include/class.user.php'; 
    $user = new User(); 

    if(isset($_REQUEST['submit'])) 
    { 
        extract($_REQUEST); 
        $result = $user->check_available($checkin, $checkout, $user->db);
    }

    function check_available($checkin, $checkout, $db) {
        $query = "SELECT * FROM reservations WHERE checkin >= '$checkin' AND checkout <= '$checkout'";
        $result = mysqli_query($db, $query);
        return $result;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
                  dateFormat : 'yy-mm-dd'
                });
  } );
  </script>
    
    
    <style>
       .well1{
            background: azure;
            border: none;
            height: 177px;
          padding-bottom: 10px;
            padding-top: 10px;
        }
        .well {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            height: 310px;
        }
        
        body {
            background-image: url('images/home_bg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
    
        /* h6
        {
            color: navajowhite;
            font-family:  monospace;
        } */
        label
        {
            color:#ffbb2b;
            font-size: 13px;
            font-weight: 100;
        }
        h3{
            color:Blue;
            padding-left:150px;
        }
        
        h4 {
            color: #ffbb2b;
        }
        h5 {
            color: #ffbb2b;
        }
        h6
        {
            color: #ded6d7;
            font-family:  monospace;
        }

    </style>
    
    
</head>

<body>
    <div class="container">
      
      
       <img class="img-responsive" src="images/home_banner.jpg" style="width:100%; height:180px;">      
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="room.php">Room &amp; Facilities</a></li>
                    <li class="active"><a href="reservation.php">Online Reservation</a></li>

                   <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="images/facebook.png"></a></li>
                    <li><a href="http://www.twitter.com"><img src="images/twitter.png"></a></li>                    
                </ul>
            </div>
        </nav>
        
       <div class='row'>
        <div class='col-md-4'></div>
        <div class='col-md-5 well1'>
         <form action="" method="post" name="room_category">
              
                 <div class="form-group">
                    <label for="location">  Location      :</label>&nbsp;&nbsp;
                    <input type="text" name="location">
                </div>

               <div class="form-group">
                    <label for="checkin">Check In :</label>&nbsp;&nbsp;&nbsp;
                    <input type="text" class="datepicker" name="checkin">

                </div>
               
               <div class="form-group">
                    <label for="checkout">Check Out:</label>&nbsp;&nbsp;
                    <input type="text" class="datepicker" name="checkout">
                </div>
                 
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary button" name="submit">Check Availability</button>

            </form>
           </div>
           <div class="col-md-3"></div>
        </div> 
<?php   

if(isset($_REQUEST['submit'])) 
{ 
    extract($_REQUEST); 
    $location = mysqli_real_escape_string($user->db, $location); // Escape location input to prevent SQL injection
    
    $sql = "SELECT * FROM room_category WHERE available >= 1 AND location = '$location'";
    $result = mysqli_query($user->db, $sql);
    if($result !== false && mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            echo "
            <div class='row'>
                <div class='col-md-4'></div>
                <div class='col-md-5 well'>
                <h3>".$row['hotelname']."</h3>
                <hr>
                <h5 >".$row['location']."</h5>
                <h4>".$row['roomname']."</h4>
                <hr>
                <h6>Rooms Available: ".$row['available']."</h6>
                <h6>No of Beds: ".$row['no_bed']." ".$row['bedtype']." bed.</h6>
                <h6>Facilities: ".$row['facility']."</h6>
                <h6>Price: ".$row['price']." Rs/night.</h6>
                </div>
                    <div class='col-md-3'>
                    <a href='./booknow.php?roomname=".$row['roomname']."&location=".$row['location']."&hotelname=".$row['hotelname']."'><button class='btn btn-primary button'>Book Now</button></a>
                    </div>   
                </div>";
        }
    }
    else
    {
        ?>
        <span class="cls" style="background-color:whitesmoke;font-weight:bolder;">        
        <?php
        echo "No rooms available for the selected location.";
        ?>
        </span>
        <?php

    }
}






