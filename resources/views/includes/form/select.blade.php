
<div class="form-group">
  <label @isset($id) for="{{ $id }}" @endisset>
    {{ $label }}
    @if ($required ?? false) <span class="text-danger">*</span> @endif
  </label>

  <div class="input-group">
       
      <select @if ($multiple ?? false) multiple @endif 
      name="{{ $name ?? ($multiple ?? false ? $id . '[]' : $id) }}" @isset($id) id="{{ $id }}" @endisset required
      class="form-control {{ $select2 ?? false ? 'select2' : '' }}" @if ($required ?? true) required @endif>
     <option value="" selected disabled>Pilih</option> 
      @foreach ($options as $value => $text)
        @if ($multiple ?? false)
          <option @if (in_array($value, $selected ?? (old($name ?? $id) ?? ($d[$name ?? $id] ?? [])))) selected
            @endif
            value="{{ $value }}">{{ $text }}</option>
        @else
          <option @if (($selected ?? (old($name ?? $id) ?? ($d[$name ?? $id] ?? false)))==$value) selected  @endif
            value="{{ $value }}">{{ $text }}</option>
        @endif
  
      @endforeach
    </select>
    @error($name ?? $id)
        <div id="{{ $name ?? $id }}-error-feedback" class="text-danger" for="{{ $name ?? $id }}">
          {{ $message }}
        </div>
      @enderror
        
      </div>




  
</div>
