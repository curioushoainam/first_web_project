<?php 
//echo "from ckeditor";
// $dimenison is a array[height in px or em, width in % or px]
function ckeditor($name, $content,$size = array('10em','100%'), $toolbar = 'standard'){
    global $ckeditor_loaded;
    $code = '';
    if (!$ckeditor_loaded){
        $code .= '<script type="text/javascript" src="./libs/asset/ckeditor/ckeditor.js"></script>';
        $ckeditor_loaded = true;
    } 
    //$code .= '<textarea id="'. $name .'">'. htmlentities($content) .'</textarea>';
	$code .= '<textarea id="'. $name .'" name="'. $name .'">'. htmlentities($content) .'</textarea>';
    $code .= '<script type="text/javascript">';
    $code .= ' config = {};
                config.entities_latin = false;
                config.language = "en";
                config.filebrowserBrowseUrl = "./libs/asset/ckfinder/ckfinder.html";
                config.filebrowserImageBrowseUrl = "./libs/asset/ckfinder/ckfinder.html";
                config.height = "'.$size[0].'";                
                config.width = "'.$size[1].'";
        ';
	if ($toolbar == 'basic'){
    $code .= "config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
		];

		config.removeButtons = 'About,Maximize,TextColor,Styles,Image,Link,BidiLtr,Outdent,Blockquote,NumberedList,CopyFormatting,Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Radio,Checkbox,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,RemoveFormat,BulletedList,Indent,CreateDiv,BidiRtl,Unlink,Flash,Table,Anchor,Language,PageBreak,HorizontalRule,BGColor,ShowBlocks,Format,Font,FontSize,Iframe';";
		
    } elseif ($toolbar == 'standard'){
    $code .= "config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		'/',
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Anchor,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Source,Templates,Save,NewPage,Preview,Print,Styles,Maximize,ShowBlocks,About,Format,Font,FontSize';";
        
    } elseif ($toolbar == 'advance'){
    $code .= "config.toolbarGroups = [
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		'/',
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
        ];";       
    }    
    $code .= "CKEDITOR.replace('". $name ."', config);";
    $code .= '</script>';

    return $code;
}

?>