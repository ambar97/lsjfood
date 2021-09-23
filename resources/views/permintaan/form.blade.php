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
            <h4><i class="fa fa-hand-lizard-o"></i> {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</h4>
          </div>
          <div class="card-body">
            <form action="{{ isset($d) ? route('permintaans.update', [$d->id]) : route('permintaans.store') }}"
              method="POST" enctype="multipart/form-data">

              @isset($d)
                @method('PUT')
              @endisset

              @csrf
              <div class="row barang">
					<div class="col-md-5">
					@include('includes.form.input', ['required'=>true,'type'=>'string', 'id'=>'nama_barang', 'name'=>'nama_barang', 'label'=>__('Nama Barang'), 'min'=>0])
					</div>
					<div class="col-md-5">
					@include('includes.form.input', ['required'=>true,  'type'=>'number', 'id'=>'kuantitas', 'name'=>'kuantitas', 'label'=>__('Kuantitas'), 'min'=>0])
					</div>
					<div class="col-md-2">
						<br><br>
						<button type="button" id="tambah-barang" class="btn btn-primary btn-sm" onClick="tambahData()"><i class="fa fa-plus"></i></button>
					</div>
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
		$('.barang').append('<div class="col-md-5">'+
					
					'</div>'+
					'<div class="col-md-5">'+
					
					'</div>'+
					'<div class="col-md-2">'+
						'<br><br>'+
						'<button type="button" id="tambah-barang" class="btn btn-primary btn-sm" onClick="tambahData()"><i class="fa fa-plus"></i></button>'+
					'</div>');
	}
</script>
@endpush
