<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4 text-primary fw-bold">
                        <?= htmlspecialchars($test['title']) ?>
                    </h3>

                    <form id="quiz-form" method="POST" action="/submitQuiz/<?= $test['id'] ?>">
                        <div id="questions-container">
                            <?php foreach ($questions as $index => $question): ?>
                                <div class="mb-4">
                                    <p class="fw-semibold mb-2"><?= ($index + 1) . ". " . htmlspecialchars($question['questions_text']) ?></p>
                                    <?php foreach (['a', 'b', 'c', 'd'] as $option): ?>
                                        <div class="form-check mb-1">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                name="q<?= $index ?>"
                                                value="<?= $option ?>"
                                                data-question-id="<?= $question['id'] ?>"
                                                id="q<?= $index ?>_<?= $option ?>"
                                                <?= ($question['user_answer'] == $option) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="q<?= $index ?>_<?= $option ?>">
                                                <?= htmlspecialchars($question["option_$option"]) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                    <input type="hidden" id="correct_q<?= $index ?>" value="<?= htmlspecialchars($question['correct_option']) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="button" id="check-btn" class="btn btn-success btn-lg" onclick="checkAnswers()">✅ Kiểm tra kết quả</button>
                            <button type="button" id="retry-btn" class="btn btn-warning btn-lg" style="display: none;" onclick="resetQuiz()">🔁 Làm lại</button>
                            <button type="submit" id="submit-btn" class="btn btn-primary btn-lg" style="display: none;">📤 Gửi bài</button>
                        </div>

                        <div id="result" class="mt-4 text-center fw-bold fs-5 text-info"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript giữ nguyên -->
<script>
    function checkAnswers() {
        let totalQuestions = <?= count($questions) ?>;
        let score = 0;
        let userAnswers = [];

        for (let i = 0; i < totalQuestions; i++) {
            let selected = document.querySelector(`input[name="q${i}"]:checked`);
            let correctAnswer = document.getElementById(`correct_q${i}`).value;

            if (selected) {
                let questionId = selected.getAttribute("data-question-id");
                userAnswers.push({
                    question_id: questionId,
                    selected_option: selected.value
                });
                if (selected.value === correctAnswer) {
                    score++;
                }
            }
        }

        // Thêm input ẩn tại đây – chỉ 1 lần
        let existingInput = document.querySelector('input[name="user_answers"]');
        if (!existingInput) {
            let userAnswersInput = document.createElement("input");
            userAnswersInput.type = "hidden";
            userAnswersInput.name = "user_answers";
            userAnswersInput.value = JSON.stringify(userAnswers);
            document.getElementById('quiz-form').appendChild(userAnswersInput);
        }

        let resultText = `🎯 Bạn đã trả lời đúng ${score} / ${totalQuestions} câu.`;
        document.getElementById('result').innerText = resultText;

        document.getElementById('check-btn').style.display = 'none';
        if (score === totalQuestions) {
            document.getElementById('submit-btn').style.display = 'block';
        } else {
            document.getElementById('retry-btn').style.display = 'block';
        }
    }


    function resetQuiz() {
        let totalQuestions = <?= count($questions) ?>;
        for (let i = 0; i < totalQuestions; i++) {
            document.querySelectorAll(`input[name="q${i}"]`).forEach(option => option.checked = false);
        }

        document.getElementById('result').innerText = "";
        document.getElementById('check-btn').style.display = 'block';
        document.getElementById('retry-btn').style.display = 'none';
        document.getElementById('submit-btn').style.display = 'none';
    }
</script>