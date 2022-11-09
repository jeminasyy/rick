<x-layout>
    <h1>Meow></h1>
    @foreach ($tickets as $ticket)
        <p>{{$ticket['id']}}</p>
    @endforeach
</x-layout>