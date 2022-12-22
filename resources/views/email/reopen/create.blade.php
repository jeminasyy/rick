<x-layout>
    <div id="reopen" style="padding-right: 300px">
        <a href="/reopen/view/{{$ticket->student->id}}">
            <i class='bx bx-left-arrow-alt bx-md'></i>
        </a>
        <p style="font-size: 17px; font-weight:bold">Request to Reopen Ticket# {{$ticket->id}}</p>
        <br>
        <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
        transform: rotate(0.08deg); ">
        <br>
        <h1 style="font-size:12px; font-weight:bold; float:right "> Date: {{$ticket->created_at}}</h1>

        <div class="ticket-div" style="padding-top:10px; padding-bottom:30px; padding-left:0px; padding-right:0px">
            <div class="ticket-left">
                <p class="attribute">Student Name</p>
                <p>{{$ticket->student->LName}}, {{$ticket->student->FName}}</p>
                
                <p class="attribute">Student Email</p>
                <p>{{$ticket->student->email}}</p>

                <p class="attribute">Student Number</p>
                <p>{{$ticket->student->studNumber}}</p>

                <p class="attribute">Year Level</p>
                <p>{{$ticket->year}}</p>

                <p class="attribute">Department</p>
                <p>{{$ticket->department}}</p>

                <p class="attribute">Assignee</p>
                <p>{{$ticket->assignee}}</p>

                {{-- @if ($ticket->response) --}}
                    <p class="attribute">Times Reopened</p>
                    <p>{{$timesReopened}}</p>
                {{-- @endif --}}
            </div>

            <div class="ticket-right">
                <p class="attribute">Type</p>
                <p>{{$ticket->categ->type}}</p>

                <p class="attribute">Category</p>
                @if ($ticket->categ->name == "Others")
                  <td>{{$ticket->others_categ}}</td>
                @else
                  <td>{{$ticket->categ->name}}</td>
                @endif
                {{-- <p>{{$ticket->categ->name}}</p> --}}

                <p class="attribute">Description</p>
                <p>{{$ticket->description}}</p>

                <p class="attribute">Status</p>
                <p>{{$ticket->status}}</p>

                <p class="attribute">Priority</p>
                <p>{{$ticket->priority}}</p>


                @if ($ticket->response)
                    <p class="attribute">Date Responded</p>
                    <p>{{$ticket->dateResponded}}</p>

                    <p class="attribute">Response/Solution</p>
                    <p>{{$ticket->response}}</p>

                    @if ($ticket->file_email)
                        <p class="attribute">Attached File</p>
                        <a href={{$url}} target="_blank">Open File <i class='bx bx-link-external'></i></a>
                    @endif
                @endif
            </div>
        </div>

        @if ($ticket->rating)
            <div class="ticket-div" style="padding-left:0px; padding-right:0px">
                <p style="font-size: 17px; font-weight:bold">Student Feedback</p>
                <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
                transform: rotate(0.08deg); ">
                <br>
                <h1 style="font-size:12px; font-weight:bold; float:right "> Date: {{$ticket->rating->created_at}}</h1>
                <p class="reopen-p">
                    <span style="font-weight: bold">Rating:&nbsp;&nbsp;</span>
                    {{$ticket->rating->rating}}
                </p>

                @if ($ticket->rating->satisfied == 1)
                    <p class="reopen-p">
                        <span style="font-weight: bold">Solution Accepted:&nbsp;&nbsp;</span>
                        Yes
                    </p>
                @else
                    <p class="reopen-p">
                        <span style="font-weight: bold">Solution Accepted:&nbsp;&nbsp;</span>
                        No
                    </p>
                @endif

                <p class="reopen-p">
                    <span style="font-weight: bold">Comments:&nbsp;&nbsp;</span>
                    {{$ticket->rating->comments}}
                </p>
            </div>
        @endif

        @if (count($ticket->reopens) != 0)
            @foreach($ticket->reopens as $reopen)
                <div class="ticket-div" style="padding-left:0px; ; padding-right:0px">
                    <br>
                    <p style="font-size: 17px; font-weight:bold">Reopened Ticket# {{$reopen->id}}</p>
                    <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
                    transform: rotate(0.08deg); ">
                    <br>
                    <h1 style="font-size:12px; font-weight:bold; float:right "> Date: {{$reopen->created_at}}</h1>

                    <p class="reopen-p">
                        <span style="font-weight: bold">Reason:&nbsp;&nbsp;</span>
                        {{$reopen->reason}}
                    </p>

                    @if ($reopen->user != null)
                        <p class="reopen-p">
                            <span style="font-weight: bold">Assignee:&nbsp;&nbsp;</span>
                            {{$reopen->user->email}}
                        </p>
                    @else
                        <p class="reopen-p">
                            <span style="font-weight: bold">Assignee:&nbsp;&nbsp;</span>
                            Unavailable
                        </p>
                    @endif

                    @if ($reopen->response != null)
                        <p class="reopen-p">
                            <span style="font-weight: bold">Action Taken:&nbsp;&nbsp;</span>
                            {{$reopen->status}}
                        </p>
                        <p class="reopen-p">
                            <span style="font-weight: bold">Response/Solution:&nbsp;&nbsp;</span>
                            {{$reopen->response}}
                        </p>
                        <p class="reopen-p">
                            <span style="font-weight: bold">Date Responded:&nbsp;&nbsp;</span>
                            {{$reopen->dateResponded}}
                        </p>
                        @if ($reopen->file_email_reopen != null)
                        <p class="reopen-p">
                            <span style="font-weight: bold">Attached File:&nbsp;&nbsp;</span>
                            <a href={{Storage::url('reopens/' . $reopen->file_email_reopen)}} target="_blank">Open File <i class='bx bx-link-external'></i></a>
                        </p>
                        @endif
                    @endif
                    <br>
                </div>
                @if($reopen->reopenrating)
                    <div class="ticket-div" style="padding-left:0px; padding-right:0px">
                        <p style="font-size: 17px; font-weight:bold">Student Feedback to Reopened Ticket# {{$reopen->id}}</p>
                        <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
                        transform: rotate(0.08deg); ">
                        <br>
                        <h1 style="font-size:12px; font-weight:bold; float:right "> Date: {{$reopen->reopenrating->created_at}}</h1>
                        <p class="reopen-p">
                            <span style="font-weight: bold">Rating:&nbsp;&nbsp;</span>
                            {{$reopen->reopenrating->rating}}
                        </p>
        
                        @if ($reopen->reopenrating->satisfied == 1)
                            <p class="reopen-p">
                                <span style="font-weight: bold">Solution Accepted:&nbsp;&nbsp;</span>
                                Yes
                            </p>
                        @else
                            <p class="reopen-p">
                                <span style="font-weight: bold">Solution Accepted:&nbsp;&nbsp;</span>
                                No
                            </p>
                        @endif
        
                        <p class="reopen-p">
                            <span style="font-weight: bold">Comments:&nbsp;&nbsp;</span>
                            {{$reopen->reopenrating->comments}}
                        </p>
                        <br>
                    </div>
                @endif
            @endforeach
        @endif

        <br>
        <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4; transform: rotate(0.08deg); ">
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

            <div class="mb-6" style="padding-left:10px">
                <input type="checkbox" id="solved" name="reassign" value=1>
                <label for="reassign">Re-assign Front Desk Officer</label><br>
            </div>

            <div class="mb-6">
                <button 
                    type="submit" 
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    style="margin-top: 1%; background-color: #EDC304;
                    border: 1px solid#EDC304;
                    border-radius: 5px;"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layout>