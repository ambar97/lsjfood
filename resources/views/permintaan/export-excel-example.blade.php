<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Id Permintaan') }}</th>
		<th class="text-center">{{ __('Id User') }}</th>
		<th class="text-center">{{ __('Jumlah Permintaan') }}</th>

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
		<td>{{ $item->id_permintaan }}</td>
		<td>{{ $item->id_user }}</td>
		<td>{{ $item->jumlah_permintaan }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Permintaan Produk Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('permintaans.edit', [$item->id])])
            {{-- @can('Permintaan Produk Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('permintaans.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
