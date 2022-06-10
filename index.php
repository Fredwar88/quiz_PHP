<?php 

require_once 'querys.php';

$query = new Query();
$catg = $query->getCategory(); 
$fech = $query->getFecha();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-0 m-5" id="form-card">
                <div class="card-header">
                    <h3>Especificaiones del Quiz</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="quiz_form">
                        <div class="form-group">
                        <label for="catg" class="form-label">Categorias</label>
                        <select id="catg">
                            <option value="null">---</option>
                            <?php 
                            foreach($catg as $value):
                            ?>
                            <option value="<?php print_r($value->cagt_ID); ?>"><?php print_r($value->nombre); ?></option>
                            <?php 
                            endforeach;
                            ?>
                        </select>
                        <label for="fech" class="form-label">Fecha</label>
                        <select id="fech">
                            <option value="null">---</option>
                            <?php 
                            foreach($fech as $value):
                            ?>
                            <option value="<?php print_r($value->fech_ID); ?>"><?php print_r($value->fecha); ?></option>
                            <?php 
                            endforeach;
                            ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <div class="mt-2">
                            <label for="preg_numbers" class="form-label">Indica el num de preguntas</label>
                            <input type="number" name="preg_numbers" id="preg_numbers" min="5" max="100" value="5" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="time" class="form-label">Minutos que durará el quiz</label>
                            <input type="number" name="time" id="time" min="5" max="60" value="5" class="form-control">
                        </div>
                        <div class="mt-2">
                            <label for="tutor" class="form-label">Modo Tutor</label>
                            <input type="checkbox" name="tutor" id="tutor" class="form-check-input" style="margin-top: 6px; margin-left: 3px;">
                        </div>
                        </div>
                        <div class="text-end">
                            <input type="submit" value="Enviar" class="btn btn-primary" id="quiz-form">
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card m-5" id="quiz_message" style="display: none;">
                <div class="card-body text-center">
                    <h3> Tu Quiz esta listo! Preciona el boton cuando quiera comenzar.</h3>
                </div>
                <div class="text-center mb-3">
                    <button class="btn btn-success" id="quiz_start">Empezar</button>
                </div>
            </div>

            <div class="card m-5 p-0" id="quiz_content" style="display: none;">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="text-center" id="quest"></h4>
                        <h5 id="timer"></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" >
                        <div class="input-group" id="answer-group">
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" name="" id="" class="form-check-input">
                                    <label for="" class="form-check-label">a</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="" id="" class="form-check-input">
                                    <label for="" class="form-check-label">b</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" name="" id="" class="form-check-input">
                                    <label for="" class="form-check-label">c</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="" id="" class="form-check-input">
                                    <label for="" class="form-check-label">d</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-dark" id="tutor_btn" style="display: none;">Tutoria</button>    
                        <button class="btn btn-success ms-2" id="next_quest_btn">Siguiente</button>
                    </div>
                </div>
                <div class="card mt-5" id="tutor_card" style="display: none;">
                    <div class="card-body">
                        <p id="tutor_area"></p>
                    </div>
                </div>
            </div>

            <div class="card m-5" id="quiz_result" style="display: none;">
                <div class="card-body text-center" >
                    <h3>El Resultado de tu quiz es..</h3>
                    <h5 id="result"></h5>
                </div>
                <div class="text-center">
                    <button class="btn btn-success mb-3" id="end">Listo</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/JS/Jquery.js"></script>
    <script src="assets/JS/main.js"></script>
</body>
</html>