function AjaxLoader() {
	AjaxLoader.prototype.getObject = function() {
		try {
			return new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			return new XMLHttpRequest(); 
		}
	}

	AjaxLoader.prototype.getPost = function(config) {
		var xhr = this.getObject();
		xhr.onreadystatechange = function() {
			var loader = document.getElementById("loader");
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					loader.innerHTML = "";
					loader.style.display = "none";
					config.succes(xhr.responseText);
				} else {
					console.log("Error: " + xhr.status);
				}
			} else {
				loader.style.display = "block";
				loader.innerHTML = '<center><img src="/img/ajax-loader.gif" /></center>';
			}
		}
		var url = "/ajax.php?app="+config.app+"&method="+config.method;
		if (config.argm) url += "&"+config.argm;
		xhr.open('GET', url, true);
		xhr.send(null);
	}
}
function TabBox(tabs_name) {
	this.tabs = tabs_name;
	this.last_active = tabs_name[0].id;
	/** 
	 *	Schova aktivni tab, zavola funkci onChange a zobrazi pozadovany tab
	 *	\param tab_name Nazev tabu, ketry ma byt zaktivovan
	 *	\param onChange funkce ktera se vola pred vykreslenim tabu
	 */
	TabBox.prototype.setActive = function(tab_name) {
		var tab_id = "content_"+this.last_active;
		var tab = document.getElementById(tab_id);
		if (tab != null) {
			tab.innerHTML = '';
			tab.style.display = "none";
		} else {
			console.log("Failded deactive tab "+tab_id);
		}
		var onChange = undefined;
		// linearni vyhledani callbacku :(
		for (var i = 0; i < this.tabs.length; i++) {
			if (this.tabs[i].id == tab_name) { onChange = this.tabs[i].callback; }
		}
		var tab_id = "content_"+tab_name;
		var tab = document.getElementById(tab_id);
		onChange(tab);
		if (tab != null) {
			tab.style.display = "block";
			this.last_active = tab_name;
		} else {
			console.log("Failded active tab "+tab_id);
		}
	}
	
	/**
	 * 	Nastavy jednotlivym tabum udalost onClick
	 * 	\param caller Instance volajici tridy
	 */
	TabBox.prototype.setCallback = function(caller) {
		this.setActive(this.last_active, function (dest) {});
		for (var i = 0; i < this.tabs.length; i++) {
			var link_id = this.tabs[i].id;
			var link = document.getElementById("tab_"+link_id);
			var callback = this.tabs[i].callback;
			link.onclick = function () {
				caller.setActive(this.id.substring(4));
			};
		}
	}
	TabBox.prototype.toString = function() {
		alert(this.tabs);
	}
}

var tabs = new TabBox([
	{id:"prodam", callback: function(dest) {var a = new AjaxLoader();a.getPost({app:"sell", method:"post_list", succes: function (data) {dest.innerHTML = data;}})}},
	{id:"koupim", callback: function(dest) {var a = new AjaxLoader();a.getPost({app:"buy", method:"post_list", succes: function (data) {dest.innerHTML = data;}})}},
	{id:"me_prispevky", callback: function(dest) {var a = new AjaxLoader();a.getPost({app:"user", method:"post_list", succes: function (data) {dest.innerHTML = data;}})}},
	{id:"podminky", callback: function(dest) {}}
]);
