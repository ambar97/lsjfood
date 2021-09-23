<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Nama Satuan Produk') }}</th>
		<th class="text-center">{{ __('Keterangan Satuan Produk') }}</th>

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
		<td>{{ $item->nama_satuan_produk }}</td>
		<td>{{ $item->keterangan_satuan_produk }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Satuan Produk Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('satuans.edit', [$item->id])])
            {{-- @can('Satuan Produk Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('satuans.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
