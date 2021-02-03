<?php
class logClass  extends TEMPLATE  
	{
	var $last_query;
	
/******************TEMPLATE***********************************************************************/	
	function TPL_ShowLogTypeSelect($typeArr, $location)/*2009_11_09  Список выбора журнала*/
		{
		$event = 'if (this.value != "'.$typeArr['default'].'") {document.getElementById("SUBMITTYPE").disabled = false; } else {document.getElementById("SUBMITTYPE").disabled = true;}';
		$table = array('bodyId' => 'productAdd');		
		$form = array('elementCaption' => array('Тип журнала'));
		$ar[] = array('name' => 'TYPEADD', 
					'id' => 'TYPEADD', 
					'type' => 'select', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => $event, 
					'default' => $typeArr['default'],
					'value' => $typeArr['value'], 
					'caption' => $typeArr['text']);	
		$ar[] = array('name' => 'SUBMITTYPE', 
					'id' => 'SUBMITTYPE', 
					'type' => 'button', 
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'selectLog();', 
					'disabled' => 1,
					'value' => 'Показать');		
		$ar[] = array('name' => 'actionSelectLog', 
					'id' => 'actionSelectLog', 
					'type' => 'hidden', 
					'default' => $location);			
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		return $full_ret;
		}	
		
/******************GETTERS***********************************************************************/	
	function GET_LogContent($src, $colums)
		{
		$maxLenStr = 20;
		$lines = file($src);
		if($lines)
			{
			$content = array();
			for($i=0; $i< count($lines); $i++)				
				{
				$tmpArr = array();
				$tmpArr = explode('	', $lines[$i]);
				for($k=0; $k< count($tmpArr); $k++)				
					{
					$str = $tmpArr[$k];
					$content[$i][$colums[$k]] = $str;				
					}			
				}
			}
		else
			$content = 0;
		return ($content);
		
		}

/******************SETTERS***********************************************************************/
	function SET_botDetected()
		{
		$logFile = '../botDetected.log';
		$fp = fopen($logFile, "a");		
		$strStart = 'time\t SCRIPT_URI\t HTTP_REFERER\t HTTP_USER_AGENT\t HTTP_HOST\t';
		$str = date('Y_m_d-H:i', time()).'	 '.$_SERVER['SCRIPT_URL'].'	 '.$_SERVER['HTTP_REFERER'].'	 '.$_SERVER['REMOTE_ADDR'].'	 '.$_SERVER['HTTP_USER_AGENT'].'
';
	    $cnt_det = fwrite($fp, $str);
//        fclose($this->fp);					
//		print_r($_SERVER);
//		return array('names' => $this->names, 'styles' => $this->styles, 'styleName' => $this->styleName, 'wanted' => $this->wantedButton);
		}
	}
?>
