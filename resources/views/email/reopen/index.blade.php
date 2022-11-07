<x-layout>
    <form method="POST" action="/emailReopen" class="form-inline">
        @csrf
        @method('PUT')
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 29;text-align: center; margin-top: 10%; position: relative;">Please enter 
            your email address</h1>
        
            <input type="text" id="email" placeholder=" email address" name="email">
            <button type="submit">Submit</button>
        </form>
</x-layout>