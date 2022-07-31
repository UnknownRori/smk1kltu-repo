
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}

async function open_sidebar() {
    sidebar = document.getElementById("sidebar")
    main = document.getElementById('main')
    opener = document.getElementById("sidebar-key")
    if (screen.availWidth < 1024) {
        1+1
    } else {
        sidebar.style.width = "25%"
        main.style.marginLeft = '25%'
        sidebar.style.display = 'block'
    }
    opener.onclick = close_sidebar
    return opener
}

async function close_sidebar() {
    sidebar = document.getElementById("sidebar")
    main = document.getElementById('main')
    opener = document.getElementById("sidebar-key")
    sidebar.style.width = "0%"
    main.style.marginLeft = '0%'
    sidebar.style.display = "none"
    await sleep(500)
    opener.onclick = open_sidebar
    return opener
}

async function readProtected(value){
    container = document.getElementById("container-cards")
    button = document.getElementById("readmore").style.display = 'none'
    if (value != 0){
        throw new Error("No such ID")
    }
    waiting = "<div class='w3-modal w3-round-large' id='modal-01' style='display: block'><div class='w3-modal-content default-background-color w3-round-large'><div class='w3-card-4 w3-padding' id='rp-waiting'><p id='w3-center'>Menunggu balasan Server Semesta 0</p></div></div></div>"
    inputs = "<div class='w3-modal w3-round-large' id='modal-01' style='display: block'><div class='w3-modal-content default-background-color w3-round-large'><div class='w3-card-4 w3-padding' id='sudo'><div class='w3-container w3-teal'><h2>Mode Sudo</h2></div><label class='w3-text-teal'><b>Username</b></label><input type='text' class='w3-input w3-border w3-border-blue' id='input0'><label class='w3-text-teal'><b>Password</b></label><input id='input1' class='w3-input w3-border w3-border-blue' type='password'><br><button class='w3-btn w3-blue-grey' onclick='readServer(0)'>Baca</button></div></div>"
    x = Math.random()
    if (x <= 0.5) {
        container.innerHTML = waiting
        await sleep(5*1000)
        document.getElementById("modal-01").classList.add("delete-0")
        await sleep(500)
        container.innerHTML = ""
    }
    container.innerHTML = inputs
    await sleep(1000)
}

async function readServer(value){
    container = document.getElementById("container-cards")
    document.getElementById("modal-01").classList.add('delete-0')
    await sleep(500)
    container.innerHTML = ""
    if (value != 0){
        throw new Error("No such ID")
    }
    waiting = "<div class='w3-modal w3-round-large' id='modal-01' style='display: block'><div class='w3-modal-content default-background-color w3-round-large'><div class='w3-card-4 w3-padding' id='rp-waiting'><p id='w3-center'>Menunggu balasan Server Semesta 0</p></div></div></div>"
    container.innerHTML = waiting
    await sleep(5 * 1000)
    document.getElementById("modal-01").classList.add("delete-0")
    await sleep(1000)
    container.innerHTML = ""
    main = document.getElementById('main')
    x = document.createElement("div")
    x.id = "SM00/0"
    x.innerHTML = '<p><span color="grey">SM00/0</span></p><table class="w3-table-all w3-small w3-striped w3-card-4 default-color"><tr><th>Kunci</th><th>Data</th></tr><tr><td>Nama</td><td>Zagar</td></tr><tr><td>Tanggal Lahir</td><td>28-06-2006</td></tr><tr><td>Alamat</td><td>NULL</td></tr><tr><td>IISN</td><td>NULL</td></tr><tr><td>Jenis Kelamin</td><td>Laki-laki</td></tr><tr><td>Asal Sekolah</td><td>SMP Negeri 7 Klaten</td></tr><tr><th>Data Sekolah Sekarang</th></tr><tr><td>Nomor Absen</td><td>3</td></tr><tr><td>Kelas</td><td>10 PPLG</td></tr><tr><td>Sekolah</td><td>SMK Muhammadiyah 1 Klaten Utara</td></tr><tr><th>Data Fisik Siswa</td></tr><tr><td>Tinggi badan</td><td>159cm</td></tr><tr><td>Berat</td><td>40kg</td></tr><tr><th>Data Metafisika Siswa</th></tr><tr><td>Nama Sihir</td><td>NULL</td></tr><tr><td>Level Sihir</td><td>NULL</td></tr></table>'
    x.classList.add('dangerous', 'w3-padding')
    main.appendChild(x)
}

function notFound(name){
    container = document.getElementById("container-cards")
    x = `<div class='w3-modal w3-round-large' id='modal-01' style='display: block'><div class='w3-modal-content default-background-color w3-round-large'><div class='w3-card w3-padding'><h2>Error 404</h2><h4>Laman ${name} tidak ditemukan</h4><br><button class='w3-button w3-border w3-border-blue w3-round-large' onclick='document.getElementById("container-cards").innerHTML = ""'>Tutup</button></div></div></div>`
    container.innerHTML = x
}

function addTodoEntry() {
    maindata = document.getElementById('input0')
    if (maindata.value == '') {
        container = document.getElementById("container-cards")
        container.innerHTML = "<div class='w3-modal w3-round-large' id='modal-01' style='display: block'><div class='w3-modal-content default-background-color w3-round-large w3-padding'><div class='w3-padding' id='rp-waiting'><span class='w3-display-right w3-button' onclick=\"document.getElementById('container-cards').innerHTML = ''\">&times;</span><p id='w3-center'>Tak dapat menambah entri: Input entri kosong</p></div></div></div>"
        return false
    }
    todolist = document.getElementById("todolist")
    x = document.createElement("li")
    x.classList.add("w3-display-container")
    x.innerHTML =  `<p class='overflow-scroll' style='width:80%'>${maindata.value}</p>` + '<span class="w3-button w3-display-right" onclick="document.getElementById(\'todolist\').removeChild(this.parentElement)">&times;</span>'
    maindata.value = ''
    todolist.appendChild(x)
}

try { 
    for (v in document.body.children[0].children) {
        if (v.href == "/main.html") {
            continue
        }
        v.click = () => {
            notFound(v.href)
            return false
        }
        v.target = '_blank'
    }
    for (v in document.getElementById('sidebar').children) {
        v.click = () => {
            notFound(v.href)
            return false
        }
        v.target = '_blank'
    }
} catch {
    console.log("bruh")
}