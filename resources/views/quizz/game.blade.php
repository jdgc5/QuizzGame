<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('assets/css/game.css')}}" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <h1 class="mb-4">Welcome to the Game!</h1>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center" id="question">Question goes here</h3>
                <div class="form-group text-center" id="answers">
                </div>
                <button class="btn btn-primary btn-answer" onclick="checkAnswer()">Submit Answer</button>
                <p class="mt-3 text-center">Questions answered correctly: <span id="correctCount">0</span></p>
                <div id="endGameButtons" style="display: none;" class="text-center">
                    <button class="btn btn-success mr-2" onclick="restartGame()">Try Again</button>
                    <button class="btn btn-danger" onclick="exitGame()">Exit</button>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        
let currentQuestionIndex = 0;
let correctCount = 0;
const questions = @json($questions);

function displayQuestion() {
    if (currentQuestionIndex < questions.length) {
        const question = questions[currentQuestionIndex];

        $('#question').text(question.question);
        $('#answers').empty();

        question.answers.forEach((answer, index) => {
            const answerId = `answer${index}`;
            $('#answers').append(`
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="${answerId}" value="${index}">
                    <label class="form-check-label" for="${answerId}">${answer.answer_text}</label>
                </div>
            `);
        });
    } else {
        $('#question').text('Game Over');
        $('#answers').empty();
    }
}


function checkAnswer() {
    const selectedAnswerIndex = parseInt($('input[name="answer"]:checked').val());
    const correctAnswerIndex = questions[currentQuestionIndex].answers.findIndex(answer => answer.is_correct);

        if (selectedAnswerIndex === correctAnswerIndex) {
            $(`#answer${selectedAnswerIndex}`).parent().css('color', 'green');
            correctCount++;
            $('#correctCount').text(correctCount);
        } else {
            $(`#answer${selectedAnswerIndex}`).parent().css('color', 'red');
        }
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            setTimeout(() => {
                displayQuestion();
            }, 1200);
        } else {
            displayEndGameButtons();
        }
    }

        $(document).ready(function() {
            displayQuestion();
        });
        
        function displayEndGameButtons() {
            $('#endGameButtons').show();
            $('.btn-answer').prop('disabled', true);
        }

        function restartGame() {
            currentQuestionIndex = 0;
            correctCount = 0;
            $('#correctCount').text(correctCount);
            displayQuestion();
            $('#endGameButtons').hide();
            $('.btn-answer').prop('disabled', false);
        }

        function exitGame() {
            window.location.href = '../quizz';
        }
        
        function finishGame() {
            const currentDate = new Date().toISOString(); // Obtener la fecha y hora actual
        
            const answeredQuestions = questions.slice(0, currentQuestionIndex).map((question, index) => {
                const selectedAnswerIndex = parseInt($(`input[name="answer"]:checked`, `#answers${index}`).val());
                const correctAnswerIndex = question.answers.findIndex(answer => answer.is_correct);
        
                return {
                    question: question.question,
                    selectedAnswer: question.answers[selectedAnswerIndex].answer_text,
                    correctAnswer: question.answers[correctAnswerIndex].answer_text,
                    isCorrect: selectedAnswerIndex === correctAnswerIndex
                };
            });
        
            // Objeto con la información a enviar al backend
            const dataToSend = {
                user_id: 1, // ID del usuario actual (debe ajustarse según tu lógica)
                date: currentDate, // Fecha y hora de la partida
                correct_answers: correctCount, // Número de respuestas correctas
                total_questions: questions.length, // Total de preguntas jugadas
                answered_questions: answeredQuestions // Preguntas y respuestas contestadas
            };
        
            
            $.ajax({
                url: 'quizz/save-game', // Ruta correspondiente al backend para guardar la partida
                method: 'POST',
                data: dataToSend,
                success: function(response) {
                    window.location.href = '/history'; // Redirige al historial de partidas
                },
                error: function(error) {
                    console.error(error);
                    // Manejar el error si ocurre
                }
            });
        }


        
    </script>
    

</html>
