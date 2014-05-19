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

