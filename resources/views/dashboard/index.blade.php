<x-layout>
    <x-sidenav>
        <div class="col-md-12 grid-margin">
            <p style="font-size: 22px; font-weight:bold">Dashboard</p>
            <br>
            <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
            transform: rotate(0.08deg); ">
            <br>

            <div class="row">
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Student Satisfaction</p>
                        <p class="h4">{{ $studentSatisfaction }}%</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Average Response Time</p>
                        <p class="h4">{{ $averageResponseTime }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Average Times Reopened</p>
                        <p class="h4">{{ $averageReopen }} Time/s</p>
                    </div>
                </div>
            </div>
            
            <br>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6">
                        <p class="font-weight-bold h4">Total Tickets</p>
                        <p class="h4">{{ $totalTickets }}</p>
                        <a href="/" class="text-primary h4">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6">
                        <p class="font-weight-bold h4">New Tickets</p>
                        <p class="h4">{{ $newTickets }}</p>
                        <a href="/" class="text-primary h4">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6">
                        <p class="font-weight-bold h4">Resolved Tickets</p>
                        <p class="h4">{{ $resolvedTickets }}</p>
                        <a href="/" class="text-primary h4">View</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Reopened Tickets</p>
                        <p class="h4">{{ $reopenedTickets }}</p>
                        <a href="/" class="text-primary h4">View</a>
                    </div>
                </div>
            </div>

            <br>
            <p class="attribute">This Month</p>
            <hr style="width: 100%; background-color: #d5d5d5; border: 0.1px solid #C4C4C4;
            transform: rotate(0.08deg); ">
            <br>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Request Tickets</p>
                        <p class="h4">{{ $requestThisMonth }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Inquiry Tickets</p>
                        <p class="h4">{{ $inquiryThisMonth }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Concern Tickets</p>
                        <p class="h4">{{ $concernThisMonth }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Other Tickets</p>
                        <p class="h4">{{ $otherThisMonth }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-sidenav>
</x-layout>