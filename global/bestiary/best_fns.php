////////////////////////////////////////////////////////////////////////////////////////////
//
// best_fns.php - Bestiary functions written for Xenogears ONLY
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the bestiary database related functions for the Xenogears subpage.
//
// Author: int
// Last modified: 05/04/01
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    db_config.php	- database configurations.
//    db_fns.php	- database functions.
//    err_fns.php	- error handling functions.
//
////////////////////////////////////////////////////////////////////////////////////////////

<?
require_once("/zenosaga.com/httpdocs/global/db_config.php");
require_once("/zenosaga.com/httpdocs/global/db_fns.php");
require_once("/zenosaga.com/httpdocs/global/err_fns.php");

////////////////////////////////////////////////////////////////////////////////////////////
//
// void best_search (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   This function returns no value.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    Not applicable.
//
// Usage:
//    Prints a search table to search for enemies in Xenogears. This is an old function
//    originally created in late 1999 and carried over from the-ethos.org era.
//
////////////////////////////////////////////////////////////////////////////////////////////

function best_search ()
{
?>

<table width="225" align="left" bgcolor="#333333" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" width="50%"><img src="/_imgs-st/_best-c1.gif"></td>
    <td align="right" valign="top" width="50%"><img src="/_imgs-st/_best-c2.gif"></td>
  </tr>
    <tr>
  
    <td colspan="2">
  
  <form action="<? echo $GLOBALS['REQUEST_URI']; ?>" method="post">
    <table width="90%" align="center">
      <tr>
        <td><span class="pastheadline"> Creature's Name: </span> <br>
          <input type="text" name="name" size="25" maxlength="16" class="dropdownb" <? echo "value=".$HTTP_POST_VARS['name']; ?>></td>
      </tr>
      <tr>
        <td><span class="copyright"> &nbsp; </span></td>
      </tr>
      <tr>
        <td><span class="pastheadline"> Continent: </span> <br>
          <select name="continent" class="dropdownb">
            <option value="" selected>All</option>
            <option value="aquvy islands">Aquvy Islands</option>
            <option value="elru">Elru</option>
            <option value="ignas">Ignas</option>
            <option value="terrane">Terrane</option>
            <option value="snowfield">Southern Snowfield</option>
          </select></td>
      </tr>
      <tr>
        <td><span class="copyright"> &nbsp; </span></td>
      </tr>
      <tr>
        <td><span class="pastheadline"> Areas: </span> <br>
          <select name="area" class="dropdownb">
            <option value="" selected>All</option>
            <option value="anima dungeon 1">Anima Dungeon I</option>
            <option value="anima dungeon 1">Anima Dungeon II</option>
            <option value="aveh">Aveh</option>
            <option value="babel tower">Babel Tower</option>
            <option value="blackmoon forest">Blackmoon Forest</option>
            <option value="dazil">Dazil</option>
            <option value="deus">Deus</option>
            <option value="duneman isle">Duneman Isle</option>
            <option value="goliath factory">Goliath Factory</option>
            <option value="ignas gate">Ignas Gate (Gate I)</option>
            <option value="kislev">Kislev</option>
            <option value="light house">Light House</option>
            <option value="mountain path">Mountain Path</option>
            <option value="nisan">Nisan</option>
            <option value="sargasso">Sargasso's Point</option>
            <option value="solaris">Solaris</option>
            <option value="taura">Taura's House</option>
            <option value="zeboim">Zeboim</option>
          </select></td>
      </tr>
      <tr>
        <td><span class="copyright"> &nbsp; </span></td>
      </tr>
      <tr>
        <td><span class="pastheadline"> Battle Type: </span> <br>
          <select name="type" class="dropdownb">
            <option value="" selected>All</option>
            <option value="0">Character</option>
            <option value="1">Gear</option>
          </select></td>
      </tr>
      <tr>
        <td><span class="copyright"> &nbsp; </span></td>
      </tr>
      <tr>
        <td><span class="pastheadline"> Item(s) dropped: </span> <br>
          <input type="text" name="item"  size="25" maxlength="16" class="dropdownb"></td>
      </tr>
      <tr>
        <td><span class="copyright"> &nbsp; </span></td>
      </tr>
      <tr>
        <td><span class="pastheadline"> Sort by: </span>
      <tr>
        <td widht="198"><select name="sort_by" class="dropdownb">
            <option value="exp">Experience Points</option>
            <option value="gold">Gold dropped</option>
            <option value="hp">Hit Points</option>
            <option value="name" selected>Monster's name</option>
          </select>
          &nbsp;
          <select name="order_by" class="dropdownb">
            <option value="asc" selected>ASC</option>
            <option value="desc">DESC</option>
          </select></td>
      </tr>
        </td>
      
        </tr>
      
      <tr>
        <td><span class="copyright"> &nbsp; </span></td>
      </tr>
      <tr>
        <td><span class="pastheadline"> Max results: </span> <br>
          <select name="max_result" class="dropdownb">
            <option value="1">1</option>
            <option value="5" selected>5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="250">Show all</option>
          </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center">
            <input type=IMAGE src="http://www.zenosaga.com/_imgs-st/img_srch.gif" border="0">
          </div></td>
      </tr>
    </table>
  </form>
    </td>
  
    </tr>
  
  <tr>
    <td align="left" valign="bottom" width="50%"><img src="/_imgs-st/_best-c3.gif"></td>
    <td align="right" valign="bottom" width="50%"><img src="/_imgs-st/_best-c4.gif"></td>
  </tr>
</table>
<?
} // END BEST_SEARCH()

