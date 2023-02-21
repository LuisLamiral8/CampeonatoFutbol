let subir = document.querySelector('.play');
let playerA,playerB, teams, goles, data = [];
let estado = true;
let golesA = 0, golesB = 0, golesTemporalesA = 0, golesTemporalesB = 0;

subir.addEventListener('click', e => {
    e.preventDefault();
    playerA = document.querySelectorAll('.player-0');
    playerB = document.querySelectorAll('.player-1');
    teams = document.querySelectorAll('.team');

    teams.forEach((equipo,i) => {
        let idEquipo = equipo.value.split("=")[1];
        goles = document.querySelector(`.goles-${i}`).value;
        if(i == 0) golesA = goles;
        else golesB = goles;
        jugadores = document.querySelectorAll(`.player-${i}`);
        let goleadores = []; 
        jugadores.forEach(jugador => {
            if(jugador.value > 0){
                goleadores.push({
                    idJugador : jugador.getAttribute('key').split("=")[1],
                    goles : jugador.value
                })
                if(i == 0) golesTemporalesA += parseInt(jugador.value);
                else golesTemporalesB += parseInt(jugador.value);
            }
        })

        let obj = {
            equipo : idEquipo,
            goles,
            goleadores
        };
        data.push(obj);
    })

    if(golesA != golesTemporalesA || golesB != golesTemporalesB) estado = false;
    else estado = true;

    console.log("Goles A: " + golesA + " golesB: " + golesB + "GolesTmpA: " + golesTemporalesA + "GolesTmpB: " + golesTemporalesB)

    console.log("Estado = " + estado)
    if(estado){

      try{
          let body = new FormData;
          body.append("json",JSON.stringify(data));

          fetch("helpers/cargarResultados.php",{
              headers : new Headers(),
              method : "POST",
              body
          })
          .then(res => res.text())
          .then(res => {
              console.log(res);
              window.location.href="./fechas.php";
          })
          .catch(e => console.log("Error: " + e))
      }
      catch(e){
          console.log("Error: " + e)
      }

    }
    else{
      estado = true;
        golesA = 0;
        golesB = 0;
        golesTemporalesA = 0;
        golesTemporalesB = 0;
    }
})
