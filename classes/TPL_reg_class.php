<?php
//require_once("main.inc.php");
class REG_TEMPLATE extends TEMPLATE  
	{
	function addUserRegNew($defVal)
		{
//		global $NAV;
/*		if($errorMsg)
			{
			$msg['text'] = $errorMsg;
			$msg['img'] = 'src/design/message/error.gif';
			$full_ret['errorMsg'] = $msg;
			}*/
		$default = $defVal;
		for($i=0; $i<count($groups); $i++)
			{
			$grId[] = $groups[$i]['user_id'];
			$grVal[] = $groups[$i]['user_name'];
			}
		$form = array(
						'action' => '/registration/queryUser/',
						'name' => 'NEWUSER',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Регистрация',
						'bodyId' => 'UserList',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Логин',
											'Электронная почта',  
											'Пароль', 
											'Повторите пароль'/*,  
											'Кодовое слово',
											'Введите кодовое слово'*/);
		$ar[] = array('name' => 'USER_NAME', 
					'id' => 'IDUSER_NAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 150px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form); checkLogin(this);',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $default['USER_NAME']);

		$ar[] = array('name' => 'USER_EMAIL', 
					'id' => 'IDUSER_EMAIL', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form); checkEmail(this); ',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 150px', 
					'default' => $default['USER_EMAIL']);
		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 150px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form); checkPassword(this, this.form); ',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'type' => 'password', 
					'style' => 'WIDTH: 150px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form); canCheckPsw = true; checkPassword(this, this.form); ',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
