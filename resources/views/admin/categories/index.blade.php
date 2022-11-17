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

                @include('partials._search-category')

                <a href="/categories/create" style="font-weight: bold; float: right;padding-bottom:5px">
                    <i class='bx bxs-category bx-fw'></i> Create New Category
                </a>

                <table>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>TYPE</th>
                        <th>DESCRIPTION</th>
                        <th></th>
                    </tr>
        
                    @unless(count($categs) == 0)

                    @foreach($categs as $categ)
                    <tr>
                        <td style="text-align:center">{{$categ['id']}}</td>
                        <td>{{$categ['name']}}</th>
                        <td>{{$categ['type']}}</td>
                        <td>{{$categ['description']}}</td>
                        <td class="action">
                            <Button class="editBtn" onclick="location.href='/categories/{{$categ->id}}/edit';"><i class='bx-fw bx bxs-edit-alt bx-sm'></i></Button>
                            <Button class="deleteBtn"><i class='bx-fw bx bxs-trash-alt bx-sm' ></i></Button>
                        </td>
                    </tr>

                    @endforeach

                    @else 
                        <p>No Categories Found</p>
                    @endunless


                </table>

                
            </div>
            <div class="paginate" style="float:left">
                {{ $categs->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
    </x-sidenav>
</x-layout>