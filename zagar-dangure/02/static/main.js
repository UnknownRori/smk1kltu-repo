sidebar = document.getElementById("sidebar")
main = document.getElementById('main')
sidebar_key = document.getElementById("sidebar-key")
container_cards = document.getElementById("container-cards")
readmore = document.getElementById("readmore")
maindata = document.getElementById('input0')
default_close = document.createElement('span')
default_close.innerText = "&times;"
default_close.classList.add("w3-button", 'w3-display-right')
default_close.onclick = () => {
    container_cards.removeChild(this.parentElement)
}

function _dsk(n) {
    x = document.createElement('th')
    x.innerText = n
    return x
}
const dsk = _dsk("Data Sekolah Sekarang")
const dfs = _dsk("Data Fisik Siswa")
const dms = _dsk("Data Metafisika Siswa")

// No class user.
mainuser = {
    "Nama": "Zagar",
    'Tanggal Lahir': "28-07-2006",
    "Alamat": null,
    "IISN": null,
    "Jenis Kelamin": "Laki-laki",
    "Asal Sekolah": "SMP Negeri 7 Klaten",
    "skip_01": dsk,
    "Nomor Absen": 22,
    "Kelas": "10 PPLG",
    "Sekolah": "SMK Muhammadiyah 1 Klaten Utara",
    "skip_02": dfs,
    "Tinggi Badan": "169cm",
    "Berat": "54kg",
    "skip_03": dms,
    "Nama Sihir": null,
    "Level Sihir": null
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
}

async function open_sidebar() {
    if (screen.availWidth < 1024) {
        1 + 1
    } else {
        sidebar.style.width = "25%"
        main.style.marginLeft = '25%'
        sidebar.style.display = 'block'
    }
    sidebar_key.onclick = close_sidebar
    return sidebar_key
}

async function close_sidebar() {
    sidebar.style.width = "0%"
    main.style.marginLeft = '0%'
    sidebar.style.display = "none"
    await sleep(500)
    sidebar_key.onclick = open_sidebar
    return sidebar_key
}

function _replace(obj, item0, item1) {
    if (obj.contains(item0) == true) {
        obj.remove(item0)
        if (item1 != '') {
            obj.add(item1)
        }
    }
}

async function readProtected(value) {
    readmore.style.display = 'none'
    if (value != 0) {
        throw new Error("No such ID")
    }

    x = Math.random()
    if (x <= 0.5) {
        await wait(5 * 1000)
        container_cards.classList.add("delete-0")
        await sleep(500)
        _replace(container_cards.classList, 'delete-0', '')
        container_cards.innerHTML = ""
    }
    PromptLogin("Sudo Mode")
    await sleep(1000)
}

async function readServer(value) {
    container_cards.classList.add('delete-0')
    await sleep(500)
    container_cards.innerHTML = ""
    if (value != 0) {
        throw new Error("No such ID")
    }
    waiting = document.createElement('p')
    waiting.classList.add('w3-center')
    waiting.innerText = "Menunggu balasan Server Semesta 0"
    _execute_modal(makeModal(waiting, true, false))
    await sleep(5 * 1000)
    container_cards.classList.add("delete-0")
    await sleep(1000)
    container_cards.innerHTML = ""
    q = document.createElement("div")
    q.id = "SM00/0"
    data = ObjectedTable(mainuser)
    q.appendChild(data)
    q.classList.add('dangerous', 'w3-padding')
    main.appendChild(q)
}

function notFound(name) {
    root = document.createElement('div')
    x = document.createElement('h4')
    y = document.createElement('p')
    x.innerText = "Error 404"
    y.innerText = `Laman ${name} tidak ditemukan`
    root.appendChild(x)
    root.appendChild(y)
    _execute_modal(makeModal(root, true, true))
}

function _todolist_destroy_parent() {
    todolist.removeChild(this.parentElement)
}

function PromptLogin(name, idname) {
    root = document.createElement('div')
    root.classList.add('w3-card-4', 'w3-padding')
    root.id = idname
    header = document.createElement('div')
    header.classList.add('w3-container', 'w3-teal')
    header.innerText = name
    label0 = document.createElement('label')
    label0.innerText = "Username"
    label1 = document.createElement('label')
    label1.classList.add('w3-text-teal')
    label1.innerText = "Password"
    input00 = document.createElement('input')
    input00.classList.add('w3-input', 'w3-border', 'w3-border-blue')
    input00.id = "input0"
    input00.type = 'text'
    input01 = document.createElement('input')
    input01.classList.add('w3-input', 'w3-border', 'w3-border-blue')
    input01.id = "input0"
    input01.type = 'password'
    br0 = document.createElement('br')
    button0 = document.createElement('button')
    button0.classList.add('w3-btn', 'w3-blue-grey')
    button0.onclick = () => {
        readServer(0)
    }
    button0.innerText = "Baca"
    root.appendChild(header)
    root.appendChild(label0)
    root.appendChild(input00)
    root.appendChild(label1)
    root.appendChild(input01)
    root.appendChild(br0)
    root.appendChild(button0)
    _execute_modal(makeModal(root, true, false, 'sudo'))
}

