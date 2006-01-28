<?php

require 'common.php';
require 'mycached.php';

$status_dat=get_value('user_status_var');
$status=explode(CR,$status_dat);

if (!isset($status)) 
  $status = array();

$now = time();
if (isset($_GET['name']))
{
  $name = $_GET['name'];
}
else
{
  $name = 'Admin/Guest';
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

$status_dat = implode(CR, $status_new);
store_value('user_status_var',$status_dat);

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
  $users .= $params[0] . '' . $sec . ',<br>';
}

echo '<b>U¿ytkownicy:</b><br /> ' . $users . '
<meta http-equiv="Refresh" content="5">
<meta http-equiv="Expires" content="0">
';

?>
