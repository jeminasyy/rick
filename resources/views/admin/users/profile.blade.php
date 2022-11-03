<x-layout>
    <x-sidenav>
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <h1 style="font-size: 19px">Hello {{auth()->user()->firstName}} {{auth()->user()->lastName}}!</h1><br>
            <p class="attribute">Role</p>
            <p>{{auth()->user()->role}}</p>
            <p class="attribute">Email</p>
            <p>{{auth()->user()->email}}</p>
            <p class="attribute">Email Verified</p>
            <p>{{auth()->user()->email_verified_at}}</p>
        </div>
    </x-sidenav>
</x-layout>