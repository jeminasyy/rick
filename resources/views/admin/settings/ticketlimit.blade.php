<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <form method="POST" action="/user/{{$user->id}}/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Limit Amounts of On Going Tickets Per Student</label>
                <input type="number" placeholder="">
                <button class="tlbtn" id="tlCancel">Cancel</button>
                <button class="tlbtn" id="tlSave">Save</button>
            </form>
        </div>
    </x-sidenav>
</x-layout>