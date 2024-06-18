const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});

//fungsi login
document.addEventListener('DOMContentLoaded', function() {
  // Function to toggle password visibility
  function togglePasswordVisibility(inputField, eyeIcon) {
    const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
    inputField.setAttribute('type', type);
    eyeIcon.classList.toggle('fa-eye-slash');
  }

  // Sign Up
  const toggleSignUpPassword = document.getElementById('toggleSignUpPassword');
  const signUpPassword = document.getElementById('signUpPassword');
  toggleSignUpPassword.addEventListener('click', function() {
    togglePasswordVisibility(signUpPassword, toggleSignUpPassword);
  });

  // const signUpButton = document.getElementById('signUpButton');
  // signUpButton.addEventListener('click', function() {
  //   alert('databasenya belum di buat bang');// ini fungsi buat insert db nya
  // });

  // Sign In
  const toggleSignInPassword = document.getElementById('toggleSignInPassword');
  const signInPassword = document.getElementById('signInPassword');
  toggleSignInPassword.addEventListener('click', function() {
    togglePasswordVisibility(signInPassword, toggleSignInPassword);
  });

  const signInButton = document.getElementById('signInButton');
  signInButton.addEventListener('click', function() {
    const username = document.querySelector('.sign-in-container input[type="text"]').value;
    const password = document.querySelector('.sign-in-container input[type="password"]').value;


    const signUpButton = document.getElementById('signUpButton');
    signUpButton.addEventListener('click', function() {
      const registerForm = document.getElementById('registerForm');
      const formData = new FormData(registerForm);
      
      fetch('/backend/php/login/register.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        alert(data);
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan pada server');
      });
    });
  
    const signInButton = document.getElementById('signInButton');
    signInButton.addEventListener('click', function() {
      const loginForm = document.getElementById('daftarForm');
      const formData = new FormData(loginForm);
      
      fetch('/backend/php/login/login.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          if (data.role === 'admin') {
            window.location.href = 'frontend/page/admin/admin.html';
          } else {
            window.location.href = 'frontend/page/user/user.html';
          }
        } else {
          alert('Username atau password salah');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan pada server');
      });
    });


  });
});