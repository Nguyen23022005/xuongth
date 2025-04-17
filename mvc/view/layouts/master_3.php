<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Mentor Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="/public/assets/img/favicon.png" rel="icon">
  <link href="/public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/public/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/public/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/public/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Main CSS File -->
  <link href="/public/assets/css/main.css" rel="stylesheet">
  <!--  -->
  <link href="/public/css/styles.css" rel="stylesheet" />


  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto" style="text-decoration: none;">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Mentor</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul class="navbar">
          <li><a href="/" style="text-decoration: none;">Trang Chủ<br></a></li>
          <li><a href="/course" style="text-decoration: none;">Khóa Học Của Bạn</a></li>
          <li><a href="/index1" style="text-decoration: none;">Tin tức</a></li>
          <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> Tài khoản
                        </a>
                        <ul class="dropdown-menu">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li><a class="dropdown-item" href="/profile/edit/<?= $_SESSION['user']['id']?>">Thông tin</a></li>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="/subjects">Trang Quản Trị</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <?php if (isset($_SESSION['user'])): ?>
                                <li><a class="dropdown-item text-danger" href="/logout">Đăng xuất</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item text-primary" href="/login">Đăng nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
  <?= $content ?>
  </main>
  <footer id="footer" class="footer position-relative light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center"style="text-decoration: none;">
            <span class="sitename">Mentor</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#" style="text-decoration: none;">Home</a></li>
            <li><a href="#" style="text-decoration: none;">About us</a></li>
            <li><a href="#" style="text-decoration: none;">Services</a></li>
            <li><a href="#" style="text-decoration: none;">Terms of service</a></li>
            <li><a href="#" style="text-decoration: none;">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#" style="text-decoration: none;">Web Design</a></li>
            <li><a href="#" style="text-decoration: none;">Web Development</a></li>
            <li><a href="#" style="text-decoration: none;">Product Management</a></li>
            <li><a href="#" style="text-decoration: none;">Marketing</a></li>
            <li><a href="#" style="text-decoration: none;">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Mentor</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/public/assets/vendor/php-email-form/validate.js"></script>
  <script src="/public/assets/vendor/aos/aos.js"></script>
  <script src="/public/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/public/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/public/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="/public/assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/public/js/scripts.js"></script>
  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>nickfinal</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
