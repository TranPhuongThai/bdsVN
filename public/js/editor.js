// JavaScript Document

function FullEditor(obj, name, height) {

    obj.width="100%";
    obj.height=height;

    /***************************************************
    ADDING CUSTOM BUTTONS
    ***************************************************/

    /*
    obj.arrCustomButtons = [["CustomName1","alert('Command 1 here.')","Caption 1 here","btnCustom1.gif"],
    ["CustomName2","alert(\"Command '2' here.\")","Caption 2 here","btnCustom2.gif"],
    ["CustomName3","alert('Command \"3\" here.')","Caption 3 here","btnCustom3.gif"]]
    */

    /***************************************************
    RECONFIGURE TOOLBAR BUTTONS
    ***************************************************/

    /*Set toolbar mode: 0: standard, 1: tab toolbar, 2: group toolbar */
    obj.toolbarMode = 2;

    obj.groups=[
    ["grpFont", "", ["FontName", "FontSize", "Strikethrough", "Superscript", "BRK", "Bold", "Italic", "Underline", "ForeColor", "BackColor"]],
    ["grpPara", "", ["Paragraph", "Numbering", "Bullets", "BRK", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull"]],
    ["grpTables", "", ["Table", "BRK", "Guidelines", "AutoTable"]],
    ["grpMedia", "", ["Image", "YoutubeVideo",  "BRK", "Hyperlink", "Characters", "Line"]], /*"CustomName1", "CustomName2", "CustomName3",*/
    ["grpEdit", "", ["XHTMLSource", "FullScreen", "Search", "RemoveFormat", "BRK", "Undo", "Redo"]]
    ];

    /***************************************************
    OTHER SETTINGS
    ***************************************************/

    obj.css="style/test.css";//Specify external css file here. If Table Auto Format is enabled, the table autoformat css rules must be defined in the css file.

    if (navigator.appName.indexOf('Microsoft') != -1) obj.cmdAssetManager = "modalDialogShow('../assetmanager/assetmanager.php','700','500')";
	else
	obj.cmdAssetManager = "modalDialogShow('/public/js/Editor/assetmanager/assetmanager.php','700','500')";
	obj.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.
	obj.cmdCustomObject = "modelessDialogShow('../../js/Editor/scripts/objects.php','100%','600')";
	
    obj.arrCustomTag=[["First Name","{%first_name%}"],
    ["Last Name","{%last_name%}"],
    ["Email","{%email%}"]];//Define custom tag selection

    obj.customColors=["#ff4500","#ffa500","#808000","#4682b4","#1e90ff","#9400d3","#ff1493","#a9a9a9"];//predefined custom colors

    obj.mode="XHTMLBody"; //Editing mode. Possible values: "HTMLBody" (default), "XHTMLBody", "HTML", "XHTML"

    obj.REPLACE(name);


} 

function TabsEditor(obj, name, height) {
	obj.width = "100%";
	obj.height = height;
	/***************************************************
	 
	 ADDING CUSTOM BUTTONS
	 
	 ***************************************************/
    /*obj.arrCustomButtons = [["CustomName1","alert(\'Command 1 here.\')","Caption 1 here","btnCustom1.gif"],

	["CustomName2","alert(\"Command \'2\' here.\")","Caption 2 here","btnCustom2.gif"],

	["CustomName3","alert(\'Command \"3\" here.\')","Caption 3 here","btnCustom3.gif"]]*/
	/***************************************************
	 
	 RECONFIGURE TOOLBAR BUTTONS
	 
	 ***************************************************/
	obj.tabs = [
		["tabHome", "Home", ["grpEdit", "grpFont", "grpPara", "grpPage"]],
		["tabStyle", "Objects", ["grpObjects", "grpLinks", "grpTables", "grpStyles", "grpCustom"]]
	];
	obj.groups = [
		["grpEdit", "", ["Undo", "Redo", "Search", "SpellCheck", "ClearAll", "BRK", "Cut", "Copy", "Paste", "PasteWord", "PasteText", "RemoveFormat"]],
		["grpFont", "", ["FontName", "FontSize", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "Superscript", "Subscript", "ForeColor", "BackColor"]],
		["grpPara", "", ["Paragraph", "Indent", "Outdent", "LTR", "RTL", "BRK", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "Numbering", "Bullets"]],
		["grpPage", "", ["Save", "Print", "Preview", "BRK", "FullScreen", "XHTMLSource"]],
		["grpObjects", "", ["Image", "Flash", "Media", "CustomObject", "BRK", "CustomTag", "Characters", "Line", "Form"]],
		["grpLinks", "", ["Hyperlink", "InternalLink", "BRK", "Bookmark"]],
		["grpTables", "", ["Table", "BRK", "Guidelines"]],
		["grpStyles", "", ["StyleAndFormatting", "Styles", "BRK", "Absolute"]],
		["grpCustom", "", ["CustomName1", "CustomName2", "BRK", "CustomName3"]]
	];
	/***************************************************
	 
	 OTHER SETTINGS
	 
	 ***************************************************/
	obj.css = "style/test.css"; //Specify external css file here
	if (navigator.appName.indexOf('Microsoft') != -1) obj.cmdAssetManager = "modalDialogShow('../assetmanager/assetmanager.php','700','500')";
	else
	obj.cmdAssetManager = "modalDialogShow('/public/js/Editor/assetmanager/assetmanager.php','700','500')";
	obj.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.
	obj.cmdCustomObject = "modelessDialogShow('../../js/Editor/scripts/objects.php','100%','600')";
	obj.arrCustomTag = [
		["First Name", "{%first_name%}"],
		["Last Name", "{%last_name%}"],
		["Email", "{%email%}"]
	]; //Define custom tag selection
	obj.customColors = ["#ff4500", "#ffa500", "#808000", "#4682b4", "#1e90ff", "#9400d3", "#ff1493", "#a9a9a9"]; //predefined custom colors
	obj.mode = "XHTMLBody"; //Editing mode. Possible values: "HTMLBody" (default), "XHTMLBody", "HTML", "XHTML"
	obj.REPLACE(name);
}