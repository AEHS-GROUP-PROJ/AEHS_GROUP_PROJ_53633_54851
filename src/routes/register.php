<?php

$LAYOUT['content'] = '
<h1>Student registration</h1>
<div id='.dom_id ( 'registration_form' ).' class="grid">
	<div>Full name</div>
	<div>
		<input type="text" name="full_name"/>
	</div>
	<div>Email</div>
	<div>
		<input type="text" name="email"/>
	</div>
	<div>Home address</div>
	<div>
		<input type="text" name="address"/>
	</div>
	<div>Phone number</div>
	<div>
		<input type="text" name="phone"/>
	</div>
	<div>Password</div>
	<div>
		<input type="password" name="password" autocomplete="new-password"/>
	</div>
	<div>Confirm password</div>
	<div>
		<input type="password" name="password_confirm" autocomplete="new-password"/>
	</div>
	<div></div>
	<div>
		<div class="button" c-click="action(register,form('.dom_id ( 'registration_form' ).'))">
			<i class="fa fa-user-plus"></i>
			<i>Register</i>
		</div>
	</div>
</div>';