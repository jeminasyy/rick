<x-layout>
    <x-sidenav>
        @include('partials._settings')
        <div style="width: 40%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Create New Category
                </h2>
            </header>
    
            <form method="POST" action="/categories" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="firstName">Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        value="{{old('name')}}"
                    />
                    @error('name')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="role">Type</label>
                    <select 
                        class="form-control"
                        name="type"
                        value="{{old('type')}}"
                    >
                        <option value="" selected>Choose...</option>
                        <option value="Request">Request</option>
                        <option value="Inquiries">Inquiries</option>
                        <option value="Concerns">Concerns</option>
                        <option value="Others">Others</option>
                    </select>
                    @error('type')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="lastName">Description</label>
                    <textarea 
                        row="20"
                        class="form-control" 
                        name="description" 
                        value="{{old('description')}}"
                    ></textarea>
                    @error('description')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                 <div class="mb-6">
                    <button type="submit" 
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        style="margin-top: 4%; background-color: #EDC304;
                        border: 1px solid#EDC304;
                        border-radius: 5px;"
                    >
                        Create
                    </button>
    
                    <a href="/categories" class="text-black ml-4"> Back </a>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>