@extends('layouts.app')

@section('content')
<div class="alert alert-success text-center bg-dark-custom text-light">
    <h3>{{ __('messages.upload_success') }}</h3>
    <p>{{ __('messages.share_link') }} : {{ route('upload.download.form', ['uuid' => $uuid]) }}</p>

    <a href="{{ route('upload.download.form', ['uuid' => $uuid]) }}" class="btn btn-outline-primary">
        {{ __('messages.download_button') }}
    </a>
    <br><br>
    <a href="{{ route('upload.form') }}" class="btn btn-secondary">{{ __('messages.new_upload') }}</a>
</div>
@endsection
