<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <div style="float: right">
                <Button class="editBtn" onclick="location.href='/user/{{$user->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i>Edit</Button>
                <Button class="deleteBtn"><i class='bx-fw bx bxs-trash-alt bx-sm' ></i>Delete</Button>
            </div>
            <h1 style="font-size: 19px">User#{{$user->id}}</h1><br> 
            <p class="attribute">NAME</p>
            <p>{{$user->lastName}}, {{$user->firstName}}</p>
            <p class="attribute">ROLE</p>
            <p>{{$user->role}}</p>
            <p class="attribute">EMAIL</p>
            <p>{{$user->email}}</p>
            <p class="attribute">EMAIL VERIFIED</p>
            <p>{{$user->email_verified_at}}</p>
            <p class="attribute">USER ACCESS</p>
            <p class="attribute">Request</p>
            @foreach ($usercategs as $usercateg)
                @if($usercateg->categ->type == 'Request')
                    <p>{{$usercateg->categ->name}}</p>
                @endif
            @endforeach
            <p class="attribute">Inquiries</p>
            @foreach ($usercategs as $usercateg)
                @if($usercateg->categ->type == 'Inquiries')
                    <p>{{$usercateg->categ->name}}</p>
                @endif
            @endforeach
            <p class="attribute">Concerns</p>
            @foreach ($usercategs as $usercateg)
                @if($usercateg->categ->type == 'Concerns')
                    <p>{{$usercateg->categ->name}}</p>
                @endif
            @endforeach
            <p class="attribute">Others</p>
            @foreach ($usercategs as $usercateg)
                @if($usercateg->categ->type == 'Others')
                    <p>{{$usercateg->categ->name}}</p>
                @endif
            @endforeach
        </div>
    </x-sidenav>
</x-layout>