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

export default {
    run(axios) {
        form.onsubmit = (event) => {
            event.preventDefault();
            axios.post('', {name: input.value}).then(({ data }) => {
                createEntry(data.greeting)
                input.value = null
            })
        }
    }
}
