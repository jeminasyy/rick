<x-layout>
    <div id="reopen">
        <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
            Reopen Ticket#{{$ticket->id}}
        </h2>

        <form method="POST" action="/reopen/store/{{$ticket->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <p class="attribute">Type</p>
                <p>{{$ticket->categ->type}}</p>

                <p class="attribute">Category</p>
                <p>{{$ticket->categ->name}}</p>

                <p class="attribute">Description</p>
                <p>{{$ticket->description}}</p>

                <p class="attribute">Priority</p>
                <p>{{$ticket->priority}}</p>

                <p class="attribute">Assignee</p>
                <p>{{$ticket->user->email}}</p>
            </div> 

            <div class="mb-6">
                <label for="response">Reason for Re-opening:</label>
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