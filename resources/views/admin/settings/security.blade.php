<x-layout>
    <x-sidenav>
        @include('partials._settings')

        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Change Password
                </h2>
                @if ($message != null) 
                    <p style="font-weight:bold; color:{{$color}}">{{ $message }}</p>
                @endif
            </header>

            <form method="POST" action="/security/{{auth()->user()->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="password">Current Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        name="currentPassword" 
                        value="{{old('currentPassword')}}"
                    />
                    @error('currentPassword')
                        <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password">New Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        value="{{old('password')}}"
                    />
                    @error('password')
                        <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>
    
                <div class="mb-6">
                    <label for="confirmation">Confirm New Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" 
                        value="{{old('password_confirmation')}}"
                    />
                    @error('password_confirmation')
                        <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>
    
                    <div class="mb-6">
                    <button type="submit" 
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        style="margin-top: 3%; background-color: #EDC304;
                        border: 1px solid#EDC304;
                        border-radius: 5px;"
                    >
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>