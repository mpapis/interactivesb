<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>ShoutBox</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<?php
  if(isset($_REQUEST['name']))
  {
    echo '
<frameset rows="30,*,20" >
	<frame name="write" src="write.php?name=' . $_REQUEST['name'] . '" scrolling="no" marginheight="1" noresize />
	<frame name="msg" src="mesage.htm" scrolling="auto" marginheight="5"  />
	<frame name="status" src="status.php?name=' . $_REQUEST['name'] . '" marginheight="1"/>
</frameset>';
  }
  else
  {
    echo '
<frameset rows="30,*,20" >
	<frame name="write" src="write.php" scrolling="no" marginheight="1" noresize />
	<frame name="msg" src="mesage.htm" scrolling="auto" marginheight="5"  />
	<frame name="status" src="status.php" marginheight="1"/>
</frameset>';
  }
?>
</html>
