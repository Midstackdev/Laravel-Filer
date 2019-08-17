 <h1>Hello {{ $user['name'] }}</h1>
 <p>Please click the link below for verification of your email {{ $user['email'] }}</p>
 <a href="{{ url('/verification', $user->verification->token) }}">Verify Email</a>