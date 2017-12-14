$(function () {
    /*
	Admin Lists
	*/
    if (document.getElementById('admin_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "admin_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                filterable: false,
                width: 150
            },
            {
                field: "Username",
                filterable: false,
                sortable: false,
                width: 150
            },
            {
                field: "Email",
                filterable: false,
                sortable: false,
                width: 250
            },
            {
                field: "Role",
                filterable: false,
                sortable: false,
                width: 70
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 80,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "admin_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "admin_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Article Lists
	*/
    if (document.getElementById('article_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "article_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Title",
                title: "Judul",
                filterable: false,
                width: 150
            },
            {
                field: "Content",
                title: "Isi",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "article_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "article_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').addClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Client Lists
	*/
    if (document.getElementById('client_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "client_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                title: "Nama",
                filterable: false,
                width: 150
            },
            {
                field: "ClientURL",
                title: "Website",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "client_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "client_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Company Lists
	*/
    if (document.getElementById('company_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "company_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                title: "Nama",
                filterable: false,
                width: 150
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "company_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Media Album Lists
	*/
    if (document.getElementById('media_album_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "media_album_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                filterable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "media_album_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "member_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<span class="glyphicon glyphicon-folder-open fontblue font16" aria-hidden="true"></span>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Member View');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Media Lists
	*/
    if (document.getElementById('media_lists_page') != null) {
        var id = $('#media_lists_page').attr("data-program");
        
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "media_get?id=" + id,
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Image",
                filterable: false,
                width: 200,
                template: "#= data.Image #"
            },
            {
                field: "URL",
                filterable: false,
                width: 300,
                template: "#= data.URL #"
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "media_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    /*
	Member Lists
	*/
    if (document.getElementById('member_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "member_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                title: "Nama",
                filterable: false,
                width: 150
            },
            {
                field: "Email",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Phone",
                title: "Telp",
                filterable: false,
                sortable: false,
                width: 100
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 80,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "member_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "member_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Preferences Lists
	*/
    if (document.getElementById('preferences_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "preferences_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                filterable: false,
                width: 150
            },
            {
                field: "Content",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "preferences_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "preferences_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Program Lists
	*/
    if (document.getElementById('program_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "program_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                title: "Nama",
                filterable: false,
                width: 150,
                template: "#= data.Name #"
            },
            {
                field: "Introduction",
                title: "Pengertian Program",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 70,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "program_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "program_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Program Sub Lists
	*/
    if (document.getElementById('program_sub_lists_page') != null) {
        var id = $('#program_sub_lists_page').attr("data-program");
        
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "program_sub_get?id=" + id,
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                title: "Nama",
                filterable: false,
                width: 150
            },
            {
                field: "Introduction",
                title: "Pengertian Program",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 70,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "program_sub_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('body').delegate(".view", "click", function() {
            var id = $(this).attr("id");
            var action = "program_sub_view";
            var dataString = 'id='+ id
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-view').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-view').html('<i class="fa fa-file-text font16"></i>');
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-title').text('Detail Data');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
    }
    
    /*
	Slider Lists
	*/
    if (document.getElementById('slider_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "slider_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Image",
                title: "Foto",
                filterable: false,
                width: 300,
                template: "#= data.Image #"
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "slider_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
    
    /*
	Testimony Lists
	*/
    if (document.getElementById('testimony_lists_page') != null) {
        $("#multipleTable").kendoGrid({
            dataSource: {
                transport: {
                    read: {
                        url: "testimony_get",
                        dataType: "json",
                        type: "POST",
                        data: {}
                    }
                },
                schema: {
                    data: "results",
                    total: "total"
                },
                pageSize: 20,
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                cache: false
            },
            sortable: {
                mode: "single",
                allowUnsort: true
            },
            pageable: {
                buttonCount: 5,
                input: true,
                pageSizes: true,
                refresh: true
            },
            filterable: {
                extra: false,
                operators: {
                    string: {
                        contains: "Mengandung kata"
                    }
                }
            },
            selectable: "row",
            resizable: true,
            columns: [{
                field: "No",
                sortable: false,
                filterable: false,
                width: 30
            },
            {
                field: "Name",
                title: "Nama",
                filterable: false,
                width: 80
            },
            {
                field: "JobTitle",
                title: "Perusahaan & Jabatan",
                filterable: false,
                sortable: false,
                width: 150
            },
            {
                field: "Testimony",
                title: "Testimoni",
                filterable: false,
                sortable: false,
                width: 300
            },
            {
                field: "Action",
                sortable: false,
                filterable: false,
                width: 60,
                template: "#= data.Action #"
            }]
        });
        
        $('body').delegate(".delete", "click", function() {
            var id = $(this).attr("id");
            var action = "testimony_delete";
            var grid = "multipleTable";
            var dataString = 'id='+ id +'&action='+ action +'&grid='+ grid;
            $.ajax(
            {
                type: "POST",
                url: newPathname + action,
                data: dataString,
                cache: false,
                beforeSend: function()
                {
                    $('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data)
                {
                    $('.'+id+'-delete').html('<i class="fa fa-times font16 text-danger"></i>');
                    $('.modal-dialog').removeClass('modal-lg');
                    $('.modal-dialog').addClass('modal-sm');
                    $('.modal-title').text('Yakin Hapus?');
                    $('.modal-body').html(data);
                    $('#myModal').modal('show');
                }
            });
            return false;
        });
        
        $('body').delegate(".edit", "click", function() {
            var id = $(this).attr("id");
            $('.'+id+'-edit').html('<i class="fa fa-spinner fa-spin"></i>');
        });
    }
});