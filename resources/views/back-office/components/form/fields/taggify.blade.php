@php
    $field_value = '';
    if (isset($data)) {
        if (isset($field['parent_name'])) {
            $field_value = $data->{$field['parent_name']}->{$field['name']};
        }
        else {
            $field_value = $data->{$field['name']};
        }
    }

@endphp
<div class="form-group {{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'row' : '' }}">
    <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
    <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : 'w-100' }}">


        {{-- <input id="kt_tagify_1" name="{{ $field['name'] }}" class="tagify__input form-control" placeholder="{{ $field['label'] }}" value="{{ old($field['name']) ?? $field_value }}" data-blacklist=''> --}}
         <input  id="{{$field['id'] }}" name="{{ $field['name'] }}" class="tagify__input form-control" placeholder="{{ $field['label'] }}" value="{{$field['value'] ?? $field_value }}"  data-blacklist=''>
        {{-- <input id="kt_tagify_1" name="{{ $field['name'] }}" class="tagify__input form-control" placeholder="{{ $field['label'] }}" value='[{"member_id":14,"value":"hamid achrboukh"},{"member_id":15,"value":"elmehdi khlifii"}]'  data-blacklist=''> --}}

        {{-- <input id="kt_tagify_1" name="{{ $field['name'] }}" class="tagify__input form-control" placeholder="{{ $field['label'] }}" value="{{ $field['value'] }}" data-blacklist=''> --}}

        <span class="form-text text-muted"></span>
    </div>
</div>

