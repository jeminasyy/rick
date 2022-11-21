<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{{asset('css/admin.css')}}">
        <link rel="stylesheet" href="{{asset('css/email.css')}}">
        <link rel="stylesheet" href="{{asset('css/modal.css')}}">
        <link rel="stylesheet" href="{{asset('css/settings.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/sidenav.css')}}">
        <link rel="stylesheet" href="{{asset('css/ticket.css')}}">
        <link rel="stylesheet" href="{{asset('css/transfer.css')}}">
        
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
        <title>RICK | Request. Inquiries. Concerns. Komersiyo</title>
    </head>
    <body>
        {{-- <x-flash-message /> --}}
        <nav id="header">
            <div id = "parent">
                <div id="child 1">
                    <img src = "{{asset('images/ust-logo.png')}}" alt="ust logo" id="ust-logo">
                </div>
                
                <div id = "child 2">
                    @auth
                    <h1 id="title">R.I.C.K Ticketing System</h1>
                    <h2 id="title2">Request. Inquiries. Concerns. Komersiyo</h2>
                    @else
                    <a href="/">
                        <h1 id="title">R.I.C.K Ticketing System</h1>
                        <h2 id="title2">Request. Inquiries. Concerns. Komersiyo</h2>
                    </a> 
                    @endif
                </div>

                <div id="child 3">
                    <img src = "{{asset('images/commerce-logo.png')}}" alt="commerce logo" id="commerce-logo">
                </div>

                @auth
                <div style="position: absolute;
                    top:0;
                    right:0;
                    margin-right: 20px;
                    margin-top: 30px;
                    font-size: 15px"
                >
                    <span class="font-bold-uppercase">
                        Welcome {{auth()->user()->firstName}}
                    </span>
                    {{-- @if (auth()->user()->newNotifs > 0) --}}
                    {{-- <a href="/notifications/{{auth()->user()->id}}">
                        <button onclick="myFunction()" class="dropbtn">
                            <i class='bx-fw bx bxs-bell bx-md bx-tada'></i>
                        </button>
                    </a> --}}
                    {{-- <form class="inline" method="POST" action="/notifications/{{auth()->user()->id}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" onclick="myFunction()" class="dropbtn">
                            <i class='bx-fw bx bxs-bell bx-md bx-tada'></i>
                        </button>
                    </form> --}}
                    {{-- @else --}}
                        <button onclick="myFunction()" class="dropbtn">
                            <i class='bx-fw bx bxs-bell bx-md'></i>
                        </button>
                    {{-- @endif --}}
                    
                    {{-- <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Dropdown</button>
                        
                    </div> --}}
                </div>

                @else
                <a href="/login" 
                    class="hover:text-laravel" 
                    style="color:#333333;
                        position: absolute;
                        top:0;
                        right:0;
                        margin-right: 20px;
                        margin-top: 30px;
                        font-size: 18px"
                >
                    <i class='bx bxs-log-in bx-fw'></i>LOGIN
                </a>
                @endif

            </div>
                
        </nav>

        <main>
            @auth
            <div id="myDropdown" class="dropdown-content">
                {{-- @unless(auth()->user()->notifications()) --}}
                @foreach(auth()->user()->notifications()-> as $notification)
                    <div class="containterNotif">
                        <a href="#home">Home</a>
                    </div>
                @endforeach
                {{-- @else
                    <div class="containterNotif">
                        <a>No Notifications</a>
                    </div>
                @endunless --}}
                {{-- <div class="containterNotif">
                    <a href="#home">Home</a>
                </div>
                <div class="containterNotif">
                    <a href="#home">Home</a>
                </div> --}}
                {{-- <a href="#about">About</a>
                <a href="#contact">Contact</a> --}}
              </div>
              @endif
            {{-- VIEW OUTPUT --}}
                {{$slot}}
        </main>

        <script>
            /* When the user clicks on the button, 
            toggle between hiding and showing the dropdown content */
            function myFunction() {
              document.getElementById("myDropdown").classList.toggle("show");
            }
            
            // Close the dropdown if the user clicks outside of it
            window.onclick = function(event) {
              if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
            }
        </script>
    </body>
</html>