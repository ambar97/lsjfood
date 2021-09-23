@extends('stisla.layouts.app')

@section('title')
{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Satuan Produk' }}
@endsection

@section('content')
<div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
            <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
        </div>
        <div class="breadcrumb-item active">
            <a href="{{ route('satuans.index') }}">{{ __('Satuan Produk') }}</a>
        </div>
        <div class="breadcrumb-item">{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa fa-percent"></i> {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($d) ? route('satuans.update', [$d->id]) : route('satuans.store') }}"
                        method="POST" enctype="multipart/form-data">

                        @isset($d)
                        @method('PUT')
                        @endisset

                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @include('includes.form.input', ['required'=>true, 'type'=>'text',
                                'id'=>'nama_satuan_produk', 'name'=>'nama_satuan_produk', 'label'=>__('Nama Satuan
                                Produk')])
                            </div>

                            <div class="col-md-6">
                                @include('includes.form.input', ['required'=>false, 'type'=>'text',
                                'id'=>'keterangan_satuan_produk', 'name'=>'keterangan_satuan_produk',
                                'label'=>__('Keterangan Satuan Produk')])
                            </div>


                            <div class="col-md-12">
                                <br>
                                @include('includes.form.buttons.save-btn')
                                @include('includes.form.buttons.btn-reset',['link'=>route('satuans.index')])
                            </div>
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

@endpush
