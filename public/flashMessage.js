 document.addEventListener("DOMContentLoaded", function () {
        var flashMessage = document.querySelector('.alertSession');
        console.log(this.location);
        if (flashMessage) {
            setTimeout(function () {
                flashMessage.style.display = 'none';
            }, 3000);
        }
    });
