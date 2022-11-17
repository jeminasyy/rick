<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Edit User#{{$user->id}}
                </h2>
            </header>
    
            <form method="POST" action="/user/{{$user->id}}/update" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <p class="attribute">Name</p>
                    <p>{{$user->lastName}}, {{$user->firstName}}</p>
                    <p class="attribute">Email</p>
                    <p>{{$user->email}}</p>
                </div>
                <div class="mb-6">
                    <label for="role">Role</label>
                    <select 
                        class="form-control"
                        name="role"
                        value="{{$user->role}}"
                    >
                        {{-- <option value="" selected>Choose...</option> --}}
                        @if ($user->role == "FDO")
                            <option value="FDO" selected>Front Desk Officer</option>
                            <option value="Admin">Adminstrator</option>
                        @elseif ($user->role == "Admin")
                            <option value="FDO">Front Desk Officer</option>
                            <option value="Admin" selected>Adminstrator</option>
                        @endif
                    </select>
                    @error('role')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">

                    <fieldset>
                        <legend>User Access:</legend>

                        @unless(count($categ) == 0)
                        {{-- {{dd($usercategs)}} --}}
                            <h2 class="text-2xl font-bold uppercase mb-1"">
                                Requests
                            </h2>
                            @for($x=0; $x < count($categ); $x++)
                                @if($categ[$x]->type == 'Request')
                                <div>
                                    @if (in_array($categ[$x]->id, $usercategs))
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}} checked>
                                    @else
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}}>
                                    @endif
                                    <label for="categ_id">{{$categ[$x]->name}}</label>
                                </div>
                                @endif
                            @endfor
                            <h2 class="text-2xl font-bold uppercase mb-1"">
                                Inquiries
                            </h2>
                            @for($x=0; $x < count($categ); $x++)
                                @if($categ[$x]->type == 'Inquiries')
                                <div>
                                    @if (in_array($categ[$x]->id, $usercategs))
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}} checked>
                                    @else
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}}>
                                    @endif
                                    <label for="categ_id">{{$categ[$x]->name}}</label>
                                </div>
                                @endif
                            @endfor
                            <h2 class="text-2xl font-bold uppercase mb-1"">
                                Concerns
                            </h2>
                            @for($x=0; $x < count($categ); $x++)
                                @if($categ[$x]->type == 'Concerns')
                                <div>
                                    @if (in_array($categ[$x]->id, $usercategs))
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}} checked>
                                    @else
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}}>
                                    @endif
                                    <label for="categ_id">{{$categ[$x]->name}}</label>
                                </div>
                                @endif
                            @endfor
                            <h2 class="text-2xl font-bold uppercase mb-1"">
                                Others
                            </h2>
                            @for($x=0; $x < count($categ); $x++)
                                @if($categ[$x]->type == 'Others')
                                <div>
                                    @if (in_array($categ[$x]->id, $usercategs))
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}} checked>
                                    @else
                                        <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ[$x]->id}}>
                                    @endif
                                    <label for="categ_id">{{$categ[$x]->name}}</label>
                                </div>
                                @endif
                            @endfor
                        @endunless
                    </fieldset>
                    @error('categ_id')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                 <div class="mb-6">
                    <button 
                        type="submit" 
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        style="margin-top: 4%; margin-left:2%; background-color: #EDC304;
                        border: 1px solid#EDC304;
                        border-radius: 5px;"
                    >
                        Edit
                    </button>
    
                    <a href="/users/{{$user->id}}" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>
