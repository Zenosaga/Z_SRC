<?php
////////////////////////////////////////////////////////////////////////////////////////////
//
// cls_char.php - Character page class constructor
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the functions needed to construct a page for a character, based
// on their respective game.
//
// Author: int
// Last modified: 05/23/03
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    cls_subs.php	- file containing environment variables
//    db_config.php	- database configurations
//    db_fns.php		- database functions
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once ("/zenosaga.com/httpdocs/global/cls_subs.php");
require_once ("/zenosaga.com/httpdocs/global/lang/lang_fns.php");

class character extends subsite
{
	var $side_logo;
	var $char_id;
	
	function set_charID($charID)
	{
		$this->char_id = $charID;
	} // end set_charID()
	
	function side_logo()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$this->side_logo = "ep_01";
				break;
			
			case '5':
			case '05':
				$this->side_logo = "ep_05";				
				break;
			
			default:
				break;
		}
		return $this->side_logo;
	}
	
	function main()
	{
?>

<TABLE cellSpacing=0 cellPadding=0 width=770 border=0>
  <TBODY>
    <TR vAlign=top align=left>
      <TD vAlign=top bgColor=#5e6a80 height=175><!-- SIDE LOGO --> 
        <IMG height=350 src="/<? echo $this->side_logo(); ?>/char/images/main_l1.jpg" width=250> 
        <!-- //SIDE LOGO --> 
        
        <br>
        <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
          <tr>
            <td bgcolor="#737188" align="left" valign="top"><img src="/_imgs-st/_char-c1.gif" width="12" height="11"></td>
            <td bgcolor="#737188">&nbsp;</td>
            <td bgcolor="#737188" valign="top" align="right"><img src="/_imgs-st/_char-c2.gif" width="12" height="11"></td>
          </tr>
          <tr bgcolor="#737188">
            <td colspan="3"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" height="100%">
                <tr>
                  <td valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td rowspan="2" valign="top"><img src="/_imgs-st/img_nfo1.gif" width="56" height="49"></td>
                        <td width="147" valign="top" height="41"><img src="/_imgs-st/nfo_stat.gif" width="147" height="41"></td>
                      </tr>
                      <tr>
                        <td width="147" valign="top"><? $this->char_data(); ?></td>
                      </tr>
                    </table>
                    <? $this->print_gear(); ?>
                    <br>
                    <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td valign="top" width="56"><img src="/_imgs-st/img_nfo1.gif" width="56" height="49"></td>
                        <td valign="top" width="147"><img src="/_imgs-st/nfo_abil.gif" width="147" height="41"></td>
                      </tr>
                      <tr>
                        <td valign="top" colspan="2"><img src="/_imgs-st/tran-pix.gif" width="1" height="5"></td>
                      </tr>
                      <tr>
                        <td valign="top" colspan="2"><!-- ABILITIES -->
                          
                          <? $this->char_abilities(); ?>
                          
                          <!-- //ABILITIES --></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
      <td width=520 bgColor=#333333 height=100% align="right"><!-- CHARACTER MENU -->
        
        <? $this->char_menu(); ?>
        
        <!-- //CHARACTER MENU -->
        
        <table cellSpacing=0 cellPadding=0 width="511" border=0 height="100%">
          <tbody>
            <tr>
              <td bgcolor="#000000" colspan="2" valign="top" width="511"><table width="511" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td background="/ep_0<? echo $this->episode; ?>/char/images/bg/0<? echo $this->char_id; ?>.jpg" height="350" valign="top"><img src="/_imgs-st/tran-pix.gif" width="50" height="77"><br>
                      <img src="/ep_0<? echo $this->episode; ?>/char/images/0<? echo $this->char_id; ?>.gif" width="142" height="45"><br>
                      <br>
                      <img src="/_imgs-st/tran-gry.gif" width="142" height="1"><br>
                      <br>
                      <img src="/_imgs-st/img_char.gif" width="91" height="9"><br>
                      <br>
                      <img src="/_imgs-st/tran-gry.gif" width="142" height="1"><br>
                      <br>
                      
                      <!-- CHARACTER PROFILE -->
                      
                      <? $this->char_profile(); ?>
                      
                      <!-- //CHARACTER PROFILE --> 
                      
                      <br>
                      <img src="/_imgs-st/tran-gry.gif" width="142" height="1"></td>
                  </tr>
                </table>
                
                <!-- CHARACTER DESCRIPTION -->
                
                <? $this->char_descript(); ?>
                <? 
	if ($this->episode == 1)
	{
		$this->ether();
		echo "<br>";
		$this->get_char_atk();
		echo "<br>";
	}
?>
                <!-- DEATHBLOWS -->
                
                <? $this->char_db(); ?>
                
                <!-- //DEATHBLOWS --> 
                
                <br>
                <? $this->char_weapons(); ?>
                
                <!-- //WEAPONS --></td>
            </tr>
        </table></TD>
    </TR>
  </TBODY>
</TABLE>
</TD>
</TR>
</TBODY>
</TABLE>
<?	
	}
	
	function char_data()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$epi = "1";
				$attack = "Strength";
				$dex = "Dexterity";
				$def = "Vitality";
				break;
				
			case '5':
			case '05':
				$epi = "5";
				$attack = "Attack";
				$dex = "Hit %";
				$def = "Defense";
				break;
			
			default:
				break;
		}
		
