<table>
  <tr>
    <td>Student Satisfaction</td>
    <td>{{ $studentSatisfaction }}</td>
  </tr>
  <tr>
    <td>Average Rating</td>
    <td>{{ $averageRating }}</td>
  </tr>
  <tr>
    <td>Average Response Time</td>
    <td>{{ $averageResponseTime }}</td>
  </tr>
  <tr>
    <td>Average Reopen Times</td>
    <td>{{ $averageReopen }}</td>
  </tr>
  <tr>
    <td>Total Tickets</td>
    <td>{{ $totalTickets }}</td>
  </tr>
  <tr>
    <td>New Tickets</td>
    <td>{{ $newTickets }}</td>
  </tr>
  <tr>
    <td>Resolved Tickets</td>
    <td>{{ $resolvedTickets }}</td>
  </tr>
  <tr>
    <td>Reopened Tickets</td>
    <td>{{ $reopenedTickets }}</td>
  </tr>
  <tr>
    <td>This Month</td>
  </tr>
  <tr>
    <td>Requests</td>
    <td>{{ $requestThisMonth }}</td>
  </tr>
  <tr>
    <td>Inquiries</td>
    <td>{{ $inquiryThisMonth }}</td>
  </tr>
  <tr>
    <td>Concerns</td>
    <td>{{ $concernThisMonth }}</td>
  </tr>
  <tr>
    <td>Others</td>
    <td>{{ $otherThisMonth }}</td>
  </tr>
</table>

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
          <td>{{ $ticket->created_at }}</td>
          <td>{{ $ticket->dateResponded }}</td>
          <td>{{ $ticket->dateResolved }}</td>
      </tr>
  @endforeach
  </tbody>
</table>