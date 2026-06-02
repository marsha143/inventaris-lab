@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')

<div class="text-center py-4">

    <lottie-player
        src="https://assets10.lottiefiles.com/packages/lf20_jzv1lqcc.json"
        background="transparent"
        speed="1"
        style="width: 320px; height: 320px; margin:auto;"
        loop
        autoplay>
    </lottie-player>

    <h1 class="fw-bold text-danger mb-3">
        403 - Akses Ditolak
    </h1>

    <p class="text-muted mb-4">
        Anda tidak memiliki hak akses untuk menjalankan aksi ini.
    </p>

    <a href="{{ route('inventaris.index') }}"
        class="btn btn-primary px-4">

        <i class="bi bi-arrow-left-circle"></i>
        Kembali ke Inventaris

    </a>

</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

@endsection