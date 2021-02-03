<?
echo 'go!';
$feedFile = 'area.js';
$outFile = 'converted.js';
$lines = file($feedFile);
$jsout = '';
$div = '"coordinates": [';
$divNameL = '"NAME": "';
$divNameR = '", "ADMIN_LVL"';
function getStrPrt($str, $div, $val) // 26_04_2007 ВОЗВРАЩАЕТ НУЖНЫЙ ЭЛЕМЕНТ $val СТРОКИ $str РАЗДЕЛЕННОЙ $div 
	{
	$tmpArr = explode($div, $str);
	return $tmpArr[$val];
	
	} 
echo count($lines);
$count = 0;
//for ($i=0; $i< count($lines); $i++ ) {
for ($i=count($lines); $i>0; $i-- ) {
	if (strpos($lines[$i], $div) !== false) {
		$strNew = 'nameReg['.$count.'] = "'.getStrPrt(getStrPrt($lines[$i], $divNameR, 0), $divNameL, 1).'";
';
//		$name = getStrPrt(getStrPrt($lines[$i], $divNameR, 0), $divNameL, 1);
		$strNew .= 'reg['.$count.'] = [';
		$coordStr = getStrPrt($lines[$i], $div, 1);
		$kArr = explode('],', $coordStr);
		for ($k=0; $k< count($kArr); $k++ ) {
			if(!($k/2 - floor($k/2)))
				{
				$strNew .= ($k)?', ': '';
				$kBoth = explode(', ', $kArr[$k]);
				$x = number_format(rtrim(ltrim($kBoth[0], ' [,'), ' ],'), 5, '.', '');
				$y = number_format(rtrim(ltrim($kBoth[1], ' [,'), ' ],'), 5, '.', '');
				$strNew .= '['.$x.', '.$y.']';
				}
			}
		$strNew .= '];
';

		
		
	$count ++;	
	$jsout .= $strNew;	
	}
}

$fp = fopen($outFile, "w");	
$cnt_det = fwrite($fp, $jsout);			

?>