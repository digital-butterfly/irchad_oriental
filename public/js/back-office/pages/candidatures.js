"use strict";
// Class definition

var KTDatatableJsonRemoteDemo = function () {
	// Private functions

	// basic demo
	var demo = function () {

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
                source: {
                    read: {
                      url: 'http://localhost:10000/assets/js/pages/candidatures.json',
                      method: 'GET',
                    },
                },
                pageSize: 10,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch')
			},

			// columns definition
			columns: [
				{
					field: 'CandidatureID',
					title: '#',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {class: 'kt-checkbox--solid'},
					textAlign: 'center',
				}, {
					field: 'Date',
                    title: 'Date',
                    type: 'date',
					format: 'MM/DD/YYYY',
				}, {
					field: 'Titre',
                    title: 'Titre',
                    template: function(row) {
						return '<a href="' + row.Lien + '">' + row.Titre + '<a/>' ;
					},
				}, {
					field: 'Categorie',
					title: 'Catégorie',
				}, {
					field: 'Porteur',
					title: 'Porteur',
				}, {
					field: 'Status',
					title: 'Status',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Nouveau', 'class': 'kt-badge--brand'},
							2: {'title': 'Rejeté', 'class': ' kt-badge--danger'},
							3: {'title': 'Validé', 'class': ' kt-badge--primary'},
							4: {'title': 'BM Rempli', 'class': ' kt-badge--success'},
							5: {'title': 'DF Remplie', 'class': ' kt-badge--info'},
							6: {'title': 'BP Généré', 'class': ' kt-badge--danger'},
							7: {'title': 'CT Convoqué', 'class': ' kt-badge--warning'},
							8: {'title': 'CPDH Convoqué', 'class': ' kt-badge--warning'},
							9: {'title': 'Incubé', 'class': ' kt-badge--warning'},
						};
						return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
					},
				}, {
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					autoHide: false,
					overflow: 'visible',
					template: function() {
						return '\
						<div class="dropdown">\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
						  	<div class="dropdown-menu dropdown-menu-right">\
						    	<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
						    	<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
						  	</div>\
						</div>\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\
							<i class="la la-edit"></i>\
						</a>\
						<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
							<i class="la la-trash"></i>\
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
		init: function () {
			demo();
		}
	};
}();

jQuery(document).ready(function () {
	KTDatatableJsonRemoteDemo.init();
});