////////////////////////////////////////////////////////////////////////////////////////////
//
// array best_2_array (array $result)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns an array containing an enemy's attributes.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $result - The main parameter $result is actually a MySQL search result returned from
//              the function get_bestiary ().
//
// Usage:
//    This function converts the search result from the criteria supplied to function
//    get_bestiary () and then returns an nested array containing the enemy's or enemies' 
//    entire attribute. 
//
////////////////////////////////////////////////////////////////////////////////////////////

function best_2_array($result)
{
	$best_array = array();
	
	for ($count = 0; $row = @mysql_fetch_object($result); $count++)
		$best_array[$count] = $row;
		
	return $best_array;
	
} // END BEST_2_ARRAY

////////////////////////////////////////////////////////////////////////////////////////////
//
// array get_bestiary (string $enemy = "", string $continent = "", string $area = "",
//                     string $type = "", string $item_kw = "", string $sort_by = "name",
//                     string $order_by = "asc", int $max_show = "10")
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Returns result of enemey from search criteria.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $enemy      - Enemy name
//    $continent  - Continent name
//    $area       - Area within continent (e.g. Blackmoon Forest)
//    $type       - Enemy type
//    $sort_by    - Sort alphabetically by Experience Points (exp), Gold Dropped (gold), 
//                  Hit Points (hp) or Name (name).
//    $order_by   - ASC for ascending, DESC for descending.
//    $max_show   - Maximum row to return, i.e. maximum number of enemies to display.
//
// Usage:
//    This function searches for a single enemy in Xenogears base on search criteria input
//    by the viewer. Returns an error page if no results found otherwise returns an array
//    created by function best_2_array () that contains all of an enemy's attributes.
//
////////////////////////////////////////////////////////////////////////////////////////////

