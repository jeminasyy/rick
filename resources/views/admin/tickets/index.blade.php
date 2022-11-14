<x-layout>
    <x-sidenav>
      @include('partials._search-ticket')

      <div id="sidenav2">
        <div class="layout">
          <input name="nav" type="radio" class="nav home-radio" id="home" checked="checked" />
          <div class="page home-page">
            <div class="page-contents">
              <h1>Home</h1>
              <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quas voluptates dolore id aspernatur odit minus quidem deleniti ab rerum exercitationem dolores neque officiis explicabo possimus blanditiis sed, voluptatem ut. Ab?</p>
              <p><label for="about">Learn more</label></p>
            </div>
          </div>
          <label class="nav" for="home">
            <span>
              <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Home
            </span>
          </label>
        
          <input name="nav" type="radio" class="about-radio" id="about" />
          <div class="page about-page">
            <div class="page-contents">
              <h1>About</h1>
              <p>Amet consectetur adipisicing elit. Sed ipsam ad exercitationem, quo quae ullam, quidem laudantium corporis quis minima debitis nesciunt repellat. Quos dolore ex quis voluptas, minus ut?</p>
            </div>
          </div>
          <label class="nav" for="about">
            <span>
              <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
              About
            </span>
          </label>
        </div>
        {{-- <hr style="width: 100%; margin-bottom: 0; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
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
                <td>{{$ticket->dateSubmitted}}</td>
                @if($ticket->status == "Pending")
                  <td>Ongoing</td>
                @else
                  <td>{{$ticket->status}}</td>
                @endif
                @if (count($ticket->reopens) != 0)
                  <td style="word-break: break-all;">
                    {{$ticket->user->email}}
                    @foreach($ticket->reopens as $reopen)
                      <br>{{$reopen->user->email}}
                    @endforeach
                  </td>
                @else
                  <td style="word-break: break-all;">{{$ticket->user->email}}</td>
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
    </div> --}}
  </x-sidenav>
</x-layout>