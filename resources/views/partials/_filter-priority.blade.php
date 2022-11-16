<form action="/tickets">
    <p class="attribute">Priority</p>
    <select name="priority" id="priority" onchange="this.form.submit()" value="{{old('categ_id')}}">
        <option value="" font color="#gray">--Select--</option>
        <option value="Unset">Unset</option>
        <option value="High">High</option>
        <option value="Medium">Medium</option>
        <option value="Low">Low</option>
    </select>
</form>