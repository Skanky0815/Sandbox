const form = document.getElementById('form')
const input = document.getElementsByName('name')[0]
const greetingTag = document.getElementById('greeting')
const container = document.getElementsByClassName('container')[0]

const createEntry = (greeting) => {
    const entity = document.createElement('div')
    entity.setAttribute('class', 'card message')
    entity.innerText = greeting;

    container.appendChild(entity)
}

const showMessage = (message) => {
    const error = document.createElement('p')
    error.setAttribute('class', 'error-message')
    error.innerText = message

    form.appendChild(error)
}

export default {
    run(axios) {
        form.onsubmit = (event) => {
            event.preventDefault();

            const errors = document.getElementsByClassName('error-message')
            for (const error of errors) {
                form.removeChild(error)
            }

            axios.post('', {name: input.value})
              .then(({ data }) => {
                    createEntry(data.greeting)
                    input.value = null
                })
              .catch(({response}) => {
                    showMessage(response.data.message)
                })
        }
    }
}
