<div class="sidebar">
    <div class="logo-details">
        <i class='bx bx-menu bx-lg' id="btn" ></i>
    </div>

    <ul class="nav-list">
        <li>
            <a href="/dashboard">
                <i class='bx bxs-chart bx-md'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="/mytickets">
                <i class='bx bxs-coupon bx-md'></i>
                <span class="links_name">Tickets</span>
            </a>
            <span class="tooltip">Tickets</span>
        </li>
        <li>
            <a href="/profile">
                <i class='bx bxs-user bx-md'></i>
                <span class="links_name">User Profile</span>
            </a>
            <span class="tooltip">Profile</span>
        </li>
        <li>
            <a href="/security">
                <i class='bx bxs-cog bx-md'></i>
                <span class="links_name">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <div class="name_job">
                    <div class="name">Team Effica</div>
                    <div class="job">&#169; 2022</div>
                </div>
            </div>
            <form class="inline" method="POST" action="/logout">
                @csrf
                <button type="submit">
                    <i class='bx bxs-log-out bx-md' id="log_out" ></i>
                </button>
            </form>
        </li>
    </ul>
</div>

<div class="main-content">
    
    {{$slot}}
</div>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("open");
        menuBtnChange();//calling the function(optional)
    });

    searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
        }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
        }
    }
</script>