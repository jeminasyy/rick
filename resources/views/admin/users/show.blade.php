<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            {{-- <div style="float: right">
                <button class="editBtn" onclick="location.href='/user/{{$user->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i>Edit</button>
                <form method="POST" action="/users/{{$user->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500"><i class='bx-fw bx bxs-trash-alt bx-sm' ></i>Delete</button>
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                  </form>
            </div> --}}

            <a href="/users">
                <i class='bx bx-left-arrow-alt bx-md'></i>
            </a>
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

            <div class="form-group col-md-10 pt-10" style="display: flex; flex-direction: row;">
                <button class="editBtn" onclick="location.href='/user/{{$user->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i>Edit</button>
                <form method="POST" action="/users/{{$user->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="deleteBtn"><i class='bx-fw bx bxs-trash-alt bx-sm' ></i>Delete</button>
                    {{-- <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button> --}}
                </form>
            </div>
        </div>
    </x-sidenav>
</x-layout>