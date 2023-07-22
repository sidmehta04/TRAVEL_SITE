<?php
include_once 'admin/include/class.user.php'; 
$user=new User();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    
    
    <style>
          
          .well1{
            /* background: rgba(0, 0, 0, 0.7); */
            border: none;
            height: 150px;
            padding-bottom:10px;
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
                    <li class="active"><a href="room.php">Room &amp; Facilities</a></li>
                    <li><a href="reservation.php">Online Reservation</a></li>
                    <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="images/facebook.png"></a></li>
                    <li><a href="http://www.twitter.com"><img src="images/twitter.png"></a></li>                    
                </ul>
            </div>
        </nav>
        
        
        
        <?php
        
        $sql="SELECT * FROM room_category where available >=1";
        $result = mysqli_query($user->db, $sql);
        if($result)
        {
            if(mysqli_num_rows($result) > 0)
            {
//               ********************************************** Show Room Category***********************
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
                            </div>
                            
                            
                        
                    
                         "; //echo end
                    
                    
                }
                
                
                          
            }
            else
            {
                echo "NO Data Exist";
            }
        }
        else
        {
            echo "Cannot connect to server".$result;
        }
        
        
        
        
        
        ?>


    </div>
    
    
    
    
    





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>