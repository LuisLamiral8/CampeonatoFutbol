let pressedPlay = document.querySelector(".pressedPlay");
let pressedConfirm = document.querySelector(".pressedConfirm");
let id = pressedPlay.id;
let t1 = document.querySelector(".team-1");
let t2 = document.querySelector(".team-2");

pressedPlay.addEventListener("click", async (e) => {
  if ((t1.value == "" && t2.value == "") || t1.value == "" || t2.value == "") {
    window.alert("Ingrese los goles");
    return false;
  }
  e.preventDefault();

  const players = await fetchPlayers();

  // console.log(players);

  for (let i = 0; i < t1.value; i++) {
    let playerSelect = document.createElement("select");
    let golesSelect = document.createElement("select");
    let defOption = document.createElement("option");
    let maxGoles = parseInt(t1.value) + 1;
    playerSelect.classList =
      "col-span-3 bg-gray-300 text-center t1PlayerSelect";
    golesSelect.classList = "col-span-1 bg-gray-300 text-center t1GolesSelect";
    defOption.value = "none";
    defOption.text = "...";
    playerSelect.appendChild(defOption);
    for (let i = 0; i < 10; i++) {
      let playerOption = document.createElement("option");
      playerOption.id = players[i][0];
      // playerOption.value = players[i][1] + " " + players[i][2];
      playerOption.value = players[i][0];
      playerOption.text = players[i][1] + " " + players[i][2];
      playerSelect.appendChild(playerOption);
    }
    for (let i = 0; i < maxGoles; i++) {
      let playerOption = document.createElement("option");
      playerOption.value = i;
      playerOption.text = i;
      golesSelect.appendChild(playerOption);
    }

    t1Container.append(playerSelect);
    t1Container.append(golesSelect);
  }
  for (let i = 0; i < t2.value; i++) {
    let playerSelect = document.createElement("select");
    let defOption = document.createElement("option");
    let golesSelect = document.createElement("select");
    let maxGoles = parseInt(t2.value) + 1;
    playerSelect.classList =
      "col-span-3 bg-gray-300 text-center t2PlayerSelect";
    golesSelect.classList = "col-span-1 bg-gray-300 text-center t2GolesSelect";
    defOption.value = "none";
    defOption.text = "...";
    playerSelect.appendChild(defOption);
    for (let i = 10; i < 20; i++) {
      let playerOption = document.createElement("option");
      playerOption.id = players[i][0];
      // playerOption.value = players[i][1] + " " + players[i][2];
      playerOption.value = players[i][0];
      playerOption.text = players[i][1] + " " + players[i][2];
      playerSelect.appendChild(playerOption);
    }
    for (let i = 0; i < maxGoles; i++) {
      let playerOption = document.createElement("option");
      playerOption.value = i;
      playerOption.text = i;
      golesSelect.appendChild(playerOption);
    }
    t2Container.append(playerSelect);
    t2Container.append(golesSelect);
  }
  pressedPlay.classList = "hidden";
  pressedConfirm.classList =
    "pressedConfirm btn btn-secondary bg-gray-500 px-3 font-black text-white rounded-md";
});

let t1Container = document.querySelector(".t1Container");
let t2Container = document.querySelector(".t2Container");

pressedConfirm.addEventListener("click", async (e) => {
  let verifier = verifyCorrectInit();
  let verifier2 = parseInt(t1.value) + parseInt(t2.value);
  if (verifier == verifier2) {
    let digits = id.split("");
    let isTie = t1.value == t2.value ? "true" : "false";
    let isWinner = t1.value > t2.value ? digits[0] : digits[1];
    let golesArr = fillGolesArr();
    // console.log(isTie);
    e.preventDefault();
    let obj = {
      t1Id: digits[0],
      t1Goles: t1.value,
      t2Id: digits[1],
      t2Goles: t2.value,
      winner: isWinner,
      tie: isTie,
      goles: golesArr,
    };
    try {
      await postGame(obj);
    } catch (error) {
      console.error(error);
    }
  } else {
    alert("Verifique si ha colocado los goles correctamente.");
  }
});
//Finished functions

const fetchPlayers = async () => {
  let digits = id.split("");
  try {
    const response = await axios.get(
      `helpers/fetchPlayers.php?E1=${digits[0]}&E2=${digits[1]}`
    );
    return response.data;
  } catch (error) {
    console.log(error);
  }
};
const verifyCorrectInit = () => {
  let t1GolesSelect = document.querySelectorAll(".t1GolesSelect");
  let t2GolesSelect = document.querySelectorAll(".t2GolesSelect");
  let verifier = 0;
  for (let i = 0; i < t1GolesSelect.length; i++) {
    verifier += parseInt(t1GolesSelect[i].value);
  }
  for (let i = 0; i < t2GolesSelect.length; i++) {
    verifier += parseInt(t2GolesSelect[i].value);
  }

  return verifier;
};
const fillGolesArr = () => {
  let returnGolesArr = [];

  let t1PlayerSelect = document.querySelectorAll(".t1PlayerSelect");
  let t1GolesSelect = document.querySelectorAll(".t1GolesSelect");
  let t2PlayerSelect = document.querySelectorAll(".t2PlayerSelect");
  let t2GolesSelect = document.querySelectorAll(".t2GolesSelect");
  // console.log(t1GolesSelect[1].value);

  for (let i = 0; i < t1PlayerSelect.length; i++) {
    if (t1PlayerSelect[i].value != "none") {
      returnGolesArr.push({
        idPlayer: parseInt(t1PlayerSelect[i].value),
        goles: parseInt(t1GolesSelect[i].value),
      });
    }
  }
  for (let i = 0; i < t2PlayerSelect.length; i++) {
    if (t2PlayerSelect[i].value != "none") {
      returnGolesArr.push({
        idPlayer: parseInt(t2PlayerSelect[i].value),
        goles: parseInt(t2GolesSelect[i].value),
      });
    }
  }
  return returnGolesArr;
};
const postGame = async (obj) => {
  await fetch("helpers/handleUploadGame.php", {
    headers: new Headers(),
    method: "POST",
    body: JSON.stringify(obj),
  })
    .then((res) => res.text())
    .then((res) => {
      console.log(res);
      window.location.href = "index.php";
    })
    .catch((error) => console.error(error));
};
