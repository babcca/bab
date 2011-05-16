<div id="sell-table">
{include file="sell_new.tpl"}
<table border="1">
	<tr>
		<th>image</th><th>description</th><th>seller_id</th><th>datum</th><th>price</th>
	</tr>
	{foreach $rows as $row}
	<tr>
		<td class="s85"><img class="image-preview" src="{$row.image}" alt="{$row.title}" /></td>
		<td class="tbl-top"><h1>{$row.title}</h1><p>{$row.description}</p></td>
		<td class="tbl-center s120"><a href="#{$row.user_id}">Petr Babicka</a></td>
		<td class="tbl-center s100">Pred {before_time time=$row.time}</td>
		<td class="tbl-center s90">{$row.price}</td>
	</tr>
	{/foreach}
</table>
<div id="sell-tab-offset">
	<a href="{make_url app=sell method=post_list argm=['offset'=>12]}">1</a>
</div>
</div>
