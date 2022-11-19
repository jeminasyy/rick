<x-layout>
    <x-sidenav>
      <div class="ticketNav">
        <a href="/mytickets">My Tickets</a>
        <a href="/tickets" class="active">All Tickets</a>
      </div>
      @include('partials._search-ticket')

      <div id="sidenav2">
        <hr style="width: 100%; margin-bottom: 0; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
        transform: rotate(0.08deg); ">
        
        <table class="table table-hover">
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
            @unless(count($tickets) == 0)

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
                @if ($ticket->user->email != null)
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