 @extends('layouts.app')

@section('content')
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Pilih Reservasi</h1>

 <div class="content">
        <!-- Futsal Button -->
        <a href="{{ route('reservasi.futsal') }}" class="card">
            <img src="{{ asset('images/futsal_image.jpg') }}" alt="Futsal">
            <div class="card-title">Futsal</div>
        </a>

        <!-- Badminton Button -->
        <a href="{{ route('reservasi.badminton') }}" class="card">
            <img src="{{ asset('images/badminton_image.jpg') }}" alt="Badminton">
            <div class="card-title">Badminton</div>
        </a>
    </div>
    </div>

@endsection
