<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Coming Soon - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <!-- Font Awesome -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />
        <!-- MDB -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
        rel="stylesheet"
        />
        <style>
            * {
              box-sizing: border-box;
            }
            
            body {
              margin: 0;
              font-family: Arial;
              font-size: 17px;
            }
            
            #myVideo {
              position: fixed;
              right: 0;
              bottom: 0;
              min-width: 100%; 
              min-height: 100%;
            }
            
            .content {
              position: fixed;
              bottom: 0;
              background: rgba(0, 0, 0, 0.5);
              color: #f1f1f1;
              width: 100%;
              padding: 20px;
            }
            
            #myBtn {
              width: 200px;
              font-size: 18px;
              padding: 10px;
              border: none;
              background: #000;
              color: #fff;
              cursor: pointer;
            }
            
            #myBtn:hover {
              background: #ddd;
              color: black;
            }
            </style>
    </head>
    <body>
       <!-- Section: Design Block -->
   <!-- Section: Design Block -->
       <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden" style="padding: 100px;">
        <style>
        .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
                hsl(218, 41%, 35%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(218, 41%, 45%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%);
        }
    
        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }
    
        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }
    
        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
        }
        </style>
    
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h2 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        TV Harmoni <br />
                        <span style="color: hsl(218, 81%, 75%)">Untuk Senyum Keluarga Indonesia</span>
                    </h2>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        
                    </p>
                </div>
        
                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
            
                        <div class="card bg-glass">
                            <div class="card-body px-4 py-5 px-md-5">
                            <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                <div class="text-center">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="mb-5">Please enter your login and password!</p>
                                </div>
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                              
                
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="form3Example3" class="form-control" />
                                    <label class="form-label" for="form3Example3">Email address</label>
                                </div>
                
                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="form3Example4" class="form-control" />
                                    <label class="form-label" for="form3Example4">Password</label>
                                </div>
                
                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                                    <label class="form-check-label" for="form2Example33">
                                        Subscribe to our newsletter
                                    </label>
                                </div>
                
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                Sign up
                                </button>
                
                                <!-- Register buttons -->
                                {{-- <div class="text-center">
                                <p>or sign up with:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>
                
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>
                
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button> --}}
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
  <!-- Section: Design Block -->
  <!-- Section: Design Block -->
  <!-- Section: Design Block -->
    </body>
     <!-- Bootstrap core JS-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Core theme JS-->
     <!-- MDB -->
     <script
     type="text/javascript"
     src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
     ></script>
     <script src="js/scripts.js"></script>
     <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
     <!-- * *                               SB Forms JS                               * *-->
     <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
     <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
     <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</html>
