<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Login - Assets Pos Indonesia</title>
      <link href="/css/styles.css" rel="stylesheet" />
      <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
   </head>
   <body class="bg-white">
      @include('sweetalert::alert')
      <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
               <main>
                     <div class="container">
                        <div class="row justify-content-center">
                           <div class="col-lg-5">
                                 <div class="card shadow-lg border-1 rounded-lg mt-5">
                                    <div class="card-header text-center">
                                       <img src="/assets/img/logo.png" alt="Logo" class="img-fluid" style="max-width: 100px;" />
                                       <h3 class="text-center font-weight-light my-4">Login to Assets</h3>
                                    </div>
                                    <div class="card-body">
                                       <form action="{{ route('login.auth') }}" method="POST">
                                          @csrf
                                          <div class="form-floating mb-3">
                                             <input class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" type="email" placeholder="name@example.com" required/>
                                             <label for="inputEmail"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                             @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                             @enderror
                                          </div>
                                          <div class="form-floating mb-3">
                                             <input class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword" type="password" placeholder="Password" required/>
                                             <label for="inputPassword"><i class="fas fa-lock me-2"></i>Password</label>
                                             @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                </span>
                                             @enderror
                                          <div class="d-grid mt-3">
                                             <button class="btn btn-orange btn-lg" type="submit">Login</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
               </main>
            </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="/js/scripts.js"></script>
   </body>
</html>
