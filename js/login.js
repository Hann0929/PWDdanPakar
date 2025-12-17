function validasi() {
    let user = document.getElementById("username").value;
    let pass = document.getElementById("password").value;

    if (user === "" || pass === "") {
        alert("Username dan Password wajib diisi!");
        return false;
    }
    return true;
}
