// Url Param
window.query = {
    list: function () {
        var url = location.search;
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                theRequest[strs[i].split("=")[0]] = decodeURI(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    },
    key: function (key) {
        var result = location.search.match(new RegExp("[\?\&]" + key + "=([^\&]+)", "i"));
        if (result == null || result.length < 1) {
            return "";
        }
        return result[1];
    },
    op: function () {
        var search = location.search;
        var theRequest = new Object();
        if (search.indexOf("?") != -1) {
            var paramStr = search.substr(1);
            params = paramStr.split("&");
            for (var i = 0; i < params.length; i++) {
                var ops = ["<=", ">=", "!=", "!$", "=", "<", ">", "^", "&", "|", "$"];
                for (var j = 0; j < ops.length; j++) {
                    op = encodeURI(ops[j]);
                    key_val = params[i].split(op);
                    if (key_val.length >= 2) {
                        theRequest[key_val[0]] = {
                            val: decodeURI(key_val[1]),
                            op: ops[j]
                        };
                        break;
                    }
                }
            }
        }
        return theRequest;
    }
}

// Dialog
Dialogor = {
	Config : {
		resize  : false,
		move 	: true,
		width	: 300,
		height	: 200,
		type	: "iframe",
		content	: "#",
		title	: "Dialogor",
		Win		: window,
		Clone	: function()
		{
			var _Config = {};
			_Config.resize	= this.resize;
			_Config.move	= this.move;
			_Config.width	= this.width;
			_Config.height	= this.height;
			_Config.type	= this.type;
			_Config.title	= this.title;
			_Config.content	= this.content;
			_Config.Win		= this.Win;
			_Config.Clone	= this.Clone;
			return _Config;
		}
	},
	
	OnLoad : function(selector, type)
	{
		if(undefined == selector) throw "Selector is undefined.";
		if(undefined == type) type = this.Conifg.type;
		var Elems = document.querySelectorAll(selector);
		for(i = 0; Elems && i < Elems.length; i++)
		{
			Elems[i].onclick = function() {
				var contents = ("a" == this.nodeName.toLowerCase()) ? this.href : this.dataset.content;
				if("id" == type) contents = contents.substring(contents.indexOf("#") + 1, contents.length);
				else if("text" == type) contents = this.dataset.msg;
				return Dialogor.Open({
					title : this.title, 
					type : type, 
					content : contents, 
					height : this.dataset.height, 
					width : this.dataset.width
				}) 
			}
		}
	},
	
	Default : function(config)
	{
		var ConfigTemp = this.Config;
		if(undefined == config)  return ConfigTemp;
		if(undefined != config.resize) 	ConfigTemp.resize	= config.resize;
		if(undefined != config.move) 	ConfigTemp.move		= config.move;
		if(undefined != config.width) 	ConfigTemp.width	= config.width;
		if(undefined != config.height) 	ConfigTemp.height	= config.height;
		if(undefined != config.type) 	ConfigTemp.type		= config.type;
		if(undefined != config.title) 	ConfigTemp.title	= config.title;
		if(undefined != config.content) ConfigTemp.content	= config.content;
		this.Config = ConfigTemp;
		return ConfigTemp;
	},
	
	GetConfig : function(config)
	{
		var ConfigTemp = this.Config.Clone();
		if(undefined == config)  return ConfigTemp;
		if(undefined != config.resize) 	ConfigTemp.resize	= config.resize;
		if(undefined != config.move) 	ConfigTemp.move		= config.move;
		if(undefined != config.width) 	ConfigTemp.width	= config.width;
		if(undefined != config.height) 	ConfigTemp.height	= config.height;
		if(undefined != config.type) 	ConfigTemp.type		= config.type;
		if(undefined != config.title) 	ConfigTemp.title	= config.title;
		if(undefined != config.content) ConfigTemp.content	= config.content;
		if(undefined != config.Win) 	ConfigTemp.Win		= config.Win;
		return ConfigTemp;
	},
	
	Open : function (config)
	{
		var OpenConfig = this.GetConfig(config);
		var myDocument = OpenConfig.Win.document;
		var view = this.getView(myDocument);
		if(OpenConfig.height > view.height)
			OpenConfig.height = view.height - 100;
		if(OpenConfig.width > view.width)
			OpenConfig.width = view.width - 100;
		
		var dlg_bg = myDocument.createElement("div");
		dlg_bg.id = "dlg_bg";
		var dlg_view = myDocument.createElement("div");
		dlg_view.id = "dlg_view";
		
		var dlg_main = myDocument.createElement("div");
		dlg_main.id = "dlg_main";
		dlg_main.style.width = OpenConfig.width + "px";
		dlg_main.style.height = OpenConfig.height + "px";
		dlg_main.style.left = (view.width - OpenConfig.width) / 2 + "px";
		dlg_main.style.top = (view.height - OpenConfig.height)/ 2 + "px";
		var dlg_title = myDocument.createElement("div");
		dlg_title.id = "dlg_title";
		var dlg_text = myDocument.createElement("h4");
		dlg_text.id = "dlg_title";
		var dlg_close = myDocument.createElement("span");
		dlg_close.id = "dlg_close";
		var dlg_box = myDocument.createElement("div");
		dlg_box.id = "dlg_content";
		
		var dlg_resize = myDocument.createElement("div");
		dlg_resize.id = "dlg_resize";

		dlg_close.onclick = function() { return OpenConfig.Win.Dialogor.Close(); };
		
		var dlg_content;
		var type = OpenConfig.type;
		content = OpenConfig.content;
		switch(type)
		{
		case "iframe":
			dlg_content = myDocument.createElement("iframe");
			dlg_content.src = content;
			dlg_content.width = "100%";
			dlg_content.height = (OpenConfig.height - 30) + "px";
			dlg_content.scrolling = "auto";
			dlg_content.frameborder = "0";
			dlg_content.style.border = "0";
			dlg_content.marginheight = "0";
			dlg_content.marginwidth = "0";
			break;
		case "text":
			dlg_content = myDocument.createTextNode(content);
			break;
		case "id":
			dlg_content = myDocument.getElementById(content).cloneNode(true);
			dlg_content.id = "dlg_box";
			break;
		}
		
		
		var move = false;
		OpenConfig.Win.onmouseout = OpenConfig.Win.onmouseup = myDocument.onmouseout = myDocument.onmouseup = function(){move = false;}
		if(OpenConfig.move)
		{
			dlg_title.onmousedown = function(ev)
			{
				move = true;
				var mc = Dialogor.mouseCoords(ev);
				var mx = mc.x;
				var my = mc.y;
				dlg_title.onmouseout =  dlg_title.onmouseup = function(ev){ move = false; }
				dlg_title.onmousemove = function(ev){
					ev = ev || window.event; 
					var mc = Dialogor.mouseCoords(ev);
					if(move){
						var x = mc.x - mx;	
						var y = mc.y - my;	
						dlg_main.style.left = parseInt(dlg_main.style.left) + x + "px";
						dlg_main.style.top  = parseInt(dlg_main.style.top)  + y + "px";
					}
					mx = mc.x;
					my = mc.y;
					return false;
				}
			}
		}
		else
		{
			dlg_title.style.cursor = "default";
		}
		
		if(OpenConfig.resize)
		{
			dlg_resize.onmousedown = function(ev)
			{
				move = true;
				var mc = Dialogor.mouseCoords(ev);
				var mx = mc.x;
				var my = mc.y;
				dlg_resize.onmouseout =  dlg_resize.onmouseup = function(ev){ move = false; }
				dlg_resize.onmousemove = function(ev){
					ev = ev || window.event; 
					var mc = Dialogor.mouseCoords(ev);
					if(move){
						var x = mc.x - mx;	
						var y = mc.y - my;	
						if("iframe" == type)
						{
							dlg_content.height = (parseInt(dlg_main.style.width) + x - 30) + "px";
						}
						dlg_main.style.width = parseInt(dlg_main.style.width) + x + "px";
						dlg_main.style.height  = parseInt(dlg_main.style.height)  + y + "px";
					}
					mx = mc.x;
					my = mc.y;
					return false;
				}
			}
		}
		
		dlg_text.appendChild(myDocument.createTextNode(OpenConfig.title));
		dlg_close.appendChild(myDocument.createTextNode("×"));
		dlg_title.appendChild(dlg_text);
		dlg_title.appendChild(dlg_close);
		dlg_box.appendChild(dlg_content);
		if(OpenConfig.resize)	dlg_box.appendChild(dlg_resize);
		dlg_main.appendChild(dlg_title);
		dlg_main.appendChild(dlg_box);
		dlg_view.appendChild(dlg_main);
		myDocument.body.appendChild(dlg_bg);
		myDocument.body.appendChild(dlg_view);
		
		dlg_content.contentWindow.Dialogor = OpenConfig.Win.Dialogor.Clone();
		dlg_content.contentWindow.Dialogor.Config.Win = dlg_content.contentWindow;

		return false;
	},
	
	Close : function()
	{
		var myDocument = this.Config.Win.document;
		var dlg_view = myDocument.getElementById("dlg_view");
		var dlg_bg = myDocument.getElementById("dlg_bg");
		if(dlg_view) dlg_view.parentNode.removeChild(dlg_view); 
		if(dlg_bg) dlg_bg.parentNode.removeChild(dlg_bg); 
		return false;
	},
	
	CloseWindow : function(win)
	{
		if(null == win.Dialogor)
		{
			win.Dialogor = Dialogor.Config.Win.Dialogor.Clone();
			win.Dialogor.Config.Win = parent;
		}
		win.Dialogor.Close();
		return false;
	},
	
	CloseParent : function()
	{
		if(parent) Dialogor.CloseWindow(parent);
	},
	
	OpenParent : function (config)
	{
		if(!parent) return false;
		config.Win = parent;
		parent.Dialogor = Dialogor.Config.Win.Dialogor.Clone();
		parent.Dialogor.Config.Win = parent;
		return parent.Dialogor.Open(config);
	},

	getDataset : function (attributes) {  
		if (!attributes) return;  
		var hash = {};  
		  
		for (var attribute, i = 0, j = attributes.length; i < j; i++) 
		{  
			attribute = attributes[i];  
			if(attribute.nodeName.indexOf('data-') != -1){  
				hash[attribute.nodeName.slice(5)] = attribute.nodeValue;  
			}  
		}  
		  
		return hash;  
	},
	
	getView : function (element)
	{
		var myDocument = this.Config.Win.document;
		if(element != myDocument)
			return {
				width: element.offsetWidth,
				height: element.offsetHeight
			}
		if (myDocument.compatMode == "BackCompat"){
			return {
				width: myDocument.body.clientWidth,
				height: myDocument.body.clientHeight
			}
		} else {
			return {
				width: myDocument.documentElement.clientWidth,
				height: myDocument.documentElement.clientHeight
			}
		}
	},
	
	//获取鼠标坐标
	mouseCoords : function (ev) 
	{ 
		var myDocument = this.Config.Win.document;
		if(ev.pageX || ev.pageY){ 
			return {x:ev.pageX, y:ev.pageY}; 
		} 
		return { 
			x:ev.clientX + myDocument.body.scrollLeft - myDocument.body.clientLeft, 
			y:ev.clientY + myDocument.body.scrollTop - myDocument.body.clientTop 
		};
	},
	
	Clone : function()
	{
		var _Dialogor = {};
		_Dialogor.Close 		= this.Close;
		_Dialogor.CloseParent 	= this.CloseParent;
		_Dialogor.CloseWindow 	= this.CloseWindow;
		_Dialogor.Config 		= this.Config.Clone();
		_Dialogor.Default 		= this.Default;
		_Dialogor.GetConfig 	= this.GetConfig;
		_Dialogor.OnLoad 		= this.OnLoad;
		_Dialogor.Open 			= this.Open;
		_Dialogor.OpenParent 	= this.OpenParent;
		_Dialogor.getDataset 	= this.getDataset;
		_Dialogor.getView 		= this.getView;
		_Dialogor.mouseCoords 	= this.mouseCoords;
		_Dialogor.Clone 		= this.Clone;
		return _Dialogor;		
	}
}

/* cookies.js 1.4.0 https://github.com/franciscop/cookies.js */
var cookies=function(a,b){function c(a,b){a=a||{};for(var c in b)void 0===a[c]&&(a[c]=b[c]);return a}function d(a){var b=a;return b instanceof Date||(b=new Date,b.setTime(b.getTime()+1e3*a)),b.toUTCString()}if(c(cookies,{expires:31536e3,path:"/",secure:"https:"===window.location.protocol,nulltoremove:!0,autojson:!0,autoencode:!0,encode:function(a){return encodeURIComponent(a)},decode:function(a){return decodeURIComponent(a)},error:function(a,b,c){throw new Error(a)},fallback:!1}),b=c(b,cookies),"string"==typeof a){var e=document.cookie.split(/;\s*/).map(b.autoencode?b.decode:function(a){return a}).map(function(a){return a.split("=")}).reduce(function(a,b){return a[b[0]]=b[1],a},{})[a];if(!b.autojson)return e;var f;try{f=JSON.parse(e)}catch(g){f=e}return"undefined"==typeof f&&b.fallback&&(f=b.fallback(a,b)),f}for(var h in a){var i=a[h],j="undefined"==typeof i||b.nulltoremove&&null===i,k=b.autojson?JSON.stringify(i):i,l=b.autoencode?b.encode(k):k;j&&(l="");var m=b.encode(h)+"="+l+(b.expires?";expires="+d(j?-1e4:b.expires):"")+";path="+b.path+(b.domain?";domain="+b.domain:"")+(b.secure?";secure":"");b.test&&b.test(m),document.cookie=m;var n=cookies(b.encode(h))||"";i&&!j&&b.expires>0&&JSON.stringify(n)!==JSON.stringify(i)&&(navigator.cookieEnabled?b.fallback?b.fallback(a,b):b.error("Cookie too large at "+i.length+" characters"):b.error("Cookies not enabled"))}return cookies};!function(a){"object"==typeof exports&&"object"==typeof module?module.exports=cookies:"function"==typeof define&&define.amd?define("cookies",[],cookies):"object"==typeof exports?exports.cookies=cookies:a.cookies=cookies}(this);

// Load 
document.addEventListener('DOMContentLoaded', function(ev) {
    // 显示更多分类
    showmore = function(more)
    {
        if(!document.getElementsByClassName("type-list")[0]) return;
        if (more)
        {
            document.getElementsByClassName("type-list")[0].className = "type-list type-list-slide";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more type-more-on";
        } else {
            document.getElementsByClassName("type-list")[0].className = "type-list";
            document.getElementsByClassName("type-more")[0].className = "type-item type-more";
        }
    }

    // 单击监听
    document.body.addEventListener("click", function(ev){
        ev = ev || window.event;
        var target = ev.target;

        // 更多分类单击监听
        if("more-type" == target.id)
        {
            var more = cookies('more-type');
            showmore(!more);
            cookies({'more-type': !more});
        }

    }, false);

    // 下载链接点击监听
    Dialogor.OnLoad(".res-links", "iframe");
    var more = cookies('more-type');
    showmore(more);

    var id = query.key('id');
    if (id != "") {
        var links = document.getElementsByTagName('a');
        for (var l in links) {
            if (!links[l].className || links[l].className.indexOf("res-links") < 0) continue;
            if (!links[l].href || links[l].href.indexOf("id=" + id) < 0) continue;
            links[l].click();
        }
	}
	
	var clipboard = new Clipboard('.clipboard-ext');

    clipboard.on('success', function (e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function (e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
});