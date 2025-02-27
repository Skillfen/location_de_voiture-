window.addEventListener("load", function () {
          const preloader = document.querySelector("#preloader");
          preloader.classList.add("hide");
      });
  function showPassword() {
    var passwordField = document.getElementById("floatingPassword");
    if (passwordField.type === "password") {
      passwordField.type = "text";
    } else {
      passwordField.type = "password";
    }
  }

  window.addEventListener("load", function() {
    var emailField = document.getElementById("floatingInput");
    emailField.addEventListener("invalid", function() {
      if (emailField.validity.valueMissing) {
        emailField.setCustomValidity("Veuillez saisir votre Utilisateur");
      } else if (emailField.validity.typeMismatch) {
        emailField.setCustomValidity("Veuillez saisir une Utilisateur valide.");
      } else {
        emailField.setCustomValidity("");
      }
    });

    var passwordField = document.getElementById("floatingPassword");
    passwordField.addEventListener("invalid", function() {
      if (passwordField.validity.valueMissing) {
        passwordField.setCustomValidity("Veuillez saisir votre mot de passe.");
      } else {
        passwordField.setCustomValidity("");
      }
    });
  });
