<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hypra</title>
  </head>
  <body>

		<div class="jumbotron jumbotron-fluid text-center">
		  <h1 class="m-4 display-4 text-primary">Hypra</h1>
		  <p class="m-4 lead">A micro framework for building restful api with PHP</p>
		  <a class="btn btn-primary btn-lg" href="./home/doc" role="button">Get Started</a> 
		  <a class="btn btn-secondary btn-lg" href="https://github.com/feminstincts/hypra" role="button">GitHub Repo</a> 
		</div>

		<div class="container m-4">
			<h3 class="p-4 display-5 text-center">Documentation</h3>
			<hr/>
			<div class="row text-left">
				<div class="col-md-6">
					<div class="card m-2 shadow" style="height: 320px;">
						<div class="card-body">
							<h5 class="card-title text-capitalize">request method / verb</h5>
							<p class="card-text">
								<code>
									get($function);
								</code>
								<br/>
								<code>
									post($function);
								</code>
								<br/>
								<code>
									put($function);
								</code>
								<br/>
								<code>
									delete($function);
								</code>
							</p>
							<a href="#" class="card-link">Details</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card m-2 shadow" style="height: 320px;">
						<div class="card-body">
							<h5 class="card-title text-capitalize">cryptography</h5>
							<p class="card-text">
								<code>
									password_encrypt($password);
								</code>
								<br/>
								<code>
									password_check($try_password, $password);
								</code>
								<br/>
								<code>
									generate_salt($salt_length);
								</code>
							</p>
							<a href="#" class="card-link">Details</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card m-2 shadow" style="height: 320px;">
						<div class="card-body">
							<h5 class="card-title text-capitalize">Account Authorization / Authentication</h5>
							<p class="card-text">
								<code>
									//user acount setup
									verify($user);
								</code>
								<br/>
								<code>
									validate($user,$component);
								</code>
								<br/>
								<code>
									register($user);
								</code>
								<br/>
								<code>
									login($user);
								</code>
								<br/>
								<code>
									startRecovery($user);
								</code>
								<br/>
								<code>
									authorizeRecovery($recovery);
								</code>
								<br/>
								<code>
									//Identity
									getId();
								</code>
								<br/>
								<code>
									auth($function);
								</code>
							</p>
							<a href="#" class="card-link">Details</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card m-2 shadow" style="height: 320px;">
						<div class="card-body">
							<h5 class="card-title text-capitalize">utilities</h5>
							<p class="card-text">
								<code>
									//globally unique identifier
									guid();
								</code>
								<br/>
								<code>
									//refactorization of input
									model();
								</code>
								<br/>
								<code>
									//other methods
									json($content);
								</code>
								<br/>
								<code>
									redirect($location);
								</code>
								<br/>
								<code>
									//file Handling
									fileHandler($name,$file_name,$path);
								</code>
								<br/>
								<code>
									//Error handling
									customError($errno, $errstr);
								</code>
								<br/>
								<code>
									//mail
									Mailer($to,$subject,$msg);
								</code>
							</p>
							<a href="#" class="card-link">Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="p-4 container text-center">
			&copy; Hypra <script type="text/javascript">document.write(new Date().getFullYear());</script>
			an Initiative of <a href="https://github.com/feminstincts/hypra/">Instincts</a>
		</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>