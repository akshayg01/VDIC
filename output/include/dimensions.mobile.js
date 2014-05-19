/* Copyright (c) 2007 Paul Bakaus (paul.bakaus@googlemail.com) and Brandon Aaron (brandon.aaron@gmail.com || http://brandonaaron.net)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * $LastChangedDate: 2007-12-20 08:43:48 -0600 (Thu, 20 Dec 2007) $
 * $Rev: 4257 $
 *
 * Version: 1.2
 *
 * Requires: jQuery 1.2+
 */
(function(c){function d(b,a){return parseInt(c.curCSS(b.jquery?b[0]:b,a,true))||0}c.dimensions={version:"1.2"};c.each(["Height","Width"],function(b,a){c.fn["inner"+a]=function(){if(this[0]){var b=a=="Height"?"Top":"Left",c=a=="Height"?"Bottom":"Right";return this.is(":visible")?this[0]["client"+a]:d(this,a.toLowerCase())+d(this,"padding"+b)+d(this,"padding"+c)}};c.fn["outer"+a]=function(b){if(this[0]){var e=a=="Height"?"Top":"Left",f=a=="Height"?"Bottom":"Right",b=c.extend({margin:false},b||{});return(this.is(":visible")? this[0]["offset"+a]:d(this,a.toLowerCase())+d(this,"border"+e+"Width")+d(this,"border"+f+"Width")+d(this,"padding"+e)+d(this,"padding"+f))+(b.margin?d(this,"margin"+e)+d(this,"margin"+f):0)}}});c.each(["Left","Top"],function(b,a){c.fn["scroll"+a]=function(b){return!this[0]?void 0:b!=void 0?this.each(function(){this==window||this==document?window.scrollTo(a=="Left"?b:c(window).scrollLeft(),a=="Top"?b:c(window).scrollTop()):this["scroll"+a]=b}):this[0]==window||this[0]==document?self[a=="Left"?"pageXOffset": "pageYOffset"]||c.boxModel&&document.documentElement["scroll"+a]||document.body["scroll"+a]:this[0]["scroll"+a]}});c.fn.extend({position:function(){var b=this[0],a,c,e;if(b){e=this.offsetParent();if(!e.length)return a;a=this.offset();c=e.offset();a.top-=d(b,"marginTop");a.left-=d(b,"marginLeft");c.top+=d(e,"borderTopWidth");c.left+=d(e,"borderLeftWidth");a={top:a.top-c.top,left:a.left-c.left}}return a},offsetParent:function(){if(this.css("display")==null)return false;for(var b=this[0].offsetParent;b&& !/^body|html$/i.test(b.tagName)&&c.css(b,"position")=="static";)b=b.offsetParent;return c(b)}})})(jQuery);
/*
 * Input Floating Hint Box - jQuery plugin 1.1 Beta
 *
 * Copyright (c) 2008 Nicolae Namolovan (nicolae.namolovan gmail.com)
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * Revision: 20
 *
 */
 /**
  * Home page http://nicolae.namolovan.googlepages.com/jquery.inputHintBox.html
  * Demo http://nicolae.namolovan.googlepages.com/jquery.inputHintBox.demo.html
  **/

/**
 * Provide an automatic box hint in the right side of a input when user click it, it disapear when focus change (blur)
 *
 * Depends on dimensions plugin's offset method for correct positioning of the hint box element
 *
 * The source(@source) of the text/html can be an attribute (title for example), or a pure html.
 * Attribute can contain escaped html, example: title="This will be &lt;b&gt;Bold&lt;/b&gt;"
 *
 * All hints can use one div element(@div option) with your custom design, and only some subelement of 
 * this @div will change (according to source).
 *
 * You can provide only the @className, and for each input a separate <div> element will be created
 * with @className as class.
 *
 * If user click on the box to select some text (for copy/paste for example), box will not disappear.
 *
 * If you need to make the box appear in more left, use incrementLeft, same for top - incrementTop,
 * you can use - sign if you want to decrement.
 **/

/**
 * Example, you have a shiny div and you want to use it as a Shell for hint messages
 * <div id="shiny_box">
 * 	<span id="round-tleft"><span id="round-tright">
 *	<div class="shiny_box_body"></div>
 * 	<span id="round-bleft"><span id="round-bright">
 * </div>
 *
 * You have a inputs like:
 * <input name="username" type="text" class="titleHintBox" title="Only letters &lt;b&gt;(a-z)&lt;/b&gt;, numbers (0-9), and periods (.) are allowed">
 * <input name="password" type="text" class="titleHintBox" title="Minimum of 8 characters in length">
 *
 * Here is an example of js to use:
 * $('.titleHintBox').inputHintBox({div:$('#shiny_box'),div_sub:'.shiny_box_body',source:'attr',attr:'title',incrementLeft:12,incrementTop:-12});
 **/

