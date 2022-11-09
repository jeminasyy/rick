<x-layout>
    <div id="reopen">
        <h1>{{$student->id}}</h1>
        <form method="POST" action="/reopen/store/{{$ticket->id}}/{{$student->id}}">
        </form>
    </div>
</x-layout>