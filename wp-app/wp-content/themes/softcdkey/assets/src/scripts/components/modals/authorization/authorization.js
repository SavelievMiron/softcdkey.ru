const authorizationModal = document.querySelector(".modal--authorization");

if (authorizationModal !== null) {
  const showPass = authorizationModal.querySelectorAll(".show-pass");
  if (showPass.length !== 0) {
    showPass.forEach((el) => {
      el.addEventListener("click", (e) => {
        const icon = e.target,
          field = icon.previousElementSibling;
        if (!icon.classList.contains("is-active")) {
          field.type = "text";
          icon.classList.add("is-active");
        } else {
          field.type = "password";
          icon.classList.remove("is-active");
        }
      });
    });
  }

  const closeModal = authorizationModal.querySelector(".modal__close");
  if (closeModal !== null) {
    closeModal.addEventListener("click", (e) => {
      authorizationModal.classList.add("hide");
    });
  }

  const signUpBtn = authorizationModal.querySelector(".user-sign-up");
  signUpBtn.addEventListener("click", (e) => {
    
    const registrationModal = document.querySelector(".modal--registration");
    if (registrationModal !== null) {
      authorizationModal.classList.add("hide");
      registrationModal.classList.remove("hide");
    }
  });

  window.onclick = function (e) {
    if (e.target == authorizationModal) {
      authorizationModal.classList.add("hide");
    }
  };

  $('.modal--authorization form').on('submit', function (e) {
    e.preventDefault()

    const $this = $(this),
    formMessage = $this.find('.form-message'),
    formData = $this.serialize()

    $this.find('input').each(function () { $(this).removeClass('form-field--invalid') })
    $this.find('.error-message').each(function () { $(this).empty(); })

    $.ajax({
      type: 'POST',
      url: globalJS.rest_api.login,
      data: formData,
      dataType: 'json',
      error: function (response, textStatus, thrownError) {
        const body = response.responseJSON;
        if (body.code === 'rest_invalid_param') {
          const params = body.data.params;
          if (params.hasOwnProperty('email')) {
            const email = $this.find('input[name="email"]'),
            error = email.next()

            email.addClass('form-field--invalid')
            error.html(params.email)
          }
          if (params.hasOwnProperty('password')) {
            const password = $this.find('input[name="password"]'),
            error = password.next()
            
            password.addClass('form-field--invalid')
            error.html(params.password)
          }
        } else {
          formMessage.addClass('is-active')
          formMessage.addClass('form-message--error')
          formMessage.html(body.message)
        }
      },
      success: function (response, textStatus, thrownError) {
        formMessage.addClass('is-active')
        formMessage.addClass('form-message--success')
        formMessage.html(response.message)
        setTimeout(() => {
          window.location.href = '/profile'
        }, 1000)
      }
    })
  })
}
