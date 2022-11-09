<x-layout>
    <div id="reopen" style="padding-right: 300px">
        <a href="/reopen/view/{{$ticket->student->id}}">
            <i class='bx bx-left-arrow-alt bx-md'></i>
        </a>
        <p style="font-size: 17px; font-weight:bold">Reopen Ticket# {{$ticket->id}}</p>
        <br>
        <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
        transform: rotate(0.08deg); ">
        <br>

        <form method="POST" action="/reopen/store/{{$ticket->id}}/{{$ticket->student->id}}">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="response">Reason for Reopening</label>
                <textarea 
                    name="reason" 
                    class="form-control" 
                    id="exampleFormControlTextarea1" 
                    rows="10"
                    value="{{old('reason')}}"
                ></textarea>
                @error('reason')
                    <p class="text-red-500 text-md mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                {{-- <label>Re-assign Front Desk Officer?<span style="font-weight: bold; color:red">*</span></label>
                <br> --}}
                <input type="checkbox" id="solved" name="reassign" value=1>
                <label for="reassign">Re-assign Front Desk Officer</label><br>
                {{-- <input type="radio" id="solved" name="reassign" value=0>
                <label for="reassign">No</label> --}}
                {{-- @error('reassign')
                <p class="text-red-500 text-md mt-1">{{$message}}</p>
                @enderror --}}
            </div>

            <div class="mb-6">
                <button 
                    type="submit" 
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    style="margin-top: 4%; margin-left:2%; background-color: #EDC304;
                    border: 1px solid#EDC304;
                    border-radius: 5px;"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layout>