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
		$this->debug = false;
		$this->simpleDebug = false;
        global $SQLhost, $SQLus, $SQLpw, $SQLdb;//, $cookieName;	
/*		echo $SQLhost.'~~~'.$SQLus.'~~~'.$SQLpw.'~~~'.$SQLdb;*/
        $this->link =     MYSQL_CONNECT("$SQLhost", "$SQLus", "$SQLpw")  OR DIE("Не могу создать соединение ");
 	    if (!$this->link)
	        {
	        echo "Database access error.\n";
			$this->error = 1;
	        die();
	        }
		$result = mysql_select_db("$SQLdb", $this->link);
		if (!$result)
			{
				$this->error = 2;
				echo "Error selecting database '$SQLdb'.\n";
				die();
			}	
		else
			{
			mysql_query("SET NAMES 'utf8'");
			$this->error = 0;		
			}
		}
    function Query ($query)
		{
		$this->result = mysql_query($query);
		$this->cur_query = $query;
		if(!$this->result) 
			{
			$this->error = 3;
			$this->error_string = mysql_errno() . ": " . mysql_error();
			if ($this->debug)
				echo "<br>query -  <font color='red'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>"."".$query."<br>".$this->error_string."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br></font>";			
			if ($this->simpleDebug)
				echo "<br>query -  <font color='red'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>".$this->error_string."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br></font>";			
				
			$ret_value = 0;	
			}
		else
			{
			$ret_value = $this->result;
			$this->last_id = mysql_insert_id();
			if ($this->debug)
				echo "<br>query - <font color='blue'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>"."".$query."<br>".$this->result."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>
							last_id = ".$this->last_id."</font><br>";			
			if ($this->simpleDebug)
				echo "<br>query - <font color='blue'>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>".$this->result."\n<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n<br>
							last_id = ".$this->last_id."</font><br>";			
			$this->error = 0;		
			}
        return $ret_value;	
		}
	function Close_link()
		{
      	mysql_close($this->link);	
		}
	function GetNumRows()
		{
		return MYSQL_NUMROWS($this->result);
		}
	function GetData($field, $is_array)
		{
		$j = 0;
//		echo "<br>Start";
		while ($row_content = mysql_fetch_array($this->result, MYSQL_ASSOC))
			{
			if (is_array($field))
				{
				for ($i=0;  $i<count($field); $i++ )		
					$ret_Val[$j][$field[$i]] = $row_content[$field[$i]];
				}
			else
				{
				$ret_Val[$j] = $row_content[$field];
				}
			$j++;
			}	
//		print_r($field);
		if($is_array)
			return $ret_Val;
		else
			return $ret_Val[0];
		}
	}
?>