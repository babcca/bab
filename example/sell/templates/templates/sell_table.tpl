<div id="sell-tab">
<table>
	<tr>
		<th>id</th><th>image</th><th>description</th><th>seller_id</th><th>datum</th><th>price</th>
	</tr>
	{foreach $rows as $row}
	<tr>
		<td>{$row.id}</td>
		<td><img src="{$row.small_image}" alt="" /></td>
		<td><h1>{$row.title}</h1><p>{$row.description}</p></td>
		<td>{$row.user_id}</td>
		<td>{$row.date}</td>
		<td>{$row.price}</td>
	</tr>
	{/foreach}
</table>
<div id="sell-tab-offset">
	<a href=""></a>
</div>
</div>
