@extends('stisla.layouts.app')

@section('title')
  {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Produk' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">
        <a href="{{ route('produks.index') }}">{{ __('Produk') }}</a>
      </div>
      <div class="breadcrumb-item">{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fa fa-archive"></i> {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</h4>
          </div>
          <div class="card-body">
            <form action="{{ isset($d) ? route('produks.update', [$d->id]) : route('produks.store') }}"
              method="POST" enctype="multipart/form-data">

              @isset($d)
                @method('PUT')
              @endisset

              @csrf
              <div class="row">
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'nama_produk', 'name'=>'nama_produk', 'label'=>__('Nama Produk')])
                </div>

				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'number', 'id'=>'isi', 'name'=>'isi', 'label'=>__('Isi'), 'min'=>0])
                </div>

				<div class="col-md-6">
                  @include('includes.form.select', ['required'=>true, 'id'=>'satuan', 'name'=>'satuan', 'label'=>__('Satuan'), 'options'=>[""]])
                </div>

				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'file', 'accept'=>'image/*', 'id'=>'image', 'name'=>'image', 'label'=>__('Image')])
                </div>

				<div class="col-md-6">
                  @include('includes.form.select', ['required'=>true, 'id'=>'kategori', 'name'=>'kategori', 'label'=>__('Kategori'), 'options'=>[""]])
                </div>


                <div class="col-md-12">
                  <br>
                  @include('includes.form.buttons.save-btn')
                  @include('includes.form.buttons.btn-reset')
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