function addTodoEntry() {
    if (maindata.value == '') {
        data = document.createElement("h4")
        data.innerText = "Tak dapat memasukkan entri: Input entri kosong"
        container_cards.appendChild(makeModal(data))
        return false
    }
    todolist = document.getElementById("todolist")
    x = document.createElement("li")
    x.classList.add("w3-display-container")
    y = document.createElement('p')
    y.innerText = maindata.value
    x.appendChild(y)
    x.appendChild(default_close)
    maindata.value = ''
    todolist.appendChild(x)
}

async function wait(ms) {
    waiting = document.createElement('p')
    waiting.classList.add('w3-center')
    waiting.innerText = "Menunggu balasan Server Semesta 0"
    _execute_modal(makeModal(waiting, true, false))
    sleep(ms)
}

function makeModal(baseElement, setVisible = true, closable = true, customId = '') {
    modal = document.createElement('div')
    modal.classList.add('w3-modal', 'w3-round-large')
    modal.id = 'modal-01'

    content = document.createElement('div')
    content.classList.add('default-background-color', 'w3-modal-content')
    true_content = document.createElement('div')
    true_content.classList.add('w3-card-4', 'w3-padding', 'w3-round-large')
    close_button = document.createElement('span')
    if (customId != '') {
        content.id = customId
    }
    if (setVisible == true) {
        modal.classList.add('init0')
        modal.style.display = 'block'
    }
    modal.appendChild(content)
    if (closable == true) {
        close_button.classList.add('w3-button', 'w3-display-right')
        close_button.onclick = () => {
            container_cards.innerHTML = ''
        }
        content.appendChild(close_button)
    }
    true_content.appendChild(baseElement)
    content.appendChild(true_content)
    return modal
}

function _execute_modal(modal_element) {
    container_cards.appendChild(modal_element)
}

function List(object) {
    root = document.createElement('ul')
    root.classList.add('w3-ul')
    for (a in object) {
        x = document.createElement("li")
        x.innerText = a.toString()
    }
    return root
}

function _object_hasattr(self, name) {
    try {
        self[name]
        return true
    } catch {
        return false
    }
}

function E_iterAppend(root, ...item) {
    for (i in item) {
        root.appendChild(item[i])
    }
}

function ObjectedTable(object) {
    // This function is a reflection to HTMLBuilder/Table
    // While this function may only recieve single key/value. It depends if it's array or not.
    nroot = document.createElement('table')
    root = document.createElement('tbody')
    n0 = document.createElement('th')
    n1 = document.createElement('th')
    n00 = document.createElement('tr')
    n0.innerText = 'Kunci'
    n1.innerText = 'Data'
    E_iterAppend(n00, n0, n1)
    root.appendChild(n00)
    nroot.appendChild(root)
    nroot.classList.add("w3-table-all", "w3-striped", 'w3-small', 'w3-card', 'w3-default-color')
    for (a in object) {
        x = document.createElement('tr')
        y = document.createElement('td')
        z = document.createElement('td')
        y.innerText = a
        b = object[a]
        if (b == false || b == true) {
            z.innerText = b.toString()
            E_iterAppend(x, y, z)
            root.appendChild(x)
            continue
        }
        if (b == null) {
            z.innerText = 'null'
            E_iterAppend(x, y, z)
            root.appendChild(x)
            continue
        }
        if (a.startsWith('skip_') && _object_hasattr(b, "nodeName")) {
            x.appendChild(b)
            root.appendChild(x)
            continue
        }
        if (typeof (b) == function () { }) continue
        if (typeof (b) == 'number') {
            z.innerText = b.toString()
            E_iterAppend(x, y, z)
            root.appendChild(x)
            continue
        }
        if (typeof (b) == 'string') {
            z.innerText = b
            E_iterAppend(x, y, z)
            root.appendChild(x)
            continue
        } if (_object_hasattr(b, "nodeName")) {
            E_iterAppend(x, y, b)
            root.appendChild(x)
            continue
        } if (typeof (b) == 'array') {
            x.appendChild(List(b))
            root.appendChild(x)
            continue
        }
        if (typeof (b) == 'object') {
            throw new Error("Unable to iterating the ObjectingTable.")
        }
    }
    return nroot
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
