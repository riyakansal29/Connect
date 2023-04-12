<?php 
  if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $signupError = "";
  
    if(empty($fullname) || empty($username) || empty($password) || empty($email)) {
      $signupError = 'All feilds are required';
    } 

    else {
      $email = $getFromU->checkInput($email);
      $fullname = $getFromU->checkInput($fullname);
      $username = $getFromU->checkInput($username);
      $password = $getFromU->checkInput($password);
 
      if ($getFromU->checkEmail($email) === true){
        $signupError = "Email already registered";
      } 
      elseif ($getFromU->checkUsername($username) === true){
        $signupError = "Username already exists";
      }
      else{
        $user_id = $getFromU->create('users', array('email' => $email,'password' => md5($password), 'fullname' => $fullname, 'username' => $username, 'profileImage' =>'assets/images/defaultprofile1.png'));
        $_SESSION['user_id'] = $user_id;
        header('Location: home.php');
      }
    }
  }
 
?>


<?php
$form='
<div class="signup-div"> 
<form method="post" autocomplete="off">

	<h3>New user? Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="fullname" placeholder="Full Name">
		</li>
		<li>
		    <input type="text" name="username" placeholder="Username">
        <p>Username must be alphanumeric and be 5-20 characters long</p>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email">
        <p>Email must be a valid address, e.g. me@mydomain.com</p>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password">
      <p>Password must be alphanumeric (@, _, #, * and - are also allowed) and be 5-20 characters long</p>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup">
		</li>
	</ul> 
</form>
</div>';
echo $form;
?>

<?php  
		if (isset($signupError)) {
			echo '<li class="error-li">
	  		<div class="span-fp-error">' . $signupError . '</div>
			 </li>';
		}
?>

<script>
<?php

echo "let s_inputs=document.querySelectorAll('input');

const s_patterns={
    email:/^[a-z\d\.-]+@[a-z\d-]+\.[a-z]{2,8}(\.[a-z]{2,5})?$/,
    password:/^[\w@#*-]{5,20}$/,
    username:/^\w{5,20}$/i
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

    s_inputs.forEach((input)=>{
        input.addEventListener('keyup',(e)=>{
            console.log(e.target.attributes.name.value);
            validate(e.target, patterns[e.target.attributes.name.value]);
        });
    });
";
?>
</script>

