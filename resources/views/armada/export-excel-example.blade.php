<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Nama Armada') }}</th>
		<th class="text-center">{{ __('Nama Driver') }}</th>
		<th class="text-center">{{ __('Plat Nomor') }}</th>

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
		<td>{{ $item->nama_armada }}</td>
		<td>{{ $item->nama_driver }}</td>
		<td>{{ $item->plat_nomor }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Armada Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('armadas.edit', [$item->id])])
            {{-- @can('Armada Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('armadas.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
