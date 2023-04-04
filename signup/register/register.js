function checkPass() {
  const name = document.getElementsByName('name');
  const pass = document.getElementsByName('password');
  const pass_check = document.getElementsByName('password_check');
  const button = document.getElementById('button');
  let y = pass_check[0].value;
  let x = pass[0].value;
  let z = name[0].value;
  let pop = document.getElementById('pop');
  if (x != y) {
    pop.removeAttribute('hidden');
    pop.innerHTML = 'Passwords do not match!!';
    button.disabled = true;
  } else if (x == y && z != '') {
    button.disabled = false;
    pop.hidden = true;
  }
}

function submit2() {
  let pop = document.getElementById('pop');
  const name = document.getElementsByName('name');
  const pass = document.getElementsByName('password');
  let x = name[0].value;
  let y = pass[0].value;

  const url = 'submit.php';
  const data = {
    name: x,
    password: y,
  };
  $.ajax({
    url: url,
    method: 'POST',
    data: data,
    success: function (response) {
      console.log(response);
      pop.removeAttribute('hidden');
      pop.innerHTML = response;
    },
    error: function (xhr, status, error) {
      console.log('Error:', error);
    },
  });
}
