<form action="/tickets">
    <p class="attribute">Category</p>
    <select name="categ_id" id="priority" onchange="this.form.submit()">
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
</form>