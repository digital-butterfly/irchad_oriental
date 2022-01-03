@php
    $field_value = '';
    if (isset($data)) {
        if (isset($field['parent_name'])) {
            if(isset($data->{$field['parent_name']}->{$field['name']}))
            {
                $field_value = $data->{$field['parent_name']}->{$field['name']};
            }else{
                $field_value = "";
            }
            
        }
        else {
            $field_value = $data->{$field['name']};
        }
    }
@endphp
<form enctype="multipart/form-data" method="post" action="{{ route('session.store') }}" >
<div class="form-group {{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'row' : '' }}">
    <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
    <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : 'w-100' }}">
        <input type="file" id="{{ $field['name'] }}" name="file" class="form-control" placeholder="{{ $field['label'] }}" value="{{ old($field['name']) ?? $field_value }}" >
        <span class="form-text text-muted"></span>
    </div>
</div>
</form>