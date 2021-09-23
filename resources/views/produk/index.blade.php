@extends($data->count() > 0 ? 'stisla.layouts.app-table' : 'stisla.layouts.app')

@section('title')
  {{ $title = 'Produk' }}
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
                {{-- @can('Produk Impor Excel') --}}
                @include('includes.form.buttons.btn-import-excel')
                {{-- @endcan --}}
                {{-- @can('Produk Tambah') --}}
                @include('includes.form.buttons.btn-add', ['link'=>route('produks.create')])
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
		<th class="text-center">{{ __('Nama Produk') }}</th>
		<th class="text-center">{{ __('Isi') }}</th>
		<th class="text-center">{{ __('Harga') }}</th>
		<th class="text-center">{{ __('Satuan') }}</th>
		<th class="text-center">{{ __('Keterangan') }}</th>
		<th class="text-center">{{ __('Image') }}</th>
		<th class="text-center">{{ __('Kategori') }}</th>

                      <th>{{ __('Aksi') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
		<td>{{ $item->nama_produk }}</td>
		<td>{{ $item->isi }}</td>
		<td>{{ $item->harga }}</td>
		<td>{{ $item->satuan }}</td>
		<td>{{ $item->keterangan }}</td>
		<td>{{ $item->image }}</td>
		<td>{{ $item->kategori }}</td>

                        <td>
                          {{-- @can('Produk Ubah') --}}
                            @include('includes.form.buttons.btn-edit', ['link'=>route('produks.edit', [$item->id])])
                          {{-- @can('Produk Hapus') --}}
                            @include('includes.form.buttons.btn-delete', ['link'=>route('produks.destroy', [$item->id])])
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
          @include('includes.empty-state', ['title'=>'Data '.$title, 'icon'=>'fa fa-archive','link'=>route('produks.create')])
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
  @include('includes.modals.modal-import-excel', ['formAction'=>route('produks.import-excel'),
  'downloadLink'=>route('produks.import-excel-example')])

@endpush
