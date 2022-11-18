<x-layout>
    {{-- <h1>Meow</h1>
    @if($tickets)
        <p>Eyyyy</p>
    @endif --}}
    <div id="reopen">
        <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
            Your Resolved and Inactive Tickets
        </h2>
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
                  @if ($ticket->status == "Resolved" || $ticket->status == "Inactive")
                    <tr>
                      <td>{{$ticket->id}}</td>
                      <td>{{$ticket->categ->name}}</td>
                      <td scope="row" style="word-break: break-all;">
                        <b>{{$ticket->student->LName}}, {{$ticket->student->FName}}</b>
                        <br>{{$ticket->student->email}}
                      </td>
                      <td>{{$ticket->description}}</td>
                      <td>{{$ticket->created_at}}</td>
                      @if($ticket->status == "Pending")
                        <td>Ongoing</td>
                      @else
                        <td>{{$ticket->status}}</td>
                      @endif
                      <td style="word-break: break-all;">{{$ticket->user->email}}</td>
                      <td>
                        <button class="reopen-button" onclick="location.href='/reopen/create/{{$ticket->id}}/{{$ticket->student->id}}';">Reopen</button>
                      </td>
                    </tr>
                  @endif
                  
                @endforeach
    
                @else
                  <p>No Tickets Found</p>
            
                @endunless
                
              </tbody>
            </table>
        </div>
    </div>

</x-layout>