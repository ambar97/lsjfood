@extends('stisla.layouts.app')

@section('title')
  {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Pembeli' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">
        <a href="{{ route('pembelis.index') }}">{{ __('Pembeli') }}</a>
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
            <form action="{{ isset($d) ? route('pembelis.update', [$d->id]) : route('pembelis.store') }}"
              method="POST" enctype="multipart/form-data">

              @isset($d)
                @method('PUT')
              @endisset

              @csrf
              <div class="row">
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'nama_pembeli', 'name'=>'nama_pembeli', 'label'=>__('Nama Pembeli')])
                </div>
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'email', 'name'=>'email', 'label'=>__('Email')])
                </div>
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'no_telp', 'name'=>'no_telp', 'label'=>__('No Telp')])
                </div>
				<div class="col-md-6">
					<?php if (isset($d)) {
						$r = false;
					}else {
						$r=true;
					} ?>
                  @include('includes.form.input', ['required'=>$r, 'type'=>'file', 'accept'=>'image/*', 'id'=>'foto', 'name'=>'foto', 'label'=>__('Foto')])
                </div>
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'lat', 'name'=>'lat', 'label'=>__('Lat')])
                </div>
				<div class="col-md-6">
                  @include('includes.form.input', ['required'=>true, 'type'=>'text', 'id'=>'long', 'name'=>'long', 'label'=>__('Long')])
                </div>
				
				<div class="col-md-6">
                  @include('includes.form.textarea', ['required'=>true, 'type'=>'text', 'id'=>'alamat', 'name'=>'alamat', 'label'=>__('Alamat')])
                </div>


                <div class="col-md-12">
                  <br>
                  @include('includes.form.buttons.save-btn')
                  @include('includes.form.buttons.btn-reset',['link'=>route('pembelis.index')])
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
