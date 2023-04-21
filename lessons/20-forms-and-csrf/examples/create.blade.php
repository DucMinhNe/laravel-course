{{-- resources/views/posts/create.blade.php --}}

<form method="POST" action="/posts">
    @csrf   {{-- REQUIRED — without it the request is rejected with 419 --}}

    <label>
        Title
        <input type="text" name="title" value="{{ old('title') }}">
    </label>
    @error('title')
        <span class="error">{{ $message }}</span>
    @enderror

    <label>
        Body
        <textarea name="body">{{ old('body') }}</textarea>
    </label>
    @error('body')
        <span class="error">{{ $message }}</span>
    @enderror

    <button type="submit">Create</button>
</form>

{{-- Deleting needs method spoofing since HTML forms only do GET/POST --}}
<form method="POST" action="/posts/1">
    @csrf
    @method('DELETE')
    <button type="submit">Delete post #1</button>
</form>
