<x-layout {{-- content="hola putos" --}} >
        {{-- componentes y sus variables --}}
        {{-- <x-slot name="content">puto</x-slot> --}}

        <article>
            
            <h1>{{ $post->title }}</h1>

            <div>
                {!! $post->body; !!}
            </div>

        </article>

        <a href="/" >Go Back</a>

</x-layout>