<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// member.php - User credential check and session registration
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file checks member's credentials and registers user session
//
// Author: int
// Last modified: 03/11/02
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    include.php   - file containing essential includes
//    db_config.php	- database configurations
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/include.php");
require_once("/zenosaga.com/httpdocs/global/db_config.php");

if ($username && $password)
{
	if (login($username, $password)=="true")
	{
		if(update_db($username, $userhash)) {
			$query = "SELECT * FROM ehq_pref WHERE username = '".$username."'";
            $query2 = "SELECT * FROM ehq_users WHERE username = '".$username."'";

			$result = @mysql_query($query);
            $result2 = @mysql_query($query2);

			$prefcookie = @mysql_fetch_row($result);
            $prefcookie2 = @mysql_fetch_row($result2);

			@setcookie("username", "$username", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("userhash", crypt($username, "ZS")."-".crypt($password, "ZS"), time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("stature", md5($username), time()+31536000, "/", ".zenosaga.com", "0");

// Set personal preference cookies
			@setcookie("lang", "$prefcookie[2]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("toplogo", "$prefcookie[3]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("mainlogo", "$prefcookie[4]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("archivenews", "$prefcookie[5]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("headlines", "$prefcookie[6]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("subsite", "$prefcookie[7]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("images_wt", "$prefcookie[8]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("images_best", "$prefcookie[9]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("color", "$prefcookie[10]", time()+31536000, "/", ".zenosaga.com", "0");
			@setcookie("timezoneoffset", "$prefcookie[11]", time()+31536000, "/", ".zenosaga.com", "0");

   			@setcookie("bbuserid", "$prefcookie2[0]", time()+31536000, "/", ".zenosaga.com", "0");
            @setcookie("bbpassword", md5($prefcookie2[2]), time()+31536000, "/", ".zenosaga.com", "0");

			if (isset($referrer))
            {
                if (eregi("http://", $referrer))
                {
                    header ("Location: $referrer");
                } else {
                    header ("Location: http://www.zenosaga.com".$referrer."");
                }
            } else {
                header("Location: ".URL."?");
            }
			echo "Logged in! Transfering you back to the main page.";
		} else {
			echo "<b>ERROR:</b> Unable to update your account.";
			exit;
		}
	} else {

		$membersonly = new page("Please login or register to use this section.");
		$membersonly->body();
		$membersonly->epchannel();
		$membersonly->topmenu();
		$membersonly->mainlogo();
		$membersonly->subsitemenu(0);
?>
<p>
<?
		echo @standarderror(login($username, $password));

		$membersonly->printfooter();
		$membersonly->printmaps();
		exit;
	} 
} else {
		$membersonly = new page("Please login or register to use this section.");
		$membersonly->body();
		$membersonly->epchannel();
		$membersonly->topmenu();
		$membersonly->mainlogo();
		$membersonly->subsitemenu(0);
?>
<p>
<?
		standarderror("You did not enter a valid user name or your password did not match the supplied username.  Please use your
		browser's BACK button and retry.");
?>
</p>
<?
		$membersonly->printfooter();
		$membersonly->printmaps();
	}
//check_valid_user();
?>
