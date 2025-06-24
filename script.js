document.addEventListener('DOMContentLoaded', () => {

    const registrationForm = document.getElementById('registrationForm');
    if (!registrationForm) return; // Stop if we are not on the registration page

    const fullNameInput = document.getElementById('fullName');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const locationInput = document.getElementById('location');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const phoneError = document.getElementById('phoneError');
    const locationError = document.getElementById('locationError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const userTypeError = document.getElementById('userTypeError');

    registrationForm.addEventListener('submit', (event) => {
        // We will validate the form, but not prevent submission here.
        // We prevent it only if validation fails.
        const isFormValid = validateForm();
        if (!isFormValid) {
            event.preventDefault(); // Stop the form from submitting if invalid
        }
    });

    function validateForm() {
        let isValid = true;
        hideAllErrors();

        // 1. Full Name: only letters and spaces.
        const nameRegex = /^[a-zA-Z\s]+$/;
        if (fullNameInput.value.trim() === '') {
            showError(nameError, 'Full Name is required.');
            isValid = false;
        } else if (!nameRegex.test(fullNameInput.value)) {
            showError(nameError, 'Full Name can only contain letters and spaces.');
            isValid = false;
        }

        // 2. Email: must be a valid format.
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput.value.trim() === '') {
            showError(emailError, 'Email Address is required.');
            isValid = false;
        } else if (!emailRegex.test(emailInput.value)) {
            showError(emailError, 'Please enter a valid email address.');
            isValid = false;
        }

        // 3. Phone Number: simple check for numbers.
        const phoneRegex = /^[0-9\s-]{10,15}$/;
        if (phoneInput.value.trim() === '') {
            showError(phoneError, 'Phone Number is required.');
            isValid = false;
        } else if (!phoneRegex.test(phoneInput.value)) {
             showError(phoneError, 'Please enter a valid phone number.');
             isValid = false;
        }

        // 4. Location: must not be empty.
        if (locationInput.value.trim() === '') {
            showError(locationError, 'Location is required.');
            isValid = false;
        }

        // 5. Password: at least 8 characters.
        if (passwordInput.value === '') {
            showError(passwordError, 'Password is required.');
            isValid = false;
        } else if (passwordInput.value.length < 8) {
            showError(passwordError, 'Password must be at least 8 characters long.');
            isValid = false;
        }

        // 6. Confirm Password: must match the password.
        if (confirmPasswordInput.value === '') {
            showError(confirmPasswordError, 'Please confirm your password.');
            isValid = false;
        } else if (passwordInput.value !== confirmPasswordInput.value) {
            showError(confirmPasswordError, 'Passwords do not match.');
            isValid = false;
        }
        
        // 7. User Type: one must be selected.
        const selectedUserType = document.querySelector('input[name="userType"]:checked');
        if (!selectedUserType) {
            showError(userTypeError, 'Please select a user type.');
            isValid = false;
        }

        return isValid;
    }

    function showError(errorElement, message) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
    
    function hideAllErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.style.display = 'none');
    }
});
