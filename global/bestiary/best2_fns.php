////////////////////////////////////////////////////////////////////////////////////////////
//
// best2_fns.php - Bestiary functions
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the bestiary database related functions.
//
// Author: int
// Last modified: 03/11/02
// 
// Copyright (C) 2001 ~ 2002 by int
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    vars.php			- file containing environment variables.
//    db_config.php	- database configurations.
//    db_fns.php		- database functions.
//
////////////////////////////////////////////////////////////////////////////////////////////

<?
require_once("/zenosaga.com/httpdocs/global/db_config.php");
require_once("/zenosaga.com/httpdocs/global/db_fns.php");
require_once("/zenosaga.com/httpdocs/global/err_fns.php");

////////////////////////////////////////////////////////////////////////////////////////////
//
// array parse_bestiary_data (int $episode, int $q)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//    This function pulls bestiary information from the MySQL database based on parameters
//    $episode and $q, then returns the final parsed information in HTML as string $replace 
//    directly to the viewer's browser.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $episode - EPISODE number, by default sets it to EPISODE 1
//    $q       - Query range for switch operator:
//
//                  1 = pulls bestiary from A to B
//                  2 = pulls bestiary from C to D
//                  .
//                  .
//                  .
//                  13 = pulls bestiary from Y to Z
//
//               By default, function will pull bestiary from A to B if $q is null
//
// Usage:
//    Call this function from a bestiary page.
//
////////////////////////////////////////////////////////////////////////////////////////////

