@extends('layouts.app')

@section('content')
<div class="mx-auto" style="max-width: 600px;">
    <h2 class="mb-4 text-center text-light">{{ __('messages.download_title') }}</h2>

    @if($upload->has_password)
        <form method="POST" action="{{ route('upload.download', $upload->uuid) }}">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label text-light">{{ __('messages.password_required') }}</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('messages.download_button') }}</button>
        </form>
    @else
        <a href="{{ route('upload.download', $upload->uuid) }}" class="btn btn-primary">{{ __('messages.download_button') }}</a>
        <p class="text-muted mt-2">{{ __('messages.no_password_needed') }}</p>
    @endif
</div>
@endsection
