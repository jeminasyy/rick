<table>
  <tr>
    <td style="font-weight: bold">Student Satisfaction</td>
    <td style="text-align:left">{{ $studentSatisfaction }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Average Rating</td>
    <td style="text-align:left">{{ $averageRating }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Average Response Time</td>
    <td style="text-align:left">{{ $averageResponseTime }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Average Reopen Times</td>
    <td style="text-align:left">{{ $averageReopen }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Total Tickets</td>
    <td style="text-align:left">{{ $totalTickets }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">New Tickets</td>
    <td style="text-align:left">{{ $newTickets }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Resolved Tickets</td>
    <td style="text-align:left">{{ $resolvedTickets }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Reopened Tickets</td>
    <td style="text-align:left">{{ $reopenedTickets }}</td>
  </tr>
  <tr>
    <td>This Month</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Requests</td>
    <td style="text-align:left">{{ $requestThisMonth }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Inquiries</td>
    <td style="text-align:left">{{ $inquiryThisMonth }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Concerns</td>
    <td style="text-align:left">{{ $concernThisMonth }}</td>
  </tr>
  <tr>
    <td style="font-weight: bold">Others</td>
    <td style="text-align:left">{{ $otherThisMonth }}</td>
  </tr>
</table>

<table>
  <thead>
  <tr>
    <th >Tickets</th>
  </tr>
  <tr>
      <th style="font-weight: bold; text-align: center">Ticket ID</th>
      <th style="font-weight: bold">Category</th>
      <th style="font-weight: bold">Student Last Name</th>
      <th style="font-weight: bold">Student First Name</th>
      <th style="font-weight: bold">Student Email</th>
      <th style="font-weight: bold">Year Level</th>
      <th style="font-weight: bold">Department</th>
      <th style="font-weight: bold; width: 200px;">Description</th>
      <th style="font-weight: bold">Status</th>
      <th style="font-weight: bold">Assignee</th>
      <th style="font-weight: bold">Priority</th>
      <th style="font-weight: bold">Response/Solution</th>
      <th style="font-weight: bold">Date Submitted</th>
      <th style="font-weight: bold">Date Responded</th>
      <th style="font-weight: bold">Date Resolved</th>
  </tr>
  </thead>
  <tbody>
  @foreach($tickets as $ticket)
      <tr>
          <td style="text-align: center">{{ $ticket->id }}</td>
          <td>{{ $ticket->categ->name }}</td>
          <td>{{ $ticket->student->LName }}</td>
          <td>{{ $ticket->student->FName }}</td>
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