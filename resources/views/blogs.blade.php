<x-layout>
    <x-slot name='title'>
        <title>All Blogs</title>
    </x-slot>
    @foreach ($blogs as $blog)
        <div>
            <a href="blog/<?= $blog->slug ?>">
                <h1> {{ $blog->title }}</h1>
            </a>
            <div>
                <p>published at {{ $blog->date }}</p>
                <p>
                    {{ $blog->intro }}
                </p>
            </div>
        </div>
    @endforeach
</x-layout>
