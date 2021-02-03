<?
function getStrPrt($str, $div, $val) // 26_04_2007 ВОЗВРАЩАЕТ НУЖНЫЙ ЭЛЕМЕНТ $val СТРОКИ $str РАЗДЕЛЕННОЙ $div 
	{
	$tmpArr = explode($div, $str);
	return $tmpArr[$val];	
	} 
function first_letter_up($string, $coding='utf-8') 
	{
	if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) 
		{
		preg_match('#(.)#us', mb_strtoupper(mb_strtolower($string, $coding), $coding), $matches);
		$string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $coding), $coding);
		}
	else 
		{
		$string = ucfirst($string);
		}
	return $string;
	}
if((isset($_POST['type']))&&(trim($_POST['type']))) //подгрузка HTML кода посредством АЯКС
//if((isset($_GET['type']))&&(trim($type = $_GET['type']))) //подгрузка HTML кода посредством АЯКС
	{
	$type = trim($_POST['type']);
	switch ($type)
		{
		case 'pinfo': /*25_02_2015 получить квартиры по фильтру*/
			{
			phpinfo();
			}
		break;		
		case 'geoKoderOSM': /*25_02_2015 получить квартиры по фильтру*/
			{
			$query = $_POST['location'].', '.$_POST['str'];
			$URI = 'http://nominatim.openstreetmap.org/search?q='.urlencode($query).'&format=xml';
			$context = stream_context_create(array(
				'http' => array(
						'method'=>"GET",
							'content' => $reqdata = http_build_query(array(
							/*	'action' => 'parse',
								'page' => $title,
								'prop' => 'text',
								'format' => 'xml',*/
						)),
						'header' => implode("\r\n", array(
								"Content-Length: " . strlen($reqdata),
								"User-Agent: SyberiaGisBot/0.1",
								"Connection: Close",
								""
						))
			)));			
			if (false === $response = file_get_contents($URI, false, $context)) 
				{
				echo 'zhopa';
				echo '';
//				return false;
				}
			else	
				{
				$xml = simplexml_load_string($response);
				foreach($xml->place->attributes() as $a => $b) {
					echo $a.'='.$b."##";
					}
				echo 'query='.$query."##";
				}
//			echo $xml->place->boundingbox;
//			return($xml);
			}
		break;		
		case 'getWiki': /*25_02_2015 получить квартиры по фильтру*/
			{
//			$str = trim($_POST['str']);
			$str = trim($_GET['str']);
			echo get_wiki(/*'Иркутск'*/$str);
			}
		break;
		}
	}
elseif((isset($_GET['q']))&&(isset($_GET['type']))) //Подгрузка списков для автоподстановки
	{
//	print_r($_GET);
	$type = trim($_GET['type']);
	$qStr = trim($_GET['q']);
	switch ($type)
		{
		case 'searchCity': 
			{
			$objType = "city";
			$coding='utf-8';
			$feedFile = 'naspu.js';
			$lines = file($feedFile);			
			$string = trim(mb_strtolower($qStr, $coding));
//			echo count($lines);
			if($lines)
				{				
				for ($i=0;  $i<count($lines); $i++ ) 
					{
					if(strlen($lines[$i])>50)
						{
							 
						 $name = 	mb_strtolower(getStrPrt(getStrPrt($lines[$i], '#regType~', 0), 'regName~', 1), $coding);
						if(strpos($name, $string) !== false)
							{
							$strout = first_letter_up($name).'**'.$string.'**'.$i.'**'.$objType.'**'.first_letter_up($name);
							echo $strout;
							echo '##';
							}
//						else echo $name.'; ';
						}
					}
						//echo $name.'; ';
				} 
			}
		break;		
		default: {}
		}
//phpinfo();		
	}
function get_wiki_(/*$title*/)
	{	
	$url = 'http://en.wikipedia.org/w/api.php?action=parse&page=example&format=json&prop=text';
	$ch = curl_init($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_USERAGENT, "User-Agent: SyberiaGisBot/0.1\r\n");
	
	if($c = curl_exec($ch) === false)
		echo 'bad';
	else
		{
	print_r( $c);
	$json = json_decode($c);
	
	$content = $json->{'parse'}->{'text'}->{'*'};	
		}
	}
/*
function get_wiki_url($title)
{
  //устанавливаем соединение через сокет
  $fp = fsockopen("ru.wikipedia.org", 443, $errno, $errstr, 30);
  if (!$fp) {
    echo "$errstr ($errno)<br />\n";
  } else {
    $out = "GET /w/api.php?action=opensearch&search=".urlencode($title)."& prop=info&format=xml&inprop=url HTTP/1.1\r\n";
    $out .= "Host: ru.wikipedia.org\r\n";
    // указывает User-Agent. Без него будет ошибка
    $out .= "User-Agent: SyberiaGisBot/0.1\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    $str = '';
    // получает только xml без полученных заголовков сервера
    while (!feof($fp)) {
      $tmp_str = fgets($fp, 128);
      if ($str != '' || substr($tmp_str,0,2)=='<?')
        $str .= $tmp_str;
    }
    fclose($fp);
    //парсим строку
	return $str;

  }
}
*/
function get_wiki($title)
{
    $context = stream_context_create(array(
        'http' => array(
                'method'=>"POST",
                    'content' => $reqdata = http_build_query(array(
                        'action' => 'parse',
                        'page' => $title,
                        'prop' => 'text',
                        'format' => 'xml',
                )),
                'header' => implode("\r\n", array(
                        "Content-Length: " . strlen($reqdata),
                        "User-Agent: SyberiaGisBot/0.1",
                        "Connection: Close",
                        ""
                ))
    )));

    if (false === $response = file_get_contents("https://ru.wikipedia.org/w/api.php", false, $context)) {
        echo 'zhopa';
		return false;
    }
    //парсим строку
    $xml = simplexml_load_string($response);
	$txtArr = explode('</table>', $xml->parse->text);
	$txtArr2 = explode('<div id="toc">', $txtArr[1]);
	echo $txtArr2[0];
//	print_r($xml->parse->text);
//	echo $xml->Section->Item;   
	return $xml->Section->Item;
}
?>