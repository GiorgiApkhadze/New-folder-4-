var fields_id = new Array;

function add_value()
{
    let values = document.getElementById('values');

    values.insertAdjacentHTML( 'beforeend', '<input type="text" class="header_value"><br><br>');
}

function add_additional_field()
{
    let header = document.getElementById('header').value;
    let values = document.getElementsByClassName('header_value');

    let arr = new Array;
    let vals = new Array;

    arr.push({'header' : header});

    for (let i = 0; i < values.length; i++)
    {
        vals[i] = values[i].value;
    }

    arr.push({'values' : vals});

    Data = JSON.stringify(arr);

    $.ajax({ 
        type:       'POST', 
        url:        './utils/add_job_field.php', 
        data:       {
                        Data: Data
                    },
        dataType:   'json',
        success:    function(data) 
                    {
                        
                        fields_id.push(data);

                        document.getElementById('job_fields_id').value = JSON.stringify(fields_id);

                        document.getElementById('values').innerHTML = `Job inside values:<br>
                        <input type="text" class="header_value"><br><br>`;
                        document.getElementById('header').value = '';
                    }
    });
}

function delete_job(id, row)
{
    
    $.ajax({ 
        type:       'POST', 
        url:        './utils/delete_job.php', 
        data:       {
                        id: id
                    },
        dataType:   'json',
        success:    function(data) 
                    {
                        row.parentElement.removeChild(row);
                    }
    });

}

function send_cv(input) 
{
    var formData = new FormData();

    formData.append('image', input.files[0]);
    
    $.ajax({ 
        type:       'POST', 
        url:        './utils/send_cv.php', 
        data:       formData,
        dataType:   'json',
        contentType: false,
        processData: false,
        success:    function(data) 
                    {
                        console.log(data);
                    }
    });
}