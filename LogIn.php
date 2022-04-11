	<?=template_header('LogIn')?>
<div class="NavLoginReg">
		<br>

		<div class="formContain center grid">

			<div class="formImgLog">
				<!-- <img src="Images\regImage" width="auto" height="100%"> -->
			</div>

			<div class = "center formContainer2">

				<h1 class="formTitle textCenter">Log-In</h1>

				<div class = "center">

					<form method="POST" class="regForm">
						<h3>Enter Email</h3>
						<input type="text" name="Email" required="required">
						<h3>Enter Password</h3>
						<input type="password" name="Password" required="required">

						<div class="">
							<p>Dont have an Account? <a href="index.php?page=registration">Register Here!</a></p>
						</div>

						<input type="submit" name="submit" class="formBtn" value="Log In">
					</form>

				</div>

			</div>

		</div>

		<?php

			$Email = isset($_POST['Email']) ? $_POST['Email'] : '';
			$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

			$sql = mysqli_connect("localhost", "root", "student", "group_12_db");
			if (mysqli_connect_errno()) {
				printf("connect failed", mysqli_connect_error());
				exit();
			}
			$email = "SELECT Customer_ID,Email,Password FROM customer_management";
			$res = mysqli_query($sql, $email);

			if ($res) {
				while ($newArray = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
					$EMAIL_C = $newArray['Email'];
					$PASSWORD_C = $newArray['Password'];
					$ID = $newArray['Customer_ID'];
					if ($Email === $EMAIL_C && $Password === $PASSWORD_C) {

						$_SESSION['user_Id'] = $ID;
						if (isset($_SESSION['user_Id'])) {

							header("Location:index.php");
						} else {

						}
					}
				}
			}

		?>

	</div>
