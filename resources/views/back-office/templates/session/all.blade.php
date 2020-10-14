@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        @component('back-office.components.portlets.table', [ 'add_link' => 'admin/session/create'])
            @slot('title')
                Sessions
            @endslot
        @endcomponent
    </div>
@endsection




@section('specific_js')
    <script>
        "use strict";

        // Class definition
        var KTDatatableRemoteAjaxDemo = function() {

            // Private functions

            // basic demo
            var demo = function() {

                var datatable = $('.kt-datatable').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                               url: 'admin/list/session',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                                map: function(raw) {
                                    // sample data mapping
                                    var dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                },
                            },
                        },
                        // pageSize: 10,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                    },

                    // layout definition
                    layout: {
                        scroll: false,
                        footer: false,
                    },
                    detail: {
                        title: 'Load sub table',
                        content: subTableInit,
                    },
                    // column sorting
                    sortable: true,

                    pagination: true,

                    search: {
                        input: $('#generalSearch'),
                        // onEnter: true,
                        delay: 400,

                    },

                    // columns definition
                    columns: [
                        {
                            field: 'id',
                            title: '#',
                            sortable: 'asc',
                            width: 50,
                            type: 'number',
                            selector: false,
                            textAlign: 'center',
                        }, {
                            field: 'title',
                            title: 'Session',
                            template: function(row) {
                                return   row.title;
                            },

                        }
                        ,
                        {
                            field: 'sort',
                            title: 'Sort',
                            template: function(row) {
                                return   row.sort;
                            },

                        }
                        ,
                        {
                            field: 'max_inscrit',
                            title: 'max inscrit',
                        },
                        {
                            field: 'start_date',
                            title: 'Date début',
                        },{
                            field: 'end_date',
                            title: 'Date fin',
                        },

                            {
                            field: 'Actions',
                            title: 'Actions',
                            sortable: false,
                            width: 110,
                            overflow: 'visible',
                            autoHide: false,
                            template: function(row) {
                                return '\
                                <a href="admin/session/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                                    <i class="flaticon2-gear"></i>\
                                </a>\
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="modal" data-target="#kt_modal_1" title="Delete">\
                                    <i class="flaticon2-trash"></i>\
                                </a>\
                            ';
                            },
                        }
                        ],

                });

            $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
            });

            $('#kt_form_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
            });

            $('#kt_form_status,#kt_form_type').selectpicker();

            };
            function subTableInit(e) {
                $('<div/>').attr('id', 'child_data_ajax_' + e.data.id).appendTo(e.detailCell).KTDatatable({
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: 'admin/list/adherentsession',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                                params: {
                                    // custom query params
                                    query: {
                                        generalSearch:e.data.id,
                                    },
                                },
                            },
                        },
                        // pageSize: 10,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                    },

                    // layout definition
                    layout: {
                        scroll: true,
                        height: 400,
                        footer: false,

                        // enable/disable datatable spinner.
                        spinner: {
                            type: 1,
                            theme: 'default',
                        },
                    },

                    sortable: true,

                    // columns definition
                    columns: [
                        {
                            field: 'member_id',
                            title: '#',
                            sortable: 'asc',
                            width: 50,
                            type: 'number',
                            selector: false,
                            textAlign: 'center',
                        }, {
                            field: 'title',
                            title: 'Nom',
                            template: function(row) {
                                return   row.title;
                            },

                        },
                        {
                            field: 'projet',
                            title: 'Projet',
                        },
                        {
                            field: 'sort',
                            title: 'Sort',
                        },{
                            field: 'observation',
                            title: 'observation',
                        },

                        {
                            field: 'Actions',
                            title: 'Actions',
                            sortable: false,
                            width: 110,
                            overflow: 'visible',
                            autoHide: false,
                            template: function(row) {
                                console.log(row,'row')
                                return '\
                                <a href="admin/session-members/' + row.id  + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                                    <i class="flaticon2-gear"></i>\
                                </a>';
                            },
                        }
                    ],
                });
            }

            return {
                // public functions
                init: function() {
                    demo();
                },
            };
        }();

        jQuery(document).ready(function() {
            KTDatatableRemoteAjaxDemo.init();

            var id;

            $('.kt-datatable').on('click', '.kt-datatable__body a[title="Delete"]', function() {

                id = $(this).closest('tr').find('td[data-field="id"]').html()





                name = $(this).closest('tr').find('td[data-field="title"] span').html();

                $('#kt_modal_1 .modal-body p span').html('' + name);

                $('#kt_modal_1 button.delete').click(function() {
                    $.ajax({
                        url: 'admin/session/' + $(id).data("value"),
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                });

            });
        });
        $(function () {
            $('.export').on('click', function () {
                var Status = $("#kt_form_type").children("option:selected"). val();
                let Type='Member'
                console.log(Type)
                $.ajax({
                    url: 'admin/exportExcelmembers',
                    data: {
                        Status: Status,
                        Type:Type
                    },

                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (data,textStatus, request) {
                        let filename = request.getResponseHeader('Content-Disposition').split("filename=")[1]
                        console.log()
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = filename.substring(1, filename.length-1);
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                });
            });
        });
    </script>
@endsection
