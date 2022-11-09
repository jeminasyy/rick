<x-layout>
    <div id="reopen">
        <header>
            <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                Reopen Ticket# {{$ticket->id}}
            </h2>
        </header>
        <form method="POST" action="/reopen/store/{{$ticket->id}}/{{$ticket->student->id}}">
            <div class="mb-6">
                <label for="response">Reason for Reopening</label>
                <textarea 
                    name="reason" 
                    class="form-control" 
                    id="exampleFormControlTextarea1" 
                    rows="10"
                    value="{{old('reason')}}"
                ></textarea>
                @error('reason')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                @enderror
            </div>
        </form>
    </div>
</x-layout>