//		db_connect("zenosaga_episode".$epi);
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_stat_en
				  WHERE charID = '$this->char_id'";

		$result = @mysql_query($query);
		
		if ($result) {
			$charData = @mysql_fetch_object($result);
		}
?>
<!-- CHARACTER DATA -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Level:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->level; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Hit Points:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->hp; ?></span></td>
  </tr>
  <? 
	if ($this->episode == '5')
	{
?>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Weight:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->ep; ?></span></td>
  </tr>
  <?
	}
?>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c"><? echo $attack; ?>:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->attack; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c"><? echo $dex; ?>:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->hit; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c"><? echo $def; ?>:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->defense; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Evade %:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->evade; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Ether Points:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->ep; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Ether Attack:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->ether; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Eth Defense:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->ethdef; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Agility</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->agility; ?></span></td>
  </tr>
  <? 
	if ($this->episode == '5')
	{
?>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Armor:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->armor; ?></span></td>
  </tr>
  <tr valign="top">
    <td width="55%"><b><span class="siteupdate3c">Accessory:</span></b></td>
    <td width="45%"><span class="siteupdate3c"><? echo $charData->accessory; ?></span></td>
  </tr>
  <?
	}
?>
</table>

<!-- //CHARACTER DATA -->
<?	
	} // end char_data()
	
	function print_gear()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$gear = "agws";
				break;
				
			case '5':
			case '05':
				$gear = "gear";
				break;
			
			default:
				break;
		}

		if (!(file_exists("/zenosaga.com/httpdocs/_img-bot/0".$this->episode."/0".$this->char_id.".jpg")))
		{
			return;
		}
?>
<!-- GEARS / A.G.W.S. --> 

<br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td rowspan="2" valign="top"><img src="/_imgs-st/img_nfo1.gif" width="56" height="49"></td>
    <td width="147" valign="top" height="41"><img src="/_imgs-st/nfo_<? echo $gear; ?>.gif" width="147" height="41"></td>
  </tr>
  <tr>
    <td width="147" align="center" valign="top"><a href="/ep_0<? echo $this->episode; ?>/gears/?gearID=<? echo $this->char_id; ?>"> <img src="/_img-bot/0<? echo $this->episode; ?>/0<? echo $this->char_id; ?>.jpg" border="0"></a></td>
  </tr>
</table>

<!-- //GEARS / A.G.W.S. -->
<?
	} //end print_gear()
	
	function char_menu()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
