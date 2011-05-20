function hide(obj, me) {
	me.value='Zobraz formular';
	obj.style.display = 'none';
}	

function show(obj, me) {
	me.value='Skryj formular';
	obj.style.display = 'block';
}
function toggle(what, me) {
	var obj = document.getElementById(what);
	if (obj.style.display == 'none') {
		show(obj, me);
	}
	else {
		hide(obj, me);
	}
}

function Dialog(id) {
	var dialog_id = id;
	var dialog_data = {content: '', pos:{ x:0, y:0}};
	var dialog_obj = undefined;
	//this.init();

	Dialog.prototype.init = function() {
		this.dialog_obj = document.createElement('div');
		this.dialog_obj.id = this.dialog_id;
		this.dialog_obj.style.position = 'absolute';
		this.dialog_obj.style.left = dialog_data.pos.x+'px';
		this.dialog_obj.style.top = dialog_data.pos.y+'px';
		this.dialog_obj.style.backgroud-color = '#F0F';
		this.dialog_obj.style.border = '1px solid #0F0';
		var title = this.dialog_obj.createElement('div');
		title.style.height = "25px";
		title.style.width = "100%";
		title.style.background-color = "#0F0";
	}
	Dialog.prototype.show = function () {
		this.dialog_obj.innerHTML = dialog_data.content;
		document.body.appendChild(this.dialog_obj);
	}
	Dialog.prototype.setContent = function(content) {
		dialog_data.content = content;
	}
}


function ImageUploader() {
	var dialog = new Dialog("upload_dialog");
	dialog.init();
	dialog.setContent("<b>ahojky</b>");
	dialog.show();
}
