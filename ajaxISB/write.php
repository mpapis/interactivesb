<?php

session_start();
session_register('last_data');
session_register('last_data_nr');

require 'common.php';

//if(isset($_GET['shout']))
{
	if(empty($_GET['name']) || empty($_GET['body']))
	{
		echo("Błąd");
	}
        else
	{
                $time_to_add = datef(time());
                $name_to_add = formatf($_GET['name']);
                $body_to_add = formatf($_GET['body']);

		$content = get_value(def_messages);
                if (!is_array($content)) $content = array();

                if( empty($_SESSION['last_data']) || ($_SESSION['last_data'] != $body_to_add) || ($content[0][2]!=$_SESSION['last_data']) )
                {
			array_unshift($content,$time_to_add.TAB.$name_to_add.TAB.$body_to_add);
			$_SESSION['last_data']=$body_to_add;
			$_SESSION['last_data_nr']=1;
                }
                else
                {
			$_SESSION['last_data_nr']=$_SESSION['last_data_nr']+1;
			$line1 = explode(TAB,$content[0]);
			$line1[0]=$time_to_add;
			$line1[2]=$body_to_add . ' <b>(x ' . $_SESSION['last_data_nr'] . ')</b>';
			$content[0] = $line1[0] . ":" . $line1[0] . ":" . $line1[0];
                }

		$count_l = count($content);
		while ( count($content) > $show_shouts )
		{
		  array_pop($content);
		}
		store_value(def_messages, $content);

		$content = file_get_contents('history.htm');
                $content = formatfall($time_to_add,$name_to_add,$body_to_add) . CR . $content;
		file_put_contents('history.htm', trim($content));
		echo("OK");
	}
}
?>
