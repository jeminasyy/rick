<form action="/tickets">
    <p class="attribute">Assignee</p>
    <select name="user_id" id="priority" onchange="this.form.submit()">
        <option value="" font color="#gray">--Select--</option>
        @foreach ($users as $user)
            <option value="{{$user['id']}}">{{$user['email']}}</option>
        @endforeach
    </select>
</form>