document.addEventListener("DOMContentLoaded", () => {
    const popups = {
        aboutLink: "aboutPop",
        privacyLink: "privacyPop",
        termsLink: "termsPop",
    };

    // Create and add overlay to the body
    const overlay = document.createElement("div");
    overlay.classList.add("overlay");
    document.body.appendChild(overlay);

    // Function to close all popups
    const closeAllPopups = () => {
        document.querySelectorAll(".popup").forEach((popup) => {
            popup.style.display = "none";
        });
        overlay.style.display = "none";
    };

    // Attach click event to each link to show the corresponding popup
    Object.keys(popups).forEach((linkId) => {
        const link = document.getElementById(linkId);
        const popupId = popups[linkId];
        const popup = document.getElementById(popupId);

        link.addEventListener("click", (e) => {
            e.preventDefault(); // Prevent default link behavior
            closeAllPopups(); // Ensure no other popup is open
            popup.style.display = "block";
            overlay.style.display = "block";
        });
    });

    // Attach click event to all "Close" buttons
    document.querySelectorAll(".closePopup").forEach((button) => {
        button.addEventListener("click", closeAllPopups);
    });

    // Attach click event to the overlay to close all popups
    overlay.addEventListener("click", closeAllPopups);
});





//log in portion
window.onload = function () {
    // Check if there is an error in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    const message= urlParams.get('message');

    // If error parameter is present, display the error message
    if (error === 'invalid_password_username') {
        document.getElementById('loginMessage').textContent = 'Invalid username or password. Please try again.';
        document.getElementById('loginMessage').style.color = 'red';
    }

    if (message==='Signup_successful'){
        document.getElementById('signupMessage').textContent='Signup Successfully'
        document.getElementById('signupMessage').style.color='green'
    }

    if (message==='delete_account'){
        document.getElementById('deleteMessage').textContent='Delete Successfully'
        document.getElementById('deleteMessage').style.color='red'
    }
};

