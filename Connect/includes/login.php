
<?php
  if (isset($_POST['login']) && !empty($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    if(!empty($email) || !empty($password)) {
      $email = $getFromU->checkInput($email);
      $password = $getFromU->checkInput($password);
  
    	if($getFromU->login($email, $password) === false) {
        	$error = "The email or password is incorrect"; 
    	}
    } 
	else {
      $error = "Please enter email and password!";
    }
  }
  ?>

<?php
  $form='<div class="login-div">
<h3>Login</h3>
<form method="post"> 
	<ul>
		<li>
		  <input type="text" name="email" id="email" placeholder="Email">
		  <p>Email must be a valid address, e.g. me@mydomain.com</p>
		</li>
		<li>
		  <input type="password" name="password" id="password" placeholder="Password">
		  <p>Password must be alphanumeric (@, _, #, * and - are also allowed) and be 5-20 characters</p>
		</li>
		<li>
			<input type="submit" name="login" id="submit" value="Login">
		</li>
	
	
	 </ul>
	</form>
	
</div>';
echo $form;
// echo '<script src="assets/js/script.js"></script>';
?>

<?php 
		if (isset($error)) {
			echo "<li class=`error-li`>
	  				<div class='span-fp-error'> . $error . </div>
	 			</li>";
		}
?>

<script>
<?php

echo "let inputs=document.querySelectorAll('input');

const patterns={
    email:/^[a-z\d\.-]+@[a-z\d-]+\.[a-z]{2,8}(\.[a-z]{2,5})?$/,
    password:/^[\w@#*-]{5,20}$/
};

    function validate(field, regex){
        console.log(regex.test(field.value));
        if(regex.test(field.value)){
            field.className='valid'; 
            return 0;
        }
        field.className='invalid';
        // const invalid=document.getElementsByClassName('invalid');
        // invalid.nextElementSibling.style.color='red';
        return 0;
    }

    inputs.forEach((input)=>{
        input.addEventListener('keyup',(e)=>{
            console.log(e.target.attributes.name.value);
            validate(e.target, patterns[e.target.attributes.name.value]);
        });
    });
";
?>
</script>


