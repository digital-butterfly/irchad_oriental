@extends('back-office.layouts.layout-default')



@section('specific_css')

@endsection




@section('page_content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <!--begin::Form-->
            <form class="kt-form" method="POST" action="{{ route('candidatures.update', $data->id) }}">
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Modifier Candidatures
                            </h3>
                        </div>

                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <button type="submit" class="btn btn-primary">Appliquer</button>
                                <button onclick="history.go(-1);" type="reset" class="btn btn-secondary">Retour</button>

                            </div>
                        </div>
                    </div>

                </div>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div><br />
			@endif

                {{ method_field('PUT') }}
				<div class="kt-portlet__body">
					<div class="kt-section kt-section--first">



						@php
							$done_groups = [];
						@endphp
						@foreach($fields as $parent)
							@if (isset($parent['group']))
								@if (!(in_array($parent['group'], $done_groups)))
									@php
										$done_groups[] = $parent['group'];
										$done_fields[] = [];
									@endphp
									<h3 class="kt-section__title">{{ $parent['group'] }}</h3>
									<div class="kt-section__body">
										@foreach($fields as $child)
											@if (isset($child['group']) && $child['group'] == $parent['group'])
												@if (!isset($child['sub_fields']))
													@if (!(in_array($child['name'], $done_fields)))
														@php
															$done_fields[] = $child['name'];
															$child['config']['hotizontalRows'] = true;
														@endphp
														@include(sprintf('back-office.components.form.fields.%s', $child['type']), $field = $child)
													@endif
												@else
													@foreach($child['sub_fields'] as $subchild)
														@if (!(in_array($subchild['name'], $done_fields)))
															@php
																$done_fields[] = $subchild['name'];
																$subchild['config']['hotizontalRows'] = true;
																$subchild['parent_name'] = $child['name'];
															@endphp
															@include(sprintf('back-office.components.form.fields.%s', $subchild['type']), $field = $subchild)
														@endif
													@endforeach
												@endif
											@endif
										@endforeach
									</div>
								@endif
							@endif
                        @endforeach
		            </div>
	            </div>
	            <div class="kt-portlet__foot">
					<div class="kt-form__actions">
						<button type="submit" class="btn btn-primary">Appliquer</button>
						<button onclick="history.go(-1);" type="reset" class="btn btn-secondary">Retour</button>
					</div>
				</div>
				@csrf
			</form>
			<!--end::Form-->
		</div>
    </div>
@endsection




@section('specific_js')
	<script>
        var KTTagify = function() {

            // Private functions
            var demo1 = function() {
                var toEl = document.getElementById('kt_tagify_1');
                console.log( $('#member_id').val())
                var tagifyTo = new Tagify(toEl, {
                    delimiters: ", ", // add new tags when a comma or a space character is entered
                    maxTags: 5,
                    enforceWhitelist: true,
                    blacklist: [$('#member_id').val()],
                    keepInvalidTags: true, // do not remove invalid tags (but keep them marked as invalid)
                    whitelist: [],
                    templates: {
                        dropdownItem : function(tagData){
                            try{
                                return '<div class="tagify__dropdown__item">' +
                                    '<div class="kt-media-card">' +
                                    '    <span class="kt-media kt-media--'+(tagData.initialsState?tagData.initialsState:'')+'" style="background-image: url('+tagData.pic+')">' +
                                    '        <span>'+tagData.id+'</span>' +
                                    '    </span>' +
                                    '    <div class="kt-media-card__info">' +
                                    '        <a href="#" class="kt-media-card__title">'+tagData.value+'</a>' +
                                    '    </div>' +
                                    '</div>' +
                                    '</div>';
                            }
                            catch(err){}
                        }
                    },
                    transformTag: function(tagData) {
                        tagData.class = 'tagify__tag tagify__tag--brand';
                    },
                    dropdown : {
                        searchKeys: ["value", "name","id"] ,
                        classname : "color-blue",
                        enabled   : 1,
                        maxItems  : 5
                    }


                });

                tagifyTo.on('input', onInput)
                function onInput(e){
                    console.log("onInput: ", e.detail);
                    tagifyTo.settings.whitelist.length = 0; // reset current whitelist
                    // tagify.loading(true).dropdown.hide.call(tagify) // show the loader animation


                    // get new whitelist from a delayed mocked request (Promise)
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
                        url : '/admin/candidaturesmemmbers', // La ressource ciblée
                        method:'POST',
                        data:{'tag':e.detail.value}

                    })
                        .then(function(result){
                            // replace tagify "whitelist" array values with new values
                            // and add back the ones already choses as Tags
                            console.log('---->',result)

                            tagifyTo.settings.whitelist.push(...result[0])
                            // tagify.settings.whitelist.splice(0, result[0].length, ...tagify.value)

                            // render the suggestions dropdown.
                            tagifyTo.dropdown.show.call(tagifyTo, e.detail.value);
                            console.log(e.detail.value,tagifyTo.value,tagifyTo.settings.whitelist,'helo')
                        })
                }

                // // initialize Tagify on the above input node reference
                // var tagify = new Tagify(input, {
                //     enforceWhitelist: true,
                //     skipInvalid: true,
                //     templates: {
                //                     dropdownItem : function(tagData){
                //                         try{
                //                             return '<div class="tagify__dropdown__item">' +
                //                                 '<div class="kt-media-card">' +
                //                                 '    <div class="kt-media-card__info">' +
                //                                 '        <a href="#" class="kt-media-card__title">'+tagData.name+'</a>' +
                //                                 '        <span class="kt-media-card__desc">'+tagData.value+'</span>' +
                //                                 '    </div>' +
                //                                 '</div>' +
                //                                 '</div>';
                //                         }
                //                         catch(err){}
                //                     }
                //                 },
                //     whitelist: [{name: "hamid", email: "achrboukh", value: 14}],
                //     dropdown: {
                //         classname: 'tagify__input',
                //         searchKeys: ["value", "name"] ,
                //         closeOnSelect: false,
                //         enabled: 0,
                //         //  try matching suggestions only for those keys (from whitelist Array)
                //     }
                //
                // })


//
// // "remove all tags" button event listener
//                 document.querySelector('.tags--removeAllBtn')
//                     .addEventListener('click', tagify.removeAllTags.bind(tagify))

// Chainable event listeners
//                 tagify.on('input', onInput)


// on character(s) added/removed (user is typing/deleting)
//                 function onInput(e){
//                     console.log("onInput: ", e.detail);
//                     tagify.settings.whitelist.length = 0; // reset current whitelist
//                     // tagify.loading(true).dropdown.hide.call(tagify) // show the loader animation
//
//
//                     // get new whitelist from a delayed mocked request (Promise)
//                     $.ajax({
//                         headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
//                         url : '/admin/candidaturesmemmbers', // La ressource ciblée
//                         method:'POST',
//                         data:{'tag':e.detail.value}
//
//                     })
//                         .then(function(result){
//                             // replace tagify "whitelist" array values with new values
//                             // and add back the ones already choses as Tags
//                             console.log('---->',result[0])
//
//                             tagify.settings.whitelist.push(...result[0])
//                             // tagify.settings.whitelist.splice(0, result[0].length, ...tagify.value)
//
//                             // render the suggestions dropdown.
//                             tagify.dropdown.show.call(tagify, e.detail.value);
//                             console.log(e.detail.value,tagify.value,tagify.settings.whitelist,'helo')
//                         })
//                 }



                //     var tagify = new Tagify(input, {
            //         enforceWhitelist: true,
            //         keepInvalidTags     : true,
            //         whitelist: [{first_name: "hamid", last_name: "achrboukh", id: 104}],
            //         templates: {
            //             dropdownItem : function(tagData){
            //                 try{
            //                     return '<div class="tagify__dropdown__item">' +
            //                         '<div class="kt-media-card">' +
            //                         '    <div class="kt-media-card__info">' +
            //                         '        <a href="#" class="kt-media-card__title">'+tagData.first_name+' '  +tagData.last_name+'</a>' +
            //                         '        <span class="kt-media-card__desc">'+tagData.id+'</span>' +
            //                         '    </div>' +
            //                         '</div>' +
            //                         '</div>';
            //                 }
            //                 catch(err){}
            //             }
            //         },
            //
            //     });
            //     tagify.on('input', onInput).on('add', onAddTag).on('invalid', onInvalidTag).on('click', onTagClick).on('dropdown:select', onDropdownSelect)
            //     function onInput(e){
            //         tagify.settings.whitelist.length = 0; // reset current whitelist
            //         tagify.loading(true).dropdown.hide.call(tagify) // show the loader animation
            //         //
            //         // // get new whitelist from a delayed mocked request (Promise)
            //         console.log("onInput: ", e.detail);
            //         $.ajax({
            //             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
            //             url : '/admin/candidaturesmemmbers', // La ressource ciblée
            //             method:'POST',
            //             data:{'tag':e.detail.value}
            //
            //         }).then(function(result){
            //             console.log(result)
            //             // replace tagify "whitelist" array values with new values
            //             // and add back the ones already choses as Tags
            //             tagify.settings.whitelist.push(...result[0], ...tagify.value)
            //             console.log('console.log(tagify.value)',tagify.settings.whitelist)
            //
            //             // render the suggestions dropdown.
            //             tagify.loading(false).dropdown.show.call(tagify);
            //         })
            //     }
            //     function onAddTag(e){
            //         console.log("onAddTag: ", e.detail);
            //         console.log("original input value: ", input.value)
            //         tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
            //     }
            //     // invalid tag added callback
            //     function onInvalidTag(e){
            //         console.log("onInvalidTag: ", e.detail);
            //     }
            //     function onTagClick(e){
            //         console.log(e.detail);
            //         console.log("onTagClick: ", e.detail);
            //     }
            //     function onDropdownSelect(e){
            //         console.log("onDropdownSelect: ", e.detail)
            //     }
            //
            }

            return {
                // public functions
                init: function() {
                    demo1();

                }
            };
        }();
		// Class definition
		var KTFormRepeater = function() {

			// Private functions
			var demo1 = function() {

				var financial_plan = $('.kt_repeater_financial_plan').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var financial_plan_loans = $('.kt_repeater_financial_plan_loans').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var startup_needs = $('.kt_repeater_startup_needs').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var overheads_fixed = $('.kt_repeater_overheads_fixed').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var overheads_scalable = $('.kt_repeater_overheads_scalable').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var human_ressources = $('.kt_repeater_human_ressources').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var taxes = $('.kt_repeater_taxes').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var pre_creation_training = $('.kt_repeater_pre_creation_training').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});

				var post_creation_training = $('.kt_repeater_post_creation_training').repeater({
					initEmpty: false,

					defaultValues: {
						'text-input': 'foo'
					},

					show: function () {
						$(this).slideDown();
					},

					hide: function (deleteElement) {
						$(this).slideUp(deleteElement);
					}
				});
			}

			return {
				// public functions
				init: function() {
					demo1();
				}
			};
		}();
        $('#statusSelect, input[name="status"]').change(updateStatusElements);

        function updateStatusElements(e) {
            console.log(e,'ee')
            var valueAttribute = '[value="' + e.target.value + '"]';
            $('#statusSelect option' + valueAttribute).prop('selected', true);
            $('input[name="status"]' + valueAttribute).prop('checked', true);
        }
        $('#incorporationSelect, input[name="incorporation"]').change(updateElements);

        function updateElements(e) {
            var valueAttribute = '[value="' + e.target.value + '"]';
            $('#incorporationSelect option' + valueAttribute).prop('selected', true);
            $('input[name="incorporation"]' + valueAttribute).prop('checked', true);
        }
        function selectTypeElemts(){
            console.log('hello', )
            let ss=$( "#statusSelect" ).val();
            let valueAttribute = '[value="' + ss + '"]';
            $('input[name="status"]' + valueAttribute).prop('checked', true)
        }
        function selectElemts(){
            console.log('hello', )
            let ss=$( "#incorporationSelect" ).val();
            let valueAttribute = '[value="' + ss + '"]';
            $('input[name="incorporation"]' + valueAttribute).prop('checked', true)
        }

		jQuery(document).ready(function() {
            selectTypeElemts();
            selectElemts()


			KTFormRepeater.init();
            KTTagify.init();
		});
	</script>
@endsection
