<?
class MANAGE_TEMPLATE extends TEMPLATE  
	{
	function TPL_GetCaptionTable($node)
		{
		global $CNT;		
		$lang = $CNT->GetAllLanguages(2);
		$tmp['label'] = 'Имя Узла';
		$tmp['value'] = $node['catalog']['sc_name'];
		$tmp['idTag'] = 'idNodeMain_'.$node['catalog']['sc_id'].'_name';
		$tmp['JQClass'] = 'editable_text';
		$mainprop[] = $tmp;
		$tmp['label'] = 'Обработчик';
		$tmp['value'] = $node['catalog']['sc_handler'];
		$tmp['idTag'] = 'idNodeMain_'.$node['catalog']['sc_id'].'_handler';
		$tmp['JQClass'] = 'editable_text';
		$mainprop[] = $tmp;
		$tmp['label'] = 'Очередность';
		$tmp['value'] = $node['catalog']['sc_order'] + 1;
		$tmp['idTag'] = 'idNodeMain_'.$node['catalog']['sc_id'].'_order';
		$tmp['JQClass'] = 'editable_select';
		$mainprop[] = $tmp;
		$tmp['label'] = 'Состоит в меню';
		$tmp['value'] = ($node['catalog']['sc_menu'])?'<font color="green">true</font>':'<font color="red">false</font>';
		$tmp['idTag'] = 'idNodeMain_'.$node['catalog']['sc_id'].'_menu';
		$tmp['JQClass'] = 'editable_select';
		$mainprop[] = $tmp;			
		$tmp['label'] = 'Системный узел';
		$tmp['value'] = ($node['catalog']['sc_system'])?'<font color="green">true</font>':'<font color="red">false</font>';
		$tmp['idTag'] = 'idNodeMain_'.$node['catalog']['sc_id'].'_system';
		$tmp['JQClass'] = 'editable_select';
		$mainprop[] = $tmp;			
		$tmp['label'] = 'Язык';
		$tmp['value'] =  $lang[$node['catalog']['lang_id']];
		$tmp['idTag'] = 'idNodeMain_'.$node['catalog']['sc_id'].'_lang';
		$tmp['JQClass'] = 'editable_select';
		$mainprop[] = $tmp;	
		$full_ret['mainProp'] = $mainprop;	
		$tmp = array();
		for($i=0; $i<count($node['body']); $i++)
			{
			$tmp['label'] = $node['body'][$i]['name'];
			$tmp['type'] = $node['body'][$i]['type'];
			$tmp['value'] = trim(strip_tags($node['body'][$i]['value']));				
			$tmp['id'] = $node['body'][$i]['id'];
			$addProp[] = $tmp;
			}
		$addProp['num'] = count($node['body']);
//		echo "ssss".$node['catalog']['sc_id'];
		$addProp['nodeid'] = $node['catalog']['sc_id'];
		
		$full_ret['addProp'] =  $addProp;
		return $full_ret;						
		}
	function TPL_EditNodePar($cont, $parType, $location)
		{
		//global $CONST;
		global $uri;
//		echo $uri;
//		print_r($cont);
	
//		echo $parType.'<hr>'.$cont['name'].'<hr>';
		$form = array(
						'action' => $location.'set/editNodePar/'. $cont['id'],
						'name' => 'Edit',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Параметр ',
						'bodyId' => 'tableEdit'						
						);

		$full_ret['el_caption'] = array(	'Тип'															
										);
/*		$elList['type']['caption'] = array('VARCHAR', 'TEXT');
		$elList['type']['value'] = $elList['type']['caption'];,
											'Имя'*/
		$elList['type']['value'] = array('INFOBLOCK', 'PAGEHEADER',  'TEXT', 'VARCHAR');
		$elList['type']['caption'] = array('Информационный блок', 'Заголовок страницы',  'Текст (с HTML)', 'Строковой параметр');
//		$curVal = ($parType)?'TEXT':'VARCHAR';
		$ar[] = array('name' => 'PAR_TYPE', 
					'id' => 'IDtype', 
					'type' => 'select', 
					'style' => 'WIDTH: 200px', 
					'class' => 'input2', 
					'onChange' => '',
					'default' => $parType,													
					'onChange' => 'changeParType(this, this.form)',
					'value' => $elList['type']['value'], 
					'caption' => $elList['type']['caption']);
		if(($parType=='TEXT')||($parType=='VARCHAR'))
			{	
			$full_ret['el_caption'][] = 'Имя';			
			$ar[] = array('name' => 'PAR_NAME', 
						'type' => 'text', 
						'id' => 'IDname', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'default' => $cont['name'],												
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'necessary' => 1 
						);
			}
		elseif(($parType=='INFOBLOCK')||($parType=='PAGEHEADER'))
			{
			$curVal = ($parType=='INFOBLOCK')?'textblock':'title';
			$ar[] = array('name' => 'PAR_NAME', 
						'id' => 'IDname', 
						'type' => 'hidden', 
						'default' => $curVal);
			}
			
		if(($parType=='PAGEHEADER')||($parType=='VARCHAR'))
			{
//			$submitDisabled = 1;
			$form['emptyCheck'] = 1;
			$full_ret['type'] = 'VARCHAR';
			if($parType=='PAGEHEADER')
				{
				$full_ret['el_caption'][] = '';
				$full_ret['el_caption'][] = 'Значение';
				}
			elseif($parType=='VARCHAR')
				$full_ret['el_caption'][] = 'Значение';			
			$ar[] = array('name' => 'PAR_VALUE', 
						'type' => 'text', 
						'id' => 'IDvalue', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'default' => trim(strip_tags($cont['value'])),
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'necessary' => 1
					);
			}
		elseif(($parType=='INFOBLOCK')||($parType=='TEXT'))
			{
			$form['emptyCheck'] = 1;
			$submitDisabled = 1;
/*			if($parType=='INFOBLOCK')
				$submitDisabled = 0;*/
			$full_ret['type'] = 'TEXT';
			}
			
/*		if(!$parType)
			{
			$full_ret['type'] = 'VARCHAR';
			$full_ret['el_caption'][] = 'Значение';
			$ar[] = array('name' => 'PAR_VALUE', 
						'type' => 'text', 
						'id' => 'IDvalue', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'default' => strip_tags($cont['value']),	
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'necessary' => 1
					);
			}
		else
			{
			$full_ret['type'] = 'TEXT';
			}*/
		$uri = array('name' => 'URI', 
					'id' => 'IDURI', 
					'type' => 'hidden', 
					'default' => $uri);
/*		$parent_id = array('name' => 'PARENT_ID', 
					'id' => 'IDPARENT_ID', 
					'type' => 'hidden', 
					'default' => $uri);*/
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'class' => 'input2', 
					'disabled' => 0,
					'value' => 'Обновить', 
					'caption' => 'Обновить');
		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		$full_ret['editorCaption'] =  'Значение';
		$full_ret['uri'] = $this->Create_HTML_Element($uri);	
		$full_ret['title'] = 'Редактирование параметра '.$cont['catalog']['sc_name'];
		$full_ret['content'] = $cont;
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table'] = $this->TPL_CreateTable($table);
		return $full_ret;						
		}
	function TPL_AddNodePar($cont, $parType, $location)
		{
		//global $CONST;
		global $uri;
//		echo $parType;
		$form = array(
						'action' => $location.'set/addNewNodePar/'. $cont['catalog']['sc_id'] ,
						'name' => 'Edit'
						);
		$table = array(
						'label' => 'Новый параметр ',
						'bodyId' => 'tableEdit'						
						);

		$full_ret['el_caption'] = array('Тип');
		$elList['type']['value'] = array('INFOBLOCK', 'PAGEHEADER',  'TEXT', 'VARCHAR');
		$elList['type']['caption'] = array('Информационный блок', 'Заголовок страницы',  'Текст (с HTML)', 'Строковой параметр');
//		$elList['type']['value'] = $elList['type']['caption'];
		$curVal = ($parType)?'TEXT':'VARCHAR';
		$ar[] = array('name' => 'PAR_TYPE', 
					'id' => 'IDtype', 
					'type' => 'select', 
					'style' => 'WIDTH: 200px', 
					'class' => 'input2', 
					'onChange' => '',
					'default' => $parType,													
					'onChange' => 'changeParType(this, this.form)',
					'value' => $elList['type']['value'], 
					'caption' => $elList['type']['caption']);
		if(($parType=='TEXT')||($parType=='VARCHAR'))
			{
			$full_ret['el_caption'][] = 'Имя';
			$ar[] = array('name' => 'PAR_NAME', 
						'type' => 'text', 
						'id' => 'IDname', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'default' => '',												
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'necessary' => 1 
						);
			}
		elseif(($parType=='INFOBLOCK')||($parType=='PAGEHEADER'))
			{
			$curVal = ($parType=='INFOBLOCK')?'textblock':'title';
			$ar[] = array('name' => 'PAR_NAME', 
						'id' => 'IDname', 
						'type' => 'hidden', 
						'default' => $curVal);
			}
		if(($parType=='PAGEHEADER')||($parType=='VARCHAR'))
			{
			$submitDisabled = 1;
			$form['emptyCheck'] = 1;
			$full_ret['type'] = 'VARCHAR';
			if($parType=='PAGEHEADER')
				{
				$full_ret['el_caption'][] = '';
				$full_ret['el_caption'][] = 'Значение';
				}
			elseif($parType=='VARCHAR')
				$full_ret['el_caption'][] = 'Значение';
				
			$ar[] = array('name' => 'PAR_VALUE', 
						'type' => 'text', 
						'id' => 'IDvalue', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'default' => '',												
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'necessary' => 1
					);
			}
		elseif(($parType=='INFOBLOCK')||($parType=='TEXT'))
			{
			$form['emptyCheck'] = 1;
			$submitDisabled = 1;
			if($parType=='INFOBLOCK')
				$submitDisabled = 0;
			$full_ret['type'] = 'TEXT';
			}
		$uri = array('name' => 'URI', 
					'id' => 'IDURI', 
					'type' => 'hidden', 
					'default' => $uri);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'class' => 'input2', 
					'disabled' => $submitDisabled,
					'value' => 'Создать', 
					'caption' => 'Создать');
		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		$full_ret['editorCaption'] =  'Значение';
		$full_ret['uri'] = $this->Create_HTML_Element($uri);	
		$full_ret['title'] = 'Добавление нового параметра в '.$cont['catalog']['sc_name'];
		$full_ret['content'] = $cont;
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table'] = $this->TPL_CreateTable($table);
		return $full_ret;						
		}
