<?php
session_start();
session_register('last_data');
session_register('last_data_nr');

require 'common.php';

ob_start();
$show_shouts = 10;
$timezone = 2;


//Error Reporting. ~_^
error_reporting(E_ALL);

function datef($timestamp, $fmt = 'Y.n.j G:i:s')
{
	global $timezone;
	if($timestamp < 1)
	{
		return 'no date';
	}
	return gmdate($fmt, $timestamp + $timezone*3600);
}

function formatf($user,$data,$time)
{
	$text = '<b>' . datef($time) . ' ' . $user . ': </b>' . $data . '<br />';
	$text = str_replace("\r\n", "\n", $text);
	$text = nl2br($text);
	$text = str_replace('\\\'', '\'', $text); //Without this, servers with magic quotes on would literally display \' instead of '
	$text = str_replace('\\\\', '\\', $text); //So people can post backslashes...for whatever reason
	$text = str_replace("\n", '', $text); //Temporary;
	return $text;
}

if(isset($_POST['shout']))
{
	if(empty($_POST['name']) || empty($_POST['body']))
{}	else
	{
                $time_to_add = time();
                $name_to_add = htmlentities($_POST['name']);
                $body_to_add = $_POST['body'];
		$to_add = trim(formatf($name_to_add,$body_to_add,$time_to_add));

		$content = file_get_contents('mesage.htm');
                if( empty($_SESSION['last_data']) || ($_SESSION['last_data'] != $body_to_add) || (strpos($content,$_SESSION['last_data'])===false) )
                {
			$content = $to_add . CR . $content;
			$_SESSION['last_data']=$body_to_add;
			$_SESSION['last_data_nr']=1;
                }
                else
                {
			$lines = explode(CR,$content);
			if(strpos($lines[0],$_SESSION['last_data'])!==false)
			{
				$_SESSION['last_data_nr']=$_SESSION['last_data_nr']+1;
				$lines[0]=trim(formatf($name_to_add,$body_to_add .  ' <b>(x ' . $_SESSION['last_data_nr'] . ')</b>',$time_to_add));
				$content = implode(CR,$lines);
			}
			else
			{
				$_SESSION['last_data_nr']=1;
				$content = $to_add . CR . $content;
			}
                }
		$lines = explode(CR,$content);
		$count_l = count($lines);
		while ( count($lines) > $show_shouts )
		{
		  array_pop($lines);
		}
		if ($count_l < $show_shouts+1) {array_pop($lines);} //additional lines for refresh
		if ($count_l < $show_shouts)   {array_pop($lines);} //additional lines for expires
		array_push($lines,'<meta http-equiv="Refresh" content="10">');
		array_push($lines,'<meta http-equiv="Expires" content="0">');
		$content = implode(CR,$lines);
		file_put_contents('mesage.htm', trim($content));

		$content = file_get_contents('history.htm');
                $content = $to_add . CR . $content;
		file_put_contents('history.htm', trim($content));
	}
}
header('location: mesage.htm');
die;
?>
