{{-- resources/views/page.blade.php --}}
{{-- Render with: view('page', ['title' => 'Posts', 'posts' => $posts]) --}}

<!DOCTYPE html>
<html lang="en">
<body>
    <h1>{{ $title }}</h1>

    @if (count($posts) > 0)
        <ul>
            @foreach ($posts as $post)
                <li>{{ $loop->iteration }}. {{ $post['title'] }}</li>
            @endforeach
        </ul>
    @else
        <p>No posts yet.</p>
    @endif

    {{-- Escaped vs raw --}}
    <p>Escaped: {{ '<b>not bold</b>' }}</p>
    <p>Raw: {!! '<b>bold</b>' !!}</p>
</body>
</html>
