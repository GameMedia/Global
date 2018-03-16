/**
* eMosbat TinyMCE Integration
* Version 1.0
*/

// Startup variables
var imageTag = false;
var theSelection = false;

var bbcodeEnabled = true;
// Check for Browser & Platform for PC & IE specific bits
// More details from: http://www.mozilla.org/docs/web-developer/sniffer/browser_type.html
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));

var panels = new Array('options-panel', 'attach-panel', 'poll-panel');
var show_panel = 'options-panel';

function escapeReg(str)
{ 
 		
  		var specials = [ "-" , "[" , "]" , "/" , "{" , "}" , "(" , ")" , "*" , "+" , "?" , "." , "\\" , "^" , "$" , "|" ]; 
    	regex = RegExp('[' + specials.join('\\') + ']', 'g'); 
    	return str.replace(regex, "\\$&"); 
}

// override addquote function
addquote = function(post_id, username, l_wrote)
{
	var message_name = 'message_' + post_id;
	var theSelection = '';
	var divarea = false;

	if (l_wrote === undefined)
	{
		// Backwards compatibility
		l_wrote = 'wrote';
	}

	if (document.all)
	{
		divarea = document.all[message_name];
	}
	else
	{
		divarea = document.getElementById(message_name);
	}

	// Get text selection - not only the post content :(
	// IE9 must use the document.selection method but has the *.getSelection so we just force no IE
	if (window.getSelection && !is_ie && !window.opera)
	{
		theSelection = window.getSelection().toString();
	}
	else if (document.getSelection && !is_ie)
	{
		theSelection = document.getSelection();
	}
	else if (document.selection)
	{
		theSelection = document.selection.createRange().text;
	}

	if (theSelection == '' || typeof theSelection == 'undefined' || theSelection == null)
	{
		if (divarea.innerHTML)
		{
			theSelection = divarea.innerHTML.replace(/<br>/ig, '\n');
			theSelection = theSelection.replace(/<br\/>/ig, '\n');
			theSelection = theSelection.replace(/&lt\;/ig, '<');
			theSelection = theSelection.replace(/&gt\;/ig, '>');
			theSelection = theSelection.replace(/&amp\;/ig, '&');
			theSelection = theSelection.replace(/&nbsp\;/ig, ' ');
		}
		else if (document.all)
		{
			theSelection = divarea.innerText;
		}
		else if (divarea.textContent)
		{
			theSelection = divarea.textContent;
		}
		else if (divarea.firstChild.nodeValue)
		{
			theSelection = divarea.firstChild.nodeValue;
		}
	}

	if (theSelection)
	{
		if (bbcodeEnabled)
		{
			insert_text('[quote="' + username + '"]' + theSelection + '[/quote]');
		}
		else
		{
			insert_text(username + ' ' + l_wrote + ':' + '<br />');
			var lines = split_lines(theSelection);
			for (i = 0; i < lines.length; i++)
			{
				insert_text('> ' + lines[i] + '<br />');
			}
		}
	}

	return;
}

// override insert_text function
insert_text = function(text, spaces, popup)
{
	if(!popup)
	{
				tinyMCE.activeEditor.focus();   
		        oldcnt = tinyMCE.activeEditor.selection.getContent();   
		        tinyMCE.activeEditor.selection.setContent(oldcnt+custom_phpbb_bbcode2html((spaces?' ':'')+text+(spaces?' ':'')));
	
	} else {
				//opener.tinyMCE.activeEditor.focus();   
		        oldcnt = opener.tinyMCE.activeEditor.selection.getContent();   
		        opener.tinyMCE.activeEditor.selection.setContent(oldcnt+opener.custom_phpbb_bbcode2html((spaces?' ':'')+text+(spaces?' ':'')));
		        //opener.tinyMCE.activeEditor.focus();
		
	}


}

// override colorPalette function
colorPalette = function(s1,s2,s3) {
	return false; // do not need it!
}

// override attach_inline function
attach_inline = function(index, filename)
{
	insert_bbcode(tinyMCE.activeEditor,'[attachment=' + index + ']' + filename,'[/attachment]<span id="__caret">_</span>',true)
}

// override hide_qr function
hide_qr = function(show)
{
		dE('qr_editor_div');
		dE('qr_showeditor_div');
		if (show && document.getElementById('qr_editor_div').style.display != 'none')
		{
			tinymce.execCommand('mceFocus',false,'message');
		}
		return true;
}

function insert_bbcode(ed,open,close,caret)
{
				bbparser_bbcodeconv_off = true;
		        ed.focus(); 
		        oldcnt = ed.selection.getContent(); 
		        ed.selection.setContent(open+oldcnt+(caret==false?' <span id="__caret">_</span> ':'')+close);
		        caretNode = ed.dom.get('__caret');
		        ed.dom.remove('__caret');
		        
				bbparser_bbcodeconv_off = false;

}

function add_default_buttons(ed,la_arr,bcaption,btip)
{
		        ed.addButton('quote', {
		        title : (btip == 1 ? la_arr[0] : ''),
		        label : (bcaption == 1 ? 'Quote' : ''),  
		        image : bbcode_images_path+'quote2.gif',
		        onclick : function() {
		        	insert_bbcode(ed,'[quote]','[/quote]',false);
		        }
		        });
		    
		        ed.addButton('code2', {
		        title : (btip == 1 ? la_arr[1] : ''),
		        label : (bcaption == 1 ? 'Code' : ''),
		        image : bbcode_images_path+'code2.gif',
		        onclick : function() {
		        	insert_bbcode(ed,'[code]','[/code]',false);
		        }
		        });
		    
		        ed.addButton('list', {
		        title : (btip == 1 ? la_arr[2] : ''),
		        label : (bcaption == 1 ? 'List' : ''),
		        image : bbcode_images_path+'list.gif',
		        onclick : function() {
		        	insert_bbcode(ed,'[list]','[/list]',false);
		        }
		        });
		    
		        ed.addButton('list2', {
		        title : (btip == 1 ? la_arr[3] : ''),
		        label : (bcaption == 1 ? 'List=' : ''),
		        image : bbcode_images_path+'list2.gif',
		        onclick : function() {
		        	insert_bbcode(ed,'[list=]','[/list]',false);
		        }
		        });
		    
		        ed.addButton('item', {
		        title : (btip == 1 ? la_arr[4] : ''),
		        label : (bcaption == 1 ? '[*]' : ''),
		        image : bbcode_images_path+'item.gif',
		        onclick : function() {
		        	insert_bbcode(ed,'[*]','[/*]',false);
		        }
		        });
		        
		        ed.addButton('flash', {
		        title : (btip == 1 ? la_arr[5] : ''),
		        label : (bcaption == 1 ? 'Flash' : ''),
		        image : bbcode_images_path+'flash.gif',
		        onclick : function() {
		        	insert_bbcode(ed,'[flash]','[/flash]',false);
		        }
		        });

	
}

function build_bbcode_regex(s,rg,rp)
{
		rgobj = new RegExp(rg,"gi");
		return s.replace(rgobj,rp);
}

function clean_paste(txt)
{
	
	var additional_tags = ""; // add additional tags here.
	
	txt = txt.replace(/__MCE_ITEM__/ig, '');
	
	tinymce.activeEditor.selection.setContent(input_strip_tags(txt,'<a><img><b><strong><br><br /><br/><p><b><span><font><em><i><blockquote><u><table><tr><td><th><caption><col><colgroup><thead><tbody><tfoot>'+additional_tags));

	return "";
	
}


//	from phpjs.org
function input_strip_tags (input, allowed) {
    allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}
