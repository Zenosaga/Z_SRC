<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// activate.php - Registration activation module
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This module activates a user's registration upon runtime -- if the user's creditentials
// exists and matches up with the record stored in the MySQL user database.  If 
// creditential matches, account will be activated and a webmail account will be created
// for the user.
//
// Author: int
// Last modified: 03/11/02
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    db_fns.php	- file required to perform database functions
//
////////////////////////////////////////////////////////////////////////////////////////////

@require_once("/zenosaga.com/httpdocs/global/db_fns.php");

if ($act == "Reg") {
	if (isset($id) || (isset($Submit))) {
		if (!db_connect("zenosaga_zenosaga")) {
			$errormessage = new page("Error interacting with the database.");
			$errormessage->body();
			$errormessage->epchannel();
			$errormessage->topmenu();
			$errormessage->mainlogo();
			$errormessage->subsitemenu(0);
			echo "<br>";
			standarderror("Unable to activate your account at this time.  Please try again later.");
			$errormessage->printfooter();
			$errormessage->printmaps();
			exit;
		} else {
			$query = "SELECT * FROM ehq_users
					  WHERE userhash = '".addslashes(htmlspecialchars(trim($id)))."'";

			$result  = @mysql_query($query);
			$result_array = @mysql_fetch_array($result);

			if ($result_array['confirm'] == "1") {
				$errormessage = new page("Account has already been activated!");
				$errormessage->body();
				$errormessage->epchannel();
				$errormessage->topmenu();
				$errormessage->mainlogo();
				$errormessage->subsitemenu(0);
				echo "<br>";
				standarderror("Our record shows that this account has already been activated.  Thanks
							   for registering with Zenosaga.com!");
				$errormessage->printfooter();
				$errormessage->printmaps();
				exit;
			} else if (@mysql_num_rows($result) > 0) {
				$query = "UPDATE ehq_users
						  SET confirm = 1
						  WHERE userhash ='".addslashes(htmlspecialchars(trim($id)))."'";

				if ($result = @mysql_query($query)) {

                        $result_array = @mysql_fetch_array($result);

						$errormessage = new page("Registration confirmed!");
						$errormessage->body();
						$errormessage->epchannel();
						$errormessage->topmenu();
						$errormessage->mainlogo();
						$errormessage->subsitemenu(0);
      
                        echo $result_array['username'].$result_array['password'];

            // creates a webmail account for user,
						// 08-19-03 :: this feature has been voided since the following routine does not work with Plesk

						echo "<br>";
						standarderror("Your account has been activated.  Please <a href='http://www.zenosaga.com/global/login.php'>login</a> now.
									         Thank you for registering with Zenosaga.com!");
						$errormessage->printfooter();
						$errormessage->printmaps();
						exit;
				}
			} else if (@mysql_num_rows($result) == "0") {
				$errormessage = new page("Unable to locate your user name.");
				$errormessage->body();
				$errormessage->epchannel();
				$errormessage->topmenu();
				$errormessage->mainlogo();
				$errormessage->subsitemenu(0);
				echo "<br>";
				standarderror("Unable to activate your account because supplied unique ID was not found in the user database.");
				$errormessage->printfooter();
				$errormessage->printmaps();
				exit;
			} else {
				$errormessage = new page("Error interacting with the database.");
				$errormessage->body();
				$errormessage->epchannel();
				$errormessage->topmenu();
				$errormessage->mainlogo();
				$errormessage->subsitemenu(0);
				echo "<br>";
				standarderror("Unable to activate your account at this time.  Please try again later.");
				$errormessage->printfooter();
				$errormessage->printmaps();
				exit;
			}

		} // End database query block
	} // End isset($id) block

// If act=Reg is set, do the following
	$errormessage = new page("Confirm your registration.");
	$errormessage->body();
	$errormessage->epchannel();
	$errormessage->topmenu();
	$errormessage->mainlogo();
	$errormessage->subsitemenu(0);
	echo "<br>";
	standarderror('
<div align=center>
<form method=post action=/activate.php?act=Reg>
<table width="400" border="0" cellspacing="0" cellpadding="0">

<tr>
<td colspan=2>
<span class=defaulttext>
To activate your account, copy and paste or carefully type your 26 digit Unique Code provided in the 
confirmation e-mail sent to you by our Support Department.  Click Activate to activate your account.
</span>
</td>
</tr>

<tr>
<td>
<span class=siteupdate3>
&nbsp;
</span>
</td>
</tr>

<!--
<tr> 
<td width="137">
<span class=pastheadline>
E-mail Address
</span>
</td>

<td width="363"> 
<input type="text" name="email" size="35" maxlength="27" class=newsletter value="myEmail@myISP.com" onfocus=\'doClear(this)\'>
</td>
</tr>
-->

<tr> 

<td width="137">
<span class=pastheadline>
Unique Code
</span>
</td>

<td width="363"> 
<input type="text" name="id" maxlength="27" size="35" value="XXXXXXXXXXXXX-XXXXXXXXXXXXX" class=newsletter onfocus=\'doClear(this)\'>
</td>
</tr>

<tr>
<td width="137">
<span class=defaulttext>
&nbsp;
</span>
</td>

<td width="363">
<span class=defaulttext>
&nbsp;
</span>
</td>
</tr>

<tr> 
<td width="137">
<span class=defaulttext>
&nbsp;
</span>
</td>

<td width="363">
<input type="submit" name="Submit" value="Activate!" class=newsletter>
</td>
</tr>
</table>
</form>
</div>
	');
	$errormessage->printfooter();
	$errormessage->printmaps();
	exit;

} // End act=Reg block
	$errormessage = new page("Error interacting with the database.");
	$errormessage->body();
	$errormessage->epchannel();
	$errormessage->topmenu();
	$errormessage->mainlogo();
	$errormessage->subsitemenu(0);
	echo "<br>";
	standarderror("Unable to activate your account at this time.  Please try again later.");
	$errormessage->printfooter();
	$errormessage->printmaps();
?>
