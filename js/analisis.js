// ===============================
// DATA HERO (SESUAI PERMINTAAN)
// ===============================
const heroes = [
    {
        name: "Zetian",
        role: "Mage • Damage • Crowd Control",
        img: "zetian.png",
        durability: 40,
        offense: 80,
        ability_effects: 70,
        difficulty: 30
    },
    {
        name: "Gusion",
        role: "Assassin • Burst",
        img: "gusion.png",
        durability: 30,
        offense: 90,
        ability_effects: 55,
        difficulty: 80
    },
    {
        name: "Miya",
        role: "Marksman • DPS",
        img: "miya.png",
        durability: 45,
        offense: 75,
        ability_effects: 30,
        difficulty: 20
    }
];

// ===============================
// SYSTEM SLIDER
// ===============================
let current = 0;

function loadHero() {
    const h = heroes[current];

    document.getElementById("heroImg").src = h.img;
    document.getElementById("heroName").innerText = h.name;
    document.getElementById("heroRole").innerText = h.role;

    // Statistik
    document.getElementById("durBar").style.width = h.durability + "%";
    document.getElementById("offBar").style.width = h.offense + "%";
    document.getElementById("aeBar").style.width = h.ability_effects + "%";
    document.getElementById("diffBar").style.width = h.difficulty + "%";

    // Angka persen
    document.getElementById("durVal").innerText = h.durability + "%";
    document.getElementById("offVal").innerText = h.offense + "%";
    document.getElementById("aeVal").innerText = h.ability_effects + "%";
    document.getElementById("diffVal").innerText = h.difficulty + "%";
}

function nextHero() {
    current = (current + 1) % heroes.length;
    loadHero();
}

function prevHero() {
    current = (current - 1 + heroes.length) % heroes.length;
    loadHero();
}

// Load hero pertama saat masuk
loadHero();
