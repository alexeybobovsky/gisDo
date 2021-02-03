<?php
//require_once("main.inc.php");
class DBLink
	{
	var $link;
	var $query;
	var $result;
	var $error;
	var $error_string;
	var $cur_query;
	var $last_id;
	var $debug;
	var $simpleDebug;
	var $file; 
	var $line;
	var $func;	
	function SetSimpleDebug($file, $func, $line)
		{
		$this->simpleDebug = true;		
		$this->file = $file;
		$this->line = $line;
		$this->func = $func;
		echo "<br><font color='green'>file: <b>".$this->file."</b>;  function: <b>".$this->func."</b>; line: <b>".$this->line.'</b></font><br>';
		}
	function SetDebug($file, $func, $line)
		{
		$this->debug = true;		
		$this->file = $file;
		$this->line = $line;
		$this->func = $func;
		echo "<br><font color='green'>file: <b>".$this->file."</b>;  function: <b>".$this->func."</b>; line: <b>".$this->line.'</b></font><br>';
		}
    function DBLink ()
		{
//		$this->debug = true;
		$this->debug = false;
		$this->simpleDebug = false;
        global $SQLhost, $SQLus, $SQLpw, $SQLdb;//, $cookieName;	
/*		echo $SQLhost.'~~~'.$SQLus.'~~~'.$SQLpw.'~~~'.$SQLdb;*/
//        $this->link =     MYSQL_CONNECT("$SQLhost", "$SQLus", "$SQLpw")  OR DIE("Не могу создать соединение ");
        $this->link =     new mysqli("$SQLhost", "$SQLus", "$SQLpw", "$SQLdb"); // OR DIE("Не могу создать соединение ");
 	    if ($this->link->connect_error)
	        {
			die('Error : ('. $this->link->connect_errno .') '. $this->link->connect_error);
			$this->error = 1;
	        }
		else
			{
//			mysql_query("SET NAMES 'utf8'");
			$results = $this->link->query("SET NAMES 'utf8'");
//			echo 'good';
			$this->error = 0;		
			}
		}
    function Query ($query)
		{
		$this->result = $this->link->query($query);
		$this->cur_query = $query;
		if(!$this->result) 
			{
			$this->error = 3;
			$this->error_string = $this->link->errno . ": " . $this->link->error;
			if ($this->debug)
				echo "<br>query -  <font color='red'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>"."".$query."<br>".$this->error_string."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br></font>";			
			if ($this->simpleDebug)
				echo "<br>query -  <font color='red'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>".$this->error_string."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br></font>";			
				
			$ret_value = 0;	
			}
		else
			{
			$ret_value = $this->result;
			$this->last_id = $this->link->insert_id;
			if ($this->debug)
				echo "<br>query - <font color='blue'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>"."".$query."<br>".$this->result->num_rows."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>
							last_id = ".$this->last_id."</font><br>";			
			if ($this->simpleDebug)
				echo "<br>query - <font color='blue'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>".$this->result->num_rows."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>
							last_id = ".$this->last_id."</font><br>";			
			$this->error = 0;		
			}
        return $ret_value;	
		}
	function Close_link()
		{
      	$this->link->close();	
		}
	function GetNumRows()
		{
		return $this->result->num_rows;
		}
	function GetData($field, $is_array)
		{
//		var_dump(debug_backtrace());
//		$t .= print_r(func_get_args(), true);

/*		$t = '';
		$fp = fopen('LOG.txt', "a");
		$t .= print_r(debug_backtrace(), true);*/
		
		$j = 0;
//		echo "<br>Start";
//		while ($row_content = mysql_fetch_array($this->result, MYSQL_ASSOC))
		while ($row_content = $this->result->fetch_array(MYSQL_ASSOC))
			{
			if (is_array($field))
				{
				for ($i=0;  $i<count($field); $i++ )		
					$ret_Val[$j][$field[$i]] = $row_content[$field[$i]];
				}
			elseif($field)
				{
				$ret_Val[$j] = $row_content[$field];
				}
			else
				$ret_Val[] =  $row_content;
			$j++;
			}	
//		print_r($field);
/*		$cnt_det = fwrite($fp, $t."\n");
		fclose($fp);*/

		if($is_array)
			return $ret_Val;
		else
			return $ret_Val[0];
		}
	}
?>