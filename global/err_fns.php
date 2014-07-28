<?
////////////////////////////////////////////////////////////////////////////////////////////
//
// err_fns.php - Standard error function
//
////////////////////////////////////////////////////////////////////////////////////////////
// 
// This file contains standard related functions.
//
// Author: int
// Last modified: 03/11/02
// 
////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////
//
// void membersonly (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//		Prints toplogo images
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//		Not available
//
// Usage:
//   	This function prints a standard error message indicating page the user is attempting
//		to view is for registered members only.
//
////////////////////////////////////////////////////////////////////////////////////////////

function membersonly()
{
  $membersonly = new page("Members only!");
?>
<p>
  
  <!-- BEGIN LOGIN MESSAGE -->
  
<table width="770" border="0" cellspacing="2" cellpadding="0" bgcolor="#000000">
  <tr>
    <td bgcolor="#000000"><table width="100%" border="0" cellspacing="2" cellpadding="10" bgcolor="#343434" align="center">
        <tr>
          <td><p><span class=defaulttext>You are attempting to access an area that is only available to 
              registered members. If you are getting this error message, then it can be one of two things. 
              You are not logged in, or you are not a registered member.</span></p>
            <p><span class=defaulttext>If you are a registered member, simply log in below:</span></p>
            <form action=process.php method=post>
              <table width="50%" border="0" cellspacing="1" cellpadding="0" align="center">
                <tr>
                  <td><b><span class=defaulttext>Username</span></b></td>
                  <td><b><span class=defaulttext>Password</span></b></td>
                </tr>
                <tr>
                  <td><?
if (isNetscape())
{
echo("<input type=text name=username size=6 class=email>");
} else {
echo("<input type=text name=username size=14 class=email>");
}
?></td>
                  <td><?
if (isNetscape())
{
echo("<input type=password name=password size=6 class=email>");
} else {
echo("<input type=password name=password size=14 class=email>");
}
?></td>
                </tr>
              </table>
            </form>
            <p><span class=defaulttext>If you are not a registered member, please 
              take your time to register. It is easy and it is completely free!</span></p>
            <p align="center"><span class=defaulttext><a href=<? echo GLOBALURL ?>register.php?action=register>REGISTER</a></span></p></td>
        </tr>
      </table></td>
  </tr>
</table>

<!-- //END LOGIN MESSAGE -->

<?
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void standarderror (str $message, str $sitemessage = "Site Message")
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//   Not available
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
// 		$message		-	Title for error box
//		$sitemessage	-	Main error message	
//
// Usage:
//		This is the main standard error output function. It draws a box with $message as the
//		title and $sitemessage as the main error message.
//
////////////////////////////////////////////////////////////////////////////////////////////

function standarderror($message, $sitemessage = "Site Message")
{
?>
<br>
<table width="770" border="0" cellspacing="1" cellpadding="10">
  <tr>
    <td bgcolor="#3F3F3F"><div align=center>
        <table width="500" border="0" cellspacing="1" cellpadding="10">
          <tr>
            <td bgcolor="#368600"><div align=center><span class=headline><? echo $sitemessage; ?></span></div></td>
          </tr>
          <tr>
            <td bgcolor="#494949"><p><span class=defaulttext><? echo $message; ?></span></p></td>
          </tr>
        </table>
      </div></td>
  </tr>
</table>
<p>
  
  <!-- //END INTRO MESSAGE -->
  
  <?
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void upgradebrowser (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//		Not available
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//		Not available
//
// Usage:
//   	This function prints a standard error message instructing the user to upgrade their
//		browser.
//
////////////////////////////////////////////////////////////////////////////////////////////

function upgradebrowser()
{
?>
<html>
<head>
<title>Upgrade your browser</title>
<link rel="stylesheet" href="http://www.zenosaga.com/global/css.php" type="text/css">
</head>
<body bgcolor="#000000">
<div align=center> <font face=Arial size=6 color=yellow> Upgrade your browser </font>
  <p> <span class=defaulttext> You are currently using an older browser.  To experience <b>The 'ETHOS' Sanctuary</b> to its fullest potential, we
    suggest that you download and view the site with a version 5.0 or higher browser (e.g. Internet Explorer 5.5,
    Opera 5, Netscape 6). </span></p>
  <p> <span class=defaulttext> This site was <b>NOT</b> designed with <i>Netscape Navigator 4.7x</i> users in mind.  If you are a big fan of 
    Netscape, grab yourself a copy of the latest Netscape Mozilla 6.x browser at <a href="http://www.netscape.com" target=_blank>http://www.netscape.com</a>. </span> </p>
  <p> <span class=defaulttext> Finally, the entirety of this web site is optimized for Internet Explorer 6.0.  For the best experience, we suggest
    you head over to <a href="http://www.microsoft.com" target=_blank>Microsoft</a> and download the latest version of
    Internet Explorer.  If you are a Microsoft-hater, well, you are out of luck =P.</p>
  </span> </div>
</body>
</html>
<?
exit;
}

////////////////////////////////////////////////////////////////////////////////////////////
//
// void check_referer (void)
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Return value:
//		Not available
//
////////////////////////////////////////////////////////////////////////////////////////////
//
// Parameter:
//		Not available
//
// Usage:
//   	Sometimes the server need to check and see if resources being accessed are directly
//		referred by Zenosaga.com and not hotlinked from an external source. This is a basic
//		function that checks for source referral and used on resource extensive section of
//		the site, such as the download pages.
//
////////////////////////////////////////////////////////////////////////////////////////////

function check_referer()
{
if (!stristr(getenv("HTTP_REFERER"), "zenosaga.com")) {

$news = new page("Search results");

$news->body();
$news->epchannel();
$news->topmenu();
$news->mainlogo();
$news->subsitemenu(0);

	standarderror ("Unable to process your request from your current location.  Please press your
					browser's back button and try again.
					
					<p>
					If the problem persists, please contact the <a href='mailto:webmaster@zenosaga.com?subject=Referral Problems (".$GLOBALS['HTTP_REFERER'].")'>webmaster</a>.
					</p>");

$news->printfooter();
$news->printmaps();
	exit;
}
}
?>
