<div style="width: 100%; padding: 20px 50px 0px 50px; height:fit-content;">
    <p style="font-size: 17px; font-weight:bold">Hi {{$FName}} {{$LName}}!</p>
    <p style="font-weight: bold; margin-top: 10px;">Reset your password with the link below.</p>
    <hr style="width: 100%; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
    transform: rotate(0.08deg); ">
    <br>
    <a 
        href="http://vast-headland-55467.herokuapp.com/reset/password/{{$User_id}}/{{$resetToken}}"
        style="background-color: #EDC304; 
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;"
    >
        Click here
    </a>
</div>