<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// db_fns.php - Database connectivity and manipulations
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the database connectivity and manipulation
// functions.
//
// Author: int
// Last modified: 03/11/02
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    db_config.php		- include file containing global database login information
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/db_config.php");

////////////////////////////////////////////////////////////////////////////////////////////
//
// int db_connect (string $database)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   MySQL connection instance
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $database - name of database to connect to and use
//
// Usage:
//    This functions connect to $database database with the
//    login information specified within the db_config.php
//    database configuration file.
//
////////////////////////////////////////////////////////////////////////////////////////////

function db_connect($database = "zenosaga_zenosaga")
{
	$result = @mysql_connect(db_server, db_user, db_pass);
	if (!$result)
		return false;

	if (!$result2 = @mysql_select_db($database)) {
		return false;
	} else {
		return $result2;
	}
} //end db_connect();

////////////////////////////////////////////////////////////////////////////////////////////
//
// int update_db (string $username, string $userhash)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   TRUE on success, FALSE on failure
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $username - name of user
//    $userhash - user's unique user-hash
//
// Usage:
//    This function connects to the user database and
//    updates the user's record with his/her last sign-in
//    date and time along with their IP address.
////////////////////////////////////////////////////////////////////////////////////////////

function update_db($username, $userhash="")
{
	if (getenv(REMOTE_ADDR) == "")
		$ip = getenv(REMOTE_HOST);
	else
		$ip = getenv(REMOTE_ADDR);
	
	if(!$conn = db_connect(db_db))
		return false;
		
	if (!@mysql_query("UPDATE ehq_users SET lastvisit = '".time('U')."', ipaddress = '".$ip."'
						WHERE username = '".$username."'"))

			 return false;
		else
			return true;
} //end update_db();

function tbl_object($dbname = "zenosaga_zenosaga", $tablename, $arg1, $arg2)
{
	db_connect($dbname);
	
	$query = "SELECT * FROM $tablename
			  WHERE $arg1 = '$arg2'";
	
	$result = mysql_query($query);

	if ($result)
	{
		$tblObj = mysql_fetch_object($result);
	}

	return $tblObj;

}
?>
