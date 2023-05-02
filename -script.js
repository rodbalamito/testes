const team1 = "Time 1"
const team2 = "Time 2"
let teamTurn = team1

let teamTurnText = document.querySelector("#teamVetoText")

const maps = document.querySelectorAll(".card")

for (let index = 0; index < maps.length; index++) {
    maps[index].addEventListener("click", chooseMap)
}

let mapPool = ["Dust 2", "Inferno", "Mirage", "Overpass"]

function chooseMap(event) {
    if (teamTurn == team1) {
        teamTurn = team2
    } else {
        teamTurn = team1
    }

    teamTurnText.innerText = `É a vez do ${teamTurn} banir o mapa!`

    event.currentTarget.classList.remove("scaleAnimation")
    event.currentTarget.removeEventListener("click", chooseMap)

    const clickedMap = event.currentTarget.querySelector(".nameOfTheMap").innerText

    mapPool = mapPool.filter(map => map != clickedMap)

    if (mapPool.length == 1) {
        const lastMap = document.querySelector(".card:not(.selected)")
        lastMap.classList.add("picked")
        lastMap.classList.remove("scaleAnimation")
        teamTurnText.innerText = `${mapPool[0]} foi o mapa escolhido!`
    }
}

const banText = document.querySelectorAll(".banText")

for (let index = 0; index < maps.length; index++) {
    maps[index].addEventListener("click", () => {
        banText[index].innerText = "Banido"
    })
}

const mapImg = document.querySelectorAll(".mapImg")

for (let index = 0; index < maps.length; index++) {
    maps[index].addEventListener("click", () => {
        mapImg[index].classList.add("mapImgAfterSelected")
    })
}