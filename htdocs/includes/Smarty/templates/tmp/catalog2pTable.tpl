<div id = 'mainContent' ><h2><a href='/catalog'>Рубрики организаций</a> \ <span id='curLayerTtl' class = 'scriptLink'  title ='Выбрать другую рубрику'>{$title}</span></h2><TABLE cellSpacing=0 cellPadding=1 border=0 width='100%' style='margin-left:50px'><tbody>{section name=obj loop=$obj}	{section name=prop loop=$obj[obj].objProp}<tr>{*<td title='{$obj[obj].firm_name}'>{$smarty.section.obj.iteration}</td>*}<td>{$obj[obj].firm_name}</td><td>{$obj[obj].objProp[prop].location}</td><td >{$obj[obj].objProp[prop].phone}</td></tr>	{/section}{/section}</tbody></table></div>