<?php 

function escapeString($string){
    return $string; 

    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $content = $_POST['dynamicContent'];
    
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO contents (content, created_at) VALUES (?, NOW())");
        $stmt->bind_param("s", $content);
    
        if ($stmt->execute()) {
            $success_message = "Content saved successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    
        $stmt->close();
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - XSS Vulnerability Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>
    <style>
        /* General Reset */
        body {
            background: #f8f9fa;
            color: #343a40;
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        nav.navbar {
            background: linear-gradient(to right, #6a11cb, #2575fc);
        }

        nav.navbar .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav.navbar .navbar-brand:hover {
            color: #d4d4d4;
        }

        footer {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }

        footer div {
            padding: 1rem;
        }

        footer a {
            color: #ffffff;
            font-weight: 500;
        }

        /* Main Content */
        #main-wrapper {
            margin-top: 2rem;
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            background: #6a11cb;
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .card-header .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #6a11cb;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.6);
        }

        .btn-primary {
            background: #2575fc;
            border: none;
        }

        .btn-primary:hover {
            background: #6a11cb;
        }

        .card-footer {
            background: #f1f1f1;
            border-radius: 0 0 15px 15px;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            nav.navbar .navbar-brand {
                font-size: 1.2rem;
            }

            .card-header .card-title {
                font-size: 1rem;
            }

            footer div {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <main>
    <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="./">Secure XSS Example</a>
               
            </div>
        </nav>
        </nav>
        <div id="main-wrapper">
            <div class="container px-5 my-3" >
                <script>
                    start_loader()
                </script>
                <div class="mx-auto col-lg-8 col-md-10 col-sm-12 col-xs-12">
                    <?php if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['dynamicContent'])): ?>
                    
                    <div class="card mb-3 rounded-0 shadow">
                        <div class="card-header rounded-0">
                            <div class="card-title"><b>Submitted Content</b></div>
                        </div>
                        <div class="card-body rounded-0">
                            <div class="container-fluid">
                                <?php 
                                   
                                    echo $_POST['dynamicContent']; 
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                    <div class="card rounded-0 mb-3 shadow">
                        <div class="card-header rounded-0">
                            <div class="card-title"><b>Sample Form</b></div>
                        </div>
                        <div class="card-body rounded-0">
                            <div class="container-fluid">
                                <form id="sample-form" action="" method="POST">
                                    <div class="mb-3">
                                        <label for="dynamicContent" class="form-label fw-light">Content</label>
                                        <textarea class="form-control form-control-sm rounded-0" 
                                        name="dynamicContent" 
                                        id="dynamicContent" 
                                        rows="10" 
                                        style="resize:none" 
                                        placeholder="Write your content here..."><?php 
   
                                        ?></textarea>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer text-center rounded-0">
                             <button class="btn btn-primary rounded-pill" form="sample-form">Submit Content</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center text-light">
            <div>Dnyaneshwar Shelke <span id="dt-year"></span> | Aarav Gaur</div>
            <div><a href="mailto:dnyaneshwarshelke0109@gmail.com">dnyaneshwarshelke0109@gmail.com</a><a>           |          </a><a href="mailto:aaravgaur759@gmail.com">aaravgaur759@gmail.com</a></div>
            <div></div>
        </footer>
    </main>
    
</body>
</html>
