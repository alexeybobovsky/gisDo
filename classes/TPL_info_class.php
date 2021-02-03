<?
class INFOADMIN_TEMPLATE extends TEMPLATE  
	{
	function ShowDelInfoBlock($nodeId, $location)/*28_05_2007*/
		{
		$table = array(
						'label' => 'Удаление',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/set/delInfo/',
						'name' => 'delCat'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $nodeId);
		$submit = array('name' => 'SUBMITARTDEL', 
					'id' => 'IDSUBMITARTDEL', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'value' => 'Удалить информационный блок', 
					'caption' => 'Удвлить!');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
		}
	
	function editNode($parId, $catList, $content, $location) /*29_05_07*/
		{
//		print_r($content);
		$form = array(
						'action' => $location.'set/edit/',
						'name' => 'Art_ADD',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Редактирование раздела',
						'bodyId' => 'Article',
						'colHeader' => array('Имя блока (адрес)', 'Краткий заголовок (в меню)', 'Подробный заголовок (на странице)',
						'Очередность', 'Текст', 'Показывать в меню')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$addJSToShort = "if (!fullTitleLocked) {document.getElementById('IDtitleFull').value = this.value;} ";
		$addJSToFull = "if(this.value){fullTitleLocked = 1; } else { fullTitleLocked = 0; };";
		$ar[] = array('name' => 'NAME', 
					'id' => 'IDNAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['catalog']['sc_name']
					);
		$ar[] = array('name' => 'titleShort', 
					'id' => 'IDtitleShort', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => $addJSToShort.'EmptyCheck(this.form)',
					'onkeyup' => $addJSToShort.'EmptyCheck(this.form)',
					'default' => $content['body']['caption']
					);
		$ar[] = array('name' => 'titleFull', 
					'id' => 'IDtitleFull', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => $addJSToFull.'EmptyCheck(this.form)',
					'onkeyup' => $addJSToFull.'EmptyCheck(this.form)',
					'default' => ($content['body']['title'])?$content['body']['title']:$content['body']['caption']
					);
		$ar[] = array('name' => 'order', 
					'id' => 'IDCategory', 
					'type' => 'select', 
					'style' => 'WIDTH: 100%', 
					'onChange' => '',
					'default' => $catList['default'],
					'value' => $catList['value'], 
					'caption' => $catList['text']);					
		$ar[] = array('name' => 'BODY', 
					'id' => 'IDBODY', 
					'type' => 'FCKEDITOR', 
					'fake_necessary' => 1, 
					'height' => 300, 
					'width' => '100%', 
					'default' => $content['body']['textblock']
					);
		$ar[] = array('name' => 'isMenu', 
					'id' => 'IDisMenu', 
					'type' => 'checkbox', 
					'class' => 'input2', 
					'disabled' => 0,
					'default' => ($content['catalog']['sc_menu'])?1:0);
		$ar[] = array('name' => 'parNodeId', 
					'id' => 'IDparNodeId', 
					'type' => 'hidden', 
					'default' => $parId);
					
		$ar[] = array('name' => 'oldName', 
					'type' => 'hidden', 
					'default' => $content['catalog']['sc_name']);
		$ar[] = array('name' => 'oldTitleShort', 
					'type' => 'hidden', 
					'default' => $content['body']['caption']);
		$ar[] = array('name' => 'oldTitleFull', 
					'type' => 'hidden', 
					'default' => ($content['body']['title'])?$content['body']['title']:$content['body']['caption']);
		$ar[] = array('name' => 'oldOrder', 
					'type' => 'hidden', 
					'default' => $catList['default']);
		$ar[] = array('name' => 'oldMenu', 
					'type' => 'hidden', 
					'default' => ($content['catalog']['sc_menu'])?1:0);
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 0,
					'value' => 'Изменить', 
					'caption' => 'создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);
			}
		return $full_ret;						
		}
	function newInfo($parId, $location) /*29_05_07*/
		{
		$form = array(
						'action' => $location.'set/addInfo/',
						'name' => 'Art_ADD',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Добавление информационного блока',
						'bodyId' => 'Article',
						'colHeader' => array( 'Текст')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$ar[] = array('name' => 'BODY', 
					'id' => 'IDBODY', 
					'type' => 'FCKEDITOR', 
					'fake_necessary' => 1, 
					'height' => 300, 
					'width' => '100%', 
					'default' => ''
					);
		$ar[] = array('name' => 'parNodeId', 
					'id' => 'IDparNodeId', 
					'type' => 'hidden', 
					'default' => $parId);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 0,
					'value' => 'создать', 
					'caption' => 'создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		return $full_ret;						
		}
	function newNode($parId, $catList, $location) /*29_05_07*/
		{
		$form = array(
						'action' => $location.'set/add/',
						'name' => 'Art_ADD',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Добавление раздела',
						'bodyId' => 'Article',
						'colHeader' => array('Имя блока (адрес)', 'Краткий заголовок (в меню)', 'Подробный заголовок (на странице)',
						'Очередность', 'Текст', 'Показывать в меню')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$addJSToShort = "if (!fullTitleLocked) {document.getElementById('IDtitleFull').value = this.value;} ";
		$addJSToFull = "if(this.value){fullTitleLocked = 1; } else { fullTitleLocked = 0; };";
		$ar[] = array('name' => 'NAME', 
					'id' => 'IDNAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => ''
					);
		$ar[] = array('name' => 'titleShort', 
					'id' => 'IDtitleShort', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => $addJSToShort.'EmptyCheck(this.form)',
					'onkeyup' => $addJSToShort.'EmptyCheck(this.form)',
					'default' => ''
					);
		$ar[] = array('name' => 'titleFull', 
					'id' => 'IDtitleFull', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => $addJSToFull.'EmptyCheck(this.form)',
					'onkeyup' => $addJSToFull.'EmptyCheck(this.form)',
					'default' => ''
					);
		$ar[] = array('name' => 'order', 
					'id' => 'IDCategory', 
					'type' => 'select', 
					'style' => 'WIDTH: 100%', 
					'onChange' => '',
					'default' => $catList['default'],
					'value' => $catList['value'], 
					'caption' => $catList['text']);					
		$ar[] = array('name' => 'BODY', 
					'id' => 'IDBODY', 
					'type' => 'FCKEDITOR', 
					'fake_necessary' => 1, 
					'height' => 300, 
					'width' => '100%', 
					'default' => ''
					);
		$ar[] = array('name' => 'isMenu', 
					'id' => 'IDisMenu', 
					'type' => 'checkbox', 
					'class' => 'input2', 
					'disabled' => 0,
					'default' => '1');
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);
		$ar[] = array('name' => 'parNodeId', 
					'id' => 'IDparNodeId', 
					'type' => 'hidden', 
					'default' => $parId);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 1,
					'value' => 'создать', 
					'caption' => 'создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		return $full_ret;						
		}
	function ShowNewInfo($curNode, $location)/*29_05_2007*/
		{
		$table = array(
						'label' => 'Новая статья',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/newBody/',
						'name' => 'newArticle'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNodeInfo', 
					'id' => 'IDcurNodeInfo', 
					'type' => 'hidden', 
					'default' => $curNode);
		$submit = array('name' => 'SUBMITCreateInfo', 
					'id' => 'IDSUBMITCreateInfo', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
//					'style' => 'WIDTH: 95%', 
//					'disabled' => 1,
					'value' => 'Добавить информационный блок', 
					'caption' => 'создать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}		
	function ShowBrothers($nodeId, $catList, $location) /*29_05_2007*/
		{
		global $ICNT;// = new GetArticle;
		$cat  = $ICNT->GetCurNode($nodeId, 0);
//		print_r($catList['default']);
		$form = array('action' => $location.'/set/editOrder/',
						'name' => 'newCat',
						'elementCaption' => array('Очередность')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$event = 'if (this.value != document.getElementById(\'IDcurOrder\').value) {document.getElementById(\'IDSUBMITORDER\').disabled = false; } else {document.getElementById(\'IDSUBMITORDER\').disabled = true;}';
		$ar[] = array('name' => 'Order', 
					'id' => 'IDOrder', 
					'type' => 'select', 
//					'style' => 'WIDTH:  95%', 
					'class' => 'inputArt',
					'onChange' => $event,
					'default' => $catList['default'],
					'value' => $catList['value'], 
					'caption' => $catList['text']);					
		$ar[] = array('name' => 'curOrNode', 
					'id' => 'IDcurOrNode', 
					'type' => 'hidden', 
					'default' => $nodeId);
		$ar[] = array('name' => 'curOrder', 
					'id' => 'IDcurOrder', 
					'type' => 'hidden', 
					'default' => $cat['catalog']['sc_order']);
		$submit = array('name' => 'SUBMITORDER', 
					'id' => 'IDSUBMITORDER', 
					'type' => 'submit', 
//					'style' => 'WIDTH:  95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Изменить очередность', 
					'caption' => 'изменить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}	
	function ShowParents($nodeId, $catList, $location) /*28_05_2007*/
		{
		global $ICNT;// = new GetArticle;
		$cat  = $ICNT->GetCurNode($nodeId, 0);
		//print_r($cat);
		$form = array('action' => $location.'/set/editPar/',
						'name' => 'newCat',
						'elementCaption' => array('Родительская категория')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$event = 'if (this.value != document.getElementById(\'IDcurCat\').value) {document.getElementById(\'IDSUBMITCATEDITCAT\').disabled = false; } else {document.getElementById(\'IDSUBMITCATEDITCAT\').disabled = true;}';
		$ar[] = array('name' => 'Category', 
					'id' => 'IDCategory', 
					'type' => 'select', 
//					'style' => 'WIDTH:  95%', 
					'class' => 'inputArt',
					'onChange' => $event,
					'default' => $cat['catalog']['sc_parId'],
					'value' => $catList['value'], 
					'caption' => $catList['text']);					
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $nodeId);
		$ar[] = array('name' => 'curCat', 
					'id' => 'IDcurCat', 
					'type' => 'hidden', 
					'default' => $cat['catalog']['sc_parId']);
		$submit = array('name' => 'SUBMITCATEDITCAT', 
					'id' => 'IDSUBMITCATEDITCAT', 
					'type' => 'submit', 
//					'style' => 'WIDTH:  95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Изменить родителя', 
					'caption' => 'изменить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}	
	function ShowDelInfo($nodeId, $location)/*28_05_2007*/
		{
		$table = array(
						'label' => 'Удаление',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/set/del/',
						'name' => 'delCat'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $nodeId);
		$submit = array('name' => 'SUBMITARTDEL', 
					'id' => 'IDSUBMITARTDEL', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'value' => 'Удалить раздел', 
					'caption' => 'Удвлить!');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
		}
	function ShowEdit($nodeId, $location) /*28_05_2007*/
		{
		$table = array(
						'label' => 'Редактирование содержания',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/edit/',
						'name' => 'newArticle'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNodeSUBMIT', 
					'id' => 'IDcurNodeSUBMIT', 
					'type' => 'hidden', 
					'default' => $nodeId);
		$submit = array('name' => 'SUBMITART', 
					'id' => 'IDSUBMITART', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
//					'disabled' => 1,
					'value' => 'Редактировать блок', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;		
		}
	function ShowNew($node, $location) /*28_05_2007*/
		{
//		echo $node;
		$table = array(
						'label' => 'Новая статья',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/new/',
						'name' => 'newArticle'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNodeSUBMIT', 
					'id' => 'IDcurNodeSUBMIT', 
					'type' => 'hidden', 
					'default' => $node);
		$submit = array('name' => 'SUBMITCreate', 
					'id' => 'IDSUBMITCreate', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
//					'style' => 'WIDTH: 95%', 
//					'disabled' => 1,
					'value' => 'Создать раздел', 
					'caption' => 'создать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}	
	function ShowMenu($node, $location) /*16_08_2007*/
		{
		global $ICNT;// = new GetArticle;
		$curNode  = $ICNT->GetCurNode($node, 0);
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/set/menu/',
						'name' => 'status'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		
		$value = ($curNode['catalog']['sc_menu'])?'Убрать раздел из меню':'Добавить раздел в меню';
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['catalog']['sc_id']);
		$submit = array('name' => 'SUBMITSTATUS', 
					'id' => 'IDSUBMITSTATUS', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
//					'disabled' => 1,
					'value' => $value, 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}	
	function ShowStatus($node, $location) /*28_05_2007*/
		{
		global $ICNT;// = new GetArticle;
		$curNode  = $ICNT->GetCurNode($node, 0);
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'/set/status/',
						'name' => 'status'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		
		$value = ($curNode['catalog']['sc_published'])?'Скрыть раздел':'Открыть раздел';
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['catalog']['sc_id']);
		$submit = array('name' => 'SUBMITSTATUS', 
					'id' => 'IDSUBMITSTATUS', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
//					'disabled' => 1,
					'value' => $value, 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}	
	
	function ShowArchive()
		{
		$form = array(
						'action' => '',
						'name' => 'articleForm',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => '');
		$ar[] = array('name' => 'curType', 
					'id' => 'IDcurType', 
					'type' => 'hidden', 
					'default' => '');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;								
		}		
	function getPropertiesForm()
		{
		global $CONST;
		$table = array(
						'label' => 'Опции',
						'bodyId' => 'category'
//						'colHeader' => array('Добавить', 'Редактировать', 'Удалить')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		return $full_ret;						
		}
	function getTree($tree)
		{
//		print_r($tree);
		global $CONST;
		global $ACL;
		$table = array(
						'label' => 'Структура сайта',
						'bodyId' => 'TREE'						
						);
		$CONT =  new GetContent;

		$full_ret['lang'] = $CONT->GetAllLanguages(2);
		$full_ret['lang'][0] = 'any';
		$full_ret['table_tree'] = $this->TPL_CreateTable($table);
		
		$tr= array();
		if(isset($_SESSION['curNode']))
			{
			for($i=0; $i<count($tree); $i++)
				{
				$this->Reset();
				$this->GetParents($tree[$i]['catalog']['sc_parId'], $tree, $i);
//			print_r($this->parents);
				$tree[$i]['parents'] = $this->parents;
				if($tree[$i]['catalog']['sc_id'] == $_SESSION['curNode'])
					{
					$visibleNodes = $this->parents;
					$curNode['id'] = $_SESSION['curNode'];
					$curNode['right'] = $ACL->GetClosedParentRight($_SESSION['curNode']);
					$full_ret['curNode'] = $curNode;
//				print_r($visibleNodes);
					unset($_SESSION['curNode']);				
					}
				}
			}
		$cnt = 0;
		for($i=0; $i<count($tree); $i++)
			{
			$name = '';
			$info = 0;
			for($n=0; $n<count($tree[$i]['body']); $n++)
				{
				if($tree[$i]['body'][$n]['name'] == 'caption')
					$name = $tree[$i]['body'][$n]['value'];
				if($tree[$i]['body'][$n]['name'] == 'textblock')
					$info++;
				}
			$tr[$cnt]['name'] = ($name)?$name:$tree[$i]['catalog']['sc_name'];
/*				$tr[$cnt]['name'] = $name.' ('.$tree[$i]['catalog']['sc_name'].')';
			else
				$tr[$cnt]['name'] = $tree[$i]['catalog']['sc_name'];*/
			$tr[$cnt]['published'] = $tree[$i]['catalog']['sc_published'];
			$tr[$cnt]['path'] = $tree[$i]['path'];
			$tr[$cnt]['nodeName'] = $tree[$i]['catalog']['sc_name'];
			$tr[$cnt]['id'] = $tree[$i]['catalog']['sc_id'];
			$tr[$cnt]['level'] = $tree[$i]['level'];
			$tr[$cnt]['is_menu'] = $tree[$i]['catalog']['sc_menu'];
			$tr[$cnt]['is_published'] = $tree[$i]['catalog']['sc_published'];
			if(($info)&&($tree[$i]['numChild']))
				$tr[$cnt]['type'] = 'infoFolder';
			elseif(($info)&&(!$tree[$i]['numChild']))
				$tr[$cnt]['type'] = 'infoNode';
			elseif((!$info)&&($tree[$i]['numChild']))
				$tr[$cnt]['type'] = 'emptyFolder';
			elseif((!$info)&&(!$tree[$i]['numChild']))
				$tr[$cnt]['type'] = 'emptyNode';				
			if($tree[$i]['level']>0)
				{
				$k = 0;
				do
					{
					$next = 0;
					$root = 0;
					for($m=$i+1; $m<count($tree); $m++)
						{
						if(($tree[$i]['parents'][$k] == $tree[$m]['parents'][$k])&&
							($tree[$i]['catalog']['sc_parId'] != $tree[$m]['catalog']['sc_parId']))
							{
							$next ++;
							}			
						if($tree[$m]['level']==0)
							{
							$root ++;
							}
						}
					$tr[$cnt]['img'][0] = ($root>0)?'vr':'sp';	
					if($tree[$i]['level']>1)
						$tr[$cnt]['img'][$k+1] = ($next>0)?'vr':'sp';
					$k++;
					}		
				while($k<$tree[$i]['level']-1);
				if($tree[$i]['numChild'])
					{
					$tr[$cnt]['img'][$tree[$i]['level']] = '3n';
					if(!$tree[$i]['haveBrother'])
						$tr[$cnt]['img'][$tree[$i]['level']] = 'endn';																	
					$tr[$cnt]['img'][] = $tr[$cnt]['type'];//'folder';
					$tr[$cnt]['havechild'] = 1;
					}
				else
					{
					$tr[$cnt]['img'][$tree[$i]['level']] = '3s';
					if(!$tree[$i]['haveBrother'])
						$tr[$cnt]['img'][$tree[$i]['level']] = 'ends';
					$tr[$cnt]['img'][] = $tr[$cnt]['type'];//($tr[$cnt]['type'] == 'article')?'node':'folder';
					$tr[$cnt]['havechild'] = 0;						
					}
				}
			elseif(!$tree[$i]['level'])
				{
				$next = 0;
				for($m=$i+1; $m<count($tree); $m++)
					{
					if($tree[$m]['level']==0)
						{
						$next ++;
						}			
					}
				if($tree[$i]['numChild'])
					{
					$tr[$cnt]['img'][0] = ($next>0)?'3n':'endn';
					$tr[$cnt]['img'][] = $tr[$cnt]['type'];//'folder';
					$tr[$cnt]['havechild'] = 1;
					}
				else
					{
					$tr[$cnt]['img'][0] = ($next>0)?'3s':'ends';					
					$tr[$cnt]['img'][] = $tr[$cnt]['type'];//'node';
					$tr[$cnt]['havechild'] = 0;
					}
				}
			$tr[$cnt]['right'] = $tree[$i]['right'];
			$bcount = $cnt;
			$cnt++;
			}		
		for($i=0; $i<count($tr); $i++)
			{
			if(($tr[$i+1])&&($tr[$i]['level']<$tr[$i+1]['level']))
				{
				if((!$i)||((isset($visibleNodes))&&(in_array($tr[$i]['id'], $visibleNodes))))
					{					
//					echo '<br>'.$tr[$i+1]['id'];
					$tr[$i+1]['visible'] = 1;
					}					
				$tr[$i+1]['topen'] = 1;
				$lvl[$tr[$i]['level']] = 1;
				}
			if(($tr[$i+1])&&($tr[$i]['level']>$tr[$i+1]['level']))
				{
				$cnt = 0;
				$tr[$i]['tclose'] = 0;
				do
					{
					$cnt++;
					if($lvl[$tr[$i]['level']-$cnt]);
						{
						$lvl[$tr[$i]['level']-$cnt] = 0;
						$tr[$i]['tclose'] ++;
						}
					}
				while(($tr[$i+1]['level'] + $cnt)<$tr[$i]['level']);
//				$tr[$i]['topen'] = 1
				}
			if((!$tr[$i+1])&&(count($tree)>1))
				{
				$cnt = 0;
				$tr[$i]['tclose'] = 0;
				do
					{
					$cnt++;
					if($lvl[$tr[$i]['level']-$cnt]);
						{
						$lvl[$tr[$i]['level']-$cnt] = 0;
						$tr[$i]['tclose'] ++;
						}
					}
				while($tr[$i]['level']-$cnt);
				}
			}
		$full_ret['Stree'] = $tr;
		$full_ret['rootRight'] = $ACL->GetRootRight();
//		$full_ret['tree'] = $tree;
		return $full_ret;
		}
	}
?>