function get_bestiary($enemy = "", $continent = "", $area = "", $type = "", $item_kw = "", 
                      $sort_by = "name", $order_by = "asc", $max_show = "10")
{
  // connect to Xenogears bestiary database
	db_connect("zenosaga_episode5");

 	// primitive language switching feature, "en" for english always default
 	switch ($GLOBALS[lang])
	{
		case 'en':
			$lang = "en";
			break;
		
		case 'fr':
			$lang = "fr";
			break;
			
		case 'sp':
			$lang = "sp";
			break;
		case 'jp':
			$lang = "jp";
			break;
		
		default:
			$lang = "en";
			break;
	}
	
	// perform MySQL search base on form input
	$query = "SELECT *
			  FROM bestiary_".$lang."
			  WHERE name LIKE '".addslashes(htmlspecialchars($enemy))."%'
			  AND continent LIKE '".addslashes(htmlspecialchars($continent))."%'
			  AND area LIKE '%".addslashes(htmlspecialchars($area))."%'
			  AND type LIKE '%".addslashes(htmlspecialchars($type))."'
			  AND item LIKE '%".addslashes(htmlspecialchars($item_kw))."%'
			  ORDER BY ".addslashes(htmlspecialchars($sort_by))." ".addslashes(htmlspecialchars($order_by))."			  
			  LIMIT 0, ".addslashes(htmlspecialchars($max_show))."";
	
	$result = @mysql_query($query);

  // error handling code begins
	if ((!$result) || (@mysql_num_rows($result) < 1))
	{

		$bestiary = new page("Search yielded no result", $ep);
		$bestiary->body();
		$bestiary->epchannel();
		$bestiary->topmenu();
		$bestiary->mainlogo();
		$bestiary->subsitemenu(0);
		
		standarderror("Your search yielded no results.  Please
		        revise your search by trying different keywords.");

		$bestiary->printfooter();
		$bestiary->printmaps();
		exit;
	}
	// error handling code ends
	
	$arraid_result = best_2_array($result);
	
	return $arraid_result;
	
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// array display_bestiary (array $best_array)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Prints a list of enemies, each enemy in its own separate table.
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//    $best_array - An array $best_array returned by function best_2_array ().
//
// Usage:
//    This function parses the nested array of enemey attributes returned by function
//    best_2_array () and prints it out in a readable HTML table to the browser.
//
////////////////////////////////////////////////////////////////////////////////////////////

function display_bestiary ($best_array)
{
  // declares Xenogears' bestiary image directory
	$best_imgdir = "/zenosaga.com/httpdocs/ep_05/bestiary/";

  // error handling code begins
	if (!is_array($best_array))
	{
		$bestiary = new page("Error retrieving bestiary data");
		$bestiary->body();
		$bestiary->epchannel();
		$bestiary->topmenu();
		$bestiary->mainlogo();
		$bestiary->subsitemenu(0);
		
		standarderror("Unable to connect to the bestiary database.  Please try again
		or if the problem persists, send us a notification via email to support@zenosaga.com.");

		$bestiary->printfooter();
		$bestiary->printmaps();
		exit;
	}
	// error handling code ends

	$tdbg_color = "#9D1C1C";

	foreach ($best_array as $row)
	{
		if ($tdbg_color == "#640000")
		{
			$tdbg_color = "#9D1C1C";
		} else {
			$tdbg_color = "#640000";	
		}
		
		if (($row->type) == "0")
		{
			$type = "Character";
		} elseif (($row->type) == "1") {
			$type = "Gear";
		} else {
			$type = "Character & Gear";
		}
?>
<div align="right">
  <table width="495" border="0" align="center">
    <tr>
      <td bgcolor="#000000" width="146" valign="top"><div align="center">
          
          <?
// display enemy's image, if file exist. otherwise display redrum.gif
if (file_exists($best_imgdir.$row->pic.".gif"))
{
	echo "<img src=\"http://www.zenosaga.com/ep_05/bestiary/".$row->pic.".gif\" width=\"146\">";
} else {
?>

          <img src="/ep_05/bestiary/redrum.gif" width="146" height="70">
          <?
}
?>
        </div></td>
      <td bgcolor="#000000" width="350"><table width="350" border="0" cellspacing="2">
          <tr>
            <td bgcolor="<? echo $tdbg_color; ?>" valign="top" width="75%"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Creature <br>
              </font> </b></td>
            <td bgcolor="<? echo $tdbg_color; ?>" valign="top" width="25%"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Type <br>
              </font> </b></td>
          </tr>
          <tr valign="top">
            <td bgcolor="#2A2A2A" width="75%"><span class="bestiaryhi"> <? echo $row->name; ?> <br>
              </span></td>
            <td bgcolor="#2A2A2A" width="25%"><span class="defaulttext"> <? echo $type; ?> <br>
              </span></td>
          </tr>
        </table>
        <table width="350" border="0" cellspacing="2">
          <tr valign="top">
            <td bgcolor="<? echo $tdbg_color; ?>" width="73"><b> <font face="Tahoma" size="1" color="#FFFFFF"> HP <br>
              </font> </b></td>
            <td bgcolor="<? echo $tdbg_color; ?>" width="73"><b> <font face="Tahoma" size="1" color="#FFFFFF"> EXP <br>
              </font> </b></td>
            <td bgcolor="<? echo $tdbg_color; ?>" width="74"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Gold <br>
              </font> </b></td>
          </tr>
          <tr valign="top" bgcolor="#2A2A2A">
            <td width="73"><span class="defaulttext"> <? echo $row->hp; ?> <br>
              </span></td>
            <td width="73"><span class="defaulttext"> <? echo $row->exp; ?> <br>
              </span></td>
            <td width="74"><span class="defaulttext"> <? echo $row->gold; ?> <br>
              </span></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td bgcolor="#000000" colspan="2"><table width="100%" border="0" cellspacing="2">
          <tr>
            <td bgcolor="<? echo $tdbg_color; ?>" valign="top"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Description <br>
              </font> </b></td>
          </tr>
          <tr>
            <td bgcolor="#2A2A2A"><span class="defaulttext"> <? echo $row->descript; ?> <br>
              <br>
              </span></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td bgcolor="#000000" colspan="2"><table width="100%" border="0" cellspacing="2">
          <tr bgcolor="<? echo $tdbg_color; ?>" valign="top">
            <td width="50%"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Continent <br>
              </font> </b></td>
            <td width="50%"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Native Habitat(s) <br>
              </font> </b></td>
          </tr>
          <tr valign="top" bgcolor="#2A2A2A">
            <td width="50%"><span class="defaulttext">
              
              <?
// display list of continent(s) where enemy resides
$continent = explode(",", $row->continent);
for ($c_count = 0; $c_count < sizeof($continent); $c_count++)
{
?>
              <img src="/images/smarrowo.gif" width="10" height="9"> <? echo $continent[$c_count]; ?> <br>
              <?
}
?>

              <br>
              </span></td>
            <td width="50%"><span class="defaulttext">
              <?
// display list of area(s) where enemy roams
$area = explode(",", $row->area);
for ($a_count = 0; $a_count < sizeof($area); $a_count++)
{
?>
              <img src="/images/smarrowg.gif" width="15" height="9"> <? echo $area[$a_count]; ?> <br>
              <?
}
?>
              <br>
              </span></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td bgcolor="#000000" colspan="2"><table width="100%" border="0" cellspacing="2">
          <tr valign="top">
            <td width="25%" bgcolor="<? echo $tdbg_color; ?>"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Drop Items <br>
              </font> </b></td>
            <td width="75%" bgcolor="<? echo $tdbg_color; ?>"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Attacks + Special abilities <br>
              </font> </b></td>
          </tr>
          <tr valign="top" bgcolor="#2A2A2A">
            <td width="25%"><span class="defaulttext">
              
              <?
// display list of item(s)the enemy drops upon defeat
$item = explode(",", $row->item);

for ($i_count = 0; $i_count < sizeof($item); $i_count++)
{
?>
              <img src="/images/square01.gif" width="10" height="10"> <? echo $item[$i_count]; ?> <br>
              <?
} // END ECHO ITEMS
?>

              <br>
              </span></td>
            <td width="75%"><span class="defaulttext">
              
              <?
// display enemy's abilities
$ability = explode(",", $row->ability);

for ($a_count = 0; $a_count < sizeof($ability); $a_count++)
{
?>
              <img src="/images/star01.gif" width="12" height="10"> <? echo $ability[$a_count]; ?> <br>
              <?
} // END ECHO ABILITIES
?>

              <br>
              </span></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td bgcolor="#000000" colspan="2"><table width="100%" border="0" cellspacing="2">
          <tr>
            <td bgcolor="<? echo $tdbg_color; ?>" valign="top"><b> <font face="Tahoma" size="1" color="#FFFFFF"> Special Notes <br>
              </font> </b></td>
          </tr>
          <tr>
            <td bgcolor="#2A2A2A"><span class="defaulttext"> <? echo $row->notes; ?> <br>
              <br>
              </span></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<br>
<br>
<?
	//$tdbg_color = "#591111";
	}
} // END DISPLAY_BESTIARY

?>
