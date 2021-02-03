function mesImageShow(obj) 
	{
//	alert(showProperties(obj));
//	alert(obj.src);
	
	var newHeight = obj.naturalHeight + 40;
	var newWidth = 	obj.naturalWidth + 16;
	$('#mesImage').attr('src', obj.src);
	var alt = (obj.alt != '') ? obj.alt : '';
	alt += ' - фото из отзыва о ' + document.title;
		
	$('#mesImageAlt').text(alt);
	$('#mesImageContaner').css({'height': newHeight + 'px', 'width': newWidth + 'px'});
	
	UI.togglePanel('', 'mesImageContaner', 1, '')
	}
function toggleAllMessages() 
	{		
	if($("#moreMessageList").hasClass('messagesHidden'))
		{
		$('.messageLastTmp').removeClass("messageLast");
		$('.messageNotLast' ).slideDown("slow", function() {		
			$("#moreMessageList").removeClass('messagesHidden');
			$("#moreMessageList").addClass('messagesShowed');
			$('#moreMessageList').attr('title', 'показать последние комментарии');
			$('#moreMessageList').text('показать последние >>');		
			resize();
			});		
		}
	else
		{
		$('.messageLastTmp').addClass("messageLast");
		$('.messageNotLast').slideUp("slow", function() {		
			$("#moreMessageList").addClass('messagesHidden');
			$("#moreMessageList").removeClass('messagesShowed');
			$('#moreMessageList').attr('title', 'показать все комментарии');
			$('#moreMessageList').text('показать все >>');		
			resize();
			});
		}
	}

function showCommentLast(str)
	{
	var parArr = str.split('##');
	if(parArr[8]>0)
		{
		var messContaner = document.getElementById("mesReplyArea_" + parArr[8]);
		}
	else
		{
		var messContaner = document.getElementById("mesNewArea");
		}
	
	var oDivMessSingleContaner = document.createElement("DIV");
	
	var oDivMessTop = document.createElement("DIV");
	var oDivMessTopAuth = document.createElement("DIV");
	var oDivMessTopDate = document.createElement("DIV");
	
	var oDivMessBody = document.createElement("DIV");
	
/*	var oDivAction = document.createElement("DIV");
	var oDivActionReply = document.createElement("SPAN");
	var oDivActionEdit = document.createElement("SPAN");
	var oDivActionState = document.createElement("SPAN");
	var oDivActionDel = document.createElement("SPAN");
*/
	var oDivReplyText = document.createElement("DIV");
	var oDivReplySubmit = document.createElement("DIV");
	var oDivReplySubmitButton = document.createElement("span");
	var oDivReplyResult = document.createElement("DIV");

	oDivMessSingleContaner.style.marginLeft = 40*parArr[7] + 'px';
	oDivMessSingleContaner.style.display = 'none';
	
	oDivMessSingleContaner.className = 'message';
	oDivMessTop.className = 'header';
	oDivMessTopAuth.className = 'auth';
	oDivMessTopDate.className = 'date';
	oDivMessBody.className = 'body';
/*	oDivAction.className = 'actionMes';*/
	oDivReplyText.className = 'messageTextArea';
	oDivReplySubmit.className = 'messageTextSubmit';
	oDivReplySubmitButton.className = 'activeButton';
		
	oDivMessSingleContaner.id = 'mesageSinleContaner_' + parArr[0];
/*	oDivActionReply.id = 'mesReply_' + parArr[0];
	oDivActionEdit.id = 'mesEdit_' + parArr[0];
	oDivActionState.id = 'mesState_' + parArr[0];
	oDivActionDel.id = 'mesDel_' + parArr[0];*/
	
/*	oDivActionReply.className = 'activeLink';
	oDivActionEdit.className = 	'activeLink';
	oDivActionState.className = 'activeLink';
	oDivActionDel.className = 	'activeLink';*/
	
	oDivMessTopAuth.innerHTML = parArr[2];
	oDivMessTopDate.innerHTML = parArr[4];
	oDivMessBody.innerHTML 	= 	parArr[1];

	oDivMessTop.appendChild(oDivMessTopAuth);
	oDivMessTop.appendChild(oDivMessTopDate);

/*	oDivAction.appendChild(oDivActionReply);
	oDivAction.appendChild(oDivActionEdit);
	oDivAction.appendChild(oDivActionState);
	oDivAction.appendChild(oDivActionDel);*/

	oDivMessSingleContaner.appendChild(oDivMessTop);
	oDivMessSingleContaner.appendChild(oDivMessBody);
/*	oDivMessSingleContaner.appendChild(oDivAction);*/
	
	messContaner.appendChild(oDivMessSingleContaner);
	messContaner.appendChild(oDivReplyText);
	messContaner.appendChild(oDivReplySubmit);
	messContaner.appendChild(oDivReplyResult);
	
	$('#mesageSinleContaner_' + parArr[0]).show('slow');
	return (parArr[0]);
	}

