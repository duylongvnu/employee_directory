<h1>Welcome to Employee Directory website</h1> <br />
<p>Your account information:</p><br />

<ul>
	<li>Name: {{ $user->name }}</li>
	<li>Email: {{ $user->email }}</li>
	<li>Password: {{ $generate_password }}</li>
</ul>
<p>Note: You have to change password on first login</p>