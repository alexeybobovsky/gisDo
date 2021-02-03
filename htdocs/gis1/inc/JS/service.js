Array.prototype.max = function() {return Math.max.apply(null, this);};
Array.prototype.min = function() {return Math.min.apply(null, this);};
function showProperties(obj, objName) 
{
  var result = "The properties for the " + objName + " object:" + "\n";
  
  for (var i in obj) {result += i + " = " + obj[i] + "\n";}
  
  return result;
}
function in_array(needle, haystack, strict) {  
    var found = false, key, strict = !!strict;
 
    for (key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            found = true;
            break;
        }
    } 
    return found;
}