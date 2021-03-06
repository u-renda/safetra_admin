var winOrigin = window.location.origin;
var winPath = window.location.pathname.split('/');
var newPathname = winOrigin + "/" + winPath[1] + "/";

(function($) {

	'use strict';
    
    // TinyMCE
    tinymce.init({
        mode: "specific_textareas",
        editor_selector: "mceEditor",
        forced_root_block: false,
        content_style: ".mce-content-body  {font-size: 14px; font-family: 'Open Sans', sans-serif;}",
        height: 250,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks",
            "insertdatetime table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });
    
    /*
	Navigation - Sidebar
	*/
    var list_child = $('li.list-child');
    
    // untuk dashboard
    if (winPath[3] === 'dashboard') {
        $('.list-dashboard').addClass('nav-active');
    }
        
    // untuk program sub & edit
    if (winPath[2] === 'program_sub_lists' || winPath[2] === 'program_sub_create'
         || winPath[2] === 'program_edit' || winPath[2] === 'program_sub_edit') {
        $('#program').addClass('nav-active');
    }
    
    // untuk edit
    if (winPath[2] === 'admin_edit') {
        $('#admin').addClass('nav-active');
    }
    if (winPath[2] === 'article_edit') {
        $('#article').addClass('nav-active');
    }
    if (winPath[2] === 'client_edit') {
        $('#client').addClass('nav-active');
    }
    if (winPath[2] === 'company_edit') {
        $('#company').addClass('nav-active');
    }
    if (winPath[2] === 'member_edit') {
        $('#member').addClass('nav-active');
    }
    if (winPath[2] === 'slider_edit') {
        $('#slider').addClass('nav-active');
    }
    if (winPath[2] === 'preferences_edit') {
        $('#preferences').addClass('nav-active');
    }
    if (winPath[2] === 'testimony_edit') {
        $('#testimony').addClass('nav-active');
    }
    
    list_child.each(function() {
        var href = $(this).find('a').attr('href');
        var list_parent = $(this).closest("li.list-parent");
        var winPathName = window.location.pathname;
        var newPath = winOrigin + winPathName;
        
        if (href === newPath) {
            $(this).addClass('nav-active');
            list_parent.addClass('nav-active');
        }
    });
    
}).apply(this, [jQuery]);

function goBack() {
    window.history.back();
}