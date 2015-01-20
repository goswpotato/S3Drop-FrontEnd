/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: 'server/upload/'
    });
	
	$('#fileupload').bind('fileuploaddone', function (e, data) {
		//alert('success');
		console.log(data);
		//location.reload();
	});
	$('#fileupload').bind('fileuploadfail', function (e, data) {
		alert('fail');
		console.log(data);
	});
	
});
