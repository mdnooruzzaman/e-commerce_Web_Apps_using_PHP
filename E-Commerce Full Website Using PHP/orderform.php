<?php include ( "inc/connect.inc.php" ); ?>
<?php 

if (isset($_REQUEST['poid'])) {
	
	$poid = mysqli_real_escape_string($con ,$_REQUEST['poid']);
}else {
	header('location: index.php');
}

ob_start();
session_start();


$getposts = mysqli_query($con ,"SELECT * FROM products WHERE id ='$poid'") ;
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						
						$available =$row['available'];
					}	
$email = "";
$ufname = "";
$mbl = "";
$addr = "";
$pn = "";
$quan = "";

//order

if (isset($_POST['order'])) {
//declere veriable
$email = $_POST['email'];
$ufname = $_POST['fullname'];
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$pn = $_POST['pname'];
$quan = $_POST['quantity'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['quantity'])) {
			throw new Exception('quantity can not be empty');
			
		}

		$res = mysqli_query($con , "INSERT INTO orders(email,full_name,mobile,oplace,proname,quantity) VALUES ('$_POST[email]','$_POST[fullname]','$_POST[mobile]','$_POST[address]','$_POST[pname]','$_POST[quantity]')");
		$success_message= '<div class="signupform_content"><h2><font face="bookman">your order confirmed</font></h2>';

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>SAREE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.png);">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<!-- <?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>';
						}
					 ?> -->
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<!-- <?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?> -->
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/ebuybdlogo.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="women/saree.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Saree</a>
				</th>
				<th><a href="women/ornament.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Ornament</a></th>
				<th><a href="women/watch.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Watch</a></th>
				<th><a href="women/perfume.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Perfume</a></th>
				<th><a href="women/hijab.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Hijab</a></th>
				<th><a href="women/tshirt.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">T-Shirt</a></th>
				<th><a href="women/footwear.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">FootWear</a></th>
				<th><a href="women/toilatry.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Toilatry</a></th>
			</tr>
		</table>
	</div>
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px;">Order Form</h2>
				<div style="float: right;">
				<?php 
					if(isset($success_message)) {echo $success_message;}
					else {
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form" style="    margin-top: 38px;">
									<div>
										<td>
											<input name="email" id="email-1" required="required"  placeholder="enter your email" class="email signupbox " type="email" size="30" >
										</td>
									</div>
								   <div>
										<td>
											<input name="fullname" placeholder="enter your full name" required="required" class="fullname signupbox" type="text" size="30" >
										</td>
									</div>
									<div>
										<td>
											<input name="mobile"  required="required"  placeholder="Mobile number" class="mobile signupbox " type="text" size="30" >
										</td>
									</div>
									<div>
										<td>
											<input name="address"  required="required"  placeholder="Write your full address" class="address signupbox " type="text" size="30" >
										</td>
									</div>
									<div>
										<td>
											<input name="pname"  required="required"  placeholder="product name" class="product signupbox " type="text" size="30" >
										</td>
									</div>

									<div>
										<td>
											<input name="quantity"  required="required"  placeholder="Quantity" class="quantity signupbox " type="text" size="30" >
										</td>
									</div>
									
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
									</div>
									
								</div>
							</form>
							
						</div>
					</div>

					';

					}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left; font-size: 23px;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img">
									<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
								
									<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: Rs <span id="amountText">'.$price.'</span>  <span id="aHiddenText" style="display:none">'.$price.'</span></div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
	<script type="text/javascript">
	function changeAmount() {
	    var v = document.getElementById("aHiddenText").innerHTML;
	    document.getElementById("amountText").innerHTML = v;
	    var sBox = document.getElementById("productAmount");
    	var y = sBox.value;
	    var x = document.getElementById("amountText").innerHTML;
	    var y = parseInt(y);
	    var x = parseInt(x);
	    document.getElementById("amountText").innerHTML = x+"x"+y+ " = " + x*y;
	}
	</script>
</body>
</html>
