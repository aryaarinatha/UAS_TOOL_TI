function validateForm() {
    var nim = document.getElementById('nim').value;
    var nama = document.getElementById('name').value;
    var fakultas = document.getElementById('fakultas').value;
    var no_hp = document.getElementById('no_hp').value;
    var alamat = document.getElementById('alamat').value;

    if (nim == '' || nama == '' || fakultas == '' || no_hp == '' || alamat == '') {
        alert('Semua kolom data harus diisi.');
        return false;
    }
    
    return true;
}