?>
<table width="511" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align=right bgcolor="#000000" colspan="3"><img src="/_imgs-st/tran-pix.gif" width="1" height="5"></td>
  </tr>
  <tr>
    <td align=left width="100" height="32"><img src="/_imgs-st/_char-mn.gif" width="100" height="32"></td>
    <td width="195" align=center valign="middle"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr align="center" valign="middle">
          <td><img src="/ep_01/char/images/_07.gif" alt="Matthews" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_08.gif" alt="Tony" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_09.gif" alt="Hammer" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_10.gif" alt="Juli Mizurahi" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_11.gif" alt="Joachim Mizurahi" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_12.gif" alt="Gaignun Kookai" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_13.gif" alt="Shelley Godwin" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_14.gif" alt="Mary Godwin" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_23.gif" alt="Albedo" width="15" height="15"></td>
        </tr>
        <tr align="center" valign="middle">
          <td><img src="/ep_01/char/images/_15.gif" alt="Margulis" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_16.gif" alt="Pellegri" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_17.gif" alt="Andew" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_18.gif" alt="Virgil" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_19.gif" alt="Wilhelm" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_20.gif" alt="Allen Ridgely" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_21.gif" alt="Miyuki Itsumi" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_22.gif" alt="Nephilim" width="15" height="15"></td>
          <td><img src="/ep_01/char/images/_24.gif" alt="Kirchswasser" width="15" height="15"></td>
        </tr>
      </table></td>
    <td width="216" height="32" align=right><a href="/ep_01/char/?charID=1"><img src="/ep_01/char/menu/01.gif" width="32" height="32" border="0"></a> <a href="/ep_01/char/?charID=2"><img src="/ep_01/char/menu/02.gif" width="32" height="32" border="0"></a> <a href="/ep_01/char/?charID=3"><img src="/ep_01/char/menu/03.gif" width="32" height="32" border="0"></a> <a href="/ep_01/char/?charID=4"><img src="/ep_01/char/menu/04.gif" width="32" height="32" border="0"></a> <a href="/ep_01/char/?charID=5"><img src="/ep_01/char/menu/05.gif" width="32" height="32" border="0"></a> <a href="/ep_01/char/?charID=6"><img src="/ep_01/char/menu/06.gif" width="32" height="32" border="0"></a></td>
  </tr>
  <tr>
    <td align=right bgcolor="#000000" colspan="3"><img src="/_imgs-st/tran-pix.gif" width="1" height="5"></td>
  </tr>
</table>
<?
				break;
				
			case '5':
			case '05':
?>
<table width="511" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align=right bgcolor="#000000" colspan="2"><img src="/_imgs-st/tran-pix.gif" width="1" height="5"></td>
  </tr>
  <tr>
    <td align=left width="189" height="32"><img src="/_imgs-st/_char-mn.gif" width="100" height="32"></td>
    <td align=right width="322" height="32"><a href="/ep_05/char/?charID=1"><img src="/ep_05/char/menu/01.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=2"><img src="/ep_05/char/menu/02.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=9"><img src="/ep_05/char/menu/03.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=3"><img src="/ep_05/char/menu/04.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=4"><img src="/ep_05/char/menu/05.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=5"><img src="/ep_05/char/menu/06.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=6"><img src="/ep_05/char/menu/07.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=7"><img src="/ep_05/char/menu/08.gif" width="32" height="32" border="0"></a> <a href="/ep_05/char/?charID=8"><img src="/ep_05/char/menu/09.gif" width="32" height="32" border="0"></a></td>
  </tr>
  <tr>
    <td align=right bgcolor="#000000" colspan="2"><img src="/_imgs-st/tran-pix.gif" width="1" height="5"></td>
  </tr>
</table>
<?
				break;
			
			default:
				break;
		} // end switch

	} // char_menu()
	
	function char_profile()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$epi = "1";
				$birth = "Homeland";
				break;
				
			case '5':
			case '05':
				$epi = "5";
				$birth = "Birthplace";
				break;
			
			default:
				break;
		}
		
//		db_connect("zenosaga_episode".$epi);
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_data_".language()."
				  WHERE charID = '".$epi."00".$this->char_id."'";

		$result = mysql_query($query);
		
		if ($result) {
			$charData = mysql_fetch_object($result);
		}
?>
<table width="342" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="26%"><span class="nfo">Gender:</span></td>
    <td width="74%"><span class="nfo"><? echo $charData->sex; ?></span></td>
  </tr>
  <tr>
    <td width="26%"><span class="nfo">Age:</span></td>
    <td width="74%"><span class="nfo"><? echo $charData->age; ?></span></td>
  </tr>
  <tr>
    <td width="26%"><span class="nfo">Height:</span></td>
    <td width="74%"><span class="nfo"><? echo $charData->height; ?> cm</span></td>
  </tr>
  <tr>
    <td width="26%"><span class="nfo">Weight:</span></td>
    <td width="74%"><span class="nfo"><? echo $charData->weight; ?> kg</span></td>
  </tr>
  <tr>
    <td width="26%"><span class="nfo"><? echo $birth; ?>:</span></td>
    <td width="74%"><span class="nfo"><? echo $charData->birthplace; ?></span></td>
  </tr>
  <tr>
    <td width="26%"><span class="nfo">Specialty:</span></td>
    <td width="74%"><span class="nfo"><? echo $charData->specialty; ?></span></td>
  </tr>
