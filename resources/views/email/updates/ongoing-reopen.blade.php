<div style="width: 100%; padding: 20px 50px 0px 50px; height:fit-content;">
    <p style="font-size: 17px; font-weight:bold">Hi {{$ticket->student->FName}} {{$ticket->student->LName}}!</p>
    <p style="font-weight: bold; margin-top: 10px;">Your ticket is ongoing</p>
    <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
    transform: rotate(0.08deg); ">
    <br>

    <p style="font-weight: bold; margin-top: 10px;">Ticket# {{$ticket->id}}</p>
        
    <p style="font-weight: bold; margin-top: 10px;">Email</p>
    <p>{{$ticket->student->email}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Student Number</p>
    <p>{{$ticket->student->studNumber}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Year Level</p>
    <p>{{$ticket->year}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Department</p>
    <p>{{$ticket->department}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Date Submitted</p>
    <p>{{$ticket->dateSubmitted}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Type</p>
    <p>{{$ticket->categ->type}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Category</p>
    <p>{{$ticket->categ->name}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Description</p>
    <p>{{$ticket->description}}</p>
    
    <p style="font-weight: bold; margin-top: 10px;">Status</p>
    <p>{{$ticket->status}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Priority</p>
    <p>{{$ticket->priority}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Reason for Reopening</p>
    <p>{{$reopen->reason}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Assignee</p>
    <p>{{$reopen->user->email}}</p>
</div>