<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <form method="POST" action="/ticketlimit/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-center">
                    <p class="attribute">Limit Amounts of On Going Tickets Per Student</p>
                </div>
                <div class="d-flex justify-content-center">
                    <input class="ticket-limit-input" type="number" value="{{$limit[0]->ticketLimit}}">
                </div>
                <div class="d-flex justify-content-center">
                    <button class="tlbtn" id="tlCancel">Cancel</button>
                    <button class="tlbtn" id="tlSave">Save</button>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>