var clicks = 0;
var monto = document.querySelector('#monto');

function cambiarojo(x) {
  x.classList.toggle("fa-eye-slash");
}

function add() {
  if (clicks == 0) {
    let before = document.querySelector('form');
    let general = document.createElement('div');
    general.className = "input-group mb-3";
    general.innerHTML = `<select name="marca" class="form-control">
    <option value="Fox">Fox</option>
    <option value="Suzuki">Suzuki</option>
    <option value="Generica">Generica</option>
  </select>
  <div class="input-group-append">
    <span class="btn btn-danger" id="eliminar" type="submit" onclick="delete_span(this)">-</span>
  </div>`
    clicks = 1;
    monto.style.display = 'block';
    before.insertBefore(general, document.querySelector('#x'));
  }

}

function delete_span(e) {
  clicks = 0;
  monto.style.display = 'none';

  e.parentElement.parentElement.remove();

}


function selec(sel) {
  var value = sel.options[sel.selectedIndex].value;
  add();
}

function mostrarPass() {
  var x = document.getElementById("inputpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}