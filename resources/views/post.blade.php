<x-layout {{-- content="hola" --}} >
        {{-- componentes y sus variables --}}
        {{-- <x-slot name="content">hola</x-slot> --}}

        <article>
            
            <h1>{!! $post->title !!}</h1>

            <p>
                <a href="#">
                    {{ $post->category->name }}
                </a>
            </p>

            <div>
                {!! $post->body; !!}
            </div>

        </article>

        <a href="/" >Go Back</a>

</x-layout>