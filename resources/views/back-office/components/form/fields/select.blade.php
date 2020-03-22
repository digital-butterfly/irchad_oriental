<label for="{{ $field['name'] }}">{{ $field['label'] }}:</label>
<select class="form-control" name="{{ $field['name'] }}" id="{{ $field['name'] }}Select">
    @foreach($fields as $field)
        @if($field['type'] == 'select' )
            <div class="form-group">
                <option value="">---</option>
                @foreach($field['options'] as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                @endforeach	
            </div>
        @endif
    @endforeach	
</select>
<span class="form-text text-muted"></span>