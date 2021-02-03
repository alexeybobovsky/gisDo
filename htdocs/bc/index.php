<? $tplDir = 'bc/';
$templates= array();
$templates[] = 'bc/headerSimple.tpl';
//$userName = 'inhuman';
//$userPsw = 	'justhuman';
if(sizeof($_POST)){	//post file form 
		$uploadTmpPath = '../htdocs/bc/upload/tmp/';
//		require_once("../classes/fileUploader.php");		
		if((isset($_POST['verifiedFile']))&&(is_file($uploadTmpPath.$_POST['verifiedFile']))){
			chdir('..//');
			require_once 'NEMApiLibrary.php';
			$keyPath = '../htdocs/bc/wallet/';
			$adrFile = 'adr.key'; $priFile = 'priv.key'; $pubFile = 'pub.key'; 
			
			$net = 'testnet';
			$NEMpubkey = file_get_contents($keyPath.$pubFile);
			$NEMprikey = file_get_contents($keyPath.$priFile);
			$baseurl = 'http://80.93.182.146:7890';
			$filename = $uploadTmpPath.$_POST['verifiedFile'];
			$dir = '../htdocs/bc/store/';
			$type = 'public'; // 只今の所、publicのみ対応。
			$algo = 'sha256'; // SHA3も可能ですがライブラリが貧弱であるためかなり遅いです。
							  // 使用可能な早さであるか確認してから使用を検討してください。
							  // PHPはネイティブでSHA256までです。
							  // 外部モジュールを導入することもできますが、SHA3採用前のkeccakであることにご注意ください
			
			$apo = new Apostille();
			$apo->setting($filename, $type, $algo, $net);
			$apo->Run();
			$reslt = $apo->send($NEMpubkey, $NEMprikey, $baseurl);
			$out = $apo->Outfile($dir); // nanowalletで監査可能な形式で$dirへ出力します。
			
			
			if($reslt['status']){
				echo '<P>','Fee is ',$reslt['fee'],' XEM<BR>';
				echo       'TXID is ',$reslt['txid'],'<BR>';
				echo       'Output is ',$out,' ,1=true 0=false</P>';
			}else{
				echo 'Error message: ',$reslt['message'];
			}			
			print_r($reslt);
			
		}
		elseif($type = trim($_POST['type'])){    //AJAX
	/*		echo $type;
			echo '
'			;*/
			chdir('..//');
			$priFile = '../htdocs/bc/wallet/priv.key';
			$ret = array();
			switch ($type){
				case 'checkPsw':{ /*2017_02_09 получить объекты слоёв*/
					
					if(trim($_POST['value'])==";jgf"){						
						$ret['filePath'] = '../htdocs/bc/upload/tmp/';
						$ret['resultPsw'] = 'success';
						$ret['key'] = file_get_contents($priFile);
					}
					else 
						$ret['resultPsw'] = 'error';
					echo json_encode($ret);
				} break;
				case 'apostileCreateTest':{ /*2017_02_09 получить объекты слоёв*/
					$nemEpoch = mktime(6, 25, 0, 3, 29, 2015);
//					$nemEpoch = mktime(2015, 2, 29, 0, 6, 25, 0);
//					$uploadTmpPath = '../htdocs/bc/upload/tmp/';
					$destDir = '../htdocs/bc/store/';
//					$dateStr4File = date('Y-m-d', $nemEpoch + $_POST['dateOfStamp']);
					$dateStr4File = date('Y-m-d');
//					$fileArr = getFileName('generatedFile.txt');
					$fileArr = getFileName($_POST['fileName']);
					$destFile = $fileArr['name'].' -- Apostille TX '.$_POST['hash'].' -- Date '.$dateStr4File.'.'.$fileArr['ext'];
					$handle = fopen($destDir.$destFile, "w+");
					fwrite($handle, $_POST['fileText']);
					fclose($handle);
					echo '/bc/?getApostille='.md5($destFile);
				} break;				
				case 'apostileCreate':{ /*2017_02_09 получить объекты слоёв*/
					$nemEpoch = mktime(6, 25, 0, 3, 29, 2015);
//					$nemEpoch = mktime(2015, 2, 29, 0, 6, 25, 0);
					$uploadTmpPath = '../htdocs/bc/upload/tmp/';
					$destDir = '../htdocs/bc/store/';
//					$dateStr4File = date('Y-m-d', $nemEpoch + $_POST['dateOfStamp']);
					$dateStr4File = date('Y-m-d');
					$fileArr = getFileName($_POST['fileName']);
					$destFile = $fileArr['name'].' -- Apostille TX '.$_POST['hash'].' -- Date '.$dateStr4File.'.'.$fileArr['ext'];
					$srcFile = $uploadTmpPath.$_POST['fileNameSrc'];
					if(is_file($uploadTmpPath.$_POST['fileNameSrc']))
						if(!rename($srcFile, $destDir.$destFile))
							echo '0';
						else
							echo '/bc/store/'.$destFile;
					else
						echo '0';
				} break;
				default :{
					echo '';
				}
			}
		}

}
elseif(sizeof($_GET)){
//	print_r($_GET);
	if(isset($_GET['getApostille'])){
		chdir('..//');
		$srcDir = '../htdocs/bc/store/';
		$templates = array();
		$dir = opendir($srcDir);
		while($file = readdir($dir)){
			if (($file!=".")&&($file!="..")&&(md5($file)===$_GET['getApostille'])){ 
				if (file_exists($srcDir.$file)) {
					if (ob_get_level()) {
						ob_end_clean();
					}
					// заставляем браузер показать окно сохранения файла
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
//					header('Content-Disposition: attachment; filename=' . basename($file));
					header('Content-Disposition: attachment; filename="'.basename($file).'"');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($srcDir.$file));
					// читаем файл и отправляем его пользователю
					readfile($srcDir.$file);
					exit;
				}
//					echo $file;
			}
		}
	}		
	elseif($_GET['fileUpload'] == 1){
		chdir('..//');
		$templates = array();			
		$uploadTmpPath = '../htdocs/bc/upload/tmp/';
		require_once("../classes/fileUploader.php");		
		$allowedExtensions = array();
		// max file size in bytes
		$sizeLimit = 10 * 1024 * 1024;
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit, array(225, 0));
		$result = $uploader->handleUpload($uploadTmpPath);
