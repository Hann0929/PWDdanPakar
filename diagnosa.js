document.getElementById("diagnosaForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const data = {
    physicalAtt: +document.getElementById("physicalAtt").value,
    physicalDef: +document.getElementById("physicalDef").value,
    magicPower: +document.getElementById("magicPower").value,
    magicDef: +document.getElementById("magicDef").value,
    hp: +document.getElementById("hp").value,
    moveSpeed: +document.getElementById("moveSpeed").value,
    critChance: +document.getElementById("critChance").value,
    critDmg: +document.getElementById("critDmg").value,
  };

  // Contoh data hero
  const heroes = [
    { nama: "Alucard", physicalAtt: 9, magicPower: 1, physicalDef: 7, magicDef: 6, hp: 8, moveSpeed: 7, critChance: 8, critDmg: 9 },
    { nama: "Eudora", physicalAtt: 2, magicPower: 10, physicalDef: 3, magicDef: 6, hp: 5, moveSpeed: 6, critChance: 2, critDmg: 4 },
    { nama: "Tigreal", physicalAtt: 5, magicPower: 2, physicalDef: 10, magicDef: 9, hp: 10, moveSpeed: 5, critChance: 3, critDmg: 3 },
    { nama: "Layla", physicalAtt: 10, magicPower: 1, physicalDef: 4, magicDef: 3, hp: 6, moveSpeed: 6, critChance: 9, critDmg: 8 },
    { nama: "Kagura", physicalAtt: 3, magicPower: 9, physicalDef: 4, magicDef: 7, hp: 6, moveSpeed: 7, critChance: 3, critDmg: 5 }
  ];

  // Hitung kecocokan
  heroes.forEach(h => {
    let total = 0;
    let atribut = Object.keys(data).length;
    for (let key in data) {
      total += 10 - Math.abs(h[key] - data[key]);
    }
    h.score = Math.round((total / (atribut * 10)) * 100);
  });

  // Urutkan hasil
  heroes.sort((a, b) => b.score - a.score);

  // Tampilkan hasil
  let hasilHTML = `<h3>💡 Hero yang Cocok:</h3>`;
  heroes.forEach(h => {
    hasilHTML += `<p><strong>${h.nama}</strong> — Kecocokan ${h.score}%</p>`;
  });

  document.getElementById("hasil").innerHTML = hasilHTML;
});
