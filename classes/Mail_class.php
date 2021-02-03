<?php
class SendMail
	{
   function sendNotifyNewMessageAdminError($name, $USER_EMAIL, $sender, $firmName, $mess,  $subj, $url)
		{
//		echo $name.'  -  '.$USER_EMAIL.'  -  '.$sender.'  -  '.$subj.'  -  '.$url;
		global $CONST, $ROUT;
//		$regExp = $ROUT->GetRusData(time()+$CONST['regConfirmExpTimе']);
		$subject= $_SERVER['SERVER_NAME'].": ошибка в описании организации";
		$from = 'From: '.$CONST['robotMailNotify'];
		$body='Здравствуйте, '.$name.'!
На сайте была найдена ошибка в пописании организации "'.$firmName.'", либо кому-то есть что про неё добавить. 

Автор сообщения

'.$sender.',

Текст сообщения:
____________________________________________________________________
'.$mess.'
____________________________________________________________________

Подробности по ссылке: 

http://'.$_SERVER['SERVER_NAME'].'/'.$url.'


Вы получили это письмо, потому что вы являетесь модератором на сайте '.$_SERVER['SERVER_NAME'].'.


__________________________________________________________________
Это письмо отправлено почтовой службой сайта "Город-детям"
http://Город-детям.РФ';
		if($this->sendEMail($USER_EMAIL, $subject, $body, $from))
			return 1;
		else
			return 0;		
		}	
   function sendNotifyNewMessage($name, $USER_EMAIL, $sender)
		{
		global $CONST, $ROUT;
//		$regExp = $ROUT->GetRusData(time()+$CONST['regConfirmExpTimе']);

//		$regExp = strftime("%H:%M %d %B %Y",time()+$CONST['regConfirmExpTimе']).'г. ';
		$subject= $_SERVER['SERVER_NAME'].": У Вас новое сообщение";
		$from = 'From: '.$CONST['robotMailNotify'];
		$body='Здравствуйте, '.$name.'!
Вам пришло новое сообщение от пользователя:		

'.$sender.'

Прочитать его Вы можете на сайте '.$_SERVER['SERVER_NAME'].' в разделе "Мой профиль" > "Cообщения" или по ссылке 

http://'.$_SERVER['SERVER_NAME'].'/user/'.$name.'/message

Если указанная выше ссылка не открывается, скопируйте ее в буфер обмена,
вставьте в адресную строку браузера и нажмите ввод.

Вы получили это письмо, потому что зарегистрированы на сайте '.$_SERVER['SERVER_NAME'].'.
Вы можете настроить отправку уведомлений о новых сообщениях 
в разделе "Мой профиль" > "Редактирование"


__________________________________________________________________
Это письмо отправлено почтовой службой сайта "Город-детям"
http://Город-детям.РФ';
		if($this->sendEMail($USER_EMAIL, $subject, $body, $from))
			return 1;
		else
			return 0;		
		}	
    function sendOrderChangeStatus($order, $firm)
		{
		global $CONST, $ROUT, $USER;
//		$usr = $USER->getUserParamAll($USER->id);
		$user = $order['info']['user_name'];
		$CatCNT = new GetCatalog;
		$orderNum = $ROUT->nullFill($order['info']['id']).$firm['orderPostfiks'];
//		$orderDate = date("d.m.Y",strtotime($order['info']['dt_order']));
		$orderDate = $ROUT->GetRusData(strtotime($order['info']['dt_status']));
//		$orderDateStatus = date("d.m.Y",strtotime($order['info']['dt_status']));
		$orderSumm = $order['info']['summa'];
		$orderStatus = $order['info']['status'];
		$subject= 'Изменение состояния Вашего заказа # '.$orderNum.' - '.$_SERVER['SERVER_NAME'];
//		$subject= base64_encode('Ваш заказ № '.$orderNum.' принят - '.$_SERVER['SERVER_NAME']);
		$from = 'From: '.$CONST['orderRobotMail'];
		$body[3] = 'Здравствуйте '.$user.', 
Изменение состояния Вашего заказа #'.$orderNum.'

- Ваш заказ выслан Вам '.$orderDate['date'].' '.$orderDate['month'].' '.$orderDate['year'].' г.'.'

После получения Вашего заказа мы просим Вас выслать нам подтверждающее 
письмо на электронный адрес '.$CONST['orderRobotMail'].'


Накладная с подробным содержанием заказа находится в Вашей истории покупок:
http://'.$_SERVER['SERVER_NAME'].$CONST['linkOrderHistory'].' 


Спасибо за Ваш выбор. 

Мы всегда надеемся на длительное сотрудничество
----------------------------

Рассылка осуществляется системой IpoShop.
IpoDesign - http://www.ipo-design.ru';
		
		$body[2] = 'Здравствуйте '.$user.', 
Изменение состояния Вашего заказа #'.$orderNum.'


- Ваш заказ оплачен в полном объеме.
- Спасибо за Ваш платеж. 

Дата зачисления платежа  '.$orderDate['date'].' '.$orderDate['month'].' '.$orderDate['year'].' г.'.'


Накладная с подробным содержанием заказа находится в Вашей истории покупок:
http://'.$_SERVER['SERVER_NAME'].$CONST['linkOrderHistory'].' 


Спасибо за Ваш выбор. 

Мы всегда надеемся на длительное сотрудничество
----------------------------

Рассылка осуществляется системой IpoShop.
IpoDesign - http://www.ipo-design.ru';
		
		$body[1] = 'Здравствуйте '.$user.', 
Изменение состояния Вашего заказа #'.$orderNum.'


- Ваш заказ принят менеджером магазина.
- Дата '.$orderDate['date'].' '.$orderDate['month'].' '.$orderDate['year'].' г.'.'


Накладная с подробным содержанием заказа и Квитанция для оплаты через Сбербанк РФ находятся в Вашей истории покупок:
http://'.$_SERVER['SERVER_NAME'].$CONST['linkOrderHistory'].' 


Спасибо за Ваш выбор. 

Мы всегда надеемся на длительное сотрудничество
----------------------------

Рассылка осуществляется системой IpoShop.
IpoDesign - http://www.ipo-design.ru';	
	if(($orderStatus>0)&&($orderStatus<4))
		{
		if($this->sendEMail($order['info']['user_email'], $subject, $body[$orderStatus], $from))
				return 1;
			else
				return 0;		
			}	
		}
		
   function sendRemindPassword($code, $pswrd, $usr, $location)
		{
		global $CONST, $ROUT;
		$regExp = $ROUT->GetRusData(time()+$CONST['regConfirmExpTimе']);
//		$regExp = strftime("%H:%M %d %B %Y",time()+$CONST['passwordRemindActivationTime']).' г.';
		$subject= $_SERVER['SERVER_NAME'].": восстановление пароля";
		$from = 'From: '.$CONST['registrationRobotMail'];
		$body='
Вы получили это письмо, в связи с запросом на восстановление забытого пароля на сайте '.$_SERVER['SERVER_NAME'].'.

------------------------------------------------
ВАЖНО!
------------------------------------------------

Если Вы не делали запроса на изменение пароля, проигнорируйте и удалите это письмо. Продолжайте только в том случае, если Вам действительно требуется восстановление пароля!

------------------------------------------------
Инструкция по активации ниже.
------------------------------------------------

Мы просим от Вас "подтверждения" Вашего запроса на восстановление забытого пароля для проверки того, что это действие выполнено именно Вами. Это требуется для защиты от нежелательных злоупотреблений.

Для подтверждения запроса и активации нового пароля, зайдите по следующей ссылке:

http://'.$_SERVER['SERVER_NAME'].$location.'confirmPR/'.$code.'     

не позднее '.$regExp['date'].' '.$regExp['month'].' '.$regExp['year'].' г.


После завершения активации, Вы сможете авторизоваться под Вашим новым паролем (указан ниже). Вы сможете изменить этот пароль в любое время, через Личный кабинет.

------------------------------------------------
Ваш новый пароль
------------------------------------------------

Ваш новый пароль: '.$pswrd.'

Сохраните этот пароль в безопасном месте. Перед использованием нового пароля, не забудьте сделать переактивацию (см. выше).




__________________________________________________________________
Это письмо отправлено почтовой службой сайта "Город-детям"
http://Город-детям.РФ';
		if($this->sendEMail($usr['user_email'], $subject, $body, $from))
			return 1;
		else
			return 0;		
		}	
    function sendOrderConfirmAdmin($order, $firm)
		{
		global $CONST, $ROUT, $USER;
		$usr = $USER->getUserParamAll($USER->id);
		$CatCNT = new GetCatalog;
		$orderNum = $ROUT->nullFill($order['info']['id']).$firm['orderPostfiks'];
//		$orderDate = date("d.m.Y",strtotime($order['info']['dt_order']));
		$orderDate = $ROUT->GetRusData(strtotime($order['info']['dt_order']));
		$orderSumm = $order['info']['summa'];

		$subject= 'Уведомление о поступлении заказа #'.$orderNum;
//		$subject= $_SERVER['SERVER_NAME'].": Order confirmation";
		$from = 'From: '.$CONST['orderRobotMail'];
		$body = 'Уведомление о поступлении заказа на сайте '.$_SERVER['SERVER_NAME'].'
		
   Номер заказа:          '.$orderNum.'
   Дата заказа:           '.$orderDate['date'].' '.$orderDate['month'].' '.$orderDate['year'].' г.'.'
   Товарополучатель:      '.$order['info']['user_first_name'].' '.$order['info']['user_so_name'].' '.$order['info']['user_last_name'].'
   Телефон:               '.$order['info']['phone'].' 
   Адрес:                 '.$order['info']['address'].' 
   
   Перечень товаров:
   
';
for($i=0; $i<count($order['content']); $i++)   
	{
	$body .= '   '.($i+1).'. '.$order['content'][$i]['item'].' в количестве '.$order['content'][$i]['value'].' шт. на сумму '.$order['content'][$i]['price'].'р.

';
	}	
$body .='
----------------------------------------------------------------------------
   Предварительная сумма заказа    '.$orderSumm.' рублей

   
   



Рассылка осуществляется системой IpoShop.
http://www.ipo-design.ru';
	
	if($this->sendEMail($CONST['orderAdminMail'], $subject, $body, $from))
			return 1;
		else
			return 0;		
		}	
    function sendOrderConfirmUser($order, $firm)
		{
//		print_r($order);
		global $CONST, $ROUT, $USER;
		$usr = $USER->getUserParamAll($USER->id);
		$CatCNT = new GetCatalog;
		$orderNum = $ROUT->nullFill($order['info']['id']).$firm['orderPostfiks'];
		$orderDate = $ROUT->GetRusData(strtotime($order['info']['dt_order']));
		$orderSumm = $order['info']['summa'];

		$subject= 'Ваш заказ # '.$orderNum.' принят - '.$_SERVER['SERVER_NAME'];
//		$subject= base64_encode('Ваш заказ № '.$orderNum.' принят - '.$_SERVER['SERVER_NAME']);
		$from = 'From: '.$CONST['orderRobotMail'];
//		$from = 'From: '.$CONST['orderRobotMail'].' \r\n';
		$body = 'Здравствуйте, '.$order['info']['user_first_name'].'!
		
Ваш заказ #'.$orderNum.' принят на проверку
в ближайшее время с Вами свяжется наш представитель 
для уточнения Вашего заказа и способов его доставки.

   Номер заказа:    '.$orderNum.'
   Дата заказа:     '.$orderDate['date'].' '.$orderDate['month'].' '.$orderDate['year'].' г.
   
   Перечень товаров:
   
';
for($i=0; $i<count($order['content']); $i++)   
	{
	$body .= '   '.($i+1).'. '.$order['content'][$i]['item'].' в количестве '.$order['content'][$i]['value'].' шт. на сумму '.$order['content'][$i]['price'].'р.

';
	}	
$body .='
----------------------------------------------------------------------------
   Предварительная сумма заказа    '.$orderSumm.' рублей

   
   

Рассылка осуществляется системой IpoShop.
http://www.ipo-design.ru';
//	echo $body;
	if($this->sendEMail($order['info']['user_email'], $subject, $body, $from))
//	if($this->send_Mail($order['info']['user_email'], $subject, $body, $from, '', 'html'))
			return 1;
		else
			return 0;		
		}	
   function sendRegistrationConfirm($name, $USER_EMAIL, $USER_PSW_1, $sid)
		{
		global $CONST, $ROUT;
		$regExp = $ROUT->GetRusData(time()+$CONST['regConfirmExpTimе']);

//		$regExp = strftime("%H:%M %d %B %Y",time()+$CONST['regConfirmExpTimе']).'г. ';
		$subject= $_SERVER['SERVER_NAME'].": подтверждение регистрации";
		$from = 'From: '.$CONST['registrationRobotMail'];
		$body='Здравствуйте, '.$name.'!
Если Вы действительно желаете зарегистрироваться, пожалуйста, 
подтвердите свое намерение до '.$regExp['date'].' '.$regExp['month'].' '.$regExp['year'].' г.'.'

Для этого Вам всего лишь нужно перейти по ссылке: http://'.$_SERVER['SERVER_NAME'].'/registration/confirm/'.$sid.'

Подтверждение требуется для исключения несанкционированного 
использования Вашего e-mail адреса. Для потверждения достаточно 
перейти по ссылке, дополнительных писем отправлять не требуется.

Если указанная выше ссылка не открывается, скопируйте ее в буфер обмена,
вставьте в адресную строку браузера и нажмите ввод.

Ваши регистрационные данные: 

----------------------------
Учетная запись: '.$name.'
Пароль: '.$USER_PSW_1.'
----------------------------




__________________________________________________________________
Это письмо отправлено почтовой службой сайта "Город-детям"
http://Город-детям.РФ';

		if($this->sendEMail($USER_EMAIL, $subject, $body, $from))
			return 1;
		else
			return 0;		
		}	
    function send_Mail($email, $subject, $body, $from, $kod, $type)
		{
		$headers  = $from;
		if($type=='html')
			$headers  .= "Content-type: text/html; charset=windows-1251 \r\n"; 
			
//		echo 'email = '.$email.'; <br> subject = '.$subject.'; <br> body = '.$body.'; <br> from = '.$from; 
//		$subject = '=?koi8-r?B?'.base64_encode($subject_v_kodirovke_koi8_r).'?=';
		$subject = '=?koi8-r?B?'.base64_encode(convert_cyr_string ($subject,w,k)).'?=';

//		$body=iconv( 'UTF-8', 'KOI8-R//IGNORE', $body );
		$body=convert_cyr_string($body,w,k);
		$success = mail($email, $subject, $body, $headers);
		return $success;
		}	
    function sendEMail($email, $subject, $body, $from)
		{
//		echo 'email = '.$email.'; <br> subject = '.$subject.'; <br> body = '.$body.'; <br> from = '.$from; 
//		$subject = '=?koi8-r?B?'.base64_encode($subject_v_kodirovke_koi8_r).'?=';
		$subject = '=?koi8-r?B?'.base64_encode(iconv( 'UTF-8', 'KOI8-R//IGNORE', $subject )).'?=';

		$body=iconv( 'UTF-8', 'KOI8-R//IGNORE', $body );
//		$body=convert_cyr_string($body,w,k);
//		$subject=convert_cyr_string ($subject,w,k);
		$success = mail($email, $subject, $body, $from);
		return $success;
		}	
	}
?>