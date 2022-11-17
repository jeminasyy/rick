<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <form method="POST" action="/ticketlimit/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Limit Amounts of On Going Tickets Per Student</label>
                <input type="number" value="{{$limit[0]->ticketLimit}}">
                <button class="tlbtn" id="tlCancel">Cancel</button>
                <button class="tlbtn" id="tlSave">Save</button>
            </form>
        </div>
    </x-sidenav>
</x-layout>