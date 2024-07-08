<?php
session_start();
include 'config.php';

// Check if the customer is logged in
if (!isset($_SESSION['customer_logged_in']) || !$_SESSION['customer_logged_in']) {
    header('Location: login.php');
    exit();
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert contact form details into database
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "Message submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>x10sion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<style>
#contact_details {
    padding: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

#contact_details .details {
    flex: 1 1 45%;
    margin: 20px 0;
}

#contact_details .details span,
#form-details form span {
    font-size: 12px;
}

#contact_details .details h2,
#form-details form h2 {
    font-size: 26px;
    line-height: 35px;
    padding: 20px 0;
}

#contact_details .details h3 {
    font-size: 16px;
    padding-bottom: 15px;
}

#contact_details .details ul {
    list-style: none;
    padding: 0;
}

#contact_details .details ul li {
    display: flex;
    padding: 10px 0;
}

#contact_details .details ul li i {
    font-size: 14px;
    padding-right: 22px;
}

#contact_details .details ul li p {
    margin: 0;
    font-size: 14px;
}

#contact_details .map {
    flex: 1 1 45%;
    height: 400px;
    margin: 20px 0;
}

#contact_details .map iframe {
    width: 100%;
    height: 100%;
}

.people {
    margin: 30px 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.people div {
    text-align: center;
    margin-bottom: 20px;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

#form-details .container {
    padding: 20px;
    width: 100%;
    max-width: 600px;
    box-sizing: border-box;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    background-color: #ececec;
}



#contact_details {
    padding: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

#contact_details .details {
    flex: 1 1 45%;
    margin: 20px 0;
}

#contact_details .details span,
#form-details form span {
    font-size: 12px;
}

#contact_details .details h2,
#form-details form h2 {
    font-size: 26px;
    line-height: 35px;
    padding: 20px 0;
}

#contact_details .details h3 {
    font-size: 16px;
    padding-bottom: 15px;
}

#contact_details .details ul {
    list-style: none;
    padding: 0;
}

#contact_details .details ul li {
    display: flex;
    padding: 10px 0;
}

#contact_details .details ul li i {
    font-size: 14px;
    padding-right: 22px;
}

#contact_details .details ul li p {
    margin: 0;
    font-size: 14px;
}

#contact_details .map {
    flex: 1 1 45%;
    height: 400px;
    margin: 20px 0;
}

#contact_details .map iframe {
    width: 100%;
    height: 100%;
}

.people {
    margin: 30px 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.people div {
    text-align: center;
    margin-bottom: 20px;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

#form-details .container {
    padding: 20px;
    width: 100%;
    max-width: 600px;
    box-sizing: border-box;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    background-color: #ececec;
}

</style>
<body>
    <!-- header include -->
    <?php include 'header.php';?>

    <section id="page-header" class="about-header">
        <h2>#Lets_Talk</h2>
        <p>Leave a message for us. We love to hear from you!!</p>
    </section>

    <section id="contact_details">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head office</h3>

            <!-- this ul is for contact details -->
            <ul>
                <li>
                    <i class='bx bx-map-alt'></i>
                    <p>Laldighi, Chottogram, Bangladesh</p>
                </li>
                <li>
                    <i class='bx bxl-gmail'></i>
                    <p>pucX10sion@gmail.com</p>
                </li>
                <li>
                    <i class='bx bxs-contact'></i>
                    <p>01571141511</p>
                </li>
                <li>
                    <i class='bx bx-time-five'></i>     
                    <p>Monday to Saturday: 9.00am to 10.00pm</p>
                </li>
            </ul>
        </div>

        <!-- this div is for the map -->
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.3937048905486!2d91.83333507437828!3d22.338758341502004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad275971a7ceaf%3A0x1300e42a953c30ec!2sPremier%20University%2C%20Department%20of%20Law%2C%20Department%20of%20Economics%2C%20Department%20of%20CSE%20and%20Department%20of%20EEE.!5e0!3m2!1sen!2sbd!4v1710264585975!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="con-form">
                        <form action="contact.php" method="POST">
                            <h2>We love to hear from you</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="people">
            <div>
                <img src="./img/image/sourav.jpg" alt="Sourav Dev" class="profile-picture">
                <p><span>Sourav Dev</span><br> Senior Network Engineer <br> Phone: 01571151411 <br> Email: devsourav085@gmail.com</p>
            </div>
            <div>
                <img src="" alt="Md Imtiaz Uddin" class="profile-picture">
                <p><span>Md Imtiaz Uddin</span><br> Senior Web Developer <br> Phone: 01306733010 <br> Email: voidrishad11@gmail.com</p>
            </div>
            <div>
                <img src="./img/image/bidhan.jpg" alt="Bidhan Nath" class="profile-picture">
                <p><span>Bidhan Nath</span><br> Senior Marketing Manager <br> Phone: 01835272050 <br> Email: bidhannath2001@gmail.com</p>
            </div>
            <div>
                <img src="./img/image/aritra.jpg" alt="Aritra Chowdhury" class="profile-picture">
                <p><span>Aritra Chowdhury</span><br> Senior Sales Manager <br> Phone: 01765743474 <br> Email: aritrapratya@gmail.com</p>
            </div>
            <div>
                <img src="" alt="Tahsin Ahmed Rafi" class="profile-picture">
                <p><span>Tahsin Ahmed Rafi</span><br> Senior Sales Manager <br> Phone: 01765743474 <br> Email: aritrapratya@gmail.com</p>
            </div>
        </div>
    </section>

    <?php include 'footer.php';?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