/*	function GetParents($id, $tree, $end)
		{
		//$par = array();
		$cnt = 0;
		for($i=0; $i<$end; $i++)
			{
			if($tree[$i]['catalog']['sc_id'] == $id)
				{
				$cnt++;
				$this->parents[$tree[$i]['level']] = $tree[$i]['catalog']['sc_id'];
				$this->GetParents($tree[$i]['catalog']['sc_parId'], $tree, $i);
				}			
			}
		return $cnt;
		$par;
		}*/
	function TPL_GetManageEditNewNode($location)
		{
		$CONT =  new GetContent;
		$lang['value'][] = 0;
		$lang['caption'][] = 'all';
		$lang_t = $CONT->GetAllLanguages(1);			
		global $CONST;
		$form = array(
						'action' => $location.'set/',
						'name' => 'NEWNODE',
						'emptyCheck' => 1
						);
		$table0 = array(
						'label' => 'Новый узел',
						'bodyId' => 'NODE'						
						);
		$table1 = array(
						'label' => 'Свойства узла',
						'bodyId' => 'CAP'						
						);
		$full_ret['table'][0]  = $this->TPL_CreateTable($table0);
		$full_ret['table'][1]  = $this->TPL_CreateTable($table1);
		$full_ret['form']  = $this->TPL_CreateForm($form);
			$full_ret['el1_caption'] = array(	'Родительская ветвь',
												/*'Тип узла', */
												'Имя узла',  
												'Очередность', 
												'Обработчик',  
												/*'Имя таблицы с данными', 
												'Название столбца', */
												'Язык',
												'Отображать в меню');
			$full_ret['el2_caption'] = array('Имя',  'Значение',  'Очередность');
			$full_ret['checkbox']['caption'] = 'Создать свойство';
			$full_ret['submit_disabled'] = 1;
			$defaults = array(	/*'NODE_TYPE' => 'manual',*/
								'NODE_PARENT' => '',
								'NODE_NAME' => '',
								'NODE_MENU' => 0,
								'NODE_HANDLER' => '',
								'NODE_ORDER' => 'last',
								'NODE_TABLE' => '',
								'NODE_COL' => '',
								'NODE_LANG' => 0,
								'CAP_NAME' => '',
								'CAP_VALUE' => '',
								'CAP_ORDER' => '',
								'CAP_NEXT' => 0
								);
			$elList = array();
			$elList['NODE_ORDER']['value'] = array('last', 'first');
			$elList['NODE_ORDER']['caption'] = array('Последний', 'Первый');
			$elList['CAP_ORDER']['value'] = array('last', 'first');
			$elList['CAP_ORDER']['caption'] = array('Последний', 'Первый');
			$ar[] = array('name' => 'NODE_PARENT', 
						'type' => 'text', 
						'id' => 'IDNODE_PARENT', 
						'style' => '', 
						'class' => 'inputInfo', 
						'onChange' => '',
						'onFocus' => 'this.blur();',
						'default' => $defaults['NODE_PARENT']
						);
			$ar[] = array('name' => 'NODE_NAME', 
						'id' => 'IDNODE_NAME', 
						'type' => 'text', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'disabled' => 1,
						'necessary' => 1, 
						'onChange' => 'EmptyCheck(this.form); pathCreate(this.value)',
						'onkeyup' => 'EmptyCheck(this.form); pathCreate(this.value)',
						'onBlur' => 'pathCreate(this.value)',
						'default' => $defaults['NODE_NAME']);
			$ar[] = array('name' => 'NODE_ORDER', 
						'id' => 'IDNODE_ORDER', 
						'type' => 'select', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'disabled' => 1,
						'default' => $defaults['NODE_ORDER'],													
						'value' => $elList['NODE_ORDER']['value'], 
						'caption' => $elList['NODE_ORDER']['caption']);
			$ar[] = array('name' => 'NODE_HANDLER', 
						'id' => 'IDNODE_HANDLER', 
						'type' => 'file', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'disabled' => 1,
						'onChange' => '',
						'default' => $defaults['NODE_HANDLER']);
			$ar[] = array('name' => 'NODE_LANG', 
						'id' => 'IDNODE_LANG', 
						'type' => 'select', 
						'style' => 'WIDTH: 200px', 
						'class' => 'input2', 
						'onChange' => '',
						'disabled' => 1,
						'default' => $defaults['NODE_LANG'],													
						'value' => $lang_t['value'], 
						'caption' => $lang_t['caption']);
			$menu[] = array('name' => 'MENU_LABEL', 
						'id' => 'IDMENU_LABEL', 
						'type' => 'text', 
						'style' => 'WIDTH: 200px', 
						'necessary' => 1, 
						'class' => 'input2', 
						'caption' => 'Заголовок в меню',
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'default' => '');
			$menu[] = array('name' => 'MENU_LINK', 
						'id' => 'IDMENU_LINK', 
						'type' => 'text', 
						'style' => 'WIDTH: 200px', 
						'necessary' => 1, 
						'class' => 'input2', 
						'caption' => 'Ссылка',
						'onChange' => 'EmptyCheck(this.form)',
						'onkeyup' => 'EmptyCheck(this.form)',
						'default' => '');
			$ar[] = array('name' => 'NODE_MENU', 
						'id' => 'IDNODE_MENU', 
						'type' => 'checkbox', 
						'class' => 'input2', 
						'disabled' => 1,
						'onClick' => 'isMenu(this); EmptyCheck(this.form)',
						'default' => $defaults['NODE_MENU']);
			$submit = array('name' => 'SUBMIT', 
						'id' => 'IDSUBMIT', 
						'type' => 'submit', 
						'style' => 'WIDTH: 100px', 
						'class' => 'input2', 
						'disabled' => 1,
						'value' => 'Создать', 
						'caption' => 'Создать');
			$hidden = array('name' => 'PARENT_ID', 
						'id' => 'IDPARENT_ID', 
						'type' => 'hidden', 
						'value' => '');
			$full_ret['hidden'] = $this->Create_HTML_Element($hidden);
			$full_ret['checkbox']['element'] = $this->Create_HTML_Element($chekbox);
			$full_ret['checkbox']['pattern'] = 'CAP_NEXT';
			$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
			for($i=0; $i<count($ar); $i++)
				{
				$full_ret['el1'][]= $this->Create_HTML_Element($ar[$i]);	
				}
			for($i=0; $i<count($menu); $i++)
				{
				$full_ret['menu'][]= $this->Create_HTML_Element($menu[$i]);	
				}
		$full_ret['tr_id'] = 'CAP[0]';
		return $full_ret;
		}
	function TPL_GetManageTree(/*$content, */$tree)
		{
		global $CONST;
		global $ACL;
		$table = array(
						'label' => 'Дерево сайта',
						'bodyId' => 'TREE'						
						);
		$CONT =  new GetContent;

		$full_ret['lang'] = $CONT->GetAllLanguages(2);
		$full_ret['lang'][0] = 'any';
		$full_ret['table_tree'] = $this->TPL_CreateTable($table);
		$tr= array();
		for($i=0; $i<count($tree); $i++)
			{
			$this->Reset();
			$this->GetParents($tree[$i]['catalog']['sc_parId'], $tree, $i);
//			print_r($this->parents);
			$tree[$i]['parents'] = $this->parents;
			}
		$cnt = 0;
		for($i=0; $i<count($tree); $i++)
			{
			$name = '';
			for($n=0; $n<count($tree[$i]['body']); $n++)
				if($tree[$i]['body'][$n]['name'] == 'caption')
					$name = $tree[$i]['body'][$n]['value'];
			if(strlen($name) >=25  )
				$name = substr($name, 0, 18).'...';
			if($name)				
				$tr[$cnt]['name'] = $name.' ('.$tree[$i]['catalog']['sc_name'].')';
			else
				$tr[$cnt]['name'] = $tree[$i]['catalog']['sc_name'];
			$tr[$cnt]['path'] = $tree[$i]['path'];
			$tr[$cnt]['nodeName'] = $tree[$i]['catalog']['sc_name'];
			$tr[$cnt]['id'] = $tree[$i]['catalog']['sc_id'];
			$tr[$cnt]['level'] = $tree[$i]['level'];
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
					$tr[$cnt]['img'][] = 'folder';
					$tr[$cnt]['havechild'] = 1;
					}
				else
					{
					$tr[$cnt]['img'][$tree[$i]['level']] = '3s';
					if(!$tree[$i]['haveBrother'])
						$tr[$cnt]['img'][$tree[$i]['level']] = 'ends';
					$tr[$cnt]['img'][] = 'node';
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
					$tr[$cnt]['img'][] = 'folder';
					$tr[$cnt]['havechild'] = 1;
					}
				else
					{
					$tr[$cnt]['img'][0] = ($next>0)?'3s':'ends';					
					$tr[$cnt]['img'][] = 'node';
					$tr[$cnt]['havechild'] = 0;
					}
				}
			$tr[$cnt]['right'] = $tree[$i]['right'];
			$bcount = $cnt;
			$cnt++;
			}			
		$full_ret['Stree'] = $tr;
		$full_ret['rootRight'] = $ACL->GetRootRight();
//		$full_ret['tree'] = $tree;
		return $full_ret;
		}
	}
?>