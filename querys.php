<?php

require_once 'db_conection.php';

class Query extends Connection {

    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function getCategory()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM categorias");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo ('Query error');
            echo $e->getMessage();
        }
    }

    public function getFecha()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM fecha");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo ('Query error');
            echo $e->getMessage();
        }
    }

    public function build_quiz($context)
    {
        $catg_data = $context['catg'];
        $fech_data = $context['fech'];
        $quest_num = $context['preg_numbers'];

        $quiz = array();
        $quest = $this->filter($catg_data, $fech_data);
        $rand_quest = $this->quest_Randomizer($quest, $quest_num);
        $quiz = $this->answersGetter($rand_quest);

        $json_quiz = array(
            'quiz' => $quiz,
            'time' => $context['time'],
            'q_num' => $quest_num,
            'is_tutor' => $context['is_tutor'],
        );
    
        return json_encode($json_quiz, JSON_UNESCAPED_UNICODE);
    }

    public function filter($catg_data, $fech_data)
    {   
        if($catg_data == "null" and $fech_data == "null") {
            $query = "SELECT * FROM preguntas";
        }
        else if($catg_data == "null") {
            $query = "SELECT * FROM preguntas WHERE fech_pre_ID = $fech_data";
        }
        else if($fech_data == "null") {
            $query = "SELECT * FROM preguntas WHERE cag_pre_ID = $catg_data";
        }
        else {
            $query = "SELECT * FROM preguntas WHERE cag_pre_ID = $catg_data AND fech_pre_ID = $fech_data";
        }
        try {
            $stm = $this->pdo->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo ('Query error');
            echo $e->getMessage();
        }
    }

    public function answersGetter($questions)
    {
        $builded_quiz = array();
        $i = 0;
        foreach ($questions as $value) {
            $id = $value->preg_ID;
            $au = array();
            try {
                $query_obj = $this->pdo->prepare("SELECT * FROM respuestas WHERE preg_id_rel = $id");
                $query_obj->execute();
                $answer = $query_obj->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo ('Query error');
                echo $e->getMessage();
            }
            $au[$i]['quest'] = $value;
            $au[$i]['answer'] = $answer;
            $i++;
            array_push($builded_quiz, $au);
        }
        return($builded_quiz);
    }

    public function quest_Randomizer($quest_list, $number)
    {
        $randomized_quest_list = array();
        $aux_array = array();

        if (count($quest_list) <= $number) {
            $aux_array = array_keys($quest_list);
            shuffle($aux_array);

            foreach ($aux_array as $value) {
                $randomized_quest_list[$value] = $quest_list[$value];
            };
        } else {
            $aux_array = array_rand($quest_list, $number);
            
            foreach ($aux_array as $value) {
                $randomized_quest_list[$value] = $quest_list[$value];
            };
        }

        return($randomized_quest_list);
    }

    public function insertQuiz($context)
    {
            $q_num = $context['quest_num'];
            $ans_corr = $context['answer_corr'];

        try {
            $query_obj = $this->pdo->prepare("INSERT INTO quiz_record (quiz_quest_num, answer) VALUES ( $q_num, $ans_corr)");
            $query_obj->execute();
            print_r("data saved");
        } catch (PDOException $e) {
            echo ('Query error');
            echo $e->getMessage();
        }
    }
}



?>


