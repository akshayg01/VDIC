/**
 * Load Yahoo Media Player script after loaded ymp.js file
 */
function include_runnerJS_ymp_init(idx) {
	Runner.YmpLoader.loadScript();
}

/**
 * @class Runner.YmpLoader
 * Load base functionality for Yahoo Media Player
 * Here we define the Yahoo! 
 * Maps API module in YUI Yloader:
 */
Runner.YmpLoader = Runner.extend(Runner.emptyFn,{

	stack: null,
	
	stackContext: null,
	
	isLoaded: false,
	
	constructor: function(){
		this.stack = [];
		this.stackContext = [];
	},
	
	loadScript: function(){
		var self = this,
			js = document.createElement('script');
		
		js.setAttribute('type', 'text/javascript');
		
		var loaded_ = function(){
			if(YAHOO.mediaplayer && YAHOO.mediaplayer.loadPlayerScript){
				YAHOO.mediaplayer.loadPlayerScript();
			}
			if (YAHOO && YAHOO.mediaplayer && YAHOO.mediaplayer.elPlayerSource){
				if(Runner.isIE){
					YAHOO.mediaplayer.elPlayerSource.onreadystatechange = function(){
						if (YAHOO.mediaplayer.elPlayerSource.readyState == 'complete' || YAHOO.mediaplayer.elPlayerSource.readyState == 'loaded'){
							self.loaded();
						}
					};
				}else{
					YAHOO.mediaplayer.elPlayerSource.onload = self.loaded;
				}
			}
		}
		
		if(Runner.isIE){
			js.onreadystatechange = function(){
				if (js.readyState == 'complete' || js.readyState == 'loaded'){
					loaded_();
				}
			};
		}else{
			js.onload = loaded_;
		}
		
		js.setAttribute('src', "http://webplayer.yahooapis.com/player.js");
		document.getElementsByTagName('HEAD')[0].appendChild(js);
	},
	
	onLoad: function(f, context){
		if (this.isLoaded){
			this.stack.push(f);
			this.stackContext.push(context);
			this.fireLoad();
		}
	},
	
	fireLoad: function(){
		for(var i =0; i < this.stack.length; i++){
			this.stack[i].apply(this.stackContext[i] ? this.stackContext[i] : this);
		}
		this.stack = [];
		this.stackContext = [];
	},
	/**
	 * Called after YMP was loaded
	 * Scope is YMP object! Not Runner.YmpLoader!
	 */
	loaded: function(){
		Runner.YmpLoader.isLoaded = true;
		YAHOO.mediaplayer.Parser.prototype.checkForLocalHost = function(url){
			return false; 
		};
	}
});
Runner.YmpLoader = new Runner.YmpLoader();