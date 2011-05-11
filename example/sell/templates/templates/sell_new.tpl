<div id="sell-new">
	<p>Prodam</p>
	<form method="post" action="">
	<input type="hidden" name="app" value="sell" />
	<input type="hidden" name="method" value="post_new_" />
	<table>
		<tr>
			<td><label for="frm-title">Titulek</label></td><td><input type="text" id="frm-title" name="title" /></td>
		</tr>
		<tr>
			<td><label for="frm-description">Detailni popis</label></td><td><textarea id="frm-description" name="description" /></textarea></td>
		</tr>
		<tr>
			<td><label for="frm-image">Obrazek</label></td><td><input type="file" accept="image/*" id="frm-image" name="image" /></td>
		</tr>
		<tr>
			<td><label for="frm-price">Cena</label></td><td><input type="text" id="frm-price" name="price" /></td>
		</tr>
		<tr>
			<td><input type="reset" value="Zrusit" /></td><td><input type="submit" value="Ulozit" /></td>
		</tr>
	</table>
	</form>
</div>
