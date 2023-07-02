<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <title>RESUME+ main</title>
    <link rel="icon" type="image/x-icon" href="favicon-16x16.png">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="printstyle.css">
    <style>
        .container pre{
           
            font-weight: bold;
            overflow: hidden;
            text-shadow: #010101;
            color:black;
            border-right: .15em solid rgb(16, 16, 15);
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: .1em;
            animation: typing 1s steps(40, end), blink-caret .9s step-end infinite;
        }
         @keyframes typing {
            from {
                width: 0;
            }
            to {
                width: 100%;
            }
        }
        @media (prefers-color-scheme: dark) {
           .navbar .resume-brand {
            color: #090907;
          }
        }

        .typing-effect {
            animation: typing 2s steps(40) 1s normal both;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid;
        }
        .navbar-custom {
            background-color: #ffffff;
        }

        .footer {
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
        }
        .navbar-custom {
            background-color: white;
            /* margin-left: 2%; */

        }
        .footer {
            background-color: #ffffff;
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #090907;
        }


        

        .footer ul {
            list-style-type: none;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0;
        }

        .footer ul li {
            margin: 0 10px;
        }

        .footer ul li a {
            color: #010101;
            text-decoration:dotted;
            font: weight 100px;;
        }
        .container {
            padding-top: 100px;
        }
    </style>
    <style>
        body {
            transition: background-color 0.9s ease;
        }

        .dark-mode {
            background-color: #333333;
            color: #000000;
        }

        .navbar-custom {
            background-color: #fdfdfd;
        }

        .navbar-custom.light-mode {
            background-color: #f8f8ef;
        }

        .footer {
            background-color: #ffffff;
            color: #090907;
            transition: background-color 0.9s ease;

        }

        .footer.dark-mode {
            background-color: #333333;
            color: #ffffff;
        }

        .card {
            background-color: #f8f9fa;
            transition: background-color 0.9s ease;

        }

        .card.dark-mode {
            background-color: #444444;
            color: #ffffff;
        }

        .text-white {
            color: #ffffff;
        }
    </style>
    <style>
        body.dark-mode {
            color: #ffffff;
        }

        body.dark-mode label {
            color: #ffffff;
        }

        body.dark-mode h1,
        body.dark-mode pre,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4 {
            color: #ffffff;
        }

        body.dark-mode label{
            color: #090907;
        }
        body.dark-mode ul,
        body.dark-mode li {
            color: #ffffff;
        }
    </style>
  </head>
  <body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
            <a class=" navbar-brand" href="index.html" style="font-family: 'Comic Sans MS', cursive;">  RESUME+</a>
            <div class="ml-auto ms-auto">
            <button id="modeSwitch" class="btn  btn btn-dark ">Theme</button>

                <a href="logout.php" class="btn btn-danger m-lg-2 m-auto">Logout</a>
            </div>
        </nav>
    </section>
    <section>
        <div id="cv-form" class="container">
            <h1 class="text-center my-2" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">...RESUME+...</h1> <hr>
            <pre class="text-center my-2 typing-effect" style="font-family: Verdana, Geneva, Tahoma, sans-serif-italic;">
                Create a resume by filling the information below..
            </pre><hr>
            <div class="row">
                <div class="col-md-6">
                    <br><br>
                    <h3>Personal information</h3> <br>
                    
                    <div class="form-group">
                        <label for="nameField"class="name-label">Name</label><br><br>
                        <input type="text" id="nameField" placeholder="Enter name here.." class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="contactfield"class="contact-label">Contact</label><br><br>
                        <input type="text" id="contactField" placeholder="Enter contact no. here.." class="form-control" />

                    </div>
                    <div class="form-group">
                        <label for="addressField"class="address-label">Address</label><br><br>
                        <textarea name="address" id="addressField" cols="10" rows="6" class="form-control"
                            placeholder="Enter Address here.."></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="profilephoto"class="profile-label">Profile Photo</label><br><br>
                        <input type="file" id="imgField" accept="image/*" class="form-control" onchange="handleFileSelect(event)" />

                       
                    </div>
                    <hr>
 <!-- <img id="imgField" src="#" alt="Preview" style="min-width: 200px; min-height: 200px;" /> -->
                    <p class="text-primary">Important Links</p>
                    <div class="form-group">
                        <label for="socialfield"class="github-label">Github</label><br><br>
                        <input type="text" id="fbField" placeholder="https://github.com/" class="form-control" />

                    </div>
                    <div class="form-group">
                        <label for="socialfield"class="twitter-label">Twitter</label><br><br>
                        <input type="text" id="instaField" placeholder="https://twitter.com/" class="form-control" />

                    </div>
                    <div class="form-group mt-2">
                        <label for="socialfield" class="linkedin-label">Linkedin</label><br><br>
                        <input type="text" id="LinkedField" placeholder="https://www.linkedin.com/in/" class="form-control" />

                    </div>
                </div>
                <div class="col-md-6">
                    <br><br>
                    <h3>Professional information</h3><br>
                    <div class="form-group mt-2">
                        <label for="" class="objective-label">Objectives</label><br><br>
                        <textarea name="" id="objectiveField" placeholder="Enter Objectives..." class="form-control"
                            cols="5" rows="3"></textarea>

                    </div>

                    <div class="form-group mt-2">
                    <label for="workfield" class="work-label">Work Experience</label><br><br>


                        <textarea type="text" placeholder="Enter Work experience's" class="form-control weField" class="weField"
                            rows="4"></textarea>
                        <!-- new textarea -->

                        <div class="container text-left mt-2" id="weAddButton">
                            <button onclick="addNewWEField()" class="btn btn-dark btn-sm">Add more</button>
                        </div>

                    </div>

                    <div class="form-group mt-2" id="ql">
                        <label for="qualification"  class="academic-label" >Academic Qualification</label><br><br>
                        <textarea type="text" placeholder="Enter Qualification's..." class="form-control eqField"
                            rows="4"></textarea>
                        <!-- textarea -->

                        <div class="container text-left mt-2" id="aqAddButton">
                            <button onclick="addNewAQField()" class="btn btn-dark btn-sm">Add more</button>

                        </div>

                    </div>
                    
                    <!-- <div class="form-group mt-2" id="sk">
                        <label for="qualification">Skills</label>
                        <textarea type="text" placeholder="Enter Skill's..." class="form-control skField"
                            rows="4"></textarea>
                        <!-- textarea -->

                        <!-- <div class="container text-left mt-2" id="skAddButton">
                            <button onclick="addNewSkField()" class="btn btn-dark btn-sm">Add more</button>

                        </div> -->

                    <!-- </div> --> 
                </div>
            </div>
            <div class="container text-center mt-4">
                <button onclick="generateCV()" class="btn btn-success btn-lg"> Generate </button><br><hr>
            </div>
        </div>

    </section>

