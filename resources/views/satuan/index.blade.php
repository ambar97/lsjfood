@extends($data->count() > 0 ? 'stisla.layouts.app-table' : 'stisla.layouts.app')

@section('title')
{{ $title = 'Satuan Produk' }}
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
                    <h4><i class="fa fa-percent"></i> Data {{ $title }}</h4>
                    <div class="card-header-action">
                        {{-- @can('Satuan Produk Impor Excel') --}}
                        @include('includes.form.buttons.btn-import-excel')
                        {{-- @endcan --}}
                        {{-- @can('Satuan Produk Tambah') --}}
                        @include('includes.form.buttons.btn-add', ['link'=>route('satuans.create')])
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
                                    <th class="text-center">{{ __('Nama Satuan Produk') }}</th>
                                    <th class="text-center">{{ __('Keterangan Satuan Produk') }}</th>

                                    <th>{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->nama_satuan_produk }}</td>
                                    <td class="text-center">{{ $item->keterangan_satuan_produk }}</td>

                                    <td class="text-center">
                                        {{-- @can('Satuan Produk Ubah') --}}
                                        @include('includes.form.buttons.btn-edit', ['link'=>route('satuans.edit',
                                        [$item->id])])
                                        {{-- @can('Satuan Produk Hapus') --}}
                                        @include('includes.form.buttons.btn-delete', ['link'=>route('satuans.destroy',
                                        [$item->id])])
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
            @include('includes.empty-state', ['title'=>'Data '.$title, 'icon'=>'fa
            fa-percent','link'=>route('satuans.create')])
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
@include('includes.modals.modal-import-excel', ['formAction'=>route('satuans.import-excel'),
'downloadLink'=>route('satuans.import-excel-example')])

@endpush
