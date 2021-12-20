const wrapper = document.querySelector('.wrapper');
    const indicators = [...document.querySelectorAll('.indicators button')];

    let currentTestimonial = 0; // Default 0

    indicators.forEach((item, i) => {
        item.addEventListener('click', () => {
            indicators[currentTestimonial].classList.remove('active');
            wrapper.style.marginLeft = `-${100 * i}%`;
            item.classList.add('active');
            currentTestimonial = i;
        })
    })


    function myFunction() {
        var x = document.getElementById("navbar");
        if (x.className === "nav") {
            x.className += " responsive";
        } else {
            x.className = "nav";
        }
    }


    function myFunctions() {
    var x = document.getElementById("add");
    if (x.className === "add_form") {
    x.className += " responsive";
} else {
    x.className = "add_form";
}
}
    function myFunction3() {
    var x = document.getElementById("ads");
    if (x.className === "add_form") {
    x.className += " responsive";
} else {
    x.className = "add_form";
}
}

