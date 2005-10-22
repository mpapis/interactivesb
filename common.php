<?PHP

define('TAB', "\t");
define('CR', "\n");

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

?>