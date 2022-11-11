<x-layout>
    <x-sidenav>
        <div style="width: 50%; margin: 1% 5%; display:inline-block; vertical-align: top;">
            <header>
                <h2 class="text-2xl font-bold uppercase mb-1 mb-8">
                    Transfer Ticket# {{$ticket->id}}
                </h2>
            </header>
    
            <form method="POST" action="/{{$reopen->id}}/reopen/setTransfer" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <p class="attribute">Type</p>
                    <p>{{$ticket->categ->type}}</p>

                    <p class="attribute">Category</p>
                    <p>{{$ticket->categ->name}}</p>

                    <p class="attribute">Description</p>
                    <p>{{$ticket->description}}</p>

                    <p class="attribute">Assignee</p>
                    <p>{{$reopen->user_id}}</p>
                </div>

                <div class="mb-6">
                    <label for="response">Transfer to:</label>
                    <select 
                        id="categ_id" 
                        name="categ_id"
                        class="form-control"
                        value="{{old('categ_id')}}"
                    >
                        <option value="" selected>Choose Category...</option>
                        @unless(count($categs) == 0)
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
                    @error('categ_id')
                        <p class="text-red-500 text-md mt-1">{{$message}}</p>
                    @enderror
                </div>

                @if ($ticket->status != "Pending" && $ticket->status != "Resolved" && $ticket->status != "Voided")
                <div class="mb-6">
                    <label for="response">Assign to:</label>
                    <select 
                        id="user_id" 
                        name="user_id"
                        class="form-control"
                        value="{{old('user')}}"
                    >
                        <option value="" selected>Choose User...</option>
                        @unless(count($users) == 0)
                        <optgroup label="Admins">
                            @foreach ($users as $user)
                                @if($user['role'] == 'Admin')
                                    <option value="{{$user['id']}}">{{$user['email']}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        <optgroup label="Front Desk Officers">
                            @foreach ($users as $user)
                                @if($user['role'] == 'FDO')
                                    <option value="{{$user['id']}}">{{$user['email']}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                        @endunless
                    </select>
                </div>
                @endif

                 <div class="mb-6">
                    <button 
                        type="submit" 
                        class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                        style="margin-top: 4%; margin-left:2%; background-color: #EDC304;
                        border: 1px solid#EDC304;
                        border-radius: 5px;"
                    >
                        Confirm
                    </button>
    
                    <a href="/tickets/{{$ticket->id}}" class="text-black ml-4"> Cancel </a>
                </div>
            </form>
        </div>
    </x-sidenav>
</x-layout>