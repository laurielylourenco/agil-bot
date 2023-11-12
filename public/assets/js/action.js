
const formCriarConta = document.getElementById('criarConta');
const formLogin = document.getElementById('login');

if (formCriarConta != null) {
    formCriarConta.addEventListener('submit', function (event) {
        event.preventDefault();

        var name = document.getElementById('yourName').value;
        var telefone = document.getElementById('phone').value;
        var username = document.getElementById('yourUsername').value;
        var password = document.getElementById('yourPassword').value;

        // Validate the form data (you can add more validation if needed)
        if (name.trim() === '' || telefone.trim() === '' || username.trim() === '' || password.trim() === '') {

            Swal.fire({
                title: "Erro",
                text: "Por informe os dados corretamente",
                icon: "error"
            });
            return;
        }

        // You can now use the form data as needed, for example, send it to a server via AJAX
        // For simplicity, we'll just log the data to the console here
        console.log('Name:', name);
        console.log('Telefone:', telefone);
        console.log('Username:', username);
        console.log('Password:', password);


        const data = new FormData();
        data.append('name', name);
        data.append('telefone', telefone);
        data.append('username', username);
        data.append('password', password);
        data.append('metodo', "criarConta");


        fetch("http://localhost/learn-bot/agil-bot/app/Routes/AuthRoute/index.php", {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    throw new Error(data.message);
                }
                console.log('Resposta do servidor:', data);
            })
            .catch(error => {

                Swal.fire({
                    title: "Erro",
                    text: error.message,
                    icon: "error"
                });


                console.error('Erro na requisição:', error);
                console.error('TESTE:', error.message);
            });

    })

}

if (formLogin != null) {

    formLogin.addEventListener('submit', function (event) {
        event.preventDefault();

        var username = document.getElementById('yourUsername').value;
        var password = document.getElementById('yourPassword').value;

        // Validate the form data (you can add more validation if needed)
        if (username.trim() === '' || password.trim() === '') {

            Swal.fire({
                title: "Erro",
                text: "Por informe os dados corretamente",
                icon: "error"
            });
            return;
        }

        console.log('Username:', username);
        console.log('Password:', password);


        const data = new FormData();
        data.append('username', username);
        data.append('password', password);
        data.append('metodo', "login");


        fetch("http://localhost/learn-bot/agil-bot/app/Routes/AuthRoute/index.php", {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    throw new Error(data.message);
                }
                console.log('Resposta do servidor:', data);
            })
            .catch(error => {

                Swal.fire({
                    title: "Erro",
                    text: error.message,
                    icon: "error"
                });
                console.error('Erro na requisição:', error);
            });

    })
}