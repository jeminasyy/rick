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
                    <a href="/student-audit" class="active">Audit Log</a>
                    <a href="/student-summary">Summary</a>
                </div>

                <header>
                    <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                        Student Audit Log
                    </h2>
                </header>

                
                
                
                <div class="table-holder-categories">

                <table>
                    <tr>
                        <th>DATE/TIME</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>EMAIL</th>
                        <th>ACTION TYPE</th>
                        <th>DESCRIPTION</th>
                    </tr>
        
                    @unless(count($studentlogs) == 0)

                    @foreach($studentlogs as $studentlog)
                    {{-- <a href="/tickets/{{$studentlog->ticketId}}"> --}}
                    <tr>
                        <td style="text-align:center">{{$studentlog->created_at}}</td>
                        <td style="text-align:center">{{$studentlog->student->FName}}</th>
                        <td style="text-align:center">{{$studentlog->student->LName}}</td>
                        <td style="text-align:center">{{$studentlog->student->email}}</td> 
                        @if ($studentlog->action_type == "FeedbackN" || $studentlog->action_type == "FeedbackR")
                            <td style="text-align:center">Feedback</td>
                        @else
                            <td style="text-align:center">{{$studentlog->action_type}}</td>
                        @endif

                        @if ($studentlog->action_type == "New")
                            <td>Submitted Ticket#{{$studentlog->ticketId}}. Assigned to User#{{$studentlog->userId}} {{$studentlog->userEmail}}</td>
                        @elseif ($studentlog->action_type == "Reopen")
                            <td>Reopened Ticket#{{$studentlog->ticketId}}. Reopen Ticket#{{$studentlog->reopenId}} was assigned to User#{{$studentlog->userId}} {{$studentlog->userEmail}}</td>
                        @elseif ($studentlog->action_type == "FeedbackN")
                            <td>Provided feedback to Ticket#{{$studentlog->ticketId}}</td>
                        @elseif ($studentlog->action_type == "FeedbackR")
                            <td>Provided feedback to Reopen Ticket#{{$studentlog->reopenId}}</td>
                        @endif
                    </tr>
                    {{-- </a> --}}

                    @endforeach

                    @else 
                        <p>No Student Logs</p>
                    @endunless


                </table>

                
            </div>
            <div class="paginate" style="float:left">
                {{ $studentlogs->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
    </x-sidenav>
</x-layout>