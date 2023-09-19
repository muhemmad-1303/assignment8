 document.addEventListener("DOMContentLoaded", function () {
        var flashMessage = document.querySelector('.alertSession');
        if (flashMessage) {
            setTimeout(function () {
                flashMessage.style.display = 'none';
            }, 3000);
        }
    });
