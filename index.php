<?php 
//Connects to your Database 
 mysql_connect("mysql6.000webhost.com", "a3290377_Project", "gmw659315") or die(mysql_error()); 
 mysql_select_db("a3290377_Project") or die(mysql_error()); 


 //This code runs if the form has been submitted

 if (isset($_POST['submit'])) { 



 //This makes sure they did not leave any fields blank

 if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {

 		die('You did not complete all of the required fields');

 	}



 // checks if the username is in use

 	if (!get_magic_quotes_gpc()) {

 		$_POST['username'] = addslashes($_POST['username']);

 	}

 $usercheck = $_POST['username'];

 $check = mysql_query("SELECT username FROM users WHERE username = '$usercheck'") 

or die(mysql_error());

 $check2 = mysql_num_rows($check);



 //if the name exists it gives an error

 if ($check2 != 0) {

 		die('Sorry, the username '.$_POST['username'].' is already in use.');

 				}


 // this makes sure both passwords entered match

 	if ($_POST['pass'] != $_POST['pass2']) {

 		die('Your passwords did not match. ');

 	}



 	// here we encrypt the password and add slashes if needed

 	$_POST['pass'] = md5($_POST['pass']);

 	if (!get_magic_quotes_gpc()) {

 		$_POST['pass'] = addslashes($_POST['pass']);

 		$_POST['username'] = addslashes($_POST['username']);

 			}



 // now we insert it into the database

 	$insert = "INSERT INTO users (username, password)

 			VALUES ('".$_POST['username']."', '".$_POST['pass']."')";

 	$add_member = mysql_query($insert);

 	?>

 <h1>Registered</h1>

 <p>Thank you, you have registered - you may now <a href="/login.php">login</a>.</p>

 <?php 
 } 

 else 
 {	
 ?>

<head>

<link rel='stylesheet' href='css/style2.css'>

<link rel='icon' type='image/png' href='logo2-20140405-favicon.ico'/>

</head>


<body background='blue.jpg'>
 
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<img alt='logo' src='flip.png' height='150px' width='150px' align='left' />
<img alt='logo' src='trainLogo.png' height='150px' width='150px' align="right" />


<center><font face="Verdana" size="7" color="white">Welcome To On Time Travel</font></center><br /><br /><br /><br /><br />

<section class="container">
    <div class="login">
 <center><table border="0">

<h1>Register</h1>

 
 <input type="text" name="username" maxlength="60" placeholder="Username">

 



 <input type="password" name="pass" maxlength="10" placeholder="Password">

 

 

 <input type="password" name="pass2" maxlength="10" placeholder="Confirm Password">

<br /><br />

 <tr><th colspan=2><input type="submit" name="submit" 
value="Register"></th></tr> </table></center></div></section>



 </form>

<center><p>If registered - you may now <a href="/login.php">login here</a>.</p></center>


</body>

 <?php

 }
 ?> 
