<x-layout>
    <div id="submit-ticket">
        <header>
            <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                Please complete your student information
            </h2>
        </header>
        <form method="POST" action="/student-information/{{$student->id}}/save" nctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row" style=" margin-bottom:5%;">
                <div class="form-group col-md-6">
                    <label for="FName">First Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="FName" 
                        name="FName"
                        value="{{old('FName')}}"
                    />
                    @error('FName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
            
                <div class="form-group col-md-6">
                    <label for="LName">Last Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="LName" 
                        name="LName"
                        value="{{old('LName')}}"
                    />
                    @error('LName')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>
            
            <div class="form-row" style=" margin-bottom:5%;">
                <div class="form-group col-md-6">
                    <label for="studNumber">Student Number</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="studNumber"
                        name="studNumber" 
                        value="{{old('studNumber')}}"
                    />
                    @error('studNumber')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
            
                <div class="form-group col-md-6">
                    <label for="studNumber">Student Email</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="email"
                        name="email" 
                        value="{{$student->email}}"
                        disabled
                    />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group col-md-10" style="display: flex; flex-direction: row;">
                <a href="/" class="btn btn-primary" style="margin-top: 4%; margin-left: 104%; background-color: #FFFFFF;
                    border: 1px solid#F8CA0A;
                    border-radius: 5px; color:#F8CA0A ;">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary" style="margin-top: 4%; margin-left:2%; background-color: #F8CA0A;
                    border: 1px solid#F8CA0A;
                    border-radius: 5px; color:#000000 ;">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layout>