</head>
<style>
    /* Google Fonts - Inter */
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,100..900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Inter", sans-serif;
    }

    body {
        width: 100%;
        min-height: 100vh;
        /* background: url('nick.jpg') no-repeat center center fixed; */
        background-size: cover;
    }

    #chatbot-toggler {
        position: fixed;
        bottom: 30px;
        right: 35px;
        border: none;
        height: 50px;
        width: 50px;
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #1E90FF;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    body.show-chatbot #chatbot-toggler {
        transform: rotate(90deg);
    }

    #chatbot-toggler span {
        color: #fff;
        position: absolute;
    }

    #chatbot-toggler span:last-child,
    body.show-chatbot #chatbot-toggler span:first-child {
        opacity: 0;
    }

    body.show-chatbot #chatbot-toggler span:last-child {
        opacity: 1;
    }

    .chatbot-popup {
        position: fixed;
        right: 35px;
        bottom: 90px;
        width: 420px;
        overflow: hidden;
        background: #fff;
        border-radius: 15px;
        opacity: 0;
        pointer-events: none;
        transform: scale(0.2);
        transform-origin: bottom right;
        box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
            0 32px 64px -48px rgba(0, 0, 0, 0.5);
        transition: all 0.1s ease;
    }

    body.show-chatbot .chatbot-popup {
        opacity: 1;
        pointer-events: auto;
        transform: scale(1);
    }

    .chat-header {
        display: flex;
        align-items: center;
        padding: 15px 22px;
        background: #1E90FF;
        justify-content: space-between;
    }

    .chat-header .header-info {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .header-info .chatbot-logo {
        width: 35px;
        height: 35px;
        padding: 6px;
        fill: #1E90FF;
        flex-shrink: 0;
        background: #fff;
        border-radius: 50%;
    }

    .header-info .logo-text {
        color: #fff;
        font-weight: 600;
        font-size: 1.31rem;
        letter-spacing: 0.02rem;
    }

    .chat-header #close-chatbot {
        border: none;
        color: #fff;
        height: 40px;
        width: 40px;
        font-size: 1.9rem;
        margin-right: -10px;
        padding-top: 2px;
        cursor: pointer;
        border-radius: 50%;
        background: none;
        transition: 0.2s ease;
    }

    .chat-header #close-chatbot:hover {
        background: #4169E1;
    }

    .chat-body {
        padding: 25px 22px;
        gap: 20px;
        display: flex;
        height: 460px;
        overflow-y: auto;
        margin-bottom: 82px;
        flex-direction: column;
        scrollbar-width: thin;
        scrollbar-color: #F0FFFF transparent;
    }

    .chat-body,
    .chat-form .message-input:hover {
        scrollbar-color: #F0FFFF transparent;
    }

    .chat-body .message {
        display: flex;
        gap: 11px;
        align-items: center;
    }

    .chat-body .message .bot-avatar {
        width: 35px;
        height: 35px;
        padding: 6px;
        fill: #fff;
        flex-shrink: 0;
        margin-bottom: 2px;
        align-self: flex-end;
        border-radius: 50%;
        background: #1E90FF;
    }

    .chat-body .message .message-text {
        padding: 12px 16px;
        max-width: 75%;
        font-size: 0.95rem;
    }

    .chat-body .bot-message.thinking .message-text {
        padding: 2px 16px;
    }

    .chat-body .bot-message .message-text {
        background: #F2F2FF;
        border-radius: 13px 13px 13px 3px;
    }

    .chat-body .user-message {
        flex-direction: column;
        align-items: flex-end;
    }

    .chat-body .user-message .message-text {
        color: #fff;
        background: #1E90FF;
        border-radius: 13px 13px 3px 13px;
    }

    .chat-body .user-message .attachment {
        width: 50%;
        margin-top: -7px;
        border-radius: 13px 3px 13px 13px;
    }

    .chat-body .bot-message .thinking-indicator {
        display: flex;
        gap: 4px;
        padding-block: 15px;
    }

    .chat-body .bot-message .thinking-indicator .dot {
        height: 7px;
        width: 7px;
        opacity: 0.7;
        border-radius: 50%;
        background: #6F6BC2;
        animation: dotPulse 1.8s ease-in-out infinite;
    }

    .chat-body .bot-message .thinking-indicator .dot:nth-child(1) {
        animation-delay: 0.2s;
    }

    .chat-body .bot-message .thinking-indicator .dot:nth-child(2) {
        animation-delay: 0.3s;
    }

    .chat-body .bot-message .thinking-indicator .dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes dotPulse {

        0%,
        44% {
            transform: translateY(0);
        }

        28% {
            opacity: 0.4;
            transform: translateY(-4px);
        }

        44% {
            opacity: 0.2;
        }
    }

    .chat-footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        background: #fff;
        padding: 15px 22px 20px;
    }

    .chat-footer .chat-form {
        display: flex;
        align-items: center;
        position: relative;
        background: #fff;
        border-radius: 32px;
        outline: 1px solid #CCCCE5;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.06);
        transition: 0s ease, border-radius 0s;
    }

    .chat-form:focus-within {
        outline: 2px solid #1E90FF;
    }

    .chat-form .message-input {
        width: 100%;
        height: 47px;
        outline: none;
        resize: none;
        border: none;
        max-height: 180px;
        scrollbar-width: thin;
        border-radius: inherit;
        font-size: 0.95rem;
        padding: 14px 0 12px 18px;
        scrollbar-color: transparent transparent;
    }

    .chat-form .chat-controls {
        gap: 3px;
        height: 47px;
        display: flex;
        padding-right: 6px;
        align-items: center;
        align-self: flex-end;
    }

    .chat-form .chat-controls button {
        height: 35px;
        width: 35px;
        border: none;
        cursor: pointer;
        color: #706DB0;
        border-radius: 50%;
        font-size: 1.15rem;
        background: none;
        transition: 0.2s ease;
    }

    .chat-form .chat-controls button:hover,
    body.show-emoji-picker .chat-controls #emoji-picker {
        color: #4169E1;
        background: #f1f1ff;
    }

    .chat-form .chat-controls #send-message {
        color: #fff;
        display: none;
        background: #1E90FF;
    }

    .chat-form .chat-controls #send-message:hover {
        background: #4169E1;
    }

    .chat-form .message-input:valid~.chat-controls #send-message {
        display: block;
    }

    .chat-form .file-upload-wrapper {
        position: relative;
        height: 35px;
        width: 35px;
    }

    .chat-form .file-upload-wrapper :where(button, img) {
        position: absolute;
    }

    .chat-form .file-upload-wrapper img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .chat-form .file-upload-wrapper #file-cancel {
        color: #ff0000;
        background: #fff;
    }

    .chat-form .file-upload-wrapper :where(img, #file-cancel),
    .chat-form .file-upload-wrapper.file-uploaded #file-upload {
        display: none;
    }

    .chat-form .file-upload-wrapper.file-uploaded img,
    .chat-form .file-upload-wrapper.file-uploaded:hover #file-cancel {
        display: block;
    }

    em-emoji-picker {
        position: absolute;
        left: 50%;
        top: -337px;
        width: 100%;
        max-width: 350px;
        visibility: hidden;
        max-height: 330px;
        transform: translateX(-50%);
    }

    body.show-emoji-picker em-emoji-picker {
        visibility: visible;
    }


    /* Responsive media query for mobile screens */
    @media (max-width: 520px) {

        #chatbot-toggler {
            right: 20px;
            bottom: 20px;
        }

        .chatbot-popup {
            right: 0;
            bottom: 0;
            height: 100%;
            border-radius: 0;
            width: 100%;
        }

        .chatbot-popup .chat-header {
            padding: 12px 15px;
        }

        .chat-body {
            height: calc(90% - 55px);
            padding: 25px 15px;
        }

        .chat-footer {
            padding: 10px 15px 15px;
        }

        .chat-form .file-upload-wrapper.file-uploaded #file-cancel {
            opacity: 0;
        }
    }
