<div class="form-group {{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'row' : '' }}">
    <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
    <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : 'w-100' }}">
        <select class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}Select">
            @php
                $counter = 0;
            @endphp
            @foreach($fields as $key)
                @php
                    $ref = $key['name'];
                @endphp
                @if ($key['type'] == 'select' && $key['name'] == $field['name'])
                    <div class="form-group">
                        <option value="">---</option>
                        @foreach($key['options'] as $option)
                            @if (isset($option->childs))
                                <optgroup label="{{ $option->title }}">
                                    @if (!empty($option->childs))
                                        @foreach($option->childs as $option)
                                            <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                            {{ 
                                                isset($data->$ref) ? 
                                                    (
                                                        (
                                                            isset($option->id) ? ($data->$ref == $option->id ? 'selected' : '') :   
                                                            (
                                                                isset($option->title) ? ($data->$ref == $option->title ? 'selected' : '') : 
                                                                (
                                                                    $data->$ref == $option ? 'selected' : ''
                                                                ) 
                                                            )
                                                        )
                                                    )
                                                : '' 
                                            }}
                                            
                                            >{{ $option->title ?? $option }}</option> 
                                        @endforeach	 
                                    @endif
                            </optgroup>
                            @else
                                <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                {{ 
                                    isset($data->$ref) ? 
                                        (
                                            (
                                                isset($option->id) ? ($data->$ref == $option->id ? 'selected' : '') :   
                                                (
                                                    isset($option->title) ? ($data->$ref == $option->title ? 'selected' : '') : 
                                                    (
                                                        $data->$ref == $option ? 'selected' : ''
                                                    ) 
                                                )
                                            )
                                        )
                                    : '' 
                                }}
                                
                                >{{ $option->title ?? $option }}</option> 
                            @endif
                        @endforeach	
                    </div>
                @elseif ($key['type'] == 'section')
                    @foreach ($key['sub_fields'] as $subfield)
                        @if ($subfield['type'] == 'select' && $subfield['name'] == $field['name'])
                            <div class="form-group">
                                <option value="">---</option>
                                @foreach($subfield['options'] as $option)
                                    @if (isset($option->childs))
                                        <optgroup label="{{ $option->title }}">
                                            @if (!empty($option->childs))
                                                @foreach($option->childs as $option)
                                                    <option value="{{ $option->id ?? ($option->title ?? $option) }}"
        
                                                    {{ 
                                                        isset($data->$ref) ? 
                                                            (
                                                                (
                                                                    isset($option->id) ? ($data->$ref == $option->id ? 'selected' : '') :   
                                                                    (
                                                                        isset($option->title) ? ($data->$ref == $option->title ? 'selected' : '') : 
                                                                        (
                                                                            $data->$ref == $option ? 'selected' : ''
                                                                        ) 
                                                                    )
                                                                )
                                                            )
                                                        : '' 
                                                    }}
                                                    
                                                    >{{ $option->title ?? $option }}</option> 
                                                @endforeach	 
                                            @endif
                                    </optgroup>
                                    @else
                                        <option value="{{ $option->id ?? ($option->title ?? $option) }}"
        
                                        {{ 
                                            isset($data->$ref) ? 
                                                (
                                                    (
                                                        isset($option->id) ? ($data->$ref == $option->id ? 'selected' : '') :   
                                                        (
                                                            isset($option->title) ? ($data->$ref == $option->title ? 'selected' : '') : 
                                                            (
                                                                $data->$ref == $option ? 'selected' : ''
                                                            ) 
                                                        )
                                                    )
                                                )
                                            : '' 
                                        }}
                                        
                                        >{{ $option->title ?? $option }}</option> 
                                    @endif
                                @endforeach	
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach	
        </select>
        <span class="form-text text-muted"></span>
    </div>
</div>