
var custom_label_map = {
"English" : {
}
};

function GetCustomLabel(name)
{
	return custom_label_map[Runner.lang.constants.current_language][name];
}

Runner.namespace('Runner.util');

(function(){
	
	var createDelayed = function(hn, obj, scope){
		return function(){
			var argsArr = Array.prototype.slice.call(arguments, 0);
			setTimeout(function(){
				hn.apply(scope, argsArr);
			}, obj.delay || 10);
		};
	};
	
	var createSingle = function(hn, e, fn, scope){
		return function(){
			e.removeListener(fn, scope);
			return hn.apply(scope, arguments);
		};
	};
	
	var createBuffered = function(hn, obj, scope){
		var task = new Runner.util.DelayedTask();
		return function(){
			task.delay(obj.buffer, hn, scope, Array.prototype.slice.call(arguments, 0));
		};
	};
	
	Runner.util.Event = function(obj, name){
		this.name = name;
		this.obj = obj;
		this.listeners = [];
	};
	
	Runner.util.Event.prototype = {
		
		session: null,
		
		createListener: function(fn, scope, obj){
			obj = obj || {};
			scope = scope || this.obj;
			var ls = {
				fn: fn, 
				scope: scope,
				options: obj
			};
			var hn = fn;
			if(obj.delay){
				hn = createDelayed(hn, obj, scope);
			}
			if(obj.single){
				hn = createSingle(hn, this, fn, scope);
			}
			if(obj.buffer){
				hn = createBuffered(hn, obj, scope);
			}
			ls.fireFn = hn;
			return ls;
		},
		
		getListenerIndex: function(fn, scope){
			scope = scope || this.obj;
			var length = this.listeners.length,
				ls;
			for(var i = 0; i < length; i++){
				ls = this.listeners[i];
				if(ls.fn == fn && ls.scope == scope){
					return i;
				}
			}
			return -1;
		},
		
		fire: function(){
			var scope,
				ls,
				length = this.listeners.length;
			if(this.listeners.length > 0){
				this.firing = true;
				var argsArr = Array.prototype.slice.call(arguments, 0);
				for(var i = 0; i < this.listeners.length; i++){
					ls = this.listeners[i];
					if ( this.session === null || ls.session == this.session){
						if(ls.fireFn.apply(ls.scope || this.obj || window, arguments) === false){
							this.firing = false;
							return false;
						}
					}
				}
				this.firing = false;
			}
			return true;
		},
		
		on: function(fn, scope, options, session){
			scope = scope || this.obj;
			if(!this.isListening(fn, scope)){
				ls = this.createListener(fn, scope, options);
				ls.session = session;
				if(!this.firing){
					this.listeners.push(ls);
				}else{
					//this.listeners = this.listeners.slice(0);
					this.listeners.push(ls);
				}
			}
		},
		
		isListening: function(fn, scope){
			return this.getListenerIndex(fn, scope) != -1;
		},
		
		removeListener: function(fn, scope){
			var index;
			if((index = this.getListenerIndex(fn, scope)) != -1){
				if(!this.firing){
					this.listeners.splice(index, 1);
				}else{
					this.listeners = this.listeners.slice(0);
					this.listeners.splice(index, 1);
				}
				return true;
			}
			return false;
		},
		
		clearListeners: function(){
			this.listeners = [];
		}
	};
})();


/**
 * @class Runner.util.Observable
 * Observer-subscriber class
 * Provides base functionality for PHPRunner's event handling
 */
Runner.util.Observable = Runner.extend(Runner.emptyFn, {
	
	session: 0,
	
	filterOptRe: /^(?:scope|delay|buffer|single)$/,
	
	addEvents: function(obj){
		if(!this.events){
			this.events = {};
		}
		if(typeof obj == 'string'){
			for(var i = 0, a = arguments, v; v = a[i]; i++){
				if(!this.events[a[i]]){
					this.events[a[i]] = true;
				}
			}
		}else{
			Runner.apply(this.events, obj);
		}
	},
	
	fireEventFilesLoaded: function(){
		if(this.eventsSuspended !== true){
			var ce = this.events[arguments[0].toLowerCase()];// || this.events[arguments[0]];
			if(typeof ce == "object"){
				ce.session = arguments[1];
				var r =  ce.fire.apply(ce, Array.prototype.slice.call(arguments, 1));
				ce.session = null;
				return r;
			}
		}
		return true;
	},
	
	fireEvent: function(){
		var evName = arguments[0].toLowerCase();
		if(this.isEventExist(evName)){
			var ce = this.events[evName];
			return ce.fire.apply(ce, Array.prototype.slice.call(arguments, 1));
		}
		return true;
	},
	
	isEventExist: function(){
		if(this.eventsSuspended !== true){
			var ce = this.events[arguments[0].toLowerCase()];
			if(typeof ce == "object"){
				return true;
			}
		}
		return false;
	},
	
	on: function(evName, fn, scope, obj){
		if(typeof evName == "object"){
			obj = evName;
			for(var event in obj){
				if(this.filterOptRe.test(event)){
					continue;
				}
				if(typeof obj[event] == "function"){
					this.on(event, obj[event], obj.scope, obj);
				}else{
					this.on(event, obj[event].fn, obj[event].scope, obj[event]);
				}
			}
			return;
		}
		obj = (!obj || typeof obj == "boolean") ? {} : obj;
		evName = evName.toLowerCase();
		var ce = this.events[evName] || true;
		if(typeof ce == "boolean"){
			ce = new Runner.util.Event(this, evName);
			this.events[evName] = ce;
		}
		ce.on(fn, scope, obj, this.session);
	},
	
	un: function(evName, fn, scope){
		var ce = this.events[evName.toLowerCase()];
		if(typeof ce == "object"){
			ce.removeListener(fn, scope);
		}
	},
	
	/**
	 * Purge (clear) array of listeners for events
	 */
	purgeListeners: function(){
		for(var event in this.events){
			if(typeof this.events[event] == "object"){
				this.events[event].clearListeners();
			}
		}
	},
	
	/**
	 * Make events suspended (delayed) for fire
	 */
	suspendEvents: function(){
	this.eventsSuspended = true;
	},
	
	/**
	 * Make events available for fire
	 */
	resumeEvents: function(){
		this.eventsSuspended = false;
	}
});


// register new namespace
Runner.namespace('Runner.util');

/**
 * @class Runner.util.DelayedTask
 * method for performing setTimeout where a new timeout cancels the old timeout. 
 * @param {Function} fn (optional) The default function to timeout
 * @param {Object} scope (optional) The default scope of that timeout
 * @param {Array} args (optional) The default Array of arguments
 */
Runner.util.DelayedTask = function(fn, scope, args){
	var id = null, 
		delay, time;
	
	var call = function(){
		var now = new Date().getTime();
		if(now - time >= delay){
			clearInterval(id);
			id = null;
			fn.apply(scope, args || []);
		}
	};
	
	/**
	 * Cancels any pending timeout and queues a new one
	 * @param {Number} delay The milliseconds to delay
	 * @param {Function} newFn (optional) Overrides function passed to constructor
	 * @param {Object} newScope (optional) Overrides scope passed to constructor
	 * @param {Array} newArgs (optional) Overrides args passed to constructor
	 */
	this.delay = function(newDelay, newFn, newScope, newArgs){
		if(id && delay != newDelay){
			this.cancel();
		}
		delay = newDelay;
		time = new Date().getTime();
		fn = newFn || fn;
		scope = newScope || scope;
		args = newArgs || args;
		if(!id){
			id = setInterval(call, delay);
		}
	};
	
	/**
	 * Cancel the last queued timeout
	 */
	this.cancel = function(){
		if(id){
			clearInterval(id);
			id = null;
		}
	};
};

/**
 * Global object for loading scripts and css files
 * @object
 */
Runner.util.ScriptLoader = Runner.extend(Runner.util.Observable, {
	/**
	 * Array of CSS files for loading
	 * @type 
	 */
	cssFiles: [],
	/**
	 * Array of file names for load
	 * @type {array}
	 */
	jsFiles: [],
	
	constructor: function(cfg){
		Runner.util.ScriptLoader.superclass.constructor.call(this, cfg);
		this.addEvents('filesLoaded');
		
		this.on('filesLoaded', function(){
			if (Runner.pages){
				Runner.pages.PageManager.initPages();
			}
		}, this, {single: true});
		
	},
	
	/**
	 * Add js file to load queue
	 * @param {array} files
	 * @param any param except first will be added for requirements array
	 */
	addJS: function(files){
		var self = this,
			isAdded = false;
		// loop through all files to add
		for (var i=0;i<files.length;i++){
			// check if such file was added before
			for (var j=0;j<this.jsFiles.length;j++){
				if (this.jsFiles[j].name == files[i]){
					isAdded = true;
					break;
				}
			}
			// add only new files
			if(!isAdded){
				// add files to array of file names
				var req = [],
					onload = null,
					arg = Array.prototype.slice.call(arguments, 1);
				for(var k=0;k < arg.length; k++){
					if (typeof(arg[k]) == typeof('string')){
						req.push(arg[k]);
					}
					if (typeof(arg[k]) == typeof(function(){})){
						//req.push(arg[k]);
						onload = function(f){ return f; }(arg[k]);
					}
				}
				this.jsFiles.push({
					name: files[i],
					isLoaded: false,
					//	add requirements, all passed arguments, except first
					requirements: Array.prototype.slice.call(arguments, 1),
					'onload': onload,
					session: parseInt(self.session)
				});
			}
			// reinit var
			isAdded = false;
		}
	},
	
	/**
	 * Method for load CSS files
	 * @param files {array}
	 */
	loadCSS: function (files, loadIE){
		for (var i=0;i<files.length; i++){
			// check if file exist in array of CSS files, try to get it's index
			var idx = this.cssFiles.getIndexOfElem(files[i], function(val, arrElem){
				if (val == arrElem.name){
					return true;
				}
			});
			
			// if file already added and it was loaded, than return true
			if (idx!=-1 && this.cssFiles[idx].isLoaded){
				continue;
			}
			this.cssFiles.push({
				name: files[i],
				isLoaded: true
			})
			var existInHead = false, existInHeadIE = false, utilObj = this;
			$('head link[rel="stylesheet"]').each(function(index, element){
				if($(element).attr('href') == files[i])
					existInHead = true;
				if($(element).attr('href') == utilObj.getCSSFileNameForIE(files[i]))
					existInHeadIE = true;
				if(existInHead && existInHeadIE)
					return false;
			});
			// load file
			var head = $(document).find('head')[0];
			if(!existInHead){
				var css = document.createElement('link');
				css.setAttribute('rel', 'stylesheet');
				css.setAttribute('type', 'text/css');
				css.setAttribute('href', files[i]);
				head.appendChild(css);
			}
			if(loadIE && Runner.isIE && !existInHeadIE){
				var css = document.createElement('link');
				css.setAttribute('rel', 'stylesheet');
				css.setAttribute('type', 'text/css');
				css.setAttribute('href', this.getCSSFileNameForIE(files[i]));
				head.appendChild(css);
			}
		}
	},
	
	getCSSFileNameForIE: function (fileName){
		if(fileName.substring(fileName.length - 4).toLowerCase() == ".css")
			return fileName.substring(0, fileName.length - 4) + "IE.css";
		else
			return fileName;
	},
	
	load: function(){
		this.session = this.session + 1;
		if (this.jsFiles.length==0) {
			this.fireEventFilesLoaded('filesLoaded', this.session-1);
		}
		
		for(var i=0;i<this.jsFiles.length;i++){
			this.loadJS(i);
		}
	},
		/**
	 * Load file from queue
	 * @param {int} idx file index
	 * @return {bool} true if success
	 * @method
	 * @private
	 */
	loadJS: function(idx){
		// return if no file obj for this file
		if (!this.jsFiles[idx]){
			return false;
		}
		// if loaded, load dependent files
		if(this.jsFiles[idx].isLoaded){
			this.jsFiles[idx].session = this.session - 1;
			this.postLoad(idx);
			return true;
		}
		// check requirements
		if (!this.checkReq(this.jsFiles[idx])){
			return false;
		}
		// file loading started already
		if(this.jsFiles[idx].isStarted){
			return false;
		}
		// load file
		this.jsFiles[idx].isStarted = true;
		
		var js = document.createElement('script');
		js.setAttribute('type', 'text/javascript');
		
		var initFuncName = this.jsFiles[idx].name.replace('.js','') + '_init';
		initFuncName = initFuncName.replace(/[\/\\.]/g, "_");
		
		var self = this,
			onload = this.jsFiles[idx].onload,
			fileName = this.jsFiles[idx].name;
		
		var	postLoadFunction = function(){
			var tl = true;
			if (typeof(window[initFuncName]) == typeof(function(){})){
				tl = window[initFuncName].call(self, idx);
			}
			if(typeof(onload) == typeof(function(){})){
				tl = onload.call(self, idx, tl);
			}
			if (tl!==false){
				self.postLoad(idx);
			}
		};
		
		if(Runner.isIE){
			js.onreadystatechange = function(){
				if (js.readyState == 'complete' || js.readyState == 'loaded'){
					postLoadFunction();
				}
			};
		}else{
			js.onload = postLoadFunction;
		}
		
		js.setAttribute('src', this.jsFiles[idx].name);
		document.getElementsByTagName('HEAD')[0].appendChild(js);
		return true;
	},
	
	/**
	 * Checks is required files are loaded
	 * @param {object} fileObj
	 * @return {Boolean}
	 */
	checkReq: function(fileObj){
		// loop through all files
		for(var i=0;i<fileObj.requirements.length;i++){
			// loop through all req
			for(var j=0;j<this.jsFiles.length;j++){
				// if req cotains loaded file, than try to load it
				if (fileObj.requirements[i] == this.jsFiles[j].name && !this.jsFiles[j].isLoaded){ 
					return false;
				}
			}
		}
		return true;
	},
	
	/**
	 * After event handler. Called after file loaded.
	 * @method
	 */
	postLoad: function(idx, session){
		var loadedAll = true;
		if (idx !== undefined){
			this.jsFiles[idx].isLoaded = true;
			this.loadDependent(idx);
			var session = this.jsFiles[idx].session;
		}
		for(var i=0;i<this.jsFiles.length; i++){
			if (!this.jsFiles[i].isLoaded /*&& this.jsFiles[i].session == session*/){
				loadedAll = false;
				break;
			}
		}
		if (loadedAll){
				if ($.inArray(session, this.loadedSes) == -1 ){
					this.fireEventFilesLoaded('filesLoaded', session);
					this.loadedSes.push(session);
				}
				if (idx!==undefined){
					for(var i=0; i < this.session; i++ ){
						this.postLoad(undefined, i);
					}
				}
		}
	},
	
	loadedSes:[],
	/**
	 * Call load for files, which are dependent to file with index = idx
	 * @param {int} idx
	 */
	loadDependent: function(idx){
		// loop through all files
		for(var i=0;i<this.jsFiles.length;i++){
			// loop through all req
			for(var j=0;j<this.jsFiles[i].requirements.length;j++){
				// if req cotains loaded file, than try to load it
				if (i != idx && this.jsFiles[i].requirements[j] == this.jsFiles[idx].name){ 
					this.loadJS(i);
				}
			}
		}
	}	
});
Runner.util.ScriptLoader = new Runner.util.ScriptLoader();
 
// create namespace
Runner.namespace('Runner.bricks');

/**
 * General class for manage bricks and containers
 * @class Runner.bricks.BrickManager
 */
Runner.bricks.BrickManager = Runner.extend(Runner.emptyFn,{
	/**
	 * jQuery element
	 * Block, container or element wich contain brick
	 * @type {object}
	 */
	elem: null,
	/**
	 * Name of container, brick or block
	 * Without contain 'runner-c-', 'runner-b-' or 'runner-'
	 * @type {string}
	 */
	name: '',
	/**
	 * Page container
	 * Dom element
	 * @type {string}
	 */
	pageCont: null,
	/**
	 * First part of base class
	 * Without contain name
	 * @type {string}
	 */
	baseClass: '',
	/**
	 * Class Name for hide container, brick or block
	 * @type {string}
	 */
	hiddenClass: '',
		
	constructor: function(cfg){
		Runner.apply(this, cfg);
		this.getElemName();
	},
	
	/**
	 * Get element name of brick, container or block 
	 * without base part of class name
	 * @param object element table for container
	 */
	getElemName: function(elem){
		if(this.name){
			return;
		}
		if(typeof elem == 'undefined'){
			elem = this.elem;
		}
		// always elem must has attribute "class"
		// this "if" only for against a risk
		if(elem.attr('class')){
			var cls = elem.attr('class').split(' ');
			for(var i=0; i<cls.length; i++){
				if(cls[i]){
					var pos = cls[i].indexOf(this.baseClass);
					if(pos > -1){
						this.name = cls[i].substr(pos+this.baseClass.length).trim();
						break;
					}
				}	
			}
		}
	},
	
	/**
	 * Hide element 
	 * Add hidden class
	 */
	hide: function(){
		if(!this.elem.hasClass(this.hiddenClass)){
			this.elem.addClass(this.hiddenClass);
		}
	},
	/**
	 * Show element 
	 * Remove hidden class
	 */
	show: function(){
		if(this.elem.hasClass(this.hiddenClass)){
			this.elem.removeClass(this.hiddenClass);
		}
	},
	
	/**
	 * Check on visible element
	 * @return {boolean}
	 */
	visible: function(){
		//if class of this.elem not contain 'runner-b-wrapper' that
		return this.elem.is(':visible');
		//else return visible from the embedded container
	}
});

/**
 * @class Runner.bricks.Brick
 */
Runner.bricks.Brick = Runner.extend(Runner.bricks.BrickManager,{
	
	contObj: false,
	
	contentElem: false,
	
	constructor: function(cfg){
		cfg.baseClass = 'runner-b-';
		cfg.hiddenClass = 'runner-hiddenbrick';
		Runner.bricks.Brick.superclass.constructor.call(this, cfg);	
		this.getContainer();
		this.getContentElem();
		if(this.elem.hasClass("runner-b-wrapper")){
			this.hiddenClass = "runner-hiddencontainer";
		}
	},
	
	/**
	 * Get content HTML element 
	 * If there isn't element with class runner-brickcontents in this brick
	 * Then content element it is this brick element
	 * @method
	 */
	getContentElem: function(){
		var brickContents = $('.runner-brickcontents',this.elem);
		if(brickContents.length){
			this.contentElem = brickContents;
		}else{
			this.contentElem = this.elem;
		}
	},
	
	/**
	 * Get container HTML element 
	 * @method
	 * @return {object}
	 */
	getContainer: function(){
		//var contElem = this.elem.closest("div[class^='runner-s-']"); 		
		var contElem;
		
		//try finding the closest container: a div element with a class 'runner-s-...' not containing the class "not-container". 
		this.elem.parents('div:not(".not-container")').each(function() {	
			var classes = [];
			if ($(this).attr('class') !== undefined) {
			   classes = $(this).attr('class').split(' ');
			}

			for (var i = 0; i < classes.length; i++) {
				if (classes[i].indexOf("runner-s-") === 0) {
					contElem = $(this);
					return false;
				}
			}		
		});
		
		if(contElem && contElem.length){
			this.contObj = new Runner.bricks.Container({
				elem: contElem,
				pageCont: this.pageCont
			});
		}
	},
	
	/**
	 * Hide brick
	 * If this brick the single in the container
	 * Then the container must be hidden too!
	 */
	hide: function(){
		Runner.bricks.Brick.superclass.hide.call(this);
		if(!this.contObj){
			return;
		}
		
		var contBricks = this.contObj.getBricks(),
			visible = false;
			
		for(var i = 0, l = contBricks.length; i<l; i++){
			if(contBricks[i].visible()){
				visible = true;
				break;
			}
		}
		
		//If there isn't any bricks in the container, hide container
		if(!visible){
			this.contObj.hide();
		}
	},
	
	/**
	 * Show brick
	 * If this brick position in the hidden container
	 * Than the container must be shown too!
	 */
	show: function(){
		Runner.bricks.Brick.superclass.show.call(this);
		if(!this.contObj){
			return;
		}
		this.contObj.show();
	},
	
	/**
	 * Hide/Show brick depending on newHTML
	 * @param {mixed} new HTML for replace
	 * @param {boolean} true, if new brick has hidden class
	 */
	prepareToReplaceWith: function(newHTML, isHidden){
		isHidden = isHidden || false;
		var isHtml = false;
		if($(newHTML).length  && $(newHTML).html()){
			if($(newHTML).tagName() == "span"){
				if($($(newHTML).html()).html()){
					isHtml = true;
				}
			}else{
				isHtml = true;
			}
		}
		
		if(!isHidden && (newHTML && !$(newHTML).length || isHtml || $(newHTML).length > 1)){
			if(!this.visible()){
				this.show();
			}
		}else if(this.visible()){
			this.hide();
		}
	},
	
	/**
	 * Replace brick elem
	 * @param {mixed} new html
	 */
	replaceWith: function(newHTML){
		this.prepareToReplaceWith(newHTML);
		this.elem.replaceWith(newHTML);
		
	},
	
	/**
	 * Replace html for brick
	 * @param {mixed} new html
	 */
	replaceHTMLWith: function(newHTML){
		this.prepareToReplaceWith(newHTML.html, newHTML.isHidden);
		this.elem.empty().html(newHTML.html);
	},
	
	/**
	 * Replace content elem of brick
	 * @param {mixed} new brick content
	 */
	replaceContentWith: function(newContent){
		this.prepareToReplaceWith(newContent);
		this.contentElem.replaceWith(newContent);
	},
	
	/**
	 * Replace html for brick content
	 * @param {mixed} new contents
	 */
	replaceContentHTMLWith: function(newHTML){
		this.prepareToReplaceWith(newHTML);
		this.contentElem.empty().html(newHTML);
	}
});

/**
 * @class Runner.bricks.Container
 */
Runner.bricks.Container = Runner.extend(Runner.bricks.BrickManager,{
	
	blockObj: false,
	
	constructor: function(cfg){
		cfg.baseClass = 'runner-c-';
		cfg.hiddenClass = 'runner-hiddencontainer';
		Runner.bricks.Container.superclass.constructor.call(this, cfg);	
		this.getBlock();
	},
	
	getElemName: function(){
		Runner.bricks.Container.superclass.getElemName.call(this, $('table.runner-c:first',this.elem));
	},
	
	/**
	 * Hide container
	 * If this container the single in the block
	 * Then the block must be hidden too!
	 */
	hide: function(){
		Runner.bricks.Container.superclass.hide.call(this);
		var bWrapperParent = this.getBWrapperParent();
		if(bWrapperParent){
			new Runner.bricks.Brick({
				elem: $(bWrapperParent)
			}).hide();
		}
		else if(!this.blockObj){
			return;
		}
		else{
			var blockConts = this.blockObj.getContainers(),
				visible = false;
			for(var i = 0, l = blockConts.length; i<l; i++){
				if(blockConts[i].visible()){
					visible = true;
					break;
				}
			}
			//If there isn't any containers in the block, hide block
			if(!visible){
				this.blockObj.hide();
			}
		}
	},
	
	/**
	 * getBWrapperParent
	 * Find parent of the container which have class 'runner-b-wrapper'
	 * @return {object} parent 
	 */
	getBWrapperParent: function(){
		var result = $(this.elem).closest('.runner-b-wrapper', this.pageCont);
		if(result.length){
			return result;
		}
		return false;
	},
	
	/**
	 * Show container
	 * If this container position in the hidden block
	 * Than the block must be shown too!
	 */
	show: function(){
		Runner.bricks.Container.superclass.show.call(this);
		var bWrapperParent = this.getBWrapperParent();
		if(bWrapperParent){
			new Runner.bricks.Brick({
				elem: $(bWrapperParent)
			}).show();
		}
		else{
			if(!this.blockObj){
				return;
			}
			this.blockObj.show();
		}
	},
	
	/**
	 * Get array of bricks for container
	 * @method
	 * @return {array}  
	 */
	getBricks: function(){
		var bricksArr = [];
		$('[class*="runner-b-"]', this.elem).each(function(){
			bricksArr.push(new Runner.bricks.Brick({
				elem: $(this)
			}));
		});
		return bricksArr;
	},
	
	/**
	 * Get block HTML element 
	 * @method
	 * @return {object}  
	 */
	getBlock: function(elem){
		var blockElem;
		if(typeof elem == 'undefined'){
			blockElem = this.elem.closest('td');
		}else{
			blockElem = elem.parent().closest('td');
		}
		if(blockElem.hasClass('runner-wrapper')){
			this.getBlock(blockElem);
		}else if(blockElem.length){
			this.blockObj = new Runner.bricks.Block({
				elem: blockElem
			});
		}
	}
});

/**
 * @class Runner.bricks.Block
 */
Runner.bricks.Block = Runner.extend(Runner.bricks.BrickManager,{
	
	constructor: function(cfg){
		cfg.baseClass = 'runner-';
		cfg.hiddenClass = 'runner-hiddenblock';
		Runner.bricks.Block.superclass.constructor.call(this, cfg);	
	},
	
	/**
	 * Get array of containers for block
	 * @method
	 * @return {array}  
	 */
	getContainers: function(){
		var contsArr = [];
		$('[class*="runner-s-"]', this.elem).each(function(){
			contsArr.push(new Runner.bricks.Container({
				elem: $(this)
			}));
		});
		return contsArr;
	}
});

// create namespace
Runner.namespace('Runner.menu');

/**
 * @class Runner.menu.Manager
 * Abstract base class that provides common menu functionality. 
 */
Runner.menu.Manager = Runner.extend(Runner.emptyFn,{
	
	/**
	 * Is use RTL on page
	 * @param {boolean}
	 */	
	isDirRTL: false,
	
	init: function(){
		var dir = $('html').attr('dir') || '';
		if(dir.toLowerCase() == 'rtl'){
			this.isDirRTL = true;
		}
	},
	
	/**
	 * Click handler function for menu items
	 * @param {object} event
	 */	
	itemClickHandler: function(event){
		var target = Runner.Event.prototype.getTarget(event),
			link = $('a:first',this)[0];
		
		if (typeof(link) == "undefined"){
			return false;
		}
		
		if($(this).hasClass('Group') && target.nodeName!='IMG' && !link.href){
			$('.groupImg:first', this).click();
			return;
		}
		
		if(target.nodeName == "A" ){
			if(target.rel == 'external'){
				return !window.open(target.href);
			}
			return;
		}
		
		Runner.Event.prototype.stopEvent(event);
		if(link.href){
			if(link.rel == 'external'){
				return !window.open(link.href);
			}
			window.location = link.href;
		}
	}
});

/**
 * @class Runner.menu.QuickJump
 * Abstract base class that provides quick jump menu functionality. 
 */
Runner.menu.QuickJump = Runner.extend(Runner.emptyFn, {
	/**
	 * Current selected item in dropdown
	 * @type Integer
	 */
	selectCurrent: -1,
	/**
	 * Init quickjump menu
	 * Bind events handlers on dropdown
	 */
	init: function(){
		var menuObj = this;
		$(".runner-quickjump:first").prop("initialized","true");
		$(".runner-quickjump").bind({
			focus: function(){
				menuObj.selectCurrent = this.selectedIndex; 
			},
			change: function(){
				if(this.options[this.selectedIndex].value){
					if($(this.options[this.selectedIndex]).attr('link') == 'External'){
						window.open(this.options[this.selectedIndex].value);
					}else{
						window.location.href = this.options[this.selectedIndex].value;
					}
				}else{
					this.selectedIndex = menuObj.selectCurrent;
				}
			}	
		});
	}	
});

/**
 * @class Runner.menu.Horizontal
 * Abstract base class that provides horizontal menu functionality. 
 */
Runner.menu.Horizontal = Runner.extend(Runner.menu.Manager,{
	/**
	 * Max submenu width
	 * @type Integer
	 */
	maxSubMenuWidth: 0, 
	/**
	 * Max group (ul) width
	 * @type Integer
	 */
	maxGroupWidth: 0,
	/**
	 * Max item (li) width
	 * @type Integer
	 */
	maxItemWidth: 0,
	/**
	 * Was top item hovered or not
	 * @type Boolean
	 */
	topItemHovered: false,
	/**
	 * Absolute posution for top item
	 * @type object
	 */
	topItemAbsPos: null,
	/**
	 * Was item hovered or not
	 * @type Boolean
	 */
	itemHovered: false,
	/**
	 * Sub menu for hovered item
	 * @type object
	 */
	subMenu: null,
	
	init: function(){
		Runner.menu.Horizontal.superclass.init.call(this);
		this.bindHoverOnItems();
		this.setRaquoToTopItems();
		$(".runner-hmenu:first").prop("initialized","true");
	},
	
	/**
	 * Find sub menu for item
	 * @param {obj} elem
	 */
	findSubMenu: function(elem){
		this.subMenu = $('ul:first:has(li)', elem);
	},
	
	/**
	 * Manage add/remove class Active
	 * @param {obj} elem
	 * @param {boolean} toggle
	 */
	manageActiveClass: function(elem ,toggle){
		if($(elem).attr('class')!='Separator'){
			//if top item 
			if($('table:first',elem).length){
				$('.runner-menutab',elem).toggleClass('active',toggle);
			}else{
				$(elem).toggleClass('active', toggle);
			}
		}
	},
	
	/**
	 * Bind hover event on every menu item
	 * For hovered items add class 'active'
	 * For items losted hover event remove class 'active'
	 */
	bindHoverOnItems: function(){
		var menuObj = this;
		
		$('.runner-hmenu td, .runner-hmenu ul li').hover(function(){
			menuObj.findSubMenu(this);
			menuObj.manageActiveClass(this, true);
			
			if(menuObj.subMenu.length){
				menuObj.maxGroupWidth = 0;
				
				if($(this).attr('view')=='topitem'){
					menuObj.topItemAbsPos = Runner.getAbsolutePosition(this,1);
					menuObj.maxItemWidth = menuObj.topItemAbsPos.width;
					menuObj.topItemHovered = false;
				}
				
				menuObj.subMenu.css('display','block');
				
				$('li[parent='+(menuObj.subMenu.attr('id'))+'] a', menuObj.subMenu).each(function(){
					if(menuObj.maxGroupWidth < this.offsetWidth)
						menuObj.maxGroupWidth = this.offsetWidth
				});
				
				if(!menuObj.topItemHovered && menuObj.maxGroupWidth < menuObj.maxItemWidth){
					menuObj.maxSubMenuWidth = menuObj.maxItemWidth;
				}else{
					menuObj.maxSubMenuWidth = menuObj.maxGroupWidth;
				}
				
				menuObj.maxSubMenuWidth += 10;
				menuObj.subMenu.css('width',''+menuObj.maxSubMenuWidth+'px');
				
				if(!menuObj.topItemHovered){
					if(menuObj.isDirRTL){
						menuObj.subMenu.css('left', (menuObj.topItemAbsPos.left + (menuObj.topItemAbsPos.width - menuObj.subMenu[0].offsetWidth))+'px');
					}else{
						menuObj.subMenu.css('left', (menuObj.topItemAbsPos.left)+'px');
					}
					menuObj.subMenu.css('top', (menuObj.topItemAbsPos.top + menuObj.topItemAbsPos.height - 1)+'px');
				}else{
					var raquoElement = $('.raquo', this)[0], 
						leftPosition = (Runner.getAbsolutePosition(raquoElement, 1).left + raquoElement.offsetWidth - Runner.getAbsolutePosition(this,1).left + 10);
					if($(this).outerWidth() < leftPosition)
						leftPosition = $(this).outerWidth() - 1;
					menuObj.subMenu.css('top', this.offsetTop + 'px');
					menuObj.subMenu.css('left', leftPosition + 'px');
				}
				
				$('li[parent='+(menuObj.subMenu.attr('id'))+']', menuObj.subMenu).each(function(){
					$(this).css('width', menuObj.maxSubMenuWidth+'px');
					if(menuObj.isDirRTL){
						$('ul:first', this).css('right', menuObj.maxSubMenuWidth+'px');
					}else{
						$('ul:first', this).css('left', menuObj.maxSubMenuWidth+'px');
					}
				});
				
				menuObj.topItemHovered = true;
				menuObj.itemHovered = true;
				//redraw shadow
				setTimeout(function(){
					if(Runner.menu.Horizontal.prototype.itemHovered){
						//Runner.menu.Horizontal.prototype.subMenu.redrawShadow();
						Runner.menu.Horizontal.prototype.itemHovered = false;
					}
				},150);
			}
		},
		function(){
			menuObj.itemHovered = false;
			menuObj.manageActiveClass(this, false);
			$('ul:first', this).css('display','none'); 
		//	$('ul:first', this).removeShadow();
		});
		
		$('.runner-hmenu td, .runner-hmenu ul li').click(this.itemClickHandler);
	},	
	
	/**
	 * Set raquo for top items which has submenus
	 */	
	setRaquoToTopItems: function(){	
	
		$('a:first', '.runner-hmenu td:has(ul:has(li)), .runner-hmenu li:has(ul:has(li))').each(function(){
			if(!$('b',this).length){
				$(this).after('<b class="raquo">&nbsp;&raquo;</b>');
			}
		});
		//if submenus of top item has current item, then add current item title to top item after raquo 
		var curTopItem = $('.runner-hmenu td[view=topitem]:has(ul:has(li.current))');
		$('b.raquo:first', curTopItem).append("&nbsp;<b class='subcur'>" + $(".runner-hmenu .curlink").attr('title') + "</b>");
		$('tr.runner-menutab', curTopItem).addClass('current');
		$('.runner-hmenu ul li ul li ul').css('top','0px');
	}
});

/**
 * @class Runner.menu.SimpleVmenu
 * Abstract base class that provides vertical simple menu functionality. 
 */
Runner.menu.SimpleVmenu = Runner.extend(Runner.menu.Manager,{
	/**
	 * Was item hovered or not
	 * @type Boolean
	 */
	itemHovered: false,
	/**
	 * Was top item hovered or not
	 * @type Boolean
	 */
	topItemHovered: false,
	/**
	 * Absolute posution for top item
	 * @type object
	 */
	topItemAbsPos: null,
	/**
	 * Sub menu for hovered item
	 * @type object
	 */
	subMenu: null,
	
	init: function(){
		Runner.menu.SimpleVmenu.superclass.init.call(this);
		this.bindHoverOnItems();
		this.setRaquoToTopItems();
		$(".runner-vmenu.simple:first").prop("initialized","true");
	},
	
	/**
	 * Find sub menu for item
	 * @param {obj} elem
	 */
	findSubMenu: function(elem){
		this.subMenu = $('ul:first:has(li)', elem);
	},
	
	/**
	 * Manage add/remove class Active
	 * @param {obj} elem
	 * @param {boolean} toggle
	 */
	manageActiveClass: function(elem ,toggle){
		if(!$(elem).hasClass('Separator')){
			$(elem).toggleClass('active', toggle);
		}
	},
	
	/**
	 * Bind hover event on every menu item
	 * For hovered items add class 'active'
	 * For items losted hover event remove class 'active'
	 */
	bindHoverOnItems: function(){
		var menuObj = this;
		
		// hover handlerIn function 
		$('.runner-vmenu.simple, .runner-vmenu.simple ul li').hover(function(){
			menuObj.manageActiveClass(this, true);
			menuObj.findSubMenu(this); 
			var	vScroll = 0; // vertical scrolling 
				//leftInd = 1, // left indent for submenu and shadow
				//topInd = 2; // top indent for submenu and shadow
			
			if(menuObj.subMenu.length){
				menuObj.subMenu.css('display','block');
				if(menuObj.isDirRTL && $.browser.msie){
					$('.runner-vmenu.simple li.Separator[parent='+menuObj.subMenu.attr('id')+']', menuObj.subMenu).each(function(){
						$(this).addClass('runner-hiddenelem');
					});
				}
				var subMenuOfW = menuObj.subMenu[0].offsetWidth;
				
				// if hovered top item
				if($(this).attr('view')=='topitem'){
					//get absolute position for top item
					menuObj.topItemAbsPos = Runner.getAbsolutePosition(this, 1);
					menuObj.topItemHovered = false;
				}
				// add scrolling
				if(!$.browser.msie && (menuObj.subMenu[0].offsetHeight + menuObj.topItemAbsPos.top) > document.body.clientHeight){
					vScroll = 10;
				}
				//find raquo element in current menu item and it's left position
				var raquoElement = $('.raquo', this)[0],
					requoAbsPosLeft = Runner.getAbsolutePosition(raquoElement, 1).left,
					requoAbsPosRight = Runner.getAbsolutePosition(raquoElement, 1).right;
					
				// set position for submenu
				if(!menuObj.topItemHovered){
					if(menuObj.isDirRTL){
						//menuObj.subMenu.css('left', (requoAbsPosLeft - subMenuOfW + vScroll - 10)+'px');
						menuObj.subMenu.css('right',''+(this.offsetWidth - vScroll)+'px')
					}else{
						menuObj.subMenu.css('left', (requoAbsPosLeft + raquoElement.offsetWidth - vScroll + 10)+'px');	
					}
					menuObj.subMenu.css('top',''+(menuObj.topItemAbsPos.top)+'px');
				}else{
					menuObj.subMenu.css('top',''+this.offsetTop+'px');
					// Need get more specific about "document.dir"! Now this "if" can be working not correct 
					if(menuObj.isDirRTL){
						menuObj.subMenu.css('right',''+(this.offsetWidth - vScroll)+'px');
					}else{
						menuObj.subMenu.css('left',''+(requoAbsPosLeft - Runner.getAbsolutePosition(this, 1).left - vScroll + raquoElement.offsetWidth + 4)+'px');
					}
				}
				//if right-to-left orientation in document
				if(menuObj.isDirRTL){
					//leftInd = -2;
					if($.browser.msie){
						$('.runner-vmenu.simple li.Separator[parent='+menuObj.subMenu.attr('id')+']', menuObj.subMenu).each(function(){
							$(this).css('width',''+subMenuOfW+'px');
							$(this).show();
						});
					}
				}
				//Now the shadow for menu dont show
				//init draw shadow for submenu
				/*menuObj.subMenu.dropShadow({
					left: leftInd, 
					top: topInd, 
					blur: 2, 
					opacity: 0.4
				});*/
				
				menuObj.itemHovered = true;
				menuObj.topItemHovered = true;
				
				//redraw shadow for item
				setTimeout(function(){
					if(Runner.menu.SimpleVmenu.prototype.itemHovered){
						//Runner.menu.SimpleVmenu.prototype.subMenu.redrawShadow();
						Runner.menu.SimpleVmenu.prototype.itemHovered = false;
					}
				},150);
			}
		},
		// hover handlerInOut function
		function(){
			menuObj.findSubMenu(this);
			menuObj.itemHovered = false;
			menuObj.manageActiveClass(this, false);
			
			if(menuObj.subMenu.length){
				menuObj.subMenu.css('display','none');
				//menuObj.subMenu.removeShadow();
			}
		});
		
		$('.runner-vmenu.simple, .runner-vmenu.simple ul li').click(this.itemClickHandler);
	},
	
	/**
	 * Set raquo for top items which has submenus
	 */
	setRaquoToTopItems: function(){
		
		$('.runner-vmenu.simple:has(ul:has(li)), .runner-vmenu.simple li:has(ul:has(li))').find('a:first').each(function(){
			if(!$('b',this).length){
				$(this).after('<b class="raquo">&nbsp;&raquo;</b>');
			}
		});
		//if submenus of top item has current item, then add current item title to top item after raquo 
		var curTopItem = $('.runner-vmenu.simple[view=topitem]:has(ul:has(li.current))');
		curTopItem.find("b.raquo:first").append("&nbsp;<b class='subcur'>"+$(".runner-vmenu.simple a.curlink").attr('title')+"</b>");
		curTopItem.addClass('current');
	}

});

/**
 * @class Runner.menu.TreeLikeVmenu
 * Abstract base class that provides vertical tree-like menu functionality. 
 */
Runner.menu.TreeLikeVmenu = Runner.extend(Runner.menu.Manager,{
	/**
	 * Cookie root
	 */
	cookieRoot: "",	
	/**
	 * Current item
	 */
	curItem: null,
	/**
	 * Id of current item
	 */
	curItemId: "",
	/**
	 * Level of current item
	 */
	curItemLevel: -1,
	
	init: function(){
		if($('.runner-vmenu.tree .curlink').length){
			this.curItem = $('.runner-vmenu.tree .curlink').closest('tr');
			this.curItemId = $(this.curItem).attr('id');
			this.curItemLevel = this.getItemLevel(this.curItem);
		}
		//hide all submenus
		$('.runner-vmenu.tree[parent]').addClass('runner-hiddenelem');
		
		//init menu
		this.bindHoverOnItems();
		this.setCurrentStyle();
		this.toggleMenuGroup();
		this.manageExpandCollapse();
		
		//open menu group saved in cookie
		this.openMenuOnLoad();
		$(".runner-vmenu.tree:first").prop("initialized","true");
	},
	
	/**
	 * Get menu item level
	 * There are 5 levels in tree like menu
	 * Top items have zero level
	 * Default value -1, level is not define
	 * @param {object} jquery item object
	 * @return {number} number of level
	 */
	getItemLevel: function(item){
		var clsItem = $(item).attr('class'),
			pos = clsItem.indexOf("level");
		//if not found level, return zero - top item
		if(pos == -1){
			return 0;
		}
		//cut number of level, parse it to int and return number
		return parseInt(clsItem.substr(pos+5, 1), 10);
	},
	
	/**
	 * Bind hover event on every menu item
	 * For hovered items add class 'active'
	 * For items losted hover event remove class 'active'
	 */
	bindHoverOnItems: function(){
		$('.runner-vmenu.tree[id^=item]').hover(function(){
			if($(this).parent().attr('class')!='Separator'){
				$(this).addClass('active');
			}
		},
		function(){
			if($(this).parent().attr('class')!='Separator'){
				$(this).removeClass('active'); 
			}
		});
		
		$('.runner-vmenu.tree[id^=item]').click(this.itemClickHandler);
	},
	
	/**
	 * Set current style for top group
	 * which has current item in children
	 */
	setCurrentStyle: function(){
		$('.runner-vmenu.tree.Group[view=topitem]').each(function(){
			var group = this;
			$('.runner-vmenu.tree[topparent='+this.id+']').each(function(){
				if($(this).hasClass('current')){
					$(group).addClass('current');
				}
			});
		});
	},
	
	/**
	 * Bind click event on span to toggle menu group
	 */
	toggleMenuGroup: function(){
		var menuObj = this;
		
		$('.runner-vmenu.tree.Group span').click(function(){
			
			var spanItem = $(this).closest("tr"),
				spanItemId = spanItem.attr('id');
			
			if ($('.groupImg',this).attr('src') == Runner.pages.constants.PLUS_GIF){
				//show all children to the current item
				menuObj.showGroupChildren(spanItem, spanItemId);
			}
			else if($('.groupImg',this).attr('src') == Runner.pages.constants.MINUS_GIF){
				
				//hide all children of closed group
				menuObj.hideGroupChildren(spanItem, spanItemId);
				
				if(spanItemId!=menuObj.curItemId && menuObj.curItemLevel > menuObj.getItemLevel(spanItem) && menuObj.hasCurrentItem(spanItem, spanItemId)){
					spanItem.addClass('current');
				}
			}
			return false;
		});
	},
	
	/**
	 * Show all children of closed group
	 * If this group has current item,
	 * then show all groups in this group, which has current item 
	 * @param {object}
	 */
	showGroupChildren: function(item, itemId){
		var menuObj = this;
		if(!itemId){
			itemId = $(item).attr('id');
		}
		
		//set image minus for closed group
		$('.groupImg',item).attr('src', Runner.pages.constants.MINUS_GIF);
		
		if(itemId!=this.curItemId && $(item).hasClass('current'))
			$(item).removeClass('current');
		
		$('.runner-vmenu.tree[parent='+itemId+']').each(function(){
			$(this).removeClass('runner-hiddenelem');
			if($(this).hasClass('Group') && menuObj.curItemLevel > menuObj.getItemLevel(this) && menuObj.hasCurrentItem(this)){
				menuObj.showGroupChildren(this);
			}
		});
		
		// add to cookie opened group
		this.addToCookie(itemId);
	},
	
	/**
	 * Hide all children of group
	 * @param {object}
	 */
	hideGroupChildren: function(item, itemId){
		var menuObj = this;
		if(!itemId){
			itemId = $(item).attr('id');
		}
		
		//set image plus for closed group
		$('.groupImg',item).attr('src', Runner.pages.constants.PLUS_GIF);
		
		$('.runner-vmenu.tree[parent='+itemId+']').each(function(){
			$(this).addClass('runner-hiddenelem');
			if($(this).hasClass('Group'))
				menuObj.hideGroupChildren(this);
		});
		
		// remove from cookie closed group
		this.removeFromCookie(itemId);
	},
	
	/**
	 * Check has item in children current item or not
	 * @param {object}
	 * @return {boolean}
	 */	
	hasCurrentItem: function(item, itemId){
		if(!itemId){
			itemId = $(item).attr('id');
		}
		if($('.runner-vmenu.tree.[parent='+itemId+']').hasClass('current'))			
			return true;
		
		var colSubGroups = $('.runner-vmenu.tree.Group.[parent='+itemId+']').length;
		for(var i=0; i<colSubGroups;i++){
			if(this.hasCurrentItem($('.runner-vmenu.tree.Group.[parent='+itemId+']').get(i)))			
				return true;
		}
		return false;
	},
	
	/**
	 * Menage group menu with expand/collapse button control
	 */
	manageExpandCollapse: function(){
		
		var menuObj = this,
			expand = false;
		
		if($('.runner-vmenu.tree.Group[view=topitem]').length){
			$('.manage').css('display','inline');
			$('.manage a').click(function(){
				if(expand){
					expand = false;
					
					$('.runner-vmenu.tree[parent]').addClass('runner-hiddenelem');
					$('.manage a').empty();
					$('img.groupImg').attr('src', Runner.pages.constants.PLUS_GIF);
					$('.manage a').append('<img src=\"' + Runner.pages.constants.PLUS_GIF + '\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_EXPAND_ALL);
					
					// on collapse all, remove all ids from cookie
					delete_cookie('openMenuGroupIds', menuObj.cookieRoot, '');
					
					if(menuObj.curItem){
						$('#'+menuObj.curItem.attr('topparent')).addClass('current');
					}
				}else{
					expand = true;
					
					$('.runner-vmenu.tree[parent]').removeClass('runner-hiddenelem');
					$('.manage a').empty();
					$('img.groupImg').attr('src',Runner.pages.constants.MINUS_GIF);
					$('.manage a').append('<img src=\"' + Runner.pages.constants.MINUS_GIF 
							+ '\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_COLLAPSE_ALL);
					
					// on expand all add all group ids to cookie
					$('.runner-vmenu.tree.Group').each(function(){
						menuObj.addToCookie(this.id);
					});
					
					if(menuObj.curItem){
						$('#'+menuObj.curItem.attr('topparent')).removeClass('current');
					}	
				}
				return false; 
			});
		}
	},
	
	/**
	 * Find cookie root
	 * Use for open menu groups on page load
	 */
	findCookieRoot: function(){
		var cutFrom = document.location['pathname'].indexOf('/', 1);
		this.cookieRoot = document.location['pathname'].substr(0,(cutFrom+1));
	},
	
	/**
	 * Add opened menu group id to cookie
	 * @param {string} group id
	 */
	addToCookie: function(menuGroupId){
		var openMenuGroupIds = get_cookie('openMenuGroupIds');
		
		if (openMenuGroupIds){
			if (openMenuGroupIds.indexOf(menuGroupId) == -1)
				openMenuGroupIds += ";"+menuGroupId;
		}else
			openMenuGroupIds = menuGroupId;
		
		set_cookie('openMenuGroupIds', openMenuGroupIds, '', this.cookieRoot, '', '' );
		this.toggleExpandCollapse();
	},
	
	/**
	 * Remove opened menu group id from cookie
	 * @param {string} group id
	 */ 
	removeFromCookie: function(menuGroupId){
		var openMenuGroupIds = get_cookie('openMenuGroupIds');
		
		if (openMenuGroupIds){
			openMenuGroupIds = openMenuGroupIds.replace((";"+menuGroupId), "");
			openMenuGroupIds = openMenuGroupIds.replace(menuGroupId, "");
		
			if(openMenuGroupIds.indexOf(';')==0)
				openMenuGroupIds = openMenuGroupIds.substr(1,openMenuGroupIds.length);
			
			set_cookie('openMenuGroupIds', openMenuGroupIds, '', this.cookieRoot, '', '' );
		}
		
		setTimeout(function(){
			Runner.menu.TreeLikeVmenu.prototype.toggleExpandCollapse();
		},500);
	},
	
	/**
	 * Expand/Collapse button control
	 * If all menu groups was opened then change img for minus
	 * Else if all menu groups was closed then change img for minus
	 */
	toggleExpandCollapse: function(){
		var visibleLength = $(".runner-vmenu.tree.subitem:visible").length,
			hiddenLength = $(".runner-vmenu.tree.subitem:hidden").length;
		
		if (visibleLength == 0 && hiddenLength > 0){
			$('.manage a').empty();
			$('.groupImg').attr('src', Runner.pages.constants.PLUS_GIF);
			$('.manage a').append('<img src=\"' + Runner.pages.constants.PLUS_GIF + '\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_EXPAND_ALL);	
		}
		else if (visibleLength != 0 && hiddenLength == 0){
			$('.manage a').empty();
			$('.groupImg').attr('src', Runner.pages.constants.MINUS_GIF);
			$('.manage a').append('<img src=\"' + Runner.pages.constants.MINUS_GIF + '\" border=0> &nbsp;&nbsp;'+Runner.lang.constants.TEXT_COLLAPSE_ALL);
		}
	},
	
	/**
	 * Open menu's group on page after load
	 */
	openMenuOnLoad: function(){
		this.findCookieRoot();
		var openMenuGroupIds = get_cookie('openMenuGroupIds');
		if (openMenuGroupIds){
			var groupForOpenArr = openMenuGroupIds.split(";");
			for (var i = 0; i < groupForOpenArr.length; i++){
				if(groupForOpenArr[i].indexOf('item') == -1){
					continue;
				}
				var group = $('#'+groupForOpenArr[i]);
				group.removeClass('runner-hiddenelem');
				$('.runner-vmenu.tree[parent='+groupForOpenArr[i]+']').removeClass('runner-hiddenelem');
				$(".groupImg", group).attr("src", Runner.pages.constants.MINUS_GIF);
			}
			this.afterOpenMenuOnLoad();
		}
		this.toggleExpandCollapse();
	},
	
	/**
	 * Set current style to opened group after open menu on load
	 * @param {object}
	 */
	afterOpenMenuOnLoad: function(item){
		if(typeof item == 'undefined'){
			if(this.curItem)
				item = this.curItem;
			else
				return;
		}
		//if item topItem 
		if(item.attr('view') == 'topitem')
			return;
		//remove current class from top item
		$('#'+item.attr('topparent')).removeClass('current');
		//get item parent
		var itemPar = $('#'+item.attr('parent'));
		//if parent open, then check recursively next parent 
		if($(".groupImg", itemPar).attr('src') == Runner.pages.constants.PLUS_GIF){
			itemPar.addClass('current');
			if(itemPar.attr('view')!='topitem'){
				this.afterOpenMenuOnLoad(itemPar);
			}
		}
	}
	
});


/**
 * @class Runner.controls.constants
 */
Runner.controls.constants = {
	/**
	 * View format constants
	 * @type String
	 */
	FORMAT_NONE: '',	
	FORMAT_DATE_SHORT: "Short Date",	
	FORMAT_DATE_LONG: "Long Date",
	FORMAT_DATE_TIME: "Datetime",
	FORMAT_TIME: "Time",
	FORMAT_CURRENCY: "Currency",
	FORMAT_PERCENT: "Percent",
	FORMAT_HYPERLINK: "Hyperlink",
	FORMAT_EMAILHYPERLINK: "Email Hyperlink",
	FORMAT_FILE_IMAGE: "File-based Image",
	FORMAT_DATABASE_IMAGE: "Database Image",
	FORMAT_DATABASE_FILE: "Database File",
	FORMAT_FILE: "Document Download",
	FORMAT_LOOKUP_WIZARD: "Lookup wizard",
	FORMAT_PHONE_NUMBER: "Phone Number",
	FORMAT_NUMBER: "Number",
	FORMAT_HTML: "HTML",
	FORMAT_CHECKBOX: "Checkbox",
	FORMAT_MAP: "Map",
	FORMAT_CUSTOM: "Custom",
	/**
	 * edit format constants
	 * @type String
	 */
	EDIT_FORMAT_NONE: "",
	EDIT_FORMAT_TEXT_FIELD: "Text field",
	EDIT_FORMAT_TEXT_AREA: "Text area",
	
	EDIT_FORMAT_RTE: "RTE",
	EDIT_FORMAT_RTEINNOVA: "RTEINNOVA",
	EDIT_FORMAT_RTECK: "RTECK",
	
	EDIT_FORMAT_PASSWORD: "Password",
	EDIT_FORMAT_DATE: "Date",
	//Date control types
	EDIT_DATE_SIMPLE: 0,
	EDIT_DATE_SIMPLE_DP: 11,
	EDIT_DATE_DD: 12,
	EDIT_DATE_DD_DP: 13,
	//eo Date control types
	EDIT_FORMAT_TIME: "Time",
	EDIT_FORMAT_RADIO: "Radio button",
	EDIT_FORMAT_CHECKBOX: "Checkbox",
	EDIT_FORMAT_DATABASE_IMAGE: "Database image",
	EDIT_FORMAT_DATABASE_FILE: "Database file",
	EDIT_FORMAT_FILE: "Document upload",
	EDIT_FORMAT_LOOKUP_WIZARD: "Lookup wizard",
	EDIT_FORMAT_HIDDEN: "Hidden field",
	EDIT_FORMAT_READONLY: "Readonly",
	
	/**
	 * Lookup wizard constants
	 */
	
	LCT_DROPDOWN: 0,
	LCT_AJAX: 1,
	LCT_LIST: 2,
	LCT_CBLIST: 3,
	LCT_RADIO: 4,
	
	LT_LISTOFVALUES: 0,
	LT_LOOKUPTABLE: 1,
	LT_CUSTOM: 2,
	
	
	MODE_ADD: 0,
	MODE_EDIT: 1,
	MODE_SEARCH: 2,
	MODE_LIST: 3,
	MODE_PRINT: 4,
	MODE_VIEW: 5,
	MODE_INLINE_ADD: 6,
	MODE_INLINE_EDIT: 7,
	MODE_EXPORT: 8
};
/**
 * @class Runner.Event
 * Abstract base class that provides event functionality. 
 * Example of usage:
	Employee = function(name){
		this.name = name;
		this.addEvent(["blur", "change"]);
		this.init();
	}
	Runner.extend(Employee, Runner.Event);
===================================================================
Predefined, javascript events:
	abort	  - Loading of an image is interrupted
	blur	  - An element loses focus
	change	  - The user changes the content of a field
	click	  - Mouse clicks an object
	dblclick  - Mouse double-clicks an object
	error	  - An error occurs when loading a document or an image
	focus	  - An element gets focus
	keydown   - A keyboard key is pressed
	keypress  - A keyboard key is pressed or held down
	keyup	  - A keyboard key is released
	load	  - A page or an image is finished loading
	mousedown - A mouse button is pressed
	mousemove - The mouse is moved
	mouseout  - The mouse is moved off an element
	mouseover - The mouse is moved over an element
	mouseup	  - A mouse button is released
	reset	  - The reset button is clicked
	resize	  - A window or frame is resized
	select	  - Text is selected
	submit	  - The submit button is clicked
	unload	  - The user exits the page
*/

Runner.Event = Runner.extend(Runner.emptyFn,{
	/**
	 * Array of predefined events
	 * @type {array}
	 */
	events: null,
	/**
	 * Array of predefined listeners
	 * @type {array}
	 */
	listeners: null,
	/**
	 * Array of elements, on which listeners should be added
	 * @type {array}
	 */
	elemsForEvent: null,
	/**
	 * Array of events that are suspended for this control
	 * @type {array}
	 */
	suspendedEvents: null,
	/**
	 * @constructor
	 */
	constructor: function(){
		// recreate objects, to prevent memory mix
		this.listeners = [];
		this.elemsForEvent = [];
		this.suspendedEvents = [];
	},
	/**
	 * Init method, should be called by class contructor, for event initialization
	 * @method
	 */	
	init: function(){
		if (this.events.length == 0){
			return false;
		}
		for(var i=0;i<this.events.length;i++){
			// pass event name and event standard handler
			if (typeof this[this.events[i]] == "function"){
				this.on(this.events[i], this[this.events[i]]);
			}else if (typeof this[this.events[i]] == "object"){
				this.on(this.events[i], this[this.events[i]].fn, this[this.events[i]].options, this[this.events[i]].scope);
			}
		}
		return true;
	},
	
	suspendEvent: function(eventArr){
		for(var i=0;i<eventArr.length;i++){
			if (!this.suspendedEvents.isInArray(eventArr[i])){
				this.suspendedEvents.push(eventArr[i]);
			}
		}
	},
	
	resumeEvent: function(eventArr){
		var eventInd = -1;
		for(var i=0;i<eventArr.length;i++){
			eventInd = this.suspendedEvents.getIndexOfElem(eventArr[i]);
			if (eventInd != -1){
				this.suspendedEvents.splice(eventInd, 1);
			}
		}
	},
	
	createDelayed: function(handler, timeout){
		return function(){
			var obj = this, args = Array.prototype.slice.call(arguments);
			setTimeout(function(){
				handler.apply(obj, args);
			}, timeout || 10);
		};
	},
	
	createBuffered: function(handler, buffer){
		var task = new Runner.util.DelayedTask(handler);
		return function(){
			task.delay(buffer, handler, null, Array.prototype.slice.call(arguments));
		};
	},
	
	createSingle: function(handler, eventName){
		var obj = this;
		return function(){
			handler.apply(obj, Array.prototype.slice.call(arguments));
			obj.unbindHn(eventName, arguments.callee);
		};
	},
	
	bindHn: function(eventName, callHandler){
		if (!callHandler || !eventName){
			return false;
		}
		var el;
		// adding listeners for all elems for event
		for(var i=0;i<this.elemsForEvent.length;i++){
			el = this.elemsForEvent[i];
			$(el).bind(eventName, {hn: callHandler, obj: this}, callHandler);
		}
		return true;
	},
	
	unbindHn: function(eventName, callHandler){
		if (!callHandler || !eventName){
			return false;
		}
		var el;
		// remove listeners for all elems for event	
		for (var j = 0; j < this.elemsForEvent.length; j++) {
			el = this.elemsForEvent[j];
			$(el).unbind(eventName, callHandler);
		}
		return true;
	},
	/**
	 * Add events to the object. Events names should be similar to predefined
	 * javascript DOM element event names.
	 * @method
	 * @param {string} eventName
	 * @param {link} fn
	 * @param {array} options.args Optional. Array of arguments, that should be passed to event handler
	 * @param {bool} options.single Optional. Pass true to fire event only once
	 * @param {int} options.timeout Optional. Pass number of miliseconds to create delayed handler
	 * @param {int} options.buffer Optional. Pass number of miliseconds to buffer. Usefull for keypress events and validations. Not fully work at now.
	 * @param {link} scope
	 */
	on: function(eventName, fn, options, scope){
		// if no DOM elems as event targets, then stop adding event
		if (!this.elemsForEvent.length || !fn){
			return false;
		}
		eventName = eventName.toLowerCase();
		//add event to event array, if needed
		this.addEvent([eventName]);
		// prepare event name, for DOM scpecifications
		var onEventName = "";
		if (eventName.indexOf("on", 0) == 0){
			onEventName = eventName;
			eventName = eventName.substring(2);
		}else{
			onEventName = "on"+eventName;
		}
		// predefine scope and func params for creating closure
		var scope = scope ? scope : this, objScope = this, options = options ? options : {};
		// predefine additional params
		var args = options.args ? options.args : [], 
			single = options.single ? options.single : false, 
			timeout = options.timeout ? options.timeout : 0, 
			buffer = options.buffer ? options.buffer : 0;
		
		var callHandler = function(e){
			// prevent call if event suspended 
			if (objScope.suspendedEvents.isInArray(eventName)){
				return;
			}
			var newArgs = Array.prototype.slice.call(arguments);
			//the order of arguments: 
			//	event object, 
			//	arguments passed to event handler, 
			//	arguments passed to fire event
			fn.apply(scope, newArgs.slice(0,1).concat(args).concat(newArgs.slice(1)));
		}
		// creating delayed handler, usefull for validations etc.
		if (timeout){
			callHandler = this.createDelayed(callHandler, timeout);
		}
		// function will clear itself after called, usefull when function need to be called once
		if(single){
			callHandler = this.createSingle(callHandler, eventName)
		}
		if(buffer){
			callHandler = this.createBuffered(callHandler, buffer);
		}
		
		this.listeners.push({
			name: eventName,
			handler: fn,
			callHandler: callHandler,
			options: options,
			scope: scope,
			index: this.listeners.length
		});
		
		this.bindHn(eventName, callHandler);
		return true;
	},
	/**
	 * Add events to object, make list of predefined events, before call init method
	 * @method
	 * @param {array} eventNameArr
	 */
	addEvent: function(eventNameArr){
		if (!this.events){
			this.events = [];
		}
		// lazy init func
		this.addEvent = function(eventNameArr){
			for(var i=0;i<eventNameArr.length;i++){
				// check if this event already added
				if (!this.events.isInArray(eventNameArr[i])){
					this.events.push(eventNameArr[i]);
				}
			}
		}
		this.addEvent(eventNameArr);
	},
	/**
	 * Kill event handling, sets empty fn as handler
	 * @method
	 * @param {string} eventName
	 * @return {bool} true if success otherwise false
	 */
	killEvent: function(eventName){
		var eventInd = this.isDefinedEvent(eventName);
		if (eventInd == -1){
			return false;
		}
		this.clearEvent(eventName);
		// remove native event handler
		this.unbindHn(eventName, this[eventName]);
		// delete event handler from object
		delete this[eventName];
		//kill event
		this.events.splice(eventInd, 1);
		// in success
		return true;
	},
	
	purgeListeners: function(){
		for(var i=0; i<this.events.length; i++){
			this.killEvent(this.events[i]);
		}
	},
	/**
	 * Clear custom event handling, sets only base class handler
	 * @method
	 * @param {string} eventName
	 * @return {bool} true if success otherwise false
	 */
	clearEvent: function(eventName){
		// search for listener object
		var listeners = this.getListeners(eventName);
		
		for(var i=0; i<listeners.length; i++){
			// clear handlers
			this.unbindHn(eventName, listeners[i].callHandler);
			this.listeners.splice(i,1);
		}	
		return true;
	},
	
	stopEvent: function(e) {
		this.stopPropagation(e);
		this.preventDefault(e);
	},
	
	stopPropagation: function(e) {
		e = this.getEvent(e);
		if (e && e.stopPropagation){
			e.stopPropagation();
		}else if(e){
			e.cancelBubble = true;
		}
	},
	
	preventDefault: function(e) {
		e = this.getEvent(e);
		if(e && e.preventDefault){
			e.preventDefault();
		}else if(e){
			e.returnValue = false;
		}
	},
	
	getEvent: function(e) {
		return e || window.event;
	},
	
	getTarget: function(e){
		if (e){
			return e.target || e.srcElement;
		}
	},
	
	/**
	 * Fires the specified event with the passed parameters (minus the event name).
	 * @param {String} eventName
	 * @return {bool} True if hadler called, otherwise false.
	 */
	fireEvent: function(eventName){
		var listeners = this.getListeners(eventName);
		for(var i=0; i<listeners.length; i++){
			// null - instead of event object
			listeners[i].callHandler.apply(this, [null].concat(Array.prototype.slice.call(arguments, 1)));
		}
		//The event execution from object's propertie was deleted, because it caused a double challenge this event
		//Properly should be, if all the events will be located in an array listeners
	},
	/**
	 * Checks if event defined
	 * @param {string} eventName
	 * @return {mixed} false if not found otherwise array index
	 */
	isDefinedEvent: function(eventName){
		return this.events.getIndexOfElem(eventName);
	},
	
	getListeners: function(eventName){
		var listeneresArr = [];
		for (var i = 0; i < this.listeners.length; i++) {
			if (this.listeners[i].name == eventName) {	
				listeneresArr.push(this.listeners[i]);
			}
		}
		return listeneresArr;
	}
});

/**
 * Global validtion object, that used to cheked controls values
 * @type {object}
 */
validation = {	
	/**
	 * Status of validator function. 
	 * @type {object} 
	 */
	validatorConsts:{
		predefined: 1,
		user: 2,
		notFound: 3
	},
	/**
	 * Array of names of user validation functions
	 */
	userValidators: [],
	/**
	 * Array of names of predefined validators 
	 * @type {array}
	 */
	predefinedValidatorsArr: ['isrequired' ,'isnumeric' ,'ispassword' ,'isemail' ,'ismoney', 'iszipcode', 'isphonenumber', 'isstate', 'isssn', 'iscc','istime', 'isdate', 'regexp'],
	/**
	 * Array of names of states for validate
	 * @type {array}
	 */
	arrStates: ['AL','AK','AS','AZ','AR','CA','CO','CT','DE','DC','FM','FL','GA','GU','HI','ID','IL','IN','IA','KS','KY','LA','ME','MH','MD','MA','MI','MN','MS','MO','MT','NE','NV',
				'NH','NJ','NM','NY','NC','ND','MP','OH','OK','OR','PW','PA','PR','RI','SC','SD','TN','TX','UT', 'VT','VI','VA','WA','WV','WI','WY'],
	/**
	 * Main function that provides object validation
	 * @param {array} validArr
	 * @param {object} control
	 * @return {object}
	 */
	validate: function(validArr, control){
		// total result obj
		var validationRes = false, validatorStatus, result = {result: true, messageArr: []};		
		// loop for all validation on obj
		for(var i=0;i<validArr.length;i++){	
			// to prevent check for undefined values, that mistically appears in IE!
			if (!validArr[i]){
				continue;
			}
			// get status of validator
			validatorStatus = this.getValidatorStatus(validArr[i]); 
			// custom user validation
			if(validatorStatus == this.validatorConsts.user){
				validationRes = window[control.validationArr[i]](control.getValue());
			// validation method in object
			}else if(validatorStatus == this.validatorConsts.predefined){				
				// for IsRequired use isEmpty method
				if(validArr[i] == "IsRequired"){
					// if field not passed IsRequired validation, we need to add text
					if (control.isEmpty()){
						validationRes = Runner.lang.constants.TEXT_INLINE_FIELD_REQUIRED;
					}else{
						validationRes = true;
					}
				}else{
					// pass regExp object as second param, for regExp method
					validationRes = this[validArr[i]](control.getValue(), control.regExp);
				}
			}else{
				validationRes = true;
			}
			// set to final result object
			result = this.setResult(validationRes, result);
		}
		// return result
		return result;
	},
	/**
	 * Check validator function status.
	 * @param {string} validatorName
	 * @return {string} property from validatorConsts object
	 */
	getValidatorStatus: function(validatorName){
		if(this.predefinedValidatorsArr.isInArray(validatorName)){
		//if(IsInArray(this.predefinedValidatorsArr, validatorName, false)){
			return this.validatorConsts.predefined;
		}else if(window[validatorName] && ((typeof(window[validatorName])=='function')||(Runner.isIE&&typeof(window[validatorName])=='object'))){
			return this.validatorConsts.user;
		}else{
			return this.validatorConsts.notFound;
		}
	},
	/**
	 * Set result to final result object
	 * @param {mixed} res result from any validation function true, or error text
	 * @param {object} obj final result object
	 * @return {object}
	 */
	setResult: function(res, obj){
		var len = obj.messageArr.length;		
		if(res!==true){
			// add message and set false to final result
			obj.result = false;
			// if res is array of messages, add each message to array
			if (typeof(res)=='object'){
				for(var i=0;i<res.length;i++){
					obj.messageArr.push(res[i]);
				}
			// add to message array if res is string
			}else{
				obj.messageArr.push(res);
			}				
		}
		return obj;
	},
	/**
	 * Handler loading custom validation function from file.
	 * @param {object} ctrl
	 */
	registerCustomValidation: function(ctrl){
		var validatorStatus;
		// loop for all validations
		for(var i=0;i<ctrl.validationArr.length;i++){		
			// to prevent check undefined vals
			if (!ctrl.validationArr[i]){
				continue;
			}
			// get validator status
			validatorStatus = this.getValidatorStatus(ctrl.validationArr[i]);			
			// if user vvalidator, and defined as function			
			if(validatorStatus == this.validatorConsts.user || validatorStatus == this.validatorConsts.notFound){			
				// check if was added
				var isAdded = false;
				for(var j=0;j<this.userValidators.length;j++){
					if(this.userValidators[j]==ctrl.validationArr[i]){
						isAdded=true;
						break;
					}
				}
				// add if not
				if(!isAdded){					
					// load js from file
					Runner.loadJS('include/validate/'+ctrl.validationArr[i]+'.js');
					// add to validation arr
					this.userValidators.push(ctrl.validationArr[i]);
				}
			}
		}
		
	},
	
	"IsRequired": function(sVal)
	{
		var regexp = /.+/;
		if(typeof(sVal)!='string')
			sVal = sVal.toString();
		if(!sVal.match(regexp) && !this.setRequired) 
		{
			this.setRequired = true;
			return Runner.lang.constants.TEXT_INLINE_FIELD_REQUIRED;
		}
		else
			return true;
			
	},
	
	"IsNumeric": function(sVal)
	{
		sVal = sVal.replace(/,/g,"");
		if(isNaN(sVal)) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_NUMBER;
		else
			return true;
	},
//	
	"IsPassword": function(sVal)
	{
		var regexp1 = /^password$/;
		var regexp2 = /.{4,}/;
		if(sVal.match(regexp1))
			return Runner.lang.constants.TEXT_INLINE_FIELD_PASSWORD1;
		else if(!sVal.match(regexp2)) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_PASSWORD2;		
		else
			return	true;	
	},

	"IsEmail": function(sVal)
	{
		var regexp = /^[A-z0-9_-]+([.][A-z0-9_-]+)*[@][A-z0-9_-]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_EMAIL;
		else
			return true;
	}, 
//	
	"IsMoney": function(sVal)
	{
		var regexp = /^(\d*)\.?(\d*)$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_CURRENCY;
		else
			return true;	
	},  
//	
	"IsZipCode": function(sVal)
	{
		var regexp = /^\d{5}([\-]\d{4})?$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_ZIPCODE;
		else
			return true;	
	},
//	
	"IsPhoneNumber": function(sVal)
	{
		var regexp = /^\(\d{3}\)\s?\d{3}\-\d{4}$/;		
		var stripped = sVal.replace(/[\(\)\.\-\ ]/g, '');    
		if(sVal.match(/.+/) && (isNaN(parseInt(stripped)) || stripped.length != 10) ) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_PHONE;
		else
			return true;
	},
//	
	"IsState": function(sVal)
	{
		if(sVal.match(/.+/) && !this.arrStates.isInArray(sVal)) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_STATE;
		else
			return true;
	}, 
//	
	"IsSSN": function(sVal)
	{
		// 123-45-6789 or 123 45 6789
		var regexp = /^\d{3}(-|\s)\d{2}(-|\s)\d{4}$/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_SSN;
		else
			return true;
	},
//	
	"IsCC": function(sVal)
	{
		//Visa, Master Card, American Express
		var regexp = /^((4\d{3})|(5[1-5]\d{2}))(-?|\040?)(\d{4}(-?|\040?)){3}|^(3[4,7]\d{2})(-?|\040?)\d{6}(-?|\040?)\d{5}/;
		if(sVal.match(/.+/) && !sVal.match(regexp) ) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_CC;
		else
			return true;
	},
//	
	"IsTime": function(sVal)
	{
		var regexp = /\d+/g;
		if(!sVal)
			return true;
		var arr = sVal.match(regexp);
		var bFlag = true;
		if(arr==null || arr.length > 3)  
			bFlag = false; 
		while(bFlag && arr.length < 3) 
			arr[arr.length] = 0; 
		if( bFlag && (arr[0]<0 || arr[0]>23 || arr[1]<0 || arr[1]>59 || arr[2]<0 || arr[2]>59) ) 
			bFlag = false; 
		if(!bFlag) 
			return Runner.lang.constants.TEXT_INLINE_FIELD_TIME;
		else
			return true;
	},
//
	"IsDate": function(sVal)
	{
		var fmt = "";
		switch (locale_dateformat){
			case 0 :
				fmt="MDY";
			break;
			case 1 : 
				fmt="DMY";
			break;	
			default:
				fmt="YMD";
			break;				
		};
		if(!this.isValidDate(sVal,fmt)){ 
			return Runner.lang.constants.TEXT_INLINE_FIELD_DATE;	
		}else{
			return true;
		}
	},
	
	"RegExp": function(sVal, regExpParamsObj){
		// create regExp obj		
		var re = new RegExp(regExpParamsObj.regex);
		// test against regExp
		if(sVal.length != 0 && (!re.test(sVal) || re.exec(sVal)[0] != sVal)){
			// return error text
			if(regExpParamsObj.messagetype == 'Text'){
				return regExpParamsObj.message;
			}else{
				return GetCustomLabel(regExpParamsObj.message);
			}
		}else{
			return true;
		}			
	},	
//		
	isValidDate: function(dateStr, format){
		if (format == null) 
			format = "MDY"; 
		format = format.toUpperCase();
		if (format.length != 3)  
			format = "MDY"; 
		if ((format.indexOf("M") == -1) || (format.indexOf("D") == -1) || (format.indexOf("Y") == -1) ) 
			format = "MDY"; 
		if (format.substring(0, 1) == "Y") 
		{ // If the year is first
			var reg1 = /^\d{2}(\-|\/|\.)\d{1,2}\1\d{1,2}$/;
			var reg2 = /^\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}$/;
		} 
		// If the year is second
		else if (format.substring(1, 2) == "Y"){ 
			var reg1 = /^\d{1,2}(\-|\/|\.)\d{2}\1\d{1,2}$/;
			var reg2 = /^\d{1,2}(\-|\/|\.)\d{4}\1\d{1,2}$/;
		// The year must be third
		}else{ 
				var reg1 = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{2}$/;
				var reg2 = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/;
			}
		// If it doesn't conform to the right format (with either a 2 digit year or 4 digit year), fail
		if ((reg1.test(dateStr) == false) && (reg2.test(dateStr) == false)) 
			return false; 
		var parts = dateStr.split(RegExp.$1); // Split into 3 parts based on what the divider was
		// Check to see if the 3 parts end up making a valid date
		if (format.substring(0, 1) == "M") 
			var mm = parts[0];  
		else if (format.substring(1, 2) == "M") 
			var mm = parts[1];  
		else	
			var mm = parts[2]; 
		if (format.substring(0, 1) == "D") 
			var dd = parts[0];  
		else if (format.substring(1, 2) == "D") 
			var dd = parts[1]; 
		else	
			var dd = parts[2]; 
		if (format.substring(0, 1) == "Y") 
			var yy = parts[0];  
		else if (format.substring(1, 2) == "Y") 
			var yy = parts[1];  
		else 
			var yy = parts[2]; 
		if (parseFloat(yy) <= 50) 
			yy = (parseFloat(yy) + 2000).toString();
		if (parseFloat(yy) <= 99) 
			yy = (parseFloat(yy) + 1900).toString(); 
		var dt = new Date(parseFloat(yy), parseFloat(mm)-1, parseFloat(dd), 0, 0, 0, 0);
		if (parseFloat(dd) != dt.getDate()) 
			return false; 
		if (parseFloat(mm)-1 != dt.getMonth()) 
			return false; 
	   return true;
	}
}
/**
 * Row control manager. Alows to add, delete and manage controls
 * Collection of control for the specific row
 * @class Runner.controls.RowManager
 */
Runner.controls.RowManager = Runner.extend(Runner.emptyFn, {
	/**
	 * Fields control collection 
	 * @param {object} fields
	 */
	fields: {},
	/**
	 * Id of row
	 * @type {int}
	 */
	rowId: -1,	
	/**
	 * Count of registred fields
	 * @param {int} fieldsCount
	 */
	fieldsCount: 0,
	/**
	 * Array of names of registered fields controls
	 * @type {array} control
	 */
	fieldNames: [],
	/**
	 * @constructor
	 * @param {int} rowId
	 */
	constructor: function(rowId){
		Runner.controls.RowManager.superclass.constructor.call(this, rowId);	
		this.fields = {};
		this.fieldNames = [];
		this.rowId = rowId;
	},
	
	/**
	 * Control to register
	 * @param {link} control
	 */
	register: function(control){	
		var controlName = control.fieldName;
		// if need to create new field
		if (!this.fields[controlName]) {			
			this.fields[controlName] = [];			
			this.fieldNames.push(controlName);
			this.fieldsCount++;			
		}
		// add control
		this.fields[controlName][control.ctrlInd] = control;
		/*if (control.secondCntrl){
			this.fields[controlName][1] = control;
		}else{
			this.fields[controlName][0] = control;
		}*/
		return true;		
	},
	/**
	 * Return control by following param
	 * @param {string} fName Pass false to get all controls of the row
	 * @param {int} controlIndex Pass false or null to get first control of the field
	 */
	getAt: function(fName, controlIndex){		
		// need to get all controls
		if (!fName){
			// array of row controls
			var rowControlsArr = [];
			// collect all controls from rowManager
			for(var i=0;i<this.fieldNames.length;i++){	
				// get all controls from field. Field may contain more then one
				for(var j=0;j< this.fields[this.fieldNames[i]].length;j++){
					// field control
					var fControl = this.getAt(this.fieldNames[i], j);
					// add to array
					rowControlsArr.push(fControl);
				}					
			}
			return rowControlsArr;
		}
		// if we need specific control
		if (!this.fields[fName]) {
			return false;
		}		
		return this.fields[fName][controlIndex];
	},
	/**
	 * Control which need to unregister
	 * @param {string} fName
	 */
	unregister: function(fName, controlIndex){
		// unreg all rows
		if (fName == null){
			for(var i=0;i<this.fieldsCount;i++){
				this.unregister(this.fieldNames[i], null);
				i--;
			}
			return true;
		// no such row
		}else if(!this.fields[fName]){
			return false;
		// unreg whole field
		}else if(controlIndex==null){
			for (var i=0;i<this.fields[fName].length; i++){
				this.unregister(fName, i);
			};			
			// delete fieldName from names arr
			for(var i=0;i<this.fieldsCount;i++){
				if (this.fieldNames[i]==fName){
					this.fieldNames.splice(i,1);						
					this.fieldsCount--;
				}
			}			
			delete this.fields[fName];
			return true;
		// unreg by params
		}else{
			// call object destructor
			if (this.fields[fName][controlIndex].destructor){
				this.fields[fName][controlIndex].destructor();
			}else if(this.fields[fName][controlIndex]["destructor"]){
				this.fields[fName][controlIndex]["destructor"]();
			}
			// remove from arr
			//this.fields[fName].splice(controlIndex, 1);
			delete this.fields[fName][controlIndex];
			return true;
		}
	},
	
	getMaxFieldIndex: function(fName){
		// if no field with such name
		if(!this.fields[fName]){
			return false;
		}
		
		return this.fields[fName].length;
	}
});
/** 
 * Table controls manager. Alows to add, delete and manage controls
 * Collection of control for the specific table.
 * @class Runner.controls.TableManager
 */
Runner.controls.TableManager = Runner.extend(Runner.emptyFn, {
	/**
	 * Row managers collection
	 * @param {object} rows
	 */
	rows: {},
	/**
	 * Name of table
	 * @type {String}
	 */
	tName: "",
	/**
	 * Count of registred rows
	 * @param {int} rowsCount
	 */
	rowsCount: 0,
	/**
	 * Ids of registered rows
	 * @type {array} control
	 */
	rowIds: [],
	/**
	 * Contructor
	 * @param {string} tName
	 */
	constructor: function(tName){
		this.tName = tName;
		this.rows = {};
		this.rowIds = [];
	},
	
	/**
	 * Control to register
	 * @param {#link} control
	 */
	register: function(control){		
		var controlId = control.id;
		// if need to create new row
		if (!this.rows[controlId]){
			this.rows[controlId] = new Runner.controls.RowManager(controlId);
			this.rowIds.push(controlId);
			this.rowsCount++;
		}
		// return register result
		return this.rows[controlId].register(control);
	},
	/**
	 * Return control by following params
	 * @param {string} rowId Pass false or null to get all controls of the table
	 * @param {string} fName Pass false or null to get all controls of the row
	 * @param {int} controlIndex Pass false or null to get first control of the field
	 */
	getAt: function(rowId, fName, controlIndex){		
		// if no rowId, then get all controls from table
		if (rowId==null){
			// array of controls for return
			var tableControlsArr = [];
			// collect all controls from rows managers
			for(var i=0;i<this.rowIds.length;i++){
				//get all controls of the row
				var rowControls = this.rows[this.rowIds[i]].getAt();
				// collect controls from row controls arr 
				for(var j=0;j<rowControls.length;j++){
					tableControlsArr.push(rowControls[j]);
				}	
			}
			return tableControlsArr;
		}
		// if row id defined, but no rows with such id
		if (!this.rows[rowId]) {
			return false;
		}
		// return result
		return this.rows[rowId].getAt(fName, controlIndex);	
	},
	/**
	 * Control which need to unregister
	 * @param {string} rowId
	 * @param {string} fName Pass false or null to clear all controls of the row
	 * @param {int} controlIndex Pass false or null to clear all control of the field
	 * @return {bool} true if success, otherwise false
	 */
	unregister: function(rowId, fName, controlIndex){		
		// unreg all rows
		if (rowId == null){
			for(var i=0;i<this.rowsCount;i++){
				this.rows[this.rowIds[i]].unregister(null, null);
			}
			return true;
		// no such row
		}else if(!this.rows[rowId]){
			return false;
		// unreg by params
		}else{
			var rowUnregStat = this.rows[rowId].unregister(fName, controlIndex);
			if (rowUnregStat && fName==null){
				// delete row id from ids arr
				for(var i=0;i<this.rowsCount;i++){
					if (this.rowIds[i]==rowId){
						this.rowIds.splice(i,1);						
						this.rowsCount--;
					}
				}
				// delete table object
				delete this.rows[rowId];
				return true;
			}else{
				return rowUnregStat;
			}
		}

	},
	
	getMaxFieldIndex: function(rowId, fName){
		// if no row with such id
		if(!this.rows[rowId]){
			return false;
		}
		
		return this.rows[rowId].getMaxFieldIndex(fName);
	}
});
/** 
 * Global control manager. Alows to add, delete and manage controls
 * Collection of controls for the specific table.
 * Should not be created directly, only one instance per page. 
 * Use its instance to get access to any control
 * @singleton
 * @class Runner.controls.ControlManager
 */
Runner.controls.ControlManager = function(){
	/**
	 * Table managers collection
	 * @type {object} private
	 */
	var tables = {};	
	/**
	 * Count of registred tables
	 * @type {int} private
	 */
	var tablesCount = 0;
	/**
	 * Names of registred tables
	 * @type {array} private
	 */
	var tableNames = [];
	
	
	return {
		/**
		 * Control to register
		 * @param {#link} control
		 */
		register: function(control){
			// return false if not control
			if (!control){
				return false;
			}
			// get table name
			var controlTable = control.table;		
			// if table not exists, create new one
			if (!tables[controlTable]){
				tables[controlTable] = new Runner.controls.TableManager(controlTable);	
				tableNames.push(controlTable);
				tablesCount++;		
			}
			// return register result
			return tables[controlTable].register(control);	
			
		},
		/**
		 * Returns control or array of controls by following params
		 * @param {string} tName
		 * @param {string} rowId Pass false or null to get all controls of the table
		 * @param {string} fName Pass false or null to get all controls of the row
		 * @param {int} controlIndex Pass false or null to get first control of the field
		 * @return {object} return control, array of controls or false
         * @intellisense
		 */
		getAt: function(tName, rowId, fName, controlIndex){
			
			// if no index passed we return control with 0 index
			controlIndex = controlIndex ? controlIndex : 0;
			
			if (tName === false){
				for(var i=0; i<tableNames.length;i++){
					var ctrl = tables[tableNames[i]].getAt(rowId, fName, controlIndex);
					if (ctrl !== false){
						return ctrl;
					}
				}
				return false;
			}
			
			// if table not exists
			if (!tables[tName]) {
				return false;
			}	
			
			// else return by params
			return tables[tName].getAt(rowId, fName, controlIndex);
		},
		
		/**
		 * Returns control or array of controls wich relevant to visible fields
		 * @param {string} tName
		 * @param {string} rowId Pass false or null to get all controls of the table
		 * @param {string} fName Pass false or null to get all controls of the row
		 * @param {int} controlIndex Pass false or null to get first control of the field
		 * @return {object} return control, array of controls or false
         * @intellisense
		 */
		getVisibleAt: function(tName, rowId, fieldName, controlIndex){
			var ctrls = this.getAt(tName, rowId, fieldName, controlIndex);
			var visibleCtrls = [];
			for(var i=0; i < ctrls.length; i++){
				if (ctrls[i] && !ctrls[i].hiddenByField)
					visibleCtrls[visibleCtrls.length] = ctrls[i];
			}
			return visibleCtrls;
		},
		
		/**
		 * Unregister control, row or table
		 * @param {string} tName
		 * @param {string} rowId Pass false or null to clear all controls of the table
		 * @param {string} fName Pass false or null to clear all controls of the row
		 * @param {int} controlIndex Pass false or null to clear first control of the field
		 * @return {bool} true if success, otherwise false
		 */
		unregister: function(tName, rowId, fName, controlIndex){	
			// if no table name passed, return false
			if (!tables[tName]) {
				return false;
			}			
			//controlIndex = controlIndex ? controlIndex : 0;			
			// recursively call unregister through table rows
			var tUnregStat = tables[tName].unregister(rowId, fName, controlIndex);
			// if delete whole table and recursive unreg call success
			if (tUnregStat && rowId==null){
				// delete table name from name arr
				for(var i=0;i<tablesCount;i++){
					if (tableNames[i]==tName){
						tableNames.splice(i,1);						
						tablesCount--;
					}
				}
				// delete table object
				delete tables[tName];
				return true;
			}else{
				return tUnregStat;
			}
		},
		
		getMaxFieldIndex: function(tName, rowId, fName){
			// if no table with such name
			if (!tables[tName]) {
				return false;
			}
			
			return tables[tName].getMaxFieldIndex(rowId, fName);
		},
		
		/**
		 * Resets all controls for specified table
		 * @method
		 * @param {string} tName
		 * @return {bool} true if success, otherwise false
		 */
		resetControlsForTable: function(tName){
			var cntrls = this.getAt(tName);
			if (!cntrls){
				return false;
			}
			var updContext = {
				"enableNextButtons":false,
				"resetHappend": true,
				"values":{}
			};
			for(var i=0;i<cntrls.length;i++){
				updContext.values[cntrls[i].fieldName] = cntrls[i].defaultValue;
			}
			for(var i=0;i<cntrls.length;i++){
				cntrls[i].reset(updContext);
			}
			return true;
		},
		
		/**
		 * Resets all controls for specified table
		 * @method
		 * @param {string} tName
		 * @return {bool} true if success, otherwise false
		 */
		clearControlsForTable: function(tName){
			var cntrls = this.getAt(tName);
			if (!cntrls){
				return false;
			}
			for(var i=0;i<cntrls.length;i++){
				if(typeof cntrls[i] != "undefined")
					cntrls[i].clear();
			}
			return true;
		}
	};
}();

// register new namespace
Runner.namespace('Runner.form');
/**
 * @class Runner.form.Button
 */
Runner.form.Button = Runner.extend(Runner.Event, {
	/**
	 * Control id
	 * @type string
	 */
	id: "",
	
	messContId: "",
	/**
	 * Message div container
	 * @type obj
	 */
	messageCont: null,
	/**
	 * jQuery object of button element
	 * @type {obj}
	 */
	elem: null,
	
	disableHandler: null,
	
	tagName: "",
	
	constructor: function(cfg){
		// copy properties from cfg to obj
		Runner.apply(this, cfg);
		//call parent
		Runner.form.Button.superclass.constructor.call(this, cfg);	
		// get button
		this.elem = $('#'+this.id);
		// create empty button, for correct script work, if button tag not exists 
		if (!this.elem.length){
			this.elem = document.createElement('INPUT');
			this.elem = $(this.elem).attr('type', 'button');
		}
		this.elemsForEvent = [this.elem.get(0)];
		this.tagName = this.elem[0].tagName;
	},
	
	init: function(args){
		this.on("click", this.clickHandler, args);
	},
	
	setDisabled: function(){
		switch(this.tagName)
		{
			case 'INPUT':
				this.elem.get(0).disabled = true;
				break;	
			default:
				this.suspendEvent(['click']);
				break;
		}	
	},
	
	setEnabled: function(){
		switch(this.tagName)
		{
			case 'INPUT':
				this.elem.get(0).disabled = false;
				break;
			default:
				this.resumeEvent(['click']);
				break;
		}	
	},
	
	setMessage: function(txt){
		// lazy init for mess container
		this.initMessCont();
		this.setMessage = function(txt){
			this.messageCont.html(txt);
		}
		this.setMessage(txt);
	},
	
	removeMessage: function(){
		// lazy init for mess container
		this.initMessCont();
		this.removeMessage = function(){
			this.messageCont.empty();
		}
		this.removeMessage();
	},
	
	initMessCont: function(){
		if (this.messageCont){
			return;
		}
		var messCont = document.createElement('DIV');
		this.messContId = this.id+"_messCont";
		messCont.id = this.messContId;
		this.messageCont = $(messCont);
		
		if($(this.elem).hasClass('runner-button') && $(this.elem).parent().hasClass('runner-btnframe')){
			$(this.messageCont).insertAfter($(this.elem).parent());
		} else {
			this.messageCont.insertAfter(this.elem);
		}
	},
	
	clickHandler: function(e, pageObj, proxy, pageid, isInlineAdd){
		var rowId,
			rowData = {id: -1, keys: [], fields: {}},
			row = $(this.elem).closest('tr[id^=gridRow]');
		
		isInlineAdd = isInlineAdd || false;
		if(row.length){
			var lastInd = row.attr('id').lastIndexOf('w'), 
				verticalRows = row.children('td.runner-cg');
			rowId = parseInt(row.attr('id').substr(lastInd + 1));
			if(verticalRows.length > 1){
				var currentVerticalRow = $(this.elem).closest('td.runner-cg');
				verticalRows.each(function(rowIndex, rowElement){
					if(rowElement == currentVerticalRow[0]){
						rowId = rowId + rowIndex - verticalRows.length + 1;
						return false;
					}
				});
			}
			rowData.id = rowId;
			if(typeof pageObj.controlsMap.gridRows!='undefined' && !isInlineAdd){
				for(var i=0; i<pageObj.controlsMap.gridRows.length; i++){
					if(pageObj.controlsMap.gridRows[i].id == rowId){
						rowData.keys = pageObj.controlsMap.gridRows[i].keys;
						break;
					}
				}
			}
			if(isInlineAdd){
				var addedRow = pageObj.inlineAdd.getRowById(rowId);
				rowData.keys = addedRow.keys;
			}
			if(typeof pageObj.listFields!='undefined'){
				for(var i=0; i<pageObj.listFields.length; i++){
					rowData.fields[pageObj.listFields[i]] = Runner.getFieldSpan(pageObj.listFields[i], rowId);
				}
			}
		}
		// create ctrl link for closure
		var ctrl = this;
		// create ajax params, before executing user code
		
		var params = {
			buttId: this.btnName,
			rndVal: (new Date().getTime())
		};
		// set button disabled before executing code
		this.setDisabled();
		// button flag, to make button enabled even if user execute return in before code
		var isButtEnabled = false;
		// execute code before
		var res = pageObj.buttonEventBefore[this.btnName](params, ctrl, pageObj, proxy, pageid, rowData);
		// set flag to true, that means button will be enabled in ajax response handler
		isButtEnabled = true;
		// create after code function closure, to make vars in code before visible in code after
		var afterHandler = function(result){
			if(res !== false){
				pageObj.buttonEventAfter[this.btnName](result, ctrl, pageObj, proxy, pageid, rowData);
			}
		};
		
		var keyObject = {};
		var isManyKeys = 0;
		var location = "";
		// add key values for edit and view page
		if(pageObj.keys){
			keyObject = pageObj.keys;
			location = pageObj.pageType;
		}
		// add selected recs values code for list page button handlers
		// !!!!!!!!!!!! for edit, view page with details, work not correct !!!!!!!!!!!!! 
		else if($('input[type=checkbox][name^=selection]', pageObj.pageCont).length){
			
			var keysElems = new Array();
			$('input[type=checkbox][id^=check][name^=selection]', pageObj.pageCont).each(function (){
				if (this.checked){
					keysElems.push(this);
				}
			});
			
			if(keysElems.length){
				isManyKeys = 1; 
				var j=0;
				if(rowData.keys.length){
					var rowKeys = '';
					for(var i=0; i<rowData.keys.length; i++){
						rowKeys += rowData.keys[i];
						if(i!=rowData.keys.length-1){
							rowKeys += '&';
						}
					}
					keyObject[j++] = rowKeys;
					location = 'grid';
				}else{
					location = pageObj.pageType;
				}
				for(var i=0; i<keysElems.length; i++){
					keyObject[j++] = (keysElems[i].value);
				}
			}
		}
		// add keys for current grid row
		if(!isManyKeys && rowData.keys.length){
			keyObject = rowData.keys;
			location = 'grid';
		}
		
		// if exist object with keys, than add to ajax params
		// send request and handle it
		var reqParams = {
			params: JSON.stringify(params), 
			keys: JSON.stringify(keyObject), 
			isManyKeys: isManyKeys,
			location: location
		};
		
		$.post("buttonhandler.php", reqParams, function(result){
			result = JSON.parse(result);
			afterHandler.call(ctrl, result);
			ctrl.setEnabled();
		});
		// if in code before was called return, we need to set button enabled
		if(!isButtEnabled){
			this.setEnabled();
		}
	}
	
});	

Runner.controls.ControlFabric = function(baseCfg, pageType, isInline){
	// make an object copy, not reference
	var cfg = {pageType: pageType, goodFieldName: Runner.goodFieldName(baseCfg.fieldName), isInline: isInline};
	Runner.apply(cfg, baseCfg);
	
	
	var tName = cfg.table, 
		id = cfg.id, 
		fName = cfg.fieldName;
		
	// analyze settings: settings, create cfg
	if(cfg.editFormat == undefined){
		cfg.editFormat = Runner.pages.PageSettings.getEditFormat(tName, fName, pageType);
	}
	if(cfg.RTEType == undefined){
		cfg.RTEType = Runner.pages.PageSettings.getFieldData(tName, fName, "RTEType", pageType);
	}
	if(cfg.dateEditType == undefined){
		cfg.dateEditType = Runner.pages.PageSettings.getFieldData(tName, fName, "dateEditType", pageType);
	}
	cfg.validation = Runner.pages.PageSettings.getValidations(tName, fName, pageType);
	cfg.mask = Runner.pages.PageSettings.getFieldData(tName, fName, "mask", pageType);
	cfg.shortTableName = Runner.pages.PageSettings.getShortTName(tName);
	cfg.disabled = Runner.pages.PageSettings.getDisabledStatus(tName, fName, pageType);
	cfg.hidden = Runner.pages.PageSettings.getHiddenStatus(tName, fName, pageType);
	
	switch (cfg.editFormat){
		case Runner.controls.constants.EDIT_FORMAT_NONE:
			return new Runner.controls.TextField(cfg);
			break;
		case Runner.controls.constants.EDIT_FORMAT_TEXT_FIELD:
			return new Runner.controls.TextField(cfg);
			break;
		case Runner.controls.constants.EDIT_FORMAT_TEXT_AREA:
		{
			switch (cfg.RTEType)
			{
				case Runner.controls.constants.EDIT_FORMAT_RTE:
					return new Runner.controls.RTEInnova(cfg);
					break;
				case Runner.controls.constants.EDIT_FORMAT_RTEINNOVA:
					cfg.useRTE = "INNOVA";
					return new Runner.controls.RTEInnova(cfg);
					break;
				case Runner.controls.constants.EDIT_FORMAT_RTECK:
					return new Runner.controls.RTECK(cfg);
					break;
				default:
					return new Runner.controls.TextArea(cfg);
					break;
			}
		}
		case Runner.controls.constants.EDIT_FORMAT_PASSWORD:
			return new Runner.controls.TextField(cfg);
			break;
		// different date controls
		case Runner.controls.constants.EDIT_FORMAT_DATE:
		{
			cfg.ctrlType = "date" + cfg.dateEditType;
			switch (cfg.dateEditType)
			{
				case Runner.controls.constants.EDIT_DATE_SIMPLE_DP:	
					cfg.useDatePicker = true;
					return new Runner.controls.DateTextField(cfg);
					break;
				case Runner.controls.constants.EDIT_DATE_DD:
					return new Runner.controls.DateDropDown(cfg);
					break;
				case Runner.controls.constants.EDIT_DATE_DD_DP:
					cfg.useDatePicker = true;
					return new Runner.controls.DateDropDown(cfg);
					break;
				case Runner.controls.constants.EDIT_DATE_SIMPLE:
				default:
					return new Runner.controls.DateTextField(cfg);
					break;
			}
		}
		//eo different date controls
		case Runner.controls.constants.EDIT_FORMAT_TIME:
			return new Runner.controls.TimeField(cfg);
			break;
		case Runner.controls.constants.EDIT_FORMAT_CHECKBOX:
			if (cfg.mode == Runner.controls.constants.MODE_SEARCH){
				return new Runner.controls.DropDownLookup(cfg);
			}else{
				return new Runner.controls.CheckBoxLookup(cfg);
			}
			
			break;
		// different file controls
		case Runner.controls.constants.EDIT_FORMAT_DATABASE_IMAGE:
			return new Runner.controls.ImageField(cfg);
			break;
		case Runner.controls.constants.EDIT_FORMAT_DATABASE_FILE:
			return new Runner.controls.FileField(cfg);
			break;
		case Runner.controls.constants.EDIT_FORMAT_FILE:
			if(Runner.pages.PageSettings.getFieldData(tName, fName, "compatibilityMode", pageType)){
				return new Runner.controls.FileField(cfg);
			}else{
				cfg.autoUpload = Runner.pages.PageSettings.getFieldData(tName, fName, "autoUpload", pageType);
				cfg.acceptFileTypes = Runner.pages.PageSettings.getFieldData(tName, fName, "acceptFileTypes", pageType);
				cfg.maxFileSize = Runner.pages.PageSettings.getFieldData(tName, fName, "maxFileSize", pageType);
				cfg.maxTotalFilesSize = Runner.pages.PageSettings.getFieldData(tName, fName, "maxTotalFilesSize", pageType);
				cfg.maxNumberOfFiles = Runner.pages.PageSettings.getFieldData(tName, fName, "maxNumberOfFiles", pageType);
				return new Runner.controls.MultiUploadField(cfg);
			}
			break;
		//eo different file controls
		case Runner.controls.constants.EDIT_FORMAT_LOOKUP_WIZARD:
			cfg.lcType = Runner.pages.PageSettings.getLCT(tName, fName, pageType);
			cfg.multiSel = Runner.pages.PageSettings.getLookupSize(tName, fName, pageType);
			cfg.parentFieldName = Runner.pages.PageSettings.getCategoryField(tName, fName, pageType);
			cfg.lookupTable = Runner.pages.PageSettings.getLookupTable(tName, fName, pageType);
			cfg.linkField = Runner.pages.PageSettings.getFieldData(tName, fName, "linkField", pageType);
			cfg.dispField = Runner.pages.PageSettings.getFieldData(tName, fName, "dispField", pageType);
			if(cfg.mode == Runner.pages.constants.PAGE_EDIT || cfg.mode == Runner.pages.constants.PAGE_INLINE_EDIT)
				cfg.autoCompleteFields = Runner.pages.PageSettings.getFieldData(tName, fName, "autoCompleteFieldsEdit", pageType);
			else if(cfg.mode == Runner.pages.constants.PAGE_ADD || cfg.mode == Runner.pages.constants.PAGE_INLINE_ADD)
				cfg.autoCompleteFields = Runner.pages.PageSettings.getFieldData(tName, fName, "autoCompleteFieldsAdd", pageType);
			
			// parse additional lookup controls params
			switch (cfg.lcType){
				case Runner.controls.constants.LCT_DROPDOWN:
					return new Runner.controls.DropDownLookup(cfg);
					break;
				case Runner.controls.constants.LCT_AJAX:
					cfg.freeInput = Runner.pages.PageSettings.getFieldData(tName, fName, "freeInput", pageType);
					return new Runner.controls.EditBoxLookup(cfg);
					break;
				case Runner.controls.constants.LCT_LIST:
					return new Runner.controls.ListPageLookup(cfg);
					break;
				case Runner.controls.constants.LCT_CBLIST:
					cfg.lcSize = 2;
					return new Runner.controls.CheckBoxLookup(cfg);
					break;
				case Runner.controls.constants.LCT_RADIO:
					cfg.lcSize = 2;
					return new Runner.controls.RadioControl(cfg);
					break;
				default:
					throw ('Invalid lookup wizard type = '+cfg.lcType+'. Cannot create lookup!');
			};
			break;
		case Runner.controls.constants.EDIT_FORMAT_READONLY:
			return new Runner.controls.ReadOnly(cfg);
			break;
		default:
			if(typeof Runner.controls.constants["Edit" + cfg.editFormat] != "undefined"){
				return new Runner.controls["Edit" + cfg.editFormat](cfg);
			}
			else
				throw ('Invalid control edit format = '+cfg.editFormat+'. Cannot create control!');
			return;
	};
};


/**
 * Base abstract class for all controls, should not be created directly
 * @requires runner, ControlManager, validate, Event
 * @class Runner.controls.Control
 */
Runner.controls.Control = Runner.extend(Runner.Event, {
	/**
	 * Name of control
	 * @type string
	 * @intellisense
	 */
	fieldName: "",
	/**
	 * Name used for HTML tags, attrs
	 * @type String
	 * @intellisense
	 */
	goodFieldName: "",
	/**
	 * table name for urls request
	 * @type String
	 * @intellisense
	 */
	shortTableName: "",
	/**
	 * Control id
	 * @type string
	 * @intellisense
	 */
	id: "",
	/**
	 * custom CSS classes
	 * @type string
	 * @intellisense
	 */
	css: "",
	/**
	 * Custom css styles
	 * @type String
	 * @intellisense
	 */
	style: "",
	/**
	 * Value DOM element id
	 * @type string
	 * @intellisense
	 */
	valContId: "",
	/**
	 * Object, value DOM element
	 * @type {object}
	 * @intellisense
	 */
	valueElem: null,
	/**
	 * Span container element id
	 * @type {string}
	 * @intellisense
	 */
	spanContId: "",
	/**
	 * Span jQuery object
	 * @type {object}
	 * @intellisense
	 */
	spanContElem: null,
	/**
	 * Error container id
	 * @type {string}
	 * @intellisense
	 */
	errContId: "",
	/**
	 * Error container, div
	 * @type {object}
	 * @intellisense
	 */	
	errContainer: null,
	/**
	 * Array of validation types
	 * @type array of string
	 * @intellisense
	 */
	validationArr: null,
	/**
	 * Text field input mask
	 * @type string
	 * @intellisense
	 */
	mask: "",
	/**
	 * Value after initialization
	 * @intellisense
	 */
	defaultValue: null,
	/**
	 * Is reset form happend or not
	 * @intellisense
	 */
	isClearHappend: false,
	/**
	 * Source table
	 * @intellisense
	 */
	table: "",
	/**
	 * Defined regExp with ,message, messageType, allowEmpty, regExp 
	 * @type {object}
	 * @intellisense
	 */
	regExp: null,
	/**
	 * Type attr
	 * @type {string}
	 * @intellisense
	 */
	inputType: "",
	/**
	 * Edit type of control, that used to process data on server
	 * Was created for search submit
	 * @type String
	 * @intellisense
	 */
	ctrlType: "",
	/**
	 * Is editable elems shown
	 * @type {bool}
	 * @intellisense
	 */
	showStatus: true,
	/**
	 * Number of control for the field. In advanced search page only 2 controls may appear for the field.
	 * But ControlManager can add any ammount of controls to the field 
	 * @type number
	 * @intellisense
	 */
	ctrlInd: -1,
	/**
	 * Indicator, is focused element or not
	 * @type Boolean
	 * @intellisense
	 */
	isSetFocus: false,
	/**
	 * Hidden property
	 * @type Boolean
	 * @intellisense
	 */
	hidden: false,
	/**
	 * Indicator, is field wich control belong hided
	 * @type Boolean
	 * @intellisense
	 */
	hiddenByField: false,
	/**
	 * Mode of using control add|adit|search
	 * @type String
	 * @intellisense
	 */
	mode: '',
	/**
	 * Indicator, true if control was marked as invalid.
	 * Usefull for password matching and validation etc.
	 * @type Boolean
	 * @intellisense
	 */
	isInvalid: false,
	/**
	 * Class constructor
	 * @constructor
	 * @extends Runner.emptyFn
	 * @param {Mixed} cfg
	 * @param {string} cfg.fieldName
	 * @param {string} cfg.id
	 * @param {array} cfg.validationArr
	 * @param {object} cfg.regExp
	 */	
	constructor: function(cfg) {
		// copy properties from cfg to controller obj
		Runner.apply(this, cfg);
		//call parent
		Runner.controls.Control.superclass.constructor.call(this, cfg);	
		// fill validation
		this.validationArr = cfg.validation.validationArr || [];
		this.regExp = cfg.validation.regExp;
		// value element id
		this.valContId = "value"+(cfg.ctrlInd || "")+"_"+this.goodFieldName+"_"+this.id;
		// value elem
		this.valueElem = (this.valueElem == null) ? $("#"+this.valContId) : this.valueElem;	
		// span container id
		this.spanContId = "edit"+this.id+"_"+this.goodFieldName+"_"+cfg.ctrlInd;
		// add span elem
		this.spanContElem = $("#"+this.spanContId);
		// error DOM element id
		this.errContId = "errorCont"+cfg.ctrlInd+"_"+this.valContId;
		// initialize control disabled
		if (cfg.disabled===true || cfg.disabled==="true"){
			this.setDisabled();
		}
		// initialize control hidden
		if (cfg.hidden===true || cfg.hidden==="true"){
			this.hide();
		}
		// there we can also apply custom css classes
		this.ccs ? valueElem.addclass(this.css) : '' ;
		// there we can also apply custom css styles
		this.addStyle(this.style);
		// get default value
		this.defaultValue = this.getDefaultValue();
		// add input type attr, if it exist
		if (this.valueElem.attr && this.valueElem.attr("type")){
			this.inputType = this.valueElem.attr("type");
		}
		// need for use focus indicator
		this.addEvent(["click"]);
		// if not passed stop event init param
		if (cfg.stopEventInit!==true) {
			//event elem
			if(this.appearOnPage())
				this.elemsForEvent = [this.valueElem.get(0)];
			//adding events
			this.addEvent(["blur"]);
			// init events
			this.init();
		}
		this.mask = cfg.mask;
		// register new control in manager
		Runner.controls.ControlManager.register(this);
		// register in validator for custom user validation functions loading
		validation.registerCustomValidation(this);
	},
	
	destructor: function(){
		this.purgeListeners();
	},
	
	unregister: function(){
		Runner.controls.ControlManager.unregister(this.table, this.id, this.fieldName);
	},
	
	initToolTip: function(text, pageObj){
		if (this.valueElem.addClass && this.mode != Runner.controls.constants.MODE_SEARCH){
			this.valueElem.addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: Runner.isFlyPage(pageObj)});
			this.initToolTip = Runner.emptyFn;
			return true;
		}else{
			return false;
		}
	},
	
	/**
	 * Add styles to value element
	 * @param {string} styleToAdd
	 * @return {Boolean} true in success, otherwise false
	 * @intellisense
	 */
	addStyle: function(styleToAdd){
		
		if (!styleToAdd){
			return false;
		}
		
		var stylesArr = styleToAdd.split(';');
		
		for(var i=0; i<stylesArr.length; i++){
			var style = stylesArr[i].split(":");
			style[0] = style[0].toString().trim();
			if (!style[0]){
				continue;
			}
			style[1] = style[1].toString().trim();
			this.valueElem.css(style[0], style[1]);
		}
		
		/*// style that was on element
		var oldStyle = this.valueElem.attr('style');
		// new style, with added
		var newStyle = (oldStyle ? oldStyle + ' ' : '') + styleToAdd;
		// set new style
		this.valueElem.attr('style', newStyle);	*/
		return true;
	},
	/**
	 * Validates control against validation types, defined in validationArr
	 * @method validate
	 * @params valArr - array of validation for event blur only
	 * @return {object} if success true, otherwise false
	 * @intellisense
	 */
	validate:function(valArr){
		if (!this.appearOnPage() || this.hiddenByField){
			return {result: true, messageArr: []};
		}
		var vRes = validation.validate(valArr || this.validationArr, this);
		// change invalid status only if any validation were made, to prevent init error container
		if (valArr || this.validationArr.length){
			if (!vRes.result){
				this.markInvalid(vRes.messageArr);
			}else{
				this.clearInvalid();
			}
		}
		// return validation result
		return vRes;
	},
	/**
	 * removes validation from control. 
	 * @param {string} vType
	 * @return {bool} If success true, false otherwise
	 * @intellisense
	 */
	removeValidation: function(vType){
		if (typeof vType != "string"){
			this.regExp = null;
			vType = "RegExp";
		}
		
		for(var i=0;i<this.validationArr.length;i++){
			if (this.validationArr[i] == vType){
				this.validationArr.splice(i,1);
				return true;
			}
		}
		return false;
	},
	/**
	 * Adds validation to control
	 * @param {string} vType
	 * @intellisense
	 */
	addValidation: function (vType){
		if (typeof vType != "string"){
			this.regExp = vType;
			vType = "RegExp";
		}
		if (!this.isSetValidation(vType)){
			this.validationArr[this.validationArr.length] = vType;
		}
	},
	/**
	 * Checks if validation added
	 * private
	 * @param {string} vType
	 * @return {bool} If success true, false otherwise
	 * @intellisense
	 */
	isSetValidation: function (vType){
		// checks if this vType defined
		if (!validation[vType]){
			return false;
		}
		for(var i=0;i<this.validationArr.length;i++){
			if (this.validationArr[i] == vType){
				return true;
			}
		}
		return false;
	},
	/**
	 * Validates control value against vType validation
	 * @param {string} vType
	 * @return {mixed}
	 * @intellisense
	 */
	validateAs: function(vType){
		if (!this.appearOnPage()){
			return {result: true, messageArr: []};
		}
		return validation[vType](this.getValue());
	},
	/**
	 * Helper func for lazy init error container
	 * @private
	 * @intellisense
	 */
	initErrorCont: function(){
		// create error container
		this.errContainer = document.createElement('div');
		this.errContainer = $(this.errContainer);
		this.errContainer.attr('id', this.errContId);
		this.errContainer.addClass('runner-error-text');
		this.errContainer.css('display', "none");
		this.errContainer.appendTo(this.spanContElem);
		this.initErrorCont = Runner.emptyFn;
	},
	
	/**
	 * Sets error messages after validation
	 * @param {array} messArr
	 * @intellisense
	 */
	markInvalid: function(messArr, dontDenySubmit){
		this.initErrorCont();
		this.markInvalid = function(messArr){
			var divInnerHtml = "";
			var pageObj = Runner.pages.PageManager.getAt(this.table, this.id);
			var that = this;
			pageObj.validateTimer = setTimeout(function(){
				that.errContainer.show();
			},1000);
			for(var i=0;i<messArr.length;i++){
				divInnerHtml += messArr[i]+"</br>";
			}
			// add message to container
			this.errContainer.html(divInnerHtml);
			// set invalid indicator
			//if(!dontDenySubmit)
				this.isInvalid = true;
		}
		this.markInvalid(messArr);
	},
	/**
	 * Clears invalid state
	 * @method
	 * @intellisense
	 */
	clearInvalid: function(){
		this.initErrorCont();
		this.clearInvalid = function(){
			this.errContainer.hide();
			this.errContainer.empty();
			// set invalid indicator
			this.isInvalid = false;
		}
		this.clearInvalid();
	},	
	/**
	 * Return invalid state of control
	 * @return {bool}
	 * @intellisense
	 */
	invalid: function(){
		return this.isInvalid;
	},
	
	/**
	 * sets default value to control
	 * return true if success. otherwise false
	 * @method
	 * @intellisense
	 */
	reset: function(updContext){
		this.setValue(this.defaultValue, true, updContext);
		this.clearInvalid();
		return true;
	},
	/**
	 * Sets empty value to control
	 * return true if success. otherwise false
	 * @method
	 * @return bool
	 * @intellisense
	 */
	clear: function(){
		this.isClearHappend = true;
		this.setValue('');
		this.clearInvalid();
		this.isClearHappend = false;
		return true;
	},
	
	/**
	 * Hide control - set display attr none
	 * Should be overriden for sophisticated controls
	 * @method
	 * @intellisense
	 */
	hide: function(){
		this.spanContElem.css("display", "none");
		this.showStatus = false;
	},
	
	/**
	 * Show control - set display attr block
	 * Should be overriden for sophisticated controls
	 * @method
	 * @intellisense
	 */
	show: function(){
		this.spanContElem.css("display", "");
		this.showStatus = true;
	},	
	/**
	 * Toggle show/hide status
	 * @intellisense
	 */
	toggleHide: function(){
		if (this.showStatus){
			this.hide();
		}else{
			this.show();
		}
	},
	/**
	 * Get value from value element. 
	 * Should be overriden for sophisticated controls
	 * @method
	 * @intellisense
	 */
	getValue: function(){
		if (this.valueElem.val){
			return this.valueElem.val();
		}else{
			return false;
		}
	},
	
	getDefaultValue: function(){
		return this.getValue();
	},
	
	/**
	 * Return value as string
	 * @return {string}
	 * @intellisense
	 */
	getStringValue: function(){
		return this.getValue();
	},
	
	/**
	 * Sets value to value DOM elem
	 * Should be overriden for sophisticated controls
	 * @method
	 * @param {mixed} val
	 * @intellisense
	 */
	setValue: function(val, triggerEvent, updContext){
		if (this.valueElem.val){
			this.valueElem.val(val);
			if(triggerEvent===true){
				this.fireEvent("change", updContext);
			}
			return true;
		}else{
			return false;
		}
	},
	
	
	/**
	 * Sets disable attr true
	 * Should be overriden for sophisticated controls
	 * @method
	 * @intellisense
	 */
	setDisabled: function(){
		if (this.valueElem.get(0)){
			this.valueElem.get(0).disabled = true;
			return true;
		}else{
			return false;
		}
	},
	
	/**
	 * Sets disaqble attr false
	 * Should be overriden for sophisticated controls
	 * @method
	 * @intellisense
	 */
	setEnabled: function(){
		if (this.valueElem.get(0)){
			this.valueElem.get(0).disabled = false;
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Returns input tag type attribute.
	 * @method
	 * @return {string}
	 * @intellisense
	 */
	getControlType: function(){
		return this.inputType;
	},
	/**
	 * Sets focus to the element
	 * @method
	 * @return {bool}
	 * @intellisense
	 */
	setFocus: function(triggerEvent){
		
		var cType = this.getControlType();
		if (cType != ""){
			// can't set focus on disabled element. This may cause IE error
			if (!this.appearOnPage() || this.valueElem.get(0).disabled == true || !this.showStatus || !$(this.valueElem).is(":visible") || this.valueElem.css('visibility') == 'hidden'){
				return false;
			}
			try{
			  this.valueElem.get(0).focus();
			}catch(err){
				// just for prevent error in IE :)
			}
			
			// trigger event
			if(triggerEvent===true){
				this.fireEvent("focus");
			}
			this.isSetFocus = true;
			return true;
		}else{
			this.isSetFocus = false;
			return false;
		}
	},
	/**
	 * Checks if control value is empty. Used for isRequired validation
	 * @method
	 * @return {bool}
	 * @intellisense
	 */
	isEmpty: function(){
		return this.getValue().toString()=="";
	},
	
	/**
	 * Custom function for onblur event
	 * @param {Object} e
	 * @intellisense
	 */
	"blur": function(e){
		this.stopEvent(e);
		this.isSetFocus = false;
		if (this.invalid()){
			return this.validate();	
		}else{
			var valArr = this.validationArr.copy().removeElem("IsRequired");
			return this.validate(valArr);
		}
		
	},
	/**
	 * Sets focus indicator true when click on elem
	 * @param {event} e
	 * @intellisense
	 */
	"click": function(e){
		this.isSetFocus = true;
	},
	/**
	 * Removes css class to value element
	 * @param {string} className
	 * @intellisense
	 */
	removeCSS: function(className){
		this.valueElem.removeClass(className);
	},
	/**
	 * Adds css class to value element
	 * @param {string} className
	 * @intellisense
	 */
	addCSS: function(className){
		this.valueElem.addClass(className);
	},
	/**
	 * Returns specified attribute from value element
	 * @param {string} attrName
	 * @intellisense
	 */
	getAttr: function(attrName){
		return this.valueElem.attr(attrName);
	},
	/**
	 * Return element that used as display.
	 * Usefull for suggest div positioning
	 * @return {object}
	 * @intellisense
	 */
	getDispElem: function(){
		return this.valueElem;
	},
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 * @intellisense
	 */
	getForSubmit: function(){
		return (this.appearOnPage() ? [this.valueElem.clone().val(this.valueElem.val())] : []);
	},
	
	/**
	 * Make readonly control
	 * Get control's clone, make it readonly
	 * And make contol hidden
	 *
	 * @return {boolean}
	 * @intellisense
	 */
	makeReadonly: function(){
		if (!this.appearOnPage() || this.isReadonly()){
			return false;
		}
		
		this.readonlyElem = this.valueElem.clone();
		this.readonlyElem.prop({
			'id': 'readonly_'+this.valContId,
			'name': 'readonly_'+this.valContId,
			'disabled': true,
			'readonly': true
		});	
		this.readonlyElem.prependTo(this.spanContElem);
		//this.valueElem.css('visibility','hidden');
		this.valueElem.css('display','none');
		return true;
	},
	
	/**
	 * Change readonly control to readwrite
	 * Remove control's clone and make contol visible
	 *
	 * @return {boolean}
	 * @intellisense
	 */ 
	makeReadWrite: function(){
		if (!this.appearOnPage() || !this.isReadonly()){
			return false;
		}
		
		this.readonlyElem.remove();	
		this.readonlyElem = undefined;
		this.valueElem.css('display', '');
		return true;
	},
	
	/**
	 * Check is control readonly or not
	 *
	 * @return {boolean}
	 * @intellisense
	 */
	isReadonly: function(){
		return $('#readonly_'+this.valContId).length;
	},
	
	/**
	 * Check is control exist or not
	 *
	 * @return {boolean}
	 * @intellisense
	 */	
	appearOnPage: function(){
		return this.valueElem.length;
	},
	
	getFieldSetting: function(key){
		return Runner.pages.PageSettings.getFieldData(this.table, this.fieldName, key, this.pageType);
	},

	/**
	* Get the displayed field's value
	* Overrided for lookup wizard controls
	 * @intellisense
	*/
	getDisplayValue: function(){
		return this.getValue();
	}	

});

Runner.viewControls.ViewControlFabric = function(baseCfg, pageType, pageContext, pageObject){
	// make an object copy, not reference
	var cfg = {
			pageType: pageType, 
			goodFieldName: Runner.goodFieldName(baseCfg.fieldName),
			pageContext: pageContext,
			pageObject: pageObject
			};
	Runner.apply(cfg, baseCfg);
		
	if(typeof Runner.viewControls[cfg.viewFormat] != "undefined"){
		return new Runner.viewControls[cfg.viewFormat](cfg);
	}
	else
		throw ('Invalid control view format = '+cfg.viewFormat+'. Cannot create control!');
};


/**
 * Base abstract class for all view controls, should not be created directly
 * @requires runner
 * @class Runner.controls.ViewControl
 */

Runner.viewControls.ViewControl = Runner.extend(Runner.emptyFn,{
	/**
	 * Name of control
	 * @type string
	 * @intellisense
	 */
	fieldName: "",
	/**
	 * Name used for HTML tags, attrs
	 * @type String
	 * @intellisense
	 */
	goodFieldName: "",
	/**
	 * table name for urls request
	 * @type String
	 * @intellisense
	 */
	shortTableName: "",
	/**
	 * Source table
	 * @type String
	 * @intellisense
	 */
	table: "",
	/**
	 * DOM context of control's page 
	 * @type String
	 * @intellisense
	 */
	pageContext: null,
	/**
	 * Page type
	 * @type String
	 * @intellisense
	 */
	pageType: "", 
	/**
	 * @constructor
	 */
	constructor: function(cfg){
		// copy properties from cfg to controller obj
		Runner.apply(this, cfg);
	}	
});
Runner.viewControls.ViewVideoField = Runner.extend(Runner.viewControls.ViewControl,{

	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
		// call parent
		Runner.viewControls.ViewVideoField.superclass.constructor.call(this, cfg);
	},


	init: function(){
		setTimeout(function(){
			$("video", this.pageContext).each(function(){
				var obj = $(this);
				projekktor(obj, {
					controls: true,
					volume: 0.5,
					width: obj.attr("width"),
					height: obj.attr("height"),
					playerFlashMP4: 'jarisplayer.swf',
					playerFlashMP3: 'jarisplayer.swf'
				});
			});
		}, 10);
	}
});

Runner.viewControls["Video file"] = Runner.viewControls.ViewVideoField;
Runner.viewControls["Database video"] = Runner.viewControls.ViewVideoField;
Runner.viewControls.ViewAudioField = Runner.extend(Runner.viewControls.ViewControl,{

	pageObject: null,
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
		// call parent
		Runner.viewControls.ViewAudioField.superclass.constructor.call(this, cfg);
	},


	init: function(){
		var initAudio = function(){
			this.preprocessAudioLinks();
			if(!YAHOO.mediaplayer.loadPlayerScript.bCalled){
				YAHOO.mediaplayer.loadPlayerScript();
			}else{
				this.addAudioTracks();
			}
		};
		if(Runner.YmpLoader){
			Runner.YmpLoader.onLoad(initAudio, this);
		}
	},
	
	initInline: function(row){
		var audioLinks = $('#edit'+row.id+'_'+this.goodFieldName, this.pageCont).find('a[type="audio/mpeg"]');
		if (audioLinks.length){
			var link = ""
				, lastInd = document.location.href.lastIndexOf("/")
				, addHref = document.location.href.substr(0, lastInd + 1);
			
			for(var j = 0; j < audioLinks.length; j++){
				var link = $(audioLinks[j]).attr("href");
				if (link.substr(0, 4) != "http"){
					$(audioLinks[j]).attr("href", (addHref + link));
				}
			}
			if(row.revertted){
				$('#edit'+row.id+'_'+this.goodFieldName, this.pageCont)
					.html($('a[class=htrack]', '#edit'+row.id+'_'+this.goodFieldName, this.pageCont));
			}
			YAHOO.MediaPlayer.addTracks($('#edit'+row.id+'_'+this.goodFieldName).get(0), null, false);
		}
	},
	
	/**
	 * Add audio tracks into player play list
	 * Using for fly pages, details and ajax reloading
	 */
	addAudioTracks: function(){
		if(typeof this.pageObject.gridElem != "undefined"){
			// add tracks into grid
			YAHOO.MediaPlayer.addTracks(this.pageObject.pageCont, null, false);
		}else{
			// add tracks into page view
			var bricksArr = this.pageObject.getBrickObjs('viewfields');
			for (var i=0;i<bricksArr.length;i++){
				YAHOO.MediaPlayer.addTracks(bricksArr[i].elem.get(0), null, false);
			}
			// if view has tabs and sections
			$('.page-viewtab', this.pageCont).each(function(){
				YAHOO.MediaPlayer.addTracks(this, null, false);
			});
		}
	},
	
	preprocessAudioLinks: function(){
		var audioLinks = $(".htrack", this.pageCont);
		var lastInd = document.location.href.lastIndexOf("/");
		var addHref = document.location.href.substr(0, lastInd+1);
		
		for(var i=0;i<audioLinks.length;i++){
			var link = $(audioLinks[i]).attr("href");
			if (link.substr(0, 4) != "http"){
				$(audioLinks[i]).attr("href", (addHref + link));
			}
		}
		return audioLinks.length;
	}
});

Runner.viewControls["Audio file"] = Runner.viewControls.ViewAudioField;
Runner.viewControls["Database audio"] = Runner.viewControls.ViewAudioField;
Runner.viewControls.ViewImageField = Runner.extend(Runner.viewControls.ViewControl,{

	pageObject: null,
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
		// call parent
		Runner.viewControls.ViewImageField.superclass.constructor.call(this, cfg);
	},


	init: function(){
		var self = this;
		setTimeout(function(){
			var zoomboxes = $('.zoombox', self.pageContext);
			if(zoomboxes.length)
				zoomboxes.zoombox({
					theme: 'zoombox', opacity: 0.8,
					duration: 400, animation: false,
					gallery: false, autoplay : false
				});
				var hasSliders = false, isRTL = Runner.isDirRTL();
				$(".presudoslider", self.pageContext).each(function(){
					if(isRTL)
						$(this).closest('td').attr('dir', 'LTR').attr("style", "text-align: left !important;");
					$(this).removeClass("presudoslider").addClass("sudoslider").sudoSlider();
					hasSliders = true;
				});
				// This need for IE with master list. Because IE don't refresh TD height after sliders initialization
				if(hasSliders && Runner.isIE && Runner.pages.PageSettings.getTableData(self.pageObject.tName, "hasMasterList")){
					Runner.isMasterOnDetail = true;
					setTimeout(function(){
						$('body').addClass('runner-dummy-forIE');
					}, 10);
				}
				if(self.pageObject.pageType == 'view' && self.pageObject.isUseTabs() 
						||  self.pageObject.controlsMap && self.pageObject.controlsMap.sections 
							&& typeof self.pageObject.controlsMap.sections.length == 'undefined'){
					setTimeout(function(){
						self.pageObject.resizeSliders(self.pageContext);
					}, 100);
				}
		}, 100);
	}
});

Runner.viewControls["File-based Image"] = Runner.viewControls.ViewImageField;
Runner.viewControls.ViewFileField = Runner.extend(Runner.viewControls.ViewControl,{

	pageObject: null,
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
		// call parent
		Runner.viewControls.ViewFileField.superclass.constructor.call(this, cfg);
	},


	init: function(){
		var self = this;
		setTimeout(function(){
			var zoomboxes = $('.zoombox', self.pageContext);
			if(zoomboxes.length)
				zoomboxes.zoombox({
					theme: 'zoombox', opacity: 0.8,
					duration: 400, animation: false,
					gallery: false, autoplay : false
				});
		}, 100);
	}
});

Runner.viewControls["Document Download"] = Runner.viewControls.ViewFileField;
Runner.viewControls.ViewDatabaseImageField = Runner.extend(Runner.viewControls.ViewControl,{

	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
		// call parent
		Runner.viewControls.ViewDatabaseImageField.superclass.constructor.call(this, cfg);
	},


	init: function(){
		var self = this;
		setTimeout(function(){
			var zoomboxes = $('.zoombox', self.pageContext);
			if(zoomboxes.length)
				zoomboxes.zoombox({
					theme: 'zoombox', opacity: 0.8,
					duration: 400, animation: false,
					gallery: false, autoplay : false
				});
		}, 100);
	}
});

Runner.viewControls["Database Image"] = Runner.viewControls.ViewDatabaseImageField;
Runner.viewControls["Old file-based Image"] = Runner.viewControls.ViewDatabaseImageField;
/**
 * Class for read only control
 */
Runner.controls.ReadOnly = Runner.extend(Runner.controls.Control, {
	
	readonlyElem: null,
	
	constructor: function(cfg) {
		Runner.controls.ReadOnly.superclass.constructor.call(this, cfg);
		this.readonlyElem = $('#readonly_'+this.valContId);
	},
	
	validate: function(){
		return {result: true};
	},
	
	getControlType: function(){
		return "readonly";
	},
	
	setFocus: function(){
		return false;
	},
	
	setValue: function(val, triggerEvent, updContext){
		Runner.controls.ReadOnly.superclass.setValue.call(this, val, triggerEvent, updContext);
		this.readonlyElem.empty().html(val);
	}
});



/**
 * TextArea control class
 */
Runner.controls.TextArea = Runner.extend(Runner.controls.Control,{
	/**
	 * Override constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){		
		this.addEvent(["change", "keyup"]);		
		// call parent
		Runner.controls.TextArea.superclass.constructor.call(this, cfg);
		// change input type, because textarea don't have type attr
		this.inputType = "textarea";		
	},
	/**
	 * Clone html for iframe submit
	 * @return {array}
	 */
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}
		return [this.valueElem.clone().val(this.getValue())]
	}
});




/**
 * Class for text fields control
 */
Runner.controls.TextField = Runner.extend(Runner.controls.Control, {
	constructor: function(cfg){
		this.addEvent(["change", "keyup"]);		
		Runner.controls.TextField.superclass.constructor.call(this, cfg);
                if(this.mask != "")
                    this.valueElem.mask(this.mask);		
	}	
});



/**
 * Class for time fields with textField value editor, and timepicker optional
 */
Runner.controls.TimeField = Runner.extend(Runner.controls.Control, {
	/**
	 * Id of type elem. Need for submit, which used on serverside
	 * @type {string}
	 */
	typeHiddId: "",
	/**
	 * jQuery object of type elem format hidden element, which used on serverside
	 * @type {Object} 
	 */
	typeHiddElem: null,	
	/**
	 * Range seconds for timepickr
	**/
	rangeSec: [],
	pageType: "",
	/**
	 * Overrides parent constructor
	 * @param {Object} cfg
	 * @param {bool} cfg.useDatePicker
	 */
	constructor: function(cfg){
		// call parent
		Runner.controls.TimeField.superclass.constructor.call(this, cfg);	
		// add hidden field for date format on serverside
		this.typeHiddId = "type_"+this.goodFieldName+"_"+this.id;
		this.typeHiddElem = $("#"+this.typeHiddId);
		this.imgTime = $("#trigger-test-"+this.valContId);
		// hide timepicker for IE, because it doesn't work properly
		//if (this.imgTime.length && !Runner.isIE){
			this.imgTime.css('visibility','visible');
		//}
		// initialize control disabled
		if (cfg.disabled===true || cfg.disabled==="true"){
			this.setDisabled();
		}
		for(i=0;i<60;i++)
		{
			if(i<10)
				this.rangeSec[i]="0"+i;
			else
				this.rangeSec[i]=""+i;
		}
		this.addEvent(["change"]);
		this.init();
		this.initTimePicker();
	},
	
	initTimePicker: function()	{
		var ctrl = this;
		var initializer = function(e){
			ctrl.imgTime.unbind("click");
			$(function(){
				var settings = Runner.pages.PageSettings.getFieldData(ctrl.table,ctrl.fieldName, 'timePick', ctrl.pageType);
				var params = {
					handle: "#"+ctrl.imgTime.attr("id"),
					updateLive: false,
					trigger: 'click',
					convention: settings['convention'],
					seconds: settings['showSec'],			
					rangeMin: settings['rangeMin'],
					rangeSec: ctrl.rangeSec
				};
				ctrl.valueElem.timepickr(params);
				 //sets "dir" to the timepikr.menu div element
				$('.ui-helper-reset.ui-timepickr.ui-widget').css('direction','ltr');
				ctrl.imgTime.click();
			});			
		}
		this.imgTime.bind("click", initializer);
	},
	/**
	 * Override addValidation
	 * @param {string} type
	 */	
	addValidation: function(type){
		// date field can be validated only as isRequired
		if (type!="isRequired"){
			return false;
		}
		// call parent
		Runner.controls.TimeField.superclass.addValidation.call(this, type);
	},
	/**
	 * Clone html for iframe submit
	 * @method
	 * @return {array}
	 */
	getForSubmit: function(){
		return [this.valueElem.clone(), this.typeHiddElem.clone()];
	},
	/**
	 * Overrides parent function for element control
	 * Sets disable attr true
	 * Sets hidden css style true for image "time"
	 * @method
	 */
	setDisabled: function()
	{
		if (this.valueElem.get(0) && this.imgTime)
		{
			this.valueElem.get(0).disabled = true;
			this.imgTime.css('visibility','hidden');
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Overrides parent function for element control
	 * Sets disable attr false
	 * Sets visible css style true for image "time"
	 * @method
	 */
	setEnabled: function()
	{
		if (this.valueElem.get(0))
		{
			this.valueElem.get(0).disabled = false;
			if (!Runner.isIE){
				this.imgTime.css('visibility','visible');
			}
			return true;
		}else{
			return false;
		}
	},
	
	"change": function(e)
	{
		return this.validate().result;
	},
	
	makeReadonly: function(){
		Runner.controls.TimeField.superclass.makeReadonly.call(this);
		if(this.imgTime!=null){
			this.imgTime.css('display','none');
		}
		return true;
	},
	
	makeReadWrite: function(){
		Runner.controls.TimeField.superclass.makeReadWrite.call(this);
		if(this.imgTime!=null){
			this.imgTime.css('display','');
		}
		return true;
	}
});
/**
 * Common base class for rte fields
 */
Runner.controls.RTEField = Runner.extend(Runner.controls.Control, {
	
	iframeElemId: "",
	
	iframeElem: null,
	
	constructor: function(cfg){
		// may be need to turn off event initialization before iframe loaded
		cfg.stopEventInit=true;
		this.tName = cfg.table;
				
		Runner.controls.RTEField.superclass.constructor.call(this, cfg);
				
		// initialize control disabled
		if (cfg.disabled==true || cfg.disabled=="true"){
			this.setDisabled();
		}
		this.fixForChrome();
	},
	
	initIframeElem: function(){
		if (!this.inputType)
			this.inputType = "RTE";
		if (!this.iframeElemId)
			this.iframeElemId = this.valContId;
		if (!this.iframeElem)
			this.iframeElem = $('#'+this.iframeElemId);
	},
	/**
	 * Indicates used datepicker with control or not
	 * @type {bool} cfg
	 */
	useRTE: false,
	
	/**
	 * Fix load RTE and Innova in browser chrome
	 */
	fixForChrome: function(){
		var pageObj = Runner.pages.PageManager.getAt(this.tName, this.id);
		if($.browser.safari &&  pageObj.fly){
			src = this.iframeElem.attr('src');
			this.iframeElem.attr('src',"");
			this.iframeElem.attr('src', src);
		}	
	},
	
	/**
	 * Override addValidation
	 * @param {string} type
	 */
	addValidation: function(type)
	{
		// date field can be validated only as isRequired
		if (type!="isRequired")
			return false;
		// call parent
		Runner.controls.RTEField.superclass.addValidation.call(this, type);
	},
	
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}
		var clElem = $('<input type="hidden" name="'+this.iframeElemId+'">').clone();
		$(clElem).val(this.getValue());
		return [clElem];
	},
	setDisabled: function()
	{
		if (this.iframeElem && !$('#disabledRTE'+this.fieldName+'_'+this.id).length){
			var val = this.getValue();
			this.iframeElem.css('display','none');
			this.spanContElem.prepend('<div id="disabledRTE'+this.fieldName+'_'+this.id+'">'+val+'</div>')
			return true;
		}else{
			return false;
		}
	},
	setEnabled: function()
	{
		if (this.iframeElem){
			$("#disabledRTE"+this.fieldName+'_'+this.id).remove();
			this.iframeElem.css('display','block');
			return true;
		}else{
			return false;
		}
	},
	
	makeReadonly: function(){
		this.iframeElem.css('display','none');
		var pageObj = Runner.pages.PageManager.getAt(this.tName, this.id);
		if (this.mode=="inline_edit" || pageObj.fly || (this.mode=="add" && !pageObj)) {
			var el = this;
			$(this.iframeElem).bind('load', function(e){
				el.setDisabled();
			});
		}
		else {
			if(this.loadIframe){
				this.setDisabled();
			}else{
				var ctrl = this;
				setTimeout(function(){
					ctrl.loadIframe = true;
					ctrl.makeReadonly();
				},1000); 
			}
		}
	},
	
	makeReadWrite: function(){
		this.iframeElem.css('display','');
		var pageObj = Runner.pages.PageManager.getAt(this.tName, this.id);
		if (this.mode=="inline_edit" || pageObj.fly || (this.mode=="add" && !pageObj)) {
			var el = this;
			$(this.iframeElem).bind('load', function(e){
				el.setEnabled();
			});
		}
		else {
			if(this.loadIframe){
				this.setEnabled();
			}else{
				var ctrl = this;
				setTimeout(function(){
				 	ctrl.loadIframe = true;
					ctrl.makeReadWrite();
				}, 1000);
			}
		}
	}
});


Runner.controls.RTEInnova = Runner.extend(Runner.controls.RTEField, 
{
	innerIframeId: null,
	
	loadIframe: false,
	
	constructor: function(cfg)
	{	
		this.useRTE = cfg.useRTE ? cfg.useRTE : false;
		Runner.controls.RTEInnova.superclass.constructor.call(this, cfg);
		this.fixForChrome();
		
	},
	
	getDefaultValue: function(){
		this.initIframeElem();
		var editor = this;
		$(this.iframeElem).bind('load', function(e){
			editor.loadIframe = true;
			if(editor.useRTE=='INNOVA'){
				if (!editor.innerIframeId)
					editor.innerIframeId = 'idContentoEdit'+editor.goodFieldName+'_'+editor.id;
					editor.defaultValue  = editor.iframeElem.contents().find('#'+editor.innerIframeId).contents().find('body').html();
			}
			else{
				editor.defaultValue  = editor.iframeElem.contents().find('#'+editor.iframeElemId).contents().find('body').html();
			}		
		});
	},
	
	getValue: function()
	{	
		Runner.controls.RTEInnova.superclass.getValue.call(this);
		
		var val, editor = this;
		if(this.iframeElem)
		{	
			if(this.useRTE=='INNOVA'){
				if (!this.innerIframeId)
					this.innerIframeId = 'idContentoEdit'+this.goodFieldName+'_'+this.id;
				val = this.iframeElem.contents().find('#'+this.innerIframeId).contents().find('body').html();
			}
			else{
				val = this.iframeElem.contents().find('#'+this.iframeElemId).contents().find('body').html();
			}
				
			if(val)
				val = val.trim();
				
			if(val == '<br>')
				val = '';
				
			return val;
		}
		else 
			return false;
	},
		
	setValue: function(val)
	{
		if(this.useRTE=='INNOVA')
			this.iframeElem.contents().find('#'+this.innerIframeId).contents().find('body').html(val);
		else
			this.iframeElem.contents().find('#'+this.iframeElemId).contents().find('body').html(val);
	}
	
});

Runner.controls.RTECK = Runner.extend(Runner.controls.RTEField, {
	
	constructor: function(cfg){	
		Runner.controls.RTECK.superclass.constructor.call(this, cfg);
		nWidth = Runner.pages.PageSettings.getFieldData(this.tName,this.fieldName,'nWidth', cfg.pageType);
		nHeight = Runner.pages.PageSettings.getFieldData(this.tName,this.fieldName,'nHeight', cfg.pageType);
		if (this.appearOnPage()){
			CKEDITOR.replace(this.valContId, { "width": nWidth, "height": nHeight });			
		}
		
	},
	
	getEditor: function(){
		if (!window.CKEDITOR){
			return false;			
		}
		if (typeof window.CKEDITOR.instances[this.valContId] == 'undefined'){
			return false;	
		}
		return window.CKEDITOR.instances[this.valContId];
	},
	
	destructor: function(){
		var editor = this.getEditor();
		if (editor!==false){
			CKEDITOR.remove(editor);
		}		
	},
	
	getValue: function(){
		this.initIframeElem();
		Runner.controls.RTECK.superclass.getValue.call(this);
		var editor = this.getEditor();
		if (editor===false){
			return false;	
		}
		return editor.getData();
	},
	
	setValue: function(val){
		var editor = this.getEditor();
		if (editor===false){
			return false;	
		}
		editor.setData(val);
		
		return true;	
	},
	
	setDisabled: function() {
		Runner.controls.RTECK.superclass.setDisabled.call(this);
		var divContElem = $("#disabledCKE_"+this.valContId);
		divContElem.css('display','none');
	},
	
	setEnabled: function(){
		Runner.controls.RTECK.superclass.setDisabled.call(this);
		var divContElem = $("#disabledCKE_"+this.valContId);
		divContElem.css('display','block');
	},
	
	initToolTip: function(text, pageObj){
		if (this.valueElem.addClass && this.mode != Runner.controls.constants.MODE_SEARCH && this.valueElem.parent().length && this.valueElem.parent().get(0).nodeName == "SPAN"){
			this.valueElem.parent().addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: pageObj.fly});
			this.initToolTip = Runner.emptyFn;
			return true;
		}else{
			return false;
		}
	},
	
	makeReadonly: function(){
		this.setDisabled();
	},
	
	makeReadWrite: function(){
		this.setEnabled();
	}
});



/**
 * Base abstract class for all file controls. Should not be created directly.
 * @requires Runner.controls.Control
 * @class Runner.controls.FileControl
 */
Runner.controls.FileControl = Runner.extend(Runner.controls.Control, {
	/**
	 * Radio DOM elem id
	 * @type {string} 
	 */
	radioElemsName: "",
	/**
	 * Radio jQuery obj
	 * @type {Object} 
	 */
	radioElems: null,
	/**
	 * Is control empty or not
	 * @type {Object} 
	 */
	notEmptyCntrl: 0,
	
	/**
	 * Override parent contructor
	 * @constructor
	 * @param {Object} cfg
	 */
	constructor: function (cfg){
		this.radioElems = {};
		cfg.stopEventInit = true;
		//call parent
		Runner.controls.FileControl.superclass.constructor.call(this, cfg);	
		
		var notEmpty = $("#notempty_"+this.goodFieldName+"_"+this.id);
		this.notEmptyCntrl = parseInt($(notEmpty).val());
		
		// add radio DOM elem ID		
		this.radioElemsName = "type_"+this.goodFieldName+"_"+this.id;
		// for ASP version in inline add mode, there are no radios, but one input type hidden
		if ($('#'+this.radioElemsName).length){
			this.getChekedRadio = function(){
				return false;
			}
		}
		// add radio DOM elem ID,
		this.getRadioControls();
		// add events
		this.events = ["change"];
		// clear blur event
		delete this["blur"];
		//event elem
		this.elemsForEvent = [this.valueElem.get(0)];
		// init events
		this.init();
	},
	/**
	 * Clear blur event handler
	 */
	"blur": Runner.emptyFn,
	/**
	 * Add change event base handler
	 * @param {Object} e
	 */
	"change": function(e){
		// stop event
		this.stopEvent(e);
		// set radio button to update
		this.changeRadio("updateRadio");
		// validate and return validation result
		return this.validate();
	},
	/**
	 * Radio buttons switcher. Call when need change radio
	 * @param {string} radioToCheck Name of radio button.
	 */
	changeRadio: function(radioToCheck){
		for(var radio in this.radioElems){
			// if exists radio button
			if (radio == radioToCheck && this.radioElems[radio]!=false){
				this.radioElems[radio].elem.get(0).checked = true;
				this.radioElems[radio].cheked = true;
			// if not exists return false
			}else if(radio == radioToCheck && this.radioElems[radio]==false){
				return false;
			// switch other radios	
			}else if(this.radioElems[radio]!=false){
				this.radioElems[radio].elem.get(0).checked = false;
				this.radioElems[radio].cheked = false;
			}
		}
		// in success
		return true;
	},
	/**
	 * Get object which contains radio elems
	 * @method
	 * @return {bool}
	 */
	getRadioControls: function(){
		var keepRadio = $('#'+this.radioElemsName+'_keep');
		var ctrl = this;
		keepRadio.bind('click', function(e){
			ctrl.changeRadio('keepRadio');
		});
		var deleteRadio = $('#'+this.radioElemsName+'_delete');
		deleteRadio.bind('click', function(e){
			ctrl.changeRadio('deleteRadio');
		});
		var updateRadio = $('#'+this.radioElemsName+'_update');
		updateRadio.bind('click', function(e){
			ctrl.changeRadio('updateRadio');
		});
		// create radioElems obj
		this.radioElems["keepRadio"] = keepRadio.length ? {elem: keepRadio, cheked: true} : false;		
		this.radioElems["deleteRadio"] = deleteRadio.length ? {elem: deleteRadio, cheked: false} : false;
		this.radioElems["updateRadio"] = updateRadio.length ? {elem: updateRadio, cheked: false} : false;
		return true;
	},
	/**
	 * Return name of cheked radio
	 * @return {string}
	 */
	getChekedRadio: function(){
		for(var radio in this.radioElems){
			if (this.radioElems[radio]!=false && this.radioElems[radio].cheked === true){
				return radio;
			}
		}
		return false;
	},
	
	validate: function(valArr){
		
		if(this.notEmptyCntrl && (this.mode == Runner.pages.constants.PAGE_EDIT || this.mode == Runner.pages.constants.PAGE_INLINE_EDIT)){
			return {result: true, messageArr: []};
		}else {
			return Runner.controls.FileControl.superclass.validate.call(this, valArr);
		}
	},

	/**
	 * Returns array of jQuery object for inline submit
	 * @return {array}
	 */
	getForSubmit: function(){
		// array of fileValue, and cheked radio
		var radio = this.getChekedRadio();
		var cloneArr = [];
		// make real clone of radio, to prevent troubles in IE
		if (radio){
			var radioClone = document.createElement('input');
			$(radioClone).attr('type', 'hidden');
			$(radioClone).attr('id', this.radioElems[radio].elem.attr('id'));
			$(radioClone).attr('name', this.radioElems[radio].elem.attr('name'));
			$(radioClone).val(this.radioElems[radio].elem.val());
			cloneArr.push($(radioClone));
		// for ASP version in inline add mode, there are no radios, but one input type hidden
		}else if($('#'+this.radioElemsName).length){
			cloneArr.push($('#'+this.radioElemsName));
		}
		// add real file elem
		var realFile = this.valueElem;
		var clone = this.valueElem.clone(true);
		clone.insertAfter(realFile); 
		cloneArr.push(realFile);
		this.valueElem = clone;
		return cloneArr;
	},
	
	makeReadonly: function(){
		this.valueElem.attr('disabled',true);
		if (this.radioElems.keepRadio){
			this.radioElems.keepRadio.elem.attr('disabled',true);
		}	
		if (this.radioElems.updateRadio){
			this.radioElems.updateRadio.elem.attr('disabled',true);
		}	
		if (this.radioElems.deleteRadio){
			this.radioElems.deleteRadio.elem.attr('disabled',true);
		}	
		return true;
	},
	
	makeReadWrite: function(){
		this.valueElem.attr('disabled', false);
		if (this.radioElems.keepRadio){
			this.radioElems.keepRadio.elem.attr('disabled',false);
		}	
		if (this.radioElems.updateRadio){
			this.radioElems.updateRadio.elem.attr('disabled',false);
		}	
		if (this.radioElems.deleteRadio){
			this.radioElems.deleteRadio.elem.attr('disabled',false);
		}	
		return true;
	},	
	
	/**
	 * Checks if control value is empty. Used for isRequired validation
	 * For files has specific criterias
	 * @override
	 * @method
	 * @return {bool}
	 */
	isEmpty: function(){
		if(this.mode == Runner.pages.constants.PAGE_EDIT || this.mode == Runner.pages.constants.PAGE_INLINE_EDIT){
			if(this.notEmptyCntrl){
				return false;
			}else{
				if (typeof(this.fileNameElem) != 'undefined' && this.fileNameElem){
					if (this.fileNameElem.get(0).value == ''){
						this.fileNameElem.get(0).value = this.fileNameElem.get(0).defaultValue;
					}
				}
				return (this.radioElems["keepRadio"].cheked === true || this.getValue().toString() == "" || this.radioElems["updateRadio"].cheked === false)
			}
		}else{
			if (typeof(this.fileNameElem) != 'undefined' && this.fileNameElem){
				if (!(this.getValue().toString() == "") && (this.fileNameElem.get(0).value == ''))
					this.fileNameElem.get(0).value = this.fileNameElem.get(0).defaultValue;
			}
			return (this.getValue().toString() == "")
		}
	},
	
	/**
	 * Set to radio buttons default value 
	 */
	resetRadio: function(){
		for(var radio in this.radioElems){
			// if exists radio button
			if (this.radioElems[radio]!=false){
				this.radioElems[radio].elem.get(0).checked = this.radioElems[radio].elem.get(0).defaultChecked;
				this.radioElems[radio].cheked = this.radioElems[radio].elem.get(0).defaultChecked;
			}
		}
	}
});

/**
 * Class for image field controls.
 * @requires Runner.controls.FileControl
 * @class Runner.controls.ImageField
 */
Runner.controls.ImageField = Runner.extend(Runner.controls.FileControl, {
	
	imgElem: null,
	
	/**
	 * Override parent contructor
	 * @constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){
		//call parent
		Runner.controls.ImageField.superclass.constructor.call(this, cfg);	
		this.imgElemId = "image_"+this.goodFieldName+"_"+this.id;	
		this.imgElem = $("#"+this.imgElemId);	
	},
	
	setValue: function(val, triggerEvent, updContext){
		if ($(val).attr('src')){
			this.imgElem.attr('src', ($(val).attr('src') + "&rndVal=" + Math.random()));
		}else{
			Runner.controls.ImageField.superclass.setValue.call(this, val, triggerEvent, updContext);
			if (updContext && updContext.resetHappend){
				this.resetRadio();
			}
		}
	}
	
});

/**
 * Class for file field controls. For images use Runner.controls.ImageField
 * @requires Runner.controls.FileControl
 * @class Runner.controls.FileField
 */
Runner.controls.FileField = Runner.extend(Runner.controls.FileControl, {
	/**
	 * Indicates if need to add timeStamp to fileName
	 * @type {bool} 
	 */
	addTimeStamp: false,
	/**
	 * ID of filename elem
	 * @type {string}
	 */
	fileNameElemId: "",
	/**
	 * Filename textfield jQuery object
	 * @param {Object} 
	 */
	fileNameElem: null,
	/**
	 * ID of hidden fileName DOM elem
	 * @type String
	 */
	fileHiddElemId: "",
	/**
	 * jQuery object of hidden fileName DOM elem
	 * @type {object} 
	 */
	fileHiddElem: null,	
	/**
	 * Override parent contructor
	 * @constructor
	 * @param {Object} cfg
	 * @param {bool} cfg.addTimeStamp
	 */
	constructor: function (cfg){
		cfg.stopEventInit = true;
		//call parent
		Runner.controls.FileField.superclass.constructor.call(this, cfg);
		// add fileName DOM elem	
		this.fileNameElemId = "filename_"+this.goodFieldName+"_"+this.id;	
		this.fileNameElem = $("#"+this.fileNameElemId).length ? $("#"+this.fileNameElemId) : null; 
		// add fileName hidden DOM elem
		this.fileHiddElemId = "filenameHidden_"+this.goodFieldName+"_"+this.id;	
		this.fileHiddElem = $("#"+this.fileHiddElemId).length ? $("#"+this.fileHiddElemId) : null;
		//timeStamp to fileName indicator
		this.addTimeStamp = cfg.addTimeStamp || Runner.pages.PageSettings.getFieldData(this.table, this.fieldName, 'isUseTimeStamp', cfg.pageType);
		// add radio buttons style switchers
		for (radio in this.radioElems){
			// if exists radio	
			if (this.radioElems[radio]){
				// create closure event handler
				var objScope = this;
				// add handler
				this.radioElems[radio].elem.bind('click', function(e){
					// get name of radio object
					var radioTypeStartFrom = this.id.lastIndexOf('_');
					var radioTypeName = this.id.substring(radioTypeStartFrom+1)+'Radio';
					// change styles
					objScope.changeControlsStyles(radioTypeName);
				});//)[0].onclick = onRadioClickHandler//.call(this, this)
			}
		}
		
		setTimeout(function(){
			var zoomboxes = $('.zoombox');
			if(zoomboxes.length)
				zoomboxes.zoombox({
					theme: 'zoombox', opacity: 0.8,
					duration: 400, animation: false,
					gallery: false, autoplay : false
				});
		}, 10);
	},
	
	/**
	 * Override addValidation
	 * @method
	 * @param {string} type
	 */
	addValidation: function(type){
		// date field can be validated only as isRequired
		if (type!="isRequired"){
			return false;
		}
		// call parent
		Runner.controls.FileField.superclass.addValidation.call(this, type);
	},
	/**
	 * Cuts name of file from path
	 * @param {string} path
	 * @return {string}
	 */
	getFileNameFromPath: function(path){
		var wpos=path.lastIndexOf('\\'); 
		var upos=path.lastIndexOf('/'); 
		var pos=wpos; 
		if(upos>wpos)
			pos=upos; 
		return path.substr(pos+1);
	},
	/**
	 * Override setValue function, for files need to change radio control status
	 * @method
	 * @param {file} val
	 */
	setValue: function(val, triggerEvent, updContext){
		var valWithStamp = "", 
			fileName = "";
		// if need to get filename without path
		if (this.fileNameElem != null || this.addTimeStamp){
			fileName = this.getFileNameFromPath(this.valueElem.val());
		}
		// add timestamp if needed
		if (this.addTimeStamp){
			var valWithStamp = this.addTimestamp(fileName);
		}
		// if name element exists, set new value
		if (this.fileNameElem != null){
			this.fileNameElem.val(valWithStamp || fileName);
			this.fileNameElem.get(0).defaultValue = (valWithStamp || fileName);
		}
		//check if 
		if (updContext && updContext.resetHappend){
			this.valueElem.val(updContext.values[this.fieldName]);
			if (this.fileNameElem != null) {
				this.fileNameElem.val(this.fileNameElem.get(0).defaultValue);
			}
			this.resetRadio();
		}
		
		if(triggerEvent===true){
			this.fireEvent("change", updContext);
		}
	},
	
	/**
	 * Add timestap to file name
	 * @param {string} file name
	 * @return {string}
	 */
	addTimestamp: function(filename){
		var wpos = filename.lastIndexOf('.');
		if(wpos<0){
			return filename+'-'+this.getTimestamp();
		}	
		return filename.substring(0,wpos)+'-'+this.getTimestamp()+filename.substring(wpos);
	},
	
	/**
	 * Get timestap
	 * @return {string}
	 */
	getTimestamp: function(){
		var ts = "", now = new Date();
		ts += now.getFullYear();
		ts += this.padDateValue(now.getMonth()+1, false);
		ts += this.padDateValue(now.getDate(), false)+'-';
		ts += this.padDateValue(now.getHours(), false);
		ts += this.padDateValue(now.getMinutes(), false);
		ts += this.padDateValue(now.getSeconds(), false);
		return ts;
	},
	
	/**
	 * Pad date value
	 * @param {integer} value of date 
	 * @param {boolean} use three-digits or not
	 * @return {string}
	 */
	padDateValue: function(value,threedigits){
		if(!threedigits){
			if(value>9){
				return ''+value;
			}
			return '0'+value;
		}
		if(value>9){
			if(value>99){
				return ''+value;
			}	
			return '0'+value;
		}
		return '00'+value;
	},
	
	/**
	 * Change file value event handler. 
	 * Changes radio to update, validates, and change fileName if file pass validation
	 * @method
	 * @param {Object} e
	 */
	"change": function(e){
		this.stopEvent(e);
		var vRes = null;
		if(!arguments[1] || !arguments[1].resetHappend){
			this.changeRadio("updateRadio");
			vRes = this.validate();
			if (vRes.result){
				var vl = this.getValue();
				this.setValue(vl, false);
			}
		}
		else
			vRes = this.validate();
		return vRes.result;
	},
	/**
	 * Override radio buttons switcher, add call change styles method
	 * @param {string} radioToCheck
	 */
	changeRadio: function(radioToCheck){
		// change styles
		this.changeControlsStyles(radioToCheck);
		// call parent
		Runner.controls.FileField.superclass.changeRadio.call(this, radioToCheck);
	},
	/**
	 * Change styles and set disabled filename field
	 * @param {Object} radioToCheck
	 */
	changeControlsStyles: function(radioToCheck){
		// if such radio button defined
		if (!this.radioElems[radioToCheck]){
			return false;
		}
		// if there is filename that need to be changed
		if (this.fileNameElem == null) {
			return false;
		}
		// if choosed delete
		if (radioToCheck == "deleteRadio"){
			this.fileNameElem.css('backgroundColor','gainsboro');
			this.fileNameElem[0].disabled=true;
			return true;
		// if choosed update or keep
		}else if(radioToCheck == "updateRadio" || radioToCheck == "keepRadio"){
			this.fileNameElem.css('backgroundColor','white');
			this.fileNameElem[0].disabled=false;
			return true;
		// in other way return false
		}else{
			return false;
		}
	},
	
	/**

	 * Get fileName from fileName type text elem.
	 * @return {string}
	 */
	getFileName: function(){
		if (this.fileHiddElem){
			return this.fileHiddElem.val();
		}else{
			return false;
		}
	},
	/**
	 * Set fileName to fileName type text elem.
	 * @param {string} fileName
	 * @return {Boolean}
	 */
	setFileName: function(fileName){
		if (this.fileHiddElem){
			this.fileHiddElem.val(fileName);
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Returns array of jQuery object for inline submit
	 * @return {array}
	 */
	getForSubmit: function(){
		var cloneArr = Runner.controls.ImageField.superclass.getForSubmit.call(this);	
		if (this.fileNameElem){
			cloneArr.push(this.fileNameElem.clone());
		}
		if (this.fileHiddElem){
			cloneArr.push(this.fileHiddElem.clone());
		}
		return cloneArr;
	}
	
	
});

/**
 * Class for multiple file field controls.
 * @requires Runner.controls.Control
 * @class Runner.controls.MultiUploadField
 */
Runner.controls.MultiUploadField = Runner.extend(Runner.controls.Control, {
	/**
	 * From object for files upload
	 * @type {jQuery object}
	 */
	uploadForm: null,
	
	fileArray: null,
	
	autoUpload: false,
	
	maxFileSize: undefined,
	
	maxTotalFilesSize: undefined,
	
	maxNumberOfFiles: undefined,
	
	acceptFileTypes: undefined,
	
	isInline: false,
	
	/**
	 * Indicator whether an error happend during an upload  
	 */
	errorHappened: false,
	
	/**
	 * Indicator whether an error happend during add file  
	 */
	errorHappenedOnAdd: false, 
	
	/**
	 * Count of files which are waiting for upload
	 */
	filesToUploadCount: 0,
	
	/**
	 * Override parent contructor
	 * @constructor
	 * @param {Object} cfg
	 */
	constructor: function (cfg){
		cfg.stopEventInit = true;
		Runner.controls.MultiUploadField.superclass.constructor.call(this, cfg);
		this.elemsForEvent = [this.valueElem.get(0)];
		this.addEvent(['change']);
		
		this.initTemplates();
	},
	
	initTemplates: function(){
		var control = this, uploadTemplateId = "template-upload", downloadTemplateId = "template-download";
		this.init();
	},
	
	init: function(){
		this.uploadForm = $("#fileupload_" + this.goodFieldName + "_" + this.id);
		if(Runner.isIE && Runner.isDirRTL()){
			$('span.btn.btn-success.fileinput-button', this.uploadForm[0]).replaceWith($('input.fileinput-button-input', this.uploadForm[0])
					.css({
						  "position": "static",
						  "border": "",
						  "border-width": 0,
						  "opacity": "",
						  "filter": ""
					}).addClass("btn btn-success fileinput-button"));
    	}else{
    		$('input.fileinput-button-input', this.uploadForm[0]).css("right", "0");
    	}
		this.fileArray = $("#value_" + this.goodFieldName + "_" + this.id);
		this.uploadForm[0].action += "?table=" + this.table + "&field=" + this.fieldName + "&pageType=" + this.pageType
			+ "&formStamp=" + $("#formStamp_" + this.goodFieldName + "_" + this.id, this.uploadForm).val();
		this.uploadForm.fileupload();
		this.uploadForm.fileupload("option", {
			autoUpload: this.autoUpload,
			acceptFileTypes: new RegExp(this.acceptFileTypes, "i"),
			dropZone: this.uploadForm,
			maxFileSize: this.maxFileSize,
			maxTotalFilesSize: this.maxTotalFilesSize,
			maxNumberOfFiles: this.maxNumberOfFiles != undefined ? this.maxNumberOfFiles - $.parseJSON(this.fileArray.val()).length 
					: undefined,
			constMaxNumberOfFiles: this.maxNumberOfFiles
		});

    	var control = this, controlId = this.goodFieldName + "_" + this.id;
    	
	    // Load existing files:
    	this.reloadFiles();
    	
    	this.showDropZone();

    	this.uploadForm.bind('fileuploadadded', function(e, data){
    		if(Runner.isGecko)
    			$('input[name="focusDummy"]', control.uploadForm[0]).focus();
   			control.hideDropZone();
   			if(data.files){
	   			if(!data.files[0].error)
	   				control.filesToUploadCount++;
	   			else
	   				control.errorHappenedOnAdd = true;
   			}
    		control.uploadForm.fileupload('setUploadAndCancelButtonState', control.filesToUploadCount > 0);
    		control.fireEvent('change');
    	});
    	this.uploadForm.bind('fileuploaddone', function(e, data){
    		if(control.filesToUploadCount > 0)
    			control.filesToUploadCount--;
    		control.uploadForm.fileupload('setUploadAndCancelButtonState', control.filesToUploadCount > 0);
    		if(data.textStatus != 'success' || !data.result || data.result.length == 0){
    			control.errorHappened = true;
    			return;
    		}
			if(!data.result[0].error){
				var fileArray = $.parseJSON(control.fileArray.val()), newFile = data.result[0];
				newFile.isNew = true; 
				fileArray.push(newFile)
				control.uploadForm.fileupload('setDeleteButtonState', fileArray.length > 0);
				control.fileArray.val(JSON.stringify(fileArray));
			}else{
    			control.errorHappened = true;				
			}
			control.clearInvalid();
    	});
    	this.uploadForm.bind('fileuploadfail', function(e, data){
    		if(control.filesToUploadCount > 0)
    			control.filesToUploadCount--;
    		control.uploadForm.fileupload('setUploadAndCancelButtonState', control.filesToUploadCount > 0);
    		control.showDropZone();
    	});
    	this.uploadForm.bind('fileuploaddestroyed', function(e, data){
			var fileArray = $.parseJSON(control.fileArray.val()), newFileArray = [];
			$.each(fileArray, function (index, element){
				if(element.name != data.name)
					newFileArray.push(element);
			});
			control.uploadForm.fileupload('setDeleteButtonState', newFileArray.length > 0);
			control.fileArray.val(JSON.stringify(newFileArray));
			control.showDropZone();
	    });
    	
    	this.uploadForm.fileupload({
    	    destroy: function (e, data) {
	            var that = $(this).data('fileupload'), button = $(data.context.context),
	            	data = {
	            		context: button.closest('.template-download'),
	                    url: e.data.fileupload.element[0].action,
	                    type: 'POST',
	                    dataType: e.data.fileupload.options.dataType,
	                    name: button.attr('data-name'),
	                    data: {
	            			_action: "DELETE",
	            			fileName: button.attr('data-name')
	            		}
	            };
                $.ajax(data);
                that._adjustMaxNumberOfFiles(1);
	            that._transition(data.context).done(
	                function () {
	                    $(this).remove();
	                    that._trigger('destroyed', e, data);
	                }
	            );
            }
    	});
	},
	
	hideDropZone: function(){
		if((this.errorHappenedOnAdd || this.filesToUploadCount == 0) && !Runner.isIE && !Runner.isMobile){
			var fileProgresDiv = $(".fileupload-progress", this.uploadForm);
			if(fileProgresDiv.hasClass("runner-dragndrop-area")){
	    		fileProgresDiv.removeClass("runner-dragndrop-area").children(".runner-dragtext").remove();
			}
		}
	},
	
	showDropZone: function(){
		if(!this.errorHappenedOnAdd 
				&& $.parseJSON(this.fileArray.val()).length == 0 
				&& this.filesToUploadCount == 0 
				&& !Runner.isIE 
				&& !Runner.isMobile){
			var progressEl = $(".fileupload-progress", this.uploadForm);
			if(!progressEl.hasClass("runner-dragndrop-area"))
				progressEl.addClass("runner-dragndrop-area").prepend('<div class="runner-dragtext">' + Runner.lang.constants.UPLOAD_DRAG + '</div>');
			var preventFunction = function(event){
				if(event){
					event.originalEvent.dataTransfer.dropEffect='none'; 
					event.stopPropagation(); 
					event.preventDefault();
				}
				return false;
			};
			$(document).unbind("drop.multiupload")
				.unbind("dragenter.multiupload")
				.unbind("dragleave.multiupload")
				.unbind("dragstart.multiupload")
				.on("drop.multiupload", function(){
					return false; 
				})
				.on("dragenter.multiupload", preventFunction)
				.on("dragover.multiupload", preventFunction)
				.on("dragstart.multiupload", preventFunction);
		}
		else{
    		this.hideDropZone();
    	}
	},
	
    // Load existing files:
	reloadFiles: function(){
		var initialFileArray = $.parseJSON(this.fileArray.val());
		this.uploadForm.fileupload("option", {
			maxNumberOfFiles: this.maxNumberOfFiles != undefined ? this.maxNumberOfFiles - initialFileArray.length 
					: undefined
		});
    	this.uploadForm.fileupload('option', 'done').call(this.uploadForm, null, {result: initialFileArray});
		this.uploadForm.fileupload('refreshMaxFilesState');
    	this.uploadForm.fileupload('setDeleteButtonState', initialFileArray.length > 0);
    	this.uploadForm.fileupload('setUploadAndCancelButtonState', this.filesToUploadCount > 0);
    	
    	return initialFileArray.length;
	},
	
	reset: function(updContext){
		this.setValue(this.defaultValue, true, updContext);
		this.clearInvalid();
		this.filesToUploadCount = 0;
		$('table tbody', this.uploadForm).empty();
		this.reloadFiles();
		this.showDropZone();
		return true;
	},
	
	/**
	 * Clear blur event handler
	 */
	"blur": Runner.emptyFn,
	/**
	 * Add change event base handler
	 * @param {Object} e
	 */
	"change": function(e){
		// stop event
		this.stopEvent(e);
		// validate and return validation result
		return this.validate();
	},
	
	validate: function(valArr){
		
		if(this.notEmptyCntrl && (this.mode == Runner.pages.constants.PAGE_EDIT || this.mode == Runner.pages.constants.PAGE_INLINE_EDIT)){
			return {result: true, messageArr: []};
		}else {
			return Runner.controls.FileControl.superclass.validate.call(this, valArr);
		}
	},

	/**
	 * Returns array of jQuery object for inline submit
	 * @return {array}
	 */
	getForSubmit: function(){
		var cloneArr = [];
		cloneArr.push(this.valueElem.clone());
		cloneArr.push($("#formStamp_" + this.goodFieldName + "_" + this.id, this.uploadForm).clone());
		return cloneArr;
	},
	
	makeReadonly: function(){
		this.valueElem.attr('disabled',true);
		this.uploadForm.fileupload('disable');
		return true;
	},
	
	makeReadWrite: function(){
		this.valueElem.attr('disabled', false);
		this.uploadForm.fileupload('enable');	
		return true;
	},	
	
	/**
	 * Checks if control value is empty. Used for isRequired validation
	 * For files has specific criterias
	 * @override
	 * @method
	 * @return {bool}
	 */
	isEmpty: function(){
		return this.getValue().toString() == "" || this.getValue().toString() == "[]";
	}
});

/**
 * Abstract base class for date fields, should not created directly
 * @class Runner.controls.DateField
 */
Runner.controls.DateField = Runner.extend(Runner.controls.Control, {
	/**
	 * Id of hidden elem, which used by datepicker
	 * @type {string} 
	 */
	datePickerHiddId: "",
	/**
	 * Hidden elem, which used by datepicker
	 * ts element
	 * @type {element} 
	 */
	datePickerHiddElem: null,
	/**
	 * Image and link of datepicker
	 * link element
	 * @type {element} 
	 */
	imgCal: null,
	/**
	 * Indicates used datepicker with control or not
	 * @type {bool} cfg
	 */
	useDatePicker: false,
	/**
	 * Id of date format hidden element, which used on serverside
	 * @type {string}
	 */
	dateFormatHiddId: "",
	/**
	 * Indicates date format with control or not
	 * @type {bool} cfg
	 */
	dateFormat: "",
	/**
	 * Indicates show time with control or not
	 * @type {bool} cfg
	 */
	showTime: false,
	/**
	 * jQuery object of date format hidden element, which used on serverside
	 * @type {Object} 
	 */
	dateFormatHiddElem: null,
	
	dataPicker: null,
	
	timeBox: null,
	
	dateDelimiter: "/",
	
	startWeekDay: 0,
	
	pageType: "",
	
	/**
	 * Overrides parent constructor
	 * @param {Object} cfg
	 * @param {bool} cfg.useDatePicker
	 */
	constructor: function(cfg){
		// call parent
		Runner.controls.DateField.superclass.constructor.call(this, cfg);
		// add hidden field for datepicker usege
		this.useDatePicker = cfg.useDatePicker ? cfg.useDatePicker : false;
		
		this.dateFormat = typeof cfg.dateFormat != "undefined" ? cfg.dateFormat : Runner.pages.PageSettings.getGlobalData("locale").dateFormat;
		this.dateDelimiter = Runner.pages.PageSettings.getGlobalData("locale")["dateDelimiter"];
		this.startWeekDay = (Number(Runner.pages.PageSettings.getGlobalData("locale").startWeekDay) + 1) % 7;
		this.showTime = Runner.pages.PageSettings.getFieldData(this.table, this.fieldName, "showTime", this.pageType);
		
		// add hidden field for date format on serverside
		this.dateFormatHiddId = "type"+(cfg.ctrlInd || "")+"_"+this.goodFieldName+"_"+this.id;
		this.dateFormatHiddElem = $("#"+this.dateFormatHiddId);	
		
		this.initDataPicker();
	},	
	
	initDataPicker: function(){
		if(!this.useDatePicker){
			this.initDataPicker = Runner.emptyFn;
			return false;
		}
		
		this.imgCal = $('#imgCal_'+this.valContId);
		this.datePickerHiddId = "tsvalue"+(this.ctrlInd || "")+"_"+this.goodFieldName+"_"+this.id;
		this.datePickerHiddElem = $("#"+this.datePickerHiddId);
		
		// for closure
		var dateControl = this;
		// YUI init code
		this.imgCal.bind("click", function(e){
			(function(e){
				Runner.Event.prototype.stopEvent(e);
				
				var args = {
						modal: true,
						render: true,
						resize: false, // not yui attr
						centered: true,
						headerContent: "&nbsp;", //Pick A Date
						footerContent: "&nbsp;"
					};
					
				var destroyCalendar;
				
				var initDatePicker = function(calWin){
					var Y = Runner.Y ;
					
					Y.use('calendar', 'datatype-date', function(Y){
						
						var date = new Date(),
							currentYear = date.getFullYear(),
							initialYear = Runner.pages.PageSettings.getFieldData(dateControl.table, dateControl.fieldName, "initialYear", dateControl.pageType),
							lastYear = Runner.pages.PageSettings.getFieldData(dateControl.table, dateControl.fieldName, "lastYear", dateControl.pageType),
							startYear = dateControl.startYear = currentYear - initialYear,
							endYear = dateControl.endYear = currentYear + lastYear;
							
						var addCalId = "cal" + (new Date().getTime() + '' + Math.floor(Math.random()*100));
						calWin.set('bodyContent', '<div id="' + addCalId + '"></div>');

						//set a navigation for right-to-left languages
						if ( Runner.isDirRTL() ) {											
							Y.Plugin.CalendarNavigator.CALENDARNAV_STRINGS.prev_month_class = Y.ClassNameManager.getClassName('calendarnav', 'nextmonth');							
							Y.Plugin.CalendarNavigator.CALENDARNAV_STRINGS.next_month_class = Y.ClassNameManager.getClassName('calendarnav', 'prevmonth');														
						}
						
						var calendar = new Y.Calendar({
							contentBox: '#' + addCalId,
							minimumDate: new Date("1/1/" + startYear),
							maximumDate: new Date("12/31/" + endYear),
							showPrevMonth: true,
							showNextMonth: true
						});
						if(Runner.isIE){
							calendar.set('width', '250px');
							calendar.set('height', '204px');
						}
						
						// localize weekdays
						calendar.set("strings.first_weekday", dateControl.startWeekDay);
						calendar.set("strings.weekdays", [Runner.lang.constants.TEXT_DAY_SU, Runner.lang.constants.TEXT_DAY_MO, Runner.lang.constants.TEXT_DAY_TU, Runner.lang.constants.TEXT_DAY_WE, Runner.lang.constants.TEXT_DAY_TH, Runner.lang.constants.TEXT_DAY_FR, Runner.lang.constants.TEXT_DAY_SA]);
						calendar.set("strings.short_weekdays", [Runner.lang.constants.TEXT_DAY_SU, Runner.lang.constants.TEXT_DAY_MO, Runner.lang.constants.TEXT_DAY_TU, Runner.lang.constants.TEXT_DAY_WE, Runner.lang.constants.TEXT_DAY_TH, Runner.lang.constants.TEXT_DAY_FR, Runner.lang.constants.TEXT_DAY_SA]);
						calendar.set("strings.very_short_weekdays", [Runner.lang.constants.TEXT_DAY_SU, Runner.lang.constants.TEXT_DAY_MO, Runner.lang.constants.TEXT_DAY_TU, Runner.lang.constants.TEXT_DAY_WE, Runner.lang.constants.TEXT_DAY_TH, Runner.lang.constants.TEXT_DAY_FR, Runner.lang.constants.TEXT_DAY_SA]);
						
						// destroy calendar handler
						destroyCalendar = function(){
							calendar.destroy();
							setTimeout(function(){
								calWin.destroy(true);
							}, 0);
						};
						
						// replace header 
						calendar.set("headerRenderer", function (curDate) {
							var curYear = curDate.getFullYear(),
								curMonth = curDate.getMonth(),
								minYear = this.get('minimumDate').getFullYear(),
								maxYear = this.get('maximumDate').getFullYear();
							
							this.yearDDId = this._calendarId + '_year_dd';
							this.monthDDId = this._calendarId + '_month_dd';
								
							var monthNames = [
								Runner.lang.constants.TEXT_MONTH_JAN,
								Runner.lang.constants.TEXT_MONTH_FEB,
								Runner.lang.constants.TEXT_MONTH_MAR,
								Runner.lang.constants.TEXT_MONTH_APR,
								Runner.lang.constants.TEXT_MONTH_MAY,
								Runner.lang.constants.TEXT_MONTH_JUN,
								Runner.lang.constants.TEXT_MONTH_JUL,
								Runner.lang.constants.TEXT_MONTH_AUG,
								Runner.lang.constants.TEXT_MONTH_SEP,
								Runner.lang.constants.TEXT_MONTH_OCT,
								Runner.lang.constants.TEXT_MONTH_NOV,
								Runner.lang.constants.TEXT_MONTH_DEC
							];
							
							var monthDD = '<select class="runner-calMonthDD" id="' + this.monthDDId + '">';
							for(var i=0; i<monthNames.length; i++){
								monthDD += '<option value="' + i + '"';
								if (i == curMonth){
									monthDD += 'selected="selected"';
								}
								monthDD += '>' + monthNames[i] + '</option>';
							}
							monthDD += '</select>';
							
							var yearDD = '<select class="runner-calYearDD" id="' + this.yearDDId + '">';
							for (var i = minYear; i<=maxYear; i++){
								yearDD += '<option value="' + i + '"';
								if (i == curYear){
									yearDD += 'selected="selected"';
								}
								yearDD += '>' + i + '</option>';
							}
							yearDD += '</select>';
							
							return monthDD + yearDD;
						});
						
						// subscribe on selection change event for calendar
						var selectionHandler = function (e) {
							if(!calendar.get("selectedDates").length)
								return;
							var selDate = calendar.get("selectedDates")[0],
								selTime = dateControl.getTime(); 
							if (selTime){
								var timeArr = selTime.split(":");
								selDate.setHours(timeArr[0]);
								selDate.setMinutes(timeArr[1]);
								selDate.setSeconds(timeArr[2]);
							}
							dateControl.setValue(selDate, true); 
							destroyCalendar();
							e.stopImmediatePropagation();
						};
						calendar.on("dateClick", selectionHandler);
						
						// subscribe on render event for calendar
						calendar.after("render", function(){
							var contentBox = $(calendar.get('contentBox').getDOMNode());
							contentBox.delegate('#' + calendar.yearDDId, 'change', function(e){
								var val = parseInt(this.value);
								if (val < endYear + 1 && val > startYear - 1){
									var oldDate = calendar.get("date");
									calendar.set("date", new Date(val, oldDate.getMonth(), 1));
								}
							});
							contentBox.delegate('#' + calendar.monthDDId, 'change', function(e){
								var val = parseInt(this.value),
									oldDate = calendar.get("date");
								calendar.set("date", new Date(oldDate.getFullYear(),val, 1));
							});
						});
						
						// show time edit box
						if(dateControl.showTime){
							var timeSpan = $(document.createElement('DIV')).addClass('runner-calTimeBox');
							dateControl.timeBox = $(document.createElement('INPUT')).
								attr('type', 'text').
									attr('size', '10').
										attr('id', 'timeBox' + dateControl.id).
											attr('maxlength', 8).
												appendTo(timeSpan);
							$(calWin.bodyNode.getDOMNode()).append(timeSpan);
						}
						
						// handler for today button
						function todayHandler() {
							calendar.today = new Date();
							if(!this.showTime){
								calendar.today.setHours(0);
								calendar.today.setMinutes(0);
								calendar.today.setSeconds(0);
							}
							calendar.selectDates(calendar.today);
							this.setValue(calendar.today, true);
							destroyCalendar();
						};
						
						// show today button
						calWin.addButton({
								value: Runner.lang.constants.TEXT_TODAY,
								section: Y.WidgetStdMod.BODY,
								classNames: 'runner-calTodayBut',
								action: function (e) {
									e.preventDefault();
									todayHandler.call(dateControl);
								}
						});
						
						$(".runner-calTodayBut").parent().css({"display": "block", "text-align": "center"});	
						
						var selDate = dateControl.getValue();
						if(typeof selDate == "undefined" || selDate == ""){
							dateControl.setTime(new Date());
						}else{
							dateControl.setTime(selDate);
						}
						if (selDate){
							calendar.set('date', selDate);
							calendar.selectDates(selDate);
						}
						
						calendar.render();
						calWin.render();
						calWin.show();
						
						//	fix for IE: stretch the header
						var node = calWin.get("srcNode").getDOMNode();
						var width = $(node).width();
						if(Runner.isIE){
							width = 270;
						}
						$(node).width(width);
						
						if ( Runner.isDirRTL() ) {
							var centered = $(window).scrollLeft() +  Math.floor(($(window).width() - node.offsetWidth) / 2);					
							calWin.set("x", centered);
						}							
					});	
				};
				
				//create fly win yui panel
				Runner.pages.PageManager.createFlyWin(args, false, initDatePicker, function(){ destroyCalendar(); });	
				
			}).call(dateControl, e);
			
		});
	},
	
	parseDateTime: function(str, dmy){
		if(str == null){
			return null;
		}
		var dt, re = /\d+/g,
			arr = str.match(re);
		if(arr == null || arr.length < 3){
			return null;
		}
		while(arr.length < 6){
			arr[arr.length] = 0;
		}
		if(dmy == 1){
			dt = new Date(arr[2], arr[1]-1, arr[0], arr[3], arr[4], arr[5]);
		}else if(dmy == 0){
			dt = new Date(arr[2], arr[0]-1, arr[1], arr[3], arr[4], arr[5]);
		}else{
			dt = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
		}
		if(isNaN(dt)){
			return null;
		}
	//	check date and month
		if(dmy == 1 && (dt.getMonth()!=arr[1] - 1 || dt.getDate()!=arr[0] || dt.getFullYear()!=arr[2])){
			return null;
		}
		if(dmy == 0 && (dt.getMonth()!=arr[0] - 1 || dt.getDate()!=arr[1] || dt.getFullYear()!=arr[2])){
			return null;
		}
		if(dmy == 2 && (dt.getMonth()!=arr[1] - 1 || dt.getDate()!=arr[2] || dt.getFullYear()!=arr[0])){
			return null;
		}
		return dt;
	},
	
	/**
	 * Override addValidation 
	 * @param {string} type
	 */	
	addValidation: function(type){
		// date field can be validated only as isRequired
		if (type!="IsRequired"){
			return false;
		}
		// call parent
		Runner.controls.DateField.superclass.addValidation.call(this, type);
	},
	
	parseTime: function(dtObj) {
		if (typeof dtObj == "object"){
			return (
				(dtObj.getHours() < 10 ? '0' : '') + dtObj.getHours() + ":"
				+ (dtObj.getMinutes() < 10 ? '0' : '') + (dtObj.getMinutes()) + ":"
				+ (dtObj.getSeconds() < 10 ? '0' : '') + (dtObj.getSeconds())
			);	
		}else{
			return "";
		}
	},
	
	getTime: function(){
		if (this.showTime){
			return this.timeBox.val();
		}else{
			return "";
		}
	},
	
	setTime: function(dtObj){
		if (this.showTime){
			if(dtObj){
				this.timeBox.val(this.parseTime(dtObj));
			}else{
				this.timeBox.val('00:00:00');
			}
		}
	},
	
	setValue: function(newDate){
		if (typeof newDate == "string"){
			return this.parseDateTime(newDate, this.dateFormat);
		}else{
			return newDate;
		}
	},
	/**
	 * format: -1 - native (d-m-y)
				1 - d/m/y
				0 - m/d/y
				2 - y/m/d
	 * @param {} value
	 * @param {} format
	 * @return {}
	 */
	print_datetime: function(value, format){
		var date='';
		
		if(format == -1){
			date += (value.getDate() < 10 ? '0' + value.getDate() : value.getDate()) + '-' + (value.getMonth() < 9 ? '0' + (value.getMonth() + 1) : value.getMonth() + 1) + '-' + value.getFullYear();
		}else if(format == 1){
			date += (value.getDate() < 10 ? '0' + value.getDate() : value.getDate()) + this.dateDelimiter + (value.getMonth() < 9 ? '0' + (value.getMonth() + 1) : value.getMonth() + 1) + this.dateDelimiter + value.getFullYear();
		}else if(format == 0){
			date += (value.getMonth() < 9 ? '0' + (value.getMonth() + 1) : value.getMonth() + 1) + this.dateDelimiter + (value.getDate() < 10 ? '0' + value.getDate() : value.getDate()) + this.dateDelimiter + value.getFullYear();
		}else{
			date += value.getFullYear() + this.dateDelimiter + (value.getMonth() < 9 ? '0' + (value.getMonth() + 1) : value.getMonth() + 1) + this.dateDelimiter + (value.getDate() < 10 ? '0' + value.getDate() : value.getDate());
		}
		if(value.getHours() == 0 && value.getMinutes() == 0 && value.getSeconds() == 0){
			return date;
		}
		
		var time='';
		if(this.showTime){
			if(value.getHours() > 0 || value.getMinutes() > 0 || value.getSeconds() > 0){
				time += (value.getHours() < 10 ? '0' + value.getHours() : value.getHours());
				time += ':' + (value.getMinutes() < 10 ? '0' + value.getMinutes() : value.getMinutes())
			}
			if(value.getSeconds() > 0){
				time += ':' + (value.getSeconds() < 10 ? '0' + value.getSeconds() : value.getSeconds());
			}
		}	
		return date + ' ' + time;
	}
	
});

/**
 * Class for date fields with textField value editor
 * If there is datePicker, instance of Runner.controls.DateTextField should be passed as target
 * @class Runner.controls.DateTextField
 */
Runner.controls.DateTextField = Runner.extend(Runner.controls.DateField, {
	
	/**
	 * Overrides parent constructor
	 * @param {Object} cfg
	 */
	constructor: function(cfg){
		this.addEvent(["change", "keyup"]);
		Runner.controls.DateTextField.superclass.constructor.call(this, cfg);
		// initialize control disabled
		if (cfg.disabled===true || cfg.disabled==="true"){
			this.setDisabled();
		}
		// get default value
		this.defaultValue = this.getValue();
	},
	getValue: function(){
		var parsedTime = this.parseDateTime(this.valueElem.val(),this.dateFormat);
		if (parsedTime == null){
			return "";
		}else{
			return parsedTime;
		}
	},
	/**
	 * Set value, also change value in hidden field
	 * @method
	 * @param {Object} val
	 * @return {bool} if passed correct Date object, otherwise false
	 */
	setValue: function(newDate, triggerEvent, updContext)	{
		newDate = Runner.controls.DateTextField.superclass.setValue.call(this, newDate, triggerEvent);	
		// if we pass Date object, so we use it
		if (typeof newDate == 'object' && newDate!=null){
			// call old date parse function, they will change in future
			var dt = this.print_datetime(newDate, this.dateFormat);
			//set value in edit textfield
			this.valueElem.val(dt);
			// if we need to set new date in hidden fields for datepicker
			if (this.useDatePicker){
				dt = this.print_datetime(newDate, -1);
				this.datePickerHiddElem.val(dt);
			}
			this.validate();
			return true;
		}else{
			// set empty value = ""
			this.valueElem.val("");
			// if we need to set new date in hidden fields for datepicker
			if (this.useDatePicker){
				this.datePickerHiddElem.val("");
			}
			this.validate();
			return false;
		}
		if(triggerEvent===true){
			this.fireEvent("change", updContext);
		}
	},
	/**
	 * Custom function for onblur event
	 * @param {Object} e
	 */
	"blur": function(e){
		// call parent
		this.stopEvent(e);
		this.focusState = false;
		if (!this.invalid()){
			return;
		}
		var vRes = this.validate();
		// set values to hidden fields
		if (vRes.result && this.useDatePicker  && this.getValue()){
			this.setValue(this.getValue());
		}
	},
	/**
	 * Sets disable attr true
	 * Should be overriden for sophisticated controls
	 * @method
	 */
	setDisabled: function(){
		if (this.valueElem.get(0) && this.imgCal){
			this.valueElem.get(0).disabled = true;
			this.imgCal.css('visibility','hidden');
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Sets disaqble attr false
	 * Should be overriden for sophisticated controls
	 * @method
	 */
	setEnabled: function(){
		if (this.valueElem.get(0)){
			this.valueElem.get(0).disabled = false;
			if(this.imgCal!=null){
				this.imgCal.css('visibility','visible');
			}
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Clone html for iframe submit
	 */
	getForSubmit: function(){
		return [this.valueElem.clone(), this.dateFormatHiddElem.clone()];
	},
	
	makeReadonly: function(){
		Runner.controls.DateTextField.superclass.makeReadonly.call(this);
		if(this.imgCal!=null){
			this.imgCal.css('display','none');
		}
		return true;
	},
	
	makeReadWrite: function(){
		Runner.controls.DateTextField.superclass.makeReadWrite.call(this);
		if(this.imgCal != null){
			this.imgCal.css('display','');
		}
		return true;
	},	
	/**
	 * Return date value as string
	 * @return {string}
	 */
	getStringValue: function(){
		return this.valueElem.val();
	}
});

/**
 * Class for date fields with three dropdowns value editor
 * If there is datePicker, instance of Runner.controls.DateDropDown should be passed as target
 * @class Runner.controls.DateDropDown
 */
Runner.controls.DateDropDown = Runner.extend(Runner.controls.DateField, {
	/**
	 * Hidden element for date value
	 * value for server submit
	 * @type {Object} type
	 */
	hiddValueElem: null,
	/**
	 * Hidden element id
	 * @type {string}
	 */
	hiddElemId: "",
	
	/**
	 * Overrides parent constructor
	 * @param {Mixed} cfg
	 */
	constructor: function(cfg){
		cfg.stopEventInit=true;
		// call parent
		Runner.controls.DateDropDown.superclass.constructor.call(this, cfg);
		//Overrides value elem. For handling 3 dropdowns
		this.valueElem = {
			"day": $("#day"+this.valContId),
			"month": $("#month"+this.valContId),
			"year": $("#year"+this.valContId)
		};
		
		// initialize control disabled
		if (cfg.disabled===true || cfg.disabled==="true"){
			this.setDisabled();
		}
		// use onchange instead onblur for DD
		this.addEvent(["change"]);
		// onblur not usable
		this.killEvent("blur");
		//event elems 
		this.elemsForEvent = [this.valueElem["day"].get(0), this.valueElem["month"].get(0), this.valueElem["year"].get(0)];		
		// init events handling
		this.init();
		// add hidden elems
		this.hiddElemId = this.valContId;
		this.hiddValueElem = $("#"+this.hiddElemId);
		// add input type attr
		this.inputType = "3dd";
		// if allready have constants, than fill combos
		if (Runner.lang.constants.TEXT_MONTH_JAN){
			this.addYearOptions(cfg.yearVal);
			this.addMonthOptions(cfg.monthVal);
			this.addDayOptions(cfg.dayVal);
		}
		if (this.hiddValueElem.length){
			var dateObj = this.parseDateTime(this.hiddValueElem.val(), 2);
			this.setValue(dateObj);
		}
		// get default value
		this.defaultValue = this.getValue();
	},
	
	destructor: function(){
		// call parent
		Runner.controls.DateDropDown.superclass.destructor.call(this);
		this.valueElem['day'].remove();
		this.valueElem['month'].remove();
		this.valueElem['year'].remove();
	},
	
	initToolTip: function(text, pageObj){
		if (this.valueElem['day'].addClass && this.valueElem['month'].addClass && this.valueElem['year'].addClass){
			this.valueElem['day'].addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: pageObj.fly, el:this.valueElem['year']});
			this.valueElem['month'].addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: pageObj.fly, el:this.valueElem['year']});
			this.valueElem['year'].addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: pageObj.fly});
			return true;
		}else{
			return false;
		}
	},
	
	/**
	 * Add year options
	 * @param {integer} year value
	 */
	addYearOptions: function(selectedYear){
		this.valueElem["year"].html('');
		var dt = new Date();
		var currentYear = dt.getFullYear();
		var initialYear = Runner.pages.PageSettings.getFieldData(this.table, this.fieldName, "initialYear", this.pageType);
		var lastYear = Runner.pages.PageSettings.getFieldData(this.table, this.fieldName, "lastYear", this.pageType);
		var startYear = currentYear - initialYear;
		var endYear = currentYear + lastYear;
		var opt = document.createElement('OPTION');
		$(opt).val('').html('');
		this.valueElem["year"].append(opt);
		
		for(var i = startYear; i<=endYear; i++){
			var opt = document.createElement('OPTION');
			$(opt).val(i).html(i);
			if (i==selectedYear){
				opt.selected = true;
			}
			this.valueElem["year"].append(opt);
		};
		this.addYearOptions = Runner.emptyFn;
	},
	/**
	 * Add month options
	 * @param {integer} month value
	 */
	addMonthOptions: function(selectedMonth){
		this.valueElem["month"].html('');
		
		var opt = document.createElement('OPTION');
		$(opt).val('').html('');
		this.valueElem["month"].append(opt);
		
		var monthNames = [];
		monthNames[1] = Runner.lang.constants.TEXT_MONTH_JAN;
		monthNames[2] = Runner.lang.constants.TEXT_MONTH_FEB;
		monthNames[3] = Runner.lang.constants.TEXT_MONTH_MAR;
		monthNames[4] = Runner.lang.constants.TEXT_MONTH_APR;
		monthNames[5] = Runner.lang.constants.TEXT_MONTH_MAY;
		monthNames[6] = Runner.lang.constants.TEXT_MONTH_JUN;
		monthNames[7] = Runner.lang.constants.TEXT_MONTH_JUL;
		monthNames[8] = Runner.lang.constants.TEXT_MONTH_AUG;
		monthNames[9] = Runner.lang.constants.TEXT_MONTH_SEP;
		monthNames[10] = Runner.lang.constants.TEXT_MONTH_OCT;
		monthNames[11] = Runner.lang.constants.TEXT_MONTH_NOV;
		monthNames[12] = Runner.lang.constants.TEXT_MONTH_DEC;
		
		for(var i=1; i<monthNames.length; i++){
			var opt = document.createElement('OPTION');
			$(opt).val(i).html(monthNames[i]);
			if (i==selectedMonth){
				opt.selected = true;
			}
			this.valueElem["month"].append(opt);
		}
		if(!this.valueElem["month"].css('width'))
			this.valueElem["month"].css('width','90px');
		
		this.addMonthOptions = Runner.emptyFn;
	},
	/**
	 * Add day options
	 * @param {integer} day value
	 */
	addDayOptions: function(selectedDay){
		this.valueElem["day"].html('');
		var opt = document.createElement('OPTION');
		$(opt).val('').html('');
		this.valueElem["day"].append(opt);
		
		for(var i=1; i<=31; i++){
			var opt = document.createElement('OPTION');
			$(opt).val(i).html(i);
			if (i==selectedDay){
				opt.selected = true;
			}
			this.valueElem["day"].append(opt);
		};
		this.addDayOptions = Runner.emptyFn;
	},
	/**
	 * Custom function for onchange event
	 * @param {Object} e
	 */
	"change": function(e){
		this.stopEvent(e);
		// if any dd is empty, than we can't start validation
		for(var name in this.valueElem){
			if (this.valueElem[name].val() == '')
			{
				this.setValue();
				return true;
			}
		}
		var vRes = this.validate();
		if (vRes.result){
			this.setValue(this.getValue());
		}
		return vRes;
	},
	"blur": Runner.emptyFn,	
	/**
	 * Gets values from dropdowns and returns it in YYYY-mm-dd-hh-ss format
	 */
	getValue: function(){
		// date pieces from dropdowns
		if (this.valueElem["day"] && this.valueElem["day"].val()){
			var dayVal = this.valueElem["day"].val();
		}else{
			return false;
		}
		if (this.valueElem["month"] && this.valueElem["month"].val()){
			var monthVal = this.valueElem["month"].val();
		}else{
			return false;
		}
		if (this.valueElem["year"] && this.valueElem["year"].val()){
			var yearVal = this.valueElem["year"].val();
		}else{
			return false;
		}
		
		var date = new Date(yearVal, monthVal-1, dayVal, 00, 00, 00);
		return date;
	},
	/**
	 * Sets value to dropdowns
	 * @param {Date} newDate
	 * @return {bool}Returns true if success, otherwise false
	 */
	setValue: function(newDate, triggerEvent, updContext){	
		newDate = Runner.controls.DateTextField.superclass.setValue.call(this, newDate, triggerEvent);	
		// if we pass Date object, so we use it
		if(typeof newDate == 'object' && newDate!=null){
			this.hiddValueElem.get(0).value =  newDate.getFullYear() + '-' + (newDate.getMonth()+1) + '-' + newDate.getDate();		
			
			this.valueElem["day"].get(0).selectedIndex = newDate.getDate();
			
			this.valueElem["month"].get(0).selectedIndex = newDate.getMonth()+1;
			
			for(var i=0; i<this.valueElem["year"].get(0).options.length;i++){
				if(this.valueElem["year"].get(0).options[i].value==newDate.getFullYear()){
					this.valueElem["year"].get(0).selectedIndex=i;
					break;
				}
			}
			if(this.useDatePicker){
				this.datePickerHiddElem.get(0).value = newDate.getDate() + '-' + (newDate.getMonth()+1) + '-' + newDate.getFullYear();
				if (this.calendar && this.calendar.cfg.getProperty('pagedate').toString() != newDate.toString()){
					this.calendar.cfg.setProperty('pagedate', newDate);
					this.calendar.select(newDate);
				}
			}
			return true;
		}else{
			this.hiddValueElem.val('');
			if(updContext && updContext.resetHappend || this.isClearHappend){
				this.valueElem["day"].get(0).selectedIndex = 0;
				this.valueElem["month"].get(0).selectedIndex = 0;
				this.valueElem["year"].get(0).selectedIndex = 0;
			}
			// if we need to set new date in hidden fields for datepicker
			if (this.useDatePicker){
				this.datePickerHiddElem.val("");
			}
			return false;
		}
		if(triggerEvent===true){
			this.fireEvent("change", updContext);
		}
	},
	
	makeReadonly: function(){
		this.setDisabled();
		return true;
	},
	
	makeReadWrite: function(){
		this.setEnabled();
		return true;
	},
	/**
	 * Overrides parent function for three element control
	 */
	setDisabled: function(){
		if (!this.valueElem.day || !this.valueElem.month || !this.valueElem.year){
			return false;
		}
		
		this.valueElem.day.attr('disabled',true);
		this.valueElem.month.attr('disabled',true);
		this.valueElem.year.attr('disabled',true);
		if (this.imgCal) {
			this.imgCal.css('visibility','hidden');
		}
		return true;
	},
	/**
	 * Overrides parent function for three element control
	 */
	setEnabled: function(){
		this.valueElem["day"][0].disabled = false;
		this.valueElem["month"][0].disabled = false;
		this.valueElem["year"][0].disabled = false;
		if(this.imgCal!=null){
			this.imgCal.css('visibility','visible');
		}
		return true;
	},
	/**
	 * Clone html for iframe submit
	 * @method
	 */
	getForSubmit: function(){
		return [this.hiddValueElem.clone(), this.dateFormatHiddElem.clone()];
	},
	/**
	 * Sets focus to the element, override
	 * @method
	 * @param bool
	 * @return {bool}
	 */
	setFocus: function(triggerEvent){
		if (this.valueElem["day"].get(0).disabled != true){
			// set focus to first dropdown
			cont=false;
			this.spanContElem.children().each(function(){
				if($(this).is(":visible") && !cont) {
					this.focus();
					cont = true;
					if(triggerEvent===true){
						this.fireEvent("focus");
					}
				this.isSetFocus = true;
				}
			});
			return true;
		}else{
			this.isSetFocus = false;
			return false;
		}
	},
	/**
	 * Checks if control value is empty. 
	 * @method
	 * @return {bool}
	 */
	isEmpty: function(){
		if (this.valueElem["day"].val() == "" || this.valueElem["month"].val() == "" || this.valueElem["year"].val() == ""){
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Validates control against validation types, defined in validationArr
	 * @method validate
	 * @params valArr - array of validation for event blur only
	 * @return {object} if success true, otherwise false
	 */
	validate:function(valArr){
		if (!this.valueElem["day"].length || !this.valueElem["month"].length || !this.valueElem["year"].length){
			return {result: true, messageArr: []};
		}
		var vRes = validation.validate(valArr || this.validationArr, this);
		// change invalid status only if any validation were made, to prevent init error container
		if (valArr || this.validationArr.length){
			if (!vRes.result){
				this.markInvalid(vRes.messageArr);
			}else{
				this.clearInvalid();
			}
		}
		// return validation result
		return vRes;
	},
	/**
	 * Return date value as string
	 * @return {string}
	 */
	getStringValue: function(){
		return this.hiddValueElem.val();
	},
	
	appearOnPage: function(){
		var elemLen = 0;
		for(var elem in this.valueElem){
			elemLen++;
		}
		return elemLen;
	}
});


/**
 * Abstract base class for LookupWizard fields, should not created directly.
 * Contains common functionality for dependent lookup wizard controls
 * @class 
 * @requires Runner.controls.Control
 */
Runner.controls.LookupWizard = Runner.extend(Runner.controls.Control, {
	/**
	 * Lookup wizard indicator
	 * @type Boolean
	 */
	isLookupWizard: true,
	/**
	 * Array dropDownControls which are dependent to this ctrl
	 * @type 
	 */
	dependentCtrls: null,
	/**
	 * Parent ctrl object. Used to get values in lookupSuggest
	 * @type {object}
	 */
	parentCtrl: null,
	/**
	 * Name of parent field
	 * @type String
	 */
	parentFieldName: '',
	
	lookupTable: "",
	
	addNew: "",
		
	pageId: -1,
	
	dispField: "",
	
	linkField: "",
	
	preloadData: null,
	
	autoCompleteFields: null,
	
	/**
	 * Override parent contructor
	 * @param {object} cfg
	 */
	constructor: function(cfg){
		// stop event init
		cfg.stopEventInit=true;
		// recreate object
		this.dependentCtrls = [];
		this.autoCompleteFields = [];
		//call parent
		Runner.controls.LookupWizard.superclass.constructor.call(this, cfg);
		//link for add new record or not
		this.addNew = $("#addnew_"+this.valContId);	
		// add change event for reload dependences
		this.addEvent(["change"]);
		
		if(Runner.isGecko){
			this.addEvent(["keyup"]);
		}
		
		var control = this;
		this.addNew.bind("click", this, function(e){
			Runner.Event.prototype.stopEvent(e);
			if(!e.data.getPageParams){
				return;
			}
			var params = e.data.getPageParams();
			control.pageId = Runner.pages.PageManager.openPage(params);
		});
	},
	
	/**
	 * Method that called just before ControlManager deleted link on this object
	 */
	destructor: function(){
		// call parent
		Runner.controls.LookupWizard.superclass.destructor.call(this);
		// may be need to clear each array element
		delete this.dependentCtrls;
	},
	
	getPageParams: function(){
		var control = this,
			category = '';
		if (this.parentCtrl){
			category = this.parentCtrl.getValue();
		}
		return {
			tName: this.lookupTable, 
			pageType: Runner.pages.constants.PAGE_ADD, 
			destroyOnClose: true,
			fName: this.fieldName,
			category: this.parentFieldName,
			lookupCtrl: this,
			modal: true,
			baseParams: {
				parId: this.id, 
				field: Runner.goodFieldName(this.fieldName), 
				category: category, 
				table: Runner.pages.PageSettings.getShortTName(this.table),  
				editType: Runner.pages.constants.ADD_ONTHEFLY
			},
			afterSave: {
				fn: function(respObj, formObj, fieldControls, page){
					if (respObj.success){
						if (control.inputType == 'select'){
							control.addOption(respObj.vals[control.dispField], respObj.vals[control.linkField]);
							control.setValue([respObj.vals[control.linkField]], true);
						}else if(control.inputType == 'text' && control.suggestValues){
							control.suggestValues.push(respObj.vals[control.dispField]);
							control.lookupValues.push(respObj.vals[control.linkField]);
							control.setLookupValue(respObj.vals[control.linkField], true, respObj.vals[control.dispField]);
							control.setFrame(false);
						}
					}else {
						if(respObj.message != undefined){
							//	respObj contains error message
							page.displayHalfPreparedMessage(respObj.message);
						}else if (respObj.html != -1){
							// respobj is a raw text
							page.win.set('bodyContent', respObj.html);
						}
						
						$('div.yui3-widget-bd').animate({
							scrollTop:0
						});
						return false;
					}
				},
				scope: this
			}
		}
	},
	/**
	 * Add dependent controls to array of controls
	 * @method 
	 * @param {array} ctrlDD array of control objects
	 */
	addDependentCtrls: function(ctrlsArr){
		for(var i=0;i<ctrlsArr.length;i++){
			this.dependentCtrls.push(ctrlsArr[i]);
		}
	},
	/**
	 * Clear links from children to there's parent ctrl	 * 
	 * @param {bool} triggerReload pass true to call reload function on children
	 */
	clearChildrenLinks: function(triggerReload){
		// reload all children
		for(var i=0;i<this.dependentCtrls.length;i++){
			// if children exists
			if(this.dependentCtrls[i]){
				this.dependentCtrls[i].clearParent(triggerReload);
			}
		}
	},
	/**
	 * Deletes link to parent ctrl, and optionaly reloads this
	 * @param {bool} triggerReload pass true to call reload method
	 */
	clearParent: function(triggerReload){
		this.parentCtrl = null;
		if (triggerReload===true){
			this.reload();
		}
	},
	/**
	 * Set parent ctrl property
	 * @param {object} ctrl
	 */
	setParentCtrl: function(ctrl){
		this.parentCtrl = ctrl;
	},
	/**
	 * Call reload method of each dependent DD
	 * @method
	 */
	reloadDependeces: function(updContext){
		if (!this.dependentCtrls || !this.dependentCtrls.length){
			return false;
		}
		// value of parent ctrl
		var masterCtrlVal = this.getValue();
		// if parent ctrl returns array value, we need to pass only first element of array
		masterCtrlVal = typeof(masterCtrlVal) == 'object' ? masterCtrlVal[0] : masterCtrlVal;
		// reload all children
		for(var i=0;i<this.dependentCtrls.length;i++){
			// if children exists
			if(this.dependentCtrls[i]){
				this.dependentCtrls[i].reload(masterCtrlVal, updContext);
			}
		}
	},
	
	clearInvalidOnDependences: function(){
		if(!this.dependentCtrls)
			return;
		for(var i=0;i<this.dependentCtrls.length;i++){
			// if children exists
			if(this.dependentCtrls[i]){
				this.dependentCtrls[i].clearInvalid();
			}
		}
	},
	
	doAutoCompleteFields: function(val){
		if(this.autoCompleteFields.length){
			$.runnerAJAX('autofillfields.php', 
				{
					mainTable: Runner.pages.PageSettings.getShortTName(this.table),
					mainField: this.fieldName,
					linkField: this.linkField,
					linkFieldVal: val || this.getValue(),
					pageType: this.pageType
				},
				(function(respObj){
					if (!respObj.success){
						return false;
					}
					var data = respObj.data,
						updContext = {values:{}},
						valToFill,
						ctrl = null;
					
					for(var i=0; i<this.autoCompleteFields.length; i++){
						updContext.values[this.autoCompleteFields[i].masterF] = [data[this.autoCompleteFields[i].lookupF]];
					}
					
					for(var i=0; i<this.autoCompleteFields.length; i++){
						ctrl = Runner.controls.ControlManager.getAt(this.table, this.id, this.autoCompleteFields[i].masterF);
						if(!ctrl)
							continue;
						valToFill = data[this.autoCompleteFields[i].lookupF];
						if(valToFill == null || typeof valToFill == 'undefined'){
							valToFill = '';
						}
						ctrl.setValue(valToFill, true, updContext);
					}
					
				}).createDelegate(this));
		}
	},
	
	/**
	 * Override simple dropDown event,
	 * add reloading for dependent dropDowns
	 * @event
	 * @param {event} e
	 */
	"change": function(){
		var updContext = {};
		if(arguments.length > 1 && typeof arguments[1] == 'object'){
			updContext = arguments[1];
		}
		if(!updContext.resetHappend){
			this.doAutoCompleteFields();
		}
		// clear invalid state in dependent controls in anyway
		this.clearInvalidOnDependences();
		//call parent
		var vRes;
		if (this.invalid()){
			vRes = this.validate();	
		}else{
			var valArr = this.validationArr.copy().removeElem("IsRequired");
			vRes = this.validate(valArr);
		}
		// call reload if value pass validation
		if (vRes.result){
			this.reloadDependeces(updContext);
			return true;
		}else{
			return false;
		}
	},
	
	"keyup": function(){
		this.change();
	}
});

/**
 * Radio control class
 * @requires Runner.controls.Control
 */
Runner.controls.RadioControl = Runner.extend(Runner.controls.LookupWizard, {
	/**
	 * Radio DOM elem id, starts from + _i 
	 * where i index of element, starts from 0
	 * @type {string} 
	 */
	radioElemsId: "",
	/**
	 * Radio jQuery obj
	 * @type {Object} 
	 */
	radioElemsArr: [],
	/**
	 * checkbox name attr 
	 * @type String
	 */
	radioElemsNameAttr: "",
	/**
	 * jQuery object which contains all radios
	 * @type {object}
	 */
	radioElem: null,
	/**
	 * Count of radio buttons
	 * @type {int}
	 */
	radioElemsCount: 0,
	/**
	 * Override parent contructor
	 * @constructor
	 * @param {Object} cfg
	 */
	constructor: function (cfg){
		this.radioElemsArr = new Array();
		cfg.stopEventInit = true;
		//call parent
		Runner.controls.RadioControl.superclass.constructor.call(this, cfg);
		this.parentFieldName = false;
		// id starts from
		this.radioElemsId = "radio_"+this.goodFieldName+"_"+this.id+"_";
		// radio elems name attr
		this.radioElemsNameAttr = "radio_"+this.goodFieldName+"_"+this.id; 
		// add radio DOM jQuery elem
		this.radioElem = $('input[name='+this.radioElemsNameAttr+']');
		// count of elems get from jQuery obj
		this.radioElemsCount = this.radioElem.length;
		// array of radios
		for(var i=0;i<this.radioElemsCount;i++){
			this.radioElemsArr.push($("#"+this.radioElemsId+i));
			//elems for event are radios
			this.elemsForEvent.push(this.radioElemsArr[i].get(0));
		}
		// initialize control disabled
		if (cfg.disabled==true || cfg.disabled=="true"){
			this.setDisabled();
		}
		// add events
		this.addEvent(["click"]);
		// init events
		this.init();
	},
	/**
	 * Set value to the control
	 * @param {string} val
	 * @param {bool} triggerEvent
	 * @return {bool}
	 */
	setValue: function(val, triggerEvent, updContext){
		var choosen = false;
		// loop for all radio elements
		for(var i=0;i<this.radioElemsCount;i++){
			if(this.radioElemsArr[i].val() == val){
				// set checked radio element
				this.radioElemsArr[i].get(0).checked = true;
				//set value in hidden eleme
				this.valueElem.val(val);
				choosen = true;
			}else{
				this.radioElemsArr[i].get(0).checked = false;
			}
		}
		if(!choosen){
			this.valueElem.val('');
		}
		if(triggerEvent===true){
			this.fireEvent("change", updContext);
		}
		return choosen;
	},
	/**
	 * Sets disable radio control
	 * @method
	 */
	setDisabled: function(){
		for(var i=0;i<this.radioElemsCount;i++){
			this.radioElemsArr[i].get(0).disabled = true;
		}
		return true;
	},
	/**
	 * Sets disaqble attr false
	 * Should be overriden for sophisticated controls
	 * @method
	 */
	setEnabled: function(){
		for(var i=0;i<this.radioElemsCount;i++){
			this.radioElemsArr[i].get(0).disabled = false;
		}
		return true;
	},	
	/**
	 * Clear blur event handler
	 */
	"blur": Runner.emptyFn,

	"change": function(e){
		if (e.target.value != this.getValue()){
			// set new val to hidden elem for chrome
			//this.setValue(e.target.value, false);
			this.setValue(e.target.value, false);
			this.doAutoCompleteFields();
			// validate and return validation result
			return this.validate().result;
		}
	},
	
	"click": function(e){ return true; },
	
	initToolTip: function(text, pageObj){
		if (this.valueElem.addClass && this.mode != Runner.controls.constants.MODE_SEARCH && this.valueElem.parent().length && this.valueElem.parent().get(0).nodeName == "SPAN"){
			this.valueElem.parent().addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: pageObj.fly});
			this.initToolTip = Runner.emptyFn;
			return true;
		}else{
			return false;
		}
	},
	
	makeReadonly: function(){
		this.setDisabled();
		return true;
	},
	
	makeReadWrite: function(){
		this.setEnabled();
		return true;
	},
	
	/**
	* Get the displayed field's value
	* @return {string}
	*/
	getDisplayValue: function(){
		var value = this.valueElem.val();	
		for(var i = 0; i < this.radioElemsCount; i++){
		    if(this.radioElemsArr[i].val() == value && this.radioElemsArr[i].get(0).checked){
					return $("#label_" + this.radioElemsArr[i].attr("id")).text();		
			}
		}
		return "";
	}
	
});

/**
 * Select control class. 
 * @requires Runner.controls.LookupWizard
 * @class Runner.controls.DropDownLookup
 */
Runner.controls.DropDownLookup = Runner.extend(Runner.controls.LookupWizard, {
	/**
	 * Number of values to select.
	 * @type {Number}
	 */
	multiSel: 1,
	/**
	 * DropDown DOM options array
	 * @type {array}
	 */
	optionsDOM: null,
	/**
	 * Type of the page which contain this control
	 * @type String
	 */
	pageType: "list",
	/**
	 * Override parent contructor 
	 * @param {object} cfg
	 * @param {int} cfg.multiSelect number of values to select. Must be >= 1
	 */
	constructor: function(cfg){
		// add multiSelect property
		this.multiSel = cfg.multiSel ? cfg.multiSel : 1;	
		// value element id
		this.valContId = "value"+(cfg.ctrlInd || "")+"_"+cfg.goodFieldName+"_"+cfg.id;
		// value elem
		this.valueElem = $("#"+this.valContId);	
		// add options array property
		if (this.appearOnPage()){
			this.optionsDOM = this.valueElem.get(0).options;
		}else{
			this.optionsDOM = [];
		}
		
		// call parent
		Runner.controls.DropDownLookup.superclass.constructor.call(this, cfg);			
		// set input type
		this.inputType = "select";
		//event elem 
		this.elemsForEvent = [this.valueElem.get(0)];		
		// init events handling
		this.init();			
		// initialize control disabled
		if (cfg.disabled==true || cfg.disabled=="true"){
			this.setDisabled();
		}
		if (this.preloadData){
			this.preload(this.preloadData.vals, this.preloadData.fVal);
		}
		//set defaultValue
		this.defaultValue = this.getValue(true);	
	},
	/**
	 * Sets value to DropDown. Tries to set all values from array if multiselect control
	 * @param {array} val
	 * @return {bool} true if success otherwise false
	 */
	setValue: function(pvals, triggerEvent, updContext){		
	    var vals = pvals
		  if(!Runner.isArray(pvals)){
	      vals = [pvals]
	    }
	// another way to fix bug #3221, instead use of try catch bellow
   	//this.valueElem.focus();
  	// number of choosen options
		var choosen = 0;
		for(var i=0; i<this.valueElem.get(0).options.length;i++){
			for(var j=0;j<vals.length;j++){
				if(this.valueElem.get(0).options[i].value==vals[j]){
					try{
						this.optionsDOM[i].selected=true;					
						choosen++;
					}catch(e){};
					
					if(this.multiSel==1){
						try{
							this.valueElem.get(0).selectedIndex=i;
						}catch(e){};
					}else{						
						break;
					}														
				}else{
					try{
						this.optionsDOM[i].selected=false;
					}catch(e){};
				}// eo if
			}// eo for	
			if (choosen>0 && this.multiSel==1){
				break;
			}
		}// eo for
		
		if(triggerEvent===true){
			this.fireEvent("change", updContext);
		}
		
		// if selected all than success
		if (choosen == vals.length && choosen <= this.multiSel){
			return true;
		}else{
			return false;	
		}		
	},
	/**
	 * Returns values from dropDown. 
	 * @method
	 * @return {array}
	 */
	getValue: function(returnArray){
		var selVals = [];
		// loop for all options
		if(this.optionsDOM.length){
			for (var i=0; i<this.optionsDOM.length;i++){
				if (this.optionsDOM[i].selected)
					selVals.push(this.optionsDOM[i].value)
			}
		}else if(this.appearOnPage()){
			for(var i=0; i<this.valueElem.get(0).options.length;i++){
				if(this.valueElem.get(0).options[i].selected){
						selVals.push(this.valueElem.get(0).options[i].value);
				}
			}
		}
		if(returnArray===true)
			return selVals;
		if(selVals.length>1)
			return selVals;
		else if(selVals.length==1)
			return selVals[0];
		else
			return "";
	},
	/**
	 * Checks if control value is empty. Used for isRequired validation
	 * @method
	 * @return {bool}
	 */
	isEmpty: function(){
		var selVals = this.getValue();
		if(typeof selVals!='object')
			return selVals==="";
		return false;
	},
	/**
	 * Deletes all options from ctrl
	 * @method
	 */
	clearOptions: function(){
		var select = this.valueElem.get(0);
		for(var i=this.optionsDOM.length-1; i>-1;i--){
			select.remove(i);
		}		
	},
	/**
	 * Adds option to select
	 * may be need to add options to specified index?
	 * @param {string} text
	 * @param {string} val
	 */
	addOption: function(text, val){
		var opt = new Option(text, val);
		$(opt).html(text);
		this.valueElem.append(opt);
	},
	/**
	 * Add options from array.
	 * Array must have such structure:
	 * array[0] = value, array[1] = text,
	 * array[2] = value, array[3] = text,
	 * 2*i - indexes of values; 2*i+1 - indexes of text. I starts from 0   
	 * @param {array} optionsArr
	 */
	addOptionsArr: function(optionsArr){		
		for(var i=0; i < optionsArr.length - 1; i=i+2){ 
			this.addOption(optionsArr[i+1], optionsArr[i]);
		}
	},	
	/**
	 * First loading, without ajax. Should be called directly
	 * @param {string} txt unparsed values for options
	 * @param {string} selectValue unparsed values of selected options
	 */
	preload: function(vals, selectValue){
		// clear all old options
		this.clearOptions();	
		// add empty option for non multiple select
		if (this.multiSel==1){
			// add empty option for non multiselect
			this.addOption(Runner.lang.constants.TEXT_PLEASE_SELECT, "");				
		}
		// load options
		this.addOptionsArr(vals);
		// if only one values except please select, so choose it
		if (this.optionsDOM.length==2){
			this.setValue([this.optionsDOM[1].value], false);	
		} else if ((this.multiSel == 1) && (selectValue != null) && (selectValue != '')){			
				selectValue = [selectValue];
				// don't need to use ajax reload call
				this.setValue(selectValue, false);		
		} else if(this.optionsDOM.length>0){
			this.setValue([this.optionsDOM[0].value], false);	
		}			
	},	
	/**
	 * Reloading dropdown. Called by change event handler
	 * @param {string} value of master ctrl
	 */
	reload: function(masterCtrlValue, updContext){	
		var fName = this.fieldName, tName = this.table, rowId = this.id;
		// can't reload if no parent ctrl - for safety use
		if (masterCtrlValue && !this.parentCtrl){
			return false;
		}	
		//ajax params
		var ajaxParams = {
			// ctrl fieldName
			field: fName,
			// value of master ctrl. Only first val from arr, because multiDrop cannot be master
			value: (masterCtrlValue !== undefined ? masterCtrlValue : ''),
			// is exist parent, indicator
			isExistParent: (this.parentCtrl ? 1 : 0),
			// tag name of ctrl
			type: this.valueElem[0].tagName,
			// page mode add, edit, etc..
			mode: this.mode,
			// Type of the page which contain this control
			pageType: this.pageType,
			// random value for prevent caching
		    rndVal: (new Date().getTime())
		};				
		// for handler closure
		var ctrl = this;	
		// get content		
		$.runnerAJAX(this.shortTableName+"_autocomplete.php", ajaxParams, function(respObj){	
			if (!respObj.success){
				respObj = {data: {}};
			}
			
			var data = respObj.data;	
			// clear all options
			ctrl.clearOptions();	
			// add empty option for non multiple select if it doesn't comes from server data
			if (ctrl.multiSel==1){
				// add empty option for non multiselect
				ctrl.addOption(Runner.lang.constants.TEXT_PLEASE_SELECT, "");				
			}
			// load options
			ctrl.addOptionsArr(data);
			
			// if only one values except please select, so choose it
			if (ctrl.optionsDOM.length==2 && ctrl.multiSel==1){
				ctrl.setValue([ctrl.optionsDOM[1].value], false);	
			}else if(ctrl.optionsDOM.length==1 && ctrl.multiSel>1){
				ctrl.setValue([ctrl.optionsDOM[0].value], false);	
			}			
			
			if(updContext && updContext.values && updContext.values[ctrl.fieldName]){
				ctrl.setValue([updContext.values[ctrl.fieldName]], true, updContext);	
			}
			
			// fire change event, for reload dependent ctrls
			ctrl.fireEvent("change", updContext);	
			// after reload clear invalid massages			
			ctrl.clearInvalid();
		});
	},
	/**
	 * Overrides parent function for element control
	 * Sets disable attr true
	 * Sets hidden css style true for link add New
	 * @method
	 */
	setDisabled: function(){
		if (this.valueElem){
			this.valueElem.get(0).disabled = true;			
			if (this.addNew){
				this.addNew.css('visibility','hidden');					
			}			
			return true;
		}
		return false;			
	},
	/**
	 * Overrides parent function for element control
	 * Sets disable attr false
	 * Sets visible css style true for link add New
	 * @method
	 */
	setEnabled: function(){
		if (this.valueElem){
			this.valueElem.get(0).disabled = false;
			if (this.addNew){
				this.addNew.css('visibility','visible');					
			}	
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Clone html for iframe submit.
	 * jQuery clone method won't clone object with new selected values
	 * that's why we need to set values in clone object separetely
	 * @return {array}
	 */
	getForSubmit: function(){
		if (!this.appearOnPage()){
			return [];
		}
		var clone = this.valueElem.clone(), selVals = this.getValue(true);
		var cloneOpt = clone.get(0).options;
		for(var i=0;i<cloneOpt.length;i++){
			for(var j=0;j<selVals.length;j++){
				if(cloneOpt[i].value==selVals[j]){
					if(this.multiSel==1)
						clone.get(0).selectedIndex = i;
					cloneOpt[i].selected = true;
					break;
				}
				else
				{
					cloneOpt[i].selected = false;
				}// eo if
			}// eo for	
		}// eo for
		
		return [clone];
	},
	
	makeReadonly: function(){
		Runner.controls.DropDownLookup.superclass.makeReadonly.call(this);
		this.addNew.css('display','none');
	},
	
	makeReadWrite: function(){
		Runner.controls.DropDownLookup.superclass.makeReadWrite.call(this);
		this.addNew.css('display','');
	},
	
	/**
	* Get the displayed field's value
	 * @return {string}
	*/
	getDisplayValue: function(){
		var i, displayValues = [];
		(this.multiSel == 1)? i = 1 : i = 0;
		
		for( ; i < this.optionsDOM.length; i++){
			if(this.optionsDOM[i].selected){
				displayValues.push(this.optionsDOM[i].text);			
			}
		}
		return displayValues.join(", ");
	},
	
	/**
	 * Drop custom function for blur event
	 * @param {Object} e
	 */
	"blur": Runner.emptyFn	
});


/**
 * Multiple select control class
 * @requires Runner.controls.LookupWizard
 * @class Runner.controls.CheckBoxLookup
 * @extends Runner.controls.LookupWizard
 */
Runner.controls.CheckBoxLookup = Runner.extend(Runner.controls.LookupWizard, {
	/**
	 * type hidd element id
	 * @type String
	 */
	typeElemId: "",
	/**
	 * type hidd element jQuery obj
	 * @type {object}
	 */
	typeElem: null,
	/**
	 * Number of checkboxes
	 * @type Number
	 */
	checkBoxCount: 0,
	/**
	 * Array of checkbox jQuery elements
	 * @type {array}
	 */
	checkBoxesArr: null,
	/**
	 * String from which checkbox name attr starts, for getting
	 * @type String
	 */
	checkBoxNameAttr: "",
	/**
	 * Type of the page which contain this control
	 * @type String
	 */
	pageType: "list",
	/**
	 * Override parent contructor
	 * @param {object} cfg
	 */
	constructor: function(cfg){
		// add checkboxes elements
		this.checkBoxesArr = [];
		//call parent
		Runner.controls.CheckBoxLookup.superclass.constructor.call(this, cfg);
		// add input type
		this.inputType = "checkbox";
		// type hidd element id
		this.typeElemId = "type_"+this.goodFieldName+"_"+this.id;
		// type hidd element jQuery obj
		this.typeElem = $("#"+this.typeElemId);
		// span where situated data of checkbox
		this.dataCheckBoxId = "data_"+this.valContId;
		// add checkboxes elements, if checkbox used in simple way
		if (($("#"+this.valContId)).length){
			var checkBox=$("#"+this.valContId);
			// arr of jQuery checkboxes
			this.checkBoxesArr.push(checkBox);
			//elems for event are checkboxes
			this.elemsForEvent.push(this.checkBoxesArr[0].get(0));
		// if checkbox used as lookup
		}else{		
			var checkBox, i=0;
			while(($("#"+this.valContId+"_"+i)).length){
				checkBox=$("#"+this.valContId+"_"+i);
				// arr of jQuery checkboxes
				this.checkBoxesArr.push(checkBox);
				//elems for event are checkboxes
				this.elemsForEvent.push(this.checkBoxesArr[i].get(0));
				i++;
			}
		}
		// initialize control disabled
		if (cfg.disabled==true || cfg.disabled=="true"){
			this.setDisabled();
		}
		// WHICH EVENTS NEED TO ADD ?
		this.addEvent(["click"]);
		// init events
		this.init();
		//set defaultValue
		this.defaultValue = this.getValue();
		// get jQuery array of checkboxes as value element
		this.checkBoxNameAttr = 'value_'+this.goodFieldName+'_'+this.id;
		this.valueElem = $('input[name^='+this.checkBoxNameAttr+']');
	},
	/**
	 * Sets array of values to checkboxes
	 * @method
	 * @param {mixed} value or array of values
	 * @return {Boolean} true if success otherwise false
	 */	
	setValue: function(value, triggerEvent, updContext){
		var valsArr = [], checkCount = 0;
		// if one checkbox
		if(value === true && this.checkBoxesArr.length == 1){
			// set checked
			this.checkBoxesArr[0].get(0).checked = true;
		}
		else if(!value){
			for(var i=0;i<this.checkBoxesArr.length;i++){
				// set all unchecked
				this.checkBoxesArr[i].get(0).checked = false;
			}
		}
		else{
			valsArr = value;
			if(typeof value == 'string'){
				valsArr = [value];
			}
			//loop for all checkboxes
			for(var i=0;i<this.checkBoxesArr.length;i++){
				// set unchecked
				this.checkBoxesArr[i].get(0).checked = false;
				// loop for all vals
				for(var j=0; j<valsArr.length;j++){
					// if check box val same as val in arr to check
					if (this.checkBoxesArr[i].val() == valsArr[j]){
						this.checkBoxesArr[i].get(0).checked = true;
						checkCount++;
						break;
					}
				}
			}
		}
		
		if(triggerEvent===true){
			this.fireEvent("click", updContext);
		}
		// check number of checked boxes
		if (checkCount == valsArr.length && checkCount<=this.checkBoxesArr.length && valsArr.length<=this.checkBoxesArr.length){
			return true;
		}else{
			return false;
		}
	},
	/**
	 * Returns array of checked values
	 * @return {array}
	 */
	getValue: function(){
		var checkedArr = this.getCheckedBoxes(), valsArr = [];
		// get value from each checkbox
		for(var i=0;i<checkedArr.length;i++){
			valsArr.push(checkedArr[i].val());
		}		
		return valsArr;
	},
	
	getStringValue: function(){
		return this.getValue().join(",");
	},
	/**
	 * Checks if control value is empty. Used for isRequired validation
	 * @method
	 * @return {bool}
	 */
	isEmpty: function(){
		// if length of values arr == 0
		if (this.getValue().length == 0){
			return true;
		}else{
			return false;
		}
	},	
	/**
	 * Sets disable attr true
	 * @method
	 */
	setDisabled: function(){
		for(var i=0;i<this.checkBoxesArr.length;i++){
			this.checkBoxesArr[i].get(0).disabled = true;
		}			
		return true;
	},
	
	/**
	 * Sets disaqble attr false
	 * @method
	 */
	setEnabled: function(){
		for(var i=0;i<this.checkBoxesArr.length;i++){
			this.checkBoxesArr[i].get(0).disabled = false;
		}			
		return true;
	},
	
	setDisabledShowCheckedBoxes: function()
	{
		for(var i=0;i<this.checkBoxesArr.length;i++)
		{
			if(this.checkBoxesArr[i].get(0).checked)
				this.checkBoxesArr[i].get(0).disabled = true;
			else{
					var dataId = $('#'+this.dataCheckBoxId+'_'+i);
					this.checkBoxesArr[i].css("display", "none");
					dataId.css("display", "none");
					dataId.next().css("display", "none");
				}	
		}			
		return true;
	},
	
	/**
	 * Returns array of cheked checkBoxes
	 * @return {array}
	 */
	getCheckedBoxes: function(){
		var chekedArr = [];
		// get value from each checkbox
		for(var i=0;i<this.checkBoxesArr.length;i++){			
			if (this.checkBoxesArr[i].get(0).checked){
				chekedArr.push(this.checkBoxesArr[i]);
			}
		}
		
		return chekedArr;
	},
	/**
	 * Returns array of jQuery object for inline submit
	 * @return {array}
	 */
	getForSubmit: function(){
		var checkedArr = this.getCheckedBoxes(), cloneArr = [];
		// get clone of each checkbox
		for(var i=0;i<checkedArr.length;i++){
			var realCb = checkedArr[i];
			
			var cbClone = document.createElement('input');
			$(cbClone).attr('type', 'hidden');
			$(cbClone).attr('id', realCb.attr('id'));
			$(cbClone).attr('name', realCb.attr('name'));
			$(cbClone).val(realCb.val());

			cloneArr.push(cbClone);	
		}		
		cloneArr.push(this.typeElem);
		return cloneArr;
	},
	// =============== NEW CODE FROM DD ====================
	/**
	 * Deletes all checkBoxes from ctrl
	 * @method
	 */
	clearCheckBoxes: function(){
		this.spanContElem.find('div').children().remove().append('<br>');
		this.checkBoxesArr = [];
	},
	/**
	 * Adds option to select
	 * may be need to add options to specified index?
	 * @param {string} text
	 * @param {string} val
	 */
	addCheckBox: function(text, val){
		var newCheckBoxId = this.valContId+"_"+this.checkBoxesArr.length;
		// create new checkbox input
		var checkBox = document.createElement("INPUT");
		$(checkBox).attr("type", "checkbox").attr("id", newCheckBoxId).attr("name", this.valContId+'[]').val(val);
		
		var label = document.createElement("B");
		$(label).attr("id", "data_"+newCheckBoxId).html(text);
		
		this.spanContElem.find('div').append(checkBox).append("&nbsp;").append(label).append("<br/>");
		
		this.checkBoxesArr.push($("#"+newCheckBoxId));
	},
	/**
	 * Add options from array.
	 * Array must have such structure:
	 * array[0] = value, array[1] = text,
	 * array[2] = value, array[3] = text,
	 * 2*i - indexes of values; 2*i+1 - indexes of text. I starts from 0   
	 * @param {array} optionsArr
	 */
	addCheckBoxArr: function(optionsArr){
		for(var i=0; i < optionsArr.length - 1; i=i+2){ 
			this.addCheckBox(optionsArr[i+1], optionsArr[i]);
		}
	},	
	
	
	/**
	 * First loading, without ajax. Should be called directly
	 * @param {string} txt unparsed values for options
	 * @param {string} selectValue unparsed values of selected options
	 */
	preload: function(vals, selectValue){
		// clear all old options
		this.clearCheckBoxes();
		// load options
		this.addCheckBoxArr(vals);
		// if only one values except please select, so choose it
		if (this.checkBoxesArr.length==1){
			this.setValue([this.checkBoxesArr[0].val()], false);
		}
		// don't need to use ajax reload call
		this.setValue([selectValue], false);
	},
	/**
	 * Reloading dropdown. Called by change event handler
	 * @param {string} value of master ctrl
	 */
	reload: function(masterCtrlValue, updContext){	
		var ctrl = this, fName = this.fieldName, tName = this.table, rowId = this.id;
		
		//ajax params
		var ajaxParams = {
			// ctrl fieldName
			field: fName,
			// value of master ctrl. Only first val from arr, because multiDrop cannot be master
			value: masterCtrlValue,
			// tag name of ctrl
			type: this.valueElem[0].tagName,
			// Type of the page which contain this control
			pageType: this.pageType,
			// random value for prevent caching
			rndVal: (new Date().getTime())
		};		
		// get content
		$.runnerAJAX(this.shortTableName+"_autocomplete.php", ajaxParams, function(respObj){
			var data = respObj.data;
			// clear all options
			ctrl.clearCheckBoxes();
			// parse string with new options
			var data = ctrl.parseContentToValues(txt);
			// if bad data from server, or timeout ends..
			if(data===false){
				return false;
			}
			// load options
			ctrl.addOptionsArr(data);
			// if only one values except please select, so choose it
			if (ctrl.checkBoxesArr.length==1){
				ctrl.setValue([ctrl.checkBoxesArr[0].val()], false);
			}
			
			if(updContext && updContext.values && updContext.values[ctrl.fieldName]){
				ctrl.setValue([updContext.values[ctrl.fieldName]], true, updContext);
			}
			
			// fire change event, for reload dependent ctrls
			ctrl.fireEvent("change", updContext);
			// after reload clear invalid massages
			ctrl.clearInvalid();
		});
	},
	/**
	 * Drop custom function for blur event
	 * @param {Object} e
	 */
	"blur": Runner.emptyFn,
	
	makeReadonly: function(){
		if (!this.appearOnPage()){
			return false;
		}
	
		for(var i = 0; i < this.checkBoxesArr.length; i++){
			var elemChk = $(this.checkBoxesArr[i].get(0)), 
				readonlyElem = elemChk.clone(),
				elId = elemChk.get(0).id;
			readonlyElem.prop({
				"id": "readonly_" + elId,
				"name": "readonly_" + elId,
				"disabled":	true
			});	
			this.spanContElem.find('div').find('#'+elId).before(readonlyElem);
			elemChk.css('display', 'none');
		}
		return true;
	},
	
	makeReadWrite: function(){
		if (!this.appearOnPage() || !this.isReadonly()){
			return false;
		}
	
		for(var i = 0; i < this.checkBoxesArr.length; i++){
			var elemChk = $(this.checkBoxesArr[i].get(0)),
				elId = elemChk.get(0).id;
			$('#readonly_' + elId).remove();
			elemChk.css('display', '');
		}
		return true;
	},
	
	isReadonly: function(){
		for(var i = 0; i < this.checkBoxesArr.length; i++){
			if($('#readonly_' + this.checkBoxesArr[i].get(0).id).length)
				return true;
		}
		return false;
	},
	
	/**
	* Get the displayed field's value
	* @return {string}
	*/
	getDisplayValue: function(){
		var displayValues = [];
		
		for(var i = 0; i < this.checkBoxesArr.length; i++){
			if(this.checkBoxesArr[i].prop("checked")){
				displayValues.push( $("#data_" + this.checkBoxesArr[i].attr("id")).text() );
			}
		}
		return displayValues.join(", ");		
	},
	
	"click": this["change"]
	
});


/**
 * Base abstract class for lookups with textFields
 * Contains text box editor as display field and hidden field for submit values
 * @class
 * @requires Runner.controls.LookupWizard
 */
Runner.controls.TextFieldLookup = Runner.extend(Runner.controls.LookupWizard, {
	/**
	 * id of jQuery element that display value
	 * Value element in EditBoxLookup is hidden, and used for submit data
	 * @type {string}
	 */
	displayId: "",
	/**
	 * jQuery element that display value
	 * Value element in EditBoxLookup is hidden, and used for submit data
	 * @type {object}
	 */
	displayElem: null,
	/**
	 * Type of the page which contain this control
	 * @type String
	 */
	pageType: "list",
	/**
	 * Override parent contructor
	 * @param {object} cfg
	 */	
	constructor: function(cfg){
		// call parent
		Runner.controls.TextFieldLookup.superclass.constructor.call(this, cfg);	
		// add display elem id
		this.displayId = "display_"+this.valContId;
		// display jQuery elem
		this.displayElem = $("#"+this.displayId);	
		// set input type
		this.inputType = "text";				
		//event elem 
		this.elemsForEvent = [this.valueElem.get(0)];	
		// initialize control disabled
		if (cfg.disabled==true || cfg.disabled=="true"){
			this.setDisabled();
		}		
				
		if (this.preloadData){
			this.preload(this.preloadData.vals, this.preloadData.fVal);
		}
		
		// get default value, because in Control class this value will be contain false as disp value. Because dispElem created after parent class constructor called
		this.defaultValue = [this.getValue(),this.getDisplayValue()];
	},
	/**
	 * Set value to display element
	 * @param {mixed} val
	 * @return {bool} true if success otherwise false
	 */
	setDisplayValue: function(val){
		if (this.displayElem){
			return this.displayElem.val(val);
		}else{
			return false;
		}		
	},
	/**
	 * Get value from value element. 
	 * Should be overriden for sophisticated controls
	 * @method
	 */
	getDisplayValue: function(){			
		if (this.displayElem){
			return this.displayElem.val();
		}else{
			return false;
		}
	},
	/**
	 * Overrides parent method. Call setlookupValue method
	 * @method
	 * @param {mixed} value
	 * @return {Boolean} true if success otherwise false
	 */	
	setValue: function(value, triggerEvent, updContext){
		this.setLookupValue(value, triggerEvent, value, updContext);
	},
	/**
	 * Value in editBoxLookup is pair of display and hidden values
	 * @method
	 * @param {mixed} hiddVal
	 * @param {mixed} dispVal
	 * @return {Boolean} true if success otherwise false
	 */	
	setLookupValue: function(hiddVal, triggerEvent, dispVal, updContext){
		// set hidden value, if all ok
		var changed = false;
		if(this.valueElem.val()!=hiddVal)
			changed = true;
		var isSetHiddVal = this.valueElem.val(hiddVal);
		if (isSetHiddVal === false){
			return false;
		}
		// set display value, if all ok
		if(this.getDisplayValue()!=dispVal)
			changed = true;
		var isSetDispVal = this.setDisplayValue(dispVal);
		if (isSetDispVal === false){
			return false;
		}
		// trigger event if needed
		if(changed && triggerEvent === true){
			this.fireEvent("change", updContext);
		}		
		return changed;
	},
	/**
	 * Overrides parent method. Value in editBoxLookup is pair of display and hidden values
	 * @method
	 * @return {array} pair of values if success otherwise false
	 */	
	getValue: function(){
		return this.valueElem.val();
	},
	
	/**
	 * sets default value to control
	 * return true if success. otherwise false
	 * @method
	 */
	reset: function(updContext){
		this.setLookupValue(this.defaultValue[0], true, this.defaultValue[1], updContext);
		this.clearInvalid();		
		return true;
	},
	
	/**
	 * Sets disable attr true
	 * @method
	 */
	setDisabled: function(){
		if (this.displayElem){
			this.displayElem.get(0).disabled = true;
			return true;
		}else{
			return false;
		}			
	},

	/**
	 * Sets disable attr false
	 * @method
	 */
	setEnabled: function(){
		if (this.displayElem){
			this.displayElem.get(0).disabled = false;
			return true;
		}else{
			return false;
		}
	},	
	/**
	 * Sets focus to the element
	 * @method
	 * @param {bool}
	 * @return {bool}
	 */
	setFocus: function(triggerEvent){
		if (this.displayElem.get(0) && this.displayElem.get(0).disabled != true){
			this.displayElem.get(0).focus();
			if(triggerEvent===true){
				this.fireEvent("focus");
			}
			this.isSetFocus = true;
			return true;
		}else{
			this.isSetFocus = false;
			return false;
		}		
	},
	/**
	 * Removes css class to value element
	 * @param {string} className
	 */
	removeCSS: function(className){
		this.displayElem.removeClass(className);
	},
	/**
	 * Adds css class to value element
	 * @param {string} className
	 */
	addCSS: function(className){
		this.displayElem.addClass(className);
	},
	/**
	 * Returns specified attribute from value element
	 * @param {string} attrName
	 */
	getAttr: function(attrName){
		return this.displayElem.attr(attrName);
	},
	/**
	 * Return element that used as display.
	 * Usefull for suggest div positioning
	 * @return {object}
	 */
	getDispElem: function(){
		return this.displayElem;
	},
	/**
	 * Checks if control value is empty. Used for isRequired validation
	 * @method
	 * @return {bool}
	 */
	isEmpty: function(){
		return this.getDisplayValue().toString()=="";
	},	
	/**
	 * First loading, without ajax. Should be called directly
	 * @param {string} txt unparsed values for options
	 * @param {string} selectValue unparsed values of selected options
	 */
	preload: function(vals, selectValue){
		// search val
		for(var i=0;i<vals.length-1;i=i+2){
			if (vals[i] == selectValue){					
				// set values
				this.setLookupValue(vals[i], false, vals[i+1]);
			}
		}		
	},
	/**
	 * Reloading dropdown. Called by change event handler
	 * @param {string} value of master ctrl
	 */
	reload: function(masterCtrlValue, updContext){		
		var fName = this.fieldName, tName = this.table, rowId = this.id;
		// can't reload if no parent ctrl - for safety use
		if (masterCtrlValue && !this.parentCtrl){
			return false;
		}		
		var ajaxParams = {
			// ctrl fieldName
			field: fName,
			// value of master ctrl
			value: masterCtrlValue,
			// is exist parent, indicator
			isExistParent: (this.parentCtrl ? 1 : 0),
			// page mode add, edit, etc..
			mode: this.mode,
			// tag name of ctrl
			type: this.valueElem[0].tagName,
			// Type of the page which contain this control
			pageType: this.pageType,
			// random value for prevent caching
		    rndVal: (new Date().getTime())
		};
		// for handler closure
		var ctrl = this;
		// get content		
		$.runnerAJAX(this.shortTableName+"_autocomplete.php", ajaxParams, 
		function(respObj, reqStatus){
			var data = [], triggerEvent = false;
			if (respObj.success){
				data = respObj.data;
			}
		
			// set values if from server comes only one value
			if(data.length==2){
				// if value changed, so fire change event
				if (ctrl.getValue()!=data[0]){
					triggerEvent = true;
				}
				ctrl.setLookupValue(data[0], triggerEvent, data[1], updContext);
				
			// if no vals from server than clear ctrl
			}else{
				ctrl.setValue("", true, updContext);
			}
			
			//if exist autofill values set it
			if(updContext && updContext.values && updContext.values[ctrl.fieldName]){
				triggerEvent = false;
				// if value changed, so fire change event
				if(ctrl.getValue()!=updContext.values[ctrl.fieldName][0]){
					triggerEvent = true;
				}
				
				if(updContext.values[ctrl.fieldName].length==2){
					ctrl.setLookupValue(updContext.values[ctrl.fieldName][0], triggerEvent, updContext.values[ctrl.fieldName][1], updContext);
				}else{
					ctrl.setValue(updContext.values[ctrl.fieldName], triggerEvent, updContext);	
				}	
			}
			
			// after reload clear invalid massages
			ctrl.clearInvalid();
		});
		
	},
	
	initToolTip: function(text, pageObj){
		if (this.displayElem.addClass && this.mode != Runner.controls.constants.MODE_SEARCH){
			this.displayElem.addClass('titleHintBox').inputHintBox({div:$('#shiny_box'), div_sub:'.shiny_box_body', 
				html:text, incrementLeft:5, isFly: pageObj.fly});
			this.initToolTip = Runner.emptyFn;
			return true;
		}else{
			return false;
		}
	},
	
	makeReadonly: function(){
		if (!this.appearOnPage()){
			return false;
		}
		this.addNew.css('display','none');
		this.displayElem.prop({
			"disabled": true,
			"readonly": true
		});
	},
	
	makeReadWrite: function(){
		if (!this.appearOnPage()){
			return false;
		}
		this.addNew.css('display','');
		this.displayElem.prop({
			"disabled": false,
			"readonly": false
		});
	}
});


/**
 * Edit box with ajax popup class with suggest div handling
 * @requires Runner.controls.TextFieldLookup
 * @class Runner.controls.EditBoxLookup
 */
Runner.controls.EditBoxLookup = Runner.extend(Runner.controls.TextFieldLookup, {
	/**
	 * Focus indicator
	 * @type Boolean
	 */
	focusState: false,
	/**
	 * suggestDiv cursor ind
	 * @type 
	 */
	cursor: -1,
	/**
	 * Array of suggest vals
	 * @type {array}
	 */
	suggestValues: null,
	/**
	 * Array of lookup vals
	 * @type {array}
	 */
	lookupValues: null,
	/**
	 * Lookup div id
	 * @type String
	 */	
	lookupDivId: "",
	/**
	 * Lookup div jQuery object
	 * @type {object}
	 */
	lookupDiv: null,
	/**
	 * Lookup div id
	 * @type String
	 
	lookupIframeId: "",*/	
	
	/**
	 * Lookup div jQuery object
	 * @type {object}
	 */
	lookupIframe: null,
	/**
	 * Set suggest value from ajaxsuggest or not
	 * @type {boolean}
	 */
	isSetSuggestVal: false,
	
	freeInput: false,
	
	isError: false,
	/**
	 * Reference to timeout set up during the last keyup event
	 */
	submitTimout: null,

	/**
	 * Override parent contructor
	 * @param {object} cfg
	 */	
	constructor: function(cfg){
		// recreate objects
		this.lookupValues = [];
		this.suggestValues = [];
		// call parent
		Runner.controls.EditBoxLookup.superclass.constructor.call(this, cfg);
		
		if(this.pageType == "list" || this.pageType == "search")
			this.freeInput = true;
		// set lookup div id
		this.lookupDivId = 'lookupSuggest_'+this.valContId;
		// init events handling
		this.init();
		
		this.elemsForEvent = [this.displayElem.get(0)];	
		
		//add events for display elem
		this.on("blur", this.blur.fn, this.blur.options, this.blur.scope);
		//this.on("keyup", this.keyup.fn, this.keyup.options, this.keyup.scope);
		this.on("focus", this.focus.fn, this.focus.options, this.focus.scope);
		this.on("keydown", this.keydown.fn, this.keydown.options, this.keydown.scope);
	},
	setFrame: function(b){
		if(b && this.getDisplayValue()!="" && !this.freeInput){
			this.addCSS("highlight");
			this.isError = true;
		}else{
			this.removeCSS("highlight");
			this.isError = false;
		}
	},
	/**
	 * Destructor with suggest div remove
	 */
	destructor: function(){
		// call parent
		Runner.controls.EditBoxLookup.superclass.destructor.call(this);
		// destroy div
		this.destroyDiv();
	},
	
	isEmpty: function(){
		return Runner.controls.EditBoxLookup.superclass.isEmpty.call(this) || this.isError;
	},
	
	/**
	 * Keycode after which lookupSuggest should start
	 * @param {} keyCode
	 * @return {}
	 */
	checkKeyCodeForRunSuggest: function(keyCode){
		return (((keyCode >= 65) && (keyCode <= 90)) || ((keyCode >= 48) && (keyCode <= 57))
			|| ((keyCode >= 96) && (keyCode <= 105)) || (keyCode==8) || (keyCode==46) || (keyCode==32)
			|| (keyCode==222));
	},
	
	/**
	 * Keyup event handler, for call lookupsuggest
	 * Do all work after keypressed
	 */
	"keydown": {
		fn: function(e){
			// use of stop event, cause jquery to use methods and properties of orginal event, which are undefined.
			//this.stopEvent(e);
			// key code
			switch(e.keyCode){
				case 38: //up arrow
					this.moveUp();
					break;
				case 40: //down arrow
					this.moveDown();
					break;
				case 13: //enter 
					this.destroyDiv();
					this.stopEvent(e);
					return false;
					break;
			}
			if(!Runner.isAcceptableKeyCode(e))
				return;
			if(this.submitTimeout)
				clearTimeout(this.submitTimeout);
		
			var editBox = this;
			this.submitTimeout = setTimeout(function(){
				if (editBox.getDisplayValue() == ""){
					// remove div
					editBox.destroyDiv();
					// remove error highlight
					editBox.setFrame(false);
					// set empty val and trigger error
					editBox.setValue("", true);
					// return from handler
					return;
				}
				if(editBox.freeInput){
					var eventsFlag = (editBox.getDisplayValue() != editBox.getValue());
					editBox.setValue(editBox.getDisplayValue(), eventsFlag);
				}
				editBox.focus.fn.call(editBox);
				// filter keys
				if (e && editBox.checkKeyCodeForRunSuggest(e.keyCode)) {
					editBox.isSetSuggestVal = false;
					// do request for suggest div data
					editBox.lookupAjax();
				}
			}, 500);
		},
		options: {
			buffer: 200
		}
	},
	/**
	 * Keydown event handler, for make select in suggest
	 * @return {bool}
	 */
	/*"keydown": {
		fn: function(e){
			// key code
			var keyCode = e.keyCode;
			switch(keyCode){
				case 38: //up arrow
					this.moveUp();
					break;
				case 40: //down arrow
					this.moveDown();
					break;
				case 13: //enter 
					this.destroyDiv();
					this.stopEvent(e);
					return false;
					break;
			}
			return true;
		}
	},*/
	/**
	 * Creates and set position of lookup div.
	 * Also set suggest vals
	 */
	showDiv: function(divsArr){
		this.destroyDiv();
		if(!divsArr.length)
			return;
		// create div with html
		this.lookupDiv = $(document.createElement("DIV"));
		this.lookupDiv.
			attr("id", this.lookupDivId).
				addClass("search_suggest").
					css("visibility", "visible").
						appendTo(document.body);
		
		for(var i=0; i<divsArr.length; i++){
			this.lookupDiv.append(divsArr[i]);
		}
		// set div coors
		this.setDivPos();
	},
	/**
	 * Destroys lookupDiv from DOM
	 */
	destroyDiv: function(){
		// if it wasn't destroyed before
		if (this.lookupDiv){
			this.lookupDiv.remove();
		}
		this.cursor = -1;
		// clear link 
		this.lookupDiv = null;
	},
	/**
	 * Set div coords
	 */
	setDivPos: function(){
		if(!this.lookupDiv)
			return;
		// get coordinates from global func
		var dispPos = Runner.getPosition(this.getDispElem().get(0));
		dispPos.top += dispPos.height;
		this.lookupDiv.css("top",dispPos.top + "px");
		this.lookupDiv.css("left",dispPos.left + "px");
		// add highest z index
		Runner.setZindexMaxToElem(this.lookupDiv);
	},
	/**
	 * On hover suggest div value div handler
	 * @param {object} divHovered
	 */
	suggestOver: function (divHovered){
		// set new cursor index
		this.cursor = divHovered.id.substring(10);
		this.dispSuggestVal(true);
	},
	/**
	 * On unhover suggest div value div
	 * @param {object} div_value
	 */
	suggestOut: function (divValue){
		divValue.className = 'suggest_link';
		this.isSetSuggestVal = false;
	},
	/**
	 * Function that makes request to server and parse content
	 */
	lookupAjax: function(){
		// vars for after request function closure
		var table = this.table, recId = this.id, fName = this.fieldName, ctrl = this;
		
		var ajaxParams = {
			mode: this.mode,
			table: this.shortTableName,
			pageType: this.pageType,
			searchFor: this.getDisplayValue(), 
			searchField: this.goodFieldName,
			lookupValue: this.getValue(),
			category : (this.parentCtrl ? this.parentCtrl.getValue() : ""),
			rndVal: (new Date().getTime()),
			editMode: this.mode// == 'search' ? Runner.controls.constants.MODE_SEARCH : '' 
		}
		
		// do request
		$.runnerAJAX("lookupsuggest.php", ajaxParams, function(respObj){
			// if error add red frame
			if (!respObj.success){
				ctrl.setFrame(true);
				ctrl.destroyDiv();
				return false;
			}
			
			var data = respObj.data, dispVal = ctrl.getDisplayValue();
			ctrl.suggestValues = [];
			ctrl.lookupValues = [];
			var found = false;
			if(ctrl.freeInput){
				found = true;
			}
			// get suggest and lookup values
			var divsArr = [];
			for(var i=0, j=0; i < data.length-1; i=i+2,j++){
				if(ctrl.focusState){
					// div html, value and event handlers
					(function(i, j){
					var suggestDiv = $(document.createElement("DIV"))
						.attr("id", "suggestDiv" + j)
						.css("cursor", "pointer")
						.addClass("suggest_link")
						.html(data[i+1])
						.bind("mouseover", function(){
							ctrl.suggestOver(this);
						}).bind("mouseout", function(){
							ctrl.suggestOut(this);
						}).bind("click", function(){
							ctrl.setFrame(false);
							ctrl.setLookupValue(data[i], true, ctrl.suggestValues[j]);
							ctrl.destroyDiv();
						});
						divsArr.push(suggestDiv);
					})(i, j);
				}
				// change data in arrays
				ctrl.suggestValues[j] = data[i+1];
				ctrl.lookupValues[j] = data[i];
				if(!found && ctrl.suggestValues[j] == dispVal){
					//	trigger events if value changed
					var eventsFlag = (ctrl.lookupValues[j] != ctrl.getValue());
					ctrl.setLookupValue(ctrl.lookupValues[j], true, ctrl.suggestValues[j]);
					found = true;
				}
			}
			
			
			if(found){
				ctrl.setFrame(false);
			}else{
				ctrl.setFrame(true);
				var eventsFlag = (ctrl.getValue()!="");
				ctrl.setLookupValue("", eventsFlag, dispVal);
			}
			if(!ctrl.focusState){
				return true;
			}
			
			/*if(ctrl.lookupValues.length){
				ctrl.setFrame(false);
			}else{
				ctrl.setFrame(true);
				var eventsFlag = (ctrl.getValue()!="");
				ctrl.setLookupValue("", eventsFlag, dispVal);
			}*/
			
			// show div
			ctrl.showDiv(divsArr);
			// set postition
			ctrl.setDivPos();
			
			$("body,input,a").click(function (evt) {
				 var target = evt.target;
				 if(target.id.substr(0,10) != "suggestDiv"){
					ctrl.destroyDiv();
				}
			});
		});
	},
	/**
	 * Down arrow handler
	 */
	moveDown: function(){
		if(!this.lookupDiv)
			return;
		// if there are any suggest vals and cursor not on last of them
		if(this.lookupDiv.children().length > 0 && this.cursor < this.lookupDiv.children().length){
			// add cursor count - same to move down
			this.cursor++;
			// loop for all suggest vals
			this.dispSuggestVal();
			// for cursor loop
			if (this.cursor == (this.lookupDiv.children().length)) {
				this.cursor = -1;
				this.focus.fn.call(this); 
			}
		}
	},
	/**
	 * Up arrow handler
	 */
	moveUp: function(){
		if(!this.lookupDiv)
			return;
		// there are any suugest vals and dont't know why check that cursor >= -1
		if(this.lookupDiv.children().length > 0 && this.cursor >= -1){
			// move up same as make cursor less
			this.cursor--;
			// set cursor on the last values, for loop
			if (this.cursor == -2) {
				this.cursor = this.lookupDiv.children().length-1; 
				this.focus.fn.call(this); 
			}
			// set styles and values
			this.dispSuggestVal();
		}
	},
	
	dispSuggestVal: function(hover){
		hover = hover || false;
		for(var i = 0; i < this.lookupDiv.children().length; i++){
			// if val that should be highlighted
			if(i == this.cursor){
				// make highlight style
				this.lookupDiv.children().get(i).className = "suggest_link_over";
				// get new values
				if(hover){
					this.isSetSuggestVal = true;
					continue;
				}
				var suggestVal = this.suggestValues[this.cursor].replace(/\<(\/b|b)\>/gi,""), 
					lookupVal = this.lookupValues[this.cursor];
				// if lookup val changes, than fireEvent
				if (this.getValue() != lookupVal){
					// remove error 
					this.setFrame(false);
					this.setLookupValue(lookupVal, true, suggestVal);
				}else{
					this.setLookupValue(lookupVal, false, suggestVal);
				}
					
			}
			// set simple suggest val style
			else{
				this.lookupDiv.children().get(i).className = "suggest_link";
			}
		}
	},
	
	/**
	 * Overrides parent function for element control
	 * Sets disable attr true
	 * Sets hidden css style true for link add New
	 * @method
	 */
	setDisabled: function(){
		var res = Runner.controls.EditBoxLookup.superclass.setDisabled.call(this);
		if (res){
			this.addNew.css('visibility','hidden');
		}
		return res;
	},
	/**
	 * Overrides parent function for element control
	 * Sets disable attr false
	 * Sets visible css style true for link add New
	 * @method
	 */
	setEnabled: function(){
		var res = Runner.controls.EditBoxLookup.superclass.setEnabled.call(this);
		if (res){
			this.addNew.css('visibility','visible');
		}
		return res;
	},
	/**
	 * Blur event handler
	 * @event
	 */
	"blur": {
		fn: function(e){
			this.focusState = false;
			if(!this.freeInput && !this.isSetSuggestVal){
				if(this.suggestValues.length){
					if (this.getDisplayValue()!= "" && !this.suggestValues.isInArray(this.getDisplayValue(), true)){
						this.setFrame(true);
					}else{
						this.setFrame(false);
					}
				}
			}
			var ctrl = this;
			setTimeout(function(){
				ctrl.destroyDiv();
			}, 250);
			Runner.controls.EditBoxLookup.superclass["blur"].call(this, e);	
		}
	},
	/**
	 * Focus event handler
	 * @event
	 */
	"focus": {
		fn: function(e){
			this.stopEvent(e);
			this.focusState = true;
		}
	},
	/**
	 * Used for prevent firing change event, and calling trigger manually
	 * @param {string} dispVal
	 * @param {string} hiddVal
	 * @param {bool} triggerEvent
	 */
	setLookupValue: function(hiddVal, triggerEvent, dispVal, updContext){
		Runner.controls.EditBoxLookup.superclass.setLookupValue.call(this, hiddVal, triggerEvent, dispVal, updContext);
	},
	
	getStringValue: function(){
		if(this.pageType == "list" || this.pageType == "search")
			return this.getDisplayValue();
		else
			return this.getValue();
	}
});

/**
 * List page with search lookup control class
 * @requires Runner.controls.TextFieldLookup
 */
Runner.controls.ListPageLookup = Runner.extend(Runner.controls.TextFieldLookup, {
	/**
	 * id of a tag, which opens search div
	 * @type {String}
	 */
	selectLinkId: "",
	/**
	 * jQuery object of a tag, which opens search div
	 * @type {object}
	 */
	selectLinkElem: null,
	
	lookupVals: null,
	
	selectField: '',
	
	isLookupOpen: false,
	
	/**
	 * Override parent contructor
	 * @param {object} cfg
	 */
	constructor: function(cfg){
		//call parent
		Runner.controls.ListPageLookup.superclass.constructor.call(this, cfg);
		// init events handling
		this.init();
		// a select tag id
		this.selectLinkId = "open_lookup_"+this.goodFieldName+"_"+this.id;
		// a select tag jQuery element
		this.selectLinkElem = $("#"+this.selectLinkId);
		// initialize control disabled
		if (cfg.disabled==true || cfg.disabled=="true"){
			this.setDisabled();
		}
		var control = this, eventParams = {
			tName: this.lookupTable, 
			pageType: Runner.pages.constants.PAGE_LIST, 
			pageId: this.pageId, 
			lookupCtrl: this,
			destroyOnClose: true,
			modal: true,
			baseParams: {
				parId: this.id, 
				field: this.fieldName, 
				category: "", 
				table: this.table, 
				firstTime: 1,
				mode: "lookup",
				editMode: this.mode,
				pageType: this.pageType
			}
		};
		
		this.selectLinkElem.bind("click", eventParams, function(e){
			Runner.Event.prototype.stopEvent(e);
			if($("#search_suggest").length > 0 && typeof DestroySuggestDiv != "undefined"){
				DestroySuggestDiv();
			}
			if (control.parentCtrl){
				e.data.baseParams.category = control.parentCtrl.getValue();
				if(typeof e.data.baseParams.category == "object")
					e.data.baseParams.category = e.data.baseParams.category[0];
			}else{
				e.data.baseParams.category = '';
			}
			control.pageId = Runner.pages.PageManager.openPage(e.data);
			control.setDisabled();
		});
	},
	
	/**
	 * Overrides parent function for element control
	 * Sets disable attr true
	 * Sets hidden css style true for image selectLinkElem
	 * @method
	 */
	setDisabled: function(){
		var res = Runner.controls.ListPageLookup.superclass.setDisabled.call(this);
		if (res){
			if (this.selectLinkElem){
				this.selectLinkElem.css('visibility','hidden');
			}
		}
		return res;
	},
	/**
	 * Overrides parent function for element control
	 * Sets disable attr false
	 * Sets visible css style true for image selectLinkElem
	 * @method
	 */
	setEnabled: function(){
		var res = Runner.controls.ListPageLookup.superclass.setEnabled.call(this);
		if (res){
			if (this.selectLinkElem){
				this.selectLinkElem.css('visibility','visible');
			}
		}
		return res;	
	},
	
	setValByInd: function(valInd){
		this.setLookupValue(this.lookupVals[valInd].linkVal, true, this.lookupVals[valInd].dispVal);
	},
	
	addLookupVal: function(linkVal, dispVal){
		return (this.lookupVals.push({'linkVal': linkVal, 'dispVal':dispVal}) - 1);
	},
	/**
	 * Use for init link
	 * helper closure function, for sending correct ind link
	 * @param {} link
	 * @param {} ind
	 * @param {} windId
	 */
	initLink: function(link, ind){
		var ctrl = this;
		link.bind('click', function(e){
			ctrl.stopEvent(e);
			ctrl.setValByInd(ind);
			Runner.pages.PageManager.unregister(ctrl.lookupTable, ctrl.pageId);
			ctrl.setFocus();
			// for detail table on master add page
			ctrl.fireEvent("keyup");
		});
	},
	/**
	 * Initialize links
	 * @param {} winId
	 */
	initLinks: function(winId){	
		var links = $("a[type='lookupSelect"+winId+"']");
		this.setEnabled();
		for(var i=0;i<links.length;i++){
			// use helper func, to prevent sending links last index in closure
			this.initLink($(links[i]), i);
		}
	},
	
	makeReadonly: function(){
		Runner.controls.ListPageLookup.superclass.makeReadonly.call(this);
		this.selectLinkElem.css('display','none');
	},
	
	makeReadWrite: function(){
		Runner.controls.ListPageLookup.superclass.makeReadWrite.call(this);
		this.selectLinkElem.css('display','');
	}
	
});
// create namespace
Runner.namespace('Runner.util.inlineEditing');

/**
 * Base abstract class for InlineAdd and InlineEdit
 * provides base functionality and event handling
 * @class Runner.util.inlineEditing.InlineEditor
 */
Runner.util.inlineEditing.InlineEditor = Runner.extend(Runner.util.Observable, {
	
	tName: "",
	
	shortTName: "",
	
	id: -1,
	
	rows: null,
	
	ajaxRequestUrl: null,
	
	lookupTable: "",
	
	categoryValue: "",
	
	lookupField: "",
	
	fNames: null,
	
	pageType: "",
	
	pageObj: "",
	
	submitUrl: "",
	
	saveAllButt: null,
	
	cancelAllButt: null,
	
	massRecButtEditMode: false,
	
	isUseFileUpload: true,
	
	hideRevertButt: false,
	
	hideSaveButt: false,
	
	baseParams: null,
	
	loadSettings: false,
	
	isVertLayout: false,
	
	isEditOwn: false,
	
	constructor: function(cfg){
		this.rows = [];
		this.fNames = [];
		this.baseParams = {};
		
		Runner.apply(this, cfg);
		Runner.util.inlineEditing.InlineEditor.superclass.constructor.call(this, cfg);	
		
		this.pageObj = Runner.pages.PageManager.getAt(this.tName, this.id); 
		this.isEditOwn = Runner.pages.PageSettings.getTableData(this.tName, "isEditOwn");
		this.totalFields = Runner.pages.PageSettings.getTableData(this.tName, "totalFields");
		this.isUseLocking = Runner.pages.PageSettings.getTableData(this.tName, "locking");
		
		if(this.isUseLocking)
		{
			this.locking = new Runner.Locking({
				tName: this.tName,
				pageId: this.id
			});
		}
		
		this.addEvents(
			'rowsEdited',
			'createControls',
			'beforeSubmit',
			'afterSubmit',
			'afterSave',
			'submitFailed',
			'beforeProcessNewRow',
			'revertRow',
			'validationFailed',
			'afterInit',
			'afterPageReady',
			'beforeRequestControls',
			'recalcGridSize',
			'beforeCancel',
			'cancel'
		);
		
		this.on('rowsEdited', function(){
			this.toggleMassRecButt();
			this.calcTotals();
		}, this);
		
		this.rowPref =  "gridRow";
	},
	
	initEvents: function(pageType){
		var events = Runner.pages.PageSettings.getTableData(this.tName, "events"),
			eventHnArr,
			i;
		for(var pType in events){
			if (pType != this.pageType){
				continue;
			}
			for(var evName in events[pType]){
				if (evName != 'afterInit' && evName != 'afterPageReady'){
					continue;
				}
				eventHnArr = events[pType][evName];
				for(i=0;i<eventHnArr.length;i++){
					this.on(evName, eventHnArr[i].hn,  eventHnArr[i].scope || this.pageObj || this);
				}
			}
		}
	},
	
	init: function(){
		this.initButtons();
		this.initEvents();
	},
	/**
	 * Reinit inline object properties
	 * Use for example to ajax reload list page
	 * id and parId can be no need
	 */
	reInit: function(gridRows){
		this.rows = gridRows;
		if(this.pageObj.pageMode == Runner.pages.constants.MODE_LIST_DETAILS){
			this.initButtons();
		}
	},
	
	/**
	 * UnSelect all records
	 */
	resetSelectAll: function(){
		if ($('#select_all'+this.id).length) {
			$('#select_all'+this.id).get(0).checkAllStatus = false;
		}
		if ($('.chooseAll'+this.id).length){
			$('input[type=checkbox][id^=chooseAll_'+this.id+']').each(function(){
				this.checked = false;
			});
		}
	},
	
	initButtons: function(){
		this.editAllButt = $("a[id=edit_selected"+this.id+"]");
		this.saveAllButt = $("a[id=saveall_edited"+this.id+"]");
		this.cancelAllButt = $("a[id=revertall_edited"+this.id+"]");
		
		var inlineObj = this;
		this.saveAllButt.bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			inlineObj.saveAll();
			inlineObj.resetSelectAll();
		});
		
		this.cancelAllButt.bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			inlineObj.cancelAll();
			inlineObj.resetSelectAll();
		});
		this.pageObj.inlineButtonsIntialized = true;
	},
	
	parseForTotals: function(val, format){
		if (format=='Number'){
			return parseFloat(val);
		}else if(format=='Time'){
			var timeArr = val.split(":");
			if(timeArr.length!=3){
				return "";
			}else{
				timeArr[0] = parseInt(timeArr[0],10);
				timeArr[1] = parseInt(timeArr[1],10);
				timeArr[2] = parseInt(timeArr[2],10);
				return timeArr;
			}
		}else{
			return val.toString().trim();
		} 
	},
	
	calcTotalField: function(fName, format){
		var fVal, sec = 0, s, m, h, d, totalVal = 0;
		for(var i=0;i<this.rows.length;i++){
			if (typeof this.rows[i].data[fName] == "undefined"){
				this.getValuesFromSpan(this.rows[i]);
			}
			fVal = this.parseForTotals(this.getValueFromSpan(this.rows[i],fName), format);	
			if (!fVal){ 
				continue;
			}
			if (format == "Time"){
				sec += fVal[2] + fVal[1]*60 + fVal[0]*3600;
			}else{
				var parsedVal = parseFloat(fVal);
				if(!isNaN(parsedVal)){
					totalVal+=parsedVal;
				}
			}
		}
		if(format=='Time'){
			s = sec % 60;
			sec -= s;
			sec /= 60;
			m = sec % 60;
			sec -= m;
			sec /= 60;
			h = sec % 24;
			sec -= h;
			sec/=24;
			d = sec;
			totalVal = (d>0 ? d+'d ' : '')+(h==0 ? '00' : h)+':'+(m>9 ? m : (m==0 ? '00' :'0'+m))+':'+(s>9 ? s : (s==0 ? '00' : '0'+s));
		} 
		$("#total"+this.id+"_"+Runner.goodFieldName(fName)).html(''+totalVal);
	},
	
	calcCountField: function(fName, format){
		var fVal, totalVal = 0;
		for(var i=0;i<this.rows.length;i++){
			if (typeof this.rows[i].data[fName] == "undefined"){
				this.getValuesFromSpan(this.rows[i]);
			}
			fVal = this.rows[i].data[fName].toString().trim();
			if (fVal){
				totalVal++;
			}
		}
		$("#total"+this.id+"_"+Runner.goodFieldName(fName)).html(''+totalVal);
	},
	
	calcAverageField: function(fName, format){
		var fVal, sec = 0, s, m, h, d, totalVal = 0, numRows = 0;
		for(var i=0;i<this.rows.length;i++){
			if (typeof this.rows[i].data[fName] == "undefined"){
				this.getValuesFromSpan(this.rows[i]);
			}
			fVal = this.parseForTotals(this.getValueFromSpan(this.rows[i],fName), format);
			if (!fVal){
				continue;
			}
			if (format == "Time"){
				sec += fVal[2] + fVal[1]*60 + fVal[0]*3600;
				numRows += 1;
			}else{
				var parsedVal = parseFloat(fVal);
				if(!isNaN(parsedVal)){
					totalVal += parsedVal;
					numRows += 1;
				}
			}
		}
		if(format=='Time' && numRows){
			sec = Math.round(sec/numRows);
			s = sec % 60;
			sec -= s;
			sec /= 60;
			m = sec % 60;
			sec -= m;
			sec /= 60;
			h = sec % 24;
			sec -= h;
			sec/=24;
			d = sec;
			totalVal = (d>0 ? d+'d ' : '')+(h==0 ? '00' : h)+':'+(m>9 ? m : (m==0 ? '00' :'0'+m))+':'+(s>9 ? s : (s==0 ? '00' : '0'+s));
		}else if(numRows){
			totalVal = Math.round((totalVal/numRows)*100)/100;
		}else{
			totalVal = "";
		}
		$("#total"+this.id+"_"+Runner.goodFieldName(fName)).html(''+totalVal);
	},
	
	calcTotals: function(){
		if(this.pageObj.fly){
			return;
		}
		for(var i=0; i<this.totalFields.length; i++){
			if (this.totalFields[i].type == "TOTAL"){
				this.calcTotalField(this.totalFields[i].fName, this.totalFields[i].format);
			}else if(this.totalFields[i].type == "COUNT"){
				this.calcCountField(this.totalFields[i].fName, this.totalFields[i].format);
			}else if(this.totalFields[i].type == "AVERAGE"){
				this.calcAverageField(this.totalFields[i].fName, this.totalFields[i].format);
			}
		};
		var totalsTr = $('tr[rowid=totals]',this.pageObj.gridElem);
		if($(totalsTr).css('display')=='none'){
			$(totalsTr).css('display','');
		}
	},
	
	initForm: function(row){
		if (row.basicForm){
			row.basicForm.fieldControls = Runner.controls.ControlManager.getAt(this.tName, row.id);
			row.basicForm.id = row.id;
			row.basicForm.baseParams.id = row.id;
			row.basicForm.fields = this.fNames;
		}else{
			var inlineObj = this;
			var baseParams = {a: 'added', editType: 'inline', id: row.id};
			
			
			row.basicForm = new Runner.form.BasicForm({
				fields: this.fNames,
				fieldControls: Runner.controls.ControlManager.getAt(this.tName, row.id),
				isFileUpload: this.isUseFileUpload,
				standardSubmit: false,
				submitUrl: this.submitUrl,
				method: 'POST',
				id: row.id,
				baseParams: Runner.apply(this.baseParams, baseParams),
				successSubmit: {
					fn: function(respObj, formObj, fieldControls){
						if (!respObj.success){
							if (respObj.fatalError)
								formObj.clearForm();
							this.fireEvent("submitFailed", respObj, this, formObj, fieldControls);											
							inlineObj.makeError(respObj.message, row);	
						}else{
							if(respObj['nonEditable'])
								row.isEditable = false;
							this.afterSubmit(row, respObj);
						}
						if(row.saveLink)
							row.saveLink.removeClass('disabled');
					},
					scope: this
				},
				submitFailed: {
					fn: function(respObj, formObj, fieldControls){
						if (respObj.success === false){
							this.makeError(respObj.message, row);
						}else{
							this.makeError(respObj, row);
						}
						this.fireEvent("submitFailed", {}, this, formObj, fieldControls);
						if(row.saveLink)
							row.saveLink.removeClass('disabled');
					},
					scope: this
				},
				beforeSubmit: {
					fn: function(formObj){
						return this.fireEvent("beforeSubmit", row, this, formObj);
					},
					scope: this
				},
				validationFailed: {
					fn: function(formObj, fieldControls){
						this.fireEvent("validationFailed", formObj, fieldControls);
						if(row.saveLink)
							row.saveLink.removeClass('disabled');
					},
					scope: this
				}
			});
		}
		if(this.pageObj.baseParams && this.pageObj.baseParams.mode == "lookup"){
			row.basicForm.baseParams["forLookup"] = true;
			row.basicForm.baseParams["table"] = this.pageObj.lookupCtrl.shortTableName;
			row.basicForm.baseParams["field"] = this.pageObj.lookupCtrl.goodFieldName;
		}
	},
	
	cancelAll: function(){
		var canceledAll = true;
		for(var i=0; i<this.rows.length; i++){
			if (!this.rows[i].submitted){
				if (this.rows[i].isAdd){
					if(Runner.util.inlineEditing.InlineAdd.prototype.cancelButtonHn.call(this, this.rows[i],true))	
						i--;
					else
						canceledAll = false;
				}else if(this.pageObj.inlineEdit){
					this.pageObj.inlineEdit.cancelButtonHn(this.rows[i],true);
				}
			}
		}
		if(canceledAll){
			this.fireEvent("recalcGridSize");
			this.toggleMassRecButt();
		}
	},
	
	submit: function(row){
		row.revertted = false;
		this.initForm(row);
		row.basicForm.submit();	
	},
	
	saveAll: function(){
		// fire rowsEdited event if all rows submited
		var allVals = [],
			allKeys = [],
			allRowIds = [];
		for(var i=0; i<this.rows.length; i++){
			allVals.push(this.rows[i].data);
			allKeys.push(this.rows[i].keys);
			allRowIds.push(this.rows[i].id);
			if (this.rows[i].submitted === false && this.rows[i].cancelLink.length){
				return false;
			}
		}
		
		this.fireEvent('rowsEdited', allVals, this.fNames, allKeys, allRowIds);
		return true;
	},
	
	cancelButtonHn: function(){	
		$('div.shiny_box').hide();
	},
	
	getControls: function(row, hideRevertButt, hideSaveButt){
		// for closure
		var inlineObject = this;
		var reqParams = {
			rndval: Math.random(),
			editType: "inline",
			id: row.id,
			mainMPageType: Runner.pages.PageSettings.getTableData(this.tName, "mainMPageType") || "",
			isNeedSettings: !Runner.pages.PageSettings.checkSettings(this.tName) || this.loadSettings,
			table: Runner.pages.PageSettings.getShortTName(this.lookupTable), 
			field: Runner.goodFieldName(this.lookupField), 
			category: this.categoryValue
		};
		
		this.fireEvent('beforeRequestControls', this, row, reqParams);
		
		for(var i = 0; i < row.keys.length; i++){
			reqParams['editid'+(i+1)] = escape(row.keys[i]);
		}
		
		$.getJSON(this.ajaxRequestUrl, reqParams, function(ctrlsJSON){
			if(ctrlsJSON.success || ctrlsJSON.success!==false){
				if(inlineObject.loadSettings && ctrlsJSON.settings){
					// add settings
					Runner.pages.PageSettings.addSettings(inlineObject.tName, ctrlsJSON.settings, false);
				}
				var init = function() {
					inlineObject.makeRowEditable(row, ctrlsJSON);
					if(inlineObject.isUseLocking){
						inlineObject.initLocking(row,ctrlsJSON);
					} 
					inlineObject.getEditBlock(row, hideRevertButt, hideSaveButt);
					inlineObject.fireEvent('afterInit', inlineObject.pageObj, inlineObject.pageObj.proxy, row.id, row, inlineObject);
				};
				if(ctrlsJSON.additionalCSS){
					Runner.util.ScriptLoader.loadCSS(ctrlsJSON.additionalCSS);
				}
				if(ctrlsJSON.additionalJS){
					for(var jsFile in ctrlsJSON.additionalJS)
						Runner.util.ScriptLoader.addJS.apply(Runner.util.ScriptLoader, [[jsFile], ctrlsJSON.additionalJS[jsFile]]);
					Runner.util.ScriptLoader.on('filesLoaded', function(){ 
						init();
						inlineObject.fireEvent('afterPageReady', inlineObject.pageObj, inlineObject.pageObj.proxy, row.id, row, inlineObject);
					}, inlineObject, {single: true});
					Runner.util.ScriptLoader.load();
				}else{
					init();
				}
			}else{
				inlineObject.makeError(ctrlsJSON.message, row);
				inlineObject.showRowButtons(row);
			}
		});	
	},	
	
	initLocking: function(row,ctrlsJSON){
		if(this.pageType!=Runner.pages.constants.PAGE_EDIT)
			return;
		
		var enableCtrls = ctrlsJSON.enableCtrls;
		if(enableCtrls == undefined){
			enableCtrls = ctrlsJSON.settings['tableSettings'][this.tName]['enableCtrls'];
		}
		
		var confirmTime = ctrlsJSON.confirmTime;
		if(confirmTime == undefined){
			confirmTime = ctrlsJSON.settings['tableSettings'][this.tName]['confirmTime'];
		}
		
		if(enableCtrls){
			var sKeys = this.getKeysForLocking(row),
				inlineObj = this;
			inlineObj.locking.StartLocking(inlineObj,row.id,sKeys,confirmTime);
		}
	},
	
	makeRowEditable: function(row, ctrlsJSON){
		for(var i=0; i<this.fNames.length; i++){
			var spanCont = $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i]));
			if(row.isAdd){
				spanCont.append(ctrlsJSON['html'][this.fNames[i]]);
			}else{
				spanCont.html(ctrlsJSON['html'][this.fNames[i]]);
			}
		}
		var ctrlsMap = ctrlsJSON.controlsMap[this.tName][this.pageType][row.id].controls,
			ctrlsArr = [];
		for(var i=0; i<ctrlsMap.length; i++){
			if (!this.fNames.isInArray(ctrlsMap[i].fieldName)){
				continue;
			}
			ctrlsMap[i].table = this.tName;
			ctrlsArr.push(Runner.controls.ControlFabric(ctrlsMap[i], this.pageType, true));
		}
		for(var i=0; i<ctrlsArr.length; i++){
			if (!ctrlsArr[i].isLookupWizard){
				continue;
			}
			if (ctrlsArr[i].parentFieldName && ctrlsArr[i].skipDependencies !== true){
				var parentCtrl = Runner.controls.ControlManager.getAt(this.tName, row.id, ctrlsArr[i].parentFieldName);
				ctrlsArr[i].setParentCtrl(parentCtrl); 
				if (parentCtrl && parentCtrl.isLookupWizard){
					parentCtrl.addDependentCtrls([ctrlsArr[i]]);
				}
			}
		}
		
		Runner.pages.RunnerPage.prototype.initToolTips.call(this.pageObj, ctrlsJSON.controlsMap[this.tName][this.pageType][row.id].toolTips,this.tName);
		this.fireEvent('createControls', row, ctrlsArr);
		var showFirstFocus = true;
		if(this.pageObj.pageMode == "listdetails"){
			if(Runner.pages.PageManager.getAt(this.pageObj.masterTName, this.pageObj.parId).pageType == "add"){
				showFirstFocus = false;
			}
		}
		if(showFirstFocus){
			Runner.pages.RunnerPage.prototype.setFirstFocus.call(this.pageObj, row.id);
		}
		
		$(".runner-button", row.row).each(function(){
			Runner.initRunnerButtonByClass(this);
		});
	},
	
	getSaveLink: function(row, hideSaveButt){
		if (row.saveLink && row.saveLink.length && hideSaveButt !== true){
			row.saveLink.show();
			return row.saveLink;
		}else if(hideSaveButt === true){
			return false;
		}
		var link = document.createElement('A');
		$(link).attr('title', Runner.lang.constants.TEXT_SAVE).addClass('saveEditing').attr('href', '').attr('id', 'saveLink'+row.id);
		if (hideSaveButt === true){
			$(link).css('display', 'none');
		}
		var imgButt = document.createElement('IMG');
		$(imgButt).attr('src', Runner.pages.constants.OK_GIF).attr('border', '0').appendTo(link);
		$(imgButt).addClass("inline-icons"); 
		
		$(imgButt).bind("click", {inlineObj: this, row: row}, function(e){
			Runner.Event.prototype.stopEvent(e);
			var row = e.data.row, 
				inlineObj = e.data.inlineObj;
			if(row.saveLink.hasClass('disabled'))
				return false;
			// flag for details recount
			row.saveLink.addClass('disabled');
			inlineObj.fromSaveBtn = true;
			$('div.shiny_box').hide();
			row.fileFieldsCount = 0;
			row.upploadErrorHappened = false;
			inlineObj.waitForFilesUpload(row);
		});
		return row.saveLink = $(link);
	},
	waitForFilesUpload: function(row){
		var inlineObj = this, controls = Runner.controls.ControlManager.getAt(this.tName, row.id);
		for(var index in controls){
			if(controls[index].editFormat == Runner.controls.constants.EDIT_FORMAT_FILE
				&& controls[index].filesToUploadCount > 0){
				row.fileFieldsCount++;
				controls[index].errorHappened = false;
				controls[index].uploadForm.bind('fileuploadstopped', { ctrl: controls[index] }, function(e, data){
					row.fileFieldsCount--;
					$(this).unbind('fileuploadstopped');
					if(e.data.ctrl.errorHappened){
						row.upploadErrorHappened = true;
						inlineObj.errorHn(row);
					}
					else
						inlineObj.callSaveHn(row);
				});
				$(".btn-primary.start", controls[index].uploadForm).click();
			} 
		}
		if(row.fileFieldsCount < 1)
			this.callSaveHn(row);
	},
	
	errorHn:function(row){
		if(row.fileFieldsCount < 1){
			row.saveLink.removeClass('disabled');
		}
	},
	
	callSaveHn: function (row){
		if(row.fileFieldsCount < 1 && !row.upploadErrorHappened){
			this.submit(row);
			this.toggleMassRecButt();
			this.resetSelectAll();
		}
	},
	getCancelLink: function(row, hideRevertButt){
	
		if (row.cancelLink && row.cancelLink.length && hideRevertButt !== true){
			row.cancelLink.show();
			return row.cancelLink;
		}else if(hideRevertButt === true){
			return false;
		}
		var link = document.createElement('A');
		$(link).attr('title', Runner.lang.constants.TEXT_CANCEL).addClass('revertEditing').attr('href', '').attr('id', 'revertLink'+row.id);
		if (hideRevertButt === true){
			$(link).css('display', 'none');
		}
		var imgButt = document.createElement('IMG');
		$(imgButt).addClass("inline-icons"); 
		
		$(imgButt).attr('src', Runner.pages.constants.CANCEL_GIF).attr('border', '0').appendTo(link).
			bind("click", {inlineObj: this, row: row}, function(e){
				Runner.Event.prototype.stopEvent(e);
				var inlineObj = e.data.inlineObj;
				inlineObj.cancelButtonHn(e.data.row);
				if(inlineObj.rows.length !== 0)
					inlineObj.toggleMassRecButt();
				inlineObj.resetSelectAll();
			}
		);
		return row.cancelLink = $(link);
	},	
	
	getEditBlock: function(row, hideRevertButt, hideSaveButt){
		if (!row.saveLink || !row.saveLink.length || !row.cancelLink || !row.cancelLink.length){
			if (row.iEditLink.length){
				row.iEditLink.
					after(this.getCancelLink(row, hideRevertButt)).
						after(this.getSaveLink(row, hideSaveButt));
			}else{
				var span;
				for(var i=0; i<this.fNames.length; i++){
					span = $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i]));
					if (span.length){
						span.
							prepend(this.getCancelLink(row, hideRevertButt)).
								prepend(this.getSaveLink(row, hideSaveButt));
						break;
					}
				}
			}
		}else{
			this.getCancelLink(row, hideRevertButt);
			this.getSaveLink(row, hideSaveButt);
		}
		
	},
	
	getKeysForLocking: function(row){
		var sKeys = "";
		for(var i=0; i<row.keys.length; i++){
			sKeys += row.keys[i] + "&";
		}
		sKeys = sKeys.substring(0,sKeys.length-1);
		return sKeys;
	},
	
	revertRow: function(row){
		// clear controls
		Runner.controls.ControlManager.unregister(this.tName, row.id);
		this.fireEvent('revertRow', row);
	},
	
	removeRowData: function(row, ind){
		if (row.basicForm && row.basicForm.destructor){
			row.basicForm.destructor();
		}
		if(row.row){
			row.row.remove();
		}
		if(row.srow){
			row.srow.remove();
		}
		
		if(this.rows.length === 1){
			this.pageObj.gridElem.hide();
			this.pageObj.getBrickObjs("grid")[0].show();
			$("thead tr", this.pageObj.gridElem).addClass('runner-hiddenelem');
			$('tr.runner-bottomrow',$(this.pageObj.gridElem).children("tbody")).addClass('runner-hiddenelem');
			$('tr.footer',$(this.pageObj.gridElem).children("tbody")).addClass('runner-hiddenelem');
			this.editAllButt.parent().hide();
			this.saveAllButt.parent().hide();
			this.cancelAllButt.parent().hide();
			$("a[id=print_selected"+this.id+"]").parent().hide();
			$("a[id=export_selected"+this.id+"]").parent().hide();
			$("a[id=delete_selected"+this.id+"]").parent().hide();
		}
		
		return this.rows.splice(ind || this.getRowInd(row), 1);
	},
	
	getRowInd: function(row){
		for(var i=0; i<this.rows.length; i++){
			if (this.rows[i].id === row.id){
				return i;
			}
		}
		return -1;
	},
	
	getRowById: function(rowId){
		for(var i=0; i<this.rows.length; i++){
			if (this.rows[i].id === parseInt(rowId)){
				return this.rows[i]; 
			}
		}
		return false;
	},
	
	makeError: function(msg, row){
		row.errorMess = msg;
		if (!row.errorDiv){
			var root = this.pageObj.gridElem;
			if(!root){
				return false;
			}
			
			var span = $("span[id^=edit"+row.id+"_]:eq(0)",root);
			span.append("<div class=runner-error><a href=# id=\"error_" + row.id + "\" style=\"white-space:nowrap;\">"+Runner.lang.constants.TEXT_INLINE_ERROR+" >></a></div>");	
			row.errorDiv = span.find("div");
			if (!this.errCont){
				$(document.body).append("<div class=\"runner-inline-error runner-message\"></div>");
				this.errCont = $("div.runner-inline-error").hide();
			}
			var inlineObj = this;
			$("#error_"+row.id).bind("mouseover", function(e){
				inlineObj.errCont.html(row.errorMess);
				inlineObj.errCont.show();
				var errorPos = Runner.getPosition(this);
				errorPos.left += errorPos.width;
				errorPos.top += errorPos.height;
				
				inlineObj.errCont.css("top",errorPos.top + "px").show().css("left",errorPos.left + "px").css("z-index",100).css("position","absolute");
			});
			$("#error_"+row.id).bind("mouseout", function(e){
				inlineObj.errCont.hide();
			});
		}
		this.errCont.html(msg);
	},
	
	clearError: function(row){
		delete row.errorMess;
		if (row.errorDiv){
			row.errorDiv.remove();
			delete row.errorDiv;
		}
	},
	
	afterSubmit: function(row, newData){
	
		this.fireEvent("beforeProcessNewRow", row, newData.vals, newData.fields, newData.keys);
		// add new data from server to row object
		row.data = Runner.apply({}, newData.vals); //shown data in grid
		row.keys = newData.keys;
		row.keyFields = newData.keyFields;
		row.rowVals = newData.rawVals; // data from BD
		
		// delete controls
		Runner.controls.ControlManager.unregister(this.tName, row.id);
		// proccess checkbox
		if (row.checkBox.length && !newData.noKeys){
			var checkBoxVal = "";
			for(var i=0; i<newData.keys.length; i++){
				checkBoxVal += newData.keys[i]+"&";
			}
			checkBoxVal = checkBoxVal.substring(0, checkBoxVal.length-1);
			row.checkBox.val(checkBoxVal).show();
			row.checkBox[0].checked = false;
			this.changeLinksKeys(row);
		}
		// add values to lookupVals
		if(this.pageObj.baseParams && this.pageObj.baseParams.mode == "lookup" && newData.linkValue){
			newData.vals[this.pageObj.lookupCtrl.linkField] = newData.linkValue;
			newData.vals[this.pageObj.lookupCtrl.dispFieldAlias ? this.pageObj.lookupCtrl.dispFieldAlias : this.pageObj.lookupCtrl.dispField] = newData.displayValue;
		}
		
		// change row to simple grid row with no editBoxes
		this.setValuesIntoSpans(row);
		if (newData.noKeys !== true){
			this.showRowButtons(row);
		}
		
		// set submitted attr
		row.submitted = true;
		row.isAdd = false;
		this.fireEvent('afterSubmit', newData.vals, newData.fields, newData.keys, row.id, newData);
		if (row.basicForm){
			setTimeout(function() {
			row.basicForm.destructor();
			row.basicForm = null;
			},0);
		}		
		if (this.rows.length == 1){
			this.pageObj.hideBrick("message");
		}
	},
	
	fireUserEventAfterInline: function(row){
		var fieldsData = [];
		//make fileds data for user event
		for(var i=0; i<this.fNames.length; i++){
			fieldsData[i] = {
				name: this.fNames[i],
				value: row.rowVals[this.fNames[i]],
				text: row.data[this.fNames[i]],
				container: Runner.getFieldSpan(this.fNames[i], row.id)
			};
		}
		//fire after save
		this.fireEvent("afterSave", fieldsData);
		//set user data to row
		for(var i=0;i<this.fNames.length; i++){
			row.rowVals[this.fNames[i]] = fieldsData[i].value;
			row.data[this.fNames[i]] = fieldsData[i].text;
		}
	},
	
	getFieldSpan: function(fName, rowId){
		return $('#edit'+rowId+'_'+Runner.goodFieldName(fName));
	},
	
	setValuesIntoSpans: function(row){
		this.fireEvent("beforeSetVals", row, this.fNames);
		
		var inlineObj = this;
		
		if(!row.revertted){
			this.fireUserEventAfterInline(row);
		}
		
		for(var i=0; i<this.fNames.length; i++){
			if (typeof row.data[this.fNames[i]] == 'undefined'){
				if(row.keyFields.isInArray(this.fNames[i])){
					row.data[this.fNames[i]] = row.keys[row.keyFields.getIndexOfElem(this.fNames[i])].toString();
				}else{
					row.data[this.fNames[i]] = "";
				}
			}
			
			var span = Runner.getFieldSpan(this.fNames[i], row.id); 
			$(span).html(row.data[this.fNames[i]]);
			for(var j=0; j<this.totalFields.length; j++){
				if(this.totalFields[j].fName == this.fNames[i]){
					if(row.rowVals && row.rowVals[this.fNames[i]]){	
						$(span).attr('val',row.rowVals[this.fNames[i]]);
					}else{
						$(span).attr('val',"");
					}
					break;
				}
			}
			
			if (Runner.pages.PageSettings.getFieldData(this.tName, this.fNames[i], 'viewFormat', this.pageType) != Runner.controls.constants.FORMAT_MAP){
				var images = $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i])).find('img'),
					imagesHref = $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i])).find('a'),
					href,src;
				for(var j=0; j<images.length; j++){
					src = $(images[j]).attr('src');
					href = $(imagesHref[j]).attr('href');
					$(images[j]).attr('src', this.replaceRndVal(src));
					$(imagesHref[j]).attr('href', this.replaceRndVal(href));
				}
			}
		}
		
		if(typeof this.pageObj.viewControlsMap != "undefined" && typeof this.pageObj.viewControlsMap.controls != "undefined"){
			var rowContext = $('#' + this.rowPref + row.id);
			for(var i = 0; i < this.pageObj.viewControlsMap.controls.length; i++){
				this.pageObj.viewControlsMap.controls[i].table = this.pageObj.tName;
				var ctrl = Runner.viewControls.ViewControlFabric(this.pageObj.viewControlsMap.controls[i], 
						this.pageObj.pageType, rowContext, this.pageObj);
				if(typeof ctrl.initInline != "undefined")
					ctrl.initInline(row);
				else
					ctrl.init();
			}
		}
		
		return row.data;
	},
	
	replaceRndVal: function(src){
		if(src){
			if (src.indexOf('rndVal=') == -1){
				return src + (src.indexOf('?') != -1 ? "&" : "?") + "rndVal=" + Math.random();
			}else{
				var startPos = src.indexOf('rndVal=') + 7, endPos = src.indexOf('&', startPos);
				return src.substring(0, startPos) + Math.random() + (endPos != -1 ? src.substring(endPos) : '');
			}
		}
		return  "";
	},
	
	getValuesFromSpan: function(row){
		row.data = {};
		for(var i=0; i<this.fNames.length; i++){
			if($('.sudoslider', $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i]))).length)
			{
				var sliderPanels = $('li', '#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i]))
				var imagesStr = "";
				for(var j = 0; j < sliderPanels.length; j++)
					if(!$(sliderPanels[j]).hasClass("cloned"))
						imagesStr += '<li>' + $(sliderPanels[j]).html() + '</li>';
				if(imagesStr != "")
					imagesStr = "<div style=\"position:relative;\"><div class=\"presudoslider\"><ul>" + imagesStr + "</ul></div></div>";					
				row.data[this.fNames[i]] = imagesStr;
			}
			else{
				var videoElement = $('.projekktor', $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i])));
				if(videoElement.length)
				{
					var fieldSpan = $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i]))
					for(var j = 0; j < videoElement.length; j++){
						var vElementId = $(videoElement[j]).attr("id"), playList = projekktor(vElementId).getPlaylist();
						projekktor(vElementId).setStop().selfDestruct();
						if(!Runner.IsIE && playList.length && playList[0].file.length){
							$(fieldSpan.find('video').get(j)).attr("src", playList[0].file[0].src).attr("type", playList[0].file[0].type);
						}
					}
				}
				row.data[this.fNames[i]] = $('#edit'+row.id+'_'+Runner.goodFieldName(this.fNames[i])).html();
			}
		}
		return row.data;
	},
	
	getValueFromSpan: function(row, fName){
		if(row.rowVals && row.rowVals[fName]){
			var val = row.rowVals[fName];
		}else{
			var val = $('#edit'+row.id+'_'+Runner.goodFieldName(fName)).attr('val');
			if(!val){
				val = row.data[fName];
			}
		}
		return val;
	},
	
	initCopyLink: function(link, row){
		if (Runner.pages.PageSettings.getTableData(this.tName, "showAddInPopup")){
			
			var editObj = this;
			$(link).bind("click", function(e){
				var eventParams = {
					tName: editObj.tName, 
					pageType: Runner.pages.constants.PAGE_ADD, 
					pageId: -1,
					destroyOnClose: true,
					parentPage: editObj,
					modal: true, 
					keys: row.keys,
					keyFields: row.keyFields,
					keyPref: "copyid",
					baseParams: {
						parId: editObj.id,
						table: editObj.tName,
						editType: Runner.pages.constants.ADD_POPUP
					},
					afterSave: {
						fn: function(respObj, formObj, fieldControls, page){
							if (respObj.success){
								this.addRowToGrid(respObj);	
							}else{
								page.displayHalfPreparedMessage(respObj.message);
								page.showBrick('message');
								return false;
							}
						},
						scope: editObj
					}
				};
				Runner.Event.prototype.stopEvent(e);
				Runner.pages.PageManager.openPage(eventParams);
			});
		}
		
		return link;
	},
	
	changeLinksKeys: function(row){
		var newUrl = Runner.pages.getUrl(this.tName, Runner.pages.constants.PAGE_VIEW, row.keys, 'editid')
		$(row.viewLink).attr('href', newUrl);
		
		var newUrl = Runner.pages.getUrl(this.tName, Runner.pages.constants.PAGE_EDIT, row.keys, 'editid')
		$(row.editLink).attr('href', newUrl);
		
		var newUrl = Runner.pages.getUrl(this.tName, Runner.pages.constants.PAGE_ADD, row.keys, 'copyid')
		$(row.copyLink).attr('href', newUrl);
	},
	
	initViewLink: function(link, row){
		if (Runner.pages.PageSettings.getTableData(this.tName, "showViewInPopup") && !Runner.isMobile){
			var inlineObj = this;
			$(link).bind("click", function(e){
				Runner.Event.prototype.stopEvent(e);
				inlineObj.pageObj.hideBrick('message');
				var eventParams = {
					tName: inlineObj.tName, 
					pageType: Runner.pages.constants.PAGE_VIEW, 
					pageId: -1,
					destroyOnClose: true,
					keys: row.keys,
					keyFields: row.keyFields,
					modal: true,
					baseParams: {
						parId: inlineObj.id,
						table: escape(inlineObj.tName)
					}
				};
				Runner.pages.PageManager.openPage(eventParams);
			});
		}
		return link;
	},
	
	initEditLink: function(link, row){
		if(Runner.pages.PageSettings.getTableData(this.tName, "showEditInPopup") && !Runner.isMobile){
			var inlineObj = this;
			$(link).bind("click", function(e){
				Runner.Event.prototype.stopEvent(e);
				inlineObj.pageObj.hideBrick('message');
				var eventParams = {
					tName: inlineObj.tName,  
					pageType: Runner.pages.constants.PAGE_EDIT, 
					pageId: -1,
					destroyOnClose: true,
					keys: row.keys,
					keyFields: row.keyFields,
					modal: true,
					baseParams: {
						parId: inlineObj.id,
						rowId: row.id,
						table: escape(inlineObj.tName),
						editType: Runner.pages.constants.EDIT_POPUP
					},
					afterSave: {
						fn: function(respObj, formObj, fieldControls, editPageObj){
							if (respObj.success){
								this.afterSubmit(row, respObj);
							}else if(respObj.lockMessage){
								$('.runner-locking').html(respObj.lockMessage).css('display', 'block');
								return false;
							}else{
								if(respObj.hideCaptha){
									$('.captcha_block').remove();
								}
								//show invslid captcha message
								editPageObj.showCaptchaErrMessage(respObj.captcha);
								if(respObj.message){
									editPageObj.displayHalfPreparedMessage(respObj.message);
									editPageObj.showBrick('message');
								}
								$('div.bd').animate({scrollTop:0});
								return false;
							}
						},
						scope: inlineObj
					}
				};
				Runner.pages.PageManager.openPage(eventParams);
			});
		}
		return link;
	},
	
	initInlineEditLink: function(link, row){
		var newUrl = Runner.pages.getUrl(this.tName, Runner.pages.constants.PAGE_EDIT, row.keys, 'editid')
		$(link).attr('href', newUrl);
		link.bind("click", {inlineObj: this, row: row}, function(e){
			Runner.Event.prototype.stopEvent(e);
			var row = e.data.row, inlineObj = e.data.inlineObj;
			if (inlineObj.inlineEditObj){
				inlineObj.inlineEditObj.inlineEdit(row);
			}else{
				inlineObj.inlineEdit(row);
			}
		});
		return link;
	},
	
	toggleMassRecButt: function(){
		if (!this.isRowsEditing()){
			this.saveAllButt.hide().parent().hide();
			this.cancelAllButt.hide().parent().hide();
			this.massRecButtEditMode = false;
		}else{
			this.saveAllButt.show().parent().show();
			this.cancelAllButt.show().parent().show();
			this.massRecButtEditMode = true;
		}
	},
	
	isRowsEditing: function(){
		for(var i=0; i<this.rows.length; i++){
			if (this.rows[i].submitted!=undefined && !this.rows[i].submitted){
				return true;
			}
		}
		return false;
	},
	
	validate: function(){
		var ctrls, 
			vRes = true;
		for(var i=0; i<this.rows.length; i++){
			ctrls = Runner.controls.ControlManager.getAt(this.tName, this.rows[i].id);
			for(var j=0; j<ctrls.length; j++){
				if (!ctrls[j].validate().result){
					vRes = false;
				}
			}
		}
		return vRes;
	},
	
	addRowToGrid: function(data){
		var newAddRow = this.prepareRow(data.vals, true);
		this.getEditBlock(newAddRow);
		this.afterSubmit(newAddRow, data);
	},
	
	initRow: function(row){
		row.submitted = true;
		row.revertted = false;
		row.data = {};
		row.saveLink = false;
		row.cancelLink = false;
		row.checkBox = $('#check'+this.id+'_'+row.id);
		row.copyLink = this.initCopyLink($('#copyLink'+row.id), row);
		row.iEditLink = this.initInlineEditLink($('#iEditLink'+row.id), row);
		row.viewLink = this.initViewLink($('#viewLink'+row.id), row);
	},
	
	hideRowButtons: function(row){
		row.viewLink.hide();
		row.copyLink.hide();
		if (row.editLink)
			row.editLink.hide();
		row.iEditLink.hide();
		row.checkBox.hide();
	},
	
	showRowButtons: function(row){
		row.viewLink.show();
		row.copyLink.show();
		if(row.isEditable){
			if (row.editLink)
				row.editLink.show();
			row.iEditLink.show();
		}
		row.checkBox.show();
		if (row.saveLink){
			row.saveLink.hide();
		}
		if(row.cancelLink){
			row.cancelLink.hide();
		}
	},
	
	prepareRow: function(vals, submitted){
		var grid = this.pageObj.gridElem,
			addRow = $(".gridRowAdd", grid)[0],
			sepAddRow = $(".gridRowSepAdd", grid);
		
		// make sure that table is shown
		if (this.rows.length === 0){
			grid.show();
			this.pageObj.getBrickObjs("grid")[0].show();
			$("thead tr", grid).removeClass('runner-hiddenelem');
			$('tr.runner-bottomrow',$(grid).children("tbody")).removeClass('runner-hiddenelem');
			$('tr.footer',$(grid).children("tbody")).removeClass('runner-hiddenelem');
			this.editAllButt.parent().show();
			this.saveAllButt.parent().show();
			this.cancelAllButt.parent().show();
			$("a[id=print_selected"+this.id+"]").parent().show();
			$("a[id=export_selected"+this.id+"]").parent().show();
			$("a[id=delete_selected"+this.id+"]").parent().show();
		}
		
		var newAddRow = {
			row: $(addRow).clone(true),
			srow: false,
			id: Runner.genId(),
			keys: [],
			keyFields: [],
			data: vals,
			isAdd: true,
			isEditable: true
		};
		if(sepAddRow.length){
			newAddRow.srow = sepAddRow.clone();
		}
		var pageId = this.id;
		
		$("*",newAddRow.row).each(function(j) {
			if(this.id == "editLink_add"+pageId){
				this.id = "editLink" + newAddRow.id;
				$(this).hide();
			}else if(this.id == "copyLink_add" + pageId){
				this.id = "copyLink" + newAddRow.id;
				$(this).hide();
			}else if(this.id == "check_add" + pageId){
				this.id = "check"+pageId+"_" + newAddRow.id;
				$(this).hide();
			}else if(this.id == "viewLink_add" + pageId){
				this.id = "viewLink" + newAddRow.id;
				$(this).hide();
			}else if(this.id == "inlineEdit_add" + pageId){
				this.id = "iEditLink" + newAddRow.id;
				$(this).hide();
			}else if(this.id.substr(0,7)=="master_" && this.id.substr(this.id.length-4-pageId.toString().length)=="_add"+pageId){
				this.id = this.id.substr(0,this.id.length-4-pageId.toString().length) + "_" + newAddRow.id;
				$(this).hide();
			}else if(this.id.substr(this.id.length-8-pageId.toString().length)=="_preview"+pageId){
				this.id = this.id.substr(0,this.id.length-pageId.toString().length)+newAddRow.id;
				var cntDet = $('span[id^=cntDet]', this);
				if($(cntDet).length){
					var cntDetId = $(cntDet).attr('id');
					cntDetId+= newAddRow.id;
					$(cntDet).attr('id',cntDetId);
				}
				$(this).hide();
			}else if(this.id.substr(0,4+pageId.toString().length)=="add"+pageId+"_"){
				this.id = "edit"+newAddRow.id+'_'+this.id.substr(4+pageId.toString().length);
			}
		});
		
		this.rows.push(newAddRow);
		newAddRow.row.removeClass('gridRowAdd runner-hiddenelem');
		newAddRow.row.attr("id", this.rowPref+newAddRow.id);
		if(newAddRow.srow){
			newAddRow.srow.removeClass('gridRowSepAdd runner-hiddenelem');
			newAddRow.srow.insertAfter(sepAddRow);
			newAddRow.row.insertAfter(sepAddRow);
		}else{	
			if(this.pageObj.addNewRecordsToBottom)
				$(addRow).parent().append(newAddRow.row);
			else
				newAddRow.row.insertAfter(addRow);
			if (!newAddRow.row.next().hasClass("interlaced")){
				newAddRow.row.addClass("interlaced");
			}
		}
	
		if(this.inlineEditObj){
			this.inlineEditObj.initRow(newAddRow);
		}	
		else {
			this.initRow(newAddRow);
		}
		newAddRow.submitted = false || submitted;
		
		return newAddRow;
	},
	
	/**
	 * checkRowDetailKeys
	 * Check new and existent row masterKeys and update details count and popup links
	 * @param {object} changed row
	 * @param {object} new master keys
	 */
	checkRowMasterKeys: function(row, newMasterKeys){
		if(typeof this.pageObj.dpObjs != 'undefined')
			$.each(this.pageObj.dpObjs, function(ind, obj){
				var isKeysChanged = false;
				if(row.masterKeys == undefined){
					row.masterKeys = newMasterKeys;
					isKeysChanged = true;
				}else
					$.each(newMasterKeys[obj.tName], function(kInd, kObj){
						if(newMasterKeys[obj.tName][kInd] != row.masterKeys[obj.tName][kInd]){
							isKeysChanged = true;
							return false;
						}
					});	
				if(isKeysChanged){
					obj.getChildRecNum(newMasterKeys[obj.tName], row.id);
					row.masterKeys[obj.tName] = newMasterKeys[obj.tName];
					obj.closeDetailsById(row.id);
				}
				else
					obj.getChildRecNum(row.masterKeys[obj.tName]);
			});
	}
});

/**
  * @class Runner.util.inlineEditing.InlineAdd
  */
Runner.util.inlineEditing.InlineAdd = Runner.extend(Runner.util.inlineEditing.InlineEditor, {	
	
	constructor: function(cfg){
		this.pageType = 'add';
		Runner.util.inlineEditing.InlineAdd.superclass.constructor.call(this, cfg);		
		this.pageType = Runner.pages.constants.PAGE_ADD;
		this.ajaxRequestUrl = this.shortTName + "_" + Runner.pages.constants.PAGE_ADD + ".php";	
		
		this.submitUrl = this.shortTName + '_' + Runner.pages.constants.PAGE_ADD + ".php";
		this.submitUrl += "?ferror=1&inline=1&";
		
		this.addEvents("beforeSetVals", "beforeInlineAdd");
	},
	
	init: function(){
		Runner.util.inlineEditing.InlineAdd.superclass.init.call(this);
		this.on({'beforeInlineAdd': function(){
			if((typeof this.pageObj.pageMode == "undefined" || this.pageObj.pageMode != "listdetails") && this.pageObj.isScrollGridBody){
				$(this.pageObj.gridElem.closest(".runner-scrollgrid-inner")).css('overflow-y','hidden');
			}
		}});
	},
	
	initAddButton: function(){
		$("a[id=inlineAdd"+this.id+"]").bind("click", {inlineAddObj: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			e.data.inlineAddObj.inlineAdd();
		});
	},	
	
	initButtons: function(){
		Runner.util.inlineEditing.InlineAdd.superclass.initButtons.call(this);	
		this.initAddButton();
	},
	
	cancelButtonHn: function(row, isCancelAll){
		row.revokeCancel = false;
		if(typeof row.onBeforeCancel != "undefined")
			row.onBeforeCancel();
		if(row.revokeCancel)
			return false;
		this.removeRowData(row);
		if (!isCancelAll) {
			this.fireEvent('recalcGridSize');
		}
		Runner.util.inlineEditing.InlineAdd.superclass.cancelButtonHn.call(this);
		if(typeof row.onCancel != "undefined")
			row.onCancel();
		Runner.controls.ControlManager.unregister(this.tName, row.id);
		return true;
	},
	
	revertRow: function(row){
		Runner.util.inlineEditing.InlineAdd.superclass.revertRow.call(this, row);
		// clear row data from memory
		this.removeRowData(row);
	},
	
	saveAll: function(){
		if(Runner.util.inlineEditing.InlineAdd.superclass.saveAll.call(this)){
			return true;
		}
		for(var i=0; i<this.rows.length; i++){
			if (!this.rows[i].submitted && this.rows[i].isAdd){
				this.rows[i].fileFieldsCount = 0;
				this.rows[i].upploadErrorHappened = 0;
				this.waitForFilesUpload(this.rows[i]);
			}
		}
	},
	
	fireUserEventAfterInline: function(row){
		if(this.pageObj.isEventExist('afterInlineAdd')){
			Runner.util.inlineEditing.InlineEdit.superclass.fireUserEventAfterInline.call(this, row);
		}
	},
	
	afterSubmit: function(row, newData){
		Runner.util.inlineEditing.InlineAdd.superclass.afterSubmit.call(this, row, newData);
		
		if (row.cancelLink){
			row.cancelLink.remove();
			row.cancelLink = null;
		}
		if (row.saveLink){
			row.saveLink.remove();
			row.saveLink = null;
		}
		if(this.isEditOwn){
			row.isAddOwnRow = true;
		}
		
		if(this.pageObj.parId){
			Runner.pages.PageManager.getById(this.pageObj.parId).setRecountFlagForPopup();
		}
		if(newData.detKeys != undefined){
			this.checkRowMasterKeys(row, newData.detKeys);
		}
		if(newData.hrefs){
			for(var i = 0; i < newData.hrefs.length; i++){
				$("#" + newData.hrefs[i].id + row.id).attr("href", newData.hrefs[i]["href"]);
			}
		}
		
		// fire rowsEdited event if all rows submited
		var allVals = [],
			allKeys = [],
			allRowIds = [];
		if(typeof row.fromSaveBtn == "undefined")
			for(var i=0; i<this.rows.length; i++){
				allVals.push(this.rows[i].data);
				allKeys.push(this.rows[i].keys);
				allRowIds.push(this.rows[i].id);
				if (this.rows[i].submitted === false){
					this.pageObj.isDetailsRecountNeeded = true;
					return;
				}
			}
		this.fireEvent('rowsEdited', allVals, newData.fields, allKeys, allRowIds, false, row.fromSaveBtn);
		row.fromSaveBtn = undefined;
	},
	
	toggleMassRecButt: function(){
		Runner.util.inlineEditing.InlineAdd.superclass.toggleMassRecButt.call(this);
		if(!this.isRowsEditing()){
			if(this.massRecButtEditMode){
				this.editAllButt.parent().hide();
			}else{
				this.editAllButt.parent().show();
			}
		}
	},
		
	inlineAdd: function(hideRevertButt, hideSaveButt){
		this.fireEvent("beforeInlineAdd");
		if (typeof hideRevertButt == "undefined"){
			hideRevertButt = this.hideRevertButt;
		}
		if (typeof hideSaveButt == "undefined"){
			hideSaveButt = this.hideSaveButt;
		}
		this.pageObj.hideBrick('message');
		var newAddRow = this.prepareRow({}, false);
		this.toggleMassRecButt();
		this.hideRowButtons(newAddRow);
		this.getControls(newAddRow, hideRevertButt, hideSaveButt);
	
	}
});

/**
  * @class Runner.util.inlineEditing.InlineEdit
  */
Runner.util.inlineEditing.InlineEdit = Runner.extend(Runner.util.inlineEditing.InlineEditor, {	
	
	constructor: function(cfg){
		Runner.util.inlineEditing.InlineEdit.superclass.constructor.call(this, cfg);	
		this.ajaxRequestUrl = this.shortTName + "_" + Runner.pages.constants.PAGE_EDIT + ".php";
		this.pageType = Runner.pages.constants.PAGE_EDIT;
		this.submitUrl = this.shortTName + '_' + Runner.pages.constants.PAGE_EDIT + ".php"; 		
		this.addEvents("beforeEditRow");
	},
	
	init: function(){
		Runner.util.inlineEditing.InlineEdit.superclass.init.call(this);
		this.initRows();
		this.on({'beforeEditRow': function(){  
			if((typeof this.pageObj.pageMode == "undefined" || this.pageObj.pageMode != "listdetails") && this.pageObj.isScrollGridBody){
				$(this.pageObj.gridElem.closest(".runner-scrollgrid-inner")).css('overflow-y','hidden');
			}
		}});
		var pageObj = this;
	},
	
	initRow: function(row){
		Runner.util.inlineEditing.InlineEdit.superclass.initRow.call(this, row);
		row.editLink = this.initEditLink($('#editLink'+row.id), row);
		row.isEditable = true;
	},
	
	initRows: function(){
		for(var i=0; i<this.rows.length; i++){
			this.initRow(this.rows[i]);
		}
		if(this.isUseLocking){
			this.showErrorForLockingRecords();
		}
	},
	
	initInlineRowEditors: function(){
		for(var i=0; i<this.rows.length; i++){
			this.getInlineButtBlock(this.rows[i]);
		}
	},
	
	initButtons: function(){
		Runner.util.inlineEditing.InlineEdit.superclass.initButtons.call(this);
		this.initEditAll();
	},
	
	initEditAll: function(){
		var inlineObj = this;
		this.editAllButt.unbind("click").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			var selBoxesArr = new Array();
			$('input[type=checkbox][id^=check'+inlineObj.id+'_]').each(function (){
				if ($(this).prop("checked")){
					if(inlineObj.isEditOwn && !$('#iEditLink' + $(this).attr('id').substr($(this).attr('id').lastIndexOf('_') + 1)).length){
						$(this).prop("checked", false);
						return true;
					}
					selBoxesArr.push($(this));
				}
			});
			var row,
				isEdit = false,
				checkBox,
				selBoxes = selBoxesArr;
			for(var i=0; i<selBoxes.length; i++){
				for(var j=0; j<inlineObj.rows.length; j++){
					checkBox = inlineObj.rows[j].checkBox;
					if ($(checkBox[0]).attr('id') == $(selBoxes[i]).attr('id')){
						row = inlineObj.rows[j];
						if(typeof row.keys != "undefined" && row.keys.length > 0){
							inlineObj.inlineEdit(row);
							if(!inlineObj.rows[i].submitted && !inlineObj.rows[i].isAdd){
								isEdit = true;
							}
						}
					}
				}
			}
			if(isEdit){
				inlineObj.toggleMassRecButt();
			}	
		});
	},
	
	reInit: function(gridRows){
		Runner.util.inlineEditing.InlineEdit.superclass.reInit.call(this, gridRows);
		this.initRows();
	},
	
	inlineEdit: function(row, hideRevertButt, hideSaveButt){
		if (typeof hideRevertButt == "undefined"){
			hideRevertButt = this.hideRevertButt;
		}
		if (typeof hideSaveButt == "undefined"){
			hideSaveButt = this.hideSaveButt;
		}
		this.pageObj.hideBrick('message');
		this.fireEvent("beforeEditRow", row);
		row.submitted = false;
		this.clearError(row);
		this.toggleMassRecButt();
		this.getValuesFromSpan(row);
		this.hideRowButtons(row);	
		this.getControls(row, hideRevertButt, hideSaveButt);
		var inlineObj = this;
		setTimeout(function(){
			$("#" + inlineObj.rowPref + row.id).removeClass('hovered');
		});
	},
	
	editRecById: function(rowId){
		var row = this.getRowById(rowId);
		if(row){
			this.inlineEdit(row);
			return true;
		}
		return false;
	},
	
	editAllRecs: function(){
		for(var i=0; i<this.rows.length;i++){
			this.inlineEdit(this.rows[i]);
		}
	},
	
	getRecsId: function(){
		var recsId = {};
		for(var i=0; i<this.rows.length;i++){
			recsId[i+1] = this.rows[i].id;
		}
		return recsId;
	},
	
	revertRow: function(row){
		row.submitted = true;
		row.revertted = true;
		row.errorDiv = false;
		if (row.checkBox.length){
			row.checkBox[0].checked = false;
		}
		// clear controls
		Runner.util.inlineEditing.InlineEdit.superclass.revertRow.call(this, row);
		// change row buttons
		this.showRowButtons(row);
		// set row data into spans
		this.setValuesIntoSpans(row);
		if(this.isUseLocking)
			this.locking.UnlockRecordInline(this.getKeysForLocking(row));
		row.checkBox.show();
	},	
	
	initForm: function(row){
		Runner.util.inlineEditing.InlineEdit.superclass.initForm.call(this, row);
		// change base params
		row.basicForm.baseParams = {a: 'edited', editType: 'inline', id: row.id};
		row.basicForm.submitUrl += "?ferror=1";
		// add keys
		for(var i=0; i<row.keys.length; i++){
			row.basicForm.baseParams["editid"+(i+1)] = row.keys[i];
		}
	},
	
	cancelButtonHn: function(row, isCancelAll){
		row.revokeCancel = false;
		if(typeof row.onBeforeCancel != "undefined")
			row.onBeforeCancel();
		if(row.revokeCancel)
			return false;
		this.revertRow(row);
		if (!isCancelAll) {
			this.fireEvent('recalcGridSize');
		}
		if(typeof row.onCancel != "undefined")
			row.onCancel();
		Runner.util.inlineEditing.InlineEdit.superclass.cancelButtonHn.call(this);
		return true;
	},
	
	toggleMassRecButt: function(){
		Runner.util.inlineEditing.InlineEdit.superclass.toggleMassRecButt.call(this);
		if (this.massRecButtEditMode){
			this.editAllButt.parent().hide();
		}else{
			this.editAllButt.parent().show();
		}
	},
	
	fireUserEventAfterInline: function(row){
		if(this.pageObj.isEventExist('afterInlineEdit')){
			Runner.util.inlineEditing.InlineEdit.superclass.fireUserEventAfterInline.call(this, row);
		}	
	},
	
	afterSubmit: function(row, newData){
		var oldKeysForLocking = this.getKeysForLocking(row);
		Runner.util.inlineEditing.InlineEdit.superclass.afterSubmit.call(this, row, newData);
		var hasDetailTables = false, detailTables = Runner.pages.PageSettings.getTableData(this.tName, "detailTables");
		if(typeof detailTables != "undefined")
			$.each(detailTables, function(index, table){ 
				hasDetailTables = true;
				return false;
			});
		if(newData.hrefs)
			for(var i = 0; i < newData.hrefs.length; i++) 
				$("#" + newData.hrefs[i].id + row.id).attr("href", newData.hrefs[i]["href"]);
		if (hasDetailTables){
			this.checkRowMasterKeys(row, newData.detKeys);
		}
		// fire rowsEdited event if all rows submited
		var allVals = [],
			allKeys = [],
			allRowIds = [];
		for(var i=0; i<this.rows.length; i++){
			allVals.push(this.rows[i].data);
			allKeys.push(this.rows[i].keys);
			allRowIds.push(this.rows[i].id);
			if (this.rows[i].submitted === false){
				return;
			}
		}
		var isEdit = typeof this.pageObj.isDetailsRecountNeeded != "undefined" ? false : true;
		this.pageObj.isDetailsRecountNeeded = undefined;
		if(this.isUseLocking){
			this.locking.ResetSetInterval(oldKeysForLocking);
		}
		this.fireEvent('rowsEdited', allVals, newData.fields, allKeys, allRowIds, isEdit);
	},
	
	saveAll: function(){
		if (Runner.util.inlineEditing.InlineEdit.superclass.saveAll.call(this)){
			return true;
		}
		for(var i=0; i<this.rows.length; i++){
			if (!this.rows[i].submitted && !this.rows[i].isAdd){
				this.rows[i].fileFieldsCount = 0;
				this.waitForFilesUpload(this.rows[i]);
			}
		}
	},
	
	/**
	 * Show error massage for locked deleted records
	 */
	showErrorForLockingRecords: function(){
		var lockingRecords = Runner.pages.PageSettings.getTableData(this.tName, 'lockRecIds');
		if(!lockingRecords.length){
			return;
		}
		for(var i=0,l=lockingRecords.length;i<l;i++){
			this.makeError("Record can't be delete. It's editing by another user.", this.getRowById(lockingRecords[i]));
			$('input[id=check'+this.id+'_'+lockingRecords[i]+']', this.pageObj.gridElem).prop('checked', true);
		}
	}
});


Runner.namespace('Runner.pages');

Runner.pages.constants = {
	PAGE_LIST: "list",
	PAGE_ADD: "add",
	PAGE_INLINE_ADD: "inline_add",
	PAGE_EDIT: "edit",
	PAGE_INLINE_EDIT: "inline_edit",
	PAGE_VIEW: "view",
	
	PAGE_SEARCH: "search",
	PAGE_REPORT: "report",
	PAGE_CHART: "chart",
	PAGE_PRINT: "print",
	PAGE_EXPORT: "export",
	PAGE_IMPORT: "import",
	PAGE_ADMIN_MEMBERS: "admin_members",
	PAGE_ADMIN_RIGHTS: "admin_rights",
	PAGE_MASTER_INFO_LIST: "masterlist",
	PAGE_MASTER_INFO_PRINT: "masterprint",
	
	PAGE_REGISTER: "register",
	PAGE_MENU: "menu",
	PAGE_REMIND: "remind",
	PAGE_CHANGEPASS: "changepwd",
	PAGE_LOGIN: "login",
	
	LIST_SIMPLE: 0,
	LIST_LOOKUP: 1,
	LIST_DETAILS: 3,
	LIST_AJAX: 4,
	RIGHTS_PAGE:  5,
	MEMBERS_PAGE:  6,
	
	ADD_SIMPLE: 0,
	ADD_INLINE: 1,
	ADD_ONTHEFLY: 2,
	ADD_MASTER: 3,
	ADD_POPUP: 4,
	
	EDIT_SIMPLE: 0,
	EDIT_INLINE: 1,
	EDIT_ONTHEFLY: 2,
	EDIT_POPUP: 3,
	
	MODE_AJAX: "ajax",
	MODE_SIMPLE: "",
	MODE_LOOKUP: "lookup",
	MODE_LIST_DETAILS: "listdetails",
	
	DP_POPUP: 0,
	DP_INLINE: 1,
	DP_NONE: 2,
	
	SEARCH_OPTIONS: {
		"Contains": "contains",
		"Equals": "equals",
		"Starts with": "startswith",
		"More than": "morethan",
		"Less than": "lessthan",
		"Between": "between",
		"Empty": "empty", 
		"NOT Contains": "notcontain", 
		"NOT Equals": "notequal", 
		"NOT Starts with": "notstartwith",
		"NOT More than": "notmorethan",
		"NOT Less than": "notlessthan", 
		"NOT Between": "notbetween", 
		"NOT Empty": "notempty"
	},
	
	MINUS_GIF: "images/minus.gif",
	PLUS_GIF: "images/plus.gif",
	CLOSE_RED_GIF: "images/search/closeRed.gif",
	OK_GIF: "images/ok.gif",
	CANCEL_GIF: "images/cancel.gif",
	HIDE_OPT_GIF: "images/search/hideOptions.gif",
	SHOW_OPT_GIF: "images/search/showOptions.gif"
};

// Insert new settings - only in alphabetical order 

/**
 * Runner.pages.Defaults
 * Class wich contains default settings (global, tables, fileds, validation)
 */
Runner.pages.Defaults = function(){
	this.globalSettings = {
		debugMode: false,
		isMobile: false,
		s508: false
	};
	this.tableSettings = {
		ajaxSuggest: true,
		confirmTime: 250,
		copy: false,
		defaultMembership: [],
		defaultRights: [],
		detailTables: {},
		dpParams: [],
		enableCtrls: true,
		events: {},
		firstTime: 0,
		fieldSettings: {},
		hasEvents: false,
		isEditOwn: false,
		isInlineAdd: false,
		isInlineEdit: false,
		isMobileIOS: false,
		isShowDetails: false,
		isUseAudio: false,
		isUseButtons: false,
		isUseCK: false,
		isUseDP: false,
		isUsedSearchFor: false,
		isUseHighlite: false,
		isUsePopUp: false,
		isUseResize: false,
		isUseToolTips: false,
		isUseVideo: false,
		isVertLayout: false,
		keys: {},
		listFields: [],
		listIcons: false,
		locking: false,
		lockRecIds: [],
		mainMPageType: "",
		masterPageType: "",
		masterTable: "",
		maxPages: 1,
		nextKeys: {},
		noScroll: false,
		pageCSS: "",
		pageLayout: "",
		pageMode: 0,
		pageNumber: 0,
		pageSkinStyle: "",
		passFieldName: 'password',
		permissions: {},
		prevKeys: {},
		proxy: {},
		recsPerRowList: 1,
		regmsg_emailError: "",
		regmsg_passwordError: "",
		regmsg_userError: "",
		rightsGroups: [],
		rightsTables: [],
		shortTNames: [],
		showAddInPopup: false,
		showEditInPopup: false,
		showRows: false,
		showViewInPopup: false,
		sKeys: "",
		strCaption: "",
		strKey: [],
		totalFields: [],
		usersList: [],
		view: false
	};
	this.fieldSettings = {
		acceptFileTypes: new RegExp(".+$", "i"),
		autoCompleteFieldsAdd: [],
		autoCompleteFieldsEdit: [],
		autoUpload: false,
		categoryField: false,
		compatibilityMode: false,
		dateEditType: Runner.controls.constants.EDIT_DATE_SIMPLE,
		depLookups: [],
		dispField: "",
		editFormat: Runner.controls.constants.EDIT_FORMAT_NONE,
		freeInput: false,
		initialYear: 100,
		isDisabled: false,
		isHidden: false,
		isUseTimeStamp: false,
		lastYear: 10,
		lcType: Runner.controls.constants.LCT_DROPDOWN,
		linkField: "",
		lookupTable: "",
		mask: "",
		maxFileSize: undefined,
		maxNumberOfFiles: undefined,
		maxTotalFileSize: undefined,
		nHeight: 200,
		nWidth: 100,
		RTEType: "",
		selectSize: 1,
		showTime: false,
		strName: "",
		timePick: {},
		validation: null,
		viewFormat: Runner.controls.constants.FORMAT_NONE
	};
	
	var self = this, SOURCE_GLOBAL = 'g', SOURCE_TABLE = 't', SOURCE_FIELD = 'f'
		, getSettings = function(source, settingName){
			var sourceName = source == SOURCE_GLOBAL ? 'globalSettings' 
					: source == SOURCE_TABLE ? 'tableSettings' : 'fieldSettings';
			if(self[sourceName][settingName] != undefined)
				return self[sourceName][settingName];
			else
				return null;
		};
		
	this.getGlobalSettings = function(settingName){
		return getSettings(SOURCE_GLOBAL, settingName);
	};
	
	this.getTableSettings = function(settingName){
		return getSettings(SOURCE_TABLE, settingName);
	};
	
	this.getFieldSettings = function(settingName){
		return getSettings(SOURCE_FIELD, settingName);
	};
	
	this.getValidationSettings = function(){
		return { 
			regExp: null, 
			validationArr: []	
		};
	};
};

Runner.pages.Defaults = new Runner.pages.Defaults();
/** 
 * Global control manager. Alows to add, delete and manage controls
 * Collection of controls for the specific table.
 * Should not be created directly, only one instance per page. 
 * Use its instance to get access to any control
 * @singleton
 */
Runner.pages.PageManager = function(){
	/**
	 * Table managers collection
	 * @type {object} private
	 */
	var tables = {}, beforeUnloadPool = [];	
	
	if (window.onunload){
		beforeUnloadPool.push(window.onBeforeUnload, window, []);
	}
	window.onunload = function(){
		window.Runner.pages.PageManager.callUnload();
	}
	
	return {
		/**
		 * Control to register
		 * @param {#link} control
		 */
		register: function(pageController){
			// return false if not control
			if (!pageController){
				return false;
			}
			// get table name
			var pageTable = pageController.tName;		
			// if table not exists, create new one
			if (!tables[pageTable]){
				tables[pageTable] = {};	
			}
			
			var pageId = pageController.pageId;		
			
			tables[pageTable][pageId] = pageController;
			
			return true;
		},
		/**
		 * Returns control or array of controls by following params
		 * @param {string} tName
		 * @param {string} rowId Pass false or null to get all controls of the table
		 * @param {string} fName Pass false or null to get all controls of the row
		 * @param {int} controlIndex Pass false or null to get first control of the field
		 * @return {object} return control, array of controls or false
		 */
		getAt: function(tName, pageId){
			// if table not exists
			if (!tables[tName]) {
				return false;
			}	
			if (!tables[tName][pageId]){
				return false;
			}
			
			return tables[tName][pageId];
		},
		
		getById: function(pageId){
			if(typeof pageId == "undefined"){
				return false;
			}
			for(var tName in tables){
				if (typeof tables[tName][pageId] != "undefined"){
					return tables[tName][pageId];
				}
			}
			return false;
		},
		/**
		 * Unregister control, row or table
		 * @param {string} tName
		 * @param {string} rowId Pass false or null to clear all controls of the table
		 * @param {string} fName Pass false or null to clear all controls of the row
		 * @param {int} controlIndex Pass false or null to clear first control of the field
		 * @return {bool} true if success, otherwise false
		 */
		unregister: function(tName, pageId){	
			// if no table name passed, return false
			if (!tables[tName]) {
				return false;
			}	
			// recursively destroy pageObjects
			if (!pageId){
				for(var id in tables[tName]){
					this.unregister(tName, id);
				}
				delete tables[tName];
			}else{
				if (tables[tName][pageId].destructor){					
					tables[tName][pageId].destructor();
				}
				Runner.pages.PageControlsMap.removeMap(tName, tables[tName][pageId].pageType, pageId);
				Runner.pages.PageViewControlsMap.removeMap(tName, tables[tName][pageId].pageType, pageId);
				delete tables[tName][pageId];
			}
			
			return true;
		},
		
		initPages: function(){
			var controlsMap = Runner.pages.PageControlsMap.getMap(), viewControlsMap = Runner.pages.PageViewControlsMap.getMap(),
				cfg;
			
			for(var tName in controlsMap){
				for(var pageType in controlsMap[tName]){
					for(var pageId in controlsMap[tName][pageType]){
						cfg = {
							tName: tName, 
							pageType: pageType, 
							pageId: pageId, 
							controlsMap: controlsMap[tName][pageType][pageId], 
							viewControlsMap: viewControlsMap[tName][pageType][pageId],
							pageMode: Runner.pages.PageSettings.getTableData(tName, "pageMode")
						};
						this.initPage(cfg);
					}
				}
			}
			// init only once
			this.initPages = Runner.emptyFn;
			Runner.stopLoading();
		},
		
		initPage: function(cfg){
			var page = Runner.pages.PageFabric(cfg);
			
			// call init method
			if (!page.fly){
				page.init();
			}else{
				page.initFlyPage();
			}
			if(!page.fly && (!page.pageMode || page.pageMode != "listdetails") && !page.isUseTabs())
				page.fireEvent('afterPageReady', page, page.proxy, page.id);
			return page;
		},
		/**
		 * For dynamic page opening
		 */
		openPage: function(pageParams){
			
			pageParams.pageId = Runner.genId();
			
			var reqParams = {
				rndval: Math.random(),
				id: pageParams.pageId,
				onFly: 1,
				isNeedSettings: true
			};
			// add base params to request
			Runner.apply(reqParams, pageParams.baseParams);
			// for closure
			var pageManager = this, ajaxRequestUrl = Runner.pages.getUrl(pageParams.tName, pageParams.pageType, pageParams.keys, pageParams.keyPref);			
			// make request
			$.getJSON(ajaxRequestUrl, reqParams, function(ctrlsJSON){
				// add settings
				Runner.pages.PageSettings.addSettings('', ctrlsJSON.settings);
				// load additional css
				var cssFilesToLoad = [], 
					allCSSFiles = [], 
					i = 0;
				if(typeof ctrlsJSON.CSSFilesIE == 'undefined'){
					ctrlsJSON.CSSFilesIE = [];
				}
				if(typeof ctrlsJSON.CSSFiles == 'undefined'){
					ctrlsJSON.CSSFiles = [];
				}
				//add page style and layout files to 'need to load' list
				if(Runner.pages.PageSettings.getTableData(pageParams.tName, "pageCSS") != ''){
					ctrlsJSON.CSSFilesIE.unshift(Runner.pages.PageSettings.getTableData(pageParams.tName, "pageCSS"));
				}
				if(Runner.pages.PageSettings.getTableData(pageParams.tName, "pageLayout") != ''){
					ctrlsJSON.CSSFilesIE.unshift(Runner.pages.PageSettings.getTableData(pageParams.tName, "pageLayout"));
				}
				// combine ordinary css and IE css to one array
				$.each(ctrlsJSON.CSSFiles, function(index, cssFile){
					allCSSFiles[allCSSFiles.length] = cssFile;
				});
				$.each(ctrlsJSON.CSSFilesIE, function(index, cssFile){
					allCSSFiles[allCSSFiles.length] = cssFile;
					if(Runner.isIE){
						allCSSFiles[allCSSFiles.length] = Runner.util.ScriptLoader.getCSSFileNameForIE(cssFile);
					}
				});
				// check if css file allready loaded
				for(i = 0; i < allCSSFiles.length; i++){
					var found = false;
					$('head link[rel="stylesheet"]').each(function(index, element){
						if($(element).attr('href') == allCSSFiles[i]){
							found = true;
							return false;
						}
					});
					if(!found){
						cssFilesToLoad[cssFilesToLoad.length] = allCSSFiles[i];
					}
				}
				// run css link creation
				if(cssFilesToLoad.length){
					Runner.util.ScriptLoader.loadCSS(cssFilesToLoad);
				}
				
				if(ctrlsJSON.additionalJS){
					$.each(ctrlsJSON.additionalJS, function(jsFile, jsFileReq){
						Runner.util.ScriptLoader.addJS.apply(Runner.util.ScriptLoader, [[jsFile], jsFileReq])
					});
				}
				Runner.util.ScriptLoader.on('filesLoaded', function(){
					// add map
					Runner.pages.PageControlsMap.addMap(pageParams.tName, pageParams.pageType, pageParams.pageId, ctrlsJSON.controlsMap);
					Runner.pages.PageViewControlsMap.addMap(pageParams.tName, pageParams.pageType, pageParams.pageId, ctrlsJSON.viewControlsMap);
					// callback analyze request data and call initPage of this class with cfg as param
					var cfg = {
						tName: pageParams.tName, 
						pageType: pageParams.pageType, 
						editType: pageParams.editType || pageParams.baseParams.editType,
						pageId: pageParams.pageId,
						controlsMap: ctrlsJSON.controlsMap[pageParams.tName][pageParams.pageType][pageParams.pageId], 
						viewControlsMap: ctrlsJSON.viewControlsMap[pageParams.tName][pageParams.pageType][pageParams.pageId],
						headerCont: ctrlsJSON.headerCont || "<span>&nbsp;</span>",
						bodyCont: ctrlsJSON.html ? ("<div class=\"runner-pagewrapper " 
								+ Runner.pages.PageSettings.getTableData(pageParams.tName, "pageSkinStyle") + "\">" + ctrlsJSON.html + "</div>") 
								: "<span>&nbsp;</span>",
						fotterCont: ctrlsJSON.fotterCont || "<span>&nbsp;</span>",
						fly: true,
						submitUrl: ajaxRequestUrl
					};
					Runner.apply(cfg, pageParams);
					pageManager.initPage(cfg)
					// add id counter
					Runner.setIdCounter(ctrlsJSON.idStartFrom);	
					
					// wait for all css files loading and resize YUI window after that
					if (!Runner.isMobile){
						if(cssFilesToLoad.length){
							Runner.cssFilesToLoadCount = cssFilesToLoad.length;
							if(Runner.isIE){
								for(i = 0; i < cssFilesToLoad.length; i++){
									//find just created css-link and bind onload event to them
									(function (){
										var link = null;
										$('head link[rel="stylesheet"]').each(function(index, element){
											if($(element).attr('href') == cssFilesToLoad[i] + ".css"){
												link = $(element)[0]; 
												return false;
											}
										});
										if(link){
											var isLoadedHandler;
											isLoadedHandler = function(){ 
												pageManager.cssIsLoaded(link, cfg, isLoadedHandler); 
											};
											link.onload = function(){ 
												Runner.cssFilesToLoadCount--;
												if(Runner.cssFilesToLoadCount == 0){
													pageManager.correctYUIWindowSize(cfg.tName, cfg.pageId);
												}
											};
										}else{
											Runner.cssFilesToLoadCount--;
										}
									})();
								}
							}else{
								for(i = 0; i < cssFilesToLoad.length; i++){
									(function (){
										var link = null;
										$('head link[rel="stylesheet"]').each(function(index, element){
											if($(element).attr('href') == cssFilesToLoad[i] + ".css"){
												link = $(element)[0]; 
												return false;
											}
										});
										if(link){
											var isLoadedHandler;
											isLoadedHandler = function(){ 
												pageManager.cssIsLoaded(link, cfg, isLoadedHandler); 
											};
											setTimeout(isLoadedHandler, 10);
										}
										else
											Runner.cssFilesToLoadCount--;
									})();
								}
							}
						}else{
							pageManager.correctYUIWindowSize(cfg.tName, cfg.pageId);
						}
					}
				}, pageManager, {single: true});
				Runner.util.ScriptLoader.load();
			});
			
			return reqParams.id
		},
		
		/**
		 * cssIsLoaded
		 * check if CSS-link is loaded
		 * @param {DOMElement} CSS-link
		 * @param {object} Runner configuration data
		 * @param {refferense} refferense to anonymous function wich useing to started this function in setTimout  
		 */
		cssIsLoaded: function(cssStylesheet, cfg, isLoadedHandler) {
			var cssLoaded = 0;
			try {
				if(cssStylesheet.sheet && cssStylesheet.sheet.cssRules.length > 0){
					cssLoaded = 1;
				}else{ 
					if(cssStylesheet.styleSheet && cssStylesheet.styleSheet.cssText.length > 0){
						cssLoaded = 1;
					}else if(cssStylesheet.innerHTML && cssStylesheet.innerHTML.length > 0){
						cssLoaded = 1;
					}
				}
			}
			catch(ex){ }
			
			var pageManager = this;
			if(cssLoaded){
				Runner.cssFilesToLoadCount--;
				if(Runner.cssFilesToLoadCount == 0){
					setTimeout(function(){ 
						pageManager.correctYUIWindowSize(cfg.tName, cfg.pageId); 
					}, 10);
				}
			}else{
				setTimeout(isLoadedHandler, 100);
			}
		},
		/**
		 * Create new fly window
		 *
		 * @param {object} specific yui arguments
		 * @param {boolean} if fly window is based on RunnerPage or other event-capable object
		 * @intellisense
		 */
		createFlyWin: function(args, pageBased, afterCreateHandler, afterCloseHandler){
			var Y = Runner.Y,
				self = this,
				pageCont = document.createElement("DIV"),
				winAttrs = {
					srcNode: pageCont,
					zIndex: Runner.genZIndexMax()
				};
			if(pageBased){
				this.pageCont = pageCont;
			}

			//combine attrs
			Runner.apply(winAttrs, args);
			//dinamic loading all needed yui files for show panel with resizability and dragability
			Y.use('panel', 'dd-constrain', 'dd-scroll', 'resize-constrain', function(Y){
				if(typeof winAttrs.bodyContent == 'undefined'){
					winAttrs.bodyContent = "&nbsp;";
				}
				var win = new Y.Panel(winAttrs),
					pageWrapper = win.bodyNode.getDOMNode();
					
				$(pageCont).parent().attr("dir", "ltr");
				$(pageWrapper).attr("dir", $("html").attr("dir")); 	
				
				$(pageWrapper).css("overflow","auto");
				$(pageWrapper).css("position","relative");
				
				win.hide();
				
				if(pageBased){
					self.win = win;
				}
				//allow dragability
				var drag = new Y.DD.Drag({
					node: pageCont
				}).	plug(Y.Plugin.DDWinScroll);
				//Add constrained to panel
				drag.plug(Y.Plugin.DDConstrained, {
					constrain: {'top':0, 'left':0}
				});
				//add drag handle only for panel header
				drag.addHandle('div.yui3-widget-hd');
				drag.on("drag:drag", function(){
					$('#shiny_box').hide();
				});
				
				if(winAttrs.resize !== false){
					//allow resizability
					var resize = new Y.Resize({
						node: pageCont,
						handles: Runner.isDirRTL() ? 'bl' : 'br'
					});
					//we can plug in the resizeConstrained plugin on the 'resize' namespace
					resize.plug(Y.Plugin.ResizeConstrained, {
						minWidth: 100,
						minHeight: 100,
						preserveRatio: false
					});
					
					resize.on('resize:resize', function(){
						$(pageWrapper).height($(win.get("contentBox").getDOMNode()).height()-60);
					});
				}	
				
				// if win modal set the same attr
				if(winAttrs.modal){	
					$(pageCont).parent().attr('modal', '1');
				}
				
				// close handler
				$('.yui3-button-close', pageCont).click(function(){
					$('#shiny_box').hide();
					if(afterCloseHandler){
						afterCloseHandler(win);
						return;
					}
					if(pageBased){
						self.fireEvent('closeFlyWin');
					}else{
						win.destroy(true);
					}	
				});
				
				// fire event after all yui files loaded and create fly win
				if(afterCreateHandler){
					afterCreateHandler(win);
				}else{
					if(pageBased){
						self.fireEvent('afterCreateFlyWin');
					}
				}
				
				//	imitate d&d
				if(winAttrs.resize !== false){
					var xy = drag.get('node').getXY();
					drag._setStartPosition(xy);
					drag.actXY = xy;
					drag._moveNode();
				}
				if ( Runner.isDirRTL() ) {  //change the Shim position
					Y.DD.DDM._pg.setStyles({
						left: 'auto',
						right: '0'
					});
					
					win.get('srcNode').dd.con.get('constrain').left = -($(document).width() - $(window).width());
	
					win.get('srcNode').dd.on("drag:start", function() { //change the Shim position
						Y.DD.DDM._pg.setStyles({
							left: 'auto',
							right: '0'
						});
					});					
				}
				
				$(pageWrapper).css("position","relative");
			});
		},
		
		/**
		 * correctYUIWindowSize
		 * Try to resize YUI window after CSS-loading
		 * @param {string} current page table name
		 * @param {string} current page ID
		 * @param {boolean} centered window or not
		 * @param {object} fly win 
		 */
		correctYUIWindowSize: function(tName, pageId, centered, win){
			var self = this;
			if(typeof win == 'undefined'){
				var pageObj = this.getAt(tName, pageId);
				if(!pageObj.win){
					return;
				}
				win = pageObj.win;
			}
			if(typeof centered == 'undefined'){
				centered = false;
			}
			
			var newWidth, fullWidth, newHeight,
				winDim = Runner.getWindowDimensions(),
				scroll = Runner.getScrollXY(),
				bodyNode = win.bodyNode.getDOMNode(),
				offsetParent = bodyNode.offsetParent,
				halfWinWidth = Math.floor(3 * winDim.width / 4),  	//three-quarter of a screen width 
				halfWinHeight = Math.floor(3 * winDim.height / 4);  //three-quarter of a screen height 
			
			if(Runner.isIE){
				offsetParent = bodyNode.offsetParent.offsetParent;
			}
			
			// correct win width size
			if(win.get('width')){
				newWidth = win.get('width');
			}else{
				newWidth = offsetParent.offsetWidth;
			}
			if(!centered && Runner.isDirRTL()){
				fullWidth = offsetParent.offsetLeft - newWidth;
			}else{
				fullWidth = offsetParent.offsetLeft + newWidth;
			}
			if(fullWidth > winDim.width){
				newWidth = newWidth - (fullWidth - winDim.width) + scroll.x - 30;
			}
			if(newWidth < 100){
				newWidth = 100;
			}
			else if(newWidth > halfWinWidth){
				newWidth = halfWinWidth;
			}
			win.set("width", newWidth);
			if(centered){
				win.set("x", halfWinWidth - Math.floor(newWidth/2) + scroll.x);
			}
			win.render();
			
			// correct win height size
			if(win.get('height')){
				newHeight = win.get('height');
			}else{
				newHeight = offsetParent.offsetHeight;
			}
			var fullHeight = offsetParent.offsetTop + newHeight;
			if(fullHeight > winDim.height){
				newHeight = newHeight - (fullHeight - winDim.height) + scroll.y - 30;
			}
			if(newHeight < 100){
				newHeight = 100;
			}
			else if(newHeight > halfWinHeight){
				newHeight = halfWinHeight;
			}
			win.set("height", newHeight);
			if(centered){
				win.set("y", halfWinHeight - Math.floor(newHeight/2) + scroll.y);
			}
			win.render();
			
			var widthScrollDelta = bodyNode.scrollWidth - $(bodyNode).width();
			if(widthScrollDelta > 5 && widthScrollDelta < 20){
				win.set("width", newWidth + widthScrollDelta + 5);
				win.render();
			}
			$(win.bodyNode.getDOMNode()).height($(win.get("contentBox").getDOMNode()).height()-60);
			win.show();
		},
		
		addUnloadHn: function(hn, scope, args){
			if (typeof hn != 'function'){
				return false;
			}
			beforeUnloadPool.push({fn: hn, scope: scope || window, args: args || []});
			return true;
		},
		
		callUnload: function(){
			var scope, args;
			for(var i=0;i<beforeUnloadPool.length;i++){
				scope = beforeUnloadPool[i].scope;
				args = beforeUnloadPool[i].args;
				beforeUnloadPool[i].fn.apply(scope, args);
			}
			for(var tName in tables){
				this.unregister(tName);
			}
		}
	}
}();


// create namespace
Runner.namespace('Runner.pages');

Runner.pages.PageControlsMap = function(){
	
	window.controlsMap = window.controlsMap || {};
	//console.log('window.controlsMap = ',window.controlsMap);
	return {
		
		addMap: function(tName, pageType, pageId, map){
			if (!tName || !pageType || typeof pageId == 'undefined'){
				return false;
			}
			if (!controlsMap[tName]){
				controlsMap[tName] = {};
			}
			if (!controlsMap[tName][pageType]){
				controlsMap[tName][pageType] = {};
			}
			controlsMap[tName][pageType][pageId] = map[tName][pageType][pageId];
		},
		
		getMap: function(tName, pageType, pageId){
			if (!tName){
				return controlsMap;
			}
			if (!pageType){
				return controlsMap[tName];
			}
			if (typeof pageId == 'undefined'){
				return controlsMap[tName][pageType];
			}
			return controlsMap[tName][pageType][pageId];
		},
		
		removeMap: function(tName, pageType, pageId){
			if (!tName || !pageType || typeof pageId == "undefined"){
				return false;
			}
			if (!controlsMap[tName]){
				return false;
			}
			if (!controlsMap[tName][pageType]){
				return false;
			}
			delete controlsMap[tName][pageType][pageId];
			return true;
		}
	};
}();

Runner.pages.PageViewControlsMap = function(){
	
	window.viewControlsMap = window.viewControlsMap || {};
	//console.log('window.controlsMap = ',window.controlsMap);
	return {
		
		addMap: function(tName, pageType, pageId, map){
			if (!tName || !pageType || typeof pageId == 'undefined'){
				return false;
			}
			if (!viewControlsMap[tName]){
				viewControlsMap[tName] = {};
			}
			if (!viewControlsMap[tName][pageType]){
				viewControlsMap[tName][pageType] = {};
			}
			viewControlsMap[tName][pageType][pageId] = map[tName][pageType][pageId];
		},
		
		getMap: function(tName, pageType, pageId){
			if (!tName){
				return viewControlsMap;
			}
			if (!pageType){
				return viewControlsMap[tName];
			}
			if (typeof pageId == 'undefined'){
				return viewControlsMap[tName][pageType];
			}
			return viewControlsMap[tName][pageType][pageId];
		},
		
		removeMap: function(tName, pageType, pageId){
			if (!tName || !pageType || typeof pageId == "undefined"){
				return false;
			}
			if (!viewControlsMap[tName]){
				return false;
			}
			if (!viewControlsMap[tName][pageType]){
				return false;
			}
			delete viewControlsMap[tName][pageType][pageId];
			return true;
		}
	};
}();

/**
 * Page settings store
 * @param {string} tName name of table
 * @param {string} pageType pageType of settings (list, add, edit etc.)
 */
Runner.pages.PageSettings = function(){
	
	// private
	window.settings = window.settings || {tables:{}};
	//console.log('window.settings = ',window.settings);
	Runner.setIdCounter(settings['global'].idStartFrom);
	Runner.debugMode = settings['global'].debugMode;
	Runner.charSet = settings['global'].charSet;
	
	//mobile
	Runner.isMobile = settings['global'].isMobile;
	
	//Active Directory
	Runner.isAD = settings['global'].isAD;
	
	this.getDefaultViewPageType = function(){
		return Runner.pages.constants.PAGE_VIEW;
	};
	
	this.getDefaultEditPageType = function(){
		return Runner.pages.constants.PAGE_EDIT;
	};
	
	// public
	this.getSettings = function(tName, fName, pageType){
		if (!tName){
			return settings;
		}
		if (!fName){
			return settings.tableSettings[tName];
		}
		return settings.tableSettings[tName]['fieldSettings'][fName][pageType];
	};
	
};

/**
 * @singletone
 */
Runner.pages.PageSettings = Runner.extend(Runner.pages.PageSettings, {

	/**
	 * Checks setting if they are already exists
	 * @param {} tName
	 * @param {} pageType
	 */
	checkSettings: function(tName, fName, pageType){
		var settings = this.getSettings(tName, fName, pageType);
		if (settings){
			return true;
		}else{
			return false;
		}
	},
	
	fieldSettingsExist: function(tName, fName, key, pageType){
		if(typeof settings.tableSettings[tName]["fieldSettings"][fName] != 'undefined' 
			&& typeof settings.tableSettings[tName]["fieldSettings"][fName][pageType] != 'undefined'
			&& typeof settings.tableSettings[tName]["fieldSettings"][fName][pageType][key] != 'undefined')
			return true;
		return false;
	},
	
	/**
	 * Load settings from server, make ajax request
	 * @param {} tName
	 * @param {} pageType
	 */
	loadSettings: function(tName, pageType){
		
		
	},
		
	
	addPageEvent: function(tName, pType, evName, evHn){
		if (!settings.tableSettings[tName]){
			settings.tableSettings[tName] = {};
		}
		if (!settings.tableSettings[tName]["events"]){
			settings.tableSettings[tName]["events"] = {};
		}
		if (!settings.tableSettings[tName]["events"][pType]){
			settings.tableSettings[tName]["events"][pType] = {};
		}
		if (!settings.tableSettings[tName]["events"][pType][evName]){
			settings.tableSettings[tName]["events"][pType][evName] = [];
		}
		settings.tableSettings[tName]["events"][pType][evName].push({hn: evHn});
	},
	
	/**
	 * Add settings from data
	 * @param {object} cfg
	 */
	addSettings: function(tName, addSettings, forceRewrite){
		if (!addSettings){
			return false;
		}
		var settings = this.getSettings();
		// add short table names
		Runner.setIdCounter(settings['global'].idStartFrom);
		Runner.apply(settings.global.shortTNames, addSettings.global.shortTNames);
		// just replace
		if (forceRewrite === true){
			settings.tableSettings[tName] = addSettings.tableSettings[tName];
			return;
		}
				
		// recursively apply if settings
		if (!tName){
			Runner.deepCopy(settings.tableSettings, addSettings.tableSettings);
		}else{
			settings.tableSettings[tName] = settings.tableSettings[tName] || {};
			Runner.deepCopy(settings.tableSettings[tName], addSettings.tableSettings[tName]);
		}		
		
		return true;		
	},
	
	getViewType: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "viewFormat", pageType);
	},
	
	getEditFormat: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "editFormat", pageType);
	},
	
	getShortTName: function(tName){
		if (!tName){
			return "";
		}
		return settings.global.shortTNames[tName] || settings.tableSettings[tName].shortTName || "";
	},
	
	getValidations: function(tName, fName, pageType){
		if (this.fieldSettingsExist(tName, fName, "validation", pageType))
			return this.getFieldData(tName, fName, "validation", pageType);
		else
			return  Runner.pages.Defaults.getValidationSettings();	 
	},
	
	getDisabledStatus: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "isDisabled", pageType);
	},
	
	getHiddenStatus: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "isHidden", pageType);
	},
	
	getCategoryField: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "categoryField", pageType);
	},
	
	getLookupTable: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "lookupTable", pageType);
	},
	
	getLookupSize: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "selectSize", pageType);
	},
	
	getLCT: function(tName, fName, pageType){
		return this.getFieldData(tName, fName, "lcType", pageType);
	},

	getTableData: function(tName, key){
		if (typeof settings.tableSettings[tName] != 'undefined' && typeof settings.tableSettings[tName][key] != 'undefined'){
			return this.returnData(settings.tableSettings[tName][key]);
		}else{
			return this.returnData(Runner.pages.Defaults.getTableSettings(key));
		}
	},
	
	getFieldData: function(tName, fName, key, pageType){
		if (this.fieldSettingsExist(tName, fName, key, pageType)){
			return this.returnData(settings.tableSettings[tName]["fieldSettings"][fName][pageType][key]);
		}else{
			return  this.returnData(Runner.pages.Defaults.getFieldSettings(key));
		}
	},
	
	getRTECKDim: function(tName){
		if (typeof settings.tableSettings[tName] != 'undefined'){
			var fieldSet = settings.tableSettings[tName]["fieldSettings"];
			for(var field in fieldSet){
				if(fieldSet[field].RTEType == 'RTECK'){
					return {nWidth:fieldSet[field].nWidth, nHeight:fieldSet[field].nHeight};
				}
			}
		}
		return false;
	},
	
	getGlobalData: function(key){
		if(settings['global'][key] != undefined)
			return this.returnData(settings['global'][key]);
		else 
			return this.returnData(Runner.pages.Defaults.getGlobalSettings(key));
	},
	
	returnData: function(data){
		if (Runner.isArray(data)){
			return data.slice(0);
		}else if(typeof data == "object" && data != null){
			var F = function(){};
			F.prototype = data;
			return new F();
		}else{
			return data;
		}
	}
});

Runner.pages.PageSettings = new Runner.pages.PageSettings();
		
/**
 * @ignore
 */
Runner.pages.PageFabric = function(baseCfg){
	var cfg = {};
	Runner.apply(cfg, baseCfg);
	
	//console.log(cfg, 'new cfg in page fabric');	
	
	switch (cfg.pageType){
		case Runner.pages.constants.PAGE_LIST:
			if (Runner.isMobile) {
				if (cfg.fly){				
					return new Runner.pages.ListPageFly(cfg);
				}
				else {
					return new Runner.pages.ListPageMobile(cfg);
				}
			}else{
				if (cfg.fly){				
					if (Runner.isAD && cfg.pageMode == Runner.pages.constants.MEMBERS_PAGE){
						return new Runner.pages.MembersPageAD(cfg);
					}
					return new Runner.pages.ListPageFly(cfg);
				}else if(cfg.pageMode == Runner.pages.constants.LIST_AJAX){
					return new Runner.pages.ListPageAjax(cfg);	
				}else if(cfg.pageMode == Runner.pages.constants.MODE_LIST_DETAILS){	
					return new Runner.pages.ListPageDP(cfg);
				}else if(cfg.pageMode == Runner.pages.constants.RIGHTS_PAGE){
					if (Runner.isAD) {
						// Active Directory
						return new Runner.pages.RightsPageAD(cfg);						
					}
					return new Runner.pages.RightsPage(cfg);						
				}else if(cfg.pageMode == Runner.pages.constants.MEMBERS_PAGE){
					return new Runner.pages.MembersPage(cfg);	
				}else{
					return new Runner.pages.ListPage(cfg);	
				}		
			}
			break;
		case Runner.pages.constants.PAGE_ADD:
			if (cfg.editType == Runner.pages.constants.ADD_ONTHEFLY){
				return new Runner.pages.AddPageFly(cfg);
			}else{
				return new Runner.pages.AddPage(cfg);	
			}	
			break;
		case Runner.pages.constants.PAGE_EDIT:
			return new Runner.pages.EditPage(cfg);
			break;
		case Runner.pages.constants.PAGE_VIEW:
			return new Runner.pages.ViewPage(cfg);
			break;
		case Runner.pages.constants.PAGE_SEARCH:
			return new Runner.pages.SearchPage(cfg);
			break;	
		case Runner.pages.constants.PAGE_REPORT:
			if (Runner.isMobile)
				return new Runner.pages.ReportPageMobile(cfg);
			else
				return new Runner.pages.ReportPage(cfg);
			break;
		case Runner.pages.constants.PAGE_CHART:
			if (Runner.isMobile)
				return new Runner.pages.ChartPageMobile(cfg);
			else
				return new Runner.pages.ChartPage(cfg);
			break;
			/*case Runner.pages.constants.PAGE_PRINT:
			return new Runner.pages.PrintPage(cfg);
			break;*/
		case Runner.pages.constants.PAGE_REGISTER:
			return new Runner.pages.RegisterPage(cfg);
			break;	
		case Runner.pages.constants.PAGE_EXPORT:
			return new Runner.pages.ExportPage(cfg);
			break;
		case Runner.pages.constants.PAGE_IMPORT:
			return new Runner.pages.ImportPage(cfg);
			break;
		default:
			cfg.createAsDefault = true;
			return new Runner.pages.RunnerPage(cfg);
			break;
	}
	
};

Runner.pages.getUrl = function(tName, pageType, keys, keyPref){
	keys = keys || [];
	keyPref = keyPref || "editid";	
	
	var url = Runner.pages.PageSettings.getShortTName(tName)+"_"+pageType+".php";
	
	for(var i=0; i< keys.length; i++){
		if(!i){
			url += "?";
		}
		url += keyPref + (i+1) + "=" + escape(keys[i]) + "&";
	}
	if(keys.length){
		url = url.substring(0, url.length-1);
	}
	return url;
};

/**
 * Base abstract class for all pages
 * @abstract
 * @class Runner.pages.RunnerPage
 * @base Runner.util.Observable
 * @intellisense
 */
Runner.pages.RunnerPage = Runner.extend(Runner.util.Observable, {
	/** 
	 * Table name 
	 * @intellisense
	 */
	tName: '',
	/**
	 * Page Type
	 * @intellisense
	 */
	pageType: '',
	/**
	 * Parent page
	 * @intellisense
	 */
	parentPage: null,
	
	modal: false,
	/**
	 * Page id from controlsMap
	 * @intellisense
	 */
	pageId: -1,
	
	controlsMap: null,
	
	viewControlsMap: [],
	
	fly: false,
	/**
	 * Header html contents of the fly page 
	 * @intellisense
	 */
	headerCont: "",
	/**
	 * Body html contents of the fly page 
	 * @intellisense
	 */
	bodyCont: "",
	/**
	 * Footer html contents of the fly page 
	 * @intellisense
	 */
	fotterCont: "",
	/**
	 * Fly page(window) object
	 * @intellisense
	 */
	win: null,
	/**
	 * Page container DOM element
	 *
	 * For simple page - body
	 * For details - td or div
	 * For fly page - div (use it instead of winDiv)
	 * @intellisense
	 */
	pageCont: null,
	/**
	 * The list of bricks, wich must be reloaded after ajax
	 * @intellisense
	 */
	bricksForReload: [],
	
	proxy: {},
	
	createAsDefault: false,
	
	useAsGlobal: false,
	
	destroyOnClose: false,
	
	afterClose: null,
	
	shortTName: "",
	
	useLocking: false,
	
	useAudio: false,
	
	useResize: false,
	
	bricksForMobileFly: [],
	
	useButtons: false,
	
	buttonNames: [],
	
	buttonEventBefore: {},
	
	buttonEventAfter: {},
	
	validateTimer: null,
	
	constructor: function(cfg){
		Runner.apply(this, cfg);
		Runner.pages.PageManager.register(this);
		
		this.addEvents('beforeInit', 'afterInit', 'filesLoaded', 'afterClose', 'afterCreateFlyWin', 'closeFlyWin', 'afterCreateCalendar', 'closeCalendar');
		
		this.id = this.pageId;
		this.proxy = Runner.pages.PageSettings.getTableData(this.tName, "proxy");
		this.useAudio = Runner.pages.PageSettings.getTableData(this.tName, "isUseAudio");
		this.useResize = Runner.pages.PageSettings.getTableData(this.tName, "isUseResize");
		this.useLocking = Runner.pages.PageSettings.getTableData(this.tName, "locking");
		this.useButtons = Runner.pages.PageSettings.getTableData(this.tName, "isUseButtons");
		this.shortTName = Runner.pages.PageSettings.getShortTName(this.tName);
		if (this.afterInit){
			this.on({'afterInit': this.afterInit});
		}
		
		// set default page container
		this.pageCont = document.body;
		// escape fly windows
		$(document).unbind('keydown').bind('keydown',this.escWin);
		/**
		 * Create a new YUI instance.
		 *
		 * Configuring YUI
		 * The default path for the YUI library is the minified version of the files (e.g., event-min.js)
		 * Use propertie 'filter' for modify the default path for all modules:
		 * 	DEBUG - Selects the debug versions of the library (e.g., event-debug.js)
		 * 	RAW - Selects the non-minified version of the library (e.g., event.js)
		 * Example: filter: 'debug'
		 *
		 * A complete list of configuration options is available on: yuilibrary.com/yui/docs/api/classes/config.html
		 * @intellisense
		 */
		if( typeof Runner.Y == "undefined" ){
			var YUIparams = {
				base: 'include/yui/'
			};
			if(Runner.pages.PageSettings.getGlobalData("debugMode")){
				YUIparams.filter = 'raw';
			}
			else
			{
				YUIparams.comboBase = 'combo.php?';
				YUIparams.combine = true;
			}
			Runner.Y = YUI(YUIparams);
		}
		this.Y = Runner.Y;
	},
	
	destructor: function(){
		// unregister page Object, clean memory
		this.destroyWin();
		if(!this.win && (Runner.isMobile) && (this.fly)){
			this.destructorMobile();
		}
		this.purgeListeners();
		Runner.controls.ControlManager.unregister(this.tName, this.pageId);
	},
	
	destructorMobile: function(){
		this.replaceBrickHTMLWith('flypanel_mobile','');
		for(var i = 0, l = this.bricksForMobileFly.length; i<l; i++){
			if (this.bricksForMobileFly[i].name != "message"){
				this.showBrick(this.bricksForMobileFly[i].name);
			}
		}
		this.hideBricks(["flypanel_mobile"]);
	},
	
	init: function(){
		var pageObj = this;
		this.fireEvent('beforeInit', this);
		
		$('body').addClass("yui3-skin-sam");
		
		this.initMenu();
		this.initEvents();
		this.setFirstFocus();
		this.initRunnerButtons();
		this.initCSS();
		
		this.hidenFields = [];
		
		//hide rows if user already hide any field
		$('.runner-hiddenfield').each(function(){ 
			pageObj.toggleParentRow(this);
			var classPrefix = "", cssClass = $(this).attr('class');
			if(cssClass.indexOf("fieldlabel_") > -1)
				classPrefix = "fieldlabel_";
			else if(cssClass.indexOf("fieldcontrol_") > -1)
				classPrefix = "fieldcontrol_";
			else if(cssClass.indexOf("fieldoption_") > -1)
				classPrefix = "fieldoption_";
			if(classPrefix == "")
				return true;
			var startIndex = cssClass.indexOf(classPrefix) + classPrefix.length, spaceIndex = cssClass.indexOf(' ', startIndex),
				fieldName = cssClass.substr(startIndex, spaceIndex > -1 ? spaceIndex - startIndex : cssClass.length - startIndex),
				ctrl = Runner.getControl(pageObj.pageId, fieldName);
			if(ctrl)
				ctrl.hiddenByField = true;
		});
		
		if(!this.isUseTabs()){
			this.initForTabs();
		}
		
		if(Runner.isIE && Runner.isDirRTL && Runner.pages.PageSettings.getTableData(this.tName, "hasMasterList")){
			var masterTD = $("td.runner-b-masterinfo");
			masterTD.removeClass("runner-bl");
			setTimeout(function(){
				masterTD.addClass("runner-bl");
			}, 10);
		}
		
		if(this.pageType==Runner.pages.constants.PAGE_LIST && !this.fly && this.useResize){
			return;
		}
		this.initForGrid();
	},
	
	/**
	 * Init functionality for page after tabs loading
	 * @intellisense
	 */
	initForTabs: function(){
		this.initControls();
		this.initViewControls();
		this.initLookups();
	},
	
	/**
	 * Init functionality for grid
	 * @intellisense
	 */
	initForGrid: function(){
		if (this.createAsDefault){
			this.fireEvent('afterInit', this, this.proxy, this.id);
		}
	},
	
	/**
	 * initCSS
	 * Load style and layout files on the fly
	 * @intellisense
	 */
	initCSS: function(){
		if(this.fly || this.pageMode == Runner.pages.constants.MODE_LIST_DETAILS){
			if(Runner.pages.PageSettings.getTableData(this.tName, "pageCSS")){
				Runner.util.ScriptLoader.loadCSS([Runner.pages.PageSettings.getTableData(this.tName, "pageCSS")
				  , Runner.pages.PageSettings.getTableData(this.tName, "pageLayout")], true);
			}
		}
	},
	
	/**
	 * Init all runner buttons on page
	 * Attach event handlers for buttons by class
	 * @intellisense
	 */
	initRunnerButtonByClass: function(el) {
		Runner.initRunnerButtonByClass(el);
	},
	
	/**
	 * Wrapper for getSettings function in PageSettings
	 * @intellisense
	 */
	getSettings: function(tName, fName){
		return Runner.pages.PageSettings.getSettings(tName, fName, this.pageType);
	},
	
	/**
	 * Wrapper for checkSettings function in PageSettings
	 * @intellisense
	 */
	checkSettings: function(tNave, fName){
		return Runner.pages.PageSettings.checkSettings(tName, fName, this.pageType);
	},
	
	/**
	* Show invalid captcha message
	* @param {boolean} - is captcha valid 
	* @param {integer} - page id
	* @intellisense
	*/
	showCaptchaErrMessage: function(valid){
		if(valid === false){
			var captchaErrDiv = $('#edit'+this.id+'_captcha_0').find('div.runner-error');
			if (captchaErrDiv.length){
				captchaErrDiv.empty().html(Runner.lang.constants.TEXT_INVALID_CAPTCHA_CODE);
			}else{
				$('#edit'+this.id+'_captcha_0').append('<div class="runner-error">'+Runner.lang.constants.TEXT_INVALID_CAPTCHA_CODE+'</div>');
			}
		}else{
			// remove captcha error
			$('#edit'+this.id+'_captcha_0').find('div.runner-error').empty();
		}
	},
	
	/**
	* Make disabled runner button
	* @intellisense
	*/
	addDisabledClass: function(el){
		$(el).closest('span.runner-btnframe').addClass('disabled');
	},
	
	/**
	* Make enabled runner button
	* @intellisense
	*/
	delDisabledClass: function(el){
		$(el).closest('span.runner-btnframe').removeClass('disabled');
		$(el).attr('type','');
		this.initRunnerButtonByClass(el);
	},
	
	/**
	* Check is runner button disabled
	* true - disabled
	* false - not disabled
	* @intellisense
	*/
	isDisabledButton: function(el){
		if ($(el).closest('span.runner-btnframe').hasClass('disabled'))
			return true;
		else 
			return false;
	},
	
	/**
	 * Init all runner buttons on page
	 * Attach event handlers for buttons
	 * @intellisense
	 */
	initRunnerButtons: function(){
		var pageObj = this;
		$(".runner-button").each(function(){
			if ($(this).attr('type')=='disabled')
				pageObj.addDisabledClass(this);
			else 
				pageObj.initRunnerButtonByClass(this);
		});
		
		$(".runner-button-img").each(function(){
			if ($(this).attr('type')=='disabled')
				pageObj.addDisabledClass(this);
			else 
				pageObj.initRunnerButtonByClass(this);
		});
		
	},
	
	initToolTips: function(toolTips, tName){
		tName = tName || this.tName;
		
		if (!Runner.pages.PageSettings.getTableData(this.tName, "isUseToolTips")){
			return false;
		}
		
		if (!$('#shiny_box').length){
			var div = document.createElement('DIV');
			$(div).css('display', 'none').attr('id', 'shiny_box').addClass('shiny_box').addClass('_hintBox').appendTo(document.body);
			$(document.createElement('DIV')).addClass('shiny_box_body').addClass('runner-panel').appendTo(div);
		}
		
		toolTips = toolTips || this.controlsMap.toolTips || [];
		var ctrls = Runner.controls.ControlManager.getAt(tName);
		
		for(var i=0; i<ctrls.length; i++){
			if (ctrls[i] && typeof toolTips[ctrls[i].fieldName] == 'string'){
				ctrls[i].initToolTip(toolTips[ctrls[i].fieldName], this);
			}
		}
		return true;
	},
	
	initMenu: function(){
		// init horizontal menu
		if($(".runner-hmenu").length && !$(".runner-hmenu:first").prop("initialized")){
			Runner.menu.Horizontal.prototype.init();
		}
		// init simple vertical menu
		if($(".runner-vmenu.simple").length && !$(".runner-vmenu.simple:first").prop("initialized")){
			Runner.menu.SimpleVmenu.prototype.init();
		}
		// init tree-like vertical menu
		if($(".runner-vmenu.tree").length && !$(".runner-vmenu.tree:first").prop("initialized")){
			Runner.menu.TreeLikeVmenu.prototype.init();
		}
		// init quick jump menu
		if($(".runner-quickjump").length && !$(".runner-quickjump:first").prop("initialized")){
			Runner.menu.QuickJump.prototype.init();
		}
	},
	
	destroyVideo: function(){
		if (typeof projekktor == "undefined"){
			return false;
		}		
		var hasMasterList = Runner.pages.PageSettings.getTableData(this.tName, "hasMasterList");
		$('.projekktor', this.pageCont).each(function(){
			if(!hasMasterList || !$(this).parents('.runner-c-master').length)
				projekktor(this.id).setStop().selfDestruct();
		});
	},
	
	resizeSliders: function(container){
		$(".sudoslider", container).each(function(){
			var sudoDiv = $(this);
			if(sudoDiv.width() == 0){
				var images = $('li img', sudoDiv);
				if(images.length){
					var image = $(images[0]);
					sudoDiv.width(image.width());
					sudoDiv.height(image.height());
					$('.prevBtn', sudoDiv.parent()).hide();
				}
			}
		});
	},
	
	initFlyPage: function(){
		if (Runner.isMobile){
			this.initFlyMobile();
			this.loadFiles();
		}else{
			this.initFly();
		}
	},
	
	loadFiles: function(){
		
		this.initCustomButtons();
		
		if (Runner.pages.PageSettings.getTableData(this.tName, "isUseCK")){
			Runner.util.ScriptLoader.addJS(["plugins/ckeditor/ckeditor.js"]);
		}
		
		//if (this.useAudio && this.pageType!=Runner.pages.constants.PAGE_ADD && this.pageType!=Runner.pages.constants.PAGE_EDIT){
		//	Runner.util.ScriptLoader.addJS(['include/runnerJS/ymp.js']);
		//}
		
		/*if (Runner.pages.PageSettings.getTableData(this.tName, "hasEvents")){
			Runner.util.ScriptLoader.addJS(["include/runnerJS/events/pageevents_" + this.shortTName + ".js"]);
		}*/
		
		if (Runner.pages.PageSettings.getTableData(this.tName, "isUseResize")){
			Runner.util.ScriptLoader.addJS(['include/runnerJS/RunnerResizeGrid.js']);
		}
		
		if(Runner.pages.PageSettings.getTableData(this.tName, "isUseGoogleMap")){
			var GoogleMapCfg = Runner.pages.PageSettings.getTableData(this.tName, "googleMapCfg");
			Runner.util.ScriptLoader.addJS(['include/runnerJS/gmap.js']);
		}
		
		if (Runner.pages.PageSettings.getTableData(this.tName, "isUseToolTips")){
			if (Runner.isMobile){
				Runner.util.ScriptLoader.addJS(["include/dimensions.mobile.js"]);
			}
			else {
				Runner.util.ScriptLoader.addJS(["include/dimensions.js"]);
			}
		}
		
		var fSett = Runner.pages.PageSettings.getTableData(this.tName, "fieldSettings", {});
		for(var fName in fSett){
			if (fSett[fName].timePick){
				Runner.util.ScriptLoader.addJS(["include/ui.js"]);
				Runner.util.ScriptLoader.addJS(["include/jquery.utils.js"], "include/ui.js");
				Runner.util.ScriptLoader.addJS(["include/ui.dropslide.js"], "include/jquery.utils.js");
				Runner.util.ScriptLoader.addJS(["include/jquery.timepickr.js"], "include/ui.dropslide.js");
			}
			
			if (fSett[fName].editFormat == Runner.controls.constants.EDIT_FORMAT_DATE && 
				(fSett[fName].dateEditType == Runner.controls.constants.EDIT_DATE_SIMPLE_DP || fSett[fName].dateEditType == Runner.controls.constants.EDIT_DATE_DD_DP)){
				if(Runner.pages.PageSettings.getGlobalData("debugMode")){
					Runner.util.ScriptLoader.addJS(["include/yui/calendar.js"], "include/yui/container.js", "include/yui/event.js");
				}
			}
		}
		Runner.util.ScriptLoader.on('filesLoaded', function(){
			this.init();
			if(!this.isUseTabs() && (this.fly || this.pageMode && this.pageMode == "listdetails"))
				this.fireEvent('afterPageReady', this, this.proxy, this.id);
		}, this, {single: true});
		Runner.util.ScriptLoader.load();
	},
	
	calcPageDimensions: function(html)
	{
		var divContainer = $('<div></div>');
		$(html).appendTo(divContainer);
		divContainer.css({
			'position': 'absolute',
			'left': '-10000px',
			'top': '-10000px'
		});
		divContainer.appendTo('body');  
		var yuiPanelWidth = divContainer.width() + 30;
		var yuiPanelHeight = divContainer.height() + 70;
		
		//if used tabs
		var div_content = $('.yui-content', divContainer);
		if (div_content.height() != null){
			yuiPanelHeight = yuiPanelHeight - div_content.height() + $('div',div_content).height()+10;
		}
		
		divContainer.remove();
//	alter panel by the window size
		var winDim = Runner.getWindowDimensions();
		var minWidgetMargin = 30;
		if (winDim.width - 2 * minWidgetMargin < yuiPanelWidth){
			yuiPanelWidth = winDim.width - 2 * minWidgetMargin;
			yuiPanelHeight += 15;
		}
		if (winDim.height - 2 * minWidgetMargin < yuiPanelHeight){
			yuiPanelHeight = winDim.height - 2 * minWidgetMargin;
			yuiPanelWidth += 10;
		}
		if(yuiPanelWidth<300)
		yuiPanelWidth = 300;
		
		if($.browser.msie){
			var ckDim = Runner.pages.PageSettings.getRTECKDim(this.tName);
			if(ckDim){
				if(yuiPanelHeight < yuiPanelHeight + ckDim.nHeight){
					yuiPanelHeight += ckDim.nHeight;
				}
			}
		}
		
		return {width: yuiPanelWidth, height: yuiPanelHeight};
	},
	
	initFlyMobile: function(){
		if (!this.fly){
			return false;
		}
		var bodyContDOM = $(this.bodyCont);
		var bricksForMobileFly = this.getBrickObjs('',false,true);
		for(var i = 0, l = bricksForMobileFly.length; i<l; i++){
			if (!bricksForMobileFly[i].elem.hasClass("runner-hiddenbrick")){
				this.bricksForMobileFly.push(bricksForMobileFly[i]);
				this.hideBrick(bricksForMobileFly[i].name);
			}
		}
		
		this.showBricks(["flypanel_mobile"]);
		this.replaceBrickContentHTMLWith("flypanel_mobile", this.bodyCont);
		
		var pageObj = this;
		$('#closefly').bind('click', function(e){
			var tName = pageObj.tName, pageId = pageObj.pageId;
			Runner.pages.PageManager.unregister(tName, pageId);
		});
	},
	
	// Dummy for function which setting flag for popup editing.
	// This dummy overrides in EditPage.
	setRecountFlagForPopup: function() {},
	
	initFly: function(){
		if (!this.fly){
			return false;
		}
		if (this.afterClose){
			this.on({'afterClose': this.afterClose});
		}
		
		var self = this,
			parentPage = Runner.pages.PageManager.getById(this.baseParams.parId);
		
		if(parentPage && parentPage.pageType == Runner.pages.constants.PAGE_LIST){
			for(var dpObj in parentPage.dpObjs){
				parentPage.dpObjs[dpObj].closeDetails(null, parentPage.dpObjs[dpObj].getRowById(this.baseParams.rowId));
			}
		}
		// we need to recount children if popup closed by cross-button (didn't saved) and details count changed 
		this.on({'afterClose': function(){ 
				if(self.needToRecountChildAfterPopup){
					for(var dpObj in parentPage.dpObjs){
						parentPage.dpObjs[dpObj].getChildRecNum(
							parentPage.dpObjs[dpObj].getRowById(self.baseParams.rowId).masterKeys,
							self.baseParams.rowId);
					}
				}
			}
		});
		$(this.bodyCont).filter('style').appendTo('head');
		
		var args = {
				centered: true,
				modal: this.modal,
				render: true,
				bodyContent: this.bodyCont,
				headerContent: this.headerCont,
				footerContent: this.fotterCont
			};
		
		if (this.destroyOnClose){
			this.on('afterClose', function(){
				var tName = this.tName, 
					pageId = this.pageId;
				Runner.pages.PageManager.unregister(tName, pageId);
			}, this);
		}
		
		this.on('afterCreateFlyWin', function(){
			var self = this;
			this.loadFiles();
			setTimeout(function(){ 
				Runner.pages.PageManager.correctYUIWindowSize(self.tName, self.pageId);
					if(Runner.isIE){
						$('.sudoslider', self.pageCont).each(function(){
							$('ul li:first img', this).css("list-style-type", "none");
						});
					}
			}, 1000);
		}, this);
		
		this.on('closeFlyWin', function(){
			this.destroyVideo();
			this.fireEvent('afterClose');
		}, this);
		
		//create fly win with yui panel
		Runner.pages.PageManager.createFlyWin.call(this, args, true);
		
		return true;
	},
	
	/**
	 * Destroy fly win panel
	 * @param {object} fly win
	 * @intellisense
	 */
	destroyWin: function(win){
		if(!win){
			win = this.win;
		}
		if(win){
			var self = this;
			setTimeout(function(){
				win.destroy(true);
				if(self.win){
					self.win = null;
				}
			}, 5);
		}
	},
	/**
	 * Close fly window page if ESC button was pressed 
	 * @param {object} event
	 * @intellisense
	 */
	escWin: function(e){
		if(e.which == 27){
			$('.yui3-button-close').each(function(){
				$(this).click();
			});	
		}
	},
	/**
	 * Close page
	 * @intellisense
	 */	
	close: function(){
		if ((this.fly) && (Runner.isMobile)){
			this.replaceBrickHTMLWith('flypanel_mobile','');
			for(var i = 0, l = this.bricksForMobileFly.length; i<l; i++){
				if (this.bricksForMobileFly[i].name != "message")
					this.showBrick(this.bricksForMobileFly[i].name);
			}
			this.hideBrick("flypanel_mobile");
			return true;
		}
		if (!this.win){
			return false;
		}
		this.destroyWin();
		return true;
	},
	
	initEvents: function(){
		var tName = this.tName;
		if (this.createAsDefault){
			tName = 'global';
		}
		var events = Runner.pages.PageSettings.getTableData(tName, "events", {}),
			eventHnArr,
			i;
		if(this.pageType == Runner.pages.constants.PAGE_PRINT){
			var printEvents = Runner.pages.PageSettings.getTableData(this.tName, "events", {});
			for(var pType in printEvents){
				if (pType != this.pageType)
					continue;
				if(typeof events[pType] == 'undefined')
					events[pType] = {};
				for(var evName in printEvents[pType])
					events[pType][evName] = printEvents[pType][evName];
			}
		}
		
		for(var pType in events){
			if (pType != this.pageType){
				continue;
			}
			for(var evName in events[pType]){
				eventHnArr = events[pType][evName];
				for(i=0;i<eventHnArr.length;i++){
					this.on(evName, eventHnArr[i].hn,  eventHnArr[i].scope || this);
				}
			}
		}
	},
	
	addSettings: function(settings){
		Runner.pages.PageSettings.addSettings(settings, this.tName, this.pageType);
	},
	
	/**
	 * Controls Class fabric with lazy initialization
	 * may be should be a function in Runner.controls.FileControl and just used here
	 * @intellisense
	 */
	initControls: function(){
		this.controlsMap.controls = this.controlsMap.controls || [];
		for(var i=0; i<this.controlsMap.controls.length; i++){
			this.controlsMap.controls[i].table = this.tName;
			var ctrl = Runner.controls.ControlFabric(this.controlsMap.controls[i], this.pageType);
		}
	},

	/**
	 * View controls Class fabric with lazy initialization
	 * @intellisense
	 */
	initViewControls: function(){
		if(typeof this.viewControlsMap != "undefined"){
			if(typeof this.viewControlsMap.controls != "undefined"){
				for(var i = 0; i < this.viewControlsMap.controls.length; i++){
					this.viewControlsMap.controls[i].table = this.tName;
					var ctrl = Runner.viewControls.ViewControlFabric(this.viewControlsMap.controls[i], this.pageType, this.pageCont, this);
					ctrl.init();
				}
			}
			if(Runner.pages.PageSettings.getTableData(this.tName, "hasMasterList") 
					&& typeof this.viewControlsMap.mViewControlsMap != "undefined"
					&& typeof this.viewControlsMap.mViewControlsMap.controls != "undefined"){
				var masterVCM = this.viewControlsMap.mViewControlsMap;
				for(var i = 0; i < masterVCM.controls.length; i++){
					masterVCM.controls[i].table = this.tName;
					var ctrl = Runner.viewControls.ViewControlFabric(masterVCM.controls[i], this.pageType, $('.runner-b-masterlistfields'), { getBrickObjs: function() { return [];}});
					ctrl.init();
				}
			}
		}
	},

	initLookups: function(){
		var pageCtrls = Runner.controls.ControlManager.getAt(this.tName, this.pageId);
		// init dependeces and preload
		for(var i=0; i<pageCtrls.length; i++){
			if (!pageCtrls[i].isLookupWizard){
				continue;
			}
			if (pageCtrls[i].parentFieldName && pageCtrls[i].skipDependencies !== true){
				var parentCtrl = Runner.controls.ControlManager.getAt(this.tName, this.pageId, pageCtrls[i].parentFieldName);
				pageCtrls[i].setParentCtrl(parentCtrl); 
				if (parentCtrl && parentCtrl.isLookupWizard){
					parentCtrl.addDependentCtrls([pageCtrls[i]]);
				}
			}
		}
	},
	
	/**
	 * Is use tabs on page
	 *
	 * If we have no tabs then controlsMap.tabs will be an empty array. So, controlsMap.tabs.length will be defined and equals 0
	 * In other way, If tabs are present, controlsMap.tabs will be an object. So, controlsMap.tabs.length will be undefined.
	 * Sections behaviour would be the same. 
	 
	 * @return {boolean}
	 * @intellisense
	 */
	isUseTabs: function(){
		if(typeof this.controlsMap.tabs !== 'undefined'){
			if(typeof this.controlsMap.tabs.length == 'undefined'){
				return true;
			}
		}	
		return false;
	},
	
	/**
	 * Init Tabs and Sections
	 * @intellisense
	 */
	initTabs: function(){
		if(this.isUseTabs()){
			// init tabs
			this.tabs = {};
			var self = this;
			this.Y.use('tabview', function(Y) {
				var tabs = self.controlsMap.tabs;
				for(var tabGroup in tabs){
					self.tabs[tabGroup] = new Y.TabView({
						srcNode:'#'+tabGroup
					});
					self.tabs[tabGroup].render();
					self.tabs[tabGroup].on('selectionChange', function(e){
						$(e.prevVal.get("srcNode")._node).closest('li').removeClass('selected')
						$(e.newVal.get("srcNode")._node).closest('li').addClass('selected');
						if(Runner.isIE){
							setTimeout(function(){
								self.resizeSliders($(e.newVal.get("panelNode")._node));
							}, 50);
						}	
					});
				}
				self.initForTabs();	
			});
		}
		
		if(typeof this.controlsMap.sections.length == 'undefined'){
			// init sections
			var sections = this.controlsMap.sections, pageObj = this;
			for(var secId in sections){
				(function(secId){
					$("#"+secId+"Butt").bind("click", function(e){
						if ($(this).attr("src") == Runner.pages.constants.MINUS_GIF){
							$("#"+secId).hide();
							$(this).attr("src", Runner.pages.constants.PLUS_GIF);
						}else{
							$("#"+secId).show();
							$(this).attr("src", Runner.pages.constants.MINUS_GIF);
							if(Runner.isIE)
								setTimeout(function(){
									pageObj.resizeSliders($("#"+secId));
								}, 50);
						}
					});
				})(secId);
			}
		}
	},
	
	initCustomButtons: function(){
		
		if (!Runner.pages.PageSettings.getTableData(this.tName, "isUseButtons")){
			return false;
		}
		Runner.util.ScriptLoader.addJS(['include/json.js']);
		/*if (Runner.debugMode === true){
			Runner.util.ScriptLoader.addJS(['include/runnerJS/RunnerEvent.js']);
			Runner.util.ScriptLoader.addJS(['include/runnerJS/button.js'],'include/runnerJS/RunnerEvent.js');
			Runner.util.ScriptLoader.addJS(['include/runnerJS/events/pageevents_'+this.shortTName+'.js'],'include/runnerJS/button.js');	
		}*/
	},
	
	/**
	 * Set focus to the first controls
	 * @param {integer} page id
	 * @intellisense
	 */
	setFirstFocus: function(id){
		var controls = "", contin = false, ctrls = Runner.controls.ControlManager.getAt(this.tName);
		$("span[id^=edit" + (id != undefined ? id : this.id) + "_]").each(function(){
			if(!contin){
				for(var i=0, l = ctrls.length; i<l; i++){
					if(ctrls[i]!=undefined){
						if(ctrls[i].spanContId == this.id && $(this).css("display")!="none" && ctrls[i].inputType!="hidden"){
							ctrls[i].setFocus();
							contin = true;
						}
					}
				}
			}
		});
	},
	
	/**
	 * Get checked checkboxes
	 * @param {int} id - pageid 
	 * @return {array}
	 * @intellisense
	 */
	getSelBoxes: function(id){
		var selBoxes = new Array();
			$('input[type=checkbox][id^=check'+id+'_]').each(function (){
				if (this.checked){
					selBoxes.push(this);
				}
			});		
		return selBoxes;
	},
	
	/**
	 * Clone form elements
	 * Now using only for clone elements from grid
	 * @param {object}   
	 * @return {array}
	 * @intellisense
	 */
	cloneFormElements: function(elems){
		var cloneElems = new Array();
		$(elems).each(function(i,n){
			if(n.type == "checkbox" && !n.checked)
				return;
			var cln = $('<input type=hidden>');
			cln.attr('name',$(n).attr('name'));
			cln.val($(n).val());
			cloneElems.push(cln);
		});
		return cloneElems;
	},
	
	/**
	 * Show field by name on current page
	 * @param {string} name of field
	 * @param {object} page container (if need another) 
	 * @intellisense
	 */
	showField: function(fieldName){
		this.toggleClassToFields(this.getSelectorForHideField(fieldName), this.pageCont, true);
		var ctrl = Runner.getControl(this.pageId, fieldName);
		if(ctrl)
			ctrl.hiddenByField = false;
	},
	
	/**
	 * Add or remove CSS-class wich hide fields
	 * @param {string} selector for hiding elemets
	 * @param {object} page wich contains elements 
	 * @param {bool} true if need to show elements
	 * @returns
	 * @intellisense
	 */
	toggleClassToFields: function(selector, pageCont, addNeeded){
		var pageObj = this;
		$(selector, pageCont).each(function(){
			addNeeded ? $(this).removeClass('runner-hiddenfield') : $(this).addClass('runner-hiddenfield');
			pageObj.toggleParentRow(this, addNeeded);
		});
	},
	
	/**
	 * Toggle parent row display setting for element 
	 * @param {DOMElement} element
	 * @param {bool} true if need to show element
	 * @returns
	 * @intellisense
	 */
	toggleParentRow: function (element, showNeeded){
		$(element).parents().each(function(){
			if($(this).hasClass('runner-toprow') || $(this).hasClass('runner-bottomrow'))
				return false;
			if($(this).hasClass('runner-row')){
				showNeeded ? $(this).removeClass('runner-hiddenrow') : $(this).addClass('runner-hiddenrow');
				return false;
			}
		});
	},
	
	/**
	 * Make jQuery selector for showField and hideField functions
	 * @param fieldName
	 * @returns
	 * @intellisense
	 */
	getSelectorForHideField: function(fieldName){
		var goodFieldName = Runner.goodFieldName(fieldName);
		return '.fieldlabel_' + goodFieldName + ', .fieldcontrol_' + goodFieldName + ', .fieldoption_' + goodFieldName + ', .fieldvalue_' + goodFieldName; 
	},
	
	/**
	 * Hide field by name on current page
	 * @param {string} name of field
	 * @param {object} page container (if need another) 
	 * @intellisense
	 */
	hideField: function(fieldName){
		this.toggleClassToFields(this.getSelectorForHideField(fieldName), this.pageCont, false);
		var ctrl = Runner.getControl(this.pageId, fieldName);
		if(ctrl)
			ctrl.hiddenByField = true;		
	},
	
	/**
	 * Check presence of visible children in element
	 * @param {object} element which children needs to check
	 * @returns {bool} true, if at least one visible child present 
	 * @intellisense
	 */
	hasVisibleElements: function(element){
		var result = false, pageObj = this;
		$(element).children().each(function(){
			var element = $(this); 
			if(element.hasClass('runner-hiddenfield'))
				return false;
			if(!element.is('table, tbody, tr, td, th') && element.css('display') != 'none'){
				result = true;
				return false;
			}
			var tresult = pageObj.hasVisibleElements(this);
			if(tresult){
				result = true;
				return false;
			}
		});
		return result;
	},
	
	/**
	 * Hide array of bricks by name on current page
	 * @param {array} names of bricks (without runner-b-)
	 * @intellisense
	 */
	hideBricks: function(arrOfNames){
		for(var i = 0, l = arrOfNames.length; i<l; i++){
			this.hideBrick(arrOfNames[i]);
		}
	},
	
	/**
	 * Hide bricks by name on current page
	 * @param {string} name of brick (without runner-b-)
	 * @intellisense
	 */
	hideBrick: function(name){
		var brickObjs = this.getBrickObjs(name);
		for(var i = 0, l = brickObjs.length; i<l; i++){
			brickObjs[i].hide();
		}
	},
	
	/**
	 * Show array of bricks by name on current page
	 * @param {array} names of bricks (without runner-b-)
	 * @intellisense
	 */
	showBricks: function(arrOfNames){
		for(var i = 0, l = arrOfNames.length; i<l; i++){
			this.showBrick(arrOfNames[i]);
		}
	},
	
	/**
	 * Show bricks by name on current page
	 * @param {string} name of brick (without runner-b-)
	 * @intellisense
	 */
	showBrick: function(name){
		var brickObjs = this.getBrickObjs(name);
		for(var i = 0, l = brickObjs.length; i<l; i++){
			brickObjs[i].show();
		}
	},
	
	/**
	 * Show bricks by name on current page for Mobile version
	 * @param {string} name of brick (without runner-b-)
	 * @param {string} name of container (without runner-c-)
	 * @intellisense
	 */
	showBrickMobile: function(name, contName){
		var brickObjs = this.getBrickObjs(name,contName);
		for(var i = 0, l = brickObjs.length; i<l; i++){
			brickObjs[i].show();
		}
	},
	
	
	/**
	 * Get objects for array of bricks by name on current page
	 * @param {array} names of bricks (without runner-b-)
	 * @intellisense
	 */
	getBricksObjs: function(arrOfNames){
		var bricksObjs = {};
		for(var i = 0, l = arrOfNames.length; i<l; i++){
			bricksObjs[arrOfNames[i]] = this.getBrickObjs(arrOfNames[i]);
		}
		return bricksObjs;
	},
	
	/**
	 * Get all brick objects by name on current page
	 * @param {string} name of brick (without runner-b-)
	 * @param {object} page container (if need another) 
	 * @param {boolean} get all bricks objs in pageCont or not 
	 *
	 * @return {array} of brick objects
	 * @intellisense
	 */
	getBrickObjs: function(name, pageCont, all){
		all = all || false;
		name = name || '';
		pageCont = pageCont || this.pageCont;
		
		var crit = all ? '[class*=runner-b-]' : '.runner-b-' + name,
			dpPar = $(pageCont).closest('td.dpinline'),
			flyWin = $(pageCont).closest('div.yui3-panel'),
			brickObjs = [];
		
		$(crit, pageCont).each(function(){
			if(!flyWin.length && $(this).closest('div.yui3-panel').length){
				return;
			}
			if(!dpPar.length && $(this).closest('td.dpinline').length){
				return;
			}
			if(dpPar.length && $(this).closest('td.dpinline')[0]!=dpPar[0]){
				return;
			}
			brickObjs.push(new Runner.bricks.Brick({
				name: name,
				elem: $(this),
				pageCont: pageCont
			}));
		});
		return brickObjs;
	},
	
	/**
	 * Get first founded brick elem by name on current page
	 * @param {string} name of brick (without runner-b-)
	 * @return {mixed} jQuery object or false
	 * @intellisense
	 */
	getBrickElem: function(name){
		var bricksArr = this.getBrickObjs(name);
		if(!bricksArr.length){
			return false;
		}else{
			return bricksArr[0].elem
		}	
	},
	
	/**
	 * Get brick grid elem on current page
	 * @return {mixed} jQuery object or false
	 * @intellisense
	 */
	getBrickGridElem: function(){
		var bricksArr = this.getBrickObjs('grid');
		for(var i=0, l=bricksArr.length; i<l; i++){
			if(!bricksArr[i].elem.closest('.runner-b-masterinfo').length){
				return bricksArr[i].elem;
			}
		}
		return false;
	},
	
	/**
	 * Get brick contents elem by name on current page
	 * @param {string} name of brick (without runner-b-)
	 * @return {mixed} jQuery object or false
	 * @intellisense
	 */
	getBrickContentsElem: function(name){
		var bricksArr = this.getBrickObjs(name);
		if(!bricksArr.length){
			return false;
		}else{
			return bricksArr[0].contentElem;
		}	
	},
	
	/**
	 * Get bricks html from current page container
	 * @param {mixed} string or object page container
	 * @return {object} {'brick name': 'brick html'}
	 * @intellisense
	 */
	getBricksHtml: function(pageCont){
		var bricksHtml = {};
		if(!pageCont){
			pageCont = this.pageCont;
		}	
		for(i=0,l=this.bricksForReload.length; i<l; i++){
			var brick = $('.runner-b-'+this.bricksForReload[i], pageCont);
			bricksHtml[this.bricksForReload[i]] = { html: brick.html(), isHidden: brick.parent('div').hasClass("runner-hiddencontainer") };
		}
		return bricksHtml;
	},
	
	/**
	 * Replace bricks elements 
	 * @param {object} {brick name : new brick}
	 * @intellisense
	 */
	replaceBricksWith: function(newBricks){
		for(var name in newBricks){
			this.replaceBrickWith(name, newBricks[name]);
		}
	},
	
	/**
	 * Replace brick element
	 * @param {string} brick name 
	 * @param {string} new brick 
	 * @intellisense
	 */
	replaceBrickWith: function(name, newBrick){
		var brickObjs = this.getBrickObjs(name);
		for(var i=0, l=brickObjs.length; i<l; i++){
			brickObjs[i].replaceWith(newBrick);
		}
	},
	
	/**
	 * Replace bricks HTML
	 * @param {object} {brick name : new brick html}
	 * @param {object} object page container
	 * @intellisense
	 */
	replaceBricksHTMLWith: function(newBricksHTML,pageCont){
		for(var name in newBricksHTML){
			this.replaceBrickHTMLWith(name, newBricksHTML[name],pageCont);
		}
	},
	
	/**
	 * Replace brick HTML
	 * @param {string} brick name 
	 * @param {string} new brick html
	 * @intellisense
	 */
	replaceBrickHTMLWith: function(name, newHTML, pageCont){
		if (pageCont){
			var brickObjs = this.getBrickObjs(name, pageCont);
		}else{ 
			var brickObjs = this.getBrickObjs(name);
		}	
		for(var i=0, l=brickObjs.length; i<l; i++){
			brickObjs[i].replaceHTMLWith(newHTML);
		}
	},
	
	
	/**
	 * Replace bricks contents elements
	 * @param {object} {brick name : new brick content}
	 * @intellisense
	 */
	replaceBricksContentsWith: function(newBricksContents){
		for(var name in newBricksContents){
			this.replaceBrickContentWith(name, newBricksContents[name]);
		}
	},
	
	/**
	 * Replace brick content element 
	 * 
	 * @param {string} brick name 
	 * @param {string} new brick content
	 * @intellisense
	 */
	replaceBrickContentWith: function(name, newContent){
		var brickObjs = this.getBrickObjs(name);
		for(var i=0, l=brickObjs.length; i<l; i++){
			brickObjs[i].replaceContentWith(newContent);
		}
	},
	
	/**
	 * Replace bricks contents HTML
	 * @param {object} {brick name : new brick content html}
	 * @intellisense
	 */
	replaceBricksContentsHTMLWith: function(newContentsHTML){
		for(var name in newContentsHTML){
			this.replaceBrickContentHTMLWith(name, newContentsHTML[name]);
		}
	},
	
	/**
	 * Replace HTML for content of brick
	 * 
	 * @param {string} brick name 
	 * @param {string} new brick content html
	 * @intellisense
	 */
	replaceBrickContentHTMLWith: function(name, newHTML){
		var brickObjs = this.getBrickObjs(name);
		for(var i=0, l=brickObjs.length; i<l; i++){
			if (this.fly && Runner.isMobile){
				//for mobile version with add in the fly for brick message
				if (brickObjs[i].elem.closest('.runner-b-flypanel_mobile').length){
					brickObjs[i].replaceContentHTMLWith(newHTML);
				}	
			}else{
				brickObjs[i].replaceContentHTMLWith(newHTML);
			}	
		}
	},

	/**
	 * Display a message
	 * 
	 * @param {string} text
	 * @param {bool} apply message style
	 * @param {bool} apply error style
	 * @intellisense
	 */
	displayMessage: function(text, style, error){
		var messageText = text;
		if(style){
			var errClass = "";
			if(!error){
				errClass = "mess_ok";
			}	
			messageText = this.getMessageText("<div class='message " + errClass + "'>" + text + "</div>");
		}
		this.replaceBrickContentHTMLWith('message', messageText);
	},
	
	/**
	 * Display half of prepared message to show
	 * @param {string} text
	 * @intellisense
	 */
	displayHalfPreparedMessage: function(text){
		this.replaceBrickContentHTMLWith('message', this.getMessageText(text));
	},
	
	/**
	 * Get prepared message text
	 * @param {string} text
	 * @intellisense
	 */
	getMessageText: function(text){
		return "<div class='runner-message'>" + text + "</div>";
	},
	
	/**
	 * Get search controller object
	 * @return {object}
	 * @intellisense
	 */
	getSearchController: function(){
		return this.searchController;
	},
	
	settings: function(){
		this.getFieldData = function(tName, fName, key){
			if (typeof settings.tableSettings[tName]["fieldSettings"][fName] != 'undefined' 
				&& typeof settings.tableSettings[tName]["fieldSettings"][fName][key] != 'undefined'){
				return this.returnData(settings.tableSettings[tName]["fieldSettings"][fName][key]);
			}else{
				return  this.returnData(Runner.pages.Defaults.getFieldSettings(key));
			}
		};
	}
});

/**
 * Search page class
 */

Runner.pages.SearchPage = Runner.extend(Runner.pages.RunnerPage, {
	
	constructor: function(cfg){
		Runner.pages.SearchPage.superclass.constructor.call(this, cfg);	
	},
	
	init: function(){
		Runner.pages.SearchPage.superclass.init.call(this);
		this.initButtons();
		this.initSearch();
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	initButtons: function(){
		var pageObj = this;
		//$("#searchButton"+this.pageId)
		$("a[id=searchButton"+this.id+"]").bind("click", function(e){
			pageObj.searchController.submitSearch();
		});
		
		//$("#resetButton"+this.pageId)
		$("a[id=resetButton"+this.id+"]").bind("click", function(e){
			pageObj.searchController.clearCtrls();
		});
		
		$("a[id=backButton"+this.id+"]").bind("click", function(e){
			pageObj.searchController.returnSubmit();
		});	
	},
	
	initSearch: function(){
		this.searchController = new Runner.search.SearchForm({
			id: this.pageId,
			tName: this.tName,
			fNamesArr: this.controlsMap.search.allSearchFields,
			shortTName: this.shortTName,
			usedSrch: this.controlsMap.search.isUsedSearch,
			searchType: 'advanced',
			panelSearchFields: this.controlsMap.search.panelSearchFields,
			pageType: this.controlsMap.search.submitPageType,
			baseParams: this.controlsMap.search.baseParams || {},
			useSuggest: Runner.pages.PageSettings.getTableData(this.tName, "ajaxSuggest"),
			shortTName: Runner.pages.PageSettings.getShortTName(this.tName)
		});
		
		this.searchController.init(this.controlsMap.search.searchBlocks);
	}
});
Runner.pages.ViewPage = Runner.extend(Runner.pages.RunnerPage, {
	
	keys: null,
	
	keyFields: null,
	
	prevKeys: null,
	
	nextKeys: null,
	
	pageType: Runner.pages.constants.PAGE_VIEW,
	
	constructor: function(cfg){
		Runner.pages.ViewPage.superclass.constructor.call(this, cfg);
		
		this.keys = cfg.keys || Runner.pages.PageSettings.getTableData(this.tName, 'keys');
		this.keyFields = cfg.keyFields || Runner.pages.PageSettings.getTableData(this.tName, 'keyFields');
		this.prevKeys = Runner.pages.PageSettings.getTableData(this.tName, 'prevKeys');
		this.nextKeys = Runner.pages.PageSettings.getTableData(this.tName, 'nextKeys');
	},
	
	init: function(){
		Runner.pages.ViewPage.superclass.init.call(this);
		this.initButtons();
		this.initTabs();
		if(!this.isUseTabs()){
			this.fireEvent('afterInit', this, this.proxy, this.id);
		}
	},
	
	initForTabs: function(){
		Runner.pages.ViewPage.superclass.initForTabs.call(this);
		this.initMap();
		if(!Runner.isMobile){
			this.initDetails();
		}
		if(this.isUseTabs()){	
			this.fireEvent('afterInit', this, this.proxy, this.id);
			this.fireEvent('afterPageReady', this, this.proxy, this.id);
		}
	},
	
	initFly: function(){
		if (Runner.pages.ViewPage.superclass.initFly.call(this)){
			this.on('afterCreateFlyWin', function(){
				var images = $(this.win.bodyNode.getDOMNode()).find('img[src*="imager.php"]'),
					src;
				for(var j=0; j<images.length; j++){
					src = $(images[j]).attr('src');
					if (src && src.indexOf('?') != -1){
						$(images[j]).attr('src', (src + "&rndVal=" + Math.random()));
					}else{
						$(images[j]).attr('src', (src + "?rndVal=" + Math.random()));
					}
				}
			}, this);
		}		
	},
	
	initButtons: function(){
		var pageObj = this;
		
		$("a[id=nextButton"+this.id+"]").bind("click", function(e){
				window.location.href = Runner.pages.getUrl(pageObj.tName, pageObj.pageType, pageObj.nextKeys);
			});
		
		$("a[id=prevButton"+this.id+"]").bind("click", function(e){
				window.location.href = Runner.pages.getUrl(pageObj.tName, pageObj.pageType, pageObj.prevKeys);
			});
		
		$("a[id=backButton"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
				window.location.href = Runner.pages.getUrl(pageObj.tName, Runner.pages.constants.PAGE_LIST)+"?a=return";
		});
	},
	
	initMap: function(){
		if (!this.controlsMap.gMaps || !this.controlsMap.gMaps.isUseGoogleMap){
			return false;
		}
		
		var showViewInPopup = Runner.pages.PageSettings.getTableData(this.tName, "showViewInPopup") && !Runner.isMobile;
		
		var initMaps = function(){		
			this.mapManager = new Runner.controls.MapManager(this.controlsMap.gMaps);
			
			this.mapManager.init();
		}
		
		if(window.GlobalGmapLoader){
			GlobalGmapLoader.onLoad(initMaps,this);
		}	
	},
	
	initDetails: function(id){
		if (typeof id == "undefined"){
			id = this.pageId;
		}
		this.dpObjs = {};
		if (Runner.pages.PageSettings.getTableData(this.tName, "isShowDetails") && this.controlsMap.dpTablesParams){
			var dpTablesParams = this.controlsMap.dpTablesParams;
			for(var i=0;i<dpTablesParams.length;i++){
				this.dpObjs[dpTablesParams[i].tName] = new Runner.util.details.ViewDP({
					id : dpTablesParams[i].id,
					masterTName:this.tName,
					tName: dpTablesParams[i].tName,
					parId: this.id,
					controlsMap: this.controlsMap.dControlsMap[dpTablesParams[i].tName],
					viewControlsMap: this.viewControlsMap.dViewControlsMap[dpTablesParams[i].tName]
				});
				this.dpObjs[dpTablesParams[i].tName].init();
			}
		}
	}
});
/**
 * Base abstract class for all pages with editing content, add, edit etc.
 */
Runner.pages.EditorPage = Runner.extend(Runner.pages.RunnerPage, {
	
	tabs: null,
	
	form: null,
	
	submitUrl: '',
	
	baseParams: null,
	
	isShowDetails: false,
	
	/**
	 * Indicator whether an error happend during files upload  
	 */
	upploadErrorHappened: false, 
	
	/**
	 * Count of FileFields with multiple uploads which need to be saved.
	 * Dynamic value. Do not edit manualy. 
	 */
	fileFieldsCount: 0,
	
	constructor: function(cfg){
		
		Runner.pages.EditorPage.superclass.constructor.call(this, cfg);
		
		this.submitUrl = Runner.pages.PageSettings.getShortTName(this.tName)+"_"+this.pageType+".php";
		this.isShowDetails = Runner.pages.PageSettings.getTableData(this.tName, "isShowDetails");
		
		this.baseParams = cfg.baseParams || {};
		this.baseParams['id'] = this.id;
		this.baseParams["editType"] = this.baseParams["editType"] || this.editType;
		
		this.addEvents("beforeSave", "afterSave");
		if (this.fly){
			this.baseParams['onFly'] = 1;
		}
	},
	
	destructor: function(){
		Runner.pages.EditorPage.superclass.destructor.call(this);
		if (this.form){
			this.form.destructor();
			this.form = null;
		}
	},
	
	init: function(){
		Runner.pages.EditorPage.superclass.init.call(this);	
		if (this.beforeSave){
			this.on({'beforeSave': this.beforeSave});
		}
		if (this.afterSave){
			this.on({'afterSave': this.afterSave});
		}
		var editorObj = this;
		this.on({'afterSave': function() { editorObj.delDisabledClass($("a[id=saveButton" + editorObj.id + "]")); }});
		this.initButtons();
		this.initTabs();
		if (!Runner.isMobile){
			setTimeout(function(){
				$('div.shiny_box').hide();
			}, 0);
		}
	},
	
	initForTabs: function(){
		Runner.pages.EditorPage.superclass.initForTabs.call(this);
		this.setFirstFocus();
		this.initToolTips();
	},
	
	close: function(){
		Runner.pages.EditorPage.superclass.close.call(this);
		$('div.shiny_box').hide();
	},
	
	isIOSMode: function(){
		return Runner.pages.PageSettings.getTableData(this.tName, "isMobileIOS");
	},
	
	initButtons: function(){
		var pageObj = this;
		if(!pageObj.isIOSMode())
			$("a[id=saveButton"+this.id+"]").bind("click", function(){
				if (!pageObj.isDisabledButton($("#saveButton"+pageObj.id))){
					pageObj.addDisabledClass($("a[id=saveButton" + pageObj.id + "]"));
					pageObj.fileFieldsCount = 0;
					pageObj.upploadErrorHappened = false;
					var controls = Runner.controls.ControlManager.getAt(pageObj.tName, pageObj.pageId);
					//controls is array, not object!
					for(var i=0; i<controls.length; i++){
						if(controls[i].editFormat == Runner.controls.constants.EDIT_FORMAT_FILE
								&& controls[i].filesToUploadCount > 0){
								controls[i].errorHappened = false;
								pageObj.fileFieldsCount++;
								controls[i].uploadForm.bind('fileuploadstopped', { ctrl: controls[i] }, function(e){
									pageObj.fileFieldsCount--;
									$(this).unbind('fileuploadstopped');
									if(e.data.ctrl.errorHappened){
										pageObj.upploadErrorHappened = true;
										pageObj.errorHn();
									}
									else
										pageObj.callSaveHn();
								});
								$(".btn-primary.start", controls[i].uploadForm).click();
						} 
					}
					if(pageObj.fileFieldsCount < 1)
						pageObj.saveHn();
				}
			});
		else
			$("a[id=saveButton" + this.id + "]").bind("click", function(){
				$("#editForm" + pageObj.id).submit();
			});
		$(".container-close").bind("click", function(){
			if(pageObj.useLocking && pageObj.pageType=="edit"){
				pageObj.locking.UnlockRecordInline(pageObj.sKeys);
			}
		});
	},
	
	errorHn:function(row){
		if(this.fileFieldsCount < 1){
			this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
		}
	},
	
	callSaveHn: function (){
		if(this.fileFieldsCount < 1 && !this.upploadErrorHappened)
			this.saveHn();
	},
	
	getForm: function(){
		this.form = new Runner.form.BasicForm({
			submitUrl: this.submitUrl,	
			standardSubmit: !this.fly,
			isFileUpload: true,
			method: 'POST',
			id: this.pageId,
			baseParams: this.baseParams,
			fieldControls: Runner.controls.ControlManager.getVisibleAt(this.tName, this.pageId),
			useMultipart: true,
			submitFailed: {
				fn: function(response, formObj, fieldControls){
					if (response == -1){
						formObj.clearForm();
						this.showError("<< "+Runner.lang.constants.TEXT_INLINE_ERROR+" >>");
					}
					this.fireEvent("afterSave", {success: false, html: response}, formObj, fieldControls, this);
					this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
				},
				scope: this
			},
			beforeSubmit: {
				fn: function(formObj){
					return this.fireEvent("beforeSave", formObj, formObj.fieldControls, this);
				},
				scope: this
			},
			validationFailed: {
				fn: function(formObj, fieldControls, failedControlsArr){
					var fNamesArr = [];
					for(var i=0; i<failedControlsArr.length;i++){
						fNamesArr.push(failedControlsArr[i].fieldName);
					}
					this.openFieldTabsSections(fNamesArr);
					this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
					return false;
				},
				scope: this
			}
		});
	},
	
	saveHn: function(){
		this.getForm();
		this.form.submit();	
	},
	
	openFieldTabsSections: function(fNamesArr){
		// open sections
		if (!Runner.isArray(this.controlsMap.sections)){
			var sections = this.controlsMap.sections;
			for(var secId in sections){
				for(var i=0; i<fNamesArr.length; i++){
					if (sections[secId].isInArray(fNamesArr[i])){
						$("#"+secId).show();
						$("#"+secId+"Butt").attr("src", Runner.pages.constants.MINUS_GIF);
						break;
					}
				}
			}
		}
		if (!Runner.isArray(this.controlsMap.tabs)){
			// open tabs
			var tabs = this.controlsMap.tabs,
				tabInd = 0,
				selected = false;
			
			for(var tabGroup in tabs){
				tabInd = 0;
				selected = false;
				for(var tab in tabs[tabGroup]){
					for(var i=0; i<fNamesArr.length; i++){
						if (tabs[tabGroup][tab].isInArray(fNamesArr[i])){
							this.tabs[tabGroup].selectChild(tabInd);
							selected = true;
							break;
						}
					}
					if (selected){
						break;
					}
					tabInd++;
				}
			}
		}
	},
	
	showError: function(txt, isArr){
		if (txt.length){
			if(typeof isArr == 'undefined' || !isArr){
				this.displayHalfPreparedMessage(txt);
			}else{
				this.getBrickContentsElem('message').empty();
				for(var i=0; i<txt.length;i++){
					this.getBrickContentsElem('message').append(this.getMessageText(txt[i])+(i<txt.length-1 ? '<br>' : ''));
				}
			}
			this.showBrick('message');
		}
	}
});
Runner.pages.AddPageFly = Runner.extend(Runner.pages.EditorPage, {
	
	pageType: Runner.pages.constants.PAGE_ADD,
	
	fName: "",
	
	parentFieldName: "", 
	
	editType: Runner.pages.constants.ADD_ONTHEFLY,
	
	constructor: function(cfg){
		Runner.pages.AddPageFly.superclass.constructor.call(this, cfg);
		this.baseParams["a"] = "added";
		this.submitUrl += "?ferror=1&fly=1&";
	},
	
	init: function(){
		Runner.pages.AddPageFly.superclass.init.call(this);
		this.fireEvent('afterInit', this, this.proxy, this.id);
	}, 
	
	initButtons: function(){
		Runner.pages.AddPage.superclass.initButtons.call(this);	
		$("a[id=cancelButton"+this.id+"]").bind("click", {page: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			e.data.page.close();
		});
	},
	
	getForm: function(){
		Runner.pages.AddPageFly.superclass.getForm.call(this);
		this.form.on('successSubmit', function(respObj, basicForm, fieldControls){
			var evRes = this.fireEvent("afterSave", respObj, basicForm, fieldControls, this);
			if (evRes !== false){
				this.close();
			}
		}, this);
		return this.form;
	},
	
	isIOSMode: function(){
		Runner.pages.AddPageFly.superclass.isIOSMode.call(this);
		return false;
	}
});
Runner.pages.AddPage = Runner.extend(Runner.pages.EditorPage, {
	
	pageType: Runner.pages.constants.PAGE_ADD,
	
	showInPopUp: false,
	
	/**
	 * Keys list for the child tables
	 */
	detailKeys: null,
	
	constructor: function(cfg){
		Runner.pages.AddPage.superclass.constructor.call(this, cfg);
		// fields for add to form add to this.baseParams
		this.baseParams['a'] = "added";
		this.showInPopUp = Runner.pages.PageSettings.getTableData(this.tName, "showAddInPopup") && !Runner.isMobile;
		this.submitUrl += "?ferror=1&";
		if (this.showInPopUp && !Runner.isMobile){
			this.submitUrl += "fly=1&";
		}
	},
	
	init: function(){
		Runner.pages.AddPage.superclass.init.call(this);
		if(!this.isUseTabs()){
			this.fireEvent('afterInit', this, this.proxy, this.id);
		}
	},
	
	initForTabs: function(){
		Runner.pages.AddPage.superclass.initForTabs.call(this);
		if(!Runner.isMobile){
			this.initDetails();
		}
		if(this.isUseTabs()){
			this.fireEvent('afterInit', this, this.proxy, this.id);
			this.fireEvent('afterPageReady', this, this.proxy, this.id);
		}
	},
	
	isInlineAddContentChanged: function(tName){
		return (this.dpObjs[tName].listPageObj.inlineAdd && this.dpObjs[tName].listPageObj.inlineAdd.inlineAddChangeContent)
	},
	
	initDetails: function(id){
		if (typeof id == "undefined"){
			id = this.pageId;
		}
		this.dpObjs = {};
		if (this.isShowDetails && this.controlsMap.dpTablesParams){
			var dpTablesParams = this.controlsMap.dpTablesParams;
			for(var i=0;i<dpTablesParams.length;i++){
				this.dpObjs[dpTablesParams[i].tName] = new Runner.util.details.AddDP({
					id : dpTablesParams[i].id,
					masterTName:this.tName,
					tName: dpTablesParams[i].tName,
					useChildCount: this.fly == true,
					controlsMap: this.controlsMap.dControlsMap[dpTablesParams[i].tName],
					parId: this.id,
					saveFailed: {
						fn: function(detObj, respObj, formObj){
							var failedTables = [],
								firstIncId;
							
							for(var tName in this.dpObjs){
								if(this.isInlineAddContentChanged(tName)){
									if (this.dpObjs[tName].submitMade && !this.dpObjs[tName].submitSucceded){
										failedTables.push(tName);
										firstIncId = firstIncId || this.dpObjs[tName].id;
									}else if(!this.dpObjs[tName].submitMade){
										return;
									}
								}
							}
							//make saved master's fields readonly
							this.form.makeReadonly();
							
							var messArr = [],
								url = document.URL,
								pos, msg, txt;
							// make txt from failedTables
							pos = url.indexOf("#dt"+firstIncId);
							if(pos == -1){
								url = url+"#dt"+firstIncId;
							}
							for(var i=0;i < failedTables.length;i++){
								msg = Runner.lang.constants.TEXT_DETAIL_NOT_SAVED.replace('%s', failedTables[i]); 
								txt = "<div id='_"+this.dpObjs[failedTables[i]].id+"' class='message mes_not'><<< "+msg+" >>> <br><a href='"+url+"' >"+Runner.lang.constants.TEXT_DETAIL_GOTO+" "+failedTables[i]+"</a></div>";
								messArr.push(txt);
							}
							
							this.showError(messArr, true);
						},
						scope: this	
					}
				});
				this.dpObjs[dpTablesParams[i].tName].init();
				this.dpObjs[dpTablesParams[i].tName].on('detailsSaved', function(detObj, allVals, fields, allKeys, allRowIds){
					var detailsSaved = true;
					for(var tName in this.dpObjs){
						if(this.isInlineAddContentChanged(tName) && (!this.dpObjs[tName].submitMade || !this.dpObjs[tName].submitSucceded)){
							detailsSaved = false;
						}else{
							$("#_"+this.dpObjs[tName].id).parent().remove();
						}
					}
					if(!detailsSaved){
						return;
					}
					if(!this.fly){
						if (this.afterAddId){
							var rUrl = Runner.pages.getUrl(this.tName, this.pageType);
							window.location.href = rUrl + ((rUrl.indexOf('?') == -1) ? "?" : "&") + 'afteradd=' + this.afterAddId;
						} else {
							window.location.href = Runner.pages.getUrl(this.tName, this.pageType);
						}
						//this.afterAddRequest();
					}else{
						var parObj = Runner.pages.PageManager.getAt(this.baseParams.table, this.baseParams.parId);
						for(var tName in parObj.dpObjs)
							parObj.dpObjs[tName].getChildRecNum(this.detailKeys[tName]);
						this.close();
					}
				}, this);
			}
		}
	},
	
	initButtons: function(){
		Runner.pages.AddPage.superclass.initButtons.call(this);	
		
		$("a[id=backButton"+this.id+"]").bind("click", {page: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			window.location.href = Runner.pages.PageSettings.getShortTName(e.data.page.tName) + '_' + Runner.pages.constants.PAGE_LIST + '.php?a=return';	
		});
		
		$("a[id=cancelButton"+this.id+"]").bind("click", {page: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			e.data.page.close();
		});
	},
	
	saveHn: function(){
		if (!this.masterSaved){
			Runner.pages.AddPage.superclass.saveHn.call(this);
			return ;
		}
		for(var tName in this.dpObjs){
			this.dpObjs[tName].saveDetails(this.mKeys[tName]);
		}
	},
	afterAddRequest: function(){
		$.post(this.submitUrl,{'afteradd':this.afterAddId});
	},
	
	getForm: function(){
		if(this.form){
			return;
		}
		
		Runner.pages.AddPage.superclass.getForm.call(this);
		this.form.standardSubmit = !this.isShowDetails && !this.fly || Runner.isMobile;
		if(this.isShowDetails && this.editType!=Runner.pages.constants.ADD_ONTHEFLY && !Runner.isMobile){
			this.form.baseParams['editType'] = Runner.pages.constants.ADD_MASTER;
			
			this.form.on('beforeSubmit', function(basicForm){
				var valRes = basicForm.validate();
				if (!valRes){
					this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
					return false;
				}
				// validate details and save, test param 
				for(var tName in this.dpObjs){
					if(this.isInlineAddContentChanged(tName)){
						if (!this.dpObjs[tName].validate()){
							valRes = false;
						}
					}
				}
				if(!valRes)
					this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
				return valRes;
				
			}, this);
			
			this.form.on('successSubmit', function(respObj, basicForm, fieldControls){
				if(respObj.success){
					this.detailKeys = respObj.detKeys;
					this.masterSaved = true;
					this.mKeys = respObj.mKeys;
					this.afterAddId = respObj.afterAddId ? respObj.afterAddId : null;
					
					for(var tName in this.dpObjs){
						this.dpObjs[tName].saveDetails(respObj.mKeys[tName]);
					}
				}else{
					this.showError(respObj.error);
					if(respObj.hideCaptha){
						$('.captcha_block').remove();
					}
					this.showCaptchaErrMessage(respObj.capthca);
				}
				this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
			}, this);
			
			this.form.on('submitFailed', function(){
				this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
			}, this);
		}
		if(typeof this.form.triedToSubmit == 'undefined')
			this.form.on('successSubmit', function(respObj, basicForm, fieldControls){
				var evRes = this.fireEvent("afterSave", respObj, basicForm, fieldControls, this);
				if (evRes !== false && (!this.isShowDetails || Runner.isMobile)){
					this.close();
				}
				else
					this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
			}, this);
	}
});

Runner.pages.EditPage = Runner.extend(Runner.pages.EditorPage, {
	
	keys: null,
	
	keyFields: null,
	
	prevKeys: null,
	
	nextKeys: null,
	
	pageType: Runner.pages.constants.PAGE_EDIT,
	
	details: null,
	
	constructor: function(cfg){
		Runner.pages.EditPage.superclass.constructor.call(this, cfg);
		
		this.keys = cfg.keys || Runner.pages.PageSettings.getTableData(this.tName, 'keys');
		this.keyFields = cfg.keyFields || Runner.pages.PageSettings.getTableData(this.tName, 'keyFields');
		//	sKeys - keys of current record use for locking
		this.sKeys = Runner.pages.PageSettings.getTableData(this.tName, "sKeys", "");
		this.prevKeys = Runner.pages.PageSettings.getTableData(this.tName, 'prevKeys');
		this.nextKeys = Runner.pages.PageSettings.getTableData(this.tName, 'nextKeys');
		this.shortTName = Runner.pages.PageSettings.getShortTName(this.tName);
		this.baseParams['a'] = "edited";
		this.submitUrl += "?ferror=1&";
		if (this.fly) {
			this.submitUrl += "fly=1&";
		}
		
		for(var i=0; i<this.keys.length; i++){
			this.baseParams["editid"+(i+1)] = this.keys[i];
			this.submitUrl += "editid"+(i+1)+"="+this.keys[i]+'&';
		}
		
	},
	
	init: function(){
		Runner.pages.EditPage.superclass.init.call(this);
		this.initLocking();
		if(!this.isUseTabs()){
			this.fireEvent('afterInit', this, this.proxy, this.id);
		}
	},
	
	initForTabs: function(){
		Runner.pages.EditPage.superclass.initForTabs.call(this);
		this.initCtrlEvents();
		if(!Runner.isMobile){
			this.initDetails();
		}
		if(this.isUseTabs()){	
			this.fireEvent('afterInit', this, this.proxy, this.id);
			this.fireEvent('afterPageReady', this, this.proxy, this.id);
		}
	},
	
	initButtons: function(){
		Runner.pages.EditPage.superclass.initButtons.call(this);
		
		var pageObj = this;
		
		$("a[id=resetButton"+this.id+"]").bind("click", function(e){
			pageObj.delDisabledClass($('a[id=prevButton'+pageObj.id+"]"));
			pageObj.delDisabledClass($('a[id=nextButton'+pageObj.id+"]"));
			Runner.controls.ControlManager.resetControlsForTable(pageObj.tName);
			clearTimeout(pageObj.validateTimer);
		});
		
		$("a[id=nextButton"+this.id+"]").bind("click", function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			if(pageObj.useLocking){
				pageObj.locking.UnlockRecord(pageObj.sKeys, '', function(){
					pageObj.nextButtonHref.call(pageObj)});
			}else{
				pageObj.nextButtonHref();
			}	
		});	
		
		$("a[id=prevButton"+this.id+"]").bind("click", function(e){
			if(pageObj.isDisabledButton(this)){
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			if(pageObj.useLocking){
				pageObj.locking.UnlockRecord(pageObj.sKeys, '', function(){
					pageObj.prevButtonHref.call(pageObj)});
			}else{
				pageObj.prevButtonHref();
			}	
		});	
		
		$("a[id=backButton"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			if(pageObj.useLocking){
				pageObj.locking.UnlockRecord(pageObj.sKeys, '', function(){
					pageObj.backButtonHref.call(pageObj)});	
			}else{
				pageObj.backButtonHref();
			}
		});
	},
	
	nextButtonHref: function(){
		window.location.href = Runner.pages.getUrl(this.tName, this.pageType, this.nextKeys);
	},
	
	prevButtonHref: function(){
		window.location.href = Runner.pages.getUrl(this.tName, this.pageType, this.prevKeys);
	},
	
	backButtonHref: function(){
		window.location.href = this.shortTName + '_' + Runner.pages.constants.PAGE_LIST + '.php?a=return';
	},
	
	initCtrlEvents: function(){
		var ctrls = Runner.controls.ControlManager.getAt(this.tName, this.pageId),
			cntrlType, 
			eventName = 'change', 
			singleFire = false, 
			delay = 0;
		
		for (var i = 0; i < ctrls.length; i++){
			
			cntrlType = ctrls[i].getControlType(), eventName = 'change', singleFire = false, delay = 0;
			
			if(cntrlType=='checkbox' || cntrlType=='radio'){
				eventName = 'click';
			}else if(cntrlType=='text' || cntrlType=='password' || cntrlType=='textarea'){
				eventName = 'keyup';
				delay = 60;
				ctrls[i].on('change', this.prevNextButtonHandler, {single: true, timeout: 0, scope: this});
			}else if(cntrlType=='RTE'){
				eventName = 'blur';
				delay = 5000;
			}
			ctrls[i].on(eventName, this.prevNextButtonHandler, {single: singleFire, timeout: delay, scope: this});
		}
	},
	
	prevNextButtonHandler: function(e){
		var pageObj = Runner.pages.PageManager.getAt(this.table, this.id);
		if(arguments.length > 1 && typeof arguments[1] == 'object' && arguments[1].enableNextButtons === false){
			return true;
		}
		//	skip arrows, tab keys
		if(e && (e.type=='keyup' || e.type=='keypress' || e.type=='keydown')){
			if(e.keyCode>=33 /*page up*/ && e.keyCode<=40 /* down arrow */ || e.keyCode==9 /*tab*/)
				return true;
		}
		
		pageObj.addDisabledClass($('a[id=prevButton'+this.id+']'));
		pageObj.addDisabledClass($('a[id=nextButton'+this.id+']'));
		
		return true;
	},
	
	initLocking: function(){
		if(this.useLocking){
			this.locking = new Runner.Locking({
				tName: this.tName,
				pageId: this.id,
				pageType: this.pageType
			});
			var pageObj = this;
			this.on("afterClose", function(e){
				pageObj.locking.UnlockRecord(pageObj.sKeys, '', '');
			}, this);
		  pageObj.locking.StartLocking(pageObj,pageObj.id,pageObj.sKeys,Runner.pages.PageSettings.getTableData(pageObj.tName, "confirmTime"));
		}
	},
	
	initDetails: function(id){
		if (typeof id == "undefined"){
			id = this.pageId;
		}
		this.dpObjs = {};
		if (this.isShowDetails && this.controlsMap.dpTablesParams){
			var dpTablesParams = this.controlsMap.dpTablesParams;
			for(var i=0;i<dpTablesParams.length;i++){
				this.dpObjs[dpTablesParams[i].tName] = new Runner.util.details.EditDP({
					id : dpTablesParams[i].id,
					parId: this.id,
					tName: dpTablesParams[i].tName,
					masterTName: this.tName,
					childRecNum: 0,
					controlsMap: this.controlsMap.dControlsMap[dpTablesParams[i].tName],
					viewControlsMap: this.viewControlsMap && this.viewControlsMap.dViewControlsMap 
						? this.viewControlsMap.dViewControlsMap[dpTablesParams[i].tName] : null,
					useChildCount: this.fly == true,
					saveFailed: {
						fn: function(detObj, respObj, formObj){
							var failedTables = [],
								firstIncId;
							for(var tName in this.dpObjs){
								if (this.dpObjs[tName].submitMade && !this.dpObjs[tName].submitSucceded){
									failedTables.push(tName);
									firstIncId = firstIncId || this.dpObjs[tName].id;
								}else if(!this.dpObjs[tName].submitMade){
									return;
								}
							}
							// make txt from failedTables
							var messArr = [],
								url = document.URL,
								pos = url.indexOf("#dt"+firstIncId),
								msg, txt;
								
							if(pos == -1){
								url = url+"#dt"+firstIncId;
							}	
							for(var i=0;i<failedTables.length;i++){
								msg = Runner.lang.constants.TEXT_DETAIL_NOT_SAVED.replace('%s', failedTables[i]); 
								txt = "<div id='_"+this.dpObjs[failedTables[i]].id+"' class='message mes_not'><<< "+msg+" >>> <br><a href='"+url+"' >"+Runner.lang.constants.TEXT_DETAIL_GOTO+" "+failedTables[i]+"</a></div>";
								messArr.push(txt);
							}
							
							this.showError(messArr, true);
						},
						scope: this
					}
				});
				this.dpObjs[dpTablesParams[i].tName].init();
			}
		}
	},
	
	getForm: function(){
		if(this.form){
			return;
		}
		
		Runner.pages.AddPage.superclass.getForm.call(this);
		if(this.isShowDetails && this.editType!=Runner.pages.constants.ADD_ONTHEFLY){
			
			this.form.on('validationFailed', function(formObj, fieldControls, faildControls){
				
				var failedFNamesArr = [];
				
				for(var i=0; i<faildControls.length;i++){
					failedFNamesArr.push(faildControls[i].fieldName);
				}
				
				this.openFieldTabsSections(failedFNamesArr);
			});
			
			this.form.on('successSubmit', function(respObj, basicForm, fieldControls){
				basicForm.destructor();
				this.form = null;
				if(respObj.success){
					if (!this.fly){
						// reload page
						window.location.href = window.location.href;
					}
				}else{
					
					// show error show error from server at top
					// show invalid captcha
				}
			}, this);
		}
		if(typeof this.form.triedToSubmit == 'undefined')
			this.form.on('successSubmit', function(respObj, basicForm, fieldControls){
				var evRes = this.fireEvent("afterSave", respObj, basicForm, fieldControls, this);
				if (evRes !== false){
					this.needToRecountChildAfterPopup = undefined;
					this.close();
				}
				else
					this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
			}, this);
	},
	
	saveHn: function(){
		if(this.isShowDetails && !Runner.isMobile){	
			this.getForm();
			// validate master and if ok save details
			if (this.form.validate()){
				this.formAlreadySubmitted = false;
				var pageObj = this, 
					hn = function(detObj, allVals, fields, allKeys, allRowIds){
					var detailsSaved = true;
					for(var tName in this.dpObjs){
						if (typeof this.dpObjs[tName].submitMade != "undefined" //(this.dpObjs[tName].inlineAdd || this.dpObjs[tName].inlineEdit) commented for bug #7254
								&& (!this.dpObjs[tName].submitMade || !this.dpObjs[tName].submitSucceded)){
							detailsSaved = false;
						}else{
							$("#_"+this.dpObjs[tName].id).parent().remove();
						}
					}
					if(!detailsSaved || pageObj.formAlreadySubmitted){
						return;
					}
					pageObj.formAlreadySubmitted = true;
					Runner.pages.EditPage.superclass.saveHn.call(this);
				};
				var saveDpInlines = false;
				for(var tName in this.dpObjs){
					this.dpObjs[tName].on('detailsSaved', hn, this, {single: true});
					var sDp = this.dpObjs[tName].saveDetails();
					if(!saveDpInlines){
						saveDpInlines = sDp;
					}
				}
				if(!saveDpInlines){
					Runner.pages.EditPage.superclass.saveHn.call(this);
				}
				this.delDisabledClass($("a[id=saveButton" + this.id + "]"));
			}
		}else{
			Runner.pages.EditPage.superclass.saveHn.call(this);
		}
	},
	
	setRecountFlagForPopup: function() {
		if(this.fly)
			this.needToRecountChildAfterPopup = true;
	}
});


/**
 * Base abstract class for all pages with showing content, list, view etc.
 */
Runner.pages.DataPageWithSearch = Runner.extend(Runner.pages.RunnerPage, {
	/**
	 * Table short name
	 * @type {string}
	 */
	shortTName: "",
	/**
	 * Search Controller 
	 * @type {object} 
	 */
	searchController: null,
		
	constructor: function(cfg){
		Runner.pages.DataPageWithSearch.superclass.constructor.call(this, cfg);
		
		this.shortTName = Runner.pages.PageSettings.getShortTName(this.tName);
	},
		
	init: function(){
		Runner.pages.DataPageWithSearch.superclass.init.call(this);	
		this.initSearch();
		this.initAdvSearch();
		this.initPrintFrLink();
		this.initPrintAll();
		this.initExcelLink();
		this.initWordLink();
		this.initPDFLink();
	},
	
	initForGrid: function(){
		Runner.pages.DataPageWithSearch.superclass.initForGrid.call(this);
		this.initPagination();
	},
	
	largeTextOpenerDelegate: function(e){
		var target = Runner.Event.prototype.getTarget(e);
		if(target.nodeName != "A" || !$(target).attr("query")) {
			return false;
		}
		Runner.Event.prototype.stopEvent(e);
		
		var self = this,
			query = $(target).attr("query"),
			args = {
				render: true,
				headerContent: "&nbsp;",
				footerContent: "&nbsp;"
			};
		
		var closeTextWin = function(fullTextWin){
			fullTextWin.destroy();
		};
		
		var afterCreateTextWin = function(fullTextWin){
			var self = this;
			$.runnerAJAX(query, {id: self.id, rndVal: Math.random()}, function(respObj){
				if (respObj.success){
					fullTextWin.set('bodyContent', respObj.textCont);
				}else{
					fullTextWin.set('bodyContent', respObj.error || "Server error");
				}
				fullTextWin.render();
				// correct YUI window size
				Runner.pages.PageManager.correctYUIWindowSize(self.tName, self.pageId, true, fullTextWin);
			});
		};
				
		//create fly win yui panel
		Runner.pages.PageManager.createFlyWin.call(this, args, false, afterCreateTextWin, closeTextWin);
	},
	
	initSearch: function(){
		if (!this.controlsMap.search){
			return false;
		}
		this.searchController = new Runner.search.SearchController({
			id: this.pageId,
			tName: this.tName,
			fNamesArr: this.controlsMap.search.allSearchFields,
			shortTName: this.shortTName,
			usedSrch: this.controlsMap.search.usedSrch,
			panelSearchFields: this.controlsMap.search.panelSearchFields,
			useSuggest: Runner.pages.PageSettings.getTableData(this.tName, "ajaxSuggest"),
			pageType: this.pageType
		});
		
		this.searchController.init(this.controlsMap.search.searchBlocks);
	},
	
	initPagination: function(){
		// add delegated events to pagination links
		$("table[name=paginationTable"+this.pageId+"]").bind("click", {pageObj: this}, function(e){
			Runner.Event.prototype.stopEvent(e);	
			var target = Runner.Event.prototype.getTarget(e);
			if(target.nodeName != "A") {
				return false;
			}
			var pageNum = $(target).attr("pageNum"),
				pageObj = e.data.pageObj;
			var url = Runner.pages.getUrl(pageObj.tName, pageObj.pageType)+"?goto="+pageNum;
			window.location.href = url;
		});
	},
	
	initAdvSearch: function(){
		var pageObj = this;
		$("a[id=advButton"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_search.php";
		});
	},
	
	initPrintFrLink: function(){
		var pageObj = this;
		$("a[id=print_"+this.pageId+"]").bind("click", function(e){
			window.open(pageObj.shortTName + "_print.php",'wPrint');
		});
	},
	
	initPrintAll: function(){
		var pageObj = this;
		$("a[id=printAll_"+this.pageId+"]").bind("click", function(e){
			window.open(pageObj.shortTName + "_print.php?all=1",'wPrint');
		});
	},
	
	initExcelLink: function(){
		var pageObj = this;
		$("a[id=export_to_excel"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_print.php?all=1&format=excel";
		});
	},
	
	initWordLink: function(){
		var pageObj = this;
		$("a[id=export_to_word"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_print.php?all=1&format=word";
		});
	},
	
	initPDFLink: function(){
		var pageObj = this;
		$("a[id=export_to_pdf"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_print.php?all=1&format=pdf";
		});
	}
});
/**
 * Base abstract class for all pages with showing content, list, view etc.
 */
Runner.pages.ListPageCommon = Runner.extend(Runner.pages.DataPageWithSearch, {
	/**
	 * Grid element 
	 * Get with method getBrickGridElem only after resize
	 * @type {object}
	 */
	gridElem: null,
	
	isScrollGridBody: false,
	
	recsPerRowList: false,
	
	heightScrollGridBody: 0,
		
	constructor: function(cfg){
		Runner.pages.ListPageCommon.superclass.constructor.call(this, cfg);
		
		this.permis = Runner.pages.PageSettings.getTableData(this.tName, "permissions");
		
		this.isScrollGridBody = this.isScrollingGrid();
		
		this.recsPerRowList = Runner.pages.PageSettings.getTableData(this.tName, "recsPerRowList");
	},
		
	init: function(){
		this.initGridElem();
		this.initResize();
		Runner.pages.ListPageCommon.superclass.init.call(this);	
		this.initSelectAll();
		
	},
	
	initForGrid: function(){
		Runner.pages.ListPageCommon.superclass.initForGrid.call(this)
		this.initGridHover();
		this.initHeaderCheckBox();
		this.initInline();
		this.initMaps();
	},
	
	initGridElem: function(){
		this.gridElem = this.getBrickGridElem();
		$(this.gridElem).unbind("click").bind("click", this.gridClickHn.createDelegate(this, [], true));
		$(this.getBrickElem('masterinfo')).unbind("click").bind("click", this.gridClickHn.createDelegate(this, [], true));
	},
	
	/**
	 * Init functionality for page after tabs loading
	 * @intellisense
	 */
	initForTabs: function(){
		this.initControls();
		if (!this.useResize) {
			this.initViewControls();
		}
		this.initLookups();
		if(this.isUseTabs())
			this.fireEvent('afterPageReady', this, this.proxy, this.id);
	},
	
	/**
	 * Cover of inlineEdit object function
	 * If inlineEdit is turn off, then get recsId by another way
	 */	
	getRecsId: function(){
		if(!this.inlineEdit){
			var recsId = {};
			$('.runner-row:not(.gridRowAdd)', this.gridElem).not(function(i){
				if(!$(this).closest('td.dpinline').length){
					var attrId = $(this).attr('id'),
						lastInd = attrId.lastIndexOf('w');
					recsId[++i] = parseInt(attrId.substr(lastInd + 1));
				}
			});	
			return recsId;
		}
		return this.inlineEdit.getRecsId();
	},
	
	gridClickHn: function(e){
		this.largeTextOpenerDelegate(e);
	},
	
	initResize: function(){
		if (Runner.isMobile){
			return false;
		}
		if(this.useResize){
			var self = this;
			this.Y.use('cookie', 'json-parse', 'json-stringify', 'datatable-base', 'resize', function(Y){
				if(!self.resizeGrid){
					self.resizeGrid = new Runner.resize.Grid({
						tName: self.tName,
						pageId: self.pageId
					});
				}
				self.resizeGrid.init();
				self.initGridElem();
				self.initForGrid();
			});
		}
	},
	
	initHeaderCheckBox: function(pageId){
		//id can be not need
		pageId = pageId || this.id;
		$('.chooseAll'+pageId).unbind("click").bind("click", function(e){
			var that = this;
			//set checked/unchecked for all checkbox in grid rows
			$('input[type=checkbox][id^=check'+pageId+'_]').each(function(){
				this.checked = that.checked;
			});
			//set checked/unchecked for all chooseAll checkboxes
			$('input[type=checkbox][id^=chooseAll_'+pageId+']').each(function(){
				this.checked = that.checked;
			});
		});
	},
	
	initSelectAll: function(){
		var pageObj = this,
			selectAll = $('#select_all'+this.id);
			
		if (!selectAll.length){
			return false;
		}
		selectAll[0].checkAllStatus = false;
		selectAll.bind("click", function(e){
			var that = this;
			this.checkAllStatus = !this.checkAllStatus;
			$('input[type=checkbox][id^=check'+pageObj.id+'_]').each(function(){
				this.checked = that.checkAllStatus;
			});
			
			return false;
		});
	},
	
	initGridHover: function(){
		
		if(!this.gridElem)
			return false;
		
		if (Runner.pages.PageSettings.getTableData(this.tName, "isUseHighlite")==false){
			return false;
		}
		
		this.gridElem.bind('mouseover', function(e){
			if($.browser.msie){
				$('select').mouseover(function(event){
					event.stopPropagation(); 
				});
			}
			var target = Runner.Event.prototype.getTarget(e);
			// traverse to filter parent
			while (target && target.nodeName && target.nodeName != "TABLE") {
				if(target.nodeName == "TR" && !$(target).hasClass("footer") && $(".revertEditing:visible", target).length == 0){
					$(target).addClass('hovered');
					break;
				}else{
					target = target.parentNode;
				}
			}
		});
		this.gridElem.bind('mouseout', function(e){
			if($.browser.msie){
				$('select').mouseout(function(event){ 
					event.stopPropagation(); 
				});
			}
			var target = Runner.Event.prototype.getTarget(e);
			// traverse to filter parent
			while (target && target.nodeName && target.nodeName != "TABLE") {
				if(target.nodeName == "TR" && !$(target).hasClass("footer")){
					$(target).removeClass('hovered');
					break;
				}else{
					target = target.parentNode;
				}
			}
		});
	},
	
	initMaps: function(){
		if (!this.controlsMap.gMaps || !this.controlsMap.gMaps.isUseGoogleMap){
			return false;
		}
		
		var initMaps = function(){
			var gMaps = {tName: this.tName}; 
			Runner.apply(gMaps, this.controlsMap.gMaps); 		

			this.mapManager = new Runner.controls.MapManager(gMaps); 
			this.mapManager.init();
			
			if (this.inlineEdit){
				this.inlineEdit.on('afterSubmit', function(vals, fields, keys, recId, data) { 
					for(var i=0; i<fields.length; i++){
						if (this.isFieldIsMap(fields[i])) {
							var mapDiv = this.getMapDiv("FIELD_MAP", recId, fields[i]);
							var span = $("#edit" + recId + "_" + Runner.goodFieldName(fields[i]));
							span.html('');
							$(mapDiv).appendTo(span);
							this.initMap(mapDiv.id);
						}else if (this.isFieldCenterLink(fields[i])) {
							var mapCenterLink = this.getCenterLink(recId, vals[fields[i]], this.isFieldCenterLink(fields[i]));
							var span = $("#edit" + recId + "_"+ Runner.goodFieldName(fields[i]));
							span.html('');
							$(mapCenterLink).appendTo(span);
							this.initCenterLink($(mapCenterLink));
						}
					}
					
					var viewQuery = "";
					for(var key = 0; key < keys.length; key++){
						viewQuery += "editid" + (key + 1) + "=" + escape(keys[key]);
					}
					
					var recordVals = {viewKey: viewQuery, keys: keys};  
					Runner.apply(recordVals, data.rawVals);
					this.updateAfterEdit(recId, recordVals);
					
				}, this.mapManager);
			}
			
			if (this.inlineAdd){
				this.inlineAdd.on('afterSubmit', function(vals, fields, keys, recId, data) {
					var viewQuery = "";
					for(var key = 0; key < keys.length; key++){
						viewQuery += "editid" + (key + 1) + "=" + escape(keys[key]);
					}
					
					var recordVals = {viewKey: viewQuery, keys: keys}; 
					Runner.apply(recordVals, data.rawVals);
					this.updateAfterAdd(recId, recordVals);
					
					for(var i=0; i<fields.length; i++){
						if (this.isFieldIsMap(fields[i])) {
							var mapDiv = this.getMapDiv("FIELD_MAP", recId, fields[i]);
							var span = $("#edit" + recId + "_" + Runner.goodFieldName(fields[i]));
							span.html('');
							$(mapDiv).appendTo(span);
							this.initMap(mapDiv.id);
							this.refreshMaps(recId);
						}else if (this.isFieldCenterLink(fields[i])) {
							var mapCenterLink = this.getCenterLink(recId, vals[fields[i]], this.isFieldCenterLink(fields[i]));
							var span = $("#edit" + recId + "_" + Runner.goodFieldName(fields[i]));
							span.html('');
							$(mapCenterLink).appendTo(span);
							this.initCenterLink($(mapCenterLink));
						}
					}
				}, this.mapManager);
			}
		}
		if (GlobalGmapLoader){
			GlobalGmapLoader.onLoad(initMaps,this);
		}
	},
	
	afterInitInlineAdd: function(row){
		if(this.useButtons){
			for(var i=0; i<this.buttonNames.length; i++){
				if($("#" + this.buttonNames[i], row.row).length){
					var newId = this.buttonNames[i] + "_" + Runner.genId();
					$("#" + this.buttonNames[i], row.row).attr('id', newId);
					// create object  
					var button = new Runner.form.Button({
						id: newId,
						btnName: this.buttonNames[i]
					});
					// init  
					button.init({args: [this, this.proxy, this.id, true]});
				}
			}
		}
	},
	
	afterInit: function(pageObj, proxy, pageid){
		this.heightScrollGridBody = proxy['gridHeight'];
		this.initScrollGridBody();
	},
	
	/**
	 * Is grid scrolling or not
	 * @return {boolean}
	 */	
	isScrollingGrid: function(){
		var isScrolling = false;
		isScrolling = Runner.pages.PageSettings.getTableData(this.tName, "scrollGridBody");
		if (Runner.pages.PageSettings.getTableData(this.tName, "isUseResize") 
				|| (this.controlsMap.gMaps.isUseFieldsMaps || Runner.pages.PageSettings.getTableData(this.tName, "noScroll")) 
					&& Runner.isIE){
			isScrolling = false;
		}
		return isScrolling;
	},
	
	/**
	 * Init scroll for grid
	 * Make grid scrolling
	 */	
	initScrollGridBody: function(){
		if (!this.isScrollGridBody || this.recsPerRowList > 1){
			return false;
		}
		
		var sizeWin = Runner.getWindowDimensions(),
			posAbs = Runner.getAbsolutePosition(this.gridElem.get(0), 1),
			fullHeight = posAbs.height + posAbs.top,
			myHeight = this.heightScrollGridBody;
		
		if(fullHeight < sizeWin.height){
			this.isScrollGridBody = false;
			return false;
		}
		
		if (!myHeight){
			if (fullHeight >= sizeWin.height) {
				myHeight = sizeWin.height - ($(document).height() - posAbs.height);
				if (myHeight < 0){
					myHeight = myHeight * (-1);
				}
			}
			else {
				myHeight = posAbs.height;
			}
		}
		
		//get height of header
		var theadHeight = $('thead tr', this.gridElem).height();
		if (theadHeight <= 0){
			theadHeight = 32;
		}
		
		$(this.gridElem).attr('theadheight', theadHeight);
		
		$('.runner-toprow, .runner-row:not(.gridRowAdd):first, .footer, .runner-bottomrow', this.gridElem).not(function(){
			if(!$(this).closest('td.dpinline').length){
				$(this).children('.runner-cc').each(function(){
					$(this).css('width', $(this).width() + 'px');
				});
			}
		});
		
		var myHeightInner = 0,
			footerHeight = $('.footer', this.gridElem).height();
			bottomHeight = $('.runner-bottomrow', this.gridElem).height();
		
		//if isset footer
		if (posAbs.height > myHeight){
			myHeight = myHeight - theadHeight;
			myHeightInner = myHeight - bottomHeight - footerHeight;
			myHeight = myHeightInner;
			$('.footer', this.gridElem).css("top", (myHeightInner + theadHeight - footerHeight - bottomHeight + 2) + "px").css("position", "absolute");
			$('.runner-bottomrow', this.gridElem).css("top", (myHeightInner + theadHeight - bottomHeight + 2) + "px").css("position", "absolute");
		}
		else {
			myHeight = posAbs.height - (theadHeight - bottomHeight);
			myHeightInner = myHeight;
		}
		
		//add div element
		var divWrap = $(document.createElement("DIV")).addClass('runner-scrollgrid-wrap').css({
			'position': 'relative',
			'height': (myHeight) + 'px',
			'padding': theadHeight + 'px 0 0'
		});
		
		if(fullHeight > sizeWin.height){
			divWrap.css('margin-bottom', this.gridElem.css('margin-bottom'));
		}
		
		//add div element
		var divInner = $(document.createElement("DIV")).addClass('runner-scrollgrid-inner').css('height',(myHeightInner) + 'px');
		
		divInner.scroll(function(){
			if($('div.shiny_box').length > 0)
				$('div.shiny_box').hide();
		});
		
		//add style to header 
		$('thead tr', this.gridElem).css('position', 'absolute').css('top', '0px');
		
		this.gridElem.closest(".runner-s-grid").before(divWrap);
		divInner.appendTo(divWrap);
		this.gridElem.closest(".runner-s-grid").appendTo(divInner);
		
		var scrollInner = this.gridElem.closest(".runner-scrollgrid-inner"),
			width1 = scrollInner.get(0).clientWidth;
		
		scrollInner.css('overflow-y', 'auto');
		scrollInner.css('overflow-x', 'hidden');
		if (Runner.isIE7){
			scrollInner.css('overflow-x', 'hidden');  
		}
		
		var width2 = scrollInner.get(0).clientWidth;
		if (!Runner.isIE){
			scrollInner.css('width', posAbs.width + (width1 - width2));
		}
	}
});	
Runner.pages.ListPageFly = Runner.extend(Runner.pages.ListPageCommon, {
	
	lookupCtrl: null,
	
	lookupBaseParams: null,
	
	constructor: function(cfg){
		
		Runner.pages.ListPageFly.superclass.constructor.call(this, cfg);
		this.listFields = Runner.pages.PageSettings.getTableData(this.tName, 'listFields');
		this.bricksForReload = ["grid","pagination","message"];
		
		this.on("afterInit", function(pageObj){
			
			this.lookupCtrl.lookupVals = this.controlsMap.lookupVals;
			
			this.lookupCtrl.initLinks(this.pageId);
			
			this.lookupCtrl.lookupSelectField = this.controlsMap.lookupSelectField;
			this.lookupCtrl.dispFieldAlias = this.controlsMap.dispFieldAlias;
			this.lookupCtrl.linkField = this.controlsMap.linkField;
			this.lookupCtrl.dispField = this.controlsMap.dispField;
			
		}, this);
		
		var categoryValue = '';
		if(this.lookupCtrl.parentCtrl){
			categoryValue = this.lookupCtrl.parentCtrl.getValue();
		}
		
		this.lookupBaseParams = {
			parId: this.lookupCtrl.pageId, 
			table: this.lookupCtrl.table, 
			field: this.lookupCtrl.fieldName, 
			mode: "lookup",
			category: categoryValue,
			control: "control", 
			editMode: this.lookupCtrl.mode,
			id: this.pageId
		};
	},
	
	destructor: function(){
		Runner.pages.ListPageFly.superclass.destructor.call(this);
		this.pageCont = null;
		this.lookupCtrl.pageId = -1;
	},
	
	init: function(){
		Runner.pages.ListPageFly.superclass.init.call(this);
		if (Runner.isMobile){
			this.showBrickMobile(["vmsearch2","cancelbutton_mobile"],"flylist");
		}
		this.initSorting();
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	/**
	 * Resize don't use on the list lookup
	 */
	initResize: Runner.emptyFn,
	
	initScrollGridBody: Runner.emptyFn,
	
	initSearch: function(){
		this.searchController = new Runner.search.SearchController({
			id: this.pageId,
			tName: this.tName,
			fNamesArr: this.controlsMap.search.allSearchFields,
			shortTName: this.shortTName,
			usedSrch: this.controlsMap.search.usedSrch,
			panelSearchFields: this.controlsMap.search.panelSearchFields,
			ajaxSubmit: true,
			useSuggest: false,
			pageType: this.pageType
		});
		
		this.searchController.init(this.controlsMap.search.searchBlocks);
		this.searchController.srchForm.baseParams = this.lookupBaseParams;
		if (!Runner.isMobile){
			this.searchController.srchForm.on("beforeSubmit", function(form){
				Runner.runLoading(this.win.bodyNode.getDOMNode());
			}, this);
		}
		
		this.searchController.on('afterSearch', function(respObj, srchController, srchForm){
			if (!Runner.isMobile){
				Runner.stopLoading(this.win.bodyNode.getDOMNode());
			}
			this.pageReloadHn(respObj);
			if (this.searchController.usedSrch){
				this.searchController.showShowAll();
			}else{
				this.searchController.hideShowAll();
			}
		}, this);
		
		this.searchController.srchForm.on('submitFailed', function(){
			if (!Runner.isMobile){
				Runner.stopLoading(this.win.bodyNode.getDOMNode());
			}
		}, this);
		
	},
	
	initInline: function(){
		if (Runner.pages.PageSettings.getTableData(this.tName, "isInlineAdd") && this.permis['add']){
			this.inlineAdd = new Runner.util.inlineEditing.InlineAdd({
				tName: this.tName,
				shortTName: this.shortTName,
				id: this.pageId,
				fNames: this.listFields,
				rows: this.controlsMap.gridRows,
				inlineEditObj: this.inlineEdit,
				totalFields: [],
				lookupField: this.lookupCtrl.fieldName
			});
			
			if (this.lookupCtrl.parentCtrl){
				this.inlineAdd.categoryValue = this.lookupCtrl.parentCtrl.getValue();
				this.inlineAdd.lookupTable = this.lookupCtrl.parentCtrl.table;
			}
			this.inlineAdd.loadSettings = true;
			
			this.inlineAdd.init();
			
			this.inlineAdd.on("beforeSetVals", function(row, fields){
				if (row.data[this.lookupCtrl.dispFieldAlias]){
					row.data[this.lookupCtrl.dispFieldAlias] = '<a href="#" type="lookupSelect'+this.searchController.srchForm.baseParams.id+'">'+row.data[this.lookupCtrl.dispFieldAlias]+'</a>';
				}else if(row.data[this.lookupCtrl.dispField]){
					row.data[this.lookupCtrl.dispField] = '<a href="#" type="lookupSelect'+this.searchController.srchForm.baseParams.id+'">'+row.data[this.lookupCtrl.dispField]+'</a>';
				}else{
					for(field in row.data){
						row.data[field] = '<a href="#" type="lookupSelect'+this.searchController.srchForm.baseParams.id+'">'+row.data[field]+'</a>';
						break;
					}
				}
			}, this);
			
			this.inlineAdd.on("afterSubmit", function(vals, fields, keys, rowId){
				var linkField = vals[this.lookupCtrl.linkField];
				if (typeof linkField == "undefined"){
					linkField = keys[this.lookupCtrl.linkField];
				}
				var newInd = this.lookupCtrl.addLookupVal(linkField, vals[this.lookupCtrl.dispFieldAlias] || vals[this.lookupCtrl.dispField]);
				var links = $('tr[id="gridRow'+ rowId +'"] a[type="lookupSelect' + this.searchController.srchForm.baseParams.id + '"]');
				if(links.length){
					var link = $(links[0]);
					this.lookupCtrl.initLink(link, newInd);
				}
			}, this);
			
			this.inlineAdd.on("afterInit", function(pageObj, proxy, pageid, row){
				this.afterInitInlineAdd(row);
			}, this);
		}
	},
	
	initSorting: function(){
		for(var i=0; i<this.listFields.length; i++){
			$("#order_"+Runner.goodFieldName(this.listFields[i])+"_"+this.pageId).bind("click", {pageObj: this}, function(e){				
				Runner.Event.prototype.stopEvent(e);
				var pageObj = e.data.pageObj;
				if (!Runner.isMobile){
					Runner.runLoading(pageObj.gridElem);
				}	
				
				$.runnerAJAX(this.href, {}, 
					function(respObj){
						pageObj.pageReloadHn.call(pageObj, respObj)
					}
				);
			});
		}
	},
	
	initPagination: function(){
	
		$("table[name=paginationTable"+this.pageId+"]").bind("click", {pageObj: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			var pageObj = e.data.pageObj;
			var target = Runner.Event.prototype.getTarget(e);
			if(target.nodeName != "A") {
				return false;
			}
			if (!Runner.isMobile){
				Runner.runLoading(pageObj.gridElem);
			}	
			
			var pageNum = $(target).attr("pageNum"),
				url = Runner.pages.getUrl(pageObj.tName, pageObj.pageType)+"?goto="+pageNum;
			
			$.runnerAJAX(url, pageObj.lookupBaseParams, 
				function(respObj){
					pageObj.pageReloadHn.call(pageObj, respObj)
				}
			);
		});
	},
	
	pageReloadHn: function(respObj){
		Runner.stopLoading(this.gridElem);
		if (respObj.success){
			this.destroyVideo();
			Runner.setIdCounter(respObj.idStartFrom);
			
			// replace bricks
			if (Runner.isMobile) {
				this.replaceBricksHTMLWith(this.getBricksHtml(respObj.html),$('.runner-c-flylist'));
			} else {
				this.replaceBricksHTMLWith(this.getBricksHtml(respObj.html));
			}
			
			// set controlsMap
			this.controlsMap = respObj["controlsMap"][this.tName][this.pageType][this.pageId];
			
			// set new vals
			this.lookupCtrl.lookupVals = respObj.controlsMap[this.tName][this.pageType][this.pageId].lookupVals;			
			this.lookupCtrl.initLinks(this.pageId);
			
			this.initGridElem();
			this.initPagination();
			this.initSorting();
			
			var gMaps = this.controlsMap.gMaps;
			if (this.mapManager && gMaps && gMaps.isUseGoogleMap){
				this.mapManager.init(gMaps.mapsData);
			}
			
			if (this.inlineAdd){
				this.inlineAdd.reInit(this.controlsMap.gridRows);
			}
			
			this.searchController.usedSrch = respObj.controlsMap[this.tName][this.pageType][this.pageId].search.usedSrch;
			
			if (this.searchController.usedSrch){
				this.searchController.showShowAll();
			} else {
				this.searchController.hideShowAll();
			}	
			
			if(typeof respObj.viewControlsMap != "undefined" && typeof respObj.viewControlsMap[this.tName][this.pageType][this.pageId].controls != "undefined"){
				var viewControls = respObj.viewControlsMap[this.tName][this.pageType][this.pageId].controls;
				for(var i = 0; i < viewControls.length; i++){
					viewControls[i].table = this.tName;
					var ctrl = Runner.viewControls.ViewControlFabric(viewControls[i], this.pageType, this.pageCont, this);
					ctrl.init();
				}
			}
		} else {
			this.win.set('bodyContent', "REQUEST FAILED");
		}
	}
});


		
Runner.pages.ListPage = Runner.extend(Runner.pages.ListPageCommon, {
		
	inlineEdit: null,
	
	inlineAdd: null,
	
	pageType: Runner.pages.constants.PAGE_LIST,
		
	mapManager: null,
		
	multipleHint: null,
	
	existMultipleHint: false,
		
	constructor: function(cfg){
		
		Runner.pages.ListPage.superclass.constructor.call(this, cfg);
		this.listFields = Runner.pages.PageSettings.getTableData(this.tName, 'listFields');
		this.multipleHint = $(".runner-sorthint", document.body);
		this.isUseInlineEdit = Runner.pages.PageSettings.getTableData(this.tName, "isInlineEdit");
		this.addEvents("afterInlineAdd", "afterInlineEdit");
	},
	
	destructor: function(){
		for(var tName in this.dpObjs){
			this.dpObjs[tName].destructor();
		}
		Runner.pages.ListPage.superclass.destructor.call(this);
	},
	
	init: function(){
		Runner.pages.ListPage.superclass.init.call(this);
		this.initButtons();
		this.initSection508();
	},
	
	initForGrid: function(){
		Runner.pages.ListPage.superclass.initForGrid.call(this);
		this.initSorting();
		this.initDetails();
		this.initPopupLinks();
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	initSection508: function(){
		if(Runner.pages.PageSettings.getGlobalData("s508")){
			this.s508Obj = new Runner.s508({
				pageId: this.id,
				gridObj: this.gridElem,
				pageURL: Runner.pages.getUrl(this.tName, this.pageType),
				maxPages: Runner.pages.PageSettings.getTableData(this.tName, "maxPages"),
				isUseInlineEdit: (this.isUseInlineEdit && this.permis['edit'])
			});
			this.s508Obj.init();
		}
	},
	
	initInline: function(){	
		var showAddInPopup = Runner.pages.PageSettings.getTableData(this.tName, "showAddInPopup") && !Runner.isMobile,
			showEditInPopup = Runner.pages.PageSettings.getTableData(this.tName, "showEditInPopup") && !Runner.isMobile,
			showViewInPopup = Runner.pages.PageSettings.getTableData(this.tName, "showViewInPopup") && !Runner.isMobile;
		
		if (this.isUseInlineEdit && this.permis['edit'] || showAddInPopup || showEditInPopup || showViewInPopup){
			
			this.inlineEdit = new Runner.util.inlineEditing.InlineEdit({
				id: this.pageId,
				tName: this.tName,
				shortTName: this.shortTName,
				fNames: this.listFields,
				rows: this.controlsMap.gridRows,
				loadSettings: true
			});
			
			this.inlineEdit.init();
			
			this.inlineEdit.on("afterSave", function(fieldsData){
				this.fireEvent("afterInlineEdit", fieldsData);
			}, this);
			
			this.inlineEdit.on("recalcGridSize", function(){
				this.recalculationGridSize();
			}, this);
			
			//after multiple saving rows
			this.inlineEdit.on("rowsEdited", function(){
				this.fireEvent("recalcGridSize");
			});
			
			this.inlineEdit.on("afterInit", function(pageObj, proxy, pageid, row){
				this.recalculationGridSize();
			}, this);
		}
		
		if (Runner.pages.PageSettings.getTableData(this.tName, "isInlineAdd") && this.permis['add'] || showAddInPopup || showEditInPopup || showViewInPopup){
		
			this.inlineAdd = new Runner.util.inlineEditing.InlineAdd({
				id: this.pageId,
				tName: this.tName,
				shortTName: this.shortTName,
				fNames: this.listFields,
				rows: this.controlsMap.gridRows,
				inlineEditObj: this.inlineEdit,
				loadSettings: true
			});
			
			this.inlineAdd.init();
			
			this.inlineAdd.on("afterSubmit", function(vals, fields, keys, id, resp){
				var detailsBricks = this.getBrickObjs('details_found');
				if (!detailsBricks.length)
					detailsBricks = this.getBrickObjs('vdetails_found');
				$.each(detailsBricks, function(ind, brick){
					$('.runner-details_found_count', brick.elem[0]).each(function(dind, detail){
						var dfStr = $(detail).html();
						if(!parseInt(dfStr))
							$(detail).html('1');
						else
							$(detail).html(parseInt(dfStr) + 1);
					});
				});
				if (resp.noKeys !== true){
					for(var tName in this.dpObjs){
						this.dpObjs[tName].addRow({
							id: id,
							masterKeys: resp.detKeys[tName],
							keys: keys
						});
						this.dpObjs[tName].getChildRecNum(resp.detKeys[tName]);
					}
					var detTables = Runner.pages.PageSettings.getTableData(this.tName, "detailTables");
					for(var tName in detTables){
						$("#master_"+Runner.pages.PageSettings.getShortTName(tName)+ "_" + id).show();
					}
					return true;
				}
			}, this);
			
			this.inlineAdd.on("afterSave", function(fieldsData){
				this.fireEvent("afterInlineAdd", fieldsData);
			}, this);
			
			this.inlineAdd.on("recalcGridSize", function(){
				this.recalculationGridSize();
			}, this);
			
			//after multiple saving rows
			this.inlineAdd.on("rowsEdited", function(){
				this.fireEvent("recalcGridSize");
			});
			
			this.inlineAdd.on("afterInit", function(pageObj, proxy, pageid, row){
				this.afterInitInlineAdd(row);
				this.recalculationGridSize();
			}, this);
		}
	},
	
	afterInlineAdd: function(fn){
		this.on('afterInlineAdd', fn, this);
	},
	
	afterInlineEdit: function(fn){
		this.on('afterInlineEdit', fn, this);
	},
	
	/**
	 * Init details for master list page
	 * Call only for list page and only once
	 */
	initDetails: function(){
		this.dpObjs = {};
		var pageObj = this;
		if (Runner.pages.PageSettings.getTableData(this.tName, "detailTables") != undefined){
			var detTables = Runner.pages.PageSettings.getTableData(this.tName, "detailTables"),
				isAlreadyInitPopup = false,
				dpParams = {
					id : this.id,
					parId: this.parId || this.id,
					masterTName: this.tName
				};
			for(var tName in detTables){
				dpParams.tName = tName;
				dpParams.rows = this.controlsMap.gridRows.slice(0);
				if (detTables[tName].listShowType == Runner.pages.constants.DP_POPUP){
					this.dpObjs[tName] = new Runner.util.details.DPPopUp(dpParams);
					this.dpObjs[tName].init();
					if(!isAlreadyInitPopup){
						var dpObj = pageObj.dpObjs[tName];
						$('.runner-details-popup').bind({
							mouseover: function(){
								dpObj.showPopup();
							},
							mouseout: function(){
								dpObj.hidePopup();
							}
						});
						isAlreadyInitPopup = true;
					}
				}else{
					this.dpObjs[tName] = new Runner.util.details.ListDP(dpParams);
					this.dpObjs[tName].init();
					this.dpObjs[tName].on('beforeShowDetails', function(dpObj, row){
						var isRowShown = false,
							isShownDPObj = false;
							
						for(var tName in detTables){
							if(typeof tName != "undefined" && tName){
								var isShown = this.dpObjs[tName].getRowByInd(row.rowInd).isShown;
								if(typeof isShown != "undefined" && isShown){
									isRowShown = true;
									isShownDPObj = this.dpObjs[tName];
								}
							}
						}
						if(!isRowShown){
							dpObj.closeDetailsByInd(row.rowInd);
						}else{
							isShownDPObj.loadingCell(isShownDPObj.getRowByInd(row.rowInd));
						}
						if (this.isScrollGridBody && !(this.recsPerRowList>1)){
							$('tr',$(this.gridElem).children("thead")).css('position','static');
							$('th.runner-cc',$(this.gridElem).children("thead")).each(function(){
								$(this).css('width','auto');
							});
							
							//get width of tbody columns
							$('tbody td.runner-cc',this.gridElem).each(function(){
								$(this).css('width','auto');
							});
							
							$('tr.runner-bottomrow',$("tbody", this.gridElem)).not(function(){
								var trBottom  = this;
								if(!$(this).closest('td.dpinline').length){
									$(trBottom).css('position','static');
									$(this).children('.runner-cc').each(function(){
										$(this).css('width','auto');
									});
								}
							});
							
							$('tr.footer',$("tbody", this.gridElem)).not(function(){
								var trFoot  = this;
								if(!$(this).closest('td.dpinline').length){
									$(trFoot).css('position','static');
									$(this).children('.runner-cc').each(function(){
										$(this).css('width','auto');
									});
								}
							});
						}
					}, this);
					this.dpObjs[tName].on('afterShowDetails', function(){
						//add style to header 
						if (this.isScrollGridBody && !(this.recsPerRowList>1)){
							var grid = this.gridElem;
							setTimeout( function() {
								$('th.runner-cc',$(grid).children("thead")).each(function(){
									$(this).css('width',$(this).width()+'px');
								});
								//get width of tbody columns
								$('tbody td.runner-cc',grid).each(function(){
									$(this).css('width',$(this).width()+'px');
								});
								$('tbody tr.runner-bottomrow',grid).children('.runner-cc').each(function(){
									$(this).css('width',$(this).width()+'px');
								});
								var posAbs = Runner.getAbsolutePosition(grid.get(0),1);
								$(grid.closest(".runner-scrollgrid-inner")).css('overflow-y','hidden');
								var width1 = $(grid.closest(".runner-scrollgrid-inner")).get(0).clientWidth;
								$(grid.closest(".runner-scrollgrid-inner")).css('overflow-y','auto');
								var width2 = $(grid.closest(".runner-scrollgrid-inner")).get(0).clientWidth;
								if (!Runner.isIE){
									$(grid.closest(".runner-scrollgrid-inner")).css('width',posAbs.width+(width1-width2));
								}
								setTimeout( function() { 
									$('tr',$(grid).children("thead")).css('position','absolute').css('top','0px');
									
									$('tr.runner-bottomrow',$("tbody", grid)).not(function(){
										var trBottom  = this;
										if(!$(this).closest('td.dpinline').length){
											$(trBottom).css('position','absolute');
										}
									});
									
									$('tr.footer',$("tbody", grid)).not(function(){
										var trFoot  = this;
										if(!$(this).closest('td.dpinline').length){
											$(trFoot).css('position','absolute');
										}
									});
								}, 0);
							} ,0);
						}
					}, this);
				}
			}
		}
	},
	
	initButtons: function(){
		this.initDeleteButton();
		this.initRecordBlock();
		this.initExportLink();
		this.initImportLink();
		this.initPrintLink();
		this.initAddButton();
		this.initAdminButton();
	},
	
	/**
	 * initPopupLinks
	 * Initioalize popup link to details pages
	 */
	initPopupLinks: function(){
		if(Runner.isMobile)
			return;
		var pageObj = this, detTables = Runner.pages.PageSettings.getTableData(pageObj.tName, "detailTables"),
			masterMouseOver = function(){
				var startSub = $(this).attr('id').indexOf('_') + 1, endSub = $(this).attr('id').lastIndexOf('_')
					, shortTName = $(this).attr('id').substr(startSub, endSub - startSub)
					, tName = '', row = null
					, rowId = $(this).attr('id').substr(endSub + 1)
					, requestUrl = shortTName + '_detailspreview.php';
				for(var detTName in detTables){
					if(Runner.pages.PageSettings.getShortTName(detTName) == shortTName){
						tName = detTName;
						break;
					}
				}	
				if(tName == ''){
					return;
				}	
				$.each(pageObj.dpObjs[tName].rows, function(index, tRow){
					if(tRow.id == rowId){
						row = tRow;
						return false;
					}
				});
				if(row == null){
					return;
				}	
				var masterKeys = {};
				$.each(row.masterKeys, function(mKey, mKeyValue){
					masterKeys[mKey] = mKeyValue || "";
				});
				pageObj.dpObjs[tName].showPopup(this, requestUrl, pageObj.tName, masterKeys);
			};
			
		if(this.dpObjs != undefined){
			$.each(this.dpObjs, function(tName, tObj){
				if (detTables[tName].listShowType == Runner.pages.constants.DP_NONE){
					return true;
				}
				$("a[id^=\"master_" + tObj.shortTName + "\"]", pageObj.getBrickGridElem()).each(function(ind, link){
					$(link).unbind('mouseover')
						.unbind('mouseout')
						.bind({
							mouseover: masterMouseOver,
							mouseout: function(){
								tObj.hidePopup();
							}
						});
				});
			});
		}
	},
	
	getEditRows: function(rowId){
		var rows = this.controlsMap.gridRows;
		for(var i=0; i<rows.length; i++){
			if(rows[i].id == parseInt(rowId)){
				if(rows[i].isEditOwnRow){
					return true;
				}
			}
		}
		return false;
	},
	
	initDeleteButton: function(){
	
		var pageObj = this,
			submitUrl = this.shortTName+"_"+this.pageType+".php";
		
		$("a[id=delete_selected"+this.id+"]").unbind("click").bind("click", function(e){
			
			var selBoxes = pageObj.getSelBoxes(pageObj.id);
			if(Runner.pages.PageSettings.getTableData(pageObj.tName, "isEditOwn")){
				var tempBoxes = [];
				$(selBoxes).each(function (index, checkBox){
						var rowId = $(checkBox).attr('id').substr($(checkBox).attr('id').lastIndexOf('_') + 1);
						if(!pageObj.inlineAdd || !pageObj.inlineAdd.getRowById(rowId).isAddOwnRow){
							if(!pageObj.getEditRows(rowId)){
								$(checkBox).prop("checked", false);
								return true;
							}
						}
						tempBoxes.push(checkBox);
					});
				selBoxes = tempBoxes;
			}
			
			if(selBoxes.length == 0 || !confirm(Runner.lang.constants.TEXT_DELETE_CONFIRM)){
				return false;
			}
			
			var form = new Runner.form.BasicForm({
				standardSubmit: true,
				submitUrl: submitUrl,
				method: 'POST',
				id: pageObj.id,
				baseParams: {"a": 'delete'},
				addElems: pageObj.cloneFormElements(selBoxes)
			});
			
			form.submit();
			form.destructor();
		});
	},
	
	initExportLink: function(){
		var pageObj = this,
			submitUrl = this.shortTName+"_"+Runner.pages.constants.PAGE_EXPORT+".php";
		
		$("a[id=export_selected"+this.id+"]").unbind("click").bind("click", function(e){
			var selBoxes = pageObj.getSelBoxes(pageObj.id);
			
			if(selBoxes.length == 0){
				return false;
			}
			
			var form = new Runner.form.BasicForm({
				standardSubmit: true,
				submitUrl: submitUrl,
				target: '_blank',
				method: 'POST',
				id: pageObj.id,
				addElems: pageObj.cloneFormElements(selBoxes),
				baseParams: {a: "export"}
			});
			
			form.submit();
			form.destructor();
		});
		
		$("a[id=export_"+this.pageId+"]").unbind("click").bind("click", function(e){
			window.open(pageObj.shortTName + "_export.php", 'wExport');
		});
	},
	
	initImportLink: function(){
		var pageObj = this;
		$("a[id=import_"+this.pageId+"]").unbind("click").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_import.php";
		});
	},
	
	initPrintLink: function(){
		var pageObj = this,
			submitUrl = this.shortTName+"_"+Runner.pages.constants.PAGE_PRINT+".php";
			
		$("a[id=print_selected"+this.id+"]").unbind("click").bind("click", function(e){
			var selBoxes = pageObj.getSelBoxes(pageObj.id);
			
			if(selBoxes.length == 0){
				return false;
			}
			
			var form = new Runner.form.BasicForm({
				standardSubmit: true,
				submitUrl: submitUrl,
				target: '_blank',
				method: 'POST',
				id: pageObj.id,
				addElems: pageObj.cloneFormElements(selBoxes),
				baseParams: {a: "print"}
			});
			
			form.submit();
			form.destructor();
		});
	},
	
	initRecordBlock: function(){
		var submitUrl = Runner.pages.getUrl(this.tName, this.pageType);
		
		$("#recordspp"+this.id).bind("change", function(e){
			document.location = submitUrl+'?pagesize='+this.options[this.selectedIndex].value;
		});
	},
	
	initAddButton: function(){
		var pageObj = this;
		if (Runner.pages.PageSettings.getTableData(this.tName, "showAddInPopup") && !Runner.isMobile){
			$("a[id=addButton"+this.id+"]").unbind("click").bind("click", function(e){
				pageObj.hideBrick('message');
				var eventParams = {
					tName: pageObj.tName, 
					pageType: Runner.pages.constants.PAGE_ADD, 
					pageId: -1,
					destroyOnClose: true,
					parentPage: pageObj,
					modal: true, 
					editType: Runner.pages.constants.ADD_POPUP,
					baseParams: {
						parId: pageObj.id,
						table: pageObj.tName,
						editType: Runner.pages.constants.ADD_POPUP
					},
					afterSave: {
						fn: function(respObj, formObj, fieldControls, addPageObj){
							if (respObj.success){
								pageObj.inlineAdd.addRowToGrid(respObj);
							}else{
								if(respObj.hideCaptha){
									$('.captcha_block').remove();
								}
								//show invslid captcha message
								addPageObj.showCaptchaErrMessage(respObj.captcha);
								if(respObj.message){
									//	respObj contains error message
									addPageObj.displayHalfPreparedMessage(respObj.message);
									addPageObj.showBrick('message');
								}else if (typeof respObj.html!='undefined'){
									// respobj is a raw text
									addPageObj.win.set('bodyContent', respObj.html);
									addPageObj.hideBrick('message');
								}
								$('div.yui3-widget-bd').animate({
									scrollTop:0
								});
								return false;
							}
						},
						scope: pageObj
					}
				};
				Runner.Event.prototype.stopEvent(e);
				Runner.pages.PageManager.openPage(eventParams);
			});
		}else{
			$("a[id=addButton"+this.id+"]").bind("click", function(e){
				document.location = Runner.pages.getUrl(pageObj.tName, Runner.pages.constants.PAGE_ADD);
			});	
		}
	},
	
	initAdminButton: function(){
		$("a[id=exitAdminArea"+this.id+"]").bind("click", function(e){
			document.location = "menu.php";
		});
		
		$("a[id=adminArea"+this.id+"]").bind("click", function(e){
			document.location = "admin_rights_list.php";
		});
	},
		
	initSorting: function(){
		var pageObj = this;
		for(var i=0; i<this.listFields.length; i++){
			$("#order_"+Runner.goodFieldName(this.listFields[i])+"_"+this.id).
				mouseout(function(){
					pageObj.delSortHint.call(pageObj);
				}).
					mousemove(function(e){
						pageObj.moveSortHint.call(pageObj,e);
					}).
						mouseover(function(e){
							pageObj.addSortHint.call(pageObj,e);
						}).
							mousedown(function(e){
								pageObj.multipleSortUrl(e, this.href, false);
							});
		}
	},
	
	/**
	 * Get url for multiple sorting on list pages
	 * @param {object} event
	 * @param {string} page url
	 * @param {boolean} use Ajax on page
	 */	
	multipleSortUrl: function(event,pageUrl,useAjax){
		var ctrlPressed = 0,
			appVersion = parseInt(navigator.appVersion);
		if(appVersion > 3){
			if (navigator.appName == "Netscape"){
				var ua = navigator.userAgent;
				var isFirefox = (ua != null && (ua.indexOf("Firefox/") != -1 || ua.indexOf("Chrome/") != -1));
				if ((!isFirefox && appVersion >= 5) || isFirefox){ 
					ctrlPressed = event.ctrlKey;
				}else{ // for Netscape version 4
					ctrlPressed = ((event.modifiers+32).toString(2).substring(3,6).charAt(1)=="1");
				}	
			}else{
				ctrlPressed = event.ctrlKey;
			}	
			if (ctrlPressed){
				pageUrl += '&ctrl=1';
				if(useAjax){
					return pageUrl; 
				}else{
					var newPage = "<scr" + "ipt language=\"JavaScript\">setTimeout(\'window.location.href=\"" + pageUrl + "&ctrl=1\"\', 1);</scr" + "ipt>";
					document.write(newPage);
					document.close();
				} 
				return false;
			}
		}
		return '';
	},
	
	/**
	 * Add hint for multiple sorting
	 * @param {object} event
	 */	
	addSortHint: function(e){
		if(this.pageMode!="listdetails")
		{
			this.existMultipleHint = true;
			this.showSortHint(e);
		}
	},	
	
	/**
	 * Set coordinates for sorting hint
	 * @param {object} event
	 */
	setCoordinatesSortHint: function(e){
		var scrollX, scrollY, 
			winDim = Runner.getWindowDimensions(),
			hintY = e.y || e.pageY,
			hintX = e.x || e.pageX;
			
		if($.browser.msie){
			scrollX = document.documentElement.scrollLeft;
			scrollY = document.documentElement.scrollTop;
		}else{
			scrollX = window.pageXOffset;
			scrollY = window.pageYOffset;
		}
		
		if(hintX + this.multipleHint.width() > winDim.width + scrollX){
			hintX -= this.multipleHint.width();
		}
		hintY += 20;
		if(hintY + this.multipleHint.height() > winDim.height + scrollY){
			hintY -= this.multipleHint.height();
		}
		this.multipleHint.css("left", "" + hintX + "px");
		this.multipleHint.css("top", "" + hintY + "px");
	},
	
	/**
	 * Show hint, it may take some time
	 * @param {object} event
	 */	
	showSortHint: function(e){
		if(!this.multipleHint.length){
			$(document.body).append('<span class="runner-sorthint"><b>'+Runner.lang.constants.TEXT_CTRL_CLICK+'</b></span>');
			this.multipleHint = $(".runner-sorthint");
		}
		this.setCoordinatesSortHint(e);
		if(this.existMultipleHint){ 
			this.multipleHint.css("display", "block");
		}
	},
	
	/**
	 * Delete hint for multiple sorting
	 */	
	delSortHint: function(){
		if(this.multipleHint.length){
			this.multipleHint.css("display","none");
			this.existMultipleHint = false;
		}	
	},
	
	/**
	 * Moving hints for multiple sorting
	 * @param {object} event
	 */	
	moveSortHint: function(e){
		if(this.multipleHint.length){
			if(this.multipleHint.css('display')!="block"){
				return false;
			}
			this.setCoordinatesSortHint(e);
		}
	},
	
	/**
	 * Recalculation grid size for scrolling
	 */	
	recalculationGridSize: function(){
		if (!this.isScrollGridBody || this.recsPerRowList > 1){
			return;
		}
		var scrollWrap = this.gridElem.closest(".runner-scrollgrid-wrap"),
			scrollInner = this.gridElem.closest(".runner-scrollgrid-inner"),
			myHeight = scrollWrap.height(),
			scrollTopVal = scrollInner.scrollTop();
		
		$('.runner-toprow, .runner-row:not(.gridRowAdd):first, .footer, .runner-bottomrow', this.gridElem).not(function(){
			if(!$(this).closest('td.dpinline').length){
				$(this).css('position', 'static');
				$(this).children('.runner-cc').each(function(){
					$(this).css('width', 'auto');
					$(this).css('width', $(this).width() + 'px');
				});
			}
		});
		var width1 = scrollInner.get(0).clientWidth;
		scrollInner.css('overflow-y', 'hidden');
		
		var pageObj = this;
		setTimeout(function(){
			//recalculate grid width
			var width2 = scrollInner.get(0).clientWidth;
			
			if (!Runner.isIE){
				scrollInner.css('width', pageObj.gridElem.width() + (width1 - width2));
			}
			if (!Runner.pages.PageSettings.getTableData(pageObj.tName, 'showRows')){
				return;
			}
			
			setTimeout(function(){ 
				$('.runner-toprow, .footer, .runner-bottomrow', pageObj.gridElem).not(function(){
					if(!$(this).closest('td.dpinline').length){
						$(this).css('position','absolute');
						if($(this).hasClass('runner-toprow')){
							$(this).css('top','0px');
						}
					}
				});
				
				var theadHeight = $('thead tr th:first', pageObj.gridElem)[0].offsetHeight;
				
				if (pageObj.gridElem.attr('theadheight') != theadHeight){
					$('.footer', pageObj.gridElem).css("top",(myHeight + theadHeight - footerHeight - bottomHeight) + "px");
					$('.runner-bottomrow', pageObj.gridElem).css("top", + (myHeight + theadHeight - bottomHeight) + "px");	
					scrollWrap.css('padding', theadHeight + 'px 0 0');
					pageObj.gridElem.attr('theadheight', theadHeight);
				}
				
				if (scrollTopVal > 0){
					var offset = scrollInner.offset();
					scrollInner.scrollTop(scrollTopVal + offset.top);
				}
				scrollInner.css('overflow-y', 'auto');
			}, 0);
		} , 0);
		
		if (!Runner.pages.PageSettings.getTableData(pageObj.tName, 'showRows')){
			scrollWrap.css('height', 'auto');
			scrollInner.css('height', 'auto');
			return;
		}
		
		if (!this.heightScrollGridBody){
			scrollWrap.css('height', 'auto');
			scrollInner.css('height', 'auto');
			
			var footerHeight = 0, bottomHeight = 0,
				sizeWin = Runner.getWindowDimensions(),
				posAbs = Runner.getAbsolutePosition(this.gridElem.get(0),1),
				theadHeight = $('thead tr th:first', this.gridElem)[0].offsetHeight;
			
			if (theadHeight <= 0){ 
				theadHeight = 32;
			}
			
			footerHeight = $('.footer', this.gridElem).height();
			bottomHeight = $('.runner-bottomrow', this.gridElem).height();
			
			if ((posAbs.top + posAbs.height) <= sizeWin.height) {
				myHeight = scrollWrap.height();
				myHeight = posAbs.height - (theadHeight - bottomHeight - footerHeight);
			}
			$('.footer', this.gridElem).css("top",((myHeight - bottomHeight - footerHeight) + theadHeight - footerHeight - bottomHeight) + "px");
			$('.runner-bottomrow', this.gridElem).css("top",+((myHeight - bottomHeight - footerHeight) + theadHeight - bottomHeight) + "px");
			
			scrollWrap.css('height', myHeight);
			scrollWrap.css('padding', theadHeight + 'px 0 0');
			myHeight = myHeight - bottomHeight - footerHeight;
			scrollInner.css('height', myHeight);
		}
	}
});

Runner.pages.ListPageAjax = Runner.extend(Runner.pages.ListPage, {
	/**
	 * Base params for ajax reload
	 * @type {object}
	 */
	ajaxBaseParams: null,
	
	constructor: function(cfg){
		
		Runner.pages.ListPageAjax.superclass.constructor.call(this, cfg);
		this.listFields = Runner.pages.PageSettings.getTableData(this.tName, 'listFields');
		
		this.ajaxBaseParams = {
			mode: "ajax",
			id: this.pageId
		};
		
		this.bricksForReload = ["details_found","page_of","vdetails_found","vpage_of","grid","pagination","message"];
	},

	initSearch: function(){
		
		Runner.pages.ListPageAjax.superclass.initSearch.call(this);
		
		this.searchController.ajaxSubmit = true;
		this.searchController.srchForm.standardSubmit = false; 
		this.searchController.srchForm.baseParams = this.ajaxBaseParams;
		
		var pageObj = this;
		this.searchController.srchForm.on("beforeSubmit", function(form){
			Runner.runLoading(this.gridElem);
		}, this);

		this.searchController.on('afterSearch', function(respObj, srchController, srchForm){
			Runner.stopLoading();
			this.pageReloadHn(respObj);
			if (this.searchController.usedSrch){
				this.searchController.showShowAll();
			}else{
				this.searchController.hideShowAll();
			}
		}, this);
		
		this.searchController.srchForm.on('submitFailed', function(){
			Runner.stopLoading();
		}, this);
	},
		
	initRecordBlock: function(){
		$("#recordspp"+this.id).bind("change", {pageObj: this}, function(e){
			var pageObj = e.data.pageObj,
				recsPP = $("#recordspp"+pageObj.id).val();
			
			Runner.runLoading(pageObj.gridElem);
			
			// ajax page reload	
			$.runnerAJAX(Runner.pages.getUrl(pageObj.tName, pageObj.pageType)+"?pagesize="+recsPP,
					pageObj.ajaxBaseParams,
					function(respObj){
						pageObj.pageReloadHn.call(pageObj, respObj);
					});
		});
		
	},
	
	initSorting: function(){
		var pageObj = this;
		for(var i=0; i<this.listFields.length; i++){
			$("#order_"+Runner.goodFieldName(this.listFields[i])+"_"+this.id).
				mouseout(function(){
					pageObj.delSortHint.call(pageObj);
				}).
					mousemove(function(e){
						pageObj.moveSortHint.call(pageObj,e);
					}).
						mouseover(function(e){
							pageObj.addSortHint.call(pageObj,e);
						}).
							mousedown(function(e){
								Runner.Event.prototype.stopEvent(e);
								Runner.runLoading(pageObj.gridElem);
								$.runnerAJAX(pageObj.multipleSortUrl(e, this.href, true) || this.href, pageObj.ajaxBaseParams,
									function(respObj){
										pageObj.pageReloadHn.call(pageObj, respObj)
									});
							}).
								click(function(e){
									Runner.Event.prototype.stopEvent(e);
								});
		}
	},
	
	initDeleteButton: function(){
		$("a[id=delete_selected"+this.id+"]").bind("click", {pageObj: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			
			var pageObj = e.data.pageObj;
			Runner.runLoading(pageObj.gridElem);
			
			var selBoxes = pageObj.getSelBoxes(pageObj.id);
			if(selBoxes.length == 0 || !confirm(Runner.lang.constants.TEXT_DELETE_CONFIRM)){
				Runner.stopLoading();
				return false;
			}
			var form = new Runner.form.BasicForm({
				submitUrl: Runner.pages.getUrl(pageObj.tName, pageObj.pageType)+"?"+$(selBoxes).serialize(),
				standardSubmit: false,
				method: 'POST',
				baseParams: Runner.apply({a: 'delete'}, pageObj.ajaxBaseParams),
				successSubmit: {
					fn: function(respObj, formObj, fieldControls){
						pageObj.pageReloadHn.call(pageObj, respObj);
					},
					scope: this
				}
			});
			
			form.submit();
		});
	},
	
	initPagination: function(){
		var pageObj = this;
		$.each(this.getBrickObjs('pagination'), function(index, brick){
			brick.elem.bind("click", function(e){
				
				Runner.Event.prototype.stopEvent(e);
				
				var target = Runner.Event.prototype.getTarget(e);
				if(target.nodeName != "A") {
					return false;
				}
				Runner.runLoading(pageObj.gridElem);
				
				// ajax page reload	
				$.runnerAJAX(Runner.pages.getUrl(pageObj.tName, pageObj.pageType)+"?goto="+$(target).attr("pageNum"),
						pageObj.ajaxBaseParams,
						function(respObj){
							pageObj.pageReloadHn.call(pageObj, respObj)
						});
			});
		});
	},
	
	pageReloadHn: function(respObj){
		Runner.stopLoading();
		
		if (respObj && respObj.success){
			this.destroyVideo();
			this.hideBrick('message');
			var selectAll = $('#select_all'+this.id);
			if (selectAll.length){
				selectAll[0].checkAllStatus = false;
			}
			Runner.setIdCounter(respObj.idStartFrom);
			Runner.pages.PageSettings.addSettings(this.tName, respObj.settings, false);
			
			// replace bricks
			this.replaceBricksHTMLWith(this.getBricksHtml(respObj.html));
			
			this.controlsMap.gridRows = respObj["controlsMap"][this.tName][this.pageType][this.id].gridRows;
			
			if (this.controlsMap.gridRows.length){
				this.hideBrick("message");
				var rowIdStartFrom = this.controlsMap.gridRows[0].id;
			}else{
				this.showBrick("message");
			}
			
			if (respObj.usermessage)
				this.showBrick("message");
			
			if(Runner.pages.PageSettings.getTableData(this.tName, "showRows")){
				$("a[id=edit_selected"+this.pageId+"]").parent().show();
				$("a[id=print_selected"+this.pageId+"]").parent().show();
				$("a[id=export_selected"+this.pageId+"]").parent().show();
				$("a[id=delete_selected"+this.pageId+"]").parent().show();
			}
			
			this.initGridElem();
			this.initResize();
			this.initDetails();
			this.initPopupLinks();
			this.initSorting();
			this.initHeaderCheckBox()
			
			var massRecButtonsTogled = false;
			if (this.inlineAdd){
				this.inlineAdd.reInit(this.controlsMap.gridRows);
				this.inlineAdd.toggleMassRecButt();
				massRecButtonsTogled = true;
			}
			if (this.inlineEdit){
				this.inlineEdit.reInit(this.controlsMap.gridRows);
				if(!massRecButtonsTogled)
					this.inlineEdit.toggleMassRecButt();
			}
			
			this.searchController.usedSrch = respObj.controlsMap[this.tName][this.pageType][this.id].search.usedSrch;
			if (this.searchController.usedSrch){
				this.searchController.showShowAll();
			}
			
			var gMaps = respObj.controlsMap[this.tName][this.pageType][this.id].gMaps;
			if (this.mapManager && gMaps && gMaps.isUseGoogleMap){
				this.mapManager.init(gMaps.mapsData);
			}
			
			if(typeof respObj.viewControlsMap != "undefined" && typeof respObj.viewControlsMap.controls != "undefined"){
				for(var i = 0; i < respObj.viewControlsMap.controls.length; i++){
					respObj.viewControlsMap.controls[i].table = this.tName;
					var ctrl = Runner.viewControls.ViewControlFabric(respObj.viewControlsMap.controls[i], this.pageType, this.pageCont, this);
					ctrl.init();
				}
			}

			this.fireEvent('afterInit', this, this.proxy, this.pageId);	
		}else{
			this.displayMessage('Submit failed',true, true);
		}
	},
	
	initScrollGridBody:Runner.emptyFn
	
});

Runner.pages.ListPageDP = Runner.extend(Runner.pages.ListPage, {
	
	baseParams: null,	
	
	detCont: null,
	
	proceedToUrl: "",
	
	useChildCount: true,
	
	masterKeys: null,
	
	hideSaveButt: false,
	
	constructor: function(cfg){
		
		Runner.pages.ListPageDP.superclass.constructor.call(this, cfg);
		// page container must be DOM element!
		this.pageCont = $('#detailPreview'+this.id)[0];
		this.addEvents("beforeSaveDetails", "afterSaveDetails", "afterDeleteDetails", "afterPageReady");
		this.baseParams = this.baseParams || {id:this.pageId};
		
		// add masterKeys to baseParams
		Runner.apply(this.baseParams, this.controlsMap.masterKeys);
	},
	
	init: function(){
	
		this.init = function(){
			Runner.pages.ListPageDP.superclass.init.call(this);
		
			if (this.beforeSaveDetails){
				this.on({'beforeSaveDetails': this.beforeSaveDetails});
			}
			if (this.afterSaveDetails){
				this.on({'afterSaveDetails': this.afterSaveDetails});
			}
			if (this.afterDeleteDetails){
				this.on({'afterDeleteDetails': this.afterDeleteDetails});
			}
			if (this.saveFailed){
				this.on({'saveFailed': this.saveFailed});
			}
		}
		
		this.loadFiles();
	},
	/**
	 * Search don't use on dpInline
	 */
	initSearch: Runner.emptyFn,
	
	initScrollGridBody:Runner.emptyFn,
	
	afterPageReady: function (){},
	
	recalculationGridSize: function(){
		var parPageObj = Runner.pages.PageManager.getAt(this.baseParams.mastertable, this.parId);
		
		if (!parPageObj.isScrollGridBody || parPageObj.recsPerRowList>1)
			return;
		
		$('tr',$("thead", parPageObj.gridElem)).not(function(){
			var trTop  = this;
			if(!$(this).closest('td.dpinline').length){
				$(trTop).css('position','static');
			}
		});
				
		$('tr.runner-bottomrow',$("tbody", parPageObj.gridElem)).not(function(){
			var trBottom  = this;
			if(!$(this).closest('td.dpinline').length){
				$(trBottom).css('position','static');
			}
		});
				
		$('tr.footer',$("tbody", parPageObj.gridElem)).not(function(){
			var trFoot  = this;
			if(!$(this).closest('td.dpinline').length){
				$(trFoot).css('position','static');
			}
		});
		
		$('th.runner-cc',$(parPageObj.gridElem).children("thead")).each(function(){
			$(this).css('width','auto');
		});
							
		//get width of tbody columns
		$('tbody td.runner-cc',parPageObj.gridElem).each(function(){
			$(this).css('width','auto');
		});
		
		var grid = parPageObj.gridElem;
		setTimeout( function() {
			$('th.runner-cc',$(grid).children("thead")).each(function(){
				$(this).css('width',$(this).width()+'px');
			});
			//get width of tbody columns
			$('tbody td.runner-cc',grid).each(function(){
				$(this).css('width',$(this).width()+'px');
			});
			var posAbs = Runner.getAbsolutePosition(grid.get(0),1);
			$(grid.closest(".runner-scrollgrid-inner")).css('overflow-y','hidden');
			var width1 = $(grid.closest(".runner-scrollgrid-inner")).get(0).clientWidth;
			$(grid.closest(".runner-scrollgrid-inner")).css('overflow-y','auto');
			var width2 = $(grid.closest(".runner-scrollgrid-inner")).get(0).clientWidth;
			if (!Runner.isIE){
				$(grid.closest(".runner-scrollgrid-inner")).css('width',posAbs.width+(width1-width2));
			}
			setTimeout( function() { 
				$('tr',$("thead", grid)).not(function(){
					var trTop  = this;
					if(!$(this).closest('td.dpinline').length){
						$(trTop).css('position','absolute').css('top','0px');
					}
				});
				
				$('tr.runner-bottomrow',$("tbody", grid)).not(function(){
					var trBottom  = this;
					if(!$(this).closest('td.dpinline').length){
						$(trBottom).css('position','absolute');
					}
				});
				
				$('tr.footer',$("tbody", grid)).not(function(){
					var trFoot  = this;
					if(!$(this).closest('td.dpinline').length){
						$(trFoot).css('position','absolute');
					}
				});
				
			}, 0);
		} ,0);
	},
	
	initDeleteButton: function(){
		
		var submitUrl = this.shortTName+"_"+this.pageType+".php";
		
		var pageObj = this;
		$("a[id=delete_selected"+this.id+"]").unbind("click").bind("click", function(e){
			var selBoxes = pageObj.getSelBoxes(pageObj.id);
			
			if(selBoxes.length == 0 || !confirm(Runner.lang.constants.TEXT_DELETE_CONFIRM)){
				return false;
			}
			
			var form = new Runner.form.BasicForm({
				standardSubmit: false,
				submitUrl: submitUrl+"?"+$(selBoxes).serialize(),
				method: 'POST',
				id: pageObj.id,
				baseParams: Runner.apply({a: 'delete', mode: Runner.pages.constants.MODE_LIST_DETAILS}, pageObj.baseParams),
				successSubmit: {
					fn: function(respObj, formObj, fieldControls){
						this.fireEvent("afterDeleteDetails");
						if(this.parId)
							Runner.pages.PageManager.getById(this.parId).setRecountFlagForPopup();
						this.pageReloadHn(respObj);
						formObj.destructor();
					},
					scope: pageObj
				}
			});
			
			form.submit();
			return false;
		});
	},
	
	initInline: function(){
		Runner.pages.ListPageDP.superclass.initInline.call(this);
		if (this.inlineAdd){
			this.inlineAdd.stopErrorNotification = true;
			this.inlineAdd.hideSaveButt = this.hideSaveButt;
			
			this.inlineAdd.on("beforeSubmit", function(row, inlineObj, formObj){
				// add base params
				Runner.apply(formObj.baseParams, this.masterKeys);
				return this.fireEvent("beforeSave", row, inlineObj, formObj);
			}, this);
			
			this.inlineAdd.on("rowsEdited", function(allVals, fields, allKeys, allRowIds, isEdited, singleSaveBtnPressed){
				
				if(this.inlineEdit && (this.inlineEdit.recordsSaved || !this.inlineEdit.isRowsEditing() || singleSaveBtnPressed) 
						|| !this.inlineEdit){
					this.inlineAdd.recordsSaved = false;
					if (this.inlineEdit){
						this.inlineEdit.recordsSaved = false;
					}
					this.fireEvent("afterSaveDetails", allVals, fields, allKeys, allRowIds, isEdited);
				}else if(this.inlineEdit){
					this.inlineAdd.recordsSaved = true;
				}
			}, this);
			
			this.inlineAdd.on("submitFailed", function(respObj, hnScope, formObj, fieldControls){
				this.fireEvent("saveFailed", respObj, formObj, fieldControls);
			}, this);
			
			this.inlineAdd.on("beforeRequestControls", function(inlineObj, inlineEditRow, reqParams){
				Runner.apply(reqParams, this.masterKeys);
			}, this);
		}
		if (this.inlineEdit){
			
			this.inlineEdit.stopErrorNotification = true;
			this.inlineEdit.hideSaveButt = this.hideSaveButt;
			
			this.inlineEdit.on("beforeSubmit", function(row, inlineObj, formObj){
				// add base params
				Runner.apply(formObj.baseParams, this.masterKeys);
				return this.fireEvent("beforeSave", row, inlineObj, formObj);
			}, this);
			
			this.inlineEdit.on("rowsEdited", function(allVals, fields, allKeys, allRowIds, isEdited){
				
				if((this.inlineAdd && (this.inlineAdd.recordsSaved || !this.inlineAdd.isRowsEditing())) || !this.inlineAdd){
					if (this.inlineAdd){
						this.inlineAdd.recordsSaved = false;
					}
					this.inlineEdit.recordsSaved = false;
					this.fireEvent("afterSaveDetails", allVals, fields, allKeys, allRowIds, isEdited);
				}else if(this.inlineAdd){
					this.inlineAdd.recordsSaved = true;
				}
			}, this);
			
			this.inlineEdit.on("submitFailed", function(respObj, hnScope, formObj, fieldControls){
				this.fireEvent("saveFailed", respObj, formObj, fieldControls);
			}, this);
			
			this.inlineEdit.on("beforeRequestControls", function(inlineObj, inlineEditRow, reqParams){
				Runner.apply(reqParams, this.masterKeys);
			}, this);
		}
	},
	
	saveAll: function(mKeys){
		var saveAllInlines = false;
		if (this.inlineAdd){
			if (mKeys){
				Runner.apply(this.inlineAdd.baseParams, mKeys);
				this.inlineAdd.baseParams['mastertable'] = this.masterTName;
			}
			saveAllInlines = true;
			this.inlineAdd.saveAll();
		}
		if (this.inlineEdit){
			if (mKeys){
				Runner.apply(this.inlineEdit.baseParams, mKeys);
				this.inlineEdit.baseParams['mastertable'] = this.masterTName;
			}
			saveAllInlines = true;
			this.inlineEdit.saveAll();
		}
		return saveAllInlines;
	},
	
	initSorting: function(){
		var pageObj = this;
		for(var i=0; i<this.listFields.length; i++){
			$("#order_"+Runner.goodFieldName(this.listFields[i])+"_"+this.id).
				mouseout(function(){
					pageObj.delSortHint.call(pageObj);
				}).
					mousemove(function(e){
						pageObj.moveSortHint.call(pageObj,e);
					}).
						mouseover(function(e){
							pageObj.addSortHint.call(pageObj,e);
						}).
							mousedown(function(e){
								Runner.Event.prototype.stopEvent(e);
								var url = pageObj.multipleSortUrl(e, this.href, true) || this.href;								
								Runner.runLoading(pageObj.detCont[0]);
								
								$.runnerAJAX(url, pageObj.baseParams, 
									function(respObj){
										pageObj.pageReloadHn.call(pageObj, respObj)
									}
								);
							}).
								click(function(e){
									Runner.Event.prototype.stopEvent(e);
								});
		}
	},
	
	initPagination: function(){
		$("table[name=paginationTable"+this.id+"]").bind("click", {pageObj: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			var pageObj = e.data.pageObj;
			var target = Runner.Event.prototype.getTarget(e);
			if(target.nodeName != "A") {
				return false;
			}
			Runner.runLoading(pageObj.detCont[0]);
			var pageNum = $(target).attr("pageNum");
			
			var url = Runner.pages.getUrl(pageObj.tName, pageObj.pageType)+"?goto="+pageNum;
			// ajax page reload	
			$.runnerAJAX(url, pageObj.baseParams,
					function(respObj){
						pageObj.pageReloadHn.call(pageObj, respObj)
					});
		});
	},
	
	pageReloadHn: function(respObj){
		Runner.stopLoading(this.detCont[0]);
		if (respObj.success){
			this.destroyVideo();
			Runner.setIdCounter(respObj.idStartFrom);
			
			this.detCont.html(respObj.html);
			
			// set controlsMap
			this.controlsMap = respObj["controlsMap"][this.tName][this.pageType][this.pageId];
			
			if (this.controlsMap.gridRows.length){
				this.hideBrick("message");
			} else {
				this.showBrick("message");
			}
			if (respObj.delMess){
				this.showBrick("message");
			}
			
			this.initGridElem();
			this.initResize();
			this.initDetails();
			this.initPopupLinks();
			this.initPagination();
			this.initSelectAll();
			
			if (this.inlineAdd){
				this.inlineAdd.reInit(this.controlsMap.gridRows);
			}
			if (this.inlineEdit){
				this.inlineEdit.reInit(this.controlsMap.gridRows);
			}
			this.initHeaderCheckBox()
			this.initSorting();
			this.initRunnerButtons();
			this.initDeleteButton();
			this.initGridHover();
			
			var gMaps = this.controlsMap.gMaps;
			if (this.mapManager && gMaps && gMaps.isUseGoogleMap){
				this.mapManager.init(gMaps.mapsData);
			}
			
			if(typeof respObj.viewControlsMap != "undefined" 
				&& typeof respObj.viewControlsMap[this.tName][this.pageType][this.pageId].controls != "undefined"){
				var viewControls = respObj.viewControlsMap[this.tName][this.pageType][this.pageId].controls;
				for(var i = 0; i < viewControls.length; i++){
					viewControls[i].table = this.tName;
					var ctrl = Runner.viewControls.ViewControlFabric(viewControls[i], this.pageType, this.pageCont, this);
					ctrl.init();
				}
			}
			
		} else {
			$("#message_block"+this.id).html("Submit failed!");	
		}
	}
});

Runner.pages.ListPageMobile = Runner.extend(Runner.pages.ListPage, {
	
	morePanel: null,
	
	menuPanel: null,
	
	srchOptDivMobile: null,
	
	bricksArr: null,
	
	bricksArrList: null,
	
	constructor: function(cfg){
		Runner.pages.ListPageMobile.superclass.constructor.call(this, cfg);
		
		this.useResize = false;
		
		this.morePanel = $("#more"+this.id);
		this.menuPanel = $("#menu_mobile_"+this.id);
		this.srchOptDivMobile = $(".searchOptions", this.pageCont);
		
		this.bricksArr = ["masterinfo_mobile","vmenu_mobile","tableinfo_mobile","search_mobile","vmenu","searchpanel","backbutton","morelink_mobile","message","grid","pagination","languages","loggedas","details_found","page_of","recsperpage","fulltext_mobile","vmsearch2","cancelbutton_mobile"];
		
		this.bricksArrList = ["masterinfo_mobile","vmenu_mobile","tableinfo_mobile","search_mobile","morelink_mobile","message","grid","pagination","languages","loggedas","details_found","page_of","recsperpage"]
		
	},
	
	init: function(){
		Runner.pages.ListPageMobile.superclass.init.call(this);
		
		this.srchOptDivMobile.show();
		// Bind the event. For Back/Forward browser button
		window.location.hash = "#list";
		var pageObj = this;
		if ( window.addEventListener ) {
			window.addEventListener( 'hashchange', pageObj.handler, false );
		} else if ( window.attachEvent ) {
			window.attachEvent( 'onhashchange', pageObj.handler);
		 }
	},
	
	handler: function(){
		if (window.location.hash=='#search'){
				$("#search_mobile_button").click();	
			}
			if (window.location.hash=='#menu'){
				$("#menu_button").click();
			}
			if (window.location.hash=='#list'){
				$("#backbutton").click();
			}
	},
	
	initMoreButton: function(id){

		if (typeof id == "undefined"){
			id = this.id;
		}
		var pageObj = this;
		$("#morebutton").unbind("click").bind("click", function(e){
			if (pageObj.morePanel.css("display")=="none") {
				pageObj.morePanel.css("left",e.clientX-pageObj.morePanel.width()+5);
				pageObj.morePanel.css("top",e.clientY+5);
				pageObj.morePanel.css("display","block");
			}
			return false;
		});
	},
	
	initMenuMobileButton: function(id){
		
		if (typeof id == "undefined"){
			id = this.id;
		}
		var pageObj = this;
		$("#menu_button").unbind("click").bind("click", function(e){
			pageObj.hideBricks(pageObj.bricksArr);
			pageObj.showBricks(["vmenu","backbutton"]);
			Runner.menu.TreeLikeVmenu.prototype.openMenuOnLoad();
			
		});
	}, 
	
	initMoreClosePanel: function(id){

		if (typeof id == "undefined"){
			id = this.id;
		}
		var pageObj = this;
		$("#more_close").unbind("click").bind("click", function(e){
			if (pageObj.morePanel.css("display")=="block") {
				pageObj.morePanel.css("display","none");
			}
			return false;
		});
	},
	
	initBackButton: function(id){
		
		var pageObj = this;
		$("#backbutton").unbind("click").bind("click", function(e){
			pageObj.hideBricks(pageObj.bricksArr);
			pageObj.showBricks(pageObj.bricksArrList);
		});
	},
	
	initSearchPanelButton: function(id){
		
		if (typeof id == "undefined"){
			id = this.id;
		}
		var pageObj = this;
		$("#search_mobile_button").unbind("click").bind("click", function(e){
			pageObj.hideBricks(pageObj.bricksArr);
			if(typeof pageObj.controlsMap.search.googleLikeFields != "undefined"
				&& pageObj.controlsMap.search.googleLikeFields.length > 0)
				pageObj.showBricks(["vmsearch2","searchpanel","backbutton"]);
			else
				pageObj.showBricks(["searchpanel","backbutton"]);
		});
	},
	
	initRowClick: function(id){

		if (typeof id == "undefined"){
			id = this.id;
		}
		var pageObj = this;
			$("td, th", "tr[id^=gridRow]").not('[ieditcont=checkBox], [ieditcont=all], [name=details], [class~=runner-cg]').unbind("click").bind("click", function(e){
				var target = Runner.Event.prototype.getTarget(e);
				if(target.nodeName != "A" || !$(target).attr("query")) {
					var trId = $(this).closest('tr[id^=gridRow]')[0].id;
					$("div[id^=gridRow][name=flybutton]").each(function (){
						if (this.id==trId && $(this).css("display")=="none"){
							$(this).css("left",e.pageX+5);
							if (!pageObj.isScrollGridBody || pageObj.recsPerRowList>1)
								$(this).css("top",e.pageY+5);
							$(this).css("display","block");
						}
						else {
							$(this).css("display","none");
						}
					});
				}
			});
	},
	
	largeTextOpenerDelegate: function(e){
		var pageObj = this;
		var target = Runner.Event.prototype.getTarget(e);
		if(target.nodeName != "A" || !$(target).attr("query")) {
			return false;
		}
		
		Runner.Event.prototype.stopEvent(e);
		
		var query = $(target).attr("query");
		
		$.runnerAJAX(query, {id: this.id, rndVal: Math.random()}, function(respObj){
			var brickContent = "<div class=\"runner-fulltext-content\">";
	    	if (respObj.success){
				brickContent += respObj.textCont;
	    	}else{
	    		brickContent +=respObj.error || "Server error";
	    	}
			brickContent += "</div>";
			pageObj.replaceBrickContentHTMLWith("fulltext_mobile", brickContent);
			pageObj.hideBricks(pageObj.bricksArr);
			pageObj.showBricks(["fulltext_mobile", "backbutton"]);
		});	
		
	},

	initSelectAll: function(){
		var pageObj = this,
			selectAll = $('#select_all'+this.id);
			
		if (!selectAll.length){
			return false;
		}
		selectAll[0].checkAllStatus = false;
		selectAll.bind("click", function(e){
			var that = this;
			this.checkAllStatus = !this.checkAllStatus;
			$('input[type=checkbox][id^=check'+pageObj.id+'_]').each(function(){
				this.checked = that.checkAllStatus;
			});
			
			if (e.stopImmediatePropagation){
				e.stopImmediatePropagation();
			}
			pageObj.morePanel.css("display","none");
		});
	},
	
	initSorting: Runner.emptyFn,
	
	initButtons: function(){
		Runner.pages.ListPageMobile.superclass.initButtons.call(this);
		this.initMoreButton();
		this.initMenuMobileButton();
		this.initMoreClosePanel();
		this.initSearchPanelButton();
		this.initRowClick();
		this.initBackButton();
	}
	
});
Runner.pages.ReportPageMobile = Runner.extend(Runner.pages.ListPageMobile, {
	
	pageType: Runner.pages.constants.PAGE_REPORT,
	
	constructor: function(cfg){
		Runner.pages.ReportPageMobile.superclass.constructor.call(this, cfg);
		this.bricksArr = ["masterinfo_mobile","vmenu_mobile","tableinfo_mobile","search_mobile","vmenu","searchpanel","backbutton","message","report","pagination","languages","loggedas","fulltext_mobile"];
		
		this.bricksArrList = ["masterinfo_mobile","vmenu_mobile","tableinfo_mobile","search_mobile","message","report","pagination","languages","loggedas"];
		
	},
	init: function(){
		Runner.pages.ReportPageMobile.superclass.init.call(this);
		this.fireEvent('afterInit', this, this.proxy, this.id);
		
		$(this.getBrickElem('report')).bind("click", this.reportClickHn.createDelegate(this, [], true));
	},
	
	reportClickHn: function(e){
		this.largeTextOpenerDelegate(e);
	},
	
	getPaginationLink: function(pageNum,linkText,cls){
		return '<a href="#" pageNum="'+pageNum+'" '+(cls ? 'class="pag_n"' : '')+' style="text-decoration: none;">' + linkText + '</a>';
	},
	
	initAdvSearch: function(){
		pageObj = this;
		$("#advButton"+this.pageId).bind("click", function(e){
			window.location.href = pageObj.shortTName + "_search.php?"+pageObj.initCrossTableParams();
		});
	},
	
	/**
	 * initRowClick don't use on report
	 */
	initRowClick: Runner.emptyFn,
	
	initButtons: function(){
		this.initMenuMobileButton();
		this.initSearchPanelButton();
		this.initBackButton();
	}

});
Runner.pages.ReportPage = Runner.extend(Runner.pages.DataPageWithSearch, {
	
	pageType: Runner.pages.constants.PAGE_REPORT,
	
	init: function(){
		Runner.pages.ReportPage.superclass.init.call(this);
		this.fireEvent('afterInit', this, this.proxy, this.id);
		
		$(this.getBrickElem('report')).bind("click", this.reportClickHn.createDelegate(this, [], true));
		
		this.initMaps();
	},
	
	reportClickHn: function(e){
		this.largeTextOpenerDelegate(e);
	},
	
	constructor: function(cfg){
		Runner.pages.ReportPage.superclass.constructor.call(this, cfg);
	},
	
	getPaginationLink: function(pageNum,linkText,cls){
		return '<a href="#" pageNum="'+pageNum+'" '+(cls ? 'class="pag_n"' : '')+' style="text-decoration: none;">' + linkText + '</a>';
	},
	
	initAdvSearch: function(){
		pageObj = this;
		$("a[id=advButton"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_search.php?"+pageObj.initCrossTableParams();
		});
	},
	
	initPrintFrLink: function(){
		pageObj = this;
		$("a[id=print_"+this.pageId+"]").bind("click", function(e){
			window.open(pageObj.shortTName + "_print.php?"+pageObj.initCrossTableParams(),'wPrint');
		});
	},

	initExcelLink: function(){
		pageObj = this;
		$("a[id=export_to_excel"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_print.php?all=1&format=excel&"+pageObj.initCrossTableParams();
		});
	},
	
	initWordLink: function(){
		pageObj = this;
		$("a[id=export_to_word"+this.pageId+"]").bind("click", function(e){
			window.location.href = pageObj.shortTName + "_print.php?all=1&format=word&"+pageObj.initCrossTableParams();
		});
	},
	
	initPDFLink: function(){
		pageObj = this;
		$("a[id=export_to_pdf"+this.pageId+"]").bind("click", function(e){
			window.open(pageObj.shortTName + "_print.php?all=1&format=pdf&"+pageObj.initCrossTableParams(),'wPrint');
		});
	},
	
	initCrossTableParams: function(){
		advAttr = "";
		shref="";
		shref=window.location.href;
		pos=shref.indexOf("&axis_x",0);
		if(pos>=0)
		{
			shref=shref.substr(0,pos);
			pos2=shref.indexOf("a=",0);
			if(pos2>=0)
				shref=shref.substr(pos2);
		}
		if($("#select_group_x")[0])
		{
			axis_x = $("#select_group_x")[0].value;
			axis_y = $("#select_group_y")[0].value;
			field = $("#select_data")[0].value;
			grfunc_value=0;
			grfunc=$("input[name=group_func]");
			for(i=0;i<grfunc.length;i++)
			{
				if(grfunc[i].checked)
					grfunc_value=grfunc[i].value;
			}
			advAttr = "axis_x="+axis_x+"&axis_y="+axis_y+"&field="+field+"&group_func="+grfunc_value+"&"+shref;
		}
		return advAttr;
	},

	initMaps: function(){
		if (!this.controlsMap.gMaps || !this.controlsMap.gMaps.isUseGoogleMap){
			return false;
		}
		
		var initMaps = function(){		
			this.mapManager = new Runner.controls.MapManager(this.controlsMap.gMaps);		
			this.mapManager.init();
		}
		
		if (GlobalGmapLoader){
			GlobalGmapLoader.onLoad(initMaps,this);
		}
	}
});
Runner.pages.ChartPageMobile = Runner.extend(Runner.pages.ListPageMobile, {
	
	pageType: Runner.pages.constants.PAGE_CHART,
	
	init: function(){
		Runner.pages.ChartPageMobile.superclass.init.call(this);
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	constructor: function(cfg){
		Runner.pages.ChartPageMobile.superclass.constructor.call(this, cfg);
		this.bricksArr = ["masterinfo_mobile","vmenu_mobile","charttableinfo_mobile","search_mobile","vmenu","searchpanel","backbutton","message","chart","languages","loggedas"];
		
		this.bricksArrList = ["masterinfo_mobile","vmenu_mobile","charttableinfo_mobile","search_mobile","message","chart","languages","loggedas"];
		
	},
	
	initButtons: function(){
		this.initMenuMobileButton();
		this.initSearchPanelButton();
		this.initBackButton();
		
	}
});
Runner.pages.ChartPage = Runner.extend(Runner.pages.DataPageWithSearch, {
	
	pageType: Runner.pages.constants.PAGE_CHART,
	
	init: function(){
		Runner.pages.ChartPage.superclass.init.call(this);
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	constructor: function(cfg){
		Runner.pages.ChartPage.superclass.constructor.call(this, cfg);
	}
});

Runner.pages.CheckboxesPage = Runner.extend(Runner.pages.ListPage, {
	/**
	 * Count of current functions wich waiting for AJAX result and set disable state for controls
	 */
	disableCounter: 0,
	/**
	 * List of table colemn headers checkboxes
	 * {array}
	 */
	columnHeaders: null,
	/**
	 * List of table rows headers 
	 * {array}
	 */
	rowHeaders: null,
	/**
	 * List of actions to send to the ug_group via AJAX
	 * {array}
	 */
	ajaxActions: null,
	/**
	 * Checkboxes id postfix (for the group value in RightsPage)
	 * {string}
	 */
	cbxPostfix: '',
	/**
	 * Left (row) checkboxes name prefix
	 * {string}
	 */
	rowCbxPrefix: '',
	/**
	 * Dummy array. Filling only in RightsPage, where represent a list of existing groups
	 * {array} 
	 */
	groups: [''],
	/**
	 * List of real tables or users names
	 * {array}
	 */
	realValues: null,
	/**
	 * List of default values (rights or membership)
	 * {array}
	 */
	defaultValues: {},
	
	constructor: function(cfg){
		this.ajaxActions = {};
		this.columnHeaders = [];
		Runner.pages.CheckboxesPage.superclass.constructor.call(this, cfg);	
	},
	
	init: function(){
		Runner.pages.CheckboxesPage.superclass.init.call(this);
		
		this.realValues = Runner.pages.PageSettings.getTableData(this.tName, "realValues");
		this.initGeneralControls();
	},
	
	/**
	 * initGeneralControls
	 * Init all general controls
	 */
	initGeneralControls: function(){
		var pageObj = this;
		$('#saveBtn').click(function(){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			pageObj.saveStateToDB(pageObj.saveCheckboxesState());
			return false;
		});
		$('#resetBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			pageObj.resetCheckboxes(); 
			return false;
		});
	},
	
	/**
	 * initOrdinaryCheckboxes
	 * Set checked state and bind handlers with all ordinary checkboxes
	 * or one concret checkbox if param passed
	 * @param {object} checkbox to bind handler
	 */
	initOrdinaryCheckboxes: function(checkbox){
		var pageObj = this, 
			saveState = function(){	
				pageObj.checkRowAndColumn(); 
			};
		if(checkbox != undefined){
			$(checkbox).click(saveState);
		}else{
			for(var g = 0; g < pageObj.groups.length; g++){
				$.each(pageObj.rowHeaders, function(rIndex, rValue){
					var cbName = '_' + rIndex + '_' + pageObj.groups[g];
					$.each(pageObj.columnHeaders, function(key, cheader){
						if($('#cb' + cheader + cbName).attr('id') != undefined){
							$('#cb' + cheader + cbName).click(saveState);
						}
					});
				});
			}
		}	
	},
	
	/**
	 * initRowCheckboxes
	 * Set checked state and bind handlers with left checkboxes (for the all rights of table) 
	 */
	initRowCheckboxes: function(){
		var pageObj = this, 
			rowclick = function(){	
				var chkBox = this;
				$.each(pageObj.columnHeaders, function(key, cheader){
					$('#cb' + cheader + '_' + $(chkBox).attr('id') + '_' + pageObj.cbxPostfix).each(function() {
						if(this.style.display != 'none'){ 
							this.checked = $(chkBox).prop('checked');
						}
					});
				});	
				pageObj.checkRowAndColumn();
			};
		$('input:checkbox[name^="' + this.rowCbxPrefix + '"]').each(function(){
			$(this).click(rowclick);
		});
	},
	
	/**
	 * initHeadCheckboxes
	 * Set checked state and bind handlers with top checkboxes (for the one right to all tables) 
	 */
	initHeadCheckboxes: function(){
		// Handler for head (top) checkbox in a column
		var pageObj = this, 
			headclick = function(){
				var chkBox = this;	
				$('input[id^=' + $(chkBox).attr('id') + '_]').each(function(){
					if($(this).css('display') != 'none'){ 
						$(this).prop('checked', $(chkBox).prop('checked'));
					}
				});
				pageObj.checkRowAndColumn();
			};
		$.each(this.columnHeaders, function(key, cheader){
			$('#cb' + cheader).click(headclick);
		});
	},
	
	/**
	 * makeArrayWithIndexes
	 * Create array identical to input parameter, but with strongly specified indexes
	 * @parameter {array} input array
	 */
	makeArrayWithIndexes: function(inputArray){
		var resultArray = new Object();
		$.each(inputArray, function(ind, element){
			resultArray[ind] = element;
		});
		return resultArray;
	},
	
	/**
	 * saveStateToDB
	 * Save all current changes in database
	 * @param {array} array of current values
	 */
	saveStateToDB: function(valuesSet){
		var pageObj = this;
		$('input:checkbox').prop('disabled', true);
		this.disableControls(true);
		$.runnerAJAX('ug_group.php', {
				rndval: Math.random(),
				state: JSON.stringify(valuesSet),
				realValues: JSON.stringify(pageObj.rowHeaders),
				a: this.ajaxActions.saveState
			},
			function(respObj){
				if(!respObj.success){
					pageObj.replaceBrickContentHTMLWith('message', respObj.error);
					pageObj.showBrick('message');
				}
				else{
					pageObj.hideBrick('message');
					pageObj.defaultValues = pageObj.saveCheckboxesState();
				}
				$('input:checkbox').prop('disabled', false);
				pageObj.disableControls(false);
			});
	},
	
	/**
	 * checkRowAndColumn
	 * Set check/uncheck state for the row(left) and column (top) checkboxes
	 */
	checkRowAndColumn: function (){
		if(this.disableCounter > 1){
			return;
		}	
		var pageObj = this, 
			colsState = [], 
			rowsState = [];
		for(var i = 0; i < this.columnHeaders.length; i++){
			$.each(this.rowHeaders, function(rIndex, rValue){
				// Set default values
				if(colsState[i] == undefined){
					colsState[i] = [pageObj.columnHeaders[i], true];
				}
				if(rowsState[rIndex] == undefined){
					rowsState[rIndex] = true;
				}
				var cbxName = '#cb' + pageObj.columnHeaders[i] + '_' + rIndex + '_' + pageObj.cbxPostfix;
				if($(cbxName).attr('id') != undefined	&& !$(cbxName).prop('checked')){
					colsState[i][1] = rowsState[rIndex] = false;
				}
			});
		}
		$.each(colsState, function(key, cstate){
			$('#cb' + cstate[0]).prop('checked', this[1]);
		});
		$.each(rowsState, function(key, rstate){
			$('input:checkbox[name="' + pageObj.rowCbxPrefix + key + '"]:eq(0)').prop('checked', rstate);
		});
	}
});
Runner.pages.MembersPage = Runner.extend(Runner.pages.CheckboxesPage, {
		
	pageType: Runner.pages.constants.PAGE_ADMIN_MEMBERS,
	
	constructor: function(cfg){
		Runner.pages.MembersPage.superclass.constructor.call(this, cfg);
		
		this.rowHeaders = this.makeArrayWithIndexes(Runner.pages.PageSettings.getTableData(this.tName, "usersList"));
		this.columnHeaders = Runner.pages.PageSettings.getTableData(this.tName, "rightsGroups");
		this.rowCbxPrefix = 'user_';
		this.ajaxActions = {
			saveOne: 'saveMembership',
			saveRow: 'saveMembershipRow',
			saveState: 'saveMembership',
			saveColumn: 'saveMembershipColumn'
		};
	},
	
	init: function(){
		Runner.pages.MembersPage.superclass.init.call(this);
	
		this.initOrdinaryCheckboxes();
		this.initRowCheckboxes();
		this.initHeadCheckboxes();
		this.defaultValues = this.saveCheckboxesState();
	},
	
	/**
	 * initButtons
	 * Bind handlers with buttons 
	 */
	initButtons: function(){
		Runner.pages.MembersPage.superclass.initButtons.call(this);	
	},	
	
	/**
	 * saveCheckboxesState
	 * Save membership to be able to restore default values or to save current values
	 * @return {object} array wich contains current state
	 */
	saveCheckboxesState: function(){
		var pageObj = this, result = {};
		$.each(pageObj.rowHeaders, function(ukey, user){
			$.each(pageObj.columnHeaders, function(key, group) {
				if($('#cb' + group + '_' + ukey + '_').prop('checked')){
					if(result[group] == undefined)
						result[group] = [];
					result[group].push(ukey);
				}
			});
		});
		return result;
	},
		
	/**
	 * resetCheckboxes
	 * Reset checkboxes to default values after database reset (in superclass)
	 */
	resetCheckboxes: function(){
		$('input:checkbox').prop('checked', false);
		$.each(this.defaultValues, function(group, users){
			$.each(users, function(key, user){
				$('#cb' + group + '_' + user + '_').prop('checked', true);
			});
		});
		this.checkRowAndColumn();
	},
	
	/**
	 * disableControls
	 * Disable buttons list while saving changes, or enable it after saving
	 * @param {bool} disable or enable flag
	 */
	disableControls: function(isDisable){
		this.disableCounter += isDisable ? 1 : -1;
		if(isDisable){
			this.addDisabledClass($('#resetBtn'));
			$('#resetBtn').prop('disabled', isDisable);
		}
		else{
			if(this.disableCounter == 0){
				this.delDisabledClass($('#resetBtn'));
				$('#resetBtn').prop('disabled', isDisable);
			}
		}
	}
});
Runner.pages.RightsPage = Runner.extend(Runner.pages.CheckboxesPage, {
	/**
	 * Type of the page 
	 */	
	pageType: Runner.pages.constants.PAGE_ADMIN_RIGHTS,
	/**
	 * Text message for adding new group alert
	 * {string}
	 */
	TEXT_AA_ADD_NEW_GROUP: 'Add new group',
	/**
	 * Text message for renaming new group alert
	 * {string}
	 */
	TEXT_AA_RENAMEGROUP: 'Rename group',
	/**
	 * Index of renaming position in the groups list
	 * {integer}
	 */
	renameidx: -1,
	/**
	 * List of existing groups
	 * {array}
	 */
	groups: null,
	/**
	 * Set of mask chars
	 * {array}
	 */
	masks: [],
	
	constructor: function(cfg){
		Runner.pages.RightsPage.superclass.constructor.call(this, cfg);
		
		this.groups = Runner.pages.PageSettings.getTableData(this.tName, "rightsGroups");
		this.rowHeaders = this.makeArrayWithIndexes(Runner.pages.PageSettings.getTableData(this.tName, "rightsTables"));
		this.columnHeaders = ['add', 'edt', 'del', 'lst', 'exp', 'imp', 'adm'];
		this.rowCbxPrefix = 'table_';
		this.ajaxActions = {
			saveOne: 'saveRight',
			saveRow: 'saveRightRow', 
			saveState: 'saveRights',
			saveColumn: 'saveTopRow'
		};
	},
	
	init: function(){
		Runner.pages.RightsPage.superclass.init.call(this);
		
		this.initMasks();
		this.initSelGroup();
		this.initCheckboxes();
		this.initRightsControls();
		this.defaultValues = this.saveCheckboxesState();
	},
	
	/**
	 * initSelGroup
	 * Set attributes and properties
	 */
	initSelGroup: function(){
		$('.group').attr('size', this.groups.length);
		if(!$('.group :selected')){
			$('.group :first').prop("selected", true);
		}
	},
	
	/**
	 * initMasks
	 * Fill the masks array
	 */
	initMasks: function(){
		this.masks['add'] = 'A';
		this.masks['edt'] = 'E';
		this.masks['del'] = 'D';
		this.masks['lst'] = 'S';
		this.masks['exp'] = 'P';
		this.masks['imp'] = 'I';
		this.masks['adm'] = 'M';
	},
	
	/**
	 * initRightsControls
	 * Bind handlers with controls 
	 */
	initRightsControls: function(){
		var pageObj = this;
		$('#saveGroupBtn').click(function(){
			pageObj.save();
		});
		$('#addGroupBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			pageObj.disableGroupButtons(true);
			$('.group').prop('disabled', true);
			$('.runner-ugaddarea').show();
			$('.groupname').focus();
			$('.groupname').val(pageObj.makename('newgroup'));
			$('.gmessage').html(pageObj.TEXT_AA_ADD_NEW_GROUP);
			pageObj.renameidx = -1;
		});
		$('#delGroupBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			pageObj.deletegroup(); 
		});
		$('#renGroupBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			if($('.group option:selected').val() < 0){
				return false; 
			}
			pageObj.disableGroupButtons(true);
			$('.group').prop('disabled', true);
			$('.runner-ugaddarea').show();
			$('.groupname')[0].focus();
			$('.groupname').val($('.group option:selected').html());
			$('.gmessage').html(pageObj.TEXT_AA_RENAMEGROUP);
			pageObj.renameidx = $('.group')[0].selectedIndex;
		});
		$('.groupname').keydown(function(event){
			e = event; 
			if(!e) e = window.event; 
			if(e.keyCode != 13){ 
				return true; 
			}
			e.cancel = true; 
			pageObj.save(); 
			return false;
		});
		$('#cancelBtn').click(function(){
			pageObj.hideBrick('message');
			$('.runner-ugaddarea').hide(); 
			$('.group').prop('disabled', false);
			pageObj.disableGroupButtons(false);
			if(pageObj.renameidx >= 0){
				$('.groupname').val('');
			}
		});
		this.initRowCheckboxes();
	},
	
	/**
	 * initCheckboxes
	 * Create function which fill checkboxes in the grid according selected group rights 
	 * and bind this function to the group list
	 */
	initCheckboxes: function(){
		var pageObj = this;
		
		this.initHeadCheckboxes();
		this.initOrdinaryCheckboxes();
		
		// Handler for group list selected index changing
		var fillboxes = function (){
			var group = $('.group :selected').val(), cbxObj = new Object();
			pageObj.cbxPostfix = group;
			// Fill the flags array with default values
			$.each(pageObj.columnHeaders, function(key, rightType){ cbxObj[rightType] = false; });
			// Create AJAX handler for the rights checkboxes

			for(var g = 0; g < pageObj.groups.length; g++){
				$.each(pageObj.rowHeaders, function(tIndex, table){
					var display = false, cbName = '_' + tIndex + '_' + pageObj.groups[g];
					if(pageObj.groups[g] == group){
						var tbl_uncheck = false;
						display = true;
						// Check, if all checkboxes in a row are checked
						$.each(pageObj.columnHeaders, function(key, rightType){ 
							if($('#cb' + rightType + cbName).attr('id') != undefined){
								if((!tbl_uncheck || !cbxObj[rightType]) 
										&& !$('#cb' + rightType + cbName).prop('checked')){
									tbl_uncheck = cbxObj[rightType] = true;
								}
							}
						});
					}
					// Show all checkboxes wich belongs to selected group and hide others
					$.each(pageObj.columnHeaders, function(key, rightType){ 
						if($('#cb' + rightType + cbName)){
							$('#cb' + rightType + cbName).css('display', display ? '' : 'none');
						}
					});
				});
			}

			pageObj.checkRowAndColumn();
			pageObj.setButtonsActiveState();
		};
		$('.group').change(fillboxes);
		$('.group').trigger('change');
	},
	
	/**
	 * saveCheckboxesState
	 * Save rights for all groups to be able to restore default values or to save current values
	 * @return {object} array wich contains current state
	 */
	saveCheckboxesState: function(){
		var pageObj = this, result = {};
		$('.group option').each(function(){
			var group = $(this).val();
			$.each(pageObj.rowHeaders, function(tkey, table){
				$.each(pageObj.columnHeaders, function(key, rightType) {
					if($('#cb' + rightType + '_' + tkey + '_' + group).prop('checked')){
						if(result[group] == undefined){
							result[group] = {};
						}
						if(result[group][tkey] == undefined){
							result[group][tkey] = '';
						}
						result[group][tkey] += pageObj.masks[rightType];
					}
				});
			});
		});
		return result; 
	},
	
	/**
	 * disableControls
	 * Disable buttons and groups list while saving changes, or enable it after saving
	 * @param {bool} disable or enable flag
	 */
	disableControls: function(isDisable){
		this.disableCounter += isDisable ? 1 : -1;
		if(isDisable){
			this.disableGroupButtons(isDisable);
			this.addDisabledClass($('#resetBtn'));
			$('.group').prop('disabled', isDisable);
		}else{
			if(this.disableCounter == 0){
				this.disableGroupButtons(isDisable);
				this.delDisabledClass($('#resetBtn'));
				$('.group').prop('disabled', isDisable);
			}
		}
	},
	
	/**
	 * disableGroupButtons
	 * Disable 'Add', 'Del', 'Rename' buttons or enable it according to param
	 * @param {bool} disable or enable flag
	 */	
	disableGroupButtons: function(isDisable){
		if(isDisable){
			this.addDisabledClass($('#addGroupBtn'));
			this.addDisabledClass($('#delGroupBtn'));
			this.addDisabledClass($('#renGroupBtn'));
		}else{
			this.delDisabledClass($('#addGroupBtn'));
			$('#addGroupBtn').prop('disabled', isDisable);
			this.setButtonsActiveState();
		}
	},
	
	/**
	 * setButtonsActiveState
	 * Set state for Delete and Rename buttons according to selected group
	 * @param {integer} selected group
	 */
	setButtonsActiveState: function(){
		if($('.group :selected').val() < 0){
			this.addDisabledClass($('#delGroupBtn'));
			this.addDisabledClass($('#renGroupBtn'));
		}else{
			this.delDisabledClass($('#delGroupBtn'));
			this.delDisabledClass($('#renGroupBtn'));
			//class hover not init. reinit buttons
			this.initRunnerButtons();
			$('.groupname').val($('.group :selected').html());
		}
	},
	
	/**
	 * deletegroup
	 * Delete selected group
	 */
	deletegroup: function(){
		var pageObj = this, id = $('.group :selected').val();
		if(id < 0){
			return false;
		}
		if(!confirm('Do you really want to delete group' + " " + $('.group :selected').html() + '?')){ 
			return;
		}
		$.runnerAJAX('ug_group.php',{	
				rndval: Math.random(),
				id: id,
				a: 'del'
			},
			function(respObj){
				if(!respObj.success){
					pageObj.replaceBrickContentHTMLWith('message', 'Error deleting record!');
					pageObj.showBrick('message'); 
					return;
				}
				pageObj.hideBrick('message');
				for(var i = 0; i < pageObj.groups.length; i++)
					if(pageObj.groups[i] == id){
						pageObj.groups.splice(i, 1);
						break;
					}
				var newId = $('.group :selected').prev().val();
				$('.group :selected').remove();
				if(newId){
					$(".group [value='" + newId + "']").attr('selected', 'selected');
				}else{
					$('.group :first').attr('selected', 'selected');
				}
				$('.group').trigger('change');
				$('.group').attr('size', pageObj.groups.length);
				$('input[type=checkbox][id$=_' + id + ']').each(function(){
					this.parentNode.removeChild(this);
				});
			}
		);
	},
	
	/**
	 * resetCheckboxes
	 * Reset checkboxes to default values after database reset (in superclass)
	 */
	resetCheckboxes: function(){
		var pageObj = this;
		$('.group option').each(function(){
			var group = $(this).val();
			$.each(pageObj.rowHeaders, function(tkey, table){
				$.each(pageObj.columnHeaders, function(rkey, rightType){
					$('#cb' + rightType + '_' + tkey + '_' + group).prop('checked',
						(pageObj.defaultValues[group] && pageObj.defaultValues[group][tkey] 
							&& pageObj.defaultValues[group][tkey].indexOf(pageObj.masks[rightType]) > -1) ? true : false);
				});
			});
		});
		this.checkRowAndColumn();
	},
	
	/**
	 * makename
	 * Make a name for a new group
	 * @param {string} name of the previous group 
	 */
	makename: function (group){
		var n = 1,
			gr = $('.group option'),
			tgroup = group;
			
		while(1){
			for(var i = 0; i < gr.length; i++){
				if(tgroup == $(gr[i]).html())
					break;
			}	
			if(i == this.groups.length){
				return tgroup;
			}
			tgroup = group + n;
			n++;
		}
	},
	
	/**
	 * save
	 * Save new group or save new name for the existing group
	 * @param {string} name of the group
	 */
	save: function (){
		var pageObj = this;
		for(var i = 0; i < $('.group option').length; i++){
			if($('.group option:eq(' + i + ')').html() == $('.groupname').val() && this.renameidx != i){
				pageObj.replaceBrickContentHTMLWith('message', 'Group with such name is allready exist!');
				pageObj.showBrick('message');
				return;
			}
		}
		if(this.renameidx == -1){
			var oldGroup = $('.group :selected').val();
			$.runnerAJAX('ug_group.php',{	
					rndval: Math.random(),
					name: $('.groupname').val(),
					a: 'add'
				},
				function(respObj){
					if(!respObj.success){
						pageObj.replaceBrickContentHTMLWith('message', 'Error adding group!');
						pageObj.showBrick('message');
						return;
					}
					pageObj.hideBrick('message');
					var id = respObj.id; 
					$('.runner-ugaddarea').hide();
					//	create and append checkboxes
					$('input[type=checkbox][id$=_-1]').each(function(){
						var cbid = $(this).attr('id').substring(0, $(this).attr('id').length - 2);
						// hide previously selected group checkboxes
						$('#' + cbid + oldGroup).hide();
						cbid += id;
						$(this.parentNode).append('<input type="checkbox"  id="' + cbid + '" name="' + cbid + '">');
						// bind onclick handler
						pageObj.initOrdinaryCheckboxes($('#' + cbid));
					});
					pageObj.groups.push(id);
					$('.group').append($('<option value="' + id + '">' + $('.groupname').val() + '</option>'));
					$('.group :last').prop('selected', true);
					$('.group').attr('size', pageObj.groups.length);
					$('.group').trigger('change');
					$('.groupname').val('');
					$('.group').prop('disabled', false);
					pageObj.disableGroupButtons(false);
				});
		}else{
			var idx = this.renameidx;
			this.renameidx = -1;
			if($('.group :selected').html() == $('.groupname').val()){
				this.saveEnd();
			}
			$.runnerAJAX('ug_group.php',{	
				rndval: Math.random(),
				id: $(".group option:eq(" + idx + ")").val(),
				name: $('.groupname').val(),
				a: 'rename'
			},
			function(respObj){
				if(!respObj.success){
					pageObj.replaceBrickContentHTMLWith('message', 'Error renaming group!');
					pageObj.showBrick('message');
					return;
				}
				$(".group option:eq(" + idx + ")").html($('.groupname').val());
				pageObj.saveEnd();
			});
		}
	},
	
	/**
	 * saveEnd
	 * Restore controls state after save
	 */
	saveEnd: function(){
		this.hideBrick('message');
		$('.runner-ugaddarea').hide();
		$('.groupname').val('');
		$('.group').prop('disabled', false);
		this.disableGroupButtons(false);
	}
});

Runner.pages.MembersPageAD = Runner.extend(Runner.pages.ListPageCommon, {
		
	pageType: Runner.pages.constants.PAGE_ADMIN_MEMBERS,
	
	rows: null,
	
	constructor: function(cfg){
		Runner.pages.MembersPageAD.superclass.constructor.call(this, cfg);
		this.baseParams.id = this.pageId;
		this.bricksForReload = ["grid","message","pagination"];
		this.rows = this.controlsMap.gridRows;
	},

	destructor: function(){
		Runner.pages.MembersPageAD.superclass.destructor.call(this);
		this.pageCont = null;
		this.parObj.disableGroupButtons(false);
	},	
	
	init: function(){
		Runner.pages.ListPageFly.superclass.init.call(this);
		this.initButtons();
		this.initRows();
		
	},
	
	initAddGrLink: function(link, row){
		var pageObj = this;
		$(link).bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			pageObj.addToGroup(row);
		});
		return link;
	},
	
	getSelections: function(){
		var selBoxesArr = new Array();
		$('input[type=checkbox][id^=check][name=selection[]]').each(function (){
			if ($(this).prop("checked")){
				selBoxesArr.push($(this));
			}
		});
		return selBoxesArr;
	},
	
	
	initCheckBoxGr: function(link){
		var pageObj = this;
		$(link).bind("click", function(e){
			var selBoxesArr = pageObj.getSelections();
			if (selBoxesArr.length && pageObj.isDisabledButton($('#addSelBtn'))){
				pageObj.delDisabledClass($('#addSelBtn'));
			}
			else if (!selBoxesArr.length && !pageObj.isDisabledButton($('#addSelBtn'))) {
				pageObj.addDisabledClass($('#addSelBtn'));
			}
		});
		return link;
	},
	
	initHeaderCheckBox: function(){
		//id can be not need
		pageObj = this;
		$('.chooseAll'+pageObj.id).unbind("click").bind("click", function(e){
			var that = this;
			//set checked/unchecked for all checkbox in grid rows
			$('input[type=checkbox][id^=check'+pageObj.id+'_]').each(function(){
				this.checked = that.checked;
			});
			//set checked/unchecked for all chooseAll checkboxes
			$('input[type=checkbox][id^=chooseAll_'+pageObj.id+']').each(function(){
				this.checked = that.checked;
			});
			
			var selBoxesArr = pageObj.getSelections();
			if (selBoxesArr.length && pageObj.isDisabledButton($('#addSelBtn'))){
				pageObj.delDisabledClass($('#addSelBtn'));
			}
			else if (!selBoxesArr.length && !pageObj.isDisabledButton($('#addSelBtn'))) {
				pageObj.addDisabledClass($('#addSelBtn'));
			}
			
		});
	},
	
	initRow: function(row){
		row.addGrLink = this.initAddGrLink($('#iAddLink'+row.id), row);
		row.checkBoxGr = this.initCheckBoxGr($('#check'+this.id+'_'+row.id));
	},
	
	initRows: function(){
		for(var i=0; i<this.rows.length; i++){
			this.initRow(this.rows[i]);
		}
	},
	
	getRowById: function(rowId){
		for(var i=0; i<this.rows.length; i++){
			if (this.rows[i].id === rowId){
				return this.rows[i]; 
			}
		}
		return false;
	},
	
	initButtons: function(){
		var pageObj = this;
		$('#addSelBtn').unbind('click').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			Runner.Event.prototype.stopEvent(e);
			pageObj.addSelectedToGroup(); 
		});
		this.addDisabledClass($('#addSelBtn'));
	},
	
	/**
	 * Resize don't use on the list lookup
	 */
	initResize: Runner.emptyFn,

	initSearch: function(){
		
		this.searchController = new Runner.search.SearchController({
			id: this.pageId,
			tName: this.tName,
			fNamesArr: this.controlsMap.search.allSearchFields,
			shortTName: this.shortTName,
			usedSrch: this.controlsMap.search.usedSrch,
			panelSearchFields: this.controlsMap.search.panelSearchFields,
			ajaxSubmit: true,
			useSuggest: false,
			pageType: this.pageType
		});
		
		this.searchController.init(this.controlsMap.search.searchBlocks);
		this.searchController.srchForm.baseParams = this.baseParams;
		this.searchController.srchForm.on("beforeSubmit", function(form){
			Runner.runLoading(this.win.bodyNode.getDOMNode());
		}, this);
		this.searchController.on('afterSearch', function(respObj, srchController, srchForm){
			Runner.stopLoading(this.win.bodyNode.getDOMNode());
			this.pageReloadHn(respObj);
			if (this.searchController.usedSrch){
				this.searchController.showShowAll();
			}else{
				this.searchController.hideShowAll();
			}
		}, this);
		
		this.searchController.srchForm.on('submitFailed', function(){
			Runner.stopLoading(this.win.bodyNode.getDOMNode());
		}, this);
		
	},
	
	initInline:  Runner.emptyFn,
	
	initPagination: function(){
	
		$("table[name=paginationTable"+this.pageId+"]").bind("click", {pageObj: this}, function(e){
			Runner.Event.prototype.stopEvent(e);
			var pageObj = e.data.pageObj;
			var target = Runner.Event.prototype.getTarget(e);
			if(target.nodeName != "A") {
				return false;
			}
			if (!Runner.isMobile)
				Runner.runLoading(pageObj.gridElem);
			var pageNum = $(target).attr("pageNum"),
				url = Runner.pages.getUrl(pageObj.tName, pageObj.pageType, {})+"?goto="+pageNum;
			
			// ajax page reload	
			$.runnerAJAX(url, pageObj.baseParams,
				function(respObj){
					pageObj.pageReloadHn.call(pageObj, respObj)
				});
		});
	},
	
	pageReloadHn: function(respObj){
		Runner.stopLoading(this.win.bodyNode.getDOMNode());
		if (respObj.success){
			Runner.setIdCounter(respObj.idStartFrom);
			
			// replace bricks
			if (Runner.isMobile) {
				this.replaceBricksHTMLWith(this.getBricksHtml(respObj.html),$('.runner-c-flylist'));
			}
			else {
				this.replaceBricksHTMLWith(this.getBricksHtml(respObj.html));
			}
			
			// set controlsMap
			this.controlsMap = respObj["controlsMap"][this.tName][this.pageType][this.pageId];
			this.rows = this.controlsMap.gridRows;
			
			this.initButtons();
			this.initRows();
			this.initPagination();
			this.initHeaderCheckBox();
			this.searchController.usedSrch = respObj.controlsMap[this.tName][this.pageType][this.pageId].search.usedSrch;
			
			if(this.searchController.usedSrch){
				this.searchController.showShowAll();
			}else{
				this.searchController.hideShowAll();
			}
		}else{
			this.win.set('bodyContent', "REQUEST FAILED");
		}
		Runner.pages.PageManager.correctYUIWindowSize(this.tName, this.pageId, true);
	},
	
	addSelectedToGroup: function(){
		var pageObj = this;
		var selBoxesArr = this.getSelections();
		
		for (var i=0; i < selBoxesArr.length; i++){
			var row = pageObj.getRowById(parseInt(selBoxesArr[i].val()));
			if (row){
				pageObj.addToGroup(row);
			}
		}
		pageObj.destructor();
		this.parObj.disableGroupButtons(false);
	},
	
	addToGroup: function(obj){
		var elemVal = obj.keys['name'];
		if (elemVal == '')
			return false;
		var pageObj = this;
		for(var i = 0; i < $('.group option').length; i++){
			if($('.group option:eq(' + i + ')').html() == elemVal){
				pageObj.replaceBrickContentHTMLWith('message', 'Group with such name is allready exist!');
				pageObj.showBrick('message');
				return;
			}
		}
		
		$.getJSON('admin_admembers_list.php',{	
				rndval: Math.random(),
				name: elemVal,
				a: 'addgr'
			},
			function(ret){
				if(!ret.success){
					pageObj.replaceBrickContentHTMLWith('message', 'Error adding group!');
					pageObj.showBrick('message');
					return;
				}
				pageObj.hideBrick('message');
				var id = ret.id; 
				pageObj.parObj.groups.push(id);
				var oldGroup = $('.group :selected').val();
				//	create and append checkboxes
				$('input[type=checkbox][id$=_-2]').each(function(){
					var cbid = $(this).attr('id').substring(0, $(this).attr('id').length - 2);
					// hide previously selected group checkboxes
					$('#' + cbid + oldGroup).hide();
					cbid += id;
					$(this.parentNode).append('<input type="checkbox"  id="' + cbid + '" name="' + cbid + '">');
					// bind onclick handler
					pageObj.parObj.initOrdinaryCheckboxes($('#' + cbid));
				});
				
				$('.group').append($('<option value="' + id + '">' + elemVal + '</option>'));
				$('.group :last').prop('selected', true);
				$('.group').attr('size', pageObj.parObj.groups.length);
				$('.group').trigger('change');
				
				$('input[type=checkbox][id^=check][name=selection[]][value='+obj.id+']').css('display','none');
				$(obj.addGrLink.get(0)).css('display','none');
				
			}
		);
	}

});
Runner.pages.RightsPageAD = Runner.extend(Runner.pages.RightsPage, {
		
	/**
	 * initRightsControls
	 * Bind handlers with controls 
	 */
	
	initRightsControls: function(){
		var pageObj = this;
		$('#saveGroupBtn').click(function(){
			pageObj.save();
		});
		$('#addGroupBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			pageObj.disableGroupButtons(true);
			var eventParams = {
				tName: "admin_admembers",
				pageType: Runner.pages.constants.PAGE_LIST, 
				pageMode: Runner.pages.constants.MEMBERS_PAGE,
				parObj: pageObj,
				destroyOnClose: true,
				modal: true,
				baseParams: {
					table: "admin_admembers"
				}
			};
			Runner.Event.prototype.stopEvent(e);
			Runner.pages.PageManager.openPage(eventParams);
			
		});
		
		$('#delGroupBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			pageObj.deletegroup(); 
		});
		
		$('#renGroupBtn').click(function(e){
			if(pageObj.isDisabledButton(this)){	
				Runner.Event.prototype.stopEvent(e);
				return false;
			}
			if($('.group option:selected').val() < 0){
				return false; 
			}
			pageObj.disableGroupButtons(true);
			$('.group').prop('disabled', true);
			$('.runner-ugaddarea').show();
			$('.groupname')[0].focus();
			$('.groupname').val($('.group option:selected').html());
			$('.gmessage').html(pageObj.TEXT_AA_RENAMEGROUP);
			pageObj.renameidx = $('.group')[0].selectedIndex;
		});
		
		$('.groupname').keydown(function(event){
			e = event; 
			if(!e) e = window.event; 
			if(e.keyCode != 13){ 
				return true; 
			}
			e.cancel = true; 
			pageObj.save(); 
			return false;
		});
		
		$('#cancelBtn').click(function(){
			pageObj.hideBrick('message');
			$('.runner-ugaddarea').hide(); 
			$('.group').prop('disabled', false);
			pageObj.disableGroupButtons(false);
			if(pageObj.renameidx >= 0){
				$('.groupname').val('');
			}
		});
		this.initRowCheckboxes();
	},
	
	reloadGroupList: function(id,name){
		var pageObj = this;
		this.groups = Runner.pages.PageSettings.getTableData("admin_rights", "rightsGroups");
		
		$('.runner-ugaddarea').hide();
			//	create and append checkboxes
		$('input[type=checkbox][id$=_-1]').each(function(){
			var cbid = $(this).attr('id').substring(0, $(this).attr('id').length - 2);
			// hide previously selected group checkboxes
			$('#' + cbid + oldGroup).hide();
			cbid += id;
			$(this.parentNode).append('<input type="checkbox"  id="' + cbid + '" name="' + cbid + '">');
			// bind onclick handler
			pageObj.initOrdinaryCheckboxes($('#' + cbid));
		});
		
		$('.group').append($('<option value="' + id + '">' + name + '</option>'));
		this.groups.push(id);
		console.log('id ',id);
		//var oldSize = $('.group').attr('size');
		//newSize = parseInt(oldSize)+1;
		$('.group').attr('size', this.groups.length);
		$('.group').trigger('change');
		console.log(this.groups);
	},
	
	/**
	 * save
	 * Save new group or save new name for the existing group
	 * @param {string} name of the group
	 */
	save: function (elemName){
		if (elemName == ''){
			return false;
		}
		var pageObj = this;
		for(var i = 0; i < $('.group option').length; i++){
			if($('.group option:eq(' + i + ')').html() == elemName && this.renameidx != i){
				pageObj.replaceBrickContentHTMLWith('message', 'Group with such name is allready exist!');
				pageObj.showBrick('message');
				return;
			}
		}
		var oldGroup = $('.group :selected').val();
		$.runnerAJAX('ug_group.php',{	
				rndval: Math.random(),
				name: elemName,
				a: 'add'
			},
			function(respObj){
				if(!respObj.success){
					pageObj.replaceBrickContentHTMLWith('message', 'Error adding group!');
					pageObj.showBrick('message');
					return;
				}
				pageObj.hideBrick('message');
				var id = respObj.id; 
				$('.runner-ugaddarea').hide();
				//	create and append checkboxes
				$('input[type=checkbox][id$=_-2]').each(function(){
					var cbid = $(this).attr('id').substring(0, $(this).attr('id').length - 2);
					// hide previously selected group checkboxes
					$('#' + cbid + oldGroup).hide();
					cbid += id;
					$(this.parentNode).append('<input type="checkbox"  id="' + cbid + '" name="' + cbid + '">');
					// bind onclick handler
					pageObj.initOrdinaryCheckboxes($('#' + cbid));
				});
				pageObj.groups.push(id);
				$('.group').append($('<option value="' + id + '">' + elemName + '</option>'));
				$('.group :last').prop('selected', true);
				$('.group').attr('size', pageObj.groups.length);
				$('.group').trigger('change');
				$('.group').prop('disabled', false);
				pageObj.disableGroupButtons(false);
		});
		
	}
	
});

Runner.pages.ExportPage = Runner.extend(Runner.pages.RunnerPage, {
		
	pageType: Runner.pages.constants.PAGE_IMPORT,
	
	constructor: function(cfg){
		Runner.pages.ExportPage.superclass.constructor.call(this, cfg);	
		this.submitUrl = Runner.pages.getUrl(this.tName, this.pageType);
	},
	
	init: function(){
		Runner.pages.ExportPage.superclass.init.call(this);	
		this.initButtons();
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	initButtons: function(){
		var pageObj = this, vtype,vrecords;
		$("a[id=saveButton"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			$('input[type=radio][name=type]').each(function(){
				if($(this).prop("checked"))
					vtype=$(this).val();
			});
			$('input[type=radio][name=records]').each(function(){
				if($(this).prop("checked"))
					vrecords=$(this).val();
			});
			pageObj.form = new Runner.form.BasicForm({
				submitUrl: pageObj.submitUrl,
				standardSubmit: true,
				method: 'POST',
				id: pageObj.pageId,
				baseParams: { 
					type: vtype,
					records: vrecords
				}
			});
			
			pageObj.form.submit();
			pageObj.form.destructor();
			pageObj.form = null;
		});	
	}
});
Runner.pages.ImportPage = Runner.extend(Runner.pages.RunnerPage, {
		
	pageType: Runner.pages.constants.PAGE_IMPORT,
	
	constructor: function(cfg){
		Runner.pages.ImportPage.superclass.constructor.call(this, cfg);	
		this.submitUrl = Runner.pages.getUrl(this.tName, this.pageType);
	},
	
	init: function(){
		Runner.pages.ImportPage.superclass.init.call(this);	
		this.initButtons();
		this.fireEvent('afterInit', this, this.proxy, this.id);
	},
	
	initButtons: function(){
		var pageObj = this;
		$("a[id=saveButton"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);

			var path = $("#file_ImportFileName"+pageObj.id).val();
			if (!path){
				return false;
			}
			var wpos = path.lastIndexOf('\\'); 
			var upos = path.lastIndexOf('/');
			var pos = wpos; 
			if(upos>wpos){
				pos=upos;
			}
			baseParams = {
				a: "added", 
				id: pageObj.pageId
			};
			baseParams["value_ImportFileName"+pageObj.id] = path.substr(pos+1);
			baseParams["type_ImportFileName"+pageObj.id] = 'upload2';
			
			var form = new Runner.form.BasicForm({
				submitUrl: pageObj.submitUrl,
				standardSubmit: true,
				isFileUpload: true,
				method: 'POST',
				baseParams: baseParams,
				id: pageObj.pageId,
				addElems: [$("#file_ImportFileName"+pageObj.id)]
			});
			
			form.submit();
			
		});	
		
		$("a[id=backButton"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			window.location.href = Runner.pages.getUrl(pageObj.tName, Runner.pages.constants.PAGE_LIST)+"?a=return";
		});
		
		$("a[linkType=debugOpener]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			// show info table
			$("#importDebugInfoTable"+this.recId).toggle();
		});
	}
});
Runner.pages.RegisterPage = Runner.extend(Runner.pages.RunnerPage, {
	
	submitUrl: "",
	
	passFieldName: 'password',
	
	userFieldName: 'username',
	
	emailFieldName: 'email',
	
	useAsGlobal: true,
	/**
	 * Reference to timeout set up during the last keyup event
	 */
	submitTimout: null,
	
	fileFieldsCount: 0,
	
	upploadErrorHappened: false,
	
	constructor: function(cfg){
		Runner.pages.RegisterPage.superclass.constructor.call(this, cfg);
		this.submitUrl = "register.php";
		this.passFieldName = Runner.pages.PageSettings.getTableData(this.tName, "passFieldName"); 
		this.userFieldName = Runner.pages.PageSettings.getTableData(this.tName, "userFieldName");
		this.emailFieldName = Runner.pages.PageSettings.getTableData(this.tName, "emailFieldName");
		this.addEvents("beforeSave");
	},
	
	init: function(){
		Runner.pages.RegisterPage.superclass.init.call(this);
		if (this.beforeSave){
			this.on({'beforeSave': this.beforeSave});
		}
		
		this.initButtons();
		this.initControlEvents();
		this.setFirstFocus();
		this.fireEvent('afterInit', this, this.proxy, this.id);
		
		//add validation
		var ctrlNames = [this.passFieldName, this.userFieldName, this.emailFieldName];
		for(var i = 0; i < ctrlNames.length; i++){
			if(ctrlNames[i] == null)
				continue;
			var ctrl = Runner.getControl(this.pageId, ctrlNames[i]);
			if (ctrl) {
				if (!ctrl.isSetValidation('IsRequired'))
					ctrl.addValidation('IsRequired');
				if(ctrlNames[i] == this.emailFieldName && !ctrl.isSetValidation('IsEmail'))
					ctrl.addValidation('IsEmail');
			}
		}
		
		this.initPreValidation();
	},
	
	initButtons: function(){
		var pageObj = this;
		if (!Runner.pages.PageSettings.getTableData(this.tName, "isMobileIOS")){
			$("a[id=saveButton"+this.id+"]").bind("click", function(e){
				Runner.Event.prototype.stopEvent(e);
				
				var arrcntrl = Runner.controls.ControlManager.getAt(pageObj.tName);
				
				$("a[id=saveButton"+this.id+"]").addClass('disabled')
				
				pageObj.upploadErrorHappened = false;
				pageObj.fileFieldsCount = 0;
				
				for(var index in arrcntrl){
					if(arrcntrl[index].editFormat == Runner.controls.constants.EDIT_FORMAT_FILE
						&& arrcntrl[index].filesToUploadCount > 0){
						pageObj.fileFieldsCount++;
						arrcntrl[index].errorHappened = false;
						arrcntrl[index].uploadForm.bind('fileuploadstopped', { ctrl: arrcntrl[index] }, function(e, data){
							pageObj.fileFieldsCount--;
							$(this).unbind('fileuploadstopped');
							if(e.data.ctrl.errorHappened){
								pageObj.upploadErrorHappened = true;
								pageObj.errorHn();
							}
							else
								pageObj.callSaveHn();
						});
						$(".btn-primary.start", arrcntrl[index].uploadForm).click();
					} 
				}
				if(pageObj.fileFieldsCount < 1)
					pageObj.callSaveHn();
			});
		} else{
			$("a[id=saveButton" + this.id + "]").bind("click", function(){
				$("#registerForm" + pageObj.id).submit();
			});
		}
	},
	
	callSaveHn: function(){
		if(this.upploadErrorHappened || this.fileFieldsCount > 0)
			return;
		
		var arrcntrl = Runner.controls.ControlManager.getAt(this.tName)
			, isInvalid = false, firstInvalidIndex = -1;
		
		for (var i = 0; i < arrcntrl.length; i++){
			if (arrcntrl[i].invalid() === true || !arrcntrl[i].validate().result){
				firstInvalidIndex = i;
				isInvalid = true;
			}
		}
		if(isInvalid){
			arrcntrl[firstInvalidIndex].setFocus();
			$("a[id=saveButton"+this.id+"]").removeClass('disabled');
			return false;
		}
		
		var form = new Runner.form.BasicForm({
			isFileUpload: true,
			submitUrl: this.submitUrl,
			standardSubmit: true,
			method: 'POST',
			baseParams: {'btnSubmit': "Register"},
			id: this.pageId,
			fieldControls: Runner.controls.ControlManager.getAt(this.tName),
			beforeSubmit: {
				fn: function(formObj){
					return this.fireEvent("beforeSave", formObj, formObj.fieldControls, this);
				},
				scope: this
			}
		});
		
		form.submit();
	},
	
	errorHn:function(row){
		if(this.fileFieldsCount < 1){
			$("a[id=saveButton"+this.id+"]").removeClass('disabled');
		}
	},
	
	initControlEvents: function(){
		var passctrl = Runner.controls.ControlManager.getAt(this.tName, this.id, this.passFieldName),
			confctrl = Runner.controls.ControlManager.getAt(this.tName, this.id, 'confirm'),
			pageObj = this;
		if(this.userFieldName) 
			var nameCtrl = Runner.controls.ControlManager.getAt(this.tName, this.id, this.userFieldName);
		else
			var nameCtrl = false;
		
		if(confctrl){
			passctrl.on('blur', 
				function(e, confctrl){
					if(confctrl.getValue()!=this.getValue() && confctrl.getValue()!=""){
						confctrl.markInvalid([Runner.lang.constants.PASSWORDS_DONT_MATCH]);
					}else{
						confctrl.clearInvalid();
						if(!this.invalid()){
							this.clearInvalid();
						}
					}
				}, 
				{args: [confctrl]}
			);
			confctrl.on('blur', function(e, passctrl){
				if(passctrl.getValue()!=this.getValue()){
					this.markInvalid([Runner.lang.constants.PASSWORDS_DONT_MATCH]);
				}else{
					if(!passctrl.invalid())
						passctrl.clearInvalid();
					this.clearInvalid();
				}
			}, {args: [passctrl]});
		}
		if(nameCtrl){
			var checkUniqueEvent = function(e){
				if(pageObj.submitTimeout)
					clearTimeout(pageObj.submitTimeout);
				
				var control = this;
				pageObj.submitTimeout = setTimeout(function(){
					var ajaxParams = {
							field: pageObj.userFieldName,
							val: control.getValue(), 
							rndVal: (new Date().getTime())
						}, nameCtrl = control;
					$.runnerAJAX("registersuggest.php", ajaxParams, function(respObj){
						if(!respObj.success){
							nameCtrl.markInvalid([respObj.errors]);
						}else{
							nameCtrl.validate();
							//if(!nameCtrl.invalid())
							//	nameCtrl.clearInvalid();
						}
					});
				}, 500);
			};
			nameCtrl.on('keyup', function() { checkUniqueEvent.call(nameCtrl); });
			nameCtrl.on('blur', function(){ checkUniqueEvent.call(nameCtrl); });
		}
	},
	
	initPreValidation: function(){
		var userErrorMessage = Runner.pages.PageSettings.getTableData(this.tName, "regmsg_userError"),
			emailErrorMessage = Runner.pages.PageSettings.getTableData(this.tName, "regmsg_emailError"),
			passwordErrorMessage = Runner.pages.PageSettings.getTableData(this.tName, "regmsg_passwordError");
		if(userErrorMessage != ""){
			Runner.controls.ControlManager.getAt(this.tName, this.id, this.userFieldName).markInvalid([userErrorMessage]);
		}
		if(emailErrorMessage != ""){
			Runner.controls.ControlManager.getAt(this.tName, this.id, this.emailFieldName).markInvalid([emailErrorMessage]);
		}
		if(passwordErrorMessage != ""){
			Runner.controls.ControlManager.getAt(this.tName, this.id, this.passFieldName).markInvalid([passwordErrorMessage]);
		}
	}
});

/**
 * Search form controller. Need for submit form in advanced and panel mode
 */
Runner.search.SearchForm = Runner.extend(Runner.util.Observable, {
	/**
	 * jQuery obj of simple search edit box
	 * @type {obj}
	 */
	smplSrchBox: null,
	/**
	 * Simple search edit box tip
	 * @type {string}
	 */
	smplSrchBoxTip: '',
	
	simpleSrchTypeCombo: null,
	
	simpleSrchFieldsCombo: null,
	/**
	 * Indicator. 
	 * True when simple search edit box get search value from user 
	 * @type Boolean
	 */
	smplUsed: false,
	/**
	 * Indicator. 
	 * True when simple search edit box get focus 
	 * @type Boolean
	 */
	usedSrch: false,
	/**
	 * Id of page, used when page loades dynamicly
	 * @type {int}
	 */
	id: -1,
	/**
	 * Name of table for which instance of class was created
	 * @type string
	 */
	tName: "",
	/**
	 * Type of search: panel on list, or advanced search page
	 * @type String
	 */
	searchType: "panel",
	/**
	 * jQuery obj of top radio with conditions
	 * @type {obj}
	 */
	conditionRadioTop: null,
	/**
     * jQuery obj
     * @type 
     */
    srchForm: null,
	/**
    * ctrls map. Used for indicate which index conected with which search ctrl
    * @type obj
    */    
    ctrlsShowMap: null,
    
    ajaxSubmit: false,
    
    baseParams: null,
    
    optCombosArr: null,
    /**
	 * Reference to timeout set up during the last keyup event
	 */
	submitTimout: null,
    
	/**
     * Override parent contructor
     * Add interaction with server
     * @param {obj} cfg
     */
    constructor: function(cfg){  
    	this.ctrlsShowMap = {};
    	this.baseParams = {};
    	this.optCombosArr = [];
    	// copy properties from cfg to controller obj
        Runner.apply(this, cfg);
    	//call parent
    	Runner.search.SearchForm.superclass.constructor.call(this, cfg);        
        // radio with contion choose or|and
        this.conditionRadioTop = $('input:radio[name=srchType]');
        
         // edit box any field contains search
        this.smplSrchBox = $('#ctlSearchFor'+this.id);
        
        this.simpleSrchTypeCombo = $('#simpleSrchTypeCombo'+this.id);
        this.simpleSrchFieldsCombo = $('#simpleSrchFieldsCombo'+this.id);
        
        this.addEvents('beforeSearch', 'afterSearch');
    },
    
    init: function(ctrlsBlocks){
    	this.initControlBlocks(ctrlsBlocks); 
    	this.initForm();
    	this.initSuggest();
    	this.initButtons();
    },
    
    initForm: function(){
    	var method = "GET";
    	if (this.ajaxSubmit){
    		var method = "POST";
    	}
    	
    	if (this.pageType == Runner.pages.constants.PAGE_LIST || this.pageType == Runner.pages.constants.PAGE_REPORT || this.pageType == Runner.pages.constants.PAGE_CHART || this.pageType == Runner.pages.constants.PAGE_PRINT){
    		var submitUrl = Runner.pages.getUrl(this.tName, this.pageType);
    	}else{
    		var submitUrl = this.pageType+".php";
    	}
    	
    	// get form object
        this.srchForm = new Runner.form.BasicForm({
			standardSubmit: !this.ajaxSubmit,
			isSearchForm: true,
			initImmediately: true,
			submitUrl: submitUrl,
			method: method,
			id: this.id,
			addRndVal: false,
			baseParams: this.baseParams || {}
		});
		
		this.srchForm.on('successSubmit', function(respObj){
			this.fireEvent('afterSearch', respObj, this, this.srchForm);
		}, this);
    	
    },
    
    initCombo: function(recId, fName, map){
    	$("#"+this.getComboId(fName, recId)).bind("change", {tName: this.tName, recId: recId, fName: fName, map: map}, function(e){
    			if (typeof e.data.map[1] == "undefined"){
    				return false;
    			}
				var ctrl = Runner.controls.ControlManager.getAt(e.data.tName, e.data.recId, e.data.fName, e.data.map[1]);
				if (!ctrl){
					return false;
				}
				if (this.value=='Between' || this.value=='NOT Between'){
					ctrl.show();
				}else{
					ctrl.hide();
				};	
			}
		);
		this.optCombosArr.push($("#"+this.getComboId(fName, recId)));
		//$("#"+this.getComboId(fName, recId)).get(0).defVal = $("#"+this.getComboId(fName, recId)).val();
	},
	
	initButtons: function(){
		var searchController = this;
		
		$("a[id=searchButtTop"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			searchController.submitSearch();
			// add run loading for ajax reboot
		});
		
		$("a[id=showAll"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			searchController.showAllSubmit();
		}); 
	},
	
	initControlBlocks: function(ctrlsBlocks){
		for(var i=0; i<ctrlsBlocks.length; i++){
			this.addRegCtrlsBlock(ctrlsBlocks[i].fName, ctrlsBlocks[i].recId, ctrlsBlocks[i].ctrlsMap);
		}
	},
	
	initSuggest: function(){
		if (!this.useSuggest){
			return false;
		}
		var ctrls, i, searchController = this;
		
		for(var fName in this.ctrlsShowMap){
			for(var recId in this.ctrlsShowMap[fName]){
				ctrls = Runner.controls.ControlManager.getAt(this.tName, recId);
				for(i=0; i<ctrls.length; i++){
					//remove all validators
					ctrls[i].validationArr = [];
					if (ctrls[i].editFormat != Runner.controls.constants.EDIT_FORMAT_TEXT_FIELD){
						continue;
					}
					ctrls[i].on('keyup', function(e, argsArr){
						if(!Runner.isAcceptableKeyCode(e))
							return;
						if(searchController.submitTimeout)
							clearTimeout(searchController.submitTimeout);
						var control = this;
						searchController.submitTimeout = setTimeout(function(){
							var srchTypeComboId = searchController.getComboId(searchController.tName, searchController.id);
							var srchTypeCombo = $('#'+srchTypeComboId);
							var suggestUrl = 'searchsuggest.php?table='+searchController.shortTName;
							return searchSuggest_new(e, control, srchTypeCombo, 'advanced', suggestUrl);
						}, 500);
					}, {buffer: 200});
					ctrls[i].on('keydown', function(e, argsArr){
						return searchController.listenEvent(e, this.valueElem.get(0), searchController);
					});
				}
				if (ctrls.length > 2){
					return true;
				}
			}
		}
	},
	
	/**
	 * Listen keyboard events in searchSuggest mode 
	 * @param {obj} oEvent
	 * @param {obj} oElement
	 * @param {obj} searchController
	 * @return {Boolean}
	 */
	listenEvent: function(oEvent, oElement, searchController){
		oEvent=window.event || oEvent;
		var iKeyCode=oEvent.keyCode;
		
		switch(iKeyCode){
			case 38: //up arrow
				if(this.useSuggest){
					moveUp(oElement);
				}
				break;
			case 40: //down arrow
				if(this.useSuggest){
					moveDown(oElement);
				}
				break;
			case 13: //enter
				if(this.useSuggest){
					DestroySuggestDiv();
				}
				searchController.submitSearch();
				break;
			case 9:
				if(this.useSuggest){
					DestroySuggestDiv();
				}
				break;
		}
		return true;
	},
	
	/**
	 * Create and submit form 
	 */
	submitSearch: function(){
		this.fireEvent('beforeSearch', this, this.srchForm);
		this.srchForm.clearForm();
		this.srchForm.searchSubmit = true;
		
		// add fields thats appear only on list panel mode
		var valSeparator = '~', 
			fieldSeparator = ')(', 
			simpleQuery = '', 
			simpleQueryEncoded = '',
			simpleQueryArr = [this.searchEscape(this.smplSrchBox.val() || "", true), '', ''];
		
		// for simple search with combos
		simpleQueryArr[1] = this.searchEscape(this.simpleSrchFieldsCombo.val() || "", true);
		
		var simpleSrchTypeComboVal = this.simpleSrchTypeCombo.val();
		//default combo value
		if(simpleSrchTypeComboVal == 'Contains'){
			simpleSrchTypeComboVal = "";
		}else{
			simpleSrchTypeComboVal = Runner.pages.constants.SEARCH_OPTIONS[simpleSrchTypeComboVal];
		}
		simpleQueryArr[2] += simpleSrchTypeComboVal || "";
		
		for(var i = simpleQueryArr.length - 1; i >= 0; i--){
			simpleQuery = simpleQueryArr[i] + (simpleQuery == '' ? '' : valSeparator) + simpleQuery;
			simpleQueryEncoded = encodeURIComponent(simpleQueryArr[i]) + (simpleQueryEncoded == '' ? '' : valSeparator) + simpleQueryEncoded;
		}
		if(simpleQuery != ''){
			this.srchForm.addToForm('qs', simpleQuery);
			this.srchForm.addToSearchForm('qs', simpleQueryEncoded);
		}
		
		// add radio values
		for (var i=0;i<this.conditionRadioTop.length;i++){
			if(this.conditionRadioTop[i].checked == true){
				if(this.conditionRadioTop[i].value != 'and'){
					this.srchForm.addToForm('criteria', this.conditionRadioTop[i].value);
					this.srchForm.addToSearchForm('criteria', encodeURIComponent(this.conditionRadioTop[i].value));
				}
				break;
			}
		}
		
		// for interator, field counter
		var j=1, notVal='', query = '', queryEncoded = '';
		// add search params for each field
		for(var fName in this.ctrlsShowMap){
			// loop through all ctrls, except cached and deleted
			for(var ind in this.ctrlsShowMap[fName]){
				// get ctrls map for field name
				var fMap = this.ctrlsShowMap[fName][ind],
					// add ctrls vals
					ctrl1 = Runner.controls.ControlManager.getAt(this.tName, ind, fName, fMap[0]);
				if (!ctrl1.appearOnPage()){
					continue;
				}
				// add empty vals, if we search empty or not empty vals
				var srchCombo = $('#'+this.getComboId(fName, ind)), 
					comboVal = srchCombo.val(),
					cachedRow = $("#"+this.getFilterRowId(fName, ind, this.srchWinShowStatus)); 
				// add only non empty and not cashed vals
				if (ctrl1.isEmpty() && comboVal.indexOf('Empty') == -1 || $(cachedRow).css('display') == 'none'){
					continue;
				}
				// define first value and type
				var fieldArray = ['', this.searchEscape(ctrl1.getStringValue()), ctrl1.ctrlType, ''];
				
				// define option
				var srchCheckBox = $('#'+this.getCheckBoxId(fName, ind));
				if(comboVal != ''){
					if(srchCheckBox.length && srchCheckBox.prop("checked")){
						comboVal = "NOT " + comboVal;
					}
					fieldArray[0] = Runner.pages.constants.SEARCH_OPTIONS[comboVal];
				}
				
				// if search type between and exists second ctrl
				if (srchCombo.val().toLowerCase().indexOf('between') !== -1 && fMap[1]){
					var ctrl2 = Runner.controls.ControlManager.getAt(this.tName, ind, fName, fMap[1]), 
						ctrl2Val = ctrl2.getStringValue();
					fieldArray[3] = this.searchEscape(ctrl2Val); 
				}
				var fieldQuery = '', fieldQueryEncoded = ''; 
				for(var i = fieldArray.length - 1; i >= 0; i--){
					fieldQuery = fieldArray[i] + (fieldQuery == '' ? '' : valSeparator) + fieldQuery;
					fieldQueryEncoded = encodeURIComponent(fieldArray[i]) + (fieldQueryEncoded == '' ? '' : valSeparator) + fieldQueryEncoded;
				}
				// add fName to query
				query += (query != '' ? fieldSeparator : '(') + this.searchEscape(fName) + valSeparator + fieldQuery;
				queryEncoded += (queryEncoded != '' ? fieldSeparator : '(') + encodeURIComponent(this.searchEscape(fName)) + 
					valSeparator + fieldQueryEncoded;
				j++;
			}
		}
		
		if(query != ''){
			this.srchForm.addToForm('q', query + ')');
			this.srchForm.addToSearchForm('q', queryEncoded + ')');
		}else{ 
			if(simpleQuery == '' && this.ajaxSubmit){
				this.srchForm.addToForm('q', '');
			}
		}
		
		this.addCrossParams();
		this.usedSrch = true;
		var formObj = this;
		// submit
		/*if(this.ajaxSubmit){
			//formObj.srchForm.ajaxForm["mode"] = "ajax";
			//formObj.srchForm.ajaxForm["id"] = this.id;
			this.srchForm.ajaxForm = Runner.apply(this.srchForm.ajaxForm, this.srchForm.baseParams);
			$.runnerAJAX(this.srchForm.submitUrl, this.srchForm.ajaxForm, function(respObj) {
				formObj.srchForm.fireEvent("successSubmit", respObj, formObj.srchForm, formObj.srchForm.fieldControls);
			},
			function(respObj){
				formObj.fireEvent("successFailed", respObj, formObj.srchForm, formObj.srchForm.fieldControls);
			});
		}else{*/
			this.srchForm.submit();
		//}
	},
	
	searchEscape: function(value, searchSimple){
		if(typeof value == "object"){
			var formObj = this;
			$.each(value, function(index, element){
				value[index] = formObj.searchEscape(value[index], searchSimple);
			});
			return value;
		}
		else{
			value = value.replace("\\","\\\\").replace("~","\\~");
			if(searchSimple){
				return value;
			}else{
				return value.replace(")(","\\)(");
			}
		}
	},
	
	/**
	  * Add params for crosstable report
	  *
	  */
	addCrossParams: function(){
		if($("#select_group_x")[0])	{
			this.srchForm.addToForm('axis_x',$("#select_group_x")[0].value);
			this.srchForm.addToForm('axis_y',$("#select_group_y")[0].value);
			this.srchForm.addToForm('field',$("#select_data")[0].value);
			grfunc_value=0;
			grfunc=$("input[name=group_func]");
			if (grfunc.length){
				for(i=0;i<grfunc.length;i++)
				{
					if(grfunc[i].checked)
						grfunc_value=grfunc[i].value;
				}
			}
			else if ($("#group_func_hidden")[0]){
				grfunc_value = $("#group_func_hidden")[0].value;
			}
			this.srchForm.addToForm('group_func',grfunc_value);
		}
	},
		
	/**
	 * Register ctrl in show map
	 * @param {string} fName
	 * @param {string} ind
	 * @param {string} ctrlIndArr
	 */
	addToShowMap: function(fName, ind, ctrlIndArr){
		// create field names and indexes if they not created
		!this.ctrlsShowMap[fName] ? this.ctrlsShowMap[fName] = {} : '';
		!this.ctrlsShowMap[fName][ind] ? this.ctrlsShowMap[fName][ind] = {} : '';
		// add ctrls indexes array
		this.ctrlsShowMap[fName][ind] = ctrlIndArr;
	},
	/**
	 * Adds block to map, regs its components and ands HTML
	 * @param {} fName
	 * @param {} ind
	 * @param {} ctrlIndArr
	 * @param {} blockHTML
	 */
	addRegCtrlsBlock: function(fName, ind, ctrlIndArr){
		// add to map
		ctrlIndArr ? this.addToShowMap(fName, ind, ctrlIndArr) : '';
		this.initCombo(ind, fName, ctrlIndArr);
	},
	/**
	 * Return search type combo id
	 * @param {string} fName
	 * @param {int} ind
	 * @return {string}
	 */
	getComboId: function(fName, ind){
		return "srchOpt_" + ind + "_" + Runner.goodFieldName(fName);
	},
	/**
	 * Return filter div id
	 * @param {string} fName
	 * @param {int} ind
	 * @return {string}
	 */
	getFilterRowId: function(fName, ind){
		return "filter_" + ind + "_" + Runner.goodFieldName(fName);
	},
	
	/**
	 * Return search checkbox id
	 * @param {string} fName
	 * @param {int} ind
	 * @return {string}
	 */
	getCheckBoxId: function(fName, ind){
		return "not_" + ind + "_" + Runner.goodFieldName(fName);
	},
	
	showAllSubmit: function(){
		this.srchForm.clearForm();
		this.srchForm.addToForm("a", 'showall');
		this.addCrossParams();
		this.usedSrch = false;
		this.smplUsed = false;
		this.isUsedSearchFor  = false;
		// submit
		if(this.smplSrchBox){
			this.smplSrchBox.val('');
		}	
		this.clearCtrls();
		this.srchForm.submit();
	},
	
	/**
	 * Submit for for return on list page
	 */
	returnSubmit: function(){
		this.srchForm.clearForm();
		this.srchForm.addToForm('a', 'return');
		// submit
		this.srchForm.submit();
	},
	/**
	 * Resets form ctrls, for panel should be overriden
	 * @return {Boolean}
	 */
	clearCtrls: function(){
		Runner.controls.ControlManager.clearControlsForTable(this.tName);
		
		for(var i=0; i<this.optCombosArr.length;i++){
			if (this.optCombosArr[i].length){
				this.optCombosArr[i].get(0).options[0].selected = true;
				this.optCombosArr[i].change();
			}
		}
		$("input[id^=not_]").each(function(){
			$(this).attr('checked',false);
		});
		if(this.conditionRadioTop.length){
			this.conditionRadioTop[0].checked = true;
		}
		return false;
	}
});

Runner.search.options = {
	CONTAINS: "Contains",
	EQUALS: "Equals",
	STARTS_WITH: "Starts with",
	MORE_THAN: "More than",
	LESS_THAN: "Less than",
	BETWEEN: "Between",
	EMPTY: "Empty",
	
	NOT_CONTAINS: "NOT Contains",
	NOT_EQUALS: "NOT Equals",
	NOT_STARTS_WITH: "NOT Starts with",
	NOT_MORE_THAN: "NOT More than",
	NOT_LESS_THAN: "NOT Less than",
	NOT_BETWEEN: "NOT Between",
	NOT_EMPTY: "NOT Empty"
};

Runner.search.optionsText = {

	"Contains": Runner.lang.constants.CONTAINS,
	"Equals": Runner.lang.constants.EQUALS,
	"Starts with": Runner.lang.constants.STARTS_WITH,
	"More than": Runner.lang.constants.MORE_THAN,
	"Less than": Runner.lang.constants.LESS_THAN,
	"Between": Runner.lang.constants.BETWEEN,
	"Empty": Runner.lang.constants.EMPTY,
	
	"NOT Contains": Runner.lang.constants.NOT_CONTAINS,
	"NOT Equals": Runner.lang.constants.NOT_EQUALS,
	"NOT Starts with": Runner.lang.constants.NOT_STARTS_WITH,
	"NOT More than": Runner.lang.constants.NOT_MORE_THAN,
	"NOT Less than": Runner.lang.constants.NOT_LESS_THAN,
	"NOT Between": Runner.lang.constants.NOT_BETWEEN,
	"NOT Empty": Runner.lang.constants.NOT_EMPTY
};

/**
 * Global object for 
 * @object
 */
Runner.search.SearchField = Runner.extend(Runner.emptyFn, {
	/**
	 * Field name
	 * @type {string}
	 */
	fName: "",
	/**
	 * Field id
	 * @type {integer}
	 */
	id: 0,
	/**
	 * Select element with search options
	 * @type {object}
	 */
	opt: null,
	/**
	 * Search controller object
	 * @type {object}
	 */
	searchObj: null,
	
	constructor: function(cfg){
		Runner.apply(this, cfg);
		this.init();
	},
	
	init: function(){
		this.opt = $('#'+this.searchObj.getComboId(this.fName, this.id)).get(0);
	},
	
	reInit: function(){
		if(!this.id){
			this.getId();
		}
		this.init();
	},
	/**
	 * Is reinit was implemented successful
	 */
	isReInitSuccess: function(){
		if(typeof this.opt == 'undefined'){
			this.reInit();
			if(!this.id){
				return false;
			}
		}
		return true;
	},
	/**
	 * Get field name
	 * @return {string}
	 */
	getName: function(){
		return this.fName;
	},
	/**
	 * Get field id
	 * @return {integer}
	 */
	getId: function(){
		if(!this.id){
			var id = this.searchObj.getLastAddedInd(this.fName);
			if(!this.searchObj.isFieldShownById(this.fName, id)){
				this.id = id;
			}
		}
		return this.id;
	},
	/**
	 * Get field control object
	 * @return {object}
	 */
	getControl: function(){
		return Runner.controls.ControlManager.getAt(this.searchObj.tName, this.id, this.fName);
	},
	/**
	 * Get second control object
	 * @return {object}
	 */
	getSecondControl: function(){
		return Runner.controls.ControlManager.getAt(this.searchObj.tName, this.id, this.fName, 1);
	},
	/**
	 * Get selected option value
	 * @param {string}
	 * @return {string}
	 */
	getOption: function(){
		if(!this.isReInitSuccess()){
			return false;
		}
		for(var j=0; j<this.opt.options.length; j++){
			if(this.opt.options[j].selected){
				return this.opt.options[j].value;
			}
		}
	},
	/**
	 * Set option value
	 * @param {string}
	 */
	setOption: function(value){
		if(typeof value == 'undefined' || !value){
			return;
		}
		if(!this.isReInitSuccess()){
			return;
		}
		for(var j=0; j<this.opt.options.length; j++){
			if(this.opt.options[j].value == value){
				this.opt.selectedIndex = j;
				$(this.opt).change();
				break;
			}
		}
	},
	/**
	 * Add new option 
	 * @param {string}
	 */
	addOption: function(value){
		if(typeof value == 'undefined' || !value){
			return;
		}
		if(!this.isReInitSuccess()){
			return;
		}
		var text = Runner.search.optionsText[value];
		var opt = new Option(text, value);
		$(opt).html(text);
		$(this.opt).append(opt);
	},
	/**
	 * Get all options
	 * @param {string}
	 * @return {array}
	 */
	getOptions: function(){
		if(!this.isReInitSuccess()){
			return false;
		}
		return this.opt.options;
	},
	/**
	 * Remove option
	 * @param {string}
	 */	
	removeOption: function(value){
		if(!this.isReInitSuccess()){
			return;
		}
		if(this.opt.options.length == 1){
			this.searchObj.hideCtrlTypeCombo();
			return;
		}
		for(var j=0; j<this.opt.options.length; j++){
			if(this.opt.options[j].value == value){
				if(this.opt.options[j].selected){
					if(j == 0){
						this.opt.selectedIndex = j+1;
					}else{
						this.opt.selectedIndex = j-1;
					}
				}
				this.opt.remove(j);
				break;
			}
		}
	},
	/**
	 * Remove field from serach panel
	 * @param {string}
	 */
	remove: function(){
		this.searchObj.deleteField(this.fName, this.id);
	}
});
/**
 * Search form with user interface. 
 * 
 */
Runner.search.SearchFormWithUI = Runner.extend(Runner.search.SearchForm, {	  
	/**
	* Options panel show status indicator
	* @type Boolean
	*/
	srchOptShowStatus: false,
	/**
	* Search win show status indicator
	* @type Boolean
	*/
	srchWinShowStatus: false,
	/**
	* Show status indicator of div, which contains add filter buttons
	* @type Boolean
	*/
	ctrlChooseMenuStatus: false,
	/**
	* Show status indicator of search type combos
	* @type Boolean
	*/
	ctrlTypeComboStatus: false,
	/**
	* jQuery obj of search options div
	* @type {obj}
	*/
	srchOptDiv: null,
	/**
	* jQuery object of img-button options panel expander
	* @type {obj}
	*/
	srchOptExpander: null,
	/**
	* jQuery object of img-button search win expander
	* @type {obj}
	*/
	srchWinExpander: null,
	/**
	 * jQuery object with div, that contains all search elements
	 * @type {obj}
	 */
	srchBlock: null,
	/**
	 * show all button jQuery obj
	 * @type {obj} 
	 */
	showAll: null,
	
	showAllButtStatus: false,
	/**
	 * jQuery object with div, that contains all search controls
	 * @type {obj}
	 */
	srchCtrlsBlock: null,
	/**
	* Show status indicator of search block
	* @type Boolean
	*/
	srchBlockStatus: true,
	/**
	* jQuery object of div with add-filter buttons
	* @type {obj}
	*/
	ctrlChooseMenuDiv: null,
	/**
	* Img src attr for hide opt
	* @type String
	*/
	hideOptSrc: "images/search/hideOptions.gif",
	/**
	* Img src attr for show opt
	* @type String
	*/
	showOptSrc: "images/search/showOptions.gif",
	/**
	 * Search panel icon switcher text
	 * @type 
	 */
	showOptText: Runner.lang.constants.TEXT_SEARCH_SHOW_OPTIONS,
	/**
	 * Search panel icon switcher text
	 * @type 
	 */
	hideOptText: Runner.lang.constants.TEXT_SEARCH_HIDE_OPTIONS,
	/**
	 * Search type combos switcher text
	 * @type 
	 */
	showComboText: Runner.lang.constants.TEXT_SHOW_OPTIONS,
	/**
	 * Search type combos switcher text
	 * @type 
	 */
	hideComboText: Runner.lang.constants.TEXT_HIDE_OPTIONS,
	/**
	 * Array of search type combos
	 * @type {array}
	 */
	searchTypeCombosArr: null,
	/**
	 * Array of divs, that used as containers for one search control with its combos, delete buttons etc.
	 * @type {array}
	 */
	srchFilterRowArr: null,
	/**
	 * Array of field names
	 * @type array
	 */
	fNamesArr: null,
	/**
	 * ctrls map. Used for indicate which index conected with which search ctrl
	 * @type obj
	 */
	ctrlsShowMap: null,
	/**
	 * jQuery obj of link-switcher. Toggles search type combos
	 * @type obj
	 */
	showHideSearchComboButton: null,
	/**
	 * Hider object, hide selects in fly div mode
	 * @type object
	 */
	hider: null,
	/**
	 * Search window container
	 * @type object
	 */
	pageCont: null,
	/**
	 * Current page object
	 * @type object 
	 */
	pageObj: null,
	/**
	 * Search panel background color
	 * @type string 
	 */
	spBgColor: '',
	/**
	 * Array of bricks for search
	 * @type object 
	 */
	searchBricks: null,
	/**
	 * Criteria container
	 * @type object 
	 */
	topCritCont: null,
	
	/**
	 * Constructor
	 * @param {obj} cfg
	 */
	constructor: function(cfg) {
		// recreate objects
		this.fNamesArr = [];
		this.searchBricks = [];
		this.srchFilterRowArr = [];
		this.searchTypeCombosArr = [];
		
		// call parent
		Runner.search.SearchFormWithUI.superclass.constructor.call(this, cfg);
		
		// get current page object
		this.pageObj = Runner.pages.PageManager.getAt(this.tName, this.id);
		// get background color for search panel brick
		this.spBgColor = $(this.pageObj.getBrickContentsElem('searchpanel')).css('background-color');
		// set search bricks array 
		this.searchBricks = ['search','vsearch2','searchpanel'];
		//events for fly serach window
		this.addEvents('afterCreateFlyWin', 'closeFlyWin');
		
		// -------------------stuf used only when in panel mode------------------
		// private jQuery obj
		this.srchOptDiv = $(".searchOptions", this.pageObj.pageCont);
		this.srchOptExpander = $("a[id=showOptPanel" + this.id + "]");
		this.srchWinExpander = $("a[id=showSrchWin" + this.id + "]");
		
		// div container with criteria switcher
		this.topCritCont = $('.srchCritTop', this.pageObj.pageCont);
		
		// div container with all search stuff
		this.srchBlock = $("#search_block"+this.id);
		
		// div object with all controls
		this.srchCtrlsBlock = $(".controlsBlock", this.pageObj.pageCont);
		
		this.showHideSearchComboButton = $('#showHideSearchType'+this.id); 
		
		this.showAll = $("a[id=showAll"+this.id+"]");
		this.showAllButtStatus = this.usedSrch;
		
		this.addDelegatedEvents();
	},
	
	/**
	 * Binds hover events for table and div. 
	 * Use parent containers as delegates
	 * Call it in constructor
	 */
	addDelegatedEvents: function(){
		// for event handlers closures
		var controller = this;
		
		//set default border styles to all cells for controls block table in search panel
		$('.srchPanelRow', this.srchCtrlsBlock).each(function(){
			$('.srchPanelCell', this).each(function(i){
				switch (i){
					case 0:
						if (!Runner.isMobile){
							controller.setBorderToLeftCell(this);
						}else{
							controller.setBorderToTopLeftRightCell(this);
						}
					break;
					case 1:
						if (!Runner.isMobile){
							controller.setBorderToCenterCell(this);
						}
						else{
							controller.setBorderToBottomLeftRightCell(this);
						}
					break;
					case 2:
						controller.setBorderToRightCell(this);
					break;
				}	
			});
		});
		
		// border hover events
		this.srchCtrlsBlock.bind('mouseover', function(e){
			// get event element
			var target = Runner.Event.prototype.getTarget(e);
			// traverse to filter parent
			while (target.className != controller.srchCtrlsBlock.attr('class')){
				if ((target.nodeName == "TD") || (Runner.isMobile && target.nodeName == "DIV")){
					// all cells
					var tds = $(target).parent().children();
					// make sure that we choosed td with controls, and not with loading box
					if ($(tds[0]).hasClass('srchPanelCell')){
						// show del image
						$('.searchPanelButton', tds[0]).css('visibility', 'visible');
						if (!Runner.isMobile){
							// set hovered border styles to left cell
							$(tds[0]).addClass('cellBorderCenterHovered cellBorderLeftHovered').attr('style', '');
							// set hovered border styles to center cell
							$(tds[1]).addClass('cellBorderCenterHovered').attr('style', '');
							// set hovered border styles to right cell
							$(tds[2]).addClass('cellBorderCenterHovered cellBorderRightHovered').attr('style', '');
						}else{
							// set hovered border styles to top cell
							$(tds[0]).addClass('cellBorderTopHovered cellBorderLeftHovered cellBorderRightHovered').attr('style', '');
							// set hovered border styles to bottom cell
							$(tds[1]).addClass('cellBorderBottomHovered cellBorderLeftHovered cellBorderRightHovered').attr('style', '');
						}
					}
					break;
				}else{
					target = target.parentNode;
				}
			}
		});

		this.srchCtrlsBlock.bind('mouseout', function(e){
			// get event element
			var target = Runner.Event.prototype.getTarget(e);
			// traverse to filter parent
			while (target.className != controller.srchCtrlsBlock.attr('class')){
				if ((target.nodeName == "TD") || (Runner.isMobile && target.nodeName == "DIV")){
					// all cells
					var tds = $(target).parent().children();
					// make sure that we choosed td with controls, and not with loading box
					if ($(tds[0]).hasClass('srchPanelCell')){
						// hide del image
						$('.searchPanelButton', tds[0]).css('visibility', 'hidden');
						if (!Runner.isMobile){
							// return default border styles to left cell
							$(tds[0]).removeClass('cellBorderCenterHovered cellBorderLeftHovered');
							controller.setBorderToLeftCell(tds[0]);
							// return default border styles to center cell
							$(tds[1]).removeClass('cellBorderCenterHovered');
							controller.setBorderToCenterCell(tds[1]);
							// return default border styles to center cell
							$(tds[2]).removeClass('cellBorderCenterHovered cellBorderRightHovered');
							controller.setBorderToRightCell(tds[2]);
						}
						else {
							// return default border styles to left cell
							$(tds[0]).removeClass('cellBorderTopHovered cellBorderLeftHovered cellBorderRightHovered');
							controller.setBorderToTopLeftRightCell(tds[0]);
							// return default border styles to center cell
							$(tds[1]).removeClass('cellBorderBottomHovered cellBorderLeftHovered cellBorderRightHovered');
							controller.setBorderToBottomLeftRightCell(tds[1]);
						}
					}
					break;
				} else {
					target = target.parentNode;
				}
			}	
		});
	},
	
	/**
	 * Set border styles to top div of search panel
	 * @param {object} cell
	 */
	setBorderToTopLeftRightCell: function(elem){
		$(elem).css({
			'border-top': '1px dotted '+this.spBgColor,
			'border-left': '1px dotted '+this.spBgColor,
			'border-right': '1px dotted '+this.spBgColor
		});	
	},
	
	/**
	 * Set border styles to bottom div of search panel
	 * @param {object} cell
	 */
	setBorderToBottomLeftRightCell: function(elem){
		$(elem).css({
			'border-bottom': '1px dotted '+this.spBgColor,
			'border-left': '1px dotted '+this.spBgColor,
			'border-right': '1px dotted '+this.spBgColor
		});	
	},
	
	/**
	 * Set border styles to center search panel cell
	 * @param {object} cell
	 */
	setBorderToCenterCell: function(elem){
		$(elem).css({
			'border-top': '1px dotted '+this.spBgColor,
			'border-bottom': '1px dotted '+this.spBgColor
		});	
	},
	
	/**
	 * Set border styles to left search panel cell
	 * @param {object} cell
	 */
	setBorderToLeftCell: function(elem){
		$(elem).css('border-left', '1px dotted '+this.spBgColor);
		this.setBorderToCenterCell(elem, this.spBgColor);
	},
	
	/**
	 * Set border styles to right search panel cell
	 * @param {object} cell
	 */
	setBorderToRightCell: function(elem){
		$(elem).css('border-right', '1px dotted '+this.spBgColor);
		this.setBorderToCenterCell(elem);
	},
	
	/**
	 * Return search type combo container ids
	 * @param {string} fName
	 * @param {int} ind
	 * @return {string}
	 */
	getComboContId: function(fName, ind){
		return "searchType_" + ind + "_" + Runner.goodFieldName(fName);
	},
	
	getComboId: function(fName, id){
		return "srchOpt_" + id + "_" + Runner.goodFieldName(fName);
	},

	/**
	 * Create flyDiv with search controls
	 * If used as onlick handler pass event object, for get click coords
	 * @param {event} e
	 */
	showSearchWin: function(e) { 
		this.hideCtrlChooseMenu();
		this.srchWinExpander.hide();
		var x = 50, y = 50, 
			height, width = 400,
			searchFormObj = this;
		
		if (Runner.isIE){
			height = 200;
		}
		if(e){
			// get click coors	
			y = e.y || e.pageY;
			x = e.x || e.pageX;
			if (e.w && e.h){
				height = e.h;
				width = e.w;
			}else if(Runner.isDirRTL()){
				x -= width;
			}
			
			if ( $(window).width() - width < x ) {
				x = $(window).width() - width + 15; 
			}
			if ( Runner.isDirRTL() && x < 0 ) {
					x = 15;
			}
			if ( $(window).width() - width < x ) {
				x = $(window).width() - width; 
			}
			if (x < 0) {
				x = 0;
			}
		}
		
		var args = {
				xy:[x, y],
				width: width,
				render: true,
				bodyContent: "&nbsp;",
				headerContent: '<span style="color: white;">' + Runner.lang.constants.SEARCH_FOR + '</span>'
					+ '<span style="position:absolute; top:2px; right:23px;">'
					+ '<span class="runner-btnframe"><span class="runner-btnleft"></span><span class="runner-btnright"></span>'
					+ '<a id="pinSrchWin' + this.pageObj.id + '" class="runner-button-img" href="#" align="absmiddle" title="Floating window" alt="Floating window">'
					+ '<img src="images/search/showWindowPin.gif"></a></span></span>',
				footerContent: "&nbsp;"
			};
		if (height){
			args['height'] = height;
		}
		
		if(!this.isEventExist('closeFlyWin')){
			this.on('closeFlyWin', function(){
				this.hideSearchWin();
			}, this);
		}
		
		if(!this.isEventExist('afterCreateFlyWin')){
			this.on('afterCreateFlyWin', function(){
				// copy container and get bricks from parent page
				this.getBricksFromParent();
				
				// hide button for toggle search panel
				this.srchOptExpander.hide();
				
				// set show indicator
				this.srchWinShowStatus = true;
				
				this.showSearchOptions();
				
				this.initWinDelButtons();
				
				$("a[id=pinSrchWin"+searchFormObj.pageObj.id+"]").bind("click", function(e){
					Runner.Event.prototype.stopEvent(e);
					searchFormObj.hideSearchWin();
					searchFormObj.showSearchOptions();
				});
				
				// correct YUI window size
				Runner.pages.PageManager.correctYUIWindowSize(this.tName, this.id, false, this.win);
			}, this);
		}
		
		//create fly win yui panel
		Runner.pages.PageManager.createFlyWin.call(this, args, true);
	},
	
	/**
	 * Get conainers and bricks for search window from parent page
	 * Containers clone
	 * Need bricks replace and unnecessary bricks remove
	 */
	getBricksFromParent: function(){
		var bricksObjs = this.pageObj.getBricksObjs(this.searchBricks);
		
		// if horizontal lyaout
		if(bricksObjs['search'].length){
			this.cloneContainerToWin(bricksObjs['search'][0].contObj, ['search']);
			this.cloneContainerToWin(bricksObjs['searchpanel'][0].contObj, ['searchpanel']);
		}// else if vertical lyaut
		else if(bricksObjs['vsearch2'].length){ 
			//if this bricks situated in the same containers
			if(bricksObjs['vsearch2'][0].contObj.name == bricksObjs['searchpanel'][0].contObj.name){
				this.cloneContainerToWin(bricksObjs['searchpanel'][0].contObj, ['searchpanel','vsearch2']);
			}else{
				this.cloneContainerToWin(bricksObjs['vsearch2'][0].contObj, ['vsearch2']);
				this.cloneContainerToWin(bricksObjs['searchpanel'][0].contObj, ['searchpanel']);
			}	
		}
	},
	
	/**
	 * Clone container and add it to search window
	 * Replace search bricks and remove all not needed bricks
	 * @param {object} container 
	 * @param {object} array of excepted bricks
	 */
	cloneContainerToWin: function(contObj, briksEx){
		// copy container and get it bricks
		var bricks = contObj.getBricks(),
			winCont = contObj.elem.clone(),
			winBrick = null,
			winBrConts = $('.runner-brickcontents', winCont);
			
		//empty all bricks or bricks contents for cloned container
		if(!winBrConts.length){
			$('[class*="runner-b-"]', winCont).empty();
		}else{
			winBrConts.empty();
		}
		
		//remove any scripts from container
		$('script',winCont).remove();
		
		// add cloned container to search window body
		$(this.win.bodyNode.getDOMNode()).append($(winCont).get(0));
		
		winCont = $('.runner-c-'+contObj.name, this.win.bodyNode.getDOMNode());
		winCont.parent().removeClass('runner-hiddencontainer');
		
		for(var i=0; i<bricks.length; i++){
			winBrick = $('.runner-b-'+bricks[i].name, winCont);
			if(!winBrick.length){
				continue;
			}
			//remove all bricks from cloned container except search bricks
			var replace = false;
			for(var j=0; j<briksEx.length; j++){
				if(bricks[i].name == briksEx[j]){
					replace = true;
					break;
				}
			}	
			if(!replace){
				winBrick.remove();
			}else{
				this.replaceWinBrick(bricks[i], winBrick);
			}
		}
	},
	
	/**
	 * Replace search window brick by brick from parent page
	 * @param {object} parent brick 
	 * @param {object} window brick
	 */
	replaceWinBrick: function(parBrick, winBrick){
		parBrick.contentElem.wrap(function(){
			return '<'+this.nodeName+' class="'+this.className+'"/>';
		});
		var winBrickContent = $('.runner-brickcontents',winBrick);
		if(winBrickContent.length){
			winBrickContent.replaceWith(parBrick.contentElem);
		}else{
			winBrick.replaceWith(parBrick.contentElem);
		}
		if(parBrick.name == 'searchpanel'){
			winBrick.removeClass('runner-hiddenbrick');	
		}
	},
	
	/**
	 * Return bricks from search window to parent page
	 */
	setBricksToParent: function(){
		var winBricksContents = {};
		for(var i=0; i<this.searchBricks.length; i++){
			var winBrick = $('.runner-b-'+this.searchBricks[i], this.win.bodyNode.getDOMNode());
			if(winBrick.length){
				var winBrickContent = $('.runner-brickcontents',winBrick);
				if(winBrickContent.length){
					winBricksContents[this.searchBricks[i]] = winBrickContent;
				}else{
					winBricksContents[this.searchBricks[i]] = winBrick;
				}
			}
		}
		this.pageObj.replaceBricksContentsWith(winBricksContents);
		$(this.win.bodyNode.getDOMNode()).empty();
	},
	
	hideShowAll: function(){
		this.showAll.hide();
		this.showAllButtStatus = false;
	},
	
	showShowAll: function(){
		this.showAll.parent().show();
		
		this.showShowAll = function(){
			this.showAll.show();
			this.showAllButtStatus = true;
			if(!this.smplSrchBox.val()){
				this.setSearchTip();
			}
		};
		
		this.showShowAll();
	},
	
	toggleShowAll: function(){
		this.showAllButtStatus ? this.hideShowAll() : this.showShowAll();
	},
	
	/**
	 * Removes fly div, and place controls to search panel
	 */
	hideSearchWin: function(id) {
		// return bricks from search window to parent page
		this.setBricksToParent();
		this.hideCtrlChooseMenu();
		this.hideSearchOptions();
		
		// hide button for toggle search panel
		this.srchOptExpander.show();
		this.srchWinExpander.show();
		
		this.pageObj.destroyWin.call(this);
		
		// set status indicator
		this.srchWinShowStatus = false;
	},
	/**
	 * Search win switcher
	 * opens and closes search win
	 */
	 toggleSearchWin: function(e) {
		this.srchWinShowStatus ? this.hideSearchWin() : this.showSearchWin(e);
		this.hideCtrlChooseMenu();
	},
	/**
	 * Showes search options div and changes image expander 
	 */
	showSearchBlock: function(){
		// show div
		this.srchBlock.show();
		this.srchBlockStatus = true;
	},
	/**
	 * Closes search options div and changes image expander 
	 */
	hideSearchBlock: function() {
		// hide div
		this.srchBlock.hide();
		this.srchBlockStatus = false;
	},
	/**
	 * Search options switcher
	 * opens and closes options in search panel
	 */
	toggleSearchBlock: function() {
		// can open panel, only if win is hidden
		(this.srchBlockStatus && !this.srchWinShowStatus) ? this.hideSearchBlock() : this.showSearchBlock();
	},
	
	/**
	* Showes search options div and changes image expander 
	*/
	showSearchOptions: function(){
		// hide/show searchpanel brick
		if(this.srchWinShowStatus){
			this.pageObj.hideBrick('searchpanel');
		}else{
			this.pageObj.showBrick('searchpanel');
		}
		// show div
		this.srchOptDiv.show();	
		// change image
		$('img', this.srchOptExpander).attr('src',this.hideOptSrc);
		this.srchOptExpander.attr('alt', this.hideOptText);
		this.srchOptExpander.attr('title', this.hideOptText);
		this.srchOptShowStatus = true;
		
		this.recalculationGridSize();
	},
	/**
	 * Closes search options div and changes image expander 
	 */
	hideSearchOptions: function() {
		this.pageObj.hideBrick('searchpanel');
		// hide div
		this.srchOptDiv.hide();
		// change image
		$('img', this.srchOptExpander).attr('src',this.showOptSrc);
		this.srchOptExpander.attr('alt', this.showOptText);
		this.srchOptExpander.attr('title', this.showOptText);
		this.srchOptShowStatus = false;
		
		this.recalculationGridSize();
	},
	/**
	 * Search options switcher
	 * opens and closes options in search panel
	 */
	toggleSearchOptions: function() {
		// can open panel, only if win is hidden
		(this.srchOptShowStatus && !this.srchWinShowStatus) ? this.hideSearchOptions() : this.showSearchOptions();
		this.hideCtrlChooseMenu();
	},

	/**
	 * Showes search options div and changes image expander 
	 */
	showCtrlChooseMenu: function() { 
		if (!this.ctrlChooseMenuDiv){
			this.ctrlChooseMenuDiv = $(".controlChooseMenu", this.pageObj.pageCont);
			this.ctrlChooseMenuDiv.appendTo(document.body);
		}
		// create closure
		var controller = this;
		// add events
		var hideHandler = function(){
			controller.showCtrlChooseMenu();
		}
		var hideTask = new Runner.util.DelayedTask(hideHandler);
		controller.ctrlChooseMenuDiv.bind('mouseover', function(e){
			showTask.cancel();
			hideTask.delay(50, hideHandler, null, [e]);
		});
		
		var showHandler = function(){
			controller.hideCtrlChooseMenu();
		}
		var showTask = new Runner.util.DelayedTask(showHandler);
		controller.ctrlChooseMenuDiv.bind('mouseout', function(e){
			hideTask.cancel();
			showTask.delay(50, showHandler, null, [e]);
		});
		
		// redefine
		this.showCtrlChooseMenu = function(){
			// set menu position, relative to Add criteria link
			var posObj = Runner.getPosition($("#showHideControlChooseMenu"+this.id)[0]),
			// calc coordinates
				divT = posObj.top + posObj.height, 
				divL = posObj.left;
			
			// add only in win mode, strange positioning in fly div
			this.ctrlChooseMenuDiv.css('top', divT).css('left', divL);
			// set div width, after div is visible, for correct offsetWidth data
			this.ctrlChooseMenuDiv.width() < posObj.width ? this.ctrlChooseMenuDiv.css('width', posObj.width) : "";
			// show it
			this.ctrlChooseMenuDiv.show();
			// set max z-index
			Runner.setZindexMaxToElem(this.ctrlChooseMenuDiv);
			this.ctrlChooseMenuStatus = true;
		}
		// call function, after lazy-init
		this.showCtrlChooseMenu();
	},
	
	/**
	 * Closes search options div and changes image expander 
	 */
	hideCtrlChooseMenu: function() {
		if (!this.ctrlChooseMenuDiv){
			this.ctrlChooseMenuDiv = $(".controlChooseMenu", this.pageObj.pageCont);
			this.ctrlChooseMenuDiv.appendTo(document.body);
		}
		this.ctrlChooseMenuDiv.hide();
		this.ctrlChooseMenuStatus = false;
	},
	
	/**
	 * Search options switcher
	 * opens and closes options in search panel
	 */
	toggleCtrlChooseMenu: function() {
		this.ctrlChooseMenuStatus ? this.hideCtrlChooseMenu() : this.showCtrlChooseMenu();
	},
	
	/**
	 * Search type combos show handler
	 */
	showCtrlTypeCombo: function() {
		for(var i = 0; i < this.searchTypeCombosArr.length; i++){
			this.searchTypeCombosArr[i].show();
			/*// show br tag if exist
			if(this.searchTypeCombosArr[i].next().tagName() == "br"){
				this.searchTypeCombosArr[i].next().show();
			}*/
			this.searchTypeCombosArr[i].find('select').show();
		}
		this.showHideSearchComboButton.html(this.hideComboText);
		this.showHideSearchComboButton.attr('title', this.hideComboText);
		this.ctrlTypeComboStatus = true;
	
	},
	/**
	 * Search type combos hide handler
	 */
	 hideCtrlTypeCombo: function() {
		for(var i = 0; i < this.searchTypeCombosArr.length; i++){
			this.searchTypeCombosArr[i].hide();
			/*// hide br tag if exist
			if(this.searchTypeCombosArr[i].next().tagName() == "br"){
				this.searchTypeCombosArr[i].next().hide();
			}*/
			this.searchTypeCombosArr[i].find('select').hide();
		}
		this.showHideSearchComboButton.html(this.showComboText);
		this.showHideSearchComboButton.attr('title', this.showComboText);
		this.ctrlTypeComboStatus = false;
	},
	/**
	 * Search type combos show\hide switcher
	 */
	toggleCtrlTypeCombo: function() {
		this.ctrlTypeComboStatus ? this.hideCtrlTypeCombo() : this.showCtrlTypeCombo();
	},
	/**
	 * Criterias show|hide controller
	 * @param {int} ctrlsCount
	 */
	toggleCrit: function(ctrlsCount){
		// lazy init, get conditions containers
		var controller = this,
			bottomSearchButt = $('.bottomSearchButt', this.pageObj.pageCont); 
		// redefine after first call
		this.toggleCrit = function(ctrlsCount){
			ctrlsCount > 1 ? controller.topCritCont.show() : controller.topCritCont.hide();
			ctrlsCount > 0 ? bottomSearchButt.show() : bottomSearchButt.hide();
		}
		// for first call
		this.toggleCrit(ctrlsCount);
	},
	recalculationGridSize: function(){
		//change height on thead grid
		if (!Runner.pages.PageSettings.getTableData(this.tName, "scrollGridBody") || Runner.pages.PageSettings.getTableData(this.tName, "recsPerRowList")>1) 
			return;
		
		var newTheadHeight = $('thead tr th',this.pageObj.gridElem)[0].offsetHeight;
		if (newTheadHeight != $(this.pageObj.gridElem).attr('theadheight')){
			var myHeight = $(".runner-scrollgrid-inner").height();
			var footerHeight = $('tr.footer td',this.pageObj.gridElem).height();
			var bottomHeight = $('tr.runner-bottomrow td',this.pageObj.gridElem).height();
			$('.footer',this.pageObj.gridElem).css("top",(myHeight+newTheadHeight-footerHeight-bottomHeight)+"px");
			$('.runner-bottomrow',this.pageObj.gridElem).css("top",+(myHeight+newTheadHeight-bottomHeight)+"px");	
			$(this.pageObj.gridElem.closest(".runner-scrollgrid-wrap")).css('padding',newTheadHeight+'px 0 0');
			$(this.pageObj.gridElem).attr('theadheight',newTheadHeight);
		}
	}
});

	/**
 * search panel controller. Used for manage search on the list page
 * for multiple search classes use id param.
 * @class
 * @param {object} cfg
 */
Runner.search.SearchController = Runner.extend(Runner.search.SearchFormWithUI, {
	
	panelStateExpires: '',
	/**
	 * Ajax add filter cache url
	 * @type String
	 */
	ajaxSearchUrl: "",  
	/**
	 * Reusable style display none
	 * @type String
	 */
	styleDispNoneText: 'display: none;',
	/**
	 * Short table name, used for create urls
	 */
	shortTName: "",
	/**
	 * Indicator, true when 'search for' field used in search
	 */
	isUsedSearchFor: false,
	/**
	 * Reference to timeout set up during the last keyup event
	 */
	submitTimout: null,
	/**
	 * Array of user fields ojects
	 */
	searchFields: null,
	/**
	 * Override parent contructor
	 * Add interaction with server
	 * @param {obj} cfg
	 */
	constructor: function(cfg){
		//call parent
		Runner.search.SearchController.superclass.constructor.call(this, cfg);
		this.searchFields = {};	
		// set search url, for ajax
		this.ajaxSearchUrl = this.shortTName + '_search.php';
		this.isUsedSearchFor = Runner.pages.PageSettings.getTableData(cfg.tName, "isUsedSearchFor");
		Runner.pages.PageManager.addUnloadHn(this.rememberPanelState, this, []);
	},
	
	init: function(ctrlsBlocks){
		Runner.search.SearchController.superclass.init.call(this, ctrlsBlocks);	
		this.initSearchFields();
		this.remindPanelState();
		this.initFastSearch(); 
		this.initAddLinks();
		this.initDelButtons();
	},
	
	initSearchFields: function(){
		for(var i=0; i<this.fNamesArr.length; i++){
			this.searchFields[this.fNamesArr[i]] = [];
		}
	},
	
	initFastSearch: function(){
		var controller = this;
		this.getSearchTip();
		$(this.smplSrchBox).bind({
			focus: function(e){
				if(!controller.smplUsed && !controller.isUsedSearchFor){ 
					controller.delSearchTip();
				}
			},
			blur: function(){
				if(!controller.smplUsed && !controller.isUsedSearchFor || !controller.smplSrchBox.val()){
					controller.setSearchTip(false);
					if(controller.isUsedSearchFor){
						controller.isUsedSearchFor = false;
					}	
				}
			}
		});
		if(!this.smplSrchBox.val()){
			this.setSearchTip(true);
		}
		
		$(this.smplSrchBox).bind('keyup', function(e){
			if (Runner.isMobile)
				return;
			if(!Runner.isAcceptableKeyCode(e))
				return;
			if(controller.submitTimeout)
				clearTimeout(controller.submitTimeout);
			var srchBoxObj = this;
			controller.submitTimeout = setTimeout(function(){
				controller.setSmplUsed();
				if(!controller.smplUsed && !controller.isUsedSearchFor){ 
					controller.delSearchTip();
				}
				if(controller.useSuggest){ 
					searchSuggest(e, srchBoxObj, 'ordinary', 'searchsuggest.php?table='+controller.shortTName, 1);
				}	
			}, 500);
		});
		$(this.smplSrchBox).bind('keydown', function(e){
			controller.setSmplUsed();
			if(!controller.smplUsed && !controller.isUsedSearchFor){ 
				controller.delSearchTip();
			}
			return controller.listenEvent(e, this, controller);
		});
	},
	
	getSearchTip: function(){
		if(!this.smplSrchBoxTip){
			this.smplSrchBoxTip = this.smplSrchBox.attr('tip');
		}
	},
	
	setSearchTip: function(firstTime){
		if(firstTime || this.smplSrchBox.val() == ""){
			this.smplUsed = false;
			this.smplSrchBox.val(this.smplSrchBoxTip).addClass("ctlSearchTip");
		}else
			this.setSmplUsed();
	},
	
	delSearchTip: function(){
		this.getSearchTip();
		this.smplSrchBox.val('').removeClass('ctlSearchTip');
	},
	
	setSmplUsed: function(){
		if(!this.smplUsed){
			this.smplUsed = true; 
		}else if(!this.smplSrchBox.val()){
			this.smplUsed = false; 
		}	
	},
	
	hideShowAll: function(){
		Runner.search.SearchController.superclass.hideShowAll.call(this);
		this.smplSrchBox.val('');
		this.setSearchTip(false);
	},
	
	/**
	 * Create and submit form 
	 */
	submitSearch: function(){  
		this.rememberPanelState();
		// replace this check to the js-settings check in next version (#5100)
		if(!this.isUsedSearchFor && !this.smplUsed){
			this.getSearchTip();
			this.smplSrchBox.val('');
		}	
		Runner.search.SearchController.superclass.submitSearch.call(this);
	},
	
	initAddLinks: function(){
		var controller = this;
		for(var i=0; i<this.fNamesArr.length; i++){
			$("#addSearchControl_"+Runner.goodFieldName(this.fNamesArr[i]), this.pageObj.pageCont).bind("click", {fName: this.fNamesArr[i]}, function(e){
				Runner.Event.prototype.stopEvent(e);
				controller.addFilter(e.data.fName);
				controller.hideCtrlChooseMenu();
			});
		};
	},
	
	initDelButtons: function(){
		var srchController = this;
		this.srchCtrlsBlock.bind('click', function(e){
		
			var target = Runner.Event.prototype.getTarget(e);
			if(target && target.nodeName != "IMG" || !$(target).attr("fName")) {
				return;
			}
			Runner.Event.prototype.stopEvent(e);
			var fName = $(target).attr("fName"),
				ctrlId = parseInt($(target).attr("ctrlId"));
			for(var i=0; i<srchController.fNamesArr.length;i++){
				if (fName == Runner.goodFieldName(srchController.fNamesArr[i])){
					fName = srchController.fNamesArr[i];
					break;
				}
			}
			srchController.delCtrl(fName, ctrlId);
		});
	},
	
	initWinDelButtons: function(){
		var srchController = this;
		
		$(this.win.bodyNode.getDOMNode()).bind('click', function(e){
		
			var target = Runner.Event.prototype.getTarget(e);
			if(target && target.nodeName != "IMG" || !$(target).attr("fName")) {
				return;
			}
			Runner.Event.prototype.stopEvent(e);
			var fName = $(target).attr("fName"),
				ctrlId = parseInt($(target).attr("ctrlId"));
			for(var i=0; i<srchController.fNamesArr.length;i++){
				if (fName == Runner.goodFieldName(srchController.fNamesArr[i])){
					fName = srchController.fNamesArr[i];
					break;
				}
			}
			srchController.delCtrl(fName, ctrlId);
		});
	},
	
	initButtons: function(){
		Runner.search.SearchController.superclass.initButtons.call(this);
		
		var searchController = this;
		
		$("a[id=showOptPanel"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			searchController.toggleSearchOptions();
		});
		$("a[id=showSrchWin"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			searchController.showSearchWin(e);
		});
		$("a[id=searchButton"+this.id+"]").bind("click", function(e){
			searchController.submitSearch();
			// add run loading for ajax reboot
		});
		$("a[id=showHideSearchType"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			searchController.toggleCtrlTypeCombo();
		});
		$("a[id=showHideControlChooseMenu"+this.id+"]").bind("click", function(e){
			Runner.Event.prototype.stopEvent(e);
			searchController.toggleCtrlChooseMenu();
		}); 
	},
		
	/**
	 * Get index of last added from cache control. 
	 * @param {string} filterName
	 * @return {int}
	 */
	getLastAddedInd: function(filterName){
		// if no map for this field
		if (!this.ctrlsShowMap[filterName]){
			return false;
		}
		// get last added and not cached ctrls block index
		var maxInd = 0, beforeMaxInd=false, i=0;
		for(var ind in this.ctrlsShowMap[filterName]){
			// need to convert to int from string. May be because object property name is string, typeof return string
			ind = parseInt(ind);
			// get max index, it will give last cached
			if (maxInd < ind){
				beforeMaxInd = maxInd;
				maxInd = ind;
			}
			// at first time take maxInd, because 0 may not appear
			if (i===0){
				beforeMaxInd = maxInd;
			}
			i++;
		}
		return beforeMaxInd;
	},
	/**
	 * returns last added filter, usefull when add new
	 * 
	 * @param {string} filterName field name
	 * @return {obj} true if success otherwise false
	 */
	getLastAdded: function(filterName){
		var beforeMaxInd = this.getLastAddedInd(filterName);
		if (!beforeMaxInd){
			return false;
		}
		// get obj
		var filterObj = $('#'+this.getFilterRowId(filterName, beforeMaxInd));
		if (filterObj.length){
			return filterObj;
		}else{
			return false;
		}
	},
	
	/**
	 * Adds ctrls block HTML to DOM
	 * @param {string} fName
	 * @param {string} ind
	 * @param {object} blockHTML
	 */
	addCtrlsHtml: function(fName, ind, blockHTML){
		this.addPanelHtml(fName, ind, blockHTML);
		// take tr container
		var rowCont = $('#'+this.getFilterRowId(fName, ind, this.srchWinShowStatus))
		// put into cells block html
		var cells = rowCont.children(),
			cellHTML = '<div class="runner-searchtype">' + blockHTML.comboHtml + '</div>'
						+ '<div class="runner-searchcontrol">' + blockHTML.control1 + '</div>'
						+ '<div class="runner-searchcontrol">' + blockHTML.control2 + '</div>';
		
		if (!Runner.isMobile){
			$(cells[0]).html(blockHTML.delButt);
			$(cells[2]).html(cellHTML);
		}
		else {
			$(cells[1]).html(cellHTML);
		}
		// execute additional js code
		eval(blockHTML.jsCode);	
	},
	
	addPanelHtml: function(fName, ind, blockHTML){
		// ctrl main container id
		var newSrchCtrlContId = this.getFilterRowId(fName, ind);
		// add ctrl main container
		var filterRowHtml = this.createTableRow(newSrchCtrlContId, 'srchPanelRow', this.styleDispNoneText, '');
		this.srchCtrlsBlock.append(filterRowHtml);
		// main container obj
		var newSrchCtrlCont = $("#"+newSrchCtrlContId);
		// add del button
		if (!Runner.isMobile){
			newSrchCtrlCont.append(this.createTableCell('srchPanelCell', '', ''));
			// add div with field name
			var fNameCellHtml = this.createTableCell('srchPanelCell', '', blockHTML.fLabel+':&nbsp;');
		}
		else {
			// add div with field name
			var fNameCellHtml = this.createTableCell('srchPanelCell', '',blockHTML.delButt+'&nbsp;'+blockHTML.fLabel+':&nbsp;');
		}
		newSrchCtrlCont.append(fNameCellHtml);
		// combo type container id
		var comboHtml = this.createTableCell('srchPanelCell srchPanelCell2', (this.ctrlTypeComboStatus ? '' : this.styleDispNoneText), '');    	
		newSrchCtrlCont.append(comboHtml);
	
		return newSrchCtrlCont;
	},
		
	/**
	 * Adds block to map, regs its components and ands HTML
	 * @param {} fName
	 * @param {} ind
	 * @param {} ctrlIndArr
	 * @param {} blockHTML
	 */
	addRegCtrlsBlock: function(fName, ind, ctrlIndArr, blockHTML){
		//add to DOM
		blockHTML ? this.addCtrlsHtml(fName, ind, blockHTML) : "";
		// call parent
		Runner.search.SearchController.superclass.addRegCtrlsBlock.call(this, fName, ind, ctrlIndArr);
		// set links for parent and child if lookup ctrl
		var ctrl = Runner.controls.ControlManager.getAt(this.tName, ind, fName);
		// if ctrl hidden it's used for cache, than, do not add link
		if (!ctrl.hidden){
			//this.setDependences(ctrl, true);
			this.setDependences(ctrl);
		}
		// reg combos
		this.searchTypeCombosArr.push($("#"+this.getComboContId(fName, ind)));
		// reg filter div block
		this.srchFilterRowArr.push($("#"+this.getFilterRowId(fName, ind)));
		// call crit controller
		this.toggleCrit(this.getVisibleBlocksCount());			
	},
	
	/**
	 * Creates table row and cell containers html
	 * @param {string} id
	 * @param {string} cssClass
	 * @param {string} style
	 * @param {string} innerHtml
	 * @return {string}
	 */
	createTableRow: function(id, cssClass, style, innerHtml){
		if (!Runner.isMobile){
			return '<tr class="'+cssClass+'" id="'+id+'" style="'+style+'">'+innerHtml+'</tr>';
		}
		else {
			return '<div class="'+cssClass+'" id="'+id+'" style="'+style+'">'+innerHtml+'</div>';
		}
	},
	
	createTableCell: function(cssClass, style, innerHtml){
		if (!Runner.isMobile) {
			return '<td class="'+cssClass+'" style="'+style+'">'+innerHtml+'</td>';
		}
		else {
			return '<div class="'+cssClass+'" style="'+style+'">'+innerHtml+'</div>';
		}
	},
	
	/**
	 * Put block into right place depending on ctrl type. 
	 * If parent field name passed, ctrl will be placed bellow parent
	 * If no parent passed, ctrl will be placed above last added for this field
	 * 
	 * @param {string} filterName
	 * @param {int} cachedInd
	 * @param {string} parentFieldName
	 */
	putCachedBlock: function(filterName, cachedInd, parentFieldName){
		// get control from cache
		var cachedRow = $("#"+this.getFilterRowId(filterName, cachedInd));
		// move cached div to top, insert it after control choose menu
		var lastAdded = this.getLastAdded(filterName);
		// if use parent
		if (parentFieldName && this.getLastAdded(parentFieldName)){
			cachedRow.insertAfter(this.getLastAdded(parentFieldName));
		}else if(lastAdded && $(lastAdded).attr("id")!=$(cachedRow).attr("id")){
			cachedRow.insertBefore(lastAdded);
		}else{
			this.srchCtrlsBlock.prepend(cachedRow);
		}
		// show row with controls
		cachedRow.show();
	},
	
	createLoadingBox: function(filterName){
		var loadingTxt = '&nbsp;&nbsp;' + filterName + ':&nbsp;loading&nbsp;...&nbsp;';
		// add tr for panel mode
		var loadTr = document.createElement('TR');
		var loadTd = document.createElement('TD');
		$(loadTd).attr('colspan', '3').addClass('cellBorderRightHovered').addClass('cellBorderLeftHovered').addClass('cellBorderCenterHovered').html(loadingTxt);    		
		$(loadTr).addClass('srchPanelRow').append(loadTd);
		return loadTr;
	},
	
	putLoadingBox: function(loadBox, filterName){
		// move cached div to top, insert it after control choose menu
		var lastAdded = this.getLastAdded(filterName);
		
		if(lastAdded){
			$(loadBox).insertBefore(lastAdded);
		}else{
			this.srchCtrlsBlock.append($(loadBox));
		}
	},
	/**
	 * Set dependent and parent links to ctrls. 
	 * If passed triggerReload, will invoke event of parent ctrl, to reload dependent ctrls
	 * 
	 * @param {obj} ctrl dependent control
	 * @param {string} parentFieldName field name of parent ctrl
	 * @param {Boolean} triggerReload pass true to reload dependent ctrls
	 * @return {Boolean} true if success otherwise false
	 */
	setDependences: function(ctrl, triggerReload){
		
		if (!ctrl.isLookupWizard){
			return false;
		}
		
		if(!ctrl.parentFieldName)
			return false;
		
		if (!ctrl.parentFieldName || !this.ctrlsShowMap[ctrl.parentFieldName]){
			return false;
		}
		// get parent index
		var parentInd = this.getLastAddedInd(ctrl.parentFieldName);
		if (!this.ctrlsShowMap[ctrl.parentFieldName][parentInd]){
			return false;
		}
		// get parent ctrl
		var parentCtrl = Runner.controls.ControlManager.getAt(this.tName, parentInd, ctrl.parentFieldName, this.ctrlsShowMap[ctrl.parentFieldName][parentInd][0]);
		
		// add link to child
		if (parentCtrl.showStatus && parentCtrl.isLookupWizard){
			ctrl.setParentCtrl(parentCtrl);
			// add to dependent array
			parentCtrl.addDependentCtrls([ctrl]);
			// reload all children
			if (triggerReload===true){
				parentCtrl.fireEvent('change');
			}else{
				ctrl.preload(ctrl.preloadData.vals, ctrl.preloadData.fVal);
			}
		}else{
			ctrl.reload();
		}
		return true;
	},
	
	getShownFilterNames: function(){
		var fNamesArr = [];
		
		for(var fName in this.ctrlsShowMap){
			var cachedInd = 0;
			for(var ind in this.ctrlsShowMap[fName]){
				// need to convert to int from string. May be because object property name is string, typeof return string
				ind = parseInt(ind);
				
				if(this.isFieldShownById(fName, ind)){
					fNamesArr.push(fName);
				}
			} 
		}
		
		return fNamesArr;
	},
	
	showCached: function(filterName){
		// no cache
		if (!this.ctrlsShowMap[filterName]){
			return false;
		}
		// index of div, that cached and we need to show it
		var cachedInd = 0;
		for(var ind in this.ctrlsShowMap[filterName]){
			// need to convert to int from string. May be because object property name is string, typeof return string
			ind = parseInt(ind);
			if(!this.isFieldShownById(filterName, ind)){
				// get max not shown index
				cachedInd = ind;
				break;
			}
		}
		// no cached ctrls, only already shown
		if(!cachedInd || this.isFieldShownById(filterName, cachedInd)){
			return false;
		}
		
		// index of last cached ctrl for this field
		var cachedCtrlIndArr = this.ctrlsShowMap[filterName][cachedInd];
		//------------------------------------------------------------------------------------------
		// process controls
		var objIndForCM, parentFieldName, parentCtrl = null, parentInd = false, ctrl1;
		// scan each object
		for(var i=0;i<cachedCtrlIndArr.length;i++){
			// index of object that stored in CM
			objIndForCM = cachedCtrlIndArr[i];
			// get ctrl
			var ctrlFromCache = Runner.controls.ControlManager.getAt(this.tName, cachedInd, filterName, objIndForCM);
			// save link to first ctrl, at the end use it to set focus on it
			if (i===0){
				ctrl1 = ctrlFromCache;
				// show ctrl
				ctrl1.show();
			}
			// get parentFieldName for lookup ctrls and add dependeces to lookup ctrls
			parentFieldName = ctrlFromCache.parentFieldName;
			// set dependeces between child and parent if these links could be
			this.setDependences(ctrlFromCache, true);
			// clear javascript, to prevent it executing second time
			ctrlFromCache.spanContElem.find('script').remove();
		}
		//------------------------------------------------------------------------------------------
		// place ctrl depend on it's type: lookup or simple
		this.putCachedBlock(filterName, cachedInd, parentFieldName);
		// show type combo, if it shown in others ctrl
		if (this.ctrlTypeComboStatus){
			$("#"+this.getComboContId(filterName, cachedInd)).show();
		}
		// set focus to added ctrl, turned off in window mode, because it cause bad visual effects in bottom control in window mode
		if (!this.srchWinShowStatus && !Runner.isMobile){
			ctrl1.setFocus();
		}
		return true;
	},
	
	/**
	 * Adds filter to panel or window, and loads another one for cache
	 * @param {string} filterName
	 * @param {function} callback user function
	 */
	addFilter: function(filterName, userCallBack) {
		
		// Chek if there are any shown fields on serach panel
		var cashedInd;
		if(!this.getShownFilterNames().isInArray(filterName, true)){
			// get cashed field id 
			cashedInd = this.getLastAddedInd(filterName);
		}
		// add object of new added field
		var sfInd = this.searchFields[filterName].length;
		this.searchFields[filterName][sfInd] = new Runner.search.SearchField({
				id: (cashedInd || 0),
				fName: filterName,
				searchObj: this
			});	
		
		var isShown = this.showCached(filterName);
		if (!isShown){
			var loadBox = this.createLoadingBox(filterName);
			this.putLoadingBox(loadBox, filterName);
		}else{
			this.ctrlTypeComboStatus ? this.showCtrlTypeCombo() : this.hideCtrlTypeCombo();
		}
		
		// ajax params
		var ajaxParams = {
			searchControllerId: this.id,
			rndval: Math.random(),
			mode: "inlineLoadCtrl",
			ctrlField: filterName,
			id: Runner.genId(),
			isNeedSettings: !Runner.pages.PageSettings.checkSettings(this.tName, filterName)
		};
		// create var for ajax handler closure
		var controller = this;
		// ajax query and callback func 
		$.getJSON(this.ajaxSearchUrl, ajaxParams, function(ctrlJSON, queryStatus){
			// register new ctrl block
			controller.addRegCtrlsBlock(filterName, ctrlJSON.divInd, (ctrlJSON.control2 ? [0, 1] : [0]), ctrlJSON);
			
			if (!Runner.pages.PageSettings.checkSettings(controller.tName, filterName, controller.pageType)){
				Runner.pages.PageSettings.addSettings(controller.tName, ctrlJSON.settings);
			}
			var ctrl;
			for(var i=0; i<ctrlJSON.ctrlMap.length; i++){
				ctrl = Runner.controls.ControlFabric(ctrlJSON.ctrlMap[i], controller.pageType);
				if(controller.useSuggest && ctrl.editFormat == Runner.controls.constants.EDIT_FORMAT_TEXT_FIELD){
					ctrl.on('keyup', function(e, argsArr){
						var srchTypeComboId = controller.getComboId(controller.tName, controller.id);
						var srchTypeCombo = $('#'+srchTypeComboId);
						var suggestUrl = 'searchsuggest.php?table='+controller.shortTName;
						return searchSuggest_new(e, this, srchTypeCombo, 'advanced', suggestUrl);
					}, {buffer: 200});
					ctrl.on('keydown', function(e, argsArr){
						return controller.listenEvent(e, this.valueElem.get(0), controller);
					});
				}
			}
			if (!isShown){
				controller.showCached(filterName);
				$(loadBox).remove();
				controller.toggleCrit(controller.getVisibleBlocksCount());
				// because ajax ctrl will shown with delay
				controller.ctrlTypeComboStatus ? controller.showCtrlTypeCombo() : controller.hideCtrlTypeCombo();
			}
			$(".srchPanelCell2").show();
			
			if(typeof controller.searchFields[filterName][sfInd] !='undefined' && !controller.searchFields[filterName][sfInd].id){
				if(controller.isFieldShownById(filterName, ctrlJSON.divInd)){
					controller.searchFields[filterName][sfInd].id = ctrlJSON.divInd;
				}else{
					controller.searchFields[filterName][sfInd].id = controller.getLastAddedInd(filterName);
				}
				controller.searchFields[filterName][sfInd].init();
			}
			
			if(typeof userCallBack != 'undefined'){
				userCallBack(controller.searchFields[filterName][sfInd]);
			}
		});
	},
	
	addFilterInNumber: function(filterName, number, userCallBack){
		for(var i=0; i<number; i++){
			this.addFilter(filterName, userCallBack);
		}
	},
	
	isFieldShownById: function(fName, id){
		if($("#" + this.getFilterRowId(fName, id)).css('display')!='none'){
			return true;
		}
		return false;
	},
	
	/**
	 * Deletes controls, its objects add html from DOM
	 * @param {string} fName
	 * @param {int} ind
	 */
	delCtrl: function(fName, ctrlId){
		var objIndForCM,
			ctrl;
		
		// ureg ctrls, loop will delete also second ctrl, if it was created
		for(var i=0;i<this.ctrlsShowMap[fName][ctrlId].length;i++){
			// index of object that stored in CM
			objIndForCM = this.ctrlsShowMap[fName][ctrlId][i];
			ctrl = Runner.controls.ControlManager.getAt(this.tName, ctrlId, fName, objIndForCM);
			// for lookup ctrls, clear links from children and trigger reload them with all values
			if (ctrl.isLookupWizard){
				ctrl.clearChildrenLinks(true);
			}
			// delete each object
			Runner.controls.ControlManager.unregister(this.tName, ctrlId, fName, objIndForCM);
		}
		
		// remove element from dom
		this.removeComboById(this.getComboContId(fName, ctrlId));
		this.removeFilterById(this.getFilterRowId(fName, ctrlId));
		// call crit controller
		this.toggleCrit(this.getVisibleBlocksCount());
		// remove from ctrl show map
		delete this.ctrlsShowMap[fName][ctrlId];
		if(this.useSuggest){
			DestroySuggestDiv();
		}
	},
	/**
	 * Deletes filter by id, removes from array and DOM element
	 * @param {string} id
	 */
	removeFilterById: function(id){
		// del from panel arr
		var elemInd = this.srchFilterRowArr.getIndexOfElem(id, function(val, elem){
			return elem.attr('id')==val;
		});
		if (elemInd !== -1){
			this.srchFilterRowArr[elemInd].remove();
			this.srchFilterRowArr.splice(elemInd, 1);
		}
	},
	/**
	 * Deletes combo cont by id, removes from array and DOM element
	 * @param {string} id
	 */
	removeComboById: function(id){
		// del from panel arr
		var elemInd = this.searchTypeCombosArr.getIndexOfElem(id, function(val, elem){
			return elem.attr('id')==val;
		});
		if (elemInd !== -1){
			this.searchTypeCombosArr.splice(elemInd, 1);
		}
	},
	/**
	 * Get number of visible ctrls blocks
	 * @return {int}
	 */
	getVisibleBlocksCount: function(){
		var visCount = 0;
		// use tr arr if window mode, or div arr if panel
		var rowArr = this.srchFilterRowArr;
		// loop through all filters to get which are visible
		for(var i=0; i<rowArr.length; i++){
			if (rowArr[i].css('display') != 'none'){
				visCount++;
			}
		}
		return visCount;
	},
	/**
	 * Resets form ctrls, for panel
	 * @return {Boolean}
	 */
	resetCtrls: function(){
		var objIndForCM;
		
		for(var fName in this.ctrlsShowMap){
			for(var ind in this.ctrlsShowMap[fName]){
				for(var i=0;i<this.ctrlsShowMap[fName][ind].length;i++){
					// index of object that stored in CM
					objIndForCM = this.ctrlsShowMap[fName][ind][i];
					// delete each object
					var ctrl = Runner.controls.ControlManager.getAt(this.tName, this.id, fName, objIndForCM);
					ctrl.reset();
				}
			}
		}
		return false;
	},
	
	rememberPanelState: function(){
		
		var cutFrom = document.location['pathname'].lastIndexOf('/', 1);
		var cookieRoot = document.location['pathname'].substr(0,(cutFrom+1));
		
		var panelStateObj = {
			srchPanelOpen: this.srchOptShowStatus, 
			srchCtrlComboOpen: this.ctrlTypeComboStatus, 
			srchWinOpen: this.srchWinShowStatus, 
			openFilters: []
		};
		if (this.srchWinShowStatus){
			var offsetParent = this.win.bodyNode.getDOMNode().offsetParent
			panelStateObj.winState = {
				x: this.win.get("x") + offsetParent.offsetLeft,
				y: this.win.get("y") + offsetParent.offsetTop,
				h: $(offsetParent).height(),
				w: $(offsetParent).width()
			};
		}
		
		if (!this.usedSrch){
			panelStateObj.openFilters = this.getShownFilterNames();
		}
		
		var searchPanelCookie = get_cookie('searchPanel'), searchPanel = {};
		if(searchPanelCookie && searchPanelCookie.length){
			searchPanel = JSON.parse(searchPanelCookie);
		}
		
		searchPanel['panelState_'+this.shortTName+'_'+this.id] = panelStateObj;
		var panelStateString = JSON.stringify(searchPanel);
		set_cookie('searchPanel', panelStateString, this.panelStateExpires, cookieRoot, '', '');
	},
	
	remindPanelState: function(){
		var panelStateString = get_cookie('searchPanel');
		var panelStateObj = null;
		if(panelStateString && panelStateString.length){
			var searchPanel = JSON.parse(panelStateString);
			if(searchPanel['panelState_'+this.shortTName+'_'+this.id] != undefined){
				panelStateObj = searchPanel['panelState_'+this.shortTName+'_'+this.id];
			}
		}
		if (!panelStateObj){
			if (this.panelSearchFields.length){
				this.showSearchOptions();
			}		
			return;
		}
		
		if (panelStateObj.srchWinOpen){
			this.hideSearchOptions();
			this.showSearchWin(panelStateObj.winState);
		}else if(panelStateObj.srchPanelOpen){
			this.showSearchOptions();
		}
		
		if (panelStateObj.srchCtrlComboOpen){
			this.showCtrlTypeCombo();
		}else{
			this.hideCtrlTypeCombo();
		}
		
		if (!this.usedSrch){
			// cut all quick search fields from array
			for(var i=0;i<this.panelSearchFields.length;i++){
				var elemIndex = panelStateObj.openFilters.getIndexOfElem(this.panelSearchFields[i]);
				if (elemIndex != -1){
					panelStateObj.openFilters.splice(elemIndex, 1);
				}
			}
			// add fields
			for(var i=0;i<panelStateObj.openFilters.length;i++){
				this.addFilter(panelStateObj.openFilters[i]);
			}
		}
	},
	
	getFieldIds: function(fName, disp){
		var idsArr = [];
		if(this.ctrlsShowMap[fName]){
			for(var id in this.ctrlsShowMap[fName]){
				if(disp === true){
					if(this.isFieldShownById(fName, id)){
						idsArr.push(id);
					}
				}else{
					idsArr.push(id);
				}
			}
		}
		return idsArr;
	},
	
	getFieldControls: function(fName, disp){
		var ctrlsArr = [], ctrl = null, idsArr = this.getFieldIds(fName, disp);
		for(var i=0; i<idsArr.length; i++){
			ctrl = Runner.controls.ControlManager.getAt(this.tName, idsArr[i], fName);
			ctrlsArr.push(ctrl);
		}
		return ctrlsArr;
	},
	
	getSecondCntrl: function(fName, id){
		return Runner.controls.ControlManager.getAt(this.tName, id, fName, 1);
	},
	
	getFieldOptions: function(fName, disp){
		var optsArr = [], opt = null, idsArr = this.getFieldIds(fName, disp);
		for(var i=0; i<idsArr.length; i++){
			opt = $('#'+this.getComboId(fName, idsArr[i])).get(0);
			optsArr.push(opt);
		}
		return optsArr;
	},
	
	/**
	 * Get list of search panel fields
	 * User function
	 * @return {array}
	 */
	getSearchFields: function(fName){
		if(typeof fName != 'undefined')
		{
			return this.searchFields[fName];
		}
		var allFields = [];
		for(var fName in this.searchFields){
			for(var i=0; i<this.searchFields[fName].length; i++){
				allFields[allFields.length] = this.searchFields[fName][i];
			}
		}
		return allFields;
	},
	/**
	 * Add field to search filter
	 * User function
	 * @param {string}
	 * @param {function} user callback
	 */
	addField: function(fName, callback){
		if(typeof fName == 'undefined' || !fName){
			return;
		}
		this.addFilter(fName, callback);
	},
	/**
	 * Delete field from search filter
	 * User function
	 * @param {string}
	 * @param {integer}
	 */
	deleteField: function(fName, id){
		if(typeof fName == 'undefined' || !fName){
			return;
		}
		//delete all fields with name like fName from search panel
		if(typeof id == 'undefined'){
			var ids = this.getFieldIds(fName, true);
			for(var i=0; i<ids.length; i++){
				this.delCtrl(fName, ids[i]);
			}
			this.searchFields[fName] = [];
		}else{ //delete only field with current id
			this.delCtrl(fName, id);
			for(var i=0; i<this.searchFields[fName].length; i++){
				if(this.searchFields[fName][i].id == id){
					delete this.searchFields[fName][i]
					break;
				}
			}
		}
	},
	/**
	 * Clear search panel
	 * User function
	 */
	clear: function(){
		var shownFields = this.getShownFilterNames();
		for(var i=0; i<shownFields.length; i++){
			this.deleteField(shownFields[i]);
		}
	},
	/**
	 * Display search panel
	 * User function
	 * @param {string}
	 */
	display: function(as){
		switch (as){
			case "show":
				if(!this.srchWinShowStatus){
					this.showSearchOptions();
				}else{
					this.hideSearchWin();
				}
				break;
			case "hide":
				if(this.srchWinShowStatus){
					this.hideSearchWin();
				}
				this.hideSearchOptions();
				break;
			case "popup":
				this.showSearchWin();
				break;
		}
	}, 	
	/**
	 * Toggle options
	 * User function
	 */
	toggleOptions: function(as){
		switch (as){
			case "show":
				this.showCtrlTypeCombo();
				break;
			case "hide":
				this.hideCtrlTypeCombo();
				break;
		}
	},
	/**
	 * Toggle criteria
	 * User function
	 * @param {string}
	 */
	toggleCriteria: function(as){
		switch (as){
			case "all":
				$('#all_checkbox', this.pageObj.pageCont).prop('checked', true);
				break;
			case "any":
				$('#any_checkbox', this.pageObj.pageCont).prop('checked', true);
				break;
			case "show":
				this.topCritCont.show();
				break;
			case "hide":
				this.topCritCont.hide();
				break;
		}
	}
});

// create namespace
Runner.namespace('Runner.form');
Runner.form.BasicForm = function(cfg){
	
	this.fieldControls = [];
	this.fields = [];
	this.addElems = [];
	this.ajaxForm = {};
	this.baseParams = {};
	Runner.apply(this, cfg);
	
	this.addEvents('beforeSubmit', 'successSubmit', 'submitFailed', 'validationFailed');
		
	
	if (this.beforeSubmit){
		this.on({'beforeSubmit': this.beforeSubmit});
	}
	if (this.successSubmit){
		this.on({'successSubmit': this.successSubmit});
	}
	if (this.submitFailed){
		this.on({'submitFailed': this.submitFailed});
	}
	if (this.validationFailed){
		this.on({'validationFailed': this.validationFailed});
	}
	
	Runner.form.BasicForm.superclass.constructor.call(this. cfg);
	
	if (cfg.initImmediately){
		this.initForm();
	}
};

Runner.form.BasicForm = Runner.extend(Runner.form.BasicForm, Runner.util.Observable, {
	
	fields: null,
	
	fieldControls: null,
	
	addElems: null,
	
	isFileUpload: false,
	
	standardSubmit: false,
	
	searchSubmit: false,
	
	formEl: null,
	
	ioEl: null,
	
	ioElId: '',
	
	submitUrl: '',
	
	method: 'POST',
	
	id: -1,
	
	baseParams: null,
	
	tName: '',
	
	shortTName: '',	
	
	target: '',
	
	ajaxForm: null,
	
	searchForm: null,
	
	autoValidation: true,
	
	addRndVal: true,
	
	useMultipart: false,
	
	isSearchForm: false,
	
	deleteAfterSubmit: false,
	
	initControls: function(){
	
	},
	
	destructor: function(leaveControls){
		if (leaveControls === true){
			for(var i=0;i<this.fieldControls.length;i++){
				this.fieldControls[i].unregister();
			}
		}
		
		if (this.ioEl){
			var iframe = this.ioEl;
			setTimeout(function(){
				$(iframe).remove();
			}, 0);
		}
		if (this.formEl){
			$(this.formEl).remove();
		}
	},
	
	submit: function(){
		this.triedToSubmit = true;
		var beforeSubmitRes = this.fireEvent('beforeSubmit', this);
		if (beforeSubmitRes === false){
			return false;
		}
		
		if (!this.validate()){
			return false;
		};
		
		if (this.isFileUpload || this.standardSubmit){
			if(this.searchSubmit && Runner.charSet == "utf-8"){
				var queryStr = '';
				$.each(this.searchForm, function(formParameter, parameterValue){
					queryStr += (queryStr == '' ? '' : '&') + formParameter + '=' + parameterValue;
				});
				var vars = {}, paramsStr = window.location.href;
				if(paramsStr.substr(paramsStr.length - 1) == '#'){
					paramsStr = paramsStr.substr(0, paramsStr.length - 1);
				}	
				paramsStr.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
					vars[key] = value;
				});
				var paramNames = ['rname', 'cname'];
				for(var i = 0; i < paramNames.length; i++)
					if(vars[paramNames[i]]){
						queryStr += (queryStr == '' ? '' : '&') + paramNames[i] + '=' + encodeURIComponent(vars[paramNames[i]]);
					}	
				queryStr = this.submitUrl + (queryStr != '' ? '?' + queryStr : '');
				if(queryStr.length < 2040){
					location.href = queryStr;
					return;
				}else{
					this.formEl.method = 'POST';
					}
			}
			this.initForm();
			this.addFormSubmit();
			this.formEl.submit();
		}else{
			this.addFormSubmit();
			// for closure
			var formObj = this;
			$.runnerAJAX(this.submitUrl, this.ajaxForm, function(respObj) {
				formObj.fireEvent("successSubmit", respObj, formObj, formObj.fieldControls);
			});
			/*$.ajax({ 
				url: this.submitUrl,
				type: 'POST',
				data: this.ajaxForm,
				success: function(data, textStatus, XMLHttpRequest) {
					var respObj = JSON.parse(data);
					formObj.fireEvent("successSubmit", respObj, formObj, formObj.fieldControls);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					formObj.fireEvent("successFailed", respObj, formObj, formObj.fieldControls);
				}
			});*/
		}
		return true;
	},
	
	initForm: function(){
		if (this.isFormReady){
			//this.clearForm();
			return;
		}
		if (this.isFileUpload && !this.standardSubmit){
			this.createIFrame();
			this.createForm();
		}else if(this.standardSubmit){
			this.createForm();
		}
		this.isFormReady = true;
	},
	
	clearForm: function(){
		if (this.formEl){
			$(this.formEl).children().remove();
		}
		this.ajaxForm = {};
		this.searchForm = {};
		return true;
	},
	
	addFormSubmit: function(){
		if (this.isFormReady && !this.isSearchForm){
			this.clearForm();
		}
		if (this.addRndVal){
			this.baseParams["rndVal"] = Math.random();
		}
		if (this.formEl){
			var arrClns;
			for(var i=0; i<this.fieldControls.length; i++){
				arrClns = this.fieldControls[i].getForSubmit();
				for (var j = 0; j < arrClns.length; j++){ 
					$(arrClns[j]).appendTo(this.formEl);
				}
			}
			for(var param in this.baseParams){
				this.addToForm(param, this.baseParams[param]);
			}
			for(var i=0; i<this.addElems.length; i++){
				$(this.addElems[i]).appendTo(this.formEl);
			}
		}else{
			this.ajaxForm = Runner.apply(this.ajaxForm, this.baseParams);
			for(var i=0; i<this.fieldControls.length; i++){
				this.ajaxForm[this.fieldControls[i].fieldName] = this.fieldControls[i].getStringValue(); 
			}
			for(var i=0; i<this.addElems.length; i++){
				$(this.addElems[i]).appendTo(this.formEl);
				this.addToForm(this.addElems[i].attr("id") || this.addElems[i].attr("name"), this.addElems[i].val());
			}
		}
		return true;
	},
	
	addToForm: function(id, val){
		if (typeof val == 'undefined' || typeof id == 'undefined' || val === null || id === null){
			return false;
		}
		
		if (this.isFileUpload || this.standardSubmit){
			if (!this.formEl){
				this.initForm();
			}
			var formElem = document.createElement('INPUT');
			$(formElem).attr('type', 'hidden').attr('name', id).attr('id', id).val(val.toString()).appendTo(this.formEl);
			if(this.searchSubmit)
				this.ajaxForm[id] = val;
		}else{
			this.ajaxForm[id] = val;
		}
	},
	
	addToSearchForm: function(id, val){
		if (typeof val == 'undefined' || typeof id == 'undefined' || val === null || id === null){
			return false;
		}
		
		this.searchForm[id] = val;
	},
	
	addElemToForm: function(el){
		if (!el){
			return false;
		}
		if ($(el).attr("id") === ""){
			return false;
		}
		if (this.isFileUpload || this.standardSubmit){
			if (!this.formEl){
				return false;
			}
			$(el).appendTo(this.formEl);
		}else{
			this.ajaxForm[$(el).attr("id")] = $(el).val();
		}
	},
	
	validate: function(){
		if (!this.autoValidation){
			return true;
		}
		var vRes, 
			controlsArr = [];
		for(var i=0; i<this.fieldControls.length; i++){
			vRes = this.fieldControls[i].validate();
			if (!vRes.result){
				controlsArr.push(this.fieldControls[i]);
			}
		}
		if (controlsArr.length){
			controlsArr[0].setFocus();
			this.fireEvent("validationFailed", this, this.fieldControls, controlsArr);
			return false;
		}else{
			return true;
		}
	},
	
	createIFrame: function(){
		if (this.ioEl){
			return false;
		}
		var frameId = 'uploadFrame_'+this.id;
		
		if(Runner.isIE){
			this.ioEl = document.createElement('<iframe name="' + frameId + '"/>');
		}else{
			this.ioEl = document.createElement('iframe');
			this.ioEl.setAttribute('name', frameId);
		}
		if(Runner.isIE){
			this.ioEl.setAttribute('src', 'javascript:false');
		}
		this.ioEl.setAttribute('id', frameId);
		
		this.ioEl.style.position = 'absolute';
		this.ioEl.style.top = '-1000px';
		this.ioEl.style.left = '-1000px';
		
		document.body.appendChild(this.ioEl);
		// for closure
		var basicForm = this;
		
		$(this.ioEl).bind('load', function(e){
			var iframeNode = $("#"+frameId)[0], ioDoc;
			if (iframeNode.contentDocument){
				ioDoc = iframeNode.contentDocument;
			}else if(iframeNode.contentWindow){
				ioDoc = iframeNode.contentWindow.document;
			}else{
				ioDoc = iframeNode.document;
			}
			if (ioDoc.body.innerHTML!=''){
				// if response contain PHP error
				try{
					var response = $(ioDoc.body.innerHTML).text()
					var responseObj = JSON.parse(response);
				}catch(e){
					basicForm.fireEvent('submitFailed', ioDoc.body.innerHTML, basicForm, basicForm.fieldControls);
					return ;
				}
				basicForm.fireEvent('successSubmit', responseObj, basicForm, basicForm.fieldControls);
			}else{
				basicForm.fireEvent('submitFailed', {}, basicForm, basicForm.fieldControls);
			}
			if(basicForm.deleteAfterSubmit){
				basicForm.destructor(true);
			}
		});
		
		this.ioElId = frameId;
		
		return this.ioEl;
	},
	
	createForm: function(){
		if (this.formEl){
			return false;
		}
		this.formEl = document.createElement('FORM');
		
		this.formEl.action = this.submitUrl;
		this.formEl.method = this.method;
		
		if (this.target){
			this.formEl.target = this.target;
		}
		
		$(this.formEl).css('display', 'none');
		if (this.isFileUpload || this.useMultipart){
			//this.formEl.enctype = "multipart/form-data";
			$(this.formEl).attr('enctype', 'multipart/form-data');
		}
		
		if (this.ioEl){
			$(this.formEl).attr('target', this.ioElId);
		}
		
		document.body.appendChild(this.formEl);
		
		/*$(this.formEl).bind('submit', {basicForm: this}, function(e){
			e.data.basicForm.fireEvent('afterSubmit');
		});*/
		
		return this.formEl;
	},
	
	makeReadonly: function(){
		for(var i=0;i<this.fieldControls.length;i++){
			this.fieldControls[i].makeReadonly();
		}
	},
	
	makeReadWrite: function(){
		for(var i=0;i<this.fieldControls.length;i++){
			this.fieldControls[i].makeReadWrite();
		}
	}
});

$.runnerAJAX = function(submitUrl, baseParams, succesHandler){
	(function(){
		var basicForm = new Runner.form.BasicForm({
			id: Runner.genId(),
			
			standardSubmit: false,
			isFileUpload: true,
			submitUrl: submitUrl,
			method: 'POST',
			baseParams: baseParams,
			deleteAfterSubmit: true,
			successSubmit: {
				fn: succesHandler,
				scope: this
			}
		});
		basicForm.submit();
	})();
};
// create namespace
Runner.namespace('Runner.util.details');

/**
 * Base abstract class for details preview inline
 * provides base functionality and event handling
 * @class Runner.util.details.DP
 */
Runner.util.details.DP = Runner.extend(Runner.util.Observable, {
	/**
	 * Detail data source table name
	 * @type {string}
	 */
	tName: "",
	/**
	 * Detail short table name
	 * @type {string}
	 */
	shortTName: "",
	/**
	 * Master data source table name
	 * @type {string}
	 */
	masterTName: "",
	/**
	 * Master short table name
	 * @type {string}
	 */
	masterShortTName: "",
	/**
	 * Ajax request url
	 * @type {string}
	 */
	ajaxRequestUrl: "",
	/**
	 * Detail page type
	 * @type {string}
	 */
	pageType: "",
	
	dpType: Runner.pages.constants.DP_NONE,
	/**
	 * Detail page id
	 * @type {string}
	 */
	id: 0,
	/**
	 * Parent page id
	 * @type {string}
	 */
	parId: 1,
	
	constructor: function(cfg){
		Runner.apply(this, cfg);
		Runner.util.details.DP.superclass.constructor.call(this, cfg);
		
		this.shortTName = Runner.pages.PageSettings.getShortTName(this.tName);
		this.masterShortTName = Runner.pages.PageSettings.getShortTName(this.masterTName);
		this.ajaxRequestUrl = this.shortTName + "_" + this.pageType + ".php";
	},
	
	init: function(){
		// . . . 
	}
});

/**
  * @class Runner.util.details.ListDP
  * Provides base functionality for details on list page
  */
Runner.util.details.ListDP = Runner.extend(Runner.util.details.DP, {
	/**
	 * Current row object
	 * @type {object}
	 */
	rows: null,
	/**
	 * Main master page type
	 * For example:
	 * We have master page add with detail table1, which has detail table2
	 * For detail table2 main master page type will be add
	 * @type {string}
	 */
	mainMasterPageType: "",
	/**
	 * Records per row on list
	 * @type {integer}
	 */
	recsPerRowList: 1,
	/**
	 * Hide child link or not 
	 * @type {boolean}
	 */
	hideChild: false,
	
	constructor: function(cfg){
		this.rows = [];
		this.dpType = Runner.pages.constants.DP_INLINE;
		this.pageType = Runner.pages.constants.PAGE_LIST;
		
		Runner.util.details.ListDP.superclass.constructor.call(this, cfg);
		this.addEvents("beforeShow", "afterShow");
		
		this.parPageObj = Runner.pages.PageManager.getById(this.parId);
		this.isVertLayout = Runner.pages.PageSettings.getTableData(this.masterTName, "isVertLayout");
		this.recsPerRowList = Runner.pages.PageSettings.getTableData(this.masterTName, "recsPerRowList");
		this.hideChild = Runner.pages.PageSettings.getTableData(this.masterTName, "detailTables")[this.tName]['hideChild'] == 1;
	},
	
	init: function(){
		Runner.util.details.ListDP.superclass.init.call(this);
		this.initRows();
		
		if (this.parPageObj){
			this.mainMasterPageType = this.parPageObj.pageType;
		}
	},
	
	initRows: function(){
		for(var i=0; i<this.rows.length; i++){
			this.rows[i] = Runner.apply({}, this.rows[i]);
			this.initRow(this.rows[i]);
		}
	},
	
	initRow: function(row, setHref){
		if (!row.row){
			row.row = $("#gridRow"+row.id);
			
			if (!row.row.length){
				row.row = $("#master_"+this.shortTName+row.id);
			}
			if (!row.row.length){
				row.row = $("#"+this.shortTName+"_preview"+row.id).closest('tr[id^=gridRow]');
			}
		}
		row.masterKeys = row.masterKeys[this.tName] || row.masterKeys;
		if(this.dpType != Runner.pages.constants.DP_POPUP){
			this.initLink(row, setHref);
			this.getDetailLinkId(row);
		}
	},
	
	/**
	 * Get detail link id
	 * @param {object} row
	 */
	getDetailLinkId: function(row){
		if (this.recsPerRowList>1){
			row.detLinksId = [];
			var pattern = this.shortTName+"_preview";
			$("a[id^="+this.shortTName+"_preview]",row.row).each(function(){
				row.detLinksId.push(this.id.substr(pattern.length));
			});
		}
	},
	
	/**
	 * Set event handler for detail preview links 
	 * @param {object} row
	 * @param {boolean} set attr href or not
	 */
	initLink: function(row, setHref){
		var dpObj = this;
		if(!Runner.isMobile){
			$("#"+this.shortTName+"_preview"+row.id).bind("click", {row: row}, function(e){
				Runner.Event.prototype.stopEvent(e);
				if(row.isShown){
					dpObj.closeDetails(null, row);
				}else{
					dpObj.getDetails(e.data.row);
					dpObj.parPageObj.hideBrick("message");
				}
			});
		}
		if(setHref === true){
			var mKeys = [], i = 0;
			for(var k in row.masterKeys){
				mKeys[i++] = row.masterKeys[k];
			}
			$("#"+this.shortTName+"_preview"+row.id).attr('href', Runner.pages.getUrl(this.tName, this.pageType, mKeys, "masterkey") + "&mastertable="+this.masterShortTName);
		}
	},
	
	/**
	 * Add new master row, added with inlineAdd
	 * @param {object} new added row
	 */
	addRow: function(row){
		this.rows.push(row);
		row.rowInd = this.rows.length-1;
		// init new added row
		this.initRow(row, true);
		// set correct det num
		var childRecNum = this.getChildCountBySameKeys(row);
		this.setChildRecNum(row, childRecNum);
	},
	
	getChildCountBySameKeys: function(row){
		var mKeysAsString = JSON.stringify(row.masterKeys);
		for(var i=0;i<this.rows.length;i++){
			if(this.rows[i].id != row.id && mKeysAsString == JSON.stringify(this.rows[i].masterKeys)){
				return this.rows[i].childNum;
			}
		}
		return "0";
	},
	
	getDetails: function(row){
		if (row.isShown === true || row.startRequest === true){
			return false;
		}
		this.fireEvent('beforeShowDetails', this, row);
		row.startRequest = true;
		var params = this.getParams(row);
		$.runnerAJAX(this.ajaxRequestUrl, params, this.showDetails.createDelegate(this, [row, params], 1));
	},
	
	getParams: function(row){
		return Runner.apply({
			id: Runner.genId(),
			mode: Runner.pages.constants.MODE_LIST_DETAILS,
			rndVal: Math.random(),
			mastertable: this.masterTName,
			masterid: this.id,
			masterpagetype: this.pageType,
			mainmasterpagetype: this.mainMasterPageType
		}, row.masterKeys);
	},
	
	createPreviewRow: function(row){
		var nextGridRow = row.row.next(); // get next row
		if (this.recsPerRowList > 1){
			//recsPerRowList > 1
			if (nextGridRow.hasClass('runner-dpreviewrow')) {
				//td for dpreview isset
				row.detTr = nextGridRow;
				row.detTd = $("#"+this.masterShortTName+"_previewcell"+row.id, row.detTr);
			}else{
				//create new row
				row.detTr = $(document.createElement("TR")).addClass('runner-dpreviewrow');
				var colSpanArr = [];
				var start = 0, i = 0;
				row.row.children('td').each(function(){
					if ($(this).attr("colid") == "endrecord"){
						colSpanArr[colSpanArr.length] = i - start;
						start = i+1;
					}
					i++;
				});
				colSpanArr[colSpanArr.length] = i - start;
				
				//create TD
				row.row.after(row.detTr);
				for(var i=0; i < colSpanArr.length; i++){
					$(document.createElement("TD"))
						.addClass('dpinline dpframe-cl dpframe-cc dpframe-cr')
						.attr('colspan', colSpanArr[i])
						.attr('id', this.masterShortTName+"_previewcell"+row.detLinksId[i])
						.appendTo(row.detTr);
					
					$(document.createElement("TD"))
						.addClass('runner-cs')
						.attr('colid', "endrecord")
						.appendTo(row.detTr);
				}
				row.detTd = $("#"+this.masterShortTName+"_previewcell"+row.id, row.detTr);
			}
		}else{
			//recsPerRowList <= 1
			if(nextGridRow.hasClass('runner-dpreviewrow')){
				row.detTr = nextGridRow;
				row.detTd = $('.dpinline', nextGridRow);
			}else{
				row.detTr = $(document.createElement("TR")).addClass('runner-dpreviewrow');
				row.detTd = $(document.createElement("TD")).addClass('dpinline dpframe-cc');
				row.row.after(row.detTr);
				if(!this.isVertLayout){
					$(document.createElement("TD")).addClass('runner-cl dpframe-cl').appendTo(row.detTr);
					row.detTd.appendTo(row.detTr).attr('colspan', row.row.find('td').length-2);
					$(document.createElement("TD")).addClass('runner-cr dpframe-cr').appendTo(row.detTr);
				}else{
					row.detTd.appendTo(row.detTr).addClass('dpframe-cl dpframe-cr').attr('colspan', row.row.find('td').length-2);
				}
			}
		}
	},
	
	showDetails: function(respObj, row, params){
		if (respObj.success === false){
			// show error in td for details
			return;
		}
		Runner.pages.PageSettings.addSettings(this.tName, respObj.settings, false);
		
		// show html
		this.createPreviewRow(row);
		row.detCont = $(document.createElement("DIV"));
		
		var dpObj = this, newId = params.id;
		
		row.detCont.
			attr('id', 'detailPreview'+newId).
			addClass('runner-pagewrapper').
			addClass(Runner.pages.PageSettings.getTableData(this.tName, "pageSkinStyle")).
				appendTo(row.detTd.empty()).
					html(respObj.html).
						before(
							'<div id="dpHide'+newId+'" align="' + (Runner.isDirRTL() ? 'right' : 'left') + '"><img id="dpClose'+newId+'" src="' + Runner.pages.constants.CLOSE_RED_GIF 
								+ '" valign="middle" style="cursor:pointer;margin-right:10px;">'+
							'<a href="'+$("#"+this.shortTName+"_preview"+row.id).attr('href')+'" name="dp'+newId+'">'
								+ Runner.lang.constants.TEXT_PROCEED_TO + ' ' 
								+ Runner.pages.PageSettings.getTableData(this.tName, "strCaption", "")+'</a></div>'
						);
		
		$("#dpClose"+newId).bind("click", this.closeDetails.createDelegate(this, [row], true));
		row.isShown = true;
		row.startRequest = false;
		
		var baseParams = {
			id: newId,
			mode: Runner.pages.constants.MODE_LIST_DETAILS,
			rndVal: Math.random(),
			masterpagetype: this.pageType,
			mastertable: this.masterTName,
			mainmasterpagetype: this.mainMasterPageType
		};
		
		// create listPageObj
		var cfg = {
			tName: this.tName,
			pageId: newId,
			pageType: this.pageType,
			controlsMap: respObj.controlsMap[this.tName][this.pageType][newId], 
			viewControlsMap: respObj.viewControlsMap[this.tName][this.pageType][newId],
			pageMode: Runner.pages.constants.MODE_LIST_DETAILS,
			detCont: row.detCont,
			masterKeys: row.masterKeys,
			parId: this.parId,
			afterSaveDetails: {
				fn: function(allVals, fields, allKeys, allRowIds, isEdited){
					this.submitMade = true;
					this.submitSucceded = true;
					if(!isEdited)
						this.getChildRecNum(row.masterKeys);
					this.fireEvent("detailsSaved", this, allVals, fields, allKeys, allRowIds);
				},
				scope: this	
			},
			afterDeleteDetails: {
				fn: function(){
					this.getChildRecNum(row.masterKeys);
				},
				scope: this	
			},
			saveFailed: {
				fn: function(respObj, formObj, fieldControls){
					this.submitMade = true;
					this.submitSucceded = false;
					this.fireEvent("saveFailed", this, respObj, formObj);
				},
				scope: this	
			},
			afterInit: {
				fn: function(){
					this.fireEvent('afterInit', this, this.proxy, this.id);	
					this.fireEvent('afterShowDetails');
				},
				scope: this
			},
			baseParams: Runner.apply(baseParams, row.masterKeys)
		};
		
		if(respObj.additionalCSS){
			Runner.util.ScriptLoader.loadCSS(respObj.additionalCSS);
		}
		if(respObj.additionalJS){
			for(var jsFile in respObj.additionalJS){
				Runner.util.ScriptLoader.addJS.apply(Runner.util.ScriptLoader, [[jsFile], respObj.additionalJS[jsFile]]);
			}
			Runner.util.ScriptLoader.on('filesLoaded', function(){ row.detPage = Runner.pages.PageManager.initPage(cfg); }, dpObj, {single: true});
			Runner.util.ScriptLoader.load();
		}else{
			row.detPage = Runner.pages.PageManager.initPage(cfg);
		}
	},
	
	getChildRecNum: function(masterKeys, rowId){
		var mKeys = [], i = 0;
		for(var k in masterKeys){
			mKeys[i++] = masterKeys[k];
		}
		var reqParams = {
			mKeys: JSON.stringify(mKeys),
			dTable: this.tName,
			dSTable: this.shortTName,
			pageType: this.pageType,
			rndVal: Math.random(),
			mTable: this.masterTName,
			mSTable: this.masterShortTName
		}
		$.runnerAJAX("detreccount.php", reqParams, function(respObj, masterKeys){
			if (respObj.success){
				if(rowId != undefined){
					this.updateChildRecNumById(masterKeys, respObj.recsCount, rowId);
				}else{
					this.updateChildRecNum(masterKeys, respObj.recsCount);
				}
			}
		}.createDelegate(this, [masterKeys], 1));
	},
	
	updateChildRecNumById: function(masterKeys, detNum, rowId){
		for(var i=0;i<this.rows.length;i++){
			if(this.rows[i].id == rowId){
				this.setChildRecNum(this.rows[i], detNum);
				this.rows[i].masterKeys = masterKeys;
			}
		}
	},
	
	updateChildRecNum: function(masterKeys, detNum){
		var mKeysAsString = JSON.stringify(masterKeys);
		for(var i=0;i<this.rows.length;i++){
			if(mKeysAsString == JSON.stringify(this.rows[i].masterKeys)){
				this.setChildRecNum(this.rows[i], detNum);
			}
		}
	},
	
	setChildRecNum: function(row, detNum){
		var spanCont = $("#cntDet_"+this.shortTName+"_"+row.id);
		if (!spanCont.length){
			spanCont = row.row.find('#'+this.shortTName+'_preview'+row.id).find('span').attr('id', "#cntDet_"+this.shortTName+"_"+row.id);
			if(!spanCont.attr('id')){
				spanCont = row.row.find('#master_'+this.shortTName + "_" + row.id).find('span').attr('id', "#cntDet_"+this.shortTName+"_"+row.id);
			}
		}
		if(!parseInt(detNum)){
			if(this.hideChild){
				spanCont.parent().hide();
			}else{
				spanCont.parent().show();
			}
			spanCont.html("");
		}else{
			spanCont.html("("+parseInt(detNum)+")");
			if(spanCont.parent().css('display') == 'none'){
				spanCont.parent().show();
			}
		}
	},
	
	closeDetailsByInd: function(ind){
		var row = this.getRowByInd(ind);
		if (row){
			this.closeDetails(null, row);
		}
	},
	
	closeDetailsById: function(rowId){
		var row = this.getRowById(rowId);
		if (row){
			this.closeDetails(null, row);
		}
	},
	
	closeDetails: function(e, row){
		if(!row.isShown){
			return false;
		}
		row.detPage.destructor();
		row.detPage = null;
		if ((this.recsPerRowList > 1) && (!this.isTdReset(row))) {
			this.resetCell(row);
		}else{
			row.detTr.remove();
			row.detTr = null;
			
			row.detTd.remove();
			row.detTd = null;
		}
		
		row.detCont.remove();
		row.detCont = null;
		
		row.isShown = false;
		return true;
	},
	
	isTdReset: function(row){
		var removeTd = false;
		for (var i=0; i<row.detLinksId.length; i++){
			var dpTd = $("#"+this.masterShortTName+"_previewcell"+row.detLinksId[i]);
			if (row.detLinksId[i]!=row.id) {
				if (dpTd.html()==''){
					removeTd = true;
				}else{
					return false;
				}
			}
		}
		return removeTd;
	},
	
	resetCell:function(row){
		row.detTd.empty();
	},
	
	loadingCell:function(row){
		row.isShown = false;
		Runner.runLoading(row.detTd);
	},
	
	getRowByInd: function(ind){
		for(var i=0; i<this.rows.length;i++){
			if (this.rows[i].rowInd == ind){
				return this.rows[i];
			}
		}
		return false;
	},
	
	getRowById: function(id){
		for(var i=0; i < this.rows.length; i++){
			if (this.rows[i].id == id){
				return this.rows[i];
			}
		}
		return false;
	},
	
	saveRow: function(){
		this.initRow(row);
	},
	
	destructor: function(){
		for(var i=0; i<this.rows.length;i++){
			this.closeDetails(null, this.rows[i]);
		}
	}
})

/**
 * @class Runner.util.details.ListDP
 * provides base functionality for popup details on list page
 */
Runner.util.details.DPPopUp = Runner.extend(Runner.util.details.ListDP, {
	
	timeout: null,
	
	masterDetails: null,
	
	/**
	 * Previously handled link
	 */
	prevLink: null,
	
	constructor: function(cfg){
		Runner.util.details.DPPopUp.superclass.constructor.call(this, cfg);	
		this.dpType = Runner.pages.constants.DP_POPUP;
		this.masterDetails = {
			show: false,
			flag: "",
			counter: 0
		};
	},	
	
	init: function(){
		Runner.util.details.DPPopUp.superclass.init.call(this);
	},
	
	/**
	 * showPopup
	 * Show detail preview in popup
	 * @param {object} details link
	 * @param {string} request url
	 */
	showPopup : function(obj, url, mastertable, masterKeys){
		var urlsDiff = false
			,pageObj =this;
			
		if (url && url !== $(".runner-details-popup").data("url")) {
			urlsDiff = true;
			$(".runner-details-popup").data("url", url);
		}
		//clearTimeout(this.timeout);
		clearTimeout($(".runner-details-popup").data("timeout"));

		if($('.runner-details-popup').css("display") == 'none' || (url != undefined && this.prevLink != obj) || urlsDiff){
			this.timeout = setTimeout(function(){
				pageObj.prevLink = obj;
				pageObj.masterDetails.flag = url;
				pageObj.masterDetails.show = true;
				pageObj.masterDetails.counter++;
				$.runnerAJAX(url, {
					counter: pageObj.masterDetails.counter,
					mastertable: mastertable,
					masterKeys: JSON.stringify(masterKeys),
					rndVal: (new Date().getTime())
				}, 
				function(respObj){
					if(!respObj.success){
						return;
					}	
					if(!pageObj.masterDetails.show){
						return;
					}
					if(!$(".runner-details-popup").length){
						$('body').append('<div class="runner-details-popup" style="display:none; position: absolute; left: 0px; top: 0px;"> </div>');
					}
					
					var detailsPopup = $(".runner-details-popup");
					detailsPopup.unbind("mouseover").unbind("mouseout")
						.bind({
							mouseover: function(){
								pageObj.showPopup();
							},
							mouseout: function(){
								pageObj.hidePopup();
							}
						});					
					
					if(pageObj.masterDetails.counter == respObj.counter){
						detailsPopup.html(respObj.body);
						if(typeof respObj.style != "undefined"){
							detailsPopup.addClass("page-detailspreview runner-pagewrapper " + respObj.layout);
							Runner.util.ScriptLoader.loadCSS([respObj.style, respObj.pageStyle], true);
						}
					}
					if(Runner.isDirRTL()){
						if(Runner.isIE){
							var linkOffset = $(obj).offset();
							setTimeout(function(){
								Runner.setLeftTopRTL(obj, detailsPopup.get(0), null, false, pageObj);
							}, 10);
							detailsPopup.show();
						}
						else{
							Runner.setLeftTopRTL(obj, detailsPopup.get(0), null, false, pageObj);
							detailsPopup.show();
						}
					}
					else{
						Runner.setLeftTop(obj, detailsPopup.get(0), null, false, pageObj);
						detailsPopup.show();
					}
				});
			}, 100);
			$(".runner-details-popup").data("timeout", this.timeout);
		}
	},
	
	/**
	 * hidePopup
	 * Hide popup with details preview 
	 */
	hidePopup : function(){
		this.masterDetails.show = false;
		if($('.runner-details-popup').css("display") == 'none' || !$('.runner-details-popup').length){
			//clearTimeout(this.timeout);
			clearTimeout($(".runner-details-popup").data("timeout"));
		}else{
			this.timeout = setTimeout(function(){
				$(".runner-details-popup").hide();
				$(".runner-details-popup").html("");
			},200);
			$(".runner-details-popup").data("timeout", this.timeout);
		}
	}
});


Runner.util.details.recDP = Runner.extend(Runner.util.details.DP, {
	
	listPageObj: null,
	
	submitMade: false,
	
	submitSucceded: true,
	
	useChildCount: false,
	
	init: function(id){
		Runner.util.details.recDP.superclass.init.call(this);
		this.initButton(id);
		this.initDpPage(id);
		
		this.addEvents('detailsSaved');
		
		if(this.detailsSaved){
			this.on({'detailsSaved': this.detailsSaved});
		}
		if(this.saveFailed){
			this.on({'saveFailed': this.saveFailed});
		}
	},
	
	initDpPage: function(id, cfg){
		if (typeof id == "undefined"){
			id = this.id;
		}
		cfg = cfg || {};
		Runner.apply(cfg, {
			tName: this.tName, 
			pageType: Runner.pages.constants.PAGE_LIST, 
			pageId: id, 
			controlsMap: this.controlsMap,
			viewControlsMap: this.viewControlsMap,
			masterTName: this.masterTName,
			detCont: $("#detailPreview"+this.id),
			useChildCount: this.useChildCount,
			childRecNum: 0,
			parId: this.parId,
			pageMode: Runner.pages.constants.MODE_LIST_DETAILS,
			baseParams:{
				id: id,
				mode: Runner.pages.constants.MODE_LIST_DETAILS,
				rndVal: Math.random(),
				masterpagetype: this.pageType
			},
			afterSaveDetails: {
				fn: function(allVals, fields, allKeys, allRowIds){
					this.submitMade = true;
					this.submitSucceded = true;
					this.fireEvent("detailsSaved", this, allVals, fields, allKeys, allRowIds);
				},
				scope: this	
			},
			saveFailed: {
				fn: function(respObj, formObj, fieldControls){
					this.submitMade = true;
					this.submitSucceded = false;
					this.fireEvent("saveFailed", this, respObj, formObj);
				},
				scope: this	
			}
		});
		this.listPageObj = Runner.pages.PageManager.initPage(cfg);
		return this.listPageObj;
	},
	
	initButton: function(id){
		if (typeof id == "undefined"){
			id = this.id;
		}
		if (Runner.isIE) { 
			$("#dpMinus" + id).attr('src', Runner.pages.constants.MINUS_GIF);
			$("#dpShowHide" + id).parent().css({"vertical-align": "top"}); //IE7 fix
		}
		$("#dpMinus"+this.id).bind("click", function(e){
			if ( $("#dpMinus"+this.id).is(":visible") ) { 
				$(".projekktor", "#detailPreview"+id).each(function(){
						projekktor(this.id).setStop();
				});
			}
			setTimeout(function(){
				$("#detailPreview"+id).toggle();
				var src = $("#dpMinus"+id).attr('src');
				if (src == Runner.pages.constants.MINUS_GIF){
					$("#dpMinus"+id).attr('src', Runner.pages.constants.PLUS_GIF);
				}else{
					$("#dpMinus"+id).attr('src', Runner.pages.constants.MINUS_GIF);
				}
			}, 100);
		});
	},
	
	saveDetails: function(){
		this.submitSucceded = false;
		this.submitMade = false;
		return this.listPageObj.saveAll();
	},
	
	validate: function(){
		var addValidRes = true,
			editValidRes = true;
			
		if (this.listPageObj.inlineEdit){
			editValidRes = this.listPageObj.inlineEdit.validate();
		}
		if (this.listPageObj.inlineAdd){
			addValidRes = this.listPageObj.inlineAdd.validate();
		}
		return editValidRes && addValidRes;
	},
	
	destructor: function(){
		if(this.listPageObj){
			this.listPageObj.destructor();
		}
	}
});


/**
  * @class Runner.util.details.AddDP
  * provides base functionality for details on add page
  */
Runner.util.details.AddDP = Runner.extend(Runner.util.details.recDP, {

	constructor: function(cfg){
		this.pageType = Runner.pages.constants.PAGE_ADD;
		Runner.util.details.AddDP.superclass.constructor.call(this, cfg);	
	},
	
	initDpPage: function(id){
		id = id || this.id;
		var cfg = {
			hideSaveButt: true,
			afterInit: {
				fn: function(pageObj, proxy, pageId){
					if(pageObj.inlineAdd){
						pageObj.inlineAdd.inlineAdd(true, true);
						
						pageObj.inlineAdd.on("createControls", function(row, ctrlsArr){
							if (this.inlineAddChangeContent){
								return true;
							}
							this.inlineAddChangeContent = false;
							var cntrlType, 
								eventName = 'change',
								delay = 0;
								
							for(var i=0;i<ctrlsArr.length;i++){
								cntrlType = ctrlsArr[i].getControlType(); 
								eventName = 'change'; 
								
								if(cntrlType=='checkbox' || cntrlType=='radio'){
									eventName = 'click';
								}else if(cntrlType=='text' || cntrlType=='password' || cntrlType=='textarea'){
									eventName = 'keyup';
								}else if(cntrlType=='RTE'){
									eventName = 'blur';
								}
								ctrlsArr[i].on(eventName, function(e, row){
									this.inlineAddChangeContent = true;
									this.getEditBlock(row, false, true);
								}, {single: true, args: [row]}, this);
							}
						}, pageObj.inlineAdd);
					}
				},
				scope: this
			}
		};
		Runner.util.details.AddDP.superclass.initDpPage.call(this, id, cfg);
		this.listPageObj.on('beforeSave', function(row, inlineObj, formObj){
			if (inlineObj.inlineAddChangeContent !== true){
				inlineObj.cancelAll();
				return false;
			}
		}, this);
		return this.listPageObj;
	},
	
	init: function(){
		Runner.util.details.AddDP.superclass.init.call(this);
	},
	
	saveDetails: function(mKeys){
		this.submitSucceded = false;
		this.submitMade = false;
		this.listPageObj.saveAll(mKeys);
	}	
});

/**
  * @class Runner.util.details.EditDP
  * provides base functionality for details on edit page
  */
Runner.util.details.EditDP = Runner.extend(Runner.util.details.recDP, {

	constructor: function(cfg){
		this.pageType = Runner.pages.constants.PAGE_EDIT;
		Runner.util.details.EditDP.superclass.constructor.call(this, cfg);
	},
	
	init: function(){
		Runner.util.details.EditDP.superclass.init.call(this);
	}
});

/**
  * @class Runner.util.details.ViewDP
  * provides base functionality for details on view page
  */
Runner.util.details.ViewDP = Runner.extend(Runner.util.details.recDP, {

	constructor: function(cfg){
		this.pageType = Runner.pages.constants.PAGE_VIEW;
		Runner.util.details.ViewDP.superclass.constructor.call(this, cfg);	
	}
});
	

// create namespace
Runner.namespace('Runner.resize');

Runner.resize.Grid = Runner.extend(Runner.emptyFn,{
	/**
	 * Id of page
	 * @type {integer}
	 */
	pageId: -1,
	/**
	 * Grid settings
	 * Add to new resizeable grid
	 * @type {object}
	 */
	gridSettings: null,
	
	columnObjs: null,
	
	columnNames: null,
	
	firstTime: false,
	
	isShowRows: false,
	
	isUseInlineAdd: false,
	
	isShowAddInPopup: false,
	
	constructor: function(cfg){
		Runner.apply(this, cfg);
		
		this.gridSettings = {};
		this.pageObj = Runner.pages.PageManager.getAt(this.tName, this.pageId);  
		this.firstTime = Runner.pages.PageSettings.getTableData(this.tName, "pageMode")!=Runner.pages.constants.LIST_AJAX;
		this.isShowRows = Runner.pages.PageSettings.getTableData(this.tName, "showRows");	
		this.isUseInlineAdd = Runner.pages.PageSettings.getTableData(this.tName, "isInlineAdd");
		this.isShowAddInPopup = Runner.pages.PageSettings.getTableData(this.tName, "showAddInPopup");
	},
	
	/**
	 * Init method
	 * Make grid resizeable 
	 */
	init: function(){
		
		if(!this.isUseInlineAdd && !this.isShowRows){
			return false;
		}
		
		if(!$(document.body).hasClass('yui3-skin-sam')){
			$(document.body).addClass('yui3-skin-sam');
		}
		
		this.gridSettings.classes = {table: this.pageObj.gridElem[0].className};
		this.gridSettings.styles = {table: this.pageObj.gridElem.attr('style') || ''};
		
		this.parseGridHeader();
		this.parseGridBodyFoot();
	},
	
	/**
	 * Has cell colspan or rowspan
	 * @return {boolean}
	 */
	hasColRowSpans: function(cell){
		if(cell.colspan || cell.rowspan){
			return true;
		}
		return false;
	},
	
	/**
	 * Is cell or row belong to grid
	 * Return false if belong, true if not
	 * @return {boolean}
	 */
	isNotMatch: function(){
		return !$(this).closest('table').hasClass('runner-c-grid');
	},
	
	/**
	 * Parse grid header
	 * Save old grid settings
	 * Prepare for resize
	 */
	parseGridHeader: function(){
		var Y = this.pageObj.Y,
			self = this,
			initCookies = new Array(),
			// get grid cookie string
			gridCookies = Y.Cookie.get(self.pageObj.shortTName); 
		
		this.columnObjs = [];
		this.gridSettings.ieconts = {ths: []};
		this.gridSettings.classes.thead = {trs: [], ths: []};
		this.gridSettings.styles.thead = {trs: [], ths: []};
		
		$('thead tr.runner-toprow',this.pageObj.gridElem).each(function(i){
			var columnId = 0;
			self.gridSettings.classes.thead.trs[i] = this.className;
			self.gridSettings.styles.thead.trs[i] = $(this).attr('style') || '';
			$("th",this).not(self.isNotMatch).each(function(){
				if(self.hasColRowSpans(this)){
					return;
				}
				
				self.columnObjs[columnId] = {
					key: "column"+columnId,
					label: $(this).html() || '&nbsp;',
					allowHTML: true,
					sortable: false
				};
				
				if(!gridCookies){
					initCookies[initCookies.length] = this.offsetWidth;
				}
				// resize not work with given width in columnObjs
				/*else{
					// parse string to array and set width for cell
					self.columnObjs[columnId].width = Y.JSON.parse(gridCookies)[columnId];
				}*/
				
				self.gridSettings.ieconts.ths[columnId] = $(this).attr('ieditcont')!=undefined || "";
				self.gridSettings.classes.thead.ths[columnId] = this.className;
				self.gridSettings.styles.thead.ths[columnId] = $(this).attr('style') || '';
				columnId++;
			});
		});	
		
		if (!gridCookies){
			Y.Cookie.set(this.pageObj.shortTName, Y.JSON.stringify(initCookies));
		}
	},
	
	/**
	 * Parse grid body and footer
	 * Save old grid settings
	 * Prepare for resize
	 */
	parseGridBodyFoot: function(){
		var self = this,
			areaCodes = [],
			numColumns = 0;
		
		this.gridSettings.rowids = [];
		this.gridSettings.ieconts.tds = [];
		this.gridSettings.classes.tbody = {trs: [], tds: []};
		this.gridSettings.styles.tbody = {trs: []};
		
		$("tbody tr.runner-row, tbody tr.runner-bottomrow", this.pageObj.gridElem).each(function(i){
			self.gridSettings.classes.tbody.trs[i] = this.className;
			self.gridSettings.styles.tbody.trs[i] = {tr: $(this).attr('style') || '', tds: []};
			self.gridSettings.rowids[i] = this.id;
			
			var areaCode = {},
				columnId = 0,
				parseColumn = false;
				
			if(self.isShowRows && (self.isUseInlineAdd && i==1 || !self.isUseInlineAdd && !i) || !self.isShowRows && self.isUseInlineAdd && !i){
				parseColumn = true;
			}
			$('td',this).not(self.isNotMatch).each(function(j){
				if(self.hasColRowSpans(this)){
					return;
				}
				if ( $(this).hasClass("runner-cl") || $(this).hasClass("runner-cr") || $(this).parent().hasClass("runner-bottomrow") ) {
					areaCode[self.columnObjs[columnId].key] = $(this).html();
				} else {
					areaCode[self.columnObjs[columnId].key] = "<div class='runner-resize-cellwrapper'>" + $(this).html() + "</div>";
				}
				self.gridSettings.styles.tbody.trs[i].tds[columnId] = $(this).attr('style') || '';
				if(parseColumn){
					self.gridSettings.classes.tbody.tds[columnId] = this.className;
					self.gridSettings.ieconts.tds[columnId] = $(this).attr('ieditcont') || '';
				}
				columnId++;
				numColumns++;
			});
			areaCodes[areaCodes.length] = areaCode;
		});
		
		this.createResizeGrid(areaCodes);
	},
	
	/**
	 * Create new resizeable grid
	 */
	createResizeGrid: function(Data){
		var Y = this.pageObj.Y,
			self = this,
			gridPar = self.pageObj.gridElem.parent();
		
		var table = new Y.DataTable.Base({
			columns: self.columnObjs,
			data: Data
		});
		// remove old table
		gridPar.empty();
		// render table
		table.render(gridPar[0]);
		// set old grid settings
		var newGridElem = self.setOldGridSettings();
		newGridElem.css({"overflow": "hidden", "table-layout": "fixed"});
		
		$('th', gridPar).not('.runner-cl, .runner-cr').not(this.isNotMatch).each(function(){	
			$(this).html("<div class='runner-resize-cellwrapper' style='width: "+ $(this).width() +"px; white-space: nowrap;'>" + $(this).html() + "</div>"); 
	
			var handle = Runner.isDirRTL()? 'l' : 'r'; //fix me
			var resize = new Y.Resize({
				node: this,
				handles: handle,
				defMinWidth: 0
			});

			if (Y.UA.ie) {
				resize.delegate.dd._move = function(ev) {
					ev.pageX = window.event.screenX; 	// pageX with screenX replacing
					return Y.DD.Drag.prototype._move.call(resize.delegate.dd, ev);
				}
				resize.delegate.dd.on('drag:mouseDown', function(e){		
						e.ev.pageX = window.event.screenX; //pageX with screenX replacing
					}				
				);
			}
			
			var resizeEventType = 'resize:resize';			
			if (Y.UA.gecko) { //ff
				resizeEventType = 'resize:align';
			}

			resize.on(resizeEventType, function(event){
				this._defResizeAlignFn(event); //to prevent YUI _syncUI invocation
				event.preventDefault(); 
				
				var gridCookies = Y.JSON.parse(Y.Cookie.get(self.pageObj.shortTName)),
					oldCellWidth = this.get("node").getDOMNode().offsetWidth, 
					newCellWidth = this.info.offsetWidth;
					cellIndex =	this.get("node").getDOMNode().cellIndex,
					gridWidth = self.pageObj.gridElem[0].offsetWidth;			
			
				$(self.pageObj.gridElem).css('width', gridWidth + (newCellWidth - oldCellWidth) + 'px');
				$(".yui3-datatable-col-" + $(this.get("node").getDOMNode()).attr("data-yui3-col-id"), gridPar).css("width", this.info.offsetWidth + "px");		
				$(".yui3-datatable-col-" + $(this.get("node").getDOMNode()).attr("data-yui3-col-id") + ' div.runner-resize-cellwrapper', gridPar).css("width", this.info.offsetWidth + "px");					
				
				gridCookies[cellIndex] = newCellWidth;
				Y.Cookie.set(self.pageObj.shortTName, Y.JSON.stringify(gridCookies));										
			});
			
			if ( Runner.isDirRTL() ) {
				resize.on("drag:start", function() { //change the Shim position
					Y.DD.DDM._pg.setStyles({
						left: 'auto',
						right: '0'
					});
				});
			}
			
			resize.on("resize:end", function(event) {	
				event.preventDefault(); //to prevent YUI _syncUI invocation
			});						
					
			if (Y.UA.gecko || Y.UA.ie) { // fix ie && firefox
				var node = $('<div style="position:relative"></div>');
				$(this).children().appendTo(node);
				node.appendTo(this);
			} else {
				$(this).css("position","relative");
			}						
		});
		
		if ( Runner.isDirRTL() ) {  //change the Shim position
			Y.DD.DDM._pg.setStyles({
				 left: 'auto',
				 right: '0'
			});
		}
		
		newGridElem.css('width', this.totalGridWidth + 'px');
		this.pageObj.initViewControls();
	},
	
	/**
	 * Set correct position for resizer element in table header
	 * Must be correct for yui3
	
	setResizerEl: function(){
		var dir = $('html').attr('dir') || '',
			thClosest = $('.yui-dt-resizer').closest('th')[1],
			thPLeft = $(thClosest).css('padding-left');
		
		if(dir.toLowerCase() == 'rtl'){
			$('.yui-dt-resizer').css('left', '-' + thPLeft);
		}else{
			$('.yui-dt-resizer').css('right', '-' + thPLeft);
		}
		
		$('.yui-dt-resizer').css({
			'bottom': '-' + $(thClosest).css('padding-bottom'),
			'height': thClosest.offsetHeight 
		});	
	}, */
	
	/**
	 * Set to new resizable grid old saved grid settings
	 */
	setOldGridSettings: function(){
		var self = this;
		
		// get new resizeable grid element
		var newGridElem = $('.runner-s-grid table.yui3-datatable-table', this.pageObj.pageCont);
		
		if(!this.isShowRows){
			$(newGridElem).hide();
		}
		// add class for table style
		newGridElem.parent().addClass("runner-s-grid").addClass("not-container");
		newGridElem.parent().parent().addClass("runner-c-grid"); //to apply the old table's margin-bottom rule
		
		// add class for table
		newGridElem.addClass(this.gridSettings.classes.table);
				
		// add style for table
		if(this.gridSettings.styles.table){
			newGridElem.attr('style',this.gridSettings.styles.table);
		}
		
		// get cookie for grid header cells
		var gridCookies = this.pageObj.Y.JSON.parse(this.pageObj.Y.Cookie.get(this.pageObj.shortTName));

		this.totalGridWidth = 0;		
		// add classes, styles and ieditcont atribute to thead row and cells
		$('thead tr', newGridElem).not(this.isNotMatch).each(function(i){
			$(this).addClass(self.gridSettings.classes.thead.trs[i]); 
			
			if(self.gridSettings.styles.thead.trs[i]){
				$(this).attr('style', self.gridSettings.styles.thead.trs[i]);
			}
			$('th', this).not(self.isNotMatch).each(function(j){
				$(this).addClass(self.gridSettings.classes.thead.ths[j]); 
				
				if(self.gridSettings.styles.thead.ths[j]){
					$(this).attr('style', self.gridSettings.styles.thead.ths[j]);
				}
				//set cell width
				if ( !$(this).hasClass("runner-cl") && !$(this).hasClass("runner-cr") && gridCookies[j] !== 0) {
					$(this).css('width', gridCookies[j] + 'px');
				} else {
					$(this).css('width', $(this).width() + 'px');
				}
				self.totalGridWidth += $(this).width();
				
				if(self.gridSettings.ieconts[j]){
					$(this).attr('ieditcont') = self.gridSettings.ieconts.ths[j];
				}
			});
		});
		
		//this.setResizerEl();
		
		// add classes, styles, ids and ieditcont atribute to tbody row and cells
		$('tbody.yui3-datatable-data tr', newGridElem).not(this.isNotMatch).each(function(i){
			$(this).addClass(self.gridSettings.classes.tbody.trs[i]);
			
			var isRowTFoot = false;
			if($(this).hasClass('footer')){
				isRowTFoot = true;
			}
			
			this.id = self.gridSettings.rowids[i];
			
			if(!isRowTFoot && self.gridSettings.styles.tbody.trs[i].tr){
				$(this).attr('style', self.gridSettings.styles.tbody.trs[i].tr);
			}
			$('td', this).not(self.isNotMatch).each(function(j){
				$(this).addClass(self.gridSettings.classes.tbody.tds[j]); 
				if(!isRowTFoot){
					if(self.gridSettings.styles.tbody.trs[i].tds[j]){
						$(this).attr('style', self.gridSettings.styles.tbody.trs[i].tds[j]);
					}
					if(self.gridSettings.ieconts[j]){
						$(this).attr('ieditcont') = self.gridSettings.ieconts.tds[j];
					}
				}
			});
		});
			
		return newGridElem;
	}
});


