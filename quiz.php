<?php

require_once('querys.php');

$query = new Query();

$context = array(
    'quest_num' => $_POST['quest_num'], 
    'answer_corr' => $_POST['answer_corr'],
);

$resp = $query->insertQuiz($context);
print_r($context);

?>