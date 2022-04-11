		<?=template_header('LogIn')?>

<Div class="NavLoginReg">

	<br>

	<div class="formContain center grid">

		<div class="formImgReg	">
			<!-- <img src="Images\regImage" width="auto" height="100%"> -->
		</div>



		<div class = "center formContainer2">

			<h1 class="formTitle textCenter">Create An Account</h1>
			<p class="formP">Create an account and gain access to Roald Dahl's greatest books today!</p>

			<br>

			<form action="logIn.php" method="POST" class="regForm center">

				<h3>Enter email</h3>
				<input type="text" name="Email" required>

				<div class="formGrid">
					<div>
						<h3>Enter Password</h3>
						<input type="password" name="password" required>
					</div>
					<div>
						<h3>Confirm Password</h3>
						<input type="password" name="Password_Confirm" required>
					</div>
				</div>


				<div class="formGrid">
					<div>
						<h3>First Name</h3>
						<input type="text" name="Fname" required>
					</div>
					<div>
						<h3>Surname</h3>
						<input type="text" name="Lname" required>
					</div>
				</div>

				<h3>Phone Number</h3>
				<input type="number" name="ph1" required>
				<!-- <h3>Second Phone Number</h3>
				<input type="number" name="ph2" value="null">
				<h3>Third Phone Number</h3>
				<input type="number" name="ph3" value="null"> -->
				<h3>Address</h3>
				<input type="text" name="Address" required>
				<h3>Postcode</h3>
				<input type="text" name="Postcode" required>

				<input type="submit" name="submit" class="formBtn" value="Register Account">
			</form>
		</div>

	</div>

	<?php
	error_reporting (E_ALL ^ E_NOTICE);


	$sql = mysqli_connect("localhost", "root", "student", "group_12_db");

	function validate_email($email_address)
	{
	if(preg_match("/^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/",
	$email_address)){
	return true;}
	return false;
	}
	// Regex provided by UK Government https://webarchive.nationalarchives.gov.uk/ukgwa/+/http://www.cabinetoffice.gov.uk/media/291370/bs7666-v2-0-xsd-PostCodeType.htm
	function validate_postcode($postcode) {
		if(preg_match("/^[A-Z]{1,2}[0-9R][0-9A-Z]? [0-9][A-Z]{2}/", $postcode)) {
				return true;
		}
		return false;
		echo "Postcode is Incorrect";
	}

	function validate_password($password) {
		if(preg_match("/^[A-Z{1}a-z0-9{1}]{6}/", $password)) {
			return true;
		}
		return false;
	}

	function validate_phone($phoneNumber) {
		if(preg_match("/^[0-9]{11}/", $phoneNumber)) {
			return true;
		}
		return false;
	}

	function validate_name($name) {
		if(preg_match("/^[a-zA-z]/", $name)) {
			return true;
		}
		return false;
	}

	function validate_address($address) {
		if(preg_match("/^[0-9\s]{1,3}[A-Za-z\s]/", $address)) {
			return true;
		}
		return false;
	}

	$phone2V = "";
	$phone3V = "";

	$emailV = isset($_POST["Email"]) ?$_POST["Email"] : "";
	$postcodeV = isset($_POST["Postcode"]) ?$_POST["Postcode"] : "";
	$passwordV = isset($_POST["password"]) ?$_POST["password"] : "";
	$passwordC = isset($_POST["Password_Confirm"]) ? $_POST["Password_Confirm"] : "";
	$FnameV = isset($_POST["Fname"]) ? $_POST["Fname"] : "";
	$LnameV = isset($_POST["Lname"]) ? $_POST["Lname"] : "";
	$addressV = isset($_POST["Address"]) ? $_POST["Address"] : "";
	$phone1V = isset($_POST["ph1"]) ? $_POST["ph1"] : "";
	$phone2V = isset($_POST["ph2"]) ? $_POST["ph2"] : "";
	$phone3V = isset($_POST["ph3"]) ? $_POST["ph3"] : "";


	if (mysqli_connect_errno()) {
		printf("connect failed", mysqli_connect_error());
		exit();
	} else {

		$Customer_Details = "INSERT INTO customer (Forename,Surname,Address,Postcode) VALUES ('".$_POST["Fname"]."', '".$_POST["Lname"]."', '".$_POST["Address"]."', '".$_POST["Postcode"]."')";

		$Reg_Details = "INSERT INTO customer_management (Email,Password) VALUES ('".$_POST["Email"]."', '".$_POST["password"]."')";

		//$Phone_Details = "INSERT INTO customer_phone_number (Phone_No_1,Phone_No_2,Phone_No_3) VALUES ('".$_POST["ph1"]."', '".$_POST["ph2"]."', '".$_POST["ph3"]."')";

	if (validate_email($emailV)) {
			if (validate_password($passwordV)) {
				if ($passwordV == $passwordC) {
					if (validate_postcode($postcodeV)) {
						if (validate_name($FnameV)) {
							if (validate_name($LnameV)) {
								if (validate_phone($phone1V)) {
									if (validate_phone($phone2V) || $phone2V == "") {
										if (validate_phone($phone3V) || $phone3V == "") {
											if (validate_address($addressV)) {
												$resCD = mysqli_query($sql, $Customer_Details);
													$res = mysqli_query($sql, $Reg_Details);
												$resPH = mysqli_query($sql, $Phone_Details);
												echo "Your account has been created, please log in.";
											} else {
												echo "Address must start with a number.";
											}
										} else {
											echo "Phone number 3 must be 11 numbers long.";
										}
									} else {
										echo "Phone number 2 must be 11 numbers long..";
									}
								} else {
									echo "Phone number 1 must be 11 numbers long..";
								}
							} else {
								echo "Last name cant include numbers.";
							}
						} else {
							echo "First name cant include numbers.";
						}
					} else {
						echo "Postcode is Incorrect.";
					}
				} else {
					echo "Passwords do not match.";
				}
			} else {
				echo "Passwords must have at least 6 characters, one capital letter and one number.";
			}
	} elseif ($emailV == "") {
		// code...
	} else {
		echo "Email is in incorrect format e.g. name@gmail.com";
	}

	}

	mysqli_close($sql);

	?>

</div>
