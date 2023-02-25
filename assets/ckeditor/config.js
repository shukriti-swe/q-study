/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function( config )  
 {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E'; 
	config.toolbarCanCollapse = true;
	config.toolbarStartupExpanded = false;
	extraPlugins = 'ckeditor_wiris';
	//config.removePlugins = 'blockquote,save,flash,iframe,tabletools,pagebreak,templates,about,showblocks,newpage,language,print,div';
   // config.removeButtons = 'Print,Form,TextField,Textarea,Button,CreateDiv,PasteText,PasteFromWord,Select,HiddenField,Radio,Checkbox,ImageButton,Anchor,BidiLtr,BidiRtl,Font,Format,Styles,Preview,Indent,Outdent';
   //config.image_previewText = ' ';

	//wiris config
	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
	config.allowedContent = true;
};
