<table class="table table-striped" id="datatable">
  <thead>
    <tr>
      @if ($isExport === false)
        <th class="text-center">{{ __('#') }}</th>
      @endif
		<th class="text-center">{{ __('Nama Metode') }}</th>
		<th class="text-center">{{ __('No Rekening') }}</th>
		<th class="text-center">{{ __('Atas Nama') }}</th>

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
		<td>{{ $item->nama_metode }}</td>
		<td>{{ $item->no_rekening }}</td>
		<td>{{ $item->atas_nama }}</td>

        @if ($isExport === false)
          <td>
            {{-- @can('Metode Pembayaran Ubah') --}}
              @include('includes.form.buttons.btn-edit', ['link'=>route('metodes.edit', [$item->id])])
            {{-- @can('Metode Pembayaran Hapus') --}}
              @include('includes.form.buttons.btn-delete', ['link'=>route('metodes.destroy', [$item->id])])
            {{-- @endcan --}}
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
