window.onload = function () {
    // Check if there is an error in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    // If error parameter is present, display the error message
    if (error === 'Username_already_exists') {
        const signupMessage = document.getElementById('signupMessage');
        signupMessage.textContent = 'Username already exists. Please choose a different one.';
        signupMessage.style.color = 'red';
    }

};
