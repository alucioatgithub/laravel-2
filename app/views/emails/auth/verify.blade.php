<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Verify your account</h2>

		<div>
			Hello {{ $username }}! Welcome to the iagr.ee!<br />
			To activate your account, pls follow next link: {{ URL::to('/auth/verify', array($token)) }}
		</div>
	</body>
</html>
