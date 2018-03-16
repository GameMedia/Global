/**
 * editor_plugin_src.js
 * 
 * phpBB BBCode Plugin
 * Copyright 2012, https://github.com/eMosbat
 * 
 * Original code by Moxiecode Systems AB
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	var JSONRequest = tinymce.util.JSONRequest, each = tinymce.each, DOM = tinymce.DOM;
	
	tinymce.create('tinymce.plugins.phpBBCodePlugin', {
		init : function(ed, url) {
			var t = this, dialect = ed.getParam('bbcode_dialect', 'phpbb').toLowerCase();

			ed.onBeforeSetContent.add(function(ed, o) {
			// eMosbat modification
				o.content = custom_phpbb_bbcode2html(o.content);
			// eMosbat modification
				o.content = t['_' + dialect + '_bbcode2html'](o.content);
			});

			ed.onPostProcess.add(function(ed, o) {
				if (o.set) {
			// eMosbat modification
					o.content = custom_phpbb_bbcode2html(o.content);
			// eMosbat modification
					o.content = t['_' + dialect + '_bbcode2html'](o.content);
				}
				
				if (o.get) {
			// eMosbat modification
					o.content = custom_phpbb_html2bbcode(o.content);
			// eMosbat modification
					o.content = t['_' + dialect + '_html2bbcode'](o.content);
				}
			});
		},

		getInfo : function() {
			return {
				longname : 'phpBB BBCode Plugin',
				author : 'Original code by Moxiecode Systems AB, Modified by eMosbat',
				authorurl : 'https://github.com/eMosbat',
				infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		},
		
		phpbb_html2bbcode : function(s) {
			s = custom_phpbb_html2bbcode(s);
			return this._phpbb_html2bbcode(s);
		},
		
		phpbb_bbcode2html : function(s) {
			s = custom_phpbb_bbcode2html(s);
			return this._phpbb_bbcode2html(s);
		},

		// Private methods

		// HTML -> BBCode in phpbb dialect
		_phpbb_html2bbcode : function(s) {
//alert('_phpbb_html2bbcode 1');			
			if(bbparser_bbcodeconv_off)
				return s;
//alert('_phpbb_html2bbcode 2');

			function rep(re, str) {
				s = s.replace(re, str);
			};

			rep(/&lt;/gi,"&___lt___;");
			rep(/&gt;/gi,"&___gt___;");

			rep(/<span style=\"color: ([^;\"]+); font-size: ([^;\"]+)%;\">(.*?)<\/span>/gi,"[color=$1][size=$2]$3[/size][/color]");
			rep(/<span style=\"color: ([^;\"]+); font-size: ([^;\"]+)%; text-decoration: ?underline;\">(.*?)<\/span>/gi,"[color=$1][size=$2][u]$3[/u][/size][/color]");
			rep(/<span style=\"color: ([^;\"]+)\">(.*?)<\/span>/gi,"[color=$1]$2[/color]");
			rep(/<span style=\"color: ([^;\"]+);\">(.*?)<\/span>/gi,"[color=$1]$2[/color]");
			rep(/<span style=\"color: ([^;\"]+); text-decoration: ?underline;\">(.*?)<\/span>/gi,"[color=$1][u]$2[/u][/color]");
			
			rep(/<span style=\"font-size: ([^;\"]+)%; color: ([^;\"]+);\">(.*?)<\/span>/gi,"[size=$1][color=$2]$3[/color][/size]");
			rep(/<span style=\"font-size: ([^;\"]+)%; color: ([^;\"]+); text-decoration: ?underline;\">(.*?)<\/span>/gi,"[size=$1][color=$2][u]$3[/u][/color][/size]");
			rep(/<span style=\"font-size: ([^;\"]+)%; text-decoration: ?underline;\">(.*?)<\/span>/gi,"[size=$1][u]$2[u][/size]");
			rep(/<span style=\"font-size: ([^;\"]+)%\">(.*?)<\/span>/gi,"[size=$1]$2[/size]");
			rep(/<span style=\"font-size: ([^;\"]+)%;\">(.*?)<\/span>/gi,"[size=$1]$2[/size]");
			
			rep(/<span style=\"font-weight: bold;\">(.*?)<\/span>/gi,"[b]$1[/b]");
			
			// example: <strong> to [b]
			rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
			rep(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[color=$1]$2[/color]");


			rep(/<font(.*?)>(.*?)<\/font>/gi,"$2");
			rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");
			rep(/<\/b>/gi,"[/b]");
			rep(/<\/strong>/gi,"[/b]");
			rep(/<b>/gi,"[b]");
			rep(/<strong(.*?)>/gi,"[b]");
			rep(/<\/i>/gi,"[/i]");
			rep(/<\/em>/gi,"[/i]");
			rep(/<i>/gi,"[i]");
			rep(/<em(.*?)>/gi,"[i]");
			rep(/<\/u>/gi,"[/u]");
			rep(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/gi,"[u]$1[/u]");
			rep(/<span style=\"text-decoration: ?underline\">(.*?)<\/span>/gi,"[u]$1[/u]");
			rep(/<u(.*?)>/gi,"[u]");
			rep(/<blockquote[^>]*>/gi,"[quote]");
			rep(/<\/blockquote>/gi,"[/quote]");
			rep(/<br \/>/gi,"\n");
			rep(/<br\/>/gi,"\n");
			rep(/<br>/gi,"\n");
			rep(/&nbsp;|\u00a0/gi," ");
			rep(/&quot;/gi,"\"");
			rep(/&amp;/gi,"&");
			rep(/<\/span>/gi,"\n");
			rep(/<span(.*?)>(.*?)<\/span>/gi,"$2");
			rep(/<p(.*?)>/gi,"");
			//rep(/<\/p>/gi,"\n");
			rep(/<\/p>/gi,"");
			rep(/<(.*?)>/gi,"");
			rep(/<\/(.*?)>/gi,"");

			rep(/&___lt___;/gi,"<");
			rep(/&___gt___;/gi,">");

			return s; 
		},

		// BBCode -> HTML from phpbb dialect
		_phpbb_bbcode2html : function(s) {
//alert('_phpbb_bbcode2html');

			function rep(re, str) {
				s = s.replace(re, str);
			};
			
			rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"&___lt__;img src=\"$1\" /&___gt__;");

			if(!bbparser_htmlconv_off)
			{
			rep(/</gi,"&___lt___;");
			rep(/>/gi,"&___gt___;");
			}
			
			// eMosbat modification
			rep(/\[size=(.*?)\](.*?)\[\/size\]/gi,"<span style=\"font-size: $1\%\">$2</span>");
			rep(/\[size\](.*?)\[\/size\]/gi,"$1");
			// eMosbat modification

			// example: [b] to <strong>
			rep(/\r\n/gi,"<br />");
			rep(/\n/gi,"<br />");
			rep(/\[b\]/gi,"<strong>");
			rep(/\[\/b\]/gi,"</strong>");
			rep(/\[i\]/gi,"<em>");
			rep(/\[\/i\]/gi,"</em>");
			rep(/\[u\]/gi,"<u>");
			rep(/\[\/u\]/gi,"</u>");
			rep(/\[url=([^\]]+)\](.*?)\[\/url\]/gi,"<a href=\"$1\">$2</a>");
			rep(/\[url\](.*?)\[\/url\]/gi,"<a href=\"$1\">$1</a>");
			rep(/\[img\](.*?)\[\/img\]/gi,"<img src=\"$1\" />");
			rep(/\[color=(.*?)\](.*?)\[\/color\]/gi,"<font color=\"$1\">$2</font>");
			
			rep(/&___lt___;/gi,"&lt;");
			rep(/&___gt___;/gi,"&gt;");
			rep(/&___lt__;/gi,"<");
			rep(/&___gt__;/gi,">");

			return s; 
		}
	});

	// Register plugin
	tinymce.PluginManager.add('phpbbcode', tinymce.plugins.phpBBCodePlugin);
})();