// $Id$

var elfinder_tinymce_callback = function(arg1) {
  var url = arg1;
          
  if (typeof arg1 == 'object') {
    url = arg1.url;
  }
  window.tinymceFileWin.document.forms[0].elements[window.tinymceFileField].value = url;
  window.tinymceFileWin.focus();
  window.close();
}