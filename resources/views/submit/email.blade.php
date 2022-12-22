<x-layout>
    <form class = "form-inline">
        <h1 style="color:black; font-family: 'Cabin', sans-serif; font-size: 29;text-align: center; margin-top: 10%; position: relative;">Please enter 
            your email address</h1>
        
        <input type="text" id="email" placeholder="email address" name="email" style="padding-left:5px">
        <button type="submit">Submit</button>
    </form>
    {{-- <form>
        <h3 className="forgotpassword-screen__title">Recover Password</h3>
       
        <div className="form-group">
            <p className="forgotpassword-screen__subtext">
                Please provide your account's email address
            </p>
            <input
                type="email"
                required
                id="email"
                placeholder="Email address"
            />
        </div>

        <button type="submit" className="btn-form__primary">
            Send Email
        </button>
    </form> --}}
</x-layout>