const loader = document.querySelector('#loader');

window.addEventListener('load', () => {
    loader.classList.add('fondu-out');
    pause(1000);
})

function pause(ms) {
  setTimeout(supprime, ms);
}

function supprime() {
    loader.remove()
}