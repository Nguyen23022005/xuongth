<style></style>
<main class="main">
    <section id="trainers" class="section trainers">

        <div class="container">

            <div class="row gy-5">
                <?php foreach ($users as $user): if ($user['role'] === 'admin') ?>
                    <?php
                    $image = !empty($user['image']) ? "/uploads/" . $user['image'] : "https://exam4future.com/assets/img/user.jpg";
                    ?>
                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="<?= $image ?>" class="img-fluid" alt="">
                            <div class="social">
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>Walter White</h4>
                            <span>Business</span>
                            <p>Aliquam iure quaerat voluptatem praesentium possimus unde laudantium vel dolorum distinctio dire flow</p>
                        </div>
                    </div><!-- End Team Member -->
                <?php endforeach; ?>

            </div>

        </div>

    </section><!-- /Trainers Section -->

</main>