/**
 * Provide a hint box near input as a absolute positioned div.
 * @name InputHintBox
 * @cat Plugins/Forms
 * @type $
 * @param Map options Optional settings
 * @option jQueryDom @div box to show, if this is set then className do not apply
 * @option String @div_sub css selector, use this when you need to write the Dynamic html into a element Inside the @div box,
 							example: .body, this will search for .body in context of @div
 * @option String @className This class will be added to the dynamic created div box. Default: "input_hint_box"
 * @option String @source Source of box message text html: attr | html, Default: "attr"
 * @option String @attr If @source = "attr" then html will be taken from the attribute named @attr. Default: "title"
 * @option String @html If @source = "html" them html will be taken from @html
 * @option Integer @incrementLeft This value will be incremented to the left property of the absolute positioned hint box. Default: 10
 * @option Integer @incrementTop This value will be incremented to the top property of the absolute positioned hint box. Default: 10
 * @option String @attachTo Hint box will be appended to this. Default: "body"
 */

(function($) {
$.fn.inputHintBox = function(options) {
	options = $.extend({}, $.inputHintBoxer.defaults, options);
	
	this.each(function(){
		new $.inputHintBoxer(this,options);
	});
	return this;
}

$.inputHintBoxer = function(input, options) {
	var $guideObject = $(options.el || input),$input = $(input), box, boxMouseDown = false;
	
	//$guideObject - in left of this object hint box will be positioned
	
	// If @type=radio then it must be inside a label and we should put the hint box in the right side of the label
	if ( ($guideObject.attr('type') == 'radio' || $guideObject.attr('type') == 'checkbox') && $guideObject.parent().is('label') ) {
		$guideObject = $( $guideObject.parent() );
	}
	

	function init() {
		var boxHtml = options.html != ''?options.html:
					  	options.source == 'attr'?$input.attr(options.attr): '';
			
		if (typeof boxHtml === "undefined") boxHtml = '';
		box = options.div != '' ? options.div.clone() : $("<div/>").addClass(options.className);
		box = box.css('display','none').addClass('_hintBox').appendTo(options.attachTo);
		
		if (options.div_sub == '') box.html(boxHtml);
		else $(options.div_sub,box).html(boxHtml);
		
		if ($input.is(":focus")){
			show();
		}
		
		$input.focus(function() {
			$('body').mousedown(global_mousedown_listener);
			show();
		}).blur(function(){
			prepare_hide();
		}).bind('focusin', function(e) {
			$('body').mousedown(global_mousedown_listener);
			show();
		}).bind('focusout', function(e){
			prepare_hide(true);
		});
	}
	
	// This is evaluated each time to prevent probs with elements with display none
	function align() {
		var guidePos = Runner.getPosition($guideObject[0]),
			offsets = $guideObject.position(),
			left = guidePos.left + $guideObject.width() + options.incrementLeft + 5 + ($.browser.safari?5:($.browser.msie?10:($.browser.mozilla?6:0))),
			//left = offsets.left + $guideObject.width() + options.incrementLeft + 5 + ($.browser.safari?5:($.browser.msie?10:($.browser.mozilla?6:0))),
			top = guidePos.top + options.incrementTop;// + ($.browser.msie?14:($.browser.mozilla?8:0));
			//top = offsets.top + options.incrementTop + ($.browser.msie?14:($.browser.mozilla?8:0));
		/*if (options.pageObj && options.pageObj.fly && options.pageObj.win){
			top += options.pageObj.win.cfg.getProperty("y");
			left += options.pageObj.win.cfg.getProperty("x");
			box.css('z-index', options.pageObj.win.cfg.getProperty("zindex")+1);
		}*/
		if (options.pageObj && options.pageObj.fly && options.pageObj.win){
			box.css('z-index', options.pageObj.win.cfg.getProperty("zindex")+1);
		}
		box.css({position:"absolute",top:top,left:left});
	}
	
	function show() {
		$('div.shiny_box').hide();
		align();
		box.show();//fadeIn('fast');
	}
	
	function prepare_hide(noTimeout) {
		// We want to allow user to select and copy/paste content from the box
		// So delay a bit to see where user click
		$('body').click(global_click_listener);
		if (boxMouseDown) return;
		if (noTimeout){
			hide(true);
		}else{
			$.inputHintBoxer.mostRecentHideTimer = setTimeout(function(){hide()},300);	
		}		
	}
	
	var global_click_listener = function(e) {
		var $e = $(e.target),c='._hintBox';
		clearTimeout($.inputHintBoxer.mostRecentHideTimer);
		if ($e.parents(c).length == 0 && $e.is(c) == false) hide();
	};
	
	// Prevent hiding when selecting..
	// When user Select a text to select, a Mousedown is fired BEFORE blur of input
	// This why we need to know when a Mousedown is done to our object
	var global_mousedown_listener = function(e) {
		var $e = $(e.target),c='._hintBox';
		boxMouseDown = ($e.parents(c).length != 0 || $e.is(c) != false);
	}
	
	function hide(noTimeout) {
		$('body').unbind('click',global_click_listener);
		$('body').unbind('mousedown',global_mousedown_listener);
		align();
		if (noTimeout){
			box.hide();
		}else{
			box.fadeOut('fast');			
		}
	}
	
	init();
	return {}
};

$.inputHintBoxer.mostRecentHideTimer = 0;

$.inputHintBoxer.defaults = {
	div: '',
	className: 'input_hint_box',
	source: 'attr', // attr or html
	div_sub: '', // Where to write
	attr: 'title',
	html: '',
	incrementLeft: 5,
	incrementTop: 0,
	attachTo: 'body'
}

})(jQuery);