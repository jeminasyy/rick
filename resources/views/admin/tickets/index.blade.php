<x-layout>
    <x-sidenav>
      <div class="ticketNav">
        <a href="/mytickets">My Tickets</a>
        <a href="/tickets" class="active">All Tickets</a>
      </div>

      {{-- <a href="/generate/tickets">Generate Report</a> --}}
      @include('partials._search-ticket')

      <div id="sidenav2">
        <hr style="width: 100%; margin-bottom: 0; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
        transform: rotate(0.08deg); ">
        
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">CATEGORY</th>
              <th scope="col">LAST NAME</th>
              <th scope="col">FIRST NAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col">DESCRIPTION</th>
              <th scope="col">DATE</th>
              <th scope="col">STATUS</th>
              <th scope="col">ASSIGNEE</th>
            </tr>
          </thead>
          <tbody>
            @unless(count($tickets) == 0)

            @foreach($tickets as $ticket)
              <tr>
                <td>{{$ticket->id}}</td>
                @if ($ticket->categ->name == "Others")
                  <td>{{$ticket->others_categ}}</td>
                @else
                  <td>{{$ticket->categ->name}}</td>
                @endif
                <td>{{$ticket->student->LName}}</td>
                <td>{{$ticket->student->FName}}</td>
                <td>{{$ticket->student->email}}</td>
                <td style="word-break: break-all;">{{$ticket->description}}</td>
                <td style="word-break: break-all;">{{$ticket->created_at}}</td>
                @if ($ticket->status == "Pending")
                  <td>Ongoing</td>
                @else
                  <td>{{$ticket->status}}</td>
                @endif
                @if ($ticket->user != null)
                  <td style="word-break: break-all;">{{$ticket->user->email}}</td>
                @else
                  <td style="word-break: break-all;">Unavailable</td>
                @endif
                <td>
                  <a href="/tickets/{{$ticket->id}}"><i class='bx-fw bx bxs-show bx-sm'></i>View</a>
                </td>
              </tr>

              
            @endforeach

            @else
              <p>No Tickets Found</p>
        
            @endunless
            
          </tbody>
        </table>
      </div>

      <div class="paginate">
        {{ $tickets->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </x-sidenav>
</x-layout>