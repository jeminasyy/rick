
<head>
    <meta charset="UTF-8">
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600,700&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <body>
        <main>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Student Satisfaction</p>
                        <p class="h4">{{ $studentSatisfaction }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Average Student Rating</p>
                        <p class="h4">{{ $averageRating }}</p>
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
                        <p class="h4">{{ $averageReopen }}</p>
                    </div>
                </div>
            </div>
            
            <br>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6">
                        <p class="font-weight-bold h4">Total Tickets</p>
                        <p class="h4">{{ $totalTickets }}</p>
                        {{-- <a href="/" class="text-primary h4">View</a> --}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6">
                        <p class="font-weight-bold h4">New Tickets</p>
                        <p class="h4">{{ $newTickets }}</p>
                        {{-- <a href="/" class="text-primary h4">View</a> --}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6">
                        <p class="font-weight-bold h4">Resolved Tickets</p>
                        <p class="h4">{{ $resolvedTickets }}</p>
                        {{-- <a href="/" class="text-primary h4">View</a> --}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body border rounded-10 bg-white mb-3 p-6" >
                        <p class="font-weight-bold h4">Reopened Tickets</p>
                        <p class="h4">{{ $reopenedTickets }}</p>
                        {{-- <a href="/" class="text-primary h4">View</a> --}}
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

            <br>
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
                </div>
                <div class="col-lg-6">
                    <h1>{{ $chart2->options['chart_title'] }}</h1>
                    {!! $chart2->renderHtml() !!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4">
                    <h1>{{ $chart3->options['chart_title'] }}</h1>
                    {!! $chart3->renderHtml() !!}
                </div>
                <div class="col-lg-4">
                    <h1>{{ $chart4->options['chart_title'] }}</h1>
                    {!! $chart4->renderHtml() !!}
                </div>
                <div class="col-lg-4">
                    <h1>{{ $chart5->options['chart_title'] }}</h1>
                    {!! $chart5->renderHtml() !!}
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            @{{{!! $chart1->renderChartJsLibrary() !!}
            {!! $chart1->renderJs() !!}
            {!! $chart2->renderJs() !!}
            {!! $chart3->renderJs() !!}
            {!! $chart4->renderJs() !!}
            {!! $chart5->renderJs() !!}}}
        </main>
    </body>
</html>