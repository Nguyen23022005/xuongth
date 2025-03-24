            <div class="card shadow p-4" style="width: 500px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Bài Kiểm Tra Trắc Nghiệm</h5>
                    <form id="quiz-form">
                        <div id="questions-container">
                            <?php foreach ($questions as $index => $question): if($tests['id']== $question['tests_id'] ){?>
                                <div class="mb-3">
                                    <p class="fw-bold"><?= htmlspecialchars($index + 1 . '. ' . $question['questions_text']) ?></p>
                                    <?php foreach (['a', 'b', 'c', 'd'] as $option): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="q<?= $index ?>" value="<?= $option ?>">
                                            <label class="form-check-label"><?= htmlspecialchars($question["option_$option"]) ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                    <input type="hidden" id="correct_q<?= $index ?>" value="<?= htmlspecialchars($question['correct_option']) ?>">
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