/*
+-------------------------------------------------------------------------------+
| Copyright (c) 2006-2007 Andrew G. Samoilov, Universal Data Solutions inc.	|
| All rights reserved.                                                  	|
|                                                                       	|
| Redistribution and use in source and binary forms, with or without    	|
| modification, are permitted provided that the following conditions    	|
| are met:                                                              	|
|                                                                       	|
| o Redistributions of source code must retain the above copyright      	|
|   notice, this list of conditions and the following disclaimer.       	|
| o Redistributions in binary form must reproduce the above copyright   	|
|   notice, this list of conditions and the following disclaimer in the 	|
|   documentation and/or other materials provided with the distribution.	|
|                                                                       	|
| THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   	|
| "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     	|
| LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR 	|
| A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  	|
| OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, 	|
| SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      	|
| LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 	|
| DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY 	|
| THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   	|
| (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE 	|
| OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  	|
+-------------------------------------------------------------------------------+
*/

var cur = -1;
//var selectsToHide = new Array();
var suggestValues = new Array();
var lookupValues = new Array();

var isLookupError = false;
//var isSetFocus = false;
//var isMouseOnDiv = false;

setTimeout( function() {
$("body,input, a").click(function(){ 
	DestroySuggestDiv();
});
} , 2000);

function IsInArray(array, value, caseSensitive){
	var i;
	for (i=0; i < array.length; i++){
		if (caseSensitive){
			if (array[i] == value){
				return true; 
			}
		}else{
			if (array[i].toLowerCase() == value.toLowerCase()){
				return true;
			}
		}
	}
	return false;
};

function DestroySuggestDiv(){
	cur = -1;
	//isMouseOnDiv = false;
	$("#search_suggest").html("");
	$("#search_suggest").css({ 
		visibility: "hidden"
	});
	$("#search_suggest_iframe").remove();
}

function PtInBox(oElement){
	var el = $("#search_suggest")[0],
		oElPos = Runner.getPosition(oElement);
	
	if (oElPos.left>= el.offsetLeft && 
		oElPos.left<=(el.offsetLeft + el.offsetWidth) && 
		oElPos.top>=el.offsetTop && 
		oElPos.top<=(el.offsetTop + el.offsetHeight)){ 
			return true; 
	}
	if ((oElPos.left + oElPos.width)>=el.offsetLeft && 
		(oElPos.left + oElPos.width)<=(el.offsetLeft + el.offsetWidth) && 
		oElPos.top>=el.offsetTop && oElPos.top<=(el.offsetTop + el.offsetHeight)){
			return true;
	}
	if (oElPos.left>=el.offsetLeft && 
		oElPos.left<=(el.offsetLeft + el.offsetWidth) && 
		(oElPos.top + oElPos.height)>=el.offsetTop && 
		(oElPos.top + oElPos.height)<=(el.offsetTop + el.offsetHeight)){
			return true;
	}
	if ((oElPos.left + oElPos.width)>=el.offsetLeft && 
		(oElPos.left + oElPos.width)<=(el.offsetLeft + el.offsetWidth) && 
		(oElPos.top + oElPos.height)>=el.offsetTop && 
		(oElPos.top + oElPos.height)<=(el.offsetTop + el.offsetHeight)){
			return true;
	}
	if ((oElPos.left<=el.offsetLeft && 
		(oElPos.left + oElPos.width)>=(el.offsetLeft + el.offsetWidth)) && 
		((el.offsetTop + el.offsetHeight)>=oElPos.top && 
		el.offsetTop<=(oElPos.top + oElPos.height))){
			return true;
	}
	return false;
}

function setLyr(obj,lyr){
	var objPos = Runner.getPosition(obj);
	if (lyr == 'search_suggest'){
		objPos.top += objPos.height;
		lyr = $("#"+lyr);
	}	
	lyr.css({
		"top": objPos.top + "px",
		"left": objPos.left + "px"
	});
}	

function moveUp(oElement, searchType){
	if($("#search_suggest").children().length>0 && cur>=-1){
		cur--;
		if (cur==-2){
			cur = $("#search_suggest").children().length-1; oElement.focus(); 
		}
		for(var i=0;i<$("#search_suggest").children().length;i++){
			if(i == cur){
				$("#search_suggest").children().get(i).className = "suggest_link_over";
//				oElement.value = suggestValues[cur].replace(/\<(\/b|b)\>/gi,"");
				oElement.value = suggestValues[cur];
			}else{
				$("#search_suggest").children().get(i).className = "suggest_link";
			}
		}
	}
}
		
function moveDown(oElement, searchType) 
{
	if($("#search_suggest").children().length>0 && cur<($("#search_suggest").children().length)){
		cur++;
		for(var i=0;i<$("#search_suggest").children().length;i++){
			if(i == cur){
				$("#search_suggest").children().get(i).className = "suggest_link_over";
//				oElement.value = suggestValues[cur].replace(/\<(\/b|b)\>/gi,"");
				oElement.value = suggestValues[cur];
			}else{
				$("#search_suggest").children().get(i).className = "suggest_link";
			}
		}
		if(cur == ($("#search_suggest").children().length)){
			cur=-1; 
			oElement.focus(); 
		}
	}
}

function suggestOver(div_value){
	$("div.suggest_link_over").each(function(){
		this.className = 'suggest_link';
	}) ;
	div_value.className = 'suggest_link_over';
	cur = div_value.id.substring(10);
}

function suggestOut(div_value){
	div_value.className = 'suggest_link';
}

function setSearch(inputName, value){
	if(setSearch.arguments[2] == 'lookup'){
		isLookupError = false;
		var helement=$("#"+inputName.substring(8)+setSearch.arguments[4])[0];
		$("#"+inputName+setSearch.arguments[4]).removeClass("highlight");
		$("#"+inputName+setSearch.arguments[4]).val(value);
		if($(helement).val() != setSearch.arguments[3]){
			$(helement).val(setSearch.arguments[3]);
			$(helement).change();
		}
	}else{
		$("input[name="+inputName+"]").val(value);
	}	
	DestroySuggestDiv();
}

/////////////////////////////////////////////////////////////////////////////////////////////
function searchSuggest(oEvent,oElement,searchType,SUGGEST_TABLE, id){
	if(typeof id == 'undefined'){
		id =1;
	}
	oEvent = window.event || oEvent;
    var iKeyCode = oEvent.keyCode, sType="";
	switch(searchType){
		case "ordinary":
			var fieldForSearch = $("select#ctlSearchField");
		    if (!fieldForSearch.length){
		    	fieldForSearch = $("#simpleSrchFieldsCombo"+id);
		    }
		    if (fieldForSearch.length){
		    	fieldForSearch = fieldForSearch.val();
		    }else{
		    	fieldForSearch = '';
		    }
			var sType = $("#ctlSearchOption");
		    if (!sType.length){
		    	sType = $("#simpleSrchFieldsCombo"+id);
		    }
		    if (sType.length){
				sType = sType.val();
		    }
			break;
		case "advanced":
			var fieldForSearch = oElement.name.substring(6);
			if($("[name=asearchopt_"+fieldForSearch+"]").length)
				sType=$("[name=asearchopt_"+fieldForSearch+"]").val();
			break;
		case "advanced1":
			var fieldForSearch = oElement.name.substring(7);
			if($("[name=asearchopt_"+fieldForSearch+"]").length)
				sType=$("[name=asearchopt_"+fieldForSearch+"]").val();
			break;
	}
	cur = -1;
	
	$.runnerAJAX(SUGGEST_TABLE, {
			searchFor:  oElement.value , 
			searchField: (fieldForSearch ? fieldForSearch : ''),
			rndVal: (new Date().getTime()),
			start: (sType=="Starts with ..."?1:0),
			searchType: searchType
		}, 
		function(respObj){
			if (!respObj.success){
				DestroySuggestDiv();	
			}else{
				if (respObj.result.length) {
					$("#search_suggest").css({ visibility: "visible"});
				} else {
					DestroySuggestDiv();
				}
				
				$("#search_suggest").html("");
				Runner.setZindexMaxToElem($("#search_suggest"));

				for(var i=0,j=0; i < respObj.result.length; i++,j++) {
					var suggest = '<div id="suggestDiv'+i+'" style="cursor:pointer;" onmouseover="suggestOver(this);" ';
					suggest += 'onmouseout="suggestOut(this);" ';
//					suggest += 'onclick="setSearch(\'' + oElement.name + '\',suggestValues[' + j + '].replace(/\\<(\\/b|b)\\>/gi,\'\'));" ';
					suggest += 'onclick="setSearch(\'' + oElement.name + '\',suggestValues[' + j + ']);" ';
					suggest += 'class="suggest_link">' + respObj.result[i].value + '</div>';
					$(suggest).appendTo("#search_suggest");
					suggestValues[j] = respObj.result[i].realValue;
				}
			}
		});
	setLyr(oElement,"search_suggest");
}

function searchSuggest_new(oEvent, ctrl, srchTypeCombo, searchType, suggestUrl){
	
	oEvent=window.event || oEvent;
    var iKeyCode=oEvent.keyCode, fieldForSearch = ctrl.fieldName, ctrlTable = ctrl.table, 
    	ctrlField = ctrl.fieldName, ctrlId = ctrl.id, ctrlInd = ctrl.ctrlInd;
        
	var sType = (srchTypeCombo.length ? srchTypeCombo.val() : '' );

	cur = -1;
	
	$.runnerAJAX(suggestUrl,{
		searchFor: ctrl.getValue(), 
		searchField: fieldForSearch,
		rndVal: (new Date().getTime()),
		start: (sType == "Starts with ..."? 1 : 0),
		searchType: searchType
	},
	function(respObj){
		if (!respObj.success){
			DestroySuggestDiv();	
		}else{
			if (respObj.result.length) {
				$("#search_suggest").css({ visibility: "visible"});
			}else{
				DestroySuggestDiv();
				return;
			}
			
			$("#search_suggest").html("");
			Runner.setZindexMaxToElem($("#search_suggest"));	
			
			for(var i=0,j=0; i < respObj.result.length; i++,j++) {
				var div = document.createElement('DIV');
				suggestValues[j] = respObj.result[i].realValue;
				$(div).attr('id', 'suggestDiv'+i).css('cursor', 'pointer').addClass('suggest_link').html(respObj.result[i].value/*.quote().entityify()*/);
				$(div).bind('mouseover', function(e){
					suggestOver(this);
				});
				$(div).bind('mouseout', function(e){
					suggestOut(this);
				});
				div.valueIndex = j;
				$(div).bind('click', function(e){
//					ctrl.setValue(suggestValues[this.valueIndex].replace(/<(\/b|b)>/gi,''));
					ctrl.setValue(suggestValues[this.valueIndex]);
					DestroySuggestDiv();
				});				
				$(div).appendTo("#search_suggest");
			}
		}
	});
	setLyr(ctrl.getDispElem().get(0), "search_suggest");
}
