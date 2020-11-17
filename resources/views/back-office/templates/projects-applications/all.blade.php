@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        @component('back-office.components.portlets.table', ['types' => ['Nouveau', 'Accepté', 'Rejeté','Business plan achevé','En attente de formation','En attente de financement', 'Incubé'], 'progresses' => ['Envoyé au Comité Technique', 'Accepté par le Comité Technique', 'Refusé par le Comité Technique','Envoyé au CPDH','Accepté par le CPDH','Refusé par le CPDH'], 'trainings' => ['Envoyé vers formation', 'Formé'], 'incorporations' => ['Entreprise en cours de création', 'Entreprise créee'], 'fundings' => ['Envoyé au financement', 'Financement accepté','Financement refusé','Financé'], 'add_link' => 'admin/candidatures/create'])
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
                        webstorage: false,
                        saveState:false,
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
                        }, {
                            field: 'created_at',
                            title: 'Date',
                        },{
                            field: 'status',
                            title: 'Statut du compte',
                            autoHide: false,
                            // callback function support for column rendering
                            template: function(row) {
                                var states = {
                                    'Nouveau': {'title': 'Retail', 'state': 'warning'},
                                    'Accepté': {'title': 'Direct', 'state': 'success'},
                                    'Business plan achevé':{'title': 'Direct', 'state': 'success'},
                                    'En cours':{'title': 'Direct', 'state': 'warning'},
                                    'Rejeté':{'title': 'Direct', 'state': 'danger'},
                                    'En attente de formation':{'title': 'Direct', 'state': 'warning'},
                                    'En attente de financement':{'title': 'Direct', 'state': 'warning'},
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
                                <a href="admin/candidatures/' + row.id + '" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Show details">\
                                    <i class="flaticon2-browser-2"></i>\
                                </a>\
                                <a href="admin/candidatures/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
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

           $('#kt_form_progress').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'progress');
        });
           $('#kt_form_training').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Formation');
        });
           $('#kt_form_incorporation').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Création');
        });$('#kt_form_funding').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Financement');
        });

        $('#kt_form_status,#kt_form_type,#kt_form_progress, #kt_form_training, #kt_form_incorporation,#kt_form_funding ').selectpicker();

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

                name = $(this).closest('tr').find('td[data-field="title"] span').html();

                $('#kt_modal_1 .modal-body p span').html('la candidature intitulée ' +'<b>'+ name+'</b>');

                $('#kt_modal_1 button.delete').click(function() {
                    $.ajax({
                        url: 'admin/candidatures/' + id,
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
                let Type='Candidatures'
                $.ajax({
                    url: 'admin/exportExcel',
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