function showCommentList(str)
	{
	var strArr = str.split('~~');
//	objCnt = strArr.length - 1;
//	var oDivContaner = document.createElement("DIV");
	var messContGlobal = document.getElementById("mesGlobal");
	messContGlobal.innerHTML ='';
	for(var i=0; i < strArr.length;  i++ )
		{
		var parArr = strArr[i].split('##');
		var oDivMessContId = document.createElement("DIV");
		var oDivMessCont = document.createElement("DIV");
		var oDivMessTop = document.createElement("DIV");
		var oDivMessTopAuth = document.createElement("DIV");
		var oDivMessTopDate = document.createElement("DIV");
		var oDivMessTopManage = document.createElement("DIV");
		var oDivMessTopManageSpan = document.createElement("SPAN");
		var oDivMessTopManageSpanImgState = document.createElement("IMG");
		var oDivMessTopManageSpanImgDel = document.createElement("IMG");
		
		var oDivMessBody = document.createElement("DIV");
		var oDivMessBodyCont = document.createElement("P");
		
		oDivMessContId.id = 'mes_' + parArr[0];
		oDivMessCont.id = 'company_detail_message_01';
		oDivMessTop.id = 'company_message_top';
		oDivMessTopAuth.id = 'company_message_top_name';
		oDivMessTopDate.id = 'company_message_top_date';
		oDivMessTopManage.id = 'company_message_top_manage';
		
		oDivMessBody.id = 'company_detail_message_text';
		oDivMessBody.className = 'company_detail_message_text';

		oDivMessBodyCont.innerHTML = parArr[1];
		oDivMessTopAuth.innerHTML = '<a href="" title="">' + parArr[2] + '&nbsp;</a>';
		oDivMessTopDate.innerHTML = parArr[4];
		
		oDivMessTopManageSpanImgState.src = (parArr[3]==0) ? '/src/design/tmp/admin/show.gif' : '/src/design/tmp/admin/hide.gif';
		oDivMessTopManageSpanImgState.title = (parArr[3]==0) ? 'Скрыть отзыв' : 'Отобразить отзыв';
		oDivMessTopManageSpanImgState.id = 	'mesState_' + parArr[0];
		
		oDivMessTopManageSpanImgDel.src = '/src/design/tmp/message/error.gif';
		oDivMessTopManageSpanImgDel.title = 'Удалить отзыв';
		oDivMessTopManageSpanImgDel.id = 	'mesDel_' + parArr[0];
		
		oDivMessTopManageSpan.appendChild(oDivMessTopManageSpanImgState);
		oDivMessTopManageSpan.appendChild(oDivMessTopManageSpanImgDel);		
		oDivMessTopManage.appendChild(oDivMessTopManageSpan);
		
		oDivMessTop.appendChild(oDivMessTopAuth);
		oDivMessTop.appendChild(oDivMessTopDate);
		oDivMessTop.appendChild(oDivMessTopManage);
		
		oDivMessBody.appendChild(oDivMessBodyCont);
		
		oDivMessCont.appendChild(oDivMessTop);
		oDivMessCont.appendChild(oDivMessBody);

		oDivMessContId.appendChild(oDivMessCont);
		
		
		messContGlobal.appendChild(oDivMessContId);
		}		
	}
