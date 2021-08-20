let sendbtn1 = document.getElementById('formulario')
let inputs = document.querySelectorAll('#formulario input') 
let push = document.getElementById("eye"); 
let password = inputs[1];

let expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, 
	number: /^.{4,12}$/, 
	password: /^.{4,12}$/, 
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ 
}
                
let validarCampo = (expresion, input, campo) => {
    if(expresion.test(input)){  
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
    }
}

let validarFormulario = (e) => {
    switch (e.target.name) {  
        case "number":  
			validarCampo(expresiones.number, e.target.value , e.target.name);
        break;
        case "email":
            validarCampo(expresiones.email, e.target.value , e.target.name);
            comparePassword()
        break;
        case "confirm_email":
            comparePassword()
        break
    }
}

let comparePassword = () => {
    if(inputs[1].value === inputs[2].value && inputs[2].value != "" ) {
        document.getElementById('grupo__confirm_email').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__confirm_email').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__confirm_email i').classList.add('fa-check-circle');
        document.querySelector('#grupo__confirm_email i').classList.remove('fa-times-circle');
        document.querySelector('#grupo__confirm_email .formulario__input-error').classList.remove('formulario__input-error-activo');

    } else {
        document.getElementById('grupo__confirm_email').classList.add('formulario__grupo-incorrecto');
        document.getElementById('grupo__confirm_email').classList.remove('formulario__grupo-correcto');
        document.querySelector('#grupo__confirm_email i').classList.add('fa-times-circle');
        document.querySelector('#grupo__confirm_email i').classList.remove('fa-check-circle');
        document.querySelector('#grupo__confirm_email .formulario__input-error').classList.add('formulario__input-error-activo');
       
    }
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario)
    input.addEventListener('blur', validarFormulario)  
    
})

let caja = document.getElementById("condiciones");
function palomita(){
    if(caja.checked) {
        document.getElementById('grupo__condiciones').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__condiciones').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__condiciones i').classList.add('fa-check-circle');
        document.querySelector('#grupo__condiciones i').classList.remove('fa-times-circle');
        document.querySelector(`#grupo__condiciones .formulario__input-error`).classList.remove('formulario__input-error-activo');

        
    }else{
        document.getElementById('grupo__condiciones').classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__condiciones .formulario__input-error`).classList.add('formulario__input-error-activo');

    }
}
caja.addEventListener('click' ,palomita)

let envioCondiciones = () => {
    
    if(!expresiones.number.test(inputs[0].value)
    //  || !expresiones.email.test(inputs[1].value) 
    //  || !expresiones.email.test(inputs[2].value)
    //  || inputs[1].value != inputs[2].value  
     || inputs[0].value == null
    //  || !inputs[1].value.length
    //  || inputs[2].value == null  
     || !caja.checked){
         return false;
     }
    
     return true;
    
}

if(sendbtn1){
    sendbtn1.addEventListener('mouseover', envioCondiciones)
    sendbtn1.addEventListener('keyup', envioCondiciones)

    sendbtn1.addEventListener('submit', (e) => {
    if(!envioCondiciones()) {
        return e.preventDefault();
    }
});
}


let conditions = document.getElementById('conditions');
let modal_container = document.getElementById('modal_container');
let close = document.getElementById('close');

conditions.addEventListener('click', () => {
  modal_container.classList.add('show');  
});

close.addEventListener('click', () => {
  modal_container.classList.remove('show');
});