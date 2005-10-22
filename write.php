<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>ShoutBox</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<body><?php
$useragent = getenv("HTTP_USER_AGENT");

if(isset($_REQUEST['name']))
{
  if (preg_match("/MSIE/i", "$useragent"))
  {
    echo '		<form name="writeform" action="mesage.php?name=' . $_REQUEST['name'] . '" method="post" target="msg" style="border: none" >';
  }
  else
  {
    echo '		<form name="writeform" action="mesage.php?name=' . $_REQUEST['name'] . '" method="post" target="msg" style="border: none" onsubmit="document.writeform.body.value=document.writeform.body_.value; document.writeform.body_.value=\'\';">';
  }
  echo '			<input type="hidden" name="name" value="' . $_REQUEST['name'] . '" id="name" />';
}
else
{
  if (preg_match("/MSIE/i", "$useragent"))
  {
    echo '		<form name="writeform" action="mesage.php" method="post" target="msg" style="border: none" >';
  }
  else
  {
    echo '		<form name="writeform" action="mesage.php" method="post" target="msg" style="border: none" onsubmit="document.writeform.body.value=document.writeform.body_.value; document.writeform.body_.value=\'\';">';
  }
  echo '			User:<input type="text" name="name" value="" size="23" id="name" onclick="if (this.value==\'Name\') this.value = \'\';" />';
}

if (preg_match("/MSIE/i", "$useragent"))
{
echo '			<input type="text" name="body" value="" size="50" maxsize="200" style="width:100%" id="body" onclick="if (this.value==\'Message\') this.value = \'\';" />
			<button accesskey="C" name="clear" type=reset><ins>C</ins>zysc</button>
			<input type="hidden" name="shout" />';
}
else
{
echo '			<input type="text" name="body_" value="" size="50" maxsize="200" style="width:100%" id="body_" onclick="if (this.value==\'Message\') this.value = \'\';" />
			<input type="hidden" name="body" value="" id="body" readonly="false" />
			<input type="hidden" name="shout" />';
}
echo '</form>';
?>
</body>
</html>
