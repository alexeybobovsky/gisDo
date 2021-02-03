<?php
//require_once("main.inc.php");
class Message
	{
	var $Header;
	var $Type;
	var $Body;
	var $Link;
    function Message ($Type, $Header, $Body, $Link)
		{
		$Title = array('Error' => 'Ошибка', 
						'Info' => 'Информация', 
						'Quest' => 'Запрос' );
		$ImageType = array('error' => 'message/error.gif', 
									'info' => 'message/Information.gif', 
									'quest' => 'message/query.gif');
		$style = array('Error' => 'error', 
									'Info' => 'notice', 
									'Quest' => 'notice');
		$Submit = array('img' => '',
								'title' => 'Ок');
        $this->Title =  $Title[$Type];
        $this->Header =  $Header;
        $this->Type =  $Type;
        $this->Body =  $Body;
        $this->style = $style[$Type];
        $this->Link =  $Link;
		
 		}
	}
?>