import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(function () {
  console.log(axios);
  $('#formAuthentication').on('submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var data = form.serialize();
    var button = $(this).find('button');
    button.attr('disabled', true);
    button.find('.button-text').addClass('d-none');
    button.find('.spinner-border').removeClass('d-none');
    form.find('input').attr('disabled', true);
    axios
      .post(url, data)
      .then(function (response) {
        if (response.data.status == 'success') {
          window.location.href = response.data.url;
        } else {
          $('#responseMessage').removeClass('d-none');
          $('#responseMessage').html(response.data.message);
        }
      })
      .catch(function (error) {
        console.error('There was an error!', error);
      })
      .finally(function () {
        form.find('input').attr('disabled', false);
        button.attr('disabled', false);
        button.find('.button-text').removeClass('d-none');
        button.find('.spinner-border').addClass('d-none');
      });
  });
});
