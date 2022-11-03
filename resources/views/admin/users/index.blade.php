<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 75%; display:inline-block; vertical-align: top;">
            <div class="settings-content-container">
                <div class="newCat">
                   <!-- <form>
                        <p>New Category</p>
                        <label>Category name</label>
                        <input type="text" placeholder="Name">
                        <label>Ticket Type</label>
                        <select></select>
                    </form>-->
                </div>

                <div class="table-holder-categories">

                @include('partials._search-user')

                <a href="/users/create" style="font-weight: bold; float: right;padding-bottom:5px">
                    <i class='bx bxs-user-plus bx-fw'></i> Create New User
                </a>

                <table>
                    <tr>
                        <th>ID</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>VERIFIED</th>
                        <th></th>
                    </tr>
        
                    @unless(count($users) == 0)

                    @foreach($users as $user)
                    <tr>
                        <td style="text-align:center">{{$user['id']}}</td>
                        <td>{{$user['firstName']}}</th>
                        <td>{{$user['lastName']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['role']}}</td>
                        @if($user['email_verified_at'])
                        <td>
                            {{$user['email_verified_at']->toDateString()}}
                        </td>
                        @else
                        <td></td>
                        @endif
                        <td class="action">
                            <Button class="editBtn"><i class='bx-fw bx bxs-edit-alt bx-sm'></i></Button>
                            <Button class="deleteBtn"><i class='bx-fw bx bxs-trash-alt bx-sm' ></i></Button>
                        </td>
                    </tr>

                    @endforeach

                    @else 
                        <p>No Users Found</p>
                    @endunless


                </table>

                
            </div>
            <div class="paginate" style="float:left">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
    </x-sidenav>
</x-layout>