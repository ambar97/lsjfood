@extends('stisla.layouts.app')

@section('title')
  {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Kategori Produk' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">
        <a href="{{ route('kategoris.index') }}">{{ __('Kategori Produk') }}</a>
      </div>
      <div class="breadcrumb-item">{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fa fa-list"></i> {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</h4>
          </div>
          <div class="card-body">
            <form action="{{ isset($d) ? route('kategoris.update', [$d->id]) : route('kategoris.store') }}"
              method="POST" enctype="multipart/form-data">

              @isset($d)
                @method('PUT')
              @endisset

              @csrf
              <div class="row">
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'nama_kategori', 'name'=>'nama_kategori', 'label'=>__('Nama Kategori')])
                </div>


                <div class="col-md-12">
                  <br>
                  @include('includes.form.buttons.save-btn')
                 @include('includes.form.buttons.btn-reset',['link'=>route('kategoris.index')])
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
