<?php
class IMAGE
	{
	var $im; 					//объект
	var $img_type;
	var $colors;
	var $styles;
	var $axisPos;
	var $stepX;
	var $kY;
	var $spX;
	var $spY;
	var $Image_W;// = 500; 			//Ширина канвы
	var $Image_H;// = 375; //Высота
	
	function IMAGE($w, $h, $type)
		{
		$this->Image_W = $w;
		$this->Image_H = $h;
		$this->img_type = $type;
		}
	function imageInitializeFile($file, $type)
		{
	    $W = $this->Image_W;
	    $H = $this->Image_H;
	    $this->im = imagecreate($W, $H);
		if($type=="gif")
			$im_src = imagecreatefromgif($file);
		elseif($type=="png")
			$im_src = imagecreatefrompng($file);
	    imagecopyresized ($this->im, $im_src, 0, 0, 0, 0, $W, $H, imagesx($im_src), imagesy($im_src));
	    }
	function imageInitialize()
		{
	    $this->im = imagecreate($this->Image_W, $this->Image_H);
	    }	
	function ReturnImageSizeX($max, $maxY, $src)
		{
	    $size = getimagesize ($src);	
	        $img['realWidth'] = $size[0];
	        $img['realHeight'] = $size[1];
	        $img['width'] = $size[0];
	        $img['height'] = $size[1];
	    if (($size[0]>$maxX)&&($size[1]<=$max))
	        {
	        $k_szh = $max/$size[0];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]<=$max)&&($size[1]>$max))
	        {
	        $k_szh = $max/$size[1];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]>$max)&&($size[1]>$max))
	        {
	            if($size[0]>$size[1])
	                $k_szh = $max/$size[0];
	            else
	                $k_szh = $max/$size[1];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]<=$max)&&($size[1]<=$max))
	        {
	        $img['width'] = $size[0];
	        $img['height'] = $size[1];
	        }
		$this->Image_W = $img['width'];
		$this->Image_H = $img['height'];
		return $img;
		
	    }
	function colorsInitialize()	    //========== Set Colors =======================================================
		{
	    $this->colors["white"] = imagecolorallocate($this->im, 255, 255, 255);  // #FFFFFF  граница
	    $this->colors["black"] = imagecolorallocate($this->im, 0, 0, 0);        // #000000
	    $this->colors["red"] = imagecolorallocate($this->im, 255, 0, 0);        // #FF0000
	    $this->colors["green"] = imagecolorallocate($this->im, 0, 220, 0);      // #00DC00
	    $this->colors["blue"] = imagecolorallocate($this->im, 0, 0, 255);       // #0000FF
	    $this->colors["wstr"] = imagecolorallocate($this->im, 0, 191, 191);     // #BB515C
	    $this->colors["trans"] = imagecolorallocate($this->im, 1, 1, 1);    	// #2ED6C1
	    $this->colors["axis"] = imagecolorallocate($this->im, 198, 197, 203);    	// #2ED6C1
	    $this->colors["payIn"] = imagecolorallocate($this->im, 236, 171, 19);    	// #2ED6C1
//	    $this->colors["payIn"] = imagecolorallocate($this->im, 60, 13, 251);    	// #2ED6C1
	    $this->colors["payOut"] = 	imagecolorallocate($this->im, 247, 218, 153);
	    $this->colors["infIn"] = 	imagecolorallocate($this->im, 60, 13, 251);
		
	    $this->colors["equant"] = 	imagecolorallocate($this->im, 0xFE, 0xD6, 0xBC);
	    $this->colors["space"] = 	imagecolorallocate($this->im, 0xBC, 0xC4, 0xFE);
	    $this->colors["ies"] = 		imagecolorallocate($this->im, 0xBB, 0xFF, 0xBB);
		
	    $this->colors["equant"] = 	imagecolorallocate($this->im, 0xFF, 0xCC, 0x44);
	    $this->colors["space"] = 	imagecolorallocate($this->im, 0x00, 0x00, 0xFF);
	    $this->colors["ies"] = 		imagecolorallocate($this->im, 0x00, 0xFF, 0x00);
//	    $this->colors["infIn"] = imagecolorallocate($this->im, 39, 98, 233);    	// #2ED6C1
//	    $this->colors["infOut"] = imagecolorallocate($this->im, 140, 113, 253);    	// #2ED6C1
//	    $this->colors["infOut"] = imagecolorallocate($this->im, 193, 210, 249);    	// #2ED6C1
//	    $this->colors["trans"] = imagecolorallocate($this->im, 1, 1, 1);    	// #2ED6C1
		}
	function stylesInitialize()//========== Set Styles =======================================================
		{
	    $this->styles["dashed"] = array($this->colors["black"], $this->colors["black"], $this->colors["black"],$this->colors["black"],
	    							$this->colors["black"], $this->colors["black"], $this->colors["black"],$this->colors["black"],
	                                $this->colors["red"], $this->colors["red"], $this->colors["red"], $this->colors["red"],
	                                $this->colors["red"], $this->colors["red"], $this->colors["red"], $this->colors["red"]);									
	    $this->styles["dotted"] = array($this->colors["black"], $this->colors["trans"], $this->colors["trans"],
	                                    $this->colors["trans"], $this->colors["trans"], $this->colors["trans"],
	                                    $this->colors["trans"], $this->colors["trans"]);
	    }
	function ReturnImageSize($max, $src)
		{
	    $size = getimagesize ($src);	
	        $img['realWidth'] = $size[0];
	        $img['realHeight'] = $size[1];
	        $img['width'] = $size[0];
	        $img['height'] = $size[1];
	    if (($size[0]>$max)&&($size[1]<=$max))
	        {
	        $k_szh = $max/$size[0];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]<=$max)&&($size[1]>$max))
	        {
	        $k_szh = $max/$size[1];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]>$max)&&($size[1]>$max))
	        {
	            if($size[0]>$size[1])
	                $k_szh = $max/$size[0];
	            else
	                $k_szh = $max/$size[1];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]<=$max)&&($size[1]<=$max))
	        {
	        $img['width'] = $size[0];
	        $img['height'] = $size[1];
	        }
		$this->Image_W = $img['width'];
		$this->Image_H = $img['height'];
		return $img;
		
	    }
	function saveCurImgToFile($fileName, $type)
		{
		switch ($type)
			{
			case 'gif':
				{
				imagegif($this->im, $fileName);
				} break;
			case 'png':
				{
				imagepng($this->im, $fileName);
				} break;
			case 'jpeg':
				{
				imagejpeg($this->im, $fileName);
				} break;
			}
		imagedestroy($this->im);
		}
	function showCurImg($type)
		{
		switch ($type)
			{
			case 'gif':
				{
				imagegif($this->im);
				} break;
			case 'png':
				{
				imagepng($this->im);
				} break;
			case 'jpeg':
				{
				imagejpeg($this->im);
				} break;
			}
		imagedestroy($this->im);
		}
