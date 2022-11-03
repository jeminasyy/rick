@if (auth()->user()->role == "FDO")
    <div></div>
@else
    <div class="settings">
        <div class="settings-container">
            <ul>
                <u>SETTINGS</u>
                <a href="/security"><li>Security</li></a>
                <a href="/users"><li>Users</li></a>
                <a href="/categories"><li>Categories</li></a>
                <a href="/ticketlimit"><li>Ticket Limitation</li></a>
            </ul>
        </div>
    </div>
@endif