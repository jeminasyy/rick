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

                <div style="float:right">
                    <div class="userNav">
                        <a href="/categories" class="active">Categories</a>
                        <a href="/categories/archived">Archive</a>
                    </div>
                    <br>
                    <a href="/categories/create" style="font-weight: bold; float: right;padding-bottom:5px">
                        <i class='bx bxs-category bx-fw'></i> Create New Category
                    </a>
                </div>
                @include('partials._search-category')
                <br><br>

                {{-- <a href="/categories/create" style="font-weight: bold; float: right;padding-bottom:5px">
                    <i class='bx bxs-category bx-fw'></i> Create New Category
                </a> --}}

                <table>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>TYPE</th>
                        <th>DESCRIPTION</th>
                        <th></th>
                    </tr>
        
                    @if(count($categs) != 0)

                        @foreach($categs as $categ)
                        <tr>
                            <td style="text-align:center">{{$categ['id']}}</td>
                            <td>{{$categ['name']}}</th>
                            <td>{{$categ['type']}}</td>
                            <td>{{$categ['description']}}</td>
                            <td class="action">
                                {{-- <button class="editBtn" onclick="location.href='/categories/{{$categ->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i></button>
                                <button class="deleteBtn" onclick="location.href='/categories/{{$categ->id}}/archive';" style="background-color: #ec746b; padding: 4px 6px 3px 5px; margin-left: 5px">
                                    <i class='bx-fw bx bxs-archive-in bx-sm'></i>
                                </button> --}}
                                {{-- <form method="POST" action="/categories/{{$categ->id}}/archive">
                                    @csrf
                                    @method('PUT')
                                    <button class="editBtn" onclick="location.href='/categories/{{$categ->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i></button>
                                    <button type="submit" class="deleteBtn"><i class='bx-fw bx bxs-archive-in bx-sm' ></i></button>
                                </form> --}}
                                <div style="display: flex; flex-direction: row;">
                                    <button class="editBtn" onclick="location.href='/categories/{{$categ->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i></button>
                                    <form method="POST" action="/categories/{{$categ->id}}/archive">
                                        @csrf
                                        @method('PUT')
                                        <button onclick="this.form.submit()"
                                            class="deleteBtn" 
                                            style="background-color: #ec746b; padding: 4px 6px 3px 5px; margin-left: 5px">
                                            <i class='bx-fw bx bxs-archive-in bx-sm'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                    @endif

                </table>

                
            </div>
            <div class="paginate" style="float:left">
                {{ $categs->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
    </x-sidenav>
</x-layout>