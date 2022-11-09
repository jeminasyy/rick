<x-layout>
    <h1>Meow></h1>
    @for ($x=0; $x<count($tickets); $x++)
        <p>{{$tickets[$x]->id}}</p>
    @endfor
</x-layout>