//		printr($result);
		echo json_encode($result);
	}
	
}
else{
	$header['title'] = 'Регистратор файлов в Blockchain NEM';
	$templates[] = 'bc/enterMarketForm.tpl';
	chdir('..//');
	$SMRT[] =  array('name' => 'header', 'body' => $header);
	require_once('../htdocs/includes/Smarty/setup.php');
	$smarty = new Smarty_CMS;	
	$smarty->init();
	$templates[] = 'bc/footerSimple.tpl';
	$smarty->assign('header', $header);	
	for($i=0; $i<sizeof($SMRT); $i++)
		$smarty->assign($SMRT[$i]['name'], $SMRT[$i]['body']);	
		
	for($i=0; $i<sizeof($templates); $i++)
		$smarty->display($templates[$i]);
}
if($REDIRECT)
	{
	header('Location: '.$REDIRECT);	
	}
else
	{
	}
function getFileName($str)
	{
	$pointPos = strrpos ($str, '.');
	$pathPos = 	strrpos ($str, '/');
	if($pathPos)
		{
		$ret['path'] = substr($str, 0, $pathPos);
		$startName = $pathPos +1; 
		$lengthName = $pointPos - $pathPos - 1;
		}
	else
		{
		$ret['path'] = '';
		$startName = 0;
		$lengthName = $pointPos;
		}
	if($pointPos)
		{
		$ret['name'] = substr($str, $startName, $lengthName);
		$ret['ext'] = substr($str, $pointPos+1);
		}
	else
		{
		$ret['name'] = $str;
		$ret['ext'] = '';
		}
	return $ret;
	}


?>