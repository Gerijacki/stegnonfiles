@if($upload->has_password)
    <form method="POST" action="{{ route('upload.download', ['uuid' => $upload->uuid]) }}">
        @csrf
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Descargar</button>
    </form>
@else
    <form method="POST" action="{{ route('upload.download', ['uuid' => $upload->uuid]) }}">
        @csrf
        <button type="submit">Descargar</button>
    </form>
@endif
