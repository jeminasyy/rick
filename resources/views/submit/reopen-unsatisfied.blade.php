<x-layout>
    <div class="ticket-div">
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 220%;text-align: center; margin-top: 13%; position: relative;">
            You answered No.
        </h1>
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 220%;text-align: center;  position: relative;">
            Do you want to reopen this ticket?
        </h1>
        {{-- <button
            class="btn btn-secondary btn-lg"
            id="primary-button"
            onclick="location.href='/{{$ticket->id}}/ticket/resolve';"
        >
            Yes, reopen ticket
        </button> --}}
           
          
    </div>
    <div class="button-div">
        <button 
            class="btn btn-secondary btn-lg"
            id="primary-button2"
            onclick="location.href='/reopen/create/{{$ticket->id}}/{{$student->id}}';"
        >
            Yes, reopen ticket
        </button> 

        <button 
            class="btn btn-secondary btn-lg"
            id="secondary-button2"
            onclick="location.href='/';"
        >
            No, return home
        </button>
    </div>
    <div class="ticket-div">
        
    </div>
</x-layout>