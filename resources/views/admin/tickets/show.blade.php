<x-layout>
    <x-sidenav>
        <div class="ticket-div">
            <a href="/tickets">
                <i class='bx bx-left-arrow-alt bx-md'></i>
            </a>
            <p style="font-size: 17px; font-weight:bold">Ticket# {{$ticket->id}}</p>
            
            @if (!$reopen)
                @if ($ticket->user_id == auth()->id())
                    <button 
                        type="button" 
                        class="btn btn-secondary btn-lg"
                        id="transfer"
                        onclick="location.href='/{{$ticket->id}}/ticket/transfer';"
                    >
                        Transfer Ticket
                    </button>
                @endif
            @endif

            @if ($reopen)
                @if ($reopen->user_id == auth()->id())
                    <button 
                        type="button" 
                        class="btn btn-secondary btn-lg"
                        id="transfer"
                        onclick="location.href='/{{$ticket->id}}/ticket/transfer';"
                    >
                        Transfer Ticket
                    </button>
                @endif
            @endif

            <br>
            <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
            transform: rotate(0.08deg); ">
            <br>
            <h1 style="font-size:12px; font-weight:bold; float:right "> Date: {{$ticket->dateSubmitted}}</h1>
        </div>

        <div class="ticket-div" style="padding-top:10px; padding-bottom:30px">
            <div class="ticket-left">
                <p class="attribute">Name</p>
                <p>{{$ticket->student->LName}}, {{$ticket->student->FName}}</p>
                
                <p class="attribute">Email</p>
                <p>{{$ticket->student->email}}</p>

                <p class="attribute">Student Number</p>
                <p>{{$ticket->student->studNumber}}</p>

                <p class="attribute">Year Level</p>
                <p>{{$ticket->year}}</p>

                <p class="attribute">Department</p>
                <p>{{$ticket->department}}</p>

                <p class="attribute">Assignee</p>
                <p>{{$ticket->user->email}}</p>
            </div>
            
            <div class="ticket-right">
                <p class="attribute">Type</p>
                <p>{{$ticket->categ->type}}</p>

                <p class="attribute">Category</p>
                <p>{{$ticket->categ->name}}</p>

                <p class="attribute">Description</p>
                <p>{{$ticket->description}}</p>
                
                @if ($ticket->status == "Pending")
                    <p class="attribute">Status</p>
                    <p>Ongoing - Waiting for Student's Feedback</p>
                @else
                    <p class="attribute">Status</p>
                    <p>{{$ticket->status}}</p>
                @endif

                @if (!$reopen)
                    @if ($ticket->user_id == auth()->id())
                        @if($ticket->status == "Pending" || $ticket->status == "Resolved" || $ticket->status == "Voided")
                            <p class="attribute">Priority</p>
                            <p>{{$ticket->priority}}</p>
                        @else
                            <form method="POST" action="/{{$ticket->id}}/ticket/updatePriority">
                                @csrf
                                @method('PUT')
                                <p class="attribute">Priority</p>
                                <select name="priority" id="priority" onchange="this.form.submit()">
                                    @if ($ticket->priority == "High")
                                        <option value="High" selected>High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    @elseif ($ticket->priority == "Medium")
                                        <option value="High">High</option>
                                        <option value="Medium" selected>Medium</option>
                                        <option value="Low">Low</option>
                                    @elseif ($ticket->priority == "Low")
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low" selected>Low</option>
                                    @else 
                                        <option value="" font color="#gray">--Select--</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    @endif
                                </select>
                            </form>
                        @endif
                    @else
                        <p class="attribute">Priority</p>
                        <p>{{$ticket->priority}}</p>
                    @endif
                @endif

                @if ($reopen)
                    @if ($reopen->user_id == auth()->id())
                        @if($ticket->status == "Pending" || $ticket->status == "Resolved" || $ticket->status == "Voided")
                            <p class="attribute">Priority</p>
                            <p>{{$ticket->priority}}</p>
                        @else
                            <form method="POST" action="/{{$reopen->id}}/reopen/updatePriority">
                                @csrf
                                @method('PUT')
                                <p class="attribute">Priority</p>
                                <select name="priority" id="priority" onchange="this.form.submit()">
                                    @if ($ticket->priority == "High")
                                        <option value="High" selected>High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    @elseif ($ticket->priority == "Medium")
                                        <option value="High">High</option>
                                        <option value="Medium" selected>Medium</option>
                                        <option value="Low">Low</option>
                                    @elseif ($ticket->priority == "Low")
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low" selected>Low</option>
                                    @else 
                                        <option value="" font color="#gray">--Select--</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    @endif
                                </select>
                            </form>
                        @endif
                    @else
                        <p class="attribute">Priority</p>
                        <p>{{$ticket->priority}}</p>
                    @endif
                @endif

                @if ($ticket->response)
                    <p class="attribute">Date Responded</p>
                    <p>{{$ticket->dateResponded}}</p>

                    <p class="attribute">Response/Solution</p>
                    <p>{{$ticket->response}}</p>
                @endif

                {{-- @if ($ticket->status == "Voided")
                    <p class="attribute">Date Responded</p>
                    <p>{{$ticket->dateResponded}}</p>

                    <p class="attribute">Reason</p>
                    <p>{{$ticket->response}}</p>
                @endif --}}

                @if (!$reopen)
                    @if ($ticket->user_id == auth()->id())
                        @if ($ticket->status == "New")
                            <div class="bottom">
                                <button type="submit" 
                                    class="btn btn-secondary btn-lg"
                                    id="secondary-button"
                                    onclick="location.href='/{{$ticket->id}}/ticket/void';"
                                >
                                    Void Ticket
                                </button>
                            </div>
                        @elseif ($ticket->status == "Opened")
                            <div class="bottom">
                                <form method="POST" action="/{{$ticket->id}}/ticket/setOngoing">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                        class="btn btn-secondary btn-lg"
                                        id="primary-button"
                                    >
                                        Mark as Ongoing
                                    </button>
                                </form>

                                <button 
                                    class="btn btn-secondary btn-lg"
                                    id="secondary-button"
                                    onclick="location.href='/{{$ticket->id}}/ticket/void';"
                                >
                                    Void Ticket
                                </button>
                            </div>
                        @elseif ($ticket->status == "Ongoing")
                            <div class="bottom">
                                <button
                                    class="btn btn-secondary btn-lg"
                                    id="primary-button"
                                    onclick="location.href='/{{$ticket->id}}/ticket/resolve';"
                                >
                                    Mark as Resolved
                                </button>

                                <button
                                    class="btn btn-secondary btn-lg"
                                    id="secondary-button"
                                    onclick="location.href='/{{$ticket->id}}/ticket/void';"
                                >
                                    Void Ticket
                                </button>
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>

        @if ($ticket->rating)
            <div class="ticket-div">
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
            <div class="ticket-div">
                @foreach($ticket->reopens as $reopen)
                    <br>
                    <p style="font-size: 17px; font-weight:bold">Ticket Reopened</p>
                    <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
                    transform: rotate(0.08deg); ">
                    <br>
                    <h1 style="font-size:12px; font-weight:bold; float:right "> Date: {{$reopen->created_at}}</h1>

                    <p class="reopen-p">
                        <span style="font-weight: bold">Reason:&nbsp;&nbsp;</span>
                        {{$reopen->reason}}
                    </p>

                    <p class="reopen-p">
                        <span style="font-weight: bold">Assignee:&nbsp;&nbsp;</span>
                        {{$reopen->user->email}}
                    </p>

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
                    @endif
                @endforeach
            </div>
        @endif

        @if ($reopen)
            <div class="ticket-div" style="margin-top:150px">
                @if ($reopen->user_id == auth()->id())
                    @if ($ticket->status == "New")
                        <div class="bottom">
                            <button type="submit" 
                                class="btn btn-secondary btn-lg"
                                id="secondary-button"
                                onclick="location.href='/{{$reopen->id}}/reopen/void';"
                            >
                                Void Ticket
                            </button>
                        </div>
                    @elseif ($ticket->status == "Reopened")
                        <div class="bottom">
                            <form method="POST" action="/{{$reopen->id}}/reopen/setOngoing">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                    class="btn btn-secondary btn-lg"
                                    id="primary-button"
                                >
                                    Mark as Ongoing
                                </button>
                            </form>

                            <button 
                                class="btn btn-secondary btn-lg"
                                id="secondary-button"
                                onclick="location.href='/{{$reopen->id}}/reopen/void';"
                            >
                                Void Ticket
                            </button>
                        </div>
                    @elseif ($ticket->status == "Ongoing")
                        <div class="bottom">
                            <button
                                class="btn btn-secondary btn-lg"
                                id="primary-button"
                                onclick="location.href='/{{$reopen->id}}/reopen/resolve';"
                            >
                                Mark as Resolved
                            </button>

                            <button
                                class="btn btn-secondary btn-lg"
                                id="secondary-button"
                                onclick="location.href='/{{$reopen->id}}/reopen/void';"
                            >
                                Void Ticket
                            </button>
                        </div>
                    @endif
                @endif
            </div>
        @endif
    </x-sidenav>
</x-layout>