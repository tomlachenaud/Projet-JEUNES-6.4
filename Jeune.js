var passwordInput = document.getElementById("passwordInput");
    var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

    showPasswordCheckbox.addEventListener("mousedown", function() {
      passwordInput.type = "text";
    });

    showPasswordCheckbox.addEventListener("mouseup", function() {
      passwordInput.type = "password";
    });

    showPasswordCheckbox.addEventListener("mouseout", function() {
      passwordInput.type = "password";
    });