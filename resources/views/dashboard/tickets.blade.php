<table>
  <thead>
  <tr>
      <th>Ticket ID</th>
      <th>Category</th>
      <th>Student Name</th>
      <th>Student Email</th>
      <th>Year Level</th>
      <th>Department</th>
      <th>Description</th>
      <th>Status</th>
      <th>Assignee</th>
      <th>Priority</th>
      <th>Response/Solution</th>
      <th>Date Submitted</th>
      <th>Date Responded</th>
      <th>Date Resolved</th>
  </tr>
  </thead>
  <tbody>
  @foreach($tickets as $ticket)
      <tr>
          <td>{{ $ticket->id }}</td>
          <td>{{ $ticket->categ->name }}</td>
          <td>{{ $ticket->student->LName }}, {{ $ticket->student->FName }}</td>
          <td>{{ $ticket->student->email }}</td>
          <td>{{ $ticket->year }}</td>
          <td>{{ $ticket->department }}</td>
          <td>{{ $ticket->description }}</td>
          <td>{{ $ticket->status }}</td>
          <td>{{ $ticket->assignee }}</td>
          <td>{{ $ticket->priority }}</td>
          <td>{{ $ticket->response }}</td>
          <td>{{ $ticket->create_at }}</td>
          <td>{{ $ticket->dateResponded }}</td>
          <td>{{ $ticket->dateResolved }}</td>
      </tr>
  @endforeach
  </tbody>
</table>