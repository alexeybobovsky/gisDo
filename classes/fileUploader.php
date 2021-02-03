<?php

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {    
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        
        if ($realSize != $this->getSize()){            
            return false;
        }
        
        $target = fopen($path, "w");        
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        
        return true;
    }	
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];            
        } else {
            throw new Exception('Getting content length is not supported.');
        }      
    }   
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {  
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }

}

class qqFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;
    private $imagePrewSize = array();
	public $fileNameOut;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760, array  $imagePrewSize = array()){        
        $allowedExtensions = array_map("strtolower", $allowedExtensions);
        $this->imagePrewSize = $imagePrewSize;
            
        $this->allowedExtensions = $allowedExtensions;        
        $this->sizeLimit = $sizeLimit;
        
        $this->checkServerSettings();       

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false; 
        }
    }
    
    private function checkServerSettings(){        
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));        
        
        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';             
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");    
        }        
    }
    
    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;        
        }
        return $val;
    }
    
    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }
        
        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }
        
        $size = $this->file->getSize();
        
        if ($size == 0) {
            return array('error' => 'File is empty');
        }
        
        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }
        
        $pathinfo = pathinfo($this->file->getName());
        $filename = $this->translit($pathinfo['filename'], 1);
        $this->filenameOut = $pathinfo;
        //$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }
        
        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }
        
        if ($this->file->save($uploadDirectory . $filename . '.' . $ext))
			{
			if(in_array($ext, array('jpg', 'JPG', 'jpeg',  'JPEG', 'png', 'PNG', 'gif', 'GIF')))
				{
				$source = $uploadDirectory . $filename . '.' . $ext;
				$new_image = $uploadDirectory . $filename . '_prew.' . $ext;
				$new_image_url_arr = explode("../htdocs", $new_image);
				$width = $this->imagePrewSize[0];
				$height = $this->imagePrewSize[1];
	//			imageResize($sourse, $new_image, $width, $height)
				$this->imageResize($source, $new_image, $width, $height);
				$fileType = 'img';
				}
			else
				$fileType = 'doc';

            return array('success'=>true, 
				'uploadDirectory' =>$uploadDirectory,
				'fileType' =>$fileType, 
				'filename' =>$filename, 
				'ext' =>$ext, 
				'prew' =>$new_image_url_arr[1]);
			} else {
            return array('error'=> 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
        
    }
function imageResize($sourse, $new_image, $width, $height) //2010_07_07 Умное масштабирование картинок
	{
	$size = GetImageSize($sourse);
	$height = (!$height)?$size[1]:$height;
	$width = (!$width)?$size[0]:$width;
	$kx = $width/$size[0];
	$ky = $height/$size[1];
	$k = ($kx>$ky)?$ky:$kx;		
	$k = ($k<1)?$k:1;
	$new_width =  $size[0] * $k;
	$new_height = $size[1] * $k;
	$image_p = @imagecreatetruecolor($new_width, $new_height);
	if ($size[2]==2)
		{
			$image_cr = imagecreatefromjpeg($sourse);
		}
	elseif ($size[2]==3)
		{
			$image_cr = imagecreatefrompng($sourse);
		}
	elseif ($size[2]==1)
	  {
			$image_cr = imagecreatefromgif($sourse);
	  }
//	echo 'X1 - '.$size[0].'; Y1 - '.$size[1].'; X2 - '.$new_width.'; Y2 - '.$new_height;
	imagecopyresampled($image_p, $image_cr, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
		if ($size[2]==2)
		  {
		   imagejpeg($image_p, $new_image, 75);
		  }
		  else if ($size[2]==1)
		  {
		   imagegif($image_p, $new_image);
		  }
		  else if ($size[2]==3)
		  {
		   imagepng($image_p, $new_image);
		  }		
	}	
	
	function translit($str, $blank) //переводит русские буквы в латиницу (29_03_07) пробел
		{
		$tr = array(
		   "Ґ"=>"G","Ё"=>"YO","Є"=>"E","Ї"=>"YI","І"=>"I",
		   "і"=>"i","ґ"=>"g","ё"=>"yo","№"=>"#","є"=>"e",
		   "ї"=>"yi","А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
		   "Д"=>"D","Е"=>"E","Ж"=>"ZH","З"=>"Z","И"=>"I",
		   "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
		   "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
		   "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
		   "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"'","Ы"=>"YI","Ь"=>"",
		   "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
		   "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"zh",
		   "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
		   "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
		   "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
		   "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"'",
		   "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya");		   
		if($blank)
			$tr[" "] = "_";
		return strtr($str,$tr);
		}
    
}
