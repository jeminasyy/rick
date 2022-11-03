<div style="width: 100%; padding: 20px 50px 0px 50px; height:fit-content;">
    <p style="font-size: 17px; font-weight:bold">Hi {{$FName}} {{$LName}}!</p>
    <p style="font-weight: bold; margin-top: 10px;">Your ticket has been voided</p>
    <p style="font-weight: bold; margin-top: 10px;">Ticket# {{$Number}}</p>
    <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
    transform: rotate(0.08deg); ">
    <br>
    <p style="font-weight: bold; margin-top: 10px;">Reason for voiding:</p>
    <p>{{$Reason}}</p>

    <p style="font-weight: bold; margin-top: 10px;">Assignee:</p>
    <p>{{$AssigneeFName}} {{$AssigneeLName}}</p>
    <p>{{$Assignee}}</p>
</div>