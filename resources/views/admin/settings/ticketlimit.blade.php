<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; margin-left:20%; display:inline-block; vertical-align: top; align-content:center">
            <form method="POST" action="/ticketlimit/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <p class="attribute" style="font-size: 150%; align-content: center">Limit Amount of Ongoing Tickets Per Student</p>
                    @if ($message != null) 
                        <p style="font-weight:bold; color:{{$color}}">{{ $message }}</p>
                    @endif
                </div>
                <div class="mb-6">
                    <input name="ticketLimit" 
                        class="ticket-limit-input" 
                        style="align-content: center; align-self:center; margin-left:25%"
                        type="number" 
                        value="{{$limit[0]->ticketLimit}}"
                    >
                </div>
                <div class="mb-6" style="margin-left:22%">
                    <button type="submit" 
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        style="margin-top: 4%; background-color: #EDC304;
                        border: 1px solid#EDC304;
                        border-radius: 5px;"
                    >
                        Save
                    </button>
    
                    <a href="/ticketlimit" class="text-black ml-4"> Cancel </a>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>