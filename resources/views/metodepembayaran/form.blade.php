@extends('stisla.layouts.app')

@section('title')
  {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Metode Pembayaran' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">
        <a href="{{ route('metodepembayarans.index') }}">{{ __('Metode Pembayaran') }}</a>
      </div>
      <div class="breadcrumb-item">{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fas fa-handshake"></i> {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</h4>
          </div>
          <div class="card-body">
            <form action="{{ isset($d) ? route('metodepembayarans.update', [$d->id]) : route('metodepembayarans.store') }}"
              method="POST" enctype="multipart/form-data">

              @isset($d)
                @method('PUT')
              @endisset

              @csrf
              <div class="row">
				        <div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'nama_metode', 'name'=>'nama_metode', 'label'=>__('Nama Metode')])
                </div>
                <div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'no_rekening', 'name'=>'no_rekening', 'label'=>__('No Rekening')])
                </div>
                <div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'atas_nama', 'name'=>'atas_nama', 'label'=>__('Atas Nama')])
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
