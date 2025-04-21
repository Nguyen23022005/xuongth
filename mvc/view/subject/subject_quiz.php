<?php
$showForm = true;

foreach ($answers as $answer) {
    if (
        $answer['user_id'] === $_SESSION['user']['id'] &&
        $answer['test_id'] === $test['id'] &&
        !empty($answer['question_id'])
    ) {
        $showForm = false;
        break;
    }
}
?>
<div class="page-title" data-aos="fade">
    <nav class="breadcrumbs">
        <div class="container">
            <ol>
                <li class="current">
                    <h4><?= htmlspecialchars($test['title']) ?></h4>
                </li>
            </ol>
        </div>
    </nav>
</div><!-- End Page Title -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-4">
                    <?php if ($showForm): ?>
                        <form id="quiz-form" method="POST" action="/submitQuiz/<?= $test['id'] ?>">
                            <div id="questions-container">
                                <?php foreach ($lessons as $lesson): ?>
                                    <?php if ($lesson['id'] === $test['lessons_id']): ?>
                                        <?php foreach ($subjects as $subject): ?>
                                            <?php if ($subject['id'] === $lesson['subject_id']): ?>
                                                <input type="hidden" name="subject_id" value="<?= htmlspecialchars($subject['id']) ?>">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>

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
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                            <div class="d-grid gap-2 mt-4" style="width:10%;">
                                <button type="button" id="check-btn" class="btn btn-success btn-lg" onclick="checkAnswers()"> Kiểm Tra </button>
                                <button type="button" id="retry-btn" class="btn btn-warning btn-lg" style="display: none;" onclick="resetQuiz()"> Làm Lại</button>
                                <button type="submit" id="submit-btn" class="btn btn-primary btn-lg" style="display: none;">Nộp Bài</button>
                            </div>

                            <div id="result" class="mt-4 fs-5 " style="color:#5FCF80"></div>
                        </form>
                    <?php else: ?>
                        <br><br><br>
                        <p class="text-center text-success fs-5">✅ Bạn đã hoàn thành bài test này.</p>
                        <div class="text-center d-flex justify-content-center gap-3">
                            <a href="/" class="btn btn-outline-success">Quay Lại</a>
                        </div>
                        <br><br><br>
                    <?php endif; ?>

                </div>
            </div>
        </div>
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

        // Chỉ thêm input nếu chưa có
        let existingInput = document.querySelector('input[name="user_answers"]');
        if (!existingInput) {
            let userAnswersInput = document.createElement("input");
            userAnswersInput.type = "hidden";
            userAnswersInput.name = "user_answers";
            userAnswersInput.value = JSON.stringify(userAnswers);
            document.getElementById('quiz-form').appendChild(userAnswersInput);
        }

        let resultText = `Bạn đã trả lời đúng ${score} / ${totalQuestions} câu.`;
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