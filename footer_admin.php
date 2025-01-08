<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
      var passwordField = document.getElementById('exampleInputPassword1');
      var passwordToggle = document.getElementById('password-toggle');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordToggle.src = 'admin-assets/img/view.png'; // Correct path to show password image
      } else {
        passwordField.type = 'password';
        passwordToggle.src = 'admin-assets/img/close-eye.png'; // Correct path to hide password image
      }
    }
  </script>
</body>
</html>