<!DOCTYPE html>
<html>
<head>
  <title>Attendee Registration Page</title>
  <?php include('DBConnection.php') ?>
  <script>
  
  function validateRegistration()
  {
	start = document.AttendeeReg
	let phone = start.mobile_phone.value
	let pattern = phone.match(/^\+[\d]{2}\s[\d]{3}\s[\d]{3}\s[\d]{3}$/);
	
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
	else if (start.password.value == '')
	{
		alert('No password has been entered');
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

<body>
<h2><strong>New User Details</strong></h2>
<form name="AttendeeReg" method="post" action="CreateUser.php" onsubmit="return validateRegistration();">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
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
        <input name="mobile_phone" type="text" style="width: 150px;" maxlength="15" /></td>
    </tr>
	<tr style="background-color: #FFFFFF;"> 
      <td>Date of Birth</td>
      <td> 
        <input name="DOB" type="date" style="width: 150px;" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <input name="password" type="password" style="width: 100px;" maxlength="20" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <input name="confirmPassword" type="password" style="width: 100px;" maxlength="20" /></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td> 
        <input type="reset" name="reset" value="Reset" />
		<input type="submit" name="submit" value="Submit" />
	  </td>
    </tr>
  </table>
  Return to the login page <a href="Login.php">here</a>.
</form>
</body>
</html>
