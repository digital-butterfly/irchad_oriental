<div class="form-group {{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'row' : '' }}">
    <label for="{{ $field['name'] }}" class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-3 col-form-label' : '' }}">{{ $field['label'] }}:</label>
    <div class="{{ (isset($field['config']) && $field['config']['hotizontalRows']) ? 'col-lg-6' : 'w-100' }}">
        <input type="date" id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="form-control" placeholder="{{ $field['label'] }}" value="{{ isset($field['parent_name']) && isset($data) ? ($data->{$field['parent_name']}->{$field['name']}) : (isset($data) && isset($data->{$field['name']}) ? $data->{$field['name']}->format('Y-m-d') : '') }}">
        <span class="form-text text-muted"></span>
    </div>
</div>