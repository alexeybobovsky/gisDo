<?php
//require_once("main.inc.php");
class ADMIN_TEMPLATE extends TEMPLATE  
	{
	function ShowConstDelete($id,  $location)/*2008_06_18 кнопка удаления объекта  */
		{
		$form = array('action' => $location.'set/delete',
						'name' => 'deleteObj'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
					
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $id);					
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);
		$submit = array('name' => 'SUBMITDELETE', 
					'id' => 'IDSUBMITDELETE', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 0,
					'value' => 'Удалить', 
					'caption' => 'Удалить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}		
	
	function ShowConstNew($location)/*2008_08_21 Создание константы*/
		{
		$form = array('action' => $location.'set/new',
						'name' => 'editConst',
						'emptyCheck' => 1,
						'elementCaption' => array('Имя константы', 'Значение',  'Описание')
						);
//		$form['action'] .= ($hidden)?'show':'hide';
		$full_ret['form']  = $this->TPL_CreateForm($form);
					
		$ar[] = array('name' => 'NAME', 
					'id' => 'NAME', 
					'type' => 'text', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'necessary' => 1, 
					'default' => '');		
/*		$ar[] = array('name' => 'VALUE', 
					'id' => 'VALUE', 
					'type' => 'text', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'necessary' => 1, 
					'default' => '');	*/
		$ar[] = array('name' => 'VALUE', 
					'id' => 'VALUE', 
					'type' => 'textarea', 
					'style' => 'WIDTH: 98%', 
					'necessary' => 1, 
					'useCompare' =>1,
					'rows' => 6,
					'cols' => 30,
					'wrap' => 'soft',
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'ABOUT', 
					'id' => 'ABOUT', 
					'type' => 'textarea', 
					'style' => 'WIDTH: 98%', 
					'necessary' => 1, 
					'useCompare' =>1,
					'rows' => 6,
					'cols' => 30,
					'wrap' => 'soft',
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);
		$submit = array('name' => 'SUBMITEDIT', 
					'id' => 'SUBMITEDIT', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}		
	function ShowConstEdit($const, $location)/*2008_08_21 редактирование константы*/
		{
		$form = array('action' => $location.'set/edit',
						'name' => 'editConst',
						'elementCaption' => array('Имя константы', 'Значение',  'Описание')
						);
//		$form['action'] .= ($hidden)?'show':'hide';
		$full_ret['form']  = $this->TPL_CreateForm($form);
					
		$ar[] = array('name' => 'NAME', 
					'id' => 'NAME', 
					'type' => 'text', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",
					'onkeyup' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",					
/*					'onChange' => $event, 
					'onkeyup' => $event,*/
					'necessary' => 1, 
					'default' => trim($const['conf_name']));		
/*		$ar[] = array('name' => 'VALUE', 
					'id' => 'VALUE', 
					'type' => 'text', 
					'class' => 'inputArt',
					'style' => 'WIDTH: 98%', 
					'onChange' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",
					'onkeyup' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",					
					'necessary' => 1, 
					'default' => trim($const['conf_value']));	*/
		$ar[] = array('name' => 'VALUE', 
					'id' => 'VALUE', 
					'type' => 'textarea', 
					'style' => 'WIDTH: 98%', 
					'necessary' => 1, 
//					'useCompare' =>1,
					'rows' => 6,
					'cols' => 30,
					'wrap' => 'soft',
					'onChange' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",
					'onkeyup' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",					
					'default' => trim($const['conf_value']));
		$ar[] = array('name' => 'ABOUT', 
					'id' => 'ABOUT', 
					'type' => 'textarea', 
					'style' => 'WIDTH: 98%', 
					'necessary' => 0, 
					'useCompare' =>1,
					'rows' => 6,
					'cols' => 30,
					'wrap' => 'soft',
					'onChange' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",
					'onkeyup' => "checkChangesInFormAndActiveSubmut(this.form, 'CMP', '_')",					
					'default' => trim($const['conf_comment']));
		$ar[] = array('name' => 'CMP_NAME', 
					'id' => 'CMP_NAME', 
					'type' => 'hidden', 
					'default' => trim($const['conf_name']));					
		$ar[] = array('name' => 'CMP_VALUE', 
					'id' => 'CMP_VALUE', 
					'type' => 'hidden', 
					'default' => trim($const['conf_value']));					
		$ar[] = array('name' => 'CMP_ABOUT', 
					'id' => 'CMP_ABOUT', 
					'type' => 'hidden', 
					'default' => trim($const['conf_comment']));					
					
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $const['conf_id']);					
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);
		$submit = array('name' => 'SUBMITEDIT', 
					'id' => 'SUBMITEDIT', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Изменить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;
		}		
	function showObjectsList($order, $location) //21_08_2008 список констант
		{
		if(is_array($order))
			{
//			$K = 1024; $M = $K*1024;
			//print_r($order);
			$colHeader = array('Название', 'Значение', /*'Слой' , */'Описание');
			$headerAlign = array('center', 'center', 'center', 'center');
								
			$dataAlign = array('name' => 'left', 'value' => 'left', /*'layer' => 'left', */'about' => 'left');
								
			$colDataReturned = array('id' => 'conf_id', 'name' => 'conf_name', 'value' => 'conf_value', 'about' => 'conf_comment');
			$colStayle = 	array('id' => '', 'name' => 'editable_text', 'value' => 'editable_text', 'about' => 'editable_text');
			$colAlias = array('name', 'value', /*'layer', */'about');
			$table = array('bodyId' => 'order',
						'headerAlign' => $headerAlign, 
//						'colStyle' => $colStayle,
						'colHeader' => $colHeader,
						'colAlias' => $colAlias
						);

			for($i=0; $i<count($order); $i++)
				{
				for($j = 0; $j<count($colAlias); $j++)
					{
					
					$full_ret['content'][$i][$colAlias[$j]] = $order[$i][$colDataReturned[$colAlias[$j]]];						
					$full_ret['align'][$i][$colAlias[$j]] = $dataAlign[$colAlias[$j]];					
					$full_ret['style'][$i][$colAlias[$j]] = $colStayle[$colAlias[$j]];					
					}
				$full_ret['content'][$i]['id'] = $order[$i][$colDataReturned['id']];					
				}
			if($_SESSION['curNode'])
				{
				$full_ret['selected']  = $_SESSION['curNode'];
				unset($_SESSION['curNode']);				
				}
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
	function showUsersFilter($groups) //04_11_2007 фильтр для отображения пользователей
		{
//		print_r($groups);
		global $CONST;
		$grId = array('0');
		$grName = array('');
		$def['gr'] = ($_SESSION['filterUsers']['fltrGroups'])?($_SESSION['filterUsers']['fltrGroups']):0;
		$def['nm'] = ($_SESSION['filterUsers']['fltrName'])?($_SESSION['filterUsers']['fltrName']):'';
//		$def['cnt'] = 20;
		for($i=0; $i<count($groups); $i++)
			{
			if((!$groups[$i]['is_system'])||(($groups[$i]['is_system'])&&($groups[$i]['user_id']==$CONST['defSubscribersGroup'])))			
				{
				$grId[] = $groups[$i]['user_id'];
				$grName[] = $groups[$i]['user_name'];
				}
			}
		$form = array(
						'action' => '',
						'name' => 'FILTERFORM',
						'emptyCheck' => 0,
						'elementCaption' => array('Группа', 'Фамилия'/*, 'Кол-во записей'*/)
						);
		$table = array('bodyId' => 'filter',
					'label' => 'Фильтр'
					);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		if($_SESSION['curNode'])
			{
			$full_ret['selected']  = $_SESSION['curNode'];
			unset($_SESSION['curNode']);				
			}
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'fltrGroups', 
					'id' => 'IDfltrGroups', 
					'type' => 'select', 
					'style' => 'WIDTH:  100px', 
					'class' => 'inputFilter',
//					'onChange' => $event,
					'default' => $def['gr'],
					'value' => $grId, 
					'caption' => $grName);					
		$ar[] = array('name' => 'fltrName', 
					'id' => 'IDfltrName', 
					'type' => 'text', 
					'style' => 'WIDTH:  40px', 
					'class' => 'inputFilter',
//					'onChange' => $event,
					'default' => $def['nm']
					);					
/*		$ar[] = array('name' => 'fltrCount', 
					'id' => 'IDfltrCount', 
					'type' => 'text', 
					'style' => 'WIDTH:  20px', 
					'class' => 'inputFilter',
//					'onChange' => $event,
					'default' => $def['cnt']
					);					*/
		$submit = array('name' => 'SUBMITCATEDITCAT', 
					'id' => 'IDSUBMITCATEDITCAT', 
					'type' => 'submit', 
					'style' => 'WIDTH:  30px', 
					'class' => 'inputFilter',
					'disabled' => 0,
					'value' => 'Go!', 
					'caption' => 'изменить');
		
		$ar[] = array('name' => 'curType', 
					'id' => 'IDcurType', 
					'type' => 'hidden', 
					'default' => 'users');

		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;								
		}		
	function showExcludeUser($user, $location) //05_09_2007 кнопка исключения пользователя из всех групп
		{
		$disabled = ($user['is_system'])?1:0;
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/exclude/',
						'name' => 'newArticle'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$submit = array('name' => 'SUBMITARTSTATUS', 
					'id' => 'IDSUBMITARTSTATUS', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Исключить из всех групп', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;				
		}
	function showClearGroup($user, $location) //05_09_2007 кнопка очистки Группы
		{
		$disabled = ($user['is_system'])?1:0;
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/clear/',
						'name' => 'newArticle'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$submit = array('name' => 'SUBMITARTSTATUS', 
					'id' => 'IDSUBMITARTSTATUS', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Очистить группу', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;				
		}
	function showGroupDelete($user, $location) //05_09_2007 кнопка удаления Группы
		{		
		$disabled = ($user['is_system'])?1:0;
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/delete/',
						'name' => 'newArticle'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$ar[] = array('name' => 'DELUSER', 
					'id' => 'IDDELUSER', 
					'title' => 'Удаление с пользователями', 
					'showCaption' => 1,
					'positionCaption' => 'right',
					'type' => 'checkbox', 
					'class' => 'input2', 
					'disabled' => 0,
					'default' => 0);
		$submit = array('name' => 'SUBMITARTSTATUS', 
					'id' => 'IDSUBMITARTSTATUS', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Удалить группу', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;				
		}
	function showGroupMemebers($user, $usersGroups, $users,  $location) //05_09_2007 Список пользователей группы
		{		
/*		if(!$user['is_system'])
			{*/
		$disabled = ($user['is_system'])?1:0;
		$form = array('action' => $location.'set/members/',
						'name' => 'membership'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
/*		print_r($usersGroups);
		print_r($groups);*/
		for($i=0; $i<count($users); $i++)
			{
			$def = 0;
			for($k=0; $k<count($usersGroups); $k++)
				{
				if($users[$i]['user_id'] == $usersGroups[$k]['user_id'])
					{
//					echo $def;
					$def++;
					}
				}
			$gr[] = array('name' => 'User_'.$users[$i]['user_id'], 
						'id' => 'IDUser__'.$users[$i]['user_id'], 
						'title' => $users[$i]['user_name'], 
						'type' => 'checkbox', 
						'class' => 'input2', 
						'onClick' => 'clearObjStyle(this);', 
						'disabled' => 0,
						'default' => $def);
			$full_ret['groupCaption'][] = $users[$i]['user_name'];
			}
		for($i=0; $i<count($gr); $i++)
			{
			$full_ret['groups'][]= $this->Create_HTML_Element($gr[$i]);	
			}		
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$ar[] = array('name' => 'groups', 
					'id' => 'IDgroups', 
					'type' => 'usersToGroups', 
					'disabled' => 0,
					'default' => '1');			
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$submit = array('name' => 'SUBMEMB', 
					'id' => 'IDSUBMEMB', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Изменить членов', 
					'caption' => 'Редактировать');
		$full_ret['membSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//			}
//		return $node;				
		}	
	function showEditGroup($usr, $location)
		{
//		print_r($usr);
		$table = array(
						'label' => 'Новая категория',
						'bodyId' => 'category'
						);
		$form = array('action' => $location.'set/edit/',
						'name' => 'newCat',
						'elementCaption' => array('Название')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$event = 'if (this.value != document.getElementById(\'IDOLDNAME\').value) {document.getElementById(\'IDSUBMITCAT\').disabled = false; }
					else {document.getElementById(\'IDSUBMITCAT\').disabled = true;}';
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $usr['user_id']);
		$ar[] = array('name' => 'OLDNAME', 
					'id' => 'IDOLDNAME', 
					'type' => 'hidden', 
					'default' => $usr['user_name']);
		$ar[] = array('name' => 'NEWNAME', 
					'id' => 'IDNEWNAME', 
					'type' => 'text', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArt',
					'necessary' => 0, 
					'onChange' => $event,
					'onkeyup' => $event,
					'default' => $usr['user_name']);					
		$submit = array('name' => 'SUBMITCAT', 
					'id' => 'IDSUBMITCAT', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Переименовать группу', 
					'caption' => 'создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}		
	function showGroupAdd($location)
		{
		$table = array(
						'label' => 'Новая категория',
						'bodyId' => 'category'
						);
		$form = array('action' => $location.'set/add/',
						'name' => 'newCat',
						'elementCaption' => array('название')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$event = 'if (this.value) {document.getElementById(\'IDSUBMITCAT\').disabled = false; } else {document.getElementById(\'IDSUBMITCAT\').disabled = true;}';
		$ar[] = array('name' => 'curNodeSUBMIT', 
					'id' => 'IDcurNodeSUBMIT', 
					'type' => 'hidden', 
					'default' => $curNode);
		$ar[] = array('name' => 'NAME', 
					'id' => 'IDNAME', 
					'type' => 'text', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArt',
					'necessary' => 0, 
					'onChange' => $event,
					'onkeyup' => $event,
					'default' => '');					
		$submit = array('name' => 'SUBMITCAT', 
					'id' => 'IDSUBMITCAT', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Создать группу', 
					'caption' => 'создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}		
	function showGroupsList($order, $location) //05_09_2007 главное окно управления группами
		{
		if(is_array($order))
			{
			//print_r($order);
			$table = array('bodyId' => 'order',
						'headerAlign' => array('left', 'center', 'center'),
						'colHeader' => array('№', 'Название', 'Пользователи'),
//						'colAlias' => array('number', 'name', 'orderNumber', 'date', 'status', 'summ')
						'colAlias' => array('number', 'name', 'users')
						);

			for($i=0; $i<count($order); $i++)
				{
				$full_ret['content'][$i]['name'] = $order[$i]['user_name'];
				$full_ret['align'][$i]['name'] = 'left';
				$full_ret['content'][$i]['users'] = (is_array($order[$i]['users']))?'':'&nbsp';
				if(is_array($order[$i]['users']))
					{
					$cnt = (count($order[$i]['users'])>3)?2:count($order[$i]['users']);
					for($k=0; $k<$cnt; $k++)
						{
						$full_ret['content'][$i]['users'] .= ($full_ret['content'][$i]['users'])?', ':'';
						$full_ret['content'][$i]['users'] .= $order[$i]['users'][$k]['user_name'];
						}
					$full_ret['content'][$i]['users'] .= (count($order[$i]['users'])>3)?' ... ':'';
					}
				$full_ret['align'][$i]['name'] = 'left';
					
				$full_ret['content'][$i]['number'] = $i+1;
				$full_ret['align'][$i]['number'] = 'left';
				$full_ret['content'][$i]['id'] = $order[$i]['user_id'];
				}
			$full_ret['table']  = $this->TPL_CreateTable($table);	
			if($_SESSION['curNode'])
				{
				$full_ret['selected']  = $_SESSION['curNode'];
				unset($_SESSION['curNode']);				
				}
			$full_ret['table']  = $this->TPL_CreateTable($table);	
			}
		else
			{
			$full_ret['noOrder']=1;
			}
//		return $full_ret;
		$form = array(
						'action' => '',
						'name' => 'orderForm',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curType', 
					'id' => 'IDcurType', 
					'type' => 'hidden', 
					'default' => 'groups');
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
	function showUserProperties($content) //04_09_2007 подробно о пользователе
		{
//		print_r($content);
		$table = array(
						'label' => 'Свойства учетной записи',
						'bodyId' => 'User',
						'colHeader' => array('ФИО', 'Адрес', 'Телефон',  'Зарегистрирован', 'Последний ip адрес', 'Последнее посещение', 'Статус' ),
						'colAlias' => array('name', 'adres', 'phone',  'regdate',  'last_ip', 'last_update', 'status')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);
/*		for($i=0; $i<count($content); $i++)
			{*/
		$statusDescr = array(	'Q' => '<font color="blue">запрос</font>', 
								'A' => '<font color="green">активен</font>', 
								'B' => '<font color="gray">заблокирован</font>');

		$content['adres'] = $content['zipCode'].', '.$content['city'].', '.$content['address']; //($content['user_status']=='ON')?'<font color = "green">подключен</font>':'<font color = "red">отключен</font>';					
		$content['adres'] = trim($content['adres']);					
		
		$content['phone'] = $content['phone']; //($content['user_status']=='ON')?'<font color = "green">подключен</font>':'<font color = "red">отключен</font>';					

		$content['name'] = $content['user_last_name'].' '.$content['user_first_name'].' '.$content['user_so_name']; //($content['user_status']=='ON')?'<font color = "green">подключен</font>':'<font color = "red">отключен</font>';					
		$content['name'] = trim($content['name']);					
		
		$content['last_ip'] = ($content['user_last_ip'])?$content['user_last_ip']:'неопределен';
		$content['status'] = $statusDescr[$content['user_registation_status']];
		$content['regdate'] = ($content['user_regdate'])?date("d:m:Y",$content['user_regdate']):'неизвестно';
		$content['last_update'] = ($content['user_time_last_update'])?date("d:m:Y",$content['user_time_last_update']):'еще не был';
		$ar[] = array('name' => 'options', 
					'id' => 'IDoptions', 
					'type' => 'UserPropertiesTable', 
					'disabled' => 0,
					'default' => '1');			
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		

		$full_ret['content'] = $content;
		
//			}
		return $full_ret;								
		}
	function ShowStatus($user, $location) //04_09_2007 статус пользователя
		{
		$status['value'][] = 'Q';
		$status['value'][] = 'A';
		$status['value'][] = 'B';
		$status['text'][] = 'Запрос';
		$status['text'][] = 'Активен';
		$status['text'][] = 'Заблокирован';
		$form = array('action' => $location.'set/status/',
						'name' => 'newCat',
						'elementCaption' => array('Статус пользователя')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$event = 'if (this.value != document.getElementById(\'IDcurCat\').value) {document.getElementById(\'IDSUBMITUSERSTATUS\').disabled = false; } else {document.getElementById(\'IDSUBMITUSERSTATUS\').disabled = true;}';
		$ar[] = array('name' => 'Category', 
					'id' => 'IDCategory', 
					'type' => 'select', 
//					'style' => 'WIDTH:  95%', 
					'class' => 'inputArt',
					'onChange' => $event,
					'default' => $user['user_registation_status'],
					'value' => $status['value'], 
					'caption' => $status['text']);					
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$ar[] = array('name' => 'curCat', 
					'id' => 'IDcurCat', 
					'type' => 'hidden', 
					'default' => $user['user_registation_status']);
		$submit = array('name' => 'SUBMITUSERSTATUS', 
					'id' => 'IDSUBMITUSERSTATUS', 
					'type' => 'submit', 
//					'style' => 'WIDTH:  95%', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Изменить статус', 
					'caption' => 'изменить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}				
		return $full_ret;
		}	
	function showAddUserForm($groups, $location) //04_09_2007  форма добавления нового пользователя администратором
		{
		for($i=0; $i<count($groups); $i++)
			{
			$grId[] = $groups[$i]['user_id'];
			$grVal[] = $groups[$i]['user_name'];
			}
		$form = array(
						'action' => $location.'set/addUser/',
						'name' => 'NEWUSER',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Новый пользователь',
						'bodyId' => 'UserList',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Логин',
											'E-mail',  
											'Группы',
											'Имя',
											'Отчество',
											'Фамилия',
											'Город',
											'Индекс',
											'Адрес',
											'Телефон',											
											'Пароль', 
											'Подтверждение пароля'
											);
		$ar[] = array('name' => 'USER_NAME', 
					'id' => 'IDUSER_NAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_EMAIL', 
					'id' => 'IDUSER_EMAIL', 
					'type' => 'text', 
					'necessary' => 1, 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'USER_GROUPS[]', 
					'id' => 'IDUSER_GROUPS', 
					'type' => 'select', 
					'size' => '4', 
					'multiple' => 1, 
					'style' => 'WIDTH: 200px', 
					'class' => 'input2', 
					'onChange' => '',
					'value' => $grId, 
					'caption' => $grVal);
		$ar[] = array('name' => 'FName', 
					'id' => 'IDFName', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'SName', 
					'id' => 'IDSName', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'LName', 
					'id' => 'IDLName', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
					
		$ar[] = array('name' => 'USER_SITY', 
					'id' => 'IDUSER_SITY', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'USER_ZIP', 
					'id' => 'IDUSER_ZIP', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'USER_ADR', 
					'id' => 'IDUSER_ADR', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'USER_PHONE', 
					'id' => 'IDUSER_PHONE', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
					
		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 1,
					'value' => 'Создать', 
//					'onClick' => 'window.opener.history.go(0); self.close()',
					'caption' => 'Создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function showUserAdd($location) //04_09_2007 кнопка добавления пользователя
		{		
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'add/',
						'name' => 'newArticle'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
/*		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);*/
		$submit = array('name' => 'SUBMITARTSTATUS', 
					'id' => 'IDSUBMITARTSTATUS', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Создать пользователя', 
					'caption' => 'Редактировать');
/*		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		*/
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;				
		}
	function showEditInfo($content, $location)
		{
		global $NAV, $CONST, $ROUT;
//		$ROUT= new Routine;
//		print_r($content);		
		$avName1[] = '';
//		$avName2 = $ROUT->GetFileList($CONST['relPathPref'].$CONST['srcAvatarSys'], 0);
//		$avName = array_merge ($avName1, $avName2);
//		$avName = $ROUT->GetFileList('../htdocs');
//		print_r($avName);
		$form = array(
						'action' => $location.'set/info/',
						'name' => 'PERSINFORM',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Персональная информация',
						'bodyId' => 'LoginTable',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	
											'Логин',
											'E-mail',
											'Имя',
											'Отчество',
											'Фамилия',
											'Город',
											'Индекс',
											'Адрес',
											'Телефон',											
										/*	'Текущий аватар',
											'Новый аватар',
											'Загрузка аватара',
											'Номер ICQ',
											'О себе',*/
											'Новый пароль',
											'Повтор пароля'										
											);					
		$ar[] = array('name' => 'UserRegName', 
					'id' => 'IDUSER_RegName', 
					'type' => 'textReadOnly', 
					'style' => 'WIDTH: 200px', 
					'bold' => 1, 
					'default' => $content['user_name']);
		$ar[] = array('name' => 'EMail', 
					'id' => 'IDUSER_EMail', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_email']);
		$ar[] = array('name' => 'FName', 
					'id' => 'IDFName', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_first_name']);
		$ar[] = array('name' => 'SName', 
					'id' => 'IDSName', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_so_name']);
		$ar[] = array('name' => 'LName', 
					'id' => 'IDLName', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_last_name']);
					
		$ar[] = array('name' => 'USER_SITY', 
					'id' => 'IDUSER_SITY', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $content['city']);
		$ar[] = array('name' => 'USER_ZIP', 
					'id' => 'IDUSER_ZIP', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $content['zipCode']);
		$ar[] = array('name' => 'USER_ADR', 
					'id' => 'IDUSER_ADR', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $content['address']);
		$ar[] = array('name' => 'USER_PHONE', 
					'id' => 'IDUSER_PHONE', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $content['phone']);
/*					
		$ar[] = array('name' => 'AvatarImg', 
					'id' => 'IDAvatarImg', 
					'type' => 'img', 
					'src' => ($content['user_avatar'])?$content['user_avatar']:$CONST['srcDesignImg'].'_.gif');
		$ar[] = array('name' => 'AvatarSelect', 
					'id' => 'IDAvatarSelect', 
					'type' => 'selectimg', 
					'style' => 'WIDTH: 200px', 
					'onChange' => '',
					'value' => $avName, 
					'caption' => $avName,
					'onChange' => 'imgPreview(\'IDAvatarSelect_IMG\', this.value, 0, \''.$CONST['srcAvatarSys'].'\', \''.$CONST['srcDesignImg'].'_.gif'.'\'); EmptyCheck(this.form)',
					'onkeyup' => 'imgPreview(\'IDAvatarSelect_IMG\', this.value, 0, \''.$CONST['srcAvatarSys'].'\', \''.$CONST['srcDesignImg'].'_.gif'.'\'); EmptyCheck(this.form)',
					'src' => $CONST['srcDesignImg'].'_.gif');
		$ar[] = array('name' => 'UploadAvatar', 
					'id' => 'IDUploadAvatar', 
					'type' => 'fileimg', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'MAX_FILE_SIZE' => $CONST['sizeUpAvatarMax'],
					'onChange' => 'imgPreview(\'IDUploadAvatar_IMG\', this.value, '.$CONST['sizeAvatar'].', \'\', \''.$CONST['srcDesignImg'].'_.gif'.'\'); EmptyCheck(this.form)',
					'src' => $CONST['srcDesignImg'].'_.gif',
					'default' => '');
		$ar[] = array('name' => 'UIN', 
					'id' => 'IDUIN', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => ($content['user_icq_uin'])?$content['user_icq_uin']:'');
		$ar[] = array('name' => 'About', 
					'id' => 'IDAbout', 
					'type' => 'textarea', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'rows' => 6,
					'cols' => 30,
					'wrap' => 'soft',
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_about']);
					*/
		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'curUserId', 
					'id' => 'IDcurUserId', 
					'type' => 'hidden', 
					'default' => $content['user_id']);
					
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 1,
					'value' => 'Изменить данные'/*, 
					'caption' => 'Изменить данные'*/);
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function showUserMemebership($user, $usersGroups, $groups,  $location) //30_08_2007 кнопка удаления пользователя
		{		
		global $CONST;
/*		if(!$user['is_system'])
			{*/
		$disabled = ($user['is_system'])?1:0;
		$form = array('action' => $location.'set/membership/',
						'name' => 'membership'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
/*		print_r($usersGroups);
		print_r($groups);*/
		for($i=0; $i<count($groups); $i++)
			{
			if((!$groups[$i]['is_system'])||(($groups[$i]['is_system'])&&($groups[$i]['user_id']==$CONST['defSubscribersGroup'])))			
				{			
				$def = 0;
				for($k=0; $k<count($usersGroups); $k++)
					{
					if($groups[$i]['user_id'] == $usersGroups[$k]['group_id'])
						{
//					echo $def;
						$def++;
						}
					}
				$gr[] = array('name' => 'Group_'.$groups[$i]['user_id'], 
							'id' => 'IDGroup_'.$groups[$i]['user_id'], 
							'title' => $groups[$i]['user_name'], 
							'type' => 'checkbox', 
							'class' => 'input2', 
							'onClick' => 'clearObjStyle(this);', 
							'disabled' => 0,
							'default' => $def);
				$full_ret['groupCaption'][] = $groups[$i]['user_name'];
				}
			}
			for($i=0; $i<count($gr); $i++)
				{
				$full_ret['groups'][]= $this->Create_HTML_Element($gr[$i]);	
				}		
			$ar[] = array('name' => 'curNode', 
						'id' => 'IDcurNode', 
						'type' => 'hidden', 
						'default' => $user['user_id']);
			$ar[] = array('name' => 'groups', 
						'id' => 'IDgroups', 
						'type' => 'usersToGroups', 
						'disabled' => 0,
						'default' => '1');			
			for($i=0; $i<count($ar); $i++)
				{
				$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
				}		
			$submit = array('name' => 'SUBMEMB', 
						'id' => 'IDSUBMEMB', 
						'type' => 'submit', 
						'class' => 'inputArtSubmit',
						'disabled' => $disabled,
						'value' => 'Изменить членство', 
						'caption' => 'Редактировать');
			$full_ret['membSubmit'] = $this->Create_HTML_Element($submit);
			return $full_ret;		
//			}
//		return $node;				
		}
	function showUserDelete($user, $location) //30_08_2007 кнопка удаления пользователя
		{		
		$disabled = ($user['is_system'])?1:0;
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/delete/',
						'name' => 'newArticle'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$submit = array('name' => 'SUBMITARTSTATUS', 
					'id' => 'IDSUBMITARTSTATUS', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Удалить пользователя', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;				
		}
	function showUserEdit($user, $location) //30_08_2007 кнопка редактирования пользователя
		{
		$disabled = ($user['is_system'])?1:0;
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'edit/',
						'name' => 'newArticle'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $user['user_id']);
		$submit = array('name' => 'SUBMITARTSTATUS', 
					'id' => 'IDSUBMITARTSTATUS', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Редактировать', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;				
		}
	function showUsersList($order, $location) //30_08_2007 главное окно управления пользователями
		{
		if(is_array($order))
			{
/*			if($_SESSION['filterUsers'])
				print_r($_SESSION['filterUsers']);*/
			$table = array('bodyId' => 'order',
						'headerAlign' => array(/*'center',*/ 'left', 'center', 'center', 'center', 'center', 'center'),
						'colHeader' => array(/*'№',*/ 'Логин', 'Фамилия И.О.', 'телефон', 'e-mail' ,/* 'Регистрация', */ 'online' /*, 'Был тут' , 'Статус'*/),
//						'colAlias' => array('number', 'name', 'orderNumber', 'date', 'status', 'summ')
						'colAlias' => array(/*'number', */'login', 'name', 'phone', 'email',  /*'regDate', */ 'online', /* 'visitDate',  'status'*/)
						);
			$statusDescr = array(	'Q' => '<font color="blue">запрос</font>', 
									'A' => '<font color="green">активен</font>', 
									'B' => '<font color="gray">заблокирован</font>');
			$onlineDescr = array(	'ON' => '<font color="red">подключен</font>', 
									'OFF' => 'отключен');
			for($i=0; $i<count($order); $i++)
				{
				$full_ret['content'][$i]['login'] = $order[$i]['user_name'];
				$full_ret['align'][$i]['login'] = 'left';
				
//				$full_ret['content'][$i]['name'] = $order[$i]['user_last_name'].' '.substr($order[$i]['user_first_name'], 0, 1).'. '.substr($order[$i]['user_so_name'], 0, 1);
				$full_ret['content'][$i]['name'] = $order[$i]['user_last_name'].'&nbsp;'.$order[$i]['user_first_name'].'&nbsp;'.$order[$i]['user_so_name'];
				$full_ret['align'][$i]['name'] = 'left';
				
				$full_ret['content'][$i]['number'] = $i+1;
				$full_ret['align'][$i]['number'] = 'left';
				
				$full_ret['content'][$i]['email'] = ($order[$i]['user_email'])?$order[$i]['user_email']:'&nbsp;';
				$full_ret['align'][$i]['email'] = 'left';
				
				
				$full_ret['content'][$i]['phone'] = ($order[$i]['phone'])?$order[$i]['phone']:'&nbsp;';
				$full_ret['align'][$i]['phone'] = 'left';
/*				
				$full_ret['content'][$i]['regDate'] = ($order[$i]['user_regdate'])?date("d:m:Y",$order[$i]['user_regdate']):'&nbsp;';
				$full_ret['align'][$i]['regDate'] = 'center';
*/				
				$full_ret['content'][$i]['online'] = $onlineDescr[$order[$i]['user_status']];
				$full_ret['align'][$i]['online'] = 'left';
/*				
				$full_ret['content'][$i]['visitDate'] = ($order[$i]['user_time_last_update'])?date("d:m:Y",$order[$i]['user_time_last_update']):'&nbsp;';
				$full_ret['align'][$i]['visitDate'] = 'left';
*/				
				$full_ret['content'][$i]['status'] = $statusDescr[$order[$i]['user_registation_status']];
				$full_ret['align'][$i]['status'] = 'left';
				
				$full_ret['content'][$i]['id'] = $order[$i]['user_id'];
				}
			$full_ret['table']  = $this->TPL_CreateTable($table);	
			if($_SESSION['curNode'])
				{
				$full_ret['selected']  = $_SESSION['curNode'];
				unset($_SESSION['curNode']);				
				}
			$full_ret['table']  = $this->TPL_CreateTable($table);	
			}
		else
			{
			$full_ret['noOrder']=1;
			}
//		return $full_ret;
		$form = array(
						'action' => $location,
						'name' => 'orderForm',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curType', 
					'id' => 'IDcurType', 
					'type' => 'hidden', 
					'default' => 'users');
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
		
/*********************************************************/		
	function UsersWithoutRightsList($users, $groups, $excluded)	
		{
		$cnt = 0;
		for($i=0; $i<count($groups); $i++)
			{
			if(!in_array($groups[$i]['user_id'], $excluded))
				{
				$tmp[$cnt]['user_id'] = $groups[$i]['user_id'];
				$tmp[$cnt]['user_name'] = $groups[$i]['user_name'];
				$tmp[$cnt]['user_type'] = 'groups';				
				$cnt++;
				}
			}
		for($i=0; $i<count($users); $i++)
			{
			if(!in_array($users[$i]['user_id'], $excluded))
				{
				$tmp[$cnt]['user_id'] = $users[$i]['user_id'];
				$tmp[$cnt]['user_name'] = $users[$i]['user_name'];
				$tmp[$cnt]['user_type'] = 'users';				
				$cnt++;
				}
			}
		return $tmp;		
		}
	function RightList($obj_id, $rights)
		{
		$CNT = new GetContent;
		global $USER;
		$form = array(
						'action' => '/upload/set/',
						'name' => 'NEWFILE',
						'emptyCheck' => 0
						);
		$table = array(
						'label' => 'Права на объект '.$CNT->GetCurNodePar($obj_id, 'sc_name'),
						'bodyId' => 'RightList',
						'colHeader' => array('#', 'Имя', 'Доступ', 'Унаследован от', 'удалить'),
						'colStyle' => array('', '', 'editable_select', '', ''),
						'colAlias' => array('rightType', 'userName', 'right', 'inherit')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$r_tmp = $rights;
		$r_Cnt = 0;
		$users = array();
		$rightAlias = array(0 =>'нет доступа', 1 => 'чтение', 3 => 'запись', 7 => 'полный доступ');
		for($i=0; $i<count($r_tmp); $i++)
			{
			for($l=0; $l<(strlen($r_tmp[$i]['right'])); $l++)
				{
				$rAr[$l] =  substr($r_tmp[$i]['right'], $l, 1);
				}
			if(($r_tmp[$i]['rightType']=='root')||($r_tmp[$i]['rightType']=='owner'))
				{
				$usId = $r_tmp[$i]['userId'];
				$r_r[$r_Cnt]['userName'] = $USER->getUserParam('user_id', $usId , 'user_name');
				$r_r[$r_Cnt]['userId'] = $r_tmp[$i]['userId'];
				$r_r[$r_Cnt]['userType'] = $r_tmp[$i]['userType'];
				$r_r[$r_Cnt]['rightId'] = $r_tmp[$i]['rightId'];
				$r_r[$r_Cnt]['inherit'] = $r_tmp[$i]['inherit'];
				$r_r[$r_Cnt]['rightSrc'] = $rAr[0];
				$r_r[$r_Cnt]['right'] = $rightAlias[$rAr[0]];
				$r_r[$r_Cnt]['cnt'] = $r_Cnt;
				$r_Cnt ++;
				$usId =  $USER->getSystemGroup('user_id');
				$r_r[$r_Cnt]['userName'] = $USER->getUserParam('user_id', $usId , 'user_name');
				$r_r[$r_Cnt]['userType'] = 'group';//$r_tmp[$i]['userType'];
				$r_r[$r_Cnt]['userId'] = $usId;
				$r_r[$r_Cnt]['rightId'] = $r_tmp[$i]['rightId'];
				$r_r[$r_Cnt]['inherit'] = $r_tmp[$i]['inherit'];
				$r_r[$r_Cnt]['right'] = $rightAlias[$rAr[2]];				
				$r_r[$r_Cnt]['rightSrc'] = $rAr[2];
				$r_r[$r_Cnt]['cnt'] = $r_Cnt;
				$r_Cnt ++;
				}
			if(($r_tmp[$i]['rightType']=='parent')||($r_tmp[$i]['rightType']=='current'))
				{
				$usId = $r_tmp[$i]['userId'];
				$r_r[$r_Cnt]['rightId'] = $r_tmp[$i]['rightId'];
				$r_r[$r_Cnt]['userType'] = $r_tmp[$i]['userType'];
				$r_r[$r_Cnt]['userName'] = $r_tmp[$i]['userName'];
				$r_r[$r_Cnt]['userId'] = $r_tmp[$i]['userId'];
				$r_r[$r_Cnt]['inherit'] = $r_tmp[$i]['inherit'];//($r_tmp[$i]['inherit'])?$CNT->GetCurNodePar($r_tmp[$i]['inherit'], 'sc_name'):'';
				$r_r[$r_Cnt]['right'] = ($r_r[$r_Cnt]['userType']=='user')?$rightAlias[$rAr[0]]:$rightAlias[$rAr[1]];
				$r_r[$r_Cnt]['rightSrc'] = ($r_r[$r_Cnt]['userType']=='user')?$rAr[0]:$rAr[1];
				$r_r[$r_Cnt]['cnt'] = $r_Cnt;
				$r_Cnt ++;
				}
			}
		$r2 = array();
		$i = 0;
		$stop=0;
		do
			{
			$num = $r_r[$i]['userId'];
//				echo $num,'<br>';
			if(!isset($r2[$num]))
				{
				$r2[$num] = $r_r[$i];
				if(($USER->getUserParam('user_id', $num , 'is_group'))&&($USER->getUserParam('user_id', $num , 'is_system')))
					{
					$stop++;
					}
				}
			$i++;
			}
		while (($i<=count($r_r))&&(!$stop));
		$ar = array();
		while (list ($key2, $val2) = each ($r2)) 
			{
			$ar[$r2[$key2]['cnt']] = $val2;
			}
		ksort($ar, SORT_NUMERIC);
		$userList = array();
		while (list ($key2, $val2) = each ($ar)) 
			{
			$userList[] = $val2['userId'];
			$ar_r[] = $val2;
			}
//		$full_ret['_rights'] = $r_tmp;
		$full_ret['rights'] = $ar_r;
		$full_ret['obj_id'] = $obj_id;
		$full_ret['userList'] = $userList;
//		$full_ret['rights_'] = $rights;
		return $full_ret;						
		}
	function UploadFile()
		{
		$pathValue = array(
						'/index/',
						'/htdocs/',
						'/classes/',
						'/htdocs/includes/Smarty/templates/',
						'/htdocs/includes/JS/',
						'/htdocs/includes/Jquery/'
						);
		$pathName = array(
						'index',
						'htdocs',
						'classes',
						'templates',
						'js',
						'Jquery'
						);
		$form = array(
						'action' => '/upload/set/',
						'name' => 'NEWFILE',
						'emptyCheck' => 0
						);
		$table = array(
						'label' => 'Загрузка файла на сервер',
						'bodyId' => 'FileList',
						'colHeader' => array('"Горячий" каталог', 'Другой', 'Файл', 'Заменить существующий', 'Создать каталог')
						);
		$subtable = array(
						'label' => 'Каталог - приёмник'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['subtable']  = $this->TPL_CreateTable($subtable);
		$ar[] = array('name' => 'PRECATALOGS', 
					'id' => 'IDPRECATALOGS', 
					'type' => 'select', 
					'style' => 'WIDTH: 200px', 
					'onChange' => '',
					'value' => $pathValue, 
					'caption' => $pathName);
		$ar[] = array('name' => 'USERCATALOG', 
					'id' => 'IDUSERCATALOG', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'default' => '');
		$ar[] = array('name' => 'FILE', 
					'id' => 'IDFILE', 
					'type' => 'file', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'OVERWRITE', 
					'id' => 'IDOVERWRITE', 
					'type' => 'checkbox', 
					'class' => 'input2', 
					'default' => 1);
		$ar[] = array('name' => 'CREATEDIR', 
					'id' => 'IDCREATEDIR', 
					'type' => 'checkbox', 
					'class' => 'input2', 
					'default' => 1);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 0,
					'value' => 'Upload', 
					'caption' => 'загрузить');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function Members($content)
		{
		if($content['groupUserList'])
			{
			for($i=0; $i<count($content['groupUserList']); $i++)		
				{
				$inGroupId[] = $content['groupUserList'][$i]['user_id'];
				$inGroupName[] = $content['groupUserList'][$i]['user_name'];
				}
			}
		else
			$inGroupId = array();
		for($i=0; $i<count($content['AllUsersList']); $i++)		
			{
			if((!in_array($content['AllUsersList'][$i]['user_id'], $inGroupId)))
				{
				$outGroupId[] = $content['AllUsersList'][$i]['user_id'];
				$outGroupName[] = $content['AllUsersList'][$i]['user_name'];
				}
			}
		$full_ret['type'] = 'group';
		$full_ret['curUser']['id'] = $content['curGroup']['user_id'];
		$full_ret['curUser']['name'] = $content['curGroup']['user_name'];
		$full_ret['colHeader'] = array('Состоят в группе', 'Не входят в группу');
		$full_ret['action'] = '/admin/SetDin/members/';		
		$full_ret['in']['id'] = $inGroupId;
		$full_ret['in']['name'] = $inGroupName;
		$full_ret['out']['id'] = $outGroupId;
		$full_ret['out']['name'] = $outGroupName;
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 0,
					'value' => 'Сохранить и закрыть', 
					'onClick' => "serialize('sort1'); self.close()",
					'caption' => 'Сохранить и закрыть');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;						
		}
	function UserProperties($content)
		{
		$table = array(
						'label' => 'Свойства учетной записи',
						'bodyId' => 'User',
						'colHeader' => array('Имя', 'e-mail', 'Зарегистрирован на сайте', 'Статус пользователя', 'последний ip адрес', 'Последнее посещение', 'Пароль', 'Статус Учетой записи'),
						'colStyle' => array('',      '',    '',    '',                     '',                    '', 'editable_text', 'editable_select'),
						'colAlias' => array('user_name', 'user_email', 'user_regdate', 'user_status', 'user_last_ip', 'user_time_last_update', 'user_password', 'user_registation_status')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);
/*		for($i=0; $i<count($content); $i++)
			{*/
		switch($content['user_registation_status'])
			{
			case 'Q': $content['user_registation_status'] = '<font color = "blue">Запрос активации</font>'; break;
			case 'A': $content['user_registation_status'] = '<font color = "green">Активизирована</font>'; break;
			case 'B': $content['user_registation_status'] = '<font color = "red">Заблокирована</font>'; break;
			}			
		$content['user_status'] = ($content['user_status']=='ON')?'<font color = "green">подключен</font>':'<font color = "red">отключен</font>';					
		$content['user_last_ip'] = ($content['user_last_ip'])?$content['user_last_ip']:'неопределен';
		$content['user_regdate'] = ($content['user_regdate'])?date("d:m:Y",$content['user_regdate']):'неизвестно';
		$content['user_time_last_update'] = ($content['user_time_last_update'])?date("d:m:Y",$content['user_time_last_update']):'еще не был';
		$content['user_password'] = '********';

		$full_ret['content'] = $content;
		
//			}
		return $full_ret;								
		}
	function addGroup($users)
		{
		for($i=0; $i<count($users); $i++)
			{
			$grId[] = $users[$i]['user_id'];
			$grVal[] = $users[$i]['user_name'];			
			}
		$form = array(
						'action' => '/admin/set/addgroup/',
						'name' => 'NEWGROUP',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Новая группа доступа',
						'bodyId' => 'UserList',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Название',
											'Члены группы');
		$ar[] = array('name' => 'USER_NAME', 
					'id' => 'IDUSER_NAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_2USER[]', 
					'id' => 'IDUSER_2USER', 
					'type' => 'select', 
					'size' => '4', 
					'multiple' => 1, 
					'style' => 'WIDTH: 200px', 
					'class' => 'input2', 
					'onChange' => '',
					'value' => $grId, 
					'caption' => $grVal);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 1,
					'value' => 'Создать', 
//					'onClick' => 'window.opener.history.go(0); self.close()',
					'caption' => 'Создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function AddUser($groups)
		{
		global $NAV;
		for($i=0; $i<count($groups); $i++)
			{
			$grId[] = $groups[$i]['user_id'];
			$grVal[] = $groups[$i]['user_name'];
			}
		$form = array(
						'action' => '/admin/set/adduser/',
						'name' => 'NEWUSER',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Новый пользователь',
						'bodyId' => 'UserList',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Имя пользователя',
											'E-mail',  
											'Пароль', 
											'Подтверждение пароля',  
											'Группы');
		$ar[] = array('name' => 'USER_NAME', 
					'id' => 'IDUSER_NAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_EMAIL', 
					'id' => 'IDUSER_EMAIL', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_GROUPS[]', 
					'id' => 'IDUSER_GROUPS', 
					'type' => 'select', 
					'size' => '4', 
					'multiple' => 1, 
					'style' => 'WIDTH: 200px', 
					'class' => 'input2', 
					'onChange' => '',
					'value' => $grId, 
					'caption' => $grVal);
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 1,
					'value' => 'Создать', 
//					'onClick' => 'window.opener.history.go(0); self.close()',
					'caption' => 'Создать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function Membership($content)
		{
		if($content['userGroupList'])
			{
			for($i=0; $i<count($content['userGroupList']); $i++)		
				{
				$inGroupId[] = $content['userGroupList'][$i]['group_id'];
				$inGroupName[] = $content['userGroupList'][$i]['user_name'];
				}
			}
		else
			$inGroupId = array();
		for($i=0; $i<count($content['AllGroupList']); $i++)		
			{
			if((!in_array($content['AllGroupList'][$i]['user_id'], $inGroupId)))
				{
				$outGroupId[] = $content['AllGroupList'][$i]['user_id'];
				$outGroupName[] = $content['AllGroupList'][$i]['user_name'];
				}
			}
		$full_ret['type'] = 'user';
		$full_ret['curUser']['id'] = $content['curUser']['user_id'];
		$full_ret['curUser']['name'] = $content['curUser']['user_name'];
		$full_ret['colHeader'] = array('Состоит в группах', 'Не входит в группы');
		$full_ret['action'] = '/admin/SetDin/membership/';		
		$full_ret['in']['id'] = $inGroupId;
		$full_ret['in']['name'] = $inGroupName;
		$full_ret['out']['id'] = $outGroupId;
		$full_ret['out']['name'] = $outGroupName;		
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 0,
					'value' => 'Сохранить и закрыть', 
					'onClick' => "serialize('sort1'); self.close()",
					'caption' => 'Сохранить и закрыть');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;						
		}
	function GroupList($content)
		{
		$form = array(
						'action' => '/admin/set/rmUser/',
						'name' => 'RMUSER'
						);
		$table = array(
						'label' => 'Группы доступа',
						'bodyId' => 'UserList',
						'colHeader' => array('#', 'Название', 'Члены'),
						'colStyle' => array('', 'editable_text', 'greybox')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['table_cols'] = array('#', 'user_name', 'memebers');
		$full_ret['form']  = $this->TPL_CreateForm($form);
		for($i=0; $i<count($content); $i++)
			{
			$full_ret['content'][$i] = $content[$i];
			}
		return $full_ret;						
		}
	function UserList($content)
		{
		$table0 = array(
						'label' => 'Список пользователей',
						'bodyId' => 'GroupList',
						'colHeader' => array('#', 'Имя', 'e-mail', 'Статус пользователя',/* 'ip', 'Был', 'Пароль', 'Статус Учетки',*/ 'Членство'),
						'colStyle' => array('', 'editable_text', 'editable_text', '',/* '', '', 'editable_text', 'editable_select',*/ '' ,'greybox')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table0);
//		$full_ret['table_captions'] = array('#', 'Пользователь', 'e-mail', 'сейчас', 'ip', 'Последний рефреш', 'Пароль', 'Статус');
		$full_ret['table_cols'] = array('#', 'user_name', 'user_email', 'user_status',/* 'user_last_ip', 'user_time_last_update', 'user_password', 'user_registation_status',*/ 'membership');
		for($i=0; $i<count($content); $i++)
			{
			$full_ret['content'][$i] = $content[$i];
			$full_ret['content'][$i]['user_password'] = '******';
			switch($content[$i]['user_registation_status'])
				{
				case 'Q': $full_ret['content'][$i]['user_registation_status'] = '<font color = "blue">Запрос активации</font>'; break;
				case 'A': $full_ret['content'][$i]['user_registation_status'] = '<font color = "green">Активизирована</font>'; break;
				case 'B': $full_ret['content'][$i]['user_registation_status'] = '<font color = "red">Заблокирована</font>'; break;
				}			
			$full_ret['content'][$i]['user_status'] = ($content[$i]['user_status']=='ON')?'<font color = "green">подключен</font>':'<font color = "red">отключен</font>';					
			}
		return $full_ret;						
		}
	}
?>