/*		$ar[] = array('name' => 'USER_IMG', 
//					'skipTemplate' => 1,
					'style' => 'cursor: pointer', 
					'title' => 'Нажмите чтобы обновить слово', 
					'onClick' => 'var rnd=Math.random()*10000 + Math.random()*1000 + Math.random()*100 + Math.random()*10; this.src = \'/registration/imgcode/\'+ rnd;',
					'id' => 'IDUSER_IMG', 
					'type' => 'img', 
					'src' => '/registration/imgcode/'
					);
		$ar[] = array('name' => 'USER_CODE', 
					'id' => 'IDUSER_CODE', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => "FONT-SIZE: 20px; width: 80", 
					'default' => '');
*/					
		$ar[] = array(
					'nameImg' => 'USER_IMG', 
					'nameInput' => 'USER_CODE', 
//					'skipTemplate' => 1,
					'styleImg' => 'cursor: pointer', 
					'styleInput' => "FONT-SIZE: 20px; width: 80", 
					'title' => 'Нажмите чтобы обновить слово', 
					'onClick' => 'var rnd=Math.random()*10000 + Math.random()*1000 + Math.random()*100 + Math.random()*10; this.src = \'/registration/imgcode/\'+ rnd;',
					'id' => 'IDUSER_IMG', 
					'type' => 'captchaBoxGA', 
					'src' => '/registration/imgcode/',
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					);
		$ar[] = array('name' => 'lnk', 
					'type' => 'hidden', 
					'default' => '/spddl/');
					
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'FONT-SIZE: 15px; width: 220', 
					'disabled' => 1,
					'value' => 'Зарегистрироваться');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function getUserInfo($user)
		{
//		$cnt = 0;
		if(($user['user_time_last_update'])&&($user['user_status']!='ON'))
			{
			$today = date("d:m:Y");
			$userDay = date("d:m:Y", $user['user_time_last_update']);
			$ret['status'] = 'Был на сайте ';
			$ret['status'] .= ($today== $userDay)?'сегодня':$userDay; //date("d:m:Y", $user['user_regdate']);
			}
		elseif($user['user_status']=='ON')
			{
			$ret['status'] = 'В данный момент находится на сайте';
			}
		if($user['user_first_name']||$user['user_so_name']||$user['user_last_name'])
			$ret['fio'] = $user['user_last_name'].' '.$user['user_first_name'].' '.$user['user_so_name'];
		if($user['user_about'])
			{
			$ret['about'] = $user['user_about'];
			}
		if($user['city'])
			{
			$ret['city'] = $user['city'];
			}
		if($user['user_icq_uin'])
			{
			$ret['icq'] = $user['user_icq_uin'];
			}
		
			
			/*
		if($user['user_first_name']||$user['user_so_name']||$user['user_last_name'])
			{
			$ret[$cnt]['value'] = $user['user_last_name'].' '.$user['user_first_name'].' '.$user['user_so_name'];
			$ret[$cnt]['name'] = 'name';
			$cnt++;			
			}
		if($user['city'])
			{
			$ret[$cnt]['value'] = $user['city'];
			$ret[$cnt]['name'] = 'откуда';
			$cnt++;			
			}
		if($user['user_regdate'])
			{
			$ret[$cnt]['value'] = date("d:m:Y", $user['user_regdate']);
			$ret[$cnt]['name'] = 'зарегистрирован';
			$cnt++;			
			}
		if($user['user_status'])
			{
			$ret[$cnt]['value'] = ($user['user_status']=='ON')?'на сайте':'отключен';
			$ret[$cnt]['name'] = 'сейчас';
			$cnt++;			
			}
		if(($user['user_time_last_update'])&&($user['user_status']!='ON'))
			{
			$today = date("d:m:Y");
			$userDay = date("d:m:Y", $user['user_time_last_update']);
			$ret[$cnt]['value'] = ($today== $userDay)?'сегодня':$userDay; //date("d:m:Y", $user['user_regdate']);
			$ret[$cnt]['name'] = 'был на сайте';
			$cnt++;			
			}
		if($user['user_about'])
			{
			$ret[$cnt]['value'] = $user['user_about'];
			$ret[$cnt]['name'] = 'о себе';
			$cnt++;			
			}
			*/
		return $ret;
		}
	function pasRemind($location)
		{
		global $NAV;
		$form = array(
						'action' => $location.'set/pasRemind/',
						'name' => 'remindForm',
						'emptyCheck' => 0
						);
		$table = array(
						'label' => 'Вход в систему',
						'bodyId' => 'LoginTable',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array('Помню только', 'Который такой:');
		$ar[] = array('name' => 'TYPE', 
					'id' => 'IDTYPE', 
					'type' => 'select', 
					'style' => 'WIDTH: 200px', 
					'default' => '',
					'value' => array('user', 'email'), 
					'caption' => array('Логин', 'Почтовый адрес'), 
					'default' => '');		
		$ar[] = array('name' => 'VALUE', 
					'id' => 'IDVALUE', 
					'type' => 'text', 
					'style' => 'WIDTH: 150px', 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'necessary' => 1, 
					'default' => '');
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => 'http://'.$_SERVER['SERVER_NAME'].$location);					
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 1,
					'value' => 'Выслать пароль', 
					'caption' => 'Войти');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}	
	function passChange($content, $location, $referrer)
		{
		$form = array(
						'action' => $location.'set/password',
						'name' => 'PERSINFORM',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Персональная информация',
						'bodyId' => 'LoginTable',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Новый пароль',
											'Повтор пароля'									
											);					
		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form);',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'user_id', 
					'id' => 'user_id', 
					'type' => 'hidden', 
					'default' => $content['user_id']);	
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => $referrer);					
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'onClick' => 'if(check2Password(this.form)) return true; else {alert(\'Пароли должны совпадать!\'); return false;} ', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 1,
					'value' => 'Изменить пароль'/*, 
					'caption' => 'Изменить данные'*/);
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function persInfo($content, $location, $referrer)
		{
//		echo $location;
//		global $NAV, $CONST, $ROUT;
//		$ROUT= new Routine;
//		print_r($content);		
/*		$avName1[] = '';
		$avName2 = $ROUT->GetFileList($CONST['relPathPref'].$CONST['srcAvatarSys'], 0);
		$avName = array_merge ($avName1, $avName2);*/
//		$avName = $ROUT->GetFileList('../htdocs');
//		print_r($avName);
		$form = array(
						'action' => $location.'set/info',
						'name' => 'PERSINFORM',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Персональная информация',
						'bodyId' => 'LoginTable',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Электронная почта',
											'Имя',
											'Отчество',
											'Фамилия',
											'Город',
/*											'Индекс',
											'Адрес',
											'Телефон',											
/*											'Текущий аватар',
											'Новый аватар',
											'Загрузка аватара',*/
											'Номер ICQ',
											'Немного о себе',
											'Почтовые уведомления',
											/*,
											'Пароль',
											'Повтор пароля'	*/									
											);					
	/*	$ar[] = array('name' => 'UserRegName', 
					'id' => 'IDUSER_RegName', 
					'type' => 'textReadOnly', 
					'class' => 'input-light', 
					'style' => 'WIDTH: 200px', 
					'bold' => 1, 
					'default' => $content['user_name']);*/
		$ar[] = array('name' => 'EMail', 
					'id' => 'IDUSER_EMail', 
					'type' => 'text', 
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'necessary' => 1, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_email']);
		$ar[] = array('name' => 'FName', 
					'id' => 'IDFName', 
					'type' => 'text', 
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_first_name']);
		$ar[] = array('name' => 'SName', 
					'id' => 'IDSName', 
					'type' => 'text', 
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_so_name']);
		$ar[] = array('name' => 'LName', 
					'id' => 'IDLName', 
					'type' => 'text', 
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'class' => 'input-light', 
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
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'default' => $content['city']);
/*					
		$ar[] = array('name' => 'USER_ZIP', 
					'id' => 'IDUSER_ZIP', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 50%', 
					'default' => $content['zipCode']);
		$ar[] = array('name' => 'USER_ADR', 
					'id' => 'IDUSER_ADR', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 50%', 
					'default' => $content['address']);
		$ar[] = array('name' => 'USER_PHONE', 
					'id' => 'IDUSER_PHONE', 
					'type' => 'text', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 50%', 
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
*/		$ar[] = array('name' => 'UIN', 
					'id' => 'IDUIN', 
					'type' => 'text', 
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => ($content['user_icq_uin'])?$content['user_icq_uin']:'');
		$ar[] = array('name' => 'About', 
					'id' => 'IDAbout', 
					'type' => 'textarea', 
//					'style' => 'WIDTH: 200px', 
					'style' => 'WIDTH: 300px', 
					'necessary' => 0, 
					'useCompare' =>1,
					'rows' => 6,
					'cols' => 30,
					'wrap' => 'soft',
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $content['user_about']);		
		$ar[] = array('name' => 'subsNews', 
					'id' => 'subsNews', 
					'type' => 'checkbox', 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onClick' => 'EmptyCheck(this.form)',
					'title' => 'Получать уведомления об обновлениях на сайте', 
					'label' => 'Получать уведомления об обновлениях на сайте',
					'default' => $content['subscribersGroup']
					);	
		$ar[] = array('name' => 'subsMes', 
					'id' => 'subsMes', 
					'type' => 'checkbox', 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onClick' => 'EmptyCheck(this.form)',
					'title' => 'Получать уведомления о новых сообщениях', 
					'label' => 'Получать уведомления о новых сообщениях',
					'default' => $content['message_notify']
					);	
		$ar[] = array('type' => 'pswrdChangeBoxGA');
		/*		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
//					'class' => 'input-light', 
					'necessary' => 1, 
					'useCompare' =>1,
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => 'defvalue');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'useCompare' =>1,
//					'class' => 'input-light', 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => 'defvalue');*/
		
		$ar[] = array('name' => 'user_id', 
					'id' => 'user_id', 
					'type' => 'hidden', 
					'default' => $content['user_id']);
		$ar[] = array('name' => '_REFERRER', 
					'type' => 'hidden', 
					'default' => $referrer);					
					

		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'onClick' => 'if(check2Password(this.form)) return true; else {alert(\'Пароли должны совпадать!\'); return false;} ', 
					'class' => 'input-light', 
					'style' => 'WIDTH: 200px', 
					'disabled' => 1,
					'value' => 'Сохранить изменения'/*, 
					'caption' => 'Изменить данные'*/);
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	function showLogout()
		{
		global $NAV;
		$form = array(
						'action' => '/login/logoff/',
						'name' => 'LOGFORM',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Выход из системы',
						'bodyId' => 'LoginTable',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$ar[] = array('name' => 'logout', 
					'id' => 'IDlogout', 
					'type' => 'button', 
					'style' => 'WIDTH: 200px', 
					'onClick' => 'this.form.submit()',
					'default' => 'покинуть сайт');
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}	
	function showLogin()
		{
//		global $NAV;
		$form = array(
						'action' => '/login/',
						'name' => 'LOGFORM'/*,
						'emptyCheck' => 1*/
						);
		$table = array(
						'label' => 'Вход в систему',
						'bodyId' => 'LoginTable',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Имя пользователя',
											'Пароль',
											'Запомнить ');
		$ar[] = array('name' => 'Username', 
					'id' => 'IDUSER_NAME', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
/*					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',*/
					'default' => '');
		$ar[] = array('name' => 'Password', 
					'id' => 'IDUSER_PSW_1', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
/*					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',*/
					'default' => '');
		$ar[] = array('name' => 'saveMe', 
					'id' => 'IDsaveMe', 
					'type' => 'checkbox', 
					'disabled' => 0,
					'default' => '1');
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 0,
					'value' => 'Войти', 
					'caption' => 'Войти');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}	
	function addUserReg($defVal, $errorMsg)
		{
		global $NAV;
		if($errorMsg)
			{
			$msg['text'] = $errorMsg;
			$msg['img'] = 'src/design/message/error.gif';
			$full_ret['errorMsg'] = $msg;
			}
		$default = $defVal;
		for($i=0; $i<count($groups); $i++)
			{
			$grId[] = $groups[$i]['user_id'];
			$grVal[] = $groups[$i]['user_name'];
			}
		$form = array(
						'action' => '/registration/queryUser/',
						'name' => 'NEWUSER',
						'emptyCheck' => 1
						);
		$table = array(
						'label' => 'Новый пользователь',
						'bodyId' => 'UserList',
						);
		$full_ret['form']  = $this->TPL_CreateForm($form);
		$full_ret['table']  = $this->TPL_CreateTable($table);
		$full_ret['el_caption'] = array(	'Имя учетной записи (ник)',
											'Фамилия',  
											'Имя',  
											'Отчество',  
											'E-mail',  
											'Город',
											'Индекс',
											'Адрес',
											'Телефон',
											'Пароль', 
											'Подтверждение пароля',  
											'Кодовое слово',
											'Введите кодовое слово');
		$ar[] = array('name' => 'USER_NAME', 
					'id' => 'IDUSER_NAME', 
					'class' => 'input-light', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $default['USER_NAME']);
		$ar[] = array('name' => 'USER_LNAME', 
					'id' => 'IDUSER_LNAME', 
					'class' => 'input-light', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $default['USER_LNAME']);
		$ar[] = array('name' => 'USER_FNAME', 
					'id' => 'IDUSER_FNAME', 
					'class' => 'input-light', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $default['USER_FNAME']);
		$ar[] = array('name' => 'USER_SNAME', 
					'id' => 'IDUSER_SNAME', 
					'class' => 'input-light', 
					'type' => 'text', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 0, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => $default['USER_SNAME']);
		$ar[] = array('name' => 'USER_EMAIL', 
					'id' => 'IDUSER_EMAIL', 
					'class' => 'input-light', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $default['USER_EMAIL']);
		$ar[] = array('name' => 'USER_SITY', 
					'id' => 'IDUSER_SITY', 
					'class' => 'input-light', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $default['USER_SITY']);
		$ar[] = array('name' => 'USER_ZIP', 
					'id' => 'IDUSER_ZIP', 
					'class' => 'input-light', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $default['USER_ZIP']);
		$ar[] = array('name' => 'USER_ADR', 
					'id' => 'IDUSER_ADR', 
					'class' => 'input-light', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $default['USER_ADR']);
		$ar[] = array('name' => 'USER_PHONE', 
					'id' => 'IDUSER_PHONE', 
					'class' => 'input-light', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => $default['USER_PHONE']);
		$ar[] = array('name' => 'USER_PSW_1', 
					'id' => 'IDUSER_PSW_1', 
					'class' => 'input-light', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_PSW_2', 
					'id' => 'IDUSER_PSW_2', 
					'class' => 'input-light', 
					'type' => 'password', 
					'style' => 'WIDTH: 200px', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'default' => '');
		$ar[] = array('name' => 'USER_IMG', 
					'skipTemplate' => 1,
					'class' => 'input-light', 
					'id' => 'IDUSER_IMG', 
					'type' => 'img', 
					'src' => '/registration/imgcode/'.$rand
					);
		$ar[] = array('name' => 'USER_CODE', 
					'class' => 'input-light', 
					'id' => 'IDUSER_CODE', 
					'type' => 'text', 
					'necessary' => 1, 
					'onChange' => 'EmptyCheck(this.form)',
					'onkeyup' => 'EmptyCheck(this.form)',
					'style' => 'WIDTH: 200px', 
					'default' => '');
		$submit = array('name' => 'SUBMIT', 
					'id' => 'IDSUBMIT', 
					'class' => 'input-light', 
					'type' => 'submit', 
					'style' => 'WIDTH: 100px', 
					'disabled' => 1,
					'value' => 'Готово', 
					'caption' => 'Зарегистрировать');
		$full_ret['elSubmit'] = $this->Create_HTML_Element($submit);
		for($i=0; $i<count($ar); $i++)
			{
			$full_ret['elements'][]= $this->Create_HTML_Element($ar[$i]);	
			}
		return $full_ret;						
		}
	}
?>
