// $Id$

function elfinder_ckeditor_callback(arg1) {
         // console.log(typeof url);
          
          var url = arg1;
          
          if (typeof arg1 == 'object') {
            url = arg1.url;
          }
          funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
          window.opener.CKEDITOR.tools.callFunction(funcNum, url);
          window.close();
}