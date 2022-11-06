<x-layout>
    <x-sidenav>
        <div class="ticket-div">
            <a href="/tickets">
                <i class='bx bx-left-arrow-alt bx-md'></i>
            </a>
            <p style="font-size: 17px; font-weight:bold">Ticket# {{$ticket->id}}</p>
            
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
                    <p>Waiting for Student's Feedback</p>
                @else
                    <p class="attribute">Status</p>
                    <p>{{$ticket->status}}</p>
                @endif

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

                @if ($ticket->status == "Resolved" || $ticket->status == "Pending")
                    <p class="attribute">Date Responded</p>
                    <p>{{$ticket->dateResponded}}</p>

                    <p class="attribute">Solution</p>
                    <p>{{$ticket->response}}</p>
                @endif

                @if ($ticket->status == "Voided")
                    <p class="attribute">Date Responded</p>
                    <p>{{$ticket->dateResponded}}</p>

                    <p class="attribute">Reason</p>
                    <p>{{$ticket->response}}</p>
                @endif
            </div>

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

        </div>
    </x-sidenav>
</x-layout>