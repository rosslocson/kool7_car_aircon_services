<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: beige;
        }

        .container {
            display: flex;
            width: 700px;
            height: 500px;
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            border-color: #262626;
            border-style: double;
        }

        .illustration {
            background: #262626;
            color: #fff;
            flex: .75;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .illustration img {
            width: 75%;
            max-width: 300px;
        }

        .illustration p {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h2 {
            margin: 0 0 10px;
            font-size: 24px;
            color: #333;
        }

        .form-section p {
            margin: 0 0 30px;
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .form-group input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #6c63ff;
        }

        .form-section a {
            color: #6c63ff;
            text-decoration: none;
            font-size: 12px;
            text-align: right;
        }

        .form-section a:hover {
            text-decoration: underline;
        }

        .form-section button {
            padding: 10px;
            background: #c00427;
            color: #fff;
            font-size: 14px;
            font-weight: bolder;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 50%;
            justify-content: center;

        }

        .form-section button:hover {
            background: #AB4459;

            border-color: black;

        }

        .form-section .create-account {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .form-section .create-account a {
            color: #c00427;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Illustration Section -->
        <div class="illustration">
            <img src="logo 2.png" alt="Illustration">
            <p>Login to your account to get a full user experience</p>
        </div>
        <!-- Form Section -->
        <div class="form-section">
            <h2 style="color: #c00427">Hello!</h2>
            <p>Login your account</p>
            <form action="user_login.php" method="post" name="form2">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div style="position: relative;">
                        <i class="fa fa-envelope"
                            style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #888;"></i>
                        <input type="text" id="email" name="email" placeholder="Enter your email" required
                            style="padding-left: 35px; width: 100%; border: 1px solid #ddd; border-radius: 5px; height: 40px; box-sizing: border-box;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position: relative;">
                        <i class="fa fa-lock"
                            style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); color: #888;"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required
                            style="padding-left: 35px; width: 100%; border: 1px solid #ddd; border-radius: 5px; height: 40px; box-sizing: border-box;">
                    </div>
                </div>

                <div> <button type="submit" name="login">Login</button> </div>

                <div class="create-account">
                    <br>
                    <p>Don't have an account? <a href="createuseraccount.php">Create Account</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>