<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// ckie_fns.php - Cookie settings and manipulations
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the cookie and session control related functions.
//
// Author: int
// Last modified: 03/11/02
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    vars.php			- file containing environment variables
//    db_config.php	- database configurations
//    db_fns.php		- database functions
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/vars.php");
require_once("/zenosaga.com/httpdocs/global/db_fns.php");
require_once("/zenosaga.com/httpdocs/global/db_config.php");

////////////////////////////////////////////////////////////////////////////////////////////
//
// int top_logo (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Prints toplogo images
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This function searches the viewer's cookie file for the "toplogo"
//    parameter.  It then takes this value and prints out the corresponding
//    toplogo images from the toplogo directory based on the value.
//
////////////////////////////////////////////////////////////////////////////////////////////

function toplogo()
{
	switch ($GLOBALS['toplogo'])
	{
		case '0':
		case '00':
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		case '01':
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo/01/toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo/01/toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		case '02':
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo/02/toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
		     	"toplogo/02/toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		case '03':
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
		       "toplogo/03/toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
		     	 "toplogo/03/toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;

   		case '04':
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo/04/toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo/04/toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		default:
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;
	}
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// int epilogo (int $etype)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Prints appropriate EPISODE toplogo
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $etype - EPISODE number
//
// Usage:
//    This functions takes $etype of type int as a parameter and prints out
//    the EPISODE toplogo from its corresonding directory.
//
////////////////////////////////////////////////////////////////////////////////////////////

function epilogo($etype)
{
	switch ($etype)
	{
		case '0':
		case '00':
			echo "<td align=right><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com'><img src='".IMAGE.
			     "toplogo2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		case '1':
		case '01':
			echo "<td align=right><a href='http://www.zenosaga.com/ep_01/?'><img src='".XSIMG.
			     "img-log1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com/ep_01/?'><img src='".XSIMG.
			     "img-log2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		case '2':
		case '02':
			echo "<td align=right><a href='http://www.zenosaga.com/ep_02/?'>
			      <img src='/_imgs-xs2/img-log1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com/ep_02/?'>
			      <img src='/_imgs-xs2/img-log2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		case '5':
		case '05':
			echo "<td align=right><a href='http://www.zenosaga.com/ep_05/?'>
			      <img src='".XGIMG."img-log1.jpg' width='385' height='100' border='0'></a></td>";
			echo "<td align=left><a href='http://www.zenosaga.com/ep_05/?'>
			      <img src='".XGIMG."img-log2.jpg' width='385' height='100' border='0'></a></td>";
			break;

		default:
			toplogo();
			break;
	}
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void zsetcookie (string $cookie, string $value, string $path = "/", 
//                  string $domain = ".zenosaga.com")
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Not available
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $cookie 	- name of cookie variable
//    $value		- value assigned to $cookie
//	  $path		  - path $cookie is applied to; default is "/" for root
//	  $domain	  - domain $cookie is attached to; default .zenosaga.com (note two dots)
//
// Usage:
//    This functions connect to default zenosaga.com database, plugs into the
//    affiliates table and print a short brief summary of affiliated sites.
//
////////////////////////////////////////////////////////////////////////////////////////////

function zsetcookie($cookie, $value, $path = "/", $domain = ".zenosaga.com")
{
	// sets cookie based on function parameter
	setcookie($cookie, $value, time()+31536000, $path, $domain, "0");
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void zunsetcookie ($cookie)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Not available
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $cookie - name of cookie to unset
//
// Usage:
//    This functions takes $cookie as a parameter and clear all values set to it.
//
////////////////////////////////////////////////////////////////////////////////////////////

function zunsetcookie($cookie)
{
	// unsets $cookie
    setcookie($cookie, "", time()+31536000, "/", ".zenosaga.com");
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void zunsetallcookie (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Not available
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This functions unsets *ALL* value associated with the entire .zenosaga.com domain.
//
//    *** USE WITH CAUTION ***
//
//	  A pratical use for this function is to clear out a user's cookie, such as during the
//    logoff process, or for debugging purposes.
//
////////////////////////////////////////////////////////////////////////////////////////////

function zunsetallcookie()
{
   	@setcookie("username", "", time()+31536000, "/", ".zenosaga.com", "0");
  	@setcookie("userhash", "", time()+31536000, "/", ".zenosaga.com", "0");	// Unique userhash

// Set personal preference cookies
	  @setcookie("lang", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("toplogo", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("mainlogo", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("archivenews", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("headlines", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("subsite", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("images_wt", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("images_best", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("color", "", time()+31536000, "/", ".zenosaga.com", "0");
	  @setcookie("timezoneoffset", "", time()+31536000, "/", ".zenosaga.com", "0");
    @setcookie("bbstyleid", "", time()+31536000, "/", ".zenosaga.com", "0");
    @setcookie("bbuserid", "", time()+31536000, "/", ".zenosaga.com", "0");
    @setcookie("bbpassword", "", time()+31536000, "/", ".zenosaga.com", "0");
    @setcookie("sessionhash", "", time()+31536000, "/", ".zenosaga.com", "0");
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// string get_lang (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Checks viewer's cookie and returns fr, eg, or sp based on $lang cookie value
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This functions searches through the viewer's cookie for $lang and returns the value
//	  specified in this field.  Value is two characters in length and corresponds to a 
//    language (directory).
//
////////////////////////////////////////////////////////////////////////////////////////////

function get_lang()
{
	switch($GLOBALS['lang'])
	{
		case 'fr':
			return "fr";
			break;
			
		case 'sp':
			return "sp";
			break;
			
		default:
			return "en";
			break;
	}
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// string insert_session (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns true if it successful, else false
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This functions inserts a new session into the session table.
//
////////////////////////////////////////////////////////////////////////////////////////////

function insert_session($sessionhashed, $bbuserid, $REMOTE_ADDR, $HTTP_USER_AGENT, $now)
{
	$server_array = @explode(".", $GLOBALS['SERVER_NAME']);
	$server_name = $server_array[0];
	
	$hostname = @gethostbyaddr(getenv("REMOTE_ADDR"));
	$referrer = @getenv("HTTP_REFERER");
	
	if ($bbuserid == "0")
	{
		db_connect(db_db);
		$result  = mysql_query("DELETE FROM ehq_session 
		                        WHERE userid = 0 
		                        AND useragent = '$HTTP_USER_AGENT'");
		
		$result2 = mysql_query("INSERT INTO ehq_session (sessionhash, userid, username, host, useragent, 
		                                                 hostname, lastactivity, 
		                                                 server, location, referrer) 
		                        VALUES ('$sessionhashed', '0', '', '$REMOTE_ADDR', '$HTTP_USER_AGENT', 
		                                '$hostname', '$now', '$server_name', '$GLOBALS[REQUEST_URI]', 
		                                '$referrer')");
	} else {
		db_connect(db_db);
		$result  = mysql_query("DELETE FROM ehq_session 
		                        WHERE userid = '$bbuserid'");
		
		$result2 = mysql_query("INSERT INTO ehq_session (sessionhash, userid, username, host, useragent, 
		                                                 hostname, lastactivity, server, location, 
		                                                 referrer) 
		                        VALUES ('$sessionhashed', '$bbuserid', '$GLOBALS[username]', '$REMOTE_ADDR', 
		                                '$HTTP_USER_AGENT', '$hostname', '$now', '$server_name', 
		                                '$GLOBALS[REQUEST_URI]', '$referrer')");
	}
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// int loggedin_users (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns total number of currently logged-in users viewing the site
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not available
//
// Usage:
//    This functions returns total number of logged-in users upon call.
//
////////////////////////////////////////////////////////////////////////////////////////////

function loggedin_users()
{

	$now = time()-300;
	$datecut = time()-600;

	$delete  = mysql_query("DELETE FROM zenosaga_zenosaga.ehq_session 
	                        WHERE lastactivity < $datecut");	

	$query = "SELECT *
			      FROM zenosaga_zenosaga.ehq_session";
		  
	$query2 = "SELECT *
			       FROM zenosaga_vbulletin.session
			       WHERE lastactivity > ($now+150)";	

	$result = @mysql_query($query);
	$result2 = @mysql_query($query2);
	
	$totalcount = @mysql_num_rows($result);
	$totalcount2 = @mysql_num_rows($result2);
	
	return ($totalcount + $totalcount2);
	
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// int update_maxusers ($logged)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns total number of viewers
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $logged   -   Current number of viewers
//
// Usage:
//    This functions records and updates the maximum number of viewers if $logged is greated
//    than existing record.
//
////////////////////////////////////////////////////////////////////////////////////////////

function update_maxusers($logged)
{
	$date_max = date('Y-m-d');

	$query = "SELECT *
			  FROM zenosaga_zenosaga.ehq_maxusers
			  WHERE maxID = '1'";
	
	$result = @mysql_query($query);
	
	$max_user = @mysql_fetch_object($result);
	
	if ($logged >= $max_user->users)
	{
		@mysql_query("UPDATE zenosaga_zenosaga.ehq_maxusers 
		              SET date = '$date_max',users = '$logged', 
		              WHERE maxID = '1'");
	}
	
	return $max_user;
} 
?>
