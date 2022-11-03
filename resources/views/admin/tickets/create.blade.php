<x-layout>
    <div id="submit-ticket">
        <form method="POST" action="/tickets/{{$student->id}}" enctype="multipart/form-data">
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
                        value="{{$student->FName}}"
                        disabled
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
                        value="{{$student->LName}}"
                        disabled
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
                        value="{{$student->studNumber}}"
                        disabled
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

            <div class="form-row" style=" margin-bottom:5%;">
                <div class="form-group col-md-6">
                    <label for="year">Year Level</label>
                    <select 
                        id="year" 
                        class="form-control"
                        name="year"
                        value="{{old('year')}}"
                    >
                        <option value="" selected>Choose...</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
        
                <div class="form-group col-md-6">
                    <label for="department">Department</label>
                    <select 
                        id="deparment" 
                        name="department"
                        class="form-control"
                        value="{{old('department')}}"
                    >
                        <option value="" selected>Choose...</option>
                        <option value="Business Economics">Business Economics</option>
                        <option value="Entrepreneurship">Entrepreneurship</option>
                        <option value="Financial Management">Financial Management</option>
                        <option value="Marketing Management">Marketing Management</option>
                        <option value="Human Resource Management">Human Resource Management</option>
                    </select>
                    @error('department')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="form-row" style=" margin-bottom:5%;">
                <div class="form-group col-md-6">
                    <label for="description">Description:</label>
                    <textarea 
                        name="description" 
                        class="form-control" 
                        id="exampleFormControlTextarea1" 
                        rows="10"
                        value="{{old('description')}}"
                    ></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="categ_id">Category</label>
                    <select 
                        id="categ_id" 
                        name="categ_id"
                        class="form-control"
                        value="{{old('categ_id')}}"
                    >
                        <option value="" selected>Choose...</option>
                        @unless(count($categs) == 0)
                        <optgroup label="Requests">
                            @foreach ($categs as $categ)
                                @if($categ['type'] == 'Request')
                                    <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        <optgroup label="Inquiries">
                            @foreach ($categs as $categ)
                                @if($categ['type'] == 'Inquiries')
                                    <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        <optgroup label="Concerns">
                            @foreach ($categs as $categ)
                                @if($categ['type'] == 'Concerns')
                                    <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        <optgroup label="Others">
                            @foreach ($categs as $categ)
                                @if($categ['type'] == 'Others')
                                    <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        @endunless
                    </select>
                    @error('categ_id')
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