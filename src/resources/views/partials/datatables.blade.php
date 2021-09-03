<style>
    div.dataTables_wrapper div.dataTables_info {
        white-space: pre-wrap;
    }

    div.dataTables_filter {
        float: right;
    }

    div.dt-buttons {
        float: right;
        margin-left: 10px;
    }

    .dataTables_filter label {
        line-height: normal;
    }

    li.buttons-columnVisibility.active a, li.buttons-columnVisibility a {
        color: #262626 !important;
        background-color: #ffffff !important;
        border-left: 5px solid #eaeaea;
    }

    li.buttons-columnVisibility a:hover {
        background-color: #eaeaea !important;
    }

    li.buttons-columnVisibility.active a {
        border-left: 5px solid #0ba557;
    }

</style>
<script>
    if (!window.hasOwnProperty('app')) {
        window.app = {};
    }

    window.app.dataTableService = {
        getSaveStateLockedKey: function (settings) {
            return "DataTables_" + settings.sInstance + "_" + "locked" + "_" + location.pathname;
        },
        getSaveStateKey: function (settings) {
            return "DataTables_" + settings.sInstance + "_" + location.pathname;
        },

        getStorage: function (settings) {
            if (settings !== undefined) {
                return (-1 === settings.iStateDuration ? sessionStorage : localStorage)
            }

            return localStorage;
        },
        saveToStorage: function (settings, key, value) {
            try {
                this.getStorage(settings).setItem(key, value);
            } catch (exception) {
                console.error(exception);
            }
        },
        getFromStorage: function (settings, key) {
            try {
                return JSON.parse(this.getStorage(settings).getItem(key));
            } catch (exception) {
                console.error(exception);
            }
        },
        removeFromStorage: function (settings, key) {
            try {
                return this.getStorage(settings).removeItem(key);
            } catch (exception) {
                console.error(exception);
            }
        },
        saveState: function (settings, data) {
            this.saveToStorage(settings, this.getSaveStateKey(settings), JSON.stringify(data));
        },
        resetSaveState: function (settings) {
            this.removeFromStorage(settings, this.getSaveStateKey(settings));
        },
        isSaveStateLocked: function (settings) {
            return this.getFromStorage(settings, this.getSaveStateLockedKey(settings));
        },
        lockSaveState: function (settings) {
            this.saveToStorage(settings, this.getSaveStateLockedKey(settings), true);
        },
        unlockSaveState: function (settings) {
            this.saveToStorage(settings, this.getSaveStateLockedKey(settings), false);
        },
        getColumnLockedKey: function (settings) {
            return "col_" + settings.sInstance + "_" + "locked" + "_" + location.pathname;
        },
        getColumnKey: function (settings) {
            return "col_" + settings.sInstance + "_" + location.pathname;
        },
        saveColumnToStorage: function (settings, value) {
            try {
                this.getStorage(settings).setItem(this.getColumnLockedKey(settings), value);
            } catch (exception) {
                console.error(exception);
            }
        },
        getColumnFromStorage: function (settings) {
            try {
                return this.getStorage(settings).getItem(this.getColumnLockedKey(settings));
            } catch (exception) {
                console.error(exception);
            }
        },
        removeColumnFromStorage: function (settings) {
            try {
                return this.getStorage(settings).removeItem(this.getColumnLockedKey(settings));
            } catch (exception) {
                console.error(exception);
            }
        },
    };
    var initialized = [];
    $.extend(true, $.fn.DataTable.defaults, {
        stateSave: true,
        stateDuration: -1,
        processing: false,
        serverSide: true,
        responsive: true,
        pagingType: 'input',
        pageLength: 10,

        dom: "" +
            "<'row'" +
            "<'col-sm-6'l>" +
            "<'col-sm-6'Bf>" +
            ">" +
            "<'row'" +
            "<'col-sm-12'tr>" +
            ">" +
            "<'row'" +
            "<'col-lg 5 col-sm-5'i>" +
            "<'col-lg-7 col-sm-7'p>" +
            ">",

        buttons: [
            {
                extend: 'colvis',
                tag: 'button',
                fade: 0,
                text: function (dt) {
                    return '<i class="fa fa-table"></i> Columns';
                },
                className: 'buttons-colvis btn-sm',
                columns: ':not(.no-colvis)',
            },

        ],
        preDrawCallback: function( settings ) {
            if($.inArray(settings.sInstance, initialized)<0){
                initialized.push(settings.sInstance);
                var currentTable = $(settings.nTableWrapper);
                var columnSearch = currentTable.find('.searchByColumn');
                var columnSelect = currentTable.find('.column_badge');
                var savedColumn = app.dataTableService.getColumnFromStorage(settings);

                var columnList = "<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">"+
                    "<li><a class='column' data-column='-1'>All</a></li>"

                for(var col in settings.aoColumns){
                    if($(settings.aoColumns[col].nTh).hasClass('enable-col-search')){
                        var title = (settings.aoColumns[col].sTitle);
                        columnList += "<li><a class='column' data-column='"+col+"'>"+title+"</a></li>";
                        if(savedColumn && savedColumn !="All"){
                            if(title == savedColumn){
                                settings.aoColumns[col].bSearchable = true;
                            }else{
                                settings.aoColumns[col].bSearchable = false;
                            }
                        }
                    }
                }
                columnList += "</ul>";
                columnSearch.after(columnList);
                currentTable.find('.dropdown-toggle').dropdown();
                if(savedColumn){
                    columnSelect.html(savedColumn);
                }else{
                    columnSelect.html("All");
                }
                currentTable.find('.column').click(function (e) {
                    e.preventDefault();
                    col= $(this).data('column');
                    if(col == -1){
                        columnSelect.html("All");
                        for(var c in settings.aoColumns){
                            if($(settings.aoColumns[c].nTh).hasClass('enable-col-search')){
                                settings.aoColumns[c].bSearchable = true;
                            }
                        }

                    }else {
                        columnSelect.html(settings.aoColumns[col].sTitle)
                        if (app.dataTableService.isSaveStateLocked(settings)){
                            app.dataTableService.saveColumnToStorage(settings, settings.aoColumns[col].sTitle);
                        }else {
                            app.dataTableService.unlockSaveState(settings);
                        }
                        for (var c in settings.aoColumns) {
                            settings.aoColumns[c].bSearchable = false;
                        }
                        settings.aoColumns[col].bSearchable = true;
                    }

                    //when column is selected redraw table
                    $('#'+settings.sTableId).DataTable().draw();
                });
            }

        },
        initComplete: function (settings) {
            var currentTable = $(settings.nTableWrapper);
            var $searchLock = $(settings.nTableWrapper).find('.dataTable_search_lock');
            var isSavedStateLocked = app.dataTableService.isSaveStateLocked(settings);
            var $searchColumn = $(settings.aoColumns);


            $searchLock.removeAttr('disabled')
                .attr('aria-control', settings.sInstance)
                .attr('data-instance', settings.sInstance)
                .attr('data-table', settings.sTableId)
                .on('click', function () {

                    if (app.dataTableService.isSaveStateLocked(settings)) {
                        app.dataTableService.removeColumnFromStorage(settings)
                        $(this).attr('data-value', 'false').html('<i class="fa fa-unlock"></i>');
                        app.dataTableService.unlockSaveState(settings);
//                        app.dataTableService.resetSaveState(settings);
                        if (settings.oSavedState) {
                            settings.oSavedState.search.search = "";
                        }

                        app.dataTableService.saveState(settings, settings.oSavedState);
                    } else {
                        $(this).attr('data-value', 'true').html('<i class="fa fa-lock"></i>');
                        settings.oSavedState.search.search = $(settings.nTableWrapper).find('input[type=search]').val();
                        app.dataTableService.saveColumnToStorage(settings, currentTable.find('.column_badge').html());
                        app.dataTableService.lockSaveState(settings);
                        app.dataTableService.saveState(settings, settings.oSavedState);
                    }
                });



            if (isSavedStateLocked) {
                $searchLock.attr('data-value', 'true').html('<i class="fa fa-lock"></i>');
                app.dataTableService.saveState(settings, settings.oSavedState);
            } else {
                $searchLock.attr('data-value', 'false').html('<i class="fa fa-unlock"></i>');
//                app.dataTableService.resetSaveState(settings);
                if (settings.oSavedState) {
                    settings.oSavedState.search.search = "";
                }
                app.dataTableService.saveState(settings, settings.oSavedState);
            }
        },
        oLanguage: {
            sSearch: 'Search: _INPUT_ <button class="dataTable_search_lock btn btn-sm btn-default" disabled><i class="fa fa-spin fa-cog"></i></button><br>'+
                ' <div class="dropdown"><a href="#" class="searchByColumn dropdown-toggle" data-toggle="dropdown">By Column</a>'+
                ' <span class="badge column_badge"></span></button></div> '
        },
        stateSaveCallback: function (settings, data) {
            if (!app.dataTableService.isSaveStateLocked(settings)) {
                data.search.search = "";
            } else {
//                app.dataTableService.saveColumnToStorage(settings, settings.aoColumns[col].sTitle);
            }
            app.dataTableService.saveState(settings, data);
        }
    });

    @if(App::environment() == "production")
        $.fn.dataTable.ext.errMode = 'none';

    $(document).on( 'error.dt', function ( e, settings, techNote, message ) {
        console.log( 'An error has been reported by DataTables: ', message );
    });
    @endif


    $(document).on('preXhr.dt', function (e, settings, data) {
        $('#table_wrapper *').css('pointer-events', 'none');
        data.search.value = data.search.value.trim();

        if (data.search.value.indexOf('%') > -1) {
            data.search.value = data.search.value.replace(/%/g, '\\%');
            data.search.value = data.search.value.replace(/_/g, '\\_');
        }
    });

    $(document).on('xhr.dt', function () {
        $('#table_wrapper *').removeAttr('style');
    });

    $(function( settings ) {
        var width = $( window ).width();
        var heigth = $(window).height();
        if(width<1024){
            $('.desktop').attr('style','width: 0px; display: none;');

        }
        if(width<768){
            $('.tablet').attr('style','width: 0px; display: none;');
        }
        if(width<1025 && heigth<1377){
            $('.desktop:not(.tablet)').attr('style','width: 0px; display: none;');
        }
    })

</script>

<script>
    $(function () {
        $('[href="http://screeningsource.app/logout"]').on('click', function (e) {
//            window.app.dataTableService.getStorage().clear();
        });

        $('#switch-role').find('#switch-href').on('click', function (e) {
//            window.app.dataTableService.getStorage().clear();
        });

    });
</script>



