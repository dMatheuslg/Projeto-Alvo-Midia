let draggedTask = null;

// Função para abrir o modal
function openModal() {
    document.getElementById('taskModal').style.display = 'block';
}

// Função para fechar o modal
function closeModal() {
    document.getElementById('taskModal').style.display = 'none';
}

// Função para adicionar a nova tarefa
function addTask() {
    const taskText = document.getElementById('taskInput').value;
    const taskDate = document.getElementById('dateInput').value;
    const taskTime = document.getElementById('timeInput').value;
    const clienteSelect = document.getElementById('clienteSelect').value;

    if (taskText && taskDate && taskTime && clienteSelect) {
        // Formatar a data no formato dia-mês-ano
        const [year, month, day] = taskDate.split('-');
        const formattedDate = `${day}/${month}/${year}`;

        const task = document.createElement('div');
        task.classList.add('task');
        task.setAttribute('draggable', 'true');

        const nomeCliente = document.getElementById('clienteSelect').options[document.getElementById('clienteSelect').selectedIndex].innerText;

        // Criar uma lista para os detalhes da tarefa
        const taskDetails = document.createElement('ul');

        const taskTextItem = document.createElement('li');
        taskTextItem.textContent = taskText;
        taskTextItem.classList.add('task-detail');

        const taskDateItem = document.createElement('li');
        taskDateItem.textContent = formattedDate;
        taskDateItem.classList.add('task-detail');

        const taskTimeItem = document.createElement('li');
        taskTimeItem.textContent = taskTime;
        taskTimeItem.classList.add('task-detail');        

        const taskClienteItem = document.createElement('li');
        taskClienteItem.textContent = "Cliente: " + nomeCliente;
        taskClienteItem.classList.add('task-detail');

        taskDetails.appendChild(taskClienteItem);
        taskDetails.appendChild(taskTextItem);
        taskDetails.appendChild(taskDateItem);
        taskDetails.appendChild(taskTimeItem);

        task.appendChild(taskDetails);

        const deleteBtn = document.createElement('button');
        deleteBtn.classList.add('delete-btn');
        deleteBtn.innerHTML = 'X';

        deleteBtn.onclick = () => {
            task.remove();        
        };

        task.appendChild(deleteBtn);
        document.getElementById('pendente').appendChild(task);
        closeModal();

        // Adicionar eventos de arrastar e soltar à nova tarefa
        task.addEventListener('dragstart', dragStart);
        task.addEventListener('dragend', dragEnd);

        // Chama a função para criar a tarefa no banco de dados
        criaTarefa(taskText, taskDate, taskTime, clienteSelect)
    }
}

// Funções para arrastar e soltar
function dragStart(event) {
    draggedTask = event.target;
    setTimeout(() => {
        event.target.style.display = 'none';
    }, 0);
}

function dragEnd(event) {
    setTimeout(() => {
        draggedTask.style.display = 'block';
        draggedTask = null;
    }, 0);
}

// Permitir o arrastar e soltar nas colunas
document.querySelectorAll('.task-container').forEach(container => {
    container.addEventListener('dragover', event => {
        event.preventDefault();
    });

    container.addEventListener('drop', event => {
        event.preventDefault();
        if (draggedTask) {
            container.appendChild(draggedTask);

            // Captura os ids
           const idTask = draggedTask.id;
           const idColuna = container.id;
           atualizaTarefa(idTask, idColuna);
        }
    });
});

// Abrir o modal ao clicar no botão
document.querySelector('.add-task-btn').onclick = openModal;


//Cria um requisição post para o php para fazer o cadastro
function criaTarefa(tarefa, data, hora, cliente){

    fetch('database/criatarefavideo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tarefa: tarefa,
            data, data,
            hora: hora,
            cliente: cliente
        })
    })
    .then(res => res.text())
    .then(data => {
        location.reload();
    }) 
    .catch(error => console.log(error));
}

function atualizaTarefa(idTarefa, idColuna){

    fetch('database/alterartarefavideo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            idTarefa: idTarefa,
            idColuna: idColuna
        })
    })
    .then(res => res.text())
    .then(data => {
        location.reload();
    }) 
    .catch(error => console.log(error));
}


function deletaTarefa(id){
    fetch('database/deletatarefavideo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id: id
        })
    })
    .then(res => res.text())
    .then(data => {
        location.reload();
    }) 
    .catch(error => console.log(error));
}
