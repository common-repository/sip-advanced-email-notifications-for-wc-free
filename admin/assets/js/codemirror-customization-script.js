var $ = jQuery;
$(document).ready(function(){
	Array.prototype.max = function () {
		return Math.max.apply(this, this);
	};
	function escapeRegExp(string) {
		return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
	}
	function replaceAll(string, find, replace) {
		return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
	}
	
	var fullId = 'summernote_0_content';
	// console.log(fullId);
	$('#'+fullId).summernote({
		placeholder: 'write here...',
		tabsize: 2,
		// justifyLeft : true,
		height: 120,
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true,                  // set focus to editable area after initializing summernote
		toolbar: [
		['style', ['style']],
		['font', ['bold', 'underline', 'clear']],
		['color', ['color']],
		['fontsize', ['fontsize']],
		['para', ['ul', 'ol', 'paragraph']],
		['table', ['table']],
		['insert', ['link', 'picture', 'video']],
		['view', ['fullscreen', 'codeview', '']]
		],
		codemirror: { // codemirror options
			theme: 'monokai'
		}
	});
	$('#'+fullId).summernote('justifyLeft');
	
});
