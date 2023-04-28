"use strict" // Stop eksekusi javascript ketika ada exception

class TodoList {
    root = undefined;
    form = undefined;
    input = undefined;
    dom = '';

    todoRootStyle = ['p-1', 'flex', 'place-content-between', 'border-gray-500']
    closeUnicode = String.fromCharCode('10006');

    constructor(rootNode, formNode, inputNode) {
        // check argumments apakah sesuai dengan standard
        if (!(formNode instanceof HTMLFormElement) ||
            !(rootNode instanceof HTMLDivElement) ||
            !(inputNode instanceof HTMLInputElement)
        )
            throw ("You should properly pass the DOM Element");

        this.form = formNode;
        this.root = rootNode;
        this.input = inputNode;
    }

    /**
     * Mount event listener
     * @return void
     */
    mount() {
        this.form.onsubmit = event => {
            event.preventDefault(); // Batalkan default behavior-nya form

            if (this.input.value == '') return; // kalo input-nya kosong auto return

            this.create(this.input.value) // buat list baru pakai value dari input

            this.input.value = ''; // kosongi value di input
        }
    }

    /**
     * Buat Todo item 
     * @param {string} content
     * @return void
     */
    create(content) {
        if (content == '') return; // kalo kosong auto return

        this.dom += `<div id='todo-${this.id}' class='${this.todoRootStyle.join(' ')}'>
                    <p class='text-left' class='max-w-24'>
                        ${content}
                    </p>
                    <button class='ml-2' onClick='deleteTodo(this)'>${this.closeUnicode}</button>
                </div>`; // cara buat elemen cepat dan tidak aman

        this.id++;

        this.root.innerHTML = this.dom; // update dom
    }

    /**
     * Hapus Todo item
     * @param {HTMLDivElement} targetNode
     * @return void
     */
    delete(targetNode) {
        // check apakah node-nya memiliki induk yang sama dengan root node
        if (!(targetNode.parentNode == this.root))
            throw ("it's doesn't belong to class object root node");

        this.root.removeChild(targetNode);
        this.dom = this.root.innerHTML;
    }
}

const TodoListApp = new TodoList(
    document.getElementById('root'),
    document.getElementById('form'),
    document.getElementById('data'),
);

const deleteTodo = event => TodoListApp.delete(event.parentNode);

TodoListApp.mount();