<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-gap {
            padding-top: 70px;
        }
        .panel-default {
            margin-top: 20px;
        }
        .panel-body {
            padding: 30px;
        }
        .form-group, .input-style {
            margin-bottom: 15px;
        }
        .btn-block {
            margin-top: 20px;
        }
        .input-style label {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>  
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center"> 
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <form action="{{ route('forgotpassword') }}" role="form" autocomplete="off" class="form" method="post" onsubmit="return validatePasswords()">
                    @csrf
                    <input value="{{ $email }}" class="form-control" name="email" type="hidden">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-at color-blue"></i></span>
                            <input value="{{ $email }}" class="form-control" name="email" type="email" disabled>
                          
                        </div>
                    </div>
                    <div class="input-style input-style-always-active has-borders validate-field mt-4">
                        <label for="form6" class="color-blue-dark font-13" style="float:left;">New Password</label>
                        <input type="password" name="new_password" placeholder="Enter New Password" class="form-control" id="form6">
                        <small id="passwordError" class="text-danger" style="display: none;">Passwords do not match</small>
                    </div>
                    <div class="input-style input-style-always-active has-borders validate-field mt-4">
                        <label for="form7" class="color-blue-dark font-13" style="float:left;">Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm new Password" class="form-control" id="form7">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                </form>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
   <script>
                    function validatePasswords() {
                        var newPassword = document.getElementById('form6').value;
                        var confirmPassword = document.getElementById('form7').value;
                        var passwordError = document.getElementById('passwordError');
                
                        if (newPassword !== confirmPassword) {
                            passwordError.style.display = 'block';
                            return false;
                        } else {
                            passwordError.style.display = 'none';
                            return true;
                        }
                    }
</script>
</body>
</html>
