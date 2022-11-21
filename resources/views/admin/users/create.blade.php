<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Create New User
                </h2>
            </header>
    
            <form method="POST" action="/users" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="firstName">First Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="firstName" 
                        value="{{old('firstName')}}"
                    />
                    @error('firstName')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="lastName">Last Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="lastName" 
                        value="{{old('lastName')}}"
                    />
                    @error('lastName')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email">Email</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="email" 
                        value="{{old('email')}}"
                    />
                    @error('email')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="role">Role</label>
                    <select 
                        class="form-control"
                        name="role"
                        value="{{old('role')}}"
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
                        <p>Note: Admins will have access to all categories</p>
                        <br>
                        @unless(count($categs) == 0)
                            <h2 class="text-2xl font-bold uppercase mb-1"">
                                Requests
                            </h2>
                            @foreach($categs as $categ)
                                @if($categ['type'] == 'Request')
                                <div>
                                    <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ['id']}}>
                                    <label for="categ_id">{{$categ['name']}}</label>
                                </div>
                                @endif
                            @endforeach

                            <h2 class="text-2xl font-bold uppercase mb-1 mt-3">
                                Inquiries
                            </h2>
                            @foreach($categs as $categ)
                                @if($categ['type'] == 'Inquiries')
                                <div>
                                    <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ['id']}}>
                                    <label for="categ_id">{{$categ['name']}}</label>
                                </div>
                                @endif
                            @endforeach

                            <h2 class="text-2xl font-bold uppercase mb-1 mt-3"">
                                Concerns
                            </h2>
                            @foreach($categs as $categ)
                                @if($categ['type'] == 'Concerns')
                                <div>
                                    <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ['id']}}>
                                    <label for="categ_id">{{$categ['name']}}</label>
                                </div>
                                @endif
                            @endforeach

                            <h2 class="text-2xl font-bold uppercase mb-1 mt-3"">
                                Others
                            </h2>
                            @foreach($categs as $categ)
                                @if($categ['type'] == 'Others')
                                <div>
                                    <input type="checkbox" id="categ_id" name="categ_id[]" value={{$categ['id']}}>
                                    <label for="categ_id">{{$categ['name']}}</label>
                                </div>
                                @endif
                            @endforeach
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
