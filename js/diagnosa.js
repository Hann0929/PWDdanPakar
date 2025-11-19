const heroes = [
  { nama: "Alucard", physicalAtt: 9, magicPower: 1, physicalDef: 7, magicDef: 6, hp: 8, moveSpeed: 7, critChance: 8, critDmg: 9 },
  { nama: "Eudora", physicalAtt: 2, magicPower: 10, physicalDef: 3, magicDef: 6, hp: 5, moveSpeed: 6, critChance: 2, critDmg: 4 },
  { nama: "Tigreal", physicalAtt: 5, magicPower: 2, physicalDef: 10, magicDef: 9, hp: 10, moveSpeed: 5, critChance: 3, critDmg: 3 },
  { nama: "Layla", physicalAtt: 10, magicPower: 1, physicalDef: 4, magicDef: 3, hp: 6, moveSpeed: 6, critChance: 9, critDmg: 8 }
];

const cfPakar = {
  physicalAtt: 0.9,
  physicalDef: 0.85,
  magicPower: 0.95,
  magicDef: 0.8,
  hp: 0.7,
  moveSpeed: 0.6,
  critChance: 0.9,
  critDmg: 0.9
};

document.getElementById("diagnosaForm").addEventListener("submit", function(e) {
  e.preventDefault();

  let input = {
    physicalAtt: +document.getElementById("physicalAtt").value,
    physicalDef: +document.getElementById("physicalDef").value,
    magicPower: +document.getElementById("magicPower").value,
    magicDef: +document.getElementById("magicDef").value,
    hp: +document.getElementById("hp").value,
    moveSpeed: +document.getElementById("moveSpeed").value,
    critChance: +document.getElementById("critChance").value,
    critDmg: +document.getElementById("critDmg").value
  };

  function cf (hero) {
    let cf_total = 0;

    for (let key in cf) {
      let cocok = 1 - Math.abs(input[key] - hero[key]) / 10;  
      let cf = cocok * cf[key];

      cf_total = cf_total + cf * (1 - cf_total);
    }

    return cf_total;
  }

  let hasilCF = heroes.map(h => ({
    nama: h.nama,
    cf: hitungCF(h)
  }));

  hasilCF.sort((a, b) => b.cf - a.cf);

  document.getElementById("hasil").innerHTML = `
    <h3>🔥 Hasil Diagnosa (Metode CF)</h3>
    <p><b>Hero Rekomendasi:</b> ${hasilCF[0].nama}</p>
    <p><b>Tingkat Kecocokan:</b> ${(hasilCF[0].cf * 100).toFixed(2)}%</p>
  `;
});