<!-- template -->
    <div id="print-content">

    <div class="card mt-3">

    <div class="container" id="cv-template">
        <div class="row">
            <div class="col-md-4 text-center templatebackground">
                <br><br>
                <img src="https://webstockreview.net/images/document-clipart-portfolio-folder-8.png" id="imgTemplate" alt="Profile Photo" style="min-width: 200px; min-height: 200px;" class="img-fluid myimg" />




                <div class="container">
                    <br>
                    <p id="nameT1">Peter Alison Parker</p>
                    <p id="contactT">+916864664488, +916344999977</p>
                    <p id="addressT">Blue circle, 8944 sector, Noida, US</p>
                    <hr>
                    <p><a id="fbT" href="https://github.com/">Github</a></p>
                    <p><a id="instaT" href="https://twitter.com/">Twitter</a></p>
                    <p><a id="LinkedT" href="https://www.linkedin.com/in/">Linkedin</a></p>


                </div>
            </div>

            <div class="col-md-8 py-5 templatebackground">
                <!-- second column  -->
                <h1 id="nameT2" class="text-center" style="font-weight: 980;">
                    Peter Alinson Parker
                </h1>

                <!-- objectives  -->
                <div class="card mt-5">
                    <div class="card-header cardcolor">
                        <h3>Objectives</h3>
                    </div>
                    <div class="card-body cardcolor">
                        <p id="objectiveT">
                        
                        </p>
                    </div>
                </div>

                <!-- work Experience -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Work Experience</h3>
                    </div>
                    <div class="card-body">
                        <ul id="weT">
                        <li> text will be printed dynamically</li>
                        </ul>
                    </div>
                </div>


                <!-- Academic qualification -->
                <div class="card mt-4">
                    <div class="card-header"class="academic-label">
                        <h3 >Academic Qualification</h3>
                    </div>
                    <div class="card-body">
                        <ul id="aqT">
                            <li> text will be printed dynamically</li>
                            
                        </ul>
                    </div>
                </div>
                <!-- Skills -->
                <!-- <div class="card mt-4">
                    <div class="card-header">
                        <h3>Skills</h3>
                    </div>
                    <div class="card-body">
                        <ul id="skT">
                        <li> text will be printed dynamically</li>
                        </ul>
                    </div>
                </div> -->

    </div></div>
                <div class="container mt-2 textfa-pull-right">
                <button onclick="window.print()"class="btn btn-success">Print CV</button>

                    <!-- <button onclick="printCV()" class="btn btn-success">Print</button> -->
                </div>
                <div class="container mt-1 textfa-pull-right">
                    <a href="welcome.php" class="btn btn-dark col-md-3 py-2">Recreate</a>
                </div>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <ul>
                <li><a href="terms.html">Terms &amp; Privacy</a></li>
                <li><a href="aboutus.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <p>&copy; 2023 RESUME+. All rights reserved.</p>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <script>
       var modeSwitchButton = document.getElementById('modeSwitch');
