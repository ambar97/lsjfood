<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Nama Produk') }}</th>
		<th class="text-center">{{ __('Isi') }}</th>
		<th class="text-center">{{ __('Harga') }}</th>
		<th class="text-center">{{ __('Satuan') }}</th>
		<th class="text-center">{{ __('Keterangan') }}</th>
		<th class="text-center">{{ __('Image') }}</th>
		<th class="text-center">{{ __('Kategori') }}</th>

      @if ($isExport === false)
        <th>{{ __('Aksi') }}</th>
      @endif
    </tr>
  </thead>
  <tbody>

    @foreach ($data as $item)
      <tr>
        @if ($isExport === false)
          <td>{{ $loop->iteration }}</td>
        @endif
		<td>{{ $item->nama_produk }}</td>
		<td>{{ $item->isi }}</td>
		<td>{{ $item->harga }}</td>
		<td>{{ $item->satuan }}</td>
		<td>{{ $item->keterangan }}</td>
		<td>{{ $item->image }}</td>
		<td>{{ $item->kategori }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Produk Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('produks.edit', [$item->id])])
            {{-- @can('Produk Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('produks.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
