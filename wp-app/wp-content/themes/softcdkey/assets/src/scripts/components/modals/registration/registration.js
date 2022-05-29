const registrationModal = document.querySelector(".modal--registration");
if (registrationModal !== null) {
  const showPass = registrationModal.querySelectorAll(".show-pass");

  if (showPass.length !== 0) {
    showPass.forEach((el) => {
      el.addEventListener("click", (e) => {
        const icon = e.target,
          field = icon.previousElementSibling;
        if (!icon.classList.contains("is-active")) {
          field.setAttribute("type", "text");
          icon.classList.add("is-active");
        } else {
          field.setAttribute("type", "password");
          icon.classList.remove("is-active");
        }
      });
    });
  }

  const closeModal = registrationModal.querySelector(".modal__close");
  if (closeModal !== null) {
    closeModal.onclick = function (e) {
      registrationModal.classList.add("hide");
    };
  }

  window.onclick = function (e) {
    if (e.target == registrationModal) {
      registrationModal.classList.add("hide");
    }
  };
  
  $('.modal--registration form').on('submit', function (e) {
    e.preventDefault()

    const $this = $(this),
    formMessage = $this.find('.form-message'),
    formData = $this.serialize()

    $this.find('input').each(function () { $(this).removeClass('form-field--invalid') })
    $this.find('.error-message').each(function () { $(this).empty(); })

    $.ajax({
      type: 'POST',
      url: globalJS.rest_api.register,
      data: formData,
      dataType: 'json',
      error: function (response, textStatus, thrownError) {
        const body = response.responseJSON;
        if (body.code === 'rest_invalid_param') {
          const params = body.data.params;
          if (params.hasOwnProperty('email')) {
            const email = $this.find('input[name="email"]'),
            error = email.parent().find('.error-message')
            console.log(error)
            email.addClass('form-field--invalid')
            error.html(params.email)
          }
          if (params.hasOwnProperty('password')) {
            const password = $this.find('input[name="password"]'),
            error = password.parent().find('.error-message')
            console.log(error)
            password.addClass('form-field--invalid')
            error.html(params.password)
          }
          if (params.hasOwnProperty('password_confirmation')) {
            const password = $this.find('input[name="password_confirmation"]'),
            error = password.parent().find('.error-message')
            
            password.addClass('form-field--invalid')
            error.html(params.password_confirmation)
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
      }
    })
  })
}


