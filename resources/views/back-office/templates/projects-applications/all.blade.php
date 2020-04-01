@extends('back-office.layouts.layout-default')



@section('specific_css')
    
@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        @component('back-office.components.portlets.table', ['types' => ['Nouveau', 'Validé', 'Rejeté', 'Incubé'], 'add_link' => 'admin/candidatures/create'])
            @slot('title')
                Candidatures
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
                                url: 'admin/list/candidatures',
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
                            title: 'Titre',
                            template: function(row) {
                                return row.first_name + ' ' + row.last_name;
                            },
                        }, {
                            field: 'created_at',
                            title: 'Date',
                        }, {
                            field: 'status',
                            title: 'Statut du compte',
                            autoHide: false,
                            // callback function support for column rendering
                            template: function(row) {
                                var states = {
                                    'Nouveau': {'title': 'Retail', 'state': 'warning'},
                                    'Validé': {'title': 'Direct', 'state': 'success'},
                                    'Rejeté': {'title': 'Online', 'state': 'danger'},
                                    'Incubé': {'title': 'Online', 'state': 'primary'}
                                };
                                console.log(states[row.status]);
                                return '<span class="kt-badge kt-badge--' + states[row.status].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + states[row.status].state + '">' +
                                        row.status + '</span>';
                            },
                        }, {
                            field: 'Actions',
                            title: 'Actions',
                            sortable: false,
                            width: 110,
                            overflow: 'visible',
                            autoHide: false,
                            template: function(row) {
                                return '\
                                <a href="admin/members/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
                                    <i class="flaticon2-gear"></i>\
                                </a>\
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-sm" data-toggle="modal" data-target="#kt_modal_1" title="Delete">\
                                    <i class="flaticon2-trash"></i>\
                                </a>\
                            ';
                            },
                        }],

                });

            $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
            });

            $('#kt_form_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
            });

            $('#kt_form_status,#kt_form_type').selectpicker();

            };

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

                id = $(this).closest('tr').find('td[data-field="id"] span').html();

                name = $(this).closest('tr').find('td[data-field="name"] span').html();

                $('#kt_modal_1 .modal-body p span').html('le compte de ' + name);

                $('#kt_modal_1 button.delete').click(function() {
                    $.ajax({
                        url: 'admin/members/' + id,
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        type: 'DELETE',
                        success: function(result) {
                            location.reload();
                        }
                    });
                });

            });
        });

    </script>
@endsection