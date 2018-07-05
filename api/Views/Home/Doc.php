<?php include("Views/Shared/style.php"); ?>

<div class="banner">
	<h1 class="red"> Hypra</h1>
	<p class="green"> &raquo; Documentation</p>
	<a href="/hypra/api/home">Home</a> | 	<a href="https://github.com/feminstincts/hypra/" target="_blank">GitHub</a>
</div>

<h3>Methods</h3>
<section>
	<h3>Test</h3>
	<p>
		<pre>
			<code>
				//request method/verb
				get($function)
				post($function)
				put($function)
				delete($function)

				//globally unique identifier
				guid()

				//cryptography
				password_encrypt($password)
				password_check($try_password, $password)
				generate_salt($salt_length)

				//refactorization of input
				model()

				//Account security
				verify($user)
				validate($user,$component)
				register($user)
				login($user)
				startRecovery($user)
				authorizeRecovery($recovery)

				//Identity
				getId()

				auth($function)


				//other methods
				json($content)
				redirect($location)

				//file Handling
				fileHandler($name,$file_name,$path)


				//Error handling
				customError($errno, $errstr)
				//mail
				Mailer($to,$subject,$msg)

			</code>
		</pre>
	<p>
		For more information, or if you have issues or concerns, see <a href="https://github.com/feminstincts/hypra/">GitHub</a>.
	</p>
</section>

<?php include("Views/Shared/footer.php"); ?>
