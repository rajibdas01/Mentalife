<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in (i.e., the session variable 'username' exists)
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    echo "404 not found";
    exit;
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentalife - Mental Healthcare Services</title>
    <link rel="stylesheet" href="open.css">
</head>

<body>
    <header>
        <h1><b>Mentalife</b></h1>
        <!-- Profile Dropdown -->

        <div class="profile">
            <a href="profile.php">Welcome <?php echo $_SESSION['username']; ?></a>
        </div>
        <span class="signout"><a href="logout.php">Logout</a></span>
    </header>




    <div class="container">
        <nav>
            <ul>
                <h4>
                    <center>
                        <a href="#home">Home</a>&ensp; &emsp;
                        <a href="#services">Services</a>&ensp; &emsp;
                        <a href="#meditation">Meditation</a>&ensp; &emsp;
                        <a href="#quotes">Quotes</a>&ensp; &emsp;
                        <a href="#music">Music</a>&ensp; &emsp;
                        <a href="#sleep">Sleep</a>&ensp; &emsp;
                        <a href="#contact">Contact</a>&ensp; &emsp;
                    </center>
                </h4>
            </ul>
        </nav>
    </div>

    <section id="home">
        <div class="container">
            <h2>Welcome to Mentalife</h2>
            <p>Your partner in mental health and well-being. We offer professional support and services to help you live a balanced and fulfilling life.</p>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="service">
                <h3>Therapy Sessions</h3>
                <p>Personalized therapy sessions to address your unique needs and concerns.</p>
            </div>
            <div class="service">
                <h3>Counseling</h3>
                <p>Expert counseling for individuals, couples, and families.</p>
            </div>
            <div class="service">
                <h3>Support Groups</h3>
                <p>Join support groups to connect with others facing similar challenges.</p>
            </div>
        </div>
    </section>

    <section id="meditation">
        <div class="container">
            <h2>Meditation</h2>
            <p id="meditation">Explore our guided meditation sessions to help you relax and find inner peace.</p>
           <a href="meditation.html">
                <button>Start Meditation</button>
        </a>
            

        </div>
    </section>

    <section id="quotes">
        <div class="container">
            <h2>Motivational Quotes</h2>
            <p id="quote">"Click the button below for a motivational quote."</p>
            <a href="quotes.html"><button>Get Quote</button></a>
        </div>
    </section>

    <section id="music">
        <div class="container">
            <h2>Relaxing Music</h2>
            <p id="Music">"Relaxing music creates a soothing atmosphere that helps to calm the mind, reduce stress, and promote a sense of tranquility."</p>
            <a href="meditation.html">
            <button>Listen</button>
            </a>
        </div>
    </section>

    <section id="sleep">
        <div class="container">
            <h2>Sleeping Exercises</h2>
            <p>"Follow these exercises to improve your sleep quality"</p>
            <a href="sleeping.html">
                <button>Get Instruction</button>
              </a>

        </div>
    </section>
    <section id="counselling">
        <div class="container">
            <h2>Counselling From Psychologists</h2>
            <p id="counselling">"All treatments that address human suffering should be rigorously evaluated to determine their effectivenes"</p>
            <a href="doctor.html">
                <button>Counselling</button>
              </a>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <form id="contactForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Send</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Mentalife. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>