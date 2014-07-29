<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// cls_page.php - Main class constructor
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the global variables and methods to construct a basic web page
// for Zenosaga.com.
//
// Author: int
// Last modified: 03/11/02
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//		agent_fns.php	-	file containing browser detection and indentification functions
//		ban_fns.php	-	file containing all banning related functions
//		ckie_fns.php	-	file containing all cookie and session functions
//		color.php		-	file containing background color scheme based on user's preference
//		db_config.php	- 	database configurations
//		db_fns.php		- 	database functions
//		download.php	-	file containing all file transmission functions
//		err_fns.php	-	file containing standard error handling functions
//		misc_fns.php	-	file containing miscellaneous site functions
//		url_fns.php	-	file containing all URL reading, writing, parsing related functions
//		user_fns.php	-	file containing all user related functions
//		vars.php		- 	file containing environment variables
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/ckie_fns.php");
require_once("/zenosaga.com/httpdocs/global/color.php");
require_once("/zenosaga.com/httpdocs/global/db_config.php");
require_once("/zenosaga.com/httpdocs/global/db_fns.php");
require_once("/zenosaga.com/httpdocs/global/misc_fns.php");
require_once("/zenosaga.com/httpdocs/global/agent_fns.php");
require_once("/zenosaga.com/httpdocs/global/url_fns.php");
require_once("/zenosaga.com/httpdocs/global/user_fns.php");
require_once("/zenosaga.com/httpdocs/global/vars.php");
require_once("/zenosaga.com/httpdocs/global/ban_fns.php");
require_once("/zenosaga.com/httpdocs/global/err_fns.php");
require_once("/zenosaga.com/httpdocs/global/download/dnld_fns.php");

// define global variables used between vBulletin and Z
global $REQUEST_URI, $username, $userhash, $sessionhashed, $bbuserid, $bbypass, $SCRIPT_NAME;

if ((SITESTATUS == "off") && (eregi("member", $SCRIPT_NAME) == false) && 
	(!check_vip($GLOBALS[bbuserid])) && !eregi('register.php', $_SERVER['SCRIPT_FILENAME']))
{
   	$sitestatus = new page("Zenosaga.com is temporarily offline");
	
   	$sitestatus->body($c="off");
   	$sitestatus->epchannel();
   	$sitestatus->topmenu();
   	$sitestatus->mainlogo();
   	$sitestatus->subsitemenu(0);
	
	standarderror("Zenosaga.com is currently undergoing server-wide maintenance. This may 
					include any of the following: server backup, server diagnostics, software 
					installation, mass file moving, installing new hardwares (hard drive, memory, 
					etc.), network configurations or setup, or others.  Maintenance usually last 
					any where from half an hour to 3 hours, so, be sure to check back later.<br>
				    <img src='http://".DOMAIN."/php-bin/counter/counter.php' border=0 width=1 height=1>",
				   	"Maintenance Message");

	$sitestatus->printfooter();
   	$sitestatus->printmaps();
	@virtual("/zenosaga.com/httpdocs/pl-bin/axs/ax.cgi");
	exit;	
}


// commented out on 11.29.2002

/*
if ((isset($username)) && (isset($userhash)))
{
	checkuser($username, $userhash);
}
*/

$array_uri = explode("/", $REQUEST_URI);

