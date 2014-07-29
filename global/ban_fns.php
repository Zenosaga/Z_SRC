<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// ban_fns.php - IP / Host matching and banning functions
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the ip and host banning related functions.
//
// Author: Steve Khou
// Last modified: 07/17/02
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//		vars.php		- file containing environment variables
//		db_fns.php		- database functions
//		db_config.php	- database configuration file
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/vars.php");
require_once("/zenosaga.com/httpdocs/global/db_config.php");
require_once("/zenosaga.com/httpdocs/global/db_fns.php");

////////////////////////////////////////////////////////////////////////////////////////////
//
// int check_banned_host (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns true if banned host exists in database, otherwise returns false
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This function takes the viewer's host name via global $REMOTE_HOST variable and
//	    compares the last two values in the banned host table.  If a match is found, the
//	    functions return TRUE, otherwise it returns FALSE.
//
////////////////////////////////////////////////////////////////////////////////////////////

function check_banned_host()
{
	global $REMOTE_HOST;

	$host_array = explode(".", $REMOTE_HOST);
	$host_final = $host_array[sizeof($host_array) - 2].".".$host_array[sizeof($host_array) - 1];
	
	db_connect();
	
	$query = "SELECT hostname
			  FROM ehq_ban_host
			  WHERE hostname REGEXP '$host_final+'";
//			  WHERE hostname REGEXP '^[".$host_final[sizeof($host_array) - 3]."]*\.$'";
//			  WHERE hostname LIKE '%$host_final'";

	if ($result = mysql_query($query))
	{
		$numrows = mysql_num_rows($result);
		if ($numrows >  0)
		{
			return true;
		} else {
			return false;
		}
		return false;
	}
	
	if (eregi("(anon*|unknown*)", $REMOTE_HOST))
	{
		return true;
	}
	return false;
} //end check_banned_host();

////////////////////////////////////////////////////////////////////////////////////////////
//
// bool check_banned_ip (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//		Returns true if banned IP exists in database, otherwise returns false
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//		Not available
//
// Usage:
//		This function takes the viewer's IP name via global $REMOTE_HOST variable and
//		compares the last two values in the banned host table.  If a match is found, the
//		functions return TRUE, otherwise it returns FALSE.
//
////////////////////////////////////////////////////////////////////////////////////////////

function check_banned_ip()
{
	global $REMOTE_ADDR;
	
	$ip_array = explode(".", $REMOTE_ADDR);
	$ip_final2 = $ip_array[0].".".$ip_array[1].".".$ip_array[2];
	
	db_connect();
	
	$query = "SELECT ipaddress
			  FROM ehq_ban_ip
			  WHERE ipaddress like '$ip_final2%'";
	
	if ($result = mysql_query($query))
	{
		$numrows = mysql_num_rows($result);
		if ($numrows >  0)
		{
			return true;
		} else {
			return false;
		}
	}
	
	return false;
} //end check_banned_ip();

////////////////////////////////////////////////////////////////////////////////////////////
//
// bool check_proxied (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns true if hiding behind proxy, otherwise returns false
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This function checks the viewer's host name via global $REMOTE_HOST variable and
//	  see if a value exists for that variable.  If reverse look up of the IP yields no
//    results, then the user is behind a proxy server, and the function returns TRUE.
//
////////////////////////////////////////////////////////////////////////////////////////////

function check_proxied()
{
	global $REMOTE_ADDR;
	$host = gethostbyaddr($REMOTE_ADDR);
	
	if ((empty($host)) || (eregi("unknown", $host)) || (eregi("proxy", $host)))
	{
		return true;
	}
		return false;
} //end check_proxied();

////////////////////////////////////////////////////////////////////////////////////////////
//
// bool check_bypass($bbuserid, $username)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns true if user is included in the ban bypass database, that is, if the user is connected
//   from a banned hostname or IP subnet, if s/he exists in the ban bypass database, return true
//   else return false.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $bbuserid		-	Global user ID
//		$username	-	Username currently logged in
//
// Usage:
//    This function checks the viewer's host name via global $REMOTE_HOST variable and
//	    see if a value exists for that variable.  If reverse look up of the IP yields no
//     results, then the user is behind a proxy server, and the function returns TRUE.
//
////////////////////////////////////////////////////////////////////////////////////////////

function check_bypass($bbuserid, $username)
{
	$query = "SELECT * FROM ehq_users_bypass WHERE userid = $bbuserid";
	$result = @mysql_query($query);
	
	if ($result)
	{
		$num_rows = @mysql_num_rows($result);
		if ($num_rows > 0)
		{
			return true;
		} else {
			return false;
		}
	}
	return true;
} // end check_bypass()

////////////////////////////////////////////////////////////////////////////////////////////
//
// bool check_banned_agent (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns true if user is browsing with an illegal web browser (i.e. WebZIP),
//   else return false.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This function checks the viewer's AGENT variable and determines if it is prohibited or not.
//		If the user's AGENT variable matches with a banned AGENT in the database, the user will
//		walled from browsing.
//
////////////////////////////////////////////////////////////////////////////////////////////

function check_banned_agent()
{
	global $HTTP_USER_AGENT;

	$file = "/zenosaga.com/httpdocs/etc/list_illegal-browsers.php";
	$fh = fopen($file, "r");
	$banned_browsers = fread($fh, filesize($file));
	@fclose($fh);
		
	if (eregi("(".$banned_browsers.")", $HTTP_USER_AGENT))
	{
		return true;
	}
	return false;
} //end check_banned_agent();
?>
