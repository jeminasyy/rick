<x-layout>
    <div id="reopen">
        <div class="ticket-div">
            <a href="/tickets/{{$student->id}}">
                <i class='bx bx-left-arrow-alt bx-md'></i>
            </a>
            <p style="font-size: 17px; font-weight:bold">Ticket# {{$ticket->id}}</p>
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

                <p class="attribute">Status</p>
                <p>{{$ticket->status}}</p>

                <p class="attribute">Priority</p>
                <p>{{$ticket->priority}}</p>
            </div>
        </div>
    </div>
</x-layout>