// cara bagus di keamanan tapi performa-nya jelek karena kebanyakan DOM
const todoListRootNode = document.getElementById('root'); // Ambil DOM root
const formNode = document.getElementById('form'); // ambil DOM form
let id = 0; // siapin id

const todoRootStyle = ['p-1', 'flex', 'place-content-between', 'border-gray-500']
const closeUnicode = String.fromCharCode(10006);

// Membuat todo
const makeTodo = content => {
    const newNode = document.createElement('div');
    const nodeContent = document.createElement('p');
    const nodeButton = document.createElement('button');

    nodeContent.textContent = content;
    nodeButton.textContent = closeUnicode;
    newNode.id = `todo-${id}`;

    // tambah class buat styling
    newNode.classList.add(...todoRootStyle);
    nodeContent.classList.add('max-w-24');
    nodeButton.classList.add('ml-2')

    // Nambah event listener
    nodeButton.addEventListener('click', deleteTodo);

    newNode.appendChild(nodeContent); // nambah child elemen-nya newNode
    newNode.appendChild(nodeButton); // nambah child elemen-nya newNode
    todoListRootNode.appendChild(newNode); // nambah child elemen-nya todoListRoot

    id++;
}

// Mengahapus todo
// hapus node-nya dengan node induk
const deleteTodo = event => todoListRootNode.removeChild(event.target.parentNode);

form.onsubmit = event => {
    event.preventDefault(); // Batalkan default behavior-nya form

    if (formNode.firstElementChild.value == '') return;

    makeTodo(formNode.firstElementChild.value);

    formNode.firstElementChild.value = ''; // kosongi value di input
}