<?php

$LAYOUT['menu'] = '
<div class="menu_item">
	<i class="fa fa-fw fa-user-plus"></i>
	<i>Student registration</i>
</div>';

$LAYOUT['content'] = '
<h1>Authorization</h1>
<div id='.dom_id ( 'authorization_form' ).' class="grid">
	<div>Username</div>
	<div>
		<input type="text" name="user_name"/>
	</div>
	<div>Password</div>
	<div>
		<input type="password" name="password"/>
	</div>
	<div></div>
	<div>
		<div class="button" c-click="action(login,form('.dom_id ( 'authorization_form' ).'))">
			<i class="fa fa-sign-in"></i>
			<i>Login</i>
		</div>
	</div>
</div>';