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

                                            @if (old($field['name'])))
                                                @if (isset($option->id))
                                                    {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                                @elseif (isset($option->title))
                                                    {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                                @else
                                                    {{ old($field['name']) == $option ? 'selected' : '' }}
                                                @endif
                                            @elseif (isset($data->$ref))
                                                @if (isset($option->id))
                                                    {{ $data->$ref == $option->id ? 'selected' : '' }}
                                                @elseif (isset($option->title))
                                                    {{ $data->$ref == $option->title ? 'selected' : '' }}
                                                @else
                                                    {{ $data->$ref == $option ? 'selected' : '' }}
                                                @endif
                                            @endif

                                            >{{ $option->title ?? $option }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            @else
                                <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                    @if (old($field['name']))
                                        @if (isset($option->id))
                                            {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                        @elseif (isset($option->title))
                                            {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                        @else
                                            {{ old($field['name']) == $option ? 'selected' : '' }}
                                        @endif
                                    @elseif (isset($data->$ref))
                                        @if (isset($option->id))
                                            {{ $data->$ref == $option->id ? 'selected' : '' }}
                                        @elseif (isset($option->title))
                                            {{ $data->$ref == $option->title ? 'selected' : '' }}
                                        @else
                                            {{ $data->$ref == $option ? 'selected' : '' }}
                                        @endif
                                    @endif


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
                                    @php
                                        $sub_ref = $subfield['name'];
                                    @endphp
                                    @if (isset($option->childs))
                                        <optgroup label="{{ $option->title }}">
                                            @if (!empty($option->childs))
                                                @foreach($option->childs as $option)
                                                    <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                                        @if (old($field['name']))
                                                            @if (isset($option->id))
                                                                {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                                            @elseif (isset($option->title))
                                                                {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                                            @else
                                                                {{ old($field['name']) == $option ? 'selected' : '' }}
                                                            @endif
                                                        @elseif (isset($data->$ref))
                                                            @if (isset($option->id))
                                                                {{ $data->$ref == $option->id ? 'selected' : '' }}
                                                            @elseif (isset($option->title))
                                                                {{ $data->$ref == $option->title ? 'selected' : '' }}
                                                            @else
                                                                {{ $data->$ref == $option ? 'selected' : '' }}
                                                            @endif
                                                        @endif

                                                    >{{ $option->title ?? $option }}</option>
                                                @endforeach
                                            @endif
                                        </optgroup>
                                    @else
                                        <option value="{{ $option->id ?? ($option->title ?? $option) }}"

                                        @if (old($field['name']))
                                            @if (isset($option->id))
                                                {{ old($field['name']) == $option->id ? 'selected' : '' }}
                                            @elseif (isset($option->title))
                                                {{ old($field['name']) == $option->title ? 'selected' : '' }}
                                            @else
                                                {{ old($field['name']) == $option ? 'selected' : '' }}
                                            @endif
                                        @elseif (isset($data->$ref->$sub_ref))
                                            @if (isset($option->id))
                                                {{ $data->$ref->$sub_ref == $option->id ? 'selected' : '' }}
                                            @elseif (isset($option->title))
                                                {{ $data->$ref->$sub_ref == $option->title ? 'selected' : '' }}
                                            @else
                                                {{ $data->$ref->$sub_ref == $option ? 'selected' : '' }}
                                            @endif
                                        @elseif (isset($data->$ref))
                                            @if (isset($option->id))
                                                {{ $data->$ref == $option->id ? 'selected' : '' }}
                                            @elseif (isset($option->title))
                                                {{ $data->$ref == $option->title ? 'selected' : '' }}
                                            @else
                                                {{ $data->$ref == $option ? 'selected' : '' }}
                                            @endif
                                        @endif

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
