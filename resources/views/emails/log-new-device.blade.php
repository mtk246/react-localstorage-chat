<p>
    Hello {{ $fullName }} ,
    <br><br>
    We saw that you recently tried to log in from a new device, IP address, or different location.
    <br>
    As a security measure we must confirm that it is you before you can access your account.
    <br><br>
    <strong> Device: </strong> {{ $os }}
    <br>
    <strong> IP address: </strong> {{ $ip }}
    <br><br>
    Please insert the following code: <h3> {{$code}} </h3> to login in new device.
</p>