<?php 
class DirectMail_TEMPLATE extends TEMPLATE  
	{
	function editDM($curNode, $location) /*25_10_2007 форма редактирования рассылки*/
		{
		global $CONST;
		for($i=0; $i<count($groups); $i++)
			{
			$grId[] = $groups[$i]['user_id'];
			$grVal[] = $groups[$i]['user_name'];
			}
		$firstDate = time();
		$curDate = strtotime($curNode['date']);
		$lastDate = (time() + 31536000); //год вперед, 
		$secInYear = 31536000;
		for($i=0; $i<=30; $i++)
			$day[] = $i+1;
		$month['captions'] = array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
		$month['values'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$cnt = 1;//round(($firstDate/$secInYear - time())+1);
		for($i=0; $i<=$cnt; $i++)
			{
			$year[]  = Date("Y", $firstDate + $secInYear*$i);
			}
		$def['pub']['day'] = Date("j", $curDate);
		$def['pub']['year'] = Date("Y", $curDate);
		$def['pub']['month'] = Date("n", $curDate);

		$table = array	(
							'label' => 'Редактирование рассылки',
							'bodyId' => 'publicDateTable'							
						);
		$form = array('action' => $location.'set/edit/',
						'name' => 'publicDate',
						'emptyCheck' => 1,
						'elementCaption' => array('Тема письма', 'Текст', 'Дата отправки')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'NAME', 
					'id' => 'IDNAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $curNode['subject']
					);
		
		$ar[] = array('name' => 'BODY', 
					'id' => 'IDBODY', 
					'type' => 'FCKEDITOR', 
					'fake_necessary' => 1, 
					'useCompare' =>1,
					'height' => 300, 
					'width' => '100%', 
					'default' => $curNode['body']
					);
		$ar[] = array('name' => 'PUBLISH', 
					'id' => 'IDPUBLISH', 
					'type' => 'calendar', 
					'month' => $month,
					'day' => $day,
					'year' => $year,
					'default' => $def['pub'],
					'disabled' => 0,
					'useCompare' =>1,
					'switch' => 0,
					'switchValue' => 0,
					'curDate' => time()*1000,
					'minShow' => $firstDate*1000,
					'maxShow' => $lastDate*1000, //год вперед, 
					'src' => $CONST['srcDesign'].'/admin/calendar.gif',
					'onMouseMove' => "this.style.cursor='hand'; return false;",
					'onClick' => "open_window('/tools/calendar/PUBLISH', 'calendar', 250, 200, 0);"
					);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['id']);
		$submit = array('name' => 'SUBMITIMG', 
					'id' => 'IDSUBMITIMG', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 0,
					'value' => 'Изменить', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}		
	function newDM($groups, $location) /*24_10_2007 форма новой рассылки*/
		{
		global $CONST;
		for($i=0; $i<count($groups); $i++)
			{
			if((!$groups[$i]['is_system'])||(($groups[$i]['is_system'])&&($groups[$i]['user_id']==$CONST['defSubscribersGroup'])))
				{
				$grId[] = $groups[$i]['user_id'];
				$grVal[] = $groups[$i]['user_name'];
				}
			}
		$firstDate = time();//strtotime($curNode['date']);
		$lastDate = (time() + 31536000); //год вперед, 
		$secInYear = 31536000;
		for($i=0; $i<=30; $i++)
			$day[] = $i+1;
		$month['captions'] = array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
		$month['values'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$cnt = 1;//round(($firstDate/$secInYear - time())+1);
		for($i=0; $i<=$cnt; $i++)
			{
			$year[]  = Date("Y", $firstDate + $secInYear*$i);
			}
		$def['pub']['day'] = Date("j", $firstDate);
		$def['pub']['year'] = Date("Y", $firstDate);
		$def['pub']['month'] = Date("n", $firstDate);
		$def['arc']['day'] = Date("j", $arcDate);
		$def['arc']['year'] = Date("Y", $arcDate);
		$def['arc']['month'] = Date("n", $arcDate);
		
		$table = array	(
							'label' => 'Новая рассылка',
							'bodyId' => 'publicDateTable'							
						);
		$form = array('action' => $location.'set/add/',
						'name' => 'publicDate',
						'emptyCheck' => 1,
						'elementCaption' => array('Тема письма', 'Текст', 'Вложение', 'Получатели' ,'Дата отправки')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'NAME', 
					'id' => 'IDNAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 100%', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => ''
					);
		
		$ar[] = array('name' => 'BODY', 
					'id' => 'IDBODY', 
					'type' => 'FCKEDITOR', 
					'fake_necessary' => 1, 
					'height' => 300, 
					'width' => '100%', 
					'default' => ''
					);
		$ar[] = array('name' => 'ATT', 
					'id' => 'IDATT', 
					'type' => 'file', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArt',
					'MAX_FILE_SIZE' => 1000000,
					'necessary' => 0, 
					'onChange' => 'EmptyCheck(this.form)',
//					'onkeyup' => $event,
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
		$ar[] = array('name' => 'PUBLISH', 
					'id' => 'IDPUBLISH', 
					'type' => 'calendar', 
					'month' => $month,
					'day' => $day,
					'year' => $year,
					'default' => $def['pub'],
					'disabled' => 0,
					'switch' => 0,
					'switchValue' => 0,
					'curDate' => time()*1000,
					'minShow' => $firstDate*1000,
					'maxShow' => $lastDate*1000, //год вперед, 
					'src' => $CONST['srcDesign'].'/admin/calendar.gif',
					'onMouseMove' => "this.style.cursor='hand'; return false;",
					'onClick' => "open_window('/tools/calendar/PUBLISH', 'calendar', 250, 200, 0);"
					);
/*		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['id']);*/
		$submit = array('name' => 'SUBMITIMG', 
					'id' => 'IDSUBMITIMG', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 1,
					'value' => 'Создать', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}		
	function ShowUploadAttachment($id, $location) /*13_10_2007 загрузка логотипа*/
		{
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$value = 'Добавить файл';
			
		$form = array('action' => $location.'set/fileUpload/',
						'name' => 'newImg',
						'elementCaption' => array($value)
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$event = 'if (this.value) {document.getElementById(\'IDSUBMITAT\').disabled = false; } else {document.getElementById(\'IDSUBMITAT\').disabled = true;}';
		
		$value = 'Загрузить файл';
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $id);
		$ar[] = array('name' => 'ATT', 
					'id' => 'IDATT', 
					'type' => 'file', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArt',
					'MAX_FILE_SIZE' => 1000000,
					'necessary' => 0, 
					'onChange' => $event,
//					'onkeyup' => $event,
					'default' => '');					
		$submit = array('name' => 'SUBMITAT', 
					'id' => 'IDSUBMITAT', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
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
	function ShowAttachmentsDM($curNode, $files, $location) //23_10_2007 список подписчиков
		{		
/*		if(!$user['is_system'])
			{*/
		$disabled = 0; //($user['is_system'])?1:0;
		$form = array('action' => $location.'set/delFiles/',
						'name' => 'membership',
						'elementCaption' => array('Прикрепленные файлы')
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
/*		print_r($usersGroups);
		print_r($files);*/
		for($i=0; $i<count($files); $i++)
			{
			$gr[] = array('name' => 'File^'.$files[$i]['file'], 
						'id' => 'IDFile^'.$files[$i]['file'], 
						'title' => $files[$i]['file'], 
						'type' => 'checkbox', 
						'class' => 'input2', 
						'onClick' => 'checkCheckboxesInFormAndChangeSubmut(this.form)', 
						'disabled' => 0,
						'default' => 0);
			$full_ret['groupCaption'][] = $files[$i]['file'];
			}
		for($i=0; $i<count($gr); $i++)
			{
			$full_ret['files'][]= $this->Create_HTML_Element($gr[$i]);	
			}		
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['id']);
		$ar[] = array('name' => 'fileList', 
					'id' => 'IDfileList', 
					'type' => 'fileList', 
					'disabled' => 0,
					'default' => '1');			
//		echo $curNode['id'];

		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
//		print_r($full_ret['elements']);
		$submit = array('name' => 'SUBFILES', 
					'id' => 'IDSUBFILES', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Удалить прикрепленные файлы', 
					'caption' => 'Редактировать');
		$full_ret['membSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//			}
			
		}
	function ShowSubscribersDM($id, $groups, $subscr, $location) //23_10_2007 список подписчиков
		{		
/*		if(!$user['is_system'])
			{*/
		global $CONST;
		$disabled = 0; //($user['is_system'])?1:0;
		$form = array('action' => $location.'set/subscribe/',
						'name' => 'membership'
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
/*		print_r($usersGroups);
		print_r($groups);*/
		for($i=0; $i<count($groups); $i++)
			{
			$def = 0;
			if((!$groups[$i]['is_system'])||(($groups[$i]['is_system'])&&($groups[$i]['user_id']==$CONST['defSubscribersGroup'])))
				{
				if(is_array($subscr))
					{
					for($k=0; $k<count($subscr); $k++)
						{
						if($groups[$i]['user_id'] == $subscr[$k]['user_id'])
							{
//					echo $def;
							$def++;
							}
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
						'default' => $id);
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
						'value' => 'Изменить получателей', 
						'caption' => 'Редактировать');
			$full_ret['membSubmit'] = $this->Create_HTML_Element($submit);
			$full_ret['searchHide'] = 1;
			return $full_ret;		
//			}
//		return $node;				
		}
	function showDateDM($curNode, $location) /*23_10_2007 кнопка даты рассылки*/
		{
		global $CONST;
//		echo $curNode['date'];
//		$firstDate = strtotime($curNode['date']);
		$firstDate = time();
		$lastDate = (time() + 31536000); //год вперед, 
		$secInYear = 31536000;
		for($i=0; $i<=30; $i++)
			$day[] = $i+1;
		$month['captions'] = array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
		$month['values'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
		$cnt = 1;//round(($firstDate/$secInYear - time())+1);
		for($i=0; $i<=$cnt; $i++)
			{
			$year[]  = Date("Y", $firstDate + $secInYear*$i);
			}
		$def['pub']['day'] = Date("j", strtotime($curNode['date']));
		$def['pub']['year'] = Date("Y", strtotime($curNode['date']));
		$def['pub']['month'] = Date("n", strtotime($curNode['date']));
		
		$table = array	(
							'label' => 'Поиск заказов',
							'bodyId' => 'publicDateTable'
						);
		$form = array('action' => $location.'set/date/',
						'name' => 'publicDate',
						'elementCaption' => array('Дата рассылки')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'PUBLISH', 
					'id' => 'IDPUBLISH', 
					'type' => 'calendar', 
					'month' => $month,
					'day' => $day,
					'year' => $year,
					'default' => $def['pub'],
					'disabled' => 0,
					'switch' => 0,
					'switchValue' => 0,
					'curDate' => time()*1000,
					'minShow' => $firstDate*1000,
					'maxShow' => $lastDate*1000, //год вперед, 
					'src' => $CONST['srcDesign'].'/admin/calendar.gif',
					'onMouseMove' => "this.style.cursor='hand'; return false;",
					'onClick' => "open_window('/tools/calendar/PUBLISH', 'calendar', 250, 200, 0);"
					);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['id']);
		$submit = array('name' => 'SUBMITIMG', 
					'id' => 'IDSUBMITIMG', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => 'Изменить дату', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}		
	function ShowSubjectDM($curNode, $location) /*23_10_2007 кнопка редактирования статуса*/
		{
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/subject/',
						'name' => 'status',
						'elementCaption' => array('Тема рассылки')
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);		
		$value = $curNode['subject'];
		$event = 'if (this.value != document.getElementById(\'IDOLDNAME\').value) {document.getElementById(\'IDSUBMITCAT\').disabled = false; }
					else {document.getElementById(\'IDSUBMITCAT\').disabled = true;}';

		$ar[] = array('name' => 'OLDNAME', 
					'id' => 'IDOLDNAME', 
					'type' => 'hidden', 
					'default' => $value);
		$ar[] = array('name' => 'NEWNAME', 
					'id' => 'IDNEWNAME', 
					'type' => 'text', 
//					'style' => 'WIDTH: 95%', 
					'class' => 'inputArt',
					'necessary' => 0, 
					'onChange' => $event,
					'onkeyup' => $event,
					'default' => $value);							
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['id']);
		$submit = array('name' => 'IDSUBMITCAT', 
					'id' => 'IDIDSUBMITCAT', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
					'disabled' => 1,
					'value' => 'Изменить тему', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}			
	function ShowStatusDM($curNode, $location) /*23_10_2007 кнопка редактирования статуса*/
		{
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/status/',
						'name' => 'status'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);		
		$disabled = 1;
//		echo '<br>'.$curNode['date'].'<br>'.time();
		if((strtotime($curNode['date'])>time())&&($curNode['status']<2))
			{
			$disabled = 0;
			}
		$value = ($curNode['status'])?'Отключить':'Включить';
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $curNode['id']);
		$submit = array('name' => 'SUBMITSTATUS', 
					'id' => 'IDSUBMITSTATUS', 
					'type' => 'submit', 
//					'style' => 'WIDTH: 200px', 
					'class' => 'inputArtSubmit',
					'disabled' => $disabled,
					'value' => $value.' рассылку', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}		
	function ShowDeleteDM($id, $location) /*23_10_2007 кнопка удаления*/
		{
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'set/delete/',
						'name' => 'newArticle'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$ar[] = array('name' => 'curNode', 
					'id' => 'IDcurNode', 
					'type' => 'hidden', 
					'default' => $id);
		$submit = array('name' => 'SUBMITDELETE', 
					'id' => 'IDSUBMITDELETE', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => 0,
					'value' => 'Удалить рассылку', 
					'caption' => 'Редактировать');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}	
	function ShowEditDM($id, $location) /*23_10_2007 кнопка редактирования*/
		{
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
					'default' => $id);
		$submit = array('name' => 'SUBMITEDIT', 
					'id' => 'IDSUBMITEDIT', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => 0,
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
	function ShowNewDM($location) /*23_10_2007 кнопка создания новой рассылки*/
		{
		$table = array(
						'label' => 'Изменение статуса',
						'bodyId' => 'article'
						);
		$form = array('action' => $location.'add/',
						'name' => 'newArticle'
						);
		$full_ret['table']  = $this->TPL_CreateTable($table);	
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$submit = array('name' => 'SUBMITEDIT', 
					'id' => 'IDSUBMITEDIT', 
					'type' => 'submit', 
					'class' => 'inputArtSubmit',
					'disabled' => 0,
					'value' => 'Создать рассылку', 
					'caption' => 'Создать рассылку');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}		
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		return $full_ret;		
//		return $node;		
		}		
	function showDMList($location, $list) //23_10_2007 главное окно управления рассылками
		{
		if(is_array($list))
			{

			$table = array('bodyId' => 'order',
						'headerAlign' => array('left','left', 'left', 'center'),
						'colHeader' => array('п/н', 'Тема', 'Срок отправки', 'Статус'),
						'colAlias' => array('number', 'subject', 'date', 'status')
						);
			$statusDescr = array(0 => '<font color="red">выключена</font>', 1 => '<font color="green">включена</font>', 2 => '<font color="blue">отправлена</font>');
			for($i=0; $i<count($list); $i++)
				{
				$full_ret['content'][$i]['subject'] = $list[$i]['subject'];
				$full_ret['align'][$i]['subject'] = 'left';
				
				$full_ret['content'][$i]['number'] = $i+1;
				$full_ret['align'][$i]['number'] = 'left';
				
				$full_ret['content'][$i]['date'] = $list[$i]['date'];
				$full_ret['align'][$i]['orderNumber'] = 'center';
								
				$full_ret['content'][$i]['status'] = $statusDescr[$list[$i]['status']];
				$full_ret['align'][$i]['status'] = 'center';
				
				$full_ret['content'][$i]['id'] = $list[$i]['id'];
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
			$full_ret['noList']=1;
			}
//		return $full_ret;
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
		
		
	}

?>
