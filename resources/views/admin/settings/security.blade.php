<x-layout>
    <x-sidenav>
        @include('partials._settings')

        <div style="width: 30%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Change Password
                </h2>
                @if ($message != null) 
                    <p style="font-weight:bold; color:{{$color}}">{{ $message }}</p>
                @endif
            </header>
            {{-- @push('other-scripts')
            <script>
                $(document).ready(function(){
                    $('#checkbox').on('change', function(){
                        $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
                    });
                });
            </script>
            @endpush --}}

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
                        id="currentpassword"
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
                        id="newpassword"
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
                        id="confirmpassword"
                    />
                    @error('password_confirmation')
                        <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>
                
                <input type="checkbox" id="checkbox">&nbsp; Show Password

                {{-- @{{
                    {{$(document).ready(function(){
                        $('#checkbox').on('change', function(){
                            $('#password').attr('type',$('#checkbox').prop('checked')==true?"text":"password"); 
                        });
                    });}}
                }} --}}

                
                    
                    {{-- <input type="password" id="password"> 
                    <input type="checkbox" id="checkbox">Show Password --}}
    
                <div class="mb-6">
                    <button type="submit" 
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        style="margin-top: 7%; background-color: #EDC304;
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