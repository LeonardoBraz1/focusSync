<?php
@session_start();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="assets/images/favicon1.ico" type="image/x-icon">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>FocusSync</title>

<link rel="stylesheet" type="text/css" href="assets/css/login.css">

</head>

<body id="particles-js">
  <div class="animated bounceInDown">
    <div class="container">
      <span class="error animated tada" id="msg"></span>
      <div id="login-container" class="flip-container">
        <div class="flipper">
          <div class="front">
            <form method="post" action="controllers/autenticacao.php" class="box" onsubmit="return checkStuff()">
              <h1><img style="width: 300px; margin: 45px 0 37px 0;" src="assets/images/logo-login.png" alt="logoFocusSync"></h1>
              <input type="text" name="username" require required placeholder="Digite seu email" autocomplete="off">
              <i class="typcn typcn-eye" id="eye"></i>
              <input type="password" name="password" require required placeholder="Digite sua senha" id="pwd"  autocomplete="off">
              <div>
                <p class="semibold-text mb-2"><a href="#" onclick="rotateContainer()">Esqueceu sua senha?</a></p>
              </div>
              <input type="submit" value="Fazer Login" class="btn1">
            </form>
          </div>
          <div class="back">
            <div id="forgot-password" class="box">
              <h1><img style="width: 200px; margin-bottom: -30px;" src="assets/images/logo-login.png" alt="logoFocusSync"></h1>
              <h1 style="color: #fff;">Redefinir Senha</h1>
              <form method="post" action="controllers/redefinir_senha.php" onsubmit="return checkEmail()">
                <input type="text" name="email"  required placeholder="Digite seu email" autocomplete="off">
                <input type="submit" value="Enviar" class="btn1">
              </form>
              <p class="semibold-text mt-2"><a href="#" onclick="rotateContainer()">Voltar para o Login</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Essential javascripts for application to work-->
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="assets/js/plugins/pace.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cldup.com/S6Ptkwu_qA.js"></script>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<Script>

    particlesJS.load('particles-js', 'particles.json', function() {
      console.log('callback - particles.js config loaded');
    });

    function showForgotPassword() {
      document.getElementById("forgot-password").style.display = "block";
      document.querySelector("form.box").style.display = "none";
    }

    function hideForgotPassword() {
      document.getElementById("forgot-password").style.display = "none";
      document.querySelector("form.box").style.display = "block";
    }

    function rotateContainer() {
      const container = document.querySelector('.container');
      container.classList.toggle('flipped');
    }


    var pwd = document.getElementById('pwd');
    var eye = document.getElementById('eye');

    eye.addEventListener('click', togglePass);

    function togglePass() {

      eye.classList.toggle('active');

      (pwd.type == 'password') ? pwd.type = 'text': pwd.type = 'password';
    }

    // Form Validation

    function checkStuff() {
      var email = document.form1.email;
      var password = document.form1.password;
      var msg = document.getElementById('msg');

      if (email.value == "") {
        msg.style.display = 'block';
        msg.innerHTML = "Please enter your email";
        email.focus();
        return false;
      } else {
        msg.innerHTML = "";
      }

      if (password.value == "") {
        msg.innerHTML = "Please enter your password";
        password.focus();
        return false;
      } else {
        msg.innerHTML = "";
      }
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if (!re.test(email.value)) {
        msg.innerHTML = "Please enter a valid email";
        email.focus();
        return false;
      } else {
        msg.innerHTML = "";
      }
    }

    // ParticlesJS

    // ParticlesJS Config.
    particlesJS("particles-js", {
      "particles": {
        "number": {
          "value": 60,
          "density": {
            "enable": true,
            "value_area": 800
          }
        },
        "color": {
          "value": "#ffffff"
        },
        "shape": {
          "type": "circle",
          "stroke": {
            "width": 0,
            "color": "#000000"
          },
          "polygon": {
            "nb_sides": 5
          },
          "image": {
            "src": "img/github.svg",
            "width": 100,
            "height": 100
          }
        },
        "opacity": {
          "value": 0.1,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 6,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
          }
        },
        "line_linked": {
          "enable": true,
          "distance": 150,
          "color": "#ffffff",
          "opacity": 0.1,
          "width": 2
        },
        "move": {
          "enable": true,
          "speed": 1.5,
          "direction": "top",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false,
          "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": false,
            "mode": "repulse"
          },
          "onclick": {
            "enable": false,
            "mode": "push"
          },
          "resize": true
        },
        "modes": {
          "grab": {
            "distance": 400,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 200,
            "duration": 0.4
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true
    });
  </script>
</body>

</html>