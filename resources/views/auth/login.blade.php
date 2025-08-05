<!DOCTYPE html>
       <html lang="en">
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <meta name="csrf-token" content="{{ csrf_token() }}">
           <title>Login - FIKOMApps</title>
           <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
           <style>
               body {
                   background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
                   height: 100vh;
                   display: flex;
                   justify-content: center;
                   align-items: center;
                   font-family: 'Arial', sans-serif;
               }
               .login-container {
                   background: rgba(0, 0, 0, 0.9);
                   border: 2px solid #f1c40f;
                   border-radius: 15px;
                   padding: 2rem;
                   width: 100%;
                   max-width: 400px;
                   box-shadow: 0 0 20px rgba(241, 196, 15, 0.3);
                   color: #fff;
               }
               .login-container h2 {
                   color: #f1c40f;
                   text-align: center;
                   margin-bottom: 1.5rem;
                   font-size: 1.8rem;
               }
               .login-container input {
                   width: 100%;
                   padding: 0.75rem;
                   margin-bottom: 1rem;
                   border: 1px solid #444;
                   border-radius: 5px;
                   background: #333;
                   color: #fff;
               }
               .login-container input:focus {
                   outline: none;
                   border-color: #f1c40f;
                   box-shadow: 0 0 5px rgba(241, 196, 15, 0.5);
               }
               .login-container button {
                   width: 100%;
                   padding: 0.75rem;
                   background: #f1c40f;
                   border: none;
                   border-radius: 5px;
                   color: #1a1a1a;
                   font-weight: bold;
                   cursor: pointer;
                   transition: background 0.3s;
               }
               .login-container button:hover {
                   background: #e0b50a;
               }
               .login-container .footer-text {
                   text-align: center;
                   margin-top: 1rem;
                   color: #ccc;
               }
               .login-container .footer-text a {
                   color: #f1c40f;
                   text-decoration: underline;
               }
               .login-container .footer-text a:hover {
                   color: #e0b50a;
               }
           </style>
       </head>
       <body>
           <div class="login-container">
               <h2>Login - FIKOMApps</h2>
               <form method="POST" action="{{ route('login') }}">
                   @csrf
                   <div>
                       <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                       @error('email')
                           <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                       @enderror
                   </div>
                   <div>
                       <input type="password" name="password" placeholder="Password" required>
                       @error('password')
                           <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                       @enderror
                   </div>
                   <div>
                       <button type="submit">Login</button>
                   </div>
                   <div class="footer-text">
                       @if (Route::has('password.request'))
                           <a href="{{ route('password.request') }}">Lupa Password?</a>
                       @endif
                   </div>
               </form>
           </div>
       </body>
       </html>