<x-layout>
    <x-sidenav>
      @include('partials._search-ticket')

      <div class="tabs">
        <div class="tab-2">
          <label for="tab2-1">One</label>
          <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
          <div id="sidenav2">
            <h4>My Tickets</h4>
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

              <div class="paginate">
                {{ $tickets->links('pagination::bootstrap-5') }}
              </div>
          </div>
        </div>

        <div class="tab-2">
          <label for="tab2-2">Two</label>
          <input id="tab2-2" name="tabs-two" type="radio">
          <div>
            <h4>All Tickets</h4>
            <p>Quisque sit amet turpis leo. Maecenas sed dolor mi. Pellentesque varius elit in neque ornare commodo ac non tellus. Mauris id iaculis quam. Donec eu felis quam. Morbi tristique lorem eget iaculis consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean at tellus eget risus tempus ultrices. Nam condimentum nisi enim, scelerisque faucibus lectus sodales at.</p>
          </div>
        </div>
      </div>
  </x-sidenav>
</x-layout>