function parse_bestiary_data($episode="1", $q)
{
	switch ($q)
	{
		case '1':
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'a%' 
			OR name LIKE 'b%' ORDER BY name ASC";
			break;
		
		case 2:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'c%' 
			OR name LIKE 'd%' ORDER BY name ASC";
			break;
		
		case 3:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'e%' 
			OR name LIKE 'f%' ORDER BY name ASC";
			break;
		
		case 4:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'g%' 
			OR name LIKE 'h%' ORDER BY name ASC";
			break;
		
		case 5:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'i%' 
			OR name LIKE 'j%' ORDER BY name ASC";
			break;
		
		case 6:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'k%' 
			OR name LIKE 'l%' ORDER BY name ASC";
			break;
		
		case 7:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'm%' 
			OR name LIKE 'n%' ORDER BY name ASC";
			break;
		
		case 8:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'o%' 
			OR name LIKE 'p%' ORDER BY name ASC";
			break;
		
		case 9:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'q%' 
			OR name LIKE 'r%' ORDER BY name ASC";
			break;
		
		case 10:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 's%' 
			OR name LIKE 't%' ORDER BY name ASC";
			break;
		
		case 11:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'u%' 
			OR name LIKE 'v%' ORDER BY name ASC";
			break;
		
		case 12:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'w%' 
			OR name LIKE 'x%' ORDER BY name ASC";
			break;
		
		case 13:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'y%' 
			OR name LIKE 'z%' ORDER BY name ASC";
			break;
		
		default:
			$query = "SELECT * FROM zenosaga_episode".$episode.".bestiary_en WHERE name LIKE 'a%' 
			OR name LIKE 'b%' ORDER BY name ASC";
			break;
	}

  // opens bestiary template file
  switch ($episode)
  {
    // Xenosaga EPISODE I
    case 1:
      $file = "/zenosaga.com/httpdocs/templates/ep1_bestiary_full.php";
      break;


    // Xenosaga EPISODE II
    case 2:
      $file = "/zenosaga.com/httpdocs/templates/ep2_bestiary_full.php";
      break;

    // Xenogears    
    case 5:
      $file = "/zenosaga.com/httpdocs/templates/xg_bestiary_full.php";
      break;

    // Xenosaga Pied Piper
    case 99:
      $file = "/zenosaga.com/httpdocs/templates/xs_ppied_bestiary_full.php";
      break;
    
    default:
      $file = "/zenosaga.com/httpdocs/templates/ep1_bestiary_full.php";
      break;
  }
    
	db_connect();
	$result = mysql_query($query);

	$fh = fopen($file, "r");
	$template = fread($fh, filesize($file));
	@fclose($fh);

	unset($replace);

  // fetch bestiary information from database and fill object $bestObj with enemy's
  // attributes as elements
	while ($bestObj = @mysql_fetch_object($result))
	{
		if (empty($bestObj->attacks))
		{
			$bestObj->attacks = "Not Available";
		}
		
		$map = array ("%%%name%%%"	=> $bestObj->name,
					  "%%%filename%%%"	  	  => 
					  "<img src=http://www.zenosaga.com/global/gfx/bestiary.php?episode=1&f=1&filename=".
					  $bestObj->filename.">",
					  "%%%hp%%%" 			  => $bestObj->hp,
					  "%%%str%%%" 			  => $bestObj->str,
					  "%%%vit%%%" 			  => $bestObj->vit,
					  "%%%eatk%%%"			  => $bestObj->eatk,
					  "%%%edef%%%"			  => $bestObj->edef,
					  "%%%eva%%%"			  => $bestObj->eva,
					  "%%%dex%%%"			  => $bestObj->dex,
					  "%%%agl%%%"			  => $bestObj->agl,
					  "%%%element%%%"		  => $bestObj->element,
					  "%%%weakness%%%"	 	  => $bestObj->weakness,
					  "%%%area%%%"		  	  => $bestObj->area,
					  "%%%exp%%%"		    	  => $bestObj->exp,
					  "%%%gold%%%"		  	  => $bestObj->money,
					  "%%%tpt%%%" 			  => $bestObj->tpt,
					  "%%%ept%%%"	  	  	  => $bestObj->ept,
					  "%%%spt%%%"		    	  => $bestObj->spt,
					  "%%%item_normal%%%"		  => $bestObj->item_normal,
					  "%%%item_rare%%%"		  => $bestObj->item_rare,
					  "%%%ds%%%"		    	  => $bestObj->ds,
					  "%%%mgroup%%%"		  => parse_groups($bestObj->mgroup),
					  "%%%descript%%%"		  => $bestObj->descript,
					  "%%%type%%%"			  => parse_icons($bestObj->type),
					  "%%%notes%%%"			  => $bestObj->notes,
					  "%%%attacks%%%"		  => parse_attacks($bestObj->attacks));

    // replaces bestiary template with values returned by function
		$replace .= strtr($template, $map);
	}
	
	// return template to browser after mapped elements are replaced with $bestObj 
	// elements
	return $replace;
	
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// int parse_attacks (string $attacks)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Prints an unordered list of the enemy's attacks.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $attacks - "attacks" object element in $bestObj initated by function 
//    parse_bestiary_data ().
//
// Usage:
//    Used in conjuction with function parse_bestiary_data ().
//
////////////////////////////////////////////////////////////////////////////////////////////

function parse_attacks ($attacks)
{
  // separate attacks by semicolons then create and fill array $attack[$i] with attack names 
	$attack = explode(";", $attacks);
	
	$i = 0;
	while ($i < sizeof($attack))
	{
		$attack_list .= '<img src="http://www.zenosaga.com/images/star01.gif"> '.$attack[$i];
		
		if (($i < sizeof($attack)) && (sizeof($attack) != 1))
		{
			$attack_list .= "<br>";
		}

		$i++;
	}
	return $attack_list;
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// int parse_groups (string $groups)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns an unordered list of other enemies this enemy is commonly associated with.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $groups - "mgroup" object element in $bestObj initated by function 
//    parse_bestiary_data ().
//
// Usage:
//    Used in conjuction with function parse_bestiary_data ().
//
////////////////////////////////////////////////////////////////////////////////////////////

function parse_groups($groups)
{
	$group = explode(";", $groups);
	
	$i = 0;
	while ($i < sizeof($group))
	{
		$group_list .= '<img src="http://www.zenosaga.com/images/square01.gif"> '.$group[$i];
		
		if (($i < sizeof($group)) && (sizeof($group) != 1))
		{
			$group_list .= "<br>";
		}

		$i++;
	}
	return $group_list;
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void parse_icons (char $icon)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns string $show with an icon representing the enemy's type: 
//   Biological, Gnosis or A.G.W.S.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $icon - "type" object element in $bestObj initated by function parse_bestiary_data ().
//
// Usage:
//    Used in conjuction with function parse_bestiary_data ().
//
////////////////////////////////////////////////////////////////////////////////////////////

function parse_icons($icon)
{
	switch ($icon)
	{
		case 'b':
			$show = "<img src='http://www.zenosaga.com/ep_01/bestiary/images/ico_b.gif'>";
			break;
		
		case 'g':
			$show = "<img src='http://www.zenosaga.com/ep_01/bestiary/images/ico_g.gif'>";
			break;
		
		case 'm':
			$show = "<img src='http://www.zenosaga.com/ep_01/bestiary/images/ico_agws.gif'>";
			break;
		
		default:
			break;
	}
	return $show;
}

?>
