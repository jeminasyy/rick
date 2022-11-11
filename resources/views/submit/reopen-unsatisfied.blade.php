<x-layout>
    <div class="form-inline3">
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 29;text-align: center; margin-top: 13%; position: relative;">
            You answered No.
        </h1>
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 29;text-align: center;  position: relative;">
            Do you want to reopen this ticket?
        </h1>
        {{-- <button
            class="btn btn-secondary btn-lg"
            id="primary-button"
            onclick="location.href='/{{$ticket->id}}/ticket/resolve';"
        >
            Yes, reopen ticket
        </button> --}}
        <button 
            class="btn btn-secondary btn-lg"
            id="secondary-button"
            onclick="location.href='/';"
        >
            Yes, reopen ticket
        </button>    
        <button 
            class="btn btn-secondary btn-lg"
            id="secondary-button"
            onclick="location.href='/';"
        >
            Oh no, return home
        </button>  
    </div>
</x-layout>