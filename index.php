<?php

/**
 * @file
 * Simple script for direct executing entered PHP.
 *
 * This script is ABSOLUTELY NOT SECURE.
 * It should be used only locally and as a tool for development.
 * If placed on a webserver, it can be used for almost any type of attack that
 * you can think of, because it will allow the users to execute PHP directly
 * on the server.
 *
 * Created by: Topsitemakers
 * http://www.topsitemakers.com/
 */

require dirname(__FILE__) . '/krumo/class.krumo.php';

// Prevent XSS via $_SERVER['PHP_SELF']
$php_self = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Execute PHP code</title>
<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link type="text/css" rel="stylesheet" href="//necolas.github.com/normalize.css/2.0.1/normalize.css" />
<style type="text/css">
#main {
  width: 800px;
  margin: 40px auto;
  text-align: center;
  background: #F9F9F9;
  padding: 30px;
}
#output {
  text-align: left;
  padding-top: 5px;
  margin-top: 20px;
  border-top: 1px solid #DDD;
  float: left;
  width: 100%;
}
#code {
  width: 780px;
  padding: 10px;
  margin: 7px 10px 20px 0;
  float: left;
  height: 160px;
  font-family: monospace;
}
#code:focus {
  outline: 0;
}
/* Add some fancyness */
/* http://hellohappy.org/css3-buttons/ */
#submit {
  background: #4162a8;
  border-top: 1px solid #38538c;
  border-right: 1px solid #1f2d4d;
  border-bottom: 1px solid #151e33;
  border-left: 1px solid #1f2d4d;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 10px 1px #5c8bee, 0px 1px 0 #1d2c4d, 0 6px 0px #1f3053, 0 8px 4px 1px #111111;
  box-shadow: inset 0 1px 10px 1px #5c8bee, 0px 1px 0 #1d2c4d, 0 6px 0px #1f3053, 0 8px 4px 1px #111111;
  color: #fff;
  font: bold 20px/1 "helvetica neue", helvetica, arial, sans-serif;
  padding: 10px 0 12px 0;
  text-align: center;
  text-shadow: 0px -1px 1px #1e2d4d;
  width: 803px;
  -webkit-background-clip: padding-box;
  margin: 4px 0 10px 0;
}
#submit:hover {
  -webkit-box-shadow: inset 0 0px 20px 1px #87adff, 0px 1px 0 #1d2c4d, 0 6px 0px #1f3053, 0 8px 4px 1px #111111;
  box-shadow: inset 0 0px 20px 1px #87adff, 0px 1px 0 #1d2c4d, 0 6px 0px #1f3053, 0 8px 4px 1px #111111;
  cursor: pointer;
}
#submit:active {
  -webkit-box-shadow: inset 0 1px 10px 1px #5c8bee, 0 1px 0 #1d2c4d, 0 2px 0 #1f3053, 0 4px 3px 0 #111111;
  box-shadow: inset 0 1px 10px 1px #5c8bee, 0 1px 0 #1d2c4d, 0 2px 0 #1f3053, 0 4px 3px 0 #111111;
  margin: 8px 0 6px 0;
}
#main ul.krumo-node {
  font-family: Helvetica;
  font-size: 13px;
}
</style>
<script type="text/javascript">
// Focus the input box on page load
window.onload = function() {
  document.getElementById('code').focus();
}
</script>
</head>
<body>

<div id="main">

  <form action="<?php print $php_self; ?>" method="post">
    <textarea id="code" name="code" placeholder="Type code here. Return values to make use of krumo's display."><?php isset($_POST['code']) ? print $_POST['code'] : ''; ?></textarea>
    <input type="submit" value="Execute code" id="submit">
  </form>

  <?php if ($_POST): ?>
  <div id="output"><?php krumo::dump(eval($_POST['code'])); ?></div>
  <?php endif; ?>

  <div style="display: block; clear: both;"></div>

</div>

</body>
</html>
