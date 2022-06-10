<?php

require_once 'querys.php';

$query = new Query();

$context = array(
    'catg' => $_POST['catg'], 
    'fech' => $_POST['fech'],
    'time' => $_POST['time'],
    'preg_numbers' => $_POST['preg_numbers'],
    'is_tutor' => $_POST['tutor'],
);

$quiz = $query->build_quiz($context);

print_r($quiz);
//header('location:quiz.php', TRUE, 200);
?>