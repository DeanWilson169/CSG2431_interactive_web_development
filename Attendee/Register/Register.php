<!DOCTYPE html>
<html>
<head>
  <title>Attendee Registration Page</title>
  <?php include('../../Database/DBConnection.php') ?>
  <link rel="stylesheet" href="../.././style.css">
  <script>
	  function validateRegistration()
	  {
		start = document.AttendeeReg
		
		let phone = start.mobile_phone.value;
		let pattern = phone.match(/^\+[\d]{2}\s[\d]{3}\s[\d]{3}\s[\d]{3}$/);
		
		today = new Date();
		dd = String(today.getDate()).padStart(2, '0');
		mm = String(today.getMonth() + 1).padStart(2, '0');
		yyyy = today.getFullYear();
		today = yyyy + '-' + mm + '-' + dd;
		
		if (start.firstname.value == '')
		{
			alert('No first name has been entered');
			start.firstname.focus();
			return false;
		}
		else if (start.surname.value == '')
		{
			alert('No surname has been entered');
			start.surname.focus();
			return false;
		}
		else if (start.mobile_phone.value == '')
		{
			alert('No mobile phone has been entered');
			start.mobile_phone.focus();
			return false;
		}
		else if (!pattern)
		{
			alert('An invalid mobile phone has been entered');
			start.mobile_phone.focus();
			return false;
		}
		else if (start.DOB.value == '')
		{
			alert('No date of birth has been selected');
			start.DOB.focus();
			return false;
		}
		else if (start.DOB.value >= today)
		{
			alert('Invalid date of birth has been selected');
			start.DOB.focus();
			return false;
		}
		else if (start.password.value == '')
		{
			alert('No password has been entered');
			start.password.focus();
			return false;
		}
		else if (start.password.value.length < 5)
		{
			alert('Invalid password has been entered: must be at least 5 characters');
			start.password.focus();
			return false;
		}
		else if (start.confirmPassword.value == '')
		{
			alert('No confirm password has been entered');
			start.confirmPassword.focus();
			return false;
		}
		else if (start.password.value != start.confirmPassword.value)
		{
			alert('Confirm password does not match password');
			start.password.focus();
			return false;
		}
	  }
  </script>
</head>

<body class="body">
	<div class="AttendeeBox">
<h2><strong>New User Details</strong></h2>
<form name="AttendeeReg" method="post" action="CreateUser.php" onsubmit="return validateRegistration();">
  <table class="registerForm" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><h3>Personal Details</h3></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>First Name</td>
      <td> 
        <input name="firstname" type="text" style="width: 200px;" maxlength="100" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Surname</td>
      <td> 
        <input name="surname" type="text" style="width: 200px;" maxlength="100" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Mobile</td>
      <td> 
        <input name="mobile_phone" type="text" style="width: 200px;" maxlength="15" placeholder="+00 000 000 000" /></td>
    </tr>
	<tr style="background-color: #FFFFFF;"> 
      <td>Date of Birth</td>
      <td> 
        <input name="DOB" type="date" style="width: 200px;" max="<?php echo date("Y-m-d"); ?>" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <input name="password" type="password" style="width: 200px;" maxlength="20" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
  <div class="center">
  	<input type="reset" name="reset" value="Reset" />
	<input type="submit" name="submit" value="Submit" />
  </div>
  <div style="text-align:center;">
  Return to the login page <a href="../../Login/Login.php">here</a>.
  </div>
</form>
</div>
</body>
</html>
