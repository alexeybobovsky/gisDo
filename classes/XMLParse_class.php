<?
class XML_Parse
	{
	var $TypeBalance;
	var $curTypeBalance;
	var $Catalog;
	var $curCatalog;
	var $TypePrice;
	var $curTypePrice;
	var $Price;
	var $curPrice;
	var $cnt; 
	var $DB_Link;
	var $parser;
	
	var $errorString;
	var $errorLine;
	var $error;
	
	var $news;
	var $currentNews;
	var $index;
	
	
	function XML_Parse($file, $LNK)
		{
		global $TM;
//		echo $f=(is_file($file))?$file.' - is file':$file.' - no file!';
		$this->error = 0;
		$this->DB_Link = $LNK;
		$this->cnt = 0;
		$this->parser = xml_parser_create('UTF-8');
//		$this->parser = xml_parser_create();
		xml_set_object($this->parser, &$this); 
		xml_set_element_handler($this->parser,'saxStartElement1','saxEndElement1');
//		xml_set_element_handler($this->parser,'saxStartElement','saxEndElement');
		xml_set_character_data_handler($this->parser,'saxCharacterData');
		xml_parser_set_option($this->parser,XML_OPTION_CASE_FOLDING,false);
		$xml = join('',file($file));	
		$TM->TimeCalc('join  file'.$file);
		if (!xml_parse($this->parser,$xml,true))
			{
		    die(sprintf('Ошибка XML: %s в строке %d',
		        xml_error_string(xml_get_error_code($this->parser)),
		        xml_get_current_line_number($this->parser)));		
			$this->errorString =  xml_error_string(xml_get_error_code($this->parser));
			$this->errorLine =  xml_get_current_line_number($this->parser);
			}
		xml_parser_free($this->parser);		
/*		print_r($this->news);
		echo '<hr>';
		print_r($XML->TypePrice);*/
		}		
	function saxEndElement1($parser,$name)
		{
		global $TM;
		switch($name)
			{
			case 'TypeBalance':
				{
				if ($this->curTypeBalance)
					{
					$TM->TimeCalc('End - TypeBalance');
//					$this->TypeBalance = $this->curTypeBalance;
					$this->curTypeBalance = null;
//					$this->cnt = 0;
					}
				}
				break;
			case 'Catalog':
				{
				if ($this->curCatalog)
					{
					$TM->TimeCalc('End - curCatalog');
//					$this->Catalog = $this->curCatalog;
					$this->curCatalog = null;
//					$this->cnt = 0;
					}
				}
				break;
			case 'TypePrice':
				{
				if ($this->curTypePrice)
					{
					$TM->TimeCalc('End - curTypePrice');
//					$this->TypePrice = $this->curTypePrice;
					$this->curTypePrice = null;
//					$this->cnt = 0;
					}
				}
				break;
			case 'Price':
				{
				if ($this->curPrice)
					{
					$TM->TimeCalc('End - curPrice');
//					$this->Price = $this->curPrice;
					$this->curPrice = null;
//					$this->cnt = 0;
					}
				}
				break;
			};
		}
		
	function saxStartElement1($parser,$name,$attrs)
		{
		global $TM;
		switch($name)
			{
			case 'TypeBalance':
				{
				$TM->TimeCalc('Start - TypeBalance');
				$queryClear = 'UPDATE `cat_type_balance` SET `is_delete` = 1';
				$this->curTypeBalance = 1;//array();				
				$this->DB_Link->Query($queryClear);
				}
				break;
			case 'Catalog':
				{
				$TM->TimeCalc('Start - Catalog');
				$queryClear = 'UPDATE `cat_items` SET `is_delete` = 1';				
				$this->curCatalog = 1;//array();
				$this->DB_Link->Query($queryClear);
				}
				break;
			case 'TypePrice':
				{
				$TM->TimeCalc('Start - TypePrice');
				$queryClear = 'UPDATE `cat_type_price` SET `is_delete` = 1';				
				$this->curTypePrice = 1;//array();
				$this->DB_Link->Query($queryClear);
				}
				break;
			case 'Price':
				{
				$TM->TimeCalc('Start - Price');
				$queryClear = 'UPDATE `cat_price` SET `is_delete` = 1';				
				$this->curPrice = 1;//array();
				$this->DB_Link->Query($queryClear);
				}
				break;
			case 'Item':
				{
				if ($this->curTypeBalance)
					{
//					$this->DB_Link->SetDebug(__FILE__, __FUNCTION__, __LINE__);						
					$querySelect = 'Select * from `cat_type_balance` WHERE `id` LIKE \''.$attrs['Id'].'\'';				
					$this->DB_Link->Query($querySelect);
					if($this->DB_Link->GetNumRows())
						{
						$query = 'UPDATE `cat_type_balance` SET `name` = \''.iconv("UTF-8", "windows-1251", $attrs['Name']).'\', `is_delete` = 0 WHERE `id` LIKE \''.$attrs['Id'].'\'';				
						}
					else
						{
						$query = 'INSERT INTO `cat_type_balance` SET `name` = \''.iconv("UTF-8", "windows-1251", $attrs['Name']).'\' ,  `id`  = \''.$attrs['Id'].'\'';				
						}
					$this->DB_Link->Query($query);
/*					$this->DB_Link->debug = false;
					$this->curTypeBalance[$this->cnt]['Id'] = $attrs['Id'];
					$this->curTypeBalance[$this->cnt]['Name'] = iconv("UTF-8", "windows-1251", $attrs['Name']);
					$this->cnt++;*/
					}
				elseif ($this->curTypePrice)
					{
					$querySelect = 'Select * from `cat_type_price` WHERE `id` LIKE \''.$attrs['Id'].'\'';				
					$this->DB_Link->Query($querySelect);
					if($this->DB_Link->GetNumRows())
						{
						$query = 'UPDATE `cat_type_price` SET `name` = \''.iconv("UTF-8", "windows-1251", $attrs['Name']).'\', `is_delete` = 0   WHERE `id` LIKE \''.$attrs['Id'].'\'';				
						}
					else
						{
						$query = 'INSERT INTO `cat_type_price` SET `name` = \''.iconv("UTF-8", "windows-1251", $attrs['Name']).'\' ,  `id`  = \''.$attrs['Id'].'\'';				
						}
					$this->DB_Link->Query($query);
					
/*					$this->curTypePrice[$this->cnt]['Id'] = $attrs['Id'];
					$this->curTypePrice[$this->cnt]['Name'] = iconv("UTF-8", "windows-1251", $attrs['Name']);
					$this->cnt++;*/
					}
					
				elseif ($this->curPrice)
					{
					$querySelect = 'Select * from `cat_price` WHERE `id_item` LIKE \''.$attrs['IdCatalog'].'\' AND `id_type` LIKE \''.$attrs['IdTypePrice'].'\'';				
					$this->DB_Link->Query($querySelect);
					if($this->DB_Link->GetNumRows())
						{
						$query = 'UPDATE `cat_price` SET 
								`id_type` = \''.$attrs['IdTypePrice'].'\', 
								`price` = \''.$attrs['Price'].'\', 
								`is_delete` = 0 
								WHERE `id_item` LIKE \''.$attrs['IdCatalog'].'\' AND `id_type` LIKE \''.$attrs['IdTypePrice'].'\'';				
						}
					else
						{
						$query = 'INSERT INTO `cat_price` SET 
								`id_item` = \''.$attrs['IdCatalog'].'\' , 
								`price` = \''.$attrs['Price'].'\', 
								`id_type` = \''.$attrs['IdTypePrice'].'\'';				
						}
					$this->DB_Link->Query($query);
					
/*					$this->curPrice[$this->cnt]['IdCatalog'] = $attrs['IdCatalog'];
					$this->curPrice[$this->cnt]['IdTypePrice'] = $attrs['IdTypePrice'];
					$this->curPrice[$this->cnt]['Price'] = $attrs['Price'];
					$this->cnt++;*/
					}
				elseif ($this->curCatalog)
					{
					$querySelect = 'Select * from `cat_items` WHERE 
						`id` LIKE \''.$attrs['Id'].'\'';										
					$this->DB_Link->Query($querySelect);
					if($this->DB_Link->GetNumRows())
						{
						$query = 'UPDATE `cat_items` SET `parent_id`= \''.$attrs['ParentId'].'\',
									`thread_id`= \''.$attrs['ThredId'].'\',
									`is_group`= \''.$attrs['IsGroup'].'\',
									`name` = \''.iconv("UTF-8", "windows-1251", $attrs['Name']).'\', 
									`level`= \''.$attrs['Level'].'\',
									`balance`= \''.$attrs['TypeBalance'].'\',
									`type_unit`= \''.iconv("UTF-8", "windows-1251", $attrs['TypeUnit']).'\',
									`is_delete` = 0 
									WHERE `id` LIKE \''.$attrs['Id'].'\'';
						}
					else
						{
						$query = 'INSERT INTO `cat_items` SET 
								`id`= \''.$attrs['Id'].'\',
								`parent_id`= \''.$attrs['ParentId'].'\',
								`thread_id`= \''.$attrs['ThredId'].'\',
								`is_group`= \''.$attrs['IsGroup'].'\',
								`name` = \''.iconv("UTF-8", "windows-1251", $attrs['Name']).'\', 
								`level`= \''.$attrs['Level'].'\',
								`balance`= \''.$attrs['TypeBalance'].'\',
								`type_unit`= \''.iconv("UTF-8", "windows-1251", $attrs['TypeUnit']).'\'';
						}
					$this->DB_Link->Query($query);
					
/*					$this->curCatalog[$this->cnt]['Id'] = $attrs['Id'];
					$this->curCatalog[$this->cnt]['ParentId'] = $attrs['ParentId'];
					$this->curCatalog[$this->cnt]['ThredId'] = $attrs['ThredId'];
					$this->curCatalog[$this->cnt]['Level'] = $attrs['Level'];
					$this->curCatalog[$this->cnt]['IsGroup'] = $attrs['IsGroup'];
					$this->curCatalog[$this->cnt]['TypeBalance'] = $attrs['TypeBalance'];
					$this->curCatalog[$this->cnt]['TypeUnit'] = $attrs['TypeUnit'];
					$this->curCatalog[$this->cnt]['Name'] = iconv("UTF-8", "windows-1251", $attrs['Name']);
					$this->cnt++;*/
					}
				}
				break;
			};
		}
		
	function saxStartElement($parser,$name,$attrs)
		{
		switch($name)
			{
			case 'newsLine':
				$news = array();
				break;
			case 'news':
				$this->currentNews = array();
				if (in_array('date',array_keys($attrs)))
					$this->currentNews['date'] = $attrs['date'];
				break;
			default:
				$this->index = $name;
				break;
			};
		}
	function saxEndElement($parser,$name)
		{
	    if ((is_array($this->currentNews)) && ($name=='news'))
		    {
	        $this->news[] = $this->currentNews;
	        $this->currentNews = null;
			}
	    $this->index = null;
		}
	function saxCharacterData($parser,$data)
		{
		if ((is_array($this->currentNews)) && ($this->index))
			$this->currentNews[$this->index] = $data;
		}	
	}
?>
