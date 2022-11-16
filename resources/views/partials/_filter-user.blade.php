<form action="/tickets">
    <p class="attribute">Assignee</p>
    <select name="user_id" id="priority" onchange="this.form.submit()" value="{{old('categ_id')}}">
        <option value="" selected>All</option>
        @unless(count($users) == 0)
        @foreach ($users as $user)
            <option value="{{$user['id']}}">{{$user['email']}}</option>
        @endforeach
        @endunless
    </select>
</form>