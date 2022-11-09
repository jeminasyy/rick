<x-layout>
    <h1>Meow</h1>
    @if($tickets)
        <p>Eyyyy</p>
    @endif
    {{-- @for ($x=0; $x<count($tickets); $x++)
        <p>{{$tickets[$x]->id}}</p>
    @endfor --}}
</x-layout>