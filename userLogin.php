	
	
<style>
	#account
	{
		position: relative;
		display: flex;
		vertical-align: middle;
		text-align: center;
		align-items: center;
	}
	#userLogIn
	{
		padding: 5px;
		margin:5px
	}
	#userLogIn #username
	{
		display:inline-block;
		padding: 6px;
		font-size: 13px;
		border: none;
		width: 140px; 
	}
	#userLogIn input[type=password]
	{
		display:inline-block;
		padding: 6px;
		font-size: 13px;
		border: none;
		width: 140px; 
	}
	#userLogIn #contactHolder
	{
		display:inline-block;
		padding: 6px;
		font-size: 13px;
		border: none;
		width: 180px; 
		background-color: grey;
		color: orange;
	}
	#userLogIn #contactHolder::placeholder
	{
		color: orange;
	}
	#verifyPassword
	{	
		display:inline-block;
		padding: 6px;
		font-size: 13px;
		border: none;
		width: 140px; 
		background-color: grey;
		color: orange;
	}
	#verifyPassword::placeholder
	{
		color: orange;		
	}
	#userLogIn #submitButton
	{
		border: none;
		padding: 6px;
	}
	#userLogIn #submitButton:hover
	{
		transition: 0.3s;	
		background-color: orange;
	}
	#profilePic
	{
		width: 30px;
		height: 30px;
	}

	#usernameFont
	{
		padding: 0px 13px;
	}
	.dropbtn {
		background-color: transparent;
		color: black;
		padding: 10px;
		margin: 10px;
		font-size: 16px;
		outline: solid white;
		border: none;
	}
	.dropdown{
		position: relative;
		display: inline-block;
	}

	.styleRight{
		transition: 0.5s;
		display: none;
		background-color: #f1f1f1;
		position: absolute;
		z-index: 3;
		right:0;
	}
	.styleRight a{
		transition: 0.5s;
		width: 180px;
		color: black;
		padding: 8px 12px;
		text-decoration: none;
		display: block;
		position:relative;
		z-index: 1;
	}
	.styleRight a:hover
		{
			min-width: 140px;
			background-color: orange;
		}

	.dropdown:hover .dropbtn {
		outline: solid orange;
	}
	.dropdown:hover .styleRight{  
		transition: 0.5s;
		display: block;
	}

	.saveDropdown:hover .styleRight
	{  
		transition: 0.5s;
		display: block;
	}
		@keyframes shake 
	{
		10%, 90% {
			transform: translate3d(-1px, 0, 0);
		}

		20%, 80% {
			transform: translate3d(2px, 0, 0);
		}

		30%, 50%, 70% {
			transform: translate3d(-4px, 0, 0);
		}

		40%, 60% {
			transform: translate3d(4px, 0, 0);
		}
	}
</style>
