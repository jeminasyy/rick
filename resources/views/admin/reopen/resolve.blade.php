<x-layout>
    <x-sidenav>
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Confirm to Resolve Ticket# {{$reopen->ticket->id}}
                </h2>
            </header>
    
            <form method="POST" action="/{{$reopen->id}}/reopen/setPending" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <p class="attribute">Type</p>
                    <p>{{$reopen->ticket->categ->type}}</p>

                    <p class="attribute">Category</p>
                    <p>{{$reopen->ticket->categ->name}}</p>

                    <p class="attribute">Description</p>
                    <p>{{$reopen->ticket->description}}</p>
                </div>

                <div class="mb-6">
                    <p class="attribute">Reason for reopening</p>
                    <p>{{$reopen->reason}}</p>
                </div>

                <div class="mb-6">
                    <label for="response">Solution:</label>
                    <textarea 
                        name="response" 
                        class="form-control" 
                        id="exampleFormControlTextarea1" 
                        rows="10"
                        value="{{old('response')}}"
                    ></textarea>
                    @error('response')
                        <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="file_email">Attach File:</label>
                    <input 
                        type="file"
                        name="file_email_reopen" 
                        value="{{old('file_email_reopen')}}"
                    />
                    @error('file_email_reopen')
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
                        Confirm
                    </button>
    
                    <a href="/tickets/{{$reopen->ticket->id}}" class="text-black ml-4"> Cancel </a>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>