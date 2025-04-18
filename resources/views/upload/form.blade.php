@extends('layouts.app')

@section('content')
<div class="mx-auto" style="max-width: 600px;">
    
    <div class="text-center mb-5">
        <img src="{{ asset('logo.svg') }}" alt="StegnonFiles logo" width="70%" class="mb-3">
        <p class="text-light">{{__('messages.info')}}</p>
    </div>
    
    <h3 class="mb-4 text-center text-light">{{ __('messages.upload_title') }}</h2>

    <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data" class="border p-4 rounded bg-dark-custom shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="file" class="form-label text-light">{{ __('messages.file_label') }}</label>
            <input type="file" name="file" id="file" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label text-light">{{ __('messages.password_label') }}</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('messages.password_label') }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.submit_upload') }}</button>
    </form>
</div>
@endsection
