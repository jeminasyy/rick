<x-layout>
    <form method="POST" action="/reopen/verify" class="form-inline1">
        @csrf
        @method('PUT')
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 220%;text-align: center; margin-top: 8%; position: relative;">Verify Email Address</h1>
        <h3 style="font-family: 'Roboto', sans-serif;font-size: 150%; font-weight: lighter;text-align: center;margin-top: 1%">Enter the verification that was sent to your email</h3>
        <input type="text" id="code" placeholder="  code" name="code">
        <button type="submit">Submit</button>
            {{-- <h3 style="font-family: 'Roboto', sans-serif;font-size: 20; font-weight: lighter;text-align: center;margin-top: 8%">Resend code</h3> --}}
    </form>
</x-layout>