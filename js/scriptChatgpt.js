const messageBar = document.querySelector(".bar-wrapper input");
const sendBar = document.querySelector('.bar-wrapper button');
const messageBox =document.querySelector('.message-box');

let API_URL = "https://api.openai.com/v1/chat/completions";
let API_KEY = "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";

sendBar.onclick = function(){
    if(messageBar.value.length > 0){
        const messageValue = messageBar.value;
        messageBar.value = null;
        let message = 
            `<div class="row p-1 d-flex chat message">
                <img src="./img/user-icon.jpg" class="mr-2" alt="logoChatGPT" width="50">
                <span>
                    ${messageValue}
                </span>
            </div>`
        let response =
            `<div class="row p-1 d-flex chat response">
                <img src="./img/chatbot.jpg" class="mr-2" alt="logoChatGPT" width="50">
                <span class="new">
                    ...
                </span>
            </div>`

        messageBox.insertAdjacentHTML('beforeend', message);

        setTimeout(() => {
            messageBox.insertAdjacentHTML('beforeend', response);

            const requestOptions = {
                method : "POST",
                headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${API_KEY}`
                },
                body: JSON.stringify({
                "model": "gpt-3.5-turbo",
                "messages": [{"role": "user", "content": messageValue}],
                'temperature' : 0.5,
                'max_tokens' : 500,
                'top_p' : 1.0,
                'frequency_penalty' : 0.52,
                'stop' : '[1.]',
                })
            }

            const setResponse = document.querySelector(".response .new");
            fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
                let content = data.choices[0].message.content;
                setResponse.innerHTML = content.replaceAll('\n', '<br>');
                setResponse.classList.remove("new");
            }).catch((error) => {
                setResponse.innerHTML = "Xin lỗi! Đã sảy ra lỗi. Vui lòng thử lại...";
            })
        }, 100);
    }
} 

//Mở chatbot
function openForm() {
document.getElementById("myForm").style.display = "block";
}
//Đóng chatbot
function closeForm() {
document.getElementById("myForm").style.display = "none";
}

function myFunctionMedia(x) {
if (x.matches) {
    document.getElementsByClassName("chatbotForm")[0].style.display = "block";
} else {
    document.getElementsByClassName("chatbotForm")[0].style.display = "none";
}
}

var x = window.matchMedia("(max-width: 1100px)")
myFunctionMedia(x)
x.addListener(myFunctionMedia)