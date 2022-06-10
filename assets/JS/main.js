$(document).ready(function() {

    
    let quiz_data
    let count = 0
    let reps_counter = Array()

    //Quiz data submit
    $('#quiz_form').submit(function(event) {
        let tutor_val

        if ($('#tutor').is(":checked")) {
            tutor_val = 'on'
        }
        else {
            tutor_val = 'off'
        }

        const data = {
            catg: $('#catg').val(),
            fech: $('#fech').val(),
            preg_numbers: $('#preg_numbers').val(),
            time: $('#time').val(),
            tutor: tutor_val,
        }
        $.ajax({
            url: 'builder.php',
            type: 'POST', 
            data: data, 
            success: function(resp) {
            quiz_data = JSON.parse(resp)         
        }});
        event.preventDefault()
        $('#form-card').hide()
        $('#quiz_message').show()
    })

    //Quiz starter
    $('#quiz_start').click(function(event) {
        
        if (quiz_data.is_tutor == 'on') {
            $('#tutor_btn').show()
        }
        startTimer()
        getNewQuest()
        $('#quiz_message').hide()
    })

    // One check validator
    $('.form-check').children(':input').click(function (event) {
        let checks = $('.form-check').children(':input')
        for (let index = 0; index < checks.length; index++) {
            const element = checks[index];
            if (element != event.target) {
                element.checked = false
            }
        }    
    })

    //display tutor content
    $('#tutor_btn').click(function () {
        $('#tutor_card').show()
    })

    //trigger next question
    $('#next_quest_btn').click(function() {
        localSave()
        count++
        if (count <= quiz_data.q_num-1) {
            getNewQuest()
        }
        else{
            console.log('terminado')
            endQuiz()
        }
    })

    $('#end').click(function (event) {
        location.reload(true)
    })


    function getNewQuest() {
        let quiz_header =  $('#quest')
        let tutor_desc = $('#tutor_area')
        let check = $('.form-check').children(':input')
        let labels = $('.form-check-label')

        quiz_header.text(quiz_data.quiz[count][count].quest.Pregunta)
        tutor_desc.text(quiz_data.quiz[count][count].quest.tutor_descrip) 
    
        for (let i = 0; i < check.length; i++) {
            const element = check[i];
            try {
                element.setAttribute('value', quiz_data.quiz[count][count].answer[i].validador)
                element.checked = false
            } catch (error) {
                console.log(error)
            }
        }
        for (let j = 0; j < labels.length; j++) {
            const element = labels[j];
            try {
                element.innerHTML = quiz_data.quiz[count][count].answer[j].respuesta
            } catch (error) {
                console.log(error)
            }
        
        }
        $('#quiz_content').show()
    }

    function localSave() {
        let checks = $('.form-check').children(':input')
        let valid
        let blank = 0
        for (let i = 0; i < checks.length; i++) {
            const element = checks[i];
            if (element.checked == true) {
                valid = element.getAttribute('value')
            }
            else{
                blank++
            }
        }
        if (blank == 4) {
            valid = 0
        }
        reps_counter.push(valid)

    }

    function startTimer() {
        let quiz_time = quiz_data.time
        let time = quiz_time * 60
        let timer_ele = $('#timer')

        const setTimer = setInterval(() => {
            let minutes = Math.floor(time/60)
            let seconds = time % 60

            seconds = seconds < 10 ?  '0' + seconds: seconds

            timer_ele.text(minutes+':'+seconds)
            
            if (time<=0) {
                clearInterval(setTimer)
                endQuiz()
            }
            else{
                time--
            }
        }, 1000);
    }

    function endQuiz() {

        $('#quiz_result').show()

        let correct = 0
        reps_counter.forEach(element => {
            if (element == 1) {
                correct++
            }
        });

        $('#result').text(correct+'/'+quiz_data.q_num)

        let quiz_post_data = {
            quest_num: quiz_data.q_num,
            answer_corr: correct,
        }
        console.log(quiz_post_data)
        $.ajax({
            url: 'quiz.php',
            type: 'POST', 
            data: quiz_post_data, 
            success: function(resp) {
                console.log(resp)
        }});
    }
})