function toggleCommentBox(obj, showMore)
	{
//	$('#newMes_').wysiwyg('clear');
/*	alert($("[id ^= newMes_]").length);*/
	$('[id ^= newMes_]').wysiwyg('destroy');
	$('[id ^= newMes_]').hide();
	$('[id ^= submit_]').hide();
	if(showMore == 1)
		var boxOptions  = {rmUnusedControls: true, 
//									brIE: true,
						controls: {
							cut   : { visible : true },
							copy  : { visible : true },
							paste : { visible : true }, 			
							bold          : { visible : true },
							italic        : { visible : true },
							underline     : { visible : true },
							strikeThrough : { visible : true }, 
							insertOrderedList    : { visible : true },
							insertUnorderedList  : { visible : true }, 
							
							alertSep: { separator: true },
							createLink  : 	{ visible : true }, 
							unLink  : 		{ visible : true }, 
							insertImage  : 	{ visible : true },
							alertSep: { separator: true },
							
							undo : { visible : true },
							redo : { visible : true }			
							},
						plugins: {
								i18n: { lang: "ru" }}};
	else
		var boxOptions  = {rmUnusedControls: true, 
//									brIE: true,
						controls: {
							cut   : { visible : true },
							copy  : { visible : true },
							paste : { visible : true }, 			
							bold          : { visible : true },
							italic        : { visible : true },
							underline     : { visible : true },
							strikeThrough : { visible : true }, 
							insertOrderedList    : { visible : true },
							insertUnorderedList  : { visible : true }, 
							undo : { visible : true },
							redo : { visible : true }			
							},
						plugins: {
								i18n: { lang: "ru" }}};		
	var newSufix = GetStrPrt(obj.id, '_', 1);
	if(newSufix != activeSufix)
		{
		activeSufix = newSufix;
	//	var messContaner = 
		if(document.getElementById('newMes_' + activeSufix))
			{
			document.getElementById("commentBox_" + activeSufix).removeChild(document.getElementById('newMes_' + activeSufix));			
			}
/*		else
			{*/
		var oMessBox = document.createElement("textarea");
		oMessBox.id = 'newMes_' + activeSufix;
		oMessBox.name = 'newMes';
		oMessBox.className = 'textarea_comment';
		oMessBox.cols = '90';
		oMessBox.rows = '5';
		oMessBox.onchange = function() {
			if (this.value != '') 
				$("#submit_" + activeSufix).show(); 
			else 
				$("#submit_" + activeSufix).hide();
			};
		document.getElementById("commentBox_" + activeSufix).appendChild(oMessBox);
//			}
		$('#newMes_' + activeSufix).wysiwyg(	boxOptions);
		$('#newMes_' + activeSufix).wysiwyg('clear');
		}
	else
		{
		document.getElementById("commentBox_" + activeSufix).removeChild(document.getElementById('newMes_' + activeSufix));
		activeSufix = '';
		}
	}
