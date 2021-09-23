@extends($data->count() > 0 ? 'stisla.layouts.app-table' : 'stisla.layouts.app')

@section('title')
  {{ $title = 'Pembeli' }}
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
        @if ($data->count() > 0)
          <div class="card">
            <div class="card-header">
              <h4><i class="fa fa-archive"></i> Data {{ $title }}</h4>
              <div class="card-header-action">
                {{-- @can('Pembeli Impor Excel') --}}
                @include('includes.form.buttons.btn-import-excel')
                {{-- @endcan --}}
                {{-- @can('Pembeli Tambah') --}}
                @include('includes.form.buttons.btn-add', ['link'=>route('pembelis.create')])
                {{-- @endcan --}}
                @include('includes.form.buttons.btn-eksport')
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="datatable">
                  <thead>
                    <tr>
                      <th class="text-center">{{ __('#') }}</th>
						<th class="text-center">{{ __('Nama Pembeli') }}</th>
						<th class="text-center">{{ __('Alamat') }}</th>
						<th class="text-center">{{ __('Email') }}</th>
						<th class="text-center">{{ __('No Telp') }}</th>
						<th class="text-center">{{ __('Alamat') }}</th>
						<th class="text-center">{{ __('Foto') }}</th>
						<th class="text-center">{{ __('Lat') }}</th>
						<th class="text-center">{{ __('Long') }}</th>
						<th class="text-center">{{ __('Tgl Daftar') }}</th>

                      <th>{{ __('Lihat Lokasi') }}</th>
                      <th>{{ __('Aksi') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_pembeli }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_telp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                          <img src="{{ asset('pembeli/'. $item->foto)}}" class="img-fluid" style="width: 150px;" alt="">
                          <!-- {{ $item->foto }} -->
                        </td>
                        <td>{{ $item->lat }}</td>
                        <td>{{ $item->long }}</td>
                        <td>{{ date('d F Y H:i', strtotime($item->created_at)) }}</td>
						<td><a href="{{ route('pembelis.maps', [$item->id]) }}" class="btn btn-outline-success btn-sm"> <i class="fa fa-map-marker-alt"></i> </a></td>
                        <td>
                          {{-- @can('Pembeli Ubah') --}}
                            @include('includes.form.buttons.btn-edit', ['link'=>route('pembelis.edit', [$item->id])])
                          {{-- @can('Pembeli Hapus') --}}
                            @include('includes.form.buttons.btn-delete', ['link'=>route('pembelis.destroy', [$item->id])])
                          {{-- @endcan --}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @else
          @include('includes.empty-state', ['title'=>'Data '.$title, 'icon'=>'fa fa-archive','link'=>route('pembelis.create')])
        @endif
      </div>

    </div>
  </div>
@endsection

@push('css')

@endpush

@push('js')

@endpush

@push('scripts')
  <script>

  </script>
@endpush

@push('modals')
  @include('includes.modals.modal-import-excel', ['formAction'=>route('customers.import-excel'),
  'downloadLink'=>route('customers.import-excel-example')])

@endpush
