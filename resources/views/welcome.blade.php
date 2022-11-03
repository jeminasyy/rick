<x-layout>
    {{-- <style>
        body{
            background-image: url('{{asset('images/index-bg.png')}}');
        }
    </style> --}}
    {{-- <div id="bg"> --}}
        <div id="body">
            <h1><span>R</span>equest. <span>I</span>nquiries. <span>C</span>oncerns. <span>K</span>omersiyo</h1>
            
            
            <div id="button-container">
                {{-- <div id="submit-new-ticket"> --}}
                 <a id="btnIndx1" class="indexBtn" href="/new/verify-email">Submit New Ticket</a>
                {{-- </div> --}}
                {{-- <div id="request-reopen"> --}}
                    <a id="btnIndx1" class="indexBtn" href="/reopen/verify-email">Re-Open Ticket</a>
                {{-- </div> --}}
            </div>
        </div>
    {{-- </div> --}}
</x-layout>