var body = document.querySelector('body');
var navbar = document.querySelector('.navbar-custom');
var footer = document.querySelector('.footer');
var card = document.querySelector('.card');
var workLabel = document.querySelector('.work-label');
var academicLabel = document.querySelector('.academic-label');
var objectiveLabel = document.querySelector('.objective-label');

var nameLabel = document.querySelector('.name-label');
var contactLabel = document.querySelector('.contact-label');
var addressLabel = document.querySelector('.address-label');
var profileLabel = document.querySelector('.profile-label');
var githubLabel = document.querySelector('.github-label');
var twitterLabel = document.querySelector('.twitter-label');
var linkedinLabel = document.querySelector('.linkedin-label');


modeSwitchButton.addEventListener('click', function () {
    if (body.classList.contains('dark-mode')) {
        body.classList.remove('dark-mode');
        navbar.classList.remove('light-mode');
        footer.classList.remove('dark-mode');
        card.classList.remove('dark-mode');
        modeSwitchButton.textContent = 'Dark Mode';

        // Change text color to white
        navbar.classList.remove('text-white');
        footer.classList.remove('text-white');
        card.classList.remove('text-white');
        workLabel.classList.remove('text-white'); // Remove the white color class from work experience label
        academicLabel.classList.remove('text-white');
        objectiveLabel.classList.remove('text-white');

        nameLabel.classList.remove('text-white');
        contactLabel.classList.remove('text-white');
        addressLabel.classList.remove('text-white');
        profileLabel.classList.remove('text-white');
        twitterLabel.classList.remove('text-white');
        githubLabel.classList.remove('text-white');
        linkedinLabel.classList.remove('text-white');
    } else {
        body.classList.add('dark-mode');
        navbar.classList.add('light-mode');
        footer.classList.add('dark-mode');
        card.classList.add('dark-mode');
        modeSwitchButton.textContent = 'Light Mode';

        // Change text color to black
        navbar.classList.add('text-white');
        footer.classList.add('text-white');
        card.classList.add('text-white');
        workLabel.classList.add('text-white'); // Add the white color class to work experience label
        academicLabel.classList.add('text-white');
        objectiveLabel.classList.add('text-white');

        nameLabel.classList.add('text-white'); 
        contactLabel.classList.add('text-white'); 
        addressLabel.classList.add('text-white'); 
        profileLabel.classList.add('text-white'); 
        twitterLabel.classList.add('text-white'); 
        githubLabel.classList.add('text-white'); 
        linkedinLabel.classList.add('text-white'); 

    }
});

    </script>
    
    <script>
         function handleFileSelect(event) {
         var file = event.target.files[0];
         var reader = new FileReader();

         reader.onload = function (event) {
         var imgTemplate = document.getElementById('imgTemplate');
         imgTemplate.src = event.target.result;
       };

       reader.readAsDataURL(file);
     }

    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>

