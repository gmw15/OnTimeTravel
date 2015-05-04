<?php 
//Connects to your Database 
 mysql_connect("mysql6.000webhost.com", "a3290377_Project", "gmw659315") or die(mysql_error()); 
 mysql_select_db("a3290377_Project") or die(mysql_error()); 

 
 //checks cookies to make sure they are logged in 

 if(isset($_COOKIE['ID_my_site'])) 

 { 

 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error()); 

 	while($info = mysql_fetch_array( $check )) 	 

 		{ 

 

 //if the cookie has the wrong password, they are taken to the login page 

 		if ($pass != $info['password']) 

 			{ 			header("Location: login.php"); 

 			} 


 //otherwise they are shown the admin area	 

 	else 

 			{ 

			
 

 echo " <!doctype html>
<!--[if lt IE 7]> <html class='no-js ie6 oldie' lang='en'> <![endif]-->
<!--[if IE 7]>    <html class='no-js ie7 oldie' lang='en'> <![endif]-->
<!--[if IE 8]>    <html class='no-js ie8 oldie' lang='en'> <![endif]-->
<!--[if gt IE 8]><!--> <html class='no-js' lang='en'> <!--<![endif]-->
<head>

<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true'></script>

    <script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

    </script>

<style>
body {background-image:url('blue.jpg');}
</style>

<link rel='icon' type='image/png' href='logo2-20140405-favicon.ico'/>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>

	<title>On Time Travel</title>
	
	
	<meta name='viewport' content='width=device-width,initial-scale=1'>
	<link rel='stylesheet' href='css/styles.css'>

  <!-- Templates -->
  <script type='text/template' id='station-list-view-template'>
  <div id='station-list-accordion' class='accordion-group'>
  </div>
  </script>

  <script type='text/template' id='train-movement-template'>
  <div class='trainMovementView'>
  <label><strong>Station:</strong> <%- locationFullName %></label>
  <label><strong><%  print(hasArrived ?  'Arrived:' : 'Expected Arrival') %></strong> <%- arrivalTime %></label>
  <label><strong><% print(hasDeparted ?  'Departed:' : 'Expected Departure') %></strong> <%- departureTime %></label>
  </div>
  </script>

  <script data-main='js/main' src='js/lib/require/require.js'></script>
<script type='text/javascript' src='js/jquery-1.4.1.min.js'></script>
  <script type='text/javascript' src='js/custom.js'></script>
</head>
<body>
<br /><br />
<font face='Verdana' size='5' color='white' align='right'><a href=logout.php>Logout</a></font> 

<center><font face='Verdana' size='7' color='white'>On Time Travel</font></center>
<img alt='logo' src='flip.png' height='150px' width='150px' align='left' />
<img alt='logo' src='trainLogo.png' height='150px' width='150px' align='right' /> 


  <div class='container'>

    <div class='masthead'>
      
	  
	  
	  <br />
	  
	  
	<div id='wrapper'>
	<div id='header'>  
      <div id='list1'>
            <ul class='menu'>
              <li class='active'><a href='#station-map-page' data-toggle='tab'>Station Map</a></li>
              <li id='nav-bar-station-list-button'><a href='#station-list-page' data-toggle='tab'>Station List</a></li>
              <li><a href='#trains-page' data-toggle='tab'>Train Map</a></li>
	<li><a href='ChooseDistance.html' class='transition'>Distance</a></li>
              <!--<li><a href='#train-list-page' data-toggle='tab'>Train List</a></li>-->
              </ul>
          </div>
        </div>
      </div>
	</div>
	</div><!-- /.navbar -->
	  
	  
	  <center>
	  <div class='CSS_Table_Example' style='width:600px;height:150px;'>
			<table >
				<tr> 
					<td>
						Dart
					</td>
					<td >
						Surburban
					</td>
					<td>
						Mainline
					</td>
					<td>
						Other
					</td>
				</tr>
				<tr>
					<td >
						<center><img alt='logo' src='green.png' /></center>
					</td>
					<td>
						<center><img alt='logo' src='blue.png' /></center>
					</td>
					<td>
						<center><img alt='logo' src='red.png' /></center>
					</td>
					<td>
						<center><img alt='logo' src='purple.png' /></center>
					</td>
				</tr>
				
			</table>
		</div>
		</center>
    

    <div id='myTabContent' class='tab-content'>

      <div id='station-map-page' class='tab-pane active main-div-surround' style='height: 600px'>
        <div class='row-fluid span12'>
          <div class='train-buttons btn-group offset3 row-fluid' data-toggle='buttons-checkbox'>
            <button type='button' class='btn btn-primary' id='dart-button'>Dart</button>
            <button type='button' class='btn btn-primary' id='suburban-button'>Suburban</button>
            <button type='button' class='btn btn-primary' id='mainline-button'>Mainline</button>
            <button type='button' class='btn btn-primary' id='other-button'>Others</button>
          </div>
        </div>
		

        <div class='main-panel'>
          <div id='map_canvas' class='map_container span8 app' style='float-none'></div>
          <div id='main-panel-sidebar' class='sidebar span3'></div>
        </div>
      </div>

      <div id='station-list-page' class='tab-pane main-div-surround' style='height: 600px'>
        <div id='station-list-container'></div>

      </div>

      <div id='trains-page' class='tab-pane main-div-surround' style='height: 600px'>
        <div class='row-fluid span12'>
          <div class='train-buttons btn-group offset3 row-fluid' data-toggle='buttons-checkbox'>
            <button type='button' class='btn btn-primary' id='trains-dart-button'>Dart</button>
            <button type='button' class='btn btn-primary' id='trains-suburban-button'>Suburban</button>
            <button type='button' class='btn btn-primary' id='trains-mainline-button'>Mainline</button>
            <button type='button' class='btn btn-primary' id='trains-other-button'>Others</button>
          </div>

        </div>

        <div class='main-panel'>
          <div id='trains-map_canvas' class='map_container span8 app' style='float-none'></div>
          <div id='trains-main-panel-sidebar' class='sidebar span3'></div>
        </div>

      </div>

    </div>

  
    
    <div style='clear: both;'></div>
  </div> <!-- /container -->
  
		

 
</body>
</html>

 "; 

 echo ""; 

 			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 
