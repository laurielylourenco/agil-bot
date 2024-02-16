
const formCriarConta = document.getElementById('criarConta');
const formLogin = document.getElementById('login');
const formSaudacao = document.getElementById('createSaudacao');
const formMenu = document.getElementById('createMenu');

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

                window.location.replace("http://localhost/learn-bot/agil-bot/app/Views/Home/index.php");

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

if (formMenu != null) {

    formMenu.addEventListener('submit', function (event) {
        event.preventDefault();

        var ordemMenu = document.getElementById('ordemMenu').value;
        var opcaomenu = document.getElementById('opcaomenu').value;
        var respostamenu = document.getElementById('respostamenu').value;


        // Validate the form data (you can add more validation if needed)
        if (ordemMenu.trim() === '' || opcaomenu.trim() === '' || respostamenu.trim() === '') {

            Swal.fire({
                title: "Erro",
                text: "Por informe os dados corretamente",
                icon: "error"
            });
            return;
        }

        // You can now use the form data as needed, for example, send it to a server via AJAX
        // For simplicity, we'll just log the data to the console here
        console.log('ordemMenu:', ordemMenu);
        console.log('opcaomenu:', opcaomenu);
        console.log('respostamenu:', respostamenu);


        const data = new FormData();
        data.append('ordemMenu', ordemMenu);
        data.append('opcaomenu', opcaomenu);
        data.append('respostamenu', respostamenu);
        data.append('metodo', "formMenu");

        ///var/www/html/learn-bot/agil-bot/app/Routes/MenuRoute/menu.php
        fetch("http://localhost/learn-bot/agil-bot/app/Routes/MenuRoute/menu.php", {
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


if (formSaudacao != null) {

    formSaudacao.addEventListener('submit', function (event) {
        event.preventDefault();

        console.log('event:', event);
        /* 
                var ordemMenu = document.getElementById('ordemMenu').value;
                var opcaomenu = document.getElementById('opcaomenu').value;
                var respostamenu = document.getElementById('respostamenu').value;
        
        
                // Validate the form data (you can add more validation if needed)
                if (ordemMenu.trim() === '' || opcaomenu.trim() === '' || respostamenu.trim() === '') {
        
                    Swal.fire({
                        title: "Erro",
                        text: "Por informe os dados corretamente",
                        icon: "error"
                    });
                    return;
                } */

        // You can now use the form data as needed, for example, send it to a server via AJAX
        // For simplicity, we'll just log the data to the console here
        /*         console.log('ordemMenu:', ordemMenu);
                console.log('opcaomenu:', opcaomenu);
                console.log('respostamenu:', respostamenu); */



    })
}

window.addEventListener('load', function () {

    if (formLogin != null || formCriarConta != null) {


        const data = new FormData();
        data.append('metodo', "existSession");


        fetch("http://localhost/learn-bot/agil-bot/app/Routes/AuthRoute/index.php", {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(data => {
                if (!data.status) {
                    throw new Error(data.message);
                }
                console.log('addEventListener', data);
            })
            .catch(error => {
                console.error('addEventListener:', error);
            });

    }

})