<link rel="stylesheet" href="./css/cssChatgpt.css">

<div class="fixed-bottom text-right mb-4 mr-4">
    <img src="./img/ChatGPT.webp" alt="" class="rounded-pill" width="60" onclick="openForm()">
</div>

        <div class="container chatbotForm" id="myForm">
            <div class="row pt-3">
                <div class="chat-main text-white">
                    <div class="col-md-12 chat-header mb-2">
                        <div class="row header-one text-white p-1">
                            <div class="col-8 name pl-2">
                                <img src="./img/ChatGPT_logo.png" width="30" alt="">
                                <h6 class="ml-1 mb-0 text-white">ChatGPT 3.5</h6>
                            </div>
                            <div class="col-4 options text-right pr-0">
                                <i class="fa fa-window-minimize hide-chat-box hover text-center pt-1" onclick="closeForm()"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Show Content -->
                    <div class="col-md-12 chats header-one">
                        <div class="message-box px-2">
                            <div class="row p-1 d-flex chat response">
                                <img src="./img/chatbot.jpg" class="mr-2" alt="logoChatGPT">
                                <span>Chào bạn! <br>Tôi có thể giúp gì được cho bạn?</span>
                            </div>
                        </div>
                    </div>
                    <!-- Search -->
                    <div class="messagebar">
                        <div class="bar-wrapper">
                            <input type="text" placeholder="Nhập câu hỏi của bạn...">
                            <button>
                                <i class="bx bx-send"></i>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    <script src="./js/scriptChatgpt.js"></script>
