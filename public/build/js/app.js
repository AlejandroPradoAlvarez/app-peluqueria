let paso=1,pasoInicial=1,pasoFinal=3;const cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t=`#paso-${paso}`;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))}))}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=pasoInicial||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=pasoFinal||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e=`${location.origin}/api/servicios`,t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}try{const e=`${location.origin}/api/horas`,t=await fetch(e);mostrarHoras(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach((e=>{const{id:t,nombre:o,precio:a}=e,n=document.createElement("P");n.classList.add("nombre-servicio"),n.textContent=o;const i=document.createElement("P");i.classList.add("precio-servicio"),i.textContent=`$ ${a}`;const c=document.createElement("DIV");c.classList.add("servicio"),c.dataset.idServicio=t,c.onclick=function(){seleccionarServicio(e)},c.appendChild(n),c.appendChild(i),document.querySelector("#servicios").appendChild(c)}))}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);o.some((e=>e.id===t))?(cita.servicios=o.filter((e=>e.id!==t)),a.classList.remove("seleccionado")):(cita.servicios=[...o,e],a.classList.add("seleccionado"))}function idCliente(){cita.id=document.querySelector("#id").value}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("change",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error",".formulario")):(cita.fecha=e.target.value,deshabilitarHoras())}))}async function deshabilitarHoras(){try{const e=`${location.origin}/api/horasdisponibles?fecha=${cita.fecha}`,t=await fetch(e),o=await t.json();document.querySelectorAll("#hora option").forEach((e=>{o.find((t=>t.hora===e.value))?(e.disabled=!0,e.classList.remove("disponible"),e.classList.add("disabled"),e.textContent=`${e.value} - No disponible hoy`):(e.disabled=!1,e.classList.remove("disabled"),e.textContent=e.value,e.classList.add("disponible"))}))}catch(e){console.log(e)}}function mostrarHoras(e){const t=document.querySelector("#hora");e.forEach((e=>{const{id:o,hora:a}=e,n=document.createElement("OPTION");n.value=a,n.textContent=a,n.dataset.hora_id=o,n.classList.add("disponible"),t.appendChild(n)}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("change",(function(e){const t=e.target.value;if(e.target.selectedOptions){Array.from(e.target.selectedOptions).map((e=>e.value))}else console.error("No hay opciones seleccionadas o el elemento no es un <select>.");const o=e.target.selectedOptions[0].dataset.hora_id;cita.hora=t,cita.hora_id=o}))}function mostrarAlerta(e,t,o,a=!0){const n=document.querySelector(".alerta");n&&n.remove();const i=document.createElement("DIV");i.textContent=e,i.classList.add("alerta"),i.classList.add(t);document.querySelector(o).appendChild(i),a&&setTimeout((()=>{i.remove()}),3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Falta Datos de Servicios, Fecha u Hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:a,servicios:n}=cita,i=document.createElement("H3");i.textContent="Resumen Servicios",e.appendChild(i),n.forEach((t=>{const{id:o,precio:a,nombre:n}=t,i=document.createElement("DIV");i.classList.add("contenedor-servicio");const c=document.createElement("P");c.textContent=n;const r=document.createElement("P");r.innerHTML=`<span>Precio:</span> $${a}`,i.appendChild(c),i.appendChild(r),e.appendChild(i)}));const c=n.reduce(((e,t)=>e+parseFloat(t.precio)),0),r=document.createElement("P");r.innerHTML=`<span>Total:</span> $${c}`;const s=document.createElement("P");s.innerHTML=`<span>Nombre:</span> ${t}`;const d=new Date(o),l=d.getMonth(),u=d.getDate()+2,m=d.getFullYear(),p=new Date(Date.UTC(m,l,u)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),h=document.createElement("P");h.innerHTML=`<span>Fecha:</span> ${p}`;const v=document.createElement("P");v.innerHTML=`<span>Hora:</span>${a}`;const f=document.createElement("P");f.innerHTML=`<span>Cantidad de Servicios:</span> ${n.length}`;const L=document.createElement("BUTTON");L.classList.add("boton"),L.textContent="Reservar Cita",L.id="reserva",L.onclick=reservarCita,e.appendChild(s),e.appendChild(h),e.appendChild(v),e.appendChild(f),e.appendChild(r),e.appendChild(L)}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));const Toast=Swal.mixin({toast:!0,position:"top-end",showConfirmButton:!1,timer:3e3,timerProgressBar:!0,didOpen:e=>{e.addEventListener("mouseenter",Swal.stopTimer),e.addEventListener("mouseleave",Swal.resumeTimer)}});async function reservarCita(){const{id:e,fecha:t,hora:o,hora_id:a,servicios:n}=cita;console.log(cita);const i=n.map((e=>e.id)),c=new FormData;c.append("usuarioId",e),c.append("fecha",t),c.append("horaId",a),c.append("servicios",i);try{const t=`${location.origin}/api/citas`,o=await fetch(t,{method:"POST",body:c}),a=await o.json();if(a.alertas)return void Toast.fire({icon:"error",title:a.alertas});{const t=document.querySelector("#reserva");t&&t.remove(),Toast.fire({icon:"success",title:"La cita fue creada correctamente."}).then((()=>{const t=document.querySelector(".contenido-resumen"),o=document.createElement("BUTTON");o.classList.add("boton"),o.classList.add("boton-eliminar"),o.textContent="Eliminar Cita",o.id="eliminar",o.onclick=reservarCita,t.appendChild(o),o.onclick=function(){!function(e){const t=new FormData;t.append("id",e),fetch("/api/eliminar",{method:"POST",body:t}).then((e=>{const t=document.querySelector("#eliminar");t&&t.remove(),Toast.fire({icon:"success",title:"La cita fue eliminada correctamente."}).then((()=>{window.location.reload()}))})).catch((e=>{Toast.fire({icon:"error",title:"Oops! Ocurrio un error al eliminar la cita."})}))}(e)}}))}}catch(e){Toast.fire({icon:"error",title:"Oops! Ocurrio un error al guardar la cita."})}}