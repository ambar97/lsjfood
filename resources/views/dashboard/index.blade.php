@extends(config('app.template').'.layouts.app')

@section('title')
Dashboard
@endsection

@if (config('app.template') === 'stisla')
@section('content')

<div class="section-header">
    <h1>{{ __('Dashboard') }}</h1>
</div>
<div class="row">
    <div class="col-12 mb-4">
        <div class="hero text-white hero-bg-image"
            data-background="{{ \App\Models\Setting::where('key', 'stisla_bg_home')->first()->value }}">
            <div class="hero-inner">
                <h2>{{ __('Selamat Datang') }}, {{ Auth::user()->name ?? 'Your Name' }}</h2>
                <p class="lead">{{ \App\Models\Setting::where('key', 'app_description')->first()->value }}</p>

                @if (auth()->check())
                <div class="mt-4">
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-white btn-lg btn-icon icon-left">
                        <i class="far fa-user"></i> {{ __('Lihat Profil') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    @foreach (range(1, 4) as $item)
    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-{{ $bg ?? 'primary' }}">
                <i class="fas fa-{{ $ikon ?? 'fire' }}"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ $judul_widget ?? 'Nama ' }}</h4>
                </div>
                <div class="card-body">
                    {{ $jumlah_data ?? $loop->iteration . '00' }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="card">
        <div class="card-body">
            <canvas id="canvas" height="280" width="600"></canvas>
        </div>
    </div>
</div>

@endsection
@else

@section('content')

<div class="container-fluid">
    <div class="block-header">
        <h2>BLANK PAGE</h2>
    </div>

</div>
@endsection
@endif

@push('css')

@endpush

@push('js')

@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var year = <?php echo $year; ?> ;
    var user = <?php echo $user; ?> ;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Transaksi',
            backgroundColor: "green",
            data: user
        }]
    };

    window.onload = function () {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'line',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Transaksi'
                }
            }
        });
    };
</script>
@endpush
