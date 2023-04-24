document.onreadystatechange = () => {
  if (document.readyState === 'interactive') {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let check = this.responseText;
        if (check == 'false') {
          window.location.href = '../../index.html';
        } else {
          document.getElementById('usernamefs').innerHTML =
            'Welcome ' + this.responseText;
        }
      }
    };
    xmlhttp.open('GET', 'student.php', true);
    xmlhttp.send();
  }
};

function logout() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.href = '../../index.html';
    }
  };
  xmlhttp.open('GET', 'logout.php', true);
  xmlhttp.send();
}
