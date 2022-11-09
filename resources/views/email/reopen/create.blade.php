<x-layout>
    <div id="reopen" style="padding-right: 300px">
        <header>
            <a href="/reopen/view/{{$ticket->student->id}}">
                <i class='bx bx-left-arrow-alt bx-md'></i>
            </a>
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

            <div class="mb-6">
                <button 
                    type="submit" 
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    style="margin-top: 4%; margin-left:2%; background-color: #EDC304;
                    border: 1px solid#EDC304;
                    border-radius: 5px;"
                >
                    Submit
                </button>

                {{-- <a href="/reopen/view/{{$ticket->student->id}}" class="text-black ml-4"> Back </a> --}}
            </div>
        </form>
    </div>
</x-layout>