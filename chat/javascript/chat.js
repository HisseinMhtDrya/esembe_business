const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

let isScrolling = false;

form.onsubmit = (e) => {
  e.preventDefault();
};

inputField.focus();
inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = "";
        scrollToBottom();
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

chatBox.addEventListener("scroll", () => {
  isScrolling = true;
});

chatBox.addEventListener("mouseleave", () => {
  isScrolling = false;
});

// Ajouter une variable pour stocker le délai de 20 secondes
let delay = 30000;

// Définir une fonction pour la redirection vers le bas
function delayScrollToBottom() {
  setTimeout(() => {
    if (!isScrolling) {
      chatBox.scrollTop = chatBox.scrollHeight;
    }
  }, delay);
}
var lastRequestTime = 0;

function loadMessages() {
    var isScrolledUp = isUserScrolling();
    
    if (!isScrolledUp && Date.now() - lastRequestTime >= 1000) {
        $.ajax({
            type: "GET",
            url: "php/get-chat.php?incoming_id="+incoming_id,
            success: function(data) {
                $("#chat").html(data);
                if (!isScrolledUp) {
                    $("#chat").scrollTop($("#chat")[0].scrollHeight);
                }
            }
        });

        lastRequestTime = Date.now();
    }
}

function isUserScrolling() {
    var threshold = 20;
    var scrollPosition = $(window).scrollTop();
    return $("#chat").scrollTop() + $("#chat").height() + threshold < $("#chat")[0].scrollHeight - threshold;
}

$(window).scroll(function() {
    loadMessages();
});

setInterval(function() {
    loadMessages();
}, 1000);
/*setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id=" + incoming_id);
}, 500);
*/
// Appeler la fonction delayScrollToBottom après l'appel à scrollToBottom()
function scrollToBottom() {
  if (!isScrolling) {
    chatBox.scrollTop = chatBox.scrollHeight;
    delayScrollToBottom();
  }
}

// Appeler la fonction delayScrollToBottom directement après la définition de scrollToBottom()
delayScrollToBottom();