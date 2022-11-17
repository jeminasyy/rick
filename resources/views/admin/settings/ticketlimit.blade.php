<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <form method="POST" action="/ticketlimit/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <p class="attribute">Limit Amount of Ongoing Tickets Per Student</p>
                </div>
                <div class="mb-6">
                    <input name="ticketLimit" class="ticket-limit-input" type="number" value="{{$limit[0]->ticketLimit}}">
                </div>
                <div class="mb-6">
                    <button type="submit" class="tlbtn" id="tlSave">Save</button>
                    <a href="/ticketlimit" class="tlbtn" id="tlCancel">Cancel</button>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>