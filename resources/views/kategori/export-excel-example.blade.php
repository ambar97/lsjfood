<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Nama Kategori') }}</th>
		<th class="text-center">{{ __('Keterangan') }}</th>

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
		<td>{{ $item->nama_kategori }}</td>
		<td>{{ $item->keterangan }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Kategori Produk Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('kategoris.edit', [$item->id])])
            {{-- @can('Kategori Produk Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('kategoris.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
