<h1>Create Question</h1>
<div class="row">
    <div class="col-md-6">
        <form action="/questions/create" method="POST">
            <div class="mb-3">
                <input type="hidden" class="form-control" id="tests_id" name="tests_id" value="<?= $tests['id'] ?? '' ?>">
                <?php if (isset($errors['tests_id'])): ?>
                    <span class="text-danger"><?= $errors['tests_id'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="questions_text" class="form-label">questions_text</label>
                <input type="text_text" class="form-control" id="questions_text" name="questions_text">
                <?php if (isset($errors['questions_text'])): ?>
                    <span class="text-danger"><?= $errors['questions_text'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="option_a" class="form-label">option_a</label>
                <input type="text" class="form-control" id="option_a" name="option_a">
                <?php if (isset($errors['option_a'])): ?>
                    <span class="text-danger"><?= $errors['option_a'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="option_b" class="form-label">option_b</label>
                <input type="text" class="form-control" id="option_b" name="option_b">
                <?php if (isset($errors['option_b'])): ?>
                    <span class="text-danger"><?= $errors['option_b'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="option_c" class="form-label">option_c</label>
                <input type="text" class="form-control" id="option_c" name="option_c">
                <?php if (isset($errors['option_c'])): ?>
                    <span class="text-danger"><?= $errors['option_c'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="option_d" class="form-label">option_d</label>
                <input type="text" class="form-control" id="option_d" name="option_d">
                <?php if (isset($errors['option_d'])): ?>
                    <span class="text-danger"><?= $errors['option_d'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="correct_option" class="form-label">Đáp án đúng</label>
                <select class="form-select" id="correct_option" name="correct_option">
                    <option value="">-- Chọn đáp án đúng --</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
                <?php if (isset($errors['correct_option'])): ?>
                    <span class="text-danger"><?= $errors['correct_option'] ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
    <div class="col-md-6">

        <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
            <div class="card shadow p-4" style="width: 500px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Bài Kiểm Tra Trắc Nghiệm</h5>
                    <form id="quiz-form">
                        <div id="questions-container">
                            <?php foreach ($questions as $index => $question): if($tests['id']== $question['tests_id']){ ?>
                                <div class="mb-3">
                                    <p class="fw-bold"><?= htmlspecialchars($index + 1 . '. ' . $question['questions_text']) ?></p>
                                    <?php foreach (['a', 'b', 'c', 'd'] as $option): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="q<?= $index ?>" value="<?= $option ?>">
                                            <label class="form-check-label"><?= htmlspecialchars($question["option_$option"]) ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                    <input type="hidden" id="correct_q<?= $index ?>" value="<?= htmlspecialchars($question['correct_option']) ?>">
                                    <form action="/questions/delete/<?= $question['id']; ?>" method="POST"
                                        style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this question?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            <?php }endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-success w-100" onclick="checkAnswers()">Kiểm tra kết quả</button>
                    </form>
                    <p id="result" class="mt-3 text-center fw-bold"></p>
                </div>
            </div>

            <script>
                function checkAnswers() {
                    let totalQuestions = <?= count($questions) ?>;
                    let score = 0;

                    for (let i = 0; i < totalQuestions; i++) {
                        let selected = document.querySelector(`input[name="q${i}"]:checked`);
                        let correctAnswer = document.getElementById(`correct_q${i}`).value;

                        if (selected && selected.value === correctAnswer) {
                            score++;
                        }
                    }

                    document.getElementById('result').innerText = `Bạn đã trả lời đúng ${score} / ${totalQuestions} câu.`;
                }
            </script>
        </body>
    </div>
</div>