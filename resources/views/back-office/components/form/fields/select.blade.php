<label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
<select class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}Select">
    @foreach($fields as $key)
        @if($key['type'] == 'select' && $key['name'] == $field['name'])
            <div class="form-group">
                <option value="">---</option>
                @foreach($key['options'] as $option)
                    @if (isset($option->childs))
                        <optgroup label="{{ $option->title }}">
                            @if (!empty($option->childs))
                                @foreach($option->childs as $option)
                                    <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                    {{ 
                                        isset($data->role) ? 
                                            (
                                                (
                                                    isset($option->id) ? ($data->role == $option->id ? 'selected' : '') :   
                                                    (
                                                        isset($option->title) ? ($data->role == $option->title ? 'selected' : '') : 
                                                        (
                                                            $data->role == $option ? 'selected' : ''
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
                            isset($data->role) ? 
                                (
                                    (
                                        isset($option->id) ? ($data->role == $option->id ? 'selected' : '') :   
                                        (
                                            isset($option->title) ? ($data->role == $option->title ? 'selected' : '') : 
                                            (
                                                $data->role == $option ? 'selected' : ''
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
</select>
<span class="form-text text-muted"></span>