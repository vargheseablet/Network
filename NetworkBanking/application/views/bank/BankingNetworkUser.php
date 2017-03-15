<!DOCTYPE html>
<html class="full" lang="en">
<head>
  <title>Network Banking</title>
  <meta charset="utf-8">
  <meta http-equip="X-UA-Compatable" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="<?php echo base_url()?>/media/css/login.css" rel="stylesheet">
  <script src="<?php echo base_url()?>/media/js/my_js.js"></script>


  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url()?>/Bank/bank_user">Home</a></li>
        <!-- <li><a href="#">About</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Contact</a></li> -->
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
        <?php foreach ($u_n as $info):?>
          <p  style="color:white;margin-right:20px;margin-top: 15px; padding-left: 15px">Welcome, <?php echo $info['user_name']?></p>
        <?php endforeach;?>
        </li>
        
        <li>
        <!-- <button id="lpopup"  onclick="div_show()"><span class="glyphicon glyphicon-log-in"></span> Login</button> -->
        <a href="<?php echo base_url()?>/Bank/homepage" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators" >
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
         <img src="<?php echo base_url()?>/media/images/bannerb.jpg" alt="Image" style="width:100%;
          max-height: 380px !important;">
        
        <div class="carousel-caption" style="background-color: black; opacity: 0.7">
          <h3 >Network Banking!</h3>
          <p>Create multiple accounts and perform basic bank transactions on one click!</p>
        </div>      
      </div>

      <div class="item">
       
        <img src="<?php echo base_url()?>/media/images/bannera.jpg" alt="Image" style="width:100%;
          max-height: 380px !important;">
        <div class="carousel-caption" style="background-color: black; opacity: 0.7">
          
          <h3>Facilities!</h3>
          <p>-Withdraw! -Deposit! -Transfer!</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>Click on one of the Bank(s) to get started!</h3><br>

  <div class="row" style="padding-left: 20%">
  <?php foreach ($u_b as $bk):?>
    <div class="col-sm-4">
      <a href="<?php echo base_url()?>/Bank/menupg_<?php echo $bk?>"><img src="<?php echo base_url()?>/media/images/bank1.png" class="img-responsive" style="height: 175px; padding-left: 91px" alt="Image">
      <p style="padding-left: 30%; padding-top: 3%"><?php echo $bk?> Bank</p>
      </a>
    </div>
    <!-- <div class="col-sm-4"> 
      <a href="<?php echo base_url()?>/Bank/menupg"><img src="<?php echo base_url()?>/media/images/bank1.png" class="img-responsive" style="height: 175px; padding-left: 91px" alt="Image">
      <p style="padding-left: 30%; padding-top: 3%">Federel Bank</p></a>
    </div> -->
  <?php endforeach;?>  
  </div>
</div><br>


<!-- <footer class="container-fluid text-center">
  <p></p>
</footer> -->

</body>
</html>
