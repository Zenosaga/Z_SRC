<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// cls_walk.php - Walkthrough class definition
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the necessary functions and variables for declaring a
// walkthrough object
//
// Author: int
// Last modified: 12/01/02
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//    cls_page.php	- main Zenosaga page class constructor
//    cls_subs.php	- extended class defining gaming section page objects
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once ("/zenosaga.com/httpdocs/global/cls_page.php");
require_once ("/zenosaga.com/httpdocs/global/cls_subs.php");

class walkthru extends subsite
{
//	var $episode;
	var $walkthruID;
	var $walkthru_disc = "";
	var $walkthru_title = "";
	var $walkthru_descript = "";
	var $walkthru_checklist = "";
	var $walkthru_fmv = "0";
	var $side_bg_color = "";
	
// Prototypes
	function get_titles()
	{}

	function set_bg_color()
	{}

	function get_dialogue()
	{}
	
	function get_walkthru()
	{}
	
	function get_characters()
	{}
	
	function get_walkthru_info()
	{}
	
	function get_checklist()
	{}
	
	function get_fmv()
	{}
	
	function get_nav()
	{}

//  Connect to database
	function get_db()
	{
		db_connect("zenosaga_episode".$this->episode);
	}
	
// End Prototypes

////////////////////////////////////////////////////////////////////////////////////////////
//
// void get_titles (void)
//		Retrieves title of current game
//
////////////////////////////////////////////////////////////////////////////////////////////

	function get_titles()
	{
		$query = "SELECT * FROM zenosaga_episode".$this->episode.
					".walkthru_title WHERE status = '1'";
		$result = @mysql_query($query);
		
		while ($titleObj = @mysql_fetch_object($result))
		{
			echo '<option value="/ep_01/walkthru/?wID='.$titleObj->wID.'">'.
					$titleObj->wID.': '.$titleObj->title.'</option>
			';
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void set_bg_color (void)
//		Set BG color
//
////////////////////////////////////////////////////////////////////////////////////////////

	function set_bg_color()
	{
		switch($this->episode)
		{
			case 1:
				$this->side_bg_color = "#11005B";
				break;

			case 5:
				$this->side_bg_color = "#5B0000";
				break;
		} // end switch
	} // end set_bg_color()
	
////////////////////////////////////////////////////////////////////////////////////////////
//
// void get_dialogue (void)
//		This function is obsolete - do not use.
//
////////////////////////////////////////////////////////////////////////////////////////////


	function get_dialogue()
	{
		$query = "SELECT";
		
		switch($this->episode)
		{
			case 1:
?>

<table width='375' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td height="64" rowspan='2' align='left' valign='top' style="padding-left: 2px; padding-right: 5px; padding-top: 1px; padding-bottom: 2px;"><strong> <span style='font-family: verdana, arial; font-size: 12px; color: #FFFFFF;'> <? echo $this->walkthru_title; ?> </span> </strong> <br>
      <span style='font-family: verdana, arial; font-size: 12px; word-spacing: 1px; color: #FFFFFF;'> <? echo $this->walkthru_descript; ?> <img src='/_imgs-xs/ani-arrw.gif' width='13' height='10'> </span></td>
  </tr>
</table>
<?
				break;
				
			case 5:
?>
<table width='375' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='70' valign='top' align='center' rowspan='2' style="padding-left: 5px; padding-right: 10px;">
    <img src='/ep_0<? echo $this->episode; ?>/walkthru/images/avatar/<? echo $this->walkthruID; ?>.gif' width='64' height='64'></td>
    <td rowspan='2' align='left' valign='top' width='305' style='filter:glow(color=BLUE,strength=2);'>
    <table width='305' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td><strong> <span style='filter:glow(color=BLUE,strength=2); font-family: verdana, arial; font-size: 12px; color: #FFFFFF;'> <? echo $this->walkthru_title; ?> </span> </strong></td>
        </tr>
        <tr>
          <td valign="top">
          <span style='filter:glow(color=BLUE,strength=2); font-family: verdana, arial; font-size: 12px; word-spacing: 1px; color: #FFFFFF;'> <? echo $this->walkthru_descript; ?><img src='/_imgs-xg/ani-arrw.gif' width='12' height='7'> </span></td>
        </tr>
      </table></td>
  </tr>
</table>
<?
				break;
		} // end switch
	} // get_dialogue()

////////////////////////////////////////////////////////////////////////////////////////////
//
// void get_walkthru (void)
//		Retrieves walkthru page of current game, based on walkthruID
//
////////////////////////////////////////////////////////////////////////////////////////////
	
	function get_walkthru()
	{
		$header_array = explode(";", $this->walkthru_checklist);
		
//		db_connect("zenosaga_episode".$this->episode);
		
		$query = "SELECT *
				  FROM zenosaga_episode".$this->episode.".walkthru_disc".$this->walkthru_disc."
				  WHERE wID = $this->walkthruID
				  ORDER BY swID ASC";
		
		$result = @mysql_query($query);
		
		$counter = 1;
		
		while ($wtObj = @mysql_fetch_object($result))
		{

?>
<!-- -Walkthrough table <? echo $counter; ?> --> 
<a name="<? echo $counter; ?>"></a>
<table width="418" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" valign="top" id="walkthru_tab<? echo $this->episode; ?>" height="15"><? 
	echo $counter.".) ".$header_array[$counter-1];
?></td>
  </tr>
  <tr>
    <?
	if ($GLOBALS['images_wt'] == "1")
	{
		switch(strlen($wtObj->swID))
		{
			case 1:
				$ss = "0".$wtObj->swID;
				break;

			default:
				$ss = $wtObj->swID;
				break;
		}
?>
    <td width="108" align="center" valign="top" style="padding-top: 15px; padding-left: 5px;"><? 
	if ($this->episode == 1)
	{
?>
      <img src="/ep_01/walkthru/shots.php?ss=<? echo $ss; ?>&wID=<? echo $this->walkthruID; ?>" id="walkthru_image">
      <?
	} else {
?>
      <img src="/ep_0<? echo $this->episode; ?>/walkthru/images/shots/<? echo $this->walkthruID; ?>/<? echo $ss; ?>.jpg" id="walkthru_image">
      <?
	}
?>
      <br>
      <br>
      
      <!-- <a href="javascript:showSS('<? echo $this->walkthru_disc; ?>', '<? echo $this->walkthruID; ?>', '<? echo $ss; ?>');"><img src="/images/umn-link.gif" border="0"></a>--></td>
    <td width="9">&nbsp;</td>
    <?
	} else {
		//null
	}
?>
    <td width="301" valign="top" id="walkthru_box<? echo $this->episode; ?>"><span id="walkthru_text">
      <? 
	$map = array("triangle" 		=> "<img src=\"/images/btn-t.gif\">",
				 "Triangle" 		=> "<img src=\"/images/btn-t.gif\">",
				 "confirm button" 	=> "<img src=\"/images/btn-x.gif\"> button",
				 "Obutton"			=> "<img src=\"/images/btn-c.gif\"> button",
				 "Xbutton"			=> "<img src=\"/images/btn-x.gif\">",
				 "Square" 			=> "<img src=\"/images/btn-s.gif\">",
				 "[y]" 				=> "<span style='color: yellow; font-weight: bold;'>",
				 "[/y]" 			=> "</span>",
				 "[r]"				=> "<span style='color: red; font-weight: bold;'>",
				 "[/span]"			=> "</span>",
				 "%rare%"			=> "<img src=\"/_imgs-st/img-key.gif\" width=\"10\" height=\"10\">",
				 "%key%"			=> "<img src=\"/_imgs-st/img-tip.gif\" width=\"15\" height=\"15\">");
	
	echo strtr(nl2br($wtObj->walkthru), $map);
?>
      <br>
      </span></td>
  </tr>
</table>
<br>

<!-- // Walkthrough table -->
<?
		$counter++;
			} // end while
	} // get_walkthru()

////////////////////////////////////////////////////////////////////////////////////////////
//
// void get_characters (void)
//		Retrieves all the playable characters from the current chapter of the walkthrough
//
////////////////////////////////////////////////////////////////////////////////////////////


	function get_characters()
	{
//		db_connect("zenosaga_episode".$this->episode);
		
		$query = "SELECT sequence
				  FROM zenosaga_episode".$this->episode.".walkthru_playable_chars
				  WHERE wID = '$this->walkthruID'";
		
		$result = @mysql_query($query);
		$row_result = @mysql_result($result, 0);
		
		$row_explode = @explode(",", $row_result);
		
		switch ($this->episode)
		{
			case '1':
				$map = array('1'=>'5', '2'=>'3', '3'=>'1', '4'=>'6', '5'=>'4', '6'=>'2');
				break;
				
			case '5':
				$map = array('1'=>'6', '2'=>'4', '3'=>'3', '4'=>'1', '5'=>'8', '6'=>'2', '7'=>'7', 
								'8'=>'9', '9'=>'5');
				break;
		}
		
		for ($i=0; $i < sizeof($row_explode); $i++)
		{
			$mapped = strtr($i+1, $map);

			switch($row_explode[$i])
			{
				case 0:
						echo "<a href=\"http://www.zenosaga.com/ep_0".
								$this->episode."/char/?charID=".$mapped."\">";
						echo "<img src=\"/ep_0".$this->episode."/walkthru/images/0_0".
								($i+1).".gif\" width=\"32\" height=\"32\" border=\"0\"></a><br>";
					break;
				
				default:
						echo "<a href=\"http://www.zenosaga.com/ep_0".$this->episode.
								"/char/?charID=".$mapped."\">";
						echo "<img src=\"/ep_0".$this->episode."/walkthru/images/1_0".($i+1).
								".gif\" width=\"32\" height=\"32\" border=\"0\"></a><br>";
					break;
			} // end switch
		} // end for
	} // end get_characters()

	function get_walkthru_info()
	{
//		db_connect("zenosaga_episode".$this->episode);
		
		$query = "SELECT *
				  FROM zenosaga_episode".$this->episode.".walkthru_title
				  WHERE wID = '$this->walkthruID'";
		
		$result = @mysql_query($query);
		
		$this->walkthru_title = @mysql_result($result, 0, "title");
		$this->walkthru_descript = @mysql_result($result, 0, "descript");
		$this->walkthru_checklist = @mysql_result($result, 0, "checklist");
		$this->walkthru_fmv = @mysql_result($result, 0, "fmv");
	} // end get_walkthru_info()

	function get_checklist()
	{
		$checklist = explode(";", $this->walkthru_checklist);
		
		$counter = 0;
		while ($counter < sizeof($checklist))
		{
			echo "<li><a href=\"#".($counter+1)."\">".$checklist[$counter]."</a></li>";
			$counter++;
		} // end while
	} // end get_checklist()
	
	function get_fmv()
	{
		if ($this->walkthru_fmv == "1")
		{
?>
<div style="position:absolute; width:105px; height:115px; z-index:10; left: 663px; top: 233px; visibility: visible">
  <div align="center">
    <p><img src="/ep_0<? echo $this->episode; ?>/walkthru/images/shots/<? echo $this->walkthruID; ?>/fmv/01.jpg"></p>
    <p><img src="/ep_0<? echo $this->episode; ?>/walkthru/images/shots/<? echo $this->walkthruID; ?>/fmv/02.jpg"></p>
    <p><img src="/images/go-fmv.gif" width="28" height="22"></p>
  </div>
</div>
<?		} else {
		}
	} // end get_fmv()
	
	function get_nav()
	{
		if (($this->walkthruID < 9) || ($this->walkthruID == 10))
		{
			$pad = "0";
		} else {
			$pad = "";
		}

		switch($this->episode)
		{
			case '1':
//				db_connect("zenosaga_episode".$this->episode);
		
				$query = "SELECT *
						  FROM zenosaga_episode".$this->episode.".walkthru_title
						  WHERE wID = '$this->walkthruID
						  AND dID = $this->walkthru_disc'";
				
				$result = @mysql_query($query);
				$numrow = @mysql_num_rows($result);
				
				if (($this->walkthruID) == 1)
				{
					echo '<img src="/images/btn-wt1-.gif" border="0"> &nbsp;&nbsp; <a href="/ep_01/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_01/walkthru/?wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
				} elseif ((($this->walkthruID) >= 1) && ($this->walkthruID <= 6)) {
					echo '<a href="/ep_01/walkthru/?wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_01/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_01/walkthru/?wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
				}  else {
					echo '<a href="/ep_01/walkthru/?wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_01/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <img src="/images/btn-wt2-.gif" border="0">';
				}
				
				break;
			
			case '5':
				switch ($this->walkthru_disc)
				{
					case '1':
						if (($this->walkthruID) == 1)
						{
							echo '<img src="/images/btn-wt1-.gif" border="0"> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?dID=1&wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
						} elseif ((($this->walkthruID) >= 2) && ($this->walkthruID <= 48)) {
							echo '<a href="/ep_05/walkthru/?dID=1&wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?dID=1&wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
						} elseif ((($this->walkthruID) >= 2) && ($this->walkthruID > 48)) {
							echo '<a href="/ep_05/walkthru/?dID=1&wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?dID=2&wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
						} else {
							echo '<a href="/ep_05/walkthru/?dID=1&wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <img src="/images/btn-wt2.gif" border="0">';
						}
						
						break;
					
					case '2':
						if (($this->walkthruID) == 49)
						{
							echo '<a href="/ep_05/walkthru/?dID=1&wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?dID=2&wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
						} elseif ((($this->walkthruID) >= 50) && ($this->walkthruID < 59)) {
							echo '<a href="/ep_05/walkthru/?dID=2&wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?dID=2&wID='.$pad.($this->walkthruID+1).'"><img src="/images/btn-wt2.gif" border="0"></a>';
						} else {
							echo '<a href="/ep_05/walkthru/?dID=2&wID='.$pad.($this->walkthruID-1).'"><img src="/images/btn-wt1.gif" border="0"></a> &nbsp;&nbsp; <a href="/ep_05/walkthru/?"><img src="/images/btn-wt0.gif" border="0"></a> &nbsp;&nbsp; <img src="/images/btn-wt2-.gif" border="0">';
						}
						
						break;
											
				} // end switch
				
				break;

		} // end switch
	} // end get_nav()
	
	function get_items()
	{
		$query = "SELECT *
				  FROM zenosaga_episode".$this->episode.".walkthru_items
				  WHERE wID = '$this->walkthruID'
				  AND dID = '$this->walkthru_disc'";
		
		$result = @mysql_query($query);
		$result2= @mysql_result($result,0, "items");
		
		$numrows = @mysql_num_rows($result);
		
		if ($numrows > 0)
		{
			return $result2;
		} else {
			return false;
		}
	}
	
	function parse_bestiary($eID)
	{
		db_connect();
		
		$query = "SELECT * FROM zenosaga_episode".$this->episode.".bestiary_en WHERE eID = '".$eID."'";
		$result = @mysql_query($query);
		
		$enemyObj = @mysql_fetch_object($result);

		return $enemyObj;
	} // end parse_bestiary();
	
	function get_bestiary()
	{

		switch($this->episode)
		{
			case '1':
			case '01':
				$file = "/zenosaga.com/httpdocs/templates/ep1_bestiary.php";
				$fh = fopen($file, "r");
				$template = fread($fh, filesize($file));
				fclose($fh);
				
				$query = "SELECT * FROM zenosaga_episode1.walkthru_bestiary WHERE wID = '".$this->walkthruID."'";
				$result = mysql_query($query);
				$total = mysql_num_rows($result);
				
				//////////////////////// BESTIARY
				
				if ($total > 0)
				{
					$enemyObj = @mysql_fetch_object($result);
					$e_list = $enemyObj->enemies;
						
//					$e_list = @mysql_result($result, 0, "enemies");
				
					$e_array = @explode(",", $e_list);
				
					$i = 0;

					while ($i < sizeof($e_array))
					{
						$enemyInfo = $this->parse_bestiary($e_array[$i]);
						$map =  array ("%%%NAME%%%"			=> $enemyInfo->name,
										"%%%IMAGE%%%" 			=> "<img src=\"/global/gfx/bestiary.php?episode=".
																	$this->episode."&filename=".$enemyInfo->filename."\">",
										"%%%HP%%%" 			=> $enemyInfo->hp,
										"%%%EXP%%%"	 		=> $enemyInfo->exp,
										"%%%GOLD%%%" 			=> $enemyInfo->money,
										"%%%TPT%%%"	 		=> $enemyInfo->tpt,
										"%%%SPT%%%"	 		=> $enemyInfo->spt,
										"%%%EPT%%%"	 		=> $enemyInfo->ept,
										"%%%ITEM_NORMAL%%%"	=> $enemyInfo->item_normal,
										"%%%ITEM_RARE%%%" 		=> $enemyInfo->item_rare,
										"%%%NOTES%%%" 			=> $enemyInfo->weakness);

						$replace .= strtr($template, $map);
						$i++;
					} // end while
					echo $replace;
				}
			
				break;

			case '5':
				break;
			
			default:
				break;
		} // end switch
	} // end get_bestiary();
	
	function get_treasures()
	{
//		db_connect("zenosaga_episode".$this->episode);
		
		$query = "SELECT *
				  FROM zenosaga_episode".$this->episode.".items_treasures
				  WHERE wID = '$this->walkthruID'
				  ORDER BY item ASC";
		
		$result = @mysql_query($query);
		
		$numrows = @mysql_num_rows($result);
		
		if ($numrows != 0)
		{
			while ($treaObj = @mysql_fetch_object($result))
			{
				switch($treaObj->rare)
				{
					case 1:
						$rare = "<img src=\"/_imgs-st/img-key.gif\">&nbsp;";
						break;
						
					default:
						$rare = "";
						break;
				}
?>
<tr>
  <td colspan="2" align="left" valign="top" id="item_name"><? echo $rare.$treaObj->item; ?></td>
</tr>
<tr>
  <td colspan="2" align="left" valign="top" id="item_explain"><? echo eregi_replace(";", "<br>", $treaObj->descript); ?></td>
  <?
			} // end while
		} else {
?>
  <td colspan="2" align="left" valign="top" style="filter:glow(color=BLUE,strength=2)"><span style='font-family: verdana, arial; font-size: 12px; word-spacing: 1px; color: #FFFFFF;'> Not available </span></td>
  <?		
		} // end if
	} // end get_treasures
	
	function get_daggers()
	{
		$query = "SELECT *
				  FROM zenosaga_episode".$this->episode.".walkthru_title
				  WHERE wID = '$this->walkthruID'";
		
		$result = mysql_query($query);
		$daggerObj = mysql_fetch_object($result);
		
		if($daggerObj->dagger != 0)
		{
			echo '<a href="http://www.zenosaga.com/daggers/script.php?eID='.$this->episode.'&sID='.$daggerObj->dagger.'"><img src="/images/ico_dagr.gif" height="32" border="0"></a>';
		}
	}
	
} // CLASS WALKTHRU

	function get_title($ep, $wID)
	{
		$query = "SELECT title FROM zenosaga_episode".$ep.".walkthru_title WHERE wID = ".$wID."";
		$result = @mysql_query($query);
		return mysql_result($result, 0, 'title');
	}
?>
