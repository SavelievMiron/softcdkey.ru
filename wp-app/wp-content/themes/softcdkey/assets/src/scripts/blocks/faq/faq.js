const topics = document.getElementsByClassName("hot-topic");
if (topics.length !== 0) {
  for (let i = 0; i < topics.length; i++) {
    topics[i].addEventListener("click", function (e) {
        for (let i = 0; i < topics.length; i++) {
            topics[i].classList.remove('is-active')
        }
        this.classList.toggle("is-active");
        
        const id = this.dataset.id,
        header = $(this).find('h4').text();

        $.ajax({
          type: 'GET',
          url: globalJS.ajax_url,
          data: {
            action: globalJS.ajax_actions.get_question,
            id: id,
            _wpnonce: globalJS.nonce.ajax.get_question
          },
          dataType: 'json',
          error: function () {
            alert('Произошла ошибка. Попробуйте ещё раз.')
          },
          success: function (response) {
            if (response.success) {
              $('.faq__questions--header').html(header)
              $('.faq__questions--content').html(response.data.items)
            } else {
              alert(response.data.message)
            }
          }
        })
    });
  }
}

const questions = document.getElementsByClassName("faq__question");
if (questions.length !== 0) {
  for (let i = 0; i < questions.length; i++) {
    questions[i].addEventListener("click", function () {
      this.classList.toggle("is-active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      } 
    });
  }
}