function toggleCommentBox_(obj)
	{
	var boxOptions  = {rmUnusedControls: true, 
						controls: {
							cut   : { visible : true },
							copy  : { visible : true },
							paste : { visible : true }, 			
							bold          : { visible : true },
							italic        : { visible : true },
							underline     : { visible : true },
							strikeThrough : { visible : true }, 
							insertOrderedList    : { visible : true },
							insertUnorderedList  : { visible : true }, 
							undo : { visible : true },
							redo : { visible : true }			
							},
						plugins: {
								i18n: { lang: "ru" }}};
	if(obj.id=='errorToggle')
		{
		if(errorBoxActive == false)
			{
			if(commentBoxActive == true)
				{
				$('#commentBox').wysiwyg('destroy');
				$('#commentBox').hide();
				commentBoxActive = false;				
				$('.submit').hide();
				}				
			var clear = ($('#errorBox').val()!='') ? false : true;
			$('#errorBox').wysiwyg(	boxOptions);
			if (clear == true)				
				$('#errorBox').wysiwyg('clear');
			errorBoxActive = true;
			}
		else if(errorBoxActive == true)
			{
			$('#errorBox').wysiwyg('destroy');
			$('#errorBox').hide();
			errorBoxActive = false;
			$('.submit').hide();
			}
		}
	else 
	if(obj.id=='commentToggle')
		{
		if(commentBoxActive == false)
			{
			if(errorBoxActive == true)
				{
				$('#errorBox').wysiwyg('destroy');
				$('#errorBox').hide();
				errorBoxActive = false;
				$('.submit').hide();
				}			
			var clear = ($('#commentBox').val()!='') ? false : true;
			$('#commentBox').wysiwyg(	boxOptions);
			if (clear == true)				
				$('#commentBox').wysiwyg('clear');
			commentBoxActive = true;
			}
		else if(commentBoxActive == true)
			{
			$('#commentBox').wysiwyg('destroy');
			$('#commentBox').hide();
			commentBoxActive = false;
			$('.submit').hide();
			}
		}
	}
function clearBox(id)	
	{
	$('#commentBox_' + id).wysiwyg('clear');
	$('#commentBox_' + id).wysiwyg('destroy');
	$('#commentBox_' + id).hide();
	commentBoxActive = false;
	$('#submit_' + id).hide();		
	}
function clearBox_(type)	
	{
	if(type == 'error')
		{
		$('#errorBox').wysiwyg('clear');
		$('#errorBox').wysiwyg('destroy');
		$('#errorBox').hide();
		errorBoxActive = false;
		}
	else if (type == 'comment')
		{
		$('#commentBox').wysiwyg('clear');
		$('#commentBox').wysiwyg('destroy');
		$('#commentBox').hide();
		commentBoxActive = false;
		}
	$('.submit').hide();		
	}
function sendMessage(obj)	
	{
	var newSufix = GetStrPrt(obj.id, '_', 1);
	var subject = 'c';	//comment	
	var body = $('#newMes_' + newSufix).val();
	if((newSufix != 'Top')&&(newSufix != 'Bottom'))
		$('#parId').val(newSufix);
	else 
		$('#parId').val('');
	UI.pleaseWait();
	if($('#senderName').val() != 0)
		var authName = $('#senderName').val();
	else
		var authName = 'Гость';
		
	$.post("/spddl/", {
						type:'message', 
						objType:$('#objType').val(), 
						subject:subject, 
						body:body, 
						objId: $('#objid').val(),
						authName: authName,
						auth: $('#sender').val(),
						parId: $('#parId').val()
					}, function(str) 
		{
		/*if(errorBoxActive == true)
			clearBox('error');
		else if (commentBoxActive == true)
			clearBox('comment');*/
		var strArr = str.split('~a~l~e~r~t~');
		if(strArr[0] != '')   //show message 
			{
			UI.pleaseWait();
			strMessArr = strArr[0].split('~t~y~p~e~');
			UI.showMessage(strMessArr[0], strMessArr[1]);							
			}
		else    //add comment
			{
			var id = showCommentLast(strArr[1]);			
			UI.pleaseWait();
			clearBox(newSufix);
/*			alert(showProperties($('#mes_'+ id + ' div')));
			$('#mes_'+ id + ' div') .animate(cssLayerStart, 1000  , function(){ $('#mes_'+ id + ' div').animate(cssLayerEnd, 500 )} );
/*			$('#mes_'+ id + ' div') .animate(cssLayerStart, 1000  , function(){ $('#mes_'+ id + ' div').animate(cssLayerEnd, 500 )} );*/

			}
		});
	}

