<?php

session_start();
if (!isset($_SESSION['user_id'])) die();

const MYSQL_SERVER = '127.0.0.1';
const MYSQL_USER = 'money';
const MYSQL_PSWD = 'Gg44gG77';
const MYSQL_DB = 'scopetrack';

if(isset($_GET['qtype']) == false) die('no qtype');

switch ($_GET['qtype']) {
    case "tasks":
        print load_tasks();
}

function load_tasks() {
    $mysqli = new mysqli(MYSQL_SERVER, MYSQL_USER, MYSQL_PSWD, MYSQL_DB);
    if (mysqli_connect_errno())
        die('Failed to connect to MySQL: ' . mysqli_connect_error());

    $stmt = $mysqli->prepare('
        SELECT
            task_id,
            task_title,
            task_impact,
            task_next_step,
            task_is_important,
            task_is_urgent
        FROM
            tasks
        WHERE
            task_owner = ?;
    ');
    if ($mysqli->errno)
        die('MySQL Error: ' . mysqli_error($mysqli) .
            " Error Code: " . $mysqli->errno);
    $stmt->bind_param('i', $_SESSION['user_id']);
    if ($mysqli->errno)
        die('MySQL Error: ' . mysqli_error($mysqli) .
            " Error Code: " . $mysqli->errno);
    $stmt->execute();
    $return = '';
    $stmt->bind_result(
        $task_id,
        $task_title,
        $task_impact,
        $task_next_step,
        $task_is_important,
        $task_is_urgent
    );
    while($stmt->fetch()) {
        $return = $return .
            $task_id . '\t' .
            $task_title . '\t' .
            $task_impact . '\t' .
            $task_next_step . '\t' .
            $task_is_important . '\t' .
            $task_is_urgent . '\n';
    }
    $stmt->close();
    $mysqli->close();
    
    return $return;
}
