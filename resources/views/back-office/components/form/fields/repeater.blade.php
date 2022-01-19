

@php
    $ref = $field['name'];

    $parent_ref = NULL;
    $repeater_values = [];

    if (old($field['name'])) {
        $repeater_values = old($field['name']);
        $repeater_values = array_map(function($element) {
            return (object) $element;
        }, $repeater_values);
    }

    if (isset($field['parent_name'])) {
        $parent_ref = $field['parent_name'];
        if (old($field['parent_name'])) {
            $repeater_values = old($field['parent_name']);
            $repeater_values = array_map(function($element) {
                return (object) $element;
            }, $repeater_values);
        }
    }

    if (isset($data) && isset($data->$ref) && $data->$ref != NULL) {
        $repeater_values = $data->$ref;
    }
    else if (isset($data) && isset($data->$parent_ref) && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL) {
        $repeater_values = $data->$parent_ref->$ref;
    }
@endphp

<div class="kt_repeater_{{ $field['name'] }}">

    <div class="form-group form-group-last row">
        <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && isset($field['config']['hotizontalRows']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
        <div data-repeater-list="{{ $field['name'] }}" class="col-lg-9">
            <div data-repeater-item="" class="form-group row align-items-center">

                @if (!(isset($field['config']['doubleRepeater'])) && !(isset($field['config']['tripleRepeater'])) && !(isset($field['config']['quadrupleRepeater']))&& !(isset($field['config']['quintupleRepeater'])) && !(isset($field['config']['quadrupleRepeaterofme']))&& !(isset($field['config']['AddDoubleRepeater']))&& !(isset($field['config']['sextupleRepeater'])))
                    <div class="col-md-8">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__control">
                                <input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['label'] }}" value="{{ $data->{$field['name']} ?? '' }}">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    @if (isset($data) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)
                                        {
                                            '{{ $field['name'] }}' :  '{{ $item->$ref ?? '' }}',
                                        },
                                    @endforeach
                                ]);
                            });
                        </script>
                    @elseif (isset($data) && isset($data->$parent_ref) && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                '{{ $field['name'] }}' :  '{{ $item->$ref ?? old($field['name']) }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                '{{ $field['name'] }}' :  '{{ $item->$ref ?? '' }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
                            });
                        </script>
                    @endif
                @elseif (isset($field['config']['tripleRepeater']))
            
                
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '4' }}">    
                   
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="label" class="form-control" placeholder="" >
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][1][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][1][0] ?? 'Quantité' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="count" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][2][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][2][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    {{-- <div class="col-md-{{ $field['config']['attributes'][3][1] ?? '4' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][3][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                @if($field['config']['Select'])
                                <select name="label" class="form-control">
                                    <option value="">---</option>
                                    @foreach($field['config']['options'] as $value)
                                    <option value="{{$value}}" >{{$value}}</option>
                                    @endforeach
                                </select>
                                @else
                                    <input type="text" name="label" class="form-control" placeholder="">

                                @endif
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div> --}}
                    {{-- *************************************************************************************************** --}}
                    {{-- @if (isset($data) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)
                                        {
                                            'label' :  '{{ $item->label ?? ' '}}',
                                            'count' :  '{{ $item->count ?? ''}}',
                                            'value' :  '{{ $item->value ?? ''}}',
                                        },
                                    @endforeach
                                ]);
                            });
                        </script>
                    @elseif (isset($data) && isset($data->$parent_ref) && $data->$parent_ref != NULL && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? ''}}',
                                                'count' :  '{{ $item->count ?? ''}}',
                                                'value' :  '{{ $item->value ?? ''}}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                'count' :  '{{ $item->count ?? ''}}',
                                                'value' :  '{{ $item->value ?? ''}}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
                            });
                        </script>
                    @endif --}}

                    @if ($repeater_values)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @if(is_array($repeater_values))
                                    @foreach ($repeater_values as $item)
                                        {
                                            '{{ $field['name'] }}' :  '{{ $item->$ref ?? '' }}',
                                            'label' :  '{{ $item->label ?? ''}}',
                                            'count' :  '{{ $item->count ?? ''}}',
                                            'value' :  '{{ $item->value ?? ''}}',
                                        },
                                    @endforeach
                                    
                                    @endif
                                ]);
                                let field = @JSON($field);
                                if (field.items_errors) {
                                    let error_key;
                                    @if(is_array($repeater_values))
                                    @foreach ($repeater_values as $key => $item)
                                        error_key = field.items_errors[{{$key}}];
                                        if(error_key) {
                                            Object.keys(error_key).forEach((key) => {
                                                $(`input[name^="${field.name}[{{$key}}][${key}]"]`).addClass('is-invalid');
                                            })
                                        }
                                    @endforeach
                                    @endif
                                }
                            });
                        </script>
                    @endif
                    {{-- *************************************************************************************************** --}}
                       @elseif (isset($field['config']['AddDoubleRepeater']))
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '4' }}">
                        <div class="kt-form__group--inline">  
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="label" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][1][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][1][0] ?? 'Quantité' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][2][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][2][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                  @if($field['config']['Select'])
                                    <select class="form-control sel" name="otherValue" >
                                        <option value="">---</option>
                                        @foreach($field['config']['options'] as $value)
                                            <option value="{{$value}}" >{{$value}}</option>
                                        @endforeach
                                    </select>

                              

                                @endif
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    {{-- **************************************************************************** --}}
                    {{-- @if (isset($data) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)
                                        {
                                            'label' :  '{{ $item->label ?? ' '}}',
                                            'value' :  '{{ $item->value ?? ''}}',
                                            'otherValue' :  '{{ $item->otherValue ?? ''}}',
                                        },
                                    @endforeach
                                ]);
                            });
                        </script>
                    @elseif (isset($data) && isset($data->$parent_ref) && $data->$parent_ref != NULL && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? ''}}',
                                                'value' :  '{{ $item->value ?? ''}}',
                                                'otherValue' :  '{{ $item->otherValue ?? ''}}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                'value' :  '{{ $item->value ?? ''}}',
                                                'otherValue' :  '{{ $item->otherValue ?? ''}}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
                            });
                        </script>
                    @endif --}}
                     @if ($repeater_values)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @if(is_array($repeater_values))
                                    @foreach ($repeater_values as $item)
                                        {
                                            '{{ $field['name'] }}' :  '{{ $item->$ref ?? '' }}',
                                            'label' :  '{{ $item->label ?? ''}}',
                                            'value' :  '{{ $item->value ?? ''}}',
                                            'otherValue' :  '{{ $item->otherValue ?? ''}}',
                                        },
                                    @endforeach
                                    
                                    @endif
                                ]);
                                let field = @JSON($field);
                                if (field.items_errors) {
                                    let error_key;
                                    @if(is_array($repeater_values))
                                    @foreach ($repeater_values as $key => $item)
                                        error_key = field.items_errors[{{$key}}];
                                        if(error_key) {
                                            Object.keys(error_key).forEach((key) => {
                                                $(`input[name^="${field.name}[{{$key}}][${key}]"]`).addClass('is-invalid');
                                            })
                                        }
                                    @endforeach
                                    @endif
                                }
                            });
                        </script>
                    @endif
                    {{-- **************************************************************************** --}}
                @elseif (isset($field['config']['quadrupleRepeater']))
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                @if($field['config']['Select'])
                                    <select class="form-control sel" name="label"  onchange="$(this).val()==='Autre à préciser'?$(this).closest('.kt-form__control').find('.pi').show():$(this).closest('.kt-form__control').find('.pi').hide()">
                                        <option value="">---</option>
                                        @foreach($field['config']['options'] as $value)
                                            <option value="{{$value}}" >{{$value}}</option>
                                        @endforeach
                                    </select>

                                    <input type="text"  name="labelOther" class="pi form-control" placeholder=""  style="display: block">
                                @else
                                    <input type="text" name="label" class="form-control" placeholder="">

                                @endif
                             </div>
                        </div>

                        <div class="d-md-none kt-margin-b-10"></div>

                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][1][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][1][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" id='montant_id' class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][2][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][2][0] ?? 'Taux' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="rate" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][3][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][3][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="duration" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>

                    @if ($repeater_values)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($repeater_values as $item)
                                        {
                                            'label' :  '{{ $item->label ?? '' }}',
                                            'labelOther' :  '{{ $item->labelOther ?? '' }}',
                                            'value' :  '{{ $item->value ?? '' }}',
                                            'rate' :  '{{ $item->rate ?? '' }}',
                                            'duration' : '{{ $item->duration ?? '' }}',
                                        },
                                    @endforeach
                                ]);
                                let field = @JSON($field);
                                if (field.items_errors) {
                                    let error_key;
                                    @foreach ($repeater_values as $key => $item)
                                        error_key = field.items_errors[{{$key}}];
                                        if(error_key) {
                                            Object.keys(error_key).forEach((key) => {
                                                $(`input[name^="${field.name}[{{$key}}][${key}]"]`).addClass('is-invalid');
                                            })
                                        }
                                    @endforeach
                                }
                            });
                        </script>
                    @endif
                      @elseif (isset($field['config']['quadrupleRepeaterofme']))
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                @if($field['config']['Select'])
                                    <select class="form-control sel" name="label"  onchange="$(this).val()==='Autre à préciser'?$(this).closest('.kt-form__control').find('.pi').show():$(this).closest('.kt-form__control').find('.pi').hide()">
                                        <option value="">---</option>
                                        @foreach($field['config']['options'] as $value)
                                            <option value="{{$value}}" >{{$value}}</option>
                                        @endforeach
                                    </select>

                                    <input type="text"  name="labelOther" class="pi form-control" placeholder=""  style="display: block">
                                    <?php
