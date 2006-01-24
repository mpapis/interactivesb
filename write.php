<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>ShoutBox</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
</head>
<?php
if (preg_match("/MSIE/i", "$useragent"))
{
echo '<body onload="document.all.body_.focus();">
';
}
else
{
echo '<body onload="document.writeform.body_.focus();">
';
}
$useragent = getenv("HTTP_USER_AGENT");

if (preg_match("/MSIE/i", "$useragent"))
{
  $post_script = 'document.all.body.value=document.all.body_.value; document.all.body_.value=\'\';';
}
else
{
  $post_script = 'document.writeform.body.value=document.writeform.body_.value; document.writeform.body_.value=\'\';';
}

if(isset($_REQUEST['name']))
{
echo '<form name="writeform" action="mesage.php?name=' . $_REQUEST['name'] . '" method="post" target="msg" style="border: none" onsubmit="' . $post_script . '">
';
echo '  <input type="hidden" name="name" value="' . $_REQUEST['name'] . '" id="name" />
';
}
else
{
echo '<form name="writeform" action="mesage.php" method="post" target="msg" style="border: none" onsubmit="' . $post_script . '">
';
echo '  User:<input type="text" name="name" value="" size="23" id="name" onclick="if (this.value==\'Name\') this.value = \'\';" />
';
}
?>
  <input type="text" name="body_" value="" size="50" maxsize="200" style="width:100%" id="body_" onclick="if (this.value=='Message') this.value = '';" />
  <input type="hidden" name="body" value="" id="body" readonly="false" />
  <input type="hidden" name="shout" />
</form>
</body>
</html>
