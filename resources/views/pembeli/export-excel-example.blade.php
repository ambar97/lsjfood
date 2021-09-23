<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Nama Pembeli') }}</th>
		<th class="text-center">{{ __('Alamat') }}</th>
		<th class="text-center">{{ __('Email') }}</th>
		<th class="text-center">{{ __('No Telp') }}</th>
		<th class="text-center">{{ __('Alamat') }}</th>
		<th class="text-center">{{ __('Foto') }}</th>
		<th class="text-center">{{ __('Lat') }}</th>
		<th class="text-center">{{ __('Long') }}</th>

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
		<td>{{ $item->nama_pembeli }}</td>
		<td>{{ $item->alamat }}</td>
		<td>{{ $item->email }}</td>
		<td>{{ $item->no_telp }}</td>
		<td>{{ $item->alamat }}</td>
		<td>{{ $item->foto }}</td>
		<td>{{ $item->lat }}</td>
		<td>{{ $item->long }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Pembeli Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('pembelis.edit', [$item->id])])
            {{-- @can('Pembeli Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('pembelis.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
