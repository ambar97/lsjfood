@extends($data->count() > 0 ? 'stisla.layouts.app-table' : 'stisla.layouts.app')

@section('title')
  {{ $title = 'Permintaan Produk' }}
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
              <h4><i class="fa fa-hand-lizard-o"></i> Data {{ $title }}</h4>
              <div class="card-header-action">
                <!-- {{-- @can('Permintaan Produk Impor Excel') --}}
                @include('includes.form.buttons.btn-import-excel')
                {{-- @endcan --}} -->
                {{-- @can('Permintaan Produk Tambah') --}}
                @include('includes.form.buttons.btn-add', ['link'=>route('permintaans.create')])
                {{-- @endcan --}}
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="datatable">
                  <thead>
                    <tr>
                      <th class="text-center">{{ __('#') }}</th>
                      <th class="text-center">{{ __('Id Permintaan') }}</th>
                      <th class="text-center">{{ __('Jumlah Permintaan') }}</th>
                      <th class="text-center">{{ __('Tanggal') }}</th>
                      <th class="text-center">{{ __('Detail Permintaan') }}</th>
                      <th class="text-center">{{ __('Cetak Form') }}</th>
                      <th>{{ __('Aksi') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                      <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $item->id_permintaan }}</td>
                        <td class="text-center">{{ $item->jumlah_permintaan }} item</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal{{$item->id}}"><i class="fa fa-eye"></i></button></td>
                        <td class="text-center"><a href="{{ route('permintaans.eksport') }}" class="btn btn-primary btn-sm" ><i class="fa fa-print"></i></a></td>
                        <td>
                          {{-- @can('Permintaan Produk Ubah') --}}
                            @include('includes.form.buttons.btn-edit', ['link'=>route('permintaans.edit', [$item->id])])
                          {{-- @can('Permintaan Produk Hapus') --}}
                            @include('includes.form.buttons.btn-delete', ['link'=>route('permintaans.destroy', [$item->id])])
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
          @include('includes.empty-state', ['title'=>'Data '.$title, 'icon'=>'fa fa-hand-lizard','link'=>route('permintaans.create')])
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
  @include('includes.modals.modal-import-excel', ['formAction'=>route('permintaans.import-excel'),
  'downloadLink'=>route('permintaans.import-excel-example')])

@endpush
