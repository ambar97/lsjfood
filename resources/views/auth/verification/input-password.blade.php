<div class="form-group">
  <label for="password">Password
    <span class="text-danger">*</span>
  </label>
  <div class="float-right">
    <a href="auth-forgot-password.html" class="text-small">
      {{ __('Lupa Password?') }}
    </a>
  </div>
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text {{ $errors->has('password') ? 'border-danger' : '' }}">
        <i class="fas fa-key"></i>
      </div>
    </div>
    <input id="password" name="password" value="" required="" type="password"
      class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" aria-autocomplete="list">
  </div>
  @error('password')
    <div id="password-error-feedback" class="text-danger" for="password">
      {{ $message }}
    </div>
  @enderror
</div>
