<?PHP

error_reporting(E_ALL);

require 'mycached.php';

define('TAB', "\t");
define('CR', "\n");
define('def_messages',3);
define('def_status',2);

$show_shouts = 14;

if(!function_exists('file_put_contents'))
{
	function file_put_contents($filename, $data)
  	{
    	if(($h = @fopen($filename, 'w')) === false)
    	{
      		return false;
  		}
    	if(($bytes = @fwrite($h, $data)) === false)
    	{
      		return false;
  		}
    	fclose($h);
    	return $bytes;
  	}
}

if(!function_exists('file_get_contents'))
{
	function file_get_contents($filename)
	{
		return implode('', file($filename));
	}
}

function datef($timestamp, $fmt = 'G:i:s') //Y.n.j  G:i:s
{
	if($timestamp < 1)
	{
		return 'no date';
	}
	return date($fmt, $timestamp);
}

function formatf($text)
{
	$text = str_replace("\r\n", "\n", $text);
	$text = nl2br($text);
	$text = str_replace('\\\'', '\'', $text); //Without this, servers with magic quotes on would literally display \' instead of '
	$text = str_replace('\\\\', '\\', $text); //So people can post backslashes...for whatever reason
	$text = str_replace("\n", '', $text); //Temporary;
	return trim($text);
}

function formatfall($time_to_add,$name_to_add,$body_to_add)
{
    return "<b>".$time_to_add." ".$name_to_add.":</b> ".$body_to_add."<br />";
}

?>