//                                    dd ($data)
                                    ?>
                                @else
                                    <input type="text" name="label" class="form-control" placeholder="">

                                @endif
                             </div>
                        </div>

                        <div class="d-md-none kt-margin-b-10"></div>

                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][1][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][1][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" id='id_q' class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][2][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                  <select class="form-control sel" name="label">
                                        <option value="">---</option>
                                            <option value="" >{{ $field['config']['attributes'][2][0] ?? 'Taux' }}</option>
                                             <option value="" >Quantité vendus (en mois)</option>
                                            <option value="" >Nombre vendus (en mois)</option>
                                    </select>
                                {{-- <label class="kt-label m-label--single">{{ $field['config']['attributes'][2][0] ?? 'Taux' }}:</label> --}}
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="rate" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][3][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][3][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="duration" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>

                    @if (isset($data) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)

                                        {
                                            'label' :  '{{ $item->label ?? '' }}',
                                            'labelOther' :  '{{ $item->labelOther ?? '' }}',
                                            'value' :  '{{ $item->value ?? '' }}',
                                            'rate' :  '{{ $item->rate ?? '' }}',
                                            'duration' : '{{ $item->duration ?? '' }}',
                                        },

                                    @endforeach
                                ]);

                            });
                        </script>
                    @elseif (isset($data) && isset($data->$parent_ref) && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {

                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();

                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                'labelOther' :  '{{ $item->labelOther ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                                'rate' :  '{{ $item->rate ?? '' }}',
                                                'duration' :  '{{ $item->duration ?? '' }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                'labelOther' :  '{{ $item->labelOther ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                                'rate' :  '{{ $item->rate ?? '' }}',
                                                'duration' :  '{{ $item->duration ?? '' }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);

                                // if($('.pi').val()!=''){
                                //     $('.pi').show()
                                // }
                            });

                        </script>
                    @endif
                   @elseif (isset($field['config']['quintupleRepeater']))
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                @if($field['config']['Select'])
                                    <select class="form-control sel" name="label"  onchange="$(this).val()==='Autre à préciser'?$(this).closest('.kt-form__control').find('.pi').show():$(this).closest('.kt-form__control').find('.pi').hide()">
                                        <option value="">---</option>
                                        @foreach($field['config']['options'] as $value)
                                            <option value="{{$value}}" >{{$value}}</option>
                                        @endforeach
                                    </select>

                                    <input type="text"  name="labelOther" class="pi form-control" placeholder=""  style="display: block">
                                    <?php
//                                    dd ($data)
                                    ?>
                                @else
                                    <input type="text" name="label" class="form-control" placeholder="">

                                @endif
{{--                                <input type="text" name="label" class="form-control" placeholder="">--}}
                            </div>
                        </div>

                        <div class="d-md-none kt-margin-b-10"></div>

                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][1][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][1][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][2][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][2][0] ?? 'Taux' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="rate" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][3][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][3][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="duration" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][4][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][4][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="organisme" class="form-control" placeholder=""></input>
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
{{-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}
                    {{-- @if (isset($data) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)

                                        {
                                            'label' :  '{{ $item->label ?? '' }}',
                                            'value' :  '{{ $item->value ?? '' }}',
                                            'rate' :  '{{ $item->rate ?? '' }}',
                                            'duration' : '{{ $item->duration ?? '' }}', 
                                            'organisme' :  '{{ $item->organisme ?? '' }}',
                                        },

                                    @endforeach
                                ]);

                            });
                        </script>
                    @elseif (isset($data) && isset($data->$parent_ref) && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {

                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();

                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                   'organisme' :  '{{ $item->organisme ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                                'rate' :  '{{ $item->rate ?? '' }}',
                                                'duration' :  '{{ $item->duration ?? '' }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                  'organisme' :  '{{ $item->organisme ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                                'rate' :  '{{ $item->rate ?? '' }}',
                                                'duration' :  '{{ $item->duration ?? '' }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);

                                // if($('.pi').val()!=''){
                                //     $('.pi').show()
                                // }
                            });

                        </script>
                    @endif --}}
 {{-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

                    @if ($repeater_values)
                                        <script>
                                            window.addEventListener('load', function() {
                                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                                $repeater.setList([
                                                    @foreach ($repeater_values as $item)
                                                        {
                                                            'label' :  '{{ $item->label ?? '' }}',
                                                            'organisme' :  '{{ $item->organisme ?? '' }}',
                                                            'value' :  '{{ $item->value ?? '' }}',
                                                            'rate' :  '{{ $item->rate ?? '' }}',
                                                            'duration' : '{{ $item->duration ?? '' }}',
                                                        },
                                                    @endforeach
                                                ]);
                                                let field = @JSON($field);
                                                if (field.items_errors) {
                                                    let error_key;
                                                    @foreach ($repeater_values as $key => $item)
                                                        error_key = field.items_errors[{{$key}}];
                                                        if(error_key) {
                                                            Object.keys(error_key).forEach((key) => {
                                                                $(`input[name^="${field.name}[{{$key}}][${key}]"]`).addClass('is-invalid');
                                                            })
                                                        }
                                                    @endforeach
                                                }
                                            });
                                        </script>
                                    @endif   
       @elseif (isset($field['config']['sextupleRepeater']))
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                @if($field['config']['Select'])
                                    <select class="form-control sel" name="label"  onchange="$(this).val()==='Autre à préciser'?$(this).closest('.kt-form__control').find('.pi').show():$(this).closest('.kt-form__control').find('.pi').hide()">
                                        <option value="">---</option>
                                        @foreach($field['config']['options'] as $value)
                                            <option value="{{$value}}" >{{$value}}</option>
                                        @endforeach
                                    </select>

                                    <input type="text"  name="labelOther" class="pi form-control" placeholder=""  style="display: block">
                                    <?php
//                                    dd ($data)
                                    ?>
                                @else
                                    <input type="text" name="label" class="form-control" placeholder="">

                                @endif
{{--                                <input type="text" name="label" class="form-control" placeholder="">--}}
                            </div>
                        </div>

                        <div class="d-md-none kt-margin-b-10"></div>

                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][1][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][1][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][2][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][2][0] ?? 'Taux' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="rate" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][3][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][3][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="duration" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                       <div class="col-md-{{ $field['config']['attributes'][4][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][4][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="otherValue" class="form-control" placeholder=""></input>
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][4][1] ?? '1' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][5][0] ?? 'Années' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="organisme" class="form-control" placeholder=""></input>
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                
{{-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!--}}
                    {{-- @if (isset($data) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)

                                        {
                                            'label' :  '{{ $item->label ?? '' }}',
                                            'value' :  '{{ $item->value ?? '' }}',
                                            'rate' :  '{{ $item->rate ?? '' }}',
                                            'duration' : '{{ $item->duration ?? '' }}', 
                                            'organisme' :  '{{ $item->organisme ?? '' }}',
                                        },

                                    @endforeach
                                ]);

                            });
                        </script>
                    @elseif (isset($data) && isset($data->$parent_ref) && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {

                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();

                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                   'organisme' :  '{{ $item->organisme ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                                'rate' :  '{{ $item->rate ?? '' }}',
                                                'duration' :  '{{ $item->duration ?? '' }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                  'organisme' :  '{{ $item->organisme ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                                'rate' :  '{{ $item->rate ?? '' }}',
                                                'duration' :  '{{ $item->duration ?? '' }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);

                                // if($('.pi').val()!=''){
                                //     $('.pi').show()
                                // }
                            });

                        </script>
                    @endif --}}
 {{-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

                    @if ($repeater_values)
                                        <script>
                                            window.addEventListener('load', function() {
                                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                                $repeater.setList([
                                                    @foreach ($repeater_values as $item)
                                                        {
                                                            'label' :  '{{ $item->label ?? '' }}',
                                                            'organisme' :  '{{ $item->organisme ?? '' }}',
                                                            'value' :  '{{ $item->value ?? '' }}',
                                                            'rate' :  '{{ $item->rate ?? '' }}',
                                                            'duration' : '{{ $item->duration ?? '' }}',
                                                            'otherValue' : '{{ $item->otherValue ?? '' }}',
                                                        },
                                                    @endforeach
                                                ]);
                                                let field = @JSON($field);
                                                if (field.items_errors) {
                                                    let error_key;
                                                    @foreach ($repeater_values as $key => $item)
                                                        error_key = field.items_errors[{{$key}}];
                                                        if(error_key) {
                                                            Object.keys(error_key).forEach((key) => {
                                                                $(`input[name^="${field.name}[{{$key}}][${key}]"]`).addClass('is-invalid');
                                                            })
                                                        }
                                                    @endforeach
                                                }
                                            });
                                        </script>
                                    @endif                      
                @else
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>{{ $field['config']['attributes'][0][0] ?? 'Désignation' }}:</label>
                            </div>
                            <div class="kt-form__control">

                                @if($field['config']['Select'])
                                <select name="label" class="form-control">
                                    <option value="">---</option>
                                    @foreach($field['config']['options'] as $value)
                                    <option value="{{$value}}" >{{$value}}</option>
                                    @endforeach
                                </select>
                                @else
                                    <input type="text" name="label" class="form-control" placeholder="">
                                @endif
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-{{ $field['config']['attributes'][0][1] ?? '3' }}">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">{{ $field['config']['attributes'][1][0] ?? 'Valeur' }}:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">

                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
  {{-- ............................................................................................................... --}}
                    {{-- @if (isset($data) && (is_array($data) || is_object($data)) && isset($data->$ref) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)
                                        {
                                            'label' :  '{{ $item->label ?? '' }}',
                                            'value' :  '{{ $item->value ?? '' }}',
                                        },
                                    @endforeach
                                ]);
                            });
                        </script>
                    @elseif (isset($data) && isset($parent_ref) && isset($data->$parent_ref) && isset($data->$parent_ref->$ref) && $data->$parent_ref->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @if (!is_array($data->$parent_ref->$ref))
                                        @foreach (json_decode($data->$parent_ref->$ref) as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label ?? '' }}',
                                                'value' :  '{{ $item->value ?? '' }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
                            });
                        </script>
                    @endif --}}
    {{--....................................................................................................... --}}
                        @if ($repeater_values)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($repeater_values as $item)
                                        {
                                            'label' :  '{{ $item->label ?? '' }}',
                                            'value' :  '{{ $item->value ?? '' }}'
                                        },
                                    @endforeach
                                ]);
                                let field = @JSON($field);
                                if (field.items_errors) {
                                    let error_key;
                                    @foreach ($repeater_values as $key => $item)
                                        error_key = field.items_errors[{{$key}}];
                                        if(error_key) {
                                            Object.keys(error_key).forEach((key) => {
                                                $(`input[name^="${field.name}[{{$key}}][${key}]"]`).addClass('is-invalid');
                                            })
                                        }
                                    @endforeach
                                }
                            });
                        </script>
                    @endif   
                @endif
                <div class="col-md-4">
                    <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                        <i class="la la-trash-o"></i>
                        Supprimer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group form-group-last row">
        <label class="col-lg-3 col-form-label"></label>
        <div class="col-lg-6">
            <a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
                <i class="la la-plus"></i> Ajouter
            </a>
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
        </div>
    </div>

</div>