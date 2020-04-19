export default {
    run(axios) {
        const form  = document.getElementById('form')
        const nameElement = document.getElementsByName('name')
        const greetingTag = document.getElementById('greeting')

        form.onsubmit = function (event) {
            event.preventDefault();
            axios.post('', {name: nameElement[0].value}).then(({ data }) => {
                greetingTag.innerText = data.greeting;
            })
        }
    }
};
