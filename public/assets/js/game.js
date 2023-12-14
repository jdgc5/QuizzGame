    $(document).ready(function() {
        getNextQuestion();
    });

    function getNextQuestion() {
        $.ajax({
            url: '{{ route("getRandomQuestion") }}', 
            type: 'GET',
            success: function(data) {
                
                $('#question').text(data.question); 

                
                $('#answers').empty(); 
                $.each(data.answers, function(index, answer) {
                    $('#answers').append(`
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="answer${index + 1}" value="${index + 1}">
                            <label class="form-check-label" for="answer${index + 1}">${answer}</label>
                        </div>
                    `);
                });
            }
        });
    }

    
    function checkAnswer() {

    }

