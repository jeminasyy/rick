<div class="row">
    <div class="col-lg-2">
        <form action="/tickets">
            <div class="relative border-2 border-gray-100 rounded-lg" id="search-div">
                
                <div class="absolute top-4 left-3">
                    <i
                        class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                    ></i>
                </div>
                <input
                    type="text"
                    name="search"
                    id="search-bar"
                    placeholder="Search Tickets..."
                />
                <div class="absolute top-2 right-2">
                    <button class="h-10 w-12 text-white rounded-lg bg-red-500 hover:bg-red-600" id="search-submit" type="submit" \>
                        <i class='bx bx-search bx-sm bx-fw'></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-2">
        <form action="/tickets">
            <p class="attribute">Category</p>
            <select name="categ_id" id="priority" onchange="this.form.submit()">
                @unless(count($categs) == 0)
                    <option value="" font color="#gray">--Select--</option>
                    <optgroup label="Requests">
                        @foreach ($categs as $categ)
                            @if($categ['type'] == 'Request')
                                <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                            @endif
                        @endforeach
                    </optgroup>
                    <optgroup label="Inquiries">
                        @foreach ($categs as $categ)
                            @if($categ['type'] == 'Inquiries')
                                <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                            @endif
                        @endforeach
                    </optgroup>
                    <optgroup label="Concerns">
                        @foreach ($categs as $categ)
                            @if($categ['type'] == 'Concerns')
                                <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                            @endif
                        @endforeach
                    </optgroup>
                    <optgroup label="Others">
                        @foreach ($categs as $categ)
                            @if($categ['type'] == 'Others')
                                <option value="{{$categ['id']}}">{{$categ['name']}}</option>
                            @endif
                        @endforeach
                    </optgroup>
                @endunless
        
            </select>
        </form>
    </div>
    <div class="col-2">
        <form action="/tickets">
            <p class="attribute">Priority</p>
            <select name="priority" id="priority" onchange="this.form.submit()">
                <option value="" font color="#gray">--Select--</option>
                <option value="Unset">Unset</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </form>
    </div>
    <div class="col-2">
        <form action="/tickets">
            <p class="attribute">Status</p>
            <select name="status" id="priority" onchange="this.form.submit()">
                <option value="" font color="#gray">--Select--</option>
                <option value="New">New</option>
                <option value="Opened">Opened</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Resolved">Pending</option>
                <option value="Resolved">Resolved</option>
                <option value="Voided">Voided</option>
                <option value="Inactive">Inactive</option>
                <option value="Reopened">Reopened</option>
            </select>
        </form>
    </div>
    <div class="col-2">
        <form action="/tickets">
            <p class="attribute">Assignee</p>
            <select name="user_id" id="priority" onchange="this.form.submit()">
                <option value="" font color="#gray">--Select--</option>
                @foreach ($users as $user)
                    <option value="{{$user['id']}}">{{$user['email']}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<br>