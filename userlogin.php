<!DOCTYPE html>
<html lang="en">

<head>

    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css">

    <style>
        body {
            color: white;
        }

        #login {
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            text-align: center;
            width: 100%;
            padding-top: 60px;
        }

        #login img {
            width: 150px;

        }

        #login .form-group {
            max-width: 300px;
            margin: 0 auto;


        }

        #login .form-control {
            border-radius: 20;
            box-shadow: none;

        }

        #login button {
            background-color: #FFDD83;
            border: none;
            color: black;
            font-weight: bold;
            padding: 15px 30px;
            border-radius: 3cqb;
            font-size: 14px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            transition: background-color 0.3s;
        }

        #login button:hover {
            background-color: white;
            color: black;
        }

        .form-container {
            background-image: url(form.png);
            background-repeat: no-repeat;
            background-size: cover;
            padding: 10px;
            border-radius: 50px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            margin: 0 auto;
            margin-top: 30px;

        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            background-color: white;
            border-radius: 50px;
            padding: 10px;
            height: 50px;
        }

        .form-group .icon {
            padding: 10px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        .form-group .icon:hover {
            background-color: white;
        }

        .form-group .icon i {
            color: #00235B;
        }

        .form-group input {
            border: none;
            outline: none;
            background: none;
            color: black;
            font-size: 14px;
            flex: 1;
        }

        .form-group input::placeholder {
            color: #cdd3d8;
        }

        button {
            background-color: #00235B;
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Montserrat', sans-serif;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #FFDD83;
        }

        .form-container a {
            color: white;
        }

        #demo li {
            list-style: none;
        }
    </style>

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <nav class="navbar navbar-default navbar-fixed-top" id="myNavbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-left">
                <a class="navbar-brand" href="index.html">Paws & Play</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                <button data-toggle="collapse" data-target="#demo">
                    <span class="glyphicon glyphicon-user"></span></button>

                <div id="demo" class="collapse">
                     <ul>
                        <li><a href="index.html">User</a></li>
                        <li><a href="adminlogin.html">Admin</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>

    <!--Log in Section -->
    <div id="login" class="container-fluid text-center bg-light">
        <div class="form-container">
            <h3 style="color: white"> Login </h3>
            <br>
            <form action="login.php" method="post" name="form2">

                <label for="email">Email Address</label>
                <div class="form-group">

                    <div class="icon"><i class="fas fa-envelope"></i></div>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <br>
                <label for="email">Password</label>
                <div class="form-group">
                    <div class="icon"><i class="fas fa-lock"></i></div>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <br>
                <button id="buttons" type="submit" name="login" class="btn btn-lg">Log In</button>
                <br><br>
                <p><a href="register.html">Create an account</a>
                </p>
            </form>
        </div>
    </div>
    <!-- FOOTER -->
    <div>
        <footer class="container-fluid text-center">
            <div class="row">
                <div class="col-sm-12">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>

                </div>
                <div id="footernames">
                    <div class="col-sm-12">
                        <h6>ITEL 203 PROJECT by: BELEN • LOCSON • MORALES • REYES</h6>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        $(document).ready(function () {
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function () {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });

            $(window).scroll(function () {
                $(".slideanim").each(function () {
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });
        })
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>

</html>