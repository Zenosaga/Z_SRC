<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// cls_subs.php - Gaming subsection class definition
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the necessary functions and variables for declaring a
// gaming sub-section main page (i.e. Xenosaga EPISODE I, EPISODE II or Xenogears).
//
// Author: int
// Last modified: 12/01/02
// 
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    cls_page.php	- main Zenosaga page class constructor
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/cls_page.php");

class subsite extends page
{

////////////////////////////////////////////////////////////////////////////////////////////
//
// void guts (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//	Returns no value
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//	Not available
//
// Usage:
//    	This function prints the main content of a gaming sub-site, based on the game
//	the viewer is currently accessing.
//
////////////////////////////////////////////////////////////////////////////////////////////

function guts()
{

	/* take the URI that was used to access current page, ex. /ep_01/bestiary/index.html
	   then create an array $guts_url that is delimited by "/". The first element of 
	   $guts_url will determine the episode theme for the subpage.
	*/
	$guts_url = explode ("/", $GLOBALS['REQUEST_URI']);

	switch ($guts_url[1])
	{
    	case 'ep_01':
			$epi = "1";
    	    //db_connect("zenosaga_episode1");
    	    break;
        
		case 'ep_02':
			$epi = "2";
			break;
			
    	case 'ep_05':
			$epi = "5";
    	    //db_connect("zenosaga_episode5");
    	    break;

	    default:
    	    break;
	}

	switch ($GLOBALS['lang'])
	{
	    case 'fr':
	         $query = "SELECT * FROM zenosaga_episode".$epi.".intro_fr";
	         break;

	    case 'sp':
	         $query = "SELECT * FROM zenosaga_episode".$epi.".intro_sp";
	         break;

	    case 'jp':
	         $query = "SELECT * FROM zenosaga_episode".$epi.".intro_jp";
	         break;

	    default:
	         $query = "SELECT * FROM zenosaga_episode".$epi.".intro_en";
	         break;
	}
	db_connect();
	$result = @mysql_query($query);
	
	$introtext = @mysql_fetch_object($result);
	
	switch ($this->episode)
	{
		case '1':
		case '01':
			$ps = "ps2";
			break;

		case '2':
		case '02':
			$ps = "ps2";
			break;

		case '5':
		case '05':
			$ps = "ps";
			break;
	}
?>

<!-- BEGIN GUTS -->


<table width="770" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="770" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="470" rowspan="2" valign="top"><table width="470" border="0" cellspacing="0" cellpadding="0" height="402" align="center">
              <tr>
                <td colspan="2" width="470" height="85" valign="bottom" align="right"><img src="<? echo $this->episode_path; ?>img-int1.jpg" width="470" height="85"></td>
              </tr>
              <tr>
                <td width="335" height="402" valign="top" align="right"><img src="<? echo $this->episode_path; ?>img-int2.jpg" width="335" height="402"></td>
                <td width="135" height="402" background="<? echo $this->episode_path; ?>img-int3.jpg"><div align="center">
                    <p><img src="<? echo $this->episode_path; ?>image01.jpg" width="105" height="71"></p>
                    <p><img src="<? echo $this->episode_path; ?>image02.jpg" width="105" height="71"></p>
                    <p><img src="<? echo $this->episode_path; ?>image03.jpg" width="105" height="71"></p>
                    <p><img src="<? echo SHARE; ?><? echo $ps; ?>.gif"></p>
                  </div></td>
              </tr>
            </table></td>
          <?
	switch ($this->episode)
	{
		case '1':
		case '01':
			$epbgcolor = "#020951";
			break;

		case '2':
		case '02':
			$epbgcolor = "#3D0350";
			break;

		case '5':
		case '05':
			$epbgcolor = "#500202";
			break;
	}
?>
          <td width="300" bgcolor="<? echo $epbgcolor; ?>" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
              <tr>
                <td valign="top"><img src="<? echo $this->episode_path; ?>_episode.gif" width="290" height="50"></td>
              </tr>
              <tr>
                <td valign="top"><!-- BEGIN EPISODE BRIEFING -->
                  
                  <?
	echo stripslashes($introtext->summary);
?>
                  
                  <!-- //END EPISODE BRIEFING --></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td valign="bottom" bgcolor="<? echo $epbgcolor; ?>"><img src="<? echo $this->episode_path; ?>img-lwr1.jpg" width="300"></td>
        </tr>
        <tr>
          <td width="470" valign="top"><?
	switch ($this->episode)
	{
		case '1':
		case '01':
?>
            <table width="461" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td width="37%"><div align="center">&nbsp;<img src="/_img-box/xs_japle.jpg" width="133" height="100"></div></td>
                <td width="22%" align="center"><img src="/_img-box/xs_jap.jpg" width="71" height="100"></td>
                <td width="41%" align="left"><img src="/_img-box/xs_usa.jpg" width="71" height="100"></td>
              </tr>
              <tr>
                <td align="center"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">February 28, 2002</font></td>
                <td width="22%" align="center"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">February 28, 2002</font></td>
                <td width="41%" align="left"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">February 25, 2003</font></td>
              </tr>
            </table>
            <?
			break;
		
		case '2':
		case '02':
?>
            <table width="461" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr valign="top">
                <td width="37%"><div align="center">&nbsp;<img src="/_img-box/xs2_japle.jpg" width="133" height="100"></div></td>
                <td width="22%" align="center"><img src="/_img-box/xs2_jap.jpg" width="71" height="100"></td>
                <td width="41%" align="left"><!--<img src="/_img-box/xs_usa.jpg" width="71" height="100">-->&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">June 24, 2004</font></td>
                <td width="22%" align="center"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">June 24, 2004</font></td>
                <td width="41%" align="left"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif"><!--February 25, 2003-->&nbsp;</font></td>
              </tr>
            </table>
            <?
		break;

		case '5':
		case '05':
?>
            <table width="461" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td width="25%"><div align="center"><img src="/_img-box/xg_jap.jpg" width="100" height="100"></div></td>
                <td width="25%"><div align="center"><img src="/_img-box/xg_usa.jpg" width="100" height="100"></div></td>
                <td width="25%"><div align="center"><img src="/_img-box/xg_me01.gif" width="75" height="94"></div></td>
                <td width="25%"><div align="center"><img src="/_img-box/xg_me02.gif" width="75" height="95"></div></td>
              </tr>
              <tr align="center">
                <td width="25%"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">February 11, 1998</font></td>
                <td width="25%"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">October 28, 1998</font></td>
                <td width="25%"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">November 29, 2000</font></td>
                <td width="25%"><font color="#CCCCCC" size="1" face="Arial, Helvetica, sans-serif">November 29, 2000</font></td>
              </tr>
            </table>
            <?
		break;
	}
?></td>
          <td width="300" valign="top" bgcolor="#323232" align="left" height="115">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>

<!-- // END GUTS -->

<?
	} // END GUTS


////////////////////////////////////////////////////////////////////////////////////////////
//
// void game_menu (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//	Returns no value
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//	Not available
//
// Usage:
//    	This function prints the gaming menu specific to the to the game	the viewer is 
//	currently accessing. It makes use of SWITCH and cases as episodes.
//
////////////////////////////////////////////////////////////////////////////////////////////

function game_menu()
{
	switch ($this->episode)
	{
		case '1':
		case '01':
?>
<MAP name=game_menu>
  <!--
<AREA shape=RECT coords=5,6,39,22 href="http://www.zenosaga.com/ep_01/char/#">
<AREA shape=RECT coords=42,6,74,21 href="http://www.zenosaga.com/ep_01/char/#">
-->
  <AREA shape=RECT coords=75,5,120,21 href="http://<? echo DOMAIN; ?>/ep_01/bestiary/?" alt="Bestiary">
  <AREA shape=RECT coords=123,6,179,22 href="http://<? echo DOMAIN; ?>/ep_01/char/?" alt="Characters">
  <!--
<AREA shape=RECT coords=184,6,240,23 href="http://www.zenosaga.com/ep_01/char/#">
<AREA shape=RECT coords=243,6,272,23 href="http://www.zenosaga.com/ep_01/char/#">
-->
  <AREA shape=RECT coords=277,5,323,23 href="http://<? echo DOMAIN; ?>/ep_01/walkthru/?" alt="Walkthrough">
  <AREA shape=RECT coords=328,5,357,21 href="http://<? echo DOMAIN; ?>/ep_01/world/?" alt="World">
</MAP>
<?
			break;
		
		case '2':
		case '02':
			break;
			
		case '5':
		case '05':
?>
<map name="game_menu">
  <!--<area shape="rect" coords="4,3,38,23" href="#boss">--> 
  <!--<area shape="rect" coords="42,6,83,21" href="/ep_05/bestiary/">-->
  <area shape="rect" coords="89,5,141,22" href="/ep_05/char/?" alt="Characters">
  <area shape="rect" coords="145,5,205,22" href="/ep_05/equip/?" alt="Equipments">
  <area shape="rect" coords="208,7,240,23" href="/ep_05/gears/?" alt="Gears">
  <!--
<area shape="rect" coords="243,6,272,23" href="#items">
-->
  <area shape="rect" coords="277,5,323,23" href="/ep_05/walkthru/?" alt="Walkthrough">
  <area shape="rect" coords="329,5,357,19" href="/ep_05/world/?" alt="World">
</map>
<?
			break;
		
		default:
?>
<map name="game_menu">
  <area shape="rect" coords="11,4,64,24" href="javascript:affils();" alt="Affiliates">
  <area shape="rect" coords="66,4,90,21" href="http://<? echo DOMAIN; ?>/faq/?" alt="Frequently Asked Questions">
  <area shape="rect" coords="142,3,188,22" href="http://<? echo DOMAIN; ?>/daggers/?" alt="Daggers Project">
  <area shape="rect" coords="191,5,274,21" href="http://<? echo DOMAIN; ?>/pw/?" alt="PERFECT WORKS">
  <area shape="rect" coords="275,5,323,22" href="http://umn.zenosaga.com/zeboim/?" alt="Souvenirs">
  <area shape="rect" coords="328,5,359,21" href="http://<? echo DOMAIN; ?>/staff.php" alt="Staffs of Zenosaga.com">
</map>
<?
			break;
	}
} // END GAME_MENU

} // END CLASS
?>
