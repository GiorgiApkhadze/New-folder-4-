function LoginCheck(form)
{

    let pwd = SHA512(form.password.value);

    $.ajax({ 
        type:       'POST', 
        url:        './utils/utils_login.php', 
        data:       {
                        username: form.username.value,
                        password: pwd
                    },
        dataType:   'json',
        success:    function (data) 
                    {
                        if (data == 0) alert('Incorrect username or password.');
                        else if (data == 1) window.location.href = './admin.php';
                    }
    });
}