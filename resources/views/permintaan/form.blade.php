@extends('stisla.layouts.app')

@section('title')
{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Permintaan Produk' }}
@endsection

@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
            <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
        </div>
        <div class="breadcrumb-item active">
            <a href="{{ route('permintaans.index') }}">{{ __('Permintaan Produk') }}</a>
        </div>
        <div class="breadcrumb-item">{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa fa-hand-lizard-o"></i> {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($d) ? route('permintaans.update', [$d->id]) : route('permintaans.store') }}"
                        method="POST" enctype="multipart/form-data">

                        @isset($d)
                        @method('PUT')
						<input type="hidden" value="{{$d->id}}" name="id_permintaan">
                        @endisset

                        @csrf
                        <div class="row barang">
                            @if(isset($d) )
                            @foreach($data as $item)
                            <div class="col-md-12 row {{ $loop->iteration == '2' ? 'barangdata':'' }}">
                                <div class="col-md-5">
                                    <small>Nama Barang</small>
                                    <input type="text" class="form-control" name="nama_barang[]"
                                        value="{{ isset($d) ? $item->nama_barang:'' }}" id="nama_barang" required>
                                </div>
                                <div class="col-md-5">
                                    <small>Kuantitas</small>
                                    <input type="text" class="form-control" name="kuantitas[]" id="kuantitas"
                                        value="{{ isset($d) ? $item->qty:'' }}" required>
                                </div>
                                <div class="col-md-2">
                                    <br><br>
                                    <button type="button" id="tambah-barang"
                                        class="btn {{ $loop->iteration == '2' ? 'btn-danger' : 'btn-primary' }} btn-sm"
                                        onClick="{{ $loop->iteration == '1' ? 'tambahData()' : 'hapusData(this)' }}"><i
                                            class="{{ $loop->iteration == '2' ? 'fa fa-minus' : 'fa fa-plus' }}"></i></button>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-md-12 row">
                                <div class="col-md-5">
                                    <small>Nama Barang</small>
                                    <input type="text" class="form-control" name="nama_barang[]" value=""
                                        id="nama_barang" required>
                                </div>
                                <div class="col-md-5">
                                    <small>Kuantitas</small>
                                    <input type="text" class="form-control" name="kuantitas[]" id="kuantitas" value=""
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <br><br>
                                    <button type="button" id="tambah-barang" class="btn btn-primary btn-sm"
                                        onClick="tambahData()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <br>
                            @include('includes.form.buttons.save-btn')
                            @include('includes.form.buttons.btn-reset',['link'=>route('permintaans.index')])
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@push('css')

@endpush

@push('js')
<script>
    function tambahData() {
        $('.barang').append('<div class="col-md-12 row barangdata"><div class="col-md-5">' +
            '<small>Nama Barang</small>' +
            '<input type="text" class="form-control" name="nama_barang[]" id="nama_barang">' +
            '</div>' +
            '<div class="col-md-5">' +
            '<small>Kuantitas</small>' +
            '<input type="text" class="form-control" name="kuantitas[]" id="kuantitas">' +
            '</div>' +
            '<div class="col-md-2">' +
            '<br><br>' +
            '<button type="button" id="tambah-barang" class="btn btn-danger btn-sm" onClick="hapusData(this)"><i class="fa fa-minus"></i></button>' +
            '</div></div>');
    }

	function hapusData(e) {
         $(e).parents('.barangdata').remove();
    }
</script>
@endpush
