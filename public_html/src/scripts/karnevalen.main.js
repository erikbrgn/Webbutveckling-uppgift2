var hamburger = document.getElementById('hamburger');
if (hamburger) {
    hamburger.addEventListener('click', function () {
        if (this.classList.contains('is-active')) {
            this.classList.remove('is-active');
        } else {
            this.classList.add('is-active');
        }
        $('#link-container').toggle('fold', 500);
    });
}

var countDownDate = new Date("May 18, 2022 00:00:01").getTime();

// Update the count down every 1 second
var x = setInterval(function () {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));

    // For future use when date is getting close
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    var timer = document.getElementById("countdown");
    if (timer !== null) {
        timer.innerHTML = days + " dagar tills det smäller!";
    }

    var timerFooter = document.getElementById('timer-footer');
    if (timerFooter !== null) {
        timerFooter.innerHTML = days + " dagar kvar!";
    }

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "Nuuuu kööör vi!";
    }
}, 1000);

var FloatLabel = (function () {
    // add active class
    var handleFocus = function handleFocus(e) {
        var target = e.target;
        if (target.tagName === 'INPUT' || target.tagName === 'SELECT') {
            target.parentNode.classList.add('active'); // target.setAttribute('placeholder', target.getAttribute('data-placeholder'));
        }
    }; // remove active class

    var handleBlur = function handleBlur(e) {
        var target = e.target;

        if (!target.value || target.value === null) {
            if (target.tagName === 'INPUT' || target.tagName === 'SELECT') {
                target.parentNode.classList.remove('active');
            }
        } //target.removeAttribute('placeholder');
    }; // register events


    var bindEvents = function bindEvents(element) {
        var floatField = element.querySelector('input');

        if (floatField != null) {
            floatField.addEventListener('focus', handleFocus);
            floatField.addEventListener('blur', handleBlur);
        }

        var select = element.querySelector('select');

        if (select != null) {
            select.addEventListener('focus', handleFocus);
            select.addEventListener('blur', handleBlur);
        }

        //   var textarea = element.querySelector('textarea');

        //   if (textarea != null) {
        //     textarea.addEventListener('focus', handleFocus);
        //     textarea.addEventListener('blur', handleBlur);
        //   }

    }; // get DOM elements

    var init = function init() {
        var floatContainers = document.querySelectorAll('div.form-field.input');

        //IE & Edge compatibility fix for forEach
        if (window.NodeList && !NodeList.prototype.forEach) {
            NodeList.prototype.forEach = Array.prototype.forEach;
        }

        floatContainers.forEach(function (element) {
            var input = element.querySelector('input');

            if (input) {
                if (input.value || input === null) {
                    element.classList.add('active');
                }
            }
            bindEvents(element);
        });
        var floatSelectContainer = document.querySelectorAll(
            'div.form-field.select'
        );
        floatSelectContainer.forEach(function (element) {
            var select = element.querySelector('select');
            var option = select.querySelector('option:checked');

            if (option.innerText !== '') {
                element.classList.add('active');
            }

            bindEvents(element);
        });

        //   var floatTextareaContainer = document.querySelectorAll('#pardot-form>p.pd-textarea');
        //   floatTextareaContainer.forEach(function (element) {
        //     var textarea = element.querySelector('textarea').value;

        //     if (textarea || textarea === null) {
        //       element.classList.add('active-textarea');
        //     }

        //     bindEvents(element);
        //   });

    };

    return {
        init: init,
    };
})();

FloatLabel.init();

// Lightbox
// Open the Modal
document.querySelectorAll('img').forEach(function (element) {
    element.addEventListener('click', function () {
        var modal = document.getElementById('modalContent');
        modal.innerHTML = "";
        modal.appendChild(this.cloneNode(true));
        document.getElementById("myModal").style.display = "flex";
    });
});
var modal = document.getElementById('myModal');
if (modal) {
    modal.addEventListener('click', function () {
        this.style.display = "none";
    });
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}