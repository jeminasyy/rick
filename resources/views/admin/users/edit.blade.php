<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Edit New User
                </h2>
            </header>
    
            <form method="POST" action="/user/{{$user->id}}/update'" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="role">Role</label>
                    <select 
                        class="form-control"
                        name="role"
                        value="{{$user->role}}"
                    >
                        <option value="" selected>Choose...</option>
                        <option value="FDO">Front Desk Officer</option>
                        <option value="Admin">Adminstrator</option>
                    </select>
                    @error('role')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">

                    <fieldset>
                        <legend>User Access:</legend>

                        @unless(count($categ) == 0)
                        {{dd(gettype($categ[0]->type))}}
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
                        Create
                    </button>
    
                    <a href="/users" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>