</style>

<body>
    <button id="chatbot-toggler">
        <span class="material-symbols-rounded">mode_comment</span>
        <span class="material-symbols-rounded">close</span>
    </button>
    <div class="chatbot-popup">
        <div class="chat-header">
            <div class="header-info">
                <svg class="chatbot-logo" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                    viewBox="0 0 1024 1024">
                    <path
                        d="M738.3 287.6H285.7c-59 0-106.8 47.8-106.8 106.8v303.1c0 59 47.8 106.8 106.8 106.8h81.5v111.1c0 .7.8 1.1 1.4.7l166.9-110.6 41.8-.8h117.4l43.6-.4c59 0 106.8-47.8 106.8-106.8V394.5c0-59-47.8-106.9-106.8-106.9zM351.7 448.2c0-29.5 23.9-53.5 53.5-53.5s53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5-53.5-23.9-53.5-53.5zm157.9 267.1c-67.8 0-123.8-47.5-132.3-109h264.6c-8.6 61.5-64.5 109-132.3 109zm110-213.7c-29.5 0-53.5-23.9-53.5-53.5s23.9-53.5 53.5-53.5 53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5zM867.2 644.5V453.1h26.5c19.4 0 35.1 15.7 35.1 35.1v121.1c0 19.4-15.7 35.1-35.1 35.1h-26.5zM95.2 609.4V488.2c0-19.4 15.7-35.1 35.1-35.1h26.5v191.3h-26.5c-19.4 0-35.1-15.7-35.1-35.1zM561.5 149.6c0 23.4-15.6 43.3-36.9 49.7v44.9h-30v-44.9c-21.4-6.5-36.9-26.3-36.9-49.7 0-28.6 23.3-51.9 51.9-51.9s51.9 23.3 51.9 51.9z" />
                </svg>
                <h2 class="logo-text">nick final</h2>
            </div>
            <button id="close-chatbot" class="material-symbols-rounded">keyboard_arrow_down</button>
        </div>
        <div class="chat-body">
            <div class="message bot-message">
                <svg class="bot-avatar" xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                    viewBox="0 0 1024 1024">
                    <path
                        d="M738.3 287.6H285.7c-59 0-106.8 47.8-106.8 106.8v303.1c0 59 47.8 106.8 106.8 106.8h81.5v111.1c0 .7.8 1.1 1.4.7l166.9-110.6 41.8-.8h117.4l43.6-.4c59 0 106.8-47.8 106.8-106.8V394.5c0-59-47.8-106.9-106.8-106.9zM351.7 448.2c0-29.5 23.9-53.5 53.5-53.5s53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5-53.5-23.9-53.5-53.5zm157.9 267.1c-67.8 0-123.8-47.5-132.3-109h264.6c-8.6 61.5-64.5 109-132.3 109zm110-213.7c-29.5 0-53.5-23.9-53.5-53.5s23.9-53.5 53.5-53.5 53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5zM867.2 644.5V453.1h26.5c19.4 0 35.1 15.7 35.1 35.1v121.1c0 19.4-15.7 35.1-35.1 35.1h-26.5zM95.2 609.4V488.2c0-19.4 15.7-35.1 35.1-35.1h26.5v191.3h-26.5c-19.4 0-35.1-15.7-35.1-35.1zM561.5 149.6c0 23.4-15.6 43.3-36.9 49.7v44.9h-30v-44.9c-21.4-6.5-36.9-26.3-36.9-49.7 0-28.6 23.3-51.9 51.9-51.9s51.9 23.3 51.9 51.9z" />
                </svg>
                <div class="message-text"> Xin chào 👋<br /> Tôi có thể giúp gì cho bạn hôm nay? </div>
            </div>
        </div>
        <div class="chat-footer">
            <form action="#" class="chat-form">
                <textarea placeholder="Message..." class="message-input" required></textarea>
                <div class="chat-controls">
                    <button type="button" id="emoji-picker"
                        class="material-symbols-outlined">sentiment_satisfied</button>
                    <div class="file-upload-wrapper">
                        <input type="file" id="file-input" hidden />
                        <img src="#" />
                        <button type="button" id="file-upload" class="material-symbols-rounded">attach_file</button>
                        <button type="button" id="file-cancel" class="material-symbols-rounded">close</button>
                    </div>
                    <button type="submit" id="send-message" class="material-symbols-rounded">arrow_upward</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/browser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    <script>
        const chatBody = document.querySelector(".chat-body");
        const messageInput = document.querySelector(".message-input");
        const sendMessageButton = document.querySelector("#send-message");
        const fileInput = document.querySelector("#file-input");
        const fileUploadWrapper = document.querySelector(".file-upload-wrapper");
        const fileCancelButton = document.querySelector("#file-cancel");
        const chatbotToggler = document.querySelector("#chatbot-toggler");
        const closeChatbot = document.querySelector("#close-chatbot");


        // Api setup
        const API_KEY = "AIzaSyAKa06ydnfEI6uI-rfBOUslzKpjk91a65Y";
        const API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${API_KEY}`;

        const userData = {
            message: null,
            file: {
                data: null,
                mime_type: null
            }
        };


        const chatHistory = [];

        const initialInputHeight = messageInput.scrollHeight;

        const createMessageElement = (content, ...classes) => {
            const div = document.createElement("div");
            div.classList.add("message", ...classes);
            div.innerHTML = content;
            return div;
        };

        const generateBotResponse = async (incomingMessageDiv) => {
            const messageElement = incomingMessageDiv.querySelector(".message-text");

            chatHistory.push({
                role: "user",
                parts: [{ text: userData.message }, ...(userData.file.data ? [{ inline_data: userData.file }] : [])],
            });

            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    contents: chatHistory
                })
            }
            try {
                const response = await fetch(API_URL, requestOptions);
                const data = await response.json();
                if (!response.ok) throw new Error(data.error.message);
                const apiResponseText = data.candidates[0].content.parts[0].text.replace(/\*\*(.*?)\*\*/g, "$1").trim();
                messageElement.innerText = apiResponseText;
                chatHistory.push({
                    role: "model",
                    parts: [{ text: apiResponseText }]
                });
            } catch (error) {
                messageElement.innerText = error.message;
                messageElement.style.color = "#ff0000";
            } finally {
                userData.file = {};
                incomingMessageDiv.classList.remove("thinking");
                chatBody.scrollTo({ behavior: "smooth", top: chatBody.scrollHeight });
            }
        };
        const handleOutgoingMessage = (e) => {
            e.preventDefault();
            userData.message = messageInput.value.trim();
            messageInput.value = "";
            fileUploadWrapper.classList.remove("file-uploaded");
            messageInput.dispatchEvent(new Event("input"));

            const messageContent = `<div class="message-text"></div>
                            ${userData.file.data ? `<img src="data:${userData.file.mime_type};base64,${userData.file.data}" class="attachment" />` : ""}`;

            const outgoingMessageDiv = createMessageElement(messageContent, "user-message");
            outgoingMessageDiv.querySelector(".message-text").innerText = userData.message;
            chatBody.appendChild(outgoingMessageDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
            setTimeout(() => {
                const messageContent = `<svg class="bot-avatar" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 1024 1024">
                    <path d="M738.3 287.6H285.7c-59 0-106.8 47.8-106.8 106.8v303.1c0 59 47.8 106.8 106.8 106.8h81.5v111.1c0 .7.8 1.1 1.4.7l166.9-110.6 41.8-.8h117.4l43.6-.4c59 0 106.8-47.8 106.8-106.8V394.5c0-59-47.8-106.9-106.8-106.9zM351.7 448.2c0-29.5 23.9-53.5 53.5-53.5s53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5-53.5-23.9-53.5-53.5zm157.9 267.1c-67.8 0-123.8-47.5-132.3-109h264.6c-8.6 61.5-64.5 109-132.3 109zm110-213.7c-29.5 0-53.5-23.9-53.5-53.5s23.9-53.5 53.5-53.5 53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5zM867.2 644.5V453.1h26.5c19.4 0 35.1 15.7 35.1 35.1v121.1c0 19.4-15.7 35.1-35.1 35.1h-26.5zM95.2 609.4V488.2c0-19.4 15.7-35.1 35.1-35.1h26.5v191.3h-26.5c-19.4 0-35.1-15.7-35.1-35.1zM561.5 149.6c0 23.4-15.6 43.3-36.9 49.7v44.9h-30v-44.9c-21.4-6.5-36.9-26.3-36.9-49.7 0-28.6 23.3-51.9 51.9-51.9s51.9 23.3 51.9 51.9z"></path>
                </svg>
                <div class="message-text">
                    <div class="thinking-indicator">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>`;
                const incomingMessageDiv = createMessageElement(messageContent, "bot-message", "thinking");
                chatBody.appendChild(incomingMessageDiv);
                chatBody.scrollTo({ behavior: "smooth", top: chatBody.scrollHeight });
                generateBotResponse(incomingMessageDiv);
            }, 600);
        };
        messageInput.addEventListener("keydown", (e) => {
            const userMessage = e.target.value.trim();
            if (e.key === "Enter" && userMessage && !e.shiftKey && window.innerWidth > 768) {
                handleOutgoingMessage(e);
            }
        });
        messageInput.addEventListener("input", (e) => {
            messageInput.style.height = `${initialInputHeight}px`;
            messageInput.style.height = `${messageInput.scrollHeight}px`;
            document.querySelector(".chat-form").style.boderRadius = messageInput.scrollHeight > initialInputHeight ? "15px" : "32px";
        });
        fileInput.addEventListener("change", (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                fileUploadWrapper.querySelector("img").src = e.target.result;
                fileUploadWrapper.classList.add("file-uploaded");
                const base64String = e.target.result.split(",")[1];

                userData.file = {
                    data: base64String,
                    mime_type: file.type
                };

                fileInput.value = "";
            };

            reader.readAsDataURL(file);
        });
        fileCancelButton.addEventListener("click", (e) => {
            userData.file = {};
            fileUploadWrapper.classList.remove("file-uploaded");
        });
        const picker = new EmojiMart.Picker({
            theme: "light",
            showSkinTones: "none",
            previewPosition: "none",
            onEmojiSelect: (emoji) => {
                const { selectionStart: start, selectionEnd: end } = messageInput;
                messageInput.setRangeText(emoji.native, start, end, "end");
                messageInput.focus();
            },
            onClickOutside: (e) => {
                if (e.target.id === "emoji-picker") {
                    document.body.classList.toggle("show-emoji-picker");
                } else {
                    document.body.classList.remove("show-emoji-picker");
                }
            },
        });
        document.querySelector(".chat-form").appendChild(picker);
        fileInput.addEventListener("change", async (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validImageTypes.includes(file.type)) {
                await Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Chỉ chấp nhận file ảnh (JPEG, PNG, GIF, WEBP)',
                    confirmButtonText: 'OK'
                });
                resetFileInput();
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => {
                fileUploadWrapper.querySelector("img").src = e.target.result;
                fileUploadWrapper.classList.add("file-uploaded");
                const base64String = e.target.result.split(",")[1];
                userData.file = {
                    data: base64String,
                    mime_type: file.type
                };
            };
            reader.readAsDataURL(file);
        });
        function resetFileInput() {
            fileInput.value = "";
            fileUploadWrapper.classList.remove("file-uploaded");
            fileUploadWrapper.querySelector("img").src = "#";
            userData.file = { data: null, mime_type: null };
            document.querySelector(".chat-form").reset();
        }
        sendMessageButton.addEventListener("click", (e) => handleOutgoingMessage(e));
        document.querySelector("#file-upload").addEventListener("click", (e) => fileInput.click());
        chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
        closeChatbot.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
    </script>
</body>

</html>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
    const currentUrl = window.location.pathname;
    const navLinks = document.querySelectorAll(".navbar a");

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentUrl) {
            link.classList.add("active");
        }
    });
});
  </script>

</body>

</html>