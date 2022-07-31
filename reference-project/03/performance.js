// Cara Bagus di performa tapi jelek di keamanan
let todoListDOM = ''; // siapkan variabel buat nyimpen DOM
const todoListRootNode = document.getElementById('root'); // Ambil DOM root
const formNode = document.getElementById('form'); // ambil DOM form
let id = 0; // siapin id

const todoRootStyle = ['p-1', 'flex', 'place-content-between', 'border-gray-500']
const closeUnicode = String.fromCharCode('10006');

// Membuat todo
const makeTodo = content => {
    todoListDOM += `<div id='todo-${id}' class='${todoRootStyle.join(' ')}'>
                    <p class='text-left' class='max-w-24'>
                        ${content}
                    </p>
                    <button class='ml-2' onClick='deleteTodo(this)'>${closeUnicode}</button>
                </div>`; // cara buat elemen cepat dan tidak aman

    id++;
    todoListRootNode.innerHTML = todoListDOM; // update DOM
}

// Mengahapus todo
const deleteTodo = event => {
    todoListRootNode.removeChild(event.parentNode); // hapus node-nya
    todoListDOM = todoListRootNode.innerHTML; // sinkronkan DOM dengan variable
}

// menambah event listener ketika submit
form.onsubmit = event => {
    event.preventDefault(); // Batalkan default behavior-nya form

    if (formNode.firstElementChild.value == '') return;

    makeTodo(formNode.firstElementChild.value) // buat list baru pakai value dari input

    formNode.firstElementChild.value = ''; // kosongi value di input
}