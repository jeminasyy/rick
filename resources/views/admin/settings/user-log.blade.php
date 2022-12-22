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

                <header>
                    <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                        User Audit Log
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
        
                    @unless(count($userlogs) == 0)

                    @foreach($userlogs as $userlog)
                    {{-- <a href="/tickets/{{$studentlog->ticketId}}"> --}}
                    <tr>
                        <td style="text-align:center">{{$userlog->created_at}}</td>
                        <td style="text-align:center">{{$userlog->user->firstName}}</th>
                        <td style="text-align:center">{{$userlog->user->lastName}}</td>
                        <td style="text-align:center">{{$userlog->user->email}}</td> 
                        @if ($userlog->action_type == "TransferN" || $userlog->action_type == "TransferR")
                            <td style="text-align:center">Transfer</td>
                        @elseif ($userlog->action_type == "CreateU" || $userlog->action_type == "CreateC")
                            <td style="text-align:center">Create</td>
                        @elseif ($userlog->action_type == "EditU" || $userlog->action_type == "EditC")
                            <td style="text-align:center">Edit</td>
                        @elseif ($userlog->action_type == "ArchiveU" || $userlog->action_type == "ArchiveC")
                            <td style="text-align:center">Archive</td>
                        @elseif ($userlog->action_type == "UnarchiveU" || $userlog->action_type == "UnarchiveC")
                            <td style="text-align:center">Unarchive</td>
                        @elseif ($userlog->action_type == "EditLimit")
                            <td style="text-align:center">Change Settings</td>
                        @endif
                        {{-- Limitations --}}
                        @if ($userlog->action_type == "EditLimit")
                            <td>Updated ticket limitation to {{$userlog->ticketLimit}}</td>
                        {{-- Users --}}
                        @elseif ($userlog->action_type == "CreateU")
                            <td>Created new user: {{$userlog->userId}}</td>
                        @elseif ($userlog->action_type == "EditU")
                            <td>Updated user: {{$userlog->userId}}</td>
                        @elseif ($userlog->action_type == "ArchiveU")
                            <td>Archived user: {{$userlog->userId}}</td>
                        @elseif ($userlog->action_type == "UnarchiveU")
                            <td>Unarchived user: {{$userlog->userId}}</td>
                        {{-- Categories --}}
                        @elseif ($userlog->action_type == "CreateC")
                            <td>Created new category: {{$userlog->categoryId}}</td>
                        @elseif ($userlog->action_type == "EditC")
                            <td>Updated category: {{$userlog->categoryId}}</td>
                        @elseif ($userlog->action_type == "ArchiveC")
                            <td>Archived category: {{$userlog->categoryId}}</td>
                        @elseif ($userlog->action_type == "UnarchiveC")
                            <td>Unarchived category: {{$userlog->categoryId}}</td>
                        {{-- Transfer --}}
                        @elseif ($userlog->action_type == "TransferN")
                            @if($userlog->user_id != $userlog->userId)
                                <td>Transferred Ticket#{{$userlog->ticketId}} to {{$userlog->categoryId}}. Ticket was re-assigned to User#{{$userlog->userId}}</td>
                            @else
                                <td>Transferred Ticket#{{$userlog->ticketId}} to {{$userlog->categoryId}}</td>
                            @endif
                        @elseif ($userlog->action_type == "TransferR")
                            @if($userlog->user_id != $userlog->userId)
                                <td>Transferred Reopen Ticket#{{$userlog->reopenId}} to {{$userlog->categoryId}}. Ticket was re-assigned to User#{{$userlog->userId}}</td>
                            @else
                                <td>Transferred Reopen Ticket#{{$userlog->reopenId}} to {{$userlog->categoryId}}</td>
                            @endif
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
                {{ $userlogs->links('pagination::bootstrap-5') }}
            </div>
        </div>
        
    </x-sidenav>
</x-layout>