</table>
<?	
	} // char_profile()
	
	function char_weapons()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$epi = "1";
				break;
				
			case '5':
			case '05':
				$epi = "5";
				break;
			
			default:
				break;
		}
		
//		db_connect("zenosaga_episode".$epi);
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_weapons_".get_lang()."
				  WHERE charID = $this->char_id";

		if (!$result = @mysql_query($query))
		{
			$result = @mysql_query("SELECT * FROM zenosaga_episode".$epi.".char_weapons_en
								    WHERE charID = $this->char_id");
		}
		
		if (@mysql_num_rows($result) > 1)
		{
?>
<!-- WEAPONS -->

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#000000" valign="bottom" align="center"><img src="/_imgs-st/_img-wbr.gif" width="485" height="19"></td>
  </tr>
  <tr>
    <td bgcolor="#000000" valign="top"><?	
		while ($charWeap = @mysql_fetch_object($result))
		{
?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td bgcolor="#000000">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#666666" valign="middle" align="left">
                <td width="75%" height="14"><span class="siteupdate3c">&nbsp;Weapon<br>
                  </span></td>
                <td width="25%" height="14"><span class="siteupdate3c">&nbsp;Price</span></td>
              </tr>
              <tr bgcolor="#000000">
                <td width="75%"><span class="nfo"><? echo $charWeap->weapon; ?></span></td>
                <td width="25%"><span class="nfo"><? echo $charWeap->price; ?></span></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#666666" valign="middle" align="left">
                <td width="75%" height="15"><span class="siteupdate3c">&nbsp;Description<br>
                  </b></span></td>
                <td width="25%" height="15"><span class="siteupdate3c">&nbsp;Acquire</b></span></td>
              </tr>
              <tr bgcolor="#000000">
                <td width="75%"><span class="nfo"><? echo $charWeap->descript; ?></span></td>
                <td width="25%"><span class="nfo"><? echo $charWeap->area; ?></span></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <hr width="98%" size="1" align="center">
      <?
		} // end while
?></td>
  </tr>
  <tr>
    <td><img src="/_imgs-st/tran-pix.gif" width="1" height="1"></td>
  </tr>
</table>
<?
	} else { } // end num_row
	} //char_weapons()
	
	function char_descript()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$epi = "1";
				break;
				
			case '5':
			case '05':
				$epi = "5";
				break;
			
			default:
				break;
		}
		
//		db_connect("zenosaga_episode".$epi);
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_data_".language()."
				  WHERE charID = '".$epi."00".$this->char_id."'";

		$result = @mysql_query($query);
		
		if ($result) {
			$charData = @mysql_fetch_object($result);
		}
?>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><span class=defaulttext><? echo $charData->descript; ?></span></td>
  </tr>
</table>
<br>
<?
	} // char_descript()
	
	function char_abilities()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$epi = "1";
				$wt = "WT";
				break;
				
			case '5':
			case '05':
				$epi = "5";
				$wt = "LV";
				break;
			
			default:
				break;
		}
		
//		db_connect("zenosaga_episode".$epi);
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_ability_en
				  WHERE charID = $this->char_id";

		$result = @mysql_query($query);
		
		while ($charAbil = @mysql_fetch_object($result))
		{

?>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <td valign="top" bgcolor="#254B4B" width="78%"><span class=defaulttext><? echo $charAbil->ability; ?></span></td>
    <td valign="top" bgcolor="#000000" width="10%" align="center"><b> <span class="defaulttext"><? echo $wt; ?></span> </b></td>
    <td valign="top" bgcolor="#FFFFFF" width="12%" align="center"><span class="defaulttextblack"><b>
      <? if ($epi == 1) { echo $charAbil->wt; } else { echo $charAbil->level; } ?>
      </b></span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" <? if ($this->episode == 1) { echo "valign=middle align=center rowspan=\"2\" "; } else { echo "align=top"; }?>><table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td rowspan="" <? if ($this->episode == 1) { echo "align=center"; } ?>><span class="defaulttextblack"><? echo $charAbil->range; ?></span></td>
        </tr>
      </table></td>
    <td valign="top" bgcolor="#000000" align="center"><b><span class="defaulttext">EP</span></b></td>
    <td valign="top" bgcolor="#FFFFFF" align="center"><b> <span class="defaulttextblack"> <? echo $charAbil->ep; ?> </span> </b></td>
  </tr>
  <?
	if ($this->episode == 1)
	{
?>
  <tr>
    <td valign="top" bgcolor="#000000" align="center"><b> <span class="defaulttext">EPt</span> </b></td>
    <td valign="top" bgcolor="#FFFFFF" align="center"><b> <span class="defaulttextblack"> <? echo $charAbil->level; ?> </span> </b></td>
  </tr>
  <?
	}
