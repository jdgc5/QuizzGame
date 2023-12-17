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
    
    <div class="container mb-5">
        <div class="card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center" id="question">Question here</h3>
                    <div class="form-group text-center" id="answers">
                    </div>
                </div>
            </div>
                <button class="btn btn-primary btn-answer" onclick="checkAnswer()">Submit Answer</button>
            <div class="exit d-inline-block w-100 p-3">
                <div class="row align-items-center justify-content-center">
                    <div class="col-6 text-center">
                        <button class="btn btn-danger p-1 px-4 " onclick="exitGame()">Exit</button>
                    </div>
                    <div class="col-6 text-center">
                        <p class="mt-3 text-center subText">Questions answered correctly: <span id="correctCount">0</span>/<span id="totalQuestions">0</span></p>
                    </div>
                </div>
            </div>
                <div id="endGameButtons" style="display: none;" class="text-center">
                    <button class="btn btn-success mr-2" onclick="restartGame()">Try Again</button>
                    
                </div>
            </div>
        </div>
    </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        
let currentQuestionIndex = 0;
let correctCount = 0;
let totalQuestions = 5;
const questions = @json($questions);

function displayQuestion() {
    if (currentQuestionIndex < questions.length) {
        const question = questions[currentQuestionIndex];
        $('#totalQuestions').text(totalQuestions);
        $('#question').text(question.question);
        $('#answers').empty();

        question.answers.forEach((answer, index) => {
            const answerId = `answer${index}`;
            $('#answers').append(`
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="${answerId}" value="${index}">
                    <label id="answer" class="form-check-label" for="${answerId}">${answer.answer_text}</label>
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
            $(`#answer${selectedAnswerIndex}`).siblings('label').addClass('bg-success');
            correctCount++;
            $('#correctCount').text(correctCount);
        } else {
            $(`#answer${selectedAnswerIndex}`).siblings('label').addClass('bg-danger'); 
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
        
        $('#answer').click(function() {
        $(this).toggleClass('selected');
});

        
    </script>
</html>
