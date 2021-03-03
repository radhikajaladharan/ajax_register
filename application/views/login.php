<!DOCTYPE html>
<html>
<head>
<title>first site</title>
<style>
  table,td{
    padding: 20px;
    font-size: 20px;
  }

h1{
  text-align: center;
  color: white;
  font-size: 35px;
}
  </style>
</head>
<body>
  <form style="margin-left: 450px" action="<?php echo base_url()?>main/log" method="post">
    <fieldset style="width:100px;height:400px;background-color: black; margin-top: 100px;">
      <legend style="color: white"><strong></strong></legend>
      <h1>Login</h1>
    <table>
      <tr>
        <td style="color: white;">
    Email/Username/PhNO:</td>
    <td><input type="text" name="email" ></td>
  </tr>

    <tr><td style="color: white;">Password:</td>
    <td><input type="password" name="password"></td></tr>
    <tr><td><input type="submit" name="Login" value="Login" style="width: 60px;"></td></tr>
    <tr><td><a href="<?php echo base_url()?>main/forgotpassword" class="nav-link text-white">Forgot password</a></td></tr>

  </table>
</fieldset>


  </form>
</body>
</html>