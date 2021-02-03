<?php
class news  extends TEMPLATE  
	{
	var $last_query;
/******************TEMPLATE***********************************************************************/	
	function ShowNewsImg($news,  $location)/*2008_05_06 кнопка удаления объекта в справочниках */
		{
//		print_r($news);
		$form = array();
		global $CONST;
		if($news['news_img'])
			{
			$form['elementCaption'][] = 'Загруженое изображение';
			require_once("../classes/Img_class.php");		
			$maxSizeInCatalogOptions = 150;
			$IMG = new IMAGE(0, 0, 'tmp');
			$src = $CONST['relPathPref'].$news['news_img'];
			$size = $IMG->ReturnImageSize($maxSizeInCatalogOptions, $src);					
			$ar[] = array('name' => 'IMG', 
						'id' => 'IMG', 
						'border' => 1, 
						'type' => 'img', 
						'title' => 'Щелчок для увеличения', 
						'class' =>'hand', 
						'onClick' =>'return GB_showImage(\''.$news['news_name'].'\', \''.$news['news_img'].'\')', 
//						'onClick' =>'open_window(\''.$news['main']['ban_file'].'\', \'IMG\', '.($size['realWidth']+50).', '.($size['realHeight']+50).', 0)',  
						'width' => $size['width'],
						'height' => $size['height'],
						'src' => $news['news_img']					
						);	
			}
		$form['elementCaption'][] = ($news['news_img'])?'<br>Новое изображение':'Загрузить изображение';
		$ar[] = array('name' => 'fileToUpload', 
					'id' => 'fileToUpload', 
					'type' => 'file', 
					'MAX_FILE_SIZE' => 1000000, 
					'necessary' => 1,
					'style' => 'WIDTH: 98%', 
					'default' => '');		

		$ar[] = array('name' => 'buttonUpload', 
					'id' => 'buttonUpload', 
					'type' => 'button', 
					'disabled' => 0,
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'return ajaxFileUpload("fileToUpload");', 
					'value' => 'Загрузить изображение');	
		
		if($news['news_img'])
			{
			$form['elementCaption'][] = ' ';
			$ar[] = array('name' => 'buttonDeleteImg', 
						'id' => 'buttonDeleteImg', 
						'type' => 'button', 
						'disabled' => 0,
						'class' => 'inputArtSubmit',
						'style' => 'WIDTH: 100%', 
						'onClick' => 'deleteImg();', 
						'value' => 'Удалить изображение');	
			$ar[] = array('name' => 'actionDeleteImg', 
						'id' => 'actionDeleteImg', 
						'type' => 'hidden', 
						'default' => $location.'set/deleteImg/');	
			}
		$form['elementCaption'][] = ' ';
		$ar[] = array('name' => 'actionNewImg', 
					'id' => 'actionNewImg', 
					'type' => 'hidden', 
					'default' => $location.'set/upload/');	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}	
	function ShowNewsVisible($isPublic,  $location)/*2008_05_06 кнопка удаления объекта в справочниках */
		{
		$ar[] = array('name' => 'SUBMITVISIBLEOBJ', 
					'id' => 'SUBMITVISIBLEOBJ', 
					'type' => 'button', 
					'disabled' => 0,
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'visibleObj('.$isPublic.');', 
					'value' => ($isPublic)?'Скрывать':'Отображать');	
		$ar[] = array('name' => 'actionVisibleObj', 
					'id' => 'actionVisibleObj', 
					'type' => 'hidden', 
					'default' => $location.'set/visible/');	
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		} 
	function ShowNewsEditBtn($id,  $location)/*2008_05_06 кнопка удаления объекта в справочниках */
		{
		$ar[] = array('name' => 'SUBMITEDITOBJ', 
					'id' => 'SUBMITEDITOBJ', 
					'type' => 'button', 
					'disabled' => 0,
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'editCurObj();', 
					'value' => 'Редактировать');	
		$ar[] = array('name' => 'actionEditObj', 
					'id' => 'actionEditObj', 
					'type' => 'hidden', 
					'default' => $location.'edit/');	
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}	
	function ShowNewsDelete($location)/*2008_05_06 кнопка удаления объекта в справочниках */
		{
		$ar[] = array('name' => 'SUBMITDELETEOBJ', 
					'id' => 'SUBMITDELETEOBJ', 
					'type' => 'button', 
					'disabled' => 0,
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'if (confirmLink("Вы действительно желаете удалить объект?")) deleteObj();', 
					'value' => 'Удалить');	
		$ar[] = array('name' => 'actionDeleteObj', 
					'id' => 'actionDeleteObj', 
					'type' => 'hidden', 
					'default' => $location.'set/delete/');	
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}	
	function showNewsList($order , $location) //27_05_2008 список объектов
		{
		if(is_array($order))
			{
//			$K = 1024; $M = $K*1024;
//			print_r($order);
			$colHeader = array('Название', /*'Категория', */'Дата добавления', 'Просмотры', 'Автор');
			$headerAlign = array('center', 'center', 'center', 'center'/*, 'center'*/);
								
			$dataAlign = array('news_name' => 'left', 'cat_name' => 'left', 'news_date' => 'left', 
							'news_viewCnt' => 'left', 'user_name' => 'left');
								
			$colDataReturned = array('id' => 'news_id', 'news_name' => 'news_name', 'news_date' => 'news_date', 
							'cat_name' => 'cat_name', 'user_name' => 'user_name', 'news_viewCnt' => 'news_viewCnt');
								
			$colAlias = array('news_name', /*'cat_name', */'news_date', 'news_viewCnt', 'user_name');
			$table = array('bodyId' => 'order',
						'headerAlign' => $headerAlign, 
						'colHeader' => $colHeader,
						'colAlias' => $colAlias
						);

			for($i=0; $i<count($order); $i++)
				{
				for($j = 0; $j<count($colAlias); $j++)
					{
					
					$full_ret['content'][$i][$colAlias[$j]] = $order[$i][$colDataReturned[$colAlias[$j]]];						
					$full_ret['align'][$i][$colAlias[$j]] = $dataAlign[$colAlias[$j]];					
					}
//				print_r($full_ret['content']);
				$full_ret['content'][$i]['news_date'] = date('Y-m-d', strtotime($full_ret['content'][$i]['news_date']));
				$full_ret['content'][$i]['news_viewCnt'] = ($full_ret['content'][$i]['news_viewCnt']==0)?'NULL':$full_ret['content'][$i]['news_viewCnt'];
				$full_ret['content'][$i]['id'] = $order[$i]['news_id'];					
				$full_ret['content'][$i]['hidden'] = ($order[$i]['news_public'])?0:1;
//				$full_ret['content'][$i]['doc2catCnt'] = $order[$i]['doc2catCnt'];					
				}
/*				
			if($_SESSION['curNode'])
				{
				$full_ret['selected']  = $_SESSION['curNode'];
				unset($_SESSION['curNode']);				
				}*/
			$full_ret['table']  = $this->TPL_CreateTable($table);	
			}
		else
			{
			$full_ret['noOrder']=1;
			}
		$form = array(
						'action' => '',
						'name' => 'orderForm',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => '');
		$ar[] = array('name' => 'curUrl', 
					'id' => 'IDcurUrl', 
					'type' => 'hidden', 
					'default' => $location);
/*		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);*/
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;								
		}	
	function ShowNewsEdit($layer, $categories, $location)/*2008_05_06 кнопка нового объекта в справочниках */
		{
		$form = array('action' => $location.'set/edit/layer',
						'name' => 'edit_layer',
						'elementCaption' => array('Название')
						);
		$event = 'if (this.value != document.getElementById(\'IDCMP_NAME\').value) {document.getElementById(\'IDSUBMITCATEDITNAME\').disabled = false; } else {document.getElementById(\'IDSUBMITCATEDITNAME\').disabled = true;}';
		$eventExt = 'if (this.value != document.getElementById(\'IDCMP_CATEG\').value) {document.getElementById(\'IDSUBMITCATEDITNAME\').disabled = false; } else {document.getElementById(\'IDSUBMITCATEDITNAME\').disabled = true;}';
		$ar[] = array('name' => 'NAME', 
					'id' => 'IDNAME', 
					'type' => 'text', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => $event, 
					'onkeyup' => $event,
					'necessary' => 0, 
					'default' => $layer['main']['news_name']);
		if(is_array($categories))
			{
			$ar[] = array('name' => 'CATEG', 
						'id' => 'IDCATEG', 
						'type' => 'select', 
						'class' => 'inputArt',
						'style' => 'WIDTH: 98%', 
						'onChange' => $eventExt, 
						'default' => $layer['main']['news_parId'],
						'value' => $categories['value'], 
						'caption' => $categories['text']);	
			$ar[] = array('name' => 'CMP_CATEG', 
						'id' => 'IDCMP_CATEG', 
						'type' => 'hidden', 
						'default' => $layer['main']['news_parId']);
			$form['elementCaption'][] = 'Категория';
			}
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $layer['main']['news_id']);
		$ar[] = array('name' => 'CMP_NAME', 
					'id' => 'IDCMP_NAME', 
					'type' => 'hidden', 
					'default' => $layer['main']['news_name']);
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);
		$submit = array('name' => 'SUBMITCATEDITNAME', 
					'id' => 'IDSUBMITCATEDITNAME', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Изменить', 
					'caption' => 'Изменить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}		
	function ShowNewsEditForm($obj, $category,  $location)/*2008_06_25  кнопка нового слоя в справочниках */
		{
//		$filePath = date('Y-m-d', strtotime($full_ret['content'][$i]['news_date']));
//		print_r($obj);
		$table = array('label' => '',
						'bodyId' => 'object'
						);
		$form = array('action' => $location.'set/editNews',
						'name' => 'info',
						'emptyCheck' => 1,
						'elementCaption' => array('Название', 'URL новости (если совпадает с названием то не заполнять)', 'Категории', 'Краткое описание', 'Основной текст', 'Источник - ссылка', 'Источник - описание'/*, 'Опубликовать сразу'*/, 'Иллюстрации'),
						);
		$ar[] = array('name' => 'title', 
					'id' => 'title', 
					'necessary' => 1,
					'type' => 'text', 
					'group' => 1, 
//					'labelGroup' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['news_name']);		
		$ar[] = array('name' => 'url', 
					'id' => 'url', 
					'necessary' => 0,
					'type' => 'text', 
					'group' => 2, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['news_nameTranslit']);		
		$ar[] = array('name' => 'category', 
					'id' => 'category', 
					'necessary' => 1,
					'type' => 'selectMulty', 
					'group' => 3, 
//					'labelGroup' => 2, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['tags'],
					'value' => $category['value'], 
					'caption' => $category['text']);		
		$ar[] = array('name' => 'head', 
					'id' => 'head', 
					'type' => 'FCKEDITOR', 					
					'fake_necessary' => 1, 
					'height' => 100, 
					'width' => '100%', 
					'group' => 5, 
//					'labelGroup' => 3, 
					'toolbar' => 'Custom', 
					'width' => '100%', 
					'default' => $obj['news_header']);	
		$ar[] = array('name' => 'body', 
					'id' => 'body', 
					'type' => 'FCKEDITOR', 					
					'fake_necessary' => 1, 
					'height' => 200, 
					'width' => '100%', 
					'group' => 4, 
//					'labelGroup' => 4, 
					'toolbar' => 'Custom', 
					'width' => '100%', 
					'default' => $obj['news_body']);
		$ar[] = array('name' => 'srcURL', 
					'id' => 'srcURL', 
					'necessary' => 0,
					'type' => 'text', 
					'group' => 7, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['news_src_url']);		
		$ar[] = array('name' => 'srcCaption', 
					'id' => 'srcCaption', 
					'necessary' => 0,
					'type' => 'text', 
					'group' => 7, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['news_src_caption']);		
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $obj['news_id']);
		$ar[] = array('name' => 'images', 
					'id' => 'images', 
					'type' => 'fileUploader', 
					'group' => 9, 
					'value' => $obj['img'], 
					'action' => $location.'set/fileUpload', 
//					'labelGroup' => 1, 
//					'class' => 'inputArt',
					'default' => array('date' => $obj['news_date'], 'nameTranslit' => $obj['news_nameTranslit']));	
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$submit = array('name' => 'SUBMITINFO', 
					'id' => 'IDSUBMITINFO', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 0,
					'value' => 'Изменить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;		
		}	
	function ShowNewsAddForm($category,  $location)/*2008_06_25  кнопка нового слоя в справочниках */
		{
//		echo $location;
//		print_r($category);
		$table = array('label' => '',
						'bodyId' => 'object'
						);
		$form = array('action' => $location.'set/addNews',
						'name' => 'info',
						'emptyCheck' => 1,
						'elementCaption' => array('Название', 'URL новости (если совпадает с названием то не заполнять)', 'Категория', 'Краткое описание', 'Основной текст',  'Источник - ссылка (без http://)', 'Источник - описание', 'Опубликовать сразу', 'Иллюстрации'),
						);
		$ar[] = array('name' => 'title', 
					'id' => 'title', 
					'necessary' => 1,
					'type' => 'text', 
					'group' => 1, 
//					'labelGroup' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => '');		
		$ar[] = array('name' => 'url', 
					'id' => 'url', 
					'necessary' => 0,
					'type' => 'text', 
					'group' => 2, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => '');		
		$ar[] = array('name' => 'category', 
					'id' => 'category', 
					'necessary' => 1,
					'type' => 'selectMulty', 
					'group' => 3, 
//					'labelGroup' => 2, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['tags'],
					'value' => $category['value'], 
					'caption' => $category['text']);
		$ar[] = array('name' => 'head', 
					'id' => 'head', 
					'type' => 'FCKEDITOR', 					
					'fake_necessary' => 1, 
					'height' => 100, 
					'width' => '100%', 
					'group' => 5, 
//					'labelGroup' => 3, 
					'toolbar' => 'Custom', 
					'width' => '100%', 
					'default' => '');						
		$ar[] = array('name' => 'body', 
					'id' => 'body', 
					'type' => 'FCKEDITOR', 					
					'fake_necessary' => 1, 
					'height' => 200, 
					'width' => '100%', 
					'group' => 6, 
//					'labelGroup' => 4, 
					'toolbar' => 'Custom', 
					'width' => '100%', 
					'default' => '');
		$ar[] = array('name' => 'srcURL', 
					'id' => 'srcURL', 
					'necessary' => 0,
					'type' => 'text', 
					'group' => 7, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['news_src_url']);		
		$ar[] = array('name' => 'srcCaption', 
					'id' => 'srcCaption', 
					'necessary' => 0,
					'type' => 'text', 
					'group' => 7, 
					'class' => 'inputArt',
					'style' => 'WIDTH: 99%', 
					'default' => $obj['news_src_caption']);		
		$ar[] = array('name' => 'published', 
					'id' => 'published', 
					'type' => 'checkbox', 
					'group' => 8, 
					'labelGroup' => 1, 
//					'class' => 'inputArt',
					'default' => 1);	
		$ar[] = array('name' => 'images', 
					'id' => 'images', 
					'type' => 'fileUploader', 
					'group' => 9, 
					'action' => $location.'set/fileUpload', 
//					'labelGroup' => 1, 
//					'class' => 'inputArt',
					'default' => 1);	
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$submit = array('name' => 'SUBMITINFO', 
					'id' => 'IDSUBMITINFO', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 0,
					'value' => 'Создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;		
		}	
	function ShowNewsAdd(/*$parent, */ $location)/*2008_06_25  кнопка нового слоя в справочниках */
		{
		$table = array('bodyId' => 'newsAdd');		
		
		$ar[] = array('name' => 'SUBMITNEWDOC', 
					'id' => 'SUBMITNEWDOC', 
					'type' => 'button', 
					'disabled' => 0,
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'createNews(this)', 
					'value' => 'Создать');		
		$ar[] = array('name' => 'actionNewsAdd', 
					'id' => 'actionNewsAdd', 
					'type' => 'hidden', 
					'default' => $location.'newsAdd/');			
/*		$ar[] = array('name' => 'parent', 
					'id' => 'parent', 
					'type' => 'hidden', 
					'default' => $parent);	*/		
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
//		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
//		$full_ret['form']  = $this->TPL_CreateForm($form);	
		return $full_ret;
		}	
	function ShowCategoryAdd($location)/*2008_06_25  кнопка нового слоя в справочниках */
		{
		$form = array(/*'action' => $location.'set/edit',
						'name' => 'edit_layer',*/
						'elementCaption' => array('Название'));
		$event = 'if (this.value != "") {document.getElementById("SUBMITADDCAT").disabled = false; } else {document.getElementById("SUBMITADDCAT").disabled = true;}';
		$ar[] = array('name' => 'NAME', 
					'id' => 'NAME', 
					'type' => 'text', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => $event, 
					'onkeyup' => $event,
					'necessary' => 1, 
					'default' => '');
		$ar[] = array('name' => 'SUBMITADDCAT', 
					'id' => 'SUBMITADDCAT', 
					'type' => 'button', 
					'disabled' => 1,
					'class' => 'inputArtSubmit',
					'style' => 'WIDTH: 100%', 
					'onClick' => 'createCategory(this)', 
					'value' => 'Создать');	
		$ar[] = array('name' => 'actionCreateCategory', 
					'id' => 'actionCreateCategory', 
					'type' => 'hidden', 
					'default' => $location.'set/addCategory/');	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}		
	function ShowNewsForm($location)/*2008_06_25 вспомогательная форма для слоёв*/
		{
		$form = array(
						'action' => '',
						'name' => 'orderForm',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => '');
		$ar[] = array('name' => 'curUrl', 
					'id' => 'IDcurUrl', 
					'type' => 'hidden', 
					'default' => $location);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}
		
/******************GETTERS***********************************************************************/	

	function getLastEvents($num) 	//2014 03 14    Поиск последних и важных (рекламных событий) по дате
		{		
		$advTagName = 'реклама';
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$limitAdd = ($num)?' limit '.$num.' ':'';
		$query = 'SELECT  *	FROM `gd_news`, `gd_news2cat` , `gd_newsCateg` 
					WHERE gd_news2cat.news_id = gd_news.news_id
					AND gd_news2cat.cat_id = gd_newsCateg.cat_id
					AND news_public = 1 
					AND cat_name LIKE \''.trim($advTagName).'\'
					ORDER BY news_date DESC, news_name
					'.$limitAdd;
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', );
		$LNK= new DBLink;		
		$ret = $retAdd = array();
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($advNum = $LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);			
			}
//		else 
		if($advNum < $num)
			{
			$retAdd = $this->getLastNews($num-$advNum, 2);
//			array_push($ret, );
			}
//		$LNK->Close_link();
		return array_merge($ret,  $retAdd);				
		}	
	function getCurTagSimple($id)
		{
		$query = 'SELECT gd_newsCateg.cat_id AS catId, cat_name, counter_news, counter_doc, is_sys 
					FROM `gd_newsCateg` 
					WHERE cat_id='.intval($id).'				';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{					
			$ret = $LNK->GetData(array('catId', 'cat_name', 'counter_news', 'counter_doc', 'is_sys'), false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getCurNewsSimple($id)
		{
		$query = 'SELECT *
					FROM `gd_news`
					WHERE news_id='.intval($id).'				';
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_nameTranslit', 'news_header', 'news_body', 'news_img', 'news_parId', 'news_author', 'news_public', 'news_viewCnt', 'news_date', 'cat_id', 'cat_name', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{					
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getAllNewsListIndexService()	//2013 09 19    Получение всех новостей для создания индекса
		{
		$query = 'SELECT  *	FROM `gd_news` ';
		$ret_arr  = array('news_id', 'news_parId', 'news_name' , 'news_body');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}

	function getCatsFromList($recordType, $columnType, $list) 	//2013 11 01    отдает категории по списку (либо по id либо по имени)
		{	
		if($columnType == 'name')
			{
			$column = 'cat_name';
			$operator = ' LIKE ';
			}
		else
			{
			$column = 'cat_id';
			$operator = ' = ';
			}
		$whereList	= 'AND ( ';
		for($i=0; $i<sizeof($list); $i++)
			{
			$whereList .= (!$i)?'' : ' OR ';
			$whereList .= $column.$operator.' \''.$list[$i].'\' ';
			}
		$whereList .= ')';
		$row = array('1' => 'counter_news', '2' => 'counter_doc');
		$templ = "SELECT *  FROM `gd_newsCateg` WHERE  counter_news != 0 AND (cat_name LIKE 'детский сад' OR cat_name LIKE 'услуги няни')		";
		$query = 'SELECT  gd_newsCateg.cat_id AS catId, cat_name, counter_news, counter_doc, is_sys 
					FROM `gd_newsCateg` 
					WHERE  '.$row[$recordType].' != 0 '.$whereList.'
					ORDER BY cat_name';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData(array('catId', 'cat_name', 'counter_news', 'counter_doc', 'is_sys'), true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getCatListNoEmptyUser($recordType) 	//2013 07 25    Поиск всех непустых категорий
		{		
		$row = array('1' => 'counter_news', '2' => 'counter_doc');
		$query = 'SELECT  gd_newsCateg.cat_id AS catId, cat_name, counter_news, counter_doc, is_sys FROM `gd_newsCateg` 
					WHERE  '.$row[$recordType].' != 0 
					AND is_sys = 0
					ORDER BY cat_name';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData(array('catId', 'cat_name', 'counter_news', 'counter_doc', 'is_sys'), true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getCatListNoEmpty() 	//2013 07 25    Поиск всех непустых категорий
		{		
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$query = 'SELECT  distinct cat_id FROM `gd_news2cat`';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData(array('cat_id'), true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getNewsCntOfKeyword($catId,  $recordType) 	//2013 07 25    Поиск статей по ключевым  словам - колисечтво
		{		
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$query = 'SELECT  COUNT(*)	FROM `gd_news`, `gd_news2cat`
					WHERE news_parId = '.$recordType.' 
					AND gd_news2cat.news_id = gd_news.news_id
					AND news_public = 1 
					AND gd_news2cat.cat_id  = \''.intval($catId).'\'';
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData('COUNT(*)', false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getTagCnt($id, $onlyCnt) /*2013_07_25 вытаскивает все yjdjcnb для новости*/
		{
		$rows = ($onlyCnt)?'COUNT(*)':' gd_newsCateg.cat_id AS catId, cat_name, counter_news, counter_doc ';
		$queryCat = 'SELECT '.$rows.'
						FROM `gd_newsCateg`, `gd_news2cat`  
					WHERE gd_news2cat.cat_id = gd_newsCateg.cat_id 
					AND news_id='.intval($id).'';
		$ret_arr_cat  = array('catId', 'cat_name', 'counter_news', 'counter_doc');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($queryCat);
		if($onlyCnt)
			$ret = $LNK->GetData('COUNT(*)', false);
		else
			$ret = $LNK->GetData($ret_arr_cat, true);
		return $ret;				
		}

	function getNewsTags($id) /*2013_07_08 вытаскивает все кейворды для новости*/
		{
		$queryCat = 'SELECT  gd_newsCateg.cat_id AS catId, cat_name, counter_news, counter_doc FROM `gd_newsCateg`, `gd_news2cat`  
					WHERE gd_news2cat.cat_id = gd_newsCateg.cat_id 
					AND news_id='.intval($id).'';
		$ret_arr_cat  = array('catId', 'cat_name', 'counter_news', 'counter_doc');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($queryCat);
		$ret = $LNK->GetData($ret_arr_cat, true);
		return $ret;				
		}

	function getNewsImages($id)
		{
		$queryImg = 'SELECT  * FROM `gd_newsImg`
					WHERE news_id='.intval($id).' ORDER BY img_src';
		$ret_arr_img  = array('img_src', 'img_title');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($queryImg);
		if($LNK->GetNumRows())
			{					
			$ret = $LNK->GetData($ret_arr_img, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getNewsOfKeywordLast($key,  $recordType, $num) 	//2013 11 05    Поиск статей по ключевым  словам по дате
		{		
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$limitAdd = ($num)?' limit '.$num.' ':'';
		$query = 'SELECT  *	FROM `gd_news`, `gd_news2cat` , `gd_newsCateg` 
					WHERE news_parId = '.$recordType.' 
					AND gd_news2cat.news_id = gd_news.news_id
					AND gd_news2cat.cat_id = gd_newsCateg.cat_id
					AND news_public = 1 
					AND cat_name LIKE \''.trim($key).'\'
					ORDER BY news_date DESC, news_name
					'.$limitAdd;
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', );
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getNewsOfKeywordMostViewed($key,  $recordType, $num) 	//2013 07 15    Поиск статей по ключевым  словам
		{		
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$limitAdd = ($num)?' limit '.$num.' ':'';
		$order =  ($num)?'  news_viewCnt DESC, news_name ': ' news_name ';
		$query = 'SELECT  *	FROM `gd_news`, `gd_news2cat` , `gd_newsCateg` 
					WHERE news_parId = '.$recordType.' 
					AND gd_news2cat.news_id = gd_news.news_id
					AND gd_news2cat.cat_id = gd_newsCateg.cat_id
					AND news_public = 1 
					AND cat_name LIKE \''.trim($key).'\'
					ORDER BY '.$order.'
					'.$limitAdd;
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', );
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}		
	function getNewsOfKeyword($key,  $recordType) 	//2013 07 15    Поиск статей по ключевым  словам
		{		
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$query = 'SELECT  *	FROM `gd_news`, `gd_news2cat` , `gd_newsCateg` 
					WHERE news_parId = '.$recordType.' 
					AND gd_news2cat.news_id = gd_news.news_id
					AND gd_news2cat.cat_id = gd_newsCateg.cat_id
					AND news_public = 1 
					AND cat_name LIKE \''.trim($key).'\'
					ORDER BY news_date DESC
					';
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', );
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getNewsNeighbour($date, $direction)
		{		
		$orderStr = ($direction) ? ' > '.$date.' ORDER BY news_date ASC ': ' < '.$date.' ORDER BY news_date DESC ';
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$query = 'SELECT  *	FROM `gd_news`
					WHERE news_parId = 1 
					AND news_public = 1 
					AND UNIX_TIMESTAMP(news_date) '.$orderStr;
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;
		}
	function getCurrentDoc($interval, $name)
		{
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$query = 'SELECT  *	FROM `gd_news`, `users`  
					WHERE news_parId = 2 
					AND news_author = user_id 
					AND news_public = 1 
					AND UNIX_TIMESTAMP(news_date) >= '.$interval['start'].' 
					AND UNIX_TIMESTAMP(news_date) < '.$interval['end'].' 					
					AND news_nameTranslit  LIKE \''.trim($name).'\'';
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date',  'news_dateUpd', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getNewsOfNameAndDate($interval, $name)
		{		
//		$query = 'SELECT  *	FROM `gd_firm` WHERE firm_nameTranslit LIKE \''.trim($letter).'\'';
		$query = 'SELECT  *	FROM `gd_news`, `users`  
					WHERE news_parId = 1 
					AND news_author = user_id 
					AND news_public = 1 
					AND UNIX_TIMESTAMP(news_date) >= '.$interval['start'].' 
					AND UNIX_TIMESTAMP(news_date) < '.$interval['end'].' 					
					AND news_nameTranslit  LIKE \''.trim($name).'\'';
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, false);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getNewsOfDateInterval($interval, $recordType, $onlyCnt)
		{		
		$rows = ($onlyCnt)?'COUNT(*)':'*';
		$query = 'SELECT  '.$rows.'	FROM `gd_news`, `users`  
					WHERE news_parId = '.$recordType.' 
					AND news_author = user_id 
					AND news_public = 1 
					AND UNIX_TIMESTAMP(news_date) >= '.$interval['start'].' 
					AND UNIX_TIMESTAMP(news_date) < '.$interval['end'].' 					
				ORDER BY news_date DESC';
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{	
			if($onlyCnt)
				$ret = $LNK->GetData('COUNT(*)', false);
			else
				$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getNewsImgAndTags($id) /*2013_07_08 вытаскивает все картинки и кейворды для новости*/
		{
		$queryCat = 'SELECT  gd_newsCateg.cat_id AS catId, cat_name FROM `gd_newsCateg`, `gd_news2cat`  
					WHERE gd_news2cat.cat_id = gd_newsCateg.cat_id 
					AND is_sys = 0
					AND news_id='.intval($id).'';
		$queryImg = 'SELECT  * FROM `gd_newsImg`
					WHERE news_id='.intval($id).' ORDER BY img_src';
		$ret_arr_cat  = array('catId', 'cat_name');
		$ret_arr_img  = array('img_src', 'img_title');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($queryCat);
		$ret['tags'] = $LNK->GetData($ret_arr_cat, true);
		$LNK->Query($queryImg);
		$ret['img'] = $LNK->GetData($ret_arr_img, true);
/*		else 
			$ret = 0;*/
//		$LNK->Close_link();
		return $ret;				
		}
	function getCurNews($id)
		{
		$query = 'SELECT *
					FROM `gd_news`
					WHERE news_id='.intval($id).'				';
		$queryCat = 'SELECT  gd_newsCateg.cat_id AS catId, cat_name FROM `gd_newsCateg`, `gd_news2cat`  
					WHERE gd_news2cat.cat_id = gd_newsCateg.cat_id 
					AND news_id='.intval($id).'';
		$queryImg = 'SELECT  * FROM `gd_newsImg`
					WHERE news_id='.intval($id).' ORDER BY img_src';
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_nameTranslit', 'news_header', 'news_body', 'news_img', 'news_parId', 'news_author', 'news_public', 'news_viewCnt', 'news_date', 'cat_id', 'cat_name', 'user_name');
		$ret_arr_cat  = array('catId', 'cat_name');
		$ret_arr_img  = array('img_src', 'img_title');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{					
			$ret = $LNK->GetData($ret_arr, false);
			$LNK->Query($queryCat);
			$ret['tags'] = $LNK->GetData($ret_arr_cat, true);
			$LNK->Query($queryImg);
			$ret['img'] = $LNK->GetData($ret_arr_img, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}

	function getNewsCategories()
		{
		$query = 'SELECT  *	FROM `gd_newsCateg`  ORDER BY cat_name';
		$ret_arr  = array('cat_id', 'cat_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
			$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getAllDocs()
		{
		$recordType = 2;
		$query = 'SELECT  *	FROM `gd_news`, `users`  
			WHERE news_parId = '.$recordType.' 
			AND news_author = user_id 
			AND news_public = 1 
			ORDER BY news_name '; //news_viewCnt DESC,  
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}	
	function getLastNews($limit, $recordType)
		{
		$query = 'SELECT  *	FROM `gd_news`, `users`  
			WHERE news_parId = '.$recordType.' 
			AND news_author = user_id 
			AND news_public = 1 
			ORDER BY news_date DESC LIMIT '.$limit;
		$ret_arr  = array('news_id', 'news_name', 'news_src', 'news_header', 'news_body', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}
	function getNewsList($recordType)
		{
		$query = 'SELECT  *	FROM `gd_news`, `users`  
					WHERE news_parId = '.$recordType.' 
						AND news_author = user_id 
						ORDER BY news_date DESC';
		$ret_arr  = array('news_id', 'news_name', 'news_header', 'news_src', 'news_nameTranslit', 'news_parId', 'news_author', 'news_img',  'news_public', 'news_viewCnt', 'news_date', 'cat_name', 'user_name');
		$LNK= new DBLink;		
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);
		$LNK->Query($query);
		if($LNK->GetNumRows())
			{		
			$ret = $LNK->GetData($ret_arr, true);
			}
		else 
		$ret = 0;
//		$LNK->Close_link();
		return $ret;				
		}

/******************SETTERS***********************************************************************/
	function updNewsCategoryCounter($id, $cnt, $type) /*25_07_13*/
		{
		$LNK= new DBLink;				
		$row = array('1' => 'counter_news', '2' => 'counter_doc');
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_newsCateg` SET '.$row[$type].' = '.$cnt.' WHERE cat_id = \''.intval($id).'\'';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}		
	function decNewsCategoryCounter($id, $type) /*25_07_13*/
		{
		$LNK= new DBLink;				
		$row = array('1' => 'counter_news', '2' => 'counter_doc');
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_newsCateg` SET '.$row[$type].' = '.$row[$type].' - 1 WHERE cat_id = \''.intval($id).'\'';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}		
	function incNewsCategoryCounter($id, $type) /*25_07_13*/
		{
		$LNK= new DBLink;				
		$row = array('1' => 'counter_news', '2' => 'counter_doc');
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_newsCateg` SET '.$row[$type].' = '.$row[$type].' + 1 WHERE cat_id = \''.intval($id).'\'';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}		
	function incNewsViews($id) /*16_07_13*/
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_news` SET news_viewCnt = news_viewCnt + 1 WHERE news_id = \''.intval($id).'\'';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}		
	function deleteImg2News($newsId, $img)
		{
		$LNK= new DBLink;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$imgAdd = ($img != '')? ' AND img_src = \''.$img.'\'' : $img;
		$queryDelete = 'DELETE  from `gd_newsImg` WHERE  news_id = \''.$newsId.'\' '.$imgAdd;
		$LNK->Query($queryDelete);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}		
	function updateImg2News($newsId, $img, $title)
		{
		$LNK= new DBLink;	
		$queryUp = 'UPDATE `gd_newsImg` SET img_title = \''.$title.'\' WHERE img_src = \''.$img.'\' AND  news_id = \''.$newsId.'\'';
		$LNK->Query($queryUp);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}		
	
	function addImg2News($newsId, $img, $title)
		{
		$LNK= new DBLink;	
		$queryAdd = 'INSERT into `gd_newsImg` SET img_src = \''.$img.'\',  news_id = \''.$newsId.'\',  img_title = \''.$title.'\'';
		$LNK->Query($queryAdd);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}		
	function addNews2Cat($newsId, $catId)
		{
		$LNK= new DBLink;	
		$queryAdd = 'INSERT into `gd_news2cat` SET cat_id = \''.trim($catId).'\',  news_id = \''.trim($newsId).'\'';
		$LNK->Query($queryAdd);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}	
	function deleteNewsFromCat($newsId)
		{
		$LNK= new DBLink;	
		$queryDelete = 'delete from `gd_news2cat` WHERE news_id = \''.intval($newsId).'\'';
		$LNK->Query($queryDelete);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}	
	function deleteImg($obj)
		{
		global $CONST;
		$LNK= new DBLink;	
		$queryDelete = 'update `gd_news` set news_img = \'\'  WHERE news_id = \''.intval($obj['news_id']).'\'';
		$LNK->Query($queryDelete);
		if ($obj['news_img'])
			{
			$delFile = trim($CONST['relPathPref']).$obj['news_img'];
			if(is_file($delFile))
				unlink($delFile);
			}
		}		
	function deleteNews($id)
		{
		$LNK= new DBLink;	
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$this->deleteNewsFromCat($id);
		$this->deleteImg2News($id, '');
		$queryDelete = 'delete from `gd_news` WHERE news_id = \''.$id.'\'';
		$LNK->Query($queryDelete);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;
		}
	function updateNews($id, $param)
		{
		$LNK= new DBLink;				
//		$LNK->SetDebug(__FILE__, __FUNCTION__, __LINE__);	
		$queryInsert = 'UPDATE `gd_news` SET ';
		$queryAdd = '';
		if (isset($param['name']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_name = \''.trim($param['name']).'\' ';
			}
		if (isset($param['nameTranslit']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_nameTranslit = \''.trim($param['nameTranslit']).'\' ';
			}
		if (isset($param['category']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_parId = \''.intval($param['category']).'\' ';
			}
		if (isset($param['public']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_public = \''.intval($param['public']).'\' ';
			}
		if (isset($param['src']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_src = \''.trim($param['src']).'\' ';
			}
		if (isset($param['body']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_body = \''.trim($param['body']).'\' ';
			}
		if (isset($param['dateUp']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_dateUpd = FROM_UNIXTIME(\''.time().'\')';
			}
/*		if (isset($param['date']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_date = FROM_UNIXTIME(\''.time().'\')';
			}*/
		if (isset($param['header']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_header = \''.trim($param['header']).'\' ';
			}
		if (isset($param['img']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_img = \''.trim($param['img']).'\' ';
			}
		if (isset($param['views']))
			{
			$queryAdd .= ($queryAdd)?', ':'';
			$queryAdd .= 'news_viewCnt = news_viewCnt+1 ';
			}
		if($queryAdd)
			{
			$queryInsert .= $queryAdd.' WHERE news_id=\''.intval($id).'\'';
			
			$LNK->Query($queryInsert);
			if($LNK->error)
				{
				$ret['error'] = 1;
				$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
				}
			else
				{
				$ret['error'] = 0;
				$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
				}
			}
		else
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = 'There is nothing to change!';// = $LNK->error_string;
			}
		return $ret;		
		}	
	function createCategory($name)
		{
		$LNK= new DBLink;				
		$queryInsert = 'INSERT into `gd_newsCateg` SET cat_name = \''.trim($name).'\'';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}		
	function createNews($param)
		{
		$LNK= new DBLink;				
		$queryInsert = 'INSERT 	into `gd_news` SET news_name = \''.$param['name'].'\', 
								news_parId = \''.$param['category'].'\', 
								news_body = \''.$param['body'].'\', 
								news_author = \''.$param['auth'].'\', 
								news_nameTranslit = \''.$param['nameTranslit'].'\', 
								news_header = \''.$param['header'].'\', 
								news_public = \''.$param['published'].'\', 
								news_src = \''.$param['src'].'\', 
								news_date = FROM_UNIXTIME(\''.time().'\') 
								';
		$LNK->Query($queryInsert);
		if($LNK->error)
			{
			$ret['error'] = 1;
			$ret['errorMsg'] = $LNK->error_string;// = $LNK->error_string;
			}
		else
			{
			$ret['error'] = 0;
			$ret['last_id'] = $LNK->last_id;// = $LNK->error_string;
			}
		return $ret;		
		}	
	}
?>