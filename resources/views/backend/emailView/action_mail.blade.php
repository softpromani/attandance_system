<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naac</title>
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .logo {
            max-width: 100px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        p{
            color:green;
        }
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">

    <div class="container">

        <!-- Header with Logo -->
        <div class="header">
            <!-- Logo -->
           <img src="{{ asset('frontend/assets/images/collage/coll_logo.png') }}" style="height: 100px; width:100px; border-radius:50%;" alt="School Logo" class="logo"> 
            <h2>JSF Academy</h2>
        </div>

        <!-- Content -->
        <div class="content">
           <h5>Hello Mr/Mis </h5> <p>{{ $email_temp->name }}</p>
            <h5>Your Staff Id:  </h5><p>{{ $email_temp->teacher_id }}</p>
            <h5>Create Your Own Password</h5><p><a href="https://www.google.com"></a></p>
        </div> 

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 JSF Academy. All rights reserved.</p>
        </div>

    </div>

</body>

</html>


