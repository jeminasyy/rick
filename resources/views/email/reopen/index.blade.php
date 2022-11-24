<x-layout>
    <form method="POST" action="/reopen/email" class="form-inline">
        @csrf
        @method('PUT')
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 220%;text-align: center; margin-top: 10%; position: relative;">Please enter 
            your email address</h1>
        
            <input style="margin-left:1%; margin-top:1%" type="text" id="email" placeholder=" Email Address" name="email">
            <button style="margin-left:1%;" type="submit">Submit</button>
        </form>
</x-layout>