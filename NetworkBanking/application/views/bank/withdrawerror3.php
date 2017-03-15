<!DOCTYPE html>
<html lang="en">
<head>
  <title>Withdraw</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script language="JavaScript">
    alert("Invalid Amount. Please enter a proper amount!!");
  </script>      
  <style>
.xs-collapse {
  display: none;
}

.xs-toggle .icon-bar {
  display: block;
  width: 22px;
  height: 2px;
  border-radius: 1px;
}
.xs-toggle .icon-bar + .icon-bar {
  margin-top: 4px;
}

.btn-default.xs-toggle .icon-bar {
  background-color: #888;
}

@media (min-width: 769px) {
  .xs-toggle {
    display: none;
    visibility: hidden;
  }
  .xs-collapse {
    display: block;
    visibility: visible;
  }
}
 p{
    text-align: center;
 }


.buttons{
text-decoration:none;
width:50%;
text-align:center;
display:block;
background-color: #000033;
color:#fff;
border:1px solid  #00001a;
padding:10px 0;
font-size:20px;
cursor:pointer;
border-radius:5px;
margin-bottom:20px;
margin-left: 40px
}

.col-sm-8{
  background-image: url(<?php echo base_url()?>/media/images/backimg.jpg); position: relative;
    background-repeat:no-repeat;
    background-size:100% 100vh;
   position: relative;
  
}
.inputs{
width:82%;
padding:10px;
border:1px solid #ccc;
padding-left:40px;
font-size:16px;
font-family:raleway;
width:100%;
margin-bottom: 20px
}
  

  </style>
</head>
<body>

   
    <nav class="navbar navbar-inverse" style="margin-bottom: 0px">
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
    <!--   <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url()?>/Bank/homepage">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Contact</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
      
        <li>
        <!-- <button id="lpopup"  onclick="div_show()"><span class="glyphicon glyphicon-log-in"></span> Login</button> -->
        <a href="<?php echo base_url()?>/Bank/homepage" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
      </ul>
    </div>
  </div>
</nav>



    <div class="row" style="margin-right: 0px">
    <div class="col-sm-4" style=" height:745px ;width:20%; background-color:#d9d9d9; padding-right: 0px">
        <button type="button" class="btn btn-default xs-toggle" data-toggle="collapse" data-target="#pills">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
     <ul class="nav nav-pills nav-stacked xs-collapse" id="pills"  style=" background: #d9d9d9;"">
            <li role="presentation"  style=" background: #d9d9d9;font-size: 16px; margin: 5px "><a href="/link.html" style="color: #001a4d" ><label>What do you want to do?</label></a></li>
            <hr style="margin: 0px">
            <li role="presentation"><a href="<?php echo base_url()?>/Bank/user_details">Details</a></li>
            <hr style="margin: 0px">
            <li role="presentation"><a href="<?php echo base_url()?>/Bank/deposit">Deposit</a></li>
            <hr style="margin: 0px">
            <li class="active" role="presentation"><a href="<?php echo base_url()?>/Bank/withdraw">Withdraw</a></li>
            <hr style="margin: 0px">
            <li role="presentation"><a href="<?php echo base_url()?>/Bank/transfer">Transfer</a></li>
            <hr style="margin: 0px">
            <li role="presentation"><a href="<?php echo base_url()?>/Bank/trans_slip">Mini statement</a></li>
            <hr style="margin: 0px">
            <li role="presentation"><a href="<?php echo base_url()?>/Bank/exit1">Exit</a></li>
            <hr style="margin: 0px">
        </ul>
    </div>
    <div class="col-sm-8" style="width: 80%; padding-right: 30px; height: 745px">
    <div class="container" style="margin-left: 400px; margin-top: 100px ;border:1px solid  #00001a; width: 35%; background-color: white; opacity: 0.6">
      <div style="padding: 10px; padding-right: 20px; ">
      <h3>Withdraw your money:</h3>
         <hr style=" height:0; border:0;  border-top:1px solid black;">
      <form name="wdraw_form" method="POST" action="<?php echo base_url()?>Bank/wdraw_auth">
        <label>Enter the amount to withdraw</label>
        <br>
        <input class="inputs" type="number" placeholder="Enter amount" name="amt">
        <div style="padding-left: 19%">
          <input class="buttons" type="submit" value="Withdraw">
        </div>  
      </form> 
    </div>
   </div>
</div>

 
</body>
</html>