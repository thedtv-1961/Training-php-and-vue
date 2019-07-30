document.querySelector('input[list]').addEventListener('input', (e) => {
  const input = e.target;
  const list = input.getAttribute('list');
  const options = document.querySelectorAll(`#${list} option`);
  const hiddenInput = document.getElementById(`${input.getAttribute('id')}-hidden`);
  const inputValue = input.value;

  hiddenInput.value = inputValue;

  for (let i = 0; i < options.length; i += 1) {
    const option = options[i];

    if (option.innerText === inputValue) {
      hiddenInput.value = option.getAttribute('data-value');
      break;
    }
  }
});