?>
  <tr bgcolor="#333333">
    <td valign="top" colspan="3"><table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td colspan="2"><span class="defaulttextorange"> <? echo $charAbil->descript; ?> </span></td>
        </tr>
      </table></td>
  </tr>
</table>
<br>
<?
		} // end while
	} // end char_abilities()

	function db_combo($combo)
	{
		$combo_array =  explode (",", $combo);
		
		for ($i = 0; $i < sizeof($combo_array); $i++)
		{
?>
&nbsp;<img src="/_imgs-st/-<? echo strtolower($combo_array[$i]); ?>.gif">
<?		
		} // end_for
	} // end db_combo	
	
	function char_db()
	{
		switch ($this->episode)
		{
			case '1':
			case '01':
				$epi = "1";
				break;
				
			case '5':
			case '05':
				$epi = "5";
				break;
			
			default:
				break;
		}
		
//		db_connect("zenosaga_episode".$epi);
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_deathblow_".get_lang()."
				  WHERE charID = $this->char_id";

		if (!$result = @mysql_query($query))
		{
			$result = @mysql_query("SELECT * FROM zenosaga_episode".$epi.".char_deathblow_en
				  WHERE charID = $this->char_id");
		}
		
		if (($numrows = @mysql_num_rows($result)) > 0)
		{
?>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#000000" width="100%" valign="bottom" align="center"><img src="/_imgs-st/_img-dbr.gif" width="485" height="19"></td>
  </tr>
  <tr>
    <td width="100%" valign="top"><?		
		}
		while ($charDB = @mysql_fetch_object($result))
		{	
			if (file_exists("/zenosaga.com/httpdocs/ep_0".$epi
				."/char/images/db/".$this->char_id."/".$charDB->dbID.".jpg"))
			{
				$db_image = "<img src=\"/ep_0".$epi."/char/images/db/"
				.$this->char_id."/".$charDB->dbID.".jpg\">";
			} else {
				$db_image = "<img src=\"/_imgs-st/na_db.jpg\">";
			}
				switch($epi)
				{
					case 5:
?>
      <table width="485" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td bgcolor="#000000" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#000000" width="168"><? echo $db_image; ?></td>
          <td bgcolor="#000000" width="317" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#666666" valign="middle" align="left">
                <td width="76%" height="14"><span class="siteupdate3c"> <b>&nbsp;Deathblow</b><br>
                  </span></td>
                <td width="12%" height="14"><span class="siteupdate3c"> <b>&nbsp;LV<br>
                  </b> </span></td>
                <td width="12%" height="14"><span class="siteupdate3c"> <b>&nbsp;AP<br>
                  </b> </span></td>
              </tr>
              <tr bgcolor="#000000">
                <td width="76%"><table width="99%" border="0" cellspacing="0" cellpadding="0" align="right">
                    <tr>
                      <td><span class="nfo"><? echo $charDB->deathblow; ?></span></td>
                    </tr>
                  </table></td>
                <td width="12%" align="center"><span class="nfo"><? echo $charDB->lv; ?></span></td>
                <td width="12%" align="center"><span class="nfo"><? echo $charDB->ap; ?></span></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#666666" valign="middle" align="left">
                <td width="62%" height="15"><span class="siteupdate3c"> <b>&nbsp;Element</b> <br>
                  </span></td>
                <td width="38%" height="15"><span class="siteupdate3c"> <b>&nbsp;Combo</b> <br>
                  </span></td>
              </tr>
              <tr bgcolor="#000000">
                <td width="62%"><table width="99%" border="0" cellspacing="0" cellpadding="0" align="right">
                    <tr>
                      <td><span class="nfo"><? echo $charDB->element; ?> </span></td>
                    </tr>
                  </table></td>
                <td width="38%"><span class="nfo">
                  <? $this->db_combo($charDB->combo); ?>
                  </span></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <?
						break;
				
				case 1:
?>
      <table width="485" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td bgcolor="#000000" colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td width="168" rowspan="3" align="center" valign="top" bgcolor="#000000"><? echo $db_image; ?></td>
          <td bgcolor="#000000" width="317" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#666666" valign="middle" align="left">
                <td width="62%" height="14"><span class="siteupdate3c"> <b>&nbsp;Deathblow</b> <br>
                  </span></td>
                <td height="14"><span class="siteupdate3c"> <b>&nbsp;Type</b> </span> <br></td>
                <td height="14"><span class="siteupdate3c"> <b>&nbsp;Level</b> </span> <br></td>
              </tr>
              <tr bgcolor="#000000">
                <td width="62%"><table width="99%" border="0" cellspacing="0" cellpadding="0" align="right">
                    <tr>
                      <td><span class="nfo"> <? echo $charDB->deathblow; ?> </span></td>
                    </tr>
                  </table></td>
                <td width="20%" align="center"><span class="nfo"><? echo $charDB->lv; ?> </span></td>
                <td width="18%" align="center"><span class="nfo"> <? echo $charDB->range; ?> </span></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr bgcolor="#666666" valign="middle" align="left">
                <td width="62%" height="15"><span class="siteupdate3c"> <b>&nbsp;Attribute</b> </span> <br></td>
                <td width="38%" height="15"><span class="siteupdate3c"> <b>&nbsp;Tech Requirements</b><br>
                  </span></td>
              </tr>
              <tr bgcolor="#000000">
                <td width="62%"><span class="defaulttext" style="font-size: 11px; font-weight: bold;"> <? echo $charDB->attrib; ?> </span> <br></td>
                <td width="38%"><span class="defaulttext" style="font-size: 11px;"> <b><a href="#">Requirement chart</a></b> <br>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle" bgcolor="#666666"><span class="siteupdate3c"><b>&nbsp;Details</b><br>
            </span></td>
        </tr>
        <tr>
          <td bgcolor="#000000" valign="top"><? echo $charDB->summary; ?></td>
        </tr>
      </table>
      <?
							break;
				}
				
				
		} // end while
if ($numrows > 0)
{
?></td>
  </tr>
  <tr>
    <td bgcolor="#000000" width="100%"></td>
  </tr>
</table>
<?
}
	} // end char_db()

function ether()
{
?>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#000000" width="100%" valign="bottom" align="center"><img src="/_imgs-st/_img-eth.gif" width="485" height="19"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" valign="top" align="center"><img src="/ep_01/char/images/ether/0<? echo $this->char_id; ?>.gif"></td>
  </tr>
</table>
<?
} // end ether()

function get_char_atk()
{
//		db_connect("zenosaga_episode1");
		
		$query = "SELECT * FROM zenosaga_episode".$epi.".char_normal_atk_".get_lang()."
				  WHERE charID = $this->char_id";

		if (!$result = @mysql_query($query))
		{
			$result = @mysql_query("SELECT * FROM char_normal_atk_en
				  WHERE charID = $this->char_id");
		}
		
		$atkBg = "#666666";
?>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="5" align="center" valign="bottom" bgcolor="#000000"><img src="/_imgs-st/_img-atk.gif" width="485" height="19"></td>
  </tr>
  <tr bgcolor="#040057" align="center">
    <td width="30%" valign="top">Attack</td>
    <td width="15%" valign="top">Type</td>
    <td width="15%" valign="top">Range</td>
    <td width="20%" valign="top">Attribute</td>
    <td width="20%" valign="top">Combo</td>
  </tr>
  <?
	while ($atkObj = @mysql_fetch_object($result))
	{
		if ($atkBg == "#5D5D5D")
		{
			$atkBg = "#666666";
		} else {
			$atkBg = "#5D5D5D";
		}
?>
  <tr bgcolor="<? echo $atkBg; ?>" align="center">
    <td width="30%" valign="top"><? echo $atkObj->attack; ?></td>
    <td width="15%" valign="top"><? echo $atkObj->type; ?></td>
    <td width="15%" valign="top"><? echo $atkObj->range; ?></td>
    <td width="20%" valign="top"><? echo $atkObj->attribute; ?></td>
    <td width="20%" valign="middle"><? $this->db_combo($atkObj->combo); ?></td>
  </tr>
  <?
	} // end while
?>
</table>
<?
} // end get_char_atk();

}

?>
