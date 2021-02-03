function checkPassword(obj, the_form)
	{
	if(canCheckPsw)
		{
		var resultMes = document.getElementById('result_IDUSER_PSW_2');
		var resultImg = document.getElementById('resultImg_IDUSER_PSW_2');
		var res = check2Password(the_form);
		if((res==1)&&(obj.value.length>5))
			{
			resultImg.src = successImg.src;
			resultMes.innerHTML = ''
			}
		else if((res==1)&&(obj.value.length<6))
			{
			resultImg.src = errorImg.src;
			resultMes.innerHTML = 'Минимум 6 символов'
			}
		else if (res==0)
			{
			resultMes.innerHTML = 'Пароли должны совпадать';
			resultImg.src = errorImg.src;
			}
		}
	}
function checkLogin(obj)
	{
	var action = document.getElementById('lnk');
	var resultMes = document.getElementById('result_' + obj.id);
	var resultImg = document.getElementById('resultImg_' + obj.id);
	if (obj.value.length>2)
		{
		resultImg.src = waitImg.src;
		$.post("/spddl/", {type:'login', login:obj.value}, function(str) 
			{	
			if(str==1)
				{
				resultImg.src = successImg.src;
				resultMes.innerHTML = ''
				}
			else if (str==0)
				{
				resultMes.innerHTML = 'Этот логин уже занят';
				resultImg.src = errorImg.src;
				}
			});
		}
	else
		{
		resultMes.innerHTML = 'Минимум 3 буквы';
		resultImg.src = errorImg.src;
		}
	}
function checkEmail(obj)
	{
	var action = document.getElementById('lnk');
	var resultMes = document.getElementById('result_' + obj.id);
	var resultImg = document.getElementById('resultImg_' + obj.id);
	resultImg.src = waitImg.src;
	$.post("/spddl/", {type:'email', email:obj.value}, function(str) 
		{	
		if(str==1)
			{
			resultImg.src = successImg.src;
			resultMes.innerHTML = ''
			}
		else if (str==0)
			{
			resultMes.innerHTML = 'ошибочный E-mail';
			resultImg.src = errorImg.src;
			}
		else if (str==2)
			{
			resultMes.innerHTML = 'этот E-mail уже используется';
			resultImg.src = errorImg.src;
			}
		});
	}
function check2Password(the_form)
	{
	var cnt = 0;
	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'password')
			{
			if(cnt)
				var passInput2 = document.forms[the_form.name].elements[i].value;				
			else
				{
				cnt ++;
				var passInput1 = document.forms[the_form.name].elements[i].value;
				}
			}
		}
	return (passInput2 == passInput1) ? 1 :0;	
	}
function EmptyCheck(the_form)
	{
	var emptyCount = 0;
	var checkPass = 0;

	var elCount = document.forms[the_form.name].elements.length;
	for (var i = 0; i < elCount; i++)
		{		
		if(document.forms[the_form.name].elements[i].type == 'submit')
			{
			var submit = document.forms[the_form.name].elements[i];
			}
		if(document.forms[the_form.name].elements[i].type == 'password')
			{
			checkPass = 0;
			}
		}
	var necCount = necessary.length;
    for (var j=0; j<necCount; j++)
	    {			
		tmpName = necessary[j];
		obj = document.getElementById(tmpName);
		/*if((!obj)&&(eval('document.all.'+tmpName)!=null))
			{
			obj=eval('document.all.'+tmpName);
			}*/
		if ((obj)&&(obj.value=='')&&(!obj.disabled))
			{
			emptyCount++;
			}
		}
	if (emptyCount>0)
		{
		submit.disabled = true;
		}
	else
		{
		if(((checkPass)&&(check2Password(the_form)))||(!checkPass))
			submit.disabled = false;
		else if((checkPass)&&(!check2Password(the_form)))
			submit.disabled = true;
		}
	}	