/************************************************************************/		
	function Image_Initialize_NoFile()
		{
		$this->im  = imagecreate ($this->Image_W, $this->Image_H); /* создать пустое изображение */
        $bgc = imagecolorallocate ($this->im, 255, 255, 255);
        $red = imagecolorallocate ($this->im, 255, 0, 0);
        $tc  = imagecolorallocate ($this->im, 0, 0, 0);
		imagesetthickness ($this->im, 15);
		imageellipse ($this->im, 75, 75, 130, 130, $red);
		imageellipse ($this->im, 75, 75, 100, 100, $red);
		imagefill ($this->im, 25, 90, $red);
	    imageline ($this->im, 43, 125, 110, 35, $red);
//	    imageline ($im, $x2, $y1, $x2, $y2, IMG_COLOR_STYLED);
        /* вывести errmsg */
		imagesetthickness ($this->im, 5);
        imagestring ($this->im, 5, 40, 70, "No IMAGE!", $tc);
	    return $im;
	    }
	function Image_Initialize_File($im_file)
		{
		global $img_ext;
		$this->img_type = $img_ext;
	    $W = $this->Image_W;
	    $H = $this->Image_H;
//	    $im = imagecreate($W, $H);
	    $im = imagecreatetruecolor($W, $H);
		if($img_ext=="jpg")
			$im_src = imagecreatefromjpeg($im_file);
		if($img_ext=="gif")
			$im_src = imagecreatefromgif($im_file);
		elseif($img_ext=="png")
			$im_src = imagecreatefrompng($im_file);
	    imagecopyresampled/*imagecopyresized */($im, $im_src, 0, 0, 0, 0, $W, $H, imagesx($im_src), imagesy($im_src));
	    return $im;
	    }
	function GetFullFilePathFromTAB ($tab)	
		{
		global $SRC_FACES, $src_faces;
		$img_full_name = 'http://'.$_SERVER['HTTP_HOST'].$SRC_FACES;
		$img_local_name = $src_faces;
		$img_rel_name = $SRC_FACES;
		$img_name = '';
		if(strlen($tab)<6)
			{
			$i=0;
			while($i<(6-strlen($tab)))
				{
				$img_name .= '0';
				$i++;
				}
			}
		$img_name .= $tab.'.jpg';
		$img_full_name .= $img_name;
		$img_rel_name .= $img_name;
		$img_local_name .= $img_name;
		$this->full_src = $img_full_name;
		$this->local_src = $img_local_name;
		$this->relative_src = $img_rel_name;
		}	
	function ReturnImageSizeNoFile($max, $w, $h)
		{
//		echo $max.' - '. $w.' - '.$h;
	    $size = array($w, $h);	
	        $img['width'] = $size[0];
	        $img['height'] = $size[1];
	    if (($size[0]>$max)&&($size[1]<=$max))
	        {
	        $k_szh = $max/$size[0];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]<=$max)&&($size[1]>$max))
	        {
	        $k_szh = $max/$size[1];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]>$max)&&($size[1]>$max))
	        {
	            if($size[0]>$size[1])
	                $k_szh = $max/$size[0];
	            else
	                $k_szh = $max/$size[1];
	        $img['width'] = intval($size[0]*$k_szh);
	        $img['height'] = intval($size[1]*$k_szh);
	        }
	    if (($size[0]<=$max)&&($size[1]<=$max))
	        {
	        $img['width'] = $size[0];
	        $img['height'] = $size[1];
	        }
		$this->Image_W = $img['width'];
		$this->Image_H = $img['height'];
		return $img;
		}
	}
?>