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
        url:        './utils/add_transfer_field.php', 
        data:       {
                        Data: Data
                    },
        dataType:   'json',
        success:    function(data) 
                    {
                        
                        fields_id.push(data);

                        document.getElementById('transfer_fields_id').value = JSON.stringify(fields_id);

                        document.getElementById('values').innerHTML = `Values:<br>
                        <input type="text" class="header_value"><br><br>`;

                    }
    });
}

function delete_transfer(id, row)
{
    
    $.ajax({ 
        type:       'POST', 
        url:        './utils/delete_transfer.php', 
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

function get_transfer_data(id, modal)
{
    
    let form = document.getElementById('update_transfer_form');

    $.ajax({ 
        type:       'POST', 
        url:        './utils/get_transfer_data.php', 
        data:       {
                        id: id
                    },
        dataType:   'json',
        success:    function(data)
                    {
                        form.name.value = data[0].name;
                        form.description.value = data[0].description;
                        form.expectation.value = data[0].expectation;
                        form.price.value = data[0].price;
                        form.type.value = data[0].type;

                        document.getElementById('transfer_id').value = id;

                        modal.style.display = 'block';
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