if (@check_banned_agent() == 'true')
{
   	$sitestatus = new page("Access Denied");
	
   	$sitestatus->body($c="off");
   	$sitestatus->epchannel();
   	$sitestatus->topmenu();
   	$sitestatus->mainlogo();
   	$sitestatus->subsitemenu(0);
	
	standarderror("Sorry, offline browsers are not permitted on this server.  Use an appropriate 
					browser and try again.<br>", "Illegal Browser Detected");

	$sitestatus->printfooter();
   	$sitestatus->printmaps();
	exit;	
}

$host_name = $GLOBALS['REMOTE_HOST'];

/* commented out on 12/07/03 -- check ban ip technique

.
.
.

*/

class page
{	// BEGIN CLASS DEFINITION

	var $episode;
	var $episode_path;
	var $title;
	var $short_title;
	var $language;

	var $thisURL;
	var $episode6;
	
function set_lang($lang)
{
    if ($lang != "en")
    {
        $this->language = $lang."/";
    } else {
		$this->language = "";
	}
}

function setURL()
{
	$this->thisURL = $GLOBALS['REQUEST_URI'];
}

function page($title, $epitype = "0")
{

// Prints out uniform resource locator in a coherent format for the title
	if (isset($title))
	{
		$this->title = "Zenosaga: The 'ETHOS' Sanctuary -+- Xenogears // Xenosaga".uri().$title."" ;
	} else {
		$this->title = "Zenosaga: The 'ETHOS' Sanctuary";
	}
	
	$this->setURL();

	$this->episode = $epitype;
	$this->short_title = $title;
	
	switch ($epitype)
	{
		case '1':
		case '01':
			$this->episode_path = XSIMG;
			break;

		case '2':
		case '02':
			$this->episode_path = XS2IMG;
			break;

		case '5':
		case '05':
			$this->episode_path = XGIMG;
			break;

		default:
			$this->episode_path = XSIMG;
			break;
	}
	
	db_connect();

}

function body()		// BEGIN BODY
{
//	if ($c == "off") {
		copyright();
//	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><? echo $this->title; ?></title>
<link rel="stylesheet" href="<? echo GLOBALURL; ?>css/style.css" type="text/css">
<? include ("/zenosaga.com/httpdocs/global/meta_fns.php"); ?>
<? include ("/zenosaga.com/httpdocs/global/java_fns.php"); 

//	db_connect(db_db);
	$userID = "SELECT *
			   FROM ehq_users
			   WHERE username = '".$GLOBALS[username]."'
			   AND userhash = '".$GLOBALS[userhash]."'";
			   
	$result  = @mysql_query($userID);
	$userObj = @mysql_fetch_object($result);

//	db_connect("zenosaga_vbulletin");
	$query = "SELECT *
			  FROM zenosaga_vbulletin.privatemessage
			  WHERE messageread = 0
			  AND deleteprompt NOT 1
			  AND userid = $GLOBALS[bbuserid]";
	
	$result2 = @mysql_query($query);
	$new_pm  = @mysql_num_rows($result2);

	if ($new_pm > 0)
	{

?>
<script language="JavaScript">
<!--
function confirm_newpm() {
	input_box=confirm("You have one ore more new private messages.");
	if (input_box==true) { 
	}
}
-->
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-13119567-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<body style="margin: 0;" onLoad="self.status='Zenosaga.com © 1999-2004'; Javascript:confirm_newpm(); return true;" bgcolor="#000000">
<?
} else {
?>

<body style="margin: 0;" onload="self.status='Zenosaga.com © 1999-2004'; return true;" bgcolor="#000000">
<?
}
?>
<!-- CENTER TAG
<div align="center">
-->
<?
}

function hidden_menu()
{
	$query = "SELECT *
			  FROM zenosaga_zenosaga.ehq_admin
			  WHERE userid = $GLOBALS[bbuserid]
			  AND username = '$GLOBALS[username]'";
	
	$result = @mysql_query($query);
	
	if (($numrows = @mysql_num_rows($result)) > 0)
	{
		if (absNetscape())
		{
			echo '<img src="http://www.zenosaga.com/images/_nav-ep3.gif" name="XS3" border="0" alt="">';
			echo '<img src="http://www.zenosaga.com/images/_nav-ep4.gif" name="XS4" border="0" alt="">';			
			echo '<img src="http://www.zenosaga.com/images/_nav-ep4.gif" name="XS4" border="0">';
			$this->episode6 = '<img src="http://www.zenosaga.com/images/_nav-ep6.gif" name="XS6" border="0" alt="">';
		} else {
			echo '<img src="http://www.zenosaga.com/images/_nav-ep3.gif" name="XS3" border="0" 
				style="filter:alpha(opacity=45)" alt="">';
			echo '<img src="http://www.zenosaga.com/images/_nav-ep4.gif" name="XS4" border="0" 
				style="filter:alpha(opacity=45)" alt="">';
			$this->episode6 = '<img src="http://www.zenosaga.com/images/_nav-ep6.gif" name="XS6" border="0"
				style="filter:alpha(opacity=45)" alt="">';
		}
	} else {
		$episode6 = "";
	}
} // end hidden_menu()

function epchannel() // BEGIN EPISODE CHANNEL
{
?>

<!-- BEGIN TOP MENU --> 

<a name='top'></a>
<table width='770' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td background="<?echo IMAGE?>bg-tophd.jpg"><!-- sub table -->
      
      <table width='770' border='0' cellspacing='1' cellpadding='0'>
          <tr>
        
          <td>
        
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='385' valign='middle'><a href="<? echo URL; ?>?"><img src='<? echo IMAGE; holiday_logo(); ?>' height='60' border="0" alt=""></a></td>
            <? if (absNetscape()) { ?>
            <td width='310' valign='bottom' align='right'><a href="http://<? echo DOMAIN; ?>/ep_01/?" OnMouseOver="ImageOn('XS'); window.status='E P I S O D E    I'"; OnMouseOut="ImageOff('XS'); window.status='';"><img src="http://<? echo DOMAIN; ?>/images/_nav-ep1.gif" name="XS" border="0"></a><a href="http://<? echo DOMAIN; ?>/ep_02/?" OnMouseOver="ImageOn('XS2'); window.status='E P I S O D E    I I'"; OnMouseOut="ImageOff('XS2'); window.status='';"><img src="http://<? echo DOMAIN; ?>/images/_nav-ep2.gif" name="XS2" border="0"></a>
              <? $this->hidden_menu(); ?>
              <a href="http://<? echo DOMAIN; ?>/ep_05/?" OnMouseOver="ImageOn('XG'); window.status='E P I S O D E    V';" OnMouseOut="ImageOff('XG'); window.status='';"><img src="http://<? echo DOMAIN; ?>/images/_nav-ep5.gif" name="XG" border="0" alt=""></a><a href="http://www.facebook.com/zenosaga"><img src="http://<? echo DOMAIN; ?>/images/fb24.png" name="Facebook" border="0" alt=""></a><? echo $this->episode6; ?></td>
          </tr>
          <?
} else {
?>
          
            <td  valign='bottom' align='right'><a href="http://<? echo DOMAIN; ?>/ep_01/?"><img src="http://<? echo DOMAIN; ?>/images/_nav-ep1.gif" name="XS" border="0"></a><a href="http://<? echo DOMAIN; ?>/ep_02/?"><img src="http://<? echo DOMAIN; ?>/images/_nav-ep2.gif" name="XS2" border="0"></a><a href="http://<? echo DOMAIN; ?>/ep_05/?"><img src="http://<? echo DOMAIN; ?>/images/_nav-ep5.gif" name="XG" border="0" alt=""></a><a href="http://www.facebook.com/zenosaga"><img src="http://<? echo DOMAIN; ?>/images/fb24.png" name="Facebook" border="0" alt=""></a></td>
          </tr>
          <!--	<td width='385' valign='bottom' align='right'><a href="http://www.zenosaga.com/ep_01/?" onFocus="this.blur()" ONMOUSEOVER="nereidFade(XS,100,20,5); window.status='E P I S O D E    I'; return true" ONMOUSEOUT="nereidFade(XS,45,20,5); window.status='Zenosaga.com © 1999-2001';"><img src="http://www.zenosaga.com/images/_nav-ep1.gif" name="XS" border="0" style="filter:alpha(opacity=45)" alt=""></a><img src="http://www.zenosaga.com/images/_nav-ep2.gif" name="XS2" border="0" style="filter:alpha(opacity=45)" alt=""><? $this->hidden_menu(); ?><a href="http://www.zenosaga.com/ep_05/?" onFocus="this.blur()" ONMOUSEOVER="nereidFade(XG,100,20,5); window.status='E P I S O D E    V'; return true" ONMOUSEOUT="nereidFade(XG,45,20,5); window.status='Zenosaga.com © 1999-2001';"><img src="http://www.zenosaga.com/images/_nav-ep5.gif" name="XG" border="0" style="filter:alpha(opacity=45)" alt=""></a><? echo $this->episode6; ?></td>-->
          <?
}
?>
            </td>
          
            </tr>
          
        </table>
      </table>
      
      <!-- // sub table --></td>
  </tr>
</table>
<?
}	// END EPISODE CHANNEL

function topmenu()	// BEGIN TOP MENU
{
?>

<!-- BEGIN URL LOCATOR AND MAIN MENU -->

<table width='770' border='0' cellspacing='1' cellpadding='0'>
<!-- BEGIN URL LOCATOR -->
<?
$this->set_lang($GLOBALS['lang']);

switch ($this->episode)
{
	case '0':
	case '00':
		$mnubgcolor = "#4F4F4F";
		$path = IMAGE;
		break;

	case '1':
	case '01':
		$mnubgcolor = "#0B0077";
		$path = XSIMG;
		break;
	
	case '2':
	case '02':
		$mnubgcolor = "#4C0663";
		$path = XS2IMG;
		break;

	case '5':
	case '05':
		$mnubgcolor = "#770000";
		$path = XGIMG;
		break;

	default:
		$mnubgcolor = "#4F4F4F";
		$path = IMAGE;
		break;
}

if (isset($GLOBALS[username]))
{
	if (checkuser($GLOBALS['username']))
	{
        $logged = "<a href='http://".DOMAIN."/global/logoff.php'><img src='".SHARE."-logoff.gif' border='0' alt=''></a>";
    } else {
        $logged = "<a href='http://www.zenosaga.com/forums/register.php'><img src='".SHARE."-rgister.gif' border='0' alt=''></a>";
    }
} else {
        $logged = "<a href='http://www.zenosaga.com/forums/register.php'><img src='".SHARE."-rgister.gif' border='0' alt=''></a>";
}
?>
<tr>
  <td width='400' valign='top' bgcolor='<? echo $mnubgcolor; ?>'><span class=copyright3> <img src='<? echo IMAGE; ?>tran-dot.gif' width='6' height='10' alt=''>
    <? cookie_crumb(); echo " <b>".$this->short_title."</b><br>"; ?>
    </span></td>
  
  <!-- //END URL LOCATOR -->
  
  <td bgcolor='<? echo $mnubgcolor; ?>'><table width='100%' border='0' cellspacing='0' cellpadding='0' align='right'>
      <tr> 
        
        <!-- BEGIN MAIN MENU -->
        
        <td width="370" align="right" valign="bottom"><? if (stristr($this->thisURL, "bookmark"))
{
?>
          <div align="right"><a href="javascript:bookmark();"><img src="<? echo IMAGE;?>smarrowm.gif" border="0" alt=""></a><img src='<? echo $path.$this->language; ?>mnu-main.gif' usemap="#top_navibarMap" border="0" alt=""><img src="<? echo SHARE; ?>-bk_mark.gif" border="0" alt=""><? echo $logged; ?></div>
          <?
} else {
?>
          <div align="right">
          <a href="javascript:bookmark();"><img src="<? echo IMAGE;?>smarrowm.gif" border="0" alt=""></a><img src='<? echo $path.$this->language; ?><? if (check_ratio($GLOBALS['bbuserid'])) { echo "mnu-main.gif'"; } else { echo "mnu-main2.gif'";} ?> usemap="#top_navibarMap" border="0" alt=""><a href="<? echo GLOBALURL; ?>bookmark/bookmark.php?bk_title=<? echo $this->short_title; ?>&bk_url=<? echo urlencode($this->thisURL); ?>&oom_bop=<? echo $GLOBALS['SERVER_NAME']; ?>"><img src="<? echo SHARE; ?>-bk_mark.gif" border="0" alt=""></a><? echo $logged; ?></div>
<?
}
?>
</td>

<!-- //END MAIN MENU -->

</tr>
</table>
</td>
</tr>
</table>

<!-- //END URL LOCATOR AND MAIN MENU -->

<?
}	// END TOP MENU

function mainlogo()	// BEGIN MAIN LOGO
{
?>

<!-- BEGIN MAIN HEADER LOGO -->

<table width="770" border="0" cellspacing="0" cellpadding="0">
<tr>
<?
if ($this->episode != "0") {
	epilogo($this->episode);
} else {
	toplogo();
}
?>
</tr>
</table>
<!-- //END MAIN HEADER LOGO -->
<?
}

function subsitemenu($type = "0")	// BEGIN SUBSITE MENU
{

	$this->set_lang($GLOBALS['lang']);

	switch ($this->episode)
	{
		case '0':
		case '00':
			$mnubgcolor = "#4F4F4F";
			$path = IMAGE;
			break;

		case '1':
		case '01':
			$mnubgcolor = "#0B0077";
			$path = XSIMG;
			break;

		case '2':
		case '02':
			$mnubgcolor = "#4C0663";
			$path = XS2IMG;
			break;

		case '5':
		case '05':
			$mnubgcolor = "#770000";
			$path = XGIMG;
			break;

		default:
			$mnubgcolor = "#4F4F4F";
			$path = IMAGE;
			break;
	}

	if($type == "0")
	{
?>

<!-- BEGIN SUB SITE MENU -->

<!-- BEGIN SEARCH -->

<table width="770" border="0" cellspacing="0" cellpadding="0" background="<? echo IMAGE; ?>hdr_bgbt.gif">
<tr background="<? echo IMAGE; ?>hdr_bgbt.gif">
<form method="post" action="<? echo UNIVERSALURL; ?>search/search.php?by=news">
<td width="210" background="<? echo IMAGE; ?>hdr_bgbt.gif" valign="top" height="27">
<span class=siteupdate3>
<? if (absNetscape()) { $value = 5; } else { $value = 10; } ?>
<input TYPE="text" NAME="keyword" class="dropdown2" value="Keywords" onfocus='doClear(this)' size="<? echo $value; ?>">
          <select NAME="type1" class="dropdown2">
            <option value="edit">Editorial</option>
            <option value="excl">Exclusives</option>
            <option value="News" selected>News</option>
            <option value="opin">Opinion Columns</option>
          </select>
          &nbsp;&nbsp;
          <input type=IMAGE src="<? echo SHARE; ?>search.gif" border="0">
          <input type=hidden name=by value=news>
          <input type=hidden name=advance value=1>
          <input type=hidden name=month1 value=%>
          <input type=hidden name=year1 value=%>
          </span></td>
          </form>
        <td width="560" background="<? echo IMAGE; ?>hdr_bgbt.gif" height="25" align="right" valign="top"><img src='<?echo SHARE; ?>mnu-intr.gif' width='195' height='27' usemap="#menuIntro" border='0' alt=""><img src="<? echo $path.$this->language; ?>mnu-game.gif" usemap="#game_menu" border="0"></td>
      </tr>
    </table>
    
    <!-- //END SEARCH --> 
    
    <!-- //END SUB SITE MENU -->
    
    <?
	}

	if($type == "1")
	{
?>
    
    <!-- BEGIN SUB SITE MENU --> 
    
    	TWO BIN! 
    
    <!-- //END SUB SITE MENU -->
    
    <?
	}	
}	// END SUBSITE MENU

function printfooter()	// BEGIN PRINT FOOTER
{
?>
    <script language="JavaScript1.2">mmLoadMenus();</script> 
    <!-- BEGIN FOOTER -->
    
    <table width='770' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td colspan='2' background='<? echo SHARE;?>bar-lwr.gif' height="26"><div align='right'> 
            <!--<img src='<? echo SHARE; ?>mnu-cpnl.gif' width='100' height='26' border=0>--> 
          </div></td>
      </tr>
      <tr>
        <td width='263'><img src='<? echo IMAGE; ?>bar-lwr1.jpg' width='263' height='50' alt=""></td>
        <td width='497'><span class=copyright><b><a href="http://<? echo DOMAIN; ?>/tos/index.php?tos=cr">Copyright</a> &raquo; Terms of Use &raquo; <a href="http://<? echo DOMAIN; ?>/tos/index.php?tos=pn">Privacy Statement</a></b></span><br>
          <span class=copyright2><b>Copyright &copy; 1999 ~ <? echo date("Y"); ?> The 'ETHOS' Sanctuary.</b> All rights reserved.<br>
          By browsing this site, you agree to the terms and conditions of our Terms of Use. Please read.</span></td>
      </tr>
      <tr bgcolor='#3D1E5B'>
        <td colspan='2'><div align='right'> <span class=version> <a href="#">Change Log</a> | <? echo VERSION; ?> </span> </div></td>
      </tr>
    </table>
    
    <!-- //END FOOTER -->
    
    <?
}	// END PRINT FOOTER

function printmaps()	// BEGIN PRINT IMAGE MAPS
{
	if (empty($this->episode))
	{
?>
    <div id="overDiv" style="position:absolute; top: 10px; left: 32px; width: 250px; clipping: 0px 50px 50px 0px; visibility: hidden;"> <img src="http://<? echo DOMAIN; ?>/_imgs-st/img_ukun.gif" width="220" height="124" alt="">
      <div id=textDiv style="position:absolute; top: 63px; left: 7px; clipping: 0px 101px 63px 0px;; width: 110px; height: 53px">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td ><font color="#0000FF" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <b>Tooltip:</b> </font></td>
            <td ></td>
          </tr>
          <tr>
            <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><b>Test</b></font></td>
          </tr>
        </table>
      </div>
      
      <!--<script language="javascript" type="text/javascript" xml:space="preserve"> initTooltip() </script>--> 
    </div>
    
    <!-- <script language="JavaScript">if (navigator.userAgent.indexOf("Op")==-1) {top.location.hash = 'download';}</SCRIPT> --> 
    
    <!-- BEGIN GAME MENU -->
    
    <map name="game_menu"">
      <area shape="rect" coords="17,4,66,20" href="javascript:affils();" alt="Affiliates">
      <area shape="rect" coords="72,4,111,20" href="http://<? echo DOMAIN; ?>/banners.php" alt="Zenosaga.com and Xenosaga banners">
      <area shape="rect" coords="115,4,141,20" href="http://<? echo DOMAIN; ?>/faq/?" alt="Frequently Asked Questions">
      <area shape="rect" coords="185,3,265,21" href="http://umn.<? echo DOMAIN; ?>/elsa/library/?" alt="ETHOS Library">
      <area shape="rect" coords="269,5,316,23" href="http://umn.<? echo DOMAIN; ?>/zeboim/?" alt="Xeno Merchandise">
      <area shape="rect" coords="320,5,357,23" href="http://<? echo DOMAIN; ?>/staff.php" alt="Zenosaga.com Staff Committee">
      <area shape="rect" coords="142,3,188,22" href="http://<? echo DOMAIN; ?>/daggers/?" alt="Daggers Project">
    </map>
    
    <!--
<map name="game_menu">
<area shape="rect" coords="11,4,64,24" href="javascript: affils();" alt="Affiliates">
<area shape="rect" coords="66,4,90,21" href="http://<? echo DOMAIN; ?>/faq/?" alt="Frequently Asked Questions">
<area shape="rect" coords="142,3,188,22" href="" alt="Two months :)">
<area shape="rect" coords="191,5,274,21" href="http://<? echo DOMAIN; ?>/pw/?" alt="PERFECT WORKS">
<area shape="rect" coords="275,5,323,22" href="http://umn.<? echo DOMAIN; ?>/zeboim/?" alt="Souvenirs">
<area shape="rect" coords="328,5,359,21" href="http://<? echo DOMAIN; ?>/staff.php" alt="Staffs of Zenosaga.com">
</map>
-->
    
    <?
	}
?>
    
    <!-- //END BEGIN GAME MENU --> 
    
    <!-- BEGIN SUB SITE MAP -->
    
    <map name="top_navibarMap">
      <area title="Contact US" shape=RECT alt="Contact Us" coords=1,1,41,12 href="http://<? echo DOMAIN; ?>/contact.php">
      <? if (check_ratio($GLOBALS['bbuserid'])) { echo '<area title="Downloads" shape=RECT alt=Downloads coords=46,0,72,11 href="http://download.zenosaga.com/index.php">'; } ?>
      <area title="Gallery" shape=RECT alt=Gallery coords=75,1,107,12 href="http://gallery.<? echo DOMAIN; ?>/?">
      <area title="My.ETHOS" shape=RECT alt=My.ETHOS coords=115,-2,170,14  href="http://my.<? echo DOMAIN; ?>/?">
      <area title="News" shape=RECT alt=News coords=175,-1,205,14 href="http://<? echo DOMAIN; ?>/search/search.php?by=news&year=%">
      
      <!--<area shape="rect" coords="284,0,303,11" href="http://<? echo DOMAIN; ?>/pw/?" alt="PERFECT WORKS" title="PERFECT WORKS">-->
      <area shape="rect" coords="305,-5,317,12" href="#" alt="Help Pamphlet" title="Help Pamphlet">
      <area shape="rect" coords="321,-2,330,12" href="#" alt="Privacy Policy" title="Privacy Policy">
      <area shape="rect" coords="334,-11,352,11" href="#" alt="Copyright Notice" title="Copyright Notice &amp; Terms of Use">
    </map>
    
    <!-- //END SUB SITE MAP --> 
    
    <!-- BEGIN EPISODE NAVIBAR MAP -->
    
    <map name="xg_navibar">
      <area shape="rect" coords="187,3,243,63" href="http://<? echo DOMAIN; ?>/ep_01" alt="E P I S O D E   I" title="E P I S O D E   I">
      <area shape="rect" coords="247,3,302,63" href="http://<? echo DOMAIN; ?>/ep_05" alt="E P I S O D E   V" title="E P I S O D E   V">
    </map>
    
    <!-- //END EPISODE NAVIBAR MAP --> 
    
    <!-- BEGIN CONTROL PANEL MAP --> 
    
    <!--
<map name="panel"> 
<area shape="circle" coords="31,13,10" href="#">
<area shape="circle" coords="52,12,9" href="#">
<area shape="circle" coords="91,12,8" href="javascript:openBDWIN('<? popup(help); ?>');">
<area shape="circle" coords="72,13,9" href="#top">
</map>
--> 
    
    <!-- //END CONTROL PANEL MAP --> 
    
    <!-- BEGIN MAIN INTRO MENU -->
    
    <map name="menuIntro">
      <area shape="rect" coords="2,4,27,23" href="javascript:chat();" alt="Online Chat">
      <area shape="rect" coords="32,5,76,23" href="http://www.zenosaga.com/forums" alt="Online Discussion"">
      <!-- onMouseOut="MM_startTimeout();" onMouseOver="MM_showMenu(window.mm_menu_0013172349_0,250,200,null,'mnuintr_r2_c2');">--> 
      <!--<area shape="rect" coords="79,5,115,24" href="http://www.live365.com/stations/295834" alt="ZenoRADIO" target="_blank">-->
      <area shape="rect" coords="117,3,142,24" href="http://xia.zenosaga.com" alt="The Xenogears Image Archive">
      <area shape="rect" coords="145,6,186,23" href="http://umn.zenosaga.com" alt="Unus Mundus Network">
    </map>
    
    <!-- //END MAIN INTRO MENU -->
    
</body>
<!-- // END CENTER TAG
</div>
-->
</html>

<?
	}	// END PRINT IMAGE MAPS
}	// END CLASS DEFINITION
//new gzip_encode();

?>
