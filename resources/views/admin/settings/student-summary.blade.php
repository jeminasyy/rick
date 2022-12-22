<x-layout>
    <x-sidenav>
        @include('partials._settings')
        
        <div style="width: 79%; display:inline-block; vertical-align: top;">
            <div class="settings-content-container">
                <div class="newCat">
                   <!-- <form>
                        <p>New Category</p>
                        <label>Category name</label>
                        <input type="text" placeholder="Name">
                        <label>Ticket Type</label>
                        <select></select>
                    </form>-->
                </div>

                <div class="ticketNav">
                    <a href="/student-audit">Audit Log</a>
                    <a href="/student-summary" class="active">Summary</a>
                </div>

                <header>
                    <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                        Student Summary
                    </h2>
                </header>

                
                
                
                <div class="table-holder-categories">

                <table>
                    <tr>
                        <th>STUDENT NUMBER</th>
                        <th>EMAIL</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>TOTAL TICKETS</th>
                        <th>ONGOING TICKETS</th>
                        <th>TIMESTAMP</th>
                    </tr>
        
                    @unless(count($studentlogs) == 0)

                    @foreach($studentlogs as $studentlog)
                    {{-- <a href="/tickets/{{$studentlog->ticketId}}"> --}}
                    <tr>
                        @if ($studentlog->studNumber == null)
                            <td style="text-align:center">N/A</td>
                        @else
                            <td style="text-align:center">{{$studentlog->studNumber}}</td>
                        @endif
                        <td style="text-align:center">{{$studentlog->email}}</td>
                        @if ($studentlog->FName == null)
                            <td style="text-align:center">N/A</td>
                        @else 
                            <td style="text-align:center">{{$studentlog->FName}}</th>
                        @endif
                        @if ($studentlog->LName == null)
                            <td style="text-align:center">N/A</td>
                        @else 
                            <td style="text-align:center">{{$studentlog->LName}}</td>
                        @endif
                        <td style="text-align:center">{{$studentlog->tickets}}</td>
                        <td style="text-align:center">{{$studentlog->ongoingTickets}}</td>
                        <td style="text-align:center">{{$studentlog->updated_at}}</td>
                    </tr>
                    {{-- </a> --}}

                    @endforeach

                    @else 
                        <p>No Student Summary</p>
                    @endunless


                </table>

                
            </div>
            <div class="paginate" style="float:left">
                {{ $studentlogs->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
    </x-sidenav>
</x-layout>