/**************************************ranking functions**************************************/	
function starOver(obj)	
	{
	starOverFlag = true;
	
	var curStarIndx = GetStrPrt(obj.id, '_', 1);
	for(var i=1; i<= 5; i++)
		{
//		alert($('#star_' + i));
		if(i<=curStarIndx)
			$('#star_' + i).attr({src : starFill.src});
		else
			$('#star_' + i).attr({src : starEmpty.src});
//			$('#star_' + i).src = starEmpty.src;			
		}		
	}

function starOut()
	{
	starOverFlag = false;
//	var curStarIndx = starCurrent;
	var curStarIndx = starCurrentFilled;
	for(var i=1; i<= 5; i++)
		{
//		alert($('#star_' + i));
		if(i<=curStarIndx)
			$('#star_' + i).attr({src : starFill.src});
		else
			$('#star_' + i).attr({src : starEmpty.src});
//			$('#star_' + i).src = starEmpty.src;			
		}	
	}
function starClick(obj)	
	{
	var rate = GetStrPrt(obj.id, '_', 1);
	$('#оrganization_events_star_active').animate( { opacity: 0.2 }, 300 , function() { } );					
	UI.pleaseWait();
	$.post("/spddl/", {
						type:'rate', 
						curRate:$('#curRate').val(), 
						objType:$('#objType').val(), 
						rate:rate, 
						orgId: $('#FIRMID').val(),
						auth: $('#sender').val(),
					}, function(str) 
		{
		var strArr = str.split('~a~l~e~r~t~');
		$('#curRate').val(rate);
		$('#оrganization_events_rate_user').html(rate);
		var strPar = strArr[1].split('##');
		rankCurrent = 		strPar[0];
		starCurrentFilled = strPar[1];
		$('#оrganization_events_rate_total').html(strPar[0]);
		$('#оrganization_events_rate_num').html(strPar[2]);
		starOut();		
		UI.pleaseWait();
		if(strArr[0] != '')   //show message 
			{
			strMessArr = strArr[0].split('~t~y~p~e~');
			UI.showMessage(strMessArr[0], strMessArr[1]);							
			}
			
		$('#оrganization_events_star_active').animate( { opacity: 1.0 }, 1000 );	
		});
	}
/*	
function starClick(starObj)
	{
	var curUser = document.getElementById('senderRNK').value;		
	var curFirm = document.getElementById('firmRNK').value;		
	var newRate = eval(GetStrPrt(starObj.id, '_', 1)) + 1;
	var action = '/company/set/rank/';
	var result = document.getElementById('myRank');
	var resultTtl = document.getElementById('ttlRank');
	var voiceCnt = document.getElementById('voiceCntNum');
	var starRow = document.getElementById('starRow');
	$(starRow).animate( { opacity: 0.2 }, 300 , function() { } );				
	$.post(action, {curUser:curUser, curFirm:curFirm, newRate:newRate}, function(str) 
			{
			if(str==0)
				{
				alert('Для оценки компании необходимо зарегистрироваться на сайте!')
				$(starRow).animate( { opacity: 1.0 }, 1000 );
				}
			else
				{
				var userRank = GetStrPrt(str, '_', 0);
				var firmRank = GetStrPrt(str, '_', 1);
				var firmRankNum = GetStrPrt(str, '_', 2);
				var starFull = GetStrPrt(str, '_', 3);
				var starHalf = GetStrPrt(str, '_', 4);
				var starEmpty = GetStrPrt(str, '_', 5);
				for(var i=0; i< 10; i++)
					{
					if(i<starFull)
						stars[i] = 1;
					else if(i<(eval(starFull)+eval(starHalf)))
						stars[i] = 2;
					else 
						stars[i] = 3;
					}
				starOut(); 
				result.innerHTML = userRank;					
				resultTtl.innerHTML = firmRank;					
				voiceCnt.innerHTML = firmRankNum;
				$(starRow).animate( { opacity: 1.0 }, 1000 );	
				}
			}
		);
	}
*/
