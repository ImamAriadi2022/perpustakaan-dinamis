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
    eyeIcon.classList.toggle('fa-eye');
    eyeIcon.classList.toggle('fa-eye-slash');
  }

  // =========================== Sign Up ===============================
  // hide password typing function
  const toggleSignUpPassword = document.getElementById('toggleSignUpPassword');
  const signUpPassword = document.getElementById('signUpPassword');
  toggleSignUpPassword.addEventListener('click', function() {
    togglePasswordVisibility(signUpPassword, toggleSignUpPassword);
  });

  // sign up proccess
  const signUpButton = document.getElementById('signUpButton');
  signUpButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the form from submitting in the default way

    // eyes checking
    const signUpPassword = document.getElementById('signUpPassword');
    if (signUpPassword.getAttribute('type') === 'text') {
      alert('Tutup passwordmu dulu!');
      return;
    }

    const daftarForm = document.getElementById('daftarForm');
    const formData = new FormData(daftarForm);
    
    fetch('backend/php/login/register.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.code == 200) {
        const result = document.getElementById('signUpResult');
        result.innerHTML = data.message;
      } else {
        const result = document.getElementById('signUpResult');
        result.innerHTML = 'Registrasi gagal';
        console.log(data.message);
      };
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });


  // =========================== Sign In ===============================
  // hide password typing function
  const toggleSignInPassword = document.getElementById('toggleSignInPassword');
  const signInPassword = document.getElementById('signInPassword');
  toggleSignInPassword.addEventListener('click', function() {
    togglePasswordVisibility(signInPassword, toggleSignInPassword);
  });

  // sign in proccess
  const signInButton = document.getElementById('signInButton');
  signInButton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the form from submitting in the default way
    
    // eyes checking
    const signInPassword = document.getElementById('signInPassword');
    if (signInPassword.getAttribute('type') === 'text') {
      alert('Tutup passwordmu dulu!');
      return;
    }
  
    const loginForm = document.getElementById('masukForm');
    const formData = new FormData(loginForm);
    
    fetch('backend/php/login/login.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.code == 200) {
        console.log(data.message);
        if (data.data.role_id == 1) {
          window.location.href = 'frontend/page/admin/admin.php';
        } else {
          window.location.href = 'frontend/page/user/user.html';
        }
      } else {
        alert(data.message);
        console.log(data.message);
      };
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
});