<?PHP
require_once("./include/user_config.php");
if(!$u->isLoggedIn()) {
    $u->redirectToURL("login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Task GoBanana Today!</title>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"
            charset="utf-8"></script>
        <script src="js/plugins/sprintf.js" charset="utf-8"></script>
        <script src="js/main.js" charset="utf-8"></script>
        <link type="text/css" rel="stylesheet" href="css/global.css"/>
    </head>
    <body>
        <div id="top_nav"></div>
        <div id="left_nav"></div>
        <div id="tasks">
            <div></div>
            <div></div>
        </div>
    </body>
</html>
