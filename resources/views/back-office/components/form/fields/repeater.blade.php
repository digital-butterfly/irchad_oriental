
    
{{-- <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : '' }}">
    
    <span class="form-text text-muted"></span>
</div> --}}
@php
    $ref = $field['name'];
    isset($field['parent_name']) ? $parent_ref = $field['parent_name'] : NULL;
@endphp

<div class="kt_repeater_{{ $field['name'] }}">

    <div class="form-group form-group-last row">
        <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && isset($field['config']['hotizontalRows']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
        <div data-repeater-list="{{ $field['name'] }}" class="col-lg-9">
            <div data-repeater-item="" class="form-group row align-items-center">
                @if (!(isset($field['config']['doubleRepeater'])) && !(isset($field['config']['tripleRepeater'])) && !(isset($field['config']['quadrupleRepeater'])))
                    <div class="col-md-8">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__control">
                                <input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['label'] }}" value="{{ $data->{$field['name']} ?? '' }}">
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    @if (isset($data) && $data->$ref != NULL)
                        <script>
                            window.addEventListener('load', function() {
                                var $repeater = $('.kt_repeater_{{ $field['name'] }}').repeater();
                                $repeater.setList([
                                    @foreach ($data->$ref as $item)
                                        {
                                            '{{ $field['name'] }}' :  '{{ $item->$ref }}',
                                        },
                                    @endforeach
                                ]);
                            });
                        </script>
                    @endif
                @elseif (isset($field['config']['tripleRepeater']))
                    <div class="col-md-4">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Désignation:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="label" class="form-control" placeholder=""> 
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-1">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Quantité:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="count" class="form-control" placeholder=""> 
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">Valeur:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">   
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
                                            'label' :  '{{ $item->label }}',
                                            'count' :  '{{ $item->count }}',
                                            'value' :  '{{ $item->value }}',
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
                                                'label' :  '{{ $item->label }}',
                                                'count' :  '{{ $item->count }}',
                                                'value' :  '{{ $item->value }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label }}',
                                                'count' :  '{{ $item->count }}',
                                                'value' :  '{{ $item->value }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
                            });
                        </script>
                    @endif
                @elseif (isset($field['config']['quadrupleRepeater']))
                    <div class="col-md-4">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Désignation:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="label" class="form-control" placeholder=""> 
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-2">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Valeur:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder=""> 
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-1">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">Taux:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="rate" class="form-control" placeholder="">   
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-1">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">Années:</label>
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
                                            'label' :  '{{ $item->label }}',
                                            'value' :  '{{ $item->value }}',
                                            'rate' :  '{{ $item->rate }}',
                                            'duration' :  '{{ $item->duration }}',
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
                                                'label' :  '{{ $item->label }}',
                                                'value' :  '{{ $item->value }}',
                                                'rate' :  '{{ $item->rate }}',
                                                'duration' :  '{{ $item->duration }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label }}',
                                                'value' :  '{{ $item->value }}',
                                                'rate' :  '{{ $item->rate }}',
                                                'duration' :  '{{ $item->duration }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
                            });
                        </script>
                    @endif
                @else
                    <div class="col-md-4">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label>Désignation:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="label" class="form-control" placeholder=""> 
                            </div>
                        </div>
                        <div class="d-md-none kt-margin-b-10"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="kt-form__group--inline">
                            <div class="kt-form__label">
                                <label class="kt-label m-label--single">Valeur:</label>
                            </div>
                            <div class="kt-form__control">
                                <input type="text" name="value" class="form-control" placeholder="">   
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
                                            'label' :  '{{ $item->label }}',
                                            'value' :  '{{ $item->value }}',
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
                                                'label' :  '{{ $item->label }}',
                                                'value' :  '{{ $item->value }}',
                                            },
                                        @endforeach
                                    @else
                                        @foreach ($data->$parent_ref->$ref as $item)
                                            {
                                                'label' :  '{{ $item->label }}',
                                                'value' :  '{{ $item->value }}',
                                            },
                                        @endforeach
                                    @endif
                                ]);
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