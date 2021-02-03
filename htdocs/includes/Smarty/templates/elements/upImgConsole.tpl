{literal}
	    <html>
	    <head>
	    <base target="picker">
	            <title>Загрузка и вставка изображения</title>
	    <STYLE TYPE="text/css">
	     BODY   {margin-left:5; font-family:Verdana; font-size:10pt; background:menu}
	     BUTTON {width:5em}
	     TABLE  {font-family:Verdana; font-size:10pt; background:menu}
	     P      {text-align:center}
	    </STYLE>

	    </head>

	    <body  onUnload="insertImage()">

	    <script language="javascript">
	    function attr(name, value) {
	        if (!value || value == "" || value == 0) return "";
	        return ' ' + name + '= "' + value + '" ';
	    }
	    function insertImage() 
			{
//			var op = window.opener;
//			alert(opener.document.forms['REPLIER'].elements['Post']);
//			alert(window.opener.form['REPLIER']);
/*			var txtarea = window.opener.REPLIER.Post;
			txtarea.value += 'img';*/
//			imageSrc = 'ddddd';		
			var messageBox =  opener.document.forms['REPLIER'].elements['Post'];
			var imgURL = document.forms['imageBB'].elements['imgUrl'];
			var imgFile = document.forms['imageBB'].elements['imgFile'];
			var srcUpload = document.forms['imageBB'].elements['srcUpload'];
			var imgText = document.forms['imageBB'].elements['imgText'];
			var imgVerSpace = document.forms['imageBB'].elements['imgVerSpace'];
			var imgHorSpace = document.forms['imageBB'].elements['imgHorSpace'];
			var imgAlign = document.forms['imageBB'].elements['imgAlign'];
			var imgBorder = document.forms['imageBB'].elements['imgBorder'];
			var insertBB = '';
			var imgSrc = '';
			if((imgURL.value != '')&&(imgURL.value != 'undefined')&&(imgURL.value != null))
				{
				imgSrc = imgURL.value;
				}
			else if ((imgFile.value != '')&&(imgFile.value != 'undefined')&&(imgFile.value != null))
				{
				var fileNameArr = imgFile.value.split('\\');
				imgSrc = srcUpload.value + fileNameArr[fileNameArr.length-1];		
				}
				insertBB += '[upimg]' + attr('src', imgSrc)
                                        + ((imgBorder.value)?attr('border', imgBorder.value):attr('border', 0))
	                                    + attr('align', imgAlign[imgAlign.selectedIndex].value)
	                                    + attr('alt', imgText.value)
	                                    + attr('vspace', imgVerSpace.value)
	                                    + attr('hspace', imgHorSpace.value)
	                                    + '[/upimg]';
				
			messageBox.value += insertBB;
/*			
	        if (document.forms[0].userfile.value)
	            {
	            window.returnValue = '[upimg]'
                						//+ '[src]'
	                                    + attr('src', document.forms[0].userfile.value)
                                        + ((ImgBorder.value)?attr('border', ImgBorder.value):attr('border',0))
                                        //+ '[/src]'
	                                    + attr('align', ImgAlign[ImgAlign.selectedIndex].value)
	                                    + ((AltText.value)?attr('alt', AltText.value):"")
	                                    + ((VerSpace.value)?attr('vspace', VerSpace.value):"")
	                                    + ((HorSpace.value)?attr('hspace', HorSpace.value):"")
	                                    + '[/upimg]';
	            }
				
	        else
	            {
	            window.returnValue = null;
	            }*/
//	       		window.close();
			}
	    function cancel()
	        {
	        window.returnValue = null;
	        window.close();
	        }
	    function IsDigit(evt)
	    {
		evt = (evt) ? evt : ((window.event) ? event : null);
	      return ((evt.keyCode >= 48) && (evt.keyCode <= 57));
	    }
	    function preview()
	        {
/*	            if (document.forms[0].userfile.value)
	                {
	                    document.forms[0].previewPict.src = document.forms[0].userfile.value;
	                }*/
	        }
{/literal}
	    </script>
	    <form name='imageBB' action = ""   method="post" enctype="multipart/form-data">
	    <TABLE CELLSPACING=1 border="0" {*width='430' height='430'*}>
		<tr>
		<td align='center'>
			<strong>ВЫБЕРИТЕ</strong>		
		</td>
		</tr>
	    <tr>
			<td >
		    <fieldset style="padding : 1px;"><legend>Файл в интернете</legend>
		
	                    URL файла<br>
	            <input type="text" name="imgUrl" onChange="preview()" style="width : 300px; margin-left:5px; "> 	         
			</fieldset>
			</td>	
		</tr>
		<tr>
		<td align='center'>
			<strong>ИЛИ</strong>		
		</td>
		</tr>
		<tr>
			<td>
		    <fieldset style="padding : 1px;"><legend> Локальный файл</legend>
		
	            <input type="hidden" name="MAX_FILE_SIZE" value="500000">
	                   Графический файл (max. 500 Kb)<br>
	            <input type="file" name="imgFile" {*onChange="preview()" *} style="width : 300px; margin-left:5px; "> 	         
			</fieldset>
			</td>	
		</tr>
	
		{*
		<tr>
			<td>
	    <br><b>Предпросмотр</b>
	    <br>
	    <span style="background-color:gray;
						overflow:auto;
						width:300px;
						height:150px;
						border-width:1px;
						border-style:solid;
						border-color:threeddarkshadow white white threeddarkshadow;">
	    <img name="previewPict" src="images/imgpreview.gif" border=1 alt="Preview" align="absmiddle" valign="middle">
	    </span>
	    <br>
			</td>
		
		</tr>
		*}
	    <!--- Einschub Dimensionen und Extras --->

		<tr>
		<td align='center'>
			<strong>ДОПОЛНИТЕЛЬНО</strong>		
		</td>
		</tr>
	    <TR>
	    <TD VALIGN="top" align="left" colspan="2" nowrap>		
		<fieldset style="padding : 0px;"><legend> Аттрибуты </legend>
			<table border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td>
	    Альтернативный текст:<br>
	    <INPUT TYPE=TEXT SIZE=40 NAME='imgText' style="width : 300px; margin-left:5px; ">
	    </TD>
		</TR>
				<TR>
			    <TD VALIGN="top" align="left" colspan="2">		
				    <table border=0 cellpadding=2 cellspacing=2>
				    <tr>
				    <td nowrap>
				    <fieldset style="padding : 1px;"><legend> Расположение </legend>
					    <table border=0 cellpadding=2 cellspacing=2>
					    <tr>
					    <td>Размещение:</td>
					    <td><select NAME='imgAlign' style="width : 80px;">
					    <option value=""></option>
					    <option value="left">слева</option>
					    <option value="right">справа</option>
					    <option value="top">сверху</option>
					    <option value="middle">в центре</option>
					    <option value="bottom">снизу</option>
					    </select>
					    </td>
					    </tr>
					    <tr>
					    <td nowrap>Рамка:</td>
					    <td>
							<INPUT TYPE=TEXT SIZE=1 value="0" NAME='imgBorder'  ONKEYPRESS="event.returnValue=IsDigit(event);" style="width : 80px;"></td>
					    </tr>
					    </table>
				    </fieldset>
				    </td>
				    <td nowrap>
				    <fieldset style="padding : 1px;"><legend> Отступ </legend>
					    <table border=0 cellpadding=2 cellspacing=1>
					    <tr>
					    <td>горизонтально:</td>
					    <td><INPUT TYPE=TEXT SIZE=2 value="0" NAME='imgHorSpace'  ONKEYPRESS="event.returnValue=IsDigit(event);" style="width : 80px;"> </td>
					    </tr>
					    <tr>
					    <td>вертикально:</td>
					    <td><INPUT TYPE=TEXT SIZE=2 value="0" NAME='imgVerSpace'  ONKEYPRESS="event.returnValue=IsDigit(event);" style="width : 80px;"></td>
					    </tr>
					    </table>
				    </fieldset>
				    </td>
				    </tr>
				    </table>
				</TD>				
				</TR>
			</table>	
			</TD>				
	     </TR>
		 <tr>
			<td align='center'>
				<input type="submit" value="отправить"  onclick="self.close();" style="width : 300px; margin:5px; ">		 
			</td>
		 </tr>
	    </TABLE>
	    <INPUT TYPE='HIDDEN'  value="{$options.uploadDir}" NAME='srcUpload'>
	    <INPUT TYPE=HIDDEN SIZE=5 value="0" NAME=ImgHeight>
	    <INPUT TYPE=HIDDEN SIZE=5 value="0" NAME=ImgWidth>		
		</form>	    
		</body>
	    </html>