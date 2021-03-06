@extends($data->count() > 0 ? 'stisla.layouts.app-table' : 'stisla.layouts.app')

@section('title')
  {{ $title = 'Kategori Produk' }}
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
              <h4><i class="fa fa-list"></i> Data {{ $title }}</h4>
              <div class="card-header-action">
                {{-- @can('Kategori Produk Impor Excel') --}}
                @include('includes.form.buttons.btn-import-excel')
                {{-- @endcan --}}
                {{-- @can('Kategori Produk Tambah') --}}
                @include('includes.form.buttons.btn-add', ['link'=>route('kategoris.create')])
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
                      <th class="text-center">{{ __('Nama Kategori') }}</th>
                      <th class="text-center">{{ __('Keterangan') }}</th>

                      <th>{{ __('Aksi') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
		<td>{{ $item->nama_kategori }}</td>
		<td>{{ $item->keterangan }}</td>

                        <td>
                          {{-- @can('Kategori Produk Ubah') --}}
                            @include('includes.form.buttons.btn-edit', ['link'=>route('kategoris.edit', [$item->id])])
                          {{-- @can('Kategori Produk Hapus') --}}
                            @include('includes.form.buttons.btn-delete', ['link'=>route('kategoris.destroy', [$item->id])])
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
          @include('includes.empty-state', ['title'=>'Data '.$title, 'icon'=>'fa fa-list','link'=>route('kategoris.create')])
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
  @include('includes.modals.modal-import-excel', ['formAction'=>route('kategoris.import-excel'),
  'downloadLink'=>route('kategoris.import-excel-example')])

@endpush
