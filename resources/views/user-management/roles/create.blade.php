@extends('stisla.layouts.app-table')

@section('title')
  {{ __('Ubah') }} {{ $title = 'Data Role' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">
        <a href="{{ route('user-management.roles.index') }}">{{ __('Role') }}</a>
      </div>
      <div class="breadcrumb-item">{{ __('Tambah') }} {{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fa fa-users"></i> {{ __('Tambah') }} {{ $title }}</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('user-management.roles.store') }}" method="POST" id="submited">
              @method('POST')
              @csrf
              <div class="row">
                <div class="col-md-12">
                  @include('includes.form.input-name',['required'=>true, 'icon'=>false])
                </div>
                <div class="col-md-12">
                  <h5>Hak akses</h5>
                </div>
                @foreach ($permissions as $item)
                  <div class="col-md-3">
                    <label class="colorinput d-flex align-items-center">
                      <div class="checkbox-group required">
                        <input name="permissions[]" value="{{ $item->id }}" type="checkbox" class="colorinput-input"/>
                        <span class="colorinput-color bg-primary"></span>
                      </div>
                      &nbsp;&nbsp;
                      {{ $item->name }}
                    </label>
                  </div>
                @endforeach

                {{-- @if ($d->name !== 'superadmin') --}}
                <div class="col-md-12">
                  <br>
                  <button class="btn btn-primary save"> <i class="fa fa-ceck"></i> Simpan</button>
                  @include('includes.form.buttons.btn-reset',['link'=>route('user-management.roles.index')])
                </div>
                {{-- @endif --}}
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  <script>
    // Gets a reference to the form element
var form = document.getElementById('submited');

// Adds a listener for the "submit" event.
form.addEventListener('submit', function(e) {
  var a = $('div.checkbox-group.required :checkbox:checked').length;
  if (a == 0) {
    alert('Pilih Hak akses');
    e.preventDefault();
  }

});
  </script>
@endsection
