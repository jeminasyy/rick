<x-layout>
    @foreach ($tickets as $ticket)
        <p>{{$ticket->id}}</p>
    @endforeach
</x-layout>