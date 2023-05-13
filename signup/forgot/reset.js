function checkPass() {
  const pass = document.getElementsByName('password');
  const pass_check = document.getElementsByName('password_check');
  const button = document.getElementById('button');
  let y = pass_check[0].value;
  let x = pass[0].value;

  if (x != y) {
    document.getElementById('pop').hidden = false;
    document.getElementById('pop').innerHTML = 'Password Do Not Match';
    button.disabled = true;
  } else {
    document.getElementById('pop').hidden = true;

    button.disabled = false;
  }
}

function submit2() {
  let pop = document.getElementById('pop');
  const pass = document.getElementsByName('password');
  const button = document.getElementById('button');
  let y = pass[0].value;

  const url = 'submit.php';
  const data = {
    password: y,
  };
  $.ajax({
    url: url,
    method: 'POST',
    data: data,
    success: function (response) {
      console.log(response);
      pop.removeAttribute('hidden');
      pop.innerHTML = response + '<br>' + 'Redirecting...';
      button.disabled = true;
      setTimeout(redirect, 2000);
    },
    error: function (xhr, status, error) {
      console.log('Error:', error);
    },
  });
}

function redirect() {
  document.location.href = '../../index.html';
}
