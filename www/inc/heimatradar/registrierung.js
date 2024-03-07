// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  const inputs = document.querySelectorAll('input')
  const form = document.getElementById('form')

  for (const field of form.elements) {
    field.addEventListener("invalid", function handleInvalidField(event) {
      field.setAttribute("aria-invalid", "true");
    });
  }

  // Loop over them and prevent submission
  Array.from(inputs).forEach(input => {
  })
})()
