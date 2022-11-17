<x-layout>
    <x-sidenav>
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <h1 style="font-size: 19px">Hello {{auth()->user()->firstName}} {{auth()->user()->lastName}}!</h1><br>
            <p class="attribute">ROLE</p>
            <p>{{auth()->user()->role}}</p>
            <p class="attribute">EMAIL</p>
            <p>{{auth()->user()->email}}</p>
            <p class="attribute">EMAIL VERIFIED</p>
            <p>{{auth()->user()->email_verified_at}}</p>
            <p class="attribute">USER ACCESS</p>
                <p class="attribute">Request</p>
                @foreach ($usercategs as $usercateg)
                    @if($usercateg->categ()->type == 'Request')
                        <p>{{$usercateg->categ()->name}}</p>
                    @endif
                @endforeach
                <p class="attribute">Inquiries</p>
                @foreach ($usercategs as $usercateg)
                    @if($usercateg->categ()->type == 'Inquiries')
                        <p>{{$usercateg->categ()->name}}</p>
                    @endif
                @endforeach
                <p class="attribute">Concerns</p>
                @foreach ($usercategs as $usercateg)
                    @if($usercateg->categ()->type == 'Concerns')
                        <p>{{$usercateg->categ()->name}}</p>
                    @endif
                @endforeach
                <p class="attribute">Others</p>
                @foreach ($usercategs as $usercateg)
                    @if($usercateg->categ()->type == 'Others')
                        <p>{{$usercateg->categ()->name}}</p>
                    @endif
                @endforeach
        </div>
    </x-sidenav>
</x-layout>