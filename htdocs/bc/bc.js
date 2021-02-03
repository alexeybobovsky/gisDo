 function verifyApostile(txHash, textContent){
	 
//	console.log(arguments);
	
	var endpoint = nem.model.objects.create("endpoint")(nem.model.nodes.defaultTestnet, nem.model.nodes.defaultPort);
//	var host = 'http://23.228.67.85';
//	var port = '7890';
	
//	var endpoint = nem.model.objects.create("endpoint")(host, port);
	var fileContent = nem.crypto.js.enc.Utf8.parse(textContent);
	nem.com.requests.transaction.byHash(endpoint, txHash).then(function(res) {
		$('#verifyResult').removeClass('inactive');
		// Verify
		if (nem.model.apostille.verify(fileContent, res.transaction)) {
			$('#verifyResult').html('Содержимое файла успешно прошло проверку на неизменность в системе Blockchain <strong>NEM</strong>' + 
			'<p><a href="http://bob.nem.ninja:8765/#/transfer/'+txHash+'" target="_blank">показать подробности транзакции</a></p>');
			$('#verifyResult').addClass('verifySuccess');
//			alert("Apostille is valid");
		} else {
			$('#verifyResult').html('Содержимое файла не прошло проверку на неизменность в системе Blockchain <strong>NEM</strong>');
			$('#verifyResult').addClass('verifyError');
//			alert("Apostille is invalid");
		}
	}, function(err) {
		$('#verifyResult').removeClass('inactive');
		$('#verifyResult').addClass('verifyError');
		$('#verifyResult').html('Не удалось выполнить проверку содержимое файла на неизменность в системе Blockchain <strong>NEM</strong> - сервер возвращает ошибку:' + err);
/*		console.log("Apostille is invalid");
		console.log(err);*/
	});	
 }
 function sendApostile(result, txtContent){
//	console.log(arguments);
	var	endpoint = nem.model.objects.create("endpoint")(nem.model.nodes.defaultTestnet, nem.model.nodes.defaultPort);
	var pKey = '9311dac63636f90ff6f1b9b0902ebd61c41c53602d080a6836e9688b146d5f1b';
	var common = nem.model.objects.create("common")("", pKey);
	var fileContent = nem.crypto.js.enc.Utf8.parse(txtContent);

	var apostille = nem.model.apostille.create(common, 
						fileName, 
						fileContent, 
						$("#string").val(), 
						nem.model.apostille.hashing["SHA256"], 
						false, false,
//						true, 
						false, 
						nem.model.network.data.testnet.id);
	nem.model.transactions.send(common, apostille.transaction, endpoint).then(function(res){
	if (res.code >= 2) {
		console.error(res.message);
	} else {
//		var dateOfStamp =  new Date(nemEpoch + (apostille.transaction.timeStamp * 1000));
//		var newFileName = apostille.data.file.name.replace(/\.[^/.]+$/, "") + " -- Apostille TX " + res.transactionHash.data + " -- Date DD/MM/YYYY" + "." + apostille.data.file.name.split('.').pop();
		$.post("/bc/index.php/", {	type:'apostileCreateTest', 
									time:apostille.transaction.timeStamp, 
									hash:res.transactionHash.data,
									fileText:txtContent,
									fileName:apostille.data.file.name,
									fileNameSrc:$('#verifiedFile').val()
									}, function(str) {
				if(str!='0')
					$('#state_res').html('<a href="'+ str+ '" target="_blank" >Сохранить зарегистрированный файл</a>');
				else
					alert('Ошибка загрузки файла');
				}
			);		
/*			
		$.post("/bc/index.php/", {	type:'apostileCreate', 
									time:apostille.transaction.timeStamp, 
									hash:res.transactionHash.data,
									fileName:apostille.data.file.name,
									fileNameSrc:$('#verifiedFile').val()
									}, function(str) {
				if(str!='0')
					$('#state_res').html('<a href="'+ str+ '" target="_blank" >Сохранить зарегистрированный файл</a>');
				else
					alert('Ошибка загрузки файла');
				}
			);*/
			
//		var dateStr = dateOfStamp.getFullYear() + '-' + dateOfStamp.getFullYear() + '-' + dateOfStamp.getFullYear();
/*		console.log("\nTransaction: " + res.message);
		console.log("\nCreate a file with the fileContent text and name it:\n" + apostille.data.file.name.replace(/\.[^/.]+$/, "") + " -- Apostille TX " + res.transactionHash.data + " -- Date DD/MM/YYYY" + "." + apostille.data.file.name.split('.').pop());
		console.log("When transaction is confirmed the file should audit successfully in Nano");
		console.log("\nYou can also take the following hash: " + res.transactionHash.data + " and put it into the audit.js example");
*/		
	}
}, function(err) {
	console.error(err);
});
}
function GetStrPrt(str, del, indx)
		{
		strArr1 = str.split(del);
		var ret = strArr1[indx];
		return ret;
		}	
