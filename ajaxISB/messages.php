<?php

require 'common.php';

//Error Reporting. ~_^
//error_reporting(E_ALL);

$content = get_value(def_messages);
if (!is_array($content)) $content = array();
foreach($content as $nr => $line)
{
  $line1 = explode(TAB,$line);
  echo(formatfall($line1[0],$line1[1],$line1[2]));
}
?>
