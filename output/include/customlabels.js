
var custom_label_map = {
"English" : {
}
};

function GetCustomLabel(name)
{
	return custom_label_map[Runner.lang.constants.current_language][name];
}