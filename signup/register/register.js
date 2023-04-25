let   flag2=0;
let   flag1=0;
let   flag3=0;
// let  button = document.getElementById('button');
function checkPass() {
  // const name = document.getElementsByName('name');
  // const pass = document.getElementsByName('password');
  // const pass_check = document.getElementsByName('password_check');
  // const button = document.getElementById('button');
  // let y = pass_check[0].value;
  // let x = pass[0].value;
  // let z = name[0].value;
  // let pop = document.getElementById('pop');
  // // console.log("hi");
  // if (x != y) {
  //   pop.removeAttribute('hidden');
  //   pop.innerHTML = 'Passwords do not match!!';
  //   button.disabled = true;
  // } else if (x == y && z != '') {
  //   button.disabled = false;
  //   pop.hidden = true;
  // }
  // if(z.length==0){
  //   button.disabled=true;
  // }

  // console.log("hi");
  const name = document.getElementsByName('name');
  const pass = document.getElementsByName('password');
  const pass_check = document.getElementsByName('password_check');
  const button = document.getElementById('button');
  let y = pass_check[0].value;
  let x = pass[0].value;
  let z = name[0].value;



  if(x.length==0){
    flag3=0;
  }
  else{
    flag3=1;
  }
  
  if(x!=y ){
    flag2=0;
    
    document.getElementById('pop').hidden=false;
    document.getElementById('pop').innerHTML='Password Do Not Match';
    
  }
  else{
    document.getElementById('pop').hidden=true;
    flag2=1;
  }
  if(flag1==0 ||flag2 ==0||flag3==0){
    button.disabled=true;
  }
  else{
    button.disabled=false;
  }

  
}

function checkName(){
  const name = document.getElementsByName('name');
  const pass = document.getElementsByName('password');
  const pass_check = document.getElementsByName('password_check');
  const button = document.getElementById('button');
  let y = pass_check[0].value;
  let x = pass[0].value;
  let z = name[0].value;
  
  // let  flag1=0, flag2=0;

  if (z.length==0){
    flag1=0;
    document.getElementById('pop').hidden=false;
    document.getElementById('pop').innerHTML='username should not be empty';
    
  }
  else{
    document.getElementById('pop').hidden=true;
    flag1=1;
  }
  if(flag1==0 || flag2 ==0 ||flag3==0){
    button.disabled=true;
  }
  else{
    button.disabled=false;
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
