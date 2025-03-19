function countUpAnimation (){
    const counters = document.querySelectorAll('.counter');


    counters.forEach(counter => {
      
        function updateCount() {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerHTML;

            const inc = Math.floor((target - count) / 100);

            if (count < target && inc > 0) {
                counter.innerHTML = (count + inc);
                
                setTimeout(updateCount, 1);
            }
            
            else {
                counter.innerHTML = target;
            }
        }
        updateCount();
    });
}
document.addEventListener("DOMContentLoaded", () => {
    const offcanvasElement = document.querySelector('.offcanvas-start');
    const main = document.querySelector('.main');
    var scrollWidth = $(document).width() - $(window).width();

    if (offcanvasElement && offcanvasElement.classList.contains('show')) {
        main.style.width = `calc(100vw - ${offcanvasElement.offsetWidth+16}px)`;
        main.classList.add('ms-auto');
    } else {
        main.style.width = '100vw'; // Khi offcanvas không hiển thị
    }

    countUpAnimation();
});

$(document).ajaxSend(function() {
  $('.overlay').fadeIn(300);
});
