var num1;
var num2;
var result;

function plus() {
  num1 = document.getElementById('value1').value;
  num2 = document.getElementById('value2').value;
  result = Number(num1) + Number(num2);
  document.getElementById('result').innerHTML = result;
}

function minus() {
  num1 = document.getElementById('value1').value;
  num2 = document.getElementById('value2').value;
  result = num1 - num2;
  document.getElementById('result').innerHTML = result;
}

function multiply() {
  num1 = document.getElementById('value1').value;
  num2 = document.getElementById('value2').value;
  result = num1 * num2;
  document.getElementById('result').innerHTML = result;
}

function divide() {
  num1 = document.getElementById('value1').value;
  num2 = document.getElementById('value2').value;
  result = num1 / num2;
  document.getElementById('result').innerHTML = result;
  if (num2==0) {
    document.getElementById('result').innerHTML = 'Mistake!';
  }
}

function power() {
  num1 = document.getElementById('value1').value;
  result = num1 * num1;
  document.getElementById('result').innerHTML = result;
}

function sqrt() {
  num1 = document.getElementById('value1').value;
  result = Math.sqrt(num1);
  document.getElementById('result').innerHTML = result;
}

function sin() {
  num1 = document.getElementById('value1').value;
  result = Math.sin(num1);
  document.getElementById('result').innerHTML = result;
}

function cos() {
  num1 = document.getElementById('value1').value;
  result = Math.cos(num1);
  document.getElementById('result').innerHTML = result;
}

function factorial() {
  num1 = document.getElementById('value1').value;
  result = 1;
  while(num1){
    result *= num1--;
  }
  document.getElementById('result').innerHTML = result;
}