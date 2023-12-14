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