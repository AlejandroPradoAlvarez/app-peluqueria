document.addEventListener('DOMContentLoaded', function(){

    iniciarApp();
});

function iniciarApp(){

    buscarPorFecha();
}

function buscarPorFecha(){

    const fechaInput=document.querySelector('#fecha');

    fechaInput.addEventListener('input',function(e){
        const fechaSeleccionada=e.target.value;

        //console.log(fechaSeleccionada); observamos que pille la fecha correctamente 

        window.location=`?fecha=${fechaSeleccionada}`;
    });
}