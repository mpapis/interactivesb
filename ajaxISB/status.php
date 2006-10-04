<?php

require 'common.php';

$status=get_value(def_status);

if (!is_array($status))
  $status = array();

$now = time();
if (isset($_REQUEST['name']))
{
  $name = $_REQUEST['name'];
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

store_value(def_status,$status_new);

$users="";

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

echo $users;

?>
