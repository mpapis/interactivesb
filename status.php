<script language=JavaScript>
function addUser(name)
{
  window.parent.frames[0].document.writeform.elements[1].value+=" "+name;
  return false;
}
</script>

<?php

require 'common.php';

$status_dat = file_get_contents('status.dat');
$status = explode(CR,$status_dat);
$now = time();
if (isset($_GET['name']))
{
  $name = $_GET['name'];
}
else
{
  $name = 'gosc';
}

foreach($status as $nr => $stat)
{
  if (strpos($stat,$name)!==false)
  {
    $status[$nr]=$name . TAB . $now;
    $exists=true;
    break;
  }
}
if ($exists!==true)
{
  array_push($status,$name . TAB . $now);
}

$status_new = array();

foreach($status as $nr => $stat)
{
  $params = explode(TAB,$stat);
  if ($params[1]>$now-60)
  {
      array_push($status_new,$stat);
  }
}

$status_dat = implode(CR,$status_new);
file_put_contents('status.dat',$status_dat);

foreach($status_new as $nr => $stat)
{
  $params = explode(TAB,$stat);
  if ($params[1]<$now-11)
  {
    $sec_nr = $now-$params[1];
    $sec = '(' . $sec_nr . ')';
  }
  else
  {
    $sec = '';
  }
  $users .= '<a href="#" onClick="addUser(\'' . $params[0] . '\')">' . $params[0] . '</a>' . $sec . ',<br>';
}

echo '<b>U¿ytkownicy:</b><br /> ' . $users;
?>
<meta http-equiv="Refresh" content="10">
<meta http-equiv="Expires" content="0">

