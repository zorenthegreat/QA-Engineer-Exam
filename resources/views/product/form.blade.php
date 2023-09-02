@extends('layouts.app', [
    'bodyClass' => 'hold-transition sidebar-mini layout-fixed'
])

@push('metas')
<meta name="access-token" content="{{ $token }}">
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div id="app" class="col">
                <product-form-component :category-enum="{{ $categories }}" />
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush