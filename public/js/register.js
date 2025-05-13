// BUTTON CONTAINERS
let back = document.getElementById('back')
let step1 = document.getElementById('step1')
let back2 = document.getElementById('back2')
let step2 = document.getElementById('step2')
let back3 = document.getElementById('back3')

// CONTAINERS
let box1 = document.getElementById('box1')
let box2 = document.getElementById('box2')
let box3 = document.getElementById('box3')
let box4 = document.getElementById('box4')

// INPUTS
let type = document.getElementById('type')
let lvl = document.getElementById('level')
let strnd = document.getElementById('strands')


let check = document.getElementById('check')
let check1 = document.getElementById('check1')

let check2blue = document.getElementById('check2blue')
let check2grey = document.getElementById('check2grey')
let check2check = document.getElementById('check2check')

let check3blue = document.getElementById('check3blue')
let check3grey = document.getElementById('check3grey')
let check3check = document.getElementById('check3check')

let check4blue = document.getElementById('check4blue')
let check4grey = document.getElementById('check4grey')
let check4check = document.getElementById('check4check')

let check5blue = document.getElementById('check5blue')
let check5grey = document.getElementById('check5grey')
let check5check = document.getElementById('check5check')

box1.classList.add('d-block') //d-block
box2.classList.add('d-none')
box3.classList.add('d-none')
box4.classList.add('d-none')
check1.classList.add('d-none')

check2blue.classList.add('d-none')
check2grey.classList.add('d-flex')
check2check.classList.add('d-none')

check3blue.classList.add('d-none')
check3grey.classList.add('d-flex')
check3check.classList.add('d-none')

check4blue.classList.add('d-none')
check4grey.classList.add('d-flex')
check4check.classList.add('d-none')

check5blue.classList.add('d-none')
check5grey.classList.add('d-flex')
check5check.classList.add('d-none')

back.addEventListener('click', () => {
    box1.classList.remove('d-none');
    box1.classList.add('d-block');

    box2.classList.remove('d-block');
    box2.classList.add('d-none');

    check1.classList.remove('d-flex');
    check1.classList.add('d-none');
    check.classList.remove('d-none');
    check.classList.add('d-flex');

    check2grey.classList.remove('d-none');
    check2grey.classList.add('d-flex');
    check2blue.classList.remove('d-flex');
    check2blue.classList.add('d-none');
})

step1.addEventListener('click', () => {
    if (!type.value) {
        alert("Please Select your Registration Type")
        return;
    }
    box1.classList.add('d-none')
    box2.classList.remove('d-none')
    box2.classList.add('d-block')

    check1.classList.remove('d-none')
    check1.classList.add('d-flex')
    check.classList.remove('d-flex')
    check.classList.add('d-none')

    check2grey.classList.remove('d-flex')
    check2grey.classList.add('d-none')
    check2blue.classList.remove('d-none')
    check2blue.classList.add('d-flex')
})

back2.addEventListener('click', () => {
    // Show Step 2 box, hide Step 3 box
    box3.classList.add('d-none');
    box3.classList.remove('d-block');
    box2.classList.remove('d-none');
    box2.classList.add('d-block');

    check3blue.classList.remove('d-flex');
    check3blue.classList.add('d-none');
    check3grey.classList.remove('d-none');
    check3grey.classList.add('d-flex');

    check2check.classList.remove('d-flex');
    check2check.classList.add('d-none');
    check2blue.classList.remove('d-none');
    check2blue.classList.add('d-flex');

    // Optional: if you had step 1 changes in step 2, don't touch check1/check
});

step2.addEventListener('click', () => {
    if (!lvl.value && !strnd.value) {
        alert("Please Select your Level and Strand")
        return;
    } else if (!lvl.value) {
        alert("Please Select your Level")
        return;
    } else if (!strnd.value) {
        alert("Please Select your Strand")
        return;
    }

    box2.classList.add('d-none')
    box3.classList.remove('d-none')
    box3.classList.add('d-block')

    check1.classList.remove('d-none')
    check1.classList.add('d-flex')
    check.classList.remove('d-flex')
    check.classList.add('d-none')

    check2blue.classList.remove('d-flex')
    check2blue.classList.add('d-none')
    check2check.classList.remove('d-none')
    check2check.classList.add('d-flex')

    check3grey.classList.remove('d-flex')
    check3grey.classList.add('d-none')
    check3blue.classList.remove('d-none')
    check3blue.classList.add('d-flex')
})

// Select all elements with the class 'option'
const options = document.querySelectorAll('.option');

