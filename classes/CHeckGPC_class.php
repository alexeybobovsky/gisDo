<?
class CheckInput
	{
	var $last_query;
	var $last_id;
	function ProccesPost_HTML($post)
		{
		global $TPL_Names;
		$keys = array_keys($post);
//		print_r($keys);
		for ($i=0; $i<count($keys); $i++)
			{
			if ((array_key_exists ($TPL_Names['HTML_SPEC_CHARS'].$keys[$i], $post))&&(!is_array($post[$keys[$i]])))
				{
				$post[$keys[$i]] = htmlspecialchars($post[$keys[$i]]); 
				}			
			elseif((array_key_exists ($TPL_Names['HTML_SPEC_CHARS'].$keys[$i], $post))&&(is_array($post[$keys[$i]])))
				{
				for ($n=0; $n<count($post[$keys[$i]]); $n++)
					{
/*					echo '!!!!<br>';
					print_r($post[$keys[$i]]);
					echo '!!!!<br>';*/
					$post[$keys[$i]][$n] = htmlspecialchars($post[$keys[$i]][$n]); 
					}
				}
			}
		return $post;
		}
	function ProccesPost_AntiHacker($post)
		{
		global $TPL_Names;
		$keys = array_keys($post);
//		print_r($keys);
		for ($i=0; $i<count($keys); $i++)
			{
			if ((array_key_exists ($TPL_Names['HTML_SPEC_CHARS'].$keys[$i], $post))&&(!is_array($post[$keys[$i]])))
				{
				$post[$keys[$i]] = htmlspecialchars($post[$keys[$i]]); 
				}			
			elseif((array_key_exists ($TPL_Names['HTML_SPEC_CHARS'].$keys[$i], $post))&&(is_array($post[$keys[$i]])))
				{
				for ($n=0; $n<count($post[$keys[$i]]); $n++)
					{
/*					echo '!!!!<br>';
					print_r($post[$keys[$i]]);
					echo '!!!!<br>';*/
					$post[$keys[$i]][$n] = htmlspecialchars($post[$keys[$i]][$n]); 
					}
				}
			}
		return $post;
		}
	}
?>