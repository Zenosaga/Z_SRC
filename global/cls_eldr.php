<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// cls_eldr.php - Class constructor for Eldridge Skyline colonies.
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains all the page constructor for individual Skyline profile pages.
//
// Author: int
// Last modified: 12/26/01
// 
////////////////////////////////////////////////////////////////////////////////////////////
//
// Require once:
//		cls_page.php		- main Zenosaga page class constructor
//
////////////////////////////////////////////////////////////////////////////////////////////
//
//	*** ADDITIONAL NOTES ***
//		This page was never completed. The code was never completed. This file only contains
//		the work I started and left to stagnant due to other projects withi Z. The grand 
//		scope of the Eldridge Skyline is to allow user to select a planet within the Milky 
//		Way Galaxy, "colonize it," and develop. Would've been cool if I actually finished it
//		can could turned into one of the very early form of social media networking.
//
////////////////////////////////////////////////////////////////////////////////////////////

require_once("/zenosaga.com/httpdocs/global/cls_page.php");

class eldridge extends page
{
	var $title_one;
	var $title_two;
	var $title_three;
	
	var $content_one;
	var $content_two;
	var $content_three;
	
	function side_panel ($top, $middle, $lower)
	{
		$this->title_one   = $top;
		$this->title_two   = $middle;
		$this->title_three = $lower;
?>

<table width="265" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td bgcolor="#006699" width="265"><div align="center"> <img src="http://www.zenosaga.com/_img-umn/tabs/_00-main.gif"> </div></td>
  </tr>
  <tr>
    <td bgcolor="#006699" width="265"><table width="100%" border="0" cellspacing="1" cellpadding="0" align="center">
        <tr>
          <td bgcolor="#000000" width="264"><div align="right"> 
              
              <!-- ONE TABLE PANEL -->
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#333333"><div align="right">
                      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="headline"> <? echo $this->title_one; ?> </span></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
                <tr>
                  <td bgcolor="#1F1F1F"><div align="right">
                      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="subsite"> Welcome to the Eldridge Skylines, TES' hosting service.  To your left occupies the
                            map of the Milky Way.  Select an "arm" to find vacant planets to colonize.  There are
                            a total of 7 vacant planets to choose from and the number of planets will grow as
                            TES expands. </span></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table>
              
              <!-- // END ONE TABLE PANEL --> 
              
              <br>
              
              <!-- TWO TABLE PANEL -->
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#333333"><div align="right">
                      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="headline"> <? echo $this->title_two; ?> </span></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
                <tr>
                  <td bgcolor="#1F1F1F"><div align="right">
                      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="subsite"> <b>Cygnus Arm</b><br>
                            There are four explored nebulae in this sector and five habital 
                            planets within the four nebulae quadrants. </span></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table>
              
              <!-- // END TWO TABLE PANEL --> 
              
              <br>
              
              <!-- THREE TABLE PANEL -->
              
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#333333"><div align="right">
                      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="headline"> <? echo $this->title_three; ?> </span></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
                <tr>
                  <td bgcolor="#1F1F1F"><div align="right">
                      <table width="97%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><span class="subsite"> <img src="http://www.zenosaga.com/_img-umn/clusters/_cygnus.jpg"> </span></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table>
              
              <!-- // END THREE TABLE PANEL --> 
              
            </div></td>
        </tr>
      </table></td>
  </tr>
</table>
<?	
	} // END SIDE_PANEL
	
	function show_nebula($nebula)
	{
		switch ($nebula)
		{
			case 'ng_6231':
?>
<table width="500" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000">
  <tr valign="top" align="left">
    <td colspan="3"><img src="/_img-umn/nebulae/sagi/ngc_6231_1.jpg" width="500" height="35"></td>
  </tr>
  <tr valign="top" align="left">
    <td width="369"><img src="/_img-umn/nebulae/sagi/ngc_6231_2.jpg" width="369" height="20"></td>
    <td width="20"><img src="/_img-umn/blinker.gif" width="20" height="20"></td>
    <td width="111"><img src="/_img-umn/nebulae/sagi/ngc_6231_4.jpg" width="111" height="20"></td>
  </tr>
  <tr valign="top" align="left">
    <td colspan="3"><img src="/_img-umn/nebulae/sagi/ngc_6231_3.jpg" width="500" height="245"></td>
  </tr>
</table>
<?				break;

			case 'carina':
?>
<table width="500" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000">
  <tr valign="top" align="left">
    <td colspan="3"><img src="/_img-umn/nebulae/sagi/carina1.jpg" width="500" height="221"></td>
  </tr>
  <tr valign="top" align="left">
    <td width="369"><img src="/_img-umn/nebulae/sagi/carina2.jpg" width="363" height="20"></td>
    <td width="20" background="/_img-umn/nebulae/sagi/carina5.jpg"><img src="/_img-umn/blinker.gif" width="20" height="20"></td>
    <td width="111"><img src="/_img-umn/nebulae/sagi/carina4.jpg" width="117" height="20"></td>
  </tr>
  <tr valign="top" align="left">
    <td colspan="3"><img src="/_img-umn/nebulae/sagi/carina3.jpg" width="500" height="59"></td>
  </tr>
</table>
<?			
				break;

			case 'pleroma':
?>
<table width="500" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000">
  <tr valign="top" align="left">
    <td colspan="3"><img src="/_img-umn/nebulae/sagi/omega1.jpg" width="500" height="188"></td>
  </tr>
  <tr valign="top" align="left">
    <td width="369"><img src="/_img-umn/nebulae/sagi/omega2.jpg" width="376" height="20"></td>
    <td width="20" background="/_img-umn/nebulae/sagi/omega5.jpg"><img src="/_img-umn/blinker.gif" width="20" height="20"></td>
    <td width="111"><img src="/_img-umn/nebulae/sagi/omega4.jpg" width="104" height="20"></td>
  </tr>
  <tr valign="top" align="left">
    <td colspan="3"><img src="/_img-umn/nebulae/sagi/omega3.jpg" width="500" height="92"></td>
  </tr>
</table>
<?			
				break;
				
			case 'm24':
?>
<table width="500" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000">
  <tr align="left">
    <td valign="bottom"><div align="left"><img src="/_img-umn/nebulae/sagi/m241.jpg"></div></td>
  </tr>
  <tr align="left">
    <td valign="top" background="/_img-umn/nebulae/sagi/m243.jpg"><div align="left"><img src="/_img-umn/nebulae/sagi/m242.jpg"><img src="/_img-umn/blinker.gif"><img src="/_img-umn/nebulae/sagi/m244.jpg" width="441" height="20"></div></td>
  </tr>
  <tr align="left">
    <td valign="top"><div align="left"><img src="/_img-umn/nebulae/sagi/m245.jpg"></div></td>
  </tr>
  <tr align="left">
    <td background="/_img-umn/nebulae/sagi/m247.jpg" valign="top"><div align="left"><img src="/_img-umn/nebulae/sagi/m246.jpg"><img src="/_img-umn/blinker.gif"><img src="/_img-umn/nebulae/sagi/m248.jpg"></div></td>
  </tr>
  <tr align="left">
    <td valign="top"><div align="left"><img src="/_img-umn/nebulae/sagi/m249.jpg"></div></td>
  </tr>
</table>
<?
				break;
				
			default:
				break;
		} // END SWITCH

	}  // END SHOW_NEBULA

} // END CLASS ELDRIDGE

?>
