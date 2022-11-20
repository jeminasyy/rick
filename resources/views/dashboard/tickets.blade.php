<table>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">CATEGORY</th>
        <th scope="col">REQUESTER</th>
        <th scope="col">DESCRIPTION</th>
        <th scope="col">DATE</th>
        <th scope="col">STATUS</th>
        <th scope="col">ASSIGNEE</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tickets as $ticket)
        <tr>
          <td>{{$ticket->id}}</td>
          <td>{{$ticket->categ->name}}</td>
          <td scope="row" style="word-break: break-all;">
            <b>{{$ticket->student->LName}}, {{$ticket->student->FName}}</b>
            <br>{{$ticket->student->email}}
          </td>
          <td>{{$ticket->description}}</td>
          <td>{{$ticket->created_at}}</td>
          <td>{{$ticket->status}}</td>
          @if ($ticket->user != null)
            <td style="word-break: break-all;">{{$ticket->user->email}}</td>
          @else
            <td style="word-break: break-all;">Unavailable</td>
          @endif
        </tr>
    </tbody>
</table>