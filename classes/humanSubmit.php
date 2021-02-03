<?php
class humanSubmit
	{
	var $names = array();
	var $styles = array();
	var $styleName = array();
	var $wantedButton;	
	function humanSubmit($num)
		{
		if($num)
			{
			$wntIndx = mt_rand(2, $num-1);
			$dt = time();
			for($i=0; $i<$num; $i++)
				{
				$this->names[$i] = md5($i.$dt);
				$this->styleName[$i] = 'C'.md5($dt.$i);
				$this->styles[$i] = ($i==$wntIndx)?'visible':'hidden';
				if($i==$wntIndx)
					$this->wantedButton = $this->names[$i];
				}
			}
		}
	function getButtons()
		{
		return array('names' => $this->names, 'styles' => $this->styles, 'styleName' => $this->styleName, 'wanted' => $this->wantedButton);
		}
	function botDetected()
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