const params = new URLSearchParams(window.location.search);
if (params.get('from') === 'no_account') {
    const alertBox = document.getElementById('custom-alert');
    alertBox.classList.remove('hidden');
}

const scrollTest = document.querySelectorAll(".planos #planos");

console.log(scrollTest);