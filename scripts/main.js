document.addEventListener('DOMContentLoaded', function () {

    const formSelect = document.getElementById('formSelect');
    const formSections = document.querySelectorAll('.form-section');

    const confirmDelete = document.getElementById('confirm-delete');
    const performDelete = document.getElementById('perform-delete');

    // Add an event listener to the select element
    formSelect.addEventListener('change', function () {
        // Hide all form sections
        formSections.forEach(section => section.style.display = 'none');

        // Show the selected form section
        const selectedOption = this.value;
        if (selectedOption) {
            document
                .getElementById(selectedOption)
                .style
                .display = 'block';
        }
    });

})

document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname.split('/').pop(); // Get the current page name

    navLinks.forEach(link => {
        // Get the href value and remove any leading slashes
        const linkPath = link.getAttribute('href').split('/').pop();

        // Compare href with current path
        if (linkPath === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});


document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthIndicator = document.getElementById('password-strength');
    
    const strength = getPasswordStrength(password);
    strengthIndicator.textContent = strength.message;
    strengthIndicator.className = strength.className;
});

function getPasswordStrength(password) {
    let strength = { message: '', className: '' };
    
    if (password.length < 6) {
        strength.message = 'Password is too short';
        strength.className = 'weak';
    } else if (password.length < 12) {
        if (/[a-z]/.test(password) && /[A-Z]/.test(password) && /[0-9]/.test(password)) {
            strength.message = 'Medium strength password';
            strength.className = 'medium';
        } else {
            strength.message = 'Password should include upper and lower case letters and numbers';
            strength.className = 'weak';
        }
    } else {
        if (/[a-z]/.test(password) && /[A-Z]/.test(password) && /[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) {
            strength.message = 'Strong password';
            strength.className = 'strong';
        } else {
            strength.message = 'Password should include upper and lower case letters, numbers, and special characters';
            strength.className = 'medium';
        }
    }
    
    return strength;
}

let table1 = new DataTable('#example');
let table2 = new DataTable('#example1');
let table3 = new DataTable('#example2');
let table4 = new DataTable('#example3');
let table5 = new DataTable('#example4');



