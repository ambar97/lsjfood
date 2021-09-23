@extends('stisla.layouts.app-table')

@section('title')
  {{ $title = 'Data Role' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fa fa-users"></i> {{ $title }}</h4>
            <div class="card-header-action">
                
                {{-- @can('Satuan Tambah') --}}
                @include('includes.form.buttons.btn-add', ['link'=>route('user-management.roles.create')])
                {{-- @endcan --}}
                <!-- @include('includes.form.buttons.btn-eksport') -->
              </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Aksi') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        {{ $item->name }}
                      </td>
                      <td>
                        @include('includes.form.buttons.btn-edit', ['link'=>route('user-management.roles.edit',
                        [$item->id])])
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
