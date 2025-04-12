<div class="col-md-6">

    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card shadow p-4" style="width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center"><?= htmlspecialchars($test['title']) ?></h5>
                <form id="quiz-form" method="POST" action="/submitQuiz/<?= $test['id'] ?>">
                    <div id="questions-container">
                        <?php foreach ($questions as $index => $question): ?>
                            <div class="mb-3">
                                <p class="fw-bold"><?= htmlspecialchars($index + 1 . '. ' . $question['questions_text']) ?></p>
                                <?php foreach (['a', 'b', 'c', 'd'] as $option): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="q<?= $index ?>"
                                            value="<?= $option ?>"
                                            data-question-id="<?= $question['id'] ?>"
                                            <?= ($question['user_answer'] == $option) ? 'checked' : '' ?>
                                        >
                                        <label class="form-check-label"><?= htmlspecialchars($question["option_$option"]) ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <input type="hidden" id="correct_q<?= $index ?>" value="<?= htmlspecialchars($question['correct_option']) ?>">
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <button type="button" id="check-btn" class="btn btn-success w-100" onclick="checkAnswers()">Kiểm tra kết quả</button>
                    <button type="button" id="retry-btn" class="btn btn-warning w-100 mt-2" style="display: none;" onclick="resetQuiz()">Làm lại bài kiểm tra</button>
                    <button type="submit" id="submit-btn" class="btn btn-primary w-100 mt-2" style="display: none;">Gửi bài</button>
                </form>
                <p id="result" class="mt-3 text-center fw-bold"></p>
            </div>
        </div>

        <script>
            function checkAnswers() {
                let totalQuestions = <?= count($questions) ?>;
                let score = 0;
                let userAnswers = [];

                for (let i = 0; i < totalQuestions; i++) {
                    let selected = document.querySelector(`input[name="q${i}"]:checked`);
                    let correctAnswer = document.getElementById(`correct_q${i}`).value;

                    // Lấy question_id từ thuộc tính data-question-id thay vì sử dụng index
                    let questionId = document.querySelector(`input[name="q${i}"]`).getAttribute("data-question-id");

                    // Lưu câu trả lời người dùng đã chọn
                    if (selected) {
                        userAnswers.push({
                            question_id: questionId, // Lưu đúng question_id từ cơ sở dữ liệu
                            selected_option: selected.value
                        });
                    }

                    // Tính điểm
                    if (selected && selected.value === correctAnswer) {
                        score++;
                    }
                }

                let resultText = `Bạn đã trả lời đúng ${score} / ${totalQuestions} câu.`;
                document.getElementById('result').innerText = resultText;

                let checkBtn = document.getElementById('check-btn');
                let retryBtn = document.getElementById('retry-btn');
                let submitBtn = document.getElementById('submit-btn');

                checkBtn.style.display = 'none';

                if (score === totalQuestions) {
                    submitBtn.style.display = 'block';
                } else {
                    retryBtn.style.display = 'block';
                }

                // Lưu câu trả lời vào form dưới dạng ẩn
                document.getElementById('quiz-form').onsubmit = function() {
                    let userAnswersInput = document.createElement("input");
                    userAnswersInput.type = "hidden";
                    userAnswersInput.name = "user_answers";
                    userAnswersInput.value = JSON.stringify(userAnswers);
                    this.appendChild(userAnswersInput);
                };
            }


            function resetQuiz() {
                let totalQuestions = <?= count($questions) ?>;

                for (let i = 0; i < totalQuestions; i++) {
                    let options = document.querySelectorAll(`input[name="q${i}"]`);
                    options.forEach(option => option.checked = false);
                }

                document.getElementById('result').innerText = "";
                document.getElementById('check-btn').style.display = 'block';
                document.getElementById('retry-btn').style.display = 'none';
                document.getElementById('submit-btn').style.display = 'none';
            }
        </script>
    </body>
</div>
