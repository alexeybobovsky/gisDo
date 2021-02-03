Array.prototype.max = function() {return Math.max.apply(null, this);};
Array.prototype.min = function() {return Math.min.apply(null, this);};
function Routine()	
	{
	this.getWikiContent = function(str)
		{
		$.post("/gis2/getFromFile.php/", {type:'getWiki', str:str}, function(str)
			{
			return str;
			});				
		
		}
	this.showProperties = function(obj, objName) 
		{
		var result = "The properties for the " + objName + " object:" + "\n";		  
		for (var i in obj) {result += i + " = " + obj[i] + "\n";}		  
		return result;
		}
	this.in_array = function(needle, haystack, strict) 
		{  
		var found = false, key, strict = !!strict;	 
		for (key in haystack) {
			if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
				found = true;
				break;
			}
		} 
		return found;
		}
	this.GetStrPrtLast = function(str, del, offset) 
		{
		if(offset === undefined)
			var offset = 0;
		strArr1 = str.split(del);
		var ret = strArr1[(strArr1.length-1 - offset)];
		return ret;		
		}			
	this.GetStrPrt = function(str, del, indx) 
		{
		strArr1 = str.split(del);
		var ret = strArr1[indx];
		return ret;		
		}		
	this.rand = function( min, max ) 
		{	
		if( max ) 
			{
			return Math.floor(Math.random() * (max - min + 1)) + min;
			} else {
			return Math.floor(Math.random() * (min + 1));
			}
		}
	
	this.getCorrectDeclensionRu = function(num, word_0, word_1, word_2)
		{
		if(num>10000)
			num -= 10000;
		if (num>1000)
			num -= 1000;		
		if (num>100)
			num -= 100;		
		if(num>10)
			{
			var tenSec, ret;
			tenSec = (Math.round(num/10 + 0.5) == Math.round(num/10)) ? Math.round(num/10)-1 : Math.round(num/10);
			if(((num>=10)&&(num<20))||(((num - (tenSec*10)) >=5 )||(num - (tenSec*10) ==0 )))
				ret = word_2;
			else if((num - (tenSec*10))>1)
				ret = word_1;
			else
				ret = word_0;
			}
		else
			{
			if((num >=5 )||(num ==0 ))
				ret = word_2;
			else if(num>1)
				ret = word_1;
			else
				ret = word_0;
			}
		return ret;
		}	
	this.str_replace = function( search, replace, subject ) 
		{
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Gabriel Paderni

		if(!(replace instanceof Array)){
			replace=new Array(replace);
			if(search instanceof Array){//If search	is an array and replace	is a string, then this replacement string is used for every value of search
				while(search.length>replace.length){
					replace[replace.length]=replace[0];
					}
				}
			}
		if(!(search instanceof Array))search=new Array(search);
		while(search.length>replace.length){//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
			replace[replace.length]='';
			}
		if(subject instanceof Array){//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
			for(k in subject){
				subject[k]=str_replace(search,replace,subject[k]);
				}
				return subject;
			}	
		for(var k=0; k<search.length; k++){
			var i = subject.indexOf(search[k]);
			while(i>-1){
				subject = subject.replace(search[k], replace[k]);
				i = subject.indexOf(search[k],i);
				}
			}
		return subject;
		}	
	}
function str_replace ( search, replace, subject ) 
	{
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: Gabriel Paderni

	if(!(replace instanceof Array)){
		replace=new Array(replace);
		if(search instanceof Array){//If search	is an array and replace	is a string, then this replacement string is used for every value of search
			while(search.length>replace.length){
				replace[replace.length]=replace[0];
				}
			}
		}
	if(!(search instanceof Array))search=new Array(search);
	while(search.length>replace.length){//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
		replace[replace.length]='';
		}
	if(subject instanceof Array){//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
		for(k in subject){
			subject[k]=str_replace(search,replace,subject[k]);
			}
			return subject;
		}	
	for(var k=0; k<search.length; k++){
		var i = subject.indexOf(search[k]);
		while(i>-1){
			subject = subject.replace(search[k], replace[k]);
			i = subject.indexOf(search[k],i);
			}
		}
	return subject;
	}