// Iterate over each option
options.forEach(option => {
    // Add a click event listener to each option
    option.addEventListener('click', function() {
        // Remove 'selected' class from all options
        options.forEach(opt => opt.classList.remove('selected'));
        // Add 'selected' class to the clicked option
        this.classList.add('selected');
        document.getElementById('type').value = 0;
        document.getElementById('type').value = option.getAttribute("value")
    });
});

// Select all elements with the class 'level'
const levels = document.querySelectorAll('.level');

// Iterate over each option
levels.forEach(level => {
    // Add a click event listener to each option
    level.addEventListener('click', function() {
        // Remove 'selected' class from all options
        levels.forEach(lvl => lvl.classList.remove('selected'));
        // Add 'selected' class to the clicked option
        this.classList.add('selected');
        document.getElementById('level').value = 0;
        document.getElementById('level').value = level.getAttribute("value")
    });
});

// Select all elements with the class 'level'
const strands = document.querySelectorAll('.strand');

// Iterate over each option
strands.forEach(strand => {
    // Add a click event listener to each option
    strand.addEventListener('click', function() {
        // Remove 'selected' class from all options
        strands.forEach(lvl => lvl.classList.remove('selected'));
        // Add 'selected' class to the clicked option
        this.classList.add('selected');
        document.getElementById('strands').value = 0;
        document.getElementById('strands').value = strand.getAttribute("strand")
    });
});

// STEP 3 VALIDATION
let step3 = document.getElementById("step3")
let fname = document.getElementById("fname")
let mname = document.getElementById("mname")
let lname = document.getElementById("lname")
let gender = document.getElementById("gender")
let birthdate = document.getElementById("bdate")
let contact = document.getElementById("contact")
let email = document.getElementById("email")
let password = document.getElementById("password")

let errorname = document.getElementById("errorname")
let errorgender = document.getElementById("errorgender")
let errorbirthdate = document.getElementById("errorbdate")
let errorcontact = document.getElementById("errorcontact")
let erroremail = document.getElementById("erroremail")
let errorpassword = document.getElementById("errorpassword")


step3.addEventListener('click', () => {
    if (!fname.value && !lname.value) {
        errorname.innerText = "Full Name is Required!"
    } else if (!fname.value) {
        errorname.innerText = "First Name is Required!"
    } else if (!fname.value) {
        errorname.innerText = "Last Name is Required!"
    } else {
        errorname.innerText = "";
    }
    if (gender.value == "Select Gender") {
        errorgender.innerText = "Gender is Required!"
    } else {
        errorgender.innerText = "";
    }
    if (!birthdate.value) {
        errorbdate.innerText = "Birthdate is Required!"
    } else {
        errorbdate.innerText = "";
    }
    if (!email.value) {
        erroremail.innerText = "Email is Required!"
    } else {
        erroremail.innerText = "";
    }
    if (!contact.value) {
        errorcontact.innerText = "Contact Number is Required!"
    } else {
        errorcontact.innerText = "";
    }

    if (!password.value) {
        errorpassword.innerText = "Password is Required!"
    } else if (password.value.length < 8) {
        errorpassword.innerText = "Password Length Must be greater than 8 letters or numbers!"
    } else {
        errorpassword.innerText = "";
    }

    if (!fname.value || !lname.value || gender.value == "Select Gender" || !birthdate.value || !email.value || !contact.value || !password.value || password.value.length < 8) {
        return;
    }
    box3.classList.add('d-none')
    box4.classList.remove('d-none')
    box4.classList.add('d-block')

    check1.classList.remove('d-none')
    check1.classList.add('d-flex')
    check.classList.remove('d-flex')
    check.classList.add('d-none')

    check2blue.classList.remove('d-flex')
    check2blue.classList.add('d-none')
    check2check.classList.remove('d-none')
    check2check.classList.add('d-flex')

    check3blue.classList.remove('d-flex')
    check3blue.classList.add('d-none')
    check3check.classList.remove('d-none')
    check3check.classList.add('d-flex')

    check4grey.classList.remove('d-flex')
    check4grey.classList.add('d-none')
    check4blue.classList.remove('d-none')
    check4blue.classList.add('d-flex')
})

back3.addEventListener('click', () => {
    // Show Step 3, hide Step 4
    box4.classList.add('d-none');
    box4.classList.remove('d-block');
    box3.classList.remove('d-none');
    box3.classList.add('d-block');

    // Step indicator updates
    check4blue.classList.remove('d-flex');
    check4blue.classList.add('d-none');
    check4grey.classList.remove('d-none');
    check4grey.classList.add('d-flex');

    check3check.classList.remove('d-flex');
    check3check.classList.add('d-none');
    check3blue.classList.remove('d-none');
    check3blue.classList.add('d-flex');

    // Optional: keep check2check and check1 active if needed, don't touch them
});


// STEP LEFT VALIDATION