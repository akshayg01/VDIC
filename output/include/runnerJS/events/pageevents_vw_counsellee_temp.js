

	var pType = Runner.pages.constants.PAGE_ADD;


Runner.pages.PageSettings.addPageEvent("vw_counsellee_temp", pType, "afterPageReady", function(pageObj, proxy, pageid, inlineRow, inlineObject){
	

// Place event code here.
// Use "Add Action" button to add code snippets.

//alert('I\'m a popup window');

var MaritalStatusId = Runner.getControl(pageid, 'MaritalStatusId');
var DateofMarriage = Runner.getControl(pageid, 'DateofMarriage');
var SpouseDevoteeId  = Runner.getControl(pageid, 'SpouseDevoteeId');


/*
var SpouseDevoteeIdRow = Runner.getControl(pageid,'SpouseDevoteeIdRow');
var DateofMarriageRow = Runner.getControl(pageid,'DateofMarriageRow');

var SpouseDevoteeIdRowCtrl = Runner.getControl(pageid,'SpouseDevoteeIdRowCtrl');
var DateofMarriageRowCtrl = Runner.getControl(pageid,'DateofMarriageRowCtrl');
*/

/*
var fieldlabel_SpouseDevoteeId = Runner.getControl(
var fieldcontrol_SpouseDevoteeId
var fieldlabel_DateofMarriage
var fieldcontrol_DateofMarriage
*/

//alert( MaritalStatusId.id  );
//alert(DateofMarriage.inputType);
//alert(SpouseDevoteeId.inputType);


MaritalStatusId.on('change', function(e){
//alert('I\'m a in change event');
//alert(this.getValue());
if (this.getValue() == '1'){

//alert('you have select unmarried');
//alert(SpouseDevoteeIdRow.getStringValue() = ' hari');
//alert(SpouseDevoteeIdRow.getValue());

//SpouseDevoteeIdRow.clear();
//SpouseDevoteeIdRow.style.display = 'none';
//DateofMarriageRow.style.display = '';

var id1 = "DateofMarriageRow";
var row1 = $("[id^=" + id1);
row1.hide() ;

var id2 = "SpouseDevoteeIdRow";
var row2 = $("[id^=" + id2);
row2.hide() ;

}
else
{
var id1 = "DateofMarriageRow";
var row1 = $("[id^=" + id1);
row1.show() ;

var id2 = "SpouseDevoteeIdRow";
var row2 = $("[id^=" + id2);
row2.show() ;